<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {	
	$Ezamiyye_Emri_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Ezam_sor=$db->prepare("SELECT * FROM  ezamiyye_emri where Ezamiyye_Emri_Id=:Ezamiyye_Emri_Id");
	$Ezam_sor->execute(array(
		'Ezamiyye_Emri_Id'=>$Ezamiyye_Emri_Id));
	$Ezam_Say=$Ezam_sor->rowCount();

	if ($Ezam_Say==1) {
		$Ezamiyye_Cek=$Ezam_sor->fetch(PDO::FETCH_ASSOC);
		$Ezam_Olundugu_Yer=$Ezamiyye_Cek['Ezam_Olundugu_Yer'];			
		$Ezam_Sebebi=$Ezamiyye_Cek['Ezam_Sebebi'];			
		$Ezam_Baslangic_Tarixi_Unix=$Ezamiyye_Cek['Ezam_Baslangic_Tarixi_Unix'];			
		$Ezam_Baslangic_Tarixi=$Ezamiyye_Cek['Ezam_Baslangic_Tarixi'];			
		$Ezam_Bitis_Tarixi_Unix=$Ezamiyye_Cek['Ezam_Bitis_Tarixi_Unix'];			
		$Ezam_Bitis_Tarixi=$Ezamiyye_Cek['Ezam_Bitis_Tarixi'];			
		$Ezam_Emri_No=$Ezamiyye_Cek['Ezam_Emri_No'];			
		$ID=$Ezamiyye_Cek['ID'];	
		$Ezam_Gun_Sayi=$Ezamiyye_Cek['Ezam_Gun_Sayi'];	
		$sil = $db->prepare("DELETE from ezamiyye_emri where Ezamiyye_Emri_Id=:Ezamiyye_Emri_Id");
		$kontrol = $sil->execute(array(
			'Ezamiyye_Emri_Id' => $Ezamiyye_Emri_Id
		));
		if ($kontrol) {			
			$Elave_Et=$db->prepare("INSERT INTO  ezamiyye_emri_islemleri SET                               
				Ezamiyye_Emri_Id=:Ezamiyye_Emri_Id,		
				Ezam_Olundugu_Yer=:Ezam_Olundugu_Yer,		
				Ezam_Sebebi=:Ezam_Sebebi,		
				Ezam_Baslangic_Tarixi_Unix=:Ezam_Baslangic_Tarixi_Unix,		
				Ezam_Baslangic_Tarixi=:Ezam_Baslangic_Tarixi,		
				Ezam_Bitis_Tarixi_Unix=:Ezam_Bitis_Tarixi_Unix,		
				Ezam_Bitis_Tarixi=:Ezam_Bitis_Tarixi,		
				Ezam_Emri_No=:Ezam_Emri_No,		
				ID=:ID,		
				Ezam_Gun_Sayi=:Ezam_Gun_Sayi,		
				Admin_Id=:Admin_Id,		
				IPAdresi=:IPAdresi,		
				Ezam_Emri_Islem_Sebebi=:Ezam_Emri_Islem_Sebebi,		
				Ezam_Emri_Durum=:Ezam_Emri_Durum	
				");
			$Insert=$Elave_Et->execute(array(                                
				'Ezamiyye_Emri_Id'=>$Ezamiyye_Emri_Id,			
				'Ezam_Olundugu_Yer'=>$Ezam_Olundugu_Yer,			
				'Ezam_Sebebi'=>$Ezam_Sebebi,			
				'Ezam_Baslangic_Tarixi_Unix'=>$Ezam_Baslangic_Tarixi_Unix,			
				'Ezam_Baslangic_Tarixi'=>$Ezam_Baslangic_Tarixi,			
				'Ezam_Bitis_Tarixi_Unix'=>$Ezam_Bitis_Tarixi_Unix,			
				'Ezam_Bitis_Tarixi'=>$Ezam_Bitis_Tarixi,			
				'Ezam_Emri_No'=>$Ezam_Emri_No,			
				'ID'=>$ID,			
				'Ezam_Gun_Sayi'=>$Ezam_Gun_Sayi,			
				'Admin_Id'=>$Admin_Id,			
				'IPAdresi'=>$IPAdresi,			
				'Ezam_Emri_Islem_Sebebi'=>3,			
				'Ezam_Emri_Durum'=>1		
			));
			if ($Insert) {
				$Ezamiyye_Sor=$db->prepare("SELECT * FROM  ezamiyye_emri where ID=:ID and Ezam_Emri_Durum=:Ezam_Emri_Durum order by Ezam_Baslangic_Tarixi_Unix ASC");
				$Ezamiyye_Sor->execute(array(
					'ID'=>$ID,
					'Ezam_Emri_Durum'=>1));
					?>
					<table class="ListelemeAlaniIciTablosu caption-top">
						<caption><b>Ezamiyyələr </b>	<button class="YenileButonlari sag" onclick="YeniEzamiyye()" type="button">Yeni</button></caption>
						<thead>
							<tr>
								<th class="textaligncenter">№</th>
								<th>Ezam olunduğu yer</th>
								<th>Səbəb və qeydlər</th>
								<th>Başlanğıc tarixi</th>
								<th>Bitiş tarixi</th>
								<th>Gün</th>
								<th>Əmrin №</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$EzamiyyeSira=0;
							while($Ezamiyye_Cek=$Ezamiyye_Sor->fetch(PDO::FETCH_ASSOC)) {
								$EzamiyyeSira++;?>
								<tr>
									<td  class="textaligncenter"><?php echo $EzamiyyeSira;?></td>
									<td><?php echo $Ezamiyye_Cek['Ezam_Olundugu_Yer'] ?></td>
									<td><?php echo $Ezamiyye_Cek['Ezam_Sebebi'] ?></td>
									<td><?php echo $Ezamiyye_Cek['Ezam_Baslangic_Tarixi'] ?></td>										
									<td><?php echo $Ezamiyye_Cek['Ezam_Bitis_Tarixi'] ?></td>										
									<td class="textaligncenter"><?php echo $Ezamiyye_Cek['Ezam_Gun_Sayi'] ?></td>										
									<td><?php echo $Ezamiyye_Cek['Ezam_Emri_No'] ?></td>										
									<td class="emeliyyatlar_iki_buttom">
										<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Ezamiyye_Cek['Ezamiyye_Emri_Id'] ?>" onclick="EzamiyyeDuzenle(this.id)" type="button">
											<i class="fas fa-edit"></i>
										</button>		
										<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Ezamiyye_Cek['Ezamiyye_Emri_Id'] ?>" onclick="EzamiyyeSil(this.id)" type="button">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php 	}else{
					echo "error_2001";/* Adı boş ola bilməz*/
					exit;
				}
			}else{
				echo "error_2001";/* Adı boş ola bilməz*/
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
?>