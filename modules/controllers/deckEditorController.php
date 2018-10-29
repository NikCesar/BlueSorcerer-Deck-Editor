<?php
    $dbService = new DbService();

    if (!isLoggedIn()) {
        return;
    }

    if(isset($_POST['functionname']) && $_POST['functionname'] == "addCard") {
        if(isset($_POST['cardId']) && isset($_POST["deckId"])) {
        }
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
?>