<script src="../assets/js/Chart.bundle.js"></script>
<fieldset><legend>Statistik Pekerjaan</legend>
<div class="row">
    
    <div class="col-sm-12 infobox-container">
        <div class="infobox infobox-green">
            <div class="infobox-icon">
                <i class="ace-icon glyphicon glyphicon-thumbs-up "></i>
            </div>

            <div class="infobox-data">
                 <?php
                        $id_karyawan = $_SESSION['id_karyawan'];
                        $t = mysqli_query($koneksi,"select count(*) as total from tharian where status='Diterima' and id_karyawan='$id_karyawan'");
                        $d = mysqli_fetch_array($t);
                    ?>
                <span class="infobox-data-number"><?=@$d['total']?></span>
                <div class="infobox-content">Laporan Diterima</div>
            </div>
        </div>

        <div class="infobox infobox-red">
            <div class="infobox-icon">
                <i class="ace-icon glyphicon glyphicon-thumbs-down "></i>
            </div>

            <div class="infobox-data">
                <?php
                        $id_karyawan = $_SESSION['id_karyawan'];
                        $t = mysqli_query($koneksi,"select count(*) as total from tharian where status='Ditolak' and id_karyawan='$id_karyawan'");
                        $d = mysqli_fetch_array($t);
                    ?>
                <span class="infobox-data-number"><?=@$d['total']?></span>
                <div class="infobox-content">Laporan Ditolak</div>
            </div>
        </div>
        <div class="infobox infobox-orange">
            <div class="infobox-icon">
                <i class="ace-icon glyphicon glyphicon-retweet "></i>
            </div>

            <div class="infobox-data">
               <?php
                        $id_karyawan = $_SESSION['id_karyawan'];
                        $t = mysqli_query($koneksi,"select count(*) as total from tharian where status='Proses' and id_karyawan='$id_karyawan'");
                        $d = mysqli_fetch_array($t);
                    ?>
                <span class="infobox-data-number"><?=@$d['total']?></span>
                <div class="infobox-content">Laporan Diproses</div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">

<div class="col-xs-6 col-sm-3 pricing-box">
    <div class="widget-box widget-color-red">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">Jam Kerja Efektif <b>Hari ini</b></h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="price">
                    <?php
                        $tanggal = date('Y-m-d');
                        $id_karyawan = $_SESSION['id_karyawan'];
                        $t = mysqli_query($koneksi,"select sum(lama_pengerjaan) as total from tharian where tanggal='$tanggal' and id_karyawan='$id_karyawan'");
                        $d = mysqli_fetch_array($t);
                    ?>
                    <b><?=$d['total']?></b>
                    <small> Menit</small>
                   
                </div>
            </div>

            <div>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    <span> (<b><?=floor($d['total']/60)?></b>
                     Jam )</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-6 col-sm-3 pricing-box">
    <div class="widget-box widget-color-blue">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">Jam Kerja Efektif <b>Kemarin</b></h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="price">
                    <?php
                       
                        $id_karyawan = $_SESSION['id_karyawan'];
                         $kemarin = mktime (0,0,0, date("m"), date("d")-1,date("Y"));
                         $tanggal = date('Y-m-d', $kemarin);

                        $t = mysqli_query($koneksi,"select sum(lama_pengerjaan) as total from tharian where tanggal='$tanggal' and id_karyawan='$id_karyawan'");
                        $d = mysqli_fetch_array($t);
                    ?>
                    <b><?=$d['total']?></b>
                    <small> Menit</small>
                  
                </div>
            </div>

            <div>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    <span> (<b><?=floor($d['total']/60)?></b>
                     Jam )</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-6 col-sm-3 pricing-box">
    <div class="widget-box widget-color-orange">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">Jam Kerja Efektif <b>Minggu ini</b></h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="price">
                    <?php
                       
                        $id_karyawan = $_SESSION['id_karyawan'];
                        $tgl_sekarang = date('Y-m-d');
                        $tanggal = date('Y-m-d', strtotime('-1 week', strtotime($tgl_sekarang)));

                        $t = mysqli_query($koneksi,"select sum(lama_pengerjaan) as total from tharian where tanggal BETWEEN '$tanggal' and '$tgl_sekarang' and id_karyawan='$id_karyawan'");

                        $d = mysqli_fetch_array($t);
                    ?>
                    <b><?=$d['total']?></b>
                    <small> Menit</small>
                   
                </div>
            </div>

            <div>
                 <a href="#" class="btn btn-block btn-warning">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    <span> (<b><?=floor($d['total']/60)?></b>
                     Jam )</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-6 col-sm-3 pricing-box">
    <div class="widget-box widget-color-green">
        <div class="widget-header">
            <h5 class="widget-title bigger lighter">Jam Kerja Efektif <b>Bulan ini</b></h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
              <div class="price">
                    <?php
                       
                        $id_karyawan = $_SESSION['id_karyawan'];
                        $tgl_sekarang =date('Y-m-d');
                         $tgl = mktime (0,0,0, date("m")-1, date("d"),date("Y"));
                         $tanggal = date('Y-m-d', $tgl);

                        $t = mysqli_query($koneksi,"select sum(lama_pengerjaan) as total from tharian where tanggal BETWEEN '$tanggal' and '$tgl_sekarang' and id_karyawan='$id_karyawan'");

                        $d = mysqli_fetch_array($t);
                    ?>
                    <b><?=$d['total']?></b>
                    <small> Menit</small>
                </div>
            </div>

            <div>
                <a href="#" class="btn btn-block btn-success">
                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                    <span> (<b><?=floor($d['total']/60)?></b>
                     Jam )</span>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
</fieldset>
   