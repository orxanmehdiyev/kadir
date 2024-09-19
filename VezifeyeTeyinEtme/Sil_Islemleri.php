<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Vezifeye_Teyin_Etme_Id                            =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']); 
	$Vez_Teyin_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where Vezifeye_Teyin_Etme_Id=:Vezifeye_Teyin_Etme_Id");
	$Vez_Teyin_Sor->execute(array(
		'Vezifeye_Teyin_Etme_Id'=>$Vezifeye_Teyin_Etme_Id));
	$Vez_Teyin_Cek=$Vez_Teyin_Sor->fetch(PDO::FETCH_ASSOC);
	$Vez_Teyin_Say=$Vez_Teyin_Sor->rowCount();
	$ID=$Vez_Teyin_Cek['ID'];
	$Vezifeye_Teyin_Etme_Tarixi=$Vez_Teyin_Cek['Vezifeye_Teyin_Etme_Tarixi'];
	$Vezifeye_Teyin_Etme_Emir_No=$Vez_Teyin_Cek['Vezifeye_Teyin_Etme_Emir_No'];
	$Islediyi_Idare=$Vez_Teyin_Cek['Islediyi_Idare'];
	$Islediyi_Sobe=$Vez_Teyin_Cek['Islediyi_Sobe'];
	$Vezife_Id=$Vez_Teyin_Cek['Vezife_Id'];
	$Faktiki_Idare_adi=$Vez_Teyin_Cek['Faktiki_Idare_adi'];
	$Faktiki_Sobe_adi=$Vez_Teyin_Cek['Faktiki_Sobe_adi'];
	$Faktiki_Vezife_adi=$Vez_Teyin_Cek['Faktiki_Vezife_adi'];
	$Faktiki_Is_Novu=$Vez_Teyin_Cek['Faktiki_Is_Novu'];
	$Faktiki_Vezifeye_Teyin_Tarixi=$Vez_Teyin_Cek['Faktiki_Vezifeye_Teyin_Tarixi'];
	$bos="";

	if ($Vez_Teyin_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}else{
		$sil = $db->prepare("DELETE from vezifeye_teyin_etme where Vezifeye_Teyin_Etme_Id=:Vezifeye_Teyin_Etme_Id");
		$kontrol = $sil->execute(array(
			'Vezifeye_Teyin_Etme_Id'=>$Vezifeye_Teyin_Etme_Id
		));	
		if ($kontrol) {
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
					'Serencam_Durum'=>1,
					'Islediyi_Idare_Id'=>$bos,
					'Idare_Ad'=>$Faktiki_Idare_adi,
					'Islediyi_Sobe_Id'=>$bos,
					'Sobe_Ad'=>$Faktiki_Sobe_adi,
					'Vezife_Ad'=>$Faktiki_Vezife_adi,
					'Vezife_Id'=>$bos,
					'Vezifeye_Teyin_Tarixi'=>$Faktiki_Vezifeye_Teyin_Tarixi
				));
				if ($yenile) {
					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id
						where User_Id=$ID
						");
					$yenile=$update->execute(array(
						'User_Id'=>$bos
					));
					if ($yenile) {

						$Islediyi_Sor=$db->prepare("SELECT * FROM user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi DESC");
						$Islediyi_Sor->execute(array(
							'ID'=>$ID));
						$Islediyi_Cek=$Islediyi_Sor->fetch(PDO::FETCH_ASSOC);
						$User_Islediyi_Vezife_Id=$Islediyi_Cek['User_Islediyi_Vezife_Id'];

						$sil = $db->prepare("DELETE from user_islediyi_vezife where User_Islediyi_Vezife_Id=:User_Islediyi_Vezife_Id");
						$kontrol = $sil->execute(array(
							'User_Islediyi_Vezife_Id'=>$User_Islediyi_Vezife_Id
						));	
						exit;

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