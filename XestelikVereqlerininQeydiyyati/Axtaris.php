<?php 
require_once '../Ayarlar/setting.php';
if ($_POST) {

	$Xestelik_Baslagic_Tarixi  = TarixBeynelxalqCevir($_POST['Xestelik_Baslagic_Tarixi']);	
	$Xestelik_Ise_Cixma_Tarixi  = TarixBeynelxalqCevir($_POST['Xestelik_Ise_Cixma_Tarixi']);

	$Xestelik_Vereqi_No   =  EditorluIcerikleriFiltrle($_POST['Xestelik_Vereqi_No']); 
	$Adi   =  EditorluIcerikleriFiltrle($_POST['Adi']); 
	$Soyadi   =  EditorluIcerikleriFiltrle($_POST['Soyadi']); 
	$AtaAdi   =  EditorluIcerikleriFiltrle($_POST['AtaAdi']);
	$sql="SELECT * FROM xestelik_qeydiyyat WHERE Xestelik_Id>?";
	$dizi=array();
	$dizi[]=0;
	if ($Xestelik_Baslagic_Tarixi>0) {
		$sql.=" and Xestelik_Baslagic_Tarixi>=?";
		$dizi[]=$Xestelik_Baslagic_Tarixi;
	}

	if ($Xestelik_Ise_Cixma_Tarixi>0) {
		$sql.=" and Xestelik_Baslagic_Tarixi<=?";
		$dizi[]=$Xestelik_Ise_Cixma_Tarixi;
	}

	if (strlen($Adi)>0) {
		$sql.=" and Adi LIKE  ?";
		$dizi[]=$Adi."%";
	}

	if (strlen($Soyadi)>0) {
		$sql.=" and Soyadi LIKE  ?";
		$dizi[]=$Soyadi."%";
	}

	if (strlen($AtaAdi)>0) {
		$sql.=" and AtaAdi LIKE  ?";
		$dizi[]=$AtaAdi."%";
	}
	$Sor = $db->prepare($sql);	
	$Sor->execute($dizi);

	$Say=$Sor->rowCount();
	if ($Say>0) {?>
		<div class="row">
			<div class="over-y genislik">
				<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
					<thead class="">
						<tr>									
							<th>Adı,soyadı, ata adı</th>
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
								<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xestelik_Baslagic_Tarixi']) ?></td>										
								<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xestelik_Ise_Cixma_Tarixi']) ?></td>
								<td><?php echo $Cek['Xestelik_Gun']?></td>																															
								<td class="emeliyyatlar_sil_buttom"><?php echo SilButonu($Cek['Xestelik_Id']); ?></td>
							</tr>	
						<?php }	?>
					</tbody>
				</table>
			</div>
		</div>
	<?php }else{	?>
		<div class="row">
			<div class="over-y">
				Axtarışınıza uyğun nəticə tapılmadı
			</div>
		</div> 
	<?php }

}
?>