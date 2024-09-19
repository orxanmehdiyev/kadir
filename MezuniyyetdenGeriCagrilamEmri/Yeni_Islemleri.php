<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                          =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Geri_Cagrilama_Tarixi       =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Geri_Cagrilama_Tarixi']);
	$Mezuniyyet_Geri_Emir_No     =  EditorluIcerikleriFiltrle($deyer['Mezuniyyet_Geri_Emir_No']);
	$Mezuniyyet_Geri_Tarix       =  TarixAzCevir($Geri_Cagrilama_Tarixi);
	$Mezuniyyet_Geri_Tarix_Bey   =  TarixBeynelxalqCevir($Geri_Cagrilama_Tarixi);
	$Mezuniyyet_Geri_Tarix_Unix  =  TarixUnikCevir($Geri_Cagrilama_Tarixi);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Geri_Cagrilama_Tarixi!=$Mezuniyyet_Geri_Tarix){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Geri_Cagrilama_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}elseif(TeqvimQeyriIsGunuYoxla($deyer['Geri_Cagrilama_Tarixi'],$db)==0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Geri_Cagrilama_Tarixi">';
		echo '<input type="hidden" id="message" value="İş günü deyil">';
		exit;
	}elseif($Mezuniyyet_Geri_Tarix_Unix<$ZamanDamgasi){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Geri_Cagrilama_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}
	else{
		$Mezuniyyet_Sor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Mezuniyyet_Durum=:Mezuniyyet_Durum and Mezuniyyet_Bitis_Tarixi_Unix>:Mezuniyyet_Bitis_Tarixi_Unix order by Mezuniyyet_Baslagic_Tarixi_Unix DESC");
		$Mezuniyyet_Sor->execute(array(
			'ID'=>$ID,
			'Mezuniyyet_Durum'=>0,
			'Mezuniyyet_Bitis_Tarixi_Unix'=>$ZamanDamgasi));
		$Say=$Mezuniyyet_Sor->rowCount();
		$Mezuniyyet_Cek=$Mezuniyyet_Sor->fetch(PDO::FETCH_ASSOC);
		$Mezuniyyet_Baslagic_Tarixi_Beynel=$Mezuniyyet_Cek['Mezuniyyet_Baslagic_Tarixi_Beynel'];
		$Mezuniyyet_Bitis_Tarixi=$Mezuniyyet_Cek['Mezuniyyet_Bitis_Tarixi'];
		$Mezuniyyet_Bitis_Tarixi_Unix=$Mezuniyyet_Cek['Mezuniyyet_Bitis_Tarixi_Unix'];
		$Mezuniyyet_Ise_Cixma_Tarixi=$Mezuniyyet_Cek['Mezuniyyet_Ise_Cixma_Tarixi'];
		$Mezuniyyet_Ise_Cixma_Tarixi_Unix=$Mezuniyyet_Cek['Mezuniyyet_Ise_Cixma_Tarixi_Unix'];
		$Mezuniyyet_Gun=$Mezuniyyet_Cek['Mezuniyyet_Gun'];
		$Mezuniyyet_Qaliq_Gun=$Mezuniyyet_Cek['Mezuniyyet_Qaliq_Gun'];
		$Mezuniyyet_Id=$Mezuniyyet_Cek['Mezuniyyet_Id'];
		$toplamgun=$Mezuniyyet_Gun+$Mezuniyyet_Qaliq_Gun;
		$d1 = new DateTime($Mezuniyyet_Geri_Tarix_Bey);
		$d2 = new DateTime($Mezuniyyet_Baslagic_Tarixi_Beynel);
		$gunferqi= $d1->diff($d2)->d; 
		$QalanGun=$toplamgun-$gunferqi;
		$Istehsalat_Sor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq>:Baslangic and Tarix_Adi_Beynelxalq<:Bitis");
		$Istehsalat_Sor->execute(array(
			'Baslangic'=>$Mezuniyyet_Baslagic_Tarixi_Beynel,
			'Bitis'=>$Mezuniyyet_Geri_Tarix_Bey));
		$IstehsalatSay=$Istehsalat_Sor->rowCount();
		if ($IstehsalatSay>0) {
			while ($Istehsalat_Cek=$Istehsalat_Sor->fetch(PDO::FETCH_ASSOC)) {
				$Sebeb=$Istehsalat_Cek['Sebeb'];
				if ($Sebeb==1 or $Sebeb==5 ) {
					$QalanGun++;
					$gunferqi--;
				}
			}			
		}
		if ($Say>0) {			
			$Elave_Et=$db->prepare("INSERT INTO mezuniyyet_geri SET                               
				Mezuniyyet_Id=:Mezuniyyet_Id,
				ID=:ID,
				Mezuniyyet_Geri_Tarix=:Mezuniyyet_Geri_Tarix,
				Mezuniyyet_Geri_Tarix_Bey=:Mezuniyyet_Geri_Tarix_Bey,	
				Mezuniyyet_Geri_Tarix_Unix=:Mezuniyyet_Geri_Tarix_Unix,	
				Mezuniyyet_Geri_Emir_No=:Mezuniyyet_Geri_Emir_No
				");
			$Insert=$Elave_Et->execute(array(                                
				'Mezuniyyet_Id'=>$Mezuniyyet_Id,
				'ID'=>$ID,
				'Mezuniyyet_Geri_Tarix'=>$Mezuniyyet_Geri_Tarix,
				'Mezuniyyet_Geri_Tarix_Bey'=>$Mezuniyyet_Geri_Tarix_Bey,
				'Mezuniyyet_Geri_Tarix_Unix'=>$Mezuniyyet_Geri_Tarix_Unix,
				'Mezuniyyet_Geri_Emir_No'=>$Mezuniyyet_Geri_Emir_No		
			));
			if ($Insert) {
				$Mezuniyyet_Geri_Id=$db->lastInsertId();
				$Elave_Et=$db->prepare("INSERT INTO mezuniyyet_geri_islemleri SET                               
					Admin_Id=:Admin_Id,
					IPAdresi=:IPAdresi,
					TarixSaat=:TarixSaat,
					ZamanDamgasi=:ZamanDamgasi,				
					Mezuniyyet_Id=:Mezuniyyet_Id,
					Mezuniyyet_Geri_Id=:Mezuniyyet_Geri_Id,
					ID=:ID,
					Mezuniyyet_Geri_Tarix=:Mezuniyyet_Geri_Tarix,
					Mezuniyyet_Geri_Tarix_Bey=:Mezuniyyet_Geri_Tarix_Bey,	
					Mezuniyyet_Geri_Tarix_Unix=:Mezuniyyet_Geri_Tarix_Unix,	
					Mezuniyyet_Geri_Emir_No=:Mezuniyyet_Geri_Emir_No
					");
				$Insert=$Elave_Et->execute(array(                                
					'Admin_Id'=>$Admin_Id,
					'IPAdresi'=>$IPAdresi,
					'TarixSaat'=>$TarixSaat,
					'ZamanDamgasi'=>$ZamanDamgasi,
					'Mezuniyyet_Id'=>$Mezuniyyet_Id,
					'Mezuniyyet_Geri_Id'=>$Mezuniyyet_Geri_Id,
					'ID'=>$ID,
					'Mezuniyyet_Geri_Tarix'=>$Mezuniyyet_Geri_Tarix,
					'Mezuniyyet_Geri_Tarix_Bey'=>$Mezuniyyet_Geri_Tarix_Bey,
					'Mezuniyyet_Geri_Tarix_Unix'=>$Mezuniyyet_Geri_Tarix_Unix,
					'Mezuniyyet_Geri_Emir_No'=>$Mezuniyyet_Geri_Emir_No		
				));
				if ($Insert) {
					$yenile = $db->prepare("UPDATE mezuniyyet SET     
						Mezuniyyet_Bitis_Tarixi=:Mezuniyyet_Bitis_Tarixi,					
						Mezuniyyet_Bitis_Tarixi_Unix=:Mezuniyyet_Bitis_Tarixi_Unix,					
						Mezuniyyet_Ise_Cixma_Tarixi=:Mezuniyyet_Ise_Cixma_Tarixi,					
						Mezuniyyet_Ise_Cixma_Tarixi_Unix=:Mezuniyyet_Ise_Cixma_Tarixi_Unix,					
						Mezuniyyet_Gun=:Mezuniyyet_Gun,					
						Mezuniyyet_Qaliq_Gun=:Mezuniyyet_Qaliq_Gun,					
						Mezuniyyet_Gun_Geri=:Mezuniyyet_Gun_Geri,					
						Mezuniyyet_Qaliq_Gun_Geri=:Mezuniyyet_Qaliq_Gun_Geri,					
						Mezuniyyet_Bitis_Tarixi_Geri=:Mezuniyyet_Bitis_Tarixi_Geri,					
						Mezuniyyet_Bitis_Tarixi_Unix_Geri=:Mezuniyyet_Bitis_Tarixi_Unix_Geri,					
						Mezuniyyet_Ise_Cixma_Tarixi_Geri=:Mezuniyyet_Ise_Cixma_Tarixi_Geri,					
						Mezuniyyet_Ise_Cixma_Tarixi_Unix_Geri=:Mezuniyyet_Ise_Cixma_Tarixi_Unix_Geri,					
						Mezuniyyet_Geri_Id=:Mezuniyyet_Geri_Id		
						WHERE Mezuniyyet_Id=$Mezuniyyet_Id");
					$update = $yenile->execute(array(     
						'Mezuniyyet_Bitis_Tarixi'=>$Mezuniyyet_Geri_Tarix,
						'Mezuniyyet_Bitis_Tarixi_Unix'=>$Mezuniyyet_Geri_Tarix_Unix,
						'Mezuniyyet_Ise_Cixma_Tarixi'=>$Mezuniyyet_Geri_Tarix,
						'Mezuniyyet_Ise_Cixma_Tarixi_Unix'=>$Mezuniyyet_Geri_Tarix_Unix,
						'Mezuniyyet_Gun'=>$gunferqi,
						'Mezuniyyet_Qaliq_Gun'=>$QalanGun,
						'Mezuniyyet_Gun_Geri'=>$Mezuniyyet_Gun,
						'Mezuniyyet_Qaliq_Gun_Geri'=>$Mezuniyyet_Qaliq_Gun,
						'Mezuniyyet_Bitis_Tarixi_Geri'=>$Mezuniyyet_Bitis_Tarixi,
						'Mezuniyyet_Bitis_Tarixi_Unix_Geri'=>$Mezuniyyet_Bitis_Tarixi_Unix,
						'Mezuniyyet_Ise_Cixma_Tarixi_Geri'=>$Mezuniyyet_Ise_Cixma_Tarixi,
						'Mezuniyyet_Ise_Cixma_Tarixi_Unix_Geri'=>$Mezuniyyet_Ise_Cixma_Tarixi_Unix,
						'Mezuniyyet_Geri_Id'=>$Mezuniyyet_Geri_Id			
					));
					if ($update) {
						echo '<input type="hidden" id="status" value="succes">';
						echo '<input type="hidden" id="statusiki" value="Geri_Cagrilama_Tarixi">';
						echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
						$Sor=$db->prepare("SELECT * FROM mezuniyyet_geri order by Mezuniyyet_Geri_Tarix_Unix DESC ");
						$Sor->execute();
						$Say=$Sor->rowCount();
						if ($Say>0) {?>
							<div class="row">
								<div class="over-y genislik">
									<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
										<thead class="">
											<tr>
												<th>№</th>
												<th>Adı,soyadı</th>
												<th>Geri Çağrılam Tarixi</th>									
												<th>Əmrin nömrəsi</th>
												<th>Əməliyatlar</th>																							
											</tr>
										</thead>
										<tbody id="list" class="table_ici">
											<?php 
											$MezuniyyetSira=0;
											while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
												$MezuniyyetSira++;
												?>
												<tr>							
													<td class="siar_no_alani"><?php echo $MezuniyyetSira ?></td>
													<td><?php 
													$user_sor=$db->prepare("SELECT * FROM user where ID=:ID");
													$user_sor->execute(array(
														'ID'=>$Cek['ID']));
													$user_cek=$user_sor->fetch(PDO::FETCH_ASSOC);
													echo $user_cek['Soy_Adi']." ".$user_cek['Adi']." ".$user_cek['Ata_Adi'] ?></td>									
													<td><?php echo $Cek['Mezuniyyet_Geri_Tarix'] ?></td>
													<td><?php echo $Cek['Mezuniyyet_Geri_Emir_No'] ?></td>																	
													<td class="emeliyyatlar_iki_buttom">
											<?php 
											$MezuniyyetSor=$db->prepare("SELECT * FROM mezuniyyet where Mezuniyyet_Id=:Mezuniyyet_Id");
											$MezuniyyetSor->execute(array(
												'Mezuniyyet_Id'=>$Cek['Mezuniyyet_Id']));
											$MezuniyyetCek=$MezuniyyetSor->fetch(PDO::FETCH_ASSOC);
											if ($MezuniyyetCek['Mezuniyyet_Durum']==0) {	?>												
												<button class="YenileButonlari" id="Sil_<?php echo $Cek['Mezuniyyet_Geri_Id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>												
											<?php }else{} ?>
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
									Bazada məzuniyyətdən geri çağrılma əmri yoxdur
								</div>
							</div> 
						<?php 	}	
					}else{
						echo '<input type="hidden" id="status" value="errorfull">';
						echo '<input type="hidden" id="statusiki" value="Geri_Cagrilama_Tarixi">';
						echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
						exit;
					}
				}else{
					echo '<input type="hidden" id="status" value="errorfull">';
					echo '<input type="hidden" id="statusiki" value="Geri_Cagrilama_Tarixi">';
					echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
					exit;
				}

			}else{
				echo '<input type="hidden" id="status" value="errorfull">';
				echo '<input type="hidden" id="statusiki" value="Geri_Cagrilama_Tarixi">';
				echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
				exit;
			}
		}else{
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="ID">';
			echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
			exit;
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>