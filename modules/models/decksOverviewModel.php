<?php
class DecksOverviewModel {
    function __construct() {
        $this->dbService = new DbService();
    }

    public function getDecksByUserId($userId) {
        return $this->dbService->getDecksByUserId($userId);
    }
}
?>