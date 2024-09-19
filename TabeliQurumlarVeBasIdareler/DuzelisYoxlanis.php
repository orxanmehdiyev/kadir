<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	if ($BasIdareDuzenle==1) {
		// code...

		$Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sors=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Id=:Id");
		$Sors->execute(array(
			'Id'=>$Id));
		$Ceks=$Sors->fetch(PDO::FETCH_ASSOC);
		?>
		<form name="IslemFormu">		
			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Adi" >Adı 
						<span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class="FormAlanlariUcunTextInputlari"  oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150"  id="Adi" value="<?php echo $Ceks['Adi'] ?>"  tabindex="1" required="" title="Adını Yazın" />
					</div>
				</div>
			</div>
			<input type="hidden" id="duzelisid" value="<?php echo $Id ?>" >
			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan bordernone">
					<button type="button" class="YenileButonlari"  onClick="DuzelisFormKontrol()"  tabindex="5">Yaddaşa Yaz</button> 
					<button type="button" class="QirmiziButonlar"  onClick="Bagla();" tabindex="6" >İmtina Et</button>
				</div>
			</div>
			<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
		</form>
	<?php 	}
}else{
	header("Location:../login");
} ?>
