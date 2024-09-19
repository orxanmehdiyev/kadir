<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Xidmet_Iline_Elave_Id                 =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$sil = $db->prepare("DELETE from xidmet_iline_elave where Xidmet_Iline_Elave_Id=:Xidmet_Iline_Elave_Id");
	$kontrol = $sil->execute(array(
		'Xidmet_Iline_Elave_Id' => $Xidmet_Iline_Elave_Id
	));
	if ($kontrol) {
		
		echo '<input type="hidden" id="status" value="succes">';
		echo '<input type="hidden" id="statusiki" value="Emrin_Tarixi">';
		echo '<input type="hidden" id="message" value="<span class=\'Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
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
								<th> Əmrin Tarixi</th>
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


		
	}else{
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Rutbe_Id">';
		echo '<input type="hidden" id="message" value="Məlumat qeydə alınmadı">';
		exit;
	}
	
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>