<?php 
session_start(); ob_start();
require_once '../Ayarlar/baglan.php';
require_once '../Ayarlar/function.php';
if (isset($_POST['FIN'])) {
  $FIN_Kod=HerfVeReqemlerXaricButunKarakterleriSil($_POST['FIN']);
  $User_Sor=$db->prepare("SELECT * FROM user where FIN_Kod=:FIN_Kod and Durum=:Durum");
  $User_Sor->execute(array(
    'FIN_Kod'=>$FIN_Kod,
    'Durum'=>1));
  $say=$User_Sor->rowCount();
  if ($say==1) {
    $User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);    
    $Sor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID and KadirGirisYetgisi=:KadirGirisYetgisi");
    $Sor->execute(array(
      'ID'=>$User_Cek['ID'],
      'KadirGirisYetgisi'=>1
    ));
    $Selsay=$Sor->rowCount();
    if ($Selsay) {
      $_SESSION['user']=$User_Cek['ID'];
     header("Location:../");
     exit;
   }else{
     header("Location:login.php");
     exit;
   }

 }else{
   header("Location:login.php");
   exit;
 }

}else{
  header("Location:404.php");
  exit;
}


?>