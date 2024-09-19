<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                            =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Tarixi                        =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Vezifeye_Teyin_Etme_Tarixi']); 
	$Vezifeye_Teyin_Etme_Emir_No   =  EditorluIcerikleriFiltrle($deyer['Vezifeye_Teyin_Etme_Emir_No']); 
	$Islediyi_Idare                =  ReqemlerXaricButunKarakterleriSil($deyer['Islediyi_Idare']); 
	$Islediyi_Sobe                 =  ReqemlerXaricButunKarakterleriSil($deyer['Islediyi_Sobe']); 
	$Vezife_Id                     =  ReqemlerXaricButunKarakterleriSil($deyer['Vezife_Id']); 
	$User_Is_Novu                  =  ReqemlerXaricButunKarakterleriSil($deyer['User_Is_Novu']); 
	$Vezifeye_Teyin_Etme_Tarixi    =  TarixBeynelxalqCevir($Tarixi);

	$TarixAzcevir                  =  TarixAzCevir($deyer['Vezifeye_Teyin_Etme_Tarixi']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum and Serencam_Durum=:Serencam_Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1,
		'Serencam_Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Faktiki_Idare_adi=$User_Cek['Idare_Ad'];
	$Faktiki_Sobe_adi=$User_Cek['Sobe_Ad'];
	$Faktiki_Vezife_adi=$User_Cek['Vezife_Ad'];
	$Faktiki_Is_Novu=$User_Cek['Is_Novu'];
	$Faktiki_Vezifeye_Teyin_Tarixi=$User_Cek['Vezifeye_Teyin_Tarixi'];
	$Soy_Adi=$User_Cek['Soy_Adi'];
	$Adi=$User_Cek['Adi'];
	$Ata_Adi=$User_Cek['Ata_Adi'];

	$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
	$Idare_Sor->execute(array(
		'Idare_Id'=>$Islediyi_Idare));
	$Idare_Say=$Idare_Sor->rowCount();
	$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
	$Idare_Adi=$Idare_Cek['Idare_Adi'];

	$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id");
	$Sobe_Sor->execute(array(
		'Sobe_Id'=>$Islediyi_Sobe));
	$Sobe_Say=$Sobe_Sor->rowCount();
	$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
	$Sobe_Ad=$Sobe_Cek['Sobe_Ad'];

	$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id");
	$Vezife_Sor->execute(array(
		'Vezife_Id'=>$Vezife_Id));
	$Vezife_Say=$Vezife_Sor->rowCount();
	$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];

	$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id");
	$Vezife_Adlari_Sor->execute(array(
		'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
	$Vezife_Adlari_Say=$Vezife_Adlari_Sor->rowCount();
	$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Ad=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Vezifeye_Teyin_Etme_Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeye_Teyin_Etme_Emir_No">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($Idare_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Islediyi_Idare">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($Sobe_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Islediyi_Sobe">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($Vezife_Id==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezife_Id">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($User_Is_Novu==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezife_Id">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($TarixAzcevir!=$Tarixi){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeye_Teyin_Etme_Tarixi">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarixi düzgün qeyd edilməyib">';
		exit;
	}/*elseif($Vezifeye_Teyin_Etme_Tarixi<$Tarix_Beynelxalq){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeye_Teyin_Etme_Tarixi">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarix faktiki tarixdən kiçik ola bilməz">';
		exit;
	}*/else{
		$Elave_Et=$db->prepare("INSERT INTO vezifeye_teyin_etme SET
			Ata_Adi=:Ata_Adi, 
			Adi=:Adi, 
			Soy_Adi=:Soy_Adi, 
			ID=:ID, 
			Vezifeye_Teyin_Etme_Tarixi=:Vezifeye_Teyin_Etme_Tarixi,
			Vezifeye_Teyin_Etme_Emir_No=:Vezifeye_Teyin_Etme_Emir_No,
			Islediyi_Idare=:Islediyi_Idare,
			Islediyi_Sobe=:Islediyi_Sobe,
			Vezife_Id=:Vezife_Id,
			Faktiki_Idare_adi=:Faktiki_Idare_adi,
			Faktiki_Sobe_adi=:Faktiki_Sobe_adi,
			Faktiki_Vezife_adi=:Faktiki_Vezife_adi,
			Faktiki_Vezifeye_Teyin_Tarixi=:Faktiki_Vezifeye_Teyin_Tarixi,
			Faktiki_Is_Novu=:Faktiki_Is_Novu
			");
		$Insert=$Elave_Et->execute(array(
			'Ata_Adi'=>$Ata_Adi,
			'Adi'=>$Adi,
			'Soy_Adi'=>$Soy_Adi,
			'ID'=>$ID,
			'Vezifeye_Teyin_Etme_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi,
			'Vezifeye_Teyin_Etme_Emir_No'=>$Vezifeye_Teyin_Etme_Emir_No,
			'Islediyi_Idare'=>$Islediyi_Idare,
			'Islediyi_Sobe'=>$Islediyi_Sobe,
			'Vezife_Id'=>$Vezife_Id,
			'Faktiki_Idare_adi'=>$Faktiki_Idare_adi,							
			'Faktiki_Sobe_adi'=>$Faktiki_Sobe_adi,							
			'Faktiki_Vezife_adi'=>$Faktiki_Vezife_adi,							
			'Faktiki_Vezifeye_Teyin_Tarixi'=>$Faktiki_Vezifeye_Teyin_Tarixi,							
			'Faktiki_Is_Novu'=>$Faktiki_Is_Novu							
		));
		if ($Insert) {
			$Vezifeye_Teyin_Etme_Id=$db->lastInsertId();
			$Elave_Et=$db->prepare("INSERT INTO vezifeye_teyin_etme_islemleri SET
				Vezifeye_Teyin_Etme_Id=:Vezifeye_Teyin_Etme_Id, 
				ID=:ID, 
				Vezifeye_Teyin_Etme_Tarixi=:Vezifeye_Teyin_Etme_Tarixi,
				Vezifeye_Teyin_Etme_Emir_No=:Vezifeye_Teyin_Etme_Emir_No,
				Islediyi_Idare=:Islediyi_Idare,
				Islediyi_Sobe=:Islediyi_Sobe,
				Vezife_Id=:Vezife_Id,
				Faktiki_Idare_adi=:Faktiki_Idare_adi,
				Faktiki_Sobe_adi=:Faktiki_Sobe_adi,
				Faktiki_Vezife_adi=:Faktiki_Vezife_adi,
				Faktiki_Vezifeye_Teyin_Tarixi=:Faktiki_Vezifeye_Teyin_Tarixi,
				Faktiki_Is_Novu=:Faktiki_Is_Novu,
				ZamanDamgasi=:ZamanDamgasi,
				TarixSaat=:TarixSaat,
				IPAdresi=:IPAdresi,
				Admin_Id=:Admin_Id
				");
			$Insert=$Elave_Et->execute(array(
				'Vezifeye_Teyin_Etme_Id'=>$Vezifeye_Teyin_Etme_Id,
				'ID'=>$ID,
				'Vezifeye_Teyin_Etme_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi,
				'Vezifeye_Teyin_Etme_Emir_No'=>$Vezifeye_Teyin_Etme_Emir_No,
				'Islediyi_Idare'=>$Islediyi_Idare,
				'Islediyi_Sobe'=>$Islediyi_Sobe,
				'Vezife_Id'=>$Vezife_Id,
				'Faktiki_Idare_adi'=>$Faktiki_Idare_adi,							
				'Faktiki_Sobe_adi'=>$Faktiki_Sobe_adi,							
				'Faktiki_Vezife_adi'=>$Faktiki_Vezife_adi,							
				'Faktiki_Vezifeye_Teyin_Tarixi'=>$Faktiki_Vezifeye_Teyin_Tarixi,							
				'Faktiki_Is_Novu'=>$Faktiki_Is_Novu,							
				'ZamanDamgasi'=>$ZamanDamgasi,							
				'TarixSaat'=>$TarixSaat,							
				'IPAdresi'=>$IPAdresi,							
				'Admin_Id'=>$Admin_Id							
			));

			if ($Insert) {
				$update=$db->prepare("UPDATE user SET
					Serencam_Durum=:Serencam_Durum,
					Islediyi_Idare_Id=:Islediyi_Idare_Id,
					Idare_Ad=:Idare_Ad,
					Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
					Sobe_Ad=:Sobe_Ad,
					Sobe_Ad=:Sobe_Ad,
					Vezife_Ad=:Vezife_Ad,
					Vezife_Id=:Vezife_Id,
					Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi
					where ID=$ID
					");
				$yenile=$update->execute(array(
					'Serencam_Durum'=>0,
					'Islediyi_Idare_Id'=>$Islediyi_Idare,
					'Idare_Ad'=>$Idare_Adi,
					'Islediyi_Sobe_Id'=>$Islediyi_Sobe,
					'Sobe_Ad'=>$Sobe_Ad,
					'Vezife_Ad'=>$Vezife_Ad,
					'Vezife_Id'=>$Vezife_Id,
					'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi
				));
				if ($yenile) {
					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id
						where Vezife_Id=$Vezife_Id
						");
					$yenile=$update->execute(array(
						'User_Id'=>$ID
					));
					if ($yenile) {
						$Elave_Et=$db->prepare("INSERT INTO user_islediyi_vezife SET
							ID=:ID,
							Idare_Ad=:Idare_Ad,
							Sobe_Ad=:Sobe_Ad,
							Vezife_Ad=:Vezife_Ad,
							Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi
							");
						$Insert=$Elave_Et->execute(array(
							'ID'=>$ID,
							'Idare_Ad'=>$Idare_Adi,
							'Sobe_Ad'=>$Sobe_Ad,
							'Vezife_Ad'=>$Vezife_Ad,
							'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Etme_Tarixi
						));
					
						echo '<input type="hidden" id="status" value="succes">';
						echo '<input type="hidden" id="statusiki" value="Vezifeye_Teyin_Etme_Tarixi">';
						echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Yeni əmir uğurla yaradıldı</span>">';
						$Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme order by Vezifeye_Teyin_Etme_Tarixi DESC");
						$Sor->execute(array(
							'Durum'=>0));
						$Say=$Sor->rowCount();
						if ($Say>0) {?>
							<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Adı,soyadı</th>
								
									<th>Tarixi</th>
									<th>Əmri No</th>																
									<th>Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>								
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>									
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Vezifeye_Teyin_Etme_Tarixi']) ?></td>
										<td><?php echo $Cek['Vezifeye_Teyin_Etme_Emir_No'] ?></td>
										<?php 
										$NovbetiSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
										$NovbetiSor->execute(array(
											'ID'=>$Cek['ID']));
										$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
										?>																									
										<td class="emeliyyatlar_sil_buttom">
											<?php									
											if ($Cek['Vezifeye_Teyin_Etme_Tarixi'] >= $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
												echo SilButonu($Cek['Vezifeye_Teyin_Etme_Id']);
											}?>
										</td>
									</tr>	
								<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
						<?php }else{	?>
							<div class="row">
								<div class="over-y">
									Bazada vəzifədən azad etmə əmri yoxdur
								</div>
							</div> 
						<?php 	}	

					}else{						
						$sil = $db->prepare("DELETE from intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
						$kontrol = $sil->execute(array(
							'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
						));	
						echo '<input type="hidden" id="status" value="succes">';
						echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
						echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Əməliyyat Uğursuz</span>">';
						$Sor=$db->prepare("SELECT * FROM vezifeden_azad_edilme  order by Vezifeden_Azad_Etme_Tarix DESC");
						$Sor->execute(array(
							'Durum'=>0));
						$Say=$Sor->rowCount();
						if ($Say>0) {?>
							<div class="row">
								<div class="over-y genislik">
									<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
										<thead class="">
											<tr>
												<th>Adı,soyadı</th>
												<th>Səbəb</th>
												<th>Tarixi</th>
												<th>Əmri No</th>																
												<th>Sil</th>																							
											</tr>
										</thead>
										<tbody id="list" class="table_ici">
											<?php 				
											while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
												if ($Cek['Sebeb']==1) {
													$Sebeb="Ştat tədbiri";
												}elseif ($Cek['Sebeb']==2) {
													$Sebeb="İntizam tənbehi";
												}else{
													$Sebeb="";
												}
												?>
												<tr>								
													<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
													<td><?php echo $Sebeb ?></td>
													<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Vezifeden_Azad_Etme_Tarix']) ?></td>
													<td><?php echo $Cek['Vezifeden_Azad_Etme_Emir_No'] ?></td>
													<?php 
													$NovbetiSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID order by Vezifeden_Azad_Etme_Tarix DESC");
													$NovbetiSor->execute(array(
														'ID'=>$Cek['ID']));
													$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
													?>																									
													<td class="emeliyyatlar_sil_buttom">
														<?php
														if($NovbetiCek['Vezifeden_Azad_Etme_Tarix']==$Cek['Vezifeden_Azad_Etme_Tarix']){
															echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
														}else{}
														?>
													</td>
												</tr>	
											<?php }
											?>
										</tbody>
									</table>
								</div>
							</div>
						<?php }else{	?>
							<div class="row">
								<div class="over-y">
									Bazada vəzifədən azad etmə əmri yoxdur
								</div>
							</div> 
						<?php 	}	



					}
				}else{
					$sil = $db->prepare("DELETE from intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
					$kontrol = $sil->execute(array(
						'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
					));	
					echo '<input type="hidden" id="status" value="succes">';
					echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
					echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Əməliyyat Uğursuz</span>">';
					$Sor=$db->prepare("SELECT * FROM vezifeden_azad_edilme  order by Vezifeden_Azad_Etme_Tarix DESC");
					$Sor->execute(array(
						'Durum'=>0));
					$Say=$Sor->rowCount();
					if ($Say>0) {?>
						<div class="row">
							<div class="over-y genislik">
								<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
									<thead class="">
										<tr>
											<th>Adı,soyadı</th>
											<th>Səbəb</th>
											<th>Tarixi</th>
											<th>Əmri No</th>																
											<th>Sil</th>																							
										</tr>
									</thead>
									<tbody id="list" class="table_ici">
										<?php 				
										while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
											if ($Cek['Sebeb']==1) {
												$Sebeb="Ştat tədbiri";
											}elseif ($Cek['Sebeb']==2) {
												$Sebeb="İntizam tənbehi";
											}else{
												$Sebeb="";
											}
											?>
											<tr>								
												<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
												<td><?php echo $Sebeb ?></td>
												<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Vezifeden_Azad_Etme_Tarix']) ?></td>
												<td><?php echo $Cek['Vezifeden_Azad_Etme_Emir_No'] ?></td>
												<?php 
												$NovbetiSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID order by Vezifeden_Azad_Etme_Tarix DESC");
												$NovbetiSor->execute(array(
													'ID'=>$Cek['ID']));
												$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
												?>																									
												<td class="emeliyyatlar_sil_buttom">
													<?php
													if($NovbetiCek['Vezifeden_Azad_Etme_Tarix']==$Cek['Vezifeden_Azad_Etme_Tarix']){
														echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
													}else{}
													?>
												</td>
											</tr>	
										<?php }
										?>
									</tbody>
								</table>
							</div>
						</div>
					<?php }else{	?>
						<div class="row">
							<div class="over-y">
								Bazada vəzifədən azad etmə əmri yoxdur
							</div>
						</div> 
					<?php 	}	


				}


			}else{
				$sil = $db->prepare("DELETE from intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
				$kontrol = $sil->execute(array(
					'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
				));	
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Əməliyyat Uğursuz</span>">';
				$Sor=$db->prepare("SELECT * FROM vezifeden_azad_edilme  order by Vezifeden_Azad_Etme_Tarix DESC");
				$Sor->execute(array(
					'Durum'=>0));
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
								<thead class="">
									<tr>
										<th>Adı,soyadı</th>
										<th>Səbəb</th>
										<th>Tarixi</th>
										<th>Əmri No</th>																
										<th>Sil</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php 				
									while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
										if ($Cek['Sebeb']==1) {
											$Sebeb="Ştat tədbiri";
										}elseif ($Cek['Sebeb']==2) {
											$Sebeb="İntizam tənbehi";
										}else{
											$Sebeb="";
										}
										?>
										<tr>								
											<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
											<td><?php echo $Sebeb ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Vezifeden_Azad_Etme_Tarix']) ?></td>
											<td><?php echo $Cek['Vezifeden_Azad_Etme_Emir_No'] ?></td>
											<?php 
											$NovbetiSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID order by Vezifeden_Azad_Etme_Tarix DESC");
											$NovbetiSor->execute(array(
												'ID'=>$Cek['ID']));
											$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
											?>																									
											<td class="emeliyyatlar_sil_buttom">
												<?php
												if($NovbetiCek['Vezifeden_Azad_Etme_Tarix']==$Cek['Vezifeden_Azad_Etme_Tarix']){
													echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
												}else{}
												?>
											</td>
										</tr>	
									<?php }
									?>
								</tbody>
							</table>
						</div>
					</div>
				<?php }else{	?>
					<div class="row">
						<div class="over-y">
							Bazada vəzifədən azad etmə əmri yoxdur
						</div>
					</div> 
				<?php 	}	

			}
		}else{
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
			echo '<input type="hidden" id="message" value="Sistem idarəcisinə məlumat verin">';
			exit;
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>