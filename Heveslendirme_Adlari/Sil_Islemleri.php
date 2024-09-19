<?php 
require_once '../Ayarlar/setting.php';
if ($HeveslendiremAdlariSil==1) {
if (isset($_POST['Deyer'])) {
	$heveslendirem_tedbirleri_ad_id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id");
	$Sor->execute(array(
		'heveslendirem_tedbirleri_ad_id'=>$heveslendirem_tedbirleri_ad_id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$heveslendirem_tedbirleri_ad=$Cek['heveslendirem_tedbirleri_ad'];
	$heveslendirem_tedbirleri_ad_Sira_No=$Cek['heveslendirem_tedbirleri_ad_Sira_No'];
	$heveslendirem_tedbirleri_ad_Xususi_No=$Cek['heveslendirem_tedbirleri_ad_Xususi_No'];
	$heveslendirem_tedbirleri_ad_Seo_Url=$Cek['heveslendirem_tedbirleri_ad_Seo_Url'];
	$heveslendirem_tedbirleri_ad_durum=$Cek['heveslendirem_tedbirleri_ad_durum'];
	$heveslendirem_tedbirleri_ad_nezere_alam=$Cek['heveslendirem_tedbirleri_ad_nezere_alam'];
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$sil = $db->prepare("DELETE from heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id");
		$kontrol = $sil->execute(array(
			'heveslendirem_tedbirleri_ad_id' => $heveslendirem_tedbirleri_ad_id
		));
		if ($kontrol) {		
			$Elave_Et=$db->prepare("INSERT INTO   heveslendirem_tedbirleri_ad_islemleri SET                               
				heveslendirem_tedbirleri_ad_islemleri_IPadresi=:heveslendirem_tedbirleri_ad_islemleri_IPadresi,
				heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi=:heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi,
				heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id,
				heveslendirem_tedbirleri_ad=:heveslendirem_tedbirleri_ad,
				heveslendirem_tedbirleri_ad_Sira_No=:heveslendirem_tedbirleri_ad_Sira_No,
				heveslendirem_tedbirleri_ad_Xususi_No=:heveslendirem_tedbirleri_ad_Xususi_No,
				heveslendirem_tedbirleri_ad_durum=:heveslendirem_tedbirleri_ad_durum,
				heveslendirem_tedbirleri_ad_nezere_alam=:heveslendirem_tedbirleri_ad_nezere_alam,
				Status=:Status,
				Islem_Eden_User_Id=:Islem_Eden_User_Id,
				heveslendirem_tedbirleri_ad_Seo_Url=:heveslendirem_tedbirleri_ad_Seo_Url
				");
			$Insert=$Elave_Et->execute(array(                                
				'heveslendirem_tedbirleri_ad_islemleri_IPadresi'=>$IPAdresi,
				'heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi'=>$ZamanDamgasi,
				'heveslendirem_tedbirleri_ad_id'=>$heveslendirem_tedbirleri_ad_id,
				'heveslendirem_tedbirleri_ad'=>$heveslendirem_tedbirleri_ad,
				'heveslendirem_tedbirleri_ad_Sira_No'=>$heveslendirem_tedbirleri_ad_Sira_No,
				'heveslendirem_tedbirleri_ad_Xususi_No'=>$heveslendirem_tedbirleri_ad_Xususi_No,
				'heveslendirem_tedbirleri_ad_durum'=>$heveslendirem_tedbirleri_ad_durum,
				'heveslendirem_tedbirleri_ad_nezere_alam'=>$heveslendirem_tedbirleri_ad_nezere_alam,
				'Status'=>3,
				'Islem_Eden_User_Id'=>$User_Id,
				'heveslendirem_tedbirleri_ad_Seo_Url'=>$heveslendirem_tedbirleri_ad_Seo_Url
			));
			if ($Insert) {?>
				<input type="hidden" id="yenilendi">
				<?php 
				$Sor=$db->prepare("SELECT * FROM  heveslendirem_tedbirleri_ad order by heveslendirem_tedbirleri_ad_Sira_No ASC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table class="table table-bordered table-hover">
								
								<thead class="">
									<tr>
										<th>№</th>
										<th>Adı</th>
										<th>Sıra №</th>
										<th>Xüsusi №</th>
										<?php if ($HeveslendiremAdlariNezereAlma==1): ?>
											<th>Nəzərə alma</th>
										<?php endif ?>		
										<?php if ($HeveslendiremAdlariStatus==1 or $HeveslendiremAdlariDuzelis==1 or $HeveslendiremAdlariSil==1): ?>
											<th class="textaligncenter">Əməliyatlar</th>				
										<?php endif ?>								
										
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php 
									$sira=0;
									while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
										$sira++;
										?>
										<tr>							
											<td class="siar_no_alani"><?php echo $sira ?></td>									
											<td><?php echo $Cek['heveslendirem_tedbirleri_ad'] ?></td>			
											<td class="siar_no_alani"><?php echo $Cek['heveslendirem_tedbirleri_ad_Sira_No'] ?></td>								
											<td class="siar_no_alani"><?php echo $Cek['heveslendirem_tedbirleri_ad_Xususi_No'] ?></td>
											<?php if ($HeveslendiremAdlariNezereAlma==1): ?>
												<td class="Vezife_Adlari_Durum_Kapsama">
													<label class="checkbox">
														<input 
														<?php 
														if ($Cek['heveslendirem_tedbirleri_ad_nezere_alam']==1) {
															echo  "checked";
														}else{}
														?>
														type="checkbox" id="nezerealam_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onchange="NezereAlam(this.id)" > 
														<span class="checkbox"> 
															<span></span>
														</span>
													</label>
												</td>
											<?php endif ?>
											<?php if ($HeveslendiremAdlariStatus==1 or $HeveslendiremAdlariDuzelis==1 or $HeveslendiremAdlariSil==1): ?>
												

												<td class="textaligncenter">
													<?php if ($HeveslendiremAdlariStatus==1): ?>
														<label class="checkbox">
															<input 
															<?php 
															if ($Cek['heveslendirem_tedbirleri_ad_durum']==1) {
																echo  "checked";
															}else{}
															?>
															type="checkbox" id="DurumId_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onchange="DurumKontrol(this.id)" > 
															<span class="checkbox"> 
																<span></span>
															</span>
														</label>
													<?php endif ?>
													<?php if ($HeveslendiremAdlariDuzelis==1): ?>
														<button class="YenileButonlari" id="Duzelis_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onclick="Duzelis(this.id)" type="button"><i class="fas fa-edit"></i></button>	
													<?php endif ?>									

													<?php if ($HeveslendiremAdlariSil==1): ?>
														<button class="YenileButonlari" id="Sil_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>	
													<?php endif ?>
												</td>			
											<?php endif ?>					

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
							Bazada Tədbiq Edilə Bilən İtizam Tənbehi Yoxdur 
						</div>
					</div> 
				<?php 	}	?>

			<?php }else{
				?>
				<input type="hidden" id="silindiinsertolmadi">
				<?php 
				$Sor=$db->prepare("SELECT * FROM  heveslendirem_tedbirleri_ad order by heveslendirem_tedbirleri_ad_Sira_No ASC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table class="table table-bordered table-hover">
								<thead class="">
									<tr>
										<th>№</th>
										<th>Adı</th>
										<th>Sıra №</th>
										<th>Xüsusi №</th>
										<?php if ($HeveslendiremAdlariNezereAlma==1): ?>
											<th>Nəzərə alma</th>
										<?php endif ?>		
										<?php if ($HeveslendiremAdlariStatus==1 or $HeveslendiremAdlariDuzelis==1 or $HeveslendiremAdlariSil==1): ?>
											<th class="textaligncenter">Əməliyatlar</th>				
										<?php endif ?>								
										
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php 
									$sira=0;
									while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
										$sira++;
										?>
										<tr>							
											<td class="siar_no_alani"><?php echo $sira ?></td>									
											<td><?php echo $Cek['heveslendirem_tedbirleri_ad'] ?></td>			
											<td class="siar_no_alani"><?php echo $Cek['heveslendirem_tedbirleri_ad_Sira_No'] ?></td>								
											<td class="siar_no_alani"><?php echo $Cek['heveslendirem_tedbirleri_ad_Xususi_No'] ?></td>
											<?php if ($HeveslendiremAdlariNezereAlma==1): ?>
												<td class="Vezife_Adlari_Durum_Kapsama">
													<label class="checkbox">
														<input 
														<?php 
														if ($Cek['heveslendirem_tedbirleri_ad_nezere_alam']==1) {
															echo  "checked";
														}else{}
														?>
														type="checkbox" id="nezerealam_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onchange="NezereAlam(this.id)" > 
														<span class="checkbox"> 
															<span></span>
														</span>
													</label>
												</td>
											<?php endif ?>
											<?php if ($HeveslendiremAdlariStatus==1 or $HeveslendiremAdlariDuzelis==1 or $HeveslendiremAdlariSil==1): ?>
												

												<td class="textaligncenter">
													<?php if ($HeveslendiremAdlariStatus==1): ?>
														<label class="checkbox">
															<input 
															<?php 
															if ($Cek['heveslendirem_tedbirleri_ad_durum']==1) {
																echo  "checked";
															}else{}
															?>
															type="checkbox" id="DurumId_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onchange="DurumKontrol(this.id)" > 
															<span class="checkbox"> 
																<span></span>
															</span>
														</label>
													<?php endif ?>
													<?php if ($HeveslendiremAdlariDuzelis==1): ?>
														<button class="YenileButonlari" id="Duzelis_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onclick="Duzelis(this.id)" type="button"><i class="fas fa-edit"></i></button>	
													<?php endif ?>									

													<?php if ($HeveslendiremAdlariSil==1): ?>
														<button class="YenileButonlari" id="Sil_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>	
													<?php endif ?>
												</td>			
											<?php endif ?>					

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
							Bazada Tədbiq Edilə Bilən İtizam Tənbehi Yoxdur 
						</div>
					</div> 
				<?php 	}	?>
				
			<?php 
			}
		}else{
			echo "error_1001";/*Silinme ugursuz*/
		}

	}else{
		echo "error_1000";/*Bazada movcut deyil*/
	}

	
}else{
	header("Location:../login.php");
	exit;
}
}
?>