<?php
    class DbService {
        private $sqlClient;

        function __construct() {
            $this->sqlClient = new mysqli("localhost", "root", "", "bluesorcerer");
        }

#region User
        public function getUserByUsername($username) {
            $query = $this->sqlClient->prepare("SELECT Id, Username, Password, Email FROM user WHERE Username = ?");
            $query->bind_param("s", $username);
            $query->execute();

            $users = $query->get_result()->fetch_all(MYSQLI_ASSOC);

            if (sizeof($users) === 1) {
                return (object) $users[0];
            }
            // throw exception;
            return null;
        }

        public function updateUser($id, $username, $email) {
            $query = $this->sqlClient->prepare("UPDATE user SET Username = ?, Email = ? WHERE Id = ?");
            $query->bind_param("ssi", $username, $email, $id);
            $query->execute();

            if($query->affected_rows === 0) {
                return null;
            }
            return $this->getUserByUsername($username);
        }
#endregion

#region Decks
        public function addDeck($userId, $deckName, $deckDescription, $deckClass) {
            $query = $this->sqlClient->prepare("INSERT INTO deck (UserId, Name, Description, Class) VALUES (?, ?, ?, ?)");
            $query->bind_param("isss", $userId, $deckName, $deckDescription, $deckClass);
            $query->execute();

            if($query->affected_rows === 0) {
                return null;
            }
            return $this->getDeckById($query->insert_id);
        }

        public function getDeckById($deckId) {
            $query = $this->sqlClient->prepare("SELECT Id, UserId, Name, Description, Class FROM deck WHERE Id = ?");
            $query->bind_param("i", $deckId);
            $query->execute();

            $users = $query->get_result()->fetch_all(MYSQLI_ASSOC);

            if (sizeof($users) === 1) {
                return (object) $users[0];
            }
            // throw exception;
            return null;
        }

        public function getDecksByUserId($userId) {
            $query = $this->sqlClient->prepare("SELECT Id, UserId, Name, Description, Class FROM deck WHERE UserId = ?");
            $query->bind_param("i", $userId);
            $query->execute();

            $decks = $query->get_result()->fetch_all(MYSQLI_ASSOC);

            $result = array();
            foreach ($decks as $deck) {
                array_push($result, (object) $deck);
            }
            return $result;
        }

        public function getCardsByDeckId($deckId) {
            $query = $this->sqlClient->prepare("SELECT CardId, Count FROM deckcard WHERE DeckId = ?");
            $query->bind_param("i", $deckId);
            $query->execute();

            $decks = $query->get_result()->fetch_all(MYSQLI_ASSOC);

            $result = array();
            foreach ($decks as $deck) {
                array_push($result, (object) $deck);
            }
            return $result;
        }
#endregion
    }

?>