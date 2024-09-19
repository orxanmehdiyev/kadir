<?php 
require_once '../Ayarlar/setting.php';
if ($RutbeAdlariYeni==1) {
	if (isset($_POST['Deyer'])) {
		$deyer =json_decode($_POST['Deyer'],true);
		$Rutbe_Adi           =  EditorluIcerikleriFiltrle($deyer['Rutbe_Adi']); 
		$Rutbe_Pulu          =  ReqemlernokteVergulXaricButunKarakterleriSil($deyer['Rutbe_Pulu']); 
		$Rutbe_Xidmet_Ili    =  ReqemlernokteVergulXaricButunKarakterleriSil($deyer['Rutbe_Xidmet_Ili']); 
		$Rutbe_Seo_Url=seo($Rutbe_Adi);
		if ($Rutbe_Pulu!="") { 
			if ($Rutbe_Adi!="") {
				$Rutbe_Adi_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Adi=:Rutbe_Adi");
				$Rutbe_Adi_Sor->execute(array(
					'Rutbe_Adi'=>$Rutbe_Adi));
				$Rutbe_Adi_Say=$Rutbe_Adi_Sor->rowCount();
				if (!$Rutbe_Adi_Say>0) {
					$Sira_No_Sor=$db->prepare("SELECT MAX(Rutbe_Sira_No) AS Rutbe_Sira_No FROM rutbe");			
					$Sira_No_Sor->execute();
					$Sira_No_Cek=$Sira_No_Sor->fetch(PDO::FETCH_ASSOC);
					$Rutbe_Sira_No=$Sira_No_Cek['Rutbe_Sira_No']+1;
					$Elave_Et=$db->prepare("INSERT INTO rutbe SET
						Rutbe_Adi=:Rutbe_Adi,
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
						");
					$Insert=$Elave_Et->execute(array(
						'Rutbe_Adi'=>$Rutbe_Adi,
						'Rutbe_Xidmet_Ili'=>$Rutbe_Xidmet_Ili,
						'Rutbe_Pulu'=>$Rutbe_Pulu,
						'Rutbe_Sira_No'=>$Rutbe_Sira_No,
						'Rutbe_Durum'=>0,
						'TarixSaat'=>$TarixSaat,
						'Admin_Id'=>$Admin_Id,
						'Admin_Ad'=>$Admin_Ad,
						'Admin_Soyad'=>$Admin_Soyad,
						'Admin_Ataadi'=>$Admin_Ataadi,
						'Rutbe_Seo_Url'=>$Rutbe_Seo_Url
					));
					if ($Insert) {
						$Rutbe_Id = $db->lastInsertId();
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
							'Rutbe_Durum'=>0,
							'TarixSaat'=>$TarixSaat,
							'Admin_Id'=>$Admin_Id,
							'Admin_Ad'=>$Admin_Ad,
							'Admin_Soyad'=>$Admin_Soyad,
							'Admin_Ataadi'=>$Admin_Ataadi,
							'Islem_Sebebi'=>1,
							'Rutbe_Seo_Url'=>$Rutbe_Seo_Url
						));
						if ($Insert) { ?>
							<input type="hidden" id="yenilendi" >
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
							<?php 	}	?>

						<?php }else{
							?>
							<input type="hidden" id="silinmeugurluinsertxeta" >
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
							<?php 	}	?>
							
							<?php 
						}
					}else{
						echo "error_2003";/*Insert xeta*/
						exit;
					}
				}else{
					echo "error_2002";/*Rutbə adı var*/
					exit;
				}
			}else{
				echo "error_2001";/*Rütbə adı boş ola bilməz*/
				exit;
			}
		}else{
			echo "error_2000";/*Rütbə pulu boş ola bilməz*/
			exit;
		}
	}else{
		header("Location:../ise_qebul_emri.php");
		exit;
	}
}
?>