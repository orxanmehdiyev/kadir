<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-4">
				<label for="Attestasiya_Idare_Adi" class="form-label">İdarə Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Attestasiya_Idare_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-4">
				<label for="Attestasiya_Sobe_Adi" class="form-label">Şöbə Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Attestasiya_Sobe_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-4">
				<label for="Attestasiya_Vezife_Adi" class="form-label">Vəzifə Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Attestasiya_Vezife_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-2">
				<label for="Attestasiya_Tarix" class="form-label">Tarixi<span class="KirmiziYazi">*</span></label>
				<input type="date" class="form-control" id="Attestasiya_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>

			<div class="col-3">
				<label for="Attestasiya_Emr_No" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Attestasiya_Emr_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>
			<div class="col-4">
				<label for="Attestasiya_Qerar" class="form-label">Komisiyanın Qərarı<span class="KirmiziYazi">*</span></label>
				<select id="Attestasiya_Qerar" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>								?>
					<option value="0">Uyğun deyil</option>
					<option value="1">Uyğundur</option>
				</select>
			</div>
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="AttestasiyaYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>