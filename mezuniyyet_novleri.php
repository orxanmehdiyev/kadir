<?php require_once '_header.php';
if ($MezuniyyetAdlariMenusu==1) {?>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
						<?php if ($MezuniyyetAdlariYeni==1): ?>
							<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>			
						<?php endif ?>					
					</div>
				</div>
			</div>
		</div>
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM mezuniyyet_novleri order by Mezuniyyet_Novleri_Sira ASC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
						<table class="ListelemeAlaniIciTablosu">						
							<thead>
								<tr>
									<th>№</th>
									<th>Adı</th>
									<th>Kissa Adı</th>
									<th>Sıra №</th>	
									<?php if ($MezuniyyetAdlariStatus==1 or $MezuniyyetAdlariDuzelis==1 or $MezuniyyetAdlariSil==1 or $MezuniyyetAdlariBax==1 ): ?>
										<th>Əməliyyatlar</th>		
									<?php endif ?>
									
								</tr>
							</thead>
							<tbody>
								<?php 
								$Sira_Nomir=0;
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									$Sira_Nomir++;
									?>
									<tr>						
										<td class=" textaligncenter"><?php echo $Sira_Nomir ?></td>
										<td><?php echo $Cek['Mezuniyyet_Novleri_Ad'] ?></td>	
										<td><?php echo $Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>	
										<td class="textaligncenter"><?php echo $Cek['Mezuniyyet_Novleri_Sira'] ?></td>
										<?php if ($MezuniyyetAdlariStatus==1 or $MezuniyyetAdlariDuzelis==1 or $MezuniyyetAdlariSil==1 or $MezuniyyetAdlariBax==1 ): ?>							
										<td class="textaligncenter">
											<?php if ($MezuniyyetAdlariStatus==1): ?>
												<label class="checkbox" title="" >
													<input <?php echo $Cek['Mezuniyyet_Novleri_Durum']==1 ? "checked":"";?>
													type="checkbox" id="DurumId_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onchange="DurumKontrol(this.id)" > 
													<span class="checkbox"> 
														<span></span>
													</span>
												</label>
											<?php endif ?>

											<?php if ($MezuniyyetAdlariDuzelis==1): ?>
												<button class="YenileButonlari" id="Duzelis_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onclick="Duzelis(this.id)" type="button">
													<i class="fas fa-edit"></i>
												</button>
											<?php endif ?>
											
											<?php if ($MezuniyyetAdlariSil==1): ?>
												<button class="YenileButonlari" id="Sil_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onclick="Sil(this.id)" type="button">
													<i class="fas fa-trash"></i>
												</button>
											<?php endif ?>
											
											<?php if ($MezuniyyetAdlariBax==1): ?>
												<button class="YenileButonlari" id="Bax_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onclick="DeyisiklereBax(this.id)" type="button">
													<i class="fas fa-eye"></i>
												</button>
											<?php endif ?>											
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
						Bazada məzuniyyət növü mövcut deyil
					</div>
				</div>			
			<?php }?>
		</div>
	</div>
	<script type="text/javascript" src="MezuniyyetNovleri/Script.js"></script>
	<?php 
} require_once '_footer.php';?>