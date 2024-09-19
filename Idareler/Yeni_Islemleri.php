<?php 
require_once '../Ayarlar/setting.php';
if ($IdarelerYeni==1) {

if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Ust_Id            = ReqemlerXaricButunKarakterleriSil($deyer['Ust_Id']);
	$Idare_Adi         = HerfVeReqemlerVebeziKarakterlerXaricButunKarakterleriSil($deyer['Idare_Adi']);
	$Idare_Kissa_Adi   = HerfVeReqemlerVebeziKarakterlerXaricButunKarakterleriSil($deyer['Idare_Kissa_Adi']);
	$Idare_VOEN        = HerfVeReqemlerVebeziKarakterlerXaricButunKarakterleriSil($deyer['Idare_VOEN']);
	$Idare_Unvan       = HerfVeReqemlerVebeziKarakterlerXaricButunKarakterleriSil($deyer['Idare_Unvan']);	
	$SiraSor=$db->prepare("SELECT MAX(Sira_No) AS Sira_No FROM idare");
	$SiraSor->execute();
	$SiraCek=$SiraSor->fetch(PDO::FETCH_ASSOC);
	$Sira_No=$SiraCek['Sira_No']+1;
	if ($Ust_Id!="") {
		if ($Idare_Adi!="") {
			if ($Idare_Kissa_Adi!="") {
				if ($Idare_VOEN!="") {
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_VOEN=:Idare_VOEN");
					$Idare_Sor->execute(array(
						'Idare_VOEN'=>$Idare_VOEN
					));
					$Idare_Say=$Idare_Sor->rowCount();
					if (!$Idare_Say>0) {
						if ($Idare_Unvan!="") {
							$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Durum=:Durum and Id=:Id");
							$Sor->execute(array(
								'Durum'=>1,
								'Id'=>$Ust_Id));
							$Cek = $Sor->fetch(PDO::FETCH_ASSOC);
							$Ust_Ad=$Cek['Adi'];
							$Elave_Et=$db->prepare("INSERT INTO  idare SET
								Idare_Adi=:Idare_Adi,						
								Ust_Id=:Ust_Id,						
								Ust_Ad=:Ust_Ad,						
								Idare_Kissa_Adi=:Idare_Kissa_Adi,						
								Sira_No=:Sira_No,
								Idare_VOEN=:Idare_VOEN,
								Idare_Unvan=:Idare_Unvan,
								Idare_Seo_Url=:Idare_Seo_Url,
								Durum=:Durum,
								Idarenin_Elave_Edildiyi_TarixSaat=:Idarenin_Elave_Edildiyi_TarixSaat
								");
							$Insert=$Elave_Et->execute(array(
								'Idare_Adi'=>$Idare_Adi,
								'Ust_Id'=>$Ust_Id,
								'Ust_Ad'=>$Ust_Ad,
								'Idare_Kissa_Adi'=>$Idare_Kissa_Adi,
								'Sira_No'=>$Sira_No,
								'Idare_VOEN'=>$Idare_VOEN,
								'Idare_Unvan'=>$Idare_Unvan,
								'Idare_Seo_Url'=>seo($Idare_Adi.$Idare_VOEN),
								'Durum'=>0,
								'Idarenin_Elave_Edildiyi_TarixSaat'=>$TarixSaat
							));
							if ($Insert) {
								$Idare_Id = $db->lastInsertId();
								$Elave_Et=$db->prepare("INSERT INTO  idare_islemleri SET
									Idare_Id=:Idare_Id,
									Idare_Adi=:Idare_Adi,						
									Ust_Id=:Ust_Id,						
									Ust_Ad=:Ust_Ad,						
									Idare_Kissa_Adi=:Idare_Kissa_Adi,						
									Sira_No=:Sira_No,
									Idare_VOEN=:Idare_VOEN,
									Idare_Unvan=:Idare_Unvan,
									Idare_Seo_Url=:Idare_Seo_Url,
									Durum=:Durum,
									Idare_Islemleri_Sebebi=:Idare_Islemleri_Sebebi,
									Idare_Islemleri_Ip=:Idare_Islemleri_Ip,
									Admin_Id=:Admin_Id,
									Admin_Ad=:Admin_Ad,
									Admin_Soyad=:Admin_Soyad,
									Admin_Ataadi=:Admin_Ataadi,
									Idare_Islem_Edildiyi_Tarix=:Idare_Islem_Edildiyi_Tarix
									");
								$Insert=$Elave_Et->execute(array(
									'Idare_Id'=>$Idare_Id,
									'Idare_Adi'=>$Idare_Adi,
									'Ust_Id'=>$Ust_Id,
									'Ust_Ad'=>$Ust_Ad,
									'Idare_Kissa_Adi'=>$Idare_Kissa_Adi,
									'Ust_Id'=>$Ust_Id,
									'Ust_Ad'=>$Ust_Ad,
									'Sira_No'=>$Sira_No,
									'Idare_VOEN'=>$Idare_VOEN,
									'Idare_Unvan'=>$Idare_Unvan,
									'Idare_Seo_Url'=>seo($Idare_Adi.$Idare_VOEN),
									'Durum'=>0,
									'Idare_Islemleri_Sebebi'=>1,
									'Idare_Islemleri_Ip'=>$IPAdresi,
									'Admin_Id'=>$Admin_Id,
									'Admin_Ad'=>$Admin_Ad,
									'Admin_Soyad'=>$Admin_Soyad,
									'Admin_Ataadi'=>$Admin_Ataadi,
									'Idare_Islem_Edildiyi_Tarix'=>$TarixSaat
								));
								if ($Insert) {
									$Idare_Sor=$db->prepare("SELECT * FROM idare ");
									$Idare_Sor->execute();
									$Idare_Say=$Idare_Sor->rowCount();
									if ($Idare_Say>0) {
										$Idare_Sor=$db->prepare("SELECT * FROM idare order by Sira_No ASC ");
										$Idare_Sor->execute();
										$Idare_Say=$Idare_Sor->rowCount();
										if ($Idare_Say>0) {?>
											<div class="row">
												<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
													<table class="ListelemeAlaniIciTablosu">
														<thead class="">
															<tr>	
																<th>№</th>
																<th>Adı</th>
																<th>Kısa Adı</th>
																<th>VÖEN</th>
																<th>Sira No</th>								
																<th>Ünvanı</th>	
																<th>Yaradıldığı Tarix</th>
																<th colspan="4">Əməliyyatlar</th>			
															</tr>
														</thead>
														<tbody>
															<?php 
															$Sira_Nomir=0;
															while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
																$Sira_Nomir++;
																?>
																<tr>							
																	<td class="textaligncenter"><?php echo $Sira_Nomir ?></td>
																	<td><?php echo $Idare_Cek['Idare_Adi'] ?></td>							
																	<td><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>							
																	<td class="textaligncenter"><?php echo $Idare_Cek['Idare_VOEN'] ?></td>
																	<td class="textaligncenter"><?php echo $Idare_Cek['Sira_No'] ?></td>
																	<td><?php echo $Idare_Cek['Idare_Unvan'] ?></td>
																	<td class="textaligncenter"><?php echo $Idare_Cek['Idarenin_Elave_Edildiyi_TarixSaat'] ?></td> 
																	<td class="Vezife_Adlari_Durum_Kapsama">
																		<label class="checkbox" title="" >
																			<input <?php echo $Idare_Cek['Durum']==1 ? "checked":"";?>									
																			type="checkbox" id="DurumId_<?php echo $Idare_Cek['Idare_Id'] ?>" onchange="DurumKontrol(this.id)" > 
																			<span class="checkbox"> 
																				<span></span>
																			</span>
																		</label>
																	</td>
																	<td class="emeliyyatlar_sil_alani">										
																		<button class="YenileButonlari" id="DuzelisButton_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="DuzelisYoxlanis(this.id)" type="button">
																			<i class="fas fa-edit"></i>
																		</button>
																	</td> 							
																	<td class="emeliyyatlar_sil_alani">										
																		<button class="YenileButonlari" id="SilButton_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="SilYoxlanis(this.id)" type="button">
																			<i class="fas fa-trash"></i>
																		</button>
																	</td> 
																	<td class="emeliyyatlar_sil_alani">										
																		<button class="YenileButonlari" id="Bax_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="DeyisiklereBax(this.id)" type="button">
																			<i class="fas fa-eye"></i>
																		</button>
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
													Bazada İdarə Mövcut Deyil
												</div>
											</div> 
										<?php 	}	
									}else{	?>
										<div class="row">
											<div class="over-y">
												Bazada İdarə Mövcut Deyil
											</div>
										</div> 
									<?php 	}	
								}else{
									echo "error_1007";/*İkinci insert Xətalı*/
									exit;
								}
							}else{
								echo "error_1006";/*Birinci insert Xətalı*/
								exit;
							}
						}else{
							echo "error_1005";/*Ünvan boşdur*/
							exit;
						}
					}else{
						echo "error_1004";/*VÖEN var*/
						exit;
					}
				}else{
					echo "error_1003";/*VÖEN boşdur*/
					exit;
				}
			}else{
				echo "error_1007";/*Adı boşdur*/
				exit;
			}
		}else{
			echo "error_1002";/*Adı boşdur*/
			exit;
		}
	}else{
		echo "error_1001";/*Üst İD boşdur*/
		exit;
	}	
}else{
	header("Location:../login.php");
	exit;
}
	// code...
}
?>