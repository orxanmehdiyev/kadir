<?php 
require_once '../Ayarlar/baglan.php';
require_once '../Ayarlar/function.php';
$Stat_Muqavile=ReqemlerXaricButunKarakterleriSil($_POST['Vezifenin_Novu']);
$Vezife_Sor=$db->prepare("SELECT DISTINCT Idare_Id FROM vezife where NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Stat_Muqavile=:Stat_Muqavile and  User_Id=:User_Id and vezife.Durum=:Durum");
$Vezife_Sor->execute(array(
	'yeniemir'=>0,
	'Stat_Muqavile'=>$Stat_Muqavile,
	'User_Id'=>0,
	'Durum'=>1));
$Vezife_Say=$Vezife_Sor->rowCount();
?>
<option ></option>
<?php 
while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)){
	$Idare_Id=$Vezife_Cek['Idare_Id'];
	$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id order by Sira_No ASC");
	$Idare_Sor->execute(array(
		'Idare_Id'=>$Idare_Id));
	while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)){
		?>
		<option value="<?php echo $Idare_Cek['Idare_Id'] ?>"><?php echo $Idare_Cek['Idare_Adi'] ?></option>
		<?php 
	}
} ?>