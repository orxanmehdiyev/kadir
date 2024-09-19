<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$teltif                         =  ReqemlerXaricButunKarakterleriSil($deyer['Heveslendirem_Tedbirleri_Ad_Id']); 
	$Hevesledirme_Tedbirleri_Tarix  =  date("Y-m-d",strtotime($deyer['Hevesledirme_Tedbirleri_Tarix']));
	if ($teltif==1 || $teltif==2 || $teltif==3 || $teltif==8 ) {
		?>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12">
			<label for="ID"  class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
			<select id="ID" required="required" class="select2 form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
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
							$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id and Ise_Qebul_Tarixi<:Ise_Qebul_Tarixi and Serencam_Durum=:Serencam_Durum");
							$User_Sor->execute(array(
								'Durum'=>1,
								'Islediyi_Idare_Id'=>$Idare_Id,
								'Islediyi_Sobe_Id'=>$Sobe_Id,
								'Vezife_Id'=>$Vezife_Id,
								'Ise_Qebul_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Serencam_Durum'=>0
							));
							$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
							$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
							$ID=$User_Cek['ID'];
							$Itizamsor=$db->prepare("SELECT intizam_tenbehi.*,intizam_tenbehi_adlari.* FROM  intizam_tenbehi
								INNER JOIN intizam_tenbehi_adlari ON intizam_tenbehi.Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=intizam_tenbehi_adlari.intizam_tenbehi_adlari_id 
								where ID=:ID and intizam_tenbehi_adlari_nezere_alam=:intizam_tenbehi_adlari_nezere_alam and Intizam_Tenbehinin_Bitis_Tarixi>=:Intizam_Tenbehinin_Bitis_Tarixi and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");
							$Itizamsor->execute(array(
								'ID'=>$User_Cek['ID'],
								'intizam_tenbehi_adlari_nezere_alam'=>0,
								'Intizam_Tenbehinin_Bitis_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Hevesledirme_Tedbirleri_Tarix
							));
							$ItizamSay=$Itizamsor->rowCount();
							if (!$ItizamSay==1) {
								echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";												
							}else{}							
						}
					}
				}
				?>
			</select>
		</div>
		<div class="col-12 text-center mt-3">
			<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>
		<?php 
	
	} elseif($teltif==4){

		?>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12">
			<label for="ID" class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
			<select id="ID" required="required" class="select2 form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
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
							$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id and Ise_Qebul_Tarixi<:Ise_Qebul_Tarixi and Serencam_Durum=:Serencam_Durum");
							$User_Sor->execute(array(
								'Durum'=>1,
								'Islediyi_Idare_Id'=>$Idare_Id,
								'Islediyi_Sobe_Id'=>$Sobe_Id,
								'Vezife_Id'=>$Vezife_Id,
								'Ise_Qebul_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Serencam_Durum'=>0
							));
							$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
							$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
							$ID=$User_Cek['ID'];
							$Itizamsor=$db->prepare("SELECT intizam_tenbehi.*,intizam_tenbehi_adlari.* FROM  intizam_tenbehi
								INNER JOIN intizam_tenbehi_adlari ON intizam_tenbehi.Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=intizam_tenbehi_adlari.intizam_tenbehi_adlari_id 
								where ID=:ID and intizam_tenbehi_adlari_nezere_alam=:intizam_tenbehi_adlari_nezere_alam and Intizam_Tenbehinin_Bitis_Tarixi>=:Intizam_Tenbehinin_Bitis_Tarixi and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");
							$Itizamsor->execute(array(
								'ID'=>$User_Cek['ID'],
								'intizam_tenbehi_adlari_nezere_alam'=>0,
								'Intizam_Tenbehinin_Bitis_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Hevesledirme_Tedbirleri_Tarix
							));
							$ItizamSay=$Itizamsor->rowCount();
							if (!$ItizamSay>0) {
								$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC ");
								$Rutbe_Emri_Sor->execute(array(
									'ID'=>$ID));
								$Rutbe_Emri_Say=$Rutbe_Emri_Sor->rowCount();
								if ($Rutbe_Emri_Say>0) {
									$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
									$Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];
									$Rutbe_Emri_Tarixi=$Rutbe_Emri_Cek['Rutbe_Emri_Tarixi'];

									$Rutbe_Vaxdindan_Evvel_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID and Rutbe_Emri_Novu=:Rutbe_Emri_Novu");
									$Rutbe_Vaxdindan_Evvel_Sor->execute(array(
										'ID'=>$ID,
										'Rutbe_Emri_Novu'=>3
									));
									$Rutbe_Vaxdindan_Evvel_Verilmesi=$Rutbe_Vaxdindan_Evvel_Sor->rowCount();
									if ($Rutbe_Vaxdindan_Evvel_Verilmesi<2) {
										$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
										$Rutbe_Sor->execute(array(
											'Rutbe_Id'=>$Rutbe_Id));
										$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
										$Rutbe_Xidmet_Ili=$Rutbe_Cek['Rutbe_Xidmet_Ili'];
										$Novbeti_Rutbe_Sira_No=$Rutbe_Cek['Rutbe_Sira_No']+1;

										$ay=$Rutbe_Xidmet_Ili * 12;
										$XidmetiliYarisi=$ay/2;	
										$uzerineAyGel="month";
										$Vaxtindan_Evvel_Tarixi=Traix_Uzerine_Gel($Rutbe_Emri_Tarixi,$XidmetiliYarisi,$uzerineAyGel);
										$Rutbe_Vaxdi=Traix_Uzerine_Gel($Rutbe_Emri_Tarixi,$ay,$uzerineAyGel);

										$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id ");
										$Vezife_Sor->execute(array(
											'User_Id'=>$ID));
										$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);					
										$AlaBileceyiRutbe=$Vezife_Cek['AlaBileceyiRutbe'];

										$Ala_Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
										$Ala_Rutbe_Sor->execute(array(
											'Rutbe_Id'=>$AlaBileceyiRutbe));
										$Ala_Rutbe_Cek=$Ala_Rutbe_Sor->fetch(PDO::FETCH_ASSOC);

										$Maksimal_Rutbe_Sira_No=$Ala_Rutbe_Cek['Rutbe_Sira_No'];

										if ($Vaxtindan_Evvel_Tarixi<=$Hevesledirme_Tedbirleri_Tarix and $Rutbe_Vaxdi>$Hevesledirme_Tedbirleri_Tarix) {
											if ($Novbeti_Rutbe_Sira_No<=$Maksimal_Rutbe_Sira_No) {
												echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
											}else{}
										}else{}										
									}else{}									
								}else{}								
							}else{}							
						}
					}
				}
				?>
			</select>
		</div>
		<div class="col-12 text-center mt-3">
			<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>
		<?php 

	}elseif($teltif==5) {
		?>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12">
			<label for="ID"  class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
			<select id="ID" required="required" class="select2 form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
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
							$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id and Ise_Qebul_Tarixi<:Ise_Qebul_Tarixi and Serencam_Durum=:Serencam_Durum");
							$User_Sor->execute(array(
								'Durum'=>1,
								'Islediyi_Idare_Id'=>$Idare_Id,
								'Islediyi_Sobe_Id'=>$Sobe_Id,
								'Vezife_Id'=>$Vezife_Id,
								'Ise_Qebul_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Serencam_Durum'=>0));
							$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
							$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
							$ID=$User_Cek['ID'];
							$Itizamsor=$db->prepare("SELECT intizam_tenbehi.*,intizam_tenbehi_adlari.* FROM  intizam_tenbehi
								INNER JOIN intizam_tenbehi_adlari ON intizam_tenbehi.Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=intizam_tenbehi_adlari.intizam_tenbehi_adlari_id 
								where ID=:ID and intizam_tenbehi_adlari_nezere_alam=:intizam_tenbehi_adlari_nezere_alam and Intizam_Tenbehinin_Bitis_Tarixi>=:Intizam_Tenbehinin_Bitis_Tarixi and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");
							$Itizamsor->execute(array(
								'ID'=>$User_Cek['ID'],
								'intizam_tenbehi_adlari_nezere_alam'=>0,
								'Intizam_Tenbehinin_Bitis_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Hevesledirme_Tedbirleri_Tarix
							));
							$ItizamSay=$Itizamsor->rowCount();
							if (!$ItizamSay>0) {
								$Heveslendirme_Sor=$db->prepare("SELECT * FROM hevesledirme_tedbirleri where ID=:ID and Heveslendirem_Tedbirleri_Ad_Id=:Heveslendirem_Tedbirleri_Ad_Id order by Sira_No ASC ");
								$Heveslendirme_Sor->execute(array(
									'ID'=>$ID,
									'Heveslendirem_Tedbirleri_Ad_Id'=>5));
								$Heveslendirme_Say=$Heveslendirme_Sor->rowCount();
								if (!$Heveslendirme_Say>0) {
									echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
								}else{}								
							}else{}							
						}
					}
				}
				?>
			</select>
		</div>
		<div class="col-12 text-center mt-3">
			<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>
		<?php 
	}elseif($teltif==6){

		?>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12">
			<label for="ID"  class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
			<select id="ID" required="required" class="select2 form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
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
							$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id and Ise_Qebul_Tarixi<:Ise_Qebul_Tarixi and Serencam_Durum=:Serencam_Durum");
							$User_Sor->execute(array(
								'Durum'=>1,
								'Islediyi_Idare_Id'=>$Idare_Id,
								'Islediyi_Sobe_Id'=>$Sobe_Id,
								'Vezife_Id'=>$Vezife_Id,
								'Ise_Qebul_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Serencam_Durum'=>0));
							$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
							$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
							$ID=$User_Cek['ID'];
							$Itizamsor=$db->prepare("SELECT intizam_tenbehi.*,intizam_tenbehi_adlari.* FROM  intizam_tenbehi
								INNER JOIN intizam_tenbehi_adlari ON intizam_tenbehi.Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=intizam_tenbehi_adlari.intizam_tenbehi_adlari_id 
								where ID=:ID and intizam_tenbehi_adlari_nezere_alam=:intizam_tenbehi_adlari_nezere_alam and Intizam_Tenbehinin_Bitis_Tarixi>=:Intizam_Tenbehinin_Bitis_Tarixi and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");
							$Itizamsor->execute(array(
								'ID'=>$User_Cek['ID'],
								'intizam_tenbehi_adlari_nezere_alam'=>0,
								'Intizam_Tenbehinin_Bitis_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Hevesledirme_Tedbirleri_Tarix
							));
							$ItizamSay=$Itizamsor->rowCount();
							if (!$ItizamSay>0) {
								$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC ");
								$Rutbe_Emri_Sor->execute(array(
									'ID'=>$ID));
								$Rutbe_Emri_Say=$Rutbe_Emri_Sor->rowCount();
								if ($Rutbe_Emri_Say>0) {
									$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
									$Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];
									$Rutbe_Emri_Tarixi=$Rutbe_Emri_Cek['Rutbe_Emri_Tarixi'];

									$Rutbe_Vaxdindan_Evvel_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID and Rutbe_Emri_Novu=:Rutbe_Emri_Novu");
									$Rutbe_Vaxdindan_Evvel_Sor->execute(array(
										'ID'=>$ID,
										'Rutbe_Emri_Novu'=>4
									));
									$Rutbe_Vaxdindan_Evvel_Verilmesi=$Rutbe_Vaxdindan_Evvel_Sor->rowCount();
									if ($Rutbe_Vaxdindan_Evvel_Verilmesi<2) {
										$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
										$Rutbe_Sor->execute(array(
											'Rutbe_Id'=>$Rutbe_Id));
										$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
										$Rutbe_Xidmet_Ili=$Rutbe_Cek['Rutbe_Xidmet_Ili'];
										$Novbeti_Rutbe_Sira_No=$Rutbe_Cek['Rutbe_Sira_No'];

										$ay=$Rutbe_Xidmet_Ili * 12;									
										$uzerineAyGel="month";					
										$Rutbe_Vaxdi=Traix_Uzerine_Gel($Rutbe_Emri_Tarixi,$ay,$uzerineAyGel);

										$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id ");
										$Vezife_Sor->execute(array(
											'User_Id'=>$ID));
										$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);					
										$AlaBileceyiRutbe=$Vezife_Cek['AlaBileceyiRutbe'];

										$Ala_Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
										$Ala_Rutbe_Sor->execute(array(
											'Rutbe_Id'=>$AlaBileceyiRutbe));
										$Ala_Rutbe_Cek=$Ala_Rutbe_Sor->fetch(PDO::FETCH_ASSOC);

										$Maksimal_Rutbe_Sira_No=$Ala_Rutbe_Cek['Rutbe_Sira_No'];

										if ($Rutbe_Vaxdi<=$Hevesledirme_Tedbirleri_Tarix) {
											if ($Novbeti_Rutbe_Sira_No==$Maksimal_Rutbe_Sira_No) {
												echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
											}else{}
										}else{}										
									}else{}									
								}else{}								
							}else{}							
						}
					}
				}
				?>
			</select>
		</div>
		<div class="col-12 text-center mt-3">
			<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>
		<?php 

	}elseif($teltif==7){?>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12">
			<label for="ID"  class="form-label">Vəzifəli şəxsin adı<span class="KirmiziYazi">*</span></label>
			<select id="ID" required="required" class="select2 form-select" onchange="SelectIkiAlaniSecildi(this.id)" title="">
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
							$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id and Ise_Qebul_Tarixi<:Ise_Qebul_Tarixi and Serencam_Durum=:Serencam_Durum");
							$User_Sor->execute(array(
								'Durum'=>1,
								'Islediyi_Idare_Id'=>$Idare_Id,
								'Islediyi_Sobe_Id'=>$Sobe_Id,
								'Vezife_Id'=>$Vezife_Id,
								'Ise_Qebul_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Serencam_Durum'=>0));
							$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
							$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
							$ID=$User_Cek['ID'];
							$Itizamsor=$db->prepare("SELECT intizam_tenbehi.*,intizam_tenbehi_adlari.* FROM  intizam_tenbehi
								INNER JOIN intizam_tenbehi_adlari ON intizam_tenbehi.Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=intizam_tenbehi_adlari.intizam_tenbehi_adlari_id 
								where ID=:ID and intizam_tenbehi_adlari_nezere_alam=:intizam_tenbehi_adlari_nezere_alam and Intizam_Tenbehinin_Bitis_Tarixi>=:Intizam_Tenbehinin_Bitis_Tarixi and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");
							$Itizamsor->execute(array(
								'ID'=>$User_Cek['ID'],
								'intizam_tenbehi_adlari_nezere_alam'=>0,
								'Intizam_Tenbehinin_Bitis_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,
								'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Hevesledirme_Tedbirleri_Tarix
							));
							$ItizamSay=$Itizamsor->rowCount();
							if ($ItizamSay==1) {
								echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";												
							}else{}							
						}
					}
				}
				?>
			</select>
		</div>
		<div class="col-12 text-center mt-3">
			<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>
		<?php 
	}	
} ?>