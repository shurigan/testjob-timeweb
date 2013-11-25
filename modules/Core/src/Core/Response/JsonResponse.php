<?php

namespace Core\Response;

/**
 * JSON Response
 *
 * Class JsonResponse
 * @package Core\Response
 */
class JsonResponse extends Response {
    /** @var array */
    private $data;

    /**
     * Constructor (KO)
     */
    public function __construct() {
        $this->addHeader("Content-type: application/json; charset: utf-8");
        $this->data = array();
    }

    /**
     * Set data
     *
     * @param array $data
     * @return ResponseInterface
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Send JSON Data
     */
    public function send() {
        $this->sendHeaders();

        $data = $this->getData();
        $data["_body_"] = $this->getBody();

        echo json_encode($data);
    }
}