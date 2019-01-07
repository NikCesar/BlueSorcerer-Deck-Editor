<?php
require_once ("$_SERVER[DOCUMENT_ROOT]/modules/view/loginView.php");
require_once ("$_SERVER[DOCUMENT_ROOT]/modules/models/loginModel.php");

class LoginController {

    private $loginModel;
    private $loginView;
    private $redirectTo;

    public $defaultAction = "showLogin";

    function __construct() {
        $this->loginModel = new LoginModel();
        $this->loginView = new LoginView();
    }

    /** @view method */
    public function showLogin() {
        $this->loginView->renderLogin();
    }

    /** @VIEW method */
    public function register() {
        $roles = $this->loginModel->getRoles();

        $rolesWithoutAdmin = [];
        foreach ($roles as $role) {
            if (!$this->loginModel->isRoleAdmin($role->Id)) {
                array_push($rolesWithoutAdmin, $role);
            }
        }

        $this->loginView->renderRegister($rolesWithoutAdmin);
    }

    public function doLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $dbUser = $this->loginModel->getUserByUsername($username);

        $isLoginValid = $this->verifyLogin($username, $password, $dbUser);

        if ($isLoginValid) {
            $_SESSION["user"] = $dbUser;
            $_SESSION["isLoggedIn"] = true;

            if (isset($_SESSION["redirectTo"])) {
                $redirectTo = $_SESSION["redirectTo"];
                $_SESSION["redirectTo"] = null;
                redirect($redirectTo);
            }

            redirect("home", "index", "message=loginSuccess");
        } else {
            redirect("login", "index", "message=loginFail");
        }
    }

    private function verifyLogin($username, $password, $dbUser) {
        if ($dbUser === null) {
            return false;
        }
        return password_verify($password, $dbUser->Password);
    }

    public function doRegister() {
        if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
            $username = strip_tags($_POST["username"]);
            $email = strip_tags($_POST["email"]);
            $password = strip_tags($_POST["password"]);
            $passwordConfirm = strip_tags($_POST["passwordConfirm"]);
            $roleId = strip_tags($_POST["roleId"]);

            
            if (empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $password !== $passwordConfirm || strlen($password) < 4) {
                redirect("login", "register", "message=registerBadInput");
            }

            if ($this->loginModel->doesUserAlreadyExist($username) || trim($username) === "" || trim($email) === "") {
                redirect("login", "index", "message=createUserFail");
            }

            $success = $this->loginModel->registerUser($username, $email, password_hash($password, PASSWORD_DEFAULT), $roleId);

            if ($success) {
                redirect("login", "index", "message=registerSuccess");
            }
            else {
                redirect("login", "register", "message=registerBadInput");
            }
        }

        redirect("login", "register", "message=registerBadInput");
    }
}
?>