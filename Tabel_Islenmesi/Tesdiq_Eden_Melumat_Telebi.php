<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Islediyi_Idare_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$User_Sor=$db->prepare("SELECT * FROM user where Islediyi_Idare_Id=:Islediyi_Idare_Id and Durum=:Durum");
	$User_Sor->execute(array(
		'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
		'Durum'=>1));?>
	<option  value="" selected="selected" tabindex="7"></option>
	<?php while($User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC)){
		$Selahiyyet_Sor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID");
		$Selahiyyet_Sor->execute(array(				
			'ID'=>$User_Cek['ID']));
		$Selahiyyet_Cek=$Selahiyyet_Sor->fetch(PDO::FETCH_ASSOC);
		if ($Selahiyyet_Cek['TesdiqSelahiyyeti']==1) {?>
			<option value='<?php echo $User_Cek['ID']  ?>'><?php echo $User_Cek['Soy_Adi']." ".$User_Cek['Adi']  ?></option>";
		<?php	}
	}
	exit;
}
?>