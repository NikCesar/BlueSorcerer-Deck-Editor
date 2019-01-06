<?php

class DbService
{
    private $sqlClient;

    function __construct()
    {
        $this->sqlClient = new mysqli("localhost", "root", "", "bluesorcerer");
    }

#region User
    public function getUserByUsername($username)
    {
        $query = $this->sqlClient->prepare("SELECT Id, Username, Password, Email FROM user WHERE Username = ?");
        $query->bind_param("s", $username);
        $query->execute();

        $users = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        if (sizeof($users) === 1) {
            return (object)$users[0];
        }
        // throw exception;
        return null;
    }

    public function updateUser($id, $username, $email)
    {
        $query = $this->sqlClient->prepare("UPDATE user SET Username = ?, Email = ? WHERE Id = ?");
        $query->bind_param("ssi", $username, $email, $id);
        $query->execute();

        if ($query->affected_rows === 0) {
            return null;
        }
        return $this->getUserByUsername($username);
    }
#endregion

#region Decks
    public function getCardCount($deckId, $cardId)
    {
        $query = $this->sqlClient->prepare("SELECT Count FROM deckcard WHERE DeckId = ? AND CardId = ?");
        $query->bind_param("is", $deckId, $cardId);
        $query->execute();

        $deckCard = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        if (sizeof($deckCard) === 1) {
            return ((object)$deckCard[0])->Count;
        }
        return null;
    }

    public function getCardCountInDeck($deckId) {
        $query = $this->sqlClient->prepare("SELECT sum(Count) as Sum FROM deckcard WHERE DeckId = ?");
        $query->bind_param("i", $deckId);
        $query->execute();

        $deckCount = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        if (sizeof($deckCount) === 1) {
            return ((object)$deckCount[0])->Sum;
        }
        return null;
    }

    public function addCard($deckId, $cardId, $count = 1, $isLegendary)
    {
        $currentCount = $this->getCardCount($deckId, $cardId);
        $deckSize = $this->getCardCountInDeck($deckId);

        if ($deckSize !== null && $deckSize === "30") {
            return false;
        }

        if ($currentCount === null) {
            $query = $this->sqlClient->prepare("INSERT INTO deckcard (DeckId, CardId, Count) VALUES (?, ?, ?)");
            $query->bind_param("isi", $deckId, $cardId, $count);
            $query->execute();
        } else if ($isLegendary && $currentCount >= 1) {
            return false;
        } else if ($currentCount >= 2) {
            return false;
        } else {
            $newCount = $currentCount + $count;
            $query = $this->sqlClient->prepare("UPDATE deckcard SET Count = ? WHERE DeckId = ? AND CardId = ?");
            $query->bind_param("iis", $newCount, $deckId, $cardId);
            $query->execute();
        }

        if ($query->affected_rows === 0) {
            return false;
        }
        return true;
    }

    public function removeCard($deckId, $cardId, $count = 1)
    {
        $currentCount = $this->getCardCount($deckId, $cardId);

        if ($currentCount <= 1) {
            $query = $this->sqlClient->prepare("DELETE FROM deckcard WHERE DeckId = ? AND CardId = ?");
            $query->bind_param("is", $deckId, $cardId);
            $query->execute();
        } else {
            $newCount = $currentCount - $count;

            $query = $this->sqlClient->prepare("UPDATE deckcard SET Count = ? WHERE DeckId = ? AND CardId = ?");
            $query->bind_param("iis", $newCount, $deckId, $cardId);
            $query->execute();
        }

        if ($query->affected_rows === 0) {
            return false;
        }
        return true;
    }

    public function addDeck($userId, $deckName, $deckDescription, $deckClass, $published, $publishDate)
    {
        $query = $this->sqlClient->prepare("INSERT INTO deck (UserId, Name, Description, Class, Published, PublishDate) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("isssss", $userId, $deckName, $deckDescription, $deckClass, $published, $publishDate);
        $query->execute();

        if ($query->affected_rows === 0) {
            return null;
        }
        return $this->getDeckById($query->insert_id);
    }

    public function updateDeck($deckId, $deckName, $deckDescription, $deckClass, $published, $publishDate)
    {
        $query = $this->sqlClient->prepare("UPDATE deck SET Name = ?, Description = ?, Class = ?, Published=?, PublishDate=? WHERE Id = ?");
        $query->bind_param("sssssi", $deckName, $deckDescription, $deckClass, $published, $publishDate, $deckId);
        $query->execute();

        if ($query->affected_rows === 0) {
            return null;
        }
        return $this->getDeckById($deckId);
    }

    public function getDeckById($deckId)
    {
        $query = $this->sqlClient->prepare("SELECT Id, UserId, Name, Description, Class, Published, PublishDate FROM deck WHERE Id = ?");
        $query->bind_param("i", $deckId);
        $query->execute();

        $users = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        if (sizeof($users) === 1) {
            $deck = (object)$users[0];
            $_SESSION['deckClass'] = $deck->Class;
            return $deck;
        }
        // throw exception;
        return null;
    }

    public function getNewestDecks()
    {
        $query = $this->sqlClient->prepare("SELECT Id, UserId, Name, Description, Class, Published, PublishDate FROM deck ORDER BY PublishDate DESC LIMIT 10");
        $query->execute();

        $newestDecks = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        $result = array();

        if (sizeof($newestDecks) >= 0) {
            foreach($newestDecks as $deck) {
                array_push($result, (object)$deck);
            }
            return $result;
        }
        //throw exception
        return null;
    }

    public function getDecksByUserId($userId)
    {
        $query = $this->sqlClient->prepare("SELECT Id, UserId, Name, Description, Class, Published, PublishDate FROM deck WHERE UserId = ?");
        $query->bind_param("i", $userId);
        $query->execute();

        $decks = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        $result = array();
        foreach ($decks as $deck) {
            array_push($result, (object)$deck);
        }
        return $result;
    }

    public function getCardsByDeckId($deckId)
    {
        $query = $this->sqlClient->prepare("SELECT CardId, Count FROM deckcard WHERE DeckId = ?");
        $query->bind_param("i", $deckId);
        $query->execute();

        $decks = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        $result = array();
        foreach ($decks as $deck) {
            array_push($result, (object)$deck);
        }
        return $result;
    }
#endregion
}

?>