<?php

namespace Core\View;

use Core\View\Engine\ViewEngineInterface;

class BaseView implements ViewInterface {
    /** @var ViewEngineInterface */
    private $viewEngine;


    public function __construct(ViewEngineInterface $engine) {
        $this->setViewEngine($engine);
    }

    /**
     * Set view engine
     *
     * @param ViewEngineInterface $engine
     * @return $this
     */
    public function setViewEngine(ViewEngineInterface $engine) {
        $this->viewEngine = $engine;
        return $this;
    }

    /**
     * Get view engine
     *
     * @return ViewEngineInterface
     */
    public function getViewEngine() {
        return $this->viewEngine;
    }


    /**
     * Render view
     *
     * @param $path
     * @param $data
     * @return mixed
     */
    public function render($path, $data) {
        // TODO невероятно неправильная строка
        $path = $_SERVER["DOCUMENT_ROOT"] . "/../view/" . trim($path,"/");

        $this->viewEngine->setPath($path);
        return $this->viewEngine->render($data);
    }

} 