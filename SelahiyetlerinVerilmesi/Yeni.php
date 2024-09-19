<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-4">
				<label for="User_Soy_Ad" class="form-label">Soyadı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Soy_Ad" oninput="AdSoyadAtaAdiYazildi(this.id)" onfocusout="AdSoyadAtaAdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="20" tabindex="1" title="">
			</div>
			<div class="col-4">
				<label for="User_Ad" class="form-label">Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Ad" oninput="AdSoyadAtaAdiYazildi(this.id)" onfocusout="AdSoyadAtaAdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="20" tabindex="2" title="">
			</div>
			<div class="col-4">
				<label for="User_Ata_Ad" class="form-label">Ata Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Ata_Ad" oninput="AdSoyadAtaAdiYazildi(this.id)" onfocusout="AdSoyadAtaAdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="20" tabindex="3" title="">
			</div>


						<div class="col-2">
				<label for="User_Dogum_Tarixi" class="form-label">Doğum Tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control tarix" autocomplete="off" required="required" placeholder="<?php echo $TekTarix?>" id="User_Dogum_Tarixi" oninput="TarixYazildi(this.id)" onchange="TarixYazildi(this.id)" onfocusout="TarixYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "10" tabindex="8" title="">
			</div>

			<div class="col-2">
				<label for="User_Fin" class="form-label">Fin<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control uppercase" id="User_Fin" oninput="ReqemHerifAlaniYazildi(this.id)" onfocusout="ReqemHerifAlaniYazildi(this.id)" required="required"maxlength="7" tabindex="5" title="">
			</div> 

			<div class="col-2">
				<label for="ID" class="form-label">Per ID<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control uppercase" id="ID" oninput="ReqemInputuDolduruldu(this.id)" onfocusout="ReqemInputuDolduruldu(this.id)" required="required"maxlength="7" tabindex="5" title="">
			</div>


			<div class="col-8">
				<label for="User_Yasayis_Unvan" class="form-label">Ünvanı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="User_Yasayis_Unvan" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="200" tabindex="6" title="">
			</div>
			<div class="col-2">
				<label for="User_Tehsil	" class="form-label">Təhsili<span class="KirmiziYazi">*</span></label>
				<select id="User_Tehsil" required="required" class="form-select" onchange="SecimAlaniSecildi(this.id)" title="">
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
				<input type="text" class="form-control" required="required" id="User_Tehsil_Aldigi_Muesse" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="8" title="">
			</div> 
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-5">
				<label for="Ixtisas" class="form-label">İxtisas<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" required="required" id="Ixtisas" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="8" title="">
			</div> 
			<div class="col-2">
				<label for="User_Ise_Qebul_Tarixi" class="form-label">İşə qəbul tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control tarix" autocomplete="off" required="required" placeholder="<?php echo $TekTarix?>" id="User_Ise_Qebul_Tarixi" oninput="TarixYazildi(this.id)" onchange="TarixYazildi(this.id)" onfocusout="TarixYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "10" tabindex="8" title="">
			</div>
			<div class="col-2">
				<label for="Usre_Cinsiyeti" class="form-label">Cinsiyyəti<span class="KirmiziYazi">*</span></label>
				<select required="required" id="Usre_Cinsiyeti" required="required" class="form-select" onchange="SecimAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="9"></option>										
					<option value="0">Kişi</option>
					<option value="1">Qadın</option>
				</select>
			</div>

			<div class=" col-3 sinaqmuddeti">
				<label for="SinaqMuddeti" class="form-label">Sinaq Müddəti<span class="KirmiziYazi">*</span></label>	
				<input required="required" type="number"  class="form-control sinaqmuddetigun" min="0" max="365" id="SinaqMuddeti" oninput="ReqemInputuDolduruldu(this.id)" title="" onkeydown="javascript: return event.keyCode == 69 ? false : true"  onfocusout="ReqemInputuDolduruldu(this.id)" maxlength="3" tabindex="9">
				<select required="required" id="SinaqMuddetiGunAy" class="form-select sinaqmuddetigunay" onchange="SecimAlaniSecildi(this.id)" title="">					
					<option value="0">Ay</option>
					<option value="1">Gün</option>
				</select>
			</div>

			<div class="col-2">
				<label for="User_Is_Novu" class="form-label">İşin Növü<span class="KirmiziYazi">*</span></label>	
				<select required="required" id="User_Is_Novu" class="form-select" onchange="VakanYerleriSay(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="10"></option>										
					<option value="0">Ştat Daxili</option>				
				</select>
			</div> 

			<div class="col-6">
				<label for="Ise_Qebul_Emri_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ise_Qebul_Emri_Nomresi" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" >
			</div> 
			<div class="col-12">
				<label for="User_Ise_Qebul_Esas" class="form-label">Qeyd </label>
				<input type="text" class="form-control" id="Mezmun" tabindex="11" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" title="">
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