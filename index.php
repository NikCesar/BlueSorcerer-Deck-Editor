<?php
    require_once "modules/helpers/globals.php";
    require_once "modules/helpers/starter.php";

    require_once "modules/requestHandler.php";

    $starter = new Starter();
    $starter->init();
?>

<!doctype html>
<html>
    <head>
        <meta content="initial-scale=1.0" name="viewport">
        <?php require "pages/partials/_scripts.php"; ?>
    </head>

    <body>
        <?php require "pages/partials/_topBar.php"; ?>

        <div class="content">
            <div id="content-header"></div>
                <?php 
                    if ($starter->isResolved) {
                        $starter->controllerInstance->{$starter->action}();
                    }
                ?>
            </div>
        </div>
        <footer></footer>
    </body>
</html>