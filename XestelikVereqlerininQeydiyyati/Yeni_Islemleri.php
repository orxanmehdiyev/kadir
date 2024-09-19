<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                 =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$Xestelik_Vereqi_No   =  EditorluIcerikleriFiltrle($deyer['Xestelik_Vereqi_No']); 
	$Tarixi  = $deyer['Xestelik_Baslagic_Tarixi'];
	$Xestelik_Baslagic_Tarixi  = TarixBeynelxalqCevir($deyer['Xestelik_Baslagic_Tarixi']);

	$Isecixma_Tarixi  = $deyer['Xestelik_Ise_Cixma_Tarixi'];
	$Xestelik_Ise_Cixma_Tarixi  = TarixBeynelxalqCevir($deyer['Xestelik_Ise_Cixma_Tarixi']);
	$Xestelik_Gun    =  ReqemlerXaricButunKarakterleriSil($deyer['Xestelik_Gun']);	

	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Soyadi=$User_Cek['Soy_Adi'];
	$Adi=$User_Cek['Adi'];
	$AtaAdi=$User_Cek['Ata_Adi'];

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Xestelik_Vereqi_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xestelik_Vereqi_No">';
		echo '<input type="hidden" id="message" value="Xəstəlik vərəqinin nömrəsini yazın">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($deyer['Xestelik_Baslagic_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xestelik_Baslagic_Tarixi">';
		echo '<input type="hidden" id="message" value="Başlağıc tarixini secin">';
		exit;
	}elseif($Isecixma_Tarixi!=TarixAzCevir($deyer['Xestelik_Ise_Cixma_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Xestelik_Ise_Cixma_Tarixi">';
		echo '<input type="hidden" id="message" value="İşə çıcma tarixini secin">';
		exit;
	}else{
		$Elave_Et=$db->prepare("INSERT INTO xestelik_qeydiyyat SET                               
			ID=:ID,		
			Soyadi=:Soyadi,		
			Adi=:Adi,		
			AtaAdi=:AtaAdi,		
			Xestelik_Vereqi_No=:Xestelik_Vereqi_No,		
			Xestelik_Baslagic_Tarixi=:Xestelik_Baslagic_Tarixi,		
			Xestelik_Ise_Cixma_Tarixi=:Xestelik_Ise_Cixma_Tarixi,		
			Xestelik_Gun=:Xestelik_Gun			
			");
		$Insert=$Elave_Et->execute(array(                                
			'ID'=>$ID,			
			'Soyadi'=>$Soyadi,			
			'Adi'=>$Adi,			
			'AtaAdi'=>$AtaAdi,			
			'Xestelik_Vereqi_No'=>$Xestelik_Vereqi_No,			
			'Xestelik_Baslagic_Tarixi'=>$Xestelik_Baslagic_Tarixi,			
			'Xestelik_Ise_Cixma_Tarixi'=>$Xestelik_Ise_Cixma_Tarixi,			
			'Xestelik_Gun'=>$Xestelik_Gun					
		));

		if ($Insert) {
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
									<th>Adı,soyadı, ata adı</th>
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
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>