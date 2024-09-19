<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$dizi = explode ("_",$_POST['Deyer']);
	$stunadi=trim($dizi[0]);
	$Sor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID ");
	$Sor->execute(array(
		'ID'=>$dizi[1]));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	if ($Cek[$stunadi]==1) {
		$deyer=0;
	}else{
		$deyer=1;
	}
	$yenile = $db->prepare("UPDATE selahiyyet SET     
		$stunadi=:deyer
		WHERE ID=$dizi[1]");
	$update = $yenile->execute(array(     
		'deyer'=>$deyer
	)); 
}
?>