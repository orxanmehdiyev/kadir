<?php 
require_once '../Ayarlar/setting.php';
if ($BasIdareAktivPassiv==1) {
if (isset($_POST['Deyer'])) {
	$Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Id=:Id");
	$Sor->execute(array(
		'Id'=>$Id));
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		if ($Cek['Durum']==0) {
			$Durum=1;
		}else{
			$Durum=0;
		}
		$yenile = $db->prepare("UPDATE tabeli_qurumlar_ve_bas_idareler SET     
			Durum=:Durum
			WHERE Id=$Id");
		$update = $yenile->execute(array(     
			'Durum'=>$Durum
		));
		if ($update) {	
			$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Id=:Id");
			$Sor->execute(array(
				'Id'=>$Id));
			$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
			$Elave_Et=$db->prepare("INSERT INTO tabeli_qurumlar_ve_bas_idareler_islemleri SET
				Durum=:Durum,			
				Islem_Edilen_Id=:Islem_Edilen_Id,			
				TarixSaat=:TarixSaat,
				ZamanDamgasi=:ZamanDamgasi,
				Seo_Url=:Seo_Url,
				IPAdresi=:IPAdresi,
				Admin_Id=:Admin_Id,
				Adi=:Adi
				");
			$Insert=$Elave_Et->execute(array(
				'Durum'=>$Durum,				
				'Islem_Edilen_Id'=>$Id,				
				'TarixSaat'=>$TarixSaat,
				'ZamanDamgasi'=>$ZamanDamgasi,
				'Seo_Url'=>$Cek['Seo_Url'],
				'IPAdresi'=>$IPAdresi,
				'Admin_Id'=>$Admin_Id,
				'Adi'=>$Cek['Adi']
			));
		}
	}
}else{
	header("Location:../login.php");
	exit;
} 
}
?>