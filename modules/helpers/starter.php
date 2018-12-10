<?php 
class Starter {
    public $isResolved;

    public $controllerInstance;
    public $action;

    private $controller;
    private $noHtmlCalls;
    private $requestUrl;

    public function init() {
        $this->isResolved = false;

        $this->ensureSessionStartAndSetLanguage();

        $this->noHtmlCalls = array();
        $this->requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($this->requestUrl == "/favicon.ico") return;

        $this->setupRoutingExceptions();
        $this->getControllerAndActionFromRequestUrl();
        $this->resolveControllerInstance();
        $this->applyRountingExceptions();
        $this->getDefaultActionIfNoneSpecified();

        $this->isResolved = true;
    }


    private function ensureSessionStartAndSetLanguage() {
        if (!isset($_SESSION))
        {
            session_start();
        } 
        
        if (!array_key_exists("language", $_SESSION)) {
            $_SESSION["language"] = "en";
        }
    }

    private function setupRoutingExceptions() {
        array_push($this->noHtmlCalls, "DeckEditorController/getJsDeck");
    }

    private function getControllerAndActionFromRequestUrl() {
        $components = explode('/', $this->requestUrl);

        // set controller and action from path, if possible.
        if (count($components) == 2) {
            if (empty($components[1])) {
                $components[1] = "Home";
            }
            $this->controller = $components[1] . "Controller";
        } else if (count($components) == 3) {
            $this->controller = $components[1] . "Controller";
            $this->action = $components[2];
        } else {
            $this->controller = "HomeController";
            $this->action = "index";
        }
    }

    private function resolveControllerInstance() {
        try {
            $targetController = $this->controller;
            $this->controllerInstance = new $targetController();
        } catch (\Throwable $th) {
            redirect("home", "notFound", "page=" . $this->controller);
        }
    }

    function getDefaultActionIfNoneSpecified() {
        // try to get default action if none was specified.
        if (!isset($this->action) || empty($this->action) || !method_exists($this->controllerInstance, $this->action)) {
            if (property_exists($this->controllerInstance, "defaultAction")) {
                $this->action = $this->controllerInstance->defaultAction;
            }
        }
    }

    private function applyRountingExceptions() {
        // call action without rendering any HTML. This ensures that only the return value of the action is really rendered. Used for JavaScript HTTP GET calls.
        if (in_array(get_class($this->controllerInstance)."/".$this->action, $this->noHtmlCalls)) {
            $this->controllerInstance->{$this->action}();
            exit;
        }
    }
}
?>