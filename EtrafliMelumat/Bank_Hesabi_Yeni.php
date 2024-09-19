<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 justify-content-center">						
			<div class="col-4">
				<label for="Bank_Hesab_Nomresi_Bank_Adi" class="form-label">Bankın adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Bank_Hesab_Nomresi_Bank_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-4">
				<label for="Bank_Hesab_Nomresi" class="form-label">Hesab nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Bank_Hesab_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="BankHesabNoYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>