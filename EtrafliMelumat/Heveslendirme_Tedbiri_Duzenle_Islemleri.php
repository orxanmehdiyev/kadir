<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Heveslendirem_Tedbirleri_Ad_Id=EditorluIcerikleriFiltrle($deyer['Heveslendirem_Tedbirleri_Ad_Id']);
	$Ad_Sor=$db->prepare("SELECT * FROM  heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id");
	$Ad_Sor->execute(array(
		'heveslendirem_tedbirleri_ad_id'=>$Heveslendirem_Tedbirleri_Ad_Id));
	$Ad_Cek=$Ad_Sor->fetch(PDO::FETCH_ASSOC);
	$Heveslendirem_Tedbirleri_Ad=$Ad_Cek['heveslendirem_tedbirleri_ad'];
	$Hevesledirme_Tedbirleri_Sebeb=EditorluIcerikleriFiltrle($deyer['Hevesledirme_Tedbirleri_Sebeb']);
	$Hevesledirme_Tedbirleri_Emrinin_Nomresi=EditorluIcerikleriFiltrle($deyer['Hevesledirme_Tedbirleri_Emrinin_Nomresi']);

	$Hevesledirme_Tedbirleri_Id=ReqemlerXaricButunKarakterleriSil($deyer['Hevesledirme_Tedbirleri_Id']);
	$Heveslendirme_Tedbiri_Sor=$db->prepare("SELECT * FROM hevesledirme_tedbirleri where Hevesledirme_Tedbirleri_Id=:Hevesledirme_Tedbirleri_Id");
	$Heveslendirme_Tedbiri_Sor->execute(array(
		'Hevesledirme_Tedbirleri_Id'=>$Hevesledirme_Tedbirleri_Id
	));
	$Heveslendirme_Tedbiri_Cek=$Heveslendirme_Tedbiri_Sor->fetch(PDO::FETCH_ASSOC);
	$Hevesledirme_Tedbirleri_User_Id=$Heveslendirme_Tedbiri_Cek['Hevesledirme_Tedbirleri_User_Id'];
	$Qeb_Tarixi                     =strtotime($deyer['Hevesledirme_Tedbirleri_Tarix']) ; 
	$Hevesledirme_Tedbirleri_Tarix                =date("d.m.Y", $Qeb_Tarixi);	

	if ($Heveslendirem_Tedbirleri_Ad_Id!="") { 
		if ($Hevesledirme_Tedbirleri_Sebeb!="") {
			if ($Hevesledirme_Tedbirleri_Emrinin_Nomresi!="") {
				if ($Hevesledirme_Tedbirleri_Id>0) {
					if ($Hevesledirme_Tedbirleri_Tarix!="") {			
						$yenile=$db->prepare("UPDATE hevesledirme_tedbirleri SET 
							Heveslendirem_Tedbirleri_Ad_Id=:Heveslendirem_Tedbirleri_Ad_Id,
							Heveslendirem_Tedbirleri_Ad=:Heveslendirem_Tedbirleri_Ad,
							Hevesledirme_Tedbirleri_Sebeb=:Hevesledirme_Tedbirleri_Sebeb,
							Hevesledirme_Tedbirleri_Tarix=:Hevesledirme_Tedbirleri_Tarix,
							Zaman_Damgasi=:Zaman_Damgasi,
							Tarix_Saat=:Tarix_Saat,
							Hevesledirme_Tedbirleri_Emrinin_Nomresi=:Hevesledirme_Tedbirleri_Emrinin_Nomresi,						
							Hevesledirme_Tedbirleri_Tesdiq_Durumu=:Hevesledirme_Tedbirleri_Tesdiq_Durumu
							WHERE Hevesledirme_Tedbirleri_Id=$Hevesledirme_Tedbirleri_Id");
						$update=$yenile->execute(array(
							'Heveslendirem_Tedbirleri_Ad_Id'=>$Heveslendirem_Tedbirleri_Ad_Id,
							'Heveslendirem_Tedbirleri_Ad'=>$Heveslendirem_Tedbirleri_Ad,
							'Hevesledirme_Tedbirleri_Sebeb'=>$Hevesledirme_Tedbirleri_Sebeb,
							'Hevesledirme_Tedbirleri_Tarix'=>$Hevesledirme_Tedbirleri_Tarix,
							'Zaman_Damgasi'=>$ZamanDamgasi,
							'Tarix_Saat'=>$TarixSaat,
							'Hevesledirme_Tedbirleri_Emrinin_Nomresi'=>$Hevesledirme_Tedbirleri_Emrinin_Nomresi,						
							'Hevesledirme_Tedbirleri_Tesdiq_Durumu'=>1
						));
						if ($update) {
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
								'Hevesledirme_Tedbirleri_Islemleri_Islem_Sebebi'=>2,
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