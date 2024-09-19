<?php 
require_once '../Ayarlar/setting.php';
$deyer =json_decode($_POST['Deyer'],true);
$Mezuniyyet_Gun      =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Gun']); 
$Tedbiq_Edildiyi_Tarix                     =strtotime($deyer['Tedbiq_Edildiyi_Tarix']); 
$CixisHesabla    = date("Y-m-d", $Tedbiq_Edildiyi_Tarix);	
$CixisHesablaCevir      = date_create($CixisHesabla);
date_modify($CixisHesablaCevir, "+".$Mezuniyyet_Gun." day"); 	
$CixisHesablaCevir_Unix = date_timestamp_get($CixisHesablaCevir);
$IseCixisTarixi = TeqvimIsGunuHesabla($CixisHesablaCevir_Unix, $db);
$data['Mezuniyyet_Ise_Cixma_Tarixi']=$IseCixisTarixi;
$mezbitis=date("d.m.Y",$CixisHesablaCevir_Unix);
$data['Mezuniyyet_Bitis_Tarixi']=$mezbitis;
$data['status']="succes";
echo json_encode($data);
exit;
?>