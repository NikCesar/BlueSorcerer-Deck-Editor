<?php

require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/CardSearchView.php";
require_once "$_SERVER[DOCUMENT_ROOT]/modules/models/cardSearchModel.php";

class CardSearchController {

    private $cardModel;
    private $cardSearchView;

    public $defaultAction = "results";

    function __construct()
    {
        $this->cardModel = new CardSearchModel();
        $this->cardSearchView = new CardSearchView();
    }

    /** @view method */
    public function index() {
        $this->cardSearchView->renderFilterPanel();
    }

    /** @view method */
    public function results() {
        $cardSearchResult = $this->cardModel->searchForCardsByQueries();
        $this->cardSearchView->renderWithoutAddLink($cardSearchResult);
    }
}
?>