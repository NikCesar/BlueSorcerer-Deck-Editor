<?php

require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/adminView.php";
require_once "$_SERVER[DOCUMENT_ROOT]/modules/models/adminModel.php";

class AdminController {

    private $adminModel;
    private $adminView;

    public $defaultAction = "index";

    function __construct() {
        $this->adminModel = new AdminModel();
        $this->adminView = new AdminView();
    }

    /** @view method */
    public function index() {
        redirectToLoginIfNotLoggedIn("admin");
        if (!$_SESSION["user"]->IsAdmin)
        {
            redirect("home");
        }

        $users = $this->adminModel->getAllUsers();
        $roles = $this->adminModel->getRoles();

        $this->adminView->renderUsers($users, $roles);
    }

    public function saveUser() {
        $id = strip_tags($_POST["Id"]);
        $username = strip_tags($_POST["Username"]);
        $email = strip_tags($_POST["Email"]);
        $roleId = strip_tags($_POST["RoleId"]);

        $updatedUser = $this->adminModel->updateUser($id, $username, $email, $roleId);

        redirect("admin", "index");
    }
}
?>