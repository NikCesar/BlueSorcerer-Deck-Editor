<?php
    include "modules/helpers/globals.php";

    include "modules/requestHandler.php";
    include "modules/helpers/contentRenderer.php";

    $controllerInstance = new CardSearchController();

    if (!isset($_SESSION))
    {
        session_start();
    }

    if (isset($_GET["page"])) {
        $pageId = urldecode($_GET["page"]);
    } else {
        $pageId = "home";
    }

    $path = parse_url($_SERVER['REQUEST_URI'],
        PHP_URL_PATH);
    $components = explode('/', $path);
    $controller = $components[1];
    $action = $components[2];

    $_SESSION["language"] = "en";
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
       <?php

       $controllerInstance = new $controller();
       if (isset($action)){
           $controllerInstance->{$action}();
       }
       ?>
            </div>
        </div>
        <footer></footer>
    </body>
</html>