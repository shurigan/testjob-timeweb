<?php

use Core\BaseApplication,
    Core\RequestInterface,
    Core\Response\ResponseInterface,
    Core\Response\Response,
    Core\View\ViewInterface,
    Core\View\BaseView,
    Core\View\Engine\ViewEngineTwig,
    Core\View\Engine\ViewEngineNative;

use Core\Controller\ErrorController;


class Application extends BaseApplication {
    /** @var ResponseInterface */
    private $response;

    /** @var ViewInterface */
    private $view;

    public function handle(RequestInterface $request) {

        $this->getRouter()->parse($request->getPath());

        $controller = $this->getRouter()->getController();
        $action = $this->getRouter()->getAction();
        $params = $this->getRouter()->getParams();


        $controllerClass = $this->getConfig()->getValue("controllers." . $controller);

        if(class_exists($controllerClass)) {
            array_unshift($params, $request);
            $response = call_user_func_array(array(new $controllerClass($this), "action".ucfirst($action)), $params);
        } else {
            $errorController = new ErrorController($this);
            $response = $errorController->action404($request);
        }

        return $response;
    }


    /**
     * Get application default response
     * @return ResponseInterface
     */
    public function getResponse() {
        if(!$this->response) {
            $this->setResponse(new Response());
        }
        return $this->response;
    }

    /**
     * Set application default response
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response) {
        $this->response = $response;
    }

    /**
     * Get view
     * @return ViewInterface
     */
    public function getView() {
        if(!$this->view) {
            $this->view = new BaseView(new ViewEngineNative());
        }
        return $this->view;
    }

}