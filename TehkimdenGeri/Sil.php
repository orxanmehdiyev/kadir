<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Tehkim_Geri_Id                 =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Tehkim_Geri_Sor=$db->prepare("SELECT * FROM tehkimden_geri_emri where Tehkim_Geri_Id=:Tehkim_Geri_Id");
	$Tehkim_Geri_Sor->execute(array(
		'Tehkim_Geri_Id'=>$Tehkim_Geri_Id));
	$Tehkim_Geri_Cek=$Tehkim_Geri_Sor->fetch(PDO::FETCH_ASSOC);
	$Tehkim_Emri_Id=$Tehkim_Geri_Cek['Tehkim_Emri_Id'];
	$Bitis_Tarixi=$Tehkim_Geri_Cek['Bitis_Tarixi'];
	
	$yenile=$db->prepare("UPDATE tehkim_emri SET 
		Bitis_Tarixi=:Bitis_Tarixi
		WHERE Tehkim_Emri_Id=$Tehkim_Emri_Id");
	$update=$yenile->execute(array(
		'Bitis_Tarixi'=>$Bitis_Tarixi
	));


	$sil = $db->prepare("DELETE from tehkimden_geri_emri where Tehkim_Geri_Id=:Tehkim_Geri_Id");
	$kontrol = $sil->execute(array(
		'Tehkim_Geri_Id' => $Tehkim_Geri_Id
	));
	if ($kontrol) {
		echo '<input type="hidden" id="status" value="succes">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
		echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
		$Sor=$db->prepare("SELECT * FROM tehkimden_geri_emri order by Tehkim_Geri_Tarix DESC");
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
								<th>Əmir No</th>
								<th class="emeliyyatlar_sil_buttom">Sil</th>																							
							</tr>
						</thead>
						<tbody id="list" class="table_ici">
							<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
								<tr>		
									<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>																	
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Tehkim_Geri_Tarix']) ?></td>
									<td><?php echo $Cek['Emrin_No']?></td>																															
									<td class="emeliyyatlar_sil_buttom"><?php echo SilButonu($Cek['Tehkim_Geri_Id']); ?></td>
								</tr>	
							<?php }	?>
						</tbody>
					</table>
				</div>
			</div>
		<?php }else{	?>
			<div class="row">
				<div class="over-y">
					Bazada təhkimdən geri əmri yoxdur
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