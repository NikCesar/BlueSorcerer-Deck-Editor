<?php
    include "modules/helpers/globals.php";

    include "modules/requestHandler.php";
    include "modules/helpers/contentRenderer.php";

    if (!isset($_SESSION))
    {
        session_start();

        $_SESSION["language"] = "en";
    } else if (!array_key_exists("language", $_SESSION)) {
        $_SESSION["language"] = "en";
    }

    // redirect to controller and action.
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $components = explode('/', $path);

    if ($path == "/favicon.ico") return;

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

    try {
        $controllerInstance = new $controller();
    } catch (\Throwable $th) {
        redirect("home", "notFound", "page=" . $components[1]);
    }

    if (!isset($action) || empty($action) || !method_exists($controllerInstance, $action)) {
        if (property_exists($controllerInstance, "defaultAction")) {
            $action = $controllerInstance->defaultAction;
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