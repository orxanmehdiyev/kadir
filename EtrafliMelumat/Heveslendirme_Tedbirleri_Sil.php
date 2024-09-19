<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {

	$Hevesledirme_Tedbirleri_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Heveslendirme_Tedbiri_Sor=$db->prepare("SELECT * FROM hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id");
	$Heveslendirme_Tedbiri_Sor->execute(array(
		'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id
	));
	$Heveslendirme_Tedbiri_Cek=$Heveslendirme_Tedbiri_Sor->fetch(PDO::FETCH_ASSOC);
	$Hevesledirme_Tedbirleri_User_Id=$Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_User_Id'];
	$Heveslendirem_Tedbirleri_Ad_Id=$Heveslendirme_Tedbiri_Cek['Heveslendirem_Tedbirleri_Ad_Id'];
	$Heveslendirem_Tedbirleri_Ad=$Heveslendirme_Tedbiri_Cek['Heveslendirem_Tedbirleri_Ad'];
	$Hevesledirme_Tedbirleri_Sebeb=$Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Sebeb'];
	$Hevesledirme_Tedbirleri_Tarix=$Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Tarix'];
	$Hevesledirme_Tedbirleri_Tesdiq_Durumu=$Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Tesdiq_Durumu'];
	$Hevesledirme_Tedbirleri_Emrinin_Nomresi=$Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Emrinin_Nomresi'];
	

	if ($Heveslendirem_Tedbirleri_Ad_Id!="") { 
		if ($Hevesledirme_Tedbirleri_Sebeb!="") {
			if ($Hevesledirme_Tedbirleri_Emrinin_Nomresi!="") {
				if ($Hevesledirme_Tedbirleri_Id>0) {
					if ($Hevesledirme_Tedbirleri_Tarix!="") {						
						$sil = $db->prepare("DELETE from hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id");
						$kontrol = $sil->execute(array(
							'Hevesledirme_Tedbirleri_Id' => $Hevesledirme_Tedbirleri_Id
						));
						if ($kontrol) {
							$Elave_Et=$db->prepare("INSERT INTO  hevesledirme_tedbirleri_islemleri SET                               
								Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id,
								Heveslendirem_Tedbirleri_Ad_Id=:Heveslendirem_Tedbirleri_Ad_Id,
								Heveslendirem_Tedbirleri_Ad=:Heveslendirem_Tedbirleri_Ad,
								Hevesledirme_Tedbirleri_Sebeb=:Hevesledirme_Tedbirleri_Sebeb,
								Hevesledirme_Tedbirleri_Tarix=:Hevesledirme_Tedbirleri_Tarix,
								Zaman_Damgasi=:Zaman_Damgasi,
								Tarix_Saat=:Tarix_Saat,
								Hevesledirme_Tedbirleri_Emrinin_Nomresi=:Hevesledirme_Tedbirleri_Emrinin_Nomresi,
								Hevesledirme_Tedbirleri_User_Id=:Hevesledirme_Tedbirleri_User_Id,
								Hevesledirme_Tedbirleri_Islemleri_Ip=:Hevesledirme_Tedbirleri_Islemleri_Ip,
								Admin_Id=:Admin_Id,
								Admin_Ad=:Admin_Ad,
								Admin_Soyad=:Admin_Soyad,
								Admin_Ataadi=:Admin_Ataadi,
								Hevesledirme_Tedbirleri_Islemleri_Islem_Sebebi=:Hevesledirme_Tedbirleri_Islemleri_Islem_Sebebi,
								Hevesledirme_Tedbirleri_Tesdiq_Durumu=:Hevesledirme_Tedbirleri_Tesdiq_Durumu
								");
							$Insert=$Elave_Et->execute(array(                                
								'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id,
								'Heveslendirem_Tedbirleri_Ad_Id'=>$Heveslendirem_Tedbirleri_Ad_Id,
								'Heveslendirem_Tedbirleri_Ad'=>$Heveslendirem_Tedbirleri_Ad,
								'Hevesledirme_Tedbirleri_Sebeb'=>$Hevesledirme_Tedbirleri_Sebeb,
								'Hevesledirme_Tedbirleri_Tarix'=>$Hevesledirme_Tedbirleri_Tarix,
								'Zaman_Damgasi'=>$ZamanDamgasi,
								'Tarix_Saat'=>$TarixSaat,
								'Hevesledirme_Tedbirleri_Emrinin_Nomresi'=>$Hevesledirme_Tedbirleri_Emrinin_Nomresi,
								'Hevesledirme_Tedbirleri_User_Id'=>$Hevesledirme_Tedbirleri_User_Id,
								'Hevesledirme_Tedbirleri_Islemleri_Ip'=>$IPAdresi,
								'Admin_Id'=>$Admin_Id,
								'Admin_Ad'=>$Admin_Ad,
								'Admin_Soyad'=>$Admin_Soyad,
								'Admin_Ataadi'=>$Admin_Ataadi,
								'Hevesledirme_Tedbirleri_Islemleri_Islem_Sebebi'=>3,
								'Hevesledirme_Tedbirleri_Tesdiq_Durumu'=>1
							));
							if ($Insert) {
								$Heveslendirme_Tedbiri_Sor=$db->prepare("SELECT * FROM  hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_User_Id=:Hevesledirme_Tedbirleri_User_Id and Hevesledirme_Tedbirleri_Tesdiq_Durumu=:Hevesledirme_Tedbirleri_Tesdiq_Durumu");
								$Heveslendirme_Tedbiri_Sor->execute(array(
									'Hevesledirme_Tedbirleri_User_Id'=>$Hevesledirme_Tedbirleri_User_Id,
									'Hevesledirme_Tedbirleri_Tesdiq_Durumu'=>1));
									?>
									<table class="ListelemeAlaniIciTablosu caption-top" >
										<caption><b>Tədbiq olunmuş həvəsləndirmə tədbirləri</b><button class="YenileButonlari sag" onclick="YeniHeveslendirmeTedbirleri()" type="button">Yeni</button></caption>
										<thead>
											<tr>
												<th class="textaligncenter">№</th>
												<th>Növü</th>
												<th>Səbəb</th>
												<th>Tarix</th>										
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$Hevslendirmesira=0;
											while($Heveslendirme_Tedbiri_Cek=$Heveslendirme_Tedbiri_Sor->fetch(PDO::FETCH_ASSOC)) {
												$Hevslendirmesira++;?>
												<tr>
													<td  class="textaligncenter"><?php echo $Hevslendirmesira; ?></td>
													<td><?php echo $Heveslendirme_Tedbiri_Cek['Heveslendirem_Tedbirleri_Ad'] ?></td>
													<td><?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Sebeb'] ?></td>
													<td><?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Tarix'] ?></td>										
													<td class="emeliyyatlar_iki_buttom">
														<button class="YenileButonlari" id="TutduguVezifeDuzenle_<?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Id'] ?>" onclick="HeveslendirmeTedbiriDuzenle(this.id)" type="button">
															<i class="fas fa-edit"></i>
														</button>		
														<button class="YenileButonlari" id="TutduguVezifeSil_<?php echo $Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_Id'] ?>" onclick="HeveslendirmeTedbiriSil(this.id)" type="button">
															<i class="fas fa-trash"></i>
														</button>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>

									<?php 
								}else{
									
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