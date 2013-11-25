<?php

namespace Core\View\Engine;


class ViewEngineNative implements ViewEngineInterface {
    /** @var string */
    private $path;

    /**
     * @param string $path
     * @return ViewEngineTemplate
     */
    public function setPath($path) {
        $this->path = $path . ".tpl.php";
        return $this;
    }

    /**
     * Render
     *
     * TODO Сделать проверку на существование пути
     * @param array $data
     * @return mixed|void
     */
    public function render($data) {
        ob_start();

        extract($data);

        include $this->path;

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }
} 