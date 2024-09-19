<?php 
require_once '../Ayarlar/setting.php';
if ($IdarelerYeni==1) {

if (isset($_POST['yeni'])) {
	?>
	<form name="IslemFormu">
		<div class="SeyfeIciSetirAlaniKapsayici">
			<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
				<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Ust_Id" >Tabe Olduğu Qurum <span class="KirmiziYazi">*</span>
				</div>
				<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
					<?php
					$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Durum=:Durum order by Sira_No ASC ");
					$Sor->execute(array(
						'Durum'=>1));
						?>
						<select tabindex="2" required="required" id="Ust_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)" title="Secim Edin">
							<option disabled="disabled" value="" selected="selected"></option>
							<?php
							while ($Cek = $Sor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<option value="<?php echo $Cek['Id'] ?>"><?php echo $Cek['Adi'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Adi" >Adı <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class=" FormAlanlariUcunTextInputlari number"oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "80"  id="Idare_Adi"  tabindex="1" required="" />
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Kissa_Adi" >Kısa Adı <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class=" FormAlanlariUcunTextInputlari number"oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "80"  id="Idare_Kissa_Adi"  tabindex="1" required="" />
					</div>
				</div>
			</div>
			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_VOEN">VÖEN <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "number" class=" FormAlanlariUcunTextInputlari number"  oninput="VoenYazildi(this.id)" maxlength="10"  onfocusout="VoenYazildi(this.id),SagVeSolBosluklariSIl(this.id)" onkeydown="javascript: return event.keyCode == 69 ? false : true"  id="Idare_VOEN"  tabindex="1" required="" />
					</div>
				</div>
			</div>
			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Unvan">Ünvanı <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class=" FormAlanlariUcunTextInputlari number" oninput="AdiYazildi(this.id),AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "100"  id="Idare_Unvan"  tabindex="1" required="" />
					</div>
				</div>
			</div>
			<div class="SayfaIciButonlarIcinSatirAlanlariKapsayicisi">
				<button type="button" class="YenileButonlari"  onClick="YeniFormKontrol()"  tabindex="5">Əlavə Et</button>
				<button type="button" class="QirmiziButonlar"  onClick="Bagla();" tabindex="6" >İmtina Et</button>
			</div>
			<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
		</form>
		<?php 
	}else{
		header("Location:../login.php");
		exit;
	}	// code...
}?>
