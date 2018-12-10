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

            redirect("home", "message=loginSuccess");
        } else {
            redirect("login", "message=loginFail");
        }
    }

    private function verifyLogin($username, $password, $dbUser) {
        if ($dbUser === null) {
            return false;
        }
        return password_verify($password, $dbUser->Password);
    }
}
?>