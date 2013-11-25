<?php

namespace Core\Response;

/**
 * Simple Response
 *
 * Class Response
 * @package Core
 */
class Response implements ResponseInterface {

    /** @var string */
    private $body;

    /** @var array  */
    private $headers = array();

    /**
     * Set body content
     * @param string $content
     * @return ResponseInterface
     */
    public function setBody($content) {
        $this->body = $content;
        return $this;
    }

    /**
     * Get body content
     * @return string
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Send response to client
     */
    public function send() {
        $this->sendHeaders();
        echo $this->getBody();
    }

    public function addHeader($header) {
        $this->headers[] = $header;
    }

    public function sendHeaders() {
        foreach($this->headers as $header) {
            header($header, true);
        }
    }
} 