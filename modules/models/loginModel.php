<?php
class LoginModel {
    private $dbService;

    function __construct() {
        $this->dbService = new DbService();
    }

    function getUserByUsername($username) {
        return $this->dbService->getUserByUsername($username);
    }
}
?>