<?php

namespace Core\Config;
use Debug\Debug;

/**
 * PHP Array implementation of config
 *
 * Class ConfigArray
 * @package Core\Config
 */
class ConfigArray implements ConfigInterface {
    /** @var array */
    private $container = array();

    /**
     * Build new config and read values from file
     * @param $filePath
     */
    public function __construct($filePath) {
        if(file_exists($filePath)) {
            $this->container = require $filePath;
        }
    }

    /**
     * Get value by key
     *
     * @param string $key
     * @return mixed
     */
    public function getValue($key)
    {
        $keysChain = explode(".", $key);

        $node = $this->container;

        foreach( $keysChain as $part ) {
            if(isset($node[$part])) {
                $node = $node[$part];
            } else {
                return null;
            }
        }

        return $node;
    }

    /**
     * Set value by key
     *
     * @param string $key
     * @param mixed $value
     * @return ConfigInterface
     */
    public function setValue($key, $value)
    {
        $keysChain = explode(".", $key);

        $node =& $this->container;

        foreach( $keysChain as $part ) {
            $node =& $node[$part];
        }

        $node = $value;

        return $this;
    }

} 