<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Ise_Qebul_Emri_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM  ise_qebul_emri where  Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id");
	$Sor->execute(array(
		'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	?>
	<input type="hidden" id="Ise_Qebul_Emri_Id" value="<?php echo $Ise_Qebul_Emri_Id ?>">
	<div class="row  g-3 p-2">
		
		<div class="col-4">
			<label for="User_Soy_Ad" class="form-label">Soyadı<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control " id="User_Soy_Ad" oninput="MetinAlaniYazildi(this.id)"  onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="" maxlength = "20" tabindex="1" title="" value="<?php echo $Cek['User_Soy_Ad'] ?>">
		</div>
		<div class="col-4">
			<label for="User_Ad" class="form-label">Adı<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control " id="User_Ad" oninput="MetinAlaniYazildi(this.id)"  onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="" maxlength = "20" tabindex="2" title="" value="<?php echo $Cek['User_Ad'] ?>">
		</div>
		<div class="col-4">
			<label for="User_Ata_Ad" class="form-label">Ata Adı<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control " id="User_Ata_Ad" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="" maxlength = "20" tabindex="3" title="" value="<?php echo $Cek['User_Ata_Ad'] ?>">
		</div>
		<div class="col-2">
			<label for="User_Dogum_Tarixi" class="form-label">Doğum Tarixi<span class="KirmiziYazi">*</span></label>
			<input type="date" class="form-control" id="User_Dogum_Tarixi" oninput="TarixAlaniYazildi(this.id)"  onfocusout="TarixAlaniYazildi(this.id)" required="" maxlength = "10" tabindex="4" title="" value="<?php
			$User_Dogum_Tarixi=explode(".", $Cek['User_Dogum_Tarixi']);
			echo $User_Dogum_Tarixi[2]."-".$User_Dogum_Tarixi[1]."-".$User_Dogum_Tarixi[0];  ?>">
		</div>
		<div class="col-2">
			<label for="User_Fin" class="form-label">Fin<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control uppercase"  id="User_Fin" oninput="FinKodAlaniYazildi(this.id)"  onfocusout="FinKodAlaniYazildi(this.id)" required="" maxlength = "7" tabindex="5" title="" value="<?php echo $Cek['User_Fin'] ?>">
		</div>
		<div class="col-8">
			<label for="User_Yasayis_Unvan" class="form-label">Ünvanı<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control " id="User_Yasayis_Unvan" oninput="UnvanAlaniYazildi(this.id)"  onfocusout="UnvanAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="" maxlength = "200" tabindex="6" title="" value="<?php echo $Cek['User_Yasayis_Unvan'] ?>">
		</div>
		<div class="col-2">
			<label for="User_Tehsil	" class="form-label">Təhsili<span class="KirmiziYazi">*</span></label>
			<select required="" id="User_Tehsil" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">							
				<optgroup label="Ümumi Təhsil"><option value="1" <?php if ($Cek['User_Tehsil']==1) {echo "selected";}else{} ?>>İbtidai</option>
					<option value="2" <?php if ($Cek['User_Tehsil']==2) {echo "selected";}else{} ?>>Ümumi Orta</option>
					<option value="3" <?php if ($Cek['User_Tehsil']==3) {echo "selected";}else{} ?>>Tam Orta</option>
				</optgroup>
				<optgroup label="Peşə təhsili">
					<option value="4" <?php if ($Cek['User_Tehsil']==4) {echo "selected";}else{} ?>>İlk Peşə</option>
					<option value="5" <?php if ($Cek['User_Tehsil']==5) {echo "selected";}else{} ?>>Texniki Peşə</option>
					<option value="6" <?php if ($Cek['User_Tehsil']==6) {echo "selected";}else{} ?>>Yüksək Texniki Peşə</option>
				</optgroup>
				<optgroup label="Orta ixtisas">
					<option value="7" <?php if ($Cek['User_Tehsil']==7) {echo "selected";}else{} ?>>Orta ixtisas</option>								
				</optgroup>
				<optgroup label="Ali təhsil">
					<option value="8" <?php if ($Cek['User_Tehsil']==8) {echo "selected";}else{} ?>>Bakalavriat</option>								
					<option value="9" <?php if ($Cek['User_Tehsil']==9) {echo "selected";}else{} ?>>Magistratura (Rezidentura)</option>								
					<option value="10" <?php if ($Cek['User_Tehsil']==10) {echo "selected";}else{} ?>>Doktorantura (Adyunktura)</option>								
				</optgroup>
			</select>
		</div> 
		<div class="col-10">
			<label for="User_Tehsil_Aldigi_Muesse" class="form-label">Universitet/İxtisas<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" required="" id="User_Tehsil_Aldigi_Muesse" oninput="UnvanAlaniYazildi(this.id)" onfocusout="UnvanAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="8" value="<?php echo $Cek['User_Tehsil_Aldigi_Muesse'] ?>">
		</div> 

		<div class="col-10">
			<label for="Ixtisas" class="form-label">İxtisas<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" required="" id="Ixtisas" oninput="UnvanAlaniYazildi(this.id)" onfocusout="UnvanAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="8" value="<?php echo $Cek['Ixtisas'] ?>">
		</div> 
		
		<div class="col-2">
			<label for="User_Ise_Qebul_Tarixi" class="form-label">İşə qəbul tarixi<span class="KirmiziYazi">*</span></label>
			<input type="date" class="form-control" required="" id="User_Ise_Qebul_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "10" tabindex="8" title="" value="<?php
			$User_Ise_Qebul_Tarixi=explode(".", $Cek['User_Ise_Qebul_Tarixi']);
			echo $User_Ise_Qebul_Tarixi[2]."-".$User_Ise_Qebul_Tarixi[1]."-".$User_Ise_Qebul_Tarixi[0];
		?>">
	</div>
	<div class="col-2">
		<label for="Usre_Cinsiyeti" class="form-label">Cinsiyyəti<span class="KirmiziYazi">*</span></label>
		<select required="" id="Usre_Cinsiyeti" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
			<option disabled="disabled" value="" selected="selected" tabindex="9"></option>										
			<option value="0" <?php if ($Cek['Usre_Cinsiyeti']==0) {echo "selected";}else{} ?>>Kişi</option>
			<option value="1" <?php if ($Cek['Usre_Cinsiyeti']==1) {echo "selected";}else{} ?> >Qadın</option>
		</select>
	</div>

	<div class=" col-3 sinaqmuddeti">
		<label for="SinaqMuddeti" class="form-label">Sinaq Müddəti<span class="KirmiziYazi">*</span></label>	
		<input required="" type="number"  class="form-control sinaqmuddetigun" min="0" max="365" id="SinaqMuddeti" oninput="ReqemAlaniYazildi(this.id)" title="" onkeydown="javascript: return event.keyCode == 69 ? false : true"  onfocusout="ReqemAlaniYazildi(this.id)" maxlength="3" tabindex="9" value="<?php echo ($Cek['SinaqMuddeti']) ?>">
		<select required="" id="SinaqMuddetiGunAy" class="form-select sinaqmuddetigunay" onchange="SelectAlaniSecildi(this.id)" title="">	
			<option value="0" <?php if ($Cek['SinaqMuddetiGunAy']==0) {echo "selected";}else{} ?>>Ay</option>
			<option value="1" <?php if ($Cek['SinaqMuddetiGunAy']==1) {echo "selected";}else{} ?>>Gün</option>			

		</select>
	</div>
	<div class="col-2">
		<label for="User_Is_Novu" class="form-label" >İşin Növü<span class="KirmiziYazi">*</span></label>	
		<select required="" id="User_Is_Novu" class="form-select" onchange="DuselisVakanYerleriSay(this.id)" title="">
			<option disabled="disabled" value="" selected="selected" tabindex="9"></option>										
			<option value="0" <?php if ($Cek['User_Is_Novu']==0) {echo "selected";}else{}  ?>>Ştat Daxili</option>
			<option value="1" <?php if ($Cek['User_Is_Novu']==1) {echo "selected";}else{}  ?>>Ştatdan Kənar</option>
		</select>
	</div> 
	<div class="col-6">
		<label for="Ise_Qebul_Emri_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
		<input type="text" class="form-control" id="Ise_Qebul_Emri_Nomresi" oninput="UnvanAlaniYazildi(this.id)" title=""  onfocusout="UnvanAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" value="<?php echo $Cek['Ise_Qebul_Emri_Nomresi'] ?>">
	</div> 
	<div class="col-12">
		<label for="Mezmun" class="form-label">Qeyd</label>
		<input type="text" class="form-control" id="Mezmun" tabindex="11" title="" value="<?php echo $Cek['Mezmun'] ?>">
	</div>
	<div class="col-12 text-center mt-3">
		<?php 
		if ($Cek['Ise_Qebul_Emri_Stausu']!=1) {
			?>
			<button type="button" onclick="DuzelisYoxlanis(this.id)" id="yaddasyoxlanis_<?php echo $Ise_Qebul_Emri_Id ?>" class="YenileButonlari" tabindex="15">Düzəliş Et</button>
		<?php }else{} 
		if ($Cek['Ise_Qebul_Emri_Stausu']!=1) {
			?>
			<button type="button" onclick="Bax(this.id)" id="Bax_<?php echo $Ise_Qebul_Emri_Id ?>" class="YenileButonlari" tabindex="15">İmtina</button>
		<?php }else{} ?>
	</div>
	
	<div class="col-6">				
		<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
	</div>
</div>
<?php } ?>