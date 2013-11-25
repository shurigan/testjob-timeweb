<?php

namespace Core\View;

/**
 * Interface ViewInterface
 * @package Core\View
 */
interface ViewInterface {
    /**
     * @param $path
     * @param $data
     * @return mixed
     */
    public function render($path, $data);
} 