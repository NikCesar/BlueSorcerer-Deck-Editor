<?php
    class CardService
    {
        private $baseUrl = 'https://api.hearthstonejson.com/v1/latest/enUS/cards.collectible.json'; 
        private $allCards = array();

        function __construct() {
            $this->downloadAllCards();
        }

        private function downloadAllCards() {
            ini_set("allow_url_fopen", 1);
            $json = file_get_contents($this->baseUrl);
            $this->allCards = json_decode($json);
        }

        public function searchForCards($query)
        {           
            $foundCards = array();

            foreach($this->allCards as $card) {
                if (strpos(strtolower($card->name), strtolower($query)) !== false) {
                    array_push($foundCards, $card);
                }
            }

            return $foundCards;
        }
    }
?>