<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Vezifeden_Azad_Etme_Id                     =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']); 

	$Vezifeden_Azad_Sor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where Vezifeden_Azad_Etme_Id=:Vezifeden_Azad_Etme_Id");
	$Vezifeden_Azad_Sor->execute(array(
		'Vezifeden_Azad_Etme_Id'=>$Vezifeden_Azad_Etme_Id));
	$Vezifeden_Azad_Sor_Say=$Vezifeden_Azad_Sor->rowCount();
	if ($Vezifeden_Azad_Sor_Say==1) {
		$Vezifeden_Azad_Cek=$Vezifeden_Azad_Sor->fetch(PDO::FETCH_ASSOC);
		$Vezifeden_Azad_Etme_Emir_No=$Vezifeden_Azad_Cek['Vezifeden_Azad_Etme_Emir_No'];
		$Vezifeden_Azad_Etme_Tarix=$Vezifeden_Azad_Cek['Vezifeden_Azad_Etme_Tarix'];
		$Islediyi_Idare_Id=$Vezifeden_Azad_Cek['Islediyi_Idare_Id'];
		$Islediyi_Sobe_Id=$Vezifeden_Azad_Cek['Islediyi_Sobe_Id'];
		$Vezife_Id=$Vezifeden_Azad_Cek['Vezife_Id'];
		$ID=$Vezifeden_Azad_Cek['ID'];
		$Vezifeye_Teyin_Tarixi=$Vezifeden_Azad_Cek['Vezifeye_Teyin_Tarixi'];

		$sil = $db->prepare("DELETE from vezifeden_azad_edilme where Vezifeden_Azad_Etme_Id=:Vezifeden_Azad_Etme_Id");
		$kontrol = $sil->execute(array(
			'Vezifeden_Azad_Etme_Id'=>$Vezifeden_Azad_Etme_Id
		));	
		if ($kontrol) {
			$Elave_Et=$db->prepare("INSERT INTO vezifeden_azad_edilme_islemleri SET
				Vezifeden_Azad_Etme_Emir_No=:Vezifeden_Azad_Etme_Emir_No, 
				Vezifeden_Azad_Etme_Tarix=:Vezifeden_Azad_Etme_Tarix,
				Sebeb=:Sebeb,
				Islediyi_Idare_Id=:Islediyi_Idare_Id,
				Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
				Vezife_Id=:Vezife_Id,
				ID=:ID,
				Vezifeden_Azad_Etme_Id=:Vezifeden_Azad_Etme_Id,
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
					Vezife_Id=:Vezife_Id,
					Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi
					where ID=$ID
					");
				$yenile=$update->execute(array(
					'Serencam_Durum'=>0,
					'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
					'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,
					'Vezife_Id'=>$Vezife_Id,
					'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Tarixi
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
						echo '<input type="hidden" id="status" value="succes">';
						echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
						echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Yeni əmir uğurla yaradıldı</span>">';
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