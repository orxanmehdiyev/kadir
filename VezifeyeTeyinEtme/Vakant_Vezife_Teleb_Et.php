<?php 
require_once '../Ayarlar/setting.php';
$Sobe_Id=ReqemlerXaricButunKarakterleriSil($_POST['Sobe_Id']);
$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Sobe_Id=:Sobe_Id and User_Id=:User_Id and vezife.Durum=:Durum and Stat_Muqavile=:Stat_Muqavile order by Vezife_Adlari_Sira ASC, Sira_No ASC");
$Vezife_Sor->execute(array(
	'yeniemir'=>0,
	'Sobe_Id'=>$Sobe_Id,
	'User_Id'=>0,
	'Durum'=>1,
	'Stat_Muqavile'=>0
));
$vakanvezifesayi=$Vezife_Sor->rowCount();
?>
<label for="Vezife_Id" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
<input type="hidden" id="vakanvezifesayi" value="<?php echo $vakanvezifesayi ?>">
<select class="form-select" required="required"  id="Vezife_Id" onchange="SelectAlaniSecildi(this.id)" tabindex="14" title="">
	<option ></option>
	<?php 
	while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)){	
		?>
		<option value="<?php echo $Vezife_Cek['Vezife_Id'] ?>"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></option>
	<?php  } ?>
</select>