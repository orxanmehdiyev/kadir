<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">	
			<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
				<label for="Hevesledirme_Tedbirleri_Tarix" class="form-label">Tədbiq Edildiyi tarix<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1 tarix" autocomplete="off" onchange="TarixAlaniYazildi(this.id)" id="Hevesledirme_Tedbirleri_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"   placeholder="__.__._____" required="required" maxlength="10" tabindex="4" title="">
			</div>	
				<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
					<label for="Hevesledirme_Tedbirleri_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Hevesledirme_Tedbirleri_Emrinin_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="20" tabindex="4" title="">
				</div>	

			<div class="col-12 col-sm-12 col-md-12 col-lg-12">
				<label for="Heveslendirem_Tedbirleri_Ad_Id	" class="form-label">Həvəsləndirmə Tədbiri<span class="KirmiziYazi">*</span></label>
				<select id="Heveslendirem_Tedbirleri_Ad_Id" required="required" class="form-select" onchange="UserAlaniSfrla(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>
					<?php 
					$Sor=$db->prepare("SELECT * FROM  heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_durum=:heveslendirem_tedbirleri_ad_durum order by heveslendirem_tedbirleri_ad_Sira_No ASC ");
					$Sor->execute(array(
						'heveslendirem_tedbirleri_ad_durum'=>1));
						while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {						?>
							<option value="<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>"><?php echo $Cek['heveslendirem_tedbirleri_ad'] ?></option>
						<?php } ?>					
					</select>
				</div>

			

				<div class="form-group col-12">
					<label for="Hevesledirme_Tedbirleri_Sebeb" class="form-label">Səbəb<span class="KirmiziYazi">*</span></label>				
					<textarea id="Hevesledirme_Tedbirleri_Sebeb" class="form-control" style="height: 70px;" maxlength ="255" rows="10" cols="50" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"></textarea>
				</div>

				<div id="heveslendirmetedmirimodalici">
					<div class="col-12 text-center mt-3">
						<button type="button" onclick="HeveslendirmeTedbiriDusenler()" class="YenileButonlari" tabindex="15" title="">Növbəti</button>
						<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
					</div>
				</div>
						<div class="col-6">
		
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>

			</form>	
		</div>
		<?php } ?>