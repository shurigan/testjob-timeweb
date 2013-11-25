<?php

namespace Core\View\Engine;

/**
 * Class ViewEngineTwig
 * @package Core\View\Engine
 */
class ViewEngineTwig implements ViewEngineInterface {
    /** @var string */
    private $path;

    /** @var Twig_Environment */
    private $twigEngine;

    /** @var array */
    private $envParams;

    /**
     * Constructor (KO)
     * @param array $environment
     */
    public function __construct($environment = array()) {
        $this->environment = $environment;
        $this->twigEngine = new \Twig_Environment(null, $environment);
        $this->twigEngine->addExtension(new \Twig_Extension_Debug());
    }

    /**
     * Set path to template
     *
     * @param string $path
     */
    public function setPath($path) {
        $this->path = $path  . ".html";
        $this->twigEngine->setLoader(new \Twig_Loader_Filesystem(dirname($this->path)));
    }


    /**
     * Render template
     *
     * @param array $data
     * @return mixed|string
     */
    public function render($data) {
        return $this->twigEngine->render(basename($this->path), $data);
    }
} 