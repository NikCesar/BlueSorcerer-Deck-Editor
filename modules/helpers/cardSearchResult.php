<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nik
 * Date: 12.11.2018
 * Time: 19:30
 */

class CardSearchResult {

    private $searchResult;

    function __construct($searchArray)
    {
        $this->searchResult = $searchArray;

    }

    function render()
    {
        foreach ($this->searchResult as $card) {
            echo "<div class=\"displayedCard\">";
            echo "  <img src=\"" . getCardImgLink($card->id) . "\">";
            echo "</div>";
        }

    }

}