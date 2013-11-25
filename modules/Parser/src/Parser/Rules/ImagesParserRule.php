<?php

namespace Parser\Rules;
use Debug\Debug;

/**
 * Class ImagesParserRule
 * @package Parser\Rules
 */
class ImagesParserRule implements ParserRuleInterface {

    /**
     * Process rule
     *
     * @param string $text
     * @return array
     */
    public function process($text) {
        $results = array();

        if(preg_match_all("/<img[^>]+src=['\"](.+?)['\"][\s>][^>]*>/is", $text, $matches)) {
            $results = $matches[1];
        }

        return $results;
    }
}