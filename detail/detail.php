<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:../index.php");
    exit();
}
$username = $_SESSION['session_username'];
$ja = $_SESSION['session_account'];
$id = $_GET['id'];

//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

$sql1 = "select * from tb_guru where id_guru = '$id'";
$sql2 = "select * from tb_siswa where id_siswa = '$id'";
$q1   = mysqli_query($koneksi, $sql1);
$q2   = mysqli_query($koneksi, $sql2);
$r1   = mysqli_fetch_array($q1);
$r2   = mysqli_fetch_array($q2);

if (!empty($r1['id_guru'])) {
    $nama = $r1['nama'];
    $nis = $r1['id_guru'];
    $jk = $r1['jk'];
    $tl = $r1['tgl_lhr'];
} else if (!empty($r2['id_siswa'])) {
    $nama = $r2['nama'];
    $nis = $r2['id_siswa'];
    $jk = $r2['jk'];
    $tl = $r2['tgl_lhr'];
} else {
    header("../historyAdmin/history.php");
    exit();
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
                <img src="../assets/logo-all.png">
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
            <div class="link">
                <a href="../main/main.php">Presensi</a>
            </div>
            <div class="title">
                <h2>Profil Akun</h2>
            </div>
            <div class="profile">
                <img src="../assets/profilepicture.jpg" class="image">
                <ul class="wrapper">
                    <ul class="hint">
                        <li>
                            <h4>Nama :</h4>
                        </li>
                        <li>
                            <h4><?php
                                if ($ja == "Siswa") {
                                    echo "NIS :";
                                } elseif ($ja == "Guru") {
                                    echo "NIP :";
                                }
                                ?>
                            </h4>
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
        </div>
</body>

</html>