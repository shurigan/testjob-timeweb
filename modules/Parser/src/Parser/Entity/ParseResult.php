<?php

namespace Parser\Entity;


use DB\DB;
use Debug\Debug;

class ParseResult {
    /** @var string */
    private $url;

    /** @var array */
    private $results = array();

    /** @var int */
    protected $id = null;

    /**
     * Set URL
     *
     * @param $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

    /**
     * Get URL
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set results array
     *
     * @param array $results
     * @return $this
     */
    public function setResults($results) {
        if(!is_array($results)) {
            $results = array($results);
        }
        $this->results = $results;
        return $this;
    }

    /**
     * Get results array
     *
     * @return array
     */
    public function getResults() {
        return $this->results;
    }

    /**
     * Return ID
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get total results count
     * @return int
     */
    public function getTotal() {
        return count($this->results);
    }

    /**
     * Save item
     */
    public function save() {
        if($this->getId()) {
            $query = DB::getInstance()->prepare('UPDATE `results` SET `url` = :url, `result_string` = :results, `total` = :total WHERE `id` = :id');
            $result = $query->execute(array(
                ':id' => $this->getId(),
                ':url' => $this->getUrl(),
                ':results' => implode(',', $this->getResults()),
                ':total' => $this->getTotal()
            ));
        } else {
            $query = DB::getInstance()->prepare('INSERT INTO `results` SET `url` = :url, `result_string` = :results, `total` = :total');
            $result = $query->execute(array(
                ':url' => $this->getUrl(),
                ':results' => implode(',', $this->getResults()),
                ':total' => $this->getTotal()
            ));
        }
    }


    /**
     * Get by ID
     *
     * @param $id
     * @return $this
     */
    public static function getById($id) {
        $query = DB::getInstance()->prepare('SELECT * FROM `results` WHERE id = :id');
        $query->execute(array(
            ':id' => $id
        ));
        if($result = $query->fetchObject()) {
            return self::fromDbResult($result);
        } else {
            return null;
        }
    }

    protected static function fromDbResult($result) {
        $item = new self();
        $item->id = $result->id;
        $item->setResults(explode(',', $result->result_string));
        $item->setUrl($result->url);

        return $item;
    }
    /**
     * String representation of item
     *
     * @return string
     */
    public function __toString() {
        return "URL: " . $this->url . ", Total results: " . count($this->results);
    }

    /**
     * Fetch all items from db
     */
    public static function findAll() {
        $results = array();

        $query = DB::getInstance()->query("SELECT * FROM `results`");
        while($result = $query->fetchObject()) {
            $results[] = self::fromDbResult($result);
        }

        return $results;
    }
}