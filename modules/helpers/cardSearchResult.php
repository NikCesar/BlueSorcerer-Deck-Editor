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
            echo "<div class=\"displayedCard\">".
                 "  <img src=\"" . getCardImgLink($card->id) . "\">".
                 "</div>";
        }

    }

    function renderWithAddLink($deck)
    {
        foreach ($this->searchResult as $card) {
            echo "<div class=\"displayedCard hover-plus\">".
                 "    <form id=\"add_<?php echo $card->id ?>\" action=\"\" method=\"POST\">".
                 "        <input type=\"text\" name=\"functionname\" value=\"addCard\" class=\"hidden\" />".
                 "        <input type=\"text\" name=\"cardId\" value=\"$card->id\" class=\"hidden\" />".
                 "        <input type=\"text\" name=\"cardName\" value=\"$card->name\" class=\"hidden\" />".
                 "        <input type=\"text\" name=\"deckId\" value=\"$deck->Id\" class=\"hidden\" />";
            if (property_exists($card, "rarity")) {
                echo "    <input type=\"text\" name=\"isLegendary\" value=\"$card->rarity\" class=\"hidden\" />";
            }
            echo "        <input type=\"submit\" value=\"+\" onclick=\"maintainScrollPos();\" class=\"add-card\" />".
                 "    </form>".
                 "    <img src=\"" . getCardImgLink($card->id) . "\">".
                 "</div>";
        }
    }


}