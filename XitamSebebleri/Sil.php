<?php 
require_once '../Ayarlar/setting.php';
if ($XidmeteXitamVerilmesisSebebiSil==1) {
if (isset($_POST['Deyer'])) {
	$xitam_sebebleri_id                 =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$sil = $db->prepare("DELETE from  xitam_sebebleri where xitam_sebebleri_id=:xitam_sebebleri_id");
	$kontrol = $sil->execute(array(
		'xitam_sebebleri_id' => $xitam_sebebleri_id
	));
	if ($kontrol) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="xitam_sebebleri_ad">';
			echo '<input type="hidden" id="message" value="<span class=\'Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
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
			<?php 	}			
	}else{		
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="xitam_sebebleri_ad">';
			echo '<input type="hidden" id="message" value="<span class=\'Ugursuz\'><i class=\'fas fa-check\'></i> Silinmə uğursuz</span>">';
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
			<?php 	}	

		
	
	}
	
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
}
?>