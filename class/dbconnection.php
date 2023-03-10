<?php
// Loaded all required libraries.
require("../vendor/autoload.php");
//Loading .env credentials.
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/**
 * Make database connection. 
 * 
 * @method connect()
 *  connects with given database.
 *  
 */
class Database
{

  /**
   * Connects with database using mysqli.
   * 
   * @param string $database
   *  Store the name of database to connect.
   * 
   * @return mixed
   *  returns mysqli object if connection successfull otherwise print error.
   */
  public function connect($database)
  {
    $connect = new mysqli("localhost", $_ENV['sqlUser'], $_ENV['sqlPass'], $database);
    if ($connect->connect_error)
      echo '<script>"Connection error:" . $connect->connect_error</script>';
    else
      echo '<script>console.log("Successfully connected with ' . $database . ' database.")</script>';
    return $connect;
  }

}
?>
