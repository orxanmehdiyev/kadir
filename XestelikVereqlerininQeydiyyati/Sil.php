<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Xestelik_Id                 =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$sil = $db->prepare("DELETE from xestelik_qeydiyyat where Xestelik_Id=:Xestelik_Id");
	$kontrol = $sil->execute(array(
		'Xestelik_Id' => $Xestelik_Id
	));
	if ($kontrol) {
		echo '<input type="hidden" id="status" value="succes">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
		echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
		$Sor=$db->prepare("SELECT * FROM xestelik_qeydiyyat order by Xestelik_Baslagic_Tarixi DESC");
		$Sor->execute();
		$Say=$Sor->rowCount();
		if ($Say>0) {?>
			<div class="row">
				<div class="over-y genislik">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>									
								<th>Adı,soyadı</th>
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
					Bazada rütbə əmri yoxdur
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