<?php
    if(isset($_GET['functionname']) && $_GET['functionname'] == "logout"){
        if (isLoggedIn()) {
            $_SESSION["user"] = null;
            $_SESSION["isLoggedIn"] = false;

            // Redirect to Home.
            header("Location: http://" . $_SERVER["SERVER_NAME"] . "?message=logoutSuccess");
        }
    }
?>