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

// $ingataku   = "";
$query = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_siswa = '$username'");
while ($user_data = mysqli_fetch_array($query)) {
    $nama = $user_data['nama'];
    $nis = $user_data['id_siswa'];
    $jk = $user_data['jk'];
    $tl = $user_data['tgl_lhr'];
    $ja = "siswa";
    // echo "<tr>";
    // echo "<td><center>" . $user_data['nama'] . "</center></td>";
    // echo "<td><center>" . $user_data['id_siswa'] . "</center></td>";
    // echo "<td><center>" . $user_data['jk'] . "</center></td>";
    // echo "<td><center>" . $user_data['tgl_lhr'] . "</center></td>";
    // echo "<td><center>" . "siswa" . "</center></td>";
    // echo "</tr>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="../assets/logo-all.svg">
            </div>
            <div class="title">
                <h1>Sistem Informasi Presensi</h1>
            </div>
            <div class="avatar">
                <img class="rect" src="../assets/ic_profile.png">
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
            <a href="../main/main.php">Presensi</a>
            <div class="title">
                <h2>Profil Akun</h2>
            </div>
            <div class="profile">
                <img src="../assets/Screenshot (1042).png" class="image">
                <ul class="wrapper">
                    <ul class="hint">
                        <li>
                            <h4>Nama :</h4>
                        </li>
                        <li>
                            <h4>NIS :</h4>
                        </li>
                        <li>
                            <h4>Jenis Kelamin :</h4>
                        </li>
                        <li>
                            <h4>TL :</h4>
                        </li>
                        <li>
                            <h4>Jenis Akun :</h4>
                        </li>
                    </ul>
                    <ul class="userdata">
                        <li>
                            <h3>
                                <?php
                                echo "$nama";
                                ?>
                            </h3>
                        </li>
                        <li>
                            <h3>
                                <?php
                                echo "$nis";
                                ?>
                            </h3>
                        </li>
                        <li>
                            <h3>
                                <?php
                                echo "$jk";
                                ?>
                            </h3>
                        </li>
                        <li>
                            <h3>
                                <?php
                                echo "$tl";
                                ?>
                            </h3>
                        </li>
                        <li>
                            <h3>
                                <?php
                                echo "$ja";
                                ?>
                            </h3>
                        </li>
                    </ul>
                </ul>
            </div>
            <!-- <table class="table" border=2>
                <tr>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Jenis Kelamin</th>
                    <th>TTL</th>
                    <th>Jenis Akun</th>
                </tr>

                <?php
                // while ($user_data = mysqli_fetch_array($query)) {
                //     echo "<tr>";
                //     echo "<td><center>" . $user_data['nama'] . "</center></td>";
                //     echo "<td><center>" . $user_data['id_siswa'] . "</center></td>";
                //     echo "<td><center>" . $user_data['jk'] . "</center></td>";
                //     echo "<td><center>" . $user_data['tgl_lhr'] . "</center></td>";
                //     echo "<td><center>" . "siswa" . "</center></td>";
                //     echo "</tr>";
                // }
                ?>
            </table> -->
        </div>
</body>

</html>