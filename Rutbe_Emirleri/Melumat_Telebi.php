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
		$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
	$Rutbe_Emri_Sor->execute(array(
		'ID'=>$ID));
	$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
	$data['Son_Aldigi_Rutbenin_Tarixi']=Tarix_Beynelxalqi_Az_Cevir($Rutbe_Emri_Cek['Rutbe_Emri_Tarixi']);
	$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id ");
	$Vezife_Sor->execute(array(
		'User_Id'=>$ID));
	$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	$Zabit_Mulu=$Vezife_Cek['Zabit_Mulu'];
	if ($Zabit_Mulu==0) {
		$data['Rutbe_Ad']=$Rutbe_Emri_Cek['Rutbe_Adi'];		
	}else{
		$data['Rutbe_Ad']="Mülkü";		
	}
	echo json_encode($data);
	exit;
} ?>