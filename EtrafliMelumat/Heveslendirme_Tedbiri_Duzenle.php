<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyse'])) {
	$Hevesledirme_Tedbirleri_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyse']);
	$Heveslendirme_Tedbiri_Sor=$db->prepare("SELECT * FROM  hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id");
	$Heveslendirme_Tedbiri_Sor->execute(array(
		'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id
	));
	$Heveslendirme_Tedbiri_Cek=$Heveslendirme_Tedbiri_Sor->fetch(PDO::FETCH_ASSOC);
	?>
	<input type="hidden" id="Hevesledirme_Tedbirleri_Id" value="<?php echo $Hevesledirme_Tedbirleri_Id ?>">
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
							<option
							<?php 
		
							echo  $Heveslendirme_Tedbiri_Cek['Heveslendirem_Tedbirleri_Ad_Id']==$Cek['heveslendirem_tedbirleri_ad_id']? "selected":"";
							?>

							value="<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>"><?php echo $Cek['heveslendirem_tedbirleri_ad'] ?></option>
						<?php } ?>					
					</select>
				</div>	
				<div class="col-4">
					<label for="Hevesledirme_Tedbirleri_Sebeb" class="form-label">Səbəb<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" name="Hevesledirme_Tedbirleri_Sebeb" id="Hevesledirme_Tedbirleri_Sebeb" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Sebeb'] ?>" required="required" maxlength ="255" tabindex="1" title="">
				</div>	
				<div class="col-3">
					<label for="Hevesledirme_Tedbirleri_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" name="Hevesledirme_Tedbirleri_Emrinin_Nomresi" id="Hevesledirme_Tedbirleri_Emrinin_Nomresi" oninput="MetinAlaniYazildi(this.id)" value="<?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Emrinin_Nomresi'] ?>" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>	 


				<?php  
				$Tarix=explode('.', $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Tarix']) ;
				$Hevesledirme_Tedbirleri_Tarix=$Tarix[2]."-".$Tarix[1]."-".$Tarix[0];

				?>
				<div class="col-2">
					<label for="Hevesledirme_Tedbirleri_Tarix" class="form-label">Tarix<span class="KirmiziYazi">*</span></label>
					<input type="date" class="form-control" name="Hevesledirme_Tedbirleri_Tarix" id="Hevesledirme_Tedbirleri_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Hevesledirme_Tedbirleri_Tarix?>" required="required" maxlength ="255" tabindex="1" title="">
				</div>	

				<div class="col-12 text-center mt-3">
					<button type="button" onclick="HeveslendirmeTedbirleriDuzenleFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>			
			</form>	
		</div>
		<?php } ?>