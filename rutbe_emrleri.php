<?php require_once '_header.php'; ?>
<script type="text/javascript" src="Rutbe_Emirleri/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
						<button class="YenileButonlari" onclick="Novbeti_Verilmesi()" type="button">Yeni</button>										
					</div>
				</div>				
			</div>
		</div>		
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM rutbe_emri order by Rutbe_Emri_Tarixi DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı</th>
									<th>Rütbə</th>
									<th>Səbəb</th>
									<th>Tarixi</th>
									<th>Əmir №</th>							
									<th class="emeliyyatlar_sil_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									if ($Cek['Rutbe_Emri_Novu']==1) {
										$Rutbe_Emri_Novu="İlkin xüsusi rütbənin verilməsi";
									}elseif ($Cek['Rutbe_Emri_Novu']==2) {
										$Rutbe_Emri_Novu="Növbəti xüsusi rütbənin verilməsi";
									}elseif ($Cek['Rutbe_Emri_Novu']==3) {
										$Rutbe_Emri_Novu="Vaxdindan əvvəl xüsusi rütbənin verilməsi";
									}elseif ($Cek['Rutbe_Emri_Novu']==4) {
										$Rutbe_Emri_Novu="Tutduğu vəzifədən yuxarı xüsusi rütbənin verixlməsi";
									}elseif ($Cek['Rutbe_Emri_Novu']==5) {
										$Rutbe_Emri_Novu="İntizam tənbehi ilə rütbənin aşağı salınması";
									}elseif ($Cek['Rutbe_Emri_Novu']==6) {
										$Rutbe_Emri_Novu="Ali xüsusi rütbənin verilməsi";
									}
									?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo $Cek['Rutbe_Adi'] ?></td>
										<td><?php echo $Rutbe_Emri_Novu ?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Rutbe_Emri_Tarixi']) ?></td>
										<td><?php echo $Cek['Rutbe_Emrinin_No'] ?></td>	
										<?php 
										$NovbetiSor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
										$NovbetiSor->execute(array(
											'ID'=>$Cek['ID']));
										$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
										?>																									
										<td class="emeliyyatlar_sil_buttom">
											<?php
											if($NovbetiCek['Rutbe_Emri_Tarixi']==$Cek['Rutbe_Emri_Tarixi']){
												echo SilButonu($Cek['Rutbe_Emri_Id']);
											}else{}
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