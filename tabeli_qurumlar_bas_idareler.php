<?php 
require_once '_header.php';
if ($BasIdare==1) {?>
	<script type="text/javascript" src="TabeliQurumlarVeBasIdareler/TabeliQurumlarVeBasIdareler.js"></script>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
						<?php if ($YeniBasIdare==1) {?><button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button> <?php }else{} ?>									
					</div>
				</div>
			</div>
		</div>
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="siar_no_alani">№</th>
									<th>Tabeli Qurumun və ya Baş İdarənin Adı</th>
									<th  class="emeliyyatlar_alani">Əməliyyatlar</th>		
								</tr>
							</thead>
							<tbody id="vezifeadlarlisti" class="table_ici">
								<?php 						
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {							
									?>
									<tr>	
										<td class="vezife_adlari_sira_input_kapsama">
											<input class="vezifeadlarisira" min="1" id="SiraId_<?php echo $Cek['Id'] ?>" type="number" value="<?php echo $Cek['Sira_No'] ?>" onfocusout="SiraDuzelis(this.id)" onkeydown="javascript: return event.keyCode == 69 ? false : true" >
										</td>	
										<td class="vezife_adlari_ad_input_kapsama" id="AdId_<?php echo $Cek['Id'] ?>">
											<?php echo $Cek['Adi'] ?>
										</td>
										<td class="emeliyyatlar_alani">
											<?php if ($BasIdareAktivPassiv==1) {?>
												<label class="checkbox" title="" >
													<input 
													<?php 
													if ($Cek['Durum']==1) {
														echo  "checked";
													}else{}
													?>
													type="checkbox" id="DurumId_<?php echo $Cek['Id'] ?>" onchange="DurumKontrol(this.id)" > 
													<span class="checkbox"> 
														<span></span>
													</span>
												</label>
											<?php } if ($BasIdareDuzenle==1) { ?>	
												<button class="YenileButonlari" id="DuzelisButton_<?php echo $Cek['Id'] ?>" onclick="DuzelisYoxlanis(this.id)" type="button"><i class="fas fa-edit"></i></button>
											<?php } if ($BasIdareSil==1) { ?>
												<button class="YenileButonlari" id="SilButton_<?php echo $Cek['Id'] ?>" onclick="SilYoxlanis(this.id)" type="button"><i class="fas fa-trash"></i></button>
											<?php } ?>
										</td> 
									</tr>	
								<?php }
								?>									
							</tbody>
						</table>
					</div>
				</div>
			<?php } else{	?>
				<div class="row">
					<div class="over-y">
						Bazada Tabeli Qurum Və Ya Baş İdarə Mövcut Deyil
					</div>
				</div> 					
			<?php 	}	?>
		</div>
	</div>

	<?php 
}
require_once '_footer.php';
?>


