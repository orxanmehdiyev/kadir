<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$Idare_Id          =  ReqemlerXaricButunKarakterleriSil($deyer['Idare_Id']);
	$Sobe_Id           =  ReqemlerXaricButunKarakterleriSil($deyer['Sobe_Id']);

	$Tarixi            = $deyer['Baslangic_Tarixi'];
	$Baslangic_Tarixi  = TarixBeynelxalqCevir($deyer['Baslangic_Tarixi']);
	$Isecixma_Tarixi   = $deyer['Bitis_Tarixi'];
	$Bitis_Tarixi      = TarixBeynelxalqCevir($deyer['Bitis_Tarixi']);
	$Emir_No           =  EditorluIcerikleriFiltrle($deyer['Emir_No']);	

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
	}elseif($Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Emir_No">';
		echo '<input type="hidden" id="message" value="Əmrin nömrəsini yazın">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($deyer['Baslangic_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Başlağıc tarixini secin">';
		exit;
	}elseif($Isecixma_Tarixi!=TarixAzCevir($deyer['Bitis_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Bitis_Tarixi">';
		echo '<input type="hidden" id="message" value="Bitiş tarixini secin">';
		exit;
	}else{
		$Elave_Et=$db->prepare("INSERT INTO tehkim_emri SET                               
			ID=:ID,		
			Idare_Id=:Idare_Id,		
			Sobe_Id=:Sobe_Id,		
			Baslangic_Tarixi=:Baslangic_Tarixi,		
			Bitis_Tarixi=:Bitis_Tarixi,		
			Emir_No=:Emir_No			
			");
		$Insert=$Elave_Et->execute(array(                                
			'ID'=>$ID,			
			'Idare_Id'=>$Idare_Id,			
			'Sobe_Id'=>$Sobe_Id,			
			'Baslangic_Tarixi'=>$Baslangic_Tarixi,			
			'Bitis_Tarixi'=>$Bitis_Tarixi,			
			'Emir_No'=>$Emir_No					
		));

		if ($Insert) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
			echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
			$Sor=$db->prepare("SELECT * FROM tehkim_emri order by Baslangic_Tarixi DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı</th>
									<th>İdarə</th>
									<th>Bölmə</th>
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
										<td>
											<?php 
											$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
											$Idare_Sor->execute(array(
												'Idare_Id'=>$Cek['Idare_Id']));
											$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
											echo $Idare_Cek['Idare_Kissa_Adi'];
											?>											
										</td>
													<td>
											<?php 
											$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id");
											$Sobe_Sor->execute(array(
												'Sobe_Id'=>$Cek['Sobe_Id']));
											$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
											echo $Sobe_Cek['Sobe_Ad'];
											?>											
										</td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Baslangic_Tarixi']) ?></td>										
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Bitis_Tarixi']) ?></td>
										<td><?php echo $Cek['Emir_No']?></td>																															
										<td class="emeliyyatlar_sil_buttom"><?php echo SilButonu($Cek['Tehkim_Emri_Id']); ?></td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada təhkim əmri yoxdur
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