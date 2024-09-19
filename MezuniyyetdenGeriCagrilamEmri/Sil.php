<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Mezuniyyet_Geri_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM mezuniyyet_geri where Mezuniyyet_Geri_Id=:Mezuniyyet_Geri_Id");
	$Sor->execute(array(
		'Mezuniyyet_Geri_Id'=>$Mezuniyyet_Geri_Id));
	$Say=$Sor->rowCount();
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$Mezuniyyet_Id=$Cek['Mezuniyyet_Id'];
	$ID=$Cek['ID'];
	$Mezuniyyet_Geri_Tarix=$Cek['Mezuniyyet_Geri_Tarix'];
	$Mezuniyyet_Geri_Tarix_Bey=$Cek['Mezuniyyet_Geri_Tarix_Bey'];
	$Mezuniyyet_Geri_Tarix_Unix=$Cek['Mezuniyyet_Geri_Tarix_Unix'];
	$Mezuniyyet_Geri_Emir_No=$Cek['Mezuniyyet_Geri_Emir_No'];
	$Mezuniyyet_Geri_Durum=$Cek['Mezuniyyet_Geri_Durum'];
	$sil = $db->prepare("DELETE from mezuniyyet_geri where Mezuniyyet_Geri_Id=:Mezuniyyet_Geri_Id");
	$kontrol = $sil->execute(array('Mezuniyyet_Geri_Id' => $Mezuniyyet_Geri_Id));	
	if ($kontrol) {
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
			$MezSor=$db->prepare("SELECT * FROM mezuniyyet where Mezuniyyet_Id=:Mezuniyyet_Id");
			$MezSor->execute(array('Mezuniyyet_Id'=>$Mezuniyyet_Id));
			$MezCek=$MezSor->fetch(PDO::FETCH_ASSOC);
			$Mezuniyyet_Gun=$MezCek['Mezuniyyet_Gun_Geri'];
			$Mezuniyyet_Qaliq_Gun=$MezCek['Mezuniyyet_Qaliq_Gun_Geri'];
			$Mezuniyyet_Bitis_Tarixi=$MezCek['Mezuniyyet_Bitis_Tarixi_Geri'];
			$Mezuniyyet_Bitis_Tarixi_Unix=$MezCek['Mezuniyyet_Bitis_Tarixi_Unix_Geri'];
			$Mezuniyyet_Ise_Cixma_Tarixi=$MezCek['Mezuniyyet_Ise_Cixma_Tarixi_Geri'];
			$Mezuniyyet_Ise_Cixma_Tarixi_Unix=$MezCek['Mezuniyyet_Ise_Cixma_Tarixi_Unix_Geri'];
			$Mezuniyyet_Gun_Geri="";
			$Mezuniyyet_Qaliq_Gun_Geri="";
			$Mezuniyyet_Bitis_Tarixi_Geri="";
			$Mezuniyyet_Bitis_Tarixi_Unix_Geri="";
			$Mezuniyyet_Ise_Cixma_Tarixi_Geri="";
			$Mezuniyyet_Ise_Cixma_Tarixi_Unix_Geri="";
			$Mezuniyyet_Geri_Id="";
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
				'Mezuniyyet_Bitis_Tarixi'=>$Mezuniyyet_Bitis_Tarixi,
				'Mezuniyyet_Bitis_Tarixi_Unix'=>$Mezuniyyet_Bitis_Tarixi_Unix,
				'Mezuniyyet_Ise_Cixma_Tarixi'=>$Mezuniyyet_Ise_Cixma_Tarixi,
				'Mezuniyyet_Ise_Cixma_Tarixi_Unix'=>$Mezuniyyet_Ise_Cixma_Tarixi_Unix,
				'Mezuniyyet_Gun'=>$Mezuniyyet_Gun,
				'Mezuniyyet_Qaliq_Gun'=>$Mezuniyyet_Qaliq_Gun,
				'Mezuniyyet_Gun_Geri'=>$Mezuniyyet_Gun_Geri,
				'Mezuniyyet_Qaliq_Gun_Geri'=>$Mezuniyyet_Qaliq_Gun_Geri,
				'Mezuniyyet_Bitis_Tarixi_Geri'=>$Mezuniyyet_Bitis_Tarixi_Geri,
				'Mezuniyyet_Bitis_Tarixi_Unix_Geri'=>$Mezuniyyet_Bitis_Tarixi_Unix_Geri,
				'Mezuniyyet_Ise_Cixma_Tarixi_Geri'=>$Mezuniyyet_Ise_Cixma_Tarixi_Geri,
				'Mezuniyyet_Ise_Cixma_Tarixi_Unix_Geri'=>$Mezuniyyet_Ise_Cixma_Tarixi_Unix_Geri,
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
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>