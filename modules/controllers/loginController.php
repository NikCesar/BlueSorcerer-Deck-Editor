<?php
    $dbService = new DbService();

    if(isset($_POST['functionname']) && $_POST['functionname'] == "login"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $dbUser = $dbService->getUserByUsername($username);

        $isLoginValid = verifyLogin($username, $password, $dbUser);

        if ($isLoginValid) {
            $_SESSION["user"] = $dbUser;
            $_SESSION["isLoggedIn"] = true;

            if (isset($_GET["redirect"])) {
                redirect($_GET["redirect"]);
            }

            redirect("home", "message=loginSuccess");
        } else {
            redirect("login", "message=loginFail");
        }
    }

    function verifyLogin($username, $password, $dbUser) {
        if ($dbUser === null) {
            return false;
        }
        return password_verify($password, $dbUser->Password);
    }
?>