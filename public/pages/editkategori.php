<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");

$helperkategori = helperkategori();

$aksi = $_GET['aksi'];
$id = $_GET['id'];

//Delete & Edit
if($aksi == 'hapus'){
    $kategori = new Kategori;
    $kategori->id = $id;
    $hasil = $kategori->hapus();
    if($hasil){
        $session->pesan("Kategori dengan ID: " . $id . " berhasil dihapus!");
        redirect_to("/pages/listkategori.php");
    }
}else{
    $kategori = Kategori::cari_dgn_id($id);
    if(isset($_POST['save'])){
        $kategori = new Kategori;
        $kategori->id = $id;
        $kategori->code = $_POST['code'];
        $kategori->kategori_type = $_POST['kategori_type'];
        $kategori->nama = $_POST['nama'];
        $hasil = $kategori->update();
        if($hasil){
            $session->pesan("Kategori dengan ID: " . $id . " berhasil diperbarui!");
            redirect_to("/pages/listkategori.php");
        }
    }
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">

    <?php echo cetak_pesan($pesan); ?>

      <div class="row mgTp">
          <div class="col-md-12">
            <form class="form-horizontal" action="editkategori.php?aksi=edit&id=<?php echo $id; ?>" method="POST">
                <fieldset>

                <!-- Form Name -->
                <legend>Update Kategori</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="nama">Code</label>  
                    <div class="col-md-4">
                        <input id="code" name="code" type="text" value="<?php echo $kategori['code']; ?>" class="form-control input-md" required=""> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="nama">Type</label>  
                    <div class="col-md-4">
                        <select id="kategori_type" name="kategori_type" class="form-control input-md">
                            <?php foreach($helperkategori as $key=>$value){ ?>
                            <option value="<?php echo $key; ?>" <?php (($key == $kategori['kategori_type'])? print('selected'):print('')); ?> ><?php echo $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Nama</label>  
                    <div class="col-md-4">
                        <input id="nama" name="nama" type="text" value="<?php echo $kategori['nama']; ?>" class="form-control input-md" required="">               
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="save"></label>
                    <div class="col-md-8">
                        <button id="save" name="save" class="btn btn-success">Update</button>
                    </div>
                </div>

                </fieldset>
            </form>
          </div>
      </div>

    </main><!-- /.container -->

    <?php require_once("../layout/footer.php")?>

  </body>
</html>