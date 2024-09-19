<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                     =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$gun                     =  ReqemlerXaricButunKarakterleriSil($deyer['gun']);
	$ay                     =  ReqemlerXaricButunKarakterleriSil($deyer['ay']);
	$il                     =  ReqemlerXaricButunKarakterleriSil($deyer['il']);
	$Orqanin_Adi            =  EditorluIcerikleriFiltrle($deyer['Orqanin_Adi']);	
	$Vezifesi               =  EditorluIcerikleriFiltrle($deyer['Vezifesi']);	
	$Qeb_Tarixi             = $deyer['Qebul_Tarixi'];
	$Qebul_Tarixi           = TarixBeynelxalqCevir($deyer['Qebul_Tarixi']);
	$Azad_Tarixi            = $deyer['Azad_Olma_Tarixi'];
	$Azad_Olma_Tarixi       = TarixBeynelxalqCevir($deyer['Azad_Olma_Tarixi']);
	$Xidmet_Iline_Daxil_Et  =  ReqemlerXaricButunKarakterleriSil($deyer['Xidmet_Iline_Daxil_Et']);

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
	}elseif($Orqanin_Adi==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Orqanin_Adi">';
		echo '<input type="hidden" id="message" value="işlədiyyi idarəni qeyd edin">';
		exit;
	}elseif($Vezifesi==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezifesi">';
		echo '<input type="hidden" id="message" value="işlədiyyi vəzifəni qeyd edin">';
		exit;
	}elseif($Qeb_Tarixi!=TarixAzCevir($deyer['Qebul_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Qebul_Tarixi">';
		echo '<input type="hidden" id="message" value="Qəbul tarixini secin">';
		exit;
	}elseif($Azad_Tarixi!=TarixAzCevir($deyer['Azad_Olma_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Azad_Olma_Tarixi">';
		echo '<input type="hidden" id="message" value="Azad olma tarixini secin">';
		exit;
	}elseif($Qebul_Tarixi>=$Azad_Olma_Tarixi){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Qebul_Tarixi">';
		echo '<input type="hidden" id="message" value="Qəbul tarixi azad olma tarixindən böyük ola bilməz">';
		exit;
	}

	else{
		$Elave_Et=$db->prepare("INSERT INTO diger_xidmet_illeri SET                               
			gun=:gun,		
			ay=:ay,		
			il=:il,		
			ID=:ID,		
			Orqanin_Adi=:Orqanin_Adi,		
			Vezifesi=:Vezifesi,		
			Qebul_Tarixi=:Qebul_Tarixi,		
			Azad_Olma_Tarixi=:Azad_Olma_Tarixi,		
			Xidmet_Iline_Daxil_Et=:Xidmet_Iline_Daxil_Et			
			");
		$Insert=$Elave_Et->execute(array(                                
			'gun'=>$gun,			
			'ay'=>$ay,			
			'il'=>$il,			
			'ID'=>$ID,			
			'Orqanin_Adi'=>$Orqanin_Adi,			
			'Vezifesi'=>$Vezifesi,			
			'Qebul_Tarixi'=>$Qebul_Tarixi,			
			'Azad_Olma_Tarixi'=>$Azad_Olma_Tarixi,			
			'Xidmet_Iline_Daxil_Et'=>$Xidmet_Iline_Daxil_Et					
		));
		if ($Insert) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
			echo '<input type="hidden" id="message" value="<span class=\'Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
			$Sor=$db->prepare("SELECT * FROM diger_xidmet_illeri order by ID ASC, Diger_Xidmet_Ili_Id  DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr style="vertical-align: middle;">									
									<th>Adı,soyadı</th>
									<th>İdarə</th>				
									<th>Vəzifə</th>
									<th>Qəbul tarixi</th>
									<th>Azad olma tarixi</th>									
									<th>İl</th>									
									<th>Ay</th>									
									<th>Gün</th>									
									<th class="Vezife_Adlari_Durum_Kapsama">Xidmet iline daxilet</th>									
									<th class="emeliyyatlar_iki_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {

									$d1 = new DateTime($Cek['Qebul_Tarixi']);
									$d2 = new DateTime($Cek['Azad_Olma_Tarixi']);

									$il=$d1->diff($d2)->y; 
									$ay= $d1->diff($d2)->m; 
									$gun=$d1->diff($d2)->d;
									?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo $Cek['Orqanin_Adi'];?></td>
										<td><?php echo $Cek['Vezifesi'];?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Qebul_Tarixi']) ?></td>	
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Azad_Olma_Tarixi']) ?></td>							
										<td><?php echo $Cek['il'] ?></td>
										<td><?php echo $Cek['ay'] ?></td>
										<td><?php echo $Cek['gun'] ?></td>
										<td class="Vezife_Adlari_Durum_Kapsama">
											
											<label class="checkbox">
												<input 
												<?php 
												if ($Cek['Xidmet_Iline_Daxil_Et']==1) {
													echo  "checked";
												}else{}
												?>
												type="checkbox" id="nezerealam_<?php echo $Cek['Diger_Xidmet_Ili_Id'] ?>" onchange="DaxilEt(this.id)" > 
												<span class="checkbox"> 
													<span></span>
												</span>
											</label>

										</td>																															
								<td class="emeliyyatlar_iki_buttom"><?php echo DuzenleButonu($Cek['Diger_Xidmet_Ili_Id']).SilButonu($Cek['Diger_Xidmet_Ili_Id']); ?></td>
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