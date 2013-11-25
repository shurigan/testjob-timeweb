<?php

namespace Core;

use Core\Config\ConfigInterface,
    Core\Router\RouterInterface,
    Core\Response\ResponseInterface,
    Core\View\ViewInterface;

/**
 * Abstract base application class
 *
 * Class BaseApplication
 * @package Core
 */
abstract class BaseApplication {

    /** @var ConfigInterface */
    private $config;

    /** @var RouterInterface */
    private $router;

    /**
     * Constructor (KO)
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config, RouterInterface $router) {
        $this->setConfig($config);
        $this->setRouter($router);
    }

    /**
     * Set application's configuration
     * @param ConfigInterface $config
     * @return $this
     */
    public function setConfig(ConfigInterface $config) {
        $this->config = $config;
        return $this;
    }

    /**
     * Get application's configuration
     * @return ConfigInterface
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Set router
     *
     * @param RouterInterface $router
     * @return $this
     */
    public function setRouter(RouterInterface $router) {
        $this->router = $router;
        return $this;
    }

    /**
     * Get router
     * @return RouterInterface
     */
    public function getRouter() {
        return $this->router;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    abstract public function handle(RequestInterface $request);

    /**
     * Get application default response
     * @return ResponseInterface
     */
    abstract public function getResponse();

    /**
     * Set application default response
     * @return ResponseInterface
     */
    abstract public function setResponse(ResponseInterface $response);

    /**
     * Get view
     * @return ViewInterface
     */
    abstract public function getView();
}