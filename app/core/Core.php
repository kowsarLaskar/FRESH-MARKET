<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core {
    protected $currentController = 'Pages'; // Default Controller
    protected $currentMethod = 'index';     // Default Method
    protected $params = [];

    public function __construct(){
        // 1. Get the URL
        $url = $this->getUrl();

        // 2. Look in controllers for first value (e.g., 'Shop')
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // If exists, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }

        // 3. Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // 4. Instantiate controller class (e.g., $pages = new Pages())
        $this->currentController = new $this->currentController;

        // 5. Check for second part of url (The Method, e.g., 'cart')
        if(isset($url[1])){
            // Check to see if method exists in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // 6. Get params
        $this->params = $url ? array_values($url) : [];

        // 7. Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        // If no URL, return default controller
        return ['Pages'];
    }
}