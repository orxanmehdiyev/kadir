<?php 
require_once '../Ayarlar/setting.php';
if ($VezifelerDuzeli==1) {
	if (isset($_POST['Deyer'])) {
		$Vezife_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Vezife_Id=:Vezife_Id");
		$Vezife_Sor->execute(array(
			'Vezife_Id'=>$Vezife_Id));
		$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
		?>
		<form name="IslemFormu">

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici">Vəzifənin Növü<span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
						<select  tabindex="2" required="required" id="Vezifenin_Novu" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
							
							<option <?php if ($Vezife_Cek['Stat_Muqavile']==0) {
								echo 	"selected='selected'";
							}else{} ?> value="0">Ştat Daxili</option>
							<option <?php if ($Vezife_Cek['Stat_Muqavile']==1) {
								echo 	"selected='selected'";
							}else{} ?> value="1">Ştatdan Kənar</option>		
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

								<option <?php if ($Vezife_Cek['AlaBileceyiRutbe']==$rutbe_cek['Rutbe_Id']) {
									echo 	"selected='selected'";
								}else{} ?> value="<?php echo $rutbe_cek['Rutbe_Id'] ?>"><?php echo $rutbe_cek['Rutbe_Adi'] ?></option>
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
								<input 
								<?php if ($Vezife_Cek['Zabit_Mulu']==0) {
									echo 'checked="checked"';
								}else{} ?>
								type="radio" id="Zabit" name="Zabit_Mulu" value="0" class="FormAlanlariIciRadioInputlari"/>
								<span class="FormAlanlariIciRadioButonAlanlariIcinBicimlendirmeAlani">							
								</span>
								<span class="FormAlanlariIciRadioButonAlanlariIcinMetinAlani" for="Zabit">Zabit</span>
							</label>
						</span>
						<span class="FormAlanlariIciRadioButonAlanlariKapsayicisi">
							<label class="FormAlanlariIciRadioButonAlani">
								<input
								<?php if ($Vezife_Cek['Zabit_Mulu']==1) {
									echo 'checked="checked"';
								}else{} ?> 
								type="radio" id="Mulku" name="Zabit_Mulu" value="1" class="FormAlanlariIciRadioInputlari"/>
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
							<?php
							while ($Yeni_Sobe_Ucun_Idare_Cek = $Yeni_Sobe_Ucun_Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Sor=$db->prepare("SELECT * FROM sobe WHERE Idare_Id=:Idare_Id and Durum=:Durum");
								$Sor->execute(array(
									'Idare_Id'=>$Yeni_Sobe_Ucun_Idare_Cek['Idare_Id'],
									'Durum'=>1));
								$Say=$Sor->rowCount();
								if ($Say>0) {
									?>
									<option
									<?php if ($Yeni_Sobe_Ucun_Idare_Cek['Idare_Id']==$Vezife_Cek['Idare_Id']) {
										echo "selected='selected'";
									}else{} ?>
									value="<?php echo $Yeni_Sobe_Ucun_Idare_Cek['Idare_Id'] ?>"><?php echo $Yeni_Sobe_Ucun_Idare_Cek['Idare_Adi'] ?></option>
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
							<?php 	
							$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum ");
							$Sobe_Sor->execute(array(
								'Idare_Id'=>$Vezife_Cek['Idare_Id'],
								'Durum'=>1
							)); ?>
							<select name="Sobe_Id" tabindex="2" required="required" id="Sobe_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
								<option disabled="disabled" value="" selected="selected"> </option>
								<?php
								while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
									?>
									<option
									<?php if ($Sobe_Cek['Sobe_Id']==$Vezife_Cek['Sobe_Id']) {
										echo "selected='selected'";
									}else{} ?>
									value="<?php echo $Sobe_Cek['Sobe_Id'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
								<?php } ?>
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
									<?php 
									while ($Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC)) {
										?>
										<option 
										<?php if ($Vezife_Adlari_Cek['Vezife_Adlari_Id']==$Vezife_Cek['Vezife_Adlari_Id']) {
											echo "selected='selected'";
										}else{} ?>
										value="<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Id'] ?>"><?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Ad'] ?></option>
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
								<input type = "number" step="any" class=" FormAlanlariUcunTextInputlari "  oninput="VezifePuluYazildi(this.id)" maxlength="10" value="<?php echo $Vezife_Cek['Vezife_Pulu'] ?>"  onkeydown="VezifePuluYazildi(this.id)"  id="Vezife_Pulu"  tabindex="1" required=""  />
							</div>
						</div>
					</div>

					<div class="SeyfeIciSetirAlaniKapsayici">
						<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
							<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Sira_No">Sira Nömrəsi<span class="KirmiziYazi">*</span>
							</div>
							<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
								<input type = "number" step="any" class=" FormAlanlariUcunTextInputlari "  oninput="VezifePuluYazildi(this.id)" maxlength="10" value="<?php echo $Vezife_Cek['Sira_No'] ?>"  onkeydown="VezifePuluYazildi(this.id)"  id="Sira_No"  tabindex="1" required=""  />
							</div>
						</div>
					</div>
					<div class="SeyfeIciSetirAlaniKapsayici">
						<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
							<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Esas_Mezuniyyeti">Əsas Məzuniyyəti<span class="KirmiziYazi">*</span>
							</div>
							<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
								<input type = "number" step="any" class=" FormAlanlariUcunTextInputlari "  oninput="VezifePuluYazildi(this.id)" maxlength="10" value="<?php echo $Vezife_Cek['Esas_Mezuniyyeti'] ?>"  onkeydown="VezifePuluYazildi(this.id)"  id="Esas_Mezuniyyeti"  tabindex="1" required=""  />
							</div>
						</div>
					</div>
					<input type="hidden" id="Vezife_Id" value="<?php echo $Vezife_Id; ?>">
					<div class="SayfaIciButonlarIcinSatirAlanlariKapsayicisi">
						<button type="button" class="YenileButonlari"  onClick="DuzelisFormKontrolYoxlanis()"  tabindex="5">Yaddaşa Yaz</button>
						<button type="button" class="QirmiziButonlar"  onClick="Bagla();" tabindex="6" >İmtina Et</button>
					</div>
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</form>
				<?php 
			}else{
				header("Location:../login.php");
				exit;
			}
		}?>