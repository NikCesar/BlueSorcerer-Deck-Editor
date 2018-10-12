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

        public function getUserByUsername($username) {
            $users = $this->executeQuery("SELECT Id, Username, Password FROM user WHERE Username = '" . $username . "'");

            if (sizeof($users) === 1) {
                return $users[0];
            }
            // throw exception;
            return null;
        }
    }

?>