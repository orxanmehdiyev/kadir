<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {
	$Tutdugu_Vezife_Sor=$db->prepare("SELECT * FROM  user_islediyi_vezife where User_Islediyi_Vezife_Id=:User_Islediyi_Vezife_Id ");
	$Tutdugu_Vezife_Sor->execute(array(
		'User_Islediyi_Vezife_Id'=>ReqemlerXaricButunKarakterleriSil($_POST['yeni'])));
	$Tutdugu_Vezife_Cek=$Tutdugu_Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row">						
		<form class="row g-3 p-2 ">	
		<input type="hidden" id="User_Islediyi_Vezife_Id" value="<?php echo ReqemlerXaricButunKarakterleriSil($_POST['yeni']) ?>">					
			<div class="col-4">
				<label for="Idare_Ad" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" name="Idare_Ad" id="Idare_Ad" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Tutdugu_Vezife_Cek['Idare_Ad'] ?>" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" name="Sobe_Ad" id="Sobe_Ad" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Tutdugu_Vezife_Cek['Sobe_Ad'] ?>" required="required" maxlength ="255" tabindex="1" title="">
			</div>	 
			<div class="col-4">
				<label for="Vezife_Ad" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" name="Vezife_Ad" id="Vezife_Ad" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Tutdugu_Vezife_Cek['Vezife_Ad'] ?>" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-4">
				<label for="Sebeb" class="form-label">Səbəb<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" name="Sebeb" id="Sebeb" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Tutdugu_Vezife_Cek['Sebeb'] ?>" required="required" maxlength ="255" tabindex="1" title="">
			</div> 

			<?php 
			$TeyinTarix=explode(".", $Tutdugu_Vezife_Cek['Vezifeye_Teyin_Tarixi']);
			$Vezifeye_Teyin_Tarixi=$TeyinTarix[2]."-".$TeyinTarix[1]."-".$TeyinTarix[0];

			$AzadolTarix=explode(".", $Tutdugu_Vezife_Cek['Vezifeden_Azad_Olunma_Tarixi']);
			$Vezifeden_Azad_Olunma_Tarixi=$AzadolTarix[2]."-".$AzadolTarix[1]."-".$AzadolTarix[0];
			?>
			<div class="col-4">
				<label for="Vezifeye_Teyin_Tarixi" class="form-label">Təyin tarixi<span class="KirmiziYazi">*</span></label>
				<input type="date" class="form-control" name="Vezifeye_Teyin_Tarixi" id="Vezifeye_Teyin_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Vezifeye_Teyin_Tarixi ?>" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-4">
				<label for="Vezifeden_Azad_Olunma_Tarixi" class="form-label">Azadolma tarixi<span class="KirmiziYazi">*</span></label>
				<input type="date" class="form-control" name="Vezifeden_Azad_Olunma_Tarixi" id="Vezifeden_Azad_Olunma_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Vezifeden_Azad_Olunma_Tarixi ?>" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="YeniTutduguVezifeDuzenleFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari"  tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>