<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {	
	$Stat_deyisikliyi_Id   =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']); 	

	$Stat_Deyisiklik_Sor=$db->prepare("SELECT * FROM  stat_deyisikliyi where Stat_deyisikliyi_Id=:Stat_deyisikliyi_Id");
	$Stat_Deyisiklik_Sor->execute(array(
		'Stat_deyisikliyi_Id'=>$Stat_deyisikliyi_Id));
	$Stat_Deyisiklik_Say=$Stat_Deyisiklik_Sor->rowCount();
	$Stat_Deyisiklik_Cek=$Stat_Deyisiklik_Sor->fetch(PDO::FETCH_ASSOC);

	$ID=$Stat_Deyisiklik_Cek['ID'];
	$Islediyi_Idare_Faktiki=$Stat_Deyisiklik_Cek['Islediyi_Idare_Faktiki'];
	$Islediyi_Sobe_Faktiki=$Stat_Deyisiklik_Cek['Islediyi_Sobe_Faktiki'];
	$Vezife_Id_Faktiki=$Stat_Deyisiklik_Cek['Vezife_Id_Faktiki'];
	$User_Is_Novu_Faktiki=$Stat_Deyisiklik_Cek['User_Is_Novu_Faktiki'];
	$Vezifeye_Teyin_Etme_Tarixi_Faktiki=$Stat_Deyisiklik_Cek['Vezifeye_Teyin_Etme_Tarixi_Faktiki'];
	$Bos_Vezife_Durum=$Stat_Deyisiklik_Cek['Bos_Vezife_Durum'];
	$Intizam_Tenbehi_Id=$Stat_Deyisiklik_Cek['Intizam_Tenbehi_Id'];
	$bos="";


	$idare_Sor=$db->prepare("SELECT * FROM  idare where Idare_Id=:Idare_Id ");
	$idare_Sor->execute(array(
		'Idare_Id'=>$Islediyi_Idare_Faktiki));
	$Idare_Say=$idare_Sor->rowCount();
	$Idare_Cek=$idare_Sor->fetch(PDO::FETCH_ASSOC);
	$Idare_Adi=$Idare_Cek['Idare_Adi'];

	$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id ");
	$Sobe_Sor->execute(array(
		'Sobe_Id'=>$Islediyi_Sobe_Faktiki));
	$Sobe_Say=$Sobe_Sor->rowCount();
	$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
	$Sobe_Adi=$Sobe_Cek['Sobe_Ad'];

	$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id ");
	$Vezife_Sor->execute(array(
		'Vezife_Id'=>$Vezife_Id_Faktiki));
	$Vezife_Say=$Vezife_Sor->rowCount();
	$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];


	$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id ");
	$Vezife_Adlari_Sor->execute(array(
		'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
	$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Adi=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];


	if ($Stat_Deyisiklik_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgünd secilmeyib">';
		exit;
	}else{
		$sil = $db->prepare("DELETE from stat_deyisikliyi where Stat_deyisikliyi_Id=:Stat_deyisikliyi_Id");
		$kontrol = $sil->execute(array(
			'Stat_deyisikliyi_Id'=>$Stat_deyisikliyi_Id
		));	

		if ($kontrol) {
			$update=$db->prepare("UPDATE user SET
				Islediyi_Idare_Id=:Islediyi_Idare_Id,
				Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
				Vezife_Id=:Vezife_Id,
				Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi,
				Idare_Ad=:Idare_Ad,
				Sobe_Ad=:Sobe_Ad,
				Vezife_Ad=:Vezife_Ad,
				Is_Novu=:Is_Novu
				where ID=$ID
				");
			$yenile=$update->execute(array(
				'Islediyi_Idare_Id'=>$Islediyi_Idare_Faktiki,
				'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Faktiki,
				'Vezife_Id'=>$Vezife_Id_Faktiki,
				'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi_Faktiki,
				'Idare_Ad'=>$Idare_Adi,
				'Sobe_Ad'=>$Sobe_Adi,
				'Vezife_Ad'=>$Vezife_Adi,
				'Is_Novu'=>$User_Is_Novu_Faktiki
			));
			if ($yenile) {
				if ($Bos_Vezife_Durum==0) {
					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id				
						where User_Id=$ID
						");
					$yenile=$update->execute(array(
						'User_Id'=>$bos		
					));

					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id				
						where Vezife_Id=$Vezife_Id_Faktiki
						");
					$yenile=$update->execute(array(
						'User_Id'=>$ID		
					));
				}else{
					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id				
						where User_Id=$ID
						");
					$yenile=$update->execute(array(
						'User_Id'=>$bos		
					));

					$Elave_Et=$db->prepare("INSERT INTO bosvezife SET
						ID=:ID, 
						Vezife_Id=:Vezife_Id
						");
					$Insert=$Elave_Et->execute(array(
						'ID'=>$ID,
						'Vezife_Id'=>$Vezife_Id_Faktiki						
					));
				}
				$Islediyi_Vezife_Sor=$db->prepare("SELECT * FROM user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi DESC");
				$Islediyi_Vezife_Sor->execute(array(
					'ID'=>$ID));
				$Islediyi_Vezife_Say=$Islediyi_Vezife_Sor->rowCount();
				$Islediyi_Vezife_Cek=$Islediyi_Vezife_Sor->fetch(PDO::FETCH_ASSOC);
				$User_Islediyi_Vezife_Id=$Islediyi_Vezife_Cek['User_Islediyi_Vezife_Id'];

				$sil = $db->prepare("DELETE from user_islediyi_vezife where User_Islediyi_Vezife_Id=:User_Islediyi_Vezife_Id");
				$kontrol = $sil->execute(array(
					'User_Islediyi_Vezife_Id'=>$User_Islediyi_Vezife_Id
				));	

				$Islediyi_Vezife_Sor=$db->prepare("SELECT * FROM user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi DESC");
				$Islediyi_Vezife_Sor->execute(array(
					'ID'=>$ID));
				$Islediyi_Vezife_Say=$Islediyi_Vezife_Sor->rowCount();
				$Islediyi_Vezife_Cek=$Islediyi_Vezife_Sor->fetch(PDO::FETCH_ASSOC);
				$User_Islediyi_Vezife_Id=$Islediyi_Vezife_Cek['User_Islediyi_Vezife_Id'];

				$update=$db->prepare("UPDATE user_islediyi_vezife SET
					Vezifeden_Azad_Olunma_Tarixi=:Vezifeden_Azad_Olunma_Tarixi					
					where User_Islediyi_Vezife_Id=$User_Islediyi_Vezife_Id
					");
				$yenile=$update->execute(array(
					'Vezifeden_Azad_Olunma_Tarixi'=>$bos				
				));
				if ($Intizam_Tenbehi_Id>0) {
					$sil = $db->prepare("DELETE from intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
					$kontrol = $sil->execute(array(
						'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
					));
				}




			}else{

			}
		}else{
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
			echo '<input type="hidden" id="message" value="Sistem idarəcisinə məlumat verin">';
			exit;
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>