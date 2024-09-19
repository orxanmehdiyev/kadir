<?php 
require_once '../Ayarlar/setting.php';
if ($YeniBasIdare==1) {

	if (isset($_POST['yeni'])) {
		?>
		<form name="IslemFormu">
			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Adi" >Adı 
						<span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class="FormAlanlariUcunTextInputlari"  oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150"  id="Adi"  tabindex="1" required="" title="Adını Yazın" />
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan bordernone">
					<button type="button" class="YenileButonlari"  onClick="YeniFormKontrol()"  tabindex="5">Yaddaşa Yaz</button> 
					<button type="button" class="QirmiziButonlar"  onClick="Bagla();" tabindex="6" >İmtina Et</button>
				</div>
			</div>
			<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
		</form>
		<?php 
	}else{
		header("Location:../login");
	}
	// code...
} ?>
