<?php
class UserProfileModel {
    private $dbService;

    function __construct() {
        $this->dbService = new DbService();
    }

    public function updateUser($id, $username, $email) {
        return $this->dbService->updateUser($id, $username, $email);
    }
}
?>