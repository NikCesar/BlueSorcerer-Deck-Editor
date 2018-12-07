<?php
require_once "$_SERVER[DOCUMENT_ROOT]/modules/view/homeView.php";
require_once "$_SERVER[DOCUMENT_ROOT]/modules/models/homeModel.php";

class HomeController {

   public $defaultAction = "index";

    function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->homeView = new HomeView();
    }

    public function index() {
        $this->homeView->renderIndex($this->homeModel);
    }

    public function notFound() {
        $this->homeView->render404();
    }
}
?>