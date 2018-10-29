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
                header("Location: http://" . $_SERVER["SERVER_NAME"] . "?page=decksOverview&message=createDeckFail");
                exit;
            }

            
            $deck = $dbService->addDeck($userId, $deckName, $deckDescription, $deckClass);

            header("Location: http://" . $_SERVER["SERVER_NAME"] . "?page=deckEditor&deckId=" . $deck->Id);
            exit;
        }
        
        header("Location: http://" . $_SERVER["SERVER_NAME"] . "?page=decksOverview&message=createDeckFail");
        exit;
    }
?>