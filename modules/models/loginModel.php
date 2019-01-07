<?php
class LoginModel {
    private $dbService;
    private $roleService;

    function __construct() {
        $this->dbService = new DbService();
        $this->roleService = new RoleService();
    }

    function getUserByUsername($username) {
        $user = $this->dbService->getUserByUsername($username);
        $user->IsAdmin = $this->roleService->isAdmin($user->RoleId);
        return $user;
    }
}
?>