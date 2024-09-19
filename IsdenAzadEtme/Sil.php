<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {	
	$ID                            =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']); 

	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>0));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Islediyi_Idare_Id=$User_Cek['Isden_Cixarilma_Idare_Id'];
	$Islediyi_Sobe_Id=$User_Cek['Isden_Cixarilma_Sobe_Id'];
	$Vezife_Id=$User_Cek['Isden_Cixarilma_Vezife_Id'];	
	$Emir_Id=$User_Cek['Emir_Id'];	
	$Bosalt="";

	$sil = $db->prepare("DELETE from emir where Emir_Id=:Emir_Id");
	$kontrol = $sil->execute(array(
		'Emir_Id'=>$Emir_Id
	));	

	$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id and User_Id=:User_Id");
	$Vezife_Sor->execute(array(
		'Vezife_Id'=>$Vezife_Id,
		'User_Id'=>0));
	$Vezife_Say=$Vezife_Sor->rowCount();

	if ($User_Say==1 and $Vezife_Say==1) {
		$Elave_Et=$db->prepare("UPDATE user SET                               
			Emir_Id=:Emir_Id,			
			Isden_Cixarilma_Emir_No=:Isden_Cixarilma_Emir_No,			
			xitam_sebebleri_kisa_ad=:xitam_sebebleri_kisa_ad,			
			Isden_Cixarilma_Tarixi=:Isden_Cixarilma_Tarixi,			
			xitam_sebebleri_id=:xitam_sebebleri_id,			
			Isden_Cixarilma_Idare_Id=:Isden_Cixarilma_Idare_Id,			
			Isden_Cixarilma_Sobe_Id=:Isden_Cixarilma_Sobe_Id,			
			Isden_Cixarilma_Vezife_Id=:Isden_Cixarilma_Vezife_Id,
			Islediyi_Idare_Id=:Islediyi_Idare_Id,
			Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
			Vezife_Id=:Vezife_Id,
			Durum=:Durum
			where ID=$ID			
			");
		$Update=$Elave_Et->execute(array(                                
			'Emir_Id'=>0,			
			'Isden_Cixarilma_Emir_No'=>$Bosalt,			
			'xitam_sebebleri_kisa_ad'=>$Bosalt,			
			'Isden_Cixarilma_Tarixi'=>$Bosalt,			
			'xitam_sebebleri_id'=>$Bosalt,			
			'Isden_Cixarilma_Idare_Id'=>$Bosalt,			
			'Isden_Cixarilma_Sobe_Id'=>$Bosalt,			
			'Isden_Cixarilma_Vezife_Id'=>$Bosalt,		
			'Islediyi_Idare_Id'=>$Islediyi_Idare_Id,		
			'Islediyi_Sobe_Id'=>$Islediyi_Sobe_Id,		
			'Vezife_Id'=>$Vezife_Id,		
			'Durum'=>1	
		));
		if ($Update) {		
			$Elave_Et=$db->prepare("UPDATE vezife SET                               
				User_Id=:User_Id
				where Vezife_Id=$Vezife_Id
				");
			$Insert=$Elave_Et->execute(array(                                
				'User_Id'=>$ID
			));

			if ($Insert) {
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
				echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
				$Sor=$db->prepare("SELECT * FROM user where Durum=:Durum order by Isden_Cixarilma_Tarixi DESC");
				$Sor->execute(array(
					'Durum'=>0));
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>
								<th>Adı,soyadı</th>
								<th>Səbəb</th>
								<th>Tarixi</th>
								<th>Əmri No</th>																
								<th>Sil</th>																							
							</tr>
						</thead>
						<tbody id="list" class="table_ici">
							<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
								<tr>
									<td><?php echo $Cek['Soy_Adi']." ".$Cek['Adi']." ".$Cek['Ata_Adi'] ?></td>			
									<td><?php echo $Cek['xitam_sebebleri_kisa_ad'] ?></td>
									<td data-sort="<?php echo$Cek['Isden_Cixarilma_Tarixi'] ?>"><?php echo TarixAzCevir($Cek['Isden_Cixarilma_Tarixi']) ?></td>
									<td><?php echo $Cek['Isden_Cixarilma_Emir_No'] ?></td>
									<td class="emeliyyatlar_sil_buttom">	
									<?php 
									if ($Cek['Isden_Cixarilma_Tarixi'] >0 and $Cek['Isden_Cixarilma_Idare_Id'] >0 ) {
										$VezifeSor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id");
										$VezifeSor->execute(array(
											'Vezife_Id'=>$Cek['Isden_Cixarilma_Vezife_Id']));	
										$VezifeCek=$VezifeSor->fetch(PDO::FETCH_ASSOC);
										if (!$VezifeCek['User_Id']>0) { echo SilButonu($Cek['ID']); 
									}

								} ?>
							</td>
								</tr>	
							<?php }
							?>
						</tbody>
					</table>
				<?php }else{	?>
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>
								<th>№</th>
								<th>Adı,soyadı</th>
								<th>Səbəb</th>
								<th>Tarixi</th>
								<th>Əmri No</th>																
								<th>Sil</th>																							
							</tr>
						</thead>
					</table> 
				<?php 	}	?>

			<?php	}else{
				echo '<input type="hidden" id="status" value="errorfull">';
				echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
				echo '<input type="hidden" id="message" value="Ikinci melumat xetali">';
				exit;
			}
		}else{
			echo '<input type="hidden" id="status" value="errorfull">';
			echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
			echo '<input type="hidden" id="message" value="Ikinci melumat xetali">';
			exit;
		}
	}else{
		$Sor=$db->prepare("SELECT * FROM user where Durum=:Durum order by Isden_Cixarilma_Tarixi DESC");
		$Sor->execute(array(
			'Durum'=>0));
		$Say=$Sor->rowCount();
		if ($Say>0) {?>
			<div class="row">
				<div class="over-y genislik">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>
								<th>№</th>
								<th>Adı,soyadı</th>
								<th>Səbəb</th>
								<th>Tarixi</th>
								<th>Əmri No</th>																
								<th>Sil</th>																							
							</tr>
						</thead>
						<tbody id="list" class="table_ici">
							<?php 
							$Sira=0;
							while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
								$Sira++;			
								?>
								<tr>							
									<td class="siar_no_alani"><?php echo $Sira ?></td>
									<td><?php echo $Cek['Soy_Adi']." ".$Cek['Adi']." ".$Cek['Ata_Adi'] ?></td>
									<td><?php echo $Cek['Isden_Cixarilma_Sebebi'] ?></td>
									<td><?php echo $Cek['Isden_Cixarilma_Tarixi'] ?></td>
									<td><?php echo $Cek['Isden_Cixarilma_Emir_No'] ?></td>
									<td class="emeliyyatlar_iki_buttom">	
										<?php 
										$VezifeSor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id");
										$VezifeSor->execute(array(
											'Vezife_Id'=>$Cek['Isden_Cixarilma_Vezife_Id']));	
										$VezifeCek=$VezifeSor->fetch(PDO::FETCH_ASSOC);
										if (!$VezifeCek['User_Id']>0) {	?>
											<button class="YenileButonlari" id="Sil_<?php echo $Cek['ID'] ?>" onclick="Sil(this.id)" type="button">
												<i class="fas fa-trash"></i>
											</button>
										<?php } ?>
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
					Bazada İşdən Azad Etmə Əmri Yoxdur
				</div>
			</div> 
		<?php 	}	?>

		<?php	
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>