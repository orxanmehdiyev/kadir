<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['ID'])) {
	 $ID=ReqemlerXaricButunKarakterleriSil($_POST['ID']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$data['Idare_Ad']=$User_Cek['Idare_Ad'];
	$data['Sobe_Ad']=$User_Cek['Sobe_Ad'];
	$data['Vezife_Ad']=$User_Cek['Vezife_Ad'];
	echo json_encode($data);
	exit;
} ?>