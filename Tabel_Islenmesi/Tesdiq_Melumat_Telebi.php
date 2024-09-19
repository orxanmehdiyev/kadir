<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$ID=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	if ($User_Cek['Vezife_Ad']=="Sədr") {
		$vezifead="Sədri";
	}elseif($User_Cek['Vezife_Ad']=="Sədr müavini"){
		$vezifead="Sədr müavini";
	}elseif($User_Cek['Vezife_Ad']=="İdarə rəisi"){
		$vezifead="Rəisi";
	}elseif($User_Cek['Vezife_Ad']=="İdarə rəsinin müavini"){
		$vezifead="Rəsinin müavini";
	}	elseif($User_Cek['Vezife_Ad']=="İdarə rəsinin müavini"){
		$vezifead="Rəsinin müavini";
	}
	$data['Vezifesi']=$vezifead;
	$data['adisoyadi']=$User_Cek['Soy_Adi']." ".$User_Cek['Adi'];

	echo json_encode($data);
	exit;
} ?>