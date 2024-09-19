<?php require_once '../Ayarlar/setting.php';
if ($HeveslendiremAdlariYeni==1) {
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-12">
				<label for="heveslendirem_tedbirleri_ad" class="form-label">Həvəsləndirmə Tədbirinin Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="heveslendirem_tedbirleri_ad" oninput="TenbehAdiYazildi(this.id)" onfocusout="TenbehAdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
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
	} ?>