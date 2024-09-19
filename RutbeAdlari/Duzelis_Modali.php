<?php 
require_once '../Ayarlar/setting.php';
if ($RutbeAdlariDuzelis==1) {
	if (isset($_POST['Deyer'])) {
		$Rutbe_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sor=$db->prepare("SELECT * FROM  rutbe where  Rutbe_Id=:Rutbe_Id");
		$Sor->execute(array(
			'Rutbe_Id'=>$Rutbe_Id));
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		?>
		<input type="hidden" id="Rutbe_Id" value="<?php echo $Rutbe_Id ?>">
		<div class="row">						
			<form class="row g-3 p-2 ">						
				<div class="col-12 col-sm-6">
					<label for="Rutbe_Adi" class="form-label">Rütbə Adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Rutbe_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "150" tabindex="1" title="" value="<?php echo $Cek['Rutbe_Adi'] ?>">
				</div>		
				<div class="col-12 col-sm-6">
					<label for="Rutbe_Pulu" class="form-label">Rütbə Pulu<span class="KirmiziYazi">*</span></label>
					<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Pulu" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" value="<?php echo $Cek['Rutbe_Pulu'] ?>" >
				</div>	
				<div class="col-12 col-sm-3">
					<label for="Rutbe_Sira_No" class="form-label">Sıra Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Sira_No" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" value="<?php echo $Cek['Rutbe_Sira_No'] ?>" >
				</div>	

				<div class="col-12 col-sm-6">
					<label for="Rutbe_Xidmet_Ili" class="form-label">Xidmət İli (Müəyyen Edilən Rütbələr Üçün Yazılır)</label>
					<input type="number" min="0" max="20" class="form-control" id="Rutbe_Xidmet_Ili"   maxlength = "8" tabindex="1" title="" value="<?php echo $Cek['Rutbe_Xidmet_Ili'] ?>" >
				</div>
				<div class="col-12 text-center mt-3">
					<button type="button" onclick="DuzeliFormKontrol()" class="YenileButonlari" tabindex="15" title="Məlumatın Taddaşa Yazılması Üçün Təsdiq">Düzəliş Et</button>
					<button type="button" onClick="Bagla();" class="YenileButonlari" tabindex="16" title="Məlumatların Yaddaşa Yazılmasından İmtina">İmtina Et</button>
				</div>		
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>				
			</form>	
		</div>
	<?php }
} ?>