<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Diger_Teltif_Id                 =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$sil = $db->prepare("DELETE from diger_teltiflerin_qeydiyyati where Diger_Teltif_Id=:Diger_Teltif_Id");
	$kontrol = $sil->execute(array(
		'Diger_Teltif_Id' => $Diger_Teltif_Id
	));
	if ($kontrol) {
		echo '<input type="hidden" id="status" value="succes">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
		echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat silindi</span>">';
		$Sor=$db->prepare("SELECT * FROM diger_teltiflerin_qeydiyyati order by Teltif_Tarixi DESC");
		$Sor->execute();
		$Say=$Sor->rowCount();
		if ($Say>0) {?>
			<div class="row">
				<div class="over-y genislik">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>									
								<th>Adı,soyadı</th>
								<th>Təltifin adı</th>
								<th>Təltif edən orqan</th>
								<th>Təltif tarixi</th>
								<th>Qeyd</th>
								<th class="emeliyyatlar_sil_buttom">Sil</th>																							
							</tr>
						</thead>
						<tbody id="list" class="table_ici">
							<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
								<tr>	
									<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
									<td><?php echo $Cek['Teltifin_Adi'] ?></td>										
									<td><?php echo $Cek['Teltif_Eden_Orqan'] ?></td>										
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Teltif_Tarixi']) ?></td>
									<td><?php echo $Cek['Qeyd']?></td>																															
									<td class="emeliyyatlar_sil_buttom"><?php echo SilButonu($Cek['Diger_Teltif_Id']); ?></td>
								</tr>	
							<?php }	?>
						</tbody>
					</table>
				</div>
			</div>
		<?php }else{	?>
			<div class="row">
				<div class="over-y">
					Təltif yoxdur
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