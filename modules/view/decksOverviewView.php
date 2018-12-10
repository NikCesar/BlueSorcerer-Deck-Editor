<?php
class DecksOverviewView {

    public function __construct()
    {
    }

    public function renderDecksOverview($decks) {
        echo "<section id=\"decksOverview\">";
        echo "<h1>" . text("MyDecks") . "</h1>";

        foreach($decks as $index=>$deck)
        {
            echo "<div class=\"deck-listing\">";
            echo "<h3>" . $deck->Name . "</h3>";
            echo "<div class=\"description\">" . $deck->Description . "</div>";
            echo "<div class=\"class\">" . $deck->Class . "</div>";
            echo "    <form id=\"editDeck_" . $deck->Id . "\" action=\"\" method=\"GET\">";
            echo "        <input type=\"text\" name=\"page\" value=\"deckEditor\" class=\"hidden\" />";
            echo "        <input type=\"text\" name=\"deckId\" value=\"" . $deck->Id . "\" class=\"hidden\" />";
            echo "        <input type=\"submit\" value=\"" . text("Edit") . "\" />";
            echo "     </form>";
            echo "</div>";
        }
        echo "</section>";

        echo "<hr/>";

        echo "<section id=\"createDeck\">";
        echo "  <h1>" . text("CreateDeck") . "</h1>";

        echo "  <form id=\"createDeckForm\" action=\"\" method=\"POST\">";
        echo "      <input type=\"text\" name=\"functionname\" value=\"createDeck\" class=\"hidden\">";
        echo "      <div>";
        echo "          <label>" . text("DeckName") . "</label>";
        echo "          <input type=\"text\" name=\"deckName\" />";
        echo "      </div>";
        echo "      <div>";
        echo "          <label>" . text("DeckDescription") . "</label>";
        echo "          <textarea type=\"text\" name=\"deckDescription\" form=\"editDeckForm\"></textarea>";
        echo "      </div>";
        echo "      <div>";
        echo "          <label>" . text("DeckClass") . "</label>";
        echo "          <select name=\"deckClass\">";
        echo "              <option value=\"\"></option>";
        echo "              <option value=\"Druid\">" . text("ClassDruid") . "</option>";
        echo "              <option value=\"Hunter\">" . text("ClassHunter") . "</option>";
        echo "              <option value=\"Mage\">" . text("ClassMage") . "</option>";
        echo "              <option value=\"Paladin\">" . text("ClassPaladin") . "</option>";
        echo "              <option value=\"Priest\">" . text("ClassPriest") . "</option>";
        echo "              <option value=\"Rogue\">" . text("ClassRogue") . "</option>";
        echo "              <option value=\"Shaman\">" . text("ClassShaman") . "</option>";
        echo "              <option value=\"Warlock\">" . text("ClassWarlock") . "</option>";
        echo "          </select>";
        echo "      </div>";

        validationMessageFor("createDeckFail");

        echo "      <input type=\"submit\" value=\"" . text("Create") . "\" />";          
        echo "  </form>";
        echo "</section>";
    }  
}