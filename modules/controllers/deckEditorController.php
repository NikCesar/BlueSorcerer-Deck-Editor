<?php
    $dbService = new DbService();

    if (!isLoggedIn()) {
        return;
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "addCard") {
        if(isset($_POST['cardId']) && isset($_POST["deckId"])) {
        }
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "addDeck") {
        if(isset($_POST['cardId']) && isset($_POST["deckId"])) {
        }

        $dbService->addDeck($_SESSION["user"]->Id, $_POST['deckName'], $_POST['deckDescription'], $_POST['deckClass']);
    }
?>