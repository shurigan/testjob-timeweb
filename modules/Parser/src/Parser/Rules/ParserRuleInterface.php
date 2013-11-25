<?php

namespace Parser\Rules;

/**
 * Interface ParserRuleInterface
 * @package Parser\Rules
 */
interface ParserRuleInterface {
    /**
     * Process rule
     *
     * @param string $text
     * @return array mixed
     */
    public function process($text);
} 