<?php
require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/homeView.php";

class HomeController {

   public $defaultAction = "index";

    function __construct()
    {
        $this->homeView = new HomeView();
    }

    public function index() {
        $this->homeView->renderIndex();
    }

    public function notFound() {
        $this->homeView->render404();
    }
}
?>