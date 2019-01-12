<?php
class HomeView {

    public function __construct()
    {
    }

    public function renderIndex($model) {
        validationMessageFor("passwordForgotSentSuccess");
        
        echo '<section id="newestDecks">';
        echo '  <h2>' . text("NewestDecks") . '</h2>';
        foreach($model->newestDecks as $index=>$deck) {
            echo '<div class="deck-listing '.$deck->Class.'">';
            echo '  <h3>' . $deck->Name . '</h3>';
            echo '  <div class="description">' . $deck->Description . '</div>';
            echo '  <div class="class">' . text("Class" . $deck->Class) . '</div>';
            echo '  <div class="publishDate">' . $deck->PublishDate . '</div>';
            echo "    <form id=\"viewDeck" . $deck->Id . "\" action=\"/visitDeck\" method=\"GET\">";
            echo "        <input type=\"text\" name=\"deckId\" value=\"" . $deck->Id . "\" class=\"hidden\" />";
            echo "        <input type=\"submit\" value=\"" . text("VisitDeck") . "\" />";
            echo "     </form>";
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