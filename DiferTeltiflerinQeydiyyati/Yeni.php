<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row p-2 ">		
			<div class="col-4">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectIkiAlaniSecildi(this.id)">
					<option disabled="disabled" value="" selected="selected" tabindex="1"></option>	
					<?php 
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC ");
					$Idare_Sor->execute(array(
						'Durum'=>1));
					while ($Idare_ceker=$Idare_Sor->fetch(PDO::FETCH_ASSOC)){
						$Idare_Id=$Idare_ceker['Idare_Id'];
						$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
						$Sobe_Sor->execute(array(
							'Durum'=>1,
							'Idare_Id'=>$Idare_Id));
						while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)){
							$Sobe_Id=$Sobe_Cek['Sobe_Id'];
							$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
							$Vezife_Sor->execute(array(
								'Durum'=>1,
								'Idare_Id'=>$Idare_Id,
								'Sobe_Id'=>$Sobe_Id,
								'User_Id'=>0));
							while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)){
								$Vezife_Id=$Vezife_Cek['Vezife_Id'];
								$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
								$User_Sor->execute(array(
									'Durum'=>1,
									'Islediyi_Idare_Id'=>$Idare_Id,
									'Islediyi_Sobe_Id'=>$Sobe_Id,
									'Vezife_Id'=>$Vezife_Id));
								$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
								$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
								$ID=$User_Cek['ID'];
								echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
							}
						}
					}
					?>
				</select>
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
			<div class="col-6">
				<label for="Teltifin_Adi" style="width: 206px" class="form-label ">Təltifin adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="" id="Teltifin_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="50" tabindex="2" title="">
			</div>

			<div class="col-6">
				<label for="Teltif_Eden_Orqan" style="width: 206px" class="form-label ">Təltifin edən orqan<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="" id="Teltif_Eden_Orqan" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="50" tabindex="2" title="">
			</div>

		<hr>
			<div class="col-2">
				<label for="Teltif_Tarixi" style="width: 206px" class="form-label ">Təltif tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1" autocomplete="off" id="Teltif_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  placeholder="__.__._____" required="required" maxlength="10" tabindex="5" title="">
			</div>

	
			<div class="col-6">
				<label for="Qeyd" style="width: 206px" class="form-label ">Qeyd<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="" id="Qeyd" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="10" tabindex="2" title="">
			</div>
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