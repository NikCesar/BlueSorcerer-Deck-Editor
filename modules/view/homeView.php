<?php
class HomeView {

    public function __construct()
    {
    }

    public function renderIndex() {
        echo "<p>Good day sir</p>";
    }

    function render404()
    {
        $page = isset($_GET["page"]) ? $_GET["page"] : "";
        echo "<p>The page '{$page}' was not found.</p>";
    }
}