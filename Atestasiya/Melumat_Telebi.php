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

	$Mez_Sor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID order by Mezuniyyet_Bitis_Tarixi_Unix DESC");
	$Mez_Sor->execute(array(
		'ID'=>$ID));
	$Mez_Cek=$Mez_Sor->fetch(PDO::FETCH_ASSOC);
	$data['Mezuniyyet_Novleri_Ad']=$Mez_Cek['Mezuniyyet_Novleri_Ad'];
	$data['Mezuniyyet_Bitis_Tarixi']=$Mez_Cek['Mezuniyyet_Bitis_Tarixi'];
	$data['Mezuniyyet_Ise_Cixma_Tarixi']=$Mez_Cek['Mezuniyyet_Ise_Cixma_Tarixi'];
	$data['Mezuniyyet_Id']=$Mez_Cek['Mezuniyyet_Id'];

echo json_encode($data);
	exit;
} ?>