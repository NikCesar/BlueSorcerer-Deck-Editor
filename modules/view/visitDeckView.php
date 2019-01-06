<?php
/**
 * Created by IntelliJ IDEA.
 * User: Nik
 * Date: 06.01.2019
 * Time: 15:48
 */

class VisitDeckView
{

    public function __construct()
    {
    }

    public function renderVisitedDeck($visitedDeck, $visitedDeckCards) {
        echo "<section id=\"visitedDeck\">";

        echo "    <div class=\"visitedDeckInformation\">";
        echo "        <h3>" . $visitedDeck->Name . "</h3>";
        echo "        <div class=\"description\">" . $visitedDeck->Description . "</div>";
        echo "        <div class=\"class\">" . $visitedDeck->Class . "</div>";
        echo "    </div>";

        echo "<hr/>";

        echo "    <section id=\"visitedDeckContent\">";
        foreach ($visitedDeckCards as $deckCard) {
                echo "<div class=\"displayedCard\">".
                    "    <img src=\"" . getCardImgLink($deckCard->CardId) . "\">".
                    "<p class=\"cardCount\">" . "x" . $deckCard->Count . "</p>" .
                    "</div>";
        }
        echo "    </section>";

        echo "</section>";
    }
}