<?php require_once '../Ayarlar/setting.php';
if ($MezuniyyetAdlariDuzelis==1) {
	if (isset($_POST['Deyer'])) {
		$Mezuniyyet_Novleri_ID  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sor=$db->prepare("SELECT * FROM mezuniyyet_novleri where Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID");
		$Sor->execute(array(
			'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID));
		$Ceks=$Sor->fetch(PDO::FETCH_ASSOC)
		?>
		<div class="row">						
			<form class="row g-3 p-2 ">						
				<div class="col-6">
					<label for="Mezuniyyet_Novleri_Ad" class="form-label">Adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Mezuniyyet_Novleri_Ad" oninput="Adıyazıldı(this.id)" onfocusout="Adıyazıldı(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="" value="<?php echo $Ceks['Mezuniyyet_Novleri_Ad']  ?>">
				</div>	
				<div class="col-6">
					<label for="Mezuniyyet_Novleri_Kissa_Ad" class="form-label">Kıssa adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Mezuniyyet_Novleri_Kissa_Ad" oninput="Adıyazıldı(this.id)" onfocusout="Adıyazıldı(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="" value="<?php echo $Ceks['Mezuniyyet_Novleri_Kissa_Ad']  ?>" >
				</div>	
				<div class="col-6">
					<label for="Mezuniyyet_Novleri_Sira" class="form-label">Sıra nöçrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Mezuniyyet_Novleri_Sira" oninput="Adıyazıldı(this.id)" onfocusout="Adıyazıldı(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="" value="<?php echo $Ceks['Mezuniyyet_Novleri_Sira']  ?>">
				</div>	 
				<div class="col-12 text-center mt-3">
					<button type="button" id="<?php echo $Mezuniyyet_Novleri_ID ?>" onclick="DuzelisFormKontrol(this.id)" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>
				<div class="col-6">

					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>
				
			</form>	
		</div>
	<?php }
} ?>