<?php
class DeckEditorModel {
    function __construct() {
        $this->dbService = new DbService();
        $this->cardService = new CardService();
        $this->deckService = new DeckService();
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
        $deckList = $dbService->getCardsByDeckId($deckId);
        $deckListCards = $cardService->getCardsByDecklist($deckList);

        $sidebarDeck = $deckService->mapSideBarDeck($deckList, $deckListCards);

        return $sidebarDeck;
    }
}
?>