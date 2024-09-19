<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                 =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$Tehkim_Emri_Id     =  ReqemlerXaricButunKarakterleriSil($deyer['Tehkim_Emri_Id']);

	$Tarixi             = $deyer['Tehkim_Geri_Tarix'];
	$Tehkim_Geri_Tarix  = TarixBeynelxalqCevir($deyer['Tehkim_Geri_Tarix']);
	$Emrin_No           =  EditorluIcerikleriFiltrle($deyer['Emrin_No']);	

	$Tehkim_Sor=$db->prepare("SELECT * FROM tehkim_emri where Tehkim_Emri_Id=:Tehkim_Emri_Id");
	$Tehkim_Sor->execute(array('Tehkim_Emri_Id'=>$Tehkim_Emri_Id));
	$Tehkim_Cek=$Tehkim_Sor->fetch(PDO::FETCH_ASSOC);
	$Bitis_Tarixi=$Tehkim_Cek['Bitis_Tarixi'];
	$Baslangic_Tarixi=$Tehkim_Cek['Baslangic_Tarixi'];


	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Emrin_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Emir_No">';
		echo '<input type="hidden" id="message" value="Əmrin nömrəsini yazın">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($deyer['Tehkim_Geri_Tarix'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Tehkim_Geri_Tarix">';
		echo '<input type="hidden" id="message" value="Başlağıc tarixini secin">';
		exit;
	}elseif($Bitis_Tarixi<$Tehkim_Geri_Tarix){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Tehkim_Geri_Tarix">';
		echo '<input type="hidden" id="message" value="Geri çağrılma bitiş tarixindən böyük ola bilməz!">';
		exit;
	}elseif($Baslangic_Tarixi>$Tehkim_Geri_Tarix){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Tehkim_Geri_Tarix">';
		echo '<input type="hidden" id="message" value="Geri çağrılma başlanğıc tarixindən kiçik ola bilməz!">';
		exit;
	}
	else{
		$Elave_Et=$db->prepare("INSERT INTO tehkimden_geri_emri SET                               
			ID=:ID,		
			Tehkim_Emri_Id=:Tehkim_Emri_Id,		
			Tehkim_Geri_Tarix=:Tehkim_Geri_Tarix,		
			Bitis_Tarixi=:Bitis_Tarixi,		
			Emrin_No=:Emrin_No	
			");
		$Insert=$Elave_Et->execute(array(                                
			'ID'=>$ID,			
			'Tehkim_Emri_Id'=>$Tehkim_Emri_Id,			
			'Tehkim_Geri_Tarix'=>$Tehkim_Geri_Tarix,			
			'Bitis_Tarixi'=>$Bitis_Tarixi,			
			'Emrin_No'=>$Emrin_No			
		));

		$yenile=$db->prepare("UPDATE tehkim_emri SET 
			Bitis_Tarixi=:Bitis_Tarixi
			WHERE Tehkim_Emri_Id=$Tehkim_Emri_Id");
		$update=$yenile->execute(array(
			'Bitis_Tarixi'=>$Tehkim_Geri_Tarix
		));





		if ($Insert) {
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
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>