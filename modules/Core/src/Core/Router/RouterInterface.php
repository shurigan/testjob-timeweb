<?php

namespace Core\Router;

use Core\Config\ConfigInterface;

/**
 * Interface RouterInterface
 * @package Core\Router
 */
interface RouterInterface {

    /**
     * Get controller by path
     * @return mixed
     */
    public function getController();

    public function getAction();

    public function getParams();

    public function parse($path);
}