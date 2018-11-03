<?php
    include_once "$_SERVER[DOCUMENT_ROOT]/modules/helpers/globals.php";

    $dbService = new DbService();

    if (!isLoggedIn()) {
        return;
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "removeCard") {
        if(isset($_POST['cardId']) && isset($_POST["deckId"])) {

            $deckId = strip_tags($_POST["deckId"]);
            $cardId = strip_tags($_POST["cardId"]);

            $success = $dbService->removeCard($deckId, $cardId);

            if ($success) {
                redirect("deckEditor", "deckId={$deckId}");
            }
            else {
                redirect("deckEditor", "deckId={$deckId}&message=cardAddFail");
            }
        }
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "addCard") {
        if(isset($_POST['cardId']) && isset($_POST["deckId"])) {
            
            $deckId = strip_tags($_POST["deckId"]);
            $cardId = strip_tags($_POST["cardId"]);

            $success = $dbService->addCard($deckId, $cardId, 1);

            if ($success) {
                redirect("deckEditor", "deckId={$deckId}");
            }
            else {
                redirect("deckEditor", "deckId={$deckId}&message=cardAddFail");
            }
        }

        redirect("deckEditor", "deckId={$deckId}&message=cardAddFail");
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "createDeck") {
        if(isset($_POST['deckName']) && isset($_POST["deckClass"])) {
            $userId = $_SESSION["user"]->Id;
            $deckName = strip_tags($_POST["deckName"]);
            $deckDescription = isset($_POST["deckDescription"]) ? strip_tags($_POST["deckDescription"]) : null;
            $deckClass = strip_tags($_POST["deckClass"]);


            if (trim($deckName) === "" || trim($deckClass) === "") {
                redirect("decksOverview", "message=createDeckFail");
            }

            
            $deck = $dbService->addDeck($userId, $deckName, $deckDescription, $deckClass);

            redirect("deckEditor", "deckId=" . $deck->Id);
        }
        
        redirect("decksOverview", "message=createDeckFail");
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "saveDeck") {
        if(isset($_GET['deckId']) && isset($_POST['deckName']) && isset($_POST["deckClass"])) {
            $userId = $_SESSION["user"]->Id;
            $deckId = strip_tags($_GET["deckId"]);
            $deckName = strip_tags($_POST["deckName"]);
            $deckDescription = isset($_POST["deckDescription"]) ? strip_tags($_POST["deckDescription"]) : null;
            $deckClass = strip_tags($_POST["deckClass"]);


            if (trim($deckName) === "" || trim($deckClass) === "") {
                redirect("deckEditor", "deckId={$deckId}&message=updateDeckFail");
            }

            
            $dbService->updateDeck($deckId, $deckName, $deckDescription, $deckClass);

            redirect("deckEditor", "deckId=" . $deckId);
        }
        
        redirect("deckEditor", "deckId={$deckId}&message=updateDeckFail");
    }
?>