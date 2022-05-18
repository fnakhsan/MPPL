CREATE DATABASE presensi;
CREATE TABLE tb_siswa(
   id_siswa VARCHAR(16) NOT NULL,
   pw_siswa VARCHAR(16) NOT NULL, 
   nama VARCHAR(40) NOT NULL, 
   jk VARCHAR(3) NOT NULL, 
   alamat VARCHAR(40) NOT NULL, 
   no_hp VARCHAR(15) NOT NULL,
   tgl_lhr DATE, 
   PRIMARY KEY (id_siswa) 
);
CREATE TABLE tb_guru(
   id_guru VARCHAR(16) NOT NULL,
   pw_guru VARCHAR(16) NOT NULL, 
   nama VARCHAR(40) NOT NULL, 
   jk VARCHAR(3) NOT NULL, 
   alamat VARCHAR(40) NOT NULL, 
   no_hp VARCHAR(15) NOT NULL,
   tgl_lhr DATE, 
   PRIMARY KEY (id_guru) 
);
CREATE TABLE presensi_siswa(
   id_presensi INT(11) NOT NULL AUTO_INCREMENT,
   id_siswa VARCHAR(16) NOT NULL, 
   tgl_presensi DATE, 
   'status' VARCHAR(6) NOT NULL, 
   valid VARCHAR(3) NOT NULL, 
   keterangan VARCHAR(255) NOT NULL, 
   PRIMARY KEY (id_presensi) 
);
ALTER TABLE `presensi_siswa` ADD CONSTRAINT `fk_presensi_siswa` FOREIGN KEY (`id_siswa`) REFERENCES `tb_siswa`(`id_siswa`) ON DELETE RESTRICT ON UPDATE CASCADE;