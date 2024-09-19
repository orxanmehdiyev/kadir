<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Diger_Xidmet_Ili_Id    =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM diger_xidmet_illeri where Diger_Xidmet_Ili_Id=:Diger_Xidmet_Ili_Id");
	$Sor->execute(array(
		'Diger_Xidmet_Ili_Id'=>$Diger_Xidmet_Ili_Id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	if ($Cek['Xidmet_Iline_Daxil_Et']==0) {
		$Xidmet_Iline_Daxil_Et=1;
	}else{
		$Xidmet_Iline_Daxil_Et=0;
	}

	$Elave_Et=$db->prepare("UPDATE diger_xidmet_illeri SET                               
		Xidmet_Iline_Daxil_Et=:Xidmet_Iline_Daxil_Et
		where Diger_Xidmet_Ili_Id=$Diger_Xidmet_Ili_Id		
		");
	$Insert=$Elave_Et->execute(array(                                
		'Xidmet_Iline_Daxil_Et'=>$Xidmet_Iline_Daxil_Et		
	));


}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>