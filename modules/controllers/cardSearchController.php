<?php
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/cardService.php"; 

    $cardService = new CardService();

    if(isset($_GET['functionname']) && $_GET['functionname'] == "searchForCards"){
        echo $cardService->searchForCards($_GET['query']);
    }
?>