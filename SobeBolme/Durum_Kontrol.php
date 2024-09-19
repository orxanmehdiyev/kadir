<?php 
require_once '../Ayarlar/setting.php';
if ($SobeBolmeDurumKontrol==1) {
	if (isset($_POST['Deyer'])) {
		$Sobe_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id");
		$Sor->execute(array(
			'Sobe_Id'=>$Sobe_Id));
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$Sobe_Ad=$Cek['Sobe_Ad'];
		$Sira_No=$Cek['Sira_No'];
		$Idare_Id=$Cek['Idare_Id'];
		if ($Cek['Durum']==0) {
			$Durum=1;
		}else{
			$Durum=0;
		}
		$yenile=$db->prepare("UPDATE sobe SET 
			Durum=:Durum
			WHERE Sobe_Id=$Sobe_Id");
		$update=$yenile->execute(array(
			'Durum'=>$Durum
		));
		if ($update) {
			$Elave_Et=$db->prepare("INSERT INTO sobe_islemleri SET 
				Sobe_Id=:Sobe_Id,
				Admin_Id=:Admin_Id,
				Idare_Id=:Idare_Id,
				Sobe_Islemleri_Sebebi=:Sobe_Islemleri_Sebebi,
				Sobe_Islemleri_Sobe_Adi=:Sobe_Islemleri_Sobe_Adi,
				TarixSaat=:TarixSaat,
				ZamanDamgasi=:ZamanDamgasi,
				IPAdresi=:IPAdresi,
				Sira_No=:Sira_No,
				Durum=:Durum
				");
			$insert=$Elave_Et->execute(array(
				'Sobe_Id'=>$Sobe_Id,
				'Admin_Id'=>$Admin_Id,
				'Idare_Id'=>$Idare_Id,
				'Sobe_Islemleri_Sebebi'=>2,
				'Sobe_Islemleri_Sobe_Adi'=>$Sobe_Ad,
				'TarixSaat'=>$TarixSaat,
				'ZamanDamgasi'=>$ZamanDamgasi,
				'IPAdresi'=>$IPAdresi,
				'Sira_No'=>$Sira_No,
				'Durum'=>$Durum
			));
		}	
	}else{
		header("Location:../login.php");
		exit;
	}
	// code...
}
?>