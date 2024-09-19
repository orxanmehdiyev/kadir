<?php 
require_once '../Ayarlar/baglan.php';
require_once '../Ayarlar/function.php';
if (isset($_GET['fin'])) {
  $data = array();
  $FIN_Kod=HerfVeReqemlerXaricButunKarakterleriSil($_GET['fin']);
  $User_Sor=$db->prepare("SELECT * FROM user where FIN_Kod=:FIN_Kod and Durum=:Durum");
  $User_Sor->execute(array(
    'FIN_Kod'=>$FIN_Kod,
    'Durum'=>1,
  ));
  $say=$User_Sor->rowCount();
  if ($say==1) {
    $User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC); 
    $data[0]=  $say;
    $ID=$User_Cek['ID'];

    $Sor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID");
    $Sor->execute(array(
      'ID'=>$ID
    ));
    $Selsay=$Sor->rowCount();
    if ($Selsay==1) {
     $Cek=$Sor->fetch(PDO::FETCH_ASSOC); 
     $data[1]=$Cek['KadirGirisYetgisi'];
   }else{
    $data[1]=3;
  }


  $personal_rutbe_sekil=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC limit 1");
  $personal_rutbe_sekil->execute(array(
    'ID'=>$ID));
  $personal_rutbe_sekil_cek=$personal_rutbe_sekil->fetch(PDO::FETCH_ASSOC);
  if (strlen($personal_rutbe_sekil_cek['Rutbe_Img'])>0) {
    $data[9]=$personal_rutbe_sekil_cek['Rutbe_Img'];
  }else{
    $data[9]="Senedler/Rutbe/nophoto.png";
  }


  echo json_encode($data);
}else{
 header("Location:login.php");
 exit;
}

}else{
  header("Location:404.php");
  exit;
}


?>