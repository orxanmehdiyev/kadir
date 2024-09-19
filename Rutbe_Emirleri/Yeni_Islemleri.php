<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                 =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Tarixi  = $deyer['Rutbe_Emri_Tarixi'];
	$Rutbe_Emri_Tarixi  = TarixBeynelxalqCevir($deyer['Rutbe_Emri_Tarixi']);

	$Rutbe_Emri_Novu    =  ReqemlerXaricButunKarakterleriSil($deyer['Rutbe_Emri_Novu']);
	$Rutbe_Id           =  ReqemlerXaricButunKarakterleriSil($deyer['Rutbe_Id']);
	$Rutbe_Emri_Qeyd    =  EditorluIcerikleriFiltrle($deyer['Rutbe_Emri_Sebeb']);
	$Rutbe_Emrinin_No   =  EditorluIcerikleriFiltrle($deyer['Rutbe_Emrinin_No']);

	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Soy_Adi=$User_Cek['Soy_Adi'];
	$Adi=$User_Cek['Adi'];
	$Ata_Adi=$User_Cek['Ata_Adi'];

	$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
	$Rutbe_Sor->execute(array(
		'Rutbe_Id'=>$Rutbe_Id));
	$Rutbe_Say=$Rutbe_Sor->rowCount();
	$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
	$Rutbe_Adi=$Rutbe_Cek['Rutbe_Adi'];

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Rutbe_Emri_Novu==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Rutbe_Emri_Novu">';
		echo '<input type="hidden" id="message" value="Rütbe növünü secin">';
		exit;
	}elseif($Rutbe_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Rutbe_Id">';
		echo '<input type="hidden" id="message" value="Rütbe secin">';
		exit;
	}else{
		$Elave_Et=$db->prepare("INSERT INTO  rutbe_emri SET  
			Soy_Adi=:Soy_Adi,
			Adi=:Adi,
			Ata_Adi=:Ata_Adi,                             
			ID=:ID,		
			Rutbe_Id=:Rutbe_Id,		
			Rutbe_Adi=:Rutbe_Adi,	
			Rutbe_Emri_Qeyd=:Rutbe_Emri_Qeyd,	
			Rutbe_Emri_Novu=:Rutbe_Emri_Novu,	
			Rutbe_Emri_Tarixi=:Rutbe_Emri_Tarixi,				
			Rutbe_Emrinin_No=:Rutbe_Emrinin_No
			");
		$Insert=$Elave_Et->execute(array(    
			'Soy_Adi'=>$Soy_Adi,
			'Adi'=>$Adi,
			'Ata_Adi'=>$Ata_Adi,                            
			'ID'=>$ID,			
			'Rutbe_Id'=>$Rutbe_Id,			
			'Rutbe_Adi'=>$Rutbe_Adi,		
			'Rutbe_Emri_Qeyd'=>$Rutbe_Emri_Qeyd,		
			'Rutbe_Emri_Novu'=>$Rutbe_Emri_Novu,		
			'Rutbe_Emri_Tarixi'=>$Rutbe_Emri_Tarixi,			
			'Rutbe_Emrinin_No'=>$Rutbe_Emrinin_No
		));
		if ($Insert) {
			$Rutbe_Emri_Id=$db->lastInsertId();
			$Elave_Et=$db->prepare("INSERT INTO  rutbe_emri_islemleri SET                               
				IPAdresi=:IPAdresi,		
				Admin_Id=:Admin_Id,		
				TarixSaat=:TarixSaat,		
				ZamanDamgasi=:ZamanDamgasi,		
				Rutbe_Emri_Id=:Rutbe_Emri_Id,		
				ID=:ID,		
				Rutbe_Id=:Rutbe_Id,		
				Rutbe_Adi=:Rutbe_Adi,	
				Rutbe_Emri_Qeyd=:Rutbe_Emri_Qeyd,	
				Rutbe_Emri_Novu=:Rutbe_Emri_Novu,	
				Rutbe_Emri_Tarixi=:Rutbe_Emri_Tarixi,				
				Rutbe_Emrinin_No=:Rutbe_Emrinin_No
				");
			$Insert=$Elave_Et->execute(array(                                
				'IPAdresi'=>$IPAdresi,			
				'Admin_Id'=>$Admin_Id,			
				'TarixSaat'=>$TarixSaat,			
				'ZamanDamgasi'=>$ZamanDamgasi,			
				'Rutbe_Emri_Id'=>$Rutbe_Emri_Id,			
				'ID'=>$ID,			
				'Rutbe_Id'=>$Rutbe_Id,			
				'Rutbe_Adi'=>$Rutbe_Adi,		
				'Rutbe_Emri_Qeyd'=>$Rutbe_Emri_Qeyd,		
				'Rutbe_Emri_Novu'=>$Rutbe_Emri_Novu,		
				'Rutbe_Emri_Tarixi'=>$Rutbe_Emri_Tarixi,			
				'Rutbe_Emrinin_No'=>$Rutbe_Emrinin_No
			));
			if ($Insert) {
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Yeni əmir uğurla yaradıldı</span>">';
				$Sor=$db->prepare("SELECT * FROM rutbe_emri order by Rutbe_Emri_Tarixi DESC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">						
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
								<thead class="">
									<tr>									
										<th>Adı,soyadı</th>
										<th>Rütbə</th>
										<th>Səbəb</th>
										<th>Tarixi</th>
										<th>Əmir №</th>							
										<th class="emeliyyatlar_sil_buttom">Sil</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
										if ($Cek['Rutbe_Emri_Novu']==1) {
											$Rutbe_Emri_Novu="İlkin xüsusi rütbənin verilməsi";
										}elseif ($Cek['Rutbe_Emri_Novu']==2) {
											$Rutbe_Emri_Novu="Növbəti xüsusi rütbənin verilməsi";
										}elseif ($Cek['Rutbe_Emri_Novu']==3) {
											$Rutbe_Emri_Novu="Vaxdindan əvvəl xüsusi rütbənin verilməsi";
										}elseif ($Cek['Rutbe_Emri_Novu']==4) {
											$Rutbe_Emri_Novu="Tutduğu vəzifədən yuxarı xüsusi rütbənin verixlməsi";
										}elseif ($Cek['Rutbe_Emri_Novu']==5) {
											$Rutbe_Emri_Novu="İntizam tənbehi ilə rütbənin aşağı salınması";
										}
										?>
										<tr>	
											<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
											<td><?php echo $Cek['Rutbe_Adi'] ?></td>
											<td><?php echo $Rutbe_Emri_Novu ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Rutbe_Emri_Tarixi']) ?></td>
											<td><?php echo $Cek['Rutbe_Emrinin_No'] ?></td>	
											<?php 
											$NovbetiSor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
											$NovbetiSor->execute(array(
												'ID'=>$Cek['ID']));
											$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
											?>																									
											<td class="emeliyyatlar_sil_buttom">
												<?php
												if($NovbetiCek['Rutbe_Emri_Tarixi']==$Cek['Rutbe_Emri_Tarixi']){
													echo SilButonu($Cek['Rutbe_Emri_Id']);
												}else{}
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
							Bazada rütbə əmri yoxdur
						</div>
					</div> 
				<?php 	}	
			}else{
				$sil = $db->prepare("DELETE from rutbe_emri where Rutbe_Emri_Id=:Rutbe_Emri_Id");
				$kontrol = $sil->execute(array(
					'Rutbe_Emri_Id'=>$Rutbe_Emri_Id
				));	
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Əməliyyat Uğursuz</span>">';
				$Sor=$db->prepare("SELECT * FROM rutbe_emri order by Rutbe_Emri_Tarixi DESC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">						
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
								<thead class="">
									<tr>									
										<th>Adı,soyadı</th>
										<th>Rütbə</th>
										<th>Səbəb</th>
										<th>Tarixi</th>
										<th>Əmir №</th>							
										<th class="emeliyyatlar_sil_buttom">Sil</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
										if ($Cek['Rutbe_Emri_Novu']==1) {
											$Rutbe_Emri_Novu="İlkin xüsusi rütbənin verilməsi";
										}elseif ($Cek['Rutbe_Emri_Novu']==2) {
											$Rutbe_Emri_Novu="Növbəti xüsusi rütbənin verilməsi";
										}elseif ($Cek['Rutbe_Emri_Novu']==2) {
											$Rutbe_Emri_Novu="Vaxdindan əvvəl xüsusi rütbənin verilməsi";
										}elseif ($Cek['Rutbe_Emri_Novu']==2) {
											$Rutbe_Emri_Novu="Tutduğu vəzifədən yuxarı xüsusi rütbənin verixlməsi";
										}
										?>
										<tr>	
											<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
											<td><?php echo $Cek['Rutbe_Adi'] ?></td>
											<td><?php echo $Rutbe_Emri_Novu ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Rutbe_Emri_Tarixi']) ?></td>
											<td><?php echo $Cek['Rutbe_Emrinin_No'] ?></td>	
											<?php 
											$NovbetiSor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
											$NovbetiSor->execute(array(
												'ID'=>$Cek['ID']));
											$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
											?>																									
											<td class="emeliyyatlar_sil_buttom">
												<?php
												if($NovbetiCek['Rutbe_Emri_Tarixi']==$Cek['Rutbe_Emri_Tarixi']){
													echo SilButonu($Cek['Rutbe_Emri_Id']);
												}else{}
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
							Bazada rütbə əmri yoxdur
						</div>
					</div> 
				<?php 	}	
			}
		}else{
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="Rutbe_Id">';
			echo '<input type="hidden" id="message" value="Məlumat qeydə alınmadı">';
			exit;
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>