<?php 
require_once '../Ayarlar/setting.php';
if ($VezifelerYeniButtonu==1) {
	if (isset($_POST['yeni'])) {
		?>
		<form name="IslemFormu">
			

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici">Vəzifənin Növü<span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
						<select  tabindex="2" required="required" id="Vezifenin_Novu" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
							<option selected disabled></option>
							<option value="0">Ştat Daxili</option>						
							<option value="1">Ştatdan Kənar</option>						
						</select>
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici">Ala Biləcəyi Ən Yüksək Rütbə<span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
						<select  tabindex="2" required="required" id="AlaBileceyiRutbe" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
							<option selected disabled></option>
							<?php 
							$rutbe_sor = $db->prepare("SELECT * FROM  rutbe where Rutbe_Durum=:Rutbe_Durum order by Rutbe_Sira_No ASC");
							$rutbe_sor->execute(array(
								'Rutbe_Durum'=>1));
							while ($rutbe_cek = $rutbe_sor->fetch(PDO::FETCH_ASSOC)) {
								?>

								<option value="<?php echo $rutbe_cek['Rutbe_Id'] ?>"><?php echo $rutbe_cek['Rutbe_Adi'] ?></option>
							<?php } ?>	
						</select>
					</div>
				</div>
			</div>


			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" id="Mulku_Metni" >				
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi" >
						<span class="FormAlanlariIciRadioButonAlanlariKapsayicisi">
							<label class="FormAlanlariIciRadioButonAlani">
								<input checked="checked" type="radio" id="Zabit" name="Zabit_Mulu" value="0" class="FormAlanlariIciRadioInputlari"/>
								<span class="FormAlanlariIciRadioButonAlanlariIcinBicimlendirmeAlani">							
								</span>
								<span class="FormAlanlariIciRadioButonAlanlariIcinMetinAlani" for="Zabit">Zabit</span>
							</label>
						</span>
						<span class="FormAlanlariIciRadioButonAlanlariKapsayicisi">
							<label class="FormAlanlariIciRadioButonAlani">
								<input type="radio" id="Mulku" name="Zabit_Mulu" value="1" class="FormAlanlariIciRadioInputlari"/>
								<span class="FormAlanlariIciRadioButonAlanlariIcinBicimlendirmeAlani">				
								</span>
								<span class="FormAlanlariIciRadioButonAlanlariIcinMetinAlani" for="Mulku">Mülkü</span>
							</label>
						</span>
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Id">İdarə<span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
						<?php
						if ($VezifeButunIdareler==1) {
							$Yeni_Sobe_Ucun_Idare_Sor = $db->prepare("SELECT * FROM  idare where Durum=:Durum order by Sira_No ASC");
							$Yeni_Sobe_Ucun_Idare_Sor->execute(array(
								'Durum'=>1
							));
						}else{
							$Yeni_Sobe_Ucun_Idare_Sor = $db->prepare("SELECT * FROM  idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC");
							$Yeni_Sobe_Ucun_Idare_Sor->execute(array(
								'Durum'=>1,
								'Idare_Id'=>$Islediyi_Idare_Id
							));
						}
						
						?>
						<select name="Idare_Id" tabindex="2" required="required" id="Idare_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id),VezifeUcunSobeTelebEt(this.value)">
							<option disabled="disabled" value="" selected="selected"></option>
							<?php
							while ($Yeni_Sobe_Ucun_Idare_Cek = $Yeni_Sobe_Ucun_Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Sor=$db->prepare("SELECT * FROM sobe WHERE Idare_Id=:Idare_Id and Durum=:Durum");
								$Sor->execute(array(
									'Idare_Id'=>$Yeni_Sobe_Ucun_Idare_Cek['Idare_Id'],
									'Durum'=>1));
								$Say=$Sor->rowCount();
								if ($Say>0) {
									?>
									<option value="<?php echo $Yeni_Sobe_Ucun_Idare_Cek['Idare_Id'] ?>"><?php echo $Yeni_Sobe_Ucun_Idare_Cek['Idare_Adi'] ?></option>
								<?php } } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="SeyfeIciSetirAlaniKapsayici">
					<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
						<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Sobe_Id">Şöbə <span class="KirmiziYazi">*</span>
						</div>
						<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi" id="YeniVezifeSobe">
							<select name="Sobe_Id" tabindex="2" required="required" id="Sobe_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
								<option disabled="disabled" value="" selected="selected"> </option>
							</select>
						</div>
					</div>
				</div>

				<?php 
				$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Durum=:Vezife_Adlari_Durum order by Vezife_Adlari_Sira ASC ");
				$Vezife_Adlari_Sor->execute(array(
					'Vezife_Adlari_Durum'=>1));
					?>
					<div class="SeyfeIciSetirAlaniKapsayici">
						<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
							<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Vezife_Adlari_Id">Vezifə<span class="KirmiziYazi">*</span>
							</div>
							<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">

								<select  tabindex="2" required="required" id="Vezife_Adlari_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
									<option disabled="disabled" value="" selected="selected"> </option>
									<?php 
									while ($Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC)) {
										?>
										<option value="<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Id'] ?>"><?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Ad'] ?></option>
									<?php } ?>
								</select>

							</div>
						</div>
					</div>

					<div class="SeyfeIciSetirAlaniKapsayici">
						<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
							<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Vezife_Pulu">Vəzifə Pulu <span class="KirmiziYazi">*</span>
							</div>
							<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
								<input type = "number" step="any" class=" FormAlanlariUcunTextInputlari "  oninput="VezifePuluYazildi(this.id)" maxlength="10"   onkeydown="VezifePuluYazildi(this.id)"  id="Vezife_Pulu"  tabindex="1" required="" />
							</div>
						</div>
					</div>

					<div class="SeyfeIciSetirAlaniKapsayici">
						<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
							<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Esas_Mezuniyyeti">Əsas Məzuniyyəti <span class="KirmiziYazi">*</span>
							</div>
							<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
								<input type = "number" step="any" class=" FormAlanlariUcunTextInputlari "  oninput="VezifePuluYazildi(this.id)" maxlength="10"   onkeydown="VezifePuluYazildi(this.id)"  id="Esas_Mezuniyyeti"  tabindex="1" required="" />
							</div>
						</div>
					</div>


					<div class="SayfaIciButonlarIcinSatirAlanlariKapsayicisi">
						<button type="button" class="YenileButonlari"  onClick="FormKontrolYoxlanis()"  tabindex="5">Əlavə Et</button>
						<button type="button" class="QirmiziButonlar"  onClick="Bagla();" tabindex="6" >İmtina Et</button>
					</div>
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</form>
				<?php 
			}else{
				header("Location:../login.php");
				exit;
			}
		}
		?>
