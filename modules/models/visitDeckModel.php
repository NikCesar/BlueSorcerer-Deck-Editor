<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nik
 * Date: 06.01.2019
 * Time: 15:48
 */

class VisitDeckModel
{

    private $visitedDeck;
    private $visitedDeckCards;

    function __construct() {
        $this->dbService = new DbService();
    }

    public function getVisitedDeckById($deckId) {
        $this->visitedDeck = $this->dbService->getDeckById($deckId);
        return $this->visitedDeck;
    }

    public function getVisitedDeckCardsByDeckId($deckId) {
        $this->visitedDeckCards = $this->dbService->getCardsByDeckId($deckId);
        return $this->visitedDeckCards;
    }

}