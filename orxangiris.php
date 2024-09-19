<?php 
session_start(); ob_start();
require_once 'Ayarlar/baglan.php';
require_once 'Ayarlar/function.php';
      $_SESSION['user']=520;

echo $_SESSION['user'];
header("Location:index.php");

	 ?>