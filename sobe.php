<?php 
require_once '_header.php';
if ($SobeBolmelerMenusu==1) {

	?>
	<script type="text/javascript" src="SobeBolme/Script.js"></script>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
						<?php if ($SobeBolmeYeni==1) { ?><button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>	<?php } ?>								
					</div>
				</div>				
			</div>
		</div>
		<div class="card-body" id="icerik">
			<?php 
			$Sobe_Say_Sor=$db->prepare("SELECT * FROM sobe ");
			$Sobe_Say_Sor->execute();
			$Sobe_Say=$Sobe_Say_Sor->rowCount();
			if ($Sobe_Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<?php 
						$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC  ");
						$Idare_Sor->execute(array(
							'Durum'=>1));
						$Idare_Sira_Nomir=0;
						while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
							$Idare_Id= $Idare_Cek['Idare_Id'];
							$Idare_Adi= $Idare_Cek['Idare_Adi'];
							$Idare_Sira_Nomir++;
							$IdareSaySor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id ");
							$IdareSaySor->execute(array(
								'Idare_Id'=>$Idare_Id));
							$IdareSay=$IdareSaySor->rowCount();
							if ($IdareSay>0) {?>
								<h4 style="text-align: center;"> <?php echo $Idare_Adi ?></h4 style="text-align: center;">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="siar_no_alani">№</th>
											<th>Adı</th>	
											<th class="siar_nomresi_alani">Sıra No</th>		
											<?php if ($SobeBolmeDurumKontrol==1 or $SobeBolmeDuzelis==1 or $SobeBolmeSil==1): ?>
												<th>Əməliyatlar</th>						
											<?php endif ?>								
											
										</tr>
									</thead>
									<tbody id="list" class="table_ici">
										<?php
										$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id order by Sira_No ASC");
										$Sobe_Sor->execute(array(
											'Idare_Id'=>$Idare_Id));
										$Sira_Nomir=0;
										while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
											$Sira_Nomir++;	
											?>
											<tr id="setir-<?php echo $Sobe_Cek['Sobe_Id'] ?>">							
												<td class="siar_no_alani"><?php echo $Sira_Nomir ?></td>
												<td id="SobeAd_<?php echo $Sobe_Cek['Sobe_Id'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
												<td  class="siar_nomresi_alani textaligncenter" id="Sira_No<?php echo $Sobe_Cek['Sobe_Id'] ?>"><?php echo $Sobe_Cek['Sira_No'] ?></td>	
												<?php if ($SobeBolmeDurumKontrol==1 or $SobeBolmeDuzelis==1 or $SobeBolmeSil==1): ?>


													<td class="emeliyyatlar_Uc_Button_alani">
														<?php if ($SobeBolmeDurumKontrol==1) { ?>
															<label class="checkbox" title="" >
																<input 
																<?php 
																if ($Sobe_Cek['Durum']==1) {
																	echo  "checked";
																}else{}
																?>
																type="checkbox" id="DurumId_<?php echo $Sobe_Cek['Sobe_Id'] ?>" onchange="DurumKontrol(this.id)" > 
																<span class="checkbox"> 
																	<span></span>
																</span>
															</label>
														<?php } if ($SobeBolmeDuzelis==1) {?>
															<button class="YenileButonlari" id="DuzelisButton_<?php echo $Sobe_Cek['Sobe_Id'] ?>" onclick="Duzelis(this.id)" type="button">Düzəliş</button>
														<?php } if ($SobeBolmeSil==1) { ?>
															<button class="YenileButonlari" id="SilButton_<?php echo $Sobe_Cek['Sobe_Id'] ?>" onclick="SilYoxlanis(this.id)" type="button">Sil</button>
														<?php } ?>
													</td> 
												<?php endif ?>												
											</tr>	
										<?php }	?>
									</tbody>
								</table>
							<?php }
						} ?>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada Şöbədə Mövcut Deyil
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
<?php }
require_once '_footer.php';
?>
