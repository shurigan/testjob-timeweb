<?php

namespace Core\View\Engine;

/**
 * Interface ViewEngineInterface
 * @package Core\View\Engine
 */
interface ViewEngineInterface {
    /**
     * Render
     * @param array $data
     * @return mixed
     */
    public function render($data);

    /**
     * Set template path
     *
     * TODO Не уверен в необходимости
     * @param $path
     * @return mixed
     */
    public function setPath($path);
} 