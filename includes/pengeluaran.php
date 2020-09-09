<?php
require_once('database.php');

class Pengeluaran{
    protected static $namatable = "pengeluaran";
    public $id;
    public $user_id;
    public $rupiah_keluar;
    public $tanggal_keluar;
    public $kategori_pengeluaran;

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

    //Pengeluaran Function
    public function create(){
        global $database;
        $sql = " INSERT INTO " . self::$namatable. " (";
        $sql.= "user_id, kategori_pengeluaran, tanggal_keluar, rupiah_keluar) ";
        $sql.= "VALUES ('$this->user_id', '$this->kategori_pengeluaran', '$this->tanggal_keluar', '$this->rupiah_keluar')";
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
        $sql.= "rupiah_keluar='" . $this->rupiah_keluar . "', tanggal_keluar='" . $this->tanggal_keluar . "', kategori_pengeluaran='" . $this->kategori_pengeluaran . "'";
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