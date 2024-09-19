<?php 
require_once '../Ayarlar/setting.php';
if ($IntizamTenbehiAdlariStatus==1) {
	if (isset($_POST['Deyer'])) {
		$intizam_tenbehi_adlari_id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sor=$db->prepare("SELECT * FROM intizam_tenbehi_adlari where intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id");
		$Sor->execute(array(
			'intizam_tenbehi_adlari_id'=>$intizam_tenbehi_adlari_id));
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$intizam_tenbehi_adlari_ad=$Cek['intizam_tenbehi_adlari_ad'];
		$intizam_tenbehi_adlari_Sira_No=$Cek['intizam_tenbehi_adlari_Sira_No'];
		$intizam_tenbehi_adlari_Xususi_No=$Cek['intizam_tenbehi_adlari_Xususi_No'];
		$intizam_tenbehi_adlari_Seo_Url=$Cek['intizam_tenbehi_adlari_Seo_Url'];
		if ($Cek['intizam_tenbehi_adlari_durum']==0) {
			$intizam_tenbehi_adlari_durum=1;
		}else{
			$intizam_tenbehi_adlari_durum=0;
		}
		$yenile=$db->prepare("UPDATE intizam_tenbehi_adlari SET 
			intizam_tenbehi_adlari_durum=:intizam_tenbehi_adlari_durum
			WHERE intizam_tenbehi_adlari_id=$intizam_tenbehi_adlari_id");
		$update=$yenile->execute(array(
			'intizam_tenbehi_adlari_durum'=>$intizam_tenbehi_adlari_durum
		));
		if ($update) {		
			$Elave_Et=$db->prepare("INSERT INTO  intizam_tenbehi_adlari_islemleri SET                               
				intizam_tenbehi_adlari_islemleri_IPadresi=:intizam_tenbehi_adlari_islemleri_IPadresi,
				intizam_tenbehi_adlari_islemleri_ZamanDamgasi=:intizam_tenbehi_adlari_islemleri_ZamanDamgasi,
				intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id,
				intizam_tenbehi_adlari_ad=:intizam_tenbehi_adlari_ad,
				intizam_tenbehi_adlari_Sira_No=:intizam_tenbehi_adlari_Sira_No,
				intizam_tenbehi_adlari_Xususi_No=:intizam_tenbehi_adlari_Xususi_No,
				intizam_tenbehi_adlari_durum=:intizam_tenbehi_adlari_durum,
				Status=:Status,
				Islem_Eden_User_Id=:Islem_Eden_User_Id,
				intizam_tenbehi_adlari_Seo_Url=:intizam_tenbehi_adlari_Seo_Url
				");
			$Insert=$Elave_Et->execute(array(                                
				'intizam_tenbehi_adlari_islemleri_IPadresi'=>$IPAdresi,
				'intizam_tenbehi_adlari_islemleri_ZamanDamgasi'=>$ZamanDamgasi,
				'intizam_tenbehi_adlari_id'=>$intizam_tenbehi_adlari_id,
				'intizam_tenbehi_adlari_ad'=>$intizam_tenbehi_adlari_ad,
				'intizam_tenbehi_adlari_Sira_No'=>$intizam_tenbehi_adlari_Sira_No,
				'intizam_tenbehi_adlari_Xususi_No'=>$intizam_tenbehi_adlari_Xususi_No,
				'intizam_tenbehi_adlari_durum'=>$intizam_tenbehi_adlari_durum,
				'Status'=>2,
				'Islem_Eden_User_Id'=>$User_Id,
				'intizam_tenbehi_adlari_Seo_Url'=>$intizam_tenbehi_adlari_Seo_Url
			));
		}	
	}else{
		header("Location:../login.php");
		exit;
	}
}
?>