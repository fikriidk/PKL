<?php
session_start();
if (empty($_SESSION['username']) or empty($_SESSION['password']) or empty($_SESSION['level'])) {
	echo "<script>alert('Maaf untuk mengakses Halaman ini, Silah Login Terlebih Dahulu..!');document.location='index.php'</script>";
} else {
	include "../config/function.php";
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?= $title ?></title>
		<link rel="shortcut icon" href="../favicon.png" />
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="../assets/css/chosen.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />

		<link rel="stylesheet" href="../assets/css/style.css" class="ace-main-stylesheet" id="main-ace-style" />

		<script src="../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if ('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<!-- tabel scripts -->
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="../assets/js/bootstrap-timepicker.min.js"></script>
		<script src="../assets/js/dataTables.buttons.min.js"></script>
		<script src="../assets/js/buttons.flash.min.js"></script>
		<script src="../assets/js/buttons.html5.min.js"></script>
		<script src="../assets/js/buttons.print.min.js"></script>
		<script src="../assets/js/buttons.colVis.min.js"></script>
		<script src="../assets/js/dataTables.select.min.js"></script>



		<script src="../assets/js/chosen.jquery.min.js"></script>

		<script src="../assets/js/bootstrap-datepicker.min.js"></script>

		<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<script src="../assets/js/ckeditor/ckeditor.js"></script>
		<script src="../assets/js/Chart.bundle.js"></script>

	</head>
<?php } ?>

<body class="no-skin">
	<div id="navbar" class="navbar navbar-default          ace-save-state">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="navbar-header pull-left">
				<a href="#" class="navbar-brand">
					<small>
						E-Kinerja - <?= $nama_aplikasi ?>
					</small>
				</a>
			</div>

			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">

					<li class="light-blue dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<?php

							if (($_SESSION['level']) == "Operator") {
								$link = "../file/foto_user/";
							} else {
								$link = "../file/foto_karyawan/";
							}

							?>
							<img class="nav-user-photo" src="<?= $link . $_SESSION['foto'] ?>" alt=" Jason's Photo" />
							<span class="user-info">
								<small>Selamat Datang,</small>
								<?= $_SESSION['nama_pengguna'] ?>
							</span>

							<i class="ace-icon fa fa-caret-down"></i>
						</a>
						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<li>
								<a href="?p=referensi&halaman=set_atasan">
									<i class="ace-icon fa fa-user"></i>
									Profil
								</a>
							</li>

							<li class="divider"></li>
							<li>
								<a href="logout.php">
									<i class="ace-icon fa fa-power-off"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-container -->
	</div>
	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>

		<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
			<script type="text/javascript">
				try {
					ace.settings.loadState('sidebar')
				} catch (e) {}
			</script>

			<div class="sidebar-shortcuts" id="sidebar-shortcuts">
				<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					<button class="btn btn-success">
						<i class="ace-icon fa fa-signal"></i>
					</button>

					<button class="btn btn-info">
						<i class="ace-icon fa fa-pencil"></i>
					</button>

					<button class="btn btn-warning">
						<i class="ace-icon fa fa-users"></i>
					</button>

					<button class="btn btn-danger">
						<i class="ace-icon fa fa-cogs"></i>
					</button>
				</div>

				<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
					<span class="btn btn-success"></span>

					<span class="btn btn-info"></span>

					<span class="btn btn-warning"></span>

					<span class="btn btn-danger"></span>
				</div>
			</div><!-- /.sidebar-shortcuts -->
			<?php
			$level = escape($_SESSION['level']);
			if ($level == "Operator") {
				include "template/menu_admin.php";
			} elseif ($level == "Karyawan") {
				include "template/menu_karyawan.php";
			}
			?>
			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>