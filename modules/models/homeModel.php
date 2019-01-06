<?php
class HomeModel {
    private $dbService;

    public $newestDecks;

    function __construct() {
        $this->dbService = new DbService();

        $this->newestDecks = $this->dbService->getNewestDecks();
    } 
}
?>