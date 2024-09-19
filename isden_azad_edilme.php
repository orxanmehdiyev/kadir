<?php require_once '_header.php';?>
<script type="text/javascript" src="IsdenAzadEtme/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
						<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>				
					</div>
				</div>				
			</div>
		</div>		
		<div class="bolmeleralanlari" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM user where Durum=:Durum order by Isden_Cixarilma_Tarixi DESC limit 30");
			$Sor->execute(array(
				'Durum'=>0));
			$Say=$Sor->rowCount();
			if ($Say>0) {?>			
				<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
					<thead class="">
						<tr>
							<th>Adı,soyadı</th>
							<th>Səbəb</th>
							<th>Tarixi</th>
							<th>Əmri No</th>																
							<th>Sil</th>																							
						</tr>
					</thead>
					<tbody id="list" class="table_ici">
						<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
							<tr>
								<td><?php echo $Cek['Soy_Adi']." ".$Cek['Adi']." ".$Cek['Ata_Adi'] ?></td>			
								<td><?php echo $Cek['xitam_sebebleri_kisa_ad'] ?></td>
								<td data-sort="<?php echo $Cek['Isden_Cixarilma_Tarixi'] ?>"><?php echo TarixAzCevir($Cek['Isden_Cixarilma_Tarixi']) ?></td>
								<td><?php echo $Cek['Isden_Cixarilma_Emir_No'] ?></td>
								<td class="emeliyyatlar_sil_buttom">	
									<?php 
									if ($Cek['Isden_Cixarilma_Tarixi'] >0 and $Cek['Isden_Cixarilma_Idare_Id'] >0 ) {
										$VezifeSor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id");
										$VezifeSor->execute(array(
											'Vezife_Id'=>$Cek['Isden_Cixarilma_Vezife_Id']));	
										$VezifeCek=$VezifeSor->fetch(PDO::FETCH_ASSOC);
										if (!$VezifeCek['User_Id']>0) { echo SilButonu($Cek['ID']); 
									}

								} ?>
							</td>
						</tr>	
					<?php } ?>
				</tbody>
			</table>					
		<?php }else{	?>
			<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
				<thead class="">
					<tr>
						<th>№</th>
						<th>Adı,soyadı</th>
						<th>Səbəb</th>
						<th>Tarixi</th>
						<th>Əmri No</th>																
						<th>Sil</th>																							
					</tr>
				</thead>
			</table>					
		<?php 	}	?>
	</div>
</div>
</div>
<?php require_once '_footer.php';?>
<script> CedveliCagir("dataTable");</script>