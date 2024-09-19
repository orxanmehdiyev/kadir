<?php 
require_once '../Ayarlar/setting.php';
if ($MezuniyyetAdlariDuzelis==1) {
	if (isset($_POST['Deyer'])) {
		$deyer =json_decode($_POST['Deyer'],true);
		$Mezuniyyet_Novleri_Ad=EditorluIcerikleriFiltrle($deyer['Mezuniyyet_Novleri_Ad']);
		$Mezuniyyet_Novleri_Kissa_Ad=EditorluIcerikleriFiltrle($deyer['Mezuniyyet_Novleri_Kissa_Ad']);
		$Mezuniyyet_Novleri_Sira=ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Novleri_Sira']);
		$Mezuniyyet_Novleri_ID=ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Novleri_ID']);	
		$Mezuniyyet_Novleri_Seo_Url= seo($Mezuniyyet_Novleri_Ad);  
		$Sor=$db->prepare("SELECT * FROM mezuniyyet_novleri where Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID");
		$Sor->execute(array(
			'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID));
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$Mezuniyyet_Novleri_Durum=$Cek['Mezuniyyet_Novleri_Durum'];
		if ($Mezuniyyet_Novleri_Ad!="") { 
			if ($Mezuniyyet_Novleri_Kissa_Ad!="") {
				if ($Mezuniyyet_Novleri_Sira!="") {
					$yenile=$db->prepare("UPDATE mezuniyyet_novleri SET 
						Mezuniyyet_Novleri_Ad=:Mezuniyyet_Novleri_Ad,
						Mezuniyyet_Novleri_Kissa_Ad=:Mezuniyyet_Novleri_Kissa_Ad,
						Mezuniyyet_Novleri_Seo_Url=:Mezuniyyet_Novleri_Seo_Url,
						Mezuniyyet_Novleri_Sira=:Mezuniyyet_Novleri_Sira,
						Mezuniyyet_Novleri_Durum=:Mezuniyyet_Novleri_Durum,
						Mezuniyyet_Novleri_TarixSaat=:Mezuniyyet_Novleri_TarixSaat
						WHERE Mezuniyyet_Novleri_ID=$Mezuniyyet_Novleri_ID");
					$update=$yenile->execute(array(
						'Mezuniyyet_Novleri_Ad'=>$Mezuniyyet_Novleri_Ad,
						'Mezuniyyet_Novleri_Kissa_Ad'=>$Mezuniyyet_Novleri_Kissa_Ad,
						'Mezuniyyet_Novleri_Seo_Url'=>$Mezuniyyet_Novleri_Seo_Url,
						'Mezuniyyet_Novleri_Sira'=>$Mezuniyyet_Novleri_Sira,
						'Mezuniyyet_Novleri_Durum'=>$Mezuniyyet_Novleri_Durum,
						'Mezuniyyet_Novleri_TarixSaat'=>$TarixSaat
					));

					if ($update) {				
						$Elave_Et=$db->prepare("INSERT INTO  mezuniyyet_novleri_islemleri SET                               
							Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID,
							Mezuniyyet_Novleri_Ad=:Mezuniyyet_Novleri_Ad,
							Mezuniyyet_Novleri_Kissa_Ad=:Mezuniyyet_Novleri_Kissa_Ad,
							Mezuniyyet_Novleri_Seo_Url=:Mezuniyyet_Novleri_Seo_Url,
							Mezuniyyet_Novleri_Sira=:Mezuniyyet_Novleri_Sira,
							Mezuniyyet_Novleri_Islem_Sebebi=:Mezuniyyet_Novleri_Islem_Sebebi,
							Mezuniyyet_Novleri_Durum=:Mezuniyyet_Novleri_Durum,
							Mezuniyyet_Novleri_TarixSaat=:Mezuniyyet_Novleri_TarixSaat,
							IPAdresi=:IPAdresi,
							Admin_Id=:Admin_Id,
							Admin_Ad=:Admin_Ad,
							Admin_Soyad=:Admin_Soyad,
							Admin_Ataadi=:Admin_Ataadi
							");
						$Insert=$Elave_Et->execute(array(                                
							'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID,
							'Mezuniyyet_Novleri_Ad'=>$Mezuniyyet_Novleri_Ad,
							'Mezuniyyet_Novleri_Kissa_Ad'=>$Mezuniyyet_Novleri_Kissa_Ad,
							'Mezuniyyet_Novleri_Seo_Url'=>$Mezuniyyet_Novleri_Seo_Url,
							'Mezuniyyet_Novleri_Sira'=>$Mezuniyyet_Novleri_Sira,
							'Mezuniyyet_Novleri_Islem_Sebebi'=>2,/*1-yeni 2-duzelis 3- silindi 4-durum aktiv 5- durum passiv*/
							'Mezuniyyet_Novleri_Durum'=>$Mezuniyyet_Novleri_Durum,
							'Mezuniyyet_Novleri_TarixSaat'=>$TarixSaat,
							'IPAdresi'=>$IPAdresi,
							'Admin_Id'=>$Admin_Id,
							'Admin_Ad'=>$Admin_Ad,
							'Admin_Soyad'=>$Admin_Soyad,
							'Admin_Ataadi'=>$Admin_Ataadi
						));
						if ($Insert) {					
							$Sor=$db->prepare("SELECT * FROM mezuniyyet_novleri order by Mezuniyyet_Novleri_Sira ASC ");
							$Sor->execute();
							$Say=$Sor->rowCount();
							?>
							<input type="hidden" id="yenilendi">
							<div class="row">
								<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
									<table class="ListelemeAlaniIciTablosu">						
										<thead>
											<tr>
												<th>№</th>
												<th>Adı</th>
												<th>Kissa Adı</th>
												<th>Sıra №</th>	
												<?php if ($MezuniyyetAdlariStatus==1 or $MezuniyyetAdlariDuzelis==1 or $MezuniyyetAdlariSil==1 or $MezuniyyetAdlariBax==1 ): ?>
													<th>Əməliyyatlar</th>		
												<?php endif ?>

											</tr>
										</thead>
										<tbody>
											<?php 
											$Sira_Nomir=0;
											while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
												$Sira_Nomir++;
												?>
												<tr>						
													<td class=" textaligncenter"><?php echo $Sira_Nomir ?></td>
													<td><?php echo $Cek['Mezuniyyet_Novleri_Ad'] ?></td>	
													<td><?php echo $Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>	
													<td class="textaligncenter"><?php echo $Cek['Mezuniyyet_Novleri_Sira'] ?></td>
													<?php if ($MezuniyyetAdlariStatus==1 or $MezuniyyetAdlariDuzelis==1 or $MezuniyyetAdlariSil==1 or $MezuniyyetAdlariBax==1 ): ?>							
														<td class="textaligncenter">
															<?php if ($MezuniyyetAdlariStatus==1): ?>
																<label class="checkbox" title="" >
																	<input <?php echo $Cek['Mezuniyyet_Novleri_Durum']==1 ? "checked":"";?>
																	type="checkbox" id="DurumId_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onchange="DurumKontrol(this.id)" > 
																	<span class="checkbox"> 
																		<span></span>
																	</span>
																</label>
															<?php endif ?>

															<?php if ($MezuniyyetAdlariDuzelis==1): ?>
																<button class="YenileButonlari" id="Duzelis_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onclick="Duzelis(this.id)" type="button">
																	<i class="fas fa-edit"></i>
																</button>
															<?php endif ?>

															<?php if ($MezuniyyetAdlariSil==1): ?>
																<button class="YenileButonlari" id="Sil_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onclick="Sil(this.id)" type="button">
																	<i class="fas fa-trash"></i>
																</button>
															<?php endif ?>

															<?php if ($MezuniyyetAdlariBax==1): ?>
																<button class="YenileButonlari" id="Bax_<?php echo $Cek['Mezuniyyet_Novleri_ID'] ?>" onclick="DeyisiklereBax(this.id)" type="button">
																	<i class="fas fa-eye"></i>
																</button>
															<?php endif ?>											
														</td> 
													<?php endif ?>
												</tr>	
											<?php }	?>

										</tbody>

									</table>
								</div>
							</div>
							<?php 
						}else{
							echo "error_2004";/* Adı boş ola bilməz*/
							exit;
						}
					}else{				
						echo "error_2003";/* Insert ugursuz*/
						exit;
					}
				}else{
					echo "error_2006";/* kissa Adı boş ola bilməz*/
					exit;
				}
			}else{
				echo "error_2002";/* kissa Adı boş ola bilməz*/
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
}
?>