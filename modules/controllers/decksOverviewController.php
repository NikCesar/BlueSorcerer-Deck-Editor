<?php

require_once "$_SERVER[DOCUMENT_ROOT]/modules/models/decksOverviewModel.php";
require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/decksOverviewView.php";

class DecksOverviewController {

    private $decksOverviewModel;
    private $ecksOverviewView;

    public $defaultAction = "index";

    function __construct()
    {
        $this->decksOverviewModel = new DecksOverviewModel();
        $this->decksOverviewView = new DecksOverviewView();
    }

    /** @view method */
    public function index() {
        redirectToLoginIfNotLoggedIn("decksOverview");
    
        $decks = $this->decksOverviewModel->getDecksByUserId($_SESSION["user"]->Id);
        $this->decksOverviewView->renderDecksOverview($decks);
    }
}
?>