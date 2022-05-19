<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:../index.php");
    exit();
}
$username = $_SESSION['session_username'];
//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

$query = mysqli_query($koneksi, "SELECT * FROM presensi_siswa where id_siswa = '$username' ORDER BY id_presensi ASC");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="../assets/logo-all.png">
            </div>
            <div class="title">
                <h1>Sistem Informasi Presensi</h1>
            </div>
            <div class="avatar">
                <img src="../assets/ic_profile.png">
            </div>
            <div class="dropdown">
                <img class="ic_dd" src="../assets/dropdown.png">
                <div class="hoveran"></div>
                <ul class="dropdownList">
                    <li><a href="../profile/profile.php">Profil</a></li>
                    <li><a href="../history/history.php">Riwayat</a></li>
                    <li><a href="../logout/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="link">
                <a href="../main/main.php">Presensi</a>
            </div>
            <div class="title">
                <h2>Riwayat Presensi</h2>
            </div>
            <table width='80%' border=2>
                <tr>
                    <th>Hari dan Tanggal</th>
                    <th>Status</th>
                    <th>keterangan</th>
                    <th>Validasi</th>
                </tr>

                <?php
                while ($user_data = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td><center>" . $user_data['tgl_presensi'] . "</center></td>";
                    echo "<td><center>" . $user_data['status'] . "</center></td>";
                    echo "<td><center>" . $user_data['keterangan'] . "</center></td>";
                    echo "<td><center>" . $user_data['valid'] . "</center></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>