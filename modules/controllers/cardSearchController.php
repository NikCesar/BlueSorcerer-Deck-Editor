<?php
    require "$_SERVER[DOCUMENT_ROOT]/modules/services/cardService.php";

    $cardService = new CardService();

    if(isset($_GET['functionname']) && $_GET['functionname'] == "searchForCards"){
        $query = $_GET['query'];
        echo json_encode($cardService->searchForCards($query));
    }
?>