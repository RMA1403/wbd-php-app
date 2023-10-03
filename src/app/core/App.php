<?php

class App {

    protected $controller;
    protected $method = "index.php";
    protected $params;

    public function __construct()
    {
        $url = $this->parseURL();

        // Dtermine Controllers
        require_once __DIR__.'/../controllers/NotFound.php';
        $this->controller=new NotFound();
        var_dump($url);
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // Determine method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1]));
        }
        
        if(!empty($url)) {
            $this-->
        }

        require_once '../app/controllers' . $this->controller . '.php';
        $this->controller = new $this->controller;


        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if ( isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}