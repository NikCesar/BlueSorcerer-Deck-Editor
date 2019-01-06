<?php
    @session_start();

    require_once "$_SERVER[DOCUMENT_ROOT]/modules/helpers/globals.php";

    require_once "$_SERVER[DOCUMENT_ROOT]/modules/services/dbService.php";  
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/services/cardService.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/services/deckService.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/services/mailService.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/services/roleService.php";
    
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/controllers/cardSearchController.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/controllers/loginController.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/controllers/homeController.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/controllers/userProfileController.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/controllers/deckEditorController.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/controllers/decksOverviewController.php";
    require_once "$_SERVER[DOCUMENT_ROOT]/modules/controllers/adminController.php";
?>