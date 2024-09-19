<?php require_once '../Ayarlar/setting.php';
if ($XidmeteXitamVerilmesisSebebiDuzelis==1) {
	if (isset($_POST['Deyer'])) {
		$xitam_sebebleri_id                 =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Xitam_Sebeb_Sor=$db->prepare("SELECT * FROM xitam_sebebleri where xitam_sebebleri_id=:xitam_sebebleri_id");
		$Xitam_Sebeb_Sor->execute(array(
			'xitam_sebebleri_id'=>$xitam_sebebleri_id));
		$Xitam_Sebeb_Cek=$Xitam_Sebeb_Sor->fetch(PDO::FETCH_ASSOC);
		?>
		<div class="row">						
			<form class="row p-2 ">	
				<input type="hidden" id="xitam_sebebleri_id" value="<?php echo $xitam_sebebleri_id ?>">
				<div class="col-12">
					<label for="xitam_sebebleri_ad" class="form-label ">Xitam səbəbi adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control"  id="xitam_sebebleri_ad" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Xitam_Sebeb_Cek['xitam_sebebleri_ad'] ?>" required="required" title=""  maxlength="255" tabindex="1">
				</div> 		
				<hr>
				<div class="col-12">
					<label for="xitam_sebebleri_kisa_ad" class="form-label ">Xitam səbəbi kıssa adı<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control"  id="xitam_sebebleri_kisa_ad" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Xitam_Sebeb_Cek['xitam_sebebleri_kisa_ad'] ?>" required="required" title=""  maxlength="255" tabindex="2">
				</div>
				<hr>
				<div class="col-12 text-center mt-3">
					<button type="button" onclick="DuzenleFormKontrol()" class="YenileButonlari" tabindex="3" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="4" title="">İmtina</button>
				</div>	
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>
			</form>	
		</div>
	<?php } 
}?>