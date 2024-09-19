<?php 
require_once '_header.php';
if ($HeveslendiremAdlariMenusu) {?>
	<script type="text/javascript" src="Heveslendirme_Adlari/Script.js"></script>		
	<div  class="mt-2">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="d-flex  justify-content-between">
						<div class="p-2"></div>
						<div class="p-2" id="cavabid"></div>
						<div class="p-2">
							<?php if ($HeveslendiremAdlariYeni==1): ?>
								<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>			
							<?php endif ?>							
						</div>
					</div>				
				</div>
			</div>

			<div class="card-body" id="icerik">
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
							Bazada Tədbiq Edilə Bilən Həvəsləndirmə Tədbiri Yoxdur 
						</div>
					</div> 
				<?php 	}	?>
			</div>
		</div>
	</div>
	<?php 
}
require_once '_footer.php';
?>