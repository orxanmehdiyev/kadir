<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2">						
			<div class="col-3">
				<label for="UsaqSoyadi" class="form-label">Soyadı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="UsaqSoyadi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-3">
				<label for="UsaqAdi" class="form-label">Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="UsaqAdi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
      
			<div class="col-3">
				<label for="UsaqAtaadi" class="form-label">Ata adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="UsaqAtaadi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>
			<div class="col-2">
				<label for="Usaq_Dogum_Tarixi" class="form-label">Doğum tarixi<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control tarix"  id="Usaq_Dogum_Tarixi" value="<?php echo $TekTarix ?>"  oninput="TarixKontrol(this.id)" onfocusout="TarixKontrol(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="10" tabindex="1" title="">
			</div>
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="UsaqYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>