<?php

require_once "$_SERVER[DOCUMENT_ROOT]/modules/services/dbService.php";

class RoleService
{
    private $dbService;
    private $roles = [];

    function __construct()
    {
        $this->dbService = new DbService();

        $this->roles = $this->dbService->getRoles();
    }

    function getRoles() {
        return $this->roles;
    }

    function isAdmin($user) {
        return $user->RoleId === $this->getRoleIdByRoleName("Administrator");
    }

    function getRoleIdByRoleName($roleName) {
        foreach ($this->roles as $key => $role) {
            if ($role->Name === $roleName) {
                return $role->Id;
            }
        }
        return null;
    }  
}