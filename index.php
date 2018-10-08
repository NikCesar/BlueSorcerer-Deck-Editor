<?php
    include "modules/requestHandler.php";
    include "modules/helpers/contentRenderer.php";

    $pageId = urldecode($_GET["page"]);
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