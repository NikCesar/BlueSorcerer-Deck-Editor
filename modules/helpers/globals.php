<?php
    function isLoggedIn() {
        return isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] === true;
    }

    function hasAnyMessage() {
        return isset($_GET["message"]);
    }

    function hasMessage($message) {
        return isset($_GET["message"]) && $_GET["message"] === $message;
    }

    function validationMessageFor($messageName) {
        if (hasMessage($messageName)) {
            echo "<section>" .
                    "<label class=\"validation-error\">" . text($messageName) . "</label>" .
                 "</section>";
        }        
    }

    function redirectToLoginIfNotLoggedIn($redirectTo = "") {
        if (!isLoggedIn()) {    
            $redirect = $redirectTo !== "" && $redirectTo !== null ? "&redirect=" . $redirectTo : "";
            $url = "http://" . $_SERVER["SERVER_NAME"] . "?page=login" . $redirect;
            echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
            exit;
        }
    }
?>
