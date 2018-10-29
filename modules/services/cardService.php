<?php

class CardService
{
    private $baseUrl = 'https://api.hearthstonejson.com/v1/latest/enUS/cards.collectible.json';
    private $imageUrlFormat = "https://art.hearthstonejson.com/v1/render/latest/enUS/256x/{id}.png";
    private $cardsMap = array();

    function __construct()
    {
        // download all cards
        ini_set("allow_url_fopen", 1);
        $json = file_get_contents($this->baseUrl);
        $allCards = json_decode($json);

        foreach ($allCards as $row) {
            $row->imgLink = str_replace("{id}", $row->id, $this->imageUrlFormat);
            $this->cardsMap[$row->id][] = $row;
        }
    }

    public function searchForCards($query)
    {
        $foundCards = array();

        if (trim($query) == '')
            return $foundCards;

        foreach ($this->cardsMap as $card) {
            if (strpos(strtolower($card[0]->name), strtolower($query)) !== false) {
                array_push($foundCards, $card[0]);
            }
        }

        return $foundCards;
    }

    public function searchForCardsByQueries($queries)
    {
        $foundCards = array();

        if (count($queries) == 0){
            return $foundCards;
        }

        foreach ($this->cardsMap as $card) {
            $cardIsMatch = true;
            foreach ($queries as $key => $value) {
                if (property_exists($card[0], $key)) {
                    if ($key === "name" || $key === "text") {
                        if ($value === "") {
                            $cardIsMatch = true;
                        } else if (strpos(strtolower($card[0]->$key), strtolower($value)) === false) {
                            $cardIsMatch = false;
                            break;
                        }
                    } else {
                        if (strtolower($card[0]->$key) !== strtolower($value)) {
                            $cardIsMatch = false;
                        }
                    }
                } else {
                    $cardIsMatch = false;
                }
            }
            if ($cardIsMatch) {
                array_push($foundCards, $card[0]);
            }
        }
        usort($foundCards, function($a, $b) {
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
            for ($i = 0; $i < $deckCard->Count; $i++) {
                array_push($foundCards, $this->cardsMap[$deckCard->CardId][0]);
            }
        }

        return $foundCards;
    }
}

?>