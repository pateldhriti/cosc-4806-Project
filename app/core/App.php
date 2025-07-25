<?php

class App {
    protected $controller = 'Movie';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Debugging: Log parsed URL parts
        file_put_contents('debug_app.log', json_encode([
            'REQUEST_METHOD' => $_SERVER['REQUEST_METHOD'],
            'URL' => $url,
            'POST' => $_POST,
            'GET' => $_GET
        ]));

        // Load controller
        if (file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once 'app/controllers/' . ucfirst($this->controller) . '.php';
        $this->controller = new $this->controller;

        // Load method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Set params
        $this->params = $url ? array_values($url) : [];

        // Call controller method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl() {
        // Support both GET and POST forms with hidden `url` field
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
            return explode('/', filter_var(rtrim($_POST['url'], '/'), FILTER_SANITIZE_URL));
        }

        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return ['Movie'];
    }
}
