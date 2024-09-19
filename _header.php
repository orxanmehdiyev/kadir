<?php 
require_once 'Ayarlar/setting.php';
?>
<!DOCTYPE html lang="az">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Free Web tutorials">
	<meta name="keywords" content="HTML, CSS, JavaScript">
	<meta name="author" content="Orxan Mehdiyev">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kadr</title>
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="disk/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="disk/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="disk/select2/select2.css">
	<link rel="stylesheet" type="text/css" href="disk/DataTables/datatables.css"/>
	<link rel="stylesheet" type="text/css" href="disk/jquery-ui-1.13.0/jquery-ui.css"/>
	<link rel="stylesheet" type="text/css" href="disk/css/kadr.css">
	<link rel="stylesheet" type="text/css" href="disk/css/style.css">	
	<script src="disk/jquery/jquery36.js"></script> 
	<script src="js/script.js"></script> 	
</head>
<body>	
	<header>		
	
		<div id="tesdiqvehansimenu">
			<div id="SeyfeAdi"></div>
			<div id="cavabid" style="color:#00ff00"></div>			
		</div>
		<div id="melumatalani">
			<div id="cixisalani">
				<a href="Islem/cixis.php"><img class="hedaericon" src="disk/img/power.png"></a>						
				<img class="hedaericon" src="disk/img/question.png">
				<a href="./"><img class="hedaericon" src="disk/img/home.png"></a>

			</div>		
			<div id="itifadecimelumat">
				<span><?php echo $Admin_Idare_Kissa_Adi ?></span></br>
				<span id="vezife"><?php echo $Admin_Vezife_Ad ?></span></br>
				<span><?php echo $Admin_Soyad." ".$Admin_Ad." ".$Admin_Ataadi ?></span>		
			</div>
		</div>
	</header>
	<?php   
	require_once '_modal.php';
	require_once '_menu.php';
?>