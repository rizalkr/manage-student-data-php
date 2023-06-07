 <?php 
 require '../func/functions.php';

 $id = $_GET["id"];

 if($id > 0){
    deleteDbMhs($id);
    echo "
    <script>
        alert('Data berhasil dihapus!')
        document.location.href = '../index.php'
    </script>
      ";
    } else {
    echo "
    <script>
        alert('Data gagal dihapus!')
        document.location.href = '../index.php'
    </script>
    ";
 }

 ?>