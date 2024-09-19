<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['tehsilsenediyukle'])) {	
	$Tehsil_Sor=$db->prepare("SELECT * FROM user_tehsil where User_Tehsil_Id=:User_Tehsil_Id");
	$Tehsil_Sor->execute(array(
		'User_Tehsil_Id'=>$_POST['User_Tehsil_Id']));
	$Tehsil_Say=$Tehsil_Sor->rowCount();
	if ($Tehsil_Say==1) {
		$Tehsil_Cek=$Tehsil_Sor->fetch(PDO::FETCH_ASSOC);
		$ID=$Tehsil_Cek['ID'];
		$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID");
		$User_Sor->execute(array(
			'ID'=>$ID));
		$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
		$User_Adi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
		if ($_FILES['file']['size']>5242880) {		
			$data['status']="error";
			$data['message']="Sənədin həcmi 5Mb dən böyük ola bilməz.";
			echo json_encode($data);
			exit;
		}
		$izinli_uzantilar=array('pdf','PDF','RAR','rar','ZIP','zip');
		$ext=strtolower(substr($_FILES['file']['name'],strpos($_FILES['file']['name'],'.')+1));
		if (in_array($ext, $izinli_uzantilar)===false) {
			$data['status']="error";
			$data['message']="İcazə verilən sənədlər pdf və ya rar olmalıdır";
			echo json_encode($data);
			exit;
		}

		$uploads_dir='../Senedler/Tehsil';
		@$tmp_name=$_FILES['file']['tmp_name'];
		@$name=$_FILES['file']['name'];
		$uniq=$User_Adi."_".uniqid();
		$refimgyol=substr($uploads_dir,3)."/".$uniq.".".$ext;
		@move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");	
		$kaydet=$db->prepare("UPDATE user_tehsil SET 
			Tehsil_Senedi_IMG=:Tehsil_Senedi_IMG
			WHERE User_Tehsil_Id={$_POST['User_Tehsil_Id']}");
		$update=$kaydet->execute(array(
			'Tehsil_Senedi_IMG' => $refimgyol
		));
		if ($update) {			
			$data['status']="success";
			$data['message']='<a style="color: #0d6efd;" href="'.$refimgyol.'" target="blank">Sənədi</a><span style="color:red; margin-left: 5px; cursor: pointer;" onclick="TehsilSenedSil(this.id)" id="TehsilSenedSil_'.$Tehsil_Cek['User_Tehsil_Id'].'">x</span>';
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