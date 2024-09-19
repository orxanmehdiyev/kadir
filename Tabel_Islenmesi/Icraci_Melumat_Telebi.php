<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$ID=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	if ($User_Cek['Vezife_Ad']=="Bölmə rəisi" or $User_Cek['Vezife_Ad']=="Şöbə rəisi") {
		$vezifead="rəisi";
	}elseif($User_Cek['Vezife_Ad']=="Böyük inspektor"){
		$vezifead="böyük inspektoru";
	}elseif($User_Cek['Vezife_Ad']=="İnspektor"){
		$vezifead="inspektoru";
	}
	$data['adisoyadi']=$User_Cek['Sobe_Ad']."nin ".$vezifead." : ".$User_Cek['Soy_Adi']." ".$User_Cek['Adi'];

	echo json_encode($data);
	exit;
} ?>