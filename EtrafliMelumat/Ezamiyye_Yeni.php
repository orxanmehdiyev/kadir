<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-5">
				<label for="Ezam_Olundugu_Yer" class="form-label">Ezam oluduğu yer<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Ezam_Olundugu_Yer" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-2">
				<label for="Ezam_Baslangic_Tarixi" class="form-label">Başlağıc Tarixi<span class="KirmiziYazi">*</span></label>
				<input type="date" class="form-control" id="Ezam_Baslangic_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>

			<div class="col-2">
				<label for="Ezam_Bitis_Tarixi" class="form-label">Bitiş Tarix<span class="KirmiziYazi">*</span></label>
				<input type="date" class="form-control" id="Ezam_Bitis_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>

			<div class="col-3">
				<label for="Ezam_Emri_No" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Ezam_Emri_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>
			<div class="col-10">
				<label for="Ezam_Sebebi" class="form-label">Səbəb və qeyd<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ezam_Sebebi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>		
			<div class="col-2">
				<label for="Ezam_Gun_Sayi" class="form-label">Səbəb və qeyd<span class="KirmiziYazi">*</span></label>
				<input type="number" class="form-control" min="1" max="365" id="Ezam_Gun_Sayi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	 





			<div class="col-12 text-center mt-3">
				<button type="button" onclick="EzamiyyeYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>