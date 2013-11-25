<?php

namespace Core\Controller;


use Core\BaseApplication;

class BaseController implements ControllerInterface {
    /** @var BaseApplication */
    private $application;

    /**
     * Не уверен что это надо
     * @param BaseApplication $application
     */
    public function __construct(BaseApplication $application) {
        $this->setApplication($application);
    }

    public function setApplication(BaseApplication $application) {
        $this->application = $application;
        return $this;
    }

    public function getApplication() {
        return $this->application;
    }

} 