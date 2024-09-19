<?php 
$deyer =json_decode($_POST['Deyer'],true);
$ID=$deyer['ID'];
$Tedbiq_Edildiyi_Tarix=date("Y-m-d", strtotime($deyer['Tedbiq_Edildiyi_Tarix']));
$Mezuniyyet_Novleri_ID=$deyer['Mezuniyyet_Novleri_ID'];

$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
$User_Sor->execute(array(
	'ID'=>$ID,
	'Durum'=>1));
$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
$Cinsiyeti=$User_Cek['Cinsiyeti'];	
$Ise_Qebul_Tarixi=$User_Cek['Ise_Qebul_Tarixi'];

$Mezuniyyete_Cixis_Tarixi=new DateTime($Tedbiq_Edildiyi_Tarix);	
$diki=new DateTime($Ise_Qebul_Tarixi);
$Xidmet_Ili= $diki->diff($Mezuniyyete_Cixis_Tarixi)->y;

$Mezuniyyet_Huququ_Sor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and (Mezuniyyet_Novleri_ID=:bir or Mezuniyyet_Novleri_ID=:iki or Mezuniyyet_Novleri_ID=:uc) order by Mezuniyyet_Id DESC");
$Mezuniyyet_Huququ_Sor->execute(array(
	'ID'=>$ID,
	'bir'=>1,
	'iki'=>2,
	'uc'=>3
));
$Mezuniyyet_Huququ_say=$Mezuniyyet_Huququ_Sor->rowCount();
$Mezuniyyet_Huququ_Cek=$Mezuniyyet_Huququ_Sor->fetch(PDO::FETCH_ASSOC);
$Xidmet_Ili_Son=$Mezuniyyet_Huququ_Cek['Xidmet_Ili_Son'];
$Mezuniyyet_Qaliq_Gun=$Mezuniyyet_Huququ_Cek['Mezuniyyet_Qaliq_Gun'];

if ($Ise_Qebul_Tarixi>$Tedbiq_Edildiyi_Tarix) {
	$data['status']="error";
	$data['message']="Məzuniyyətə çıxma tarixi səhvdir! Məzuniyyətin tədbiq edildiyi tarix işə qəbul tarixindən əvvəl ola bilməz";			
	echo json_encode($data);
	exit;
}

if (($Xidmet_Ili_Son>$Tedbiq_Edildiyi_Tarix) and ($Mezuniyyet_Qaliq_Gun==0)) {
		// mezuniyyeti yoxdur
	$data['status']="error";
	$data['message']="Məzuniyyət tədbiq edildiyi tarix səhv! Əməkdaşın bu tarixdən sonrakı məzuniyyətləri istifadə edildiyi üçün bu tarix üzrə məzuniyyət əmri verə bilmərsiz";			
	echo json_encode($data);				
	exit;
}

if ($Tarix_Beynelxalq>$Tedbiq_Edildiyi_Tarix) {
	$data['status']="error";
	$data['message']="Məzuniyyət tədbiq edildiyi tarix səhv! Keşmiş tarixə məzuniyyət əmri verilə bilməz";			
	echo json_encode($data);				
	exit;
}

if($Xidmet_Ili_Son>$Tedbiq_Edildiyi_Tarix and $Mezuniyyet_Qaliq_Gun>0){
// qaliq mezuniyyeti var
}elseif($Xidmet_Ili_Son<$Tedbiq_Edildiyi_Tarix ){
	$iyirmigunonce=Traix_Uzerine_Gel($Tarix_Beynelxalq,20,"day");
	if ($Tarix_Beynelxalq <$Xidmet_Ili_Son and $iyirmigunonce>$Xidmet_Ili_Son ) {
		echo "mezuniyyet huququ yaranmayib";
		exit;		
	}
}
$Altiay = Traix_Uzerine_Gel($Ise_Qebul_Tarixi,6,"month");
if ($Altiay>$Tedbiq_Edildiyi_Tarix) {
	$data['status']="error";
	$data['message']="Məzuniyyət hüququ yaranamyıb! Məzuniyyət hüququnun yaranması üçün işə qəbul tarixindən an azı 6 ay keçməlidir. Seçili əməkdaş üçün məzuniyyət hüququnun yaranma tarixi ".TarixAzCevir($Altiay)." tarixindən sonradır.";			
	echo json_encode($data);				
	exit;
}

