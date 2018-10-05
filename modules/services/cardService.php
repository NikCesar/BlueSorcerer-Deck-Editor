<?php
    class CardService
    {
        private $baseUrl = 'https://api.hearthstonejson.com/v1/latest/enUS/cards.collectible.json'; 
        private $imageUrlFormat = "https://art.hearthstonejson.com/v1/render/latest/enUS/256x/{id}.png";
        private $cardsMap = array();

        function __construct() {
            $this->downloadAllCards();
        }

        private function downloadAllCards() {
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

            foreach($this->cardsMap as $card) {
                if (strpos(strtolower($card[0]->name), strtolower($query)) !== false) {
                    array_push($foundCards, $card[0]);
                }
            }

            return $foundCards;
        }

        public function getCardsByDecklist($ids)
        {           
            $foundCards = array();

            foreach($ids as $cardId) {
                array_push($foundCards, $this->cardsMap[$cardId][0]);
            }

            return $foundCards;
        }
    }
?>