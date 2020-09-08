<?php
require_once('database.php');

class Kategori{
    protected static $namatable = "kategori";
    public $id;
    public $code;
    public $kategori_type;
    public $nama;

    //Call query from DB
    public static function cari_dgn_sql($sql =""){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = $database->fetch_array($result_set)){
            $object_array[] = $row;
        }
        return $object_array;
    }

    //Find with ID
    public static function cari_dgn_id($id = 0){
        $result_array = self::cari_dgn_sql("SELECT * FROM " . self::$namatable . " WHERE id = {$id} LIMIT 1");
        return !empty($result_array)?array_shift($result_array):false;
    }

    //Kategori Function
    public function create(){
        global $database;
        $sql = " INSERT INTO " . self::$namatable. " (";
        $sql.= "code, kategori_type, nama) VALUES ('$this->code', '$this->kategori_type', '$this->nama')";
        if($database->query($sql)){
            return true;
        } else{
            return false;
        }
    }

    //Update
    public function update(){
        global $database;
        $sql = "UPDATE ".self::$namatable. " SET ";
        $sql.= "code='" . $this->code . "', nama='" . $this->nama . "', kategori_type='" . $this->kategori_type . "'";
        $sql.= " WHERE id=" . $this->id;
        $database->query($sql);
        return ($database->affected_rows() == 1)?true:false;
    }

    //Delete
    public function hapus(){
        global $database;
        $sql = "DELETE FROM ".self::$namatable;
        $sql.= " WHERE id=" .$this->id;
        $sql.= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1)?true:false;
    }

    //Find username
    public function nama($id){
        $hasil = $this->cari_dgn_id($id);
        return $hasil["nama"];
    }

    public static function cari_semua(){
        return self::cari_dgn_sql("SELECT * FROM " . self::$namatable);
    }

    public static function total_semua(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . self::$namatable;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }
}
?>