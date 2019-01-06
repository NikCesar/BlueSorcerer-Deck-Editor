<?php
    @session_start();

    require "$_SERVER[DOCUMENT_ROOT]/modules/services/dbService.php";  
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/cardService.php";
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/deckService.php";
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/roleService.php";
    
    include "controllers/cardSearchController.php";
    include "controllers/loginController.php";
    include "controllers/homeController.php";
    include "controllers/userProfileController.php";
    include "controllers/deckEditorController.php";
    include "controllers/decksOverviewController.php";
    include "controllers/adminController.php";
?>