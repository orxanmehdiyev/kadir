<?php require_once '../Ayarlar/setting.php';
if ($HeveslendiremAdlariDuzelis==1) {
if (isset($_POST['Deyer'])) {
	$heveslendirem_tedbirleri_ad_id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM  heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id");
	$Sor->execute(array(
		'heveslendirem_tedbirleri_ad_id'=>$heveslendirem_tedbirleri_ad_id
	));
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		?>
		<div class="row">						
			<form class="row g-3 p-2 ">						
				<div class="col-12">
					<label for="heveslendirem_tedbirleri_ad" class="form-label">Həvəsləndirmə Tədbirinin Adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="heveslendirem_tedbirleri_ad" oninput="TenbehAdiYazildi(this.id)" onfocusout="TenbehAdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" value="<?php echo $Cek['heveslendirem_tedbirleri_ad']  ?>" maxlength ="255" tabindex="1" title="">
				</div>

				<div class="col-12">
					<label for="heveslendirem_tedbirleri_ad_Sira_No" class="form-label">Sıra nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="number" class="form-control" id="heveslendirem_tedbirleri_ad_Sira_No" oninput="ReqemAlaniYazildi(this.id)" onfocusout="ReqemAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" value="<?php echo $Cek['heveslendirem_tedbirleri_ad_Sira_No']  ?>" title="" min="0" onkeydown="javascript: return event.keyCode == 69 ? false : true" maxlength="3000">
				</div>

				<div class="col-12">
					<label for="heveslendirem_tedbirleri_ad_Xususi_No" class="form-label">Xüsusi nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="number" class="form-control" id="heveslendirem_tedbirleri_ad_Xususi_No" oninput="ReqemAlaniYazildi(this.id)" onfocusout="ReqemAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" value="<?php echo $Cek['heveslendirem_tedbirleri_ad_Xususi_No']  ?>" title=""  min="0" onkeydown="javascript: return event.keyCode == 69 ? false : true" maxlength="3000">
				</div>
				<input type="hidden" id="heveslendirem_tedbirleri_ad_id" value="<?php echo $heveslendirem_tedbirleri_ad_id ?>">
				<div class="col-12 text-center mt-3">
					<button type="button" onclick="DuzelisFormKontrol()"  class="YenileButonlari" tabindex="15" title="">Düzeliş Et</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina Et</button>
				</div>
				<div class="col-6">

					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>

			</form>	
		</div>
		<?php
	}else{
		echo "error_2000";/* Düzeliş edilə bilməz*/
		exit;
	}
}else{
	header("Location:../intizam_tebehi_adlari");
	exit;
}
} ?>