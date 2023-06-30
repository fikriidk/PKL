<script src="../assets/js/Chart.bundle.js"></script>
<br>
<br>
<center><img src="<?= $logo ?>" width="200px">
        <h2>"E-Kinerja" <br> <?= $nama_aplikasi ?> <br> <?= $kota ?></h2>
    </center>
<br>
<br>
<br>
<div class="row">
    <div class="col-sm-12 infobox-container">
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="ace-icon glyphicon glyphicon-book "></i>
            </div>

            <div class="infobox-data">
                <?php
                $t = mysqli_query($koneksi, "select count(*) as total from tjabatan");
                $d = mysqli_fetch_array($t);
                ?>
                <span class="infobox-data-number"><?= @$d['total'] ?></span>
                <div class="infobox-content">Data Jabatan</div>
            </div>
        </div>

        <div class="infobox infobox-red">
            <div class="infobox-icon">
                <i class="ace-icon glyphicon glyphicon-user "></i>
            </div>

            <div class="infobox-data">
                <?php
                $t = mysqli_query($koneksi, "select count(*) as total from tkaryawan");
                $d = mysqli_fetch_array($t);
                ?>
                <span class="infobox-data-number"><?= @$d['total'] ?></span>
                <div class="infobox-content">Data Karyawan</div>
            </div>
        </div>
        <div class="infobox infobox-orange">
            <div class="infobox-icon">
                <i class="ace-icon glyphicon glyphicon-user "></i>
            </div>

            <div class="infobox-data">
                <?php
                $t = mysqli_query($koneksi, "select count(*) as total from tuser");
                $d = mysqli_fetch_array($t);
                ?>
                <span class="infobox-data-number"><?= @$d['total'] ?></span>
                <div class="infobox-content">Data User</div>
            </div>
        </div>
    </div>

</div>