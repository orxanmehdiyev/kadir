<?php 
require_once '../Ayarlar/setting.php';
if ($IdarelerDurumKontrol==1) {

	if (isset($_POST['Deyer'])) {
		$Idare_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
		$Idare_Sor->execute(array(
			'Idare_Id'=>$Idare_Id));
		$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
		$Ust_Id=$Idare_Cek['Ust_Id'];
		$Ust_Ad=$Idare_Cek['Ust_Ad'];
		$Sira_No=$Idare_Cek['Sira_No'];
		$Idare_Adi=$Idare_Cek['Idare_Adi'];
		$Idare_Kissa_Adi=$Idare_Cek['Idare_Kissa_Adi'];
		$Idare_VOEN=$Idare_Cek['Idare_VOEN'];
		$Idare_Seo_Url=$Idare_Cek['Idare_Seo_Url'];
		$Idare_Unvan=$Idare_Cek['Idare_Unvan'];
		if ($Idare_Cek['Durum']==0) {
			$Durum=1;
			$Idare_Islemleri_Sebebi=4;
		}else{
			$Durum=0;
			$Idare_Islemleri_Sebebi=5;
		}
		$yenile=$db->prepare("UPDATE idare SET 
			Durum=:Durum
			WHERE Idare_Id=$Idare_Id");
		$update=$yenile->execute(array(
			'Durum'=>$Durum
		));
		if ($update) {
			$Elave_Et=$db->prepare("INSERT INTO  idare_islemleri SET
				Idare_Id=:Idare_Id,
				Idare_Adi=:Idare_Adi,						
				Ust_Id=:Ust_Id,						
				Ust_Ad=:Ust_Ad,						
				Idare_Kissa_Adi=:Idare_Kissa_Adi,						
				Sira_No=:Sira_No,
				Idare_VOEN=:Idare_VOEN,
				Idare_Unvan=:Idare_Unvan,
				Idare_Seo_Url=:Idare_Seo_Url,
				Durum=:Durum,
				Idare_Islemleri_Sebebi=:Idare_Islemleri_Sebebi,
				Idare_Islemleri_Ip=:Idare_Islemleri_Ip,
				Admin_Id=:Admin_Id,
				Admin_Ad=:Admin_Ad,
				Admin_Soyad=:Admin_Soyad,
				Admin_Ataadi=:Admin_Ataadi,
				Idare_Islem_Edildiyi_Tarix=:Idare_Islem_Edildiyi_Tarix
				");
			$Insert=$Elave_Et->execute(array(
				'Idare_Id'=>$Idare_Id,
				'Idare_Adi'=>$Idare_Adi,
				'Ust_Id'=>$Ust_Id,
				'Ust_Ad'=>$Ust_Ad,
				'Idare_Kissa_Adi'=>$Idare_Kissa_Adi,
				'Ust_Id'=>$Ust_Id,
				'Ust_Ad'=>$Ust_Ad,
				'Sira_No'=>$Sira_No,
				'Idare_VOEN'=>$Idare_VOEN,
				'Idare_Unvan'=>$Idare_Unvan,
				'Idare_Seo_Url'=>seo($Idare_Adi.$Idare_VOEN),
				'Durum'=>$Durum,
				'Idare_Islemleri_Sebebi'=>$Idare_Islemleri_Sebebi,
				'Idare_Islemleri_Ip'=>$IPAdresi,
				'Admin_Id'=>$Admin_Id,
				'Admin_Ad'=>$Admin_Ad,
				'Admin_Soyad'=>$Admin_Soyad,
				'Admin_Ataadi'=>$Admin_Ataadi,
				'Idare_Islem_Edildiyi_Tarix'=>$TarixSaat
			));
		}	
	}else{
		header("Location:../login.php");
		exit;
	}
	// code...
}
?>