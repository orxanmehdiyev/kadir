<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Mezuniyyet_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);	
	$sil = $db->prepare("DELETE from mezuniyyet where Mezuniyyet_Id=:Mezuniyyet_Id");
	$kontrol = $sil->execute(array(
		'Mezuniyyet_Id' => $Mezuniyyet_Id
	));	
	if ($kontrol) {		
		echo '<input type="hidden" id="status" value="success">';
		$Sor=$db->prepare("SELECT * FROM mezuniyyet order by Baslagic_Tarixi DESC  limit 30");
		$Sor->execute();
		$Say=$Sor->rowCount();
		if ($Say>0) {?>
			<div class="row">
				<div class="over-y genislik">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>
								<th>Adı,soyadı</th>
								<th>Xidmət ili</th>
								<th>Xidmət ili</th>
								<th>Məzuniyyətin növü</th>
								<th>Gün</th>
								<th>Başlanğıc Tarixi</th>
								<th>Bitiş Tarixi</th>
								<th>İşə çıxma Tarixi</th>
								<th>Əmrin nömrəsi</th>
								<th>Əməliyyatlar</th>																							
							</tr>
						</thead>
						<tbody id="list" class="table_ici">
							<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { ?>
								<tr>
									<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db) ?></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Baslagic']) ?></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Son']) ?></td>
									<td><?php echo $Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>
									<td><?php echo $Cek['Mezuniyyet_Gun'] ?></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Baslagic_Tarixi']) ?></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Bitis_Tarixi']) ?></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Cixma_Tarixi']) ?></td>
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
		<?php }else{	?>
			<div class="row">
				<div class="over-y">
					Bazada Məzuniyyət Əmri Yoxdur
				</div>
			</div> 
		<?php }				
	}else{
		echo '<input type="hidden" id="status" value="errorfull">';			
		echo '<input type="hidden" id="message" value="Xeta baş verdi sistem idarəcisinə məlumat verin">'	;
		exit;
	}
}else{
	header("Location:../mezuniyyet_emri");
	exit;
}
?>