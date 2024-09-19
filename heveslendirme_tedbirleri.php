<?php require_once '_header.php'; ?>
<script type="text/javascript" src="Heveslendireme_Tedbirleri/Script.js"></script>		
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
			$Sor=$db->prepare("SELECT * FROM hevesledirme_tedbirleri order by Hevesledirme_Tedbirleri_Tarix DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı</th>
									<th>Həvəsləndirmə tədbiri</th>
									<th>Səbəb</th>
									<th class="tarixsutunu">Tarix</th>
									<th>Əmrin №</th>
									<th class="emeliyyatlar_sil_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo $Cek['Heveslendirem_Tedbirleri_Ad']?></td>
										<td><?php echo $Cek['Hevesledirme_Tedbirleri_Sebeb']?></td>
											<td data-sort="<?php echo $Cek['Hevesledirme_Tedbirleri_Tarix'] ?>" class="textaligncenter"><?php echo TarixAzCevir($Cek['Hevesledirme_Tedbirleri_Tarix']);?></td>								
										<td><?php echo $Cek['Hevesledirme_Tedbirleri_Emrinin_Nomresi']?></td>																															
										<td class="emeliyyatlar_sil_buttom"><?php echo SilButonu($Cek['Hevesledirme_Tedbirleri_Id']); ?></td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
					Bazada hƏvəsləndirmə əmri yoxdur
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
</div>
<?php 
require_once '_footer.php';
?>
<script>
	CedveliCagir("dataTable");
</script>