<?php 
require_once '../Ayarlar/setting.php';
if (!isset($_POST['Deyer'])) {
	header("Location:login.php");
	exit;
}else{
	$deyer =json_decode($_POST['Deyer'],true);
	$Vezife_Adlari_Ad    = $deyer['Vezife_Adlari_Ad']; 
	$Vezife_Adlari_Id  = ReqemlerXaricButunKarakterleriSil($deyer['Vezife_Adlari_Id']);
	if ($Vezife_Adlari_Ad!="") {
		$Vezife_Adlari_Sayi_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Ad=:Vezife_Adlari_Ad and Vezife_Adlari_Id<>:Vezife_Adlari_Id");
		$Vezife_Adlari_Sayi_Sor->execute(array(
			'Vezife_Adlari_Ad'=>$Vezife_Adlari_Ad,
			'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
		$Vezife_Adlari_Sayi_Say=$Vezife_Adlari_Sayi_Sor->rowCount();
		if (!$Vezife_Adlari_Sayi_Say>0) {
			$Vezife_Adlari_Sayi_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Ad=:Vezife_Adlari_Ad and Vezife_Adlari_Id=:Vezife_Adlari_Id");
			$Vezife_Adlari_Sayi_Sor->execute(array(
				'Vezife_Adlari_Ad'=>$Vezife_Adlari_Ad,
				'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
			$Vezife_Adlari_Sayi_Say=$Vezife_Adlari_Sayi_Sor->rowCount();
			if (!$Vezife_Adlari_Sayi_Say>0) {
				$yenile = $db->prepare("UPDATE vezife_adlari SET     
					Vezife_Adlari_Ad=:Vezife_Adlari_Ad
					WHERE Vezife_Adlari_Id=$Vezife_Adlari_Id");
				$update = $yenile->execute(array(     
					'Vezife_Adlari_Ad'=>$Vezife_Adlari_Ad
				)); 
				if ($update) {					
					$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id ");
					$Vezife_Adlari_Sor->execute(array(
						'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
					$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
					$Vezife_Adlari_Durum=$Vezife_Adlari_Cek['Vezife_Adlari_Durum'];
					$Vezife_Adlari_Ad=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];
					$Vezife_Adlari_Sira=$Vezife_Adlari_Cek['Vezife_Adlari_Sira'];				
					$Elave_Et=$db->prepare("INSERT INTO vezife_adlari_islem SET 
						Vezife_Adlari_Id=:Vezife_Adlari_Id, 
						Vezife_Adlari_Ad=:Vezife_Adlari_Ad, 
						Iselem_Eden_User_Id=:Iselem_Eden_User_Id, 
						ZamanDamgasi=:ZamanDamgasi, 
						Vezife_Adlari_Durum=:Vezife_Adlari_Durum, 
						Vezife_Adlari_Sira=:Vezife_Adlari_Sira
						");
					$Insert=$Elave_Et->execute(array(
						'Vezife_Adlari_Id'=>$Vezife_Adlari_Id,  
						'Vezife_Adlari_Ad'=>$Vezife_Adlari_Ad,  
						'Iselem_Eden_User_Id'=>$_SESSION['user'],  
						'ZamanDamgasi'=>$ZamanDamgasi,  
						'Vezife_Adlari_Durum'=>$Vezife_Adlari_Durum,  
						'Vezife_Adlari_Sira'=>$Vezife_Adlari_Sira  
					));
					if ($Insert) {
						echo "1304";/*Yenilenme ugursuz*/
						exit;
					}else{
						echo "error_3004";/*Yenilenme ugursuz*/
						exit;
					}
				}else{
					echo "error_3003";/*Yenilenme ugursuz*/
					exit;
				}
			}else{
				echo "error_3002";/*Vezife adi bazada vad*/
				exit;
			}
		}else{
			echo "error_3001";/*Vezife adi bazada vad*/
			exit;
		}
	}else{
		echo "error_3000";/*Vezife adi bosdur*/
		exit;
	}
}
?>