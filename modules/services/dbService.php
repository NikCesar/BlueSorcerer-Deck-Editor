<?php
    class DbService {
        private $sqlClient;

        function __construct() {
            $this->sqlClient = new mysqli("localhost", "root", "", "bluesorcerer");
        }

        public function executeQuery($sqlQuery) {
            $result = $this->sqlClient->query($sqlQuery);
            $results = array();

            while($row = $result->fetch_assoc()) {
                array_push($results, (object)$row);
            }
            
            return $results;
        }
    }

?>