if ($Mezuniyyet_Huququ_say>0) {
	$Xidmet_Ili_Bitis = $Mezuniyyet_Huququ_Cek['Xidmet_Ili_Son'];
	$Xidmet_Ili_Baslagic=$Mezuniyyet_Huququ_Cek['Xidmet_Ili_Baslagic'];
}else{
	$Xidmet_Ili_Baslagic=$Ise_Qebul_Tarixi;
	$Xidmet_Ili_Bitis = Traix_Uzerine_Gel($Ise_Qebul_Tarixi,1,"year");
}



$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id and Durum=:Durum");
$Vezife_Sor->execute(array(
	'User_Id'=>$ID,
	'Durum'=>1));
$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);





while ($Xidmet_Ili_Baslagic<$Tarix_Beynelxalq) {
	$Mez_Xid_Ili_Sor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Xidmet_Ili_Baslagic=:Xidmet_Ili_Baslagic and Xidmet_Ili_Son=:Xidmet_Ili_Son and (Mezuniyyet_Novleri_ID=:bir or Mezuniyyet_Novleri_ID=:iki or Mezuniyyet_Novleri_ID=:uc) order by Mezuniyyet_Id DESC");
	$Mez_Xid_Ili_Sor->execute(array(			
		'ID'=>$ID,
		'Xidmet_Ili_Baslagic'=>$Xidmet_Ili_Baslagic,
		'Xidmet_Ili_Son'=>$Xidmet_Ili_Bitis,
		'bir'=>1,
		'iki'=>2,
		'uc'=>3
	));
	$Mez_Xid_Ili_Say=$Mez_Xid_Ili_Sor->rowCount();
	if ($Mez_Xid_Ili_Say>0) {				
		$Mez_Xid_Ili_Cek=$Mez_Xid_Ili_Sor->fetch(PDO::FETCH_ASSOC);
		$Mezuniyyet_Qaliq_Guns=$Mez_Xid_Ili_Cek['Mezuniyyet_Qaliq_Gun'];
		if ($Mezuniyyet_Qaliq_Guns>0) {
			if ($Xidmet_Ili_Bitis>$Tedbiq_Edildiyi_Tarix) {
				$mezuniyyetgunu=$Mezuniyyet_Qaliq_Guns;				
				$Xidmet_Ili_BaslagicAZ   = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);					
				$Xidmet_Ili_BitisAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
				break;
			}elseif($Xidmet_Ili_Bitis<$Tedbiq_Edildiyi_Tarix and $Mezuniyyet_Qaliq_Guns>0){
				$mezuniyyetgunu=$Mezuniyyet_Qaliq_Guns;				
				$Xidmet_Ili_BaslagicAZ   = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);					
				$Xidmet_Ili_BitisAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
				break;
			}	else{		
				$Xidmet_Ili_Baslagic     = Traix_Uzerine_Gel($Xidmet_Ili_Baslagic,1,"year");
				$Xidmet_Ili_BaslagicAZ   = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);	

				$Xidmet_Ili_Bitis        = Traix_Uzerine_Gel($Xidmet_Ili_Bitis,1,"year");
				$Xidmet_Ili_BitisAZ      = Tarix_Beynelxalqi_Az_Cevir( $Xidmet_Ili_Bitis);
				$mezuniyyetgunu=$Mezuniyyet_Qaliq_Guns;	
				break;
			}					
		}else{
			$Xidmet_Ili_Baslagic       = Traix_Uzerine_Gel($Xidmet_Ili_Baslagic,1,"year");
			$Xidmet_Ili_Bitis          = Traix_Uzerine_Gel($Xidmet_Ili_Bitis,1,"year");
		}


	}else{
		if ($Mezuniyyet_Qaliq_Gun>0) {
			$mezuniyyetgunu=$Mezuniyyet_Qaliq_Gun;			
			$Xidmet_Ili_BaslagicAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);
			$Xidmet_Ili_BitisAZ         = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
			if ($Xidmet_Ili>=5 and $Xidmet_Ili<10) {
				$mezuniyyetgunu=$mezuniyyetgunu+3;
			}elseif($Xidmet_Ili>=10 and $Xidmet_Ili<15){
				$mezuniyyetgunu=$mezuniyyetgunu+5;
			}elseif($Xidmet_Ili>=15 and $Xidmet_Ili<20){
				$mezuniyyetgunu=$mezuniyyetgunu+10;
			}elseif($Xidmet_Ili>=20){
				$mezuniyyetgunu=$mezuniyyetgunu+15;
			}else{
				$mezuniyyetgunu;
			}
			break;
		}else{
			$mezuniyyetgunu=0;			
			$Xidmet_Ili_BaslagicAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);
			$Xidmet_Ili_BitisAZ         = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
			if ($Xidmet_Ili>=5 and $Xidmet_Ili<10) {
				$mezuniyyetgunu=$mezuniyyetgunu+3;
			}elseif($Xidmet_Ili>=10 and $Xidmet_Ili<15){
				$mezuniyyetgunu=$mezuniyyetgunu+5;
			}elseif($Xidmet_Ili>=15 and $Xidmet_Ili<20){
				$mezuniyyetgunu=$mezuniyyetgunu+10;
			}elseif($Xidmet_Ili>=20){
				$mezuniyyetgunu=$mezuniyyetgunu+15;
			}else{
				$mezuniyyetgunu;
			}
			break;
		}
	}
}

