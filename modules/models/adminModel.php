<?php
class AdminModel {
    private $dbService;
    private $roleService;
    private $mailService;

    function __construct() {
        $this->dbService = new DbService();
        $this->roleService = new RoleService();
        $this->mailService = new MailService();
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

    public function createUser($username, $email, $roleId) {
        return $this->dbService->createUser($username, $email, $roleId);
    }

    public function sendPasswordResetEmail($userId, $email) {
        return $this->mailService->sendPasswordResetEmail($userId, $email);
    }

    public function getUserByResetToken($token) {
        return $this->dbService->getUserByResetToken($token);
    }
    
    public function getUserByEmail($email) {
        return $this->dbService->getUserByEmail($email);
    }
    
    public function resetPassword($userId, $password) {
        return $this->dbService->resetPassword($userId, $password);
    }

    public function doesUserAlreadyExist($username) {
        $this->dbService->getUserByUsername($username) != null;
    }
}
?>