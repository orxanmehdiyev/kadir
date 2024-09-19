<?php require_once '../Ayarlar/setting.php';
if ($MezuniyyetAdlariYeni==1) {
	if (isset($_POST['yeni'])) {?>
		<div class="row">						
			<form class="row g-3 p-2 ">						
				<div class="col-6">
					<label for="Mezuniyyet_Novleri_Ad" class="form-label">Adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Mezuniyyet_Novleri_Ad" oninput="Adıyazıldı(this.id)" onfocusout="Adıyazıldı(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>	
				<div class="col-6">
					<label for="Mezuniyyet_Novleri_Kissa_Ad" class="form-label">Kıssa adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Mezuniyyet_Novleri_Kissa_Ad" oninput="Adıyazıldı(this.id)" onfocusout="Adıyazıldı(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>	 
				<div class="col-12 text-center mt-3">
					<button type="button" onclick="FormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>
				<div class="col-6">

					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>
				
			</form>	
		</div>
	<?php } 
}?>