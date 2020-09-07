<?php
require_once("config.php");
class MySQLDatabase{
    private $connection;

    function __construct(){
        $this->open_connection();
    }

    public function open_connection(){
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if(!$this->connection){
            die("Koneksi ke Database Gagal!");
        }else{
            $db_select = mysqli_select_db($this->connection, DB_NAME);
            if(!$db_select){
                die("Nama Database Tidak Ditemukan: " . mysqli_error($this->connection));
            }
        }
    }

    //Query
    public function query($sql){
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    //Fetch (Tarik) result
    public function fetch_array($result_set){
        return mysqli_fetch_array($result_set);
    }

    private function confirm_query($result){
        if(!$result){
            $output = "Database Query Gagal: " . mysqli_error($this->connection);
            die($output);
        }
    }

    public function close_connection(){
        if($this->connection){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }
}
$database = new MySQLDatabase;
?>