<?php
    $dbService = new DbService();

    if(isset($_GET['functionname']) && $_GET['functionname'] == "logout"){
        if (isLoggedIn()) {
            $_SESSION["user"] = null;
            $_SESSION["isLoggedIn"] = false;

            redirect("home", "message=logoutSuccess");
        }
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "saveUserProfile"){
        $id = $_SESSION["user"]->Id;
        $username = strip_tags($_POST["Username"]);
        $email = strip_tags($_POST["Email"]);

        $updatedUser = $dbService->updateUser($id, $username, $email);

        $_SESSION["user"] = $updatedUser;
    }
?>