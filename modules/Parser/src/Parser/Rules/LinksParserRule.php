<?php

namespace Parser\Rules;
use Debug\Debug;

/**
 * Class LinksParserRule
 * @package Parser\Rules
 */
class LinksParserRule implements ParserRuleInterface {

    /**
     * Process rule
     *
     * @param string $text
     * @return array
     */
    public function process($text) {
        $results = array();

        if(preg_match_all("/<a[^>]+href=('|\")(.*?)(?:\\1)/is", $text, $matches)) {
            foreach($matches[2] as $match) {
                if(!empty($match)) {
                    $results[] = $match;
                }
            }
        }

        return $results;
    }
}