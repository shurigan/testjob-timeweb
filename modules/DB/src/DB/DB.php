<?php
/**
 * Написан на скоряк. Давно уже пользуюсь готовыми библиотеками. Очень нравится Doctrine.
 */


namespace DB;
use Debug\Debug;

/**
 * Class DB
 * @package DB
 */
class DB {

    private $connection;

    /** @var \PDO */
    private static $instance = null;

    /**
     * Return instance of DB
     *
     * @return \PDO
     */
    public static function getInstance() {
        if(!self::$instance) {
            self::create();
        }
        return self::$instance;
    }

//    /**
//     * Constructor (KO)
//     * @param \PDO $connection
//     */
//    protected function __construct(\PDO $connection) {
//        $this->connection = $connection;
//    }


    /**
     * Create DB
     *
     * @param array $options
     */
    public static function create($options = array()) {
        $host = isset($options["host"]) ? $options["host"] : "localhost";
        $port = isset($options["port"]) ? $options["port"] : "3307";
        $user = isset($options["user"]) ? $options["user"] : "";
        $password = isset($options["password"]) ? $options["password"] : "";
        $database = isset($options["database"]) ? $options["database"] : "timeweb";

        $dsn = 'mysql:dbname='.$database.';host='.$host.';port='.$port;

        try {
            self::$instance = new \PDO($dsn, $user, $password);

        } catch(\Exception $e) {

            Debug::dump($e);
        }

    }


} 