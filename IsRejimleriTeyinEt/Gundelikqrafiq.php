<?php
require_once '../Ayarlar/setting.php';
if (isset($_POST)) {
	$ID                      =  $_POST['ID'];
	$Tarix                   = date("Y-m-d", strtotime($_POST['Gundelik_Tarix']));
	$Is_Giris_Saati          =  $_POST['GundelikIs_Giris_Saati'];
	$Is_Cixis_Saati          =  $_POST['GundelikIs_Cixis_Saati'];
	$Is_Rejimi = 2;
	foreach ($ID as $değer) {
		if (isset($_POST['bir_' . $değer])) {
			if (HarflerXaricButunKarakterleriSil($_POST['bir_' . $değer]) == "on") {
				$bir = 0;
			} else {
				$bir = 1;
			};
		} else {
			echo 	$bir = 1;
		}
		if (isset($_POST['iki_' . $değer])) {
			if (HarflerXaricButunKarakterleriSil($_POST['iki_' . $değer]) == "on") {
				$iki = 0;
			} else {
				$iki = 1;
			}
		} else {
			$iki = 1;
		}
		if (isset($_POST['uc_' . $değer])) {
			if (HarflerXaricButunKarakterleriSil($_POST['uc_' . $değer]) == "on") {
				$uc = 0;
			} else {
				$uc = 1;
			}
		} else {
			$uc = 1;
		}
		if (isset($_POST['dord_' . $değer])) {
			if (HarflerXaricButunKarakterleriSil($_POST['dord_' . $değer]) == "on") {
				$dord = 0;
			} else {
				$dord = 1;
			}
		} else {
			$dord = 1;
		}
		if (isset($_POST['bes_' . $değer])) {
			if (HarflerXaricButunKarakterleriSil($_POST['bes_' . $değer]) == "on") {
				$bes = 0;
			} else {
				$bes = 1;
			}
		} else {
			$bes = 1;
		}
		if (isset($_POST['alti_' . $değer])) {
			if (HarflerXaricButunKarakterleriSil($_POST['alti_' . $değer]) == "on") {
				$alti = 0;
			} else {
				$alti = 1;
			}
		} else {
			$alti = 1;
		}
		if (isset($_POST['yeddi_' . $değer])) {
			if (HarflerXaricButunKarakterleriSil($_POST['yeddi_' . $değer]) == "on") {
				$yeddi = 0;
			} else {
				$yeddi = 1;
			}
		} else {
			$yeddi = 1;
		}
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
		$Sor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID and Idare_Id=:Idare_Id and Is_Rejimi=:Is_Rejimi and Tarix=:Tarix and Is_Giris_Saati=:Is_Giris_Saati and Is_Cixis_Saati=:Is_Cixis_Saati and bir=:bir and iki=:iki and uc=:uc and dord=:dord and bes=:bes and alti=:alti and yeddi=:yeddi");
		$Sor->execute(array(
			'ID' => $değer,
			'Idare_Id' => $Idare_Id,
			'Is_Rejimi' => $Is_Rejimi,
			'Tarix' => $Tarix,
			'Is_Giris_Saati' => $Is_Giris_Saati,
			'Is_Cixis_Saati' => $Is_Cixis_Saati,
			'bir' => $bir,
			'iki' => $iki,
			'uc' => $uc,
			'dord' => $dord,
			'bes' => $bes,
			'alti' => $alti,
			'yeddi' => $yeddi
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
				bir=:bir,
				iki=:iki,
				uc=:uc,
				dord=:dord,
				bes=:bes,
				alti=:alti,
				yeddi=:yeddi
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
				'bir' => $bir,
				'iki' => $iki,
				'uc' => $uc,
				'dord' => $dord,
				'bes' => $bes,
				'alti' => $alti,
				'yeddi' => $yeddi
			));
		}
	}
	exit;
} else {
	header("Location:../intizam_tenbehleri.php");
	exit;
}