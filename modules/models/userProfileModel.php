<?php
class UserProfileModel {
    private $dbService;
    private $roleService;

    function __construct() {
        $this->dbService = new DbService();
        $this->roleService = new RoleService();
    }

    public function updateUser($id, $username, $email, $roleId) {
        return $this->dbService->updateUser($id, $username, $email, $roleId);
    }

    function getUserByUsername($username) {
        $user = $this->dbService->getUserByUsername($username);
        if ($user !== null) {
            $user->IsAdmin = $this->roleService->isAdmin($user->RoleId);
        }
        return $user;
    }
}
?>