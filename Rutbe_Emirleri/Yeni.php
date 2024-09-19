<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row p-2 ">		
			<div class="col-4">
				<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
				<select id="ID" required="required" class="js-example-placeholder-single form-select" title="" onchange="SelectIkiAlaniSecildi(this.id)">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>	
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
								$ID=$User_Cek['ID'];
								echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
							}
						}
					}
					?>
				</select>
			</div>	

			<div class="col-3 tarixvehesabla">
				<label for="Rutbe_Emri_Tarixi" style="width: 206px" class="form-label ">Xüsusi rütbənin verilmə tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control  left" value="<?php echo $TekTarix   ?>" id="Rutbe_Emri_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength="10" tabindex="4" title="">
				<button type="button" onclick="RutbeHesabla()" class="YenileButonlari right"  tabindex="15" title=""><i class="fas fa-search"></i></button>
			</div>

			<div class="col-5 ">
				<ul id="rutbeverilmemelumati">
					
				</ul>
			</div>
			<hr>

			


			<div class="col-3">
				<label for="Rutbe_Ad" class="form-label"><b>Rütbəsi</b><span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Rutbe_Ad" readonly title="">
			</div>

			<div class="col-3">
				<label for="Son_Aldigi_Rutbenin_Tarixi" class="form-label"><b>Son rütbə verilmə tarixi</b><span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Son_Aldigi_Rutbenin_Tarixi" readonly title="">
			</div>

			<div class="col-2">
				<label for="Rutbe_Emrinin_No" class="form-label">Əmrin nömrəsi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Rutbe_Emrinin_No" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" >
			</div>
			<hr>

			<div class="col-6">
				<label for="Idare_Ad" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Idare_Ad"  readonly  title="">
			</div>

			<div class="col-4">
				<label for="Sobe_Ad" class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control"  id="Sobe_Ad" readonly title="">
			</div>

			<div class="col-2">
				<label for="Vezife_Ad" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
				<input type="tarix" class="form-control" id="Vezife_Ad" readonly title="">
			</div>
			<hr>
			<div class="col-5">
				<label for="Rutbe_Emri_Novu	" class="form-label">Xüsusi rütbənin növü<span class="KirmiziYazi">*</span></label>
				<select id="Rutbe_Emri_Novu" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>				
					<option value="1">İlkin xüsusi rütbənin verilməsi</option>
					<option value="2">Növbəti xüsusi rütbənin verilməsi</option>							
					<option value="3">Vaxdından əvvəl xüsusi rütbənin verilməsi</option>							
					<option value="4">Bir pillə yuxarı xüsusi rütbənin verilməsi</option>							
				</select>
			</div>	

			<div class="col-4">
				<?php 	
				$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Durum=:Rutbe_Durum order by Rutbe_Sira_No ASC ");
				$Rutbe_Sor->execute(array(
					'Rutbe_Durum'=>1)); ?>
				<label for="Rutbe_Id	" class="form-label">Xüsusi rütbənin növü<span class="KirmiziYazi">*</span></label>
				<select id="Rutbe_Id" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>	
					<?php 	while ($Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC)) {	
						if ($Rutbe_Cek['Rutbe_Sira_No']!=24) {
						?>			
						<option value="<?php echo $Rutbe_Cek['Rutbe_Id'] ?>"><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></option>
					<?php } } ?>	
				</select>
			</div>	
			<hr>
			<div class="col-12">
				<label for="Rutbe_Emri_Sebeb" class="form-label">Qeyd<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" id="Rutbe_Emri_Sebeb" oninput="MetinAlaniYazildi(this.id)" title="" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "150" tabindex="10" >
			</div>
			<hr>

			<div class="col-12 text-center mt-3" id="rutbebutonlari">

			</div>	

			<div class="col-6">
				<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
			</div>	
		</form>	
	</div>
	<?php } ?>