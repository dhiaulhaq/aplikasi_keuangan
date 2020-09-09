<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pengeluaran.php");

$kategori = new Kategori;
$kategori->nilaikategori = 'keluar';
$foundkategori = $kategori->kategorikeuangan();

if(isset($_POST['save'])){
    $pengeluaran = new Pengeluaran;
    $pengeluaran->user_id = $session->uid;
    $pengeluaran->kategori_pengeluaran = $_POST['kategori_pengeluaran'];
    $pengeluaran->tanggal_keluar = $_POST['tanggal_keluar'];
    $pengeluaran->rupiah_keluar = $_POST['rupiah_keluar'];
    $createstatus = $pengeluaran->create();
    if($createstatus){
        //Message
        $pesan = "Pengeluaran berhasil ditambahkan!";
        $session->pesan($pesan);

        //Redirect to login page
        redirect_to("/pages/listpengeluaran.php");
    }
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">

        <form class="form-horizontal" action="newpengeluaran.php" method="POST">
            <fieldset>

            <!-- Form Name -->
            <legend>Tambah Pengeluaran Baru</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Jumlah Rupiah</label>  
                <div class="col-md-4">
                    <input id="rupiah_keluar" name="rupiah_keluar" type="number" placeholder="5000" min="0" step="1" class="form-control input-md" required=""> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Kategori Pengeluaran</label>  
                <div class="col-md-4">
                    <select id="kategori_pengeluaran" name="kategori_pengeluaran" class="form-control input-md">
                        <?php foreach($foundkategori as $cat){ ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Tanggal Keluar</label>  
                <div class="col-md-4">
                    <input id="tanggal_keluar" name="tanggal_keluar" type="date" min="2018-01-01" class="form-control input-md" required="">               
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

    </main><!-- /.container -->

    <?php require_once("../layout/footer.php")?>

  </body>
</html>