<?php
class HomeModel {
    private $dbService;

    public $newestDecks;

    function __construct() {
        $this->dbService = new DbService();

        $this->newestDecks = $this->dbService->getNewestPublishedDecks();
        foreach($this->newestDecks as $key=>$deck) {
            $formatedDate = date_create_from_format("Y-m-d H:i:s", $deck->PublishDate);
            $this->newestDecks[$key]->PublishDate = date_format($formatedDate, "d-m-Y H:i:s");
        }
    } 
}
?>