<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Ezamiyye_Emri_Id                            =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']); 
	$Sor=$db->prepare("SELECT * FROM ezamiyye_emri where Ezamiyye_Emri_Id=:Ezamiyye_Emri_Id");
	$Sor->execute(array(
		'Ezamiyye_Emri_Id'=>$Ezamiyye_Emri_Id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$Cek['ID'],
		'Durum'=>1));
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
	if ($Cek['Ezam_Novu']==0) {
		$EzamiyyeNovu="Daxili ezamiyyə";
	}else{
		$EzamiyyeNovu="Xarici ezamiyyə";
	}

	?>
	<div class="row">						
		<form class="row p-2 ">		
<input type="hidden" id="Ezamiyye_Emri_Id" value="<?php echo $Ezamiyye_Emri_Id ?>">
			<div class="col-2">
				<label for="Ezam_geri_Tarixi" class="form-label">Geri çağrılma tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1 tarix" value="<?php echo $Cek['Ezam_Bitis_Tarixi']?>" autocomplete="off" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)" maxlength="10" id="Ezam_geri_Tarixi"  title="">
			</div>
				<div class="col-3">
				<label for="Ezamiyye_Geri_Emir_No" class="form-label">Geri çağrılma əmrinin no<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ezamiyye_Geri_Emir_No" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Cek['Ezamiyye_Geri_Emir_No']?>" maxlength = "150" tabindex="10" >
			</div>
			<hr>
			<div class="col-12">
				<label for="Ezam_Geri_Sebeb" class="form-label">Geri çağrılma səbəbi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Ezam_Geri_Sebeb" value="<?php echo $Cek['Ezam_Geri_Sebeb']?>" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" >
			</div>
			<hr>
			<div class="col-3">
				<label  class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $AdSoyadAtaadi ?>" title="">				
			</div>	

			
			<div class="col-3">
				<label for="Ezam_Novu	" class="form-label">Ezamiyə növü<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $EzamiyyeNovu ?>" title="">
			</div>	
			<div class="col-2">
				<label for="Ezam_Baslangic_Tarixi" class="form-label">Başlanğıc tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $Cek['Ezam_Baslangic_Tarixi']?>" title="">
			</div>

			<div class="col-2">
				<label for="Ezam_Bitis_Tarixi" class="form-label">Bitiş tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $Cek['Ezam_Bitis_Tarixi']?>" title="">
			</div>

			<div class="col-1">
				<label for="Ezam_Gun_Sayi" class="form-label">Gün<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $Cek['Ezam_Gun_Sayi']?>" title="">
			</div>
			<hr>
			<div class="col-6">
				<label for="Ezam_Olundugu_Yer" class="form-label">Ezam yeri<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $Cek['Ezam_Olundugu_Yer']?>" title="">
			</div>

			<div class="col-2">
				<label for="Ezam_Emri_No" class="form-label">Ezamiyyə Əmrinin No<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $Cek['Ezam_Emri_No']?>" title="">
			</div>
			<hr>
			<div class="col-12">
				<label for="Ezam_Sebebi" class="form-label">Ezamiyyə səbəbi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $Cek['Ezam_Sebebi']?>" title="">
			</div>
			<div class="col-6">
				<label for="Idare_Ad" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $User_Cek['Idare_Ad']?>" title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $User_Cek['Sobe_Ad']?>" title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ad" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" readonly value="<?php echo $User_Cek['Vezife_Ad']?>" title="">
			</div>


			<div class="col-12 text-center mt-3">
				<button type="button" onclick="GeriFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>	

			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>	
		</form>	
	</div>
	<?php } ?>