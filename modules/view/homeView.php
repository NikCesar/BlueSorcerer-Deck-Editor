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
        setPageTitle("404 - page not found");
        
        $page = isset($_GET["page"]) ? $_GET["page"] : "";
        echo "<div  class=\"not-found\">";
        echo "  <h1>The page '$page' was not found.</h1>";
        echo "  <img src=\"http://" . $_SERVER["SERVER_NAME"] . "/assets/img/404.png\" />";
        echo "  <span class=\"name\">$page</span>";
        echo "  <span class=\"four-oh-four\">404</span>";
        echo "</div>";
    }

    
}