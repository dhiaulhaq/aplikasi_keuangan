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

?>