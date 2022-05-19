<?php

//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);
//atur variabel
$err        = "";
$username   = "";
// $ingataku   = "";
$query = mysqli_query($koneksi, "SELECT * FROM presensi_siswa ORDER BY id_siswa");

?>
<html>
<head>
  <title>SISTEM PRESENSI</title>
  <p><br><br><center>RIWAYAT PRESENSI</center></br></br></p>
</head>

<body>
<a href="../main/main.php">Presensi</a><br/><br/>
    <table width='80%' border=2>
    <tr>
        <th>TANGGAL</th> <th>STATUS</th> <th>KETERANGAN</th> <th>VALIDASI</th>
    </tr>

    <?php
    while($user_data = mysqli_fetch_array($query)) {
        echo "<tr>";
		echo "<td><center>".$user_data['tgl_presensi']."</center></td>";
		echo "<td><center>".$user_data['status']."</center></td>";
		echo "<td><center>".$user_data['keterangan']."</center></td>";
        echo "<td><center>".$user_data['valid']."</center></td>";
        echo "</tr>";
	}
	?>
	</table>
</body>
</html>

