<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {	
	$Rutbe_Emri_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Rutbe_Sor=$db->prepare("SELECT * FROM  rutbe_emri where Rutbe_Emri_Id=:Rutbe_Emri_Id");
	$Rutbe_Sor->execute(array(
		'Rutbe_Emri_Id'=>$Rutbe_Emri_Id));
	$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
	$Rutbe_Say=$Rutbe_Sor->rowCount();
	$Rutbe_Emrinin_No=$Rutbe_Cek['Rutbe_Emrinin_No'];
	$Rutbe_Emri_Tarixi_Unix=$Rutbe_Cek['Rutbe_Emri_Tarixi_Unix'];
	$Rutbe_Emri_Tarixi=$Rutbe_Cek['Rutbe_Emri_Tarixi'];
	$Rutbe_Emri_Sebeb=$Rutbe_Cek['Rutbe_Emri_Sebeb'];
	$ID=$Rutbe_Cek['ID'];
	$Rutbe_Adi=$Rutbe_Cek['Rutbe_Adi'];
	$Rutbe_Id=$Rutbe_Cek['Rutbe_Id'];
	$Rutbe_Img=$Rutbe_Cek['Rutbe_Img'];
	$sileine="../".$Rutbe_Img;



	if ($Rutbe_Say==1) {
		$sil = $db->prepare("DELETE from  rutbe_emri where Rutbe_Emri_Id=:Rutbe_Emri_Id");
		$kontrol = $sil->execute(array(
			'Rutbe_Emri_Id' => $Rutbe_Emri_Id
		));
		if ($kontrol) {
			@unlink($sileine);
			$Rutbe_Emri_Id=$db->lastInsertId();
			$Elave_Et=$db->prepare("INSERT INTO rutbe_emri_islemleri SET                               
				Rutbe_Emri_Id=:Rutbe_Emri_Id,
				Admin_Id=:Admin_Id,
				IPAdresi=:IPAdresi,
				Rutbe_Emri_Islemleri_Sebeb=:Rutbe_Emri_Islemleri_Sebeb,
				Rutbe_Id=:Rutbe_Id,
				Rutbe_Adi=:Rutbe_Adi,
				ID=:ID,
				Rutbe_Emri_Sebeb=:Rutbe_Emri_Sebeb,
				Rutbe_Emri_Tarixi=:Rutbe_Emri_Tarixi,
				Rutbe_Emri_Tarixi_Unix=:Rutbe_Emri_Tarixi_Unix,
				ZamanDamgasi=:ZamanDamgasi,
				TarixSaat=:TarixSaat,
				Rutbe_Emri_Durum=:Rutbe_Emri_Durum,
				Rutbe_Emrinin_No=:Rutbe_Emrinin_No
				");
			$Insert=$Elave_Et->execute(array(                                
				'Rutbe_Emri_Id'=>$Rutbe_Emri_Id,		
				'Admin_Id'=>$Admin_Id,		
				'IPAdresi'=>$IPAdresi,		
				'Rutbe_Emri_Islemleri_Sebeb'=>3,		
				'Rutbe_Id'=>$Rutbe_Id,		
				'Rutbe_Adi'=>$Rutbe_Adi,		
				'ID'=>$ID,		
				'Rutbe_Emri_Sebeb'=>$Rutbe_Emri_Sebeb,		
				'Rutbe_Emri_Tarixi'=>$Rutbe_Emri_Tarixi,		
				'Rutbe_Emri_Tarixi_Unix'=>$Rutbe_Emri_Tarixi_Unix,		
				'ZamanDamgasi'=>$ZamanDamgasi,		
				'TarixSaat'=>$TarixSaat,		
				'Rutbe_Emri_Durum'=>1,		
				'Rutbe_Emrinin_No'=>$Rutbe_Emrinin_No	
			));
			if ($Insert) {?>

				<?php 
				$Rutbe_Sor=$db->prepare("SELECT * FROM  rutbe_emri where ID=:ID and Rutbe_Emri_Durum=:Rutbe_Emri_Durum order by Rutbe_Emri_Tarixi_Unix ASC");
				$Rutbe_Sor->execute(array(
					'ID'=>$ID,
					'Rutbe_Emri_Durum'=>1));
					?>
					<table class="ListelemeAlaniIciTablosu caption-top">
										<caption><b>Aldığı Rütbələr </b>	<button class="YenileButonlari sag" onclick="YeniEtrafliRutbe()" type="button">Yeni</button></caption>
										<thead>
											<tr>
												<th class="textaligncenter">№</th>
												<th>Şəkil</th>
												<th>Adı</th>
												<th>Səbəb</th>
												<th>Tarixi</th>												
												<th>Əmrin №</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$RutbeSira=0;
											while($Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC)) {
												$RutbeSira++;
												if (strlen($Rutbe_Cek['Rutbe_Img'])>0) {
													$RutbeSekli=$Rutbe_Cek['Rutbe_Img'];
												}else{
													$RutbeSekli="Senedler/Rutbe/nophoto.png";
												}
												?>
												<tr>
													<td  class="textaligncenter"><?php echo $RutbeSira;?></td>
													<td style="width: 60px; cursor: pointer; margin: 0;padding: 0;">
														<label style="cursor: pointer;" for="Rutbesekli_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>"><img id="rutbeimage_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>" src="<?php echo $RutbeSekli ?>" style="width: 60px;height: 76px;cursor: pointer;"></label>														
														<form  method="post" enctype="multipart/form-data" id="RutbesekilFormu_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>">
															<input type="hidden" name="RutbeSekliYukle">
															<input type="hidden" name="Rutbe_Emri_Id" value="<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>">
															<input type="file" class="fileuploadgizliinput" name="file" id="Rutbesekli_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>"  onchange="YeniRutbeSekliYukle(this.form)">															
														</form>

													</td>
													<td><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></td>
													<td><?php echo $Rutbe_Cek['Rutbe_Emri_Sebeb'] ?></td>
													<td><?php echo $Rutbe_Cek['Rutbe_Emri_Tarixi'] ?></td>
													<td><?php echo $Rutbe_Cek['Rutbe_Emrinin_No'] ?></td>										
													<td class="emeliyyatlar_iki_buttom">
														<button class="YenileButonlari" id="RutbeDuzenle_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>" onclick="RutbeDuzenle(this.id)" type="button">
															<i class="fas fa-edit"></i>
														</button>		
														<button class="YenileButonlari" id="RutbeSil_<?php echo $Rutbe_Cek['Rutbe_Emri_Id'] ?>" onclick="RutbeSil(this.id)" type="button">
															<i class="fas fa-trash"></i>
														</button>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>

				<?php }else{
					echo "error_2002";/* Adı boş ola bilməz*/
					exit;
				}
			}else{
				echo "error_2002";/* Adı boş ola bilməz*/
				exit;
			}
		}else{
			echo "error_2001";/* Adı boş ola bilməz*/
			exit;
		}
	}else{
		header("Location:../intizam_tebehi_adlari");
		exit;
	}
?>