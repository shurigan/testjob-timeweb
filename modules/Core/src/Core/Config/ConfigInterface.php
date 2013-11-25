<?php

namespace Core\Config;

/**
 * Interface ConfigInterface
 * @package Core\Config
 */
interface ConfigInterface {

    /**
     * Get value by key
     *
     * @param string $key
     * @return mixed
     */
    public function getValue($key);

    /**
     * Set value by key
     *
     * @param string $key
     * @param mixed $value
     * @return ConfigInterface
     */
    public function setValue($key, $value);
} 