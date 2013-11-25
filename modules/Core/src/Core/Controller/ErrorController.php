<?php

namespace Core\Controller;

use Core\RequestInterface;

class ErrorController extends BaseController {

    public function action404(RequestInterface $request) {
        return $this->getApplication()->getResponse()->setBody("ERROR (" . $request->getPath() . ")");
    }
} 