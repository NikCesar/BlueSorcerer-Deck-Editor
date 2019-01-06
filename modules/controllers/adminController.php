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
        redirectToLoginIfNotAuthorized("admin");

        $users = $this->adminModel->getAllUsers();
        $this->adminView->renderUsers($users);
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