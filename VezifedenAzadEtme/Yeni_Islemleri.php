<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                                         =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Vezifeden_Azad_Etme_Emir_No                =  EditorluIcerikleriFiltrle($deyer['Vezifeden_Azad_Etme_Emir_No']); 
	$Tarixi                                     =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Vezifeden_Azad_Etme_Tarix']); 
	$Vezifeden_Azad_Etme_Tarix                  =  TarixBeynelxalqCevir($Tarixi);

	$TarixAzcevir                  =  TarixAzCevir($deyer['Vezifeden_Azad_Etme_Tarix']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Islediyi_Idare_Id=$User_Cek['Islediyi_Idare_Id'];
	$Islediyi_Sobe_Id=$User_Cek['Islediyi_Sobe_Id'];
	$Vezifeye_Teyin_Tarixi=$User_Cek['Vezifeye_Teyin_Tarixi'];
	$Vezife_Id=$User_Cek['Vezife_Id'];
	$Soy_Adi=$User_Cek['Soy_Adi'];
	$Adi=$User_Cek['Adi'];
	$Ata_Adi=$User_Cek['Ata_Adi'];
	$bos="";

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Vezifeden_Azad_Etme_Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Emir_No">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($TarixAzcevir!=$Tarixi){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarixi düzgün qeyd edilməyib">';
		exit;
	}/*elseif($Vezifeden_Azad_Etme_Tarix<$Tarix_Beynelxalq){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarix faktiki tarixdən kiçik ola bilməz">';
		exit;
	}*/else{
		$Elave_Et=$db->prepare("INSERT INTO vezifeden_azad_edilme SET
			Ata_Adi=:Ata_Adi, 
			Soy_Adi=:Soy_Adi, 
			Adi=:Adi, 
			Vezifeden_Azad_Etme_Emir_No=:Vezifeden_Azad_Etme_Emir_No, 
			Vezifeden_Azad_Etme_Tarix=:Vezifeden_Azad_Etme_Tarix,
			Sebeb=:Sebeb,
			Islediyi_Idare_Id=:Islediyi_Idare_Id,
			Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
			Vezife_Id=:Vezife_Id,
			Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi,
			ID=:ID
			");
		$Insert=$Elave_Et->execute(array(
			'Ata_Adi'=>$Ata_Adi,
			'Soy_Adi'=>$Soy_Adi,
			'Adi'=>$Adi,
			'Vezifeden_Azad_Etme_Emir_No'=>$Vezifeden_Azad_Etme_Emir_No,
			'Vezifeden_Azad_Etme_Tarix'=>$Vezifeden_Azad_Etme_Tarix,
			'Sebeb'=>1,
			'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
			'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,
			'Vezife_Id'=>$Vezife_Id,
			'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Tarixi,
			'ID'=>$ID							
		));
		if ($Insert) {
			$Vezifeden_Azad_Etme_Id=$db->lastInsertId();
			$Elave_Et=$db->prepare("INSERT INTO vezifeden_azad_edilme_islemleri SET
				Vezifeden_Azad_Etme_Emir_No=:Vezifeden_Azad_Etme_Emir_No, 
				Vezifeden_Azad_Etme_Tarix=:Vezifeden_Azad_Etme_Tarix,
				Sebeb=:Sebeb,
				Islediyi_Idare_Id=:Islediyi_Idare_Id,
				Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
				Vezife_Id=:Vezife_Id,
				ID=:ID,
				Vezifeden_Azad_Etme_Id=:Vezifeden_Azad_Etme_Id,
				Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi,
				ZamanDamgasi=:ZamanDamgasi,
				TarixSaat=:TarixSaat,
				IPAdresi=:IPAdresi,
				Admin_Id=:Admin_Id
				");
			$Insert=$Elave_Et->execute(array(
				'Vezifeden_Azad_Etme_Emir_No'=>$Vezifeden_Azad_Etme_Emir_No,
				'Vezifeden_Azad_Etme_Tarix'=>$Vezifeden_Azad_Etme_Tarix,
				'Sebeb'=>1,
				'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
				'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,
				'Vezife_Id'=>$Vezife_Id,
				'ID'=>$ID,							
				'Vezifeden_Azad_Etme_Id'=>$Vezifeden_Azad_Etme_Id,							
				'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Tarixi,							
				'ZamanDamgasi'=>$ZamanDamgasi,							
				'TarixSaat'=>$TarixSaat,							
				'IPAdresi'=>$IPAdresi,							
				'Admin_Id'=>$Admin_Id							
			));
			if ($Insert) {
				$update=$db->prepare("UPDATE user SET
					Serencam_Durum=:Serencam_Durum,
					Islediyi_Idare_Id=:Islediyi_Idare_Id,
					Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
					Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi,
					Vezife_Id=:Vezife_Id,
					Serencam_Tarix=:Serencam_Tarix,
					Serencam_Sebeb=:Serencam_Sebeb,
					Serencam_Emir=:Serencam_Emir
					where ID=$ID
					");
				$yenile=$update->execute(array(
					'Serencam_Durum'=>1,
					'Islediyi_Idare_Id'=>$bos,
					'Islediyi_Sobe_Id'=>$bos,
					'Vezifeye_Teyin_Tarixi'=>$bos,
					'Vezife_Id'=>$bos,
					'Serencam_Tarix'=>$Vezifeden_Azad_Etme_Tarix,
					'Serencam_Sebeb'=>0,
					'Serencam_Emir'=>$Vezifeden_Azad_Etme_Emir_No

				));
				if ($yenile) {
					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id
						where User_Id=$ID
						");
					$yenile=$update->execute(array(
						'User_Id'=>$bos
					));
					$Islediyi_Vezife_Sor=$db->prepare("SELECT * FROM user_islediyi_vezife  order by Vezifeye_Teyin_Tarixi DESC");
					$Islediyi_Vezife_Sor->execute();
					$Islediyi_Vezife_Cek=$Islediyi_Vezife_Sor->fetch(PDO::FETCH_ASSOC);
					$User_Islediyi_Vezife_Id=$Islediyi_Vezife_Cek['User_Islediyi_Vezife_Id'];

					$update=$db->prepare("UPDATE user_islediyi_vezife SET
						Vezifeden_Azad_Olunma_Tarixi=:Vezifeden_Azad_Olunma_Tarixi
						where User_Islediyi_Vezife_Id=$User_Islediyi_Vezife_Id
						");
					$yenile=$update->execute(array(
						'Vezifeden_Azad_Olunma_Tarixi'=>$Vezifeden_Azad_Etme_Tarix
					));

					if ($yenile) {					
						echo '<input type="hidden" id="status" value="succes">';
						echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
						echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Yeni əmir uğurla yaradıldı</span>">';
						$Sor=$db->prepare("SELECT * FROM vezifeden_azad_edilme  order by Vezifeden_Azad_Etme_Tarix DESC");
						$Sor->execute();
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
													$NovbetiSor=$db->prepare("SELECT * FROM user where ID=:ID");
													$NovbetiSor->execute(array(
														'ID'=>$Cek['ID']));
													$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
													?>																									
													<td class="emeliyyatlar_sil_buttom">
														<?php									
														if ($Cek['Vezifeden_Azad_Etme_Tarix'] > $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
															echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
														}?>
													</td>
												</tr>	
											<?php }	?>
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
													$NovbetiSor=$db->prepare("SELECT * FROM user where ID=:ID");
													$NovbetiSor->execute(array(
														'ID'=>$Cek['ID']));
													$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
													?>																									
													<td class="emeliyyatlar_sil_buttom">
														<?php									
														if ($Cek['Vezifeden_Azad_Etme_Tarix'] > $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
															echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
														}?>
													</td>
												</tr>	
											<?php }	?>
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
												$NovbetiSor=$db->prepare("SELECT * FROM user where ID=:ID");
												$NovbetiSor->execute(array(
													'ID'=>$Cek['ID']));
												$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
												?>																									
												<td class="emeliyyatlar_sil_buttom">
													<?php									
													if ($Cek['Vezifeden_Azad_Etme_Tarix'] > $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
														echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
													}?>
												</td>
											</tr>	
										<?php }	?>
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
											$NovbetiSor=$db->prepare("SELECT * FROM user where ID=:ID");
											$NovbetiSor->execute(array(
												'ID'=>$Cek['ID']));
											$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
											?>																									
											<td class="emeliyyatlar_sil_buttom">
												<?php									
												if ($Cek['Vezifeden_Azad_Etme_Tarix'] > $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
													echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
												}?>
											</td>
										</tr>	
									<?php }	?>
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