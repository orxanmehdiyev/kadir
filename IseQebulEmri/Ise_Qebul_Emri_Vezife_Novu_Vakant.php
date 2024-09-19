<?php 
require_once '../Ayarlar/baglan.php';
require_once '../Ayarlar/function.php';
$Stat_Muqavile=ReqemlerXaricButunKarakterleriSil($_POST['Stat_Muqavile']);
$Vezife_Sor=$db->prepare("SELECT * FROM vezife where NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Stat_Muqavile=:Stat_Muqavile and User_Id=:User_Id and vezife.Durum=:Durum ");
$Vezife_Sor->execute(array(
	'yeniemir'=>0,
	'Stat_Muqavile'=>$Stat_Muqavile,
	'User_Id'=>0,
	'Durum'=>1
));
echo $Vezife_Say=$Vezife_Sor->rowCount();
?>


