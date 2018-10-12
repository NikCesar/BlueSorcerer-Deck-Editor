<?php
    include "modules/helpers/globals.php";

    include "modules/requestHandler.php";
    include "modules/helpers/contentRenderer.php";

    if (!isset($_SESSION))
    {
        session_start();
    }

    if (isset($_GET["page"])) {
        $pageId = urldecode($_GET["page"]);
    } else {
        $pageId = "home";
    }

    $_SESSION["language"] = "en";
?>

<!doctype html>
<html>
    <head>
        <?php include "pages/partials/_scripts.php"; ?>
    </head>

    <body>
        <?php include "pages/partials/_topBar.php"; ?>

       <?php renderContent($pageId); ?>

        <footer></footer>
    </body>
</html>