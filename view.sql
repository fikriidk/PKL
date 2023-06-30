DROP view IF EXISTS `v_lapharian`;

CREATE  VIEW `v_lapharian` AS 
select tharian.*,tkaryawan.nama_lengkap,tkaryawan.atasan1,tkaryawan.atasan2,tsatuan.satuan,tjabatan.jabatan from tharian,tkaryawan,tsatuan,tjabatan where tharian.id_karyawan=tkaryawan.id_karyawan and tharian.id_satuan=tsatuan.id_satuan and tkaryawan.jabatan=tjabatan.id_jabatan;


DROP TABLE IF EXISTS `v_datakaryawan`;

CREATE VIEW `v_datakaryawan` AS select `tkaryawan`.`id_karyawan` AS `id_karyawan`,`tkaryawan`.`nip` AS `nip`,`tkaryawan`.`nama_lengkap` AS `nama_lengkap`,`tkaryawan`.`jabatan` AS `jabatan`,`tkaryawan`.`atasan1` AS `atasan1`,`tkaryawan`.`atasan2` AS `atasan2`,`tkaryawan`.`password` AS `password`,`tkaryawan`.`status` AS `status`,`tkaryawan`.`level` AS `level`,`tkaryawan`.`foto` AS `foto`,`tkaryawan`.`tgl_simpan` AS `tgl_simpan`,`tjabatan`.`jabatan` AS `jabatan1` from (`tkaryawan` join `tjabatan`) where (`tkaryawan`.`jabatan` = `tjabatan`.`id_jabatan`);
