<?php
    class DbService {
        private $sqlClient;

        function __construct() {
            $this->sqlClient = new mysqli("localhost", "root", "", "bluesorcerer");
        }

        public function getUserByUsername($username) {
            $query = $this->sqlClient->prepare("SELECT Id, Username, Password, Email FROM user WHERE Username = ?");
            $query->bind_param("s", $username);
            $query->execute();

            $users = $query->get_result()->fetch_all(MYSQLI_ASSOC);

            if (sizeof($users) === 1) {
                return (object) $users[0];
            }
            // throw exception;
            return null;
        }

        public function updateUser($id, $username, $email) {
            $query = $this->sqlClient->prepare("UPDATE user SET Username = ?, Email = ? WHERE Id = ?");
            $query->bind_param("ssi", $username, $email, $id);
            $query->execute();

            if($query->affected_rows === 0) {
                return null;
            }
            return $this->getUserByUsername($username);
        }
    }

?>