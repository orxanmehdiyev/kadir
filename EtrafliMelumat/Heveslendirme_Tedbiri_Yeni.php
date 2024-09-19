<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-3">
				<label for="Heveslendirem_Tedbirleri_Ad_Id	" class="form-label">Həvəsləndirmə Tədbiri<span class="KirmiziYazi">*</span></label>
				<select id="Heveslendirem_Tedbirleri_Ad_Id" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
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
				<div class="col-4">
					<label for="Hevesledirme_Tedbirleri_Sebeb" class="form-label">Səbəb<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" name="Hevesledirme_Tedbirleri_Sebeb" id="Hevesledirme_Tedbirleri_Sebeb" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>	
				<div class="col-3">
					<label for="Hevesledirme_Tedbirleri_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" name="Hevesledirme_Tedbirleri_Emrinin_Nomresi" id="Hevesledirme_Tedbirleri_Emrinin_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>	 



				<div class="col-2">
					<label for="Hevesledirme_Tedbirleri_Tarix" class="form-label">Tarix<span class="KirmiziYazi">*</span></label>
					<input type="date" class="form-control" name="Hevesledirme_Tedbirleri_Tarix" id="Hevesledirme_Tedbirleri_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>	

				<div class="col-12 text-center mt-3">
					<button type="button" onclick="HeveslendirmeTedbirleriYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>			
			</form>	
		</div>
		<?php } ?>