<?php
require_once("../../includes/database.php");
require_once("../../includes/user.php");
require_once("../../includes/helper.php");
require_once("../../includes/session.php");
require_once("../../includes/kategori.php");
require_once("../../includes/balance.php");

$kategori = new Kategori;
$tahun = daftarTahun();
$bulan = daftarBulan();
$tahunnow = date('Y');
$bulannow = date('m');

if(isset($_POST['save'])){
    $tahunnow = $_POST['tahun'];
    $bulannow = $_POST['bulan'];
}

$balance = new Balance;
$balance->tahun = $tahunnow;
$balance->bulan = $bulannow;
$totalpengeluaran = $balance->totalpengeluaran();
$totalpemasukan = $balance->totalpemasukan();
$profit = $totalpemasukan - $totalpengeluaran;
$itempemasukan = $balance->itempemasukan();
$itempengeluaran = $balance->itempengeluaran();

?>

<!doctype html>
<html lang="en">
  
  <?php require_once("../layout/head.php")?>

  <body>

    <?php require_once("../layout/nav.php")?>

    <main role="main" class="container">

        <form class="form-horizontal" action="balancereport.php" method="POST">
            <div class="row">
                <div class="col-3 form-group">
                    <!-- Display Year -->
                    <label class="control-label" for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <?php foreach($tahun as $key=>$value){ ?>
                            <option value="<?php echo $key; ?>" <?php ($key==$tahunnow)? print "selected":false; ?>>
                                <?php echo $value; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-3 form-group">
                    <!-- Display Month -->
                    <label class="control-label" for="bulan">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control">
                        <?php foreach($bulan as $key=>$value){ ?>
                            <option value="<?php echo $key; ?>" <?php ($key==$bulannow)? print "selected":false; ?>>
                                <?php echo $value; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-4 form-group">
                    <label class="control-label" for="bulan">&nbsp</label></br>
                    <button id="save" name="save" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Display Balance -->
        <div class="card">
            <div class="card-header"><h2>Balance Keuangan</h2></div>
            <div class="row">
                <div class="col">
                    <table class="table">
                        <tr>
                            <th scope="col">Total Pemasukan</th>
                            <th scope="col">Rp. <?php echo number_format((float)$totalpemasukan, 2,',','.'); ?></th>
                        </tr>
                        <tr>
                            <th scope="col">Total Pengeluaran</th>
                            <th scope="col">Rp. <?php echo number_format((float)$totalpengeluaran, 2,',','.'); ?></th>
                        </tr>
                        <tr>
                            <th scope="col">Balance</th>
                            <th scope="col">Rp. <?php echo number_format((float)$profit, 2,',','.'); ?></th>
                        </tr>
                    </table>
                </div>
                <div class="col">
                    <table class="table">
                        <tr>
                            <th scope="col">Pemasukan</th>
                            <th scope="col">Rp. <?php echo number_format((float)$totalpemasukan, 2,',','.'); ?></th>
                        </tr>
                        <?php foreach($itempemasukan as $item){ ?>
                        <tr>
                            <th scope="col"><?php echo $kategori->nama($item['kategori_pemasukan']) ?></th>
                            <th scope="col">Rp. <?php echo number_format((float)$item['total'], 2,',','.'); ?></th>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="col">
                    <table class="table">
                        <tr>
                            <th scope="col">Pengeluaran</th>
                            <th scope="col">Rp. <?php echo number_format((float)$totalpengeluaran, 2,',','.'); ?></th>
                        </tr>
                        <?php foreach($itempengeluaran as $item){ ?>
                        <tr>
                            <th scope="col"><?php echo $kategori->nama($item['kategori_pengeluaran']) ?></th>
                            <th scope="col">Rp. <?php echo number_format((float)$item['total'], 2,',','.'); ?></th>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </main><!-- /.container -->

    <?php require_once("../layout/footer.php")?>

  </body>
</html>