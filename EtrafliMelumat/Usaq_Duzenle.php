<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['duzenle'])) {
	$User_Usaq_Id=ReqemlerXaricButunKarakterleriSil($_POST['duzenle']);
	$Usaq_Sor=$db->prepare("SELECT * FROM user_usaq where User_Usaq_Id=:User_Usaq_Id ");
	$Usaq_Sor->execute(array(
		'User_Usaq_Id'=>$User_Usaq_Id));
	$Usaq_Cek=$Usaq_Sor->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row">						
		<form class="row g-3 p-2">		
		<input type="hidden" id="User_Usaq_Id" value="<?php echo $User_Usaq_Id ?>">				
			<div class="col-3">
				<label for="UsaqSoyadi" class="form-label">Soyadı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Usaq_Cek['Soyadi'] ?>"  id="UsaqSoyadi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-3">
				<label for="UsaqAdi" class="form-label">Adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Usaq_Cek['Adi'] ?>"  id="UsaqAdi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	

			<div class="col-3">
				<label for="UsaqAtaadi" class="form-label">Ata adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Usaq_Cek['Ataadi'] ?>" id="UsaqAtaadi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>
			<div class="col-2">
				<label for="Usaq_Dogum_Tarixi" class="form-label">Doğum tarixi<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control tarix"  id="Usaq_Dogum_Tarixi" value="<?php echo $Usaq_Cek['Dogum_Tarixi'] ?>"  oninput="TarixKontrol(this.id)" onfocusout="TarixKontrol(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="10" tabindex="1" title="">
			</div>
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="UsaqDuzenleFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>