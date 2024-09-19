<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                         =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Mezuniyyet_Novleri_ID      =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Novleri_ID']); 
	$Tedbiq_Edildiyi_Tarix                     =strtotime($deyer['Tedbiq_Edildiyi_Tarix']) ; 

	if ($ID>0 and $Mezuniyyet_Novleri_ID==1) {}
		if ($Mezuniyyet_Novleri_ID==1) {
			require_once 'Xidmet_Ili_Hesabla_Esas_Elave_Birge.php';
		}elseif($Mezuniyyet_Novleri_ID==2){
			require_once 'Xidmet_Ili_Hesabla_Esas.php';
		}elseif($Mezuniyyet_Novleri_ID==3){
			require_once 'Xidmet_Ili_Hesabla_Elave.php';
		}elseif($Mezuniyyet_Novleri_ID==4){

		}elseif($Mezuniyyet_Novleri_ID==5){

		}

		




	}else{
		header("Location:../intizam_tenbehleri.php");
		exit;
	}
?>