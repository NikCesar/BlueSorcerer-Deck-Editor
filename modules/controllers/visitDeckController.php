<?php
require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/visitDeckView.php";
require_once "$_SERVER[DOCUMENT_ROOT]/modules/models/visitDeckModel.php";

class VisitDeckController
{
    private $visitDeckView;
    private $visitDeckModel;

    public $defaultAction = "index";

    function __construct()
    {
        $this->visitDeckModel = new VisitDeckModel();
        $this->visitDeckView = new VisitDeckView();
    }

    /** @view method */
    public function index() {
        redirectToLoginIfNotLoggedIn("decksOverview");

        $deckId = 0;
        if (isset($_GET['deckId'])) {
            $deckId = strip_tags($_GET['deckId']);
        }

        if ($deckId === 0) {
            return;
        }

        $visitedDeck = $this->visitDeckModel->getVisitedDeckById($deckId);
        $visitedDeckCards = $this->visitDeckModel->getVisitedDeckCardsByDeckId($deckId);
        $this->visitDeckView->renderVisitedDeck($visitedDeck, $visitedDeckCards);
    }

}