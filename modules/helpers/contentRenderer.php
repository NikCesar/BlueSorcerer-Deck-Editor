<?php
    include "fileHelper.php";

    function renderContent($pageId) {
        $view = searchFile("./pages", $pageId . ".php");

        if ($view !== null)
        {
            include_once $view;
        }   
    }
?>
