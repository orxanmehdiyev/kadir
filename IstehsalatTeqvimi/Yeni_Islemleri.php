<?php 
require_once '../Ayarlar/setting.php';
if ($IstehsaltTeqvimiYeni==1) {

if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Tarixi                     =strtotime($deyer['Tarix_Adi']) ; 
	$Tarix_Adi                =date("d.m.Y", $Tarixi);
	$Tarix_Adi_Beynelxalq                =date("Y-m-d", $Tarixi);
	$Sebeb=ReqemlerXaricButunKarakterleriSil($deyer['Sebeb']);
	if ($Tarix_Adi!="") { 
		$Sor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi=:Tarix_Adi");
		$Sor->execute(array(
			'Tarix_Adi'=>$Tarix_Adi));
		$Say=$Sor->rowCount();

		if (!$Say>0) {
			if ($Sebeb!="") {
				$Elave_Et=$db->prepare("INSERT INTO  istehsalt_teqvimi SET                               
					Tarix_Adi=:Tarix_Adi,
					Tarix_Adi_Unix=:Tarix_Adi_Unix,
					Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq,
					TarixSaat=:TarixSaat,
					Sebeb=:Sebeb			
					");
				$Insert=$Elave_Et->execute(array(                                
					'Tarix_Adi'=>$Tarix_Adi,
					'Tarix_Adi_Unix'=>$Tarixi,
					'Tarix_Adi_Beynelxalq'=>$Tarix_Adi_Beynelxalq,
					'TarixSaat'=>$TarixSaat,
					'Sebeb'=>$Sebeb			
				));

				if ($Insert) {
					$Istehsalt_Teqvimi_ID=$db->lastInsertId();
					$Elave_Et=$db->prepare("INSERT INTO istehsalt_teqvimi_islemleri SET                               
						Istehsalt_Teqvimi_ID=:Istehsalt_Teqvimi_ID,
						TarixSaat=:TarixSaat,
						Tarix_Adi=:Tarix_Adi,
						Tarix_Adi_Unix=:Tarix_Adi_Unix,
						Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq,
						Sebeb=:Sebeb,	
						Islem_Sebebi=:Islem_Sebebi,	
						IPAdresi=:IPAdresi,
						Admin_Id=:Admin_Id,
						Admin_Ad=:Admin_Ad,
						Admin_Soyad=:Admin_Soyad,
						Admin_Ataadi=:Admin_Ataadi
						");
					$Insert=$Elave_Et->execute(array(                                
						'Istehsalt_Teqvimi_ID'=>$Istehsalt_Teqvimi_ID,
						'TarixSaat'=>$TarixSaat,
						'Tarix_Adi'=>$Tarix_Adi,
						'Tarix_Adi_Unix'=>$Tarixi,
						'Tarix_Adi_Beynelxalq'=>$Tarix_Adi_Beynelxalq,
						'Sebeb'=>$Sebeb,
						'Islem_Sebebi'=>1,
						'IPAdresi'=>$IPAdresi,
						'Admin_Id'=>$Admin_Id,
						'Admin_Ad'=>$Admin_Ad,
						'Admin_Soyad'=>$Admin_Soyad,
						'Admin_Ataadi'=>$Admin_Ataadi
					));
					if ($Insert) {?>

						<?php 
						$Sor=$db->prepare("SELECT * FROM  istehsalt_teqvimi order by Tarix_Adi_Unix DESC");
						$Sor->execute();
						$Say=$Sor->rowCount();
						if ($Say>0) {?>
							<div class="row">
								<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
									<table class="ListelemeAlaniIciTablosu" id="istehsalatteqvimi">						
										<thead>
											<tr>
												<th>Tarix</th>
												<th>Səbəb</th>										
												<th>Əməliyyatlar</th>		

											</tr>
										</thead>
										<tbody>
											<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
												if ($Cek['Sebeb']==1) {
													$Sebeb="Bayram Günü";
												}elseif($Cek['Sebeb']==2){
													$Sebeb="Bayram Günü Əvəzi";
												}elseif($Cek['Sebeb']==3){
													$Sebeb="İş günü";
												}elseif($Cek['Sebeb']==4){
													$Sebeb="İstrahət Günü";
												}elseif($Cek['Sebeb']==5){
													$Sebeb="Seçgi Günü";
												}

												?>
												<tr>		
													<td><?php echo $Cek['Tarix_Adi'] ?></td>					
													<td><?php echo $Sebeb ?></td>										

													<td class="emeliyyatlar_iki_buttom">										
														<button class="YenileButonlari" id="Sil_<?php echo $Cek['Istehsalt_Teqvimi_ID'] ?>" onclick="Sil(this.id)" type="button">
															<i class="fas fa-trash"></i>
														</button>											
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
									İstehsalat təqviminə düzəliş yoxdur
								</div>
							</div>			
						<?php }
					}else{
						echo "error_2004";/* Insert ugursuz*/
						exit;
					}
				}else{				
					echo "error_2003";/* Insert ugursuz*/
					exit;
				}
			}else{
				echo "error_2002";/* kissa Adı boş ola bilməz*/
				exit;
			}
		}else{
			?>

			<?php 
			$Sor=$db->prepare("SELECT * FROM  istehsalt_teqvimi order by Istehsalt_Teqvimi_ID DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
						<table class="ListelemeAlaniIciTablosu" id="istehsalatteqvimi">						
							<thead>
								<tr>
									<th>Tarix</th>
									<th>Səbəb</th>										
									<th>Əməliyyatlar</th>		

								</tr>
							</thead>
							<tbody>
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									if ($Cek['Sebeb']==1) {
										$Sebeb="Bayram Günü";
									}elseif($Cek['Sebeb']==2){
										$Sebeb="Bayram Günü Əvəzi";
									}elseif($Cek['Sebeb']==3){
										$Sebeb="İş günü";
									}elseif($Cek['Sebeb']==4){
										$Sebeb="İstrahət Günü";
									}elseif($Cek['Sebeb']==5){
										$Sebeb="Seçgi Günü";
									}

									?>
									<tr>		
										<td><?php echo $Cek['Tarix_Adi'] ?></td>					
										<td><?php echo $Sebeb ?></td>										

										<td class="emeliyyatlar_iki_buttom">										
											<button class="YenileButonlari" id="Sil_<?php echo $Cek['Istehsalt_Teqvimi_ID'] ?>" onclick="Sil(this.id)" type="button">
												<i class="fas fa-trash"></i>
											</button>											
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
						İstehsalat təqviminə düzəliş yoxdur
					</div>
				</div>			
			<?php }			
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