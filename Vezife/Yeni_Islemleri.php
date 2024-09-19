<?php  
require_once '../Ayarlar/setting.php';
if ($VezifelerYeniButtonu==1) {
	if (isset($_POST['Deyer'])) {
		$deyer =json_decode($_POST['Deyer'],true);
		$Idare_Id           = ReqemlerXaricButunKarakterleriSil($deyer['Idare_Id']);
		$AlaBileceyiRutbe           = ReqemlerXaricButunKarakterleriSil($deyer['AlaBileceyiRutbe']);
		$Sobe_Id            = ReqemlerXaricButunKarakterleriSil($deyer['Sobe_Id']);
		$Vezife_Adlari_Id   = ReqemlerXaricButunKarakterleriSil($deyer['Vezife_Adlari_Id']);
		$Vezife_Pulu        = ReqemlernokteVergulXaricButunKarakterleriSil($deyer['Vezife_Pulu']);
		$Vezifenin_Novu     = ReqemlerXaricButunKarakterleriSil($deyer['Vezifenin_Novu']);
		$Zabit_Mulu         = ReqemlerXaricButunKarakterleriSil($deyer['Zabit_Mulu']);
		$Esas_Mezuniyyeti         = ReqemlerXaricButunKarakterleriSil($deyer['Esas_Mezuniyyeti']);
		if ($Esas_Mezuniyyeti>0) {
			if ($Idare_Id>0) {
				$Yeni_Sobe_Ucun_Idare_Sor = $db->prepare("SELECT * FROM  idare where Idare_Id=:Idare_Id and  Durum=:Durum");
				$Yeni_Sobe_Ucun_Idare_Sor->execute(array(
					'Idare_Id'=>$Idare_Id,
					'Durum'=>1
				));
				$idaresayi=$Yeni_Sobe_Ucun_Idare_Sor->rowCount();
				if ($idaresayi==1) {
					if ($Sobe_Id>0) {
						$sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id and Durum=:Durum");
						$sor->execute(array(
							'Sobe_Id'=>$Sobe_Id,
							'Durum'=>1
						));
						$sobesayi=$sor->rowCount();
						if ($sobesayi==1) {
							if ($Vezife_Adlari_Id>0) {
								$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Durum=:Vezife_Adlari_Durum and Vezife_Adlari_Id=:Vezife_Adlari_Id");
								$Vezife_Adlari_Sor->execute(array(
									'Vezife_Adlari_Durum'=>1,
									'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
								$vezifeadsayi=$Vezife_Adlari_Sor->rowCount();
								if ($vezifeadsayi==1) {
									if ($Vezife_Pulu>=0) {
										if ($Vezifenin_Novu!="") {
											if ($Zabit_Mulu!="") {
												$SiraSor=$db->prepare("SELECT MAX(Sira_No) AS Sira_No FROM vezife where Sobe_Id=:Sobe_Id and Idare_Id=:Idare_Id");
												$SiraSor->execute(array(
													'Sobe_Id'=>$Sobe_Id,
													'Idare_Id'=>$Idare_Id));
												$SiraCek=$SiraSor->fetch(PDO::FETCH_ASSOC);
												$Sira_No=$SiraCek['Sira_No']+1;			
												$Elave_Et=$db->prepare("INSERT INTO vezife SET
													Vezife_Adlari_Id=:Vezife_Adlari_Id,
													AlaBileceyiRutbe=:AlaBileceyiRutbe,
													Stat_Vahidi=:Stat_Vahidi,
													Idare_Id=:Idare_Id,
													Sobe_Id=:Sobe_Id,
													Vezife_Pulu=:Vezife_Pulu,
													Stat_Muqavile=:Stat_Muqavile,
													Zabit_Mulu=:Zabit_Mulu,
													Sira_No=:Sira_No,
													Esas_Mezuniyyeti=:Esas_Mezuniyyeti,
													Durum=:Durum
													");
												$Insert=$Elave_Et->execute(array(
													'Vezife_Adlari_Id'=>$Vezife_Adlari_Id,
													'AlaBileceyiRutbe'=>$AlaBileceyiRutbe,
													'Stat_Vahidi'=>1,
													'Idare_Id'=>$Idare_Id,
													'Sobe_Id'=>$Sobe_Id,
													'Vezife_Pulu'=>$Vezife_Pulu,
													'Stat_Muqavile'=>$Vezifenin_Novu,
													'Zabit_Mulu'=>$Zabit_Mulu,
													'Sira_No'=>$Sira_No,
													'Esas_Mezuniyyeti'=>$Esas_Mezuniyyeti,
													'Durum'=>0
												));
												if ($Insert) {
													$Vezife_Id = $db->lastInsertId();
													$Elave_Et=$db->prepare("INSERT INTO vezife_islemleri SET
														Vezife_Id=:Vezife_Id,
														Esas_Mezuniyyeti=:Esas_Mezuniyyeti,
														AlaBileceyiRutbe=:AlaBileceyiRutbe,
														Vezife_Adlari_Id=:Vezife_Adlari_Id,
														Stat_Vahidi=:Stat_Vahidi,
														Idare_Id=:Idare_Id,
														Sobe_Id=:Sobe_Id,
														Vezife_Pulu=:Vezife_Pulu,
														Stat_Muqavile=:Stat_Muqavile,
														Zabit_Mulu=:Zabit_Mulu,
														Sira_No=:Sira_No,
														IPAdresi=:IPAdresi,
														ZamanDamgasi=:ZamanDamgasi,
														Islem_User_Id=:Islem_User_Id,
														Islem_Sebebi=:Islem_Sebebi,
														Durum=:Durum
														");
													$Insert=$Elave_Et->execute(array(
														'Vezife_Id'=>$Vezife_Id,
														'Esas_Mezuniyyeti'=>$Esas_Mezuniyyeti,
														'AlaBileceyiRutbe'=>$AlaBileceyiRutbe,
														'Vezife_Adlari_Id'=>$Vezife_Adlari_Id,
														'Stat_Vahidi'=>1,
														'Idare_Id'=>$Idare_Id,
														'Sobe_Id'=>$Sobe_Id,
														'Vezife_Pulu'=>$Vezife_Pulu,
														'Stat_Muqavile'=>$Vezifenin_Novu,
														'Zabit_Mulu'=>$Zabit_Mulu,
														'Sira_No'=>$Sira_No,
														'IPAdresi'=>$IPAdresi,
														'ZamanDamgasi'=>$ZamanDamgasi,
														'Islem_User_Id'=>$User_Id,
														'Islem_Sebebi'=>1,
														'Durum'=>0
													));
													if ($Insert) {
														?>
														<?php 
														$Sobe_Say_Sor=$db->prepare("SELECT * FROM vezife ");
														$Sobe_Say_Sor->execute();
														$Sobe_Say=$Sobe_Say_Sor->rowCount();
														if ($Sobe_Say>0) {?>
															<input type="hidden" id="yenilendi" value="yenilendi">
															<div class="row">
																<div class="over-y genislik">
																	<?php 
																	if ($VezifeButunIdareler==1) {
																		$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC");
																		$Idare_Sor->execute(array(
																			'Durum'=>1));
																	}else{
																		$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC");
																		$Idare_Sor->execute(array(
																			'Durum'=>1,
																			'Idare_Id'=>$Islediyi_Idare_Id));
																	}

																	while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
																		$Idare_Id= $Idare_Cek['Idare_Id'];
																		$Idare_Adi= $Idare_Cek['Idare_Adi'];
																		$Idare_Say_Sor=$db->prepare("SELECT * FROM vezife WHERE Idare_Id=:Idare_Id ");
																		$Idare_Say_Sor->execute(array(
																			'Idare_Id'=>$Idare_Id,
																		));
																		$Idare_Say=$Idare_Say_Sor->rowCount();
																		if ($Idare_Say>0) {
																			?>
																			<h4 style="text-align: center;"><?php echo $Idare_Adi ?></h4>
																			<table class="table table-bordered table-hover">
																				<thead class="">
																					<tr>
																						<th class="siar_no_alani">№</th>
																						<th>Vəzifə Adı</th>	
																						<th class="stat_vahidi">Ştat Vahidi</th>	
																						<th class="emeliyyatlar_alani">Vəzifənin Növü</th>
																						<th class="emeliyyatlar_alani">Vəzifə haqqı</th>									
																						<th class="emeliyyatlar_alani">Əsas Məzuniyyəti</th>									
																						<th>Ala Biləcəyi rütbə</th>									
																						<th class="siar_nomresi_alani">Sıra No</th>
																						<?php if ($VezifelerDurum==1 or $VezifelerDuzeli==1 or $VezifelerSil==1): ?>
																							<th class="emeliyyatlar_alani">Əməliyatlar</th>
																						<?php endif ?>
																					</tr>
																				</thead>
																				<tbody id="list" class="table_ici">
																					<?php
																					$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
																					$Sobe_Sor->execute(array(
																						'Idare_Id'=>$Idare_Id,
																						'Durum'=>1));
																					$Sira_No=0;
																					while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
																						$Sobe_Id=$Sobe_Cek['Sobe_Id'];
																						$Sobe_Say_Sor=$db->prepare("SELECT * FROM vezife WHERE Sobe_Id=:Sobe_Id  order by Sira_No ASC");
																						$Sobe_Say_Sor->execute(array(
																							'Sobe_Id'=>$Sobe_Id
																							));
																						$Sobe_Say=$Sobe_Say_Sor->rowCount();
																						if ($Sobe_Say>0) {
																							?>
																							<tr id="setir-<?php echo $Sobe_Cek['Sobe_Id']?>">	
																								<?php if ($VezifelerDurum==1 or $VezifelerDuzeli==1 or $VezifelerSil==1) { ?>
																									<td colspan="9" id="SobeAd_<?php echo $Sobe_Cek['Sobe_Id'] ?>">
																										<b><?php echo $Sobe_Cek['Sobe_Ad'] ?></b>
																									</td>
																								<?php } else{ ?>
																									<td colspan="8" id="SobeAd_<?php echo $Sobe_Cek['Sobe_Id'] ?>">
																										<b><?php echo $Sobe_Cek['Sobe_Ad'] ?></b>
																									</td>
																								<?php } ?>
																							</tr>	
																							<?php
																							$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
																							$Vezife_Sor->execute(array(
																								'Sobe_Id'=>$Sobe_Id,																							
																								'Vezife_Adlari_Durum'=>1));

																							while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
																								$Sira_No++;											
																								?>
																								<tr>
																									<td class="center"><?php echo $Sira_No; ?></td>
																									<td><?php echo $Vezife_Cek['Vezife_Adlari_Ad']; ?></td>
																									<td class="center"><?php echo $Vezife_Cek['Stat_Vahidi']; ?></td>
																									<td class="center">
																										<?php
																										if ($Vezife_Cek['Zabit_Mulu']==0) {
																											echo "Vəzifəli";
																										}else{
																											echo "Mülkü";
																										}
																										?>
																									</td>													
																									<td class="center"><?php echo number_format($Vezife_Cek['Vezife_Pulu'],2); ?></td>
																									<td class="center"><?php echo $Vezife_Cek['Esas_Mezuniyyeti']; ?></td>
																									<td class="center"><?php
																									$rutbeadisor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
																									$rutbeadisor->execute(array(
																										'Rutbe_Id'=>$Vezife_Cek['AlaBileceyiRutbe']));
																									$rutbe_Cek=$rutbeadisor->fetch(PDO::FETCH_ASSOC);
																									echo $rutbe_Cek['Rutbe_Adi']; ?></td>
																									<td class="center"><?php echo $Vezife_Cek['Sira_No']; ?></td>													
																									
																									<?php if ($VezifelerDurum==1 or $VezifelerDuzeli==1 or $VezifelerSil==1): ?>
																										<td class="textaligncenter">
																											<?php if ($VezifelerDurum==1) { ?>
																												<label class="checkbox" title="" >
																													<input 
																													<?php 
																													if ($Vezife_Cek['Durum']==1) {
																														echo  "checked";
																													}else{}
																													?>
																													type="checkbox" id="DurumId_<?php echo $Vezife_Cek['Vezife_Id'] ?>" onchange="DurumKontrol(this.id)" > 
																													<span class="checkbox"> 
																														<span></span>
																													</span>
																												</label>
																											<?php } if ($VezifelerDuzeli==1) {?>
																												<button class="YenileButonlari" id="DuzelisButton_<?php echo $Vezife_Cek['Vezife_Id'] ?>" onclick="Duzelis(this.id)" type="button"><i class="fas fa-edit"></i></button>														
																											<?php }if ($VezifelerSil==1) {?>
																												<button class="YenileButonlari" id="SilButton_<?php echo $Vezife_Cek['Vezife_Id'] ?>" onclick="SilYoxlanis(this.id)" type="button"><i class="fas fa-trash"></i></button>
																											<?php } ?>
																										</td>
																									<?php endif ?>
																								</tr>
																							<?php }
																							$Vezife_Stat_Vahidi_Cemi_Sor=$db->prepare("SELECT SUM(Stat_Vahidi) AS Stat_Vahidi, SUM(Vezife_Pulu) AS Vezife_Pulu FROM vezife where Sobe_Id=:Sobe_Id ");
																							$Vezife_Stat_Vahidi_Cemi_Sor->execute(array(
																								'Sobe_Id'=>$Sobe_Id
																								));
																								$Vezife_Stat_Vahidi_Cemi=$Vezife_Stat_Vahidi_Cemi_Sor->fetch(PDO::FETCH_ASSOC);?>
																								<tr>							
																									<td colspan="2"><b>Cəmi</b></td>
																									<td class="center"><b><?php echo round(floatval($Vezife_Stat_Vahidi_Cemi['Stat_Vahidi']),0); ?></b></td>
																									<td></td>
																									<td class="center"><b><?php echo number_format($Vezife_Stat_Vahidi_Cemi['Vezife_Pulu'], 2, ',', ' '); ?></b></td>
																									<?php if ($VezifelerDurum==1 or $Vezife_Cek['Durum']==1 or $VezifelerDuzeli==1) { ?>
																										<td colspan="4"></td>
																									<?php }else{ ?>
																										<td colspan="3"></td>
																									<?php } ?>
																								</tr>	
																							<?php } }
																							?>
																						</tbody>
																					</table>
																					<?php 
																				} 
																			} ?>

																		</div>
																	</div>
																<?php }else{	?>
																	<div class="row">
																		<div class="over-y">
																			Bazada Vəzifə Mövcut Deyil
																		</div>
																	</div> 
																<?php 	}	?>

																<?php 
															}else{
																echo "error_1011";/*Ikinci əməliyyat uğursuz*/
																exit;	
															}
														}else{
															echo "error_1010";/*Birinci əməliyyat uğursuz*/
															exit;	
														}
													}else{
														echo "error_1009";/*Zabit ya mülkü secilməlidi Növü secilməlidir*/
														exit;
													}
												}else{
													echo "error_1008";/*Vəzifə Növü secilməlidir*/
													exit;
												}								
											}else{
												echo "error_1007";/*Vəzifə pulu boşdur*/
												exit;
											}
										}else{
											echo "error_1006";/*Vəzifə İd xetali*/
											exit;
										}
									}else{
										echo "error_1005";/*Vəzifə İd boşdur*/
										exit;
									}
								}else{
									echo "error_1004";/*Şöbə id xətalı*/
									exit;
								}
							}else{
								echo "error_1003";/*Şöbə İd boşdur*/
								exit;
							}
						}else{
							echo "error_1002";/*Idarə İd xetalı*/
							exit;
						}

					}else{
						echo "error_1001";/*Idarə İd boş ola bilməz*/
						exit;
					}
				}else{
					echo "error_1001";/*Idarə İd boş ola bilməz*/
					exit;
				}
			}else{
				header("Location:../login.php");
				exit;
			}
		}
	?>