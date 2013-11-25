<?php

namespace Core\Response;

/**
 * Interface ResponseInterface
 * @package Core
 */
interface ResponseInterface {

    /**
     * @return string
     */
    public function getBody();

    /**
     * @param string $content
     * @return ResponseInterface
     */
    public function setBody($content);

    /**
     * @param string $header
     * @return ResponseInterface
     */
    public function addHeader($header);

} 