<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:../index.php");
    exit();
}
$username = $_SESSION['session_username'];
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
    $ja = "Guru";
    $query = mysqli_query($koneksi, "SELECT * FROM presensi_guru where id_guru = '$nis' ORDER BY id_presensi DESC");
} else if (!empty($r2['id_siswa'])) {
    $nama = $r2['nama'];
    $nis = $r2['id_siswa'];
    $jk = $r2['jk'];
    $tl = $r2['tgl_lhr'];
    $ja = "Siswa";
    $query = mysqli_query($koneksi, "SELECT * FROM presensi_siswa where id_siswa = '$nis' ORDER BY id_presensi DESC");
} else {
    header("location:../history-admin/history.php");
    exit();
}

if (isset($_POST['update'])) {
    while ($data = mysqli_fetch_array($query)) {
        if ($ja == "Siswa") {
            if (isset($_POST['status' . $data['id_presensi']]) && isset($_POST['validate' . $data['id_presensi']]) && isset($_POST['id_presensi' . $data['id_presensi']])) {
                mysqli_query($koneksi, "update presensi_siswa set status = '{$_POST['status' .$data['id_presensi']]}', valid = '{$_POST['validate' .$data['id_presensi']]}' where id_presensi = '{$_POST['id_presensi' .$data['id_presensi']]}'");
                $alert = "Presensi siswa berhasil dilakukan";
            } else {
                $alert = "Presensi siswa tidak berhasil dilakukan";
            }
        } elseif ($ja == "Guru") {
            if (isset($_POST['status' . $data['id_presensi']]) && isset($_POST['validate' . $data['id_presensi']]) && isset($_POST['id_presensi' . $data['id_presensi']])) {
                mysqli_query($koneksi, "update presensi_guru set status = '{$_POST['status' .$data['id_presensi']]}', valid = '{$_POST['validate' .$data['id_presensi']]}' where id_presensi = '{$_POST['id_presensi' .$data['id_presensi']]}'");
                $alert = "Presensi guru berhasil dilakukan";
            } else {
                $alert = "Presensi guru tidak berhasil dilakukan";
            }
        } else {
            $alert = "Presensi tidak berhasil dilakukan";
        }
    }
    header("location:../history-admin/history.php");
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
                <a href="../history-admin/history.php">Kembali</a>
            </div>
            <div class="title">
                <h2>Riwayat Presensi</h2>
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

            <table class="table" border="1">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>keterangan</th>
                        <th>Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                        while ($user_data = mysqli_fetch_array($query)) {
                            $status = '                            
                        <label for="hadir' . $user_data['id_presensi'] . '"><input type="radio" id="hadir' . $user_data['id_presensi'] . '" name="status' . $user_data['id_presensi'] . '" value="hadir">Hadir</label>                    
                        <label for="sakit' . $user_data['id_presensi'] . '"><input type="radio" id="sakit' . $user_data['id_presensi'] . '" name="status' . $user_data['id_presensi'] . '" value="sakit">Sakit</label>                        
                        <label for="izin' . $user_data['id_presensi'] . '"><input type="radio" id="izin' . $user_data['id_presensi'] . '" name="status' . $user_data['id_presensi'] . '" value="izin">Izin</label>
                        <label for="alpha' . $user_data['id_presensi'] . '"><input type="radio" id="alpha' . $user_data['id_presensi'] . '" name="status' . $user_data['id_presensi'] . '" value="alpha">Alpha</label>
                        ';
                            $validate = '
                        <label for="not_yet' . $user_data['id_presensi'] . '"><input type="radio" id="not_yet' . $user_data['id_presensi'] . '" name="validate' . $user_data['id_presensi'] . '" value="NY">NOT YET</label>                    
                        <label for="no' . $user_data['id_presensi'] . '"><input type="radio" id="no' . $user_data['id_presensi'] . '" name="validate' . $user_data['id_presensi'] . '" value="N">NO</label>                        
                        <label for="yes' . $user_data['id_presensi'] . '"><input type="radio" id="yes' . $user_data['id_presensi'] . '" name="validate' . $user_data['id_presensi'] . '" value="Y">YES</label>
                        ';
                            $tgl = date("l, d M Y", strtotime($user_data['tgl_presensi']));
                            echo "<input type=\"hidden\" name=\"id_presensi" . $user_data['id_presensi'] . "\" value=\"" . $user_data['id_presensi'] . "\">";
                            echo "<tr>";
                            echo "<td>" . $tgl . "</td>";
                            echo "<td>" . $user_data['status'] . $status . "</td>";
                            echo "<td> <a href=\"../berkas/" . $user_data['keterangan'] . "\" target=\"_blank\" rel=\"noopener noreferrer\">" . $user_data['keterangan'] . "</a> </td>";
                            echo "<td>" . $user_data['valid'] . $validate . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        <input type="submit" name="update" value="Submit" class="submit" />
                    </form>;
                </tbody>
            </table>
            <div>
                <h3>
                    <?php
                    if (isset($alert)) {
                        echo $alert;
                    }
                    ?>
                </h3>
            </div>
        </div>
    </div>
</body>

</html>