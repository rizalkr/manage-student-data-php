<?php 
require '../func/functions.php';

$id = $_GET["id"];
$query = "SELECT * FROM tbl_mhs WHERE id_mhs = $id ";
$mahasiswa = query($query);

?>

 <h1 style="text-align: center;">PDF REPORT DATA MAHASIWA</h1>
 <table border="1" cellpadding = "10" cellspacing = "0" style="text-align: center; margin-left: 20%;">
    <tr>
        <th>Nim</th>
        <th>Nama </th>
        <th>Jurusan</th>
    </tr>
    <?php 
    foreach($mahasiswa as $mhs):?>
    <tr>
        <td><?= $mhs["nim"] ?></td>
        <td><?= $mhs["nama"] ?></td>
        <td><?= $mhs["jurusan"] ?></td>
    </tr>
    <?php endforeach; ?>
</table>