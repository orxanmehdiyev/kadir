<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-2">
				<label for="Dovlet_Nom_Nisani" class="form-label">Nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Dovlet_Nom_Nisani" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>		
			<div class="col-4">
				<label for="Neqliyyat_Vasiteleri_Novu" class="form-label">Növü<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Neqliyyat_Vasiteleri_Novu" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-4">
				<label for="Neqliyyat_Vasiteleri_Marka" class="form-label">Markası<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Neqliyyat_Vasiteleri_Marka" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-2">
				<label for="Neqliyyat_Vasiteleri_Motor_Hecmi" class="form-label">Mator həcmi<span class="KirmiziYazi">*</span></label>
				<input type="number" class="form-control" id="Neqliyyat_Vasiteleri_Motor_Hecmi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	 

			<div class="col-2">
				<label for="Neqliyyat_Vasiteleri_Adam_Yeri" class="form-label">Yer sayı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Neqliyyat_Vasiteleri_Adam_Yeri" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-2">
				<label for="Neqliyyat_Vasiteleri_Istehsal_Ili" class="form-label">İstehsal ili<span class="KirmiziYazi">*</span></label>
				<select id="Neqliyyat_Vasiteleri_Istehsal_Ili" class="form-control" onchange="SelectAlaniSecildi(this.id)">
					<?php 
				$buil=date("Y", $ZamanDamgasi);
				$Kohne=$buil-50;
					?>
					<option value="" selected="selected"></option>
					<?php for ($i=$buil; $i >= $Kohne; $i--) { 
			?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
					<?php } ?>
				</select>
			</div>	

			<div class="col-2">
				<label for="Neqliyyat_Vasiteleri_Balans_Deyeri" class="form-label">Deyeri<span class="KirmiziYazi">*</span></label>
				<input type="number" class="form-control" id="Neqliyyat_Vasiteleri_Balans_Deyeri" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="15" tabindex="1" title="">
			</div>	

			<div class="col-4">
				<label for="Idare_Id" class="form-label">İdarə <span class="KirmiziYazi">*</span></label>
				<select id="Idare_Id" class="form-control" onchange="SelectAlaniSecildi(this.id)">
					<?php 
					$Idare_Sor=$db->prepare("SELECT * FROM idare order by Sira_No ASC ");
					$Idare_Sor->execute(); 
					?>
					<option value="" selected="selected"></option>
					<?php while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {?>
						<option value="<?php echo $Idare_Cek['Idare_Id'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></option>
					<?php } ?>
				</select>
			</div>	

			<div class="col-2">
				<label for="Bann_Nomresi" class="form-label">Bann nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Bann_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-2">
				<label for="Sash_Nomresi" class="form-label">Şass sömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Sash_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-2">
				<label for="Rengi" class="form-label">Rəngi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Rengi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="BalansaAlinmaFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">

				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>
			
		</form>	
	</div>
	<?php } ?>