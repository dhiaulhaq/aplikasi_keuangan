<?php
$logged = false;
$nama = "";
if(isset($session)){
  $logged = $session->user_loggedin();
  $nama = $session->nama();
}
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="/">Kalkuleit</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">User</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-coins"></i> Keuangan</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/pages/listkategori.php"><i class="fas fa-ellipsis-h"></i> Kategori</a>
              <a class="dropdown-item" href="/pages/listpemasukan.php"><i class="fab fa-get-pocket"></i> Pemasukan</a>
              <a class="dropdown-item" href="/pages/listpengeluaran.php"><i class="fas fa-arrow-circle-right"></i> Pengeluaran</a>
              <a class="dropdown-item" href="/pages/balancereport.php"><i class="fas fa-file-invoice"></i> Balance</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav">

          <?php if(!$logged){ ?>
          <li class="nav-item">
            <a class="nav-link" href="/pages/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/register.php">Register</a>
          </li>
          <?php }?>

          <?php if($logged){ ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Hi <?php echo $nama; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/logout.php">Logout</a>
          </li>
          <?php }?>

        </ul>
      </div>
    </nav>