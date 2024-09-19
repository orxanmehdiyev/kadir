<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['yeni'])) {?>
	<div class="row">						
		<form class="row p-2 ">		
			<div class="col-3">
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

			
			<div class="col-3">
				<label for="Mezuniyyet_Novleri_ID	" class="form-label">Məzuniyyət növü<span class="KirmiziYazi">*</span></label>
				<select id="Mezuniyyet_Novleri_ID" required="required" class="form-select" onchange="MelumatTelebEt(this.id)" title="">
					<option disabled="disabled" value="" selected="selected" tabindex="7"></option>
					<?php 
					$Mezuniyyet_Sor=$db->prepare("SELECT * FROM  mezuniyyet_novleri where Mezuniyyet_Novleri_Durum=:Mezuniyyet_Novleri_Durum order by Mezuniyyet_Novleri_Sira ASC ");
					$Mezuniyyet_Sor->execute(array(
						'Mezuniyyet_Novleri_Durum'=>1));
						while ($Mezuniyyet_Cek=$Mezuniyyet_Sor->fetch(PDO::FETCH_ASSOC)) {						?>
							<option value="<?php echo $Mezuniyyet_Cek['Mezuniyyet_Novleri_ID'] ?>"><?php echo $Mezuniyyet_Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></option>
						<?php } ?>					
					</select>
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


				<div class="row" id="mezuniyyeticerik">
					
				</div>

				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>	
			</form>	
		</div>
		<?php } ?>