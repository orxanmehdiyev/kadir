<?php
require_once '../Ayarlar/setting.php';
if (isset($_POST)) {
	$ID                      =  $_POST['ID'];
	$Tarix                   = date("Y-m-d", strtotime($_POST['gizlitarixbir']));
	$Is_Giris_Saati          =  $_POST['gizlisaatbirbir'];
	$Is_Cixis_Saati          =  $_POST['gizlisaatbiriki'];
	$Is_Rejimi = 3;
	foreach ($ID as $değer) {	
		$User_Sor = $db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
		$User_Sor->execute(array(
			'ID' => $değer,
			'Durum' => 1
		));
		$User_Say = $User_Sor->rowCount();
		$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
		$Soyadi = $User_Cek['Soy_Adi'];
		$Adi = $User_Cek['Adi'];
		$Ataadi = $User_Cek['Ata_Adi'];
		$Idare_Id = $User_Cek['Islediyi_Idare_Id'];
		$Idare_Adi = $User_Cek['Idare_Ad'];
		$Sor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID and Idare_Id=:Idare_Id and Is_Rejimi=:Is_Rejimi and Tarix=:Tarix and Is_Giris_Saati=:Is_Giris_Saati and Is_Cixis_Saati=:Is_Cixis_Saati and Novbe_Sayi=:Novbe_Sayi and Is_Qurupu=:Is_Qurupu");
		$Sor->execute(array(
			'ID' => $değer,
			'Idare_Id' => $Idare_Id,
			'Is_Rejimi' => $Is_Rejimi,
			'Tarix' => $Tarix,
			'Is_Giris_Saati' => $Is_Giris_Saati,
			'Is_Cixis_Saati' => $Is_Cixis_Saati,
			'Novbe_Sayi' => 2,
			'Is_Qurupu' => 1
		));
		$Say = $Sor->rowCount();
		if ($Say == 0) {
			$Elave_Et = $db->prepare("INSERT INTO  is_rejimi SET
				ID=:ID,
				Adi=:Adi,
				Soyadi=:Soyadi,
				Ataadi=:Ataadi,
				Idare_Id=:Idare_Id,
				Idare_Adi=:Idare_Adi,
				Is_Rejimi=:Is_Rejimi,
				Tarix=:Tarix,
				Is_Giris_Saati=:Is_Giris_Saati,	    
				Is_Cixis_Saati=:Is_Cixis_Saati,
				Novbe_Sayi=:Novbe_Sayi,
				Is_Qurupu=:Is_Qurupu
				");
			$Insert = $Elave_Et->execute(array(
				'ID' => $değer,
				'Adi' => $Adi,
				'Soyadi' => $Soyadi,
				'Ataadi' => $Ataadi,
				'Idare_Id' => $Idare_Id,
				'Idare_Adi' => $Idare_Adi,
				'Is_Rejimi' => $Is_Rejimi,
				'Tarix' => $Tarix,
				'Is_Giris_Saati' => $Is_Giris_Saati,
				'Is_Cixis_Saati' => $Is_Cixis_Saati,
				'Novbe_Sayi' => 2,
				'Is_Qurupu' => 1
			));
		}
	}
	exit;
} else {
	header("Location:../intizam_tenbehleri.php");
	exit;
}