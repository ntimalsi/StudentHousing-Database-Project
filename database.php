<?php
class Database {
  private static $mysqli = null;

  public function __construct() {
    die('Init function error');
  }

  public static function dbConnect() {
	//try connecting to your database
	require_once("/home/ntimalsi/DBtimalsina.php");

	//catch a potential error, if unable to connect
  if($mysqli==null){
    try{
      $mysqli= new PDO('mysql:8113='.DBHOST.';dbname='.DBNAME,USERNAME, PASSWORD);
      echo "Successful Connection";
    }
    catch(PDOException $e){
      echo"Could not connect";
      die($e->getMessage());
    }
  }
    return $mysqli;
  }

  public static function dbDisconnect() {
    $mysqli = null;
  }
}
?>
