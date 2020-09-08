<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");

$helperkategori = helperkategori();

if(isset($_POST['save'])){
    $kategori = new Kategori;
    $kategori->code = $_POST['code'];
    $kategori->kategori_type = $_POST['kategori_type'];
    $kategori->nama = $_POST['nama'];
    $createstatus = $kategori->create();
    if($createstatus){
        //Message
        $pesan = "Kategori berhasil ditambahkan!";
        $session->pesan($pesan);

        //Redirect to login page
        redirect_to("/pages/listkategori.php");
    }
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">

        <form class="form-horizontal" action="newkategori.php" method="POST">
            <fieldset>

            <!-- Form Name -->
            <legend>Tambah Kategori Baru</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Code</label>  
                <div class="col-md-4">
                    <input id="code" name="code" type="text" placeholder="Kategori Code" class="form-control input-md" required=""> 
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Type</label>  
                <div class="col-md-4">
                    <select id="kategori_type" name="kategori_type" class="form-control input-md">
                        <?php foreach($helperkategori as $key=>$value){ ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Nama</label>  
                <div class="col-md-4">
                    <input id="nama" name="nama" type="text" placeholder="Bayar Listrik" class="form-control input-md" required="">               
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