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

	$User_Is_Novu                               =  ReqemlerXaricButunKarakterleriSil($deyer['User_Is_Novu']); 
	$Islediyi_Idare                             =  ReqemlerXaricButunKarakterleriSil($deyer['Islediyi_Idare']); 
	$Islediyi_Sobe                              =  ReqemlerXaricButunKarakterleriSil($deyer['Islediyi_Sobe']); 
	$Vezife_Id_islediyi                         =  ReqemlerXaricButunKarakterleriSil($deyer['Vezife_Id']); 

	$idare_Sor=$db->prepare("SELECT * FROM  idare where Idare_Id=:Idare_Id ");
	$idare_Sor->execute(array(
		'Idare_Id'=>$Islediyi_Idare));
	$Idare_Say=$idare_Sor->rowCount();
	$Idare_Cek=$idare_Sor->fetch(PDO::FETCH_ASSOC);
	$Idare_Adi=$Idare_Cek['Idare_Adi'];

	$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id ");
	$Sobe_Sor->execute(array(
		'Sobe_Id'=>$Islediyi_Sobe));
	$Sobe_Say=$Sobe_Sor->rowCount();
	$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
	$Sobe_Adi=$Sobe_Cek['Sobe_Ad'];

	$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id ");
	$Vezife_Sor->execute(array(
		'Vezife_Id'=>$Vezife_Id_islediyi));
	$Vezife_Say=$Vezife_Sor->rowCount();
	$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];


	$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id ");
	$Vezife_Adlari_Sor->execute(array(
		'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
	$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
	$Vezife_Adi=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];

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
	$User_Is_Novu_Faktiki=$User_Cek['Is_Novu'];
	$Vezifeye_Teyin_Etme_Tarixi_Faktiki=$User_Cek['Vezifeye_Teyin_Tarixi'];
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
	}elseif($Idare_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Islediyi_Idare_Id">';
		echo '<input type="hidden" id="message" value="Idarə secilməyib">';
		exit;
	}elseif($Sobe_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Islediyi_Sobe_Id">';
		echo '<input type="hidden" id="message" value="Şöbə secilməyib">';
		exit;
	}elseif($Vezife_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Vezife_Id">';
		echo '<input type="hidden" id="message" value="Vəzifə secilməyib">';
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
			'ID'=>$ID							
		));
		if ($Insert) {
			$Intizam_Tenbehi_Id=$db->lastInsertId();
			$Elave_Et=$db->prepare("INSERT INTO stat_deyisikliyi SET
				ID=:ID, 
				Islediyi_Idare=:Islediyi_Idare, 
				Islediyi_Sobe=:Islediyi_Sobe, 
				Vezife_Id=:Vezife_Id, 
				User_Is_Novu=:User_Is_Novu, 
				Vezifeye_Teyin_Etme_Emir_No=:Vezifeye_Teyin_Etme_Emir_No, 
				Vezifeye_Teyin_Etme_Tarixi=:Vezifeye_Teyin_Etme_Tarixi, 
				Islediyi_Idare_Faktiki=:Islediyi_Idare_Faktiki, 
				Islediyi_Sobe_Faktiki=:Islediyi_Sobe_Faktiki, 
				Vezife_Id_Faktiki=:Vezife_Id_Faktiki, 
				User_Is_Novu_Faktiki=:User_Is_Novu_Faktiki, 
				Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id, 
				Vezifeye_Teyin_Etme_Tarixi_Faktiki=:Vezifeye_Teyin_Etme_Tarixi_Faktiki 			
				");
			$Insert=$Elave_Et->execute(array(
				'ID'=>$ID,
				'Islediyi_Idare'=>$Islediyi_Idare,
				'Islediyi_Sobe'=>$Islediyi_Sobe,
				'Vezife_Id'=>$Vezife_Id_islediyi,
				'User_Is_Novu'=>$User_Is_Novu,
				'Vezifeye_Teyin_Etme_Emir_No'=>$Intizam_Tenbehi_Emrinin_Nomresi,
				'Vezifeye_Teyin_Etme_Tarixi'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
				'Islediyi_Idare_Faktiki'=>$Islediyi_Idare_Id,
				'Islediyi_Sobe_Faktiki'=>$Islediyi_Sobe_Id,
				'Vezife_Id_Faktiki'=>$Vezife_Id,
				'User_Is_Novu_Faktiki'=>$User_Is_Novu_Faktiki,
				'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id,
				'Vezifeye_Teyin_Etme_Tarixi_Faktiki'=>$Vezifeye_Teyin_Etme_Tarixi_Faktiki
			));

			$update=$db->prepare("UPDATE user SET
				Islediyi_Idare_Id=:Islediyi_Idare_Id,
				Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
				Vezife_Id=:Vezife_Id,
				Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi,
				Idare_Ad=:Idare_Ad,
				Sobe_Ad=:Sobe_Ad,
				Vezife_Ad=:Vezife_Ad,
				Is_Novu=:Is_Novu
				where ID=$ID
				");
			$yenile=$update->execute(array(
				'Islediyi_Idare_Id'=>$Islediyi_Idare,
				'Islediyi_Sobe_Id'=>$Islediyi_Sobe,
				'Vezife_Id'=>$Vezife_Id_islediyi,
				'Vezifeye_Teyin_Tarixi'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
				'Idare_Ad'=>$Idare_Adi,
				'Sobe_Ad'=>$Sobe_Adi,
				'Vezife_Ad'=>$Vezife_Adi,
				'Is_Novu'=>$User_Is_Novu
			));


			$update=$db->prepare("UPDATE vezife SET
				User_Id=:User_Id				
				where User_Id=$ID
				");
			$yenile=$update->execute(array(
				'User_Id'=>$bos		
			));

			$update=$db->prepare("UPDATE vezife SET
				User_Id=:User_Id				
				where Vezife_Id=$Vezife_Id_islediyi
				");
			$yenile=$update->execute(array(
				'User_Id'=>$ID		
			));
			$Islediyi_Vezife_Sor=$db->prepare("SELECT * FROM user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi DESC");
			$Islediyi_Vezife_Sor->execute(array(
				'ID'=>$ID));
			$Islediyi_Vezife_Say=$Islediyi_Vezife_Sor->rowCount();
			$Islediyi_Vezife_Cek=$Islediyi_Vezife_Sor->fetch(PDO::FETCH_ASSOC);
			$User_Islediyi_Vezife_Id=$Islediyi_Vezife_Cek['User_Islediyi_Vezife_Id'];

			$update=$db->prepare("UPDATE user_islediyi_vezife SET
				Vezifeden_Azad_Olunma_Tarixi=:Vezifeden_Azad_Olunma_Tarixi					
				where User_Islediyi_Vezife_Id=$User_Islediyi_Vezife_Id
				");
			$yenile=$update->execute(array(
				'Vezifeden_Azad_Olunma_Tarixi'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix				
			));
			$Elave_Et=$db->prepare("INSERT INTO user_islediyi_vezife SET
				ID=:ID,			
				Idare_Ad=:Idare_Ad,			
				Sobe_Ad=:Sobe_Ad,			
				Vezife_Ad=:Vezife_Ad,			
				Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id,			
				Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi			
				");
			$Insert=$Elave_Et->execute(array(
				'ID'=>$ID,		
				'Idare_Ad'=>$Idare_Adi,		
				'Sobe_Ad'=>$Sobe_Adi,		
				'Vezife_Ad'=>$Vezife_Adi,		
				'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id,		
				'Vezifeye_Teyin_Tarixi'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix		
			));			
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
				if ($intizam_tenbehi_adlari_id==5) {

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