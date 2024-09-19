<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['duzenle'])) {
	$Xarici_Dil_Id=ReqemlerXaricButunKarakterleriSil($_POST['duzenle']);
	$Xarici_Dil=$db->prepare("SELECT * FROM  xarici_dil where Xarici_Dil_Id=:Xarici_Dil_Id ");
	$Xarici_Dil->execute(array(
		'Xarici_Dil_Id'=>$Xarici_Dil_Id));
	$Xarici_Cek=$Xarici_Dil->fetch(PDO::FETCH_ASSOC)
	?>
	<div class="row">						
		<form class="row g-3 p-2 justify-content-center">			
			<input type="hidden" id="Xarici_Dil_Id" value="<?php echo $Xarici_Dil_Id?>">			
			<div class="col-4">
				<label for="Xarici_Dil_Ad" class="form-label">Xarici dil<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Xarici_Cek['Xarici_Dil_Ad'] ?>" id="Xarici_Dil_Ad" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
			</div>	
			<div class="col-4">
				<label for="Xarici_Dil_Sevye" class="form-label">Bilik səviyyəsi<span class="KirmiziYazi">*</span></label>
				<select id="Xarici_Dil_Sevye" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">				
					<option <?php echo $Xarici_Cek['Xarici_Dil_Sevye']==1?"selected":"" ?> value="1">Kafi</option>
					<option <?php echo $Xarici_Cek['Xarici_Dil_Sevye']==2?"selected":"" ?> value="2">Yaxşı</option>
					<option <?php echo $Xarici_Cek['Xarici_Dil_Sevye']==3?"selected":"" ?> value="3">Əla</option>
				</select>
			</div>
			<div class="col-12 text-center mt-3">
				<button type="button" onclick="XariciDilDuzenleFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>			
		</form>	
	</div>
	<?php } ?>