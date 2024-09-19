<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyse'])) {
	$Rutbe_Emri_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyse']);
	$Sor=$db->prepare("SELECT * FROM  rutbe_emri where Rutbe_Emri_Id=:Rutbe_Emri_Id");
	$Sor->execute(array(
		'Rutbe_Emri_Id'=>$Rutbe_Emri_Id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$tarix=explode(".", $Cek['Rutbe_Emri_Tarixi']);
	?>
	<input type="hidden" id="Rutbe_Emri_Id" value="<?php echo $Rutbe_Emri_Id ?>">
	<div class="row">						
		<form class="row g-3 p-2 ">						
			<div class="col-7">
				<label for="Rutbe_Id	" class="form-label">Rütbə<span class="KirmiziYazi">*</span></label>
				<select id="Rutbe_Id" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					
					<?php 
					$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Durum=:Rutbe_Durum order by Rutbe_Sira_No ASC ");
					$Rutbe_Sor->execute(array(
						'Rutbe_Durum'=>1));
						while ($Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC)) {						?>
							<option
							<?php echo $Rutbe_Cek['Rutbe_Id']==$Cek['Rutbe_Id']?"selected":"" ?>
							value="<?php echo $Rutbe_Cek['Rutbe_Id'] ?>"><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></option>
						<?php } ?>					
					</select>
				</div>	
				<div class="col-2">
					<label for="Rutbe_Emri_Tarixi" class="form-label">Tarix<span class="KirmiziYazi">*</span></label>
					<input type="date" class="form-control" name="Rutbe_Emri_Tarixi" id="Rutbe_Emri_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $tarix[2]."-".$tarix[1]."-".$tarix[0]?>" required="required" maxlength ="255" tabindex="1" title="">
				</div>
				<div class="col-3">
					<label for="Rutbe_Emrinin_No" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" value="<?php echo $Cek['Rutbe_Emrinin_No'] ?>" name="Rutbe_Emrinin_No" id="Rutbe_Emrinin_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
				</div>
				<div class="col-12">
					<label for="Rutbe_Emri_Sebeb" class="form-label">Səbəb və qeyd<span class="KirmiziYazi">*</span></label>
						<select id="Rutbe_Emri_Novu" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">	
						<option <?php echo $Cek['Rutbe_Emri_Novu']==1?"selected":"" ?> value="1">İlkin xüsusi rütbənin verilməsi</option>
						<option <?php echo $Cek['Rutbe_Emri_Novu']==2?"selected":"" ?> value="2">Növbəti xüsusi rütbənin verilməsi</option>							
						<option <?php echo $Cek['Rutbe_Emri_Novu']==3?"selected":"" ?> value="3">Vaxdından əvvəl xüsusi rütbənin verilməsi</option>							
						<option <?php echo $Cek['Rutbe_Emri_Novu']==4?"selected":"" ?> value="4">Bir pillə yuxarı xüsusi rütbənin verilməsi</option>							
					</select>
				</div>
				<div class="col-12 text-center mt-3">
					<button type="button" onclick="RutbeDuzenleFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>			
			</form>	
		</div>
		<?php } ?>