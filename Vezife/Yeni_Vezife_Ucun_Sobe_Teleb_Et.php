<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Idare_Id'])) {
	$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC ");
	$Sobe_Sor->execute(array(
		'Idare_Id'=>ReqemlerXaricButunKarakterleriSil($_REQUEST['Idare_Id']),
		'Durum'=>1
	));
		?>
		<select name="Sobe_Id" tabindex="2" required="required" id="Sobe_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
			<option disabled="disabled" value="" selected="selected"> </option>
			<?php
			while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
				?>
				<option value="<?php echo $Sobe_Cek['Sobe_Id'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
			<?php } ?>
		</select>
	<?php } else{
		header("Location:../login.php");
		exit;
	} ?>

