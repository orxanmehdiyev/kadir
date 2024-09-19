<?php 
require_once '../Ayarlar/setting.php';
if ($RutbeAdlariStatus==1) {
if (!isset($_POST['Deyer'])) {
	header("Location:../rutbe_adlari.php");
	exit;
}else{
	$Rutbe_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
	$Rutbe_Sor->execute(array(
		'Rutbe_Id'=>$Rutbe_Id));
	$Rutbe_Say=$Rutbe_Sor->rowCount();
	if ($Rutbe_Say==1) {
		$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
		$Rutbe_Adi=$Rutbe_Cek['Rutbe_Adi'];
		$Rutbe_Pulu=$Rutbe_Cek['Rutbe_Pulu'];
		$Rutbe_Sira_No=$Rutbe_Cek['Rutbe_Sira_No'];
		$Rutbe_Seo_Url=$Rutbe_Cek['Rutbe_Seo_Url'];
		$Rutbe_Xidmet_Ili=$Rutbe_Cek['Rutbe_Xidmet_Ili'];
		if ($Rutbe_Cek['Rutbe_Durum']==0) {
			$Rutbe_Durum=1;
			$Islem_Sebebi=4;
		}else{
			$Rutbe_Durum=0;
			$Islem_Sebebi=5;
		}
		$yenile = $db->prepare("UPDATE rutbe SET     
			Rutbe_Durum=:Rutbe_Durum
			WHERE Rutbe_Id=$Rutbe_Id");
		$update = $yenile->execute(array(     
			'Rutbe_Durum'=>$Rutbe_Durum
		));
		if ($update) {
			$Elave_Et=$db->prepare("INSERT INTO rutbe_islemleri SET
				Rutbe_Id=:Rutbe_Id,
				Rutbe_Adi=:Rutbe_Adi,
				Rutbe_Xidmet_Ili=:Rutbe_Xidmet_Ili,
				Rutbe_Pulu=:Rutbe_Pulu,
				Rutbe_Sira_No=:Rutbe_Sira_No,
				Rutbe_Durum=:Rutbe_Durum,
				TarixSaat=:TarixSaat,
				Admin_Id=:Admin_Id,
				Admin_Ad=:Admin_Ad,
				Admin_Soyad=:Admin_Soyad,
				Admin_Ataadi=:Admin_Ataadi,
				Islem_Sebebi=:Islem_Sebebi,
				Rutbe_Seo_Url=:Rutbe_Seo_Url
				");
			$Insert=$Elave_Et->execute(array(
				'Rutbe_Id'=>$Rutbe_Id,
				'Rutbe_Adi'=>$Rutbe_Adi,
				'Rutbe_Xidmet_Ili'=>$Rutbe_Xidmet_Ili,
				'Rutbe_Pulu'=>$Rutbe_Pulu,
				'Rutbe_Sira_No'=>$Rutbe_Sira_No,
				'Rutbe_Durum'=>$Rutbe_Durum,
				'TarixSaat'=>$TarixSaat,
				'Admin_Id'=>$Admin_Id,
				'Admin_Ad'=>$Admin_Ad,
				'Admin_Soyad'=>$Admin_Soyad,
				'Admin_Ataadi'=>$Admin_Ataadi,
				'Islem_Sebebi'=>$Islem_Sebebi,
				'Rutbe_Seo_Url'=>$Rutbe_Seo_Url
			));
		}else{
		}
	}
}
}
?>