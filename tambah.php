<?php 

session_start();
//jika tidak ada sesi login, maka kembalikan user ke halaman login
if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
} 

require 'functions.php';
//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {
    // untuk debug
    // var_dump($POST); 
    // var_dump($_FILES); die;

    //cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }
    }

    //cek apakah data berhasil ditambahkan atau tidak
    // var_dump(mysqli_affected_rows($conn));
    // if(mysqli_affected_rows($conn)>0) {
    //     echo "Success"; } else {
    //         echo "Failed!";
    //         echo "<br>";
    //         echo mysqli_error($conn);
    //     }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
  
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="nim">Nim : </label>
                <input type="text" name="nim" id="nim" required>
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan">
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit"> Add Data</button>
            </li>
        </ul>
    </form>
</body>
</html>