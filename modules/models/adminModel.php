<?php
class AdminModel {
    private $dbService;

    function __construct() {
        $this->dbService = new DbService();
    }

    function getAllUsers() {
        $users = $this->dbService->getAllUsers();
        foreach ($users as $user) {
            $user->isAdmin = isAdmin($user);
        }
        return $users;
    }

    public function updateUser($id, $username, $email, $roleId) {
        return $this->dbService->updateUser($id, $username, $email, $roleId);
    }
}
?>