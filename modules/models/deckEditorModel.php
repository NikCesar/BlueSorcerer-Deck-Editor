<?php
class DeckEditorModel {
    private $dbService;
    private $cardService;
    private $deckService;

    function __construct() {
        $this->dbService = new DbService();
        $this->cardService = new CardService();
        $this->deckService = new DeckService();
    }

    public function getDeck($deckId) 
    {
        if ($deckId == null || $deckId < 0) {
            return null;
        }

        $deck = $this->dbService->getDeckById($deckId);
        return $deck;
    }

    public function getDeckList($deck) {
        if ($deck == null || $deck->Id < 0) {
            return null;
        }
    
        if ($deck->UserId != $_SESSION["user"]->Id) {
            return null;
        }

        $deckList = $this->dbService->getCardsByDeckId($deck->Id);
        return $deckList;
    }

    public function removeCard($deckId, $cardId) {
        $success = $this->dbService->removeCard($deckId, $cardId);
        return $success;
    }

    public function addCard($deckId, $cardId, $isLegendary) {
        $success = $this->dbService->addCard($deckId, $cardId, 1, $isLegendary);
        return $success;
    }

    public function addDeck($userId, $deckName, $deckDescription, $deckClass) {
        $deck = $this->dbService->addDeck($userId, $deckName, $deckDescription, $deckClass);
        return $deck;
    }

    public function getSidebarDeck($deckId) {
        $deckList = $this->dbService->getCardsByDeckId($deckId);
        $deckListCards = $this->cardService->getCardsByDecklist($deckList);

        $sidebarDeck = $this->deckService->mapSideBarDeck($deckList, $deckListCards);

        return $sidebarDeck;
    }
}
?>