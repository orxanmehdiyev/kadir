<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                                         =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$intizam_tenbehi_adlari_id                  =  ReqemlerXaricButunKarakterleriSil($deyer['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id']); 
	$Intizam_Tenbehi_Sebeb                      =  EditorluIcerikleriFiltrle($deyer['Intizam_Tenbehi_Sebeb']); 
	$Intizam_Tenbehi_Emrinin_Nomresi            =  EditorluIcerikleriFiltrle($deyer['Intizam_Tenbehi_Emrinin_Nomresi']); 
	$Tarixi                                     =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']); 
	$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix   =  TarixBeynelxalqCevir($Tarixi);
	$Intizam_Tenbehinin_Bitis_Tarixi            =  Traix_Uzerine_Gel($Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,6,"month");
	$Intizam_Tenbehi_Tesdiq_Durumu=0;

	$TarixAzcevir                  =  TarixAzCevir($deyer['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Islediyi_Idare_Id=$User_Cek['Islediyi_Idare_Id'];
	$Islediyi_Sobe_Id=$User_Cek['Islediyi_Sobe_Id'];
	$Vezife_Id=$User_Cek['Vezife_Id'];
	$Soy_Adi=$User_Cek['Soy_Adi'];
	$Adi=$User_Cek['Adi'];
	$Ata_Adi=$User_Cek['Ata_Adi'];
	$bos="";

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
	}/*elseif($Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<$Tarix_Beynelxalq){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
		echo '<input type="hidden" id="message" value="İntizam tənbehinin tarix faktiki tarixdən kiçik ola bilməz">';
		exit;
	}*/else{
		$Elave_Et=$db->prepare("INSERT INTO intizam_tenbehi SET
			Intizam_Tenbehi_Emrinin_Nomresi=:Intizam_Tenbehi_Emrinin_Nomresi, 
			Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix, 
			Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi, 
			Intizam_Tenbehi_Sebeb=:Intizam_Tenbehi_Sebeb, 
			Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad, 
			Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id, 
			Islediyi_Idare_Id=:Islediyi_Idare_Id, 
			Islediyi_Sobe_Id=:Islediyi_Sobe_Id, 
			Vezife_Id=:Vezife_Id, 
			Soy_Adi=:Soy_Adi, 
			Adi=:Adi, 
			Ata_Adi=:Ata_Adi, 
			ID=:ID
			");
		$Insert=$Elave_Et->execute(array(
			'Intizam_Tenbehi_Emrinin_Nomresi'=>$Intizam_Tenbehi_Emrinin_Nomresi,
			'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,  
			'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Tenbehinin_Bitis_Tarixi,   
			'Intizam_Tenbehi_Sebeb'=>$Intizam_Tenbehi_Sebeb,  
			'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'=>$AD_Cek['intizam_tenbehi_adlari_ad'],  
			'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>$intizam_tenbehi_adlari_id,  
			'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,  
			'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,  
			'Vezife_Id'=>$Vezife_Id,  
			'Soy_Adi'=>$Soy_Adi,  
			'Adi'=>$Adi,  
			'Ata_Adi'=>$Ata_Adi,  
			'ID'=>$ID							
		));
		if ($Insert) {
			$Intizam_Tenbehi_Id=$db->lastInsertId();
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
			if ($Insert) {
				if ($intizam_tenbehi_adlari_id==7) {
					$update=$db->prepare("UPDATE user SET
						Serencam_Durum=:Serencam_Durum,
						Islediyi_Idare_Id=:Islediyi_Idare_Id,
						Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
						Vezife_Id=:Vezife_Id,
						Isden_Cixarilma_Idare_Id=:Isden_Cixarilma_Idare_Id,
						Isden_Cixarilma_Sobe_Id=:Isden_Cixarilma_Sobe_Id,
						Isden_Cixarilma_Vezife_Id=:Isden_Cixarilma_Vezife_Id,
						Serencam_Tarix=:Serencam_Tarix,
						Serencam_Sebeb=:Serencam_Sebeb,
							Serencam_Emir=:Serencam_Emir
						where ID=$ID
						");
					$yenile=$update->execute(array(
						'Serencam_Durum'=>1,
						'Islediyi_Idare_Id'=>$bos,
						'Islediyi_Sobe_Id'=>$bos,
						'Vezife_Id'=>$bos,
						'Isden_Cixarilma_Idare_Id'=>$Islediyi_Idare_Id,
						'Isden_Cixarilma_Sobe_Id'=>$Islediyi_Sobe_Id,
						'Isden_Cixarilma_Vezife_Id'=>$Vezife_Id,
						'Serencam_Tarix'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
						'Serencam_Sebeb'=>1,
						'Serencam_Emir'=>$Intizam_Tenbehi_Emrinin_Nomresi
					));
					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id
						where User_Id=$ID
						");
					$yenile=$update->execute(array(
						'User_Id'=>$bos
					)); 
				}

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

				if ($intizam_tenbehi_adlari_id==8 or $intizam_tenbehi_adlari_id==9 ) {
					$xitam_sebebleri_kisa_ad="Gömrük orqanlarından xaric edildikdə";
					$update=$db->prepare("UPDATE user SET
						Durum=:Durum,
						Islediyi_Idare_Id=:Islediyi_Idare_Id,
						Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
						Vezife_Id=:Vezife_Id,
						Isden_Cixarilma_Idare_Id=:Isden_Cixarilma_Idare_Id,
						Isden_Cixarilma_Sobe_Id=:Isden_Cixarilma_Sobe_Id,
						Isden_Cixarilma_Vezife_Id=:Isden_Cixarilma_Vezife_Id,
						xitam_sebebleri_id=:xitam_sebebleri_id,
						xitam_sebebleri_kisa_ad=:xitam_sebebleri_kisa_ad,
						Isden_Cixarilma_Emir_No=:Isden_Cixarilma_Emir_No,
						Isden_Cixarilma_Tarixi=:Isden_Cixarilma_Tarixi
						where ID=$ID
						");
					$yenile=$update->execute(array(
						'Durum'=>0,
						'Islediyi_Idare_Id'=>$bos,
						'Islediyi_Sobe_Id'=>$bos,
						'Vezife_Id'=>$bos,
						'Isden_Cixarilma_Idare_Id'=>$Islediyi_Idare_Id,
						'Isden_Cixarilma_Sobe_Id'=>$Islediyi_Sobe_Id,
						'Isden_Cixarilma_Vezife_Id'=>$Vezife_Id,
						'xitam_sebebleri_id'=>8,
						'xitam_sebebleri_kisa_ad'=>$xitam_sebebleri_kisa_ad,
						'Isden_Cixarilma_Emir_No'=>$Intizam_Tenbehi_Emrinin_Nomresi,
						'Isden_Cixarilma_Tarixi'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix
					));
					$update=$db->prepare("UPDATE vezife SET
						User_Id=:User_Id
						where User_Id=$ID
						");
					$yenile=$update->execute(array(
						'User_Id'=>$bos
					)); 

				}


				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Yeni əmir uğurla yaradıldı</span>">';
				$Sor=$db->prepare("SELECT * FROM   intizam_tenbehi order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC,Intizam_Tenbehi_Id DESC");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover " id="dataTable">
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