<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");

$aksi = $_GET['aksi'];
$uid = $_GET['uid'];

//Delete & Edit
if($aksi == 'hapus'){
    $user = new User;
    $user->id = $uid;
    $hasil = $user->hapus();
    if($hasil){
        $session->pesan("User dengan ID: " . $uid . " berhasil dihapus!");
        redirect_to("/pages/listuser.php");
    }
}else{
    $user = User::cari_dgn_id($uid);
    if(isset($_POST['save'])){
        $user = new User;
        $user->id = $uid;
        $user->nama = $_POST['nama'];
        $user->email = $_POST['email'];
        $hasil = $user->update();
        if($hasil){
            $session->pesan("User dengan ID: " . $id . " berhasil diperbarui!");
            redirect_to("/pages/listuser.php");
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
            <form class="form-horizontal" action="edituser.php?aksi=edit&uid=<?php echo $uid; ?>" method="POST">
                <fieldset>

                <!-- Form Name -->
                <legend>Update User</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="nama">Nama</label>  
                    <div class="col-md-4">
                        <input id="nama" name="nama" type="text" value="<?php echo $user['nama']; ?>" class="form-control input-md" required=""> 
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email</label>  
                    <div class="col-md-4">
                        <input id="email" name="email" type="text" value="<?php echo $user['email']; ?>" class="form-control input-md" required="">               
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="save"></label>
                    <div class="col-md-8">
                        <button id="save" name="save" class="btn btn-success">Update</button>
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