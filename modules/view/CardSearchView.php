<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nik
 * Date: 26.11.2018
 * Time: 18:47
 */
class CardSearchView {

    public function __construct()
    {
    }

    public function renderFilterPanel() {
        include("$_SERVER[DOCUMENT_ROOT]/pages/partials/_cardSearchFilterPanel.php");
    }

    function renderWithoutAddLink($cardSearchResult)
    {
        include("$_SERVER[DOCUMENT_ROOT]/pages/partials/_cardSearchFilterPanel.php");

        echo "<section id=\"searchedCards\">";
        foreach ($cardSearchResult as $card) {
            echo "<div class=\"displayedCard\">".
                     "    <img src=\"" . getCardImgLink($card->id) . "\">".
                 "</div>";
        }
        echo "</section>";
    }

    function renderWithAddLink($cardSearchResult ,$deck)
    {
        include("$_SERVER[DOCUMENT_ROOT]/pages/partials/_cardSearchFilterPanel.php");
        echo "<section id=\"searchedCards\">";
        foreach ($cardSearchResult as $card) {
            echo "<div class=\"displayedCard hover-plus\">".
                "    <form id=\"add_$card->id\" action=\"\" method=\"POST\">".
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
        echo "</section>";
    }


}