<?php require_once '_header.php'; ?>
<script type="text/javascript" src="IntizamTenbehleri/Script.js"></script>		
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
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM   intizam_tenbehi order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC,Intizam_Tenbehi_Id DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Nömrə</th>
									<th>Adı,soyadı</th>
									<th>Səbəb</th>
									<th>İntizam Tənbehi</th>
									<th>Başlanğıc Tarixi</th>
									<th>Bitiş Tarixi</th>
									<th>Əməliyyat</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>							
										<td class="siar_no_alani"><?php echo $Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);	?></td>
										<td><?php echo $Cek['Intizam_Tenbehi_Sebeb'] ?></td>
										<td><?php echo $Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
										<td class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']) ?></td>
										<td class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Intizam_Tenbehinin_Bitis_Tarixi']) ?></td>										
										<td class="emeliyyatlar_iki_buttom">							
											<?php echo DuzenleButonu($Cek['Intizam_Tenbehi_Id'])." ".SilButonu($Cek['Intizam_Tenbehi_Id']) ?>		
										</td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada İntizam Tənbehi əmri yoxdur
					</div>
				</div> 
			<?php }	?>
		</div>
	</div>
</div>
<?php require_once '_footer.php';?>
<script> 
	CedveliCagir("dataTable");
</script>