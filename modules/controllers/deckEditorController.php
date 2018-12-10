<?php
require_once "$_SERVER[DOCUMENT_ROOT]/modules/models/deckEditorModel.php";
require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/deckEditorView.php";

class DeckEditorController {

    private $cardSearchModel;
    private $deckEditorModel;
    private $deckEditorView;

    public $defaultAction = "index";

    function __construct()
    {
        $this->cardSearchModel = new CardSearchModel(); //TODO: Do not use CardSearchModel in DeckEditorController.
        $this->deckEditorModel = new DeckEditorModel();
        $this->deckEditorView = new DeckEditorView();
    }

    /** @view method */
    public function index() {
        if (isset($_GET["deckId"]))
        {
            $deck = $this->deckEditorModel->getDeck($_GET["deckId"]);
            $deckList = $this->deckEditorModel->getDeckList($deck);   
            $sideBarDeck = $this->deckEditorModel->getSideBarDeck($deck->Id);

            $this->deckEditorView->renderDeckEditor($deck, $deckList, $sideBarDeck);
        }
    }

    /** @view method */
    public function results() {
        if (isset($_GET["deckId"]))
        {
            $deck = $this->deckEditorModel->getDeck($_GET["deckId"]);
            $deckList = $this->deckEditorModel->getDeckList($deck);   
            $sideBarDeck = $this->deckEditorModel->getSideBarDeck($deck->Id);

            $cardSearchResult = $this->cardSearchModel->searchForCardsByQueries();

            $this->deckEditorView->renderDeckEditor($deck, $deckList, $sideBarDeck, $cardSearchResult);
        }
    }

    public function removeCard() {
        redirectToLoginIfNotLoggedIn();

        if(isset($_POST['cardId']) && isset($_POST["deckId"])) {

            $deckId = strip_tags($_POST["deckId"]);
            $cardId = strip_tags($_POST["cardId"]);

            $success = $this->deckEditorModel->removeCard($deckId, $cardId);

            if ($success) {
                redirect("deckEditor", "deckId={$deckId}");
            }
            else {
                redirect("deckEditor", "deckId={$deckId}&message=cardAddFail");
            }
        }
    }

    public function addCard() {
        redirectToLoginIfNotLoggedIn();

        if(isset($_POST['cardId']) && isset($_POST["deckId"])) {

            $isLegendary = false;

            if (isset($_POST['isLegendary']) && $_POST['isLegendary'] == "LEGENDARY"){
                $isLegendary = true;
            }

            $deckId = strip_tags($_POST["deckId"]);
            $cardId = strip_tags($_POST["cardId"]);

            $success = $this->deckEditorModel->addCard($deckId, $cardId, 1, $isLegendary);

            if ($success) {
                redirect("deckEditor", "deckId={$deckId}");
            }
            else {
                redirect("deckEditor", "deckId={$deckId}&message=cardAddFail");
            }
        }

        redirect("deckEditor", "deckId={$deckId}&message=cardAddFail");
    }

    public function createDeck() {
        redirectToLoginIfNotLoggedIn();

        if(isset($_POST['deckName']) && isset($_POST["deckClass"])) {
            $userId = $_SESSION["user"]->Id;
            $deckName = strip_tags($_POST["deckName"]);
            $deckDescription = isset($_POST["deckDescription"]) ? strip_tags($_POST["deckDescription"]) : null;
            $deckClass = strip_tags($_POST["deckClass"]);


            if (trim($deckName) === "" || trim($deckClass) === "") {
                redirect("decksOverview", "message=createDeckFail");
            }

            $deck = $this->deckEditorModel->addDeck($userId, $deckName, $deckDescription, $deckClass);

            redirect("deckEditor", "deckId=" . $deck->Id);
        }
        
        redirect("decksOverview", "message=createDeckFail");
    }

    function saveDeck() {
        redirectToLoginIfNotLoggedIn();

        if(isset($_GET['deckId']) && isset($_POST['deckName']) && isset($_POST["deckClass"])) {
            $userId = $_SESSION["user"]->Id;
            $deckId = strip_tags($_GET["deckId"]);
            $deckName = strip_tags($_POST["deckName"]);
            $deckDescription = isset($_POST["deckDescription"]) ? strip_tags($_POST["deckDescription"]) : null;
            $deckClass = strip_tags($_POST["deckClass"]);


            if (trim($deckName) === "" || trim($deckClass) === "") {
                redirect("deckEditor", "deckId={$deckId}&message=updateDeckFail");
            }

            $this->deckEditorModel->updateDeck($deckId, $deckName, $deckDescription, $deckClass);

            redirect("deckEditor", "deckId=" . $deckId);
        }
        
        redirect("deckEditor", "deckId={$deckId}&message=updateDeckFail");
    }

    function getJsDeck() {
        if (!isLoggedIn() || !isset($_GET["deckId"])) {
            return "[]";
        }
        
        $sidebarDeck = $this->deckEditorModel->getSidebarDeck($_GET["deckId"]);
        $jsonDeck = array();

        foreach ($sidebarDeck as $card) {
            $jsonDeck["{$card->Id}"] = $card->Count;
        }

        echo json_encode($jsonDeck);
    }
}
?>