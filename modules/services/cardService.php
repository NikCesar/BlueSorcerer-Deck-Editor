<?php
    class CardService
    {
        // https://market.mashape.com/omgvamp/hearthstone
        private $baseUrl = 'https://omgvamp-hearthstone-v1.p.mashape.com/cards/'; 
        private $authenticationArray = array('X-Mashape-Key: Law2aqNS0LmshaQuw94sPj0yVk0bp1Ni6AXjsnvgaylweSq7CG');

        public function searchForCards($query)
        {
            $curlRequest = curl_init($this->baseUrl . "search/" . $query);

            curl_setopt($curlRequest, CURLOPT_HTTPHEADER, $this->authenticationArray);
            curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curlRequest);

            return $response;
        }
    }
?>