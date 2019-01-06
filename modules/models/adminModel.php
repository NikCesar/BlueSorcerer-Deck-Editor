<?php
class AdminModel {
    private $dbService;
    private $roleService;

    function __construct() {
        $this->dbService = new DbService();
        $this->roleService = new RoleService();
    }

    function getAllUsers() {
        $users = $this->dbService->getAllUsers();
        foreach ($users as $user) {
            $user->isAdmin = $this->roleService->isAdmin($user);
        }
        return $users;
    }

    public function getRoles() {
        return $this->roleService->getRoles();
    }

    public function updateUser($id, $username, $email, $roleId) {
        return $this->dbService->updateUser($id, $username, $email, $roleId);
    }
}
?>