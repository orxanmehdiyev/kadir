<?php 
require_once '../Ayarlar/setting.php';
$Idare_Id=ReqemlerXaricButunKarakterleriSil($_POST['Idare_Id']);
?>
<label for="Sobe_Id" class="form-label">Şöbə<span class="KirmiziYazi">*</span></label>
<select class="form-select" id="Sobe_Id" required="required" onchange="SelectAlaniSecildi(this.id)" tabindex="13" title="">
	<option ></option>
	<?php 
		$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id order by Sira_No ASC");
		$Sobe_Sor->execute(array(
			'Idare_Id'=>$Idare_Id));
		while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)){
			?>
			<option value="<?php echo $Sobe_Cek['Sobe_Id'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
		<?php }?>

</select>