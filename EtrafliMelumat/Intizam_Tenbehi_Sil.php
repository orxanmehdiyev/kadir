<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Intizam_Tenbehi_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Intizam_Sor=$db->prepare("SELECT * FROM  intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
	$Intizam_Sor->execute(array(
		'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id));
	$Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC);
	$sil = $db->prepare("DELETE from  intizam_tenbehi where Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id");
	$kontrol = $sil->execute(array(
		'Intizam_Tenbehi_Id' => $Intizam_Tenbehi_Id
	));
	if ($kontrol) {
		$Elave_Et=$db->prepare("INSERT INTO  intizam_tenbehi_islemleri SET                               
			Intizam_Tenbehi_Id=:Intizam_Tenbehi_Id,
			Intizam_Tenbehi_User_Id=:Intizam_Tenbehi_User_Id,
			Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,
			Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad=:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad,
			Intizam_Tenbehi_Sebeb=:Intizam_Tenbehi_Sebeb,
			Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,
			Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix,
			Intizam_Tenbehinin_Bitis_Tarixi=:Intizam_Tenbehinin_Bitis_Tarixi,
			Intizam_Tenbehinin_Bitis_Tarix_Unix=:Intizam_Tenbehinin_Bitis_Tarix_Unix,
			Intizam_Tenbehi_Tesdiq_Durumu=:Intizam_Tenbehi_Tesdiq_Durumu,
			Intizam_Tenbehi_Emrinin_Nomresi=:Intizam_Tenbehi_Emrinin_Nomresi,
			Intizam_tenbehi_Islemleri_Zaman_Damgasi=:Intizam_tenbehi_Islemleri_Zaman_Damgasi,
			Intizam_Tenbehi_Islemleri_IP=:Intizam_Tenbehi_Islemleri_IP,
			Intizam_Tenbehi_Islemleri_Sebeb=:Intizam_Tenbehi_Islemleri_Sebeb,
			Admin_Id=:Admin_Id
			");
		$Insert=$Elave_Et->execute(array(                                
			'Intizam_Tenbehi_Id'=>$Intizam_Tenbehi_Id,
			'Intizam_Tenbehi_User_Id'=>$Intizam_Cek['Intizam_Tenbehi_User_Id'],
			'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>$Intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'],
			'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'=>$Intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'],
			'Intizam_Tenbehi_Sebeb'=>$Intizam_Cek['Intizam_Tenbehi_Sebeb'],
			'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'],
			'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix'=>$Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix'],
			'Intizam_Tenbehinin_Bitis_Tarixi'=>$Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'],
			'Intizam_Tenbehinin_Bitis_Tarix_Unix'=>$Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarix_Unix'],
			'Intizam_Tenbehi_Tesdiq_Durumu'=>1,
			'Intizam_Tenbehi_Emrinin_Nomresi'=>$Intizam_Cek['Intizam_Tenbehi_Emrinin_Nomresi'],
			'Intizam_tenbehi_Islemleri_Zaman_Damgasi'=>$TarixSaat,
			'Intizam_Tenbehi_Islemleri_IP'=>$IPAdresi,
			'Intizam_Tenbehi_Islemleri_Sebeb'=>2,
			'Admin_Id'=>$Admin_Id,
		));
		if ($Insert) {?>

			<?php 
			$Intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where Intizam_Tenbehi_User_Id=:Intizam_Tenbehi_User_Id and Intizam_Tenbehi_Tesdiq_Durumu=:Intizam_Tenbehi_Tesdiq_Durumu order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix ASC");
			$Intizam_Sor->execute(array(
				'Intizam_Tenbehi_User_Id'=>$Intizam_Cek['Intizam_Tenbehi_User_Id'],
				'Intizam_Tenbehi_Tesdiq_Durumu'=>1));
				?>
				<table class="ListelemeAlaniIciTablosu caption-top">
					<caption><b>Tədbiq olunmuş intizam tədbirləri </b>	<button class="YenileButonlari sag" onclick="YeniIntizamTenbehi()" type="button">Yeni</button></caption>
					<thead>
						<tr>
							<th class="textaligncenter">№</th>
							<th>İntizam tənbehlərinin növü</th>
							<th>Səbəb və qeydlər</th>
							<th>Başlanğıc tarixi</th>
							<th>Bitiş tarixi</th>
							<th>Əmrin №</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$IntizamTenbehiSira=0;
						while($Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC)) {
							$IntizamTenbehiSira++;?>
							<tr>
								<td  class="textaligncenter"><?php echo $IntizamTenbehiSira;?></td>
								<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
								<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Sebeb'] ?></td>
								<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'] ?></td>										
								<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'] ?></td>										
								<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>										
								<td class="emeliyyatlar_iki_buttom">
									<button class="YenileButonlari" id="IntizamTedbiriDuzenle_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriDuzenle(this.id)" type="button">
										<i class="fas fa-edit"></i>
									</button>		
									<button class="YenileButonlari" id="IntizamTedbiriSil_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriSil(this.id)" type="button">
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			<?php }else{
				?>

				<?php 
				$Intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where Intizam_Tenbehi_User_Id=:Intizam_Tenbehi_User_Id and Intizam_Tenbehi_Tesdiq_Durumu=:Intizam_Tenbehi_Tesdiq_Durumu order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix_Unix ASC");
				$Intizam_Sor->execute(array(
					'Intizam_Tenbehi_User_Id'=>$Intizam_Tenbehi_User_Id,
					'Intizam_Tenbehi_Tesdiq_Durumu'=>1));
					?>
					<table class="ListelemeAlaniIciTablosu caption-top">
						<caption><b>Tədbiq olunmuş intizam tədbirləri </b>	<button class="YenileButonlari sag" onclick="YeniIntizamTenbehi()" type="button">Yeni</button></caption>
						<thead>
							<tr>
								<th class="textaligncenter">№</th>
								<th>İntizam tənbehlərinin növü</th>
								<th>Səbəb və qeydlər</th>
								<th>Başlanğıc tarixi</th>
								<th>Bitiş tarixi</th>
								<th>Əmrin №</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$IntizamTenbehiSira=0;
							while($Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC)) {
								$IntizamTenbehiSira++;?>
								<tr>
									<td  class="textaligncenter"><?php echo $IntizamTenbehiSira;?></td>
									<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Ad'] ?></td>
									<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Sebeb'] ?></td>
									<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'] ?></td>										
									<td><?php echo $Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'] ?></td>										
									<td><?php echo $Intizam_Cek['Intizam_Tenbehi_Emrinin_Nomresi'] ?></td>										
									<td class="emeliyyatlar_iki_buttom">
										<button class="YenileButonlari" id="IntizamTedbiriDuzenle_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriDuzenle(this.id)" type="button">
											<i class="fas fa-edit"></i>
										</button>		
										<button class="YenileButonlari" id="IntizamTedbiriSil_<?php echo $Intizam_Cek['Intizam_Tenbehi_Id'] ?>" onclick="IntizamTedbiriSil(this.id)" type="button">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>

					<?php 
				}
			}else{
				echo "error_2006";/* kissa Adı boş ola bilməz*/
				exit;
			}		


		}else{
			header("Location:../intizam_tebehi_adlari");
			exit;
		}
	?>