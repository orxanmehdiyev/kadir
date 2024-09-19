<?php require_once '_header.php';?>
<style type="text/css">
	.dt-buttons{
  margin-left: 0px;
  height: 0px;
}
</style>
<script type="text/javascript" src="MezuniyyetEmri/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2"><button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button></div>
				</div>				
			</div>
		</div>		
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM   mezuniyyet order by Baslagic_Tarixi DESC limit 30");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Soyadı</th>
									<th>Adı</th>
									<th>Ata adı</th>
									<th class="tarixsutunu">Xidmət ili</th>
									<th class="tarixsutunu">Xidmət ili</th>
									<th>Məzuniyyətin növü</th>
									<th class="textaligncenter">Gün</th>
									<th>Başlanğıc Tarixi</th>
									<th class="textaligncenter">Bitiş Tarixi</th>
									<th>İşə çıxma Tarixi</th>
									<th>Əmrin nömrəsi</th>
									<th class="textaligncenter">Əməliyyatlar</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { ?>
									<tr>
										<td><?php echo $Cek['Soyadi'] ?></td>
										<td><?php echo $Cek['Adi'] ?></td>
										<td><?php echo $Cek['AtaAdi'] ?></td>
										<td data-sort="<?php echo$Cek['Xidmet_Ili_Baslagic'] ?>" class="tarixsutunu"><?php	if ($Cek['Xidmet_Ili_Baslagic']>0) {
											 echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Baslagic']);
										}
										 ?></td>
										<td data-sort="<?php echo$Cek['Xidmet_Ili_Son'] ?>" class="tarixsutunu"><?php 
										if ($Cek['Xidmet_Ili_Son']>0) {
											echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Son']);
										}
										 ?></td>
										<td><?php echo $Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>
										<td class="textaligncenter"><?php echo $Cek['Mezuniyyet_Gun'] ?></td>
										<td data-sort="<?php echo$Cek['Baslagic_Tarixi'] ?>"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Baslagic_Tarixi']) ?></td>
										<td data-sort="<?php echo$Cek['Bitis_Tarixi'] ?>" class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Bitis_Tarixi']) ?></td>
										<td data-sort="<?php echo$Cek['Ise_Cixma_Tarixi'] ?>"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Cixma_Tarixi']) ?></td>
										<td><?php echo $Cek['Mezuniyyet_Emrinin_Nomresi'] ?></td>										
										<td class="emeliyyatlar_iki_buttom">										
											<?php 
											
											echo DuzenleButonu($Cek['Mezuniyyet_Id']);
											echo SilButonu($Cek['Mezuniyyet_Id']);
											?>	
										</td>
									</tr>	
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{ ?>
				<div class="row">
					<div class="over-y">
						Bazada Məzuniyyət Əmri Yoxdur
					</div>
				</div> 
			<?php }	?>
		</div>
	</div>
</div>
<?php require_once '_footer.php'; ?>
<script>
	CedveliCagir("dataTable");
</script>