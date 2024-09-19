<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=EditorluIcerikleriFiltrle($deyer['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id']);
	$Ad_Sor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari where intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id");
	$Ad_Sor->execute(array(
		'intizam_tenbehi_adlari_id'=>$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id));
	$Ad_Cek=$Ad_Sor->fetch(PDO::FETCH_ASSOC);
	$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=$Ad_Cek['intizam_tenbehi_adlari_ad'];
	$Intizam_Tenbehi_Sebeb=EditorluIcerikleriFiltrle($deyer['Intizam_Tenbehi_Sebeb']);
	$Intizam_Tenbehi_Emrinin_Nomresi=EditorluIcerikleriFiltrle($deyer['Intizam_Tenbehi_Emrinin_Nomresi']);
	$Intizam_Tenbehi_Id=ReqemlerXaricButunKarakterleriSil($deyer['Intizam_Tenbehi_Id']);

	$Tedbiq_Edildiyi_Tarix     =strtotime($deyer['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']) ; 
	$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix                =date("d.m.Y", $Tedbiq_Edildiyi_Tarix);

	$Bitis_Tarixi=strtotime($deyer['Intizam_Tenbehinin_Bitis_Tarixi']);	
	if ($Bitis_Tarixi=="") {
		$BitisTarixiHesabla      = date("Y-m-d", $Tedbiq_Edildiyi_Tarix);
		$BitisTarixiCevir      = date_create($BitisTarixiHesabla);
		date_modify($BitisTarixiCevir, "+6 month");
		$Intizam_Tenbehinin_Bitis_Tarixi = date("d.m.Y",(date_timestamp_get($BitisTarixiCevir)));
		$Intizam_Tenbehinin_Bitis_Tarix_Unix=strtotime($Intizam_Tenbehinin_Bitis_Tarixi);
	}else{
		$Intizam_Tenbehinin_Bitis_Tarixi=date("d.m.Y", $Bitis_Tarixi);	
		$Intizam_Tenbehinin_Bitis_Tarix_Unix=$Bitis_Tarixi;
	}
	$Intizam_Sor=$db->prepare("SELECT * FROM  intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
	$Intizam_Sor->execute(array(
		'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id));
	$Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC);
$Intizam_Tenbehi_User_Id=$Intizam_Cek['Intizam_Tenbehi_User_Id'];

	if ($Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad!="") { 
		if ($Intizam_Tenbehi_Sebeb!="") {
			if ($Intizam_Tenbehi_Emrinin_Nomresi!="") {
				if ($Intizam_Tenbehi_Id>0) {
					if ($Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix!="") {			
						if ($Intizam_Tenbehinin_Bitis_Tarixi!="") {			
							$yenile=$db->prepare("UPDATE intizam_tenbehi SET 
								Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,
								Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad,
								Intizam_Tenbehi_Sebeb=:Intizam_Tenbehi_Sebeb,
								Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
								Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix,
								Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi,
								Intizam_Tenbehinin_Bitis_Tarix_Unix=:Intizam_Tenbehinin_Bitis_Tarix_Unix,
								Intizam_Tenbehi_Tesdiq_Durumu=:Intizam_Tenbehi_Tesdiq_Durumu,
								Intizam_Tenbehi_Emrinin_Nomresi=:Intizam_Tenbehi_Emrinin_Nomresi
								WHERE Intizam_Tenbehi_Id=$Intizam_Tenbehi_Id");
							$update=$yenile->execute(array(
								'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,
								'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'=>$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad,
								'Intizam_Tenbehi_Sebeb'=>$Intizam_Tenbehi_Sebeb,
								'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
								'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix'=>$Tedbiq_Edildiyi_Tarix,
								'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Tenbehinin_Bitis_Tarixi,
								'Intizam_Tenbehinin_Bitis_Tarix_Unix'=>$Intizam_Tenbehinin_Bitis_Tarix_Unix,
								'Intizam_Tenbehi_Tesdiq_Durumu'=>1,
								'Intizam_Tenbehi_Emrinin_Nomresi'=>$Intizam_Tenbehi_Emrinin_Nomresi
							));
							if ($update) {
								$Elave_Et=$db->prepare("INSERT INTO  intizam_tenbehi_islemleri SET                               
									Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id,
									Intizam_Tenbehi_User_Id=:Intizam_Tenbehi_User_Id,
									Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,
									Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad,
									Intizam_Tenbehi_Sebeb=:Intizam_Tenbehi_Sebeb,
									Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
									Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix,
									Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi,
									Intizam_Tenbehinin_Bitis_Tarix_Unix=:Intizam_Tenbehinin_Bitis_Tarix_Unix,
									Intizam_Tenbehi_Tesdiq_Durumu=:Intizam_Tenbehi_Tesdiq_Durumu,
									Intizam_Tenbehi_Emrinin_Nomresi=:Intizam_Tenbehi_Emrinin_Nomresi,
									Intizam_tenbehi_Islemleri_Zaman_Damgasi=:Intizam_tenbehi_Islemleri_Zaman_Damgasi,
									Intizam_Tenbehi_Islemleri_IP=:Intizam_Tenbehi_Islemleri_IP,
									Intizam_Tenbehi_Islemleri_Sebeb=:Intizam_Tenbehi_Islemleri_Sebeb,
									Admin_Id=:Admin_Id
									");
								$Insert=$Elave_Et->execute(array(                                
									'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id,
									'Intizam_Tenbehi_User_Id'=>$Intizam_Tenbehi_User_Id,
									'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,
									'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'=>$Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad,
									'Intizam_Tenbehi_Sebeb'=>$Intizam_Tenbehi_Sebeb,
									'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
									'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix'=>$Tedbiq_Edildiyi_Tarix,
									'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Tenbehinin_Bitis_Tarixi,
									'Intizam_Tenbehinin_Bitis_Tarix_Unix'=>$Intizam_Tenbehinin_Bitis_Tarix_Unix,
									'Intizam_Tenbehi_Tesdiq_Durumu'=>1,
									'Intizam_Tenbehi_Emrinin_Nomresi'=>$Intizam_Tenbehi_Emrinin_Nomresi,
									'Intizam_tenbehi_Islemleri_Zaman_Damgasi'=>$TarixSaat,
									'Intizam_Tenbehi_Islemleri_IP'=>$IPAdresi,
									'Intizam_Tenbehi_Islemleri_Sebeb'=>2,
									'Admin_Id'=>$Admin_Id,
								));
								if ($Insert) {?>

									<?php 
									$Intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where Intizam_Tenbehi_User_Id=:Intizam_Tenbehi_User_Id and Intizam_Tenbehi_Tesdiq_Durumu=:Intizam_Tenbehi_Tesdiq_Durumu order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix ASC");
									$Intizam_Sor->execute(array(
										'Intizam_Tenbehi_User_Id'=>$Intizam_Tenbehi_User_Id,
										'Intizam_Tenbehi_Tesdiq_Durumu'=>1));
										?>
										<table class="ListelemeAlaniIciTablosu caption-top">
											<caption><b>Tədbiq olunmuş intizam tədbirləri </b>	<button class="YenileButonlari sag" onclick="YeniIntizamTenbehi()" type="button">Yeni</button></caption>
											<thead>
												<tr>
													<th class="textaligncenter">№</th>
													<th>İntizam tənbehlərinin növü</th>
													<th>Səbəb və qeydlər</th>
													<th>Başlanğıc tarixi</th>
													<th>Bitiş tarixi</th>
													<th>Əmrin №</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$IntizamTenbehiSira=0;
												while($Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC)) {
													$IntizamTenbehiSira++;?>
													<tr>
														<td  class="textaligncenter"><?php echo $IntizamTenbehiSira;?></td>
														<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
														<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Sebeb'] ?></td>
														<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'] ?></td>										
														<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'] ?></td>										
														<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>										
														<td class="emeliyyatlar_iki_buttom">
															<button class="YenileButonlari" id="IntizamTedbiriDuzenle_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriDuzenle(this.id)" type="button">
																<i class="fas fa-edit"></i>
															</button>		
															<button class="YenileButonlari" id="IntizamTedbiriSil_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriSil(this.id)" type="button">
																<i class="fas fa-trash"></i>
															</button>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>

									<?php }else{
										?>

										<?php 
										$Intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where Intizam_Tenbehi_User_Id=:Intizam_Tenbehi_User_Id and Intizam_Tenbehi_Tesdiq_Durumu=:Intizam_Tenbehi_Tesdiq_Durumu order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix ASC");
										$Intizam_Sor->execute(array(
											'Intizam_Tenbehi_User_Id'=>$Intizam_Tenbehi_User_Id,
											'Intizam_Tenbehi_Tesdiq_Durumu'=>1));
											?>
											<table class="ListelemeAlaniIciTablosu caption-top">
												<caption><b>Tədbiq olunmuş intizam tədbirləri </b>	<button class="YenileButonlari sag" onclick="YeniIntizamTenbehi()" type="button">Yeni</button></caption>
												<thead>
													<tr>
														<th class="textaligncenter">№</th>
														<th>İntizam tənbehlərinin növü</th>
														<th>Səbəb və qeydlər</th>
														<th>Başlanğıc tarixi</th>
														<th>Bitiş tarixi</th>
														<th>Əmrin №</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$IntizamTenbehiSira=0;
													while($Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC)) {
														$IntizamTenbehiSira++;?>
														<tr>
															<td  class="textaligncenter"><?php echo $IntizamTenbehiSira;?></td>
															<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
															<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Sebeb'] ?></td>
															<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'] ?></td>										
															<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'] ?></td>										
															<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>										
															<td class="emeliyyatlar_iki_buttom">
																<button class="YenileButonlari" id="IntizamTedbiriDuzenle_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriDuzenle(this.id)" type="button">
																	<i class="fas fa-edit"></i>
																</button>		
																<button class="YenileButonlari" id="IntizamTedbiriSil_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriSil(this.id)" type="button">
																	<i class="fas fa-trash"></i>
																</button>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>

											<?php 
										}
									}else{
										echo "error_2006";/* kissa Adı boş ola bilməz*/
										exit;
									}		
								}else{
									echo "error_2005";/* tarix*/
									exit;
								}							
							}else{
								echo "error_2005";/* tarix*/
								exit;
							}					
						}else{
							echo "error_2004";/*İd*/
							exit;
						}
					}else{
						echo "error_2003";/* Emrin nomresi*/
						exit;
					}
				}else{
					echo "error_2002";/* sebeb*/
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