<?php
class CardSearchModel {

    private $cardService;

    public function __construct() {
        $this->cardService = new CardService();
    }

    public function searchForCardsByQueries() {
        $queries = array();
        if (isset($_POST['cardName']) && $_POST['cardName'] !== "") {
            $queries['name'] = strip_tags($_POST['cardName']);
        }
        if (isset($_POST['cardText']) && $_POST['cardText'] !== "") {
            $queries['text'] = strip_tags($_POST['cardText']);
        }
        if (isset($_POST['cardCost']) && $_POST['cardCost'] !== "") {
            $queries['cost'] = strip_tags($_POST['cardCost']);
        }
        if (isset($_POST['cardAttack']) && $_POST['cardAttack'] !== "") {
            $queries['attack'] = strip_tags($_POST['cardAttack']);
        }
        if (isset($_POST['cardHealth']) && $_POST['cardHealth'] !== "") {
            $queries['health'] = strip_tags($_POST['cardHealth']);
        }
        if (isset($_GET['page']) && $_GET['page'] === "deckEditor" && isset($_SESSION['deckClass']) && $_SESSION['deckClass'] !== "") {
            $queries['deckClass'] = strip_tags($_SESSION['deckClass']);
        };
        if (isset($_POST['classSelect']) && $_POST['classSelect'] !== "") {
            $queries['cardClass'] = strip_tags($_POST['classSelect']);
        }
        if (isset($_POST['typeSelect']) && $_POST['typeSelect'] !== "") {
            $queries['type'] = strip_tags($_POST['typeSelect']);
        }
        if ((isset($_POST['raceSelect']) && $_POST['raceSelect'] !== "") && (isset($_POST['typeSelect']) && ($_POST['typeSelect'] === "Minion" || $_POST['typeSelect'] === ""))) {
            $queries['race'] = strip_tags($_POST['raceSelect']);
        }
        if (isset($_POST['setSelect']) && $_POST['setSelect'] !== "") {
            $queries['set'] = strip_tags($_POST['setSelect']);
        }
        $queries['collectible'] = true;

        $foundCards = array();

        if (count($queries) == 1 || (count($queries) == 2 && array_key_exists("deckClass", $queries))) {
            $GLOBALS['cardSearchResult'] = new CardSearchResult($foundCards);
            return $foundCards;
        }

        foreach ($this->cardService->getCardsMap() as $card) {
            $cardIsMatch = true;
            foreach ($queries as $key => $value) {
                if (property_exists($card, $key)) {
                    if ($key === "name" || $key === "text") {
                        if ($value === "") {
                            $cardIsMatch = true;
                        } else if (strpos(strtolower($card->$key), strtolower($value)) === false) {
                            $cardIsMatch = false;
                            continue;
                        }
                    } else if (strtolower($card->$key) !== strtolower($value)) {
                        $cardIsMatch = false;
                    }
                } else if ($key === 'deckClass') {
                    if (property_exists($card, "cardClass")) {
                        if (strtolower($card->cardClass) !== strtolower($queries['deckClass']) && $card->cardClass !== "NEUTRAL") {
                            $cardIsMatch = false;
                        }
                    }
                } else {
                    $cardIsMatch = false;
                }
            }
            if ($cardIsMatch) {
                array_push($foundCards, $card);
            }
        }
        usort($foundCards, function ($a, $b) {
            $aCost = property_exists($a, "cost") ? $a->cost : 0;
            $bCost = property_exists($b, "cost") ? $b->cost : 0;
            $isBigger = $aCost > $bCost;
            return $isBigger;
        });
        return $foundCards;
    }

    public function getCardsMap() {
        return $this->cardService->getCardsMap();
    }
}
?>