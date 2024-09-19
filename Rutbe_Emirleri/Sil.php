<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Rutbe_Emri_Id         =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Emir_Sor=$db->prepare("SELECT * FROM rutbe_emri where Rutbe_Emri_Id=:Rutbe_Emri_Id");
	$Emir_Sor->execute(array(
		'Rutbe_Emri_Id'=>$Rutbe_Emri_Id
	));
	$Emir_Say=$Emir_Sor->rowCount();
	if ($Emir_Say==1) {
		$Emir_Cek=$Emir_Sor->fetch(PDO::FETCH_ASSOC);
		$ID=$Emir_Cek['ID'];
		$Rutbe_Id=$Emir_Cek['Rutbe_Id'];
		$Rutbe_Adi=$Emir_Cek['Rutbe_Adi'];
		$Rutbe_Emri_Qeyd=$Emir_Cek['Rutbe_Emri_Qeyd'];
		$Rutbe_Emri_Novu=$Emir_Cek['Rutbe_Emri_Novu'];
		$Rutbe_Emri_Tarixi=$Emir_Cek['Rutbe_Emri_Tarixi'];
		$Rutbe_Emrinin_No=$Emir_Cek['Rutbe_Emrinin_No'];
		$Intizam_Tenbehi_Id=$Emir_Cek['Intizam_Tenbehi_Id'];
		$Hevesledirme_Tedbirleri_Id=$Emir_Cek['Hevesledirme_Tedbirleri_Id'];
		$sil = $db->prepare("DELETE from rutbe_emri where Rutbe_Emri_Id=:Rutbe_Emri_Id");
		$kontrol = $sil->execute(array(
			'Rutbe_Emri_Id' => $Rutbe_Emri_Id
		));
		if ($kontrol) {
			if ($Rutbe_Emri_Novu==5) {
				$sil = $db->prepare("DELETE from intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
				$kontrol = $sil->execute(array(
					'Intizam_Tenbehi_Id' => $Intizam_Tenbehi_Id
				));
				$sil = $db->prepare("DELETE from hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id");
				$kontrol = $sil->execute(array(
					'Hevesledirme_Tedbirleri_Id' => $Hevesledirme_Tedbirleri_Id
				));
				
			}

			if ($Rutbe_Emri_Novu==3 or $Rutbe_Emri_Novu==4 ) {
				$sil = $db->prepare("DELETE from hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id");
				$kontrol = $sil->execute(array(
					'Hevesledirme_Tedbirleri_Id' => $Hevesledirme_Tedbirleri_Id
				));				
			}
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
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Uğurla silindi</span>">';
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
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Uğurla silindi! Qeydiyyat uğursuz</span>">';
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
			echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Silinmə uğursuz</span>">';
			exit;
		}
	}else{
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Silinmə uğursuz</span>">';
		exit;
	}

}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>