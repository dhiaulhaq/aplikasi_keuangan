<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pengeluaran.php");

$helperkategori = helperkategori();
$kategori = new Kategori;
$kategori->nilaikategori = 'keluar';
$foundkategori = $kategori->kategorikeuangan();

$aksi = $_GET['aksi'];
$id = $_GET['id'];

//Delete & Edit
if($aksi == 'hapus'){
    $pengeluaran = new Pengeluaran;
    $pengeluaran->id = $id;
    $hasil = $pengeluaran->hapus();
    if($hasil){
        $session->pesan("Pengeluaran dengan ID: " . $id . " berhasil dihapus!");
        redirect_to("/pages/listpengeluaran.php");
    }
}else{
    $pengeluaran = Pengeluaran::cari_dgn_id($id);
    if(isset($_POST['save'])){
        $pengeluaran = new Pengeluaran;
        $pengeluaran->id = $id;
        $pengeluaran->rupiah_keluar = $_POST['rupiah_keluar'];
        $pengeluaran->kategori_pengeluaran = $_POST['kategori_pengeluaran'];
        $pengeluaran->tanggal_keluar = $_POST['tanggal_keluar'];
        $hasil = $pengeluaran->update();
        if($hasil){
            $session->pesan("Pengeluaran dengan ID: " . $id . " berhasil diperbarui!");
            redirect_to("/pages/listpengeluaran.php");
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
            <form class="form-horizontal" action="editpengeluaran.php?aksi=edit&id=<?php echo $id; ?>" method="POST">
                <fieldset>

                <!-- Form Name -->
                <legend>Update Pengeluaran</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="nama">Jumlah Rupiah</label>  
                    <div class="col-md-4">
                        <input id="rupiah_keluar" name="rupiah_keluar" type="number" min="0" step="1" class="form-control input-md" required="" value="<?php echo $pengeluaran['rupiah_keluar'] ?>"> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="nama">Kategori Pengeluaran</label>  
                    <div class="col-md-4">
                        <select id="kategori_pengeluaran" name="kategori_pengeluaran" class="form-control input-md">
                            <?php foreach($foundkategori as $cat){ ?>
                                <option value="<?php echo $cat['id']; ?>"<?php (($cat['id']==$pengeluaran['kategori_pengeluaran'])? print('selected'):false); ?>>
                                <?php echo $cat['nama']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Tanggal Keluar</label>  
                    <div class="col-md-4">
                        <input id="tanggal_keluar" name="tanggal_keluar" type="date" min="2018-01-01" class="form-control input-md" required="" value="<?php echo $pengeluaran['tanggal_keluar']; ?>">               
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