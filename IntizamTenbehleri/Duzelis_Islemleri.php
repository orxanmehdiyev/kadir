<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                                         =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Intizam_Tenbehi_Id                         =  ReqemlerXaricButunKarakterleriSil($deyer['Intizam_Tenbehi_Id']); 
	$intizam_tenbehi_adlari_id                  =  ReqemlerXaricButunKarakterleriSil($deyer['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id']); 
	$Intizam_Tenbehi_Sebeb                      =  EditorluIcerikleriFiltrle($deyer['Intizam_Tenbehi_Sebeb']); 
	$Intizam_Tenbehi_Emrinin_Nomresi            =  EditorluIcerikleriFiltrle($deyer['Intizam_Tenbehi_Emrinin_Nomresi']); 
	$Tarixi                                     =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']); 
	$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix   =  TarixBeynelxalqCevir($Tarixi);
	$Intizam_Tenbehinin_Bitis_Tarixi            =  Traix_Uzerine_Gel($Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,6,"month");
	$TarixAzcevir                  =  TarixAzCevir($deyer['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();

	$intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id ");
	$intizam_Sor->execute(array(
		'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id));
	$intizam_Say=$intizam_Sor->rowCount();
	$intizam_Cek=$intizam_Sor->fetch(PDO::FETCH_ASSOC);
	$Movcut_intizam_tenbehi_adlari_id=$intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'];
	if ($Movcut_intizam_tenbehi_adlari_id==6) {
		$sil = $db->prepare("DELETE from rutbe_emri where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
		$kontrol = $sil->execute(array(
			'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
		));	
	}

	$AD_Sor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari where intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id");
	$AD_Sor->execute(array(
		'intizam_tenbehi_adlari_id'=>$intizam_tenbehi_adlari_id));
	$AD_Say=$AD_Sor->rowCount();
	$AD_Cek=$AD_Sor->fetch(PDO::FETCH_ASSOC);

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($intizam_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id">';
		echo '<input type="hidden" id="message" value="Melumat tapilmadi">';
		exit;
	}elseif($AD_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id">';
		echo '<input type="hidden" id="message" value="Tənbeh növü düzgün seçilməyib">';
		exit;
	}elseif($Intizam_Tenbehi_Sebeb==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehi_Sebeb">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin səbəbi qeyd edilməyib">';
		exit;
	}elseif($Intizam_Tenbehi_Emrinin_Nomresi==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehi_Emrinin_Nomresi">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin əmrinin nömrəsi qeyd edilməyib">';
		exit;
	}elseif($TarixAzcevir!=$Tarixi){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarixi düzgün qeyd edilməyib">';
		exit;
	}elseif($Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<$Tarix_Beynelxalq){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarix faktiki tarixdən kiçik ola bilməz">';
		exit;
	}else{
		$Elave_Et=$db->prepare("UPDATE intizam_tenbehi SET
			Intizam_Tenbehi_Emrinin_Nomresi=:Intizam_Tenbehi_Emrinin_Nomresi, 
			Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix, 
			Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi, 
			Intizam_Tenbehi_Sebeb=:Intizam_Tenbehi_Sebeb, 
			Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad, 
			Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id, 
			ID=:ID
			WHERE Intizam_Tenbehi_Id=$Intizam_Tenbehi_Id
			");
		$Insert=$Elave_Et->execute(array(
			'Intizam_Tenbehi_Emrinin_Nomresi'=>$Intizam_Tenbehi_Emrinin_Nomresi,
			'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,  
			'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Tenbehinin_Bitis_Tarixi,   
			'Intizam_Tenbehi_Sebeb'=>$Intizam_Tenbehi_Sebeb,  
			'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'=>$AD_Cek['intizam_tenbehi_adlari_ad'],  
			'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>$intizam_tenbehi_adlari_id,  
			'ID'=>$ID							
		));
		if ($Insert) {
			$Elave_Et=$db->prepare("INSERT INTO intizam_tenbehi_islemleri SET
				Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id, 
				Admin_Id=:Admin_Id, 
				IPAdresi=:IPAdresi, 
				TarixSaat=:TarixSaat, 
				ZamanDamgasi=:ZamanDamgasi, 
				Intizam_Tenbehi_Emrinin_Nomresi=:Intizam_Tenbehi_Emrinin_Nomresi,
				Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix, 
				Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi, 
				Intizam_Tenbehi_Sebeb=:Intizam_Tenbehi_Sebeb, 
				Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad, 
				Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id, 
				ID=:ID
				");
			$Insert=$Elave_Et->execute(array(
				'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id,  
				'Admin_Id'=>$Admin_Id,  
				'IPAdresi'=>$IPAdresi,  
				'TarixSaat'=>$TarixSaat,  
				'ZamanDamgasi'=>$ZamanDamgasi,  
				'Intizam_Tenbehi_Emrinin_Nomresi'=>$Intizam_Tenbehi_Emrinin_Nomresi,
				'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,  
				'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Tenbehinin_Bitis_Tarixi,   
				'Intizam_Tenbehi_Sebeb'=>$Intizam_Tenbehi_Sebeb,  
				'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'=>$AD_Cek['intizam_tenbehi_adlari_ad'],  
				'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>$intizam_tenbehi_adlari_id,  
				'ID'=>$ID							
			));

			if ($intizam_tenbehi_adlari_id==6) {
				$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC ");
				$Rutbe_Emri_Sor->execute(array(
					'ID'=>$ID
				));
				$Rutbe_Emri_Say=$Rutbe_Emri_Sor->rowCount();
				if ($Rutbe_Emri_Say>0) {
					$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
					$Movcut_Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];


					$Rutbe_Adi_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
					$Rutbe_Adi_Sor->execute(array(
						'Rutbe_Id'=>$Movcut_Rutbe_Id));
					$Rutbe_Adi_Cek=$Rutbe_Adi_Sor->fetch(PDO::FETCH_ASSOC);
					$Rutbe_Sira_No=$Rutbe_Adi_Cek['Rutbe_Sira_No']-1;


					$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Sira_No=:Rutbe_Sira_No");
					$Rutbe_Sor->execute(array(
						'Rutbe_Sira_No'=>$Rutbe_Sira_No));
					$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
					$Rutbe_Id=$Rutbe_Cek['Rutbe_Id'];
					$Rutbe_Adi=$Rutbe_Cek['Rutbe_Adi'];


					$Elave_Et=$db->prepare("INSERT INTO  rutbe_emri SET                               
						ID=:ID,		
						Rutbe_Id=:Rutbe_Id,		
						Rutbe_Adi=:Rutbe_Adi,	
						Rutbe_Emri_Qeyd=:Rutbe_Emri_Qeyd,	
						Rutbe_Emri_Novu=:Rutbe_Emri_Novu,	
						Rutbe_Emri_Tarixi=:Rutbe_Emri_Tarixi,				
						Rutbe_Emrinin_No=:Rutbe_Emrinin_No,
						Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id
						");
					$Insert=$Elave_Et->execute(array(                                
						'ID'=>$ID,			
						'Rutbe_Id'=>$Rutbe_Id,			
						'Rutbe_Adi'=>$Rutbe_Adi,		
						'Rutbe_Emri_Qeyd'=>$Intizam_Tenbehi_Sebeb,		
						'Rutbe_Emri_Novu'=>5,		
						'Rutbe_Emri_Tarixi'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,			
						'Rutbe_Emrinin_No'=>$Intizam_Tenbehi_Emrinin_Nomresi,
						'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
					));
				}else{
					$İntizam_Sil_Sor=$db->prepare("SELECT * FROM  intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
					$İntizam_Sil_Sor->execute(array(
						'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id));						
					echo '<input type="hidden" id="status" value="error">';
					echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id">';
					echo '<input type="hidden" id="message" value="Bu tənbeh tədbiq edilə bilməz">';
					exit;
				}


			}
			if ($Insert) {
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Düzəliş uğurlu edildi</span>">';
				$Sor=$db->prepare("SELECT * FROM   intizam_tenbehi order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC,Intizam_Tenbehi_Id DESC");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="ListelemeAlaniIciTablosu " id="dataTable">
								<thead class="">
									<tr>
										<th>Nömrə</th>
										<th>Adı,soyadı</th>
										<th>Səbəb</th>
										<th>İntizam Tənbehi</th>
										<th>Başlanğıc Tarixi</th>
										<th>Bitiş Tarixi</th>
										<th>Əməliyyat</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<tr>							
											<td class="siar_no_alani"><?php echo $Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>
											<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);	?></td>
											<td><?php echo $Cek['Intizam_Tenbehi_Sebeb'] ?></td>
											<td><?php echo $Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']) ?></td>
											<td class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Intizam_Tenbehinin_Bitis_Tarixi']) ?></td>										
											<td class="emeliyyatlar_iki_buttom">							
												<?php echo DuzenleButonu($Cek['Intizam_Tenbehi_Id'])." ".SilButonu($Cek['Intizam_Tenbehi_Id']) ?>		
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
							Bazada İntizam Tənbehi əmri yoxdur
						</div>
					</div> 
				<?php }	
			}else{
				$sil = $db->prepare("DELETE from intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
				$kontrol = $sil->execute(array(
					'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
				));	
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Əməliyyat Uğursuz</span>">';
				$Sor=$db->prepare("SELECT * FROM   intizam_tenbehi order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC,Intizam_Tenbehi_Id DESC");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="ListelemeAlaniIciTablosu " id="dataTable">
								<thead class="">
									<tr>
										<th>Nömrə</th>
										<th>Adı,soyadı</th>
										<th>Səbəb</th>
										<th>İntizam Tənbehi</th>
										<th>Başlanğıc Tarixi</th>
										<th>Bitiş Tarixi</th>
										<th>Əməliyyat</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<tr>							
											<td class="siar_no_alani"><?php echo $Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>
											<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);	?></td>
											<td><?php echo $Cek['Intizam_Tenbehi_Sebeb'] ?></td>
											<td><?php echo $Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']) ?></td>
											<td class="textaligncenter"><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Intizam_Tenbehinin_Bitis_Tarixi']) ?></td>										
											<td class="emeliyyatlar_iki_buttom">							
												<?php echo DuzenleButonu($Cek['Intizam_Tenbehi_Id'])." ".SilButonu($Cek['Intizam_Tenbehi_Id']) ?>		
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
							Bazada İntizam Tənbehi əmri yoxdur
						</div>
					</div> 
				<?php }	
			}
		}else{
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
			echo '<input type="hidden" id="message" value="Sistem idarəcisinə məlumat verin">';
			exit;
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>