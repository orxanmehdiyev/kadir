<?php require_once '_header.php';
if ($XidmeteXitamVerilmesiMensusu==1) {
	?>
	<script type="text/javascript" src="XitamSebebleri/Script.js"></script>		
	<div  class="mt-2">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="d-flex  justify-content-between">
						<div class="p-2"></div>
						<div class="p-2" id="cavabid"></div>
						<div class="p-2">
							<?php if ($XidmeteXitamVerilmesiYeni==1): ?>
								<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>	
							<?php endif ?>

						</div>
					</div>				
				</div>
			</div>		
			<div class="card-body" id="icerik">
				<?php 
				$Sor=$db->prepare("SELECT * FROM xitam_sebebleri order by xitam_sebebleri_id ASC");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
								<thead class="">
									<tr>									
										<th>Adı</th>
										<th>Kısa adı</th>
										<?php if ($XidmeteXitamVerilmesisSebebiSil==1 or $XidmeteXitamVerilmesisSebebiDuzelis==1): ?>
											<th class="emeliyyatlar_iki_buttom">Əməliyatlar</th>		
										<?php endif ?>																															
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<tr>	
											<td><?php echo $Cek['xitam_sebebleri_ad'];?></td>					
											<td><?php echo $Cek['xitam_sebebleri_kisa_ad'] ?></td>
											<?php if ($XidmeteXitamVerilmesisSebebiSil==1 or $XidmeteXitamVerilmesisSebebiDuzelis==1): ?>	
												<td class="emeliyyatlar_iki_buttom">
													<?php 
													if ($XidmeteXitamVerilmesisSebebiSil==1) {
														echo SilButonu($Cek['xitam_sebebleri_id']);
													}
													if ($XidmeteXitamVerilmesisSebebiDuzelis==1) {
														echo  DuzenleButonu($Cek['xitam_sebebleri_id']); 
													}			
												?></td>
											<?php endif ?>
										</tr>	
									<?php }	?>
								</tbody>
							</table>
						</div>
					</div>
				<?php }else{	?>
					<div class="row">
						<div class="over-y">
							Bazada xitam səbəbi yoxdur
						</div>
					</div> 
				<?php 	}	?>
			</div>
		</div>
	</div>
	<?php 
} 
require_once '_footer.php';?>