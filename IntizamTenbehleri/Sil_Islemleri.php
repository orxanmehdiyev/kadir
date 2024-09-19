<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {	
	$Intizam_Tenbehi_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM  intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
	$Sor->execute(array(
		'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id));
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$ID=$Cek['ID'];
		$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=$Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'];
		$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=$Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'];
		$Intizam_Tenbehi_Sebeb=$Cek['Intizam_Tenbehi_Sebeb'];
		$Intizam_Tenbehinin_Bitis_Tarixi=$Cek['Intizam_Tenbehinin_Bitis_Tarixi'];
		$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=$Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
		$Intizam_Tenbehi_Emrinin_Nomresi=$Cek['Intizam_Tenbehi_Emrinin_Nomresi'];

		$Islediyi_Idare_Id=$Cek['Islediyi_Idare_Id'];
		$Islediyi_Sobe_Id=$Cek['Islediyi_Sobe_Id'];
		$Vezife_Id=$Cek['Vezife_Id'];


		$sil = $db->prepare("DELETE from intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
		$kontrol = $sil->execute(array(
			'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
		));	

		if ($Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id==5){
			$Stat_deyisikliyi_Sor=$db->prepare("SELECT * FROM  stat_deyisikliyi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
			$Stat_deyisikliyi_Sor->execute(array(
				'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id));
			$Stat_deyisikliyi_Cek=$Stat_deyisikliyi_Sor->fetch(PDO::FETCH_ASSOC);

			$Islediyi_Idare_Id=$Stat_deyisikliyi_Cek['Islediyi_Idare_Faktiki'];
			$Islediyi_Sobe_Id=$Stat_deyisikliyi_Cek['Islediyi_Sobe_Faktiki'];
			$Vezife_Id=$Stat_deyisikliyi_Cek['Vezife_Id_Faktiki'];
			$Is_Novu=$Stat_deyisikliyi_Cek['User_Is_Novu_Faktiki'];
			$Vezifeye_Teyin_Tarixi=$Stat_deyisikliyi_Cek['Vezifeye_Teyin_Etme_Tarixi_Faktiki'];

			$sil = $db->prepare("DELETE from stat_deyisikliyi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
			$kontrol = $sil->execute(array(
				'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
			));	

			$idare_Sor=$db->prepare("SELECT * FROM  idare where Idare_Id=:Idare_Id ");
			$idare_Sor->execute(array(
				'Idare_Id'=>$Islediyi_Idare_Id));
			$Idare_Cek=$idare_Sor->fetch(PDO::FETCH_ASSOC);
			$Idare_Adi=$Idare_Cek['Idare_Adi'];

			$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id ");
			$Sobe_Sor->execute(array(
				'Sobe_Id'=>$Islediyi_Sobe_Id));
			$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
			$Sobe_Adi=$Sobe_Cek['Sobe_Ad'];

			$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id ");
			$Vezife_Sor->execute(array(
				'Vezife_Id'=>$Vezife_Id));
			$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
			$Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];

			$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id ");
			$Vezife_Adlari_Sor->execute(array(
				'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
			$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
			$Vezife_Adi=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];

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
				'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
				'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,
				'Vezife_Id'=>$Vezife_Id,
				'Vezifeye_Teyin_Tarixi'=>$Vezifeye_Teyin_Tarixi,
				'Idare_Ad'=>$Idare_Adi,
				'Sobe_Ad'=>$Sobe_Adi,
				'Vezife_Ad'=>$Vezife_Adi,
				'Is_Novu'=>$Is_Novu
			));
			$bos="";
			$update=$db->prepare("UPDATE vezife SET
				User_Id=:User_Id				
				where User_Id=$ID
				");
			$yenile=$update->execute(array(
				'User_Id'=>$bos		
			));

			$update=$db->prepare("UPDATE vezife SET
				User_Id=:User_Id				
				where Vezife_Id=$Vezife_Id
				");
			$yenile=$update->execute(array(
				'User_Id'=>$ID		
			));

			$sil = $db->prepare("DELETE from user_islediyi_vezife where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
			$kontrol = $sil->execute(array(
				'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
			));	

			$Islediyi_Vezife_Sor=$db->prepare("SELECT * FROM user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi DESC");
			$Islediyi_Vezife_Sor->execute(array(
				'ID'=>$ID));
			$Islediyi_Vezife_Say=$Islediyi_Vezife_Sor->rowCount();
			$Islediyi_Vezife_Cek=$Islediyi_Vezife_Sor->fetch(PDO::FETCH_ASSOC);
			$User_Islediyi_Vezife_Id=$Islediyi_Vezife_Cek['User_Islediyi_Vezife_Id'];
			$bos="";
			$update=$db->prepare("UPDATE user_islediyi_vezife SET
				Vezifeden_Azad_Olunma_Tarixi=:Vezifeden_Azad_Olunma_Tarixi					
				where User_Islediyi_Vezife_Id=$User_Islediyi_Vezife_Id
				");
			$yenile=$update->execute(array(
				'Vezifeden_Azad_Olunma_Tarixi'=>$bos				
			));



		}




		if ($Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id==6){
			$sil = $db->prepare("DELETE from rutbe_emri where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
			$kontrol = $sil->execute(array(
				'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id
			));	
		}
		if ($kontrol) {
			$bos="";
			if ($Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id==7) {
				$update=$db->prepare("UPDATE user SET
					Serencam_Durum=:Serencam_Durum,
					Islediyi_Idare_Id=:Islediyi_Idare_Id,
					Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
					Vezife_Id=:Vezife_Id,
					Isden_Cixarilma_Idare_Id=:Isden_Cixarilma_Idare_Id,
					Isden_Cixarilma_Sobe_Id=:Isden_Cixarilma_Sobe_Id,
					Isden_Cixarilma_Vezife_Id=:Isden_Cixarilma_Vezife_Id
					where ID=$ID
					");
				$yenile=$update->execute(array(
					'Serencam_Durum'=>0,
					'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
					'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,
					'Vezife_Id'=>$Vezife_Id,
					'Isden_Cixarilma_Idare_Id'=>$bos,
					'Isden_Cixarilma_Sobe_Id'=>$bos,
					'Isden_Cixarilma_Vezife_Id'=>$bos
				));
				$update=$db->prepare("UPDATE vezife SET
					User_Id=:User_Id
					where Vezife_Id=$Vezife_Id
					");
				$yenile=$update->execute(array(
					'User_Id'=>$ID
				));
			}

			if ($Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id==8 or $Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id==9 ) {
				$bos="";
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
					'Durum'=>1,
					'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,
					'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,
					'Vezife_Id'=>$Vezife_Id,
					'Isden_Cixarilma_Idare_Id'=>$bos,
					'Isden_Cixarilma_Sobe_Id'=>$bos,
					'Isden_Cixarilma_Vezife_Id'=>$bos,
					'xitam_sebebleri_id'=>$bos,
					'xitam_sebebleri_kisa_ad'=>$bos,
					'Isden_Cixarilma_Emir_No'=>$bos,
					'Isden_Cixarilma_Tarixi'=>$bos
				));
				$update=$db->prepare("UPDATE vezife SET
					User_Id=:User_Id
					where Vezife_Id=$Vezife_Id
					");
				$yenile=$update->execute(array(
					'User_Id'=>$ID
				));

			}

			

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
				'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'=>$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad,  
				'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,  
				'ID'=>$ID							
			));
			if ($Insert) {
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Uğurla silindi</span>">';
				$Sor=$db->prepare("SELECT * FROM   intizam_tenbehi order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC,Intizam_Tenbehi_Id DESC ");
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
				echo '<input type="hidden" id="status" value="error">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Silinməd Uğursuz. Id Tapılmad</span>">';
			}
		}else{
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Silinməf Uğursuz. Id Tapılmad</span>">';
		}
	}else{
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugursuz\'><i class=\'fas fa-times\'></i> Silinməg Uğursuz. Id Tapılmad</span>">';
	}
}else{
	header("Location:../ise_qebul_emri");
	exit;
}?>
