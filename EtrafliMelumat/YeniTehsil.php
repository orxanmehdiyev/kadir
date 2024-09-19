<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-6">
				<label for="Tehsil_Aldigi_Muesise" class="form-label">Bitirdiyi Təhsil müəsissəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Tehsil_Aldigi_Muesise" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-6">
				<label for="Ixtisas" class="form-label">İxtisası<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ixtisas" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	 
			<div class="col-6">
				<label for="Tehsil" class="form-label">İxtisası<span class="KirmiziYazi">*</span></label>
				<select id="Tehsil" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected"></option>
					<optgroup label="Ümumi Təhsil">
						<option value="1">İbtidai</option>
						<option value="2">Ümumi Orta</option>
						<option value="3">Tam Orta</option>
					</optgroup>
					<optgroup label="Peşə təhsili">
						<option value="4">İlk Peşə </option>
						<option value="5">Texniki Peşə</option>
						<option value="6">Yüksək Texniki Peşə</option>
					</optgroup>
					<optgroup label="Orta ixtisas">
						<option value="7">Orta ixtisas</option>								
					</optgroup>
					<optgroup label="Ali təhsil">
						<option value="8">Bakalavriat</option>								
						<option value="9">Magistratura (Rezidentura)</option>								
						<option value="10">Doktorantura (Adyunktura)</option>								
					</optgroup>
				</select>
			</div>	 
			<div class="col-3">
				<label for="Qebul_Tarixi" class="form-label">Qəbul tarixi<span class="KirmiziYazi">*</span></label>
				<input type="date" class="form-control" id="Qebul_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-3">
				<label for="Bitirdiyi_Tarix" class="form-label">Bitirdiyi tarix<span class="KirmiziYazi">*</span></label>
				<input type="date" class="form-control" id="Bitirdiyi_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="YeniTehsilFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">

				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>
			
		</form>	
	</div>
	<?php } ?>