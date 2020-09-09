<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pemasukan.php");

$helperkategori = helperkategori();
$kategori = new Kategori;
$kategori->nilaikategori = 'masuk';
$foundkategori = $kategori->kategorikeuangan();

$aksi = $_GET['aksi'];
$id = $_GET['id'];

//Delete & Edit
if($aksi == 'hapus'){
    $pemasukan = new Pemasukan;
    $pemasukan->id = $id;
    $hasil = $pemasukan->hapus();
    if($hasil){
        $session->pesan("Pemasukan dengan ID: " . $id . " berhasil dihapus!");
        redirect_to("/pages/listpemasukan.php");
    }
}else{
    $pemasukan = Pemasukan::cari_dgn_id($id);
    if(isset($_POST['save'])){
        $pemasukan = new Pemasukan;
        $pemasukan->id = $id;
        $pemasukan->rupiah_masuk = $_POST['rupiah_masuk'];
        $pemasukan->kategori_pemasukan = $_POST['kategori_pemasukan'];
        $pemasukan->tanggal_masuk = $_POST['tanggal_masuk'];
        $hasil = $pemasukan->update();
        if($hasil){
            $session->pesan("Pemasukan dengan ID: " . $id . " berhasil diperbarui!");
            redirect_to("/pages/listpemasukan.php");
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
            <form class="form-horizontal" action="editpemasukan.php?aksi=edit&id=<?php echo $id; ?>" method="POST">
                <fieldset>

                <!-- Form Name -->
                <legend>Update Pemasukan</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="nama">Jumlah Rupiah</label>  
                    <div class="col-md-4">
                        <input id="rupiah_masuk" name="rupiah_masuk" type="number" min="0" step="1" class="form-control input-md" required="" value="<?php echo $pemasukan['rupiah_masuk'] ?>"> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="nama">Kategori Pemasukan</label>  
                    <div class="col-md-4">
                        <select id="kategori_pemasukan" name="kategori_pemasukan" class="form-control input-md">
                            <?php foreach($foundkategori as $cat){ ?>
                                <option value="<?php echo $cat['id']; ?>"<?php (($cat['id']==$pemasukan['kategori_pemasukan'])? print('selected'):false); ?>>
                                <?php echo $cat['nama']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Tanggal Masuk</label>  
                    <div class="col-md-4">
                        <input id="tanggal_masuk" name="tanggal_masuk" type="date" min="2018-01-01" class="form-control input-md" required="" value="<?php echo $pemasukan['tanggal_masuk']; ?>">               
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="save"></label>
                    <div class="col-md-8">
                        <button id="save" name="save" class="btn btn-success">Simpan</button>
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