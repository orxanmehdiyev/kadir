<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) { ?>
	<div class="row">
		<form class="row g-3 p-2 ">
			<div class="col-6">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>
					<?php
					$DavamSor = $db->prepare("SELECT * FROM isedavamiyyet where Tarix=:Tarix and istiqamet=:istiqamet");
					$DavamSor->execute(array(
						'Tarix' => $Tarix_Beynelxalq,
						'istiqamet' => 0,
					));
					while ($Davamcek = $DavamSor->fetch(PDO::FETCH_ASSOC)) {
						$YoxlaSor = $db->prepare("SELECT * FROM isedavamiyyet where Tarix=:Tarix and ID=:ID and istiqamet=:istiqamet order by isedavamiyyet_id DESC");
						$YoxlaSor->execute(array(
							'Tarix' => $Tarix_Beynelxalq,
							'ID' => $Davamcek['ID'],
							'istiqamet' => 0
						));
						$Yoxlacek = $YoxlaSor->fetch(PDO::FETCH_ASSOC);
						$yoxlaId = $Yoxlacek['isedavamiyyet_id'];
						if ($yoxlaId == $Davamcek['isedavamiyyet_id']) {

							$CixisQeydiyyat = $db->prepare("SELECT * FROM cixislarinqeydiyyati where isedavamiyyet_id=:isedavamiyyet_id");
							$CixisQeydiyyat->execute(array(
								'isedavamiyyet_id' => $Davamcek['isedavamiyyet_id']
							));
							$CixisQeydiyyatSay = $CixisQeydiyyat->rowCount();
							if ($CixisQeydiyyatSay==0) {
			
							
					?>
							<option value=" <?php echo $Davamcek['ID'] ?> "><?php echo AdiSoyadiAtaadi($Davamcek['ID'], $db)?></option>"
					<?php	} }
					}	?>
				</select>
			</div>

			<hr>
			<div class="col-6">
				<label for="Idare_Ad" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Idare_Ad" readonly title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Sobe_Ad" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ad" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Vezife_Ad" readonly title="">
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
				<label for="Cixis_Sebebi" class="form-label">Cıxış səbəbi<span class="KirmiziYazi">*</span></label>
				<input type="select" class="form-control" id="Cixis_Sebebi" oninput="SebebAlaniYazildi(this.id)" onfocusout="SebebAlaniYazildi(this.id)" required="required" maxlength="255" tabindex="4" title="">
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