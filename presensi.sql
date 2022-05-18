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