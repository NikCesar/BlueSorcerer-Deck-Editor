<?php
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/cardService.php"; 

    $cardService = new CardService();

    if(isset($_GET['functionname']) && $_GET['functionname'] == "searchForCards"){
        echo json_encode($cardService->searchForCards($_GET['query']));
    }
?>