<?php require_once '_header.php';
$personal=$db->prepare("SELECT * FROM user where ID=:ID and Seo_Url=:Seo_Url");
$personal->execute(array(
	'ID'=>$_GET['ID'],
	'Seo_Url'=>$_GET['sef']));
$say=$personal->rowCount();
if ($say==1) {	
	$personal_cek=$personal->fetch(PDO::FETCH_ASSOC);
	$personal_rutbe_sekil=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC limit 1");
	$personal_rutbe_sekil->execute(array(
		'ID'=>$_GET['ID']));
	$personal_rutbe_sekil_cek=$personal_rutbe_sekil->fetch(PDO::FETCH_ASSOC);
	if (strlen($personal_rutbe_sekil_cek['Rutbe_Img'])>0) {
		$Personal_Sekli=$personal_rutbe_sekil_cek['Rutbe_Img'];
	}else{
		$Personal_Sekli="Senedler/Rutbe/nophoto.png";
	}
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
				<img src="<?php echo $Personal_Sekli ?>" class="img-fluid">
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
				<div class="row g-3">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="inputsexs" class="form-label">Təşkilat</label>
						<input type="text" class="form-control" disabled value="">
					</div>	
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<label for="inputsexs" class="form-label">Gömrük Orqanı</label>
						<input type="text" class="form-control" disabled  value="<?php echo $personal_cek['Idare_Ad'] ?>">
					</div>	
					<div class="col-7">
						<label for="inputsexs" class="form-label">Struktur bölmə</label>
						<input type="text" class="form-control" disabled value="<?php echo $personal_cek['Sobe_Ad'] ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Vəzifəsi</label>
						<input type="text" class="form-control" disabled  value="<?php echo $personal_cek['Vezife_Ad'] ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Təyin olunduğu tarix</label>
						<input type="text" class="form-control"   value="<?php echo TarixAzCevir($personal_cek['Ise_Qebul_Tarixi']) ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Şəxsi işinin nömrəsi</label>
						<input type="text" class="form-control"  disabled value="<?php echo  sprintf("%03d", SexsiIsNomresi($_GET['ID'],$db)) ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">SSN</label>
						<input type="text" class="form-control"  disabled value="<?php echo $personal_cek['SSN_Nomresi'] ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">ID</label>
						<input type="text" class="form-control" id="ID" disabled value="<?php echo $personal_cek['ID'] ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">İşə qəbul tarixi</label>
						<input type="text" class="form-control" disabled value="<?php echo TarixAzCevir($personal_cek['Ise_Qebul_Tarixi']) ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Xidmətə Qəbul tarixi</label>
						<input type="text" class="form-control"  disabled value="<?php echo TarixAzCevir($personal_cek['Ise_Qebul_Tarixi']) ?>">
					</div>
					<hr>
					<div class="col-4">
						<?php 	
						$RutmeEmriSor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
						$RutmeEmriSor->execute(array(
							'ID'=>$_GET['ID']));
						$RutmeEmriCek=$RutmeEmriSor->fetch(PDO::FETCH_ASSOC);
						?>
						<label for="inputsexs" class="form-label">Rütbəsi</label>
						<input type="text" class="form-control"  disabled value="<?php echo $RutmeEmriCek['Rutbe_Adi'] ?>">
					</div>
					<div class="col-3">
						<label for="inputsexs" class="form-label">Son rütbənin verilmə tarixi</label>
						<input type="text" class="form-control"  disabled value="<?php echo TarixAzCevir($RutmeEmriCek['Rutbe_Emri_Tarixi']) ?>">
					</div>
					<?php
					$RutmeAdiSor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id ");
					$RutmeAdiSor->execute(array(
						'Rutbe_Id'=>$RutmeEmriCek['Rutbe_Id']));
					$RutmeAdiCek=$RutmeAdiSor->fetch(PDO::FETCH_ASSOC);
					$Rutbe_Xidmet_Ili=$RutmeAdiCek['Rutbe_Xidmet_Ili'];
					if ($Rutbe_Xidmet_Ili!=0) {
						$novbetitarix=Traix_Uzerine_Gel($RutmeEmriCek['Rutbe_Emri_Tarixi'],$Rutbe_Xidmet_Ili," year");
					}

					if ($RutmeAdiCek['Rutbe_Xidmet_Ili']!=0){?>
						<div class="col-3">
							<label for="inputsexs" class="form-label">Növbəti rütbənin tarixi</label>
							<input type="text" class="form-control" disabled  value="<?php echo TarixAzCevir($novbetitarix); ?>">
						</div>
					<?php } ?>




				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-12">
				<div class="row">	
					<div class="col-2">
						<label for="inputsexs" class="form-label">Soyadı</label>
						<input type="text" class="form-control" id="Soy_Adi" disabled value="<?php echo $personal_cek['Soy_Adi'] ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Adı</label>
						<input type="text" class="form-control" id="Adi"  disabled value="<?php echo $personal_cek['Adi'] ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Ata Adı</label>
						<input type="text" class="form-control" id="Ata_Adi" disabled value="<?php echo $personal_cek['Ata_Adi'] ?>">
					</div>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Doğum tarixi</label>
						<input type="text" class="form-control" disabled value="<?php echo TarixAzCevir($personal_cek['Dogum_Tarixi']) ?>">
					</div>
					<?php 
					$Dogum_Tarixi      =  $personal_cek['Dogum_Tarixi'];
					$bugun = date("Y-m-d", $ZamanDamgasi);
					$diff = date_diff(date_create($Dogum_Tarixi), date_create($bugun));
					$yasin=$diff->format('%y');
					?>
					<div class="col-1">
						<label for="inputsexs" class="form-label">Yaşı</label>
						<input type="text" class="form-control"  disabled value="<?php echo $yasin ?>">
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-12">
				<div class="row">	
					<div class="col-1">
						<label for="inputsexs" class="form-label">FİN</label>
						<input type="text" class="form-control"  disabled value="<?php echo $personal_cek['FIN_Kod'] ?>">
					</div>
					<div class="col-1">
						<label for="inputsexs" class="form-label">Cinsiyyəti</label>
						<input type="text" class="form-control" id="Cinsiyeti" disabled value="<?php echo $personal_cek['Cinsiyeti']==0?"Kişi":"Qadın" ?>">
					</div>
					<?php 
					if ($personal_cek['aile_veziyyeti']==1) {
						$aile_veziyyeti="Subay";
					}elseif($personal_cek['aile_veziyyeti']==2){
						$aile_veziyyeti="Evli";
					}elseif($personal_cek['aile_veziyyeti']==3){
						$aile_veziyyeti="Boşanıb";
					}elseif($personal_cek['aile_veziyyeti']==4){
						$aile_veziyyeti="Dul";
					}else{
						$aile_veziyyeti="";
					}
					?>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Ailə vəziyyəti</label>
						<input type="text" class="form-control" disabled value="<?php echo $aile_veziyyeti; ?>">
					</div>
					<?php 		
					$Usaq_Sor=$db->prepare("SELECT * FROM user_usaq where ID=:ID order by Dogum_Tarixi_Beynel ASC ");
					$Usaq_Sor->execute(array(
						'ID'=>$_GET['ID']));
					$Usaq_Say=$Usaq_Sor->rowCount();

					?>
					<div class="col-2">
						<label for="inputsexs" class="form-label">Uşaqlarının sayı</label>
						<input type="text" class="form-control" id="personusaqsayi"  disabled value="<?php echo $Usaq_Say;?>">
					</div>
					<div class="col-3">
						<label for="inputsexs" class="form-label">Doğulduğu yer</label>
						<input type="text" class="form-control"   disabled value="<?php echo $personal_cek['Doguldugu_Unvan'] ?>">
					</div>
					<div class="col-3">
						<label for="inputsexs" class="form-label">Ünvanı</label>
						<input type="text" class="form-control"  disabled value="<?php echo $personal_cek['Yasayis_Unvan'] ?>">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="row g-3"> 
					<div class="col-12 text-end">
						<button type="submit" class="btn btn-secondary">Düzəliş et</button>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">			
			<div class="col-md-12 col-lg-12 col-xl-6" id="etraflitehsilid">	
				<?php 
				$Tehsil_Sor=$db->prepare("SELECT * FROM  user_tehsil where ID=:ID ");
				$Tehsil_Sor->execute(array(
					'ID'=>$_GET['ID']));
					?>
					<table class="ListelemeAlaniIciTablosu caption-top">
						<caption><b>Təhsili</b><button class="YenileButonlari sag" onclick="YeniTehsil()" type="button">Yeni</button></caption>
						<thead>
							<tr>
								<th>№</th>
								<th>Təhsil Səviyyəsi</th>
								<th>Bitirdiyi Təhsil Müəsisəsi</th>
								<th>İxtisası</th>
								<th>Sənədləri</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$tehsilsirano=0;
							while ($Tehsil_Cek=$Tehsil_Sor->fetch(PDO::FETCH_ASSOC)) {
								$tehsilsirano++;
								if($Tehsil_Cek['Tehsil']==1){
									$Tehsil="İbtidai";
								}elseif($Tehsil_Cek['Tehsil']==2){
									$Tehsil="Ümumi Orta";
								}elseif($Tehsil_Cek['Tehsil']==3){
									$Tehsil="Tam Orta";
								}elseif($Tehsil_Cek['Tehsil']==4){
									$Tehsil="İlk Peşə";
								}elseif($Tehsil_Cek['Tehsil']==5){
									$Tehsil="Texniki Peşə";
								}elseif($Tehsil_Cek['Tehsil']==6){
									$Tehsil="Yüksək Texniki Peşə";
								}elseif($Tehsil_Cek['Tehsil']==7){
									$Tehsil="Orta ixtisas";
								}elseif($Tehsil_Cek['Tehsil']==8){
									$Tehsil="Bakalavriat";
								}elseif($Tehsil_Cek['Tehsil']==9){
									$Tehsil="Magistratura (Rezidentura)";
								}elseif($Tehsil_Cek['Tehsil']==10){
									$Tehsil="Doktorantura (Adyunktura)";
								}else{
									$Tehsil="";
								}
								?>
								<tr>
									<td><?php echo $tehsilsirano ?></td>
									<td><?php echo $Tehsil ?></td>
									<td><?php echo $Tehsil_Cek['Tehsil_Aldigi_Muesise'] ?></td>
									<td><?php echo $Tehsil_Cek['Ixtisas'] ?></td>
									<td class="textaligncenter" id="senedler_<?php echo $Tehsil_Cek['User_Tehsil_Id']?>">
										<?php if (strlen($Tehsil_Cek['Tehsil_Senedi_IMG'])>0) {?>
											<a style="color: #0d6efd;" href="<?php echo $Tehsil_Cek['Tehsil_Senedi_IMG'] ?>" target="blank">Sənədi</a><span style="color:red; margin-left: 5px; cursor: pointer;" onclick="TehsilSenedSil(this.id)" id="TehsilSenedSil_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">x</span>
										<?php }else{?>
											<form  method="post" enctype="multipart/form-data" id="tehsilform_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">
												<input type="hidden" name="tehsilsenediyukle">
												<input type="hidden" name="User_Tehsil_Id" value="<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">												
												<label class="fileuploadgizliinputlabel" for="file_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>" id="label_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">Browse...</label>
												<input type="file" class="fileuploadgizliinput" name="file" id="file_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>"  onchange="TehsilSenediYukle(this.form)">
												<button class="YenileButonlari" type="submit" id="button_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>" style="display: none;">Yüklə</button>
											</form>
										<?php } ?>
									</td>
									<td class="emeliyyatlar_iki_buttom">										
										<button class="YenileButonlari" id="Siltehsil_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>" onclick="TehsilSil(this.id)" type="button">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<hr >
				</div>



				<div class="col-md-12 col-lg-12 col-xl-6" id="etraflitutduguvezife">	
					<?php 
					$Tutdugu_Vezife_Sor=$db->prepare("SELECT * FROM  user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi DESC");
					$Tutdugu_Vezife_Sor->execute(array(
						'ID'=>$_GET['ID']));
						?>
						<table class="ListelemeAlaniIciTablosu caption-top" >
							<caption><b>Tutduğu vəzifələr </b>	<button class="YenileButonlari sag" onclick="YeniTutduguVezife()" type="button">Yeni</button></caption>
							<thead>
								<tr>
									<th  class="textaligncenter">№</th>
									<th>İdarə</th>
									<th>Şöbə/Bölmə</th>
									<th>Vəzifə</th>
									<th>Təyin</th>
									<th>Azad olma</th>
									<th>Səbəb</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$tutduguvezifasira=0;
								while($Tutdugu_Vezife_Cek=$Tutdugu_Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
									$tutduguvezifasira++;
									if ($Tutdugu_Vezife_Cek['Vezifeden_Azad_Olunma_Tarixi']>0) {
										$Vezifeden_Azad_Olunma_Tarixi=Tarix_Beynelxalqi_Az_Cevir($Tutdugu_Vezife_Cek['Vezifeden_Azad_Olunma_Tarixi']);
									}else{
										$Vezifeden_Azad_Olunma_Tarixi="";
									}
									?>
									<tr>
										<td  class="textaligncenter"><?php echo $tutduguvezifasira; ?></td>
										<td><?php echo $Tutdugu_Vezife_Cek['Idare_Ad'] ?></td>
										<td><?php echo $Tutdugu_Vezife_Cek['Sobe_Ad'] ?></td>
										<td><?php echo $Tutdugu_Vezife_Cek['Vezife_Ad'] ?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Tutdugu_Vezife_Cek['Vezifeye_Teyin_Tarixi'])?></td>
										<td><?php echo $Vezifeden_Azad_Olunma_Tarixi ?></td>
										<td><?php echo $Tutdugu_Vezife_Cek['Sebeb'] ?></td>
										<td class="emeliyyatlar_iki_buttom">
											<button class="YenileButonlari" id="TutduguVezifeDuzenle_<?php echo $Tutdugu_Vezife_Cek['User_Islediyi_Vezife_Id'] ?>" onclick="TutduguVezifeDuzenle(this.id)" type="button">
												<i class="fas fa-edit"></i>
											</button>		
											<button class="YenileButonlari" id="TutduguVezifeSil_<?php echo $Tutdugu_Vezife_Cek['User_Islediyi_Vezife_Id'] ?>" onclick="TutduguVezifeSil(this.id)" type="button">
												<i class="fas fa-trash"></i>
											</button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<hr>
					</div>





					<div class="col-md-12 col-lg-12 col-xl-6" id="tedbiqolunmusheveslendirme">	
						<?php 
						$Heveslendirme_Tedbiri_Sor=$db->prepare("SELECT * FROM  hevesledirme_tedbirleri where ID=:ID");
						$Heveslendirme_Tedbiri_Sor->execute(array(
							'ID'=>$_GET['ID']
						));
						?>
						<table class="ListelemeAlaniIciTablosu caption-top" >
							<caption><b>Tədbiq olunmuş həvəsləndirmə tədbirləri</b><button class="YenileButonlari sag" onclick="YeniHeveslendirmeTedbirleri()" type="button">Yeni</button></caption>
							<thead>
								<tr>
									<th class="textaligncenter">№</th>
									<th>Növü</th>
									<th>Səbəb</th>
									<th>Tarix</th>										
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$Hevslendirmesira=0;
								while($Heveslendirme_Tedbiri_Cek=$Heveslendirme_Tedbiri_Sor->fetch(PDO::FETCH_ASSOC)) {
									$Hevslendirmesira++;?>
									<tr>
										<td  class="textaligncenter"><?php echo $Hevslendirmesira; ?></td>
										<td><?php echo $Heveslendirme_Tedbiri_Cek['Heveslendirem_Tedbirleri_Ad'] ?></td>
										<td><?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Sebeb'] ?></td>							
										<td data-sort="<?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Tarix'] ?>"><?php echo TarixAzCevir($Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Tarix']) ?></td>										
										<td class="emeliyyatlar_iki_buttom">
											<button class="YenileButonlari" id="TutduguVezifeDuzenle_<?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Id'] ?>" onclick="HeveslendirmeTedbiriDuzenle(this.id)" type="button">
												<i class="fas fa-edit"></i>
											</button>		
											<button class="YenileButonlari" id="TutduguVezifeSil_<?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Id'] ?>" onclick="HeveslendirmeTedbiriSil(this.id)" type="button">
												<i class="fas fa-trash"></i>
											</button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<hr>
					</div>
					<div class="col-md-12 col-lg-12 col-xl-6" id="etraflitedbiqolunmusintizam">	
						<?php 
						$Intizam_Sor=$db->prepare("SELECT * FROM  intizam_tenbehi where ID=:ID  order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
						$Intizam_Sor->execute(array(
							'ID'=>$_GET['ID']));
							?>
							<table class="ListelemeAlaniIciTablosu caption-top">
								<caption><b>Tədbiq olunmuş intizam tədbirləri </b>	<button class="YenileButonlari sag" onclick="YeniIntizamTenbehi()" type="button">Yeni</button></caption>
								<thead>
									<tr>
										<th class="textaligncenter">№</th>
										<th>İntizam tənbehlərinin növü</th>
										<th>Səbəb və qeydlər</th>
										<th>Başlanğıc tarixi</th>
										<th>Bitiş tarixi</th>
										<th>Əmrin №</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$IntizamTenbehiSira=0;
									while($Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC)) {
										$IntizamTenbehiSira++;?>
										<tr>
											<td  class="textaligncenter"><?php echo $IntizamTenbehiSira;?></td>
											<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
											<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Sebeb'] ?></td>
											<td data-sort="<?php echo $Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'] ?>"><?php echo TarixAzCevir($Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']) ?></td>										
											<td data-sort="<?php echo $Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'] ?>"><?php echo TarixAzCevir($Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi']) ?></td>										
											<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>										
											<td class="emeliyyatlar_iki_buttom">
												<button class="YenileButonlari" id="IntizamTedbiriDuzenle_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriDuzenle(this.id)" type="button">
													<i class="fas fa-edit"></i>
												</button>		
												<button class="YenileButonlari" id="IntizamTedbiriSil_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriSil(this.id)" type="button">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<hr>
						</div>							
						<div class="col-md-12 col-lg-12 col-xl-6" id="etrafli_rutbe_melumati">	
							<?php 
							$Rutbe_Sor=$db->prepare("SELECT * FROM  rutbe_emri where ID=:ID  order by Rutbe_Emri_Tarixi ASC");
							$Rutbe_Sor->execute(array(
								'ID'=>$_GET['ID']));
								?>
								<table class="ListelemeAlaniIciTablosu caption-top">
									<caption><b>Aldığı Rütbələr </b>	<button class="YenileButonlari sag" onclick="YeniEtrafliRutbe()" type="button">Yeni</button></caption>
									<thead>
										<tr>
											<th class="textaligncenter">№</th>
											<th>Şəkil</th>
											<th>Adı</th>
											<th>Səbəb</th>
											<th>Tarixi</th>												
											<th>Əmrin №</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$RutbeSira=0;
										while($Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC)) {
											$RutbeSira++;
											if ($Rutbe_Cek['Rutbe_Emri_Novu']==1) {
												$Rutbe_Emri_Novu="İlkin xüsusi rütbənin verilməsi";
											}	elseif ($Rutbe_Cek['Rutbe_Emri_Novu']==2) {
												$Rutbe_Emri_Novu="Növbəti xüsusi rütbənin verilməsi";
											}	elseif ($Rutbe_Cek['Rutbe_Emri_Novu']==3) {
												$Rutbe_Emri_Novu="Vaxdından əvvəl xüsusi rütbənin verilməsi";
											}elseif ($Rutbe_Cek['Rutbe_Emri_Novu']==4) {
												$Rutbe_Emri_Novu="Bir pillə yuxarı xüsusi rütbənin verilməsi";
											}

											if (strlen($Rutbe_Cek['Rutbe_Img'])>0) {
												$RutbeSekli=$Rutbe_Cek['Rutbe_Img'];
											}else{
												$RutbeSekli="Senedler/Rutbe/nophoto.png";
											}
											?>
											<tr>
												<td  class="textaligncenter"><?php echo $RutbeSira;?></td>
												<td style="width: 60px; cursor: pointer; margin: 0;padding: 0;">
													<label style="cursor: pointer;" for="Rutbesekli_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>"><img id="rutbeimage_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>" src="<?php echo $RutbeSekli ?>" style="width: 60px;height: 76px;cursor: pointer;"></label>														
													<form  method="post" enctype="multipart/form-data" id="RutbesekilFormu_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>">
														<input type="hidden" name="RutbeSekliYukle">
														<input type="hidden" name="Rutbe_Emri_Id" value="<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>">
														<input type="file" class="fileuploadgizliinput" name="file" id="Rutbesekli_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>"  onchange="YeniRutbeSekliYukle(this.form)">															
													</form>
												</td>
												<td><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></td>
												<td><?php echo $Rutbe_Emri_Novu ?></td>
												<td><?php echo TarixAzCevir($Rutbe_Cek['Rutbe_Emri_Tarixi']) ?></td>
												<td><?php echo $Rutbe_Cek['Rutbe_Emrinin_No'] ?></td>										
												<td class="emeliyyatlar_iki_buttom">
													<button class="YenileButonlari" id="RutbeDuzenle_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>" onclick="RutbeDuzenle(this.id)" type="button">
														<i class="fas fa-edit"></i>
													</button>		
													<button class="YenileButonlari" id="RutbeSil_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>" onclick="RutbeSil(this.id)" type="button">
														<i class="fas fa-trash"></i>
													</button>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
								<hr>
							</div>
							<div class="col-md-12 col-lg-12 col-xl-6" id="etraflitezamiyye">	
								<?php 
								$Ezamiyye_Sor=$db->prepare("SELECT * FROM  ezamiyye_emri where ID=:ID and Ezam_Emri_Durum=:Ezam_Emri_Durum order by Ezam_Baslangic_Tarixi_Unix ASC");
								$Ezamiyye_Sor->execute(array(
									'ID'=>$_GET['ID'],
									'Ezam_Emri_Durum'=>1));
									?>
									<table class="ListelemeAlaniIciTablosu caption-top">
										<caption><b>Ezamiyyələr </b>	<button class="YenileButonlari sag" onclick="YeniEzamiyye()" type="button">Yeni</button></caption>
										<thead>
											<tr>
												<th class="textaligncenter">№</th>
												<th>Ezam olunduğu yer</th>
												<th>Səbəb və qeydlər</th>
												<th>Başlanğıc tarixi</th>
												<th>Bitiş tarixi</th>
												<th>Gün</th>
												<th>Əmrin №</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$EzamiyyeSira=0;
											while($Ezamiyye_Cek=$Ezamiyye_Sor->fetch(PDO::FETCH_ASSOC)) {
												$EzamiyyeSira++;?>
												<tr>
													<td  class="textaligncenter"><?php echo $EzamiyyeSira;?></td>
													<td><?php echo $Ezamiyye_Cek['Ezam_Olundugu_Yer'] ?></td>
													<td><?php echo $Ezamiyye_Cek['Ezam_Sebebi'] ?></td>
													<td><?php echo $Ezamiyye_Cek['Ezam_Baslangic_Tarixi'] ?></td>										
													<td><?php echo $Ezamiyye_Cek['Ezam_Bitis_Tarixi'] ?></td>										
													<td class="textaligncenter"><?php echo $Ezamiyye_Cek['Ezam_Gun_Sayi'] ?></td>										
													<td><?php echo $Ezamiyye_Cek['Ezam_Emri_No'] ?></td>										
													<td class="emeliyyatlar_iki_buttom">
														<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Ezamiyye_Cek['Ezamiyye_Emri_Id'] ?>" onclick="EzamiyyeDuzenle(this.id)" type="button">
															<i class="fas fa-edit"></i>
														</button>		
														<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Ezamiyye_Cek['Ezamiyye_Emri_Id'] ?>" onclick="EzamiyyeSil(this.id)" type="button">
															<i class="fas fa-trash"></i>
														</button>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>										
									<hr>
								</div>
								<div class="col-md-12 col-lg-12 col-xl-6" id="etrafliattestasiya">	
									<?php 
									$Attestasiya_Sor=$db->prepare("SELECT * FROM  attestasiya_emri where ID=:ID and Attestasiya_Durum=:Attestasiya_Durum order by Attestasiya_Tarix_Unix ASC");
									$Attestasiya_Sor->execute(array(
										'ID'=>$_GET['ID'],
										'Attestasiya_Durum'=>1));
										?>
										<table class="ListelemeAlaniIciTablosu caption-top">
											<caption><b>Attestasiyaları </b>	<button class="YenileButonlari sag" onclick="YeniAttestasiya()" type="button">Yeni</button></caption>
											<thead>
												<tr>
													<th class="textaligncenter">№</th>
													<th>İdarə Adı</th>
													<th>Şöbə</th>
													<th>Vəzifə</th>
													<th>Son Tarix</th>													
													<th>Növbəti Tarix</th>													
													<th>Əmrin №</th>
													<th>Qərar</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$AttestasiyaSira=0;
												while($Attestasiya_Cek=$Attestasiya_Sor->fetch(PDO::FETCH_ASSOC)) {
													$AttestasiyaSira++;?>
													<tr>
														<td  class="textaligncenter"><?php echo $AttestasiyaSira;?></td>
														<td><?php echo $Attestasiya_Cek['Attestasiya_Idare_Adi'] ?></td>
														<td><?php echo $Attestasiya_Cek['Attestasiya_Sobe_Adi'] ?></td>
														<td><?php echo $Attestasiya_Cek['Attestasiya_Vezife_Adi'] ?></td>										
														<td><?php echo $Attestasiya_Cek['Attestasiya_Tarix'] ?></td>
														<td><?php echo $Attestasiya_Cek['Attestasiya_Tarix_Novbeti'] ?></td>
														<td><?php echo $Attestasiya_Cek['Attestasiya_Emr_No'] ?></td>										
														<td><?php echo $Attestasiya_Cek['Attestasiya_Qerar']==1?"Uyğundur":"Uyğun deyil" ?></td>										
														<td class="emeliyyatlar_iki_buttom">
															<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Attestasiya_Cek['Attestasiya_Id'] ?>" onclick="AttestasiyaDuzenle(this.id)" type="button">
																<i class="fas fa-edit"></i>
															</button>		
															<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Attestasiya_Cek['Attestasiya_Id'] ?>" onclick="AttestasiyaSil(this.id)" type="button">
																<i class="fas fa-trash"></i>
															</button>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
										<hr>
									</div>
									<div class="col-md-12 col-lg-12 col-xl-6" id="eraflixaricidil">	
										<?php 
										$Xarici_Dil_Sor=$db->prepare("SELECT * FROM  xarici_dil where ID=:ID order by Xarici_Dil_Ad ASC ");
										$Xarici_Dil_Sor->execute(array(
											'ID'=>$_GET['ID']));
											?>
											<table class="ListelemeAlaniIciTablosu caption-top">
												<caption><b>Bildiyi xarici dillər </b>	<button class="YenileButonlari sag" onclick="YeniXariciDil()" type="button">Yeni</button></caption>
												<thead>
													<tr>
														<th class="textaligncenter">№</th>
														<th>Adı</th>
														<th>Bilik səvyyəsi</th>															
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$XariciDilSira=0;
													while($Xarici_Dil_Cek=$Xarici_Dil_Sor->fetch(PDO::FETCH_ASSOC)) {
														$XariciDilSira++;
														if ($Xarici_Dil_Cek['Xarici_Dil_Sevye']==1) {
															$Xarici_Dil_Sevye="Kafi";
														}
														else if ($Xarici_Dil_Cek['Xarici_Dil_Sevye']==2) {
															$Xarici_Dil_Sevye="Yaxşı";
														}
														else if ($Xarici_Dil_Cek['Xarici_Dil_Sevye']==3) {
															$Xarici_Dil_Sevye="Əla";
														}else{
															$Xarici_Dil_Sevye="";
														}

														?>
														<tr>
															<td  class="textaligncenter"><?php echo $XariciDilSira;?></td>
															<td><?php echo $Xarici_Dil_Cek['Xarici_Dil_Ad'] ?></td>
															<td><?php echo $Xarici_Dil_Sevye ?></td>																									
															<td class="emeliyyatlar_iki_buttom">
																<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Xarici_Dil_Cek['Xarici_Dil_Id'] ?>" onclick="XariciDilDuzenle(this.id)" type="button">
																	<i class="fas fa-edit"></i>
																</button>		
																<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Xarici_Dil_Cek['Xarici_Dil_Id'] ?>" onclick="XariciDilSil(this.id)" type="button">
																	<i class="fas fa-trash"></i>
																</button>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>		
											<hr>
										</div>											
										<div class="col-md-12 col-lg-12 col-xl-6" id="eraflibankhesabno">	
											<?php 
											$Bank_Hesab_Sor=$db->prepare("SELECT * FROM  bank_hesab_nomrsei where ID=:ID order by Bank_Hesab_Nomresi_Bank_Adi ASC ");
											$Bank_Hesab_Sor->execute(array(
												'ID'=>$_GET['ID']));
												?>
												<table class="ListelemeAlaniIciTablosu caption-top">
													<caption><b>Bank hesab nömrəsi</b>	<button class="YenileButonlari sag" onclick="YeniBankHesabi()" type="button">Yeni</button></caption>
													<thead>
														<tr>
															<th class="textaligncenter">№</th>
															<th>Bankın adı</th>
															<th>Hesab nömrəsi</th>															
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php 
														$BankHesabSira=0;
														while($Bank_Hesab_Cek=$Bank_Hesab_Sor->fetch(PDO::FETCH_ASSOC)) {
															$BankHesabSira++;
															?>
															<tr>
																<td  class="textaligncenter"><?php echo $BankHesabSira;?></td>
																<td><?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi_Bank_Adi'] ?></td>
																<td><?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi'] ?></td>																									
																<td class="emeliyyatlar_iki_buttom">
																	<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi_Id'] ?>" onclick="BankHesabiDuzenle(this.id)" type="button">
																		<i class="fas fa-edit"></i>
																	</button>		
																	<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi_Id'] ?>" onclick="BankHesabiSil(this.id)" type="button">
																		<i class="fas fa-trash"></i>
																	</button>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
												<hr>
											</div>		

											<div class="col-md-12 col-lg-12 col-xl-6" id="etrafliusaqlari">												
												<table class="ListelemeAlaniIciTablosu caption-top">
													<caption><b>Uşaqları</b>	<button class="YenileButonlari sag" onclick="YeniUsaq()" type="button">Yeni</button></caption>
													<thead>
														<tr>
															<th class="textaligncenter">№</th>
															<th>Soyadı Adı Ata adı</th>
															<th>Doğum tarixi</th>															
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php 
														$UsaqSira=0;
														while($Usaq_Cek=$Usaq_Sor->fetch(PDO::FETCH_ASSOC)) {
															$UsaqSira++;
															?>
															<tr>
																<td  class="textaligncenter"><?php echo $UsaqSira;?></td>
																<td><?php echo $Usaq_Cek['Soyadi']." ".$Usaq_Cek['Adi']." ".$Usaq_Cek['Ataadi'] ?></td>
																<td><?php echo $Usaq_Cek['Dogum_Tarixi'] ?></td>																									
																<td class="emeliyyatlar_iki_buttom">
																	<button class="YenileButonlari" id="UsaqDuzenle_<?php echo $Usaq_Cek['User_Usaq_Id'] ?>" onclick="UsaqDuzenle(this.id)" type="button">
																		<i class="fas fa-edit"></i>
																	</button>		
																	<button class="YenileButonlari" id="UsaqSil_<?php echo $Usaq_Cek['User_Usaq_Id'] ?>" onclick="UsaqSil(this.id)" type="button">
																		<i class="fas fa-trash"></i>
																	</button>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
												<hr>
											</div>				
											<div class="col-md-12 col-lg-12 col-xl-12" id="etraflimezuniyyet">	
												<?php 
												$Mezuniyyet_Sor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi DESC ");
												$Mezuniyyet_Sor->execute(array(
													'ID'=>$_GET['ID']));
													?>
													<span><caption><b>Məzuniyyətləri</b>	<button class="YenileButonlari sag" onclick="YeniMezuniyyet()" type="button">Yeni</button></caption></span>
													<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTablemezuniyyet">
														<thead class="">
															<tr>
																<th>Məzuniyyətin növü</th>																	
																<th class="tarixsutunu">Xidmət ili</th>
																<th class="tarixsutunu">Xidmət ili</th>

																<th class="textaligncenter">Gün</th>
																<th>Başlanğıc Tarixi</th>
																<th class="textaligncenter">Bitiş Tarixi</th>
																<th>İşə çıxma Tarixi</th>
																<th>Əmrin nömrəsi</th>
																<th class="textaligncenter">Əməliyyatlar</th>																							
															</tr>
														</thead>
														<tbody id="list" class="table_ici">
															<?php while ($Mezuniyyet_Cek=$Mezuniyyet_Sor->fetch(PDO::FETCH_ASSOC)) { ?>
																<tr>		
																	<td><?php echo $Mezuniyyet_Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>															
																	<td data-sort="<?php echo$Mezuniyyet_Cek['Xidmet_Ili_Baslagic'] ?>" class="tarixsutunu"><?php	if ($Mezuniyyet_Cek['Xidmet_Ili_Baslagic']>0) {
																		echo Tarix_Beynelxalqi_Az_Cevir($Mezuniyyet_Cek['Xidmet_Ili_Baslagic']);
																	}
																?></td>
																<td data-sort="<?php echo$Mezuniyyet_Cek['Xidmet_Ili_Son'] ?>" class="tarixsutunu"><?php 
																if ($Mezuniyyet_Cek['Xidmet_Ili_Son']>0) {
																	echo Tarix_Beynelxalqi_Az_Cevir($Mezuniyyet_Cek['Xidmet_Ili_Son']);
																}
															?></td>

															<td class="textaligncenter"><?php echo $Mezuniyyet_Cek['Mezuniyyet_Gun'] ?></td>
															<td data-sort="<?php echo$Mezuniyyet_Cek['Baslagic_Tarixi'] ?>"><?php echo Tarix_Beynelxalqi_Az_Cevir($Mezuniyyet_Cek['Baslagic_Tarixi']) ?></td>
															<td data-sort="<?php echo$Mezuniyyet_Cek['Bitis_Tarixi'] ?>" class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Mezuniyyet_Cek['Bitis_Tarixi']) ?></td>
															<td data-sort="<?php echo$Mezuniyyet_Cek['Ise_Cixma_Tarixi'] ?>"><?php echo Tarix_Beynelxalqi_Az_Cevir($Mezuniyyet_Cek['Ise_Cixma_Tarixi']) ?></td>
															<td><?php echo $Mezuniyyet_Cek['Mezuniyyet_Emrinin_Nomresi'] ?></td>										
															<td class="emeliyyatlar_iki_buttom">
																<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Mezuniyyet_Cek['Mezuniyyet_Id'] ?>" onclick="MezuniyyetDuzenle(this.id)" type="button">
																	<i class="fas fa-edit"></i>
																</button>		
																<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Mezuniyyet_Cek['Mezuniyyet_Id'] ?>" onclick="MezuniyyetSil(this.id)" type="button">
																	<i class="fas fa-trash"></i>
																</button>
															</td>
														</tr>	
													<?php } ?>
												</tbody>
											</table>
											<hr>
										</div>











										<div class="col-md-12 col-lg-12 col-xl-12">	

											<table class="ListelemeAlaniIciTablosu caption-top" id="etraflimelumatsexsiucot">

												<caption><b>Şəxsi uçot vərəqi</b> 	<button class="YenileButonlari sag" onclick="Yeni()" type="button">Yeni</button></caption>

												<thead>

													<tr>

														<th>İl</th>

														<th>Aylar</th>						

														<th>Vəzifə pulu</th>

														<th>Hesab<br/>lanmış</th>

														<th>Rütbə</th>

														<th>Staj</th>

														<th>Məzu<br/>niyyət</th>

														<th>Vəzifə Fərq</th>

														<th>Rütbə fərq</th>

														<th>Staj fərq</th>						

														<th>Əvəzcilik</th>

														<th>Mükafat</th>

														<th>Ezamiyyə</th>

														<th>Müavinət</th>

														<th>Maddi yardım</th>

														<th>60% əlavə</th>

														<th>Ərzaq payı</th>

														<th>Cəmi əmək haqqı</th>

														<th>İşsi<br/>zlik<br/>dən sığorta</th>

														<th>Həmk<br/>arlar</th>

														<th>Gəlir vergisi</th>

														<th>İçbari tibbi slğorta</th>

														<th>3% D.S.M.F</th>

														<th>Cəmi tutqu</th>

														<th>Əmək haqqı catası</th>





													</tr>

												</thead>

												<tbody>

													<tr>					

														<td>2021</td>

														<td>Yanvar</td>

														<td>525.00</td>

														<td>525.00</td>

														<td>150.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

														<td>171.00</td>

													</tr>

												</tbody>

											</table>

										</div>















									</div>













								<?php }else{

									header("Location:index.php");

									exit;

								} 

								require_once '_footer.php';?>

								<script type="text/javascript" src="EtrafliMelumat/Script.js"></script>	

								<script type="text/javascript">

									function MezuniyyetCagir(icerik){
										var dataTables = $('#'+icerik).DataTable({
											"bFilter" : false,               
											"bLengthChange": true,
											"lengthMenu": [[10,20,30,40,50,60,70,80,90, -1], [10,20,30,40,50,60,70,80,90, "Hamısı"]],
											"pageLength":10,
   													"order": [], //Initial no order.
   													"aaSorting": [],
    												"searching": false,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    												"lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    												"info": true,
    												"bAutoWidth": false,
    												"responsive": true,
    												'processing': true,
    												"fixedHeader": true,   
    												buttons: [ ],
    												pagingType: 'numbers',
    												dom: '<"float-left"B><"float-right"f>rt<"row"<"col-6"l><"d-none"i><"col-sm-6"p>>',
    											});
									}
									MezuniyyetCagir("dataTablemezuniyyet");

									function	datatablecagir(id){	

										var dataTasbles = $('#'+id).DataTable({

											"bFilter" : false,               

											"bLengthChange": true,

											"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Hamısı"]],

											"pageLength": 10,

    "order": [], //Initial no order.

    "aaSorting": [],

    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false

    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false

    "info": true,

    "bAutoWidth": false,

    "responsive": true,

    'processing': true, 

    dom:

    "<'ui grid'"+

    "<'row'"+

    "<'col-12 col-sm-3'l>"+

    "<'col-12 col-sm-4'B>"+

    "<'col-12 col-sm-5'f>"+

    ">"+

    "<'row dt-table'"+

    "<'sixteen wide column'tr>"+

    ">"+

    "<'row'"+

    "<'seven wide column'i>"+

    "<'right aligned nine wide column'p>"+

    ">"+

    ">",





    buttons: [

    

    {extend: 'excel', title: 'ExampleFile'},

    {	extend: 'print',

    customize: function ( win ) {

    	$(win.document.body)

    	.css( 'font-size', '10pt' )

    	$(win.document.body).find( 'table' )

    	.addClass( 'compact' )

    	.css( 'font-size', 'inherit' );

    }, title: 'Şəxsi heyyət haqqında məlumat',

    exportOptions: {

    	columns: ':visible',

    	stripHtml: false,

    }

  }

  ],

});

									}





								datatablecagir("etraflimelumatsexsiucot");</script>