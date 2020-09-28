<?php
require_once("../includes/database.php");
require_once("../includes/user.php");
require_once("../includes/helper.php");
require_once("../includes/session.php");

$logged = false;
$nama = "";

if(isset($session)){
  $logged = $session->user_loggedin();
  $nama = $session->nama();
}

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("layout/head.php")?>

  <body>

    <?php require_once("layout/nav.php")?>

    <main role="main" class="container">
    <?php echo cetak_pesan($pesan); ?>

    <?php if(!$logged){ ?>
      <div class="starter-template">
        <h1>Kalkuleit - Aplikasi Keuangan</h1>
        <p class="lead">Anda tidak terdaftar sebagai pengguna, silahkan Register atau Login untuk dapat menggunakan aplikasi.</p>
      </div>
    <?php }else{ ?>
      <div class="starter-template">
        <h1>Kalkuleit - Aplikasi Keuangan</h1>
        <p class="lead">Anda terdaftar sebagai: <?php echo $nama; ?>, silahkan akses menu Keuangan untuk menggunakan aplikasi.</p>
      </div>
    <?php } ?>

    </main><!-- /.container -->

    <?php require_once("layout/footer.php")?>

  </body>
</html>