<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Diger_Xidmet_Ili_Id                 =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Diger_Sor=$db->prepare("SELECT * FROM diger_xidmet_illeri where Diger_Xidmet_Ili_Id=:Diger_Xidmet_Ili_Id");
	$Diger_Sor->execute(array(
		'Diger_Xidmet_Ili_Id'=>$Diger_Xidmet_Ili_Id));
	$Diger_Cek=$Diger_Sor->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row">						
		<form class="row p-2 ">		
			<input type="hidden" id="Diger_Xidmet_Ili_Id" value="<?php echo $Diger_Xidmet_Ili_Id ?>">
			<div class="col-4">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectIkiAlaniSecildi(this.id)">
					<option disabled="disabled" value="" selected="selected" tabindex="1"></option>
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
								$ID=$User_Cek['ID'];?>
								<option value="<?php echo $ID ?>"<?php echo $ID==$Diger_Cek['ID']?'selected="selected"':'';?>><?php  echo $AdSoyadAtaadi ?></option>";
							<?php	}
						}
					}
					?>
				</select>
			</div>	
			<hr>
			<?php 
			$Melumat_User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and ID=:ID");
			$Melumat_User_Sor->execute(array(
				'Durum'=>1,
				'ID'=>$Diger_Cek['ID']));
			$Melumat_User_Cek=$Melumat_User_Sor->fetch(PDO::FETCH_ASSOC);
			?>
			<div class="col-6">
				<label for="Idare_Ad" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Idare_Ad" value="<?php echo $Melumat_User_Cek['Idare_Ad'] ?>" readonly  title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Sobe_Ad" value="<?php echo $Melumat_User_Cek['Sobe_Ad'] ?>" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ad" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Vezife_Ad" value="<?php echo $Melumat_User_Cek['Vezife_Ad'] ?>" readonly title="">
			</div>
			<hr>
			<div class="col-6">
				<label for="Orqanin_Adi" class="form-label ">İşlədiyi İdarə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Diger_Cek['Orqanin_Adi'] ?>" id="Orqanin_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" title=""  maxlength="255" tabindex="9">
			</div>			

			<div class="col-6" id="yeniemirsobe">
				<label for="Vezifesi" onchange="SelectAlaniSecildi(this.id)" class="form-label ">İşlədiyi Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" value="<?php echo $Diger_Cek['Vezifesi'] ?>"  id="Vezifesi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" title=""  maxlength="255" tabindex="9">
			</div>
			<hr>
			<div class="col-2" style="width:120px;">
				<label for="Qebul_Tarixi" style="width: 206px" class="form-label ">Qəbul tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1 tarix" autocomplete="off" id="Qebul_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)" value="<?php echo Tarix_Beynelxalqi_Az_Cevir($Diger_Cek['Qebul_Tarixi']) ?>"  required="required" maxlength="10" tabindex="3" title="">
			</div>
			<div class="col-2" style="width:120px;">
				<label for="Azad_Olma_Tarixi" style="width: 206px" class="form-label">Azad olma tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1 tarix" autocomplete="off" id="Azad_Olma_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  value="<?php echo Tarix_Beynelxalqi_Az_Cevir($Diger_Cek['Azad_Olma_Tarixi']) ?>" required="required" maxlength="10" tabindex="5" title="">
			</div>
			<hr>
			<div class="col-2" style="width:120px;">
				<label for="gun" style="width: 206px" class="form-label">Gün<span class="KirmiziYazi">*</span></label>
				<input required="required" type="number" value="<?php echo $Diger_Cek['gun'] ?>"  class="form-control sinaqmuddetigun" min="0" max="365" id="gun" oninput="ReqemInputuDolduruldu(this.id)" title="" onkeydown="javascript: return event.keyCode == 69 ? false : true"  onfocusout="ReqemInputuDolduruldu(this.id)" maxlength="3" tabindex="9">
			</div>

			<div class="col-2" style="width:120px;">
				<label for="ay" style="width: 206px" class="form-label">Ay<span class="KirmiziYazi">*</span></label>
				<input required="required" type="number"  value="<?php echo $Diger_Cek['ay'] ?>"  class="form-control sinaqmuddetigun" min="0" max="365" id="ay" oninput="ReqemInputuDolduruldu(this.id)" title="" onkeydown="javascript: return event.keyCode == 69 ? false : true"  onfocusout="ReqemInputuDolduruldu(this.id)" maxlength="3" tabindex="9">
			</div>

			<div class="col-2" style="width:120px;">
				<label for="il" style="width: 206px" class="form-label">İl<span class="KirmiziYazi">*</span></label>
				<input required="required" type="number" value="<?php echo $Diger_Cek['il'] ?>" class="form-control sinaqmuddetigun" min="0" max="365" id="il" oninput="ReqemInputuDolduruldu(this.id)" title="" onkeydown="javascript: return event.keyCode == 69 ? false : true"  onfocusout="ReqemInputuDolduruldu(this.id)" maxlength="3" tabindex="9">
			</div>

			<div class="col-2">
				<label for="Xidmet_Iline_Daxil_Et	" class="form-label">Xidmət ilinə<span class="KirmiziYazi">*</span></label>
				<select id="Xidmet_Iline_Daxil_Et" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option value="0" <?php echo 0==$Diger_Cek['Xidmet_Iline_Daxil_Et']?'selected="selected"':'';?>>Daxil etmə</option>
					<option value="1" <?php echo 1==$Diger_Cek['Xidmet_Iline_Daxil_Et']?'selected="selected"':'';?>>Daxil et</option>	
				</select>
			</div>	

			<hr>
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