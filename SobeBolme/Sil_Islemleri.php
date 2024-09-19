<?php 
require_once '../Ayarlar/setting.php';
if ($SobeBolmeSil==1) {
	if (isset($_POST['Deyer'])) {
		$Sobe_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id");
		$Sor->execute(array(
			'Sobe_Id'=>$Sobe_Id));
		$Say=$Sor->rowCount();
		if ($Say==1) {
			$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
			$Sobe_Ad=$Cek['Sobe_Ad'];
			$Sira_No=$Cek['Sira_No'];
			$Idare_Id=$Cek['Idare_Id'];
			$Durum=$Cek['Durum'];
			$sil = $db->prepare("DELETE from sobe where Sobe_Id=:Sobe_Id");
			$kontrol = $sil->execute(array(
				'Sobe_Id' => $Sobe_Id
			));
			if ($kontrol) {
				$Elave_Et=$db->prepare("INSERT INTO sobe_islemleri SET 
					Sobe_Id=:Sobe_Id,
					Admin_Id=:Admin_Id,
					Idare_Id=:Idare_Id,
					Sobe_Islemleri_Sebebi=:Sobe_Islemleri_Sebebi,
					Sobe_Islemleri_Sobe_Adi=:Sobe_Islemleri_Sobe_Adi,
					TarixSaat=:TarixSaat,
					ZamanDamgasi=:ZamanDamgasi,
					IPAdresi=:IPAdresi,
					Sira_No=:Sira_No,
					Durum=:Durum
					");
				$insert=$Elave_Et->execute(array(
					'Sobe_Id'=>$Sobe_Id,
					'Admin_Id'=>$Admin_Id,
					'Idare_Id'=>$Idare_Id,
					'Sobe_Islemleri_Sebebi'=>3,
					'Sobe_Islemleri_Sobe_Adi'=>$Sobe_Ad,
					'TarixSaat'=>$TarixSaat,
					'ZamanDamgasi'=>$ZamanDamgasi,
					'IPAdresi'=>$IPAdresi,
					'Sira_No'=>$Sira_No,
					'Durum'=>$Durum
				));
				if ($insert) {
					?>
					<input type="hidden" id="silcavab" value="silindi">
					<div class="row">
						<div class="over-y genislik">
							<?php 
							$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC  ");
							$Idare_Sor->execute(array(
								'Durum'=>1));
							$Idare_Sira_Nomir=0;
							while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Idare_Id= $Idare_Cek['Idare_Id'];
								$Idare_Adi= $Idare_Cek['Idare_Adi'];
								$Idare_Sira_Nomir++;
								$IdareSaySor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id ");
								$IdareSaySor->execute(array(
									'Idare_Id'=>$Idare_Id));
								$IdareSay=$IdareSaySor->rowCount();
								if ($IdareSay>0) {?>
									<h4 style="text-align: center;"> <?php echo $Idare_Adi ?></h4 style="text-align: center;">
									<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="siar_no_alani">№</th>
											<th>Adı</th>	
											<th class="siar_nomresi_alani">Sıra No</th>		
											<?php if ($SobeBolmeDurumKontrol==1 or $SobeBolmeDuzelis==1 or $SobeBolmeSil==1): ?>
												<th>Əməliyatlar</th>						
											<?php endif ?>								
											
										</tr>
									</thead>
									<tbody id="list" class="table_ici">
										<?php
										$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id order by Sira_No ASC");
										$Sobe_Sor->execute(array(
											'Idare_Id'=>$Idare_Id));
										$Sira_Nomir=0;
										while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
											$Sira_Nomir++;	
											?>
											<tr id="setir-<?php echo $Sobe_Cek['Sobe_Id'] ?>">							
												<td class="siar_no_alani"><?php echo $Sira_Nomir ?></td>
												<td id="SobeAd_<?php echo $Sobe_Cek['Sobe_Id'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
												<td  class="siar_nomresi_alani textaligncenter" id="Sira_No<?php echo $Sobe_Cek['Sobe_Id'] ?>"><?php echo $Sobe_Cek['Sira_No'] ?></td>	
												<?php if ($SobeBolmeDurumKontrol==1 or $SobeBolmeDuzelis==1 or $SobeBolmeSil==1): ?>


													<td class="emeliyyatlar_Uc_Button_alani">
														<?php if ($SobeBolmeDurumKontrol==1) { ?>
															<label class="checkbox" title="" >
																<input 
																<?php 
																if ($Sobe_Cek['Durum']==1) {
																	echo  "checked";
																}else{}
																?>
																type="checkbox" id="DurumId_<?php echo $Sobe_Cek['Sobe_Id'] ?>" onchange="DurumKontrol(this.id)" > 
																<span class="checkbox"> 
																	<span></span>
																</span>
															</label>
														<?php } if ($SobeBolmeDuzelis==1) {?>
															<button class="YenileButonlari" id="DuzelisButton_<?php echo $Sobe_Cek['Sobe_Id'] ?>" onclick="Duzelis(this.id)" type="button">Düzəliş</button>
														<?php } if ($SobeBolmeSil==1) { ?>
															<button class="YenileButonlari" id="SilButton_<?php echo $Sobe_Cek['Sobe_Id'] ?>" onclick="SilYoxlanis(this.id)" type="button">Sil</button>
														<?php } ?>
													</td> 
												<?php endif ?>												
											</tr>	
										<?php }	?>
									</tbody>
								</table>
									<?php 
								}
							} ?>
						</div>
					</div>
					<?php 
				}
				else{
					echo "error_1002";/*Silinme ugursuz*/
				}
			}else{
				echo "error_1001";/*Silinme ugursuz*/
			}
		}else{
			echo "error_1000";/*Bazada movcut deyil*/
		}	
	}else{
		header("Location:../login.php");
		exit;
	}
}
?>