<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row p-2 " id="xestelikaxtaris">	
			
			<div class="col-2" style="width:120px;" >
				<label for="Xestelik_Baslagic_Tarixi" style="width: 206px" class="form-label ">Başlanğıc tarixi</label>
				<input type="text" class="form-control pickmeup_1 tarix" placeholder="__.__._____" autocomplete="off" maxlength="10" name="Xestelik_Baslagic_Tarixi"  title="">
			</div>			

			<div class="col-2">
				<label for="Xestelik_Ise_Cixma_Tarixi" style="width: 206px" class="form-label ">Bitiş tarixi</label>
				<input type="text" class="form-control pickmeup_1 tarix" autocomplete="off" name="Xestelik_Ise_Cixma_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  placeholder="__.__._____" required="required" maxlength="10" tabindex="5" title="">
			</div>

			<hr>
			<div class="col-4">
				<label for="Soyadi" class="form-label">Soyadı</label>
				<input type="tarix" class="form-control"  name="Soyadi"  title="">
			</div>	
			<div class="col-4">
				<label for="Adi" class="form-label">Adı</label>
				<input type="tarix" class="form-control"  name="Adi" title="">
			</div>
			<div class="col-4">
				<label for="AtaAdi" class="form-label">Ata adı</label>
				<input type="tarix" class="form-control"  name="AtaAdi"  title="">
			</div>
			<hr>
			<div class="col-3">
				<label for="Xestelik_Vereqi_No" style="width: 206px" class="form-label ">Xəstəlik vərəqinin nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="" name="Xestelik_Vereqi_No" title="">
			</div>







			<hr>
			<div class="col-12 text-center mt-3">
				<button type="button"  id="formgonder" onclick="Axtar()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>	
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>
		</form>	
	</div>
	<?php } ?>