<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['RutbeSekliYukle'])) {	
	$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe_emri where Rutbe_Emri_Id=:Rutbe_Emri_Id");
	$Rutbe_Sor->execute(array(
		'Rutbe_Emri_Id'=>$_POST['Rutbe_Emri_Id']));
	$Rutbe_Say=$Rutbe_Sor->rowCount();
	if ($Rutbe_Say==1) {
		$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
		$ID=$Rutbe_Cek['ID'];
		$KohneSekil=$Rutbe_Cek['Rutbe_Img'];
		$Rutbe_Adi=$Rutbe_Cek['Rutbe_Adi'];
		$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID");
		$User_Sor->execute(array(
			'ID'=>$ID));
		$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
		$User_Adi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi']." ".$Rutbe_Adi;
		if ($_FILES['file']['size']>5242880) {		
			$data['status']="error";
			$data['message']="Sənədin həcmi 5Mb dən böyük ola bilməz.";
			echo json_encode($data);
			exit;
		}
		$izinli_uzantilar=array('JPG','jpg','PNG','png','JPEG','jpeg');
		$ext=strtolower(substr($_FILES['file']['name'],strpos($_FILES['file']['name'],'.')+1));
		if (in_array($ext, $izinli_uzantilar)===false) {
			$data['status']="error";
			$data['message']="İcazə verilən sənədlər pdf və ya rar olmalıdır";
			echo json_encode($data);
			exit;
		}

		$uploads_dir='../Senedler/Rutbe';
		@$tmp_name=$_FILES['file']['tmp_name'];
		@$name=$_FILES['file']['name'];
		$uniq=$User_Adi."_".uniqid();
		$refimgyol=substr($uploads_dir,3)."/".$uniq.".".$ext;
		@move_uploaded_file($tmp_name, "$uploads_dir/$uniq.$ext");	
		$kaydet=$db->prepare("UPDATE rutbe_emri SET 
			Rutbe_Img=:Rutbe_Img
			WHERE Rutbe_Emri_Id={$_POST['Rutbe_Emri_Id']}");
		$update=$kaydet->execute(array(
			'Rutbe_Img' => $refimgyol
		));
		if ($update) {	
			$sileine="../".$KohneSekil;
			@unlink($sileine);		
			$data['status']="success";
			$data['message']='asdas';
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