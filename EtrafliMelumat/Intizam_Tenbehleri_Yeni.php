<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-5">
				<label for="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id	" class="form-label">İntizam tənbehinin növü<span class="KirmiziYazi">*</span></label>
				<select id="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>
					<?php 
					$Sor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari where intizam_tenbehi_adlari_durum=:intizam_tenbehi_adlari_durum order by intizam_tenbehi_adlari_Sira_No ASC ");
					$Sor->execute(array(
						'intizam_tenbehi_adlari_durum'=>1));
						while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {						?>
							<option value="<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>"><?php echo $Cek['intizam_tenbehi_adlari_ad'] ?></option>
						<?php } ?>					
					</select>
				</div>	
				<div class="col-2">
					<label for="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix" class="form-label">Tədbiq Edildiyi Tarix<span class="KirmiziYazi">*</span></label>
					<input type="date" class="form-control" name="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix" id="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>

				<div class="col-2">
					<label for="Intizam_Tenbehinin_Bitis_Tarixi" class="form-label">Bitiş Tarix<span class="KirmiziYazi">*</span></label>
					<input type="date" class="form-control" name="Intizam_Tenbehinin_Bitis_Tarixi" id="Intizam_Tenbehinin_Bitis_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>

				<div class="col-3">
					<label for="Intizam_Tenbehi_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" name="Intizam_Tenbehi_Emrinin_Nomresi" id="Intizam_Tenbehi_Emrinin_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>
				<div class="col-12">
					<label for="Intizam_Tenbehi_Sebeb" class="form-label">Səbəb və qeyd<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" name="Intizam_Tenbehi_Sebeb" id="Intizam_Tenbehi_Sebeb" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>		 





				<div class="col-12 text-center mt-3">
					<button type="button" onclick="IntizamTedbirleriYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>			
			</form>	
		</div>
		<?php } ?>