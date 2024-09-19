<?php 
require_once '_header.php';
if ($IntizamTenbehiAdlariMenu==1) {
	?>
	<script type="text/javascript" src="Intizam_Tenbehi_Adlari/Script.js"></script>		
	<div  class="mt-2">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="d-flex  justify-content-between">
						<div class="p-2"></div>
						<div class="p-2" id="cavabid"></div>
						<div class="p-2">
							<?php if ($IntizamTenbehiAdlariYeni==1) {?>	<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>	<?php } ?>

						</div>
					</div>				
				</div>
			</div>

			<div class="card-body" id="icerik">
				<?php 
				$Sor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari order by intizam_tenbehi_adlari_Sira_No ASC ");
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
										<?php if ($IntizamTenbehiAdlariNezerealmaGoster==1): ?>
											<th>Nəzərə alma</th>
										<?php endif ?>			
										<?php if ($IntizamTenbehiAdlariStatus==1 or $IntizamTenbehiAdlariDuzelis==1 or $IntizamTenbehiAdlariSil==1): ?>
											<th class="emeliyyatlar_alani">Əməliyatlar</th>			
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
											<td><?php echo $Cek['intizam_tenbehi_adlari_ad'] ?></td>			
											<td class="siar_no_alani"><?php echo $Cek['intizam_tenbehi_adlari_Sira_No'] ?></td>								
											<td class="siar_no_alani"><?php echo $Cek['intizam_tenbehi_adlari_Xususi_No'] ?></td>
											<?php if ($IntizamTenbehiAdlariNezerealmaGoster): ?>
												<td class="Vezife_Adlari_Durum_Kapsama">
													<label class="checkbox">
														<input 
														<?php 
														if ($Cek['intizam_tenbehi_adlari_nezere_alam']==1) {
															echo  "checked";
														}else{}
														?>
														type="checkbox"
														<?php if ($IntizamTenbehiAdlariNezerealma!=1) {
															echo disabled;
														} ?>

														id="nezerealam_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onchange="NezereAlam(this.id)" > 
														<span class="checkbox"> 
															<span></span>
														</span>
													</label>
												</td>
											<?php endif ?>
											<?php if ($IntizamTenbehiAdlariStatus==1 or $IntizamTenbehiAdlariDuzelis==1 or $IntizamTenbehiAdlariSil==1): ?>
												

												<td class="textaligncenter">
													<?php if ($IntizamTenbehiAdlariStatus==1): ?>
														<label class="checkbox">
															<input 
															<?php 
															if ($Cek['intizam_tenbehi_adlari_durum']==1) {
																echo  "checked";
															}else{}
															?>
															type="checkbox" id="DurumId_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onchange="DurumKontrol(this.id)" > 
															<span class="checkbox"> 
																<span></span>
															</span>
														</label>

													<?php endif ?>
													<?php if ($IntizamTenbehiAdlariDuzelis): ?>
														<button class="YenileButonlari" id="Duzelis_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onclick="Duzelis(this.id)" type="button">	<i class="fas fa-edit"></i></button>		
													<?php endif ?>

													<?php if ($IntizamTenbehiAdlariSil): ?>
														<button class="YenileButonlari" id="Sil_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onclick="Sil(this.id)" type="button">	<i class="fas fa-trash"></i></button>				
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
			</div>
		</div>
	</div>
	<?php 
}
require_once '_footer.php';
?>