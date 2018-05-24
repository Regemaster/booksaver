<?php
  class Db {
    private static $instance = NULL;
    private static $serverName = "sql107.epizy.com";
    private static $userName = "epiz_21427436";
    private static $passwd = "mezzopotamia";
    private static $dbname = "epiz_21427436_booksaver";

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO('mysql:host='. self::$serverName .';dbname='. self::$dbname, self::$userName, self::$passwd, $pdo_options);
      }
      return self::$instance;
    }
  }
?>

