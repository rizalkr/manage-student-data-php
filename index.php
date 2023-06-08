<?php 
session_start();

if(!isset($_SESSION["loged"])){
    header('Location: ./users/login.php');
    exit;
}



require './func/functions.php';

$jumlahDataPerhalaman = 4;
$jumlahData = count(query("SELECT * FROM tbl_mhs"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman); //Nb : ceil berfungsi untuk membukatkan keatas contoh: 1,2 menjadi 2 -Rizal Kurnia
$halamanActive = (isset($_GET["page"])) ? $_GET["page"] : 1; //Seleksi apakah ada halaman saat pertama login dengan ternary 
$awalData = ($jumlahDataPerhalaman * $halamanActive) - $jumlahDataPerhalaman;


$mahasiswa = query( "SELECT * FROM tbl_mhs LIMIT $awalData, $jumlahDataPerhalaman");
$number = 1;

if(isset($_POST["cari"])){
    $mahasiswa = search($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Laman Admin</title>
</head>
<body>
    <div class="title"><h1>Data Mahasiswa</h1></div>
    <div class="container">
    <div class="container-table"> 

        <!-- Fiture Search -->
        <form action="" method="post">
            <input type="text" name="keyword" id="keyword" 
             autofocus="40" autocomplete="off" placeholder="Cari nama atau nim">
            <button type="hide" name="cari" id="tombol-cari">Search</button> 
        </form>
        
        <a href="./crud/add.php"><button type="submit">Add MHS</button></a>
        <a href="./users/logout.php"><button type="submit">Logout</button></a>

        <!-- Navigasi -->
        <?php if($halamanActive > 1):?>
        <a href="?page=<?= $halamanActive - 1?>"><button type="submit">&laquo;</button></a>
        <?php endif?>
        
        <?php if($halamanActive < $jumlahHalaman):?>
        <a href="?page=<?= $halamanActive + 1?>"><button type="submit">&raquo;</button></a>
        <?php endif?>
        <!-- Navigasi -->

        <div class="table" id="table">
            <table border="1" cellpadding = "10" cellspacing = "0" >
                <tr>
                    <th>No. </th>
                    <th>Image</th>
                    <th>Nim</th>
                    <th>Nama </th>
                    <th>Jurusan</th>
                    <th>Handle</th>
                </tr>
                <?php 
                foreach($mahasiswa as $mhs):?>
                <tr>
                    <td><?= $number + $awalData; ?>.</td>
                    <td>
                        <img src="./img/<?= $mhs['image']?>" alt="belom ada" width="100px">
                    </td>
                    <td><?= $mhs["nim"] ?></td>
                    <td><?= $mhs["nama"] ?></td>
                    <td><?= $mhs["jurusan"] ?></td>
                    <td>
                        <a href="./crud/edit.php?id=<?= $mhs['id_mhs'] ?>"><input type="submit" value="Edit"></a>
                        <a href="./crud/delete.php?id=<?= $mhs['id_mhs'] ?>" 
                        onclick="return confirm('Yakin?')"><input type="submit" value="Delete"></a>
                    </td>
                </tr>
                <?php $number++;?>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    </div>
    <script src="./js/jquery-3.7.0.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>