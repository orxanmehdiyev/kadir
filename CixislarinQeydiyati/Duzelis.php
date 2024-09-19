<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Intizam_Tenbehi_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM   intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
	$Sor->execute(array(
		'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id));
	$Ceks=$Sor->fetch(PDO::FETCH_ASSOC)
	?>
	<div class="row">						
		<form class="row g-3 p-2 ">	
		<input type="hidden" id="Intizam_Tenbehi_Id" value="<?php echo $Intizam_Tenbehi_Id ?>">	
			<div class="col-6">
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
			<div class="col-6">
				<label for="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id	" class="form-label">İtizam Tənbehinin növü<span class="KirmiziYazi">*</span></label>
				<select id="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
					<?php 
					$Sor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari where intizam_tenbehi_adlari_durum=:intizam_tenbehi_adlari_durum order by intizam_tenbehi_adlari_Sira_No ASC ");
					$Sor->execute(array(
						'intizam_tenbehi_adlari_durum'=>1));
						while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {						?>
							<option <?php echo $Ceks['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id']==$Cek['intizam_tenbehi_adlari_id']?"selected":"" ?> value="<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>"><?php echo $Cek['intizam_tenbehi_adlari_ad'] ?></option>
						<?php } ?>					
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
					<input type="text" class="form-control" id="Idare_Ad" value="<?php echo $User_Ceks['Idare_Ad'] ?>" readonly  title="">
				</div>

				<div class="col-4">
					<label for=""  class="form-label">Şöbə/Bölmə<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Sobe_Ad" value="<?php echo $User_Ceks['Sobe_Ad'] ?>"  readonly title="">
				</div>

				<div class="col-2">
					<label for="" class="form-label">Vəzifə<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Vezife_Ad" value="<?php echo $User_Ceks['Vezife_Ad'] ?>" readonly title="">
				</div>

				<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
					<label for="Intizam_Tenbehi_Emrinin_Nomresi" class="form-label">Əmrin Nömrəsi<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control" id="Intizam_Tenbehi_Emrinin_Nomresi" oninput="IntizamTenbehiSebebAlaniYazildi(this.id)" onfocusout="IntizamTenbehiSebebAlaniYazildi(this.id)" value="<?php echo $Ceks['Intizam_Tenbehi_Emrinin_Nomresi'] ?>"  required="required" maxlength="20" tabindex="4" title="">
				</div>

				<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
					<label for="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix" class="form-label">Tədbiq Edildiyi tarix<span class="KirmiziYazi">*</span></label>
					<input type="text" class="form-control pickmeup_1 tarix" id="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  value="<?php echo Tarix_Beynelxalqi_Az_Cevir($Ceks['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']) ?>" required="required" maxlength="10" tabindex="4" title="">
				</div>		
				<div class="form-group col-12">
					<label for="Intizam_Tenbehi_Sebeb" class="form-label">Səbəb<span class="KirmiziYazi">*</span></label>				
					<textarea id="Intizam_Tenbehi_Sebeb" class="form-control" style="height: 70px;" maxlength ="255" rows="10" cols="50" oninput="IntizamTenbehiSebebAlaniYazildi(this.id)" onfocusout="IntizamTenbehiSebebAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"><?php echo trim($Ceks['Intizam_Tenbehi_Sebeb']) ?></textarea>
				</div>
				<div class="col-12 text-center mt-3">
					<button type="button" onclick="DuzelisIntizamTenbehiFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>	
				<div class="col-6">
					<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
				</div>	
			</form>	
		</div>
		<?php } ?>