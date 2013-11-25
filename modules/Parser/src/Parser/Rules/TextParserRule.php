<?php

namespace Parser\Rules;


use Debug\Debug;

/**
 * Class TextParserRule
 * @package Parser\Rules
 */
class TextParserRule implements ParserRuleInterface {
    /** @var string */
    private $search;

    /**
     * Constructor (KO)
     *
     * @param string $search
     */
    public function __construct($search) {
        $this->setSearchText($search);
    }

    /**
     * Set search text
     *
     * @param string $search
     */
    public function setSearchText($search) {
        $this->search = $search;
    }

    /**
     * Process rule
     *
     * @param string $text
     * @return array
     */
    public function process($text) {
        $results = array();
        if(preg_match_all("/".$this->search."/is", htmlspecialchars($text), $matches)) {
            $results = $matches[0];
        }

        return $results;
    }
}