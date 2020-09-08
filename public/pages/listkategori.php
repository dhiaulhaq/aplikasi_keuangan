<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");

if(isset($session)){
  $logged = $session->user_loggedin();
  if(!$logged){
      redirect_to("/pages/login.php");
  }
}

$kategori = Kategori::cari_semua();
$totalkategori = Kategori::total_semua();

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">
    <?php echo cetak_pesan($pesan); ?>

      <div class="row">
        <div class="col-md-10"><h2>Daftar Kategori </h2></div>
        <div class="col-md-2">
            <a class="btn btn-primary" href="/pages/newkategori.php"><i class="fas fa-plus"></i> Add </a>
        </div>
      </div>

      <div class="row mgTp">
          <table class="table">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($kategori as $cat){ ?>
                <tr>
                    <th scope="row"><?php echo $cat['code'] ?></th>
                    <td><?php echo $cat['kategori_type'] ?></td>
                    <td><?php echo $cat['nama'] ?></td>
                    <td>
                        <a href="editkategori.php?aksi=edit&id=<?php echo $cat['id']; ?>"><i class="far fa-edit"></i></a>
                        <a href="editkategori.php?aksi=hapus&id=<?php echo $cat['id']; ?>"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
          </table>
      </div>

    </main><!-- /.container -->

    <?php require_once("../layout/footer.php")?>

  </body>
</html>