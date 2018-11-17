<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nik
 * Date: 12.11.2018
 * Time: 19:30
 */

class CardSearchResult
{

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

    function renderWithAddLink($deck)
    {
        foreach ($this->searchResult as $card) {
            echo "<div class=\"displayedCard hover-plus\">";
            echo "    <form id=\"add_<?php echo $card->id ?>\" action=\"\" method=\"POST\">";
            echo "        <input type=\"text\" name=\"functionname\" value=\"addCard\" class=\"hidden\" />";
            echo "        <input type=\"text\" name=\"cardId\" value=\"$card->id\" class=\"hidden\" />";
            echo "        <input type=\"text\" name=\"deckId\" value=\"$deck->Id\" class=\"hidden\" />";
            echo "        <input type=\"submit\" value=\"+\" onclick=\"maintainScrollPos();\" class=\"add-card\" />";
            echo "    </form>";
            echo "    <img src=\"" . getCardImgLink($card->id) . "\">";
            echo "</div>";
        }
    }


}