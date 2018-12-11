<?php
class HomeModel {
    public $newestDecks;
    public $topDecks;

    function __construct() {
        $this->newestDecks = array(
            (object) array("name" => "Temp burn aggro damage deck",
                  "description" => "My new super aggressive top tier deck! Check it out.",
                  "class" => "Hunter",
                  "score" => 92),
            (object)  array("name" => "Rakdos Burn",
                  "description" => "I got gud, now look at my deck!",
                  "class" => "Mage",
                  "score" => -1),
        );
    
        $this->topDecks = $this->newestDecks;
    } 
}
?>