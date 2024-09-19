<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$tarixbaslagic    =  date("Y-m-d",strtotime($deyer['tarixbaslagic'])); 
	$tarixbitis       =  date("Y-m-d",strtotime($deyer['tarixbitis']));
	?>
	<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">				
		<thead class="sabit">							
			<tr class="textaligncenter" >
				<th style="width:50px;">ID</th>
				<th>Şəkli</th>
				<th>Soyadı</th>
				<th>Adı</th>
				<th>Atasının<br/> adı</th>
				<th>Gömrük orqanı</th>
				<th style="width: 70px; ">Sturuktur bölmə</th>
				<th>Vəzifə</th>
				<th>Attestasiyadan kecdiyi gömrük orqanı</th>
				<th style="width: 70px; ">Attestasiyadan kecdiyi bölmə</th>
				<th>Attestasiyadan kecdiyi vəzifə</th>
				<th class="tarixsutunu">Son at. tar.</th>
				<th class="tarixsutunu">Növbəti at. tar.</th>								
				<th>Qərar</th>
				<th class="tarixsutunu">Bal</th>
				<th class="tarixsutunu">Qiymetlendirme</th>

			</tr>							
		</thead>
		<tbody>
			<?php 
			if ($UmumiBaxisButunIdareler==1) {
				$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC");
				$Idare_Sor->execute(array(
					'Durum'=>1));
			}else{
				$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id and  Durum=:Durum order by Sira_No ASC");
				$Idare_Sor->execute(array(
					'Idare_Id'=>$Islediyi_Idare_Id,
					'Durum'=>1));
			}

			while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
				$Idare_Id= $Idare_Cek['Idare_Id'];
				$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
				$Sobe_Sor->execute(array(
					'Idare_Id'=>$Idare_Id,
					'Durum'=>1));								
				while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {	
					$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id   and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and vezife.User_Id>:User_Id and Stat_Muqavile=:Stat_Muqavile and Zabit_Mulu=:Zabit_Mulu  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
					$Vezife_Sor->execute(array(
						'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
						'Vezife_Adlari_Durum'=>1,
						'User_Id'=>0,
						'Stat_Muqavile'=>0,
						'Zabit_Mulu'=>0
					));									
					while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {								
						$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
						$Sor->execute(array(
							'ID'=>$Vezife_Cek['User_Id']));
						$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
						$Ad=$Cek['Adi'];
						$Soy_Adi=$Cek['Soy_Adi'];
						$Ata_Adi=$Cek['Ata_Adi'];
						$Ise_Qebul_Tarixi      =  Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Qebul_Tarixi']);	
						$Ise_Qebul_Tarixi_beynelxalq      =  $Cek['Ise_Qebul_Tarixi'];	
						$Islediyi_Idare_Id      =  $Cek['Islediyi_Idare_Id'];	
						$Islediyi_Sobe_Id      =  $Cek['Islediyi_Sobe_Id'];	
						$Vezife_Id      =  $Cek['Vezife_Id'];	

						$VezifeteyinSor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID order by Vezifeye_Teyin_Etme_Tarixi DESC");
						$VezifeteyinSor->execute(array(
							'ID'=>$Vezife_Cek['User_Id']));
						$VezifeteyinCek=$VezifeteyinSor->fetch(PDO::FETCH_ASSOC);
						$Vezifeye_Teyin_Etme_Tarixi=$VezifeteyinCek['Vezifeye_Teyin_Etme_Tarixi'];

						$StadDeyisikliSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID order by Vezifeye_Teyin_Etme_Tarixi DESC");
						$StadDeyisikliSor->execute(array(
							'ID'=>$Vezife_Cek['User_Id']));
						$StadDeyisikliCek=$StadDeyisikliSor->fetch(PDO::FETCH_ASSOC);
						$VezifeyeTarixi=$StadDeyisikliCek['Vezifeye_Teyin_Etme_Tarixi'];

						if ($Ise_Qebul_Tarixi_beynelxalq>$Vezifeye_Teyin_Etme_Tarixi and $Ise_Qebul_Tarixi_beynelxalq>$VezifeyeTarixi) {
							$Tarix=$Ise_Qebul_Tarixi_beynelxalq;
						}elseif($Vezifeye_Teyin_Etme_Tarixi>$Ise_Qebul_Tarixi_beynelxalq and $Vezifeye_Teyin_Etme_Tarixi>$VezifeyeTarixi){
							$Tarix=$Vezifeye_Teyin_Etme_Tarixi;
						}elseif($VezifeyeTarixi>$Ise_Qebul_Tarixi_beynelxalq and $VezifeyeTarixi>$Vezifeye_Teyin_Etme_Tarixi){
							$Tarix=$VezifeyeTarixi;
						}



						$Dogum_Tarixi=Tarix_Beynelxalqi_Az_Cevir($Cek['Dogum_Tarixi']);
						$Dogum_Tarixi_beynelxalq=$Cek['Dogum_Tarixi'];
						$bugun = date("Y-m-d", $ZamanDamgasi);
						$diff = date_diff(date_create($Cek['Dogum_Tarixi']), date_create($bugun));
						$yasin=$diff->format('%y');
						$Yasayis_Unvan      =  $Cek['Yasayis_Unvan'];
						$Doguldugu_Unvan      =  $Cek['Doguldugu_Unvan'];				


						$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
						$Rutbe_Emri_Sor->execute(array(
							'ID'=>$Cek['ID']));
						$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
						if (strlen($Rutbe_Emri_Cek['Rutbe_Img'])>0) {

							$RutbeSekli='<img src="'.$Rutbe_Emri_Cek['Rutbe_Img'].'" class=" mx-auto d-block" style="width:96px;height: 100px;" alt="...">';
						}else{		

							$RutbeSekli='<img src="Senedler/Rutbe/nophoto.png" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
						}

						$Atest_Sor=$db->prepare("SELECT * FROM  attestasiya_emri where ID=:ID and Attestasiya_Tarix>=:Bir and Attestasiya_Tarix<=:Iki order by Attestasiya_Tarix DESC ");
						$Atest_Sor->execute(array(
							'ID'=>$Cek['ID'],
							'Bir'=>$tarixbaslagic,
							'Iki'=>$tarixbitis
						));
						$Atest_Say=$Atest_Sor->rowCount();
						if ($Atest_Say) {
							while($Atest_Cek=$Atest_Sor->fetch(PDO::FETCH_ASSOC)){

								if ($Atest_Cek['Attestasiya_Qerar']==0) {
									$Attestasiya_Qerar="Tutduğu vəzifəyə uyğundur";
									$qerar="Tutduğu vəzifəyə uyğundur";
								}elseif ($Atest_Cek['Attestasiya_Qerar']==1) {
									$Attestasiya_Qerar="İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur";
									$qerar="İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur";
								}elseif ($Atest_Cek['Attestasiya_Qerar']==2) {
									$Attestasiya_Qerar="Tutduğu vəzifəyə uyğun deyil";
									$qerar="Tutduğu vəzifəyə uyğun deyil";
								}
								?>

								<tr class="vertikalmidle">
									<td class="textaligncenter"><?php echo $Vezife_Cek['User_Id']>0 ? $Vezife_Cek['User_Id']:"";?></td>
									<?php if ($Vezife_Cek['User_Id']>0) {?>
										<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
									<?php   }else{?>
										<td></td>
									<?php 	} ?>

									<td><?php echo $Soy_Adi ?></td>
									<td><?php echo $Ad ?></td>
									<td><?php echo $Ata_Adi ?></td>
									<td class="textaligncenter"><?php echo IdareQissaAdi($Islediyi_Idare_Id, $db) ?></td>
									<td class="textaligncenter" style="word-break: break-word;"><?php echo  SobeAdi($Islediyi_Sobe_Id, $db) ?></td>
									<td class="textaligncenter"><?php echo VezifeAdi($Vezife_Id, $db) ?></td>	

									<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Atest_Cek['Idare_Adi'] ?></td>
									<td class="textaligncenter" style="word-break: break-word;"><?php echo $Atest_Cek['Sobe_Ad'] ?></td>
									<td class="textaligncenter"><?php echo $Atest_Cek['Vezife_Ad'] ?></td>	
									<td data-sort="<?php echo $Atest_Cek['Attestasiya_Tarix'] ?>" class="textaligncenter"><?php echo date("d.m.Y",strtotime($Atest_Cek['Attestasiya_Tarix']))?></td>									
									<td data-sort="<?php echo $Atest_Cek['Attestasiya_Tarix_Novbeti']?>" class="textaligncenter"><?php echo date("d.m.Y",strtotime($Atest_Cek['Attestasiya_Tarix_Novbeti']))?></td>

									<td data-sort="<?php echo $qerar ?>"><?php echo $Attestasiya_Qerar ?></td>		
									<td class="textaligncenter"><?php echo $Atest_Cek['Topladigi_Bal']?></td>
									<td class="textaligncenter"><?php echo $Atest_Cek['Qiymetlendirme_Bali']?></td>																			
								</tr>
							<?php   }
						}
						}
					} 
				}?>
			</tbody>
		</table>

	<?php }else{
		header("Location:../index.php");
		exit;
	}
?>