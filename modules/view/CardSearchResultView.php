<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nik
 * Date: 26.11.2018
 * Time: 18:47
 */
class CardSearchResultView {

    private $cardSearchResult;

    public function __construct($searchResult)
    {
        $this->cardSearchResult = $searchResult;
    }

    function render()
    {
        foreach ($this->cardSearchResult as $card) {
            echo "<div class=\"displayedCard\">".
                "  <img src=\"" . getCardImgLink($card->id) . "\">".
                "</div>";
        }

    }

}