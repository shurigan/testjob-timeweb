<?php

namespace Core\Router;

use Core\Config\ConfigInterface;
use Debug\Debug;

class BaseRouter implements RouterInterface {

    private $params = array();

    private $controller = null;

    private $action;

    /** @var array */
    private $routes;

    /**
     * Constructor (KO)
     * @param array $routes
     */
    public function __construct($routes) {
        $this->setRoutes($routes);
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getParams() {
        return $this->params;
    }

    private function explode($route, $matches = array()) {
        $this->controller = $route["controller"];
        $this->action = isset($route["action"]) ? $route["action"] : "index";
        $this->params = isset($route["params"]) ? $route["params"] : array();

        foreach($this->params as &$param) {
            $param = preg_replace_callback('#\$(\d+)(?:\|\|(.*))?#is', function($replacement) use ($matches) {
                return isset($matches[(int)$replacement[1]]) ? $matches[(int)$replacement[1]] : $replacement[2];
            }, $param);
        }
    }

    public function parse($path) {

        foreach($this->routes as $route) {
            if( isset($route["path"]) && preg_match("#^".$route["path"]."$#is", $path, $matches) && isset($route["controller"])) {
                $this->explode($route, $matches);
            }
        }

        if(!$this->controller) {
            $this->explode($this->routes["404"]);
        }
    }

    /**
     * Get routes
     *
     * @return array
     */
    public function getRoutes() {
        return $this->routes;
    }

    /**
     * Set routes
     *
     * @param array $routes
     * @return $this
     */
    public function setRoutes($routes) {
        $this->routes = $routes;
        return $this;
    }

}