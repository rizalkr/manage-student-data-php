<?php 
require '../func/functions.php';

$jumlahDataPerhalaman = 4;
$halamanActive = (isset($_GET["page"])) ? $_GET["page"] : 1; //Seleksi apakah ada halaman saat pertama login dengan ternary 
$awalData = ($jumlahDataPerhalaman * $halamanActive) - $jumlahDataPerhalaman;

$keyword = $_GET["keyword"];
$query = "SELECT * FROM tbl_mhs WHERE nim LIKE '$keyword%' OR nama LIKE '$keyword%' OR jurusan LIKE '$keyword%' ";
$mahasiswa = query($query);

$number = 1;
?>
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
            <a href="./crud/print.php?id=<?= $mhs['id_mhs'] ?>" target="_blank"><button type="submit">Cetak</button></a>
        </td>
    </tr>
    <?php $number++;?>
    <?php endforeach; ?>
</table>