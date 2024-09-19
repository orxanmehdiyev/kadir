<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                 =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);	
	$Xidmet_Iline_Tarixi  = $deyer['Xidmet_Iline_Elave_Verilme_tarixi'];
	$Xidmet_Iline_Elave_Verilme_tarixi  = TarixBeynelxalqCevir($deyer['Xidmet_Iline_Elave_Verilme_tarixi']);
	$Xidmet_Iline_Elave                 =  ReqemlerXaricButunKarakterleriSil($deyer['Xidmet_Iline_Elave']);

	$Emr_Tarixi  = $deyer['Emrin_Tarixi'];
	$Emrin_Tarixi  = TarixBeynelxalqCevir($deyer['Emrin_Tarixi']);
	$Emir_No   =  EditorluIcerikleriFiltrle($deyer['Emir_No']);

	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();

	$Xidmet_Ili_Sor=$db->prepare("SELECT * FROM xidmet_iline_elave where ID=:ID and Xidmet_Iline_Elave>=:Xidmet_Iline_Elave ");
	$Xidmet_Ili_Sor->execute(array(
		'ID'=>$ID,
		'Xidmet_Iline_Elave'=>$Xidmet_Iline_Elave
	));
	$Xidmet_Ili_Say=$Xidmet_Ili_Sor->rowCount();

	$Xidmet_Sor=$db->prepare("SELECT * FROM xidmet_iline_elave where ID=:ID and Xidmet_Iline_Elave_Verilme_tarixi>=:Xidmet_Iline_Elave_Verilme_tarixi");
	$Xidmet_Sor->execute(array(
		'ID'=>$ID,
		'Xidmet_Iline_Elave_Verilme_tarixi'=>$Xidmet_Iline_Elave_Verilme_tarixi
	));
	$Xidmet_Say=$Xidmet_Sor->rowCount();

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}	elseif ($Xidmet_Iline_Elave_Verilme_tarixi>$Emrin_Tarixi) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xidmet_Iline_Elave_Verilme_tarixi">';
		echo '<input type="hidden" id="message" value="Əmrin tarixi əlavənin verilmə tariindən böyük ola bilməz">';
		exit;
	}
	elseif ($Xidmet_Say==1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xidmet_Iline_Elave_Verilme_tarixi">';
		echo '<input type="hidden" id="message" value="Bu əməkdaş üçün yeni tarixdə əmir var">';
		exit;
	}
	elseif ($Xidmet_Ili_Say==1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xidmet_Iline_Elave">';
		echo '<input type="hidden" id="message" value="Secili xidmət ili və ya ondan böyük xidmet ili var">';
		exit;
	}
	elseif($Xidmet_Iline_Tarixi!=TarixAzCevir($deyer['Xidmet_Iline_Elave_Verilme_tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xidmet_Iline_Elave_Verilme_tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}
	elseif($Emr_Tarixi!=TarixAzCevir($deyer['Emrin_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Emrin_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}
	elseif($Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Emir_No">';
		echo '<input type="hidden" id="message" value="Əmrin nömrəsini yazın">';
		exit;
	}	
	elseif($Xidmet_Iline_Elave==5 or  $Xidmet_Iline_Elave==10 or $Xidmet_Iline_Elave==15 or $Xidmet_Iline_Elave==20 or $Xidmet_Iline_Elave==25 or $Xidmet_Iline_Elave==30 or $Xidmet_Iline_Elave==40 or $Xidmet_Iline_Elave==50){
		$Elave_Et=$db->prepare("INSERT INTO xidmet_iline_elave SET                               
			ID=:ID,		
			Xidmet_Iline_Elave_Verilme_tarixi=:Xidmet_Iline_Elave_Verilme_tarixi,		
			Emrin_Tarixi=:Emrin_Tarixi,		
			Emir_No=:Emir_No,		
			Xidmet_Iline_Elave=:Xidmet_Iline_Elave			
			");
		$Insert=$Elave_Et->execute(array(                                
			'ID'=>$ID,			
			'Xidmet_Iline_Elave_Verilme_tarixi'=>$Xidmet_Iline_Elave_Verilme_tarixi,			
			'Emrin_Tarixi'=>$Emrin_Tarixi,			
			'Emir_No'=>$Emir_No,			
			'Xidmet_Iline_Elave'=>$Xidmet_Iline_Elave					
		));

		if ($Insert) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Emrin_Tarixi">';
			echo '<input type="hidden" id="message" value="<span class=\'Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
			$Sor=$db->prepare("SELECT * FROM xidmet_iline_elave order by Emrin_Tarixi DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı</th>
									<th>Əlavə verilmə tarixi</th>
									<th>Əlavə %</th>
									<th> Əmrin Tarixi</th>
									<th>Əmir no</th>
									<th class="emeliyyatlar_iki_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Iline_Elave_Verilme_tarixi']) ?></td>										
										<td><?php echo $Cek['Xidmet_Iline_Elave'] ?></td>										
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Emrin_Tarixi']) ?></td>
										<td><?php echo $Cek['Emir_No']?></td>																															
										<td class="emeliyyatlar_iki_buttom">
											<?php 
											$Sor_Xidmet=$db->prepare("SELECT * FROM xidmet_iline_elave where ID=:ID order by  Xidmet_Iline_Elave_Verilme_tarixi DESC");
											$Sor_Xidmet->execute(array(
												'ID'=>$Cek['ID']
											));
											$Sor_Xidmet_Cek=$Sor_Xidmet->fetch(PDO::FETCH_ASSOC);
											if ($Sor_Xidmet_Cek['Xidmet_Iline_Elave_Verilme_tarixi']==$Cek['Xidmet_Iline_Elave_Verilme_tarixi']) {
												echo DuzenleButonu($Cek['Xidmet_Iline_Elave_Id']).SilButonu($Cek['Xidmet_Iline_Elave_Id']); 
											}
											
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
						Xidmət ilinə əlavə əmri yoxdur
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
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xidmet_Iline_Elave">';
		echo '<input type="hidden" id="message" value="Xidmət ilinə əlavə düzgün deyil">';
		exit;
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>