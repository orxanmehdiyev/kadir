<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row p-2 ">		
			<div class="col-3">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectIkiAlaniSecildi(this.id)">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>	
					<?php 
					$Sor=$db->prepare("SELECT * FROM mezuniyyet where Mezuniyyet_Bitis_Tarixi_Unix>:Mezuniyyet_Bitis_Tarixi_Unix order by Mezuniyyet_Baslagic_Tarixi_Unix DESC");
					$Sor->execute(array(
						'Mezuniyyet_Bitis_Tarixi_Unix'=> TraixUzerineGunGelUnixCevir($TarixSaat,1)));
					while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
						$ID_Mezuniyyetdeki=$Cek['ID'];
						$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and ID=:ID");
						$User_Sor->execute(array(
							'Durum'=>1,
							'ID'=>$ID_Mezuniyyetdeki));
						$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
						$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
						$ID=$User_Cek['ID'];
						echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
					}	
					?>
				</select>
			</div>	

			<div class="col-2 tarixvehesabla">
				<label for="Geri_Cagrilama_Tarixi" class="form-label ">Geri çağrılma tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control tarix left" value="<?php echo $TekTarix   ?>" id="Geri_Cagrilama_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="10" tabindex="4" title="">
				<button type="button" onclick="QaliqGunuHesabla()" class="YenileButonlari right"  tabindex="15" title=""><i class="fas fa-calculator"></i></button>
			</div>
			<div class="col-2 ">

			</div>	

			<hr>
			<div class="col-6">
				<label for="Idare_Ad" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Idare_Ad"  readonly  title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Sobe_Ad" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ad" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Vezife_Ad" readonly title="">
			</div>


			<hr>
			<div class="col-4">
				<label for="Mezuniyyet_Novleri_Ad" class="form-label">Məzuniyyetin növü<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Mezuniyyet_Novleri_Ad"  readonly  title="">
			</div>

			<div class="col-2">
				<label for="Mezuniyyet_Bitis_Tarixi" class="form-label">Bitiş tarixi<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Mezuniyyet_Bitis_Tarixi" readonly title="">
			</div>

			<div class="col-2">
				<label for="Mezuniyyet_Ise_Cixma_Tarixi" class="form-label">İşə çıxma tarixi<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Mezuniyyet_Ise_Cixma_Tarixi" readonly title="">
			</div>
			<input type="hidden" id="Mezuniyyet_Id">

			<hr>
			<div class="col-2">
				<label for="Mezuniyyet_Qaliq_Gun" class="form-label">Qalıq günlərinin sayı<span class="KirmiziYazi">*</span></label>
				<input type="number" class="form-control" id="Mezuniyyet_Qaliq_Gun" oninput="ReqemAlaniYazildi(this.id)" onfocusout="ReqemAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  readonly required="required" maxlength="2" tabindex="4" title="">
			</div>
			<div class="col-2">
				<label for="Mezuniyyet_Geri_Emir_No" class="form-label">Əmrin №<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Mezuniyyet_Geri_Emir_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="2" tabindex="4" title="">
			</div>
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