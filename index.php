<?php

session_start();
//jika tidak ada sesi login, maka kembalikan user ke halaman login
if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
} 

//menghubungkan halaman index.php dengan function
require 'functions.php';

//Pagination : untuk menambahkan halaman
//Konfirmasi Pagination
$jumlahDataPerHalaman = 4;
//jumlah halaman = total data/ data per halaman
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
//  cari tau sedang ada dihalaman berapa/ hal aktif
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman"); //tampilkan 3 data mulai dari indek ke 2

//tombol cari ditekan
if(isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>

<a href="logout.php">Logout</a>
<h1>Daftar Mahasiswa</h1>

<a href="tambah.php">Add Data Mahasiswa</a>
<!-- untuk enter -->
<br></br>

<form action="" method="post">

    <input type="text" name="keyword" size="30" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol-cari"> Search </button>
</form>

<br></br>

<!-- navigasi -->

<?php if($halamanAktif > 1) : ?> 
    <a href="?halaman=<?php echo $halamanAktif - 1; ?>">&laquo;</a>
<?php endif; ?>

<?php for ($i = 1; $i<= $jumlahHalaman; $i++ ) : ?>
    <?php if( $i == $halamanAktif ) : ?>
    <a href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: red;"><?php echo $i; ?> </a>
    <?php else : ?>
        <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?> </a>
    <?php endif; ?>
<?php endfor; ?>

<?php if($halamanAktif < $jumlahHalaman) : ?> 
    <a href="?halaman=<?php echo $halamanAktif + 1; ?>">&raquo;</a>
<?php endif; ?>

<br>
<div id="container">
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Nim</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>
    <?php $i =1; ?>
    <?php foreach ($mahasiswa as $row): ?>
    <tr>
        <td><?php echo $i;?></td>
        <td>
            <a href="ubah.php?id=<?php echo $row["id"];?>">Edit</a> |
            <a href="hapus.php?id=<?php echo $row["id"];?>" onclick="
                return confirm('Yakin?');">Delete</a>
        </td>
        <td><img src="img/<?php echo $row["gambar"];?>" width="50" alt=""></td>
        <td><?php echo $row["nim"];?></td>
        <td><?php echo $row["nama"];?></td>
        <td><?php echo $row["email"];?></td>
        <td><?php echo $row["jurusan"];?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>
</div>

<!-- Javascript -->
<script src="js/script.js"></script>
</body>
</html>