<?php

namespace Core;

/**
 * Class RequestInterface
 * @package Core
 */
interface RequestInterface {

    /**
     * Get path
     * @return string
     */
    public function getPath();

    /**
     * Get var
     * @param $varName
     * @return mixed
     */
    public function getRequestVar($varName);

} 