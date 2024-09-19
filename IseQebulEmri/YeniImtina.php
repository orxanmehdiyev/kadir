<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>

	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-4">
				<label for="User_Soy_Ad" class="form-label">Soyadı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Soy_Ad" readonly="readonly"  title="" >
			</div>
			<div class="col-4">
				<label for="User_Ad" class="form-label">Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Ad" readonly="readonly" title="">
			</div>
			<div class="col-4">
				<label for="User_Ata_Ad" class="form-label">Ata Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Ata_Ad" readonly="readonly"  title="">
			</div>
			<div class="col-2">
				<label for="User_Dogum_Tarixi" class="form-label">Doğum Tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control tarix" disabled="disabled"  placeholder="<?php echo $TekTarix?>" id="User_Dogum_Tarixi" title="" >
			</div>

			<div class="col-2">
				<label for="User_Fin" class="form-label">Fin<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control uppercase" id="User_Fin" readonly="readonly"  title="">
			</div> 

			<div class="col-2">
				<label for="ID" class="form-label">Per ID<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control uppercase" id="ID" readonly="readonly"  title="">
			</div>


			<div class="col-8">
				<label for="User_Yasayis_Unvan" class="form-label">Ünvanı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Yasayis_Unvan" readonly="readonly"  title="">
			</div>
			<div class="col-2">
				<label for="User_Tehsil" class="form-label">Təhsili<span class="KirmiziYazi">*</span></label>
				<select id="User_Tehsil" class="form-select" disabled  title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>
					<optgroup label="Ümumi Təhsil">
						<option value="1">İbtidai</option>
						<option value="2">Ümumi Orta</option>
						<option value="3">Tam Orta</option>
					</optgroup>
					<optgroup label="Peşə təhsili">
						<option value="4">İlk Peşə </option>
						<option value="5">Texniki Peşə</option>
						<option value="6">Yüksək Texniki Peşə</option>
					</optgroup>
					<optgroup label="Orta ixtisas">
						<option value="7">Orta ixtisas</option>								
					</optgroup>
					<optgroup label="Ali təhsil">
						<option value="8">Bakalavriat</option>								
						<option value="9">Magistratura (Rezidentura)</option>								
						<option value="10">Doktorantura (Adyunktura)</option>								
					</optgroup>
				</select>
			</div> 
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-5">
				<label for="User_Tehsil_Aldigi_Muesse" class="form-label">Universitet<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" required="required" id="User_Tehsil_Aldigi_Muesse" disabled title="">
			</div> 
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-5">
				<label for="Ixtisas" class="form-label">İxtisas<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" required="required" id="Ixtisas"  disabled title="">
			</div> 
			<div class="col-2">
				<label for="User_Ise_Qebul_Tarixi" class="form-label">İşə qəbul tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control tarix" autocomplete="off"  disabled title="">
			</div>
			<div class="col-2">
				<label for="Usre_Cinsiyeti" class="form-label">Cinsiyyəti<span class="KirmiziYazi">*</span></label>
				<select required="required" id="Usre_Cinsiyeti" class="form-select"  disabled title="">
					<option disabled="disabled" value="" selected="selected" tabindex="9"></option>										
					<option value="0">Kişi</option>
					<option value="1">Qadın</option>
				</select>
			</div>

			<div class=" col-3 sinaqmuddeti">
				<label for="SinaqMuddeti" class="form-label">Sinaq Müddəti<span class="KirmiziYazi">*</span></label>	
				<input required="required" type="number"  class="form-control sinaqmuddetigun"  disabled title="">
				<select required="required" id="SinaqMuddetiGunAy" class="form-select sinaqmuddetigunay"  disabled title="">					
					<option value="0">Ay</option>
					<option value="1">Gün</option>
				</select>
			</div>

			<div class="col-2">
				<label for="User_Is_Novu" class="form-label">İşin Növü<span class="KirmiziYazi">*</span></label>	
				<select required="required" id="User_Is_Novu" class="form-select"  disabled title="">
					<option disabled="disabled" value="" selected="selected" tabindex="10"></option>										
					<option value="0">Ştat Daxili</option>				
				</select>
			</div> 

			<div class="col-6">
				<label for="Ise_Qebul_Emri_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ise_Qebul_Emri_Nomresi"  disabled title="">
			</div> 
			<div class="col-12">
				<label for="User_Ise_Qebul_Esas" class="form-label">Qeyd </label>
				<input type="text" class="form-control" id="Mezmun" tabindex="11"  disabled title="">
			</div>	
			<div id="VakantIdareSobeVezife" class="row " style="margin: 0; padding: 0;">				
			</div>
			<div class="col-6">
				<?php 	
				$Umumi_Vakat_Sor=$db->prepare("SELECT * FROM vezife WHERE NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and User_Id=:User_Id and vezife.Durum=:Durum");
				$Umumi_Vakat_Sor->execute(array(
					'yeniemir'=>0,
					'User_Id'=>0,
					'Durum'=>1));
				$Umumi_Vakat_Say=$Umumi_Vakat_Sor->rowCount();
				?>
				<p><b>Vakant Yer</b>:<span id="vakantsayi"> <?php echo $Umumi_Vakat_Say ?></span> ədəd <b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>
		</form>	
	</div>

<?php } ?>