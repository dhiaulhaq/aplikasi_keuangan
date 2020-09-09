<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pemasukan.php");

$kategori = new Kategori;
$kategori->nilaikategori = 'masuk';
$foundkategori = $kategori->kategorikeuangan();

if(isset($_POST['save'])){
    $pemasukan = new Pemasukan;
    $pemasukan->user_id = $session->uid;
    $pemasukan->kategori_pemasukan = $_POST['kategori_pemasukan'];
    $pemasukan->tanggal_masuk = $_POST['tanggal_masuk'];
    $pemasukan->rupiah_masuk = $_POST['rupiah_masuk'];
    $createstatus = $pemasukan->create();
    if($createstatus){
        //Message
        $pesan = "Pemasukan berhasil ditambahkan!";
        $session->pesan($pesan);

        //Redirect to login page
        redirect_to("/pages/listpemasukan.php");
    }
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">

        <form class="form-horizontal" action="newpemasukan.php" method="POST">
            <fieldset>

            <!-- Form Name -->
            <legend>Tambah Pemasukan Baru</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Jumlah Rupiah</label>  
                <div class="col-md-4">
                    <input id="rupiah_masuk" name="rupiah_masuk" type="number" placeholder="5000" min="0" step="1" class="form-control input-md" required=""> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Kategori Pemasukan</label>  
                <div class="col-md-4">
                    <select id="kategori_pemasukan" name="kategori_pemasukan" class="form-control input-md">
                        <?php foreach($foundkategori as $cat){ ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Tanggal Masuk</label>  
                <div class="col-md-4">
                    <input id="tanggal_masuk" name="tanggal_masuk" type="date" min="2018-01-01" class="form-control input-md" required="">               
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