<?php 
require_once '../Ayarlar/setting.php';
if ($VezifelerDurum==1) {
	if (isset($_POST['Deyer'])) {
		$Vezife_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id");
		$Sor->execute(array(
			'Vezife_Id'=>$Vezife_Id));
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$Vezife_Adlari_Id=$Cek['Vezife_Adlari_Id'];
		$Stat_Vahidi=$Cek['Stat_Vahidi'];
		$Idare_Id=$Cek['Idare_Id'];
		$Sobe_Id=$Cek['Sobe_Id'];
		$Vezife_Pulu=$Cek['Vezife_Pulu'];
		$Stat_Muqavile=$Cek['Stat_Muqavile'];
		$Zabit_Mulu=$Cek['Zabit_Mulu'];
		$Sira_No=$Cek['Sira_No'];
		$AlaBileceyiRutbe=$Cek['AlaBileceyiRutbe'];
		$Vezife_User_Id=$Cek['User_Id'];
		if ($Cek['Durum']==0) {
			$Durum=1;
		}else{
			$Durum=0;
		}
		$yenile=$db->prepare("UPDATE vezife SET 
			Durum=:Durum
			WHERE Vezife_Id=$Vezife_Id");
		$update=$yenile->execute(array(
			'Durum'=>$Durum
		));
		if ($update) {
			$Elave_Et=$db->prepare("INSERT INTO vezife_islemleri SET
				Vezife_Id=:Vezife_Id,
				AlaBileceyiRutbe=:AlaBileceyiRutbe,
				Vezife_Adlari_Id=:Vezife_Adlari_Id,
				Stat_Vahidi=:Stat_Vahidi,
				Idare_Id=:Idare_Id,
				Sobe_Id=:Sobe_Id,
				Vezife_Pulu=:Vezife_Pulu,
				Stat_Muqavile=:Stat_Muqavile,
				Zabit_Mulu=:Zabit_Mulu,
				Sira_No=:Sira_No,
				User_Id=:User_Id,
				IPAdresi=:IPAdresi,
				ZamanDamgasi=:ZamanDamgasi,
				Islem_User_Id=:Islem_User_Id,
				Islem_Sebebi=:Islem_Sebebi,
				Durum=:Durum
				");
			$Insert=$Elave_Et->execute(array(
				'Vezife_Id'=>$Vezife_Id,
				'AlaBileceyiRutbe'=>$AlaBileceyiRutbe,
				'Vezife_Adlari_Id'=>$Vezife_Adlari_Id,
				'Stat_Vahidi'=>$Stat_Vahidi,
				'Idare_Id'=>$Idare_Id,
				'Sobe_Id'=>$Sobe_Id,
				'Vezife_Pulu'=>$Vezife_Pulu,
				'Stat_Muqavile'=>$Stat_Muqavile,
				'Zabit_Mulu'=>$Zabit_Mulu,
				'Sira_No'=>$Sira_No,
				'User_Id'=>$Vezife_User_Id,
				'IPAdresi'=>$IPAdresi,
				'ZamanDamgasi'=>$ZamanDamgasi,
				'Islem_User_Id'=>$User_Id,
				'Islem_Sebebi'=>2,
				'Durum'=>$Durum
			));
		}	
	}else{
		header("Location:../login.php");
		exit;
	}
}
?>