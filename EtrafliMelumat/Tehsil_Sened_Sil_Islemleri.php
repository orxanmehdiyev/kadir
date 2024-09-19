<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {	
	$User_Tehsil_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Tehsil_Sor=$db->prepare("SELECT * FROM user_tehsil where User_Tehsil_Id=:User_Tehsil_Id");
	$Tehsil_Sor->execute(array(
		'User_Tehsil_Id'=>$User_Tehsil_Id));
	$Tehsil_Say=$Tehsil_Sor->rowCount();
	if ($Tehsil_Say==1) {
		$Tehsil_Cek=$Tehsil_Sor->fetch(PDO::FETCH_ASSOC);
		$Tehsil_Senedi_IMG=$Tehsil_Cek['Tehsil_Senedi_IMG'];
		$sileine="../".$Tehsil_Senedi_IMG;
		@unlink($sileine);
		$Silinenyol="";
		$kaydet=$db->prepare("UPDATE user_tehsil SET 
			Tehsil_Senedi_IMG=:Tehsil_Senedi_IMG
			WHERE User_Tehsil_Id=$User_Tehsil_Id");
		$update=$kaydet->execute(array(
			'Tehsil_Senedi_IMG' => $Silinenyol
		));
		if ($update) {			
			$data['status']="success";
			$data['message']="<form  method='post' enctype='multipart/form-data' id='tehsilform_".$User_Tehsil_Id."'>
			<input type='hidden' name='tehsilsenediyukle'>
			<input type='hidden' name='User_Tehsil_Id' value='".$User_Tehsil_Id."'>	
			<label class='fileuploadgizliinputlabel' for='file_".$User_Tehsil_Id."' id='label_".$User_Tehsil_Id."'>Browse...</label>
			<input type='file' class='fileuploadgizliinput' name='file' id='file_".$User_Tehsil_Id."'  onchange='TehsilSenediYukle(this.form)'>
			
			</form>";
			echo json_encode($data);
			exit;		
		} else {
			$data['status']="error";
			$data['message']="Yenilənmə Uğursuz";
			echo json_encode($data);
			exit;
		}
	}else{
		$data['status']="error";
		$data['message']="Yenilənmə Uğursuz";
		echo json_encode($data);
		exit;
	}
}

?>