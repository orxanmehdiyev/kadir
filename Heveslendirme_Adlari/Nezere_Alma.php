<?php 
require_once '../Ayarlar/setting.php';
if ($HeveslendiremAdlariNezereAlma==1) {
if (isset($_POST['Deyer'])) {
	$heveslendirem_tedbirleri_ad_id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id");
	$Sor->execute(array(
		'heveslendirem_tedbirleri_ad_id'=>$heveslendirem_tedbirleri_ad_id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$heveslendirem_tedbirleri_ad=$Cek['heveslendirem_tedbirleri_ad'];
	$heveslendirem_tedbirleri_ad_Sira_No=$Cek['heveslendirem_tedbirleri_ad_Sira_No'];
	$heveslendirem_tedbirleri_ad_Xususi_No=$Cek['heveslendirem_tedbirleri_ad_Xususi_No'];
	$heveslendirem_tedbirleri_ad_Seo_Url=$Cek['heveslendirem_tedbirleri_ad_Seo_Url'];
	$heveslendirem_tedbirleri_ad_durum=$Cek['heveslendirem_tedbirleri_ad_durum'];

	if ($Cek['heveslendirem_tedbirleri_ad_nezere_alam']==0) {
		$heveslendirem_tedbirleri_ad_nezere_alam=1;
	}else{
		$heveslendirem_tedbirleri_ad_nezere_alam=0;
	}
	$yenile=$db->prepare("UPDATE heveslendirem_tedbirleri_ad SET 
		heveslendirem_tedbirleri_ad_nezere_alam=:heveslendirem_tedbirleri_ad_nezere_alam
		WHERE heveslendirem_tedbirleri_ad_id=$heveslendirem_tedbirleri_ad_id");
	$update=$yenile->execute(array(
		'heveslendirem_tedbirleri_ad_nezere_alam'=>$heveslendirem_tedbirleri_ad_nezere_alam
	));
	if ($update) {		
		$Elave_Et=$db->prepare("INSERT INTO  heveslendirem_tedbirleri_ad_islemleri SET                               
			heveslendirem_tedbirleri_ad_islemleri_IPadresi=:heveslendirem_tedbirleri_ad_islemleri_IPadresi,
			heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi=:heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi,
			heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id,
			heveslendirem_tedbirleri_ad=:heveslendirem_tedbirleri_ad,
			heveslendirem_tedbirleri_ad_Sira_No=:heveslendirem_tedbirleri_ad_Sira_No,
			heveslendirem_tedbirleri_ad_Xususi_No=:heveslendirem_tedbirleri_ad_Xususi_No,
			heveslendirem_tedbirleri_ad_durum=:heveslendirem_tedbirleri_ad_durum,
			heveslendirem_tedbirleri_ad_nezere_alam=:heveslendirem_tedbirleri_ad_nezere_alam,
			Status=:Status,
			Islem_Eden_User_Id=:Islem_Eden_User_Id,
			heveslendirem_tedbirleri_ad_Seo_Url=:heveslendirem_tedbirleri_ad_Seo_Url
			");
		$Insert=$Elave_Et->execute(array(                                
			'heveslendirem_tedbirleri_ad_islemleri_IPadresi'=>$IPAdresi,
			'heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi'=>$ZamanDamgasi,
			'heveslendirem_tedbirleri_ad_id'=>$heveslendirem_tedbirleri_ad_id,
			'heveslendirem_tedbirleri_ad'=>$heveslendirem_tedbirleri_ad,
			'heveslendirem_tedbirleri_ad_Sira_No'=>$heveslendirem_tedbirleri_ad_Sira_No,
			'heveslendirem_tedbirleri_ad_Xususi_No'=>$heveslendirem_tedbirleri_ad_Xususi_No,
			'heveslendirem_tedbirleri_ad_durum'=>$heveslendirem_tedbirleri_ad_durum,
			'heveslendirem_tedbirleri_ad_nezere_alam'=>$heveslendirem_tedbirleri_ad_nezere_alam,
			'Status'=>2,
			  'Islem_Eden_User_Id'=>$User_Id,
			'heveslendirem_tedbirleri_ad_Seo_Url'=>$heveslendirem_tedbirleri_ad_Seo_Url
		));
	}	
}else{
	header("Location:../login.php");
	exit;
}
}
?>