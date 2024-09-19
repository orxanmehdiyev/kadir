<?php 
require_once '../Ayarlar/setting.php';
if ($SobeBolmeYeni==1) {
	if (isset($_POST['yeni'])) {
		?>
		<form name="IslemFormu">
			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Id">İdarə <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
						<?php
						$Yeni_Sobe_Ucun_Idare_Sor = $db->prepare("SELECT * FROM  idare where Durum=:Durum order by Sira_No ASC");
						$Yeni_Sobe_Ucun_Idare_Sor->execute(array(
							'Durum'=>1
						));
						?>
						<select name="Idare_Id" tabindex="2" required="required" id="Idare_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)">
							<option disabled="disabled" value="" selected="selected"> Secin...</option>
							<?php
							while ($Yeni_Sobe_Ucun_Idare_Cek = $Yeni_Sobe_Ucun_Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<option value="<?php echo $Yeni_Sobe_Ucun_Idare_Cek['Idare_Id'] ?>"><?php echo $Yeni_Sobe_Ucun_Idare_Cek['Idare_Adi'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>';
			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Sobe_Ad" >Adı <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
						<input type = "text" class=" FormAlanlariUcunTextInputlari" oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SecimEdildi(this.id)" maxlength = "80"  id="Sobe_Ad"  tabindex="1" required="" />
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
}?>
