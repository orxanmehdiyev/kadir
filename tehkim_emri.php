<?php require_once '_header.php'; ?>
<script type="text/javascript" src="TehkimEmri/Script.js"></script>		
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
			$Sor=$db->prepare("SELECT * FROM tehkim_emri order by Baslangic_Tarixi DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı</th>
									<th>İdarə</th>
									<th>Bölmə</th>
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
										<td>
											<?php 
											$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
											$Idare_Sor->execute(array(
												'Idare_Id'=>$Cek['Idare_Id']));
											$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
											echo $Idare_Cek['Idare_Kissa_Adi'];
											?>											
										</td>
													<td>
											<?php 
											$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id");
											$Sobe_Sor->execute(array(
												'Sobe_Id'=>$Cek['Sobe_Id']));
											$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
											echo $Sobe_Cek['Sobe_Ad'];
											?>											
										</td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Baslangic_Tarixi']) ?></td>										
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Bitis_Tarixi']) ?></td>
										<td><?php echo $Cek['Emir_No']?></td>																															
										<td class="emeliyyatlar_sil_buttom"><?php echo SilButonu($Cek['Tehkim_Emri_Id']); ?></td>
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