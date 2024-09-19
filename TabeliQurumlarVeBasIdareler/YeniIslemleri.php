<?php 
require_once '../Ayarlar/setting.php';
if (!isset($_POST['Deyer'])) {
	header("Location:login.php");
	exit;
}else{
	$deyer   = json_decode($_POST['Deyer'],true);
	$Adi     = HerfVeReqemlerVebeziKarakterlerXaricButunKarakterleriSil($deyer['Adi']);
	$Seo_Url=seo($Adi);
	$SiraSor=$db->prepare("SELECT MAX(Sira_No) AS Sira_No FROM tabeli_qurumlar_ve_bas_idareler");
	$SiraSor->execute();
	$SiraCek=$SiraSor->fetch(PDO::FETCH_ASSOC);
	$Sira_No=$SiraCek['Sira_No']+1;
	if ($Adi!="") {
		$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Adi=:Adi");
		$Sor->execute(array(			
			'Adi'=>$Adi
		));				
		$Say=$Sor->rowCount();
		if (!$Say>0) {
			$Elave_Et=$db->prepare("INSERT INTO tabeli_qurumlar_ve_bas_idareler SET
				Sira_No=:Sira_No,
				TarixSaat=:TarixSaat,
				ZamanDamgasi=:ZamanDamgasi,
				Seo_Url=:Seo_Url,
				Adi=:Adi
				");
			$Insert=$Elave_Et->execute(array(
				'Sira_No'=>$Sira_No,
				'TarixSaat'=>$TarixSaat,
				'ZamanDamgasi'=>$ZamanDamgasi,
				'Seo_Url'=>$Seo_Url,
				'Adi'=>$Adi
			));
			if ($Insert) {
				$Islem_Edilen_Id = $db->lastInsertId();
				$Elave_Et=$db->prepare("INSERT INTO tabeli_qurumlar_ve_bas_idareler_islemleri SET
					Sira_No=:Sira_No,
					Adi=:Adi,
					Islem_Edilen_Id=:Islem_Edilen_Id,
					TarixSaat=:TarixSaat,
					ZamanDamgasi=:ZamanDamgasi,
					Seo_Url=:Seo_Url,
					IPAdresi=:IPAdresi,
					Admin_Id=:Admin_Id
					");
				$Insert=$Elave_Et->execute(array(
					'Sira_No'=>$Sira_No,
					'Adi'=>$Adi,
					'Islem_Edilen_Id'=>$Islem_Edilen_Id,				
					'TarixSaat'=>$TarixSaat,
					'ZamanDamgasi'=>$ZamanDamgasi,
					'Seo_Url'=>$Seo_Url,
					'IPAdresi'=>$IPAdresi,
					'Admin_Id'=>$Admin_Id
				));
				if ($Insert) {
					$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler");
					$Sor->execute();
					$Say=$Sor->rowCount();
					if ($Say>0) {?>
						<div class="row">
							<div class="over-y genislik">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="siar_no_alani">№</th>
											<th>Tabeli Qurumun və ya Baş İdarənin Adı</th>
											<th colspan="3" class="emeliyyatlar_alani">Əməliyyatlar</th>		
										</tr>
									</thead>
									<tbody id="vezifeadlarlisti" class="table_ici">
										<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { ?>
											<tr>						
												<td class="vezife_adlari_sira_input_kapsama">
													<input class="vezifeadlarisira" min="1" id="SiraId_<?php echo $Cek['Id'] ?>" type="number" value="<?php echo $Cek['Sira_No'] ?>" onfocusout="SiraDuzelis(this.id)" onkeydown="javascript: return event.keyCode == 69 ? false : true" >
												</td>
												<td class="vezife_adlari_ad_input_kapsama" id="AdId_<?php echo $Cek['Id'] ?>">
													<?php echo $Cek['Adi'] ?>
												</td>
												<td class="Vezife_Adlari_Durum_Kapsama">
													<label class="checkbox" title="" >
														<input 
														<?php 
														if ($Cek['Durum']==1) {
															echo  "checked";
														}else{}
														?>
														type="checkbox" id="DurumId_<?php echo $Cek['Id'] ?>" onchange="DurumKontrol(this.id)" > 
														<span class="checkbox"> 
															<span></span>
														</span>
													</label>
												</td>	
												<td class="emeliyyatlar_duzeli_alani">										
													<button class="YenileButonlari" id="DuzelisButton_<?php echo $Cek['Id'] ?>" onclick="DuzelisYoxlanis(this.id)" type="button">Düzəliş</button>
												</td> 							
												<td class="emeliyyatlar_sil_alani">										
													<button class="YenileButonlari" id="SilButton_<?php echo $Cek['Id'] ?>" onclick="SilYoxlanis(this.id)" type="button">Sil</button>
												</td> 
											</tr>	
										<?php }	?>									
									</tbody>
								</table>
							</div>
						</div>
					<?php } else{	?>
						<div class="row">
							<div class="over-y">
								Bazada Tabeli Qurum Və Ya Baş İdarə Mövcut Deyil
							</div>
						</div> 					
					<?php 	}	
				}else{
					echo "error_1006";/*Ikinci Insert xeta*/
					exit;
				}
			}else{
				echo "error_1005";/*Birinci Insert xeta*/
				exit;
			}			
		}else{
			echo "error_1003";/*Adi Bazada var*/
			exit;
		}
	}else{
		echo "error_1002";/*Adi Boş*/
		exit;
	}
}
?>