<?php 
require_once '../Ayarlar/setting.php';
if (!isset($_POST['Deyer'])) {
	header("Location:login.php");
	exit;
}else{
	$Istehsalt_Teqvimi_ID=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM istehsalt_teqvimi where Istehsalt_Teqvimi_ID=:Istehsalt_Teqvimi_ID");
	$Sor->execute(array(
		'Istehsalt_Teqvimi_ID'=>$Istehsalt_Teqvimi_ID));
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$Tarix_Adi=$Cek['Tarix_Adi'];
		$Sebeb=$Cek['Sebeb'];
		$sil = $db->prepare("DELETE from istehsalt_teqvimi where Istehsalt_Teqvimi_ID=:Istehsalt_Teqvimi_ID");
		$kontrol = $sil->execute(array(
			'Istehsalt_Teqvimi_ID' => $Istehsalt_Teqvimi_ID
		));
		if ($kontrol) {
			$Elave_Et=$db->prepare("INSERT INTO istehsalt_teqvimi_islemleri SET                               
				Istehsalt_Teqvimi_ID=:Istehsalt_Teqvimi_ID,
				TarixSaat=:TarixSaat,
				Tarix_Adi=:Tarix_Adi,
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
				'Sebeb'=>$Sebeb,
				'Islem_Sebebi'=>3,
				'IPAdresi'=>$IPAdresi,
				'Admin_Id'=>$Admin_Id,
				'Admin_Ad'=>$Admin_Ad,
				'Admin_Soyad'=>$Admin_Soyad,
				'Admin_Ataadi'=>$Admin_Ataadi
			));
			if ($Insert) {
				?>
				<input type="hidden" id="silcavab">
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
				?>
				<input type="hidden" id="SilugurInsertxeta">
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
		}	else{
		}
	}else{
		echo "error_4000";
		exit;
	}
}
?>