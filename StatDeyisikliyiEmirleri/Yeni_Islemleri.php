<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                           =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Bos_Vezife_Durum             =  ReqemlerXaricButunKarakterleriSil($deyer['Bos_Vezife_Durum']); 
	$Islediyi_Idare_Id            =  ReqemlerXaricButunKarakterleriSil($deyer['Islediyi_Idare']); 
	$Islediyi_Sobe_Id             =  ReqemlerXaricButunKarakterleriSil($deyer['Islediyi_Sobe']); 
	$Vezife_Id                    =  ReqemlerXaricButunKarakterleriSil($deyer['Vezife_Id']); 
	$User_Is_Novu                 =  ReqemlerXaricButunKarakterleriSil($deyer['User_Is_Novu']); 
	$Vezifeye_Teyin_Etme_Emir_No  =  EditorluIcerikleriFiltrle($deyer['Vezifeye_Teyin_Etme_Emir_No']); 
	$Tarixi                       =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Vezifeye_Teyin_Etme_Tarixi']); 
	$Vezifeye_Teyin_Etme_Tarixi   =  TarixBeynelxalqCevir($Tarixi);
	$TarixAzcevir                 =  TarixAzCevir($deyer['Vezifeye_Teyin_Etme_Tarixi']);

	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Islediyi_Idare_Faktiki=$User_Cek['Islediyi_Idare_Id'];
	$Islediyi_Sobe_Faktiki=$User_Cek['Islediyi_Sobe_Id'];
	$Vezife_Id_Faktiki=$User_Cek['Vezife_Id'];
	$User_Is_Novu_Faktiki=$User_Cek['Is_Novu'];
	$Vezifeye_Teyin_Etme_Tarixi_Faktiki=$User_Cek['Vezifeye_Teyin_Tarixi'];

	$bos="";

	$idare_Sor=$db->prepare("SELECT * FROM  idare where Idare_Id=:Idare_Id ");
	$idare_Sor->execute(array(
		'Idare_Id'=>$Islediyi_Idare_Id));
	$Idare_Say=$idare_Sor->rowCount();
	$Idare_Cek=$idare_Sor->fetch(PDO::FETCH_ASSOC);
	$Idare_Adi=$Idare_Cek['Idare_Adi'];

	$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id ");
	$Sobe_Sor->execute(array(
		'Sobe_Id'=>$Islediyi_Sobe_Id));
	$Sobe_Say=$Sobe_Sor->rowCount();
	$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
	$Sobe_Adi=$Sobe_Cek['Sobe_Ad'];

	$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id ");
	$Vezife_Sor->execute(array(
		'Vezife_Id'=>$Vezife_Id));
	$Vezife_Say=$Vezife_Sor->rowCount();
	$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];


	$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id ");
	$Vezife_Adlari_Sor->execute(array(
		'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
	$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Adi=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];


	$Islediyi_Vezife_Sor=$db->prepare("SELECT * FROM user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi DESC");
	$Islediyi_Vezife_Sor->execute(array(
		'ID'=>$ID));
	$Islediyi_Vezife_Say=$Islediyi_Vezife_Sor->rowCount();
	$Islediyi_Vezife_Cek=$Islediyi_Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	$User_Islediyi_Vezife_Id=$Islediyi_Vezife_Cek['User_Islediyi_Vezife_Id'];

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Vezifeye_Teyin_Etme_Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeye_Teyin_Etme_Emir_No">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($Idare_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Islediyi_Idare_Id">';
		echo '<input type="hidden" id="message" value="Idarə secilməyib">';
		exit;
	}elseif($Sobe_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Islediyi_Sobe_Id">';
		echo '<input type="hidden" id="message" value="Şöbə secilməyib">';
		exit;
	}elseif($Vezife_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezife_Id">';
		echo '<input type="hidden" id="message" value="Vəzifə secilməyib">';
		exit;
	}elseif($TarixAzcevir!=$Tarixi){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeye_Teyin_Etme_Tarixi">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarixi düzgün qeyd edilməyib">';
		exit;
	}/*elseif($Vezifeye_Teyin_Etme_Tarixi<$Tarix_Beynelxalq){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeye_Teyin_Etme_Tarixi">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarix faktiki tarixdən kiçik ola bilməz">';
		exit;
	}*/else{
		$Elave_Et=$db->prepare("INSERT INTO stat_deyisikliyi SET
			ID=:ID, 
			Islediyi_Idare=:Islediyi_Idare, 
			Islediyi_Sobe=:Islediyi_Sobe, 
			Vezife_Id=:Vezife_Id, 
			User_Is_Novu=:User_Is_Novu, 
			Vezifeye_Teyin_Etme_Emir_No=:Vezifeye_Teyin_Etme_Emir_No, 
			Vezifeye_Teyin_Etme_Tarixi=:Vezifeye_Teyin_Etme_Tarixi, 
			Islediyi_Idare_Faktiki=:Islediyi_Idare_Faktiki, 
			Islediyi_Sobe_Faktiki=:Islediyi_Sobe_Faktiki, 
			Vezife_Id_Faktiki=:Vezife_Id_Faktiki, 
			User_Is_Novu_Faktiki=:User_Is_Novu_Faktiki, 
			Bos_Vezife_Durum=:Bos_Vezife_Durum, 
			Vezifeye_Teyin_Etme_Tarixi_Faktiki=:Vezifeye_Teyin_Etme_Tarixi_Faktiki 			
			");
		$Insert=$Elave_Et->execute(array(
			'ID'=>$ID,
			'Islediyi_Idare'=>$Islediyi_Idare_Id,
			'Islediyi_Sobe'=>$Islediyi_Sobe_Id,
			'Vezife_Id'=>$Vezife_Id,
			'User_Is_Novu'=>$User_Is_Novu,
			'Vezifeye_Teyin_Etme_Emir_No'=>$Vezifeye_Teyin_Etme_Emir_No,
			'Vezifeye_Teyin_Etme_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi,
			'Islediyi_Idare_Faktiki'=>$Islediyi_Idare_Faktiki,
			'Islediyi_Sobe_Faktiki'=>$Islediyi_Sobe_Faktiki,
			'Vezife_Id_Faktiki'=>$Vezife_Id_Faktiki,
			'User_Is_Novu_Faktiki'=>$User_Is_Novu_Faktiki,
			'Bos_Vezife_Durum'=>$Bos_Vezife_Durum,
			'Vezifeye_Teyin_Etme_Tarixi_Faktiki'=>$Vezifeye_Teyin_Etme_Tarixi_Faktiki
		));

		if ($Insert) {
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
				'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
				'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,
				'Vezife_Id'=>$Vezife_Id,
				'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi,
				'Idare_Ad'=>$Idare_Adi,
				'Sobe_Ad'=>$Sobe_Adi,
				'Vezife_Ad'=>$Vezife_Adi,
				'Is_Novu'=>$User_Is_Novu
			));
			if ($yenile) {
				$update=$db->prepare("UPDATE vezife SET
					User_Id=:User_Id				
					where User_Id=$ID
					");
				$yenile=$update->execute(array(
					'User_Id'=>$bos		
				));

				$update=$db->prepare("UPDATE vezife SET
					User_Id=:User_Id				
					where Vezife_Id=$Vezife_Id
					");
				$yenile=$update->execute(array(
					'User_Id'=>$ID		
				));

				$update=$db->prepare("UPDATE user_islediyi_vezife SET
					Vezifeden_Azad_Olunma_Tarixi=:Vezifeden_Azad_Olunma_Tarixi					
					where User_Islediyi_Vezife_Id=$User_Islediyi_Vezife_Id
					");
				$yenile=$update->execute(array(
					'Vezifeden_Azad_Olunma_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi				
				));
				$Elave_Et=$db->prepare("INSERT INTO user_islediyi_vezife SET
					ID=:ID,			
					Idare_Ad=:Idare_Ad,			
					Sobe_Ad=:Sobe_Ad,			
					Vezife_Ad=:Vezife_Ad,			
					Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi			
					");
				$Insert=$Elave_Et->execute(array(
					'ID'=>$ID,		
					'Idare_Ad'=>$Idare_Adi,		
					'Sobe_Ad'=>$Sobe_Adi,		
					'Vezife_Ad'=>$Vezife_Adi,		
					'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi		
				));

				$sil = $db->prepare("DELETE from bosvezife where ID=:ID");
				$kontrol = $sil->execute(array(
					'ID'=>$ID
				));	


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