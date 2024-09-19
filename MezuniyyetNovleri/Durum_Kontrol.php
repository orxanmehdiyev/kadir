<?php 
require_once '../Ayarlar/setting.php';
if ($MezuniyyetAdlariStatus==1) {
if (isset($_POST['Deyer'])) {
	$Mezuniyyet_Novleri_ID  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM mezuniyyet_novleri where Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID");
	$Sor->execute(array(
		'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$Mezuniyyet_Novleri_Ad=$Cek['Mezuniyyet_Novleri_Ad'];
	$Mezuniyyet_Novleri_Kissa_Ad=$Cek['Mezuniyyet_Novleri_Kissa_Ad'];
	$Mezuniyyet_Novleri_Seo_Url=$Cek['Mezuniyyet_Novleri_Seo_Url'];
	$Mezuniyyet_Novleri_Sira=$Cek['Mezuniyyet_Novleri_Sira'];
	if ($Cek['Mezuniyyet_Novleri_Durum']==0) {
		$Mezuniyyet_Novleri_Durum=1;
		$Mezuniyyet_Novleri_Islem_Sebebi=4;
	}else{
		$Mezuniyyet_Novleri_Durum=0;
		$Mezuniyyet_Novleri_Islem_Sebebi=5;
	}
	$yenile=$db->prepare("UPDATE mezuniyyet_novleri SET 
		Mezuniyyet_Novleri_Durum=:Mezuniyyet_Novleri_Durum
		WHERE Mezuniyyet_Novleri_ID=$Mezuniyyet_Novleri_ID");
	$update=$yenile->execute(array(
		'Mezuniyyet_Novleri_Durum'=>$Mezuniyyet_Novleri_Durum
	));
	if ($update) {		
		$Elave_Et=$db->prepare("INSERT INTO  mezuniyyet_novleri_islemleri SET                               
			Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID,
			Mezuniyyet_Novleri_Ad=:Mezuniyyet_Novleri_Ad,
			Mezuniyyet_Novleri_Kissa_Ad=:Mezuniyyet_Novleri_Kissa_Ad,
			Mezuniyyet_Novleri_Seo_Url=:Mezuniyyet_Novleri_Seo_Url,
			Mezuniyyet_Novleri_Sira=:Mezuniyyet_Novleri_Sira,
			Mezuniyyet_Novleri_Islem_Sebebi=:Mezuniyyet_Novleri_Islem_Sebebi,
			Mezuniyyet_Novleri_Durum=:Mezuniyyet_Novleri_Durum,
			Mezuniyyet_Novleri_TarixSaat=:Mezuniyyet_Novleri_TarixSaat,
			IPAdresi=:IPAdresi,
			Admin_Id=:Admin_Id,
			Admin_Ad=:Admin_Ad,
			Admin_Soyad=:Admin_Soyad,
			Admin_Ataadi=:Admin_Ataadi
			");
		$Insert=$Elave_Et->execute(array(                                
			'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID,
			'Mezuniyyet_Novleri_Ad'=>$Mezuniyyet_Novleri_Ad,
			'Mezuniyyet_Novleri_Kissa_Ad'=>$Mezuniyyet_Novleri_Kissa_Ad,
			'Mezuniyyet_Novleri_Seo_Url'=>$Mezuniyyet_Novleri_Seo_Url,
			'Mezuniyyet_Novleri_Sira'=>$Mezuniyyet_Novleri_Sira,
			'Mezuniyyet_Novleri_Islem_Sebebi'=>$Mezuniyyet_Novleri_Islem_Sebebi,/*1-yeni 2-duzelis 3- silindi 4-durum aktiv 5- durum passiv*/
			'Mezuniyyet_Novleri_Durum'=>$Mezuniyyet_Novleri_Durum,
			'Mezuniyyet_Novleri_TarixSaat'=>$TarixSaat,
			'IPAdresi'=>$IPAdresi,
			'Admin_Id'=>$Admin_Id,
			'Admin_Ad'=>$Admin_Ad,
			'Admin_Soyad'=>$Admin_Soyad,
			'Admin_Ataadi'=>$Admin_Ataadi
		));
	}	
}else{
	header("Location:../login.php");
	exit;
}
}
?>