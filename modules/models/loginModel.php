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

    function isRoleAdmin($roleId) {
        return $this->roleService->isAdmin($roleId);
    }

    public function doesUserAlreadyExist($username) {
        $this->dbService->getUserByUsername($username) != null;
    }
    
    public function getRoles() {
        return $this->roleService->getRoles();
    }

    public function registerUser($username, $email, $password, $roleId) {
        return $this->dbService->registerUser($username, $email, $password, $roleId);
    }
}
?>