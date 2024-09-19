<?php require_once '_header.php'; ?>
<script type="text/javascript" src="XestelikVereqlerininQeydiyyati/Script.js"></script>		
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
				<div class="col-12 text-end">									
					<a href="javascript:void(0)" title="" onclick="EtrafliAxtaris()" >Ətraflı axtarış</a>
				</div>			
			</div>
		</div>		
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM xestelik_qeydiyyat order by Xestelik_Baslagic_Tarixi DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı, ata adı</th>
									<th>Başlanğıc tarixi</th>
									<th>Bitiş tarixi</th>
									<th>Gün</th>
									<th class="emeliyyatlar_sil_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xestelik_Baslagic_Tarixi']) ?></td>										
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xestelik_Ise_Cixma_Tarixi']) ?></td>
										<td><?php echo $Cek['Xestelik_Gun']?></td>																															
										<td class="emeliyyatlar_sil_buttom"><?php echo SilButonu($Cek['Xestelik_Id']); ?></td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada rütbə əmri yoxdur
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
</div>
<?php require_once '_footer.php';?>
<script>
	CedveliCagir("dataTable");
</script>

