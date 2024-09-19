<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">		
			<div class="col-6">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
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
			<div class="col-6">
				<label for="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id	" class="form-label">İtizam Tənbehinin növü<span class="KirmiziYazi">*</span></label>
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

				<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
					<label for="Intizam_Tenbehi_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Intizam_Tenbehi_Emrinin_Nomresi" oninput="IntizamTenbehiSebebAlaniYazildi(this.id)" onfocusout="IntizamTenbehiSebebAlaniYazildi(this.id)"   required="required" maxlength="20" tabindex="4" title="">
				</div>

				<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
					<label for="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix" class="form-label">Tədbiq Edildiyi tarix<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control pickmeup_1 tarix" id="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  value="<?php echo $TekTarix ?>" required="required" maxlength="10" tabindex="4" title="">
				</div>		
				<div class="form-group col-12">
					<label for="Intizam_Tenbehi_Sebeb" class="form-label">Səbəb<span class="KirmiziYazi">*</span></label>				
					<textarea id="Intizam_Tenbehi_Sebeb" class="form-control" style="height: 70px;" maxlength ="255" rows="10" cols="50" oninput="IntizamTenbehiSebebAlaniYazildi(this.id)" onfocusout="IntizamTenbehiSebebAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"></textarea>
				</div>
				<div id="Isnovu" class="row " style="margin: 0; padding: 0;">

				</div>
				<div id="VakantIdareSobeVezife" class="row " style="margin: 0; padding: 0;">

				</div>	
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
					<p id="vakant" style="display: none; "><b>Vakant Yer</b>:<span id="vakantsayi"></span> ədəd </p>
				</div>	
			</form>	
		</div>
		<?php } ?>