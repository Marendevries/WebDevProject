<?php


class User {

    /* Properties */
    private $conn;

    /* Get database access */
    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    function trimString($input) {
            // remove quotes from string
            return $$input = trim(str_replace( array("'", "'"), '', $$input));
        }

    function getSingleValue($tableName, $prop, $value, $columnName)
    {
        $q = $this->conn->query("SELECT `$columnName` FROM `$tableName` WHERE $prop='".$value."'");
        $f = $q->fetch();
        $result = $f[$columnName];
        return $result;
    }

}

class player_data {
    private $player_id;
    private $name;
    private $winnings_total;

    public function setPlayerId($player_id)
    {
        $this->$player_id = $player_id;
    }
    public function setName($name)
    {
        $this->$name = $name;
    }
    public function setWinningsTotal($winnings_total)
    {
        $this->$winnings_total = $winnings_total;
    }
}

class player_game {
    private $player_game_id;
    private $game_id;
    private $player_id_fk;
}

class Core
{

    public $pdo;
    private static $instance;

    private function __construct()
    {
        // building data source name from config
        $dsn = 'pgsql:host=' . bonfig::read('db.host') .
            ';dbname='    . bonfig::read('db.basename') .
            ';port='      . bonfig::read('db.port') .
            ';connect_timeout=15';
        // getting DB user from config
        $user = bonfig::read('db.user');
        // getting DB password from config
        $password = bonfig::read('db.password');

        $this->pdo = new PDO($dsn, $user, $password);
    }
    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }
}

class Bonfig
{
    static $confArray;

    public static function read($name)
    {
        return self::$confArray[$name];
    }

    public static function write($name, $value)
    {
        self::$confArray[$name] = $value;
    }

}

// db
bonfig::write('db.host', 'localhost');
bonfig::write('db.port', '5432');
bonfig::write('db.basename', 'pokerDb');
bonfig::write('db.user', 'student');
bonfig::write('db.password', 'student');