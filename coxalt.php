

<?php 
ini_set("max_execution_time", 86400);
date_default_timezone_set('Asia/Baku');
header("Content-Type:text/html; charset=UTF-8");
try {
	$db=new PDO("mysql:host=localhost;dbname=u0425436_ndgk;charset=utf8",'u0425436_ndgk','13AH04AH@Aydan');
}
catch (PDOExpception $e) {
	echo $e->getMessage();
}
$Sor=$db->prepare("SELECT * FROM  userdes ");
$Sor->execute();
while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {

	$Elave_Et=$db->prepare("INSERT INTO user SET 
		ID=:ID,
		Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id,
		Ise_Qebul_Emri_Nomresi=:Ise_Qebul_Emri_Nomresi,
		Soy_Adi=:Soy_Adi,
		Adi=:Adi,
		Ata_Adi=:Ata_Adi,
		FIN_Kod=:FIN_Kod,
		Kimlik_Nomir=:Kimlik_Nomir,
		Cinsiyeti=:Cinsiyeti,
		Telefon=:Telefon,
		Dogum_Tarixi=:Dogum_Tarixi,
		Doguldugu_Unvan=:Doguldugu_Unvan,
		Yasayis_Unvan=:Yasayis_Unvan,
		ZamanDamgasi=:ZamanDamgasi,
		Ise_Qebul_Tarixi=:Ise_Qebul_Tarixi,
		Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi,
		Vetendasligi=:Vetendasligi,
		Sinaq_Muddeti=:Sinaq_Muddeti,
		SinaqMuddetiGunAy=:SinaqMuddetiGunAy,
		SinaqMuddetiBitis=:SinaqMuddetiBitis,
		Islediyi_Idare_Id=:Islediyi_Idare_Id,
		Idare_Ad=:Idare_Ad,
		Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
		Sobe_Ad=:Sobe_Ad,
		Vezife_Id=:Vezife_Id,
		Vezife_Ad=:Vezife_Ad,
		Vezife_Pulu=:Vezife_Pulu,
		Teltif_Silahi=:Teltif_Silahi,
		Durum=:Durum,
		Serencam_Durum=:Serencam_Durum,
		Seo_Url=:Seo_Url,
		SSN_Nomresi=:SSN_Nomresi,
		Qeyd=:Qeyd,
		aile_veziyyeti=:aile_veziyyeti

		");
	$insert=$Elave_Et->execute(array(
		'ID'=>$Cek['ID'],
		'Ise_Qebul_Emri_Id'=>$Cek['Ise_Qebul_Emri_Id'],
		'Ise_Qebul_Emri_Nomresi'=>$Cek['Ise_Qebul_Emri_Nomresi'],
		'Soy_Adi'=>$Cek['Soy_Adi'],
		'Adi'=>$Cek['Adi'],
		'Ata_Adi'=>$Cek['Ata_Adi'],
		'FIN_Kod'=>$Cek['FIN_Kod'],
		'Kimlik_Nomir'=>$Cek['Kimlik_Nomir'],
		'Cinsiyeti'=>$Cek['Cinsiyeti'],
		'Telefon'=>$Cek['Mobil_Telefon'],
		'Dogum_Tarixi'=> date("Y-m-d",strtotime($Cek['Dogum_Tarixi'])),
		'Doguldugu_Unvan'=> $Cek['Doguldugu_Unvan'],
		'Yasayis_Unvan'=> $Cek['Yasayis_Unvan'],
		'ZamanDamgasi'=> $Cek['ZamanDamgasi'],
		'Ise_Qebul_Tarixi'=> date("Y-m-d",strtotime($Cek['Ise_Qebul_Tarixi'])),
		'Vezifeye_Teyin_Tarixi'=> $Cek['Vezifeye_Teyin_Tarixi'],
		'Vetendasligi'=> $Cek['Vetendasligi'],
		'Sinaq_Muddeti'=> $Cek['Sinaq_Muddeti'],
		'SinaqMuddetiGunAy'=> $Cek['SinaqMuddetiGunAy'],
		'SinaqMuddetiBitis'=> $Cek['SinaqMuddetiBitis'],
		'Islediyi_Idare_Id'=> $Cek['Islediyi_Idare_Id'],
		'Idare_Ad'=> $Cek['Idare_Ad'],
		'Islediyi_Sobe_Id'=> $Cek['Islediyi_Sobe_Id'],
		'Sobe_Ad'=> $Cek['Sobe_Ad'],
		'Vezife_Id'=> $Cek['Vezife_Id'],
		'Vezife_Ad'=> $Cek['Vezife_Ad'],
		'Vezife_Pulu'=> $Cek['Vezife_Pulu'],
		'Teltif_Silahi'=> $Cek['Teltif_Silahi'],
		'Durum'=> $Cek['Durum'],
		'Serencam_Durum'=> $Cek['Serencam_Durum'],
		'Seo_Url'=> $Cek['Seo_Url'],
		'SSN_Nomresi'=> $Cek['SSN_Nomresi'],
		'Qeyd'=> $Cek['Qeyd'],
		'aile_veziyyeti'=> $Cek['aile_veziyyeti']

	));


}
?>
