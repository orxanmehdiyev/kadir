<?php 
session_start(); ob_start();
require_once '../Ayarlar/baglan.php';
require_once '../Ayarlar/function.php';
$User_Sor=$db->prepare("SELECT * FROM user where User_Id=:User_Id ");
$User_Sor->execute(array(
	'User_Id'=>$_SESSION['user']));
$say=$User_Sor->rowCount();
if ($say==1) {
	if (isset($_POST['tesdiqle'])) {
		$Ise_Qebul_Emri_Id  =ReqemlerXaricButunKarakterleriSil($_POST['tesdiqle']); 
		$Ise_Qebul_Emri_Tesdiqle=$db->prepare("SELECT * FROM ise_qebul_emri where Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id and Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu");
		$Ise_Qebul_Emri_Tesdiqle->execute(array(
			'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id,
			'Ise_Qebul_Emri_Stausu'=>0));
		$say=$Ise_Qebul_Emri_Tesdiqle->rowCount();
		if ($say==1) {
			$Ise_Qebul_Emri_TesdiqleCek=$Ise_Qebul_Emri_Tesdiqle->fetch(PDO::FETCH_ASSOC);
			$Ise_Qebul_Emri_Id                =$Ise_Qebul_Emri_TesdiqleCek['Ise_Qebul_Emri_Id'];  
			$User_Soy_Ad                      =$Ise_Qebul_Emri_TesdiqleCek['User_Soy_Ad'];
			$User_Ad                          =$Ise_Qebul_Emri_TesdiqleCek['User_Ad'];     
			$User_Ata_Ad                      =$Ise_Qebul_Emri_TesdiqleCek['User_Ata_Ad'];      
			$User_Dogum_Tarixi                =$Ise_Qebul_Emri_TesdiqleCek['User_Dogum_Tarixi'];
			$User_Fin                         =$Ise_Qebul_Emri_TesdiqleCek['User_Fin'];
			$User_Yasayis_Unvan               =$Ise_Qebul_Emri_TesdiqleCek['User_Yasayis_Unvan'];
			$User_Tehsil                      =$Ise_Qebul_Emri_TesdiqleCek['User_Tehsil'];
			$User_Tehsil_Aldigi_Muesse        =$Ise_Qebul_Emri_TesdiqleCek['User_Tehsil_Aldigi_Muesse'];
			$Ixtisas                          =$Ise_Qebul_Emri_TesdiqleCek['Ixtisas'];
			$User_Ise_Qebul_Tarixi            =$Ise_Qebul_Emri_TesdiqleCek['User_Ise_Qebul_Tarixi'];
			$Usre_Cinsiyeti                   =$Ise_Qebul_Emri_TesdiqleCek['Usre_Cinsiyeti'];
			$User_Is_Novu                     =$Ise_Qebul_Emri_TesdiqleCek['User_Is_Novu'];
			$Ise_Qebul_Emri_Nomresi           =$Ise_Qebul_Emri_TesdiqleCek['Ise_Qebul_Emri_Nomresi'];
			$User_Ise_Qebul_Esas              =$Ise_Qebul_Emri_TesdiqleCek['User_Ise_Qebul_Esas'];
			$User_Islediyi_Idare              =$Ise_Qebul_Emri_TesdiqleCek['User_Islediyi_Idare'];
			$User_Islediyi_Sobe_Bolme         =$Ise_Qebul_Emri_TesdiqleCek['User_Islediyi_Sobe_Bolme'];
			$User_Vezife                      =$Ise_Qebul_Emri_TesdiqleCek['User_Vezife'];
			$Seo_Url                          =$Ise_Qebul_Emri_TesdiqleCek['Seo_Url'];
			$yenile = $db->prepare("UPDATE ise_qebul_emri SET  
				Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu
				WHERE Ise_Qebul_Emri_Id=$Ise_Qebul_Emri_Id");
			$update = $yenile->execute(array( 
				'Ise_Qebul_Emri_Stausu'=>1
			));  
			if ($update) {
				$Elave_Et=$db->prepare("INSERT INTO ise_qebul_emri_islemleri SET
					Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id, 
					Sebeb=:Sebeb, 
					User_Soy_Ad=:User_Soy_Ad, 
					User_Ad=:User_Ad,        
					User_Ata_Ad=:User_Ata_Ad,        
					User_Dogum_Tarixi=:User_Dogum_Tarixi,
					User_Fin=:User_Fin,
					User_Yasayis_Unvan=:User_Yasayis_Unvan,
					User_Tehsil=:User_Tehsil,
					User_Tehsil_Aldigi_Muesse=:User_Tehsil_Aldigi_Muesse,
					Ixtisas=:Ixtisas,
					User_Ise_Qebul_Tarixi=:User_Ise_Qebul_Tarixi,
					Usre_Cinsiyeti=:Usre_Cinsiyeti,
					User_Is_Novu=:User_Is_Novu,
					Ise_Qebul_Emri_Nomresi=:Ise_Qebul_Emri_Nomresi,
					User_Ise_Qebul_Esas=:User_Ise_Qebul_Esas,
					User_Islediyi_Idare=:User_Islediyi_Idare,
					User_Islediyi_Sobe_Bolme=:User_Islediyi_Sobe_Bolme,
					User_Vezife=:User_Vezife,
					ZamanDamgasiI=:ZamanDamgasiI,
					Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu,
					Seo_Url=:Seo_Url,
					Islem_Eden_User_Id=:Islem_Eden_User_Id
					");
				$Insert=$Elave_Et->execute(array(
					'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id ,  
					'Sebeb'=>3,  
					'User_Soy_Ad'=>$User_Soy_Ad,  
					'User_Ad'=>$User_Ad,        
					'User_Ata_Ad'=>$User_Ata_Ad,        
					'User_Dogum_Tarixi'=>$User_Dogum_Tarixi,
					'User_Fin'=>$User_Fin,
					'User_Yasayis_Unvan'=>$User_Yasayis_Unvan,
					'User_Tehsil'=>$User_Tehsil,
					'User_Tehsil_Aldigi_Muesse'=>$User_Tehsil_Aldigi_Muesse,
					'Ixtisas'=>$Ixtisas,
					'User_Ise_Qebul_Tarixi'=>$User_Ise_Qebul_Tarixi,
					'Usre_Cinsiyeti'=>$Usre_Cinsiyeti,
					'User_Is_Novu'=>$User_Is_Novu,
					'Ise_Qebul_Emri_Nomresi'=>$Ise_Qebul_Emri_Nomresi,
					'User_Ise_Qebul_Esas'=>$User_Ise_Qebul_Esas,
					'User_Islediyi_Idare'=>$User_Islediyi_Idare,
					'User_Islediyi_Sobe_Bolme'=>$User_Islediyi_Sobe_Bolme,
					'User_Vezife'=>$User_Vezife,
					'ZamanDamgasiI'=>$ZamanDamgasi,
					'Ise_Qebul_Emri_Stausu'=>1,
					'Seo_Url'=>$Seo_Url,
					'Islem_Eden_User_Id'=>$_SESSION['user']
				));
				if ($Insert) {
					$Elave_Et=$db->prepare("INSERT INTO user SET
						User_Soy_Ad=:User_Soy_Ad, 
						User_Ad=:User_Ad, 
						User_Ata_Ad=:User_Ata_Ad, 
						User_Fin=:User_Fin, 
						Usre_Cinsiyeti=:Usre_Cinsiyeti, 
						User_Dogum_Tarixi=:User_Dogum_Tarixi, 
						User_Yasayis_Unvan=:User_Yasayis_Unvan, 
						User_Ise_Qebul_ZamanDamgasi=:User_Ise_Qebul_ZamanDamgasi, 
						User_Tehsil=:User_Tehsil, 
						User_Tehsil_Aldigi_Muesse=:User_Tehsil_Aldigi_Muesse, 
						Ixtisas	=:Ixtisas, 
						User_Islediyi_Idare=:User_Islediyi_Idare, 
						User_Islediyi_Sobe_Bolme=:User_Islediyi_Sobe_Bolme, 
						User_Isleme_Durumu=:User_Isleme_Durumu, 
						User_Vezife=:User_Vezife, 
						User_Seo_Url=:User_Seo_Url, 
						User_Is_Novu=:User_Is_Novu, 
						User_Ise_Qebul_Esas=:User_Ise_Qebul_Esas, 
						Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id, 
						Ise_Qebul_Emri_Nomresi=:Ise_Qebul_Emri_Nomresi

						");
					$Insert=$Elave_Et->execute(array(
						'User_Soy_Ad'=>$User_Soy_Ad ,  
						'User_Ad'=>$User_Ad ,  
						'User_Ata_Ad'=>$User_Ata_Ad ,  
						'User_Fin'=>$User_Fin ,  
						'Usre_Cinsiyeti'=>$Usre_Cinsiyeti ,  
						'User_Dogum_Tarixi'=>$User_Dogum_Tarixi ,  
						'User_Yasayis_Unvan'=>$User_Yasayis_Unvan ,  
						'User_Ise_Qebul_ZamanDamgasi'=>$User_Ise_Qebul_Tarixi ,  
						'User_Tehsil'=>$User_Tehsil ,  
						'User_Tehsil_Aldigi_Muesse'=>$User_Tehsil_Aldigi_Muesse,  
						'Ixtisas'=>$Ixtisas,  
						'User_Islediyi_Idare'=>$User_Islediyi_Idare ,  
						'User_Islediyi_Sobe_Bolme'=>$User_Islediyi_Sobe_Bolme ,  
						'User_Isleme_Durumu'=>0 ,  
						'User_Vezife'=>$User_Vezife ,  
						'User_Seo_Url'=>$Seo_Url ,  
						'User_Is_Novu'=>$User_Is_Novu ,  
						'User_Ise_Qebul_Esas'=>$User_Ise_Qebul_Esas ,  
						'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id ,  
						'Ise_Qebul_Emri_Nomresi'=>$Ise_Qebul_Emri_Nomresi 
					));


				}else{
					echo "error_3002";/*Ise qebul emir islemlerine inser getmedi*/
					exit;
				}
			}else{
				echo "error_3002";/*Ise Qebul Emrinde Yenilenme getmedi*/
				exit;
			}
		}else{
			echo "error_3001";/*Bu emir uy]unsuz gelib*/
			exit;
		}
	}else{
		header("Location:../login.php");
		exit;
	}
}else{
	header("Location:../login.php");
	exit;
}


?>