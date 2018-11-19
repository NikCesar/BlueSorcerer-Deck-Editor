<?php
    @session_start();

    require "$_SERVER[DOCUMENT_ROOT]/modules/services/dbService.php";  
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/cardService.php";
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/deckService.php";
    require "$_SERVER[DOCUMENT_ROOT]/modules/helpers/cardSearchResult.php";
    
    include "controllers/cardSearchController.php";
    include "controllers/loginController.php";
    include "controllers/userProfileController.php";
    include "controllers/deckEditorController.php";
?>