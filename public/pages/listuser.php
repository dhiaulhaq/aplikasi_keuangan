<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

if(isset($session)){
  $logged = $session->user_loggedin();
  if(!$logged){
      redirect_to("/pages/login.php");
  }
}

$users = User::cari_semua();
$totaluser = User::total_semua();

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">
    <?php echo cetak_pesan($pesan); ?>

      <div class="row">
        <div class="col-md-10"><h2>Daftar User </h2></div>
        <div class="col-md-2">
            <a class="btn btn-primary" href="/pages/newuser.php"><i class="fas fa-plus"></i> Add </a>
        </div>
      </div>

      <div class="row mgTp">
          <table class="table">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($users as $user){ ?>
                <tr>
                    <th scope="row"><?php echo $user['id'] ?></th>
                    <td><?php echo $user['nama'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td>
                        <a href="edituser.php?aksi=edit&uid=<?php echo $user['id']; ?>"><i class="far fa-edit"></i></a>
                        <a href="edituser.php?aksi=hapus&uid=<?php echo $user['id']; ?>"><i class="far fa-trash-alt"></i></a>
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