<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Ise_Qebul_Emri_Id                =ReqemlerXaricButunKarakterleriSil($deyer['Ise_Qebul_Emri_Id']); 
	$User_Soy_Ad                      =HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Soy_Ad']); 
	$User_Ad                          =HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Ad']); 
	$User_Ata_Ad                      =HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Ata_Ad']); 
	$Dogum_Tarixi                     =strtotime($deyer['User_Dogum_Tarixi']) ; 
	$User_Dogum_Tarixi                =date("Y-m-d", $Dogum_Tarixi);
	$User_Fin                         =KicikHerfleriBoyukHerflerleDeyisidir(HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Fin'])); 
	$User_Yasayis_Unvan               =EditorluIcerikleriFiltrle($deyer['User_Yasayis_Unvan']); 
	$User_Tehsil                      =ReqemlerXaricButunKarakterleriSil($deyer['User_Tehsil']);
	$User_Tehsil_Aldigi_Muesse=EditorluIcerikleriFiltrle($deyer['User_Tehsil_Aldigi_Muesse']);  
	$Ixtisas=EditorluIcerikleriFiltrle($deyer['Ixtisas']);  
	$Ise_Qebul_Tarixi                 =$deyer['User_Ise_Qebul_Tarixi'];    
	$User_Ise_Qebul_Tarixi_nn         =strtotime($Ise_Qebul_Tarixi); 
	$User_Ise_Qebul_Tarixi            =date("Y-m-d", $User_Ise_Qebul_Tarixi_nn);
	$Usre_Cinsiyeti                   =ReqemlerXaricButunKarakterleriSil($deyer['Usre_Cinsiyeti']); 
	$User_Is_Novu                     =ReqemlerXaricButunKarakterleriSil($deyer['User_Is_Novu']); 
	$Ise_Qebul_Emri_Nomresi           =EditorluIcerikleriFiltrle($deyer['Ise_Qebul_Emri_Nomresi']);
	$Mezmun                           =EditorluIcerikleriFiltrle($deyer['Mezmun']);
	$SinaqMuddeti                     =ReqemlerXaricButunKarakterleriSil($deyer['SinaqMuddeti']);  
	$SinaqMuddetiGunAy                =ReqemlerXaricButunKarakterleriSil($deyer['SinaqMuddetiGunAy']); 
	$Zaman      = date_create($Ise_Qebul_Tarixi);
	if ($SinaqMuddetiGunAy==0) {
		date_modify($Zaman, "+{$SinaqMuddeti} month");
	}else{
		date_modify($Zaman, "+{$SinaqMuddeti} day"); 
	}
	$SinaqMuddetiBitis_nn = date_timestamp_get($Zaman);
	$SinaqMuddetiBitis            =date("Y-m-d", $SinaqMuddetiBitis_nn);
	$Seo_Url= HerfVeReqemlerXaricButunKarakterleriSil(Benzersiz_Seo_Url($User_Soy_Ad." ".$User_Ad." ".$User_Ata_Ad." ".$User_Fin));
	$Duzelis_ID_Sor=$db->prepare("SELECT * FROM  ise_qebul_emri where  Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id");
	$Duzelis_ID_Sor->execute(array(
		'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id));
	$Duzelis_ID_Say=$Duzelis_ID_Sor->rowCount();
	if ($Duzelis_ID_Say==1) {
		if ($User_Soy_Ad!="") {
			if ($User_Ad!="") {
				if ($User_Ata_Ad!="") {
					if ($User_Dogum_Tarixi!="") {
						if ($User_Fin!="" and strlen($User_Fin)==7) {
							$User_Fin_Sor=$db->prepare("SELECT * FROM user WHERE User_Fin=:User_Fin and User_Isleme_Durumu=:User_Isleme_Durumu");
							$User_Fin_Sor->execute(array(
								'User_Fin'=>$User_Fin,
								'User_Isleme_Durumu'=>0));
							$User_Fin_Say=$User_Fin_Sor->rowCount();
							if (!$User_Fin_Say>0) {
								$IsFinSor=$db->prepare("SELECT * FROM ise_qebul_emri WHERE User_Fin=:User_Fin and Ise_Qebul_Emri_Id<>:Ise_Qebul_Emri_Id");
								$IsFinSor->execute(array(
									'User_Fin'=>$User_Fin,
									'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id));
								$IsFinSay=$IsFinSor->rowCount();
								if (!$IsFinSay>0) {
									if ($User_Yasayis_Unvan!="") {
										if ($User_Tehsil!="") {
											if ($User_Tehsil_Aldigi_Muesse!="") {
											if ($Ixtisas!="") {
												if ($User_Ise_Qebul_Tarixi!="") {
													if ($Usre_Cinsiyeti!="") {
														if ($User_Is_Novu!="") {
															if ($Ise_Qebul_Emri_Nomresi!="") {
																if ($Mezmun!="") {
																	if ($SinaqMuddeti!="") {
																		if ($SinaqMuddetiGunAy!="") {
																			$yenile = $db->prepare("UPDATE ise_qebul_emri SET     
																				User_Soy_Ad=:User_Soy_Ad,
																				User_Ad=:User_Ad,
																				User_Ata_Ad=:User_Ata_Ad,
																				User_Dogum_Tarixi=:User_Dogum_Tarixi,
																				User_Fin=:User_Fin,
																				User_Yasayis_Unvan=:User_Yasayis_Unvan,
																				User_Tehsil=:User_Tehsil,
																				User_Tehsil_Aldigi_Muesse=:User_Tehsil_Aldigi_Muesse,
																				Ixtisas=:Ixtisas,
																				User_Ise_Qebul_Tarixi=:User_Ise_Qebul_Tarixi,
																				Usre_Cinsiyeti=:Usre_Cinsiyeti,
																				User_Is_Novu=:User_Is_Novu,
																				Ise_Qebul_Emri_Nomresi=:Ise_Qebul_Emri_Nomresi,
																				Mezmun=:Mezmun,
																				SinaqMuddeti=:SinaqMuddeti,
																				SinaqMuddetiGunAy=:SinaqMuddetiGunAy,
																				SinaqMuddetiBitis=:SinaqMuddetiBitis,
																				Seo_Url=:Seo_Url
																				WHERE Ise_Qebul_Emri_Id=$Ise_Qebul_Emri_Id");
																			$update = $yenile->execute(array(     
																				'User_Soy_Ad'=>$User_Soy_Ad,
																				'User_Ad'=>$User_Ad,
																				'User_Ata_Ad'=>$User_Ata_Ad,
																				'User_Dogum_Tarixi'=>$User_Dogum_Tarixi,
																				'User_Fin'=>$User_Fin,
																				'User_Yasayis_Unvan'=>$User_Yasayis_Unvan,
																				'User_Tehsil'=>$User_Tehsil,
																				'User_Tehsil_Aldigi_Muesse'=>$User_Tehsil_Aldigi_Muesse,
																				'Ixtisas'=>$Ixtisas,
																				'User_Ise_Qebul_Tarixi'=>$User_Ise_Qebul_Tarixi,
																				'Usre_Cinsiyeti'=>$Usre_Cinsiyeti,
																				'User_Is_Novu'=>$User_Is_Novu,
																				'Ise_Qebul_Emri_Nomresi'=>$Ise_Qebul_Emri_Nomresi,
																				'Mezmun'=>$Mezmun,
																				'SinaqMuddeti'=>$SinaqMuddeti,
																				'SinaqMuddetiGunAy'=>$SinaqMuddetiGunAy,
																				'SinaqMuddetiBitis'=>$SinaqMuddetiBitis,
																				'Seo_Url'=>$Seo_Url
																			)); 
																			if ($update) {
																				$Elave_Et=$db->prepare("INSERT INTO ise_qebul_emri_islemleri SET
																					Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id, 
																					Sebeb=:Sebeb, 
																					User_Soy_Ad=:User_Soy_Ad, 
																					User_Ad=:User_Ad,        
																					User_Ata_Ad=:User_Ata_Ad,        
																					User_Dogum_Tarixi=:User_Dogum_Tarixi,
																					/* User_Fin=:User_Fin,*/
																					User_Yasayis_Unvan=:User_Yasayis_Unvan,
																					User_Tehsil=:User_Tehsil,
																					User_Tehsil_Aldigi_Muesse=:User_Tehsil_Aldigi_Muesse,
																					Ixtisas=:Ixtisas,
																					User_Ise_Qebul_Tarixi=:User_Ise_Qebul_Tarixi,
																					Usre_Cinsiyeti=:Usre_Cinsiyeti,
																					User_Is_Novu=:User_Is_Novu,
																					Ise_Qebul_Emri_Nomresi=:Ise_Qebul_Emri_Nomresi,
																					Mezmun=:Mezmun,																			
																					ZamanDamgasiI=:ZamanDamgasiI,
																					Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu,
																					Seo_Url=:Seo_Url,
																					SinaqMuddeti=:SinaqMuddeti,
																					SinaqMuddetiGunAy=:SinaqMuddetiGunAy,
																					SinaqMuddetiBitis=:SinaqMuddetiBitis,
																					IPAdresi=:IPAdresi,
																					Admin_Id=:Admin_Id,
																					Admin_Ad=:Admin_Ad,
																					Admin_Soyad=:Admin_Soyad,
																					Admin_Ataadi=:Admin_Ataadi
																					");
																				$Insert=$Elave_Et->execute(array(
																					'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id,  
																					'Sebeb'=>2,  
																					'User_Soy_Ad'=>$User_Soy_Ad,  
																					'User_Ad'=>$User_Ad,        
																					'User_Ata_Ad'=>$User_Ata_Ad,        
																					'User_Dogum_Tarixi'=>$User_Dogum_Tarixi,
																					/*'User_Fin'=>$User_Fin,*/
																					'User_Yasayis_Unvan'=>$User_Yasayis_Unvan,
																					'User_Tehsil'=>$User_Tehsil,
																					'User_Tehsil_Aldigi_Muesse'=>$User_Tehsil_Aldigi_Muesse,
																					'Ixtisas'=>$Ixtisas,
																					'User_Ise_Qebul_Tarixi'=>$User_Ise_Qebul_Tarixi,
																					'Usre_Cinsiyeti'=>$Usre_Cinsiyeti,
																					'User_Is_Novu'=>$User_Is_Novu,
																					'Ise_Qebul_Emri_Nomresi'=>$Ise_Qebul_Emri_Nomresi,
																					'Mezmun'=>$Mezmun,																					
																					'ZamanDamgasiI'=>$ZamanDamgasi,
																					'Ise_Qebul_Emri_Stausu'=>0,
																					'Seo_Url'=>$Seo_Url,
																					'SinaqMuddeti'=>$SinaqMuddeti,
																					'SinaqMuddetiGunAy'=>$SinaqMuddetiGunAy,
																					'SinaqMuddetiBitis'=>$SinaqMuddetiBitis,
																					'IPAdresi'=>$IPAdresi,
																					'Admin_Id'=>$Admin_Id,
																					'Admin_Ad'=>$Admin_Ad,
																					'Admin_Soyad'=>$Admin_Soyad,
																					'Admin_Ataadi'=>$Admin_Ataadi
																				));
																				if ($Insert) {?>
																					<input type="hidden" id="yenilendi">
																					<?php 
																					$Sor=$db->prepare("SELECT * FROM  ise_qebul_emri order by Ise_Qebul_Emri_Id DESC ");
																					$Sor->execute();
																					$Say=$Sor->rowCount();
																					if ($Say>0) {?>
																						<div class="row">
					<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
						<table class="ListelemeAlaniIciTablosu">
							<thead class="">
								<tr>
									<th>Nömrə</th>
									<th>Əmrin məksədi</th>
									<th>Tarix</th>
									<th>Statusu</th>
									<th>Qeyd</th>																
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php 
								$Sira_Nomir=0;
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									$Sira_Nomir++;
									$OgluQizi = ( $Cek['Usre_Cinsiyeti'] == 0 ) ? "oğlunun işə qəbul əmri" : "qızının işə qəbul əmri";

									?>
									<tr style="cursor: pointer;" id="Bax_<?php echo $Cek['Ise_Qebul_Emri_Id'] ?>" onclick="Bax(this.id)">							
										<td class="siar_no_alani"><?php echo $Cek['Ise_Qebul_Emri_Nomresi'] ?></td>
										<td><?php echo $Cek['User_Soy_Ad']." ".$Cek['User_Ad']." ".$Cek['User_Ata_Ad']." ".$OgluQizi ?></td>
										<td class="textaligncenter"><?php echo  Tarix_Beynelxalqi_Az_Cevir($Cek['User_Ise_Qebul_Tarixi']) ?></td>
										<td class="textaligncenter"><?php 
										if ($Cek['Ise_Qebul_Emri_Stausu']==0) {
											echo 'Təsdiq Gözləyir';
										}elseif($Cek['Ise_Qebul_Emri_Stausu']==1){
											echo 'Təsdiqləndi';
										}
										?>
										<td ><?php echo $Cek['Mezmun'] ?>	</td>									
									</td>												
								</tr>	
							<?php }
							?>
						</tbody>
					</table>
				</div>
			</div>
																				<?php }else{	?>
																					<div class="row">
																						<div class="over-y">
																							Bazada İşə qəbul əmri yoxdur
																						</div>
																					</div> 
																				<?php 	}	?>
																				
																			<?php }else{
																				echo "error_2019";/*İnsert Uğursuz oldu*/
																			}

																		}else{
																			echo "error_2018";/*Yenilənə uğursu*/
																			exit; 
																		}

																	}else{
																		echo "error_2017";/*Sınaq müddəti gün ay boş ola bilməz*/
																		exit; 
																	}
																}else{
																	echo "error_2016";/*Sınaq müddəti boş ola bilməz*/
																	exit; 
																}
															}else{
																echo "error_2015";/*Məzmun boş ola bilməz*/
																exit; 
															}
														}else{
															echo "error_2014";/*İşə qəbul əmrinin nömrəsi boş ola bilməz boş ola bilməz*/
															exit; 
														}
													}else{
														echo "error_2013";/*Iş novü boş ola bilməz*/
														exit; 
													}	
												}else{
													echo "error_2012";/*Çinsiyyəti boş ola bilməz*/
													exit; 
												}	
											}else{
												echo "error_2011";/*İşə qəbul tarixi boş ola bilməz*/
												exit; 
											}	
												}else{
											echo "error_2023";/*Təhsili aldığı ixtisas boş ola bilməz*/
											exit; 
										}			
										}else{
											echo "error_2010";/*Təhsili aldığı ixtisas boş ola bilməz*/
											exit; 
										}											
									}else{
										echo "error_2009";/*Təhsili boş ola bilməz*/
										exit; 
									}
								}else{
									echo "error_2008";/*Yaşayış ünvanı boş ola bilməz*/
									exit; 
								}
							}else{
								echo "error_2007";/*Bu fin ucun başqa emir gözleyir*/
								exit;
							}

						}else{
							echo "error_2006";/*Bu fin bazada var ve həmin əməkdaş işləyir*/
							exit;
						}
					}else{
						echo "error_2005";/*Fin boş ola bilməz*/
						exit;
					}
				}else{
					echo "error_2004";/*Doğum tarixi boş ola bilməz*/
					exit;
				}
			}else{
				echo "error_2003";/*Ata adı boş ola bilməz*/
				exit;
			}
		}else{
			echo "error_2002";/*Adı boş ola bilməz*/
			exit;
		}
	}else{
		echo "error_2001";/*Soya adı boş ola bilməz*/
		exit;
	}
}else{
	echo "error_2000";/*Düzəliş edilən id xəta*/
	exit;
}
}else{
	header("Location:../login.php");
	exit;
}

?>