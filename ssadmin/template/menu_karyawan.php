<ul class="nav nav-list">
					
		<li class="<?php if(isset($_GET['p']) && $_GET['p'] =="") echo "active"?>">
			<a href="?">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text"> Beranda </span>
			</a>
			<b class="arrow"></b>
		</li>
		<li class="<?php if(isset($_GET['p']) && $_GET['p'] =="referensi") echo "active"?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-desktop"></i>
				<span class="menu-text">
					Referensi
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="<?php if(isset($_GET['halaman']) && $_GET['halaman'] =="set_atasan") echo "active"?>">
					<a href="?p=referensi&halaman=set_atasan">
						<i class="menu-icon fa fa-caret-right"></i>
						Set Atasan
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
		<li class="<?php if(isset($_GET['p']) && $_GET['p'] =="laporan_saya") echo "active"?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-book"></i>
				<span class="menu-text">
					Laporan Saya
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="<?php if(isset($_GET['halaman']) && $_GET['halaman'] =="laporan_harian") echo "active"?>">
					<a href="?p=laporan_saya&halaman=laporan_harian">
						<i class="menu-icon fa fa-caret-right"></i>
						Laporan Harian
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?php if(isset($_GET['halaman']) && $_GET['halaman'] =="riwayat_laporan") echo "active"?>">
					<a href="?p=laporan_saya&halaman=riwayat_laporan">
						<i class="menu-icon fa fa-caret-right"></i>
						Riwayat Laporan
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>

		<li class="<?php if(isset($_GET['p']) && $_GET['p'] =="laporan_bawahan") echo "active"?>">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-book"></i>
				<span class="menu-text">
					Laporan Bawahan
				</span>
				<b class="arrow fa fa-angle-down"></b>
			</a>
			<b class="arrow"></b>
			<ul class="submenu">
				<li class="<?php if(isset($_GET['halaman']) && $_GET['halaman'] =="harian_bawahan") echo "active"?>">
					<a href="?p=laporan_bawahan&halaman=harian_bawahan">
						<i class="menu-icon fa fa-caret-right"></i>
						Laporan Harian
					</a>
					<b class="arrow"></b>
				</li>
			</ul>
		</li>
	

		

	</ul><!-- /.nav-list -->

