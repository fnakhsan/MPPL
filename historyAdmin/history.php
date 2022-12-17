<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:../index.php");
    exit();
}
$username = $_SESSION['session_username'];
$ja = $_SESSION['session_account'];
//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

$query1 = mysqli_query($koneksi, "SELECT id_guru FROM tb_guru ORDER BY id_guru ASC");
$query2 = mysqli_query($koneksi, "SELECT id_siswa FROM tb_siswa ORDER BY id_siswa ASC");

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
            <div class="con">
                <table class="table1" border="1">
                    <thead>
                        <tr>
                            <th>NIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($user_data = mysqli_fetch_array($query1)) {
                            echo "<tr>";
                            echo "<td>" . $user_data['id_guru'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <table class="table2" border="1">
                    <thead>
                        <tr>
                            <th>NIS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($user_data = mysqli_fetch_array($query2)) {
                            echo "<tr>";
                            echo "<td>" . $user_data['id_siswa'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>