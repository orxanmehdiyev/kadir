<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Deyer  =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']); 
	if ($Deyer==1 or $Deyer==2 or $Deyer==3) {?>

		<div class="col-3">
			<label for="Tedbiq_Edildiyi_Tarix" class="form-label" style="display: block; ">Məzuniyyətə çıxma tarixi<span class="KirmiziYazi">*</span></label>
			<input  type="text" class="form-control tarix mezuniyyettarix" style="float: left; " value="<?php echo $TekTarix   ?>" id="Tedbiq_Edildiyi_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="10" tabindex="4" title="">
			<button type="button" onclick="Xidmetilihesabla()" class="mezuniyyethesabla" tabindex="15" title=""><i class="fas fa-calculator"></i></button>
		</div>		
		<div class="col-3" > 
			<input type="checkbox" value="" id="flexCheckDefault">
			<label class="form-check-label checkboxyendir" for="flexCheckDefault" >
				Köhnə məlumatın daxil edilməsi
			</label>
		</div>	
		<hr>
		<div class="col-2">
			<label for="Mezuniyyet_Gun" class="form-label">Məz. günlərinin sayı<span class="KirmiziYazi">*</span></label>
			<input type="number" class="form-control" id="Mezuniyyet_Gun" oninput="ReqemAlaniYazildi(this.id)" onfocusout="ReqemAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" readonly   required="required" maxlength="2" tabindex="4" title="">
		</div>

		<div class="col-2">
			<label for="Mezuniyyet_Qaliq_Gun" class="form-label">Qalıq günlərinin sayı<span class="KirmiziYazi">*</span></label>
			<input type="number" class="form-control" id="Mezuniyyet_Qaliq_Gun" oninput="ReqemAlaniYazildi(this.id)" onfocusout="ReqemAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  readonly required="required" maxlength="2" tabindex="4" title="">
		</div>

		<div class="col-2">
			<label for="Xidmet_Ili" class="form-label">Gömrük stajı<span class="KirmiziYazi">*</span></label>
			<input type="number" class="form-control" id="Xidmet_Ili" oninput="ReqemAlaniYazildi(this.id)" onfocusout="ReqemAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  readonly required="required" maxlength="2" tabindex="4" title="">
		</div>
		<div class="col-4">
			<label for="Mezuniyyet_Xidmet_Ili_Son" class="form-label">Xidmət ili<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" style="width: 50%; float: right; margin-top: 20px;" id="Mezuniyyet_Xidmet_Ili_Son" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" readonly  required="required" maxlength="10" tabindex="4" title="">
			<input type="text" class="form-control" style="width: 49%;float: left; margin-left: 1px; " id="Mezuniyyet_Xidmet_Ili_Baslagic" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" readonly  required="required" maxlength="10" tabindex="4" title="">
		</div>

		<hr>
		<div class="col-2">
			<label for="Mezuniyyet_Bitis_Tarixi" class="form-label">Bitmə tarixi<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" id="Mezuniyyet_Bitis_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  readonly required="required" maxlength="10" tabindex="4" title="">
		</div>

		<div class="col-2">
			<label for="Mezuniyyet_Ise_Cixma_Tarixi" class="form-label">İşə çıxma tarixi<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" id="Mezuniyyet_Ise_Cixma_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  readonly required="required" maxlength="10" tabindex="4" title="">
		</div>





		<div class="col-2">
			<label for="Mezuniyyet_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" id="Mezuniyyet_Emrinin_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="20" tabindex="4" title="">
		</div>

		<div class="col-3">
			<label for="Mezuniyyet_Evezi_ID" class="form-label">Vəzifəni həvalə et<span class="KirmiziYazi">*</span></label>
			<select id="Mezuniyyet_Evezi_ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectUcAlaniSecildi(this.id)">
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
		<div class="row" id="hevale">
			<div class="col-6">
				<label for="Idare_Ads" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Idare_Ads"  readonly  title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ads" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Sobe_Ads" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ads" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Vezife_Ads" readonly title="">
			</div>
		</div>
		<div class="col-12 text-center mt-3">
			<button type="button" onclick="MezuniyyetYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>	

	<?php }elseif($Deyer==4 or $Deyer==5 or $Deyer==6){
		?>
		<div class="col-2">
			<label for="Mezuniyyet_Gun" class="form-label">Məz. günlərinin sayı<span class="KirmiziYazi">*</span></label>
			<input type="number" class="form-control" id="Mezuniyyet_Gun" oninput="ReqemAlaniYazildi(this.id)" onfocusout="ReqemAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  required="required" maxlength="2" tabindex="4" title="">
		</div>

		<div class="col-3">
			<label for="Tedbiq_Edildiyi_Tarix" class="form-label" style="display: block; ">Məzuniyyətə çıxma tarixi<span class="KirmiziYazi">*</span></label>
			<input  type="text" class="form-control tarix mezuniyyettarix" style="float: left; " value="<?php echo $TekTarix   ?>" id="Tedbiq_Edildiyi_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="10" tabindex="4" title="">
			<button type="button" onclick="IseCixmaHesab()" class="mezuniyyethesabla" tabindex="15" title=""><i class="fas fa-calculator"></i></button>
		</div>
		<hr>

		<div class="col-2">
			<label for="Mezuniyyet_Bitis_Tarixi" class="form-label">Bitmə tarixi<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" id="Mezuniyyet_Bitis_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  readonly required="required" maxlength="10" tabindex="4" title="">
		</div>
		<div class="col-2">
			<label for="Mezuniyyet_Ise_Cixma_Tarixi" class="form-label">İşə çıxma tarixi<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" id="Mezuniyyet_Ise_Cixma_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  readonly required="required" maxlength="10" tabindex="4" title="">
		</div>


		<div class="col-2">
			<label for="Mezuniyyet_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
			<input type="text" class="form-control" id="Mezuniyyet_Emrinin_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="20" tabindex="4" title="">
		</div>

		<div class="col-3">
			<label for="Mezuniyyet_Evezi_ID" class="form-label">Vəzifəni həvalə et<span class="KirmiziYazi">*</span></label>
			<select id="Mezuniyyet_Evezi_ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectUcAlaniSecildi(this.id)">
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
		<div class="row" id="hevale">
			<div class="col-6">
				<label for="Idare_Ads" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Idare_Ads"  readonly  title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ads" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Sobe_Ads" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ads" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Vezife_Ads" readonly title="">
			</div>
		</div>
		<div class="col-12 text-center mt-3">
			<button type="button" onclick="SosialYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>	

		<?php 
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}?>
