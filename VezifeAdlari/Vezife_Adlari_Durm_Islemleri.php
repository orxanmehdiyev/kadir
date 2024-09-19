<?php 
require_once '../Ayarlar/setting.php';
if ($VezifeAdlariAktivPassiv==1) {

	if (!isset($_POST['Deyer'])) {
		header("Location:login.php");
		exit;
	}else{
		$Vezife_Adlari_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id");
		$Vezife_Adlari_Sor->execute(array(
			'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
		$Vezife_Adlari_Say=$Vezife_Adlari_Sor->rowCount();
		if ($Vezife_Adlari_Say==1) {
			$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
			if ($Vezife_Adlari_Cek['Vezife_Adlari_Durum']==0) {
				$Vezife_Adlari_Durum=1;
			}else{
				$Vezife_Adlari_Durum=0;
			}
			$yenile = $db->prepare("UPDATE vezife_adlari SET     
				Vezife_Adlari_Durum=:Vezife_Adlari_Durum
				WHERE Vezife_Adlari_Id=$Vezife_Adlari_Id");
			$update = $yenile->execute(array(     
				'Vezife_Adlari_Durum'=>$Vezife_Adlari_Durum
			));
		}
	}
}
?>