<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row p-2 ">		
			<div class="col-3">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectIkiAlaniSecildi(this.id)">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>	
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
			<div class="col-3">
				<label for="Ezam_Novu	" class="form-label">Ezamiiyə növü<span class="KirmiziYazi">*</span></label>
				<select id="Ezam_Novu" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>				
					<option value="0">Daxili Ezamiyyə</option>
					<option value="1">Xarici Ezamiyyə</option>							
				</select>
			</div>	
			<div class="col-2">
				<label for="Ezam_Baslangic_Tarixi" class="form-label">Başlanğıc tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1 tarix" autocomplete="off" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)" placeholder="<?php echo $TekTarix ?>" onchange="TarixAlaniYazildi(this.id)" maxlength="10" id="Ezam_Baslangic_Tarixi"  title="">
			</div>
			<div class="col-1">
				<label for="Ezam_Gun_Sayi" class="form-label">Gün<span class="KirmiziYazi">*</span></label>
				<input required="required" type="number"  class="form-control sinaqmuddetigun" min="0" max="365" id="Ezam_Gun_Sayi" oninput="ReqemAlaniYazildi(this.id)" title="" onkeydown="javascript: return event.keyCode == 69 ? false : true"  onfocusout="ReqemAlaniYazildi(this.id)" maxlength="3" tabindex="9">
			</div>
			<hr>
			<div class="col-6">
				<label for="Ezam_Olundugu_Yer" class="form-label">Ezam yeri<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ezam_Olundugu_Yer" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" >
			</div>
			<div class="col-2">
				<label for="Ezam_Emri_No" class="form-label">Əmrin nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ezam_Emri_No" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" >
			</div>
			<hr>
			<div class="col-12">
				<label for="Ezam_Sebebi" class="form-label">Ezamiyyə səbəbi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ezam_Sebebi" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" >
			</div>
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