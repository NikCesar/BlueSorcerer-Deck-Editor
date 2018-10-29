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
                header("Location: http://" . $_SERVER["SERVER_NAME"] . "?page=" . $_GET["redirect"]);
                exit;
            }

            // Redirect to Home.
            header("Location: http://" . $_SERVER["SERVER_NAME"] . "?message=loginSuccess");
            exit;
        } else {
            header("Location: http://" . $_SERVER["SERVER_NAME"] . "?page=login&message=loginFail");
            exit;
        }
    }

    function verifyLogin($username, $password, $dbUser) {
        if ($dbUser === null) {
            return false;
        }
        return password_verify($password, $dbUser->Password);
    }
?>