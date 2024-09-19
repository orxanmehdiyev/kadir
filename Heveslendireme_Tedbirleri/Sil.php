<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {	
	$Hevesledirme_Tedbirleri_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Heveslendirme_Sor=$db->prepare("SELECT * FROM hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id");
	$Heveslendirme_Sor->execute(array(
		'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id));
	$Heveslendirme_Cek=$Heveslendirme_Sor->fetch(PDO::FETCH_ASSOC);
	$Intizam_Tenbehinin_Bitis_Tarixi=$Heveslendirme_Cek['Intizam_Tenbehinin_Bitis_Tarixi'];


	$sil = $db->prepare("DELETE from hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id ");
	$kontrol = $sil->execute(array(
		'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id
	));	
	$sil = $db->prepare("DELETE from rutbe_emri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id ");
	$kontrol = $sil->execute(array(
		'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id
	));	
$bos="";
	$Elave_Et=$db->prepare("UPDATE  intizam_tenbehi SET                               
		Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi,	
		Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id	
		where Hevesledirme_Tedbirleri_Id=$Hevesledirme_Tedbirleri_Id
		");
	$Insert=$Elave_Et->execute(array(                                
		'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Tenbehinin_Bitis_Tarixi	,
		'Hevesledirme_Tedbirleri_Id'=>$bos	
	));


	if ($kontrol) {

		echo '<input type="hidden" id="status" value="succes">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="<span class=\'Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';			
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
								<th>Tarixi</th>
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
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Hevesledirme_Tedbirleri_Tarix']) ?></td>
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
		<?php 	}	

	}else{
		echo '<input type="hidden" id="status" value="succes">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="<span class=\'Ugursuz\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';	
	}
	

}else{
	header("Location:../heveslendirme_tedbirleri.php");
	exit;
}
?>
