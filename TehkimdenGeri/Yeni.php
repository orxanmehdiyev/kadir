<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row p-2 ">		
			<div class="col-4">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectIkiAlaniSecildi(this.id)">
					<option disabled="disabled" value="" selected="selected" tabindex="1"></option>	
					<?php 
					$Tehkim_Sor=$db->prepare("SELECT * FROM tehkim_emri where Baslangic_Tarixi<:Baslagic and Bitis_Tarixi>:Bitis");
					$Tehkim_Sor->execute(array(
						'Baslagic'=>$Tarix_Beynelxalq,
						'Bitis'=>$Tarix_Beynelxalq
					));
					while ($Tehkim_Cek=$Tehkim_Sor->fetch(PDO::FETCH_ASSOC)){
						$ID=$Tehkim_Cek['ID'];
						$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID");
						$User_Sor->execute(array(
							'ID'=>$ID));
						$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
						$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
						$ID=$User_Cek['ID'];
						echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
					}

					?>
				</select>
			</div>	
						<div class="col-2">
				<label for="Tehkim_Geri_Tarix" style="width: 206px" class="form-label ">Geri çağrılma tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1" autocomplete="off" id="Tehkim_Geri_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  placeholder="__.__._____"  required="required" maxlength="10" tabindex="3" title="">
			</div>


			<div class="col-2">
				<label for="Emrin_No" style="width: 206px" class="form-label ">Əmrin No<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control"  id="Emrin_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" title=""  maxlength="10" tabindex="9">
			</div>
			<hr>
			<div class="col-6">
				<label for="Idare_Ad" class="form-label">İdarə</label>
				<input type="tarix" class="form-control"  id="Idare_Ad"  readonly  title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə/Bölmə</label>
				<input type="tarix" class="form-control"  id="Sobe_Ad" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ad" class="form-label">Vəzifə</label>
				<input type="tarix" class="form-control" id="Vezife_Ad" readonly title="">
			</div>
			<hr>
			<div class="col-5">
				<label for="Tehkim_Idare_Ad" class="form-label">Təhkim olunduğu idarə</label>
				<input type="tarix" class="form-control"  id="Tehkim_Idare_Ad"  readonly  title="">
			</div>

			<div class="col-3">
				<label for="Tehkim_Sobe_Ad" class="form-label">Təhkim olunduğu bölmə</label>
				<input type="tarix" class="form-control"  id="Tehkim_Sobe_Ad" readonly title="">
			</div>

			<div class="col-2">
				<label for="Baslangic_Tarixi" class="form-label">Təhkim başlanğıc tarixi</label>
				<input type="tarix" class="form-control"  id="Baslangic_Tarixi" readonly title="">
			</div>

			<div class="col-2">
				<label for="Bitis_Tarixi" class="form-label">Təhkim bitiş tarixi</label>
				<input type="tarix" class="form-control"  id="Bitis_Tarixi" readonly title="">
			</div>
			<hr>
			<input type="hidden" id="Tehkim_Emri_Id">



			<hr>
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>	
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>
		</form>	
	</div>
	<?php } ?>