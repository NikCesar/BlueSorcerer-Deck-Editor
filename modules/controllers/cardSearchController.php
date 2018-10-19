<?php
    $cardService = new CardService();

    if(isset($_GET['functionname']) && $_GET['functionname'] == "searchForCards"){
        $query = $_GET['query'];
        echo json_encode($cardService->searchForCards($query));
    }
//    if (isset($_GET['functionname']) && $_GET['functionname'] == "searchForCardsByQueries"){
//        $queries = $_GET['queries'];
//        echo json_encode($cardService->searchForCardsByQueries($queries));
//    }
    if (isset($_POST['functionname']) && $_POST['functionname'] == "searchForCardsByQueries") {
        $queries = array();
        if (isset($_POST['cardName']) && $_POST['cardName'] !== "") {
            $queries['name'] = strip_tags($_POST['cardName']);
        }
        if (isset($_POST['cardText']) && $_POST['cardText'] !== "") {
            $queries['text'] = strip_tags($_POST['cardText']);
        }
        if (isset($_POST['cardCost']) && $_POST['cardCost'] !== "") {
            $queries['cost'] = strip_tags($_POST['cardCost']);
        }
        if (isset($_POST['cardAttack']) && $_POST['cardAttack'] !== "") {
            $queries['attack'] = strip_tags($_POST['cardAttack']);
        }
        if (isset($_POST['cardHealth']) && $_POST['cardHealth'] !== "") {
            $queries['health'] = strip_tags($_POST['cardHealth']);
        }
        if (isset($_POST['classSelect']) && $_POST['classSelect'] !== "") {
            $queries['cardClass'] = strip_tags($_POST['classSelect']);
        }
        if (isset($_POST['typeSelect']) && $_POST['typeSelect'] !== "") {
            $queries['type'] = strip_tags($_POST['typeSelect']);
        }
        if (isset($_POST['raceSelect']) && $_POST['raceSelect'] !== "") {
            $queries['race'] = strip_tags($_POST['raceSelect']);
        }
        if (isset($_POST['setSelect']) && $_POST['setSelect'] !== "") {
            $queries['set'] = strip_tags($_POST['setSelect']);
        }
        $queries['collectible'] = true;
        $_SESSION["searchResult"] = $cardService->searchForCardsByQueries($queries);
    }
?>