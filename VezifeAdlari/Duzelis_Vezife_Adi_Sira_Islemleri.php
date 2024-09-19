<?php 
require_once '../Ayarlar/setting.php';
if ($VezifeAdlariSira==1) {
	if (!isset($_POST['Deyer'])) {
		header("Location:login.php");
		exit;
	}else{
		$deyer =json_decode($_POST['Deyer'],true);
		$Vezife_Adlari_Sira    = ReqemlerXaricButunKarakterleriSil($deyer['Vezife_Adlari_Sira']); 
		$Vezife_Adlari_Id  = ReqemlerXaricButunKarakterleriSil($deyer['Vezife_Adlari_Id']);
		if ($Vezife_Adlari_Sira!="") {	
			$yenile = $db->prepare("UPDATE vezife_adlari SET     
				Vezife_Adlari_Sira=:Vezife_Adlari_Sira
				WHERE Vezife_Adlari_Id=$Vezife_Adlari_Id");
			$update = $yenile->execute(array(     
				'Vezife_Adlari_Sira'=>$Vezife_Adlari_Sira
			)); 
			if ($update) {					
				$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id ");
				$Vezife_Adlari_Sor->execute(array(
					'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
				$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
				$Vezife_Adlari_Durum=$Vezife_Adlari_Cek['Vezife_Adlari_Durum'];
				$Vezife_Adlari_Ad=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];
				$Vezife_Adlari_Sira=$Vezife_Adlari_Cek['Vezife_Adlari_Sira'];				
				$Elave_Et=$db->prepare("INSERT INTO vezife_adlari_islem SET 
					Vezife_Adlari_Id=:Vezife_Adlari_Id, 
					Vezife_Adlari_Ad=:Vezife_Adlari_Ad, 
					Iselem_Eden_User_Id=:Iselem_Eden_User_Id, 
					ZamanDamgasi=:ZamanDamgasi, 
					Vezife_Adlari_Durum=:Vezife_Adlari_Durum, 
					Vezife_Adlari_Sira=:Vezife_Adlari_Sira
					");
				$Insert=$Elave_Et->execute(array(
					'Vezife_Adlari_Id'=>$Vezife_Adlari_Id,  
					'Vezife_Adlari_Ad'=>$Vezife_Adlari_Ad,  
					'Iselem_Eden_User_Id'=>$_SESSION['user'],  
					'ZamanDamgasi'=>$ZamanDamgasi,  
					'Vezife_Adlari_Durum'=>$Vezife_Adlari_Durum,  
					'Vezife_Adlari_Sira'=>$Vezife_Adlari_Sira  
				));
				if ($Insert) {?>

					<?php 
					$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari order by Vezife_Adlari_Sira ASC ");
					$Vezife_Adlari_Sor->execute();
					$Vezife_Adlari_Say=$Vezife_Adlari_Sor->rowCount();
					if ($Vezife_Adlari_Say>0) {?>
						<div class="row">
					<div class="over-y genislik">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="siar_no_alani">ID</th>
									<th>Adı</th>
									<th>Siar</th>			
									<?php if ($VezifeAdlariAktivPassiv==1 or $VezifeAdlariSil==1): ?>					
										<th class="emeliyyatlar_alani">Əməliyyatlar</th>
									<?php endif ?>		
								</tr>
							</thead>
							<tbody id="vezifeadlarlisti" class="table_ici">
								<?php 
								$Sira_Nomir=0;
								while ($Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC)) {
									$Sira_Nomir++;
									?>
									<tr>						
										<td><?php echo $Sira_Nomir ?></td>
										<td class="vezife_adlari_ad_input_kapsama">
											<input id="VezifeAdlariAd_<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Id'] ?>" type="text"  class="vezifeadlariad" onfocusout="VezifeAdlariAdDuzelis(this.id)"  value="<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Ad'] ?>" >
										</td>
										<td class="vezife_adlari_sira_input_kapsama">
											<?php if ($VezifeAdlariSira==1) {	?>
												<input class="vezifeadlarisira" id="VezifeAdlariSira_<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Id'] ?>" type="number" value="<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Sira'] ?>" onfocusout="VezifeAdlariSiraDuzelis(this.id)" onkeydown="javascript: return event.keyCode == 69 ? false : true" >
											<?php } else{ ?>
												<input class="vezifeadlarisira"  type="number" value="<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Sira'] ?>" disabled >
											<?php } ?>
										</td>
										<?php if ($VezifeAdlariAktivPassiv==1 or $VezifeAdlariSil==1): ?>
											<td class="emeliyyatlar_sil_alani textaligncenter">		
												<?php if ($VezifeAdlariAktivPassiv==1) { ?>										
													<label class="checkbox" title="" >
														<input 
														<?php 
														if ($Vezife_Adlari_Cek['Vezife_Adlari_Durum']==1) {
															echo  "checked";
														}else{

														}
														?>
														type="checkbox" id="VezifeAdlarDurumId_<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Id'] ?>" onchange="VezifeAdlariDurumKontrol(this.id)" > 
														<span class="checkbox"> 
															<span></span>
														</span>
													</label>
												<?php } if ($VezifeAdlariSil==1) { ?>
													<button class="YenileButonlari" id="SilButton_<?php echo $Vezife_Adlari_Cek['Vezife_Adlari_Id'] ?>" onclick="SilYoxlanis(this.id)" type="button">Sil</button>
												<?php } ?>
											</td> 
										<?php endif ?>
									</tr>	
								<?php }
								?>
								<div id="IseQebulModaliIci" style="display: none;">
									<div class="row">						
										<form class="row g-3 p-2 ">						
											<div class="col-6">
												<label for="Vezife_Adlari_Ad" class="form-label" >Adı<span class="KirmiziYazi">*</span></label>
												<input type="text" class="form-control" id="Vezife_Adlari_Ad" oninput="MetinAlaniYazildi(this.id)"  onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" style="text-transform: capitalize;" maxlength = "30" tabindex="1" title="Vəzifənin Adı Yazılır.Bu sahə Məcburidir" >
											</div>						
											<div class="col-2">
												<label for="Vezife_Adlari_Sira	" class="form-label">Sira Nömrəsi<span class="KirmiziYazi">*</span></label>

												<?php 
												$Vezife_Adlari_Sayi_Sor=$db->prepare("SELECT MAX(Vezife_Adlari_Sira) AS Vezife_Adlari_Sira FROM vezife_adlari");			
												$Vezife_Adlari_Sayi_Sor->execute();
												$Cek=$Vezife_Adlari_Sayi_Sor->fetch(PDO::FETCH_ASSOC);
												$Vezife_Adlari_Sira=$Cek['Vezife_Adlari_Sira']+1;
												?>				
												<input type="text" class="form-control" disabled="disabled" value="<?php echo $Vezife_Adlari_Sira ?>" >

											</div> 

											<div class="col-12 text-center mt-3">
												<button type="button" onclick="VezifeAdlarininYazilmasiFormKontrol()" class="YenileButonlari" tabindex="15" title="Məlumatın Taddaşa Yazılması Üçün Təsdiq">Yaddaşa Yaz</button>
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
									Bazada Vezife Adı Mövcut Deyil
								</div>
							</div> 
							<div id="IseQebulModaliIci" style="display: none;">
								<div class="row">						
									<form class="row g-3 p-2 ">						
										<div class="col-6">
											<label for="Vezife_Adlari_Ad" class="form-label" >Adı<span class="KirmiziYazi">*</span></label>
											<input type="text" class="form-control" id="Vezife_Adlari_Ad" oninput="MetinAlaniYazildi(this.id)"  onfocusout="MetinAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" style="text-transform: capitalize;" maxlength = "20" tabindex="1" title="Vəzifənin Adı Yazılır.Bu sahə Məcburidir" >
										</div>						
										<div class="col-2">
											<label for="Vezife_Adlari_Sira	" class="form-label">Sira Nömrəsi<span class="KirmiziYazi">*</span></label>

											<?php 
											$Vezife_Adlari_Sayi_Sor=$db->prepare("SELECT MAX(Vezife_Adlari_Sira) AS Vezife_Adlari_Sira FROM vezife_adlari");			
											$Vezife_Adlari_Sayi_Sor->execute();
											$Cek=$Vezife_Adlari_Sayi_Sor->fetch(PDO::FETCH_ASSOC);
											$Vezife_Adlari_Sira=$Cek['Vezife_Adlari_Sira']+1;
											?>				
											<input type="text" class="form-control" disabled="disabled" value="<?php echo $Vezife_Adlari_Sira ?>" >

											<input type="hidden" id="Vezife_Adlari_Sira" value="<?php echo $Vezife_Adlari_Siras ?>" >
										</div> 

										<div class="col-12 text-center mt-3">
											<button type="button" onclick="VezifeAdlarininYazilmasiFormKontrol()" class="YenileButonlari" tabindex="15" title="Məlumatın Taddaşa Yazılması Üçün Təsdiq">Yaddaşa Yaz</button>
											<button type="button" onClick="Bagla();" class="YenileButonlari" tabindex="16" title="Məlumatların Yaddaşa Yazılmasından İmtina">İmtina Et</button>
										</div>
										<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
									</form>	
								</div>
							</div>
						<?php 	}	?>


						<?php exit;	}else{
							echo "error_3004";/*Yenilenme ugursuz*/
							exit;
						}
					}else{
						echo "error_3003";/*Yenilenme ugursuz*/
						exit;
					}
					
					
				}else{
					echo "error_3000";/*Vezife adi bosdur*/
					exit;
				}
			}
		}
	?>