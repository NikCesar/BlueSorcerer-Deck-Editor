<?php
class DeckEditorView {

    public function __construct()
    {
    }

    public function renderDeckEditor($deck, $deckList, $sideBarDeck) {
        echo "<section id=\"deckEditor\">";
        echo "    <h1>" . text("EditDeck") . "</h1>";

        echo "    <form id=\"editDeckForm\" action=\"/deckEditor/saveDeck&deckId=$deck->Id\" method=\"POST\">";
        echo "        <div>";
        echo "            <label>" . text("DeckName") . "</label>";
        echo "            <input type=\"text\" name=\"deckName\" value=\"$deck->Name\" />";
        echo "        </div>";
        echo "        <div>";
        echo "            <label>" . text("DeckDescription") . "</label>";
        echo "            <textarea type=\"text\" name=\"deckDescription\" form=\"editDeckForm\">$deck->Description</textarea>";
        echo "        </div>";
        echo "        <div>";
        echo "            <label>" . text("DeckClass"). "</label>";
        echo "            <select name=\"deckClass\" value=\"$deck->Class\">";
        echo "                <option value=\"\"></option>";
        echo "                <option value=\"Druid\"". $deck->Class === "Druid"?"selected=selected":"" . ">" . text("ClassDruid") . "</option>";
        echo "                <option value=\"Hunter\"". $deck->Class === "Hunter"?"selected=selected":"" . " >" . text("ClassHunter") . "</option>";
        echo "                <option value=\"Mage\"". $deck->Class === "Mage"?"selected=selected":"" . " >" . text("ClassMage") . "</option>";
        echo "                <option value=\"Paladin\"". $deck->Class === "Paladin"?"selected=selected":"" . " >" . text("ClassPaladin") . "</option>";
        echo "                <option value=\"Priest\"". $deck->Class === "Priest"?"selected=selected":"" . " >" . text("ClassPriest") . "</option>";
        echo "                <option value=\"Rogue\"". $deck->Class === "Rogue"?"selected=selected":"" . " >" . text("ClassRogue") . "</option>";
        echo "                <option value=\"Shaman\"". $deck->Class === "Shaman"?"selected=selected":"" . " >" . text("ClassShaman") . "</option>";
        echo "                <option value=\"Warlock\"". $deck->Class === "Warlock"?"selected=selected":"" . " >" . text("ClassWarlock") . "</option>";
        echo "            </select>";
        echo "        </div>";
        echo "        <input type=\"submit\" value=\"" . text("Save") . "\" /> ";           
        echo "    </form>";
        echo "</section>";

        $this->renderSideBarDeckList($deck, $sideBarDeck);

        echo "<hr/>";

        require "pages/partials/_cardSearchFilterPanel.php";

        echo "<hr/>";

        echo "<section>";
        echo "    <h3>" . text("ClickCardToAdd") . "</h3>";
        echo "</section>";

        echo "<section id=\"searchedCards\">";
        if (isset($GLOBALS['cardSearchResult']))
        {
            $GLOBALS['cardSearchResult']->renderWithAddLink($deck);
        }
        echo "</section>";
    }

    private function renderSideBarDeckList($deck, $sideBarDeck) {
        echo "<div id=\"sideBarDeckList\">";
        echo "<div class=\"load-container\"><div class=\"loader\">Loading...</div></div>";

        echo "    <section id=\"deckList\">";
        echo "        <ul>";
        foreach ($sideBarDeck as $deckEntry) {
            echo "      <li class=\"deckListElement\">";
            echo "          <label class=\"cardAmount\">" . $deckEntry->Count . "</label>";
            echo "          <label class=\"cardName\">" . $deckEntry->Name . "</label>";
            echo "          <form id=\"remove_" . $deckEntry->Id . "\" action=\"/deckEditor/removeCard\" method=\"POST\">";
            echo "              <input type=\"text\" name=\"cardId\" value=\"" . $deckEntry->Id . "\" class=\"hidden\" />";
            echo "              <input type=\"text\" name=\"deckId\" value=\"" . $deck->Id . "\" class=\"hidden\" />";
            echo "              <input type=\"submit\" value=\" - \" class=\"remove-card\" />";
            echo "          </form>";
            echo "      </li>";
        }
        echo "        </ul>";
        echo "    </section>";
        echo "</div>";
    }
}