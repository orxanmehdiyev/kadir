<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                 =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$Teltifin_Adi   =  EditorluIcerikleriFiltrle($deyer['Teltifin_Adi']); 
	$Teltif_Eden_Orqan   =  EditorluIcerikleriFiltrle($deyer['Teltif_Eden_Orqan']); 
	$Qeyd   =  EditorluIcerikleriFiltrle($deyer['Qeyd']); 
	$Tarixi  = $deyer['Teltif_Tarixi'];
	$Teltif_Tarixi  = TarixBeynelxalqCevir($deyer['Teltif_Tarixi']);

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
	}elseif($Teltifin_Adi==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Teltifin_Adi">';
		echo '<input type="hidden" id="message" value="Təltif adını yazın">';
		exit;
	}elseif($Teltif_Eden_Orqan==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Teltif_Eden_Orqan">';
		echo '<input type="hidden" id="message" value="Təltif edən orqan">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($deyer['Teltif_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Teltif_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}else{
		$Elave_Et=$db->prepare("INSERT INTO diger_teltiflerin_qeydiyyati SET                               
			Ata_Adi=:Ata_Adi,		
			Adi=:Adi,		
			Soy_Adi=:Soy_Adi,		
			ID=:ID,		
			Teltifin_Adi=:Teltifin_Adi,		
			Teltif_Eden_Orqan=:Teltif_Eden_Orqan,		
			Qeyd=:Qeyd,		
			Teltif_Tarixi=:Teltif_Tarixi			
			");
		$Insert=$Elave_Et->execute(array(                                
			'Ata_Adi'=>$Ata_Adi,			
			'Adi'=>$Adi,			
			'Soy_Adi'=>$Soy_Adi,			
			'ID'=>$ID,			
			'Teltifin_Adi'=>$Teltifin_Adi,			
			'Teltif_Eden_Orqan'=>$Teltif_Eden_Orqan,			
			'Qeyd'=>$Qeyd,			
			'Teltif_Tarixi'=>$Teltif_Tarixi					
		));

		if ($Insert) {

			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
			echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
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
										<td data-sort="<?php echo $Cek['Teltif_Tarixi'] ?>" class="textaligncenter"><?php echo TarixAzCevir($Cek['Teltif_Tarixi']);?></td>
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
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>