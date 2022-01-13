<?php 

session_start();
$_SESSION = [];  //untuk memastikan session benar benar hilang
session_unset(); //untuk memastikan session benar benar hilang
session_destroy();

//cmenghilangkan cookie saat klik logout
setcookie('id', '', time() - 3600);
setcookie('key', '', time()- 3600);

//jika logout diklik, arahkan ke halaman login
header("Location: login.php");
exit;

?>