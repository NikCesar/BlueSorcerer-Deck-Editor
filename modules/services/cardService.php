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

        if (trim($queries) == '')
            return $foundCards;

        $queryArray = json_decode($queries);

        foreach ($this->cardsMap as $card) {
            $cardIsMatch = false;
            foreach ($queryArray as $key => $value) {
                if (property_exists($card[0], $key)) {
                    if ($key === "name" || $key === "text") {
                        if ($value === "") {
                            $cardIsMatch = true;
                        } else if (strpos(strtolower($card[0]->$key), strtolower($value)) !== false) {
                            $cardIsMatch = true;
                            break;
                        }
                    } else {
                        if (strtolower($card[0]->$key) === strtolower($value)) {
                            $cardIsMatch = true;
                            break;
                        }
                    }
                } else {

                }
            }
            if ($cardIsMatch) {
                array_push($foundCards, $card[0]);
            }
        }

        return $foundCards;
    }

    public function getCardsByDecklist($ids)
    {
        $foundCards = array();

        foreach ($ids as $cardId) {
            array_push($foundCards, $this->cardsMap[$cardId][0]);
        }

        return $foundCards;
    }
}

?>