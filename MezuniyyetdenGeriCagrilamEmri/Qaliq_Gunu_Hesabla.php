<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                          =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Geri_Cagrilama_Tarixi       =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Geri_Cagrilama_Tarixi']);
	$Mezuniyyet_Geri_Tarix       =  TarixAzCevir($Geri_Cagrilama_Tarixi);
	$Mezuniyyet_Geri_Tarix_Bey   =  TarixBeynelxalqCevir($Geri_Cagrilama_Tarixi);
	$Mezuniyyet_Geri_Tarix_Unix  =  TarixUnikCevir($Geri_Cagrilama_Tarixi);
	$Mezuniyyet_Sor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID order by Mezuniyyet_Baslagic_Tarixi_Unix DESC");
	$Mezuniyyet_Sor->execute(array(
		'ID'=>$ID));
	$Mezuniyyet_Cek=$Mezuniyyet_Sor->fetch(PDO::FETCH_ASSOC);
	$Mezuniyyet_Baslagic_Tarixi_Beynel=$Mezuniyyet_Cek['Mezuniyyet_Baslagic_Tarixi_Beynel'];
	$Mezuniyyet_Gun=$Mezuniyyet_Cek['Mezuniyyet_Gun'];
	$Mezuniyyet_Qaliq_Gun=$Mezuniyyet_Cek['Mezuniyyet_Qaliq_Gun'];
	$Mezuniyyet_Id=$Mezuniyyet_Cek['Mezuniyyet_Id'];
	$toplamgun=$Mezuniyyet_Gun+$Mezuniyyet_Qaliq_Gun;
	$d1 = new DateTime($Mezuniyyet_Geri_Tarix_Bey);
	$d2 = new DateTime($Mezuniyyet_Baslagic_Tarixi_Beynel);
	$gunferqi= $d1->diff($d2)->d; 
	$QalanGun=$toplamgun-$gunferqi;
	$Istehsalat_Sor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq>:Baslangic and Tarix_Adi_Beynelxalq<:Bitis");
	$Istehsalat_Sor->execute(array(
		'Baslangic'=>$Mezuniyyet_Baslagic_Tarixi_Beynel,
		'Bitis'=>$Mezuniyyet_Geri_Tarix_Bey));
	$IstehsalatSay=$Istehsalat_Sor->rowCount();
	if ($IstehsalatSay>0) {
		while ($Istehsalat_Cek=$Istehsalat_Sor->fetch(PDO::FETCH_ASSOC)) {
			$Sebeb=$Istehsalat_Cek['Sebeb'];
			if ($Sebeb==1 or $Sebeb==5 ) {
				$QalanGun++;
			}
		}			
	}
	$data['Mezuniyyet_Qaliq_Gun']=$QalanGun;
	echo json_encode($data);
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>