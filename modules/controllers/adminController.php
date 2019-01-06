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

    /** @VIEW method */
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

    /** @VIEW method */
    public function passwordReset() {
        if (!isset($_GET["token"])) {
            redirect("home");
        }

        $resetToken = $_GET["token"];

        $user = $this->adminModel->getUserByResetToken($resetToken);

        $this->adminView->renderPasswordReset($user->Id);
    }

    public function saveUser() {
        redirectToLoginIfNotLoggedIn("admin");
        if (!$_SESSION["user"]->IsAdmin)
        {
            redirect("home");
        }

        $id = strip_tags($_POST["Id"]);
        $username = strip_tags($_POST["Username"]);
        $email = strip_tags($_POST["Email"]);
        $roleId = strip_tags($_POST["RoleId"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            redirect("admin", "index", "message=updateUserBadMail{$id}");
        }

        $updatedUser = $this->adminModel->updateUser($id, $username, $email, $roleId);

        redirect("admin", "index");
    }

    public function createUser() {
        redirectToLoginIfNotLoggedIn("admin");
        if (!$_SESSION["user"]->IsAdmin)
        {
            redirect("home");
        }

        if(isset($_POST['username']) && isset($_POST["email"]) && isset($_POST["roleId"])) {
            $username = strip_tags($_POST["username"]);
            $email = strip_tags($_POST["email"]);
            $roleId = strip_tags($_POST["roleId"]);

            if ($this->adminModel->doesUserAlreadyExist($username) 
                || trim($username) === "" || trim($email) === ""
                || $roleId < 0) {
                redirect("admin", "index", "message=createUserFail");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirect("admin", "index", "message=createUserBadMail");
            }

            $user = $this->adminModel->createUser($username, $email, $roleId);
            $this->adminModel->sendPasswordResetEmail($user->Id, $email);

            redirect("admin", "index", "message=createUserSuccess");
        }
        
        redirect("admin", "index", "message=createUserFail");
    }

    public function doResetPassword() {
        if(isset($_POST['userId']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
            $userId = strip_tags($_POST["userId"]);
            $password = strip_tags($_POST["password"]);
            $passwordConfirm = strip_tags($_POST["passwordConfirm"]);

            if ($password !== $passwordConfirm || strlen($password) < 4) {
                redirect("admin", "passwordreset", "message=resetPasswordBadInput&token=".$_POST["token"]);
            }

            $success = $this->adminModel->resetPassword($userId, password_hash($password, PASSWORD_DEFAULT));

            if ($success) {
                redirect("admin", "index", "message=resetPasswordSuccess");
            }
            else {
                redirect("admin", "passwordreset", "message=resetPasswordFail&token=".$_POST["token"]);
            }
        }

        redirect("admin", "passwordreset", "message=resetPasswordBadInput&token=".$_POST["token"]);
    }
}
?>