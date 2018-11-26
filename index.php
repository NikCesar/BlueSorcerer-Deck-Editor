<?php
    include "modules/helpers/globals.php";

    include "modules/requestHandler.php";
    include "modules/helpers/contentRenderer.php";

    $cardSearchController = new CardSearchController();

    if (!isset($_SESSION))
    {
        session_start();
    }

    if (isset($_GET["page"])) {
        $pageId = urldecode($_GET["page"]);
    } else {
        $pageId = "home";
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] === "searchForCardsByQueries") {
            $cardSearchController->searchForCardsByQueries();
        }
    }

    $_SESSION["language"] = "en";
?>

<!doctype html>
<html>
    <head>
        <?php require "pages/partials/_scripts.php"; ?>
    </head>

    <body>
        <?php require "pages/partials/_topBar.php"; ?>

       <?php renderContent($pageId); ?>

        <footer></footer>
    </body>
</html>