<?php 
require_once '_header.php';
if ($IdarelerMenusu==1) {
	?>
	<script type="text/javascript" src="Idareler/Script.js"></script>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
						<?php if ($IdarelerYeni==1) {?><button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button><?php } ?>
					</div>
				</div>				
			</div>
		</div>
		<div class="card-body" id="icerik">
			<?php 
			$Idare_Sor=$db->prepare("SELECT * FROM idare order by Sira_No ASC ");
			$Idare_Sor->execute();
			$Idare_Say=$Idare_Sor->rowCount();
			if ($Idare_Say>0) {?>
				<div class="row">
					<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
						<table class="ListelemeAlaniIciTablosu">
							<thead class="">
								<tr>	
									<th>№</th>
									<th>Adı</th>
									<th>Kısa Adı</th>
									<th>VÖEN</th>
									<th>Sira No</th>								
									<th>Ünvanı</th>	
									<th>Yaradıldığı Tarix</th>
									<th >Əməliyyatlar</th>			
								</tr>
							</thead>
							<tbody>
								<?php 
								$Sira_Nomir=0;
								while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
									$Sira_Nomir++;
									?>
									<tr>							
										<td class="textaligncenter"><?php echo $Sira_Nomir ?></td>
										<td><?php echo $Idare_Cek['Idare_Adi'] ?></td>							
										<td><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>							
										<td class="textaligncenter"><?php echo $Idare_Cek['Idare_VOEN'] ?></td>
										<td class="textaligncenter"><?php echo $Idare_Cek['Sira_No'] ?></td>
										<td><?php echo $Idare_Cek['Idare_Unvan'] ?></td>
										<td class="textaligncenter"><?php echo $Idare_Cek['Idarenin_Elave_Edildiyi_TarixSaat'] ?></td> 
										<td style="width:250px;">
											<?php if ($IdarelerDurumKontrol==1) {?>
												<label class="checkbox" title="" >
													<input <?php echo $Idare_Cek['Durum']==1 ? "checked":"";?>									
													type="checkbox" id="DurumId_<?php echo $Idare_Cek['Idare_Id'] ?>" onchange="DurumKontrol(this.id)" > 
													<span class="checkbox"> 
														<span></span>
													</span>
												</label>
											<?php } if ($IdarelerDuzelis==1) {?>		
												<button class="YenileButonlari" id="DuzelisButton_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="DuzelisYoxlanis(this.id)" type="button">
													<i class="fas fa-edit"></i>
												</button>
											<?php } if ($IdarelerSil==1) {?>
												<button class="YenileButonlari" id="SilButton_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="SilYoxlanis(this.id)" type="button">
													<i class="fas fa-trash"></i>
												</button>
											<?php } if ($IdarelerIslemlereBaxis==1) {?>
												<button class="YenileButonlari" id="Bax_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="DeyisiklereBax(this.id)" type="button">
													<i class="fas fa-eye"></i>
												</button>
											<?php } ?>
										</td> 
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
						Bazada İdarə Mövcut Deyil
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
	<?php 
	// code...
}
require_once '_footer.php';
?>