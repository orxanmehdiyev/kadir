<?php require_once '_header.php'; ?>
<script type="text/javascript" src="XidmeIlineElavelerinVerilmesi/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2 row" style="width:400px;">						
						<div class="col-2" style="width:120px;">
							<label for="Tedbiq_Tarixi" style="width: 206px" class="form-label">Tarix<span class="KirmiziYazi">*</span></label>
							<input type="text" class="form-control pickmeup_1 tarix" autocomplete="off" id="Tedbiq_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  placeholder="__.__._____" required="required" maxlength="255" tabindex="5" title="">
						</div>						
						<div class="col-2">
							<button class="YenileButonlari buttonlabelsevyesine" onclick="Xidmetiliyoxla()">Yoxla</button>
						</div>

					</div>
					<div class="p-2" id="cavabid" style="width:400px;"></div>
					<div class="p-2">						
						<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>
					</div>
				</div>				
			</div>
		</div>	

		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM xidmet_iline_elave order by Emrin_Tarixi DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı</th>
									<th>Əlavə verilmə tarixi</th>
									<th>Əlavə %</th>
									<th>Əmrin Tarixi</th>
									<th>Əmir no</th>
									<th class="emeliyyatlar_iki_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Iline_Elave_Verilme_tarixi']) ?></td>										
										<td><?php echo $Cek['Xidmet_Iline_Elave'] ?></td>										
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Emrin_Tarixi']) ?></td>
										<td><?php echo $Cek['Emir_No']?></td>																															
										<td class="emeliyyatlar_iki_buttom">
											<?php 
											$Sor_Xidmet=$db->prepare("SELECT * FROM xidmet_iline_elave where ID=:ID order by  Xidmet_Iline_Elave_Verilme_tarixi DESC");
											$Sor_Xidmet->execute(array(
												'ID'=>$Cek['ID']
											));
											$Sor_Xidmet_Cek=$Sor_Xidmet->fetch(PDO::FETCH_ASSOC);
											if ($Sor_Xidmet_Cek['Xidmet_Iline_Elave_Verilme_tarixi']==$Cek['Xidmet_Iline_Elave_Verilme_tarixi']) {
												echo DuzenleButonu($Cek['Xidmet_Iline_Elave_Id']).SilButonu($Cek['Xidmet_Iline_Elave_Id']); 
											}
											
											?>	
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
						Xidmət ilinə əlavə əmri yoxdur
					</div>
				</div> 
			<?php 	}	
			?>

		</div>
		<div class="card-body" id="yoxlanis"></div>	
	</div>
</div>
<?php require_once '_footer.php';?>
<script>
	CedveliCagir("dataTable");
</script>