<?php 
$hosting = "localhost";
$username = "root";
$password = "";
$database = "db_kampus";

$db = mysqli_connect("$hosting", "$username", "$password" , "$database");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }  

function query($query){
    global $db;
    $rows = [];
    $result = mysqli_query($db, $query);

    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function addDbMhs($data){
    global $db;
    $nim = htmlspecialchars($data['nim']);
    $nama = htmlspecialchars($data['nama']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $img = upImg();

    $query = " INSERT INTO tbl_mhs VALUES(
        '', '$nim', '$nama', '$jurusan', '$img'
        )";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function upImg(){
    $imgName = $_FILES["img"]["name"];
    $imgSize = $_FILES["img"]["size"];
    $tmpName = $_FILES["img"]["tmp_name"];
    $dirName = '../img/';

    if($imgSize > 1000000){
        echo "<script>alert('Ukuran File Kegedean')</script>";
        return false;
    }

    move_uploaded_file($tmpName, "$dirName".$imgName);
    return $imgName;
}

function deleteDbMhs($data){
    global $db;
    mysqli_query($db, "DELETE FROM tbl_mhs WHERE id_mhs = $data");
}

function editDbMhs($data){
    global $db;
    $id = $_GET["id"];
    $nim = htmlspecialchars($data['nim']);
    $nama = htmlspecialchars($data['nama']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $img = upImg();

    $query = "UPDATE tbl_mhs SET nim = '$nim', nama = '$nama', jurusan = '$jurusan', image = '$img' WHERE id_mhs = $id ";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function search($keyword){
    $query = "SELECT * FROM tbl_mhs WHERE nim LIKE '$keyword%' OR nama LIKE '$keyword%' OR jurusan LIKE '$keyword%' ";
    return query($query);
}

function register($data){
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password1 = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    $checkUser = mysqli_query($db, "SELECT username FROM users WHERE username = '$username' ");

    if(mysqli_fetch_assoc($checkUser)){
        echo "<script>alert('Username telah terdaftar, silahkan cek kembali')</script>";

        return false;
    }

    // Konfirmasi Password
    if($password1 !== $password2){
        echo "<script>alert('Password tidak cocok')";
        return false;
    }

    $password = password_hash($password1, PASSWORD_DEFAULT);

    mysqli_query($db, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($db);
}
?>