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
            if (property_exists($row, "rarity")) {
                $cardObject["rarity"] = $row->rarity;
            }


            $this->cardsMap[$row->id] = (object)$cardObject;
        }
    }

    public function getCardsMap() {
        return $this->cardsMap;
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