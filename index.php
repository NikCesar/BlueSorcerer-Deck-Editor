<?php
    include "modules/helpers/globals.php";

    include "modules/requestHandler.php";
    include "modules/helpers/contentRenderer.php";

    ensureSessionStartAndSetLanguage();

    // declare exception rulesets.
    $noHtmlCalls = array();
    setupRoutingExceptions();

    // redirect to controller and action.
    $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $controller = "";
    $action = "";
    getControllerAndActionFromRequestUrl();
    
    // try resolve controller.
    $controllerInstance = null;
    resolveControllerInstance();

    // decide wether or not the path controller/action is a JS call. If so, render without html/body.
    applyRountingExceptions();
?>

<?php 
    /**
     * Private functions are here.
     */

    function ensureSessionStartAndSetLanguage() {
        if (!isset($_SESSION))
        {
            session_start();
        } 
        
        if (!array_key_exists("language", $_SESSION)) {
            $_SESSION["language"] = "en";
        }
    }

    function setupRoutingExceptions() {
        array_push($noHtmlCalls, "deckEditor/getJsDeck");
    }

    function getControllerAndActionFromRequestUrl() {
        $components = explode('/', $requestUrl);

        // set controller and action from path, if possible.
        if (count($components) == 2) {
            if (empty($components[1])) {
                $components[1] = "Home";
            }
            $controller = $components[1] . "Controller";
        } else if (count($components) == 3) {
            $controller = $components[1] . "Controller";
            $action = $components[2];
        } else {
            $controller = "HomeController";
            $action = "index";
        }

        // try to get default action if none was specified.
        if (!isset($action) || empty($action) || !method_exists($controllerInstance, $action)) {
            if (property_exists($controllerInstance, "defaultAction")) {
                $action = $controllerInstance->defaultAction;
            }
        }
    }

    function resolveControllerInstance() {
        try {
            if ($path == "/favicon.ico") return;
            
            $controllerInstance = new $controller();
        } catch (\Throwable $th) {
            redirect("home", "notFound", "page=" . $components[1]);
        }
    }

    function applyRountingExceptions() {
        // call action without rendering any HTML. This ensures that only the return value of the action is really rendered. Used for JavaScript HTTP GET calls.
        if (in_array("$controller/$action", $noHtmlCalls)) {
            $controllerInstance->{$action}();
            exit;
        }
    }
?>

<!doctype html>
<html>
    <head>
        <?php require "pages/partials/_scripts.php"; ?>
    </head>

    <body>
        <?php require "pages/partials/_topBar.php"; ?>

        <div class="content">
            <div id="content-header"></div>
                <?php $controllerInstance->{$action}(); ?>
            </div>
        </div>
        <footer></footer>
    </body>
</html>