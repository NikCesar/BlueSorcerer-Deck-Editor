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
}