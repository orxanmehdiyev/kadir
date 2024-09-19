<?php require_once '_header.php';
if ($IstehsaltTeqvimimenu==1) {
	?>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-3">
						<?php if ($IstehsaltTeqvimiYeni==1): ?>
							<div class="row">
								<div class="col-4">
									<input type="date" class="form-control" id="Tarix_Adi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" required="required" maxlength ="255" tabindex="1" title="">
								</div>
								<div class="col-6">						
									<select id="Sebeb" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
										<option disabled="disabled" value="" selected="selected" tabindex="7"></option>					
										<option value="1">Bayram</option>
										<option value="2">Bayram günü əvəzi</option>
										<option value="3">İş günü</option>
										<option value="4">İstrahət gün</option>
										<option value="5">Seçgi</option>
									</select>
								</div>
								<div class="col-2">
									<button type="button" onclick="FormIslemleri()" class="YenileButonlari" tabindex="15" title="">Təsdiq</button>						
								</div>
							</div>
						<?php endif ?>

					</div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
					</div>
				</div>
			</div>
		</div>
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM  istehsalt_teqvimi order by Tarix_Adi_Unix DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
						<table class="ListelemeAlaniIciTablosu" id="istehsalatteqvimi">						
							<thead>
								<tr>
									<th>Tarix</th>
									<th>Səbəb</th>	
									<?php if ($IstehsaltTeqvimiSil==1): ?>
										<th>Əməliyyatlar</th>				
									<?php endif ?>									
									

								</tr>
							</thead>
							<tbody id="ssss">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									if ($Cek['Sebeb']==1) {
										$Sebeb="Bayram Günü";
									}elseif($Cek['Sebeb']==2){
										$Sebeb="Bayram Günü Əvəzi";
									}elseif($Cek['Sebeb']==3){
										$Sebeb="İş günü";
									}elseif($Cek['Sebeb']==4){
										$Sebeb="İstrahət Günü";
									}elseif($Cek['Sebeb']==5){
										$Sebeb="Seçgi Günü";
									}

									?>
									<tr>		
										<td><?php echo $Cek['Tarix_Adi'] ?></td>					
										<td><?php echo $Sebeb ?></td>										
										<?php if ($IstehsaltTeqvimiSil==1): ?>
											<td class="emeliyyatlar_iki_buttom">										
												<button class="YenileButonlari" id="Sil_<?php echo $Cek['Istehsalt_Teqvimi_ID'] ?>" onclick="Sil(this.id)" type="button">
													<i class="fas fa-trash"></i>
												</button>								
											</td> 
										<?php endif ?>

									</tr>	
								<?php }	?>							
							</tbody>						
						</table>
					</div>
				</div>
			<?php } else{	?>
				<div class="row">
					<div class="over-y">
						İstehsalat təqviminə düzəliş yoxdur
					</div>
				</div>			
			<?php }?>
		</div>
	</div>

	<?php 
}
require_once '_footer.php';?>
<script type="text/javascript" src="IstehsalatTeqvimi/Script.js"></script>	