if ($Cinsiyeti==1) {
	$Usaq_Sor=$db->prepare("SELECT * FROM user_usaq where ID=:ID");
	$Usaq_Sor->execute(array(
		'ID'=>$ID));
	$Usaq_Say=$Usaq_Sor->rowCount();
	if ($Usaq_Say>=2) {
		$usagagoregun=0;
		$Mezuniyyete_Cixdigi_Il    = date("Y", strtotime($Tedbiq_Edildiyi_Tarix));
		while ($Usaq_Cek=$Usaq_Sor->fetch(PDO::FETCH_ASSOC)) {
			$Usaq_Dogum_tarixi=$Usaq_Cek['Dogum_Tarixi_Beynel'];
			$dogumilitap=explode("-", $Usaq_Dogum_tarixi);
			$dogumili=$dogumilitap[0];					
			$Usagin_Yasi=$Mezuniyyete_Cixdigi_Il-$dogumili;
			if ($Usagin_Yasi>0 and  $Usagin_Yasi<14) {
				$usagagoregun++;
			}
		}
	}
	if ($usagagoregun==2) {
		$mezuniyyetgunu=$mezuniyyetgunu+2;
	} elseif($usagagoregun>=3){
		$mezuniyyetgunu=$mezuniyyetgunu+5;
	}

}

if(isset($mezuniyyetgunu)){
	$Istesalat_Bitis=Traix_Uzerine_Gel($Tedbiq_Edildiyi_Tarix,$mezuniyyetgunu,"day");



	$Teqvim_Sor=$db->prepare("SELECT * FROM istehsalt_teqvimi WHERE Tarix_Adi_Beynelxalq >=:Tedbiq_Edildiyi_Tarix and Tarix_Adi_Beynelxalq <=:Istesalat_Bitis");
	$Teqvim_Sor->execute(array(
		'Tedbiq_Edildiyi_Tarix'=>$Tedbiq_Edildiyi_Tarix,
		'Istesalat_Bitis'=>$Istesalat_Bitis));
	$Teqvim_Say=$Teqvim_Sor->rowCount();

	if ($Teqvim_Say>0) {
		$mezuniyyeti=$mezuniyyetgunu;
		while ($Teqvim_Cek=$Teqvim_Sor->fetch(PDO::FETCH_ASSOC)) {
			$Sebeb=$Teqvim_Cek['Sebeb'];
			if ($Sebeb==1 or $Sebeb==5) {
				$mezuniyyeti++;			
			}		
		}
		$CixisHesabdla    = Traix_Uzerine_Gel($Tedbiq_Edildiyi_Tarix,$mezuniyyeti,"day");
	}	else{
		$CixisHesabdla    = Traix_Uzerine_Gel($Tedbiq_Edildiyi_Tarix,$mezuniyyetgunu,"day");
	}


	$IseCixisTarixi = IscixisiHesabla($CixisHesabdla, $db);
	$data['status']="succes";
	$data['message']="Məzuniyyətə çıxma tarixi səhv";		
	$data['Mezuniyyet_Ise_Cixma_Tarixi']=Tarix_Beynelxalqi_Az_Cevir($IseCixisTarixi);

	$data['Mezuniyyet_Bitis_Tarixi']=Tarix_Beynelxalqi_Az_Cevir($CixisHesabdla);
	$data['mezuniyyetgunu']=$mezuniyyetgunu;
	if ($Mezuniyyet_Qaliq_Gun==null) {
		$Mezuniyyet_Qaliq_Gun=0;
	}

	$data['Mezuniyyet_Qaliq_Gun']=$Mezuniyyet_Qaliq_Gun;
	$data['Xidmet_Ili']=$Xidmet_Ili;
	$data['Mezuniyyet_Xidmet_Ili_Baslagic']=$Xidmet_Ili_BaslagicAZ;
	$data['Mezuniyyet_Xidmet_Ili_Son']=$Xidmet_Ili_BitisAZ;
	echo json_encode($data);
	exit;
}







?>