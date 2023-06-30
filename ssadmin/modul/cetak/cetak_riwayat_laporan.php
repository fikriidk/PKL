<link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
<table id="dynamic-table1" class="table table-striped table-bordered table-hover">
    <?php
    //session_start();
    session_start();
    include "../../../config/koneksi.php";
    include "../../../config/function.php";

    @$id_karyawan = $_SESSION['id_karyawan'];


    @$tanggal1 = $_POST['tanggal1a'];
    @$tanggal2 = $_POST['tanggal2a'];
    //echo $nama_karyawan;
    @$tabel = "v_lapharian";
    @$field_id = "id_harian";
    @$urutan = "desc";
    @$tgl = date('Y-m-d');


    $tampil = tampil($tabel, "where id_karyawan = '$id_karyawan' and tanggal BETWEEN '$tanggal1' and '$tanggal2' order by id_harian desc");
    $data1 = mysqli_fetch_array($tampil);


    ?>

    <thead>
        <tr>
            <th colspan="14" style="text-align: center;">
                <img src="<?= $logo ?>" width="100px">

                <h3><?= strtoupper($nama_aplikasi) ?> <br> LAPORAN KINERJA HARIAN <br><b><?= strtoupper($data1['nama_lengkap']) ?></b> <br> Periode <?= tgl_indo($tanggal1) ?> s/d <?= tgl_indo($tanggal2) ?></h3>
            </th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Kegiatan</th>
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Lama Pengerjaan</th>
            <th>Deskripsi Pekerjaan</th>
            <th>Output</th>
            <th>Satuan</th>
            <th>File</th>
            <th>Status</th>
            <th>Nilai</th>
            <th>Keterangan</th>
            <th>Verifikator</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $tampilx = tampil($tabel, "where id_karyawan = '$id_karyawan' and tanggal BETWEEN '$tanggal1' and '$tanggal2' order by tanggal asc");

        $no = 0;
        while ($data = mysqli_fetch_array($tampilx)) {
            $no++;
            if ($data['status'] == "Diterima") {
                $status = '<span class="label label-lg label-success">
						<i class="ace-icon glyphicon glyphicon-thumbs-up bigger-120"></i> Diterima </span>';
            } elseif ($data['status'] == "Ditolak") {
                $status = '<span class="label label-lg label-danger">
						<i class="ace-icon glyphicon glyphicon-thumbs-down bigger-120"></i> Ditolak </span>';
            } else {
                $status = '<span class="label label-lg label-warning">
						<i class="ace-icon glyphicon glyphicon-retweet bigger-120"></i>  Proses	</span>';
            }

            $t = tampil("tkaryawan", "where id_karyawan='$data[id_korektor]'");
            $d = mysqli_fetch_array($t);
            if ($d) {
                $verifikator = $d['nama_lengkap'];
            } else {
                $verifikator = " - ";
            }
        ?>

            <tr>
                <td><?= @$no ?></td>
                <td><?= $data['tanggal'] ?></td>
                <td><?= $data['kegiatan'] ?></td>
                <td><?= $data['waktu_mulai'] ?></td>
                <td><?= $data['waktu_selesai'] ?></td>
                <td><?= $data['lama_pengerjaan'] ?> Menit</td>
                <td><?= $data['deskripsi_pekerjaan'] ?></td>
                <td><?= $data['output'] ?></td>
                <td><?= $data['satuan'] ?></td>
                <td><?= ($data['file_pekerjaan'] == '-' || $data['file_pekerjaan'] == '') ? '' : '<a href="../file/file_pekerjaan/' . $data['file_pekerjaan'] . '">Lihat file</a>'; ?></td>
                <td><?= $status ?></td>
                <td><?= $data['nilai'] ?></td>
                <td><?= $data['keterangan'] ?></td>
                <td><?= @$verifikator ?></td>
            </tr>
        <?php
            @$total += $data['lama_pengerjaan'];
            @$total_nilai += $data['nilai'];
        }    ?>

    </tbody>
    <tr>
        <td colspan="5" align="right" style="color: blue;font-weight: bold;">Total Jam Kerja Efektif Tanggal <span style="color:red"><?= tgl_indo($tanggal1) ?></span> s/d <span style="color:red"><?= tgl_indo($tanggal2) ?></span> </td>
        <td colspan="6" style="color: blue;font-weight: bold;"><?= @$total ?> Menit <span style="color:red"> (<?= floor(@$total / 60) ?> Jam)</span> </td>
        <td colspan="5"><b><?= @$total_nilai ?></b></td>
    </tr>
</table>