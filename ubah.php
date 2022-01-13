<?php 
session_start();
//jika tidak ada sesi login, maka kembalikan user ke halaman login
if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
} 

require 'functions.php';

//ambil data di URL
$id = $_GET["id"];
//query data mahasisa berasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
// var_dump($mhs["nama"]);

//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {
    //cek apakah data berhasil diubah atau tidak
    if(ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
</head>
<body>
  
    <h1>Edit Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $mhs["id"];?>">
        <input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"];?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?php echo $mhs["nama"];?>">
            </li>
            <li>
                <label for="nim">Nim : </label>
                <input type="text" name="nim" id="nim" required
                value="<?php echo $mhs["nim"];?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" value="<?php echo $mhs["email"];?>">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" value="<?php echo $mhs["jurusan"];?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <img src="img/<?php echo $mhs['gambar']; ?>" width="40"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit"> Edit Data</button>
            </li>
        </ul>
    </form>
</body>
</html>