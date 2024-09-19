<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Rutbe_Id=ReqemlerXaricButunKarakterleriSil($deyer['Rutbe_Id']);
	$Rutbe_Emri_Tarixi_Unix=strtotime($deyer['Rutbe_Emri_Tarixi']);
	$Rutbe_Emri_Tarixi=date("d.m.Y", $Rutbe_Emri_Tarixi_Unix);
	$Rutbe_Emri_Tarixi_Bey=date("Y-m-d", $Rutbe_Emri_Tarixi_Unix);
	$Rutbe_Emri_Novu=EditorluIcerikleriFiltrle($deyer['Rutbe_Emri_Novu']);
	$Rutbe_Emrinin_No=EditorluIcerikleriFiltrle($deyer['Rutbe_Emrinin_No']);
	$ID=ReqemlerXaricButunKarakterleriSil($deyer['ID']);

	$Ad_Sor=$db->prepare("SELECT * FROM  rutbe where Rutbe_Id=:Rutbe_Id");
	$Ad_Sor->execute(array(
		'Rutbe_Id'=>$Rutbe_Id));
	$Rutbe_Say=$Ad_Sor->rowCount();
	$Ad_Cek=$Ad_Sor->fetch(PDO::FETCH_ASSOC);
	$Rutbe_Adi=$Ad_Cek['Rutbe_Adi'];	
	$User_sor=$db->prepare("SELECT * FROM  user where ID=:ID and Durum=:Durum");
	$User_sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_sor->rowCount();
	if ($Rutbe_Adi!="" and $Rutbe_Id!="" and $Rutbe_Emri_Tarixi_Unix!="" and $Rutbe_Emri_Tarixi!="" and $Rutbe_Emri_Novu!="" and $Rutbe_Emrinin_No!="" and $User_Say==1 and $Rutbe_Say==1) {
		$Elave_Et=$db->prepare("INSERT INTO  rutbe_emri SET                               
			Rutbe_Id=:Rutbe_Id,
			Rutbe_Adi=:Rutbe_Adi,
			ID=:ID,
			Rutbe_Emri_Novu=:Rutbe_Emri_Novu,
			Rutbe_Emri_Tarixi=:Rutbe_Emri_Tarixi,
			Rutbe_Emri_Tarixi_Unix=:Rutbe_Emri_Tarixi_Unix,
			Rutbe_Emri_Tarixi_Bey=:Rutbe_Emri_Tarixi_Bey,
			ZamanDamgasi=:ZamanDamgasi,
			TarixSaat=:TarixSaat,
			Rutbe_Emri_Durum=:Rutbe_Emri_Durum,
			Rutbe_Emrinin_No=:Rutbe_Emrinin_No
			");
		$Insert=$Elave_Et->execute(array(                                
			'Rutbe_Id'=>$Rutbe_Id,		
			'Rutbe_Adi'=>$Rutbe_Adi,		
			'ID'=>$ID,		
			'Rutbe_Emri_Novu'=>$Rutbe_Emri_Novu,		
			'Rutbe_Emri_Tarixi'=>$Rutbe_Emri_Tarixi,		
			'Rutbe_Emri_Tarixi_Unix'=>$Rutbe_Emri_Tarixi_Unix,		
			'Rutbe_Emri_Tarixi_Bey'=>$Rutbe_Emri_Tarixi_Bey,		
			'ZamanDamgasi'=>$ZamanDamgasi,		
			'TarixSaat'=>$TarixSaat,		
			'Rutbe_Emri_Durum'=>1,		
			'Rutbe_Emrinin_No'=>$Rutbe_Emrinin_No	
		));
		if ($Insert) {
			$Rutbe_Emri_Id=$db->lastInsertId();
			$Elave_Et=$db->prepare("INSERT INTO rutbe_emri_islemleri SET                               
				Rutbe_Emri_Id=:Rutbe_Emri_Id,
				Admin_Id=:Admin_Id,
				IPAdresi=:IPAdresi,
				Rutbe_Emri_Islemleri_Sebeb=:Rutbe_Emri_Islemleri_Sebeb,
				Rutbe_Id=:Rutbe_Id,
				Rutbe_Adi=:Rutbe_Adi,
				ID=:ID,
				Rutbe_Emri_Novu=:Rutbe_Emri_Novu,
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
				'Rutbe_Emri_Islemleri_Sebeb'=>5,		
				'Rutbe_Id'=>$Rutbe_Id,		
				'Rutbe_Adi'=>$Rutbe_Adi,		
				'ID'=>$ID,		
				'Rutbe_Emri_Novu'=>$Rutbe_Emri_Novu,		
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
														if ($Rutbe_Cek['Rutbe_Emri_Novu']==1) {
													$Rutbe_Emri_Novu="İlkin xüsusi rütbənin verilməsi";
												}	elseif ($Rutbe_Cek['Rutbe_Emri_Novu']==2) {
													$Rutbe_Emri_Novu="Növbəti xüsusi rütbənin verilməsi";
												}	elseif ($Rutbe_Cek['Rutbe_Emri_Novu']==3) {
													$Rutbe_Emri_Novu="Vaxdından əvvəl xüsusi rütbənin verilməsi";
												}elseif ($Rutbe_Cek['Rutbe_Emri_Novu']==4) {
													$Rutbe_Emri_Novu="Bir pillə yuxarı xüsusi rütbənin verilməsi";
												}
												
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
													<td><?php echo $Rutbe_Emri_Novu ?></td>
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