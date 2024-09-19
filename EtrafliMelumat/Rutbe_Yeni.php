<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-7">
				<label for="Rutbe_Id	" class="form-label">Rütbə<span class="KirmiziYazi">*</span></label>
				<select id="Rutbe_Id" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>
					<?php 
					$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Durum=:Rutbe_Durum order by Rutbe_Sira_No ASC ");
					$Rutbe_Sor->execute(array(
						'Rutbe_Durum'=>1));
						while ($Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC)) {						?>
							<option value="<?php echo $Rutbe_Cek['Rutbe_Id'] ?>"><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></option>
						<?php } ?>					
					</select>
				</div>	
				<div class="col-2">
					<label for="Rutbe_Emri_Tarixi" class="form-label">Tarix<span class="KirmiziYazi">*</span></label>
					<input type="date" class="form-control" name="Rutbe_Emri_Tarixi" id="Rutbe_Emri_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>
				<div class="col-3">
					<label for="Rutbe_Emrinin_No" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" name="Rutbe_Emrinin_No" id="Rutbe_Emrinin_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>
				<div class="col-12">
					<label for="Rutbe_Emri_Novu" class="form-label">Səbəb və qeyd<span class="KirmiziYazi">*</span></label>
					<select id="Rutbe_Emri_Novu" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
						<option disabled="disabled" value="" selected="selected" tabindex="7"></option>				
						<option value="1">İlkin xüsusi rütbənin verilməsi</option>
						<option value="2">Növbəti xüsusi rütbənin verilməsi</option>							
						<option value="3">Vaxdından əvvəl xüsusi rütbənin verilməsi</option>							
						<option value="4">Bir pillə yuxarı xüsusi rütbənin verilməsi</option>							
					</select>
				</div>
				<div class="col-12 text-center mt-3">
					<button type="button" onclick="RutbeYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>			
			</form>	
		</div>
		<?php } ?>