<?php
class HomeView {

    public function __construct()
    {
    }

    public function renderIndex($model) {
        echo '<section id="newestDecks">';
        echo '  <h2>' . text("NewestDecks") . '</h2>';
        echo '  <input type="text" onkeyup="searchForCards(this.value);" />';
        foreach($model->newestDecks as $index=>$deck) {
            echo '<div class="deck-listing">';
            echo '  <h3>' . $deck->name . '</h3>';
            echo '  <div class="description">' . $deck->description . '</div>';
            echo '  <div class="class">' . $deck->class . '</div>';
            echo '  <div class="score">' . $deck->score . '</div>';
            echo '</div>';
        }
        echo '</section>';

        echo '<section id="topDecks">';
        echo '  <h2>' . text("TopDecks") . '</h2>';
        foreach($model->topDecks as $index=>$deck) {
            echo '<div class="deck-listing">';
            echo '  <h3>' . $deck->name . '</h3>';
            echo '  <div class="description">' . $deck->description . '</div>';
            echo '  <div class="class">' . $deck->class . '</div>';
            echo '  <div class="score">' . $deck->score . '</div>';
            echo '</div>';
        }    
        echo '</section>';
    }

    function render404()
    {
        $page = isset($_GET["page"]) ? $_GET["page"] : "";
        echo "<p>The page '{$page}' was not found.</p>";
    }

    
}