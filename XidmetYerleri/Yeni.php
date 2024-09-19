<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) { ?>
	<div class="row">
		<form class="row g-3 p-2 ">

			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
				<label for="xidmet_yerleri_ad" class="form-label">Xidmət yeri adı<span class="KirmiziYazi">*</span></label>
				<input type="select" class="form-control" id="xidmet_yerleri_ad" oninput="SebebAlaniYazildi(this.id)" onfocusout="SebebAlaniYazildi(this.id)" required="required" maxlength="255" tabindex="4" title="">
			</div>


			<div class="col-12 text-center mt-3">
				<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()" class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi" id="errorcavabi"></b></p>
			</div>
		</form>
	</div>
<?php } ?>