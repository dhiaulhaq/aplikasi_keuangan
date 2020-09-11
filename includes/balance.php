<?php
require_once('database.php');

class Balance{
    
    public $tahun;
    public $bulan;
    public $awalbulan;
    public $akhirbulan; //Monthly Report

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

    public function totalpengeluaran(){
        $this->awalbulan = $this->tahun . "-" . $this->bulan . "-01";
        $this->akhirbulan = date("Y-m-t", strtotime($this->awalbulan));
        $sql = "SELECT SUM(rupiah_keluar) AS total FROM pengeluaran WHERE DATE(tanggal_keluar) BETWEEN '";
        $sql.= $this->awalbulan . "' AND '" . $this->akhirbulan . "'";
        $pengeluaran_array = self::cari_dgn_sql($sql);
        return !empty($pengeluaran_array[0]['total']) ? $pengeluaran_array[0]['total']:0;
    }

    public function itempengeluaran(){
        $this->awalbulan = $this->tahun . "-" . $this->bulan . "-01";
        $this->akhirbulan = date("Y-m-t", strtotime($this->awalbulan));
        $sql = "SELECT kategori_pengeluaran, SUM(rupiah_keluar) AS total FROM pengeluaran WHERE DATE(tanggal_keluar) BETWEEN '";
        $sql.= $this->awalbulan . "' AND '" . $this->akhirbulan . "'";
        $sql.= " GROUP BY kategori_pengeluaran";
        $sql.= " ORDER BY rupiah_keluar DESC";
        $item_array = self::cari_dgn_sql($sql);
        return $item_array;
    }

    public function totalpemasukan(){
        $this->awalbulan = $this->tahun . "-" . $this->bulan . "-01";
        $this->akhirbulan = date("Y-m-t", strtotime($this->awalbulan));
        $sql = "SELECT SUM(rupiah_masuk) AS total FROM pemasukan WHERE DATE(tanggal_masuk) BETWEEN '";
        $sql.= $this->awalbulan . "' AND '" . $this->akhirbulan . "'";
        $pemasukan_array = self::cari_dgn_sql($sql);
        return !empty($pemasukan_array[0]['total']) ? $pemasukan_array[0]['total']:0;
    }

    public function itempemasukan(){
        $this->awalbulan = $this->tahun . "-" . $this->bulan . "-01";
        $this->akhirbulan = date("Y-m-t", strtotime($this->awalbulan));
        $sql = "SELECT kategori_pemasukan, SUM(rupiah_masuk) AS total FROM pemasukan WHERE DATE(tanggal_masuk) BETWEEN '";
        $sql.= $this->awalbulan . "' AND '" . $this->akhirbulan . "'";
        $sql.= " GROUP BY kategori_pemasukan";
        $sql.= " ORDER BY rupiah_masuk DESC";
        $item_array = self::cari_dgn_sql($sql);
        return $item_array;
    }

}
?>