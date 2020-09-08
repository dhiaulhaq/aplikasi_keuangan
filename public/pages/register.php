<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

if(isset($_POST['save'])){
    $user = new User;
    $user->nama = $_POST['nama'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $createstatus = $user->create();
    if($createstatus){
        //Message
        $pesan = "Hi, " . $user->nama . ". Welcome!";
        $session->pesan($pesan);

        //Redirect to login page
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

        <form class="form-horizontal" action="register.php" method="POST">
            <fieldset>

            <!-- Form Name -->
            <legend>Register Yourself</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nama">Nama</label>  
                <div class="col-md-4">
                    <input id="nama" name="nama" type="text" placeholder="John" class="form-control input-md" required=""> 
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>  
                <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="johndoe@example.com" class="form-control input-md" required="">               
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">               
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="save"></label>
                <div class="col-md-8">
                    <button id="save" name="save" class="btn btn-success">Register</button>
                </div>
            </div>

            </fieldset>
        </form>

    </main><!-- /.container -->

    <?php require_once("../layout/footer.php")?>

  </body>
</html>