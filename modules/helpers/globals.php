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

    function validationMessageFor($messageName, $textLookup = null) {
        if ($textLookup === null) {
            $textLookup = $messageName;
        }
        if (hasMessage($messageName)) {
            echo "<section>" .
                    "<label class=\"validation-error\">" . text($textLookup) . "</label>" .
                 "</section>";
        }        
    }

    function redirectToLoginIfNotLoggedIn($redirectTo = "") {
        if (!isLoggedIn()) {
            $_SESSION["redirectTo"] = $redirectTo;
            redirect("login");
        }
    }

    function redirect($controller = "home", $action = "", $params = "") {
        if (!empty($params)) {
            echo "<script type=\"text/javascript\">location.href='http://{$_SERVER["SERVER_NAME"]}/{$controller}/{$action}?{$params}';</script>";
            //header("Location: http://{$_SERVER["SERVER_NAME"]}/{$controller}/{$action}?{$params}");
            exit;
        }

        //header("Location: http://{$_SERVER["SERVER_NAME"]}/{$controller}/{$action}");
        echo "<script type=\"text/javascript\">location.href='http://{$_SERVER["SERVER_NAME"]}/{$controller}/{$action}';</script>";
        exit;
    }

    function getCardImgLink($cardId) {
        return "https://art.hearthstonejson.com/v1/render/latest/enUS/256x/{$cardId}.png";
    }

    function setPageTitle($pageTitle) {
        echo "<script type=\"text/javascript\">document.title='$pageTitle';</script>";
    }
?>
