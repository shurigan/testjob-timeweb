<?php

namespace Parser\Parser;
use Debug\Debug;
use Parser\Rules\ParserRuleInterface;

/**
 * Class HttpParser
 * @package Parser\Parser
 */
class HttpParser {

    /** @var resource */
    protected $context;

    /** @var array */
    private $rules = array();

    /** @var bool */
    private $error = false;

    /**
     * Constructor (KO)
     */
    public function __construct() {
        $opts = array('http' =>
            array(
                'method' => 'GET',
                'ignore_errors' => '1'
            )
        );
        $this->context = stream_context_create($opts);
    }

    /**
     * Add rule
     *
     * @param ParserRuleInterface $rule
     */
    public function addRule(ParserRuleInterface $rule) {
        array_push($this->rules, $rule);
    }


    /**
     * Process rule
     *
     * @param string $url
     * @return array
     */
    public function process($url) {

        if(!preg_match("/^https?:\/\//is", $url)) {
            $url = "http://" . $url;
        }

        $results = array();

        if($stream  = @fopen($url, "r", false, $this->context)) {
            if($content = stream_get_contents($stream)) {

                foreach($this->rules as $rule) {
                    /** @var ParserRuleInterface $rule */
                    $results = array_merge($results, $rule->process($content));
                }

            } else {
                $this->error = "Error fetch site content";
            }
        } else {
            $this->error = "URL not found";
        }

        return $results;
    }

    /**
     * Get errors
     *
     * @return bool
     */
    public function getError() {
        return $this->error;
    }
} 