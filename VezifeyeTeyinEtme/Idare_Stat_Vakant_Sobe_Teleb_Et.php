<?php 
require_once '../Ayarlar/setting.php';
$Idare_Id=ReqemlerXaricButunKarakterleriSil($_POST['Idare_Id']);
$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Idare_Id=:Idare_Id and User_Id=:User_Id and vezife.Durum=:Durum and Stat_Muqavile=:Stat_Muqavile");
$Vezife_Sor->execute(array(
	'yeniemir'=>0,
	'Idare_Id'=>$Idare_Id,
	'User_Id'=>0,
	'Durum'=>1,
	'Stat_Muqavile'=>0
));
$vakanvezifesayi=$Vezife_Sor->rowCount();

$Vezife_Sor=$db->prepare("SELECT DISTINCT Sobe_Id FROM vezife where  NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Idare_Id=:Idare_Id and User_Id=:User_Id and Stat_Muqavile=:Stat_Muqavile and Durum=:Durum ");
$Vezife_Sor->execute(array(
	'yeniemir'=>0,
	'Idare_Id'=>$Idare_Id,
	'User_Id'=>0,
	'Stat_Muqavile'=>0,
	'Durum'=>1));
$vakansobesayi=$Vezife_Sor->rowCount();
?>
<label for="Islediyi_Sobe" class="form-label">Şöbə<span class="KirmiziYazi">*</span></label>
<input type="hidden" id="vakansobesayi" value="<?php echo $vakanvezifesayi ?>">
<select class="form-select" id="Islediyi_Sobe" required="required" onchange="StatSobeVezifeTelebEt(this.id)" tabindex="13" title="">
	<option ></option>
	<?php 
	while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)){
		$Sobe_Id=$Vezife_Cek['Sobe_Id'];
		$Idare_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id order by Sira_No ASC");
		$Idare_Sor->execute(array(
			'Sobe_Id'=>$Sobe_Id));
		while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)){
			?>
			<option value="<?php echo $Idare_Cek['Sobe_Id'] ?>"><?php echo $Idare_Cek['Sobe_Ad'] ?></option>
		<?php }?>

	<?php } ?>
</select>