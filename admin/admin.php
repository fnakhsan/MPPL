<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:../index.php");
    exit();
}

if (($_SESSION['session_account'] != "Admin")) {
    header("location:../index.php");
    exit();
}

//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "presensi";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);

$today =  date("Y-m-d");
$query1 = mysqli_query($koneksi, "SELECT * FROM presensi_guru where tgl_presensi = '$today' ORDER BY id_presensi ASC");
$query2 = mysqli_query($koneksi, "SELECT * FROM presensi_siswa where tgl_presensi = '$today' ORDER BY id_presensi ASC");

if (isset($_POST['submitBtn'])) {
    while ($data = mysqli_fetch_array($query2)) {
        if (isset($_POST['validate' . $data['id_presensi']]) && isset($_POST['id_presensi' . $data['id_presensi']])) {
            mysqli_query($koneksi, "update presensi_siswa set valid = '{$_POST['validate' .$data['id_presensi']]}' where id_presensi = '{$_POST['id_presensi' .$data['id_presensi']]}'");
            $alert = "Presensi siswa berhasil dilakukan";
        } else {
            $alert = "Presensi siswa tidak berhasil dilakukan";
        }
    }
    while ($data = mysqli_fetch_array($query1)) {
        if (isset($_POST['validate' . $data['id_presensi']]) && isset($_POST['id_presensi' . $data['id_presensi']])) {
            mysqli_query($koneksi, "update presensi_guru set valid = '{$_POST['validate' .$data['id_presensi']]}' where id_presensi = '{$_POST['id_presensi' .$data['id_presensi']]}'");
            $alert = "Presensi guru berhasil dilakukan";
        } else {
            $alert = "Presensi guru tidak berhasil dilakukan";
        }
    }

    header("location:../history-admin/history.php");
}
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
                    <li><a href="../history-admin/history.php">Riwayat</a></li>
                    <li><a href="../logout/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="title">
                <h2>Presensi Hari Ini</h2>
            </div>
            <div class="today">
                <h3><?php echo $today; ?></h3>
            </div>
            <table class="table" border="1">
                <thead>
                    <tr>
                        <th>NIS / NIP</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="$user_data['id_presensi']">
                        <?php
                        while ($user_data = mysqli_fetch_array($query1)) {
                            echo "<tr>";
                            $validate = '
                            <input type="radio" id="not_yet" name="validate' . $user_data['id_presensi'] . '"value="NY">
                            <label for="not_yet">NOT YET</label><br>
                            <input type="radio" id="no" name="validate' . $user_data['id_presensi'] . '"value="N">
                            <label for="no">NO</label><br>
                            <input type="radio" id="yes" name="validate' . $user_data['id_presensi'] . '"value="Y">
                            <label for="yes">YES</label>
                            ';
                            echo "<input type=\"hidden\" name=\"id_presensi" . $user_data['id_presensi'] . "\" value=\"" . $user_data['id_presensi'] . "\">";
                            echo "<td>" . $user_data['id_guru'] . "</td>";
                            echo "<td>" . $user_data['status'] . "</td>";
                            echo "<td> <a href=\"../berkas/" . $user_data['keterangan'] . "\" target=\"_blank\" rel=\"noopener noreferrer\">" . $user_data['keterangan'] . "</a> </td>";
                            echo "<td>" . $user_data['valid' . $user_data['id_presensi']] . " |" . $validate . "</td>";
                            echo "</tr>";
                        }
                        while ($user_data = mysqli_fetch_array($query2)) {
                            echo "<tr>";
                            $validate = '
                            <input type="radio" id="not_yet" name="validate' . $user_data['id_presensi'] . '"value="NY">
                            <label for="not_yet">NOT YET</label><br>
                            <input type="radio" id="no" name="validate' . $user_data['id_presensi'] . '"value="N">
                            <label for="no">NO</label><br>
                            <input type="radio" id="yes" name="validate' . $user_data['id_presensi'] . '"value="Y">
                            <label for="yes">YES</label>
                            ';
                            echo "<input type=\"hidden\" name=\"id_presensi" . $user_data['id_presensi'] . "\" value=\"" . $user_data['id_presensi'] . "\">";
                            echo "<td>" . $user_data['id_siswa'] . "</td>";
                            echo "<td>" . $user_data['status'] . "</td>";
                            echo "<td> <a href=\"../berkas/" . $user_data['keterangan'] . "\" target=\"_blank\" rel=\"noopener noreferrer\">" . $user_data['keterangan'] . "</a> </td>";
                            echo "<td>" . $user_data['valid'] . " |" . $validate . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        <input type="submit" name="submitBtn" value="Submit" class="submit" />
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
        </form>
    </div>
</body>

</html>