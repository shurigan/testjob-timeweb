<?php

namespace Core;
use Debug\Debug;

/**
 * Class Request
 * @package Core
 */
class Request implements RequestInterface {

    /** @var string */
    private $path;


    public function __construct() {
        $this->path = isset($_SERVER["REDIRECT_URL"]) ? $_SERVER["REDIRECT_URL"] : $_SERVER["REQUEST_URI"];
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Get var
     * @param $varName
     * @return mixed
     */
    public function getRequestVar($varName)
    {
        return isset($_REQUEST[$varName]) ? $_REQUEST[$varName] : null;
    }


} 