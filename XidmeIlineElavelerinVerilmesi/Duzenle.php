<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {
	$Xidmet_Iline_Elave_Id  = ReqemlerXaricButunKarakterleriSil($_POST['yeni']);
	$Sor=$db->prepare("SELECT * FROM  xidmet_iline_elave where Xidmet_Iline_Elave_Id=:Xidmet_Iline_Elave_Id");
	$Sor->execute(array(
		'Xidmet_Iline_Elave_Id'=>$Xidmet_Iline_Elave_Id));
	$Ceks=$Sor->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row">						
		<form class="row p-2 ">		
			<input type="hidden" id="Xidmet_Iline_Elave_Id" value="<?php echo $Xidmet_Iline_Elave_Id ?>" >
			<div class="col-4">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
					<?php 
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC ");
					$Idare_Sor->execute(array(
						'Durum'=>1));
					while ($Idare_ceker=$Idare_Sor->fetch(PDO::FETCH_ASSOC)){
						$Idare_Id=$Idare_ceker['Idare_Id'];
						$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
						$Sobe_Sor->execute(array(
							'Durum'=>1,
							'Idare_Id'=>$Idare_Id));
						while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)){
							$Sobe_Id=$Sobe_Cek['Sobe_Id'];
							$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
							$Vezife_Sor->execute(array(
								'Durum'=>1,
								'Idare_Id'=>$Idare_Id,
								'Sobe_Id'=>$Sobe_Id,
								'User_Id'=>0));
							while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)){
								$Vezife_Id=$Vezife_Cek['Vezife_Id'];
								$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
								$User_Sor->execute(array(
									'Durum'=>1,
									'Islediyi_Idare_Id'=>$Idare_Id,
									'Islediyi_Sobe_Id'=>$Sobe_Id,
									'Vezife_Id'=>$Vezife_Id));
								$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
								$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
								$ID=$User_Cek['ID']; ?>
								<option <?php echo $Ceks['ID']==$ID?"selected":"" ?>  value="<?php echo $ID ?>"><?php echo $AdSoyadAtaadi ?></option>									
							<?php }
						}
					}
					?>
				</select>
			</div>	
			<hr>
			<?php 
			$User_Sorr=$db->prepare("SELECT * FROM user where ID=:ID");
			$User_Sorr->execute(array(
				'ID'=>$Ceks['ID']
			));
			$User_Ceks=$User_Sorr->fetch(PDO::FETCH_ASSOC);
			?>
			<div class="col-6">
				<label for="Idare_Ad" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" value="<?php echo $User_Ceks['Idare_Ad']; ?>"  id="Idare_Ad"  readonly  title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" value="<?php echo $User_Ceks['Sobe_Ad']; ?>" id="Sobe_Ad" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ad" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" value="<?php echo $User_Ceks['Vezife_Ad']; ?>" id="Vezife_Ad" readonly title="">
			</div>

			<div class="col-3">
				<label for="Ise_Qebul_Tarixi" class="form-label">Xidmətə qəbul tarixi<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" value="<?php echo Tarix_Beynelxalqi_Az_Cevir($User_Ceks['Ise_Qebul_Tarixi']); ?>" id="Ise_Qebul_Tarixi" readonly title="">
			</div>

			<hr>
			<div class="col-3">
				<label for="Xidmet_Iline_Elave_Verilme_tarixi" style="width: 250px" class="form-label ">Xidmət ilinə əlavənin verilmə tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1" autocomplete="off" id="Xidmet_Iline_Elave_Verilme_tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  value="<?php echo Tarix_Beynelxalqi_Az_Cevir($Ceks['Xidmet_Iline_Elave_Verilme_tarixi']); ?>" required="required" maxlength="10" tabindex="5" title="">
			</div>

			<div class="col-3">				
				<label for="Xidmet_Iline_Elave	" class="form-label">Xidmət ilinə əlavə (%)<span class="KirmiziYazi">*</span></label>
				<select id="Xidmet_Iline_Elave" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option value="5" <?php echo $Ceks['Xidmet_Iline_Elave']==5?"selected":""; ?> >5</option>
					<option value="10" <?php echo $Ceks['Xidmet_Iline_Elave']==10?"selected":""; ?>>10</option>
					<option value="15" <?php echo $Ceks['Xidmet_Iline_Elave']==15?"selected":""; ?>>15</option>
					<option value="20" <?php echo $Ceks['Xidmet_Iline_Elave']==20?"selected":""; ?>>20</option>
					<option value="25" <?php echo $Ceks['Xidmet_Iline_Elave']==25?"selected":""; ?>>25</option>
					<option value="30" <?php echo $Ceks['Xidmet_Iline_Elave']==30?"selected":""; ?>>30</option>
					<option value="40" <?php echo $Ceks['Xidmet_Iline_Elave']==40?"selected":""; ?>>40</option>
					<option value="50" <?php echo $Ceks['Xidmet_Iline_Elave']==50?"selected":""; ?>>50</option>					
				</select>
			</div>
			<hr>
			<div class="col-3">
				<label for="Emrin_Tarixi" style="width: 250px" class="form-label ">Əmrin tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1" autocomplete="off" id="Emrin_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  value="<?php echo Tarix_Beynelxalqi_Az_Cevir($Ceks['Emrin_Tarixi']); ?>" required="required" maxlength="10" tabindex="5" title="">
			</div>

			<div class="col-3">
				<label for="Emir_No" class="form-label ">Əmrin nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control " id="Emir_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id)"  value="<?php echo $Ceks['Emir_No']; ?>" required="required" maxlength="10" tabindex="5" title="">
			</div>



			<div class="col-12 text-center mt-3">
				<button type="button" onclick="DuzenleFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
				<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
			</div>	
			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>
		</form>	
	</div>
	<?php } ?>