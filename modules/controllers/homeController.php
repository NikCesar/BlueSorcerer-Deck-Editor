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

    /** @view method */
    public function index() {
        $this->homeView->renderIndex($this->homeModel);
    }

    /** @view method */
    public function notFound() {
        $this->homeView->render404();
    }

    function changeLanguage() {
        if($_SESSION["language"] === "en") {
            $_SESSION["language"] = "de";
        } else {
            $_SESSION["language"] = "en";
        }

        redirect("home");
    }
}
?>