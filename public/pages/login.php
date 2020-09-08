<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

if(isset($_POST['save'])){
  // $user = new User;
  $email = $_POST['email'];
  $password = $_POST['password'];
  $loginuid = User::authenticate($email, $password);
  if($loginuid){
    $user = User::cari_dgn_id($loginuid);
    $session->login($loginuid);
    $nama = $user['nama'];
    $session->nama($nama);
    $pesan = "Welcome back " . $nama . "!";
    $session->pesan($pesan);
    redirect_to("/");
  }else{
    // $pesan = "Email atau Password anda salah!";
    // $session->pesan($pesan);
    redirect_to("/pages/login.php");
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
          <form class="col-md-6 offset-md-3" action="login.php" method="POST">
              <h3 class="title">Please sign in</h3>
              <hr class="divisor">
              <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <button type="submit" name="save" class="btn btn-primary topBtn"><i class="fa fa-sign-in"></i> Sign in</button>
          </form>
      </div>

    </main><!-- /.container -->

    <?php require_once("../layout/footer.php")?>

  </body>
</html>