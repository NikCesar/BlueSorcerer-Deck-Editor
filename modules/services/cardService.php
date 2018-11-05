<?php

class CardService
{
    private $baseUrl = 'https://api.hearthstonejson.com/v1/latest/enUS/cards.collectible.json';
    private $cardsMap = array();

    function __construct()
    {
        // download all cards
        ini_set("allow_url_fopen", 1);
        $json = file_get_contents($this->baseUrl);
        $allCards = json_decode($json);

        foreach ($allCards as $row) {
            $cardObject = array(
                "id" => $row->id,
                "name" => $row->name,
                "cardClass" => $row->cardClass,
                "collectible" => $row->collectible,
                "set" => $row->set,
            );
            if (property_exists($row, "text")) {
                $cardObject["text"] = $row->text;
            }
            if (property_exists($row, "attack")) {
                $cardObject["attack"] = $row->attack;
            }
            if (property_exists($row, "health")) {
                $cardObject["health"] = $row->health;
            }
            if (property_exists($row, "cost")) {
                $cardObject["cost"] = $row->cost;
            }
            if (property_exists($row, "race")) {
                $cardObject["race"] = $row->race;
            }
            if (property_exists($row, "type")) {
                $cardObject["type"] = $row->type;
            }


            $this->cardsMap[$row->id] = (object)$cardObject;
        }
    }

    public function searchForCards($query)
    {
        $foundCards = array();

        if (trim($query) == '')
            return $foundCards;

        foreach ($this->cardsMap as $card) {
            if (strpos(strtolower($card->name), strtolower($query)) !== false) {
                array_push($foundCards, $card);
            }
        }

        return $foundCards;
    }

    public function searchForCardsByQueries($queries)
    {
        $foundCards = array();

        if (count($queries) == 0) {
            return $foundCards;
        }

        foreach ($this->cardsMap as $card) {
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

    public function getCardsByDecklist($deckList)
    {
        $foundCards = array();

        foreach ($deckList as $deckCard) {
            array_push($foundCards, $this->cardsMap[$deckCard->CardId]);
        }

        return $foundCards;
    }
}

?>