<?php 
require_once '../Ayarlar/setting.php';
if ($RutbeAdlariDuzelis==1) {
	if (!isset($_POST['Deyer'])) {
		header("Location:../rutbe_adlari.php");
	}else{
		$deyer =json_decode($_POST['Deyer'],true);
		$Rutbe_Adi=EditorluIcerikleriFiltrle($deyer['Rutbe_Adi']);
		$Rutbe_Pulu=ReqemlernokteVergulXaricButunKarakterleriSil($deyer['Rutbe_Pulu']);
		$Rutbe_Sira_No=ReqemlerXaricButunKarakterleriSil($deyer['Rutbe_Sira_No']);	
		$Rutbe_Id=ReqemlerXaricButunKarakterleriSil($deyer['Rutbe_Id']);
		$Rutbe_Xidmet_Ili=ReqemlerXaricButunKarakterleriSil($deyer['Rutbe_Xidmet_Ili']);
		$Rutbe_Seo_Url=seo($Rutbe_Adi);
		$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
		$Rutbe_Sor->execute(array(
			'Rutbe_Id'=>$Rutbe_Id));
		$Rutbe_Say=$Rutbe_Sor->rowCount();
		if ($Rutbe_Say==1) {
			$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
			$Rutbe_Durum=$Rutbe_Cek['Rutbe_Durum'];
			if ($Rutbe_Adi!="") {
				if ($Rutbe_Pulu!="") {
					if ($Rutbe_Sira_No>0) {
						$SiraNomresi=$db->prepare("SELECT * FROM rutbe where Rutbe_Id<>:Rutbe_Id and Rutbe_Sira_No=:Rutbe_Sira_No");
						$SiraNomresi->execute(array(
							'Rutbe_Id'=>$Rutbe_Id,
							'Rutbe_Sira_No'=>$Rutbe_Sira_No));
						$SiarSay=$SiraNomresi->rowCount();
						if (!$SiarSay>0) {	
							$yenile = $db->prepare("UPDATE rutbe SET     
								Rutbe_Adi         = :Rutbe_Adi,
								Rutbe_Xidmet_Ili  = :Rutbe_Xidmet_Ili,
								Rutbe_Pulu        = :Rutbe_Pulu,
								Rutbe_Sira_No     = :Rutbe_Sira_No,
								Rutbe_Durum       = :Rutbe_Durum,
								TarixSaat         = :TarixSaat,
								Admin_Id          = :Admin_Id,
								Admin_Ad          = :Admin_Ad,
								Admin_Soyad       = :Admin_Soyad,
								Admin_Ataadi      = :Admin_Ataadi,
								Rutbe_Seo_Url     = :Rutbe_Seo_Url
								WHERE Rutbe_Id=$Rutbe_Id");
							$update = $yenile->execute(array(     
								'Rutbe_Adi'=>$Rutbe_Adi,
								'Rutbe_Xidmet_Ili'=>$Rutbe_Xidmet_Ili,
								'Rutbe_Pulu'=>$Rutbe_Pulu,
								'Rutbe_Sira_No'=>$Rutbe_Sira_No,
								'Rutbe_Durum'=>$Rutbe_Durum,
								'TarixSaat'=>$TarixSaat,
								'Admin_Id'=>$Admin_Id,
								'Admin_Ad'=>$Admin_Ad,
								'Admin_Soyad'=>$Admin_Soyad,
								'Admin_Ataadi'=>$Admin_Ataadi,
								'Rutbe_Seo_Url'=>$Rutbe_Seo_Url		
							));
							if ($update) {
								$Elave_Et=$db->prepare("INSERT INTO rutbe_islemleri SET
									Rutbe_Id=:Rutbe_Id,
									Rutbe_Adi=:Rutbe_Adi,
									Rutbe_Xidmet_Ili=:Rutbe_Xidmet_Ili,
									Rutbe_Pulu=:Rutbe_Pulu,
									Rutbe_Sira_No=:Rutbe_Sira_No,
									Rutbe_Durum=:Rutbe_Durum,
									TarixSaat=:TarixSaat,
									Admin_Id=:Admin_Id,
									Admin_Ad=:Admin_Ad,
									Admin_Soyad=:Admin_Soyad,
									Admin_Ataadi=:Admin_Ataadi,
									Islem_Sebebi=:Islem_Sebebi,
									Rutbe_Seo_Url=:Rutbe_Seo_Url
									");
								$Insert=$Elave_Et->execute(array(
									'Rutbe_Id'=>$Rutbe_Id,
									'Rutbe_Adi'=>$Rutbe_Adi,
									'Rutbe_Xidmet_Ili'=>$Rutbe_Xidmet_Ili,
									'Rutbe_Pulu'=>$Rutbe_Pulu,
									'Rutbe_Sira_No'=>$Rutbe_Sira_No,
									'Rutbe_Durum'=>$Rutbe_Durum,
									'TarixSaat'=>$TarixSaat,
									'Admin_Id'=>$Admin_Id,
									'Admin_Ad'=>$Admin_Ad,
									'Admin_Soyad'=>$Admin_Soyad,
									'Admin_Ataadi'=>$Admin_Ataadi,
									'Islem_Sebebi'=>2,
									'Rutbe_Seo_Url'=>$Rutbe_Seo_Url
								));
								if ($Insert) {?>
									<input type="hidden" id="ugurlu" >
									<?php 
									$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe order by Rutbe_Sira_No ASC ");
									$Rutbe_Sor->execute();
									$Rutbe_Say=$Rutbe_Sor->rowCount();
									if ($Rutbe_Say>0) {?>
										<div class="row">
											<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
												<table class="ListelemeAlaniIciTablosu">						
													<thead>
														<tr>
															<th>№</th>
															<th>Adı</th>
															<th>Pulu</th>
															<th>X/R Xidmət İli</th>	
															<th>Sıra №</th>
															<?php if ($RutbeAdlariStatus==1 or $RutbeAdlariDuzelis==1 or $RutbeAdlariSil==1 or $RutbeAdlariBaxis==1): ?>
																<th class="emeliyyatlar_alani">Əməliyyatlar</th>	
															<?php endif ?>								
														</tr>
													</thead>
													<tbody>
														<?php 
														$Sira_Nomir=0;
														while ($Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC)) {
															$Sira_Nomir++;
															?>
															<tr>						
																<td class=" textaligncenter"><?php echo $Sira_Nomir ?></td>
																<td><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></td>
																<td class="textaligncenter"><?php echo number_format($Rutbe_Cek['Rutbe_Pulu'],2) ?></td>
																<td class="textaligncenter"><?php echo $Rutbe_Cek['Rutbe_Xidmet_Ili']>0 ? $Rutbe_Cek['Rutbe_Xidmet_Ili']:"";?></td>
																<td class="textaligncenter"><?php echo $Rutbe_Cek['Rutbe_Sira_No'] ?></td>
																<?php if ($RutbeAdlariStatus==1 or $RutbeAdlariDuzelis==1 or $RutbeAdlariSil==1 or $RutbeAdlariBaxis==1): ?>							
																	
																	<td class="emeliyyatlar_sil_alani textaligncenter">
																		<?php if ($RutbeAdlariStatus==1) { ?>
																			<label class="checkbox" title="" >
																				<input <?php echo $Rutbe_Cek['Rutbe_Durum']==1 ? "checked":"";?>
																				type="checkbox" id="DurumId_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onchange="DurumKontrol(this.id)" > 
																				<span class="checkbox"> 
																					<span></span>
																				</span>
																			</label>
																		<?php } if ($RutbeAdlariDuzelis==1) { ?>
																			<button class="YenileButonlari" id="Duzelis_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onclick="Duzelis(this.id)" type="button">
																				<i class="fas fa-edit"></i>
																			</button>
																		<?php } if ($RutbeAdlariSil==1) { ?>
																			<button class="YenileButonlari" id="Sil_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onclick="Sil(this.id)" type="button">
																				<i class="fas fa-trash"></i>
																			</button>
																		<?php } if ($RutbeAdlariBaxis==1) { ?>
																			<button class="YenileButonlari" id="Sil_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onclick="DeyisiklereBax(this.id)" type="button">
																				<i class="fas fa-eye"></i>
																			</button>
																		<?php } ?>
																	</td> 
																<?php endif ?>
															</tr>	
														<?php }	?>
														<div id="YeniModalİci" style="display: none;">
															<div class="row">						
																<form class="row g-3 p-2 ">						
																	<div class="col-12 col-sm-6">
																		<label for="Rutbe_Adi" class="form-label">Rütbə Adı<span class="KirmiziYazi">*</span></label>
																		<input type="text" class="form-control" id="Rutbe_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "150" tabindex="1" title="">
																	</div>		
																	<div class="col-12 col-sm-6">
																		<label for="Rutbe_Pulu" class="form-label">Rütbə Pulu<span class="KirmiziYazi">*</span></label>
																		<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Pulu" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" >
																	</div>	
																	<div class="col-12 col-sm-6">
																		<label for="Rutbe_Xidmet_Ili" class="form-label">Xidmət İli (Müəyyen Edilən Rütbələr Üçün Yazılır)</label>
																		<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Xidmet_Ili" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" >
																	</div>	
																	<div class="col-12 text-center mt-3">
																		<button type="button" onclick="YeniRutbeAdiFormKontrol()" class="YenileButonlari" tabindex="15" title="Məlumatın Taddaşa Yazılması Üçün Təsdiq">Yaddaşa Yaz</button>
																		<button type="button" onClick="Bagla();" class="YenileButonlari" tabindex="16" title="Məlumatların Yaddaşa Yazılmasından İmtina">İmtina Et</button>
																	</div>		
																	<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>				
																</form>	
															</div>
														</div>
													</tbody>
													
												</table>
											</div>
										</div>
									<?php } else{	?>
										<div class="row">
											<div class="over-y">
												Bazada Rütbə Adı Mövcut Deyil
											</div>
										</div> 
										<div id="YeniModalİci" style="display: none;">
											<div class="row">						
												<form class="row g-3 p-2 ">						
													<div class="col-12 col-sm-6">
														<label for="Rutbe_Adi" class="form-label">Rütbə Adı<span class="KirmiziYazi">*</span></label>
														<input type="text" class="form-control" id="Rutbe_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "150" tabindex="1" title="">
													</div>		
													<div class="col-12 col-sm-6">
														<label for="Rutbe_Pulu" class="form-label">Rütbə Pulu<span class="KirmiziYazi">*</span></label>
														<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Pulu" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" >
													</div>	
													<div class="col-12 text-center mt-3">
														<button type="button" onclick="YeniRutbeAdiFormKontrol()" class="YenileButonlari" tabindex="15" title="Məlumatın Taddaşa Yazılması Üçün Təsdiq">Yaddaşa Yaz</button>
														<button type="button" onClick="Bagla();" class="YenileButonlari" tabindex="16" title="Məlumatların Yaddaşa Yazılmasından İmtina">İmtina Et</button>
													</div>		
													<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>				
												</form>	
											</div>
										</div>
									<?php 	}	
								}else{?>
									<input type="hidden" id="isnertugursuz" >
									<?php 
									$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe order by Rutbe_Sira_No ASC ");
									$Rutbe_Sor->execute();
									$Rutbe_Say=$Rutbe_Sor->rowCount();
									if ($Rutbe_Say>0) {?>
										<div class="row">
											<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
												<table class="ListelemeAlaniIciTablosu">						
													<thead>
														<tr>
															<th>№</th>
															<th>Adı</th>
															<th>Pulu</th>
															<th>X/R Xidmət İli</th>	
															<th>Sıra №</th>
															<?php if ($RutbeAdlariStatus==1 or $RutbeAdlariDuzelis==1 or $RutbeAdlariSil==1 or $RutbeAdlariBaxis==1): ?>
																<th class="emeliyyatlar_alani">Əməliyyatlar</th>	
															<?php endif ?>								
														</tr>
													</thead>
													<tbody>
														<?php 
														$Sira_Nomir=0;
														while ($Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC)) {
															$Sira_Nomir++;
															?>
															<tr>						
																<td class=" textaligncenter"><?php echo $Sira_Nomir ?></td>
																<td><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></td>
																<td class="textaligncenter"><?php echo number_format($Rutbe_Cek['Rutbe_Pulu'],2) ?></td>
																<td class="textaligncenter"><?php echo $Rutbe_Cek['Rutbe_Xidmet_Ili']>0 ? $Rutbe_Cek['Rutbe_Xidmet_Ili']:"";?></td>
																<td class="textaligncenter"><?php echo $Rutbe_Cek['Rutbe_Sira_No'] ?></td>
																<?php if ($RutbeAdlariStatus==1 or $RutbeAdlariDuzelis==1 or $RutbeAdlariSil==1 or $RutbeAdlariBaxis==1): ?>							
																	
																	<td class="emeliyyatlar_sil_alani textaligncenter">
																		<?php if ($RutbeAdlariStatus==1) { ?>
																			<label class="checkbox" title="" >
																				<input <?php echo $Rutbe_Cek['Rutbe_Durum']==1 ? "checked":"";?>
																				type="checkbox" id="DurumId_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onchange="DurumKontrol(this.id)" > 
																				<span class="checkbox"> 
																					<span></span>
																				</span>
																			</label>
																		<?php } if ($RutbeAdlariDuzelis==1) { ?>
																			<button class="YenileButonlari" id="Duzelis_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onclick="Duzelis(this.id)" type="button">
																				<i class="fas fa-edit"></i>
																			</button>
																		<?php } if ($RutbeAdlariSil==1) { ?>
																			<button class="YenileButonlari" id="Sil_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onclick="Sil(this.id)" type="button">
																				<i class="fas fa-trash"></i>
																			</button>
																		<?php } if ($RutbeAdlariBaxis==1) { ?>
																			<button class="YenileButonlari" id="Sil_<?php echo $Rutbe_Cek['Rutbe_Id'] ?>" onclick="DeyisiklereBax(this.id)" type="button">
																				<i class="fas fa-eye"></i>
																			</button>
																		<?php } ?>
																	</td> 
																<?php endif ?>
															</tr>	
														<?php }	?>
														<div id="YeniModalİci" style="display: none;">
															<div class="row">						
																<form class="row g-3 p-2 ">						
																	<div class="col-12 col-sm-6">
																		<label for="Rutbe_Adi" class="form-label">Rütbə Adı<span class="KirmiziYazi">*</span></label>
																		<input type="text" class="form-control" id="Rutbe_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "150" tabindex="1" title="">
																	</div>		
																	<div class="col-12 col-sm-6">
																		<label for="Rutbe_Pulu" class="form-label">Rütbə Pulu<span class="KirmiziYazi">*</span></label>
																		<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Pulu" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" >
																	</div>	
																	<div class="col-12 col-sm-6">
																		<label for="Rutbe_Xidmet_Ili" class="form-label">Xidmət İli (Müəyyen Edilən Rütbələr Üçün Yazılır)</label>
																		<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Xidmet_Ili" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" >
																	</div>	
																	<div class="col-12 text-center mt-3">
																		<button type="button" onclick="YeniRutbeAdiFormKontrol()" class="YenileButonlari" tabindex="15" title="Məlumatın Taddaşa Yazılması Üçün Təsdiq">Yaddaşa Yaz</button>
																		<button type="button" onClick="Bagla();" class="YenileButonlari" tabindex="16" title="Məlumatların Yaddaşa Yazılmasından İmtina">İmtina Et</button>
																	</div>		
																	<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>				
																</form>	
															</div>
														</div>
													</tbody>
													
												</table>
											</div>
										</div>
									<?php } else{	?>
										<div class="row">
											<div class="over-y">
												Bazada Rütbə Adı Mövcut Deyil
											</div>
										</div> 
										<div id="YeniModalİci" style="display: none;">
											<div class="row">						
												<form class="row g-3 p-2 ">						
													<div class="col-12 col-sm-6">
														<label for="Rutbe_Adi" class="form-label">Rütbə Adı<span class="KirmiziYazi">*</span></label>
														<input type="text" class="form-control" id="Rutbe_Adi" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "150" tabindex="1" title="">
													</div>		
													<div class="col-12 col-sm-6">
														<label for="Rutbe_Pulu" class="form-label">Rütbə Pulu<span class="KirmiziYazi">*</span></label>
														<input type="number" min="0" max="9999999" class="form-control" id="Rutbe_Pulu" oninput="PulFormatiYazildi(this.id)" onfocusout="PulFormatiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength = "8" tabindex="1" title="" >
													</div>	
													<div class="col-12 text-center mt-3">
														<button type="button" onclick="YeniRutbeAdiFormKontrol()" class="YenileButonlari" tabindex="15" title="Məlumatın Taddaşa Yazılması Üçün Təsdiq">Yaddaşa Yaz</button>
														<button type="button" onClick="Bagla();" class="YenileButonlari" tabindex="16" title="Məlumatların Yaddaşa Yazılmasından İmtina">İmtina Et</button>
													</div>		
													<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>				
												</form>	
											</div>
										</div>
									<?php 	}	
								}
							}else{
								echo "error_2006";/*Rütbə sıra nömrəsi bazada var*/
								exit;
							}
						}else{
							echo "error_2005";/*Rütbə sıra nömrəsi bazada var*/
							exit;
						}						
					}else{
						echo "error_2004";/*Rütbə sıra nömrəsi bazada var*/
						exit;
					}
				}else{
					echo "error_2002";/*Rütbə pulu boş ola bilməz*/
					exit;
				}			
			}else{
				echo "error_2001";/*Rütbə adı boş ola bilməz*/
				exit;
			}
		}else{
			echo "error_2000";/*Id xetali*/
			exit; 
		}
	}
}
?>