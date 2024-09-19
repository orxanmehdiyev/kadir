<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['duzenle'])) {
	$Bank_Hesab_Nomresi_Id=ReqemlerXaricButunKarakterleriSil($_POST['duzenle']);
	$Bank_Hesab=$db->prepare("SELECT * FROM  bank_hesab_nomrsei where Bank_Hesab_Nomresi_Id=:Bank_Hesab_Nomresi_Id");
	$Bank_Hesab->execute(array(
		'Bank_Hesab_Nomresi_Id'=>$Bank_Hesab_Nomresi_Id));
	$Bank_HesabCek=$Bank_Hesab->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row">						
		<form class="row g-3 p-2 justify-content-center">		
			<input type="hidden" id="Bank_Hesab_Nomresi_Id" value="<?php echo $Bank_Hesab_Nomresi_Id ?>">				
			<div class="col-4">
				<label for="Bank_Hesab_Nomresi_Bank_Adi" class="form-label">Bankın adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Bank_HesabCek['Bank_Hesab_Nomresi_Bank_Adi'] ?>" id="Bank_Hesab_Nomresi_Bank_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>
			<div class="col-4">
				<label for="Bank_Hesab_Nomresi" class="form-label">Hesab nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Bank_HesabCek['Bank_Hesab_Nomresi'] ?>"  id="Bank_Hesab_Nomresi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="BankHesabNoDuzenleFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>