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

    /** @JSON ONLY method */
    public function searchForCards() {
        $query = $_GET['query'];

        $foundCards = array();

        if (trim($query) == '') {
            echo json_encode($foundCards);
            return;
        }

        foreach ($this->cardModel->getCardsMap() as $card) {
            if (strpos(strtolower($card->name), strtolower($query)) !== false) {
                array_push($foundCards, $card);
            }
        }

        echo json_encode($foundCards);
    }

}
?>