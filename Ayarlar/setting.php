<?php 
session_start(); ob_start();
if (isset($_SESSION['user'])) {
	$ID=$_SESSION['user'];
}else{
	$ID="";
	header("Location:login.php");
	exit;
}
require_once 'baglan.php';
require_once 'function.php';
require_once 'SimpleXLSX.php';

$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID ");
$User_Sor->execute(array(
	'ID'=>$ID));
$say=$User_Sor->rowCount();
if ($say==1) {	
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$User_Id=$User_Cek['ID'];
	$Admin_Id=$User_Cek['ID'];
	$Admin_Ad=$User_Cek['Adi'];
	$Admin_Soyad=$User_Cek['Soy_Adi'];
	$Admin_Ataadi=$User_Cek['Ata_Adi'];
	$Admin_Vezife=$User_Cek['Vezife_Ad'];
	$Admin_Islediyi_Idare_Id=$User_Cek['Islediyi_Idare_Id'];
	$Admin_Vezife_Ad=$User_Cek['Vezife_Ad'];
	$Soy_Adi=$User_Cek['Soy_Adi'];
	$Adi=$User_Cek['Adi'];
	$Islediyi_Idare_Id=$User_Cek['Islediyi_Idare_Id'];


	$Admin_Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id ");
	$Admin_Idare_Sor->execute(array(
		'Idare_Id'=>$Admin_Islediyi_Idare_Id));
	$Admin_Idare_Cek=$Admin_Idare_Sor->fetch(PDO::FETCH_ASSOC);
	$Admin_Idare_Kissa_Adi=$Admin_Idare_Cek['Idare_Kissa_Adi'];
}else{
	header("Location:login.php");
	exit;
}

$SelahiyyetSor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID ");
$SelahiyyetSor->execute(array(
	'ID'=>$ID));
$SelahiyyetCek=$SelahiyyetSor->fetch(PDO::FETCH_ASSOC);
$KadirGirisYetgisi=$SelahiyyetCek['KadirGirisYetgisi'];
$TenzimlenmelerMenusu=$SelahiyyetCek['TenzimlenmelerMenusu'];
$BasIdare=$SelahiyyetCek['BasIdare'];
$YeniBasIdare=$SelahiyyetCek['YeniBasIdare'];
$BasIdareAktivPassiv=$SelahiyyetCek['BasIdareAktivPassiv'];
$BasIdareDuzenle=$SelahiyyetCek['BasIdareDuzenle'];
$BasIdareSil=$SelahiyyetCek['BasIdareSil'];
$IdarelerMenusu=$SelahiyyetCek['IdarelerMenusu'];
$IdarelerYeni=$SelahiyyetCek['IdarelerYeni'];
$IdarelerDurumKontrol=$SelahiyyetCek['IdarelerDurumKontrol'];
$IdarelerDuzelis=$SelahiyyetCek['IdarelerDuzelis'];
$IdarelerSil=$SelahiyyetCek['IdarelerSil'];
$IdarelerIslemlereBaxis=$SelahiyyetCek['IdarelerIslemlereBaxis'];

$SobeBolmelerMenusu=$SelahiyyetCek['SobeBolmelerMenusu'];
$SobeBolmeYeni=$SelahiyyetCek['SobeBolmeYeni'];
$SobeBolmeDurumKontrol=$SelahiyyetCek['SobeBolmeDurumKontrol'];
$SobeBolmeDuzelis=$SelahiyyetCek['SobeBolmeDuzelis'];
$SobeBolmeSil=$SelahiyyetCek['SobeBolmeSil'];

$VezifelerMenusu=$SelahiyyetCek['VezifelerMenusu'];
$VezifelerYeniButtonu=$SelahiyyetCek['VezifelerYeniButtonu'];
$VezifelerDurum=$SelahiyyetCek['VezifelerDurum'];
$VezifelerDuzeli=$SelahiyyetCek['VezifelerDuzeli'];
$VezifelerSil=$SelahiyyetCek['VezifelerSil'];
$VezifeButunIdareler=$SelahiyyetCek['VezifeButunIdareler'];

$VezifeAdlariMenusu=$SelahiyyetCek['VezifeAdlariMenusu'];
$VezifeAdlariSira=$SelahiyyetCek['VezifeAdlariSira'];
$VezifeAdlariAktivPassiv=$SelahiyyetCek['VezifeAdlariAktivPassiv'];
$VezifeAdlariSil=$SelahiyyetCek['VezifeAdlariSil'];
$VezifeAdlariYeni=$SelahiyyetCek['VezifeAdlariYeni'];

$RutbeAdlariMensu=$SelahiyyetCek['RutbeAdlariMensu'];
$RutbeAdlariYeni=$SelahiyyetCek['RutbeAdlariYeni'];
$RutbeAdlariStatus=$SelahiyyetCek['RutbeAdlariStatus'];
$RutbeAdlariDuzelis=$SelahiyyetCek['RutbeAdlariDuzelis'];
$RutbeAdlariSil=$SelahiyyetCek['RutbeAdlariSil'];
$RutbeAdlariBaxis=$SelahiyyetCek['RutbeAdlariBaxis'];


$IntizamTenbehiAdlariMenu=$SelahiyyetCek['IntizamTenbehiAdlariMenu'];
$IntizamTenbehiAdlariYeni=$SelahiyyetCek['IntizamTenbehiAdlariYeni'];
$IntizamTenbehiAdlariNezerealma=$SelahiyyetCek['IntizamTenbehiAdlariNezerealma'];
$IntizamTenbehiAdlariNezerealmaGoster=$SelahiyyetCek['IntizamTenbehiAdlariNezerealmaGoster'];
$IntizamTenbehiAdlariStatus=$SelahiyyetCek['IntizamTenbehiAdlariStatus'];
$IntizamTenbehiAdlariDuzelis=$SelahiyyetCek['IntizamTenbehiAdlariDuzelis'];
$IntizamTenbehiAdlariSil=$SelahiyyetCek['IntizamTenbehiAdlariSil'];

$HeveslendiremAdlariMenusu=$SelahiyyetCek['HeveslendiremAdlariMenusu'];
$HeveslendiremAdlariYeni=$SelahiyyetCek['HeveslendiremAdlariYeni'];
$HeveslendiremAdlariNezereAlma=$SelahiyyetCek['HeveslendiremAdlariNezereAlma'];
$HeveslendiremAdlariStatus=$SelahiyyetCek['HeveslendiremAdlariStatus'];
$HeveslendiremAdlariDuzelis=$SelahiyyetCek['HeveslendiremAdlariDuzelis'];
$HeveslendiremAdlariSil=$SelahiyyetCek['HeveslendiremAdlariSil'];

$MezuniyyetAdlariMenusu=$SelahiyyetCek['MezuniyyetAdlariMenusu'];
$MezuniyyetAdlariYeni=$SelahiyyetCek['MezuniyyetAdlariYeni'];
$MezuniyyetAdlariStatus=$SelahiyyetCek['MezuniyyetAdlariStatus'];
$MezuniyyetAdlariDuzelis=$SelahiyyetCek['MezuniyyetAdlariDuzelis'];
$MezuniyyetAdlariSil=$SelahiyyetCek['MezuniyyetAdlariSil'];
$MezuniyyetAdlariBax=$SelahiyyetCek['MezuniyyetAdlariBax'];

$IstehsaltTeqvimimenu=$SelahiyyetCek['IstehsaltTeqvimimenu'];
$IstehsaltTeqvimiYeni=$SelahiyyetCek['IstehsaltTeqvimiYeni'];
$IstehsaltTeqvimiSil=$SelahiyyetCek['IstehsaltTeqvimiSil'];

$XidmeteXitamVerilmesiMensusu=$SelahiyyetCek['XidmeteXitamVerilmesiMensusu'];
$XidmeteXitamVerilmesiYeni=$SelahiyyetCek['XidmeteXitamVerilmesiYeni'];
$XidmeteXitamVerilmesisSebebiSil=$SelahiyyetCek['XidmeteXitamVerilmesisSebebiSil'];
$XidmeteXitamVerilmesisSebebiDuzelis=$SelahiyyetCek['XidmeteXitamVerilmesisSebebiDuzelis'];


$InsanResruslariEsasMenu=$SelahiyyetCek['InsanResruslariEsasMenu'];
$UmumiBaxisButunIdareler=$SelahiyyetCek['UmumiBaxisButunIdareler'];




?> 