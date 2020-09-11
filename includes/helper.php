<?php

function redirect_to($lokasi = NULL){
    if($lokasi!=NULL){
        header("Location: {$lokasi}");
        exit;
    }
}

function cetak_pesan($pesan=""){
    if(!empty($pesan)){
        return "<div class=\"alert alert-success\" role=\"alert\">{$pesan}</div>";
    }else{
        return "";
    }
}

function alert_danger($pesan=""){
    if(!empty($pesan)){
        return "<div class=\"alert alert-danger\" role=\"alert\">{$pesan}</div>";
    }else{
        return "";
    }
}

function helperkategori(){
    $cat['masuk'] = 'Masuk';
    $cat['keluar'] = 'Keluar';
    return $cat;
}

//Date
function daftarTahun(){
    $kumpulanTahun = array();
    $sekarang = date('Y');
    $tahunmulai = $sekarang - 3;
    for($tahun = $sekarang; $tahun >= $tahunmulai; $tahun--){
        $kumpulanTahun[$tahun] = $tahun;
    }
    return $kumpulanTahun;
}

function daftarBulan(){
    $bulan = array(1=> 'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember');
    return $bulan;
}

?>