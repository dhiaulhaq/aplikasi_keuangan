<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/pemasukan.php");

$user = new User;
$kategori = new Kategori;

if(isset($session)){
  $logged = $session->user_loggedin();
  if(!$logged){
      redirect_to("/pages/login.php");
  }
}

$pemasukan = Pemasukan::cari_semua();
$totalpemasukan = Pemasukan::total_semua();

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">
    <?php echo cetak_pesan($pesan); ?>

      <div class="row">
        <div class="col-md-10"><h2>Daftar Pemasukan </h2></div>
        <div class="col-md-2">
            <a class="btn btn-primary" href="/pages/newpemasukan.php"><i class="fas fa-plus"></i> Add </a>
        </div>
      </div>

      <div class="row mgTp">
          <table class="table">
            <thead>
                <tr>
                    <th scope="col">Kasir</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Rupiah</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($pemasukan as $pem){ ?>
                <tr>
                    <th scope="row"><?php echo $user->nama($pem['user_id']) ?></th>
                    <td><?php echo $kategori->nama($pem['kategori_pemasukan']) ?></td>
                    <td><?php echo $pem['tanggal_masuk'] ?></td>
                    <td><?php echo $pem['rupiah_masuk'] ?></td>
                    <td>
                        <a href="editpemasukan.php?aksi=edit&id=<?php echo $pem['id']; ?>"><i class="far fa-edit"></i></a>
                        <a href="editpemasukan.php?aksi=hapus&id=<?php echo $pem['id']; ?>"><i class="far fa-trash-alt"></i></a>
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