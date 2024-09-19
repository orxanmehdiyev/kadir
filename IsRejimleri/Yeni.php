<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) { ?>
	<div class="row">
		<form class="row g-3 p-2 ">
			<div class="col-6">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" name="states[]" title="" onchange="SelectIkiAlaniSecildi(this.id)">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>
					<?php
					$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC ");
					$Idare_Sor->execute(array(
						'Durum' => 1
					));
					while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
						$Idare_Id = $Idare_ceker['Idare_Id'];
						$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
						$Sobe_Sor->execute(array(
							'Durum' => 1,
							'Idare_Id' => $Idare_Id
						));
						while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
							$Sobe_Id = $Sobe_Cek['Sobe_Id'];
							$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
							$Vezife_Sor->execute(array(
								'Durum' => 1,
								'Idare_Id' => $Idare_Id,
								'Sobe_Id' => $Sobe_Id,
								'User_Id' => 0
							));
							while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Vezife_Id = $Vezife_Cek['Vezife_Id'];
								$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
								$User_Sor->execute(array(
									'Durum' => 1,
									'Islediyi_Idare_Id' => $Idare_Id,
									'Islediyi_Sobe_Id' => $Sobe_Id,
									'Vezife_Id' => $Vezife_Id
								));
								$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
								$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'] . " " . $User_Cek['Ata_Adi'];
								$ID = $User_Cek['ID'];
								echo "<option value='" . $ID . "'>{$AdSoyadAtaadi}</option>";
							}
						}
					}
					?>
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

			<div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
				<label for="Is_Rejimi" class="form-label">İş rejimi<span class="KirmiziYazi">*</span></label>
				<select id="Is_Rejimi" class="form-select" onchange="IsRejimiSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected"></option>
					<option value="1">İdarə</option>
					<option value="2">Gündəlik</option>
					<option value="3">Növbə</option>
				</select>
			</div>
			<div class="col-2 col-sm-2 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
				<label for="Novbe_Sayi" class="form-label">Növbə Sayı<span class="KirmiziYazi">*</span></label>
				<select id="Novbe_Sayi" disabled="disabled" class="form-select" onchange="NovbeSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected"></option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</div>
			<div class="col-2 col-sm-2 col-md-1 col-lg-1 col-xl-1 col-xxl-1">
				<label for="Is_Qurupu" class="form-label">İş qrupu<span class="KirmiziYazi">*</span></label>
				<select id="Is_Qurupu" disabled="disabled" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected"></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</div>
			<hr>
			<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
				<label for="Is_Giris_Saati" class="form-label">İşə gəlmə<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)" disabled="disabled" id="Is_Giris_Saati" title="">
			</div>
			<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
				<label for="Fasile_Saati_Baslagic" class="form-label">Fasilə çıxış<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" disabled="disabled" id="Fasile_Saati_Baslagic" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>

			<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
				<label for="Fasile_Saati_Bitis" class="form-label">Fasilə Giriş<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" disabled="disabled" id="Fasile_Saati_Bitis" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>

			<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
				<label for="Is_Cixis_Saati" class="form-label">İşdən getmə<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" disabled="disabled" id="Is_Cixis_Saati" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>

			<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
				<label for="Gunduz" class="form-label">Gündüz<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" disabled="disabled" id="Gunduz" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>

			<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
				<label for="Gece" class="form-label">Gecə<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" disabled="disabled" id="Gece" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>
			<hr>
			<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6" id="istraheygunu" style="display: none;">
				<h5>Əməşdaşın istrahət günləri</h5>
				<input type="checkbox" value="" id="bir" value="1">
				<label class="form-check-label" for="bir">
					Bazar ertəsi
				</label>
				<br>
				<input type="checkbox" value="" id="iki">
				<label class="form-check-label" for="iki">
					Çərşəmbə axşamı
				</label>
				<br>
				<input type="checkbox" value="" id="uc">
				<label class="form-check-label" for="uc">
					Çərşəmbə
				</label>
				<br>
				<input type="checkbox" value="" id="dord">
				<label class="form-check-label" for="dord">
					Cümə axşamı
				</label>
				<br>
				<input type="checkbox" value="" id="bes">
				<label class="form-check-label" for="bes">
					Cümə
				</label>
				<br>
				<input type="checkbox" value="" id="alti">
				<label class="form-check-label" for="alti">
					Şəmbə
				</label>
				<br>
				<input type="checkbox" value="" id="yeddi">
				<label class="form-check-label" for="yeddi">
					Bazar
				</label>

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