<?php require_once '_header.php';?>
<script type="text/javascript" src="Atestasiya/Script.js"></script>		
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
			$Sor=$db->prepare("SELECT * FROM  attestasiya_emri order by Attestasiya_Tarix DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Adı,soyadı</th>									
									<th>Tarixi</th>
									<th>Qərar</th>
									<th>Növbəti tarix</th>
									<th>Əmir №</th>
									<th>Topladığı bal</th>
									<th>Qiymətləndirməsi</th>						
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php	while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { 
									if ($Cek['Attestasiya_Qerar']==0) {
										$Attestasiya_Qerar="Tutduğu vəzifəyə uyğundur";
									}elseif ($Cek['Attestasiya_Qerar']==1) {
										$Attestasiya_Qerar="İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur";
									}elseif ($Cek['Attestasiya_Qerar']==2) {
										$Attestasiya_Qerar="Tutduğu vəzifəyə şərtli uyğun deyil";
									}
									?>
									<tr>	
										<td><?php echo  AdiSoyadiAtaadi($Cek['ID'], $db);	?></td>
										<td><?php echo date("d.m.Y",strtotime($Cek['Attestasiya_Tarix']))?></td>
										<td><?php echo $Attestasiya_Qerar ?></td>
										<td><?php echo date("d.m.Y",strtotime($Cek['Attestasiya_Tarix_Novbeti']))?></td>															
										<td><?php echo $Cek['Attestasiya_Emr_No'] ?></td>
										<td><?php echo $Cek['Topladigi_Bal'] ?></td>								
										<td><?php echo $Cek['Qiymetlendirme_Bali'] ?></td>			
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
						Bazada attestasiya əmri yoxdur
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
</div>
<?php require_once '_footer.php';?>
<script> CedveliCagir("dataTable");</script>