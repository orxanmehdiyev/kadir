<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                                              =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);	
	$Hevesledirme_Tedbirleri_Emrinin_Nomresi         =  EditorluIcerikleriFiltrle($deyer['Hevesledirme_Tedbirleri_Emrinin_Nomresi']); 
	$Hevesledirme_Tedbirleri_Sebeb                   =  EditorluIcerikleriFiltrle($deyer['Hevesledirme_Tedbirleri_Sebeb']); 
	$Heveslendirem_Tedbirleri_Ad_Id                  =  ReqemlerXaricButunKarakterleriSil($deyer['Heveslendirem_Tedbirleri_Ad_Id']); 

	$Tarixi            = $deyer['Hevesledirme_Tedbirleri_Tarix'];
	$Hevesledirme_Tedbirleri_Tarix  = TarixBeynelxalqCevir($deyer['Hevesledirme_Tedbirleri_Tarix']);

	$Heves_Ad_Sor=$db->prepare("SELECT * FROM  heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id ");
	$Heves_Ad_Sor->execute(array(
		'heveslendirem_tedbirleri_ad_id'=>$Heveslendirem_Tedbirleri_Ad_Id));
	$Heves_Ad_Cek=$Heves_Ad_Sor->fetch(PDO::FETCH_ASSOC);
	$Heves_Ad_Say=$Heves_Ad_Sor->rowCount();

	$Heveslendirem_Tedbirleri_Ad=$Heves_Ad_Cek['heveslendirem_tedbirleri_ad'];
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Soy_Adi=$User_Cek['Soy_Adi'];
	$Adi=$User_Cek['Adi'];
	$Ata_Adi=$User_Cek['Ata_Adi'];
	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif ($Heves_Ad_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Heveslendirem_Tedbirleri_Ad_Id">';
		echo '<input type="hidden" id="message" value="Həvəsləndirmə növünü secin">';
		exit;
	}elseif ($Hevesledirme_Tedbirleri_Emrinin_Nomresi=="") {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Hevesledirme_Tedbirleri_Emrinin_Nomresi">';
		echo '<input type="hidden" id="message" value="Əmrin nömrəsini qeyd edin">';
		exit;
	}elseif ($Hevesledirme_Tedbirleri_Sebeb=="") {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Hevesledirme_Tedbirleri_Sebeb">';
		echo '<input type="hidden" id="message" value="Səbəb yazın">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($deyer['Hevesledirme_Tedbirleri_Tarix'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Hevesledirme_Tedbirleri_Tarix">';
		echo '<input type="hidden" id="message" value="Tarixi secin">';
		exit;
	}else{
		$Elave_Et=$db->prepare("INSERT INTO hevesledirme_tedbirleri SET                               
			Ata_Adi=:Ata_Adi,		
			Adi=:Adi,		
			Soy_Adi=:Soy_Adi,		
			ID=:ID,		
			Heveslendirem_Tedbirleri_Ad_Id=:Heveslendirem_Tedbirleri_Ad_Id,		
			Heveslendirem_Tedbirleri_Ad=:Heveslendirem_Tedbirleri_Ad,		
			Hevesledirme_Tedbirleri_Sebeb=:Hevesledirme_Tedbirleri_Sebeb,		
			Hevesledirme_Tedbirleri_Tarix=:Hevesledirme_Tedbirleri_Tarix,		
			Hevesledirme_Tedbirleri_Emrinin_Nomresi=:Hevesledirme_Tedbirleri_Emrinin_Nomresi			
			");
		$Insert=$Elave_Et->execute(array(                                
			'Ata_Adi'=>$Ata_Adi,			
			'Adi'=>$Adi,			
			'Soy_Adi'=>$Soy_Adi,			
			'ID'=>$ID,			
			'Heveslendirem_Tedbirleri_Ad_Id'=>$Heveslendirem_Tedbirleri_Ad_Id,			
			'Heveslendirem_Tedbirleri_Ad'=>$Heveslendirem_Tedbirleri_Ad,			
			'Hevesledirme_Tedbirleri_Sebeb'=>$Hevesledirme_Tedbirleri_Sebeb,			
			'Hevesledirme_Tedbirleri_Tarix'=>$Hevesledirme_Tedbirleri_Tarix,			
			'Hevesledirme_Tedbirleri_Emrinin_Nomresi'=>$Hevesledirme_Tedbirleri_Emrinin_Nomresi					
		));
		if ($Insert) {
			$Hevesledirme_Tedbirleri_Id=$db->lastInsertId();
			if ($Heveslendirem_Tedbirleri_Ad_Id==4) {
				$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC ");
				$Rutbe_Emri_Sor->execute(array(
					'ID'=>$ID));
				$Rutbe_Emri_Say=$Rutbe_Emri_Sor->rowCount();
				$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
				$Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];

				$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
				$Rutbe_Sor->execute(array(
					'Rutbe_Id'=>$Rutbe_Id));
				$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
				$Rutbe_Xidmet_Ili=$Rutbe_Cek['Rutbe_Xidmet_Ili'];
				$Novbeti_Rutbe_Sira_No=$Rutbe_Cek['Rutbe_Sira_No']+1;

				$Novbeti_Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Sira_No=:Rutbe_Sira_No");
				$Novbeti_Rutbe_Sor->execute(array(
					'Rutbe_Sira_No'=>$Novbeti_Rutbe_Sira_No));
				$Novbeti_Rutbe_Cek=$Novbeti_Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
				$Novbeti_Rutbe_Id=$Novbeti_Rutbe_Cek['Rutbe_Id'];
				$Novbeti_Rutbe_Adi=$Novbeti_Rutbe_Cek['Rutbe_Adi'];

				$Elave_Et=$db->prepare("INSERT INTO  rutbe_emri SET                               
					ID=:ID,		
					Rutbe_Id=:Rutbe_Id,		
					Rutbe_Adi=:Rutbe_Adi,	
					Rutbe_Emri_Qeyd=:Rutbe_Emri_Qeyd,	
					Rutbe_Emri_Novu=:Rutbe_Emri_Novu,	
					Rutbe_Emri_Tarixi=:Rutbe_Emri_Tarixi,				
					Rutbe_Emrinin_No=:Rutbe_Emrinin_No,
					Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id
					");
				$Insert=$Elave_Et->execute(array(                                
					'ID'=>$ID,			
					'Rutbe_Id'=>$Novbeti_Rutbe_Id,			
					'Rutbe_Adi'=>$Novbeti_Rutbe_Adi,		
					'Rutbe_Emri_Qeyd'=>$Hevesledirme_Tedbirleri_Sebeb,		
					'Rutbe_Emri_Novu'=>3,		
					'Rutbe_Emri_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,			
					'Rutbe_Emrinin_No'=>$Hevesledirme_Tedbirleri_Emrinin_Nomresi,
					'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id
				));
			}


			if ($Heveslendirem_Tedbirleri_Ad_Id==6) {
				$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC ");
				$Rutbe_Emri_Sor->execute(array(
					'ID'=>$ID));
				$Rutbe_Emri_Say=$Rutbe_Emri_Sor->rowCount();
				$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
				$Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];

				$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
				$Rutbe_Sor->execute(array(
					'Rutbe_Id'=>$Rutbe_Id));
				$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
				$Rutbe_Xidmet_Ili=$Rutbe_Cek['Rutbe_Xidmet_Ili'];
				$Novbeti_Rutbe_Sira_No=$Rutbe_Cek['Rutbe_Sira_No']+1;

				$Novbeti_Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Sira_No=:Rutbe_Sira_No");
				$Novbeti_Rutbe_Sor->execute(array(
					'Rutbe_Sira_No'=>$Novbeti_Rutbe_Sira_No));
				$Novbeti_Rutbe_Cek=$Novbeti_Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
				$Novbeti_Rutbe_Id=$Novbeti_Rutbe_Cek['Rutbe_Id'];
				$Novbeti_Rutbe_Adi=$Novbeti_Rutbe_Cek['Rutbe_Adi'];

				$Elave_Et=$db->prepare("INSERT INTO  rutbe_emri SET                               
					ID=:ID,		
					Rutbe_Id=:Rutbe_Id,		
					Rutbe_Adi=:Rutbe_Adi,	
					Rutbe_Emri_Qeyd=:Rutbe_Emri_Qeyd,	
					Rutbe_Emri_Novu=:Rutbe_Emri_Novu,	
					Rutbe_Emri_Tarixi=:Rutbe_Emri_Tarixi,				
					Rutbe_Emrinin_No=:Rutbe_Emrinin_No,
					Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id
					");
				$Insert=$Elave_Et->execute(array(                                
					'ID'=>$ID,			
					'Rutbe_Id'=>$Novbeti_Rutbe_Id,			
					'Rutbe_Adi'=>$Novbeti_Rutbe_Adi,		
					'Rutbe_Emri_Qeyd'=>$Hevesledirme_Tedbirleri_Sebeb,		
					'Rutbe_Emri_Novu'=>4,		
					'Rutbe_Emri_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix,			
					'Rutbe_Emrinin_No'=>$Hevesledirme_Tedbirleri_Emrinin_Nomresi,
					'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id
				));
			}

			if ($Heveslendirem_Tedbirleri_Ad_Id==7) {
				$Intizam_Sor=$db->prepare("SELECT * FROM  intizam_tenbehi where ID=:ID order by Intizam_Tenbehinin_Bitis_Tarixi DESC");
				$Intizam_Sor->execute(array(
					'ID'=>$ID));
				$Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC);
				$Intizam_Tenbehi_Id=$Intizam_Cek['Intizam_Tenbehi_Id'];
				$Intizam_Tenbehinin_Bitis_Tarixi=$Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'];

				$Elave_Et=$db->prepare("UPDATE  intizam_tenbehi SET                               
					Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi,	
					Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id	
					where Intizam_Tenbehi_Id=$Intizam_Tenbehi_Id
					");
				$Insert=$Elave_Et->execute(array(                                
					'Intizam_Tenbehinin_Bitis_Tarixi'=>$Hevesledirme_Tedbirleri_Tarix	,
					'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id	
				));


				$Elave_Et=$db->prepare("UPDATE  hevesledirme_tedbirleri SET                               
					Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi	
					where Hevesledirme_Tedbirleri_Id=$Hevesledirme_Tedbirleri_Id
					");
				$Insert=$Elave_Et->execute(array(                                
					'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Tenbehinin_Bitis_Tarixi	
				));
			}



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
	}

}else{
	header("Location:../heveslendirme_tedbirleri.php");
	exit;
}
?>


<!-- 



 -->