<?php

namespace Debug;
use Core\View\BaseView;
use Core\View\Engine\ViewEngineTwig;

/**
 * Class Debug
 * @package Debug
 */
abstract class Debug {
    /** @var bool */
    private static $enabled = false;

    /** @var array */
    private static $messages = array();

    /**
     * Eneble or disable debugging
     *
     * @param bool $enable
     */
    public static function enable($enable = true) {
        self::$enabled = $enable;

        if($enable) {
            register_shutdown_function(function() {
                Debug::show();
            });
        }
    }

    /**
     * Show debug info
     */
    public static function show() {
        if(self::$enabled) {
            $view = new BaseView(new ViewEngineTwig(array('debug' => true)));
            $content = $view->render("debug/messages", array("messages" => self::$messages));
            echo $content;
        }
    }

    /**
     * Dump variables
     */
    public static function dump() {
        $args = func_get_args();
        foreach($args as $variable) {
            array_push(self::$messages, $variable);
        }
    }

    private function __construct() {}
    private function __clone() {}
}