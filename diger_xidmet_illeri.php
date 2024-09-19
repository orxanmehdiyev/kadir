<?php require_once '_header.php'; ?>
<script type="text/javascript" src="DigerXidmetIlleri/Script.js"></script>		
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
			$Sor=$db->prepare("SELECT * FROM diger_xidmet_illeri order by ID ASC, Diger_Xidmet_Ili_Id  DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr style="vertical-align: middle;">									
									<th>Adı,soyadı</th>
									<th>İdarə</th>				
									<th>Vəzifə</th>
									<th>Qəbul tarixi</th>
									<th>Azad olma tarixi</th>									
									<th>İl</th>									
									<th>Ay</th>									
									<th>Gün</th>									
									<th class="Vezife_Adlari_Durum_Kapsama">Xidmet iline daxilet</th>									
									<th class="emeliyyatlar_iki_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {

									$d1 = new DateTime($Cek['Qebul_Tarixi']);
									$d2 = new DateTime($Cek['Azad_Olma_Tarixi']);

									$il=$d1->diff($d2)->y; 
									$ay= $d1->diff($d2)->m; 
									$gun=$d1->diff($d2)->d;
									?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo $Cek['Orqanin_Adi'];?></td>
										<td><?php echo $Cek['Vezifesi'];?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Qebul_Tarixi']) ?></td>	
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Azad_Olma_Tarixi']) ?></td>							
										<td><?php echo $Cek['il'] ?></td>
										<td><?php echo $Cek['ay'] ?></td>
										<td><?php echo $Cek['gun'] ?></td>
										<td class="Vezife_Adlari_Durum_Kapsama">											
											<label class="checkbox">
												<input 
												<?php 
												if ($Cek['Xidmet_Iline_Daxil_Et']==1) {
													echo  "checked";
												}else{}
												?>
												type="checkbox" id="nezerealam_<?php echo $Cek['Diger_Xidmet_Ili_Id'] ?>" onchange="DaxilEt(this.id)" > 
												<span class="checkbox"> 
													<span></span>
												</span>
											</label>
											
										</td>																															
										<td class="emeliyyatlar_iki_buttom"><?php echo DuzenleButonu($Cek['Diger_Xidmet_Ili_Id']).SilButonu($Cek['Diger_Xidmet_Ili_Id']); ?></td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada təhkim əmri yoxdur
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