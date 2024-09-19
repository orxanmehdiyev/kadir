<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Attestasiya_Id=EditorluIcerikleriFiltrle($_POST['Deyer']);
	$Attestasiya_Sor=$db->prepare("SELECT * FROM  attestasiya_emri where Attestasiya_Id=:Attestasiya_Id");
	$Attestasiya_Sor->execute(array(
		'Attestasiya_Id'=>$Attestasiya_Id));
	$Attestasiya_Say=$Attestasiya_Sor->rowCount();

	if ($Attestasiya_Say==1 ) {
		$Attestasiya_Cek=$Attestasiya_Sor->fetch(PDO::FETCH_ASSOC);
		$ID=$Attestasiya_Cek['ID'];
		$Attestasiya_Idare_Adi=$Attestasiya_Cek['Attestasiya_Idare_Adi'];
		$Attestasiya_Sobe_Adi=$Attestasiya_Cek['Attestasiya_Sobe_Adi'];
		$Attestasiya_Vezife_Adi=$Attestasiya_Cek['Attestasiya_Vezife_Adi'];
		$Attestasiya_Tarix=$Attestasiya_Cek['Attestasiya_Tarix'];
		$Attestasiya_Tarix_Unix=$Attestasiya_Cek['Attestasiya_Tarix_Unix'];
		$Attestasiya_Qerar=$Attestasiya_Cek['Attestasiya_Qerar'];
		$Attestasiya_Tarix_Novbeti=$Attestasiya_Cek['Attestasiya_Tarix_Novbeti'];
		$Attestasiya_Tarix_Novbeti_Unix=$Attestasiya_Cek['Attestasiya_Tarix_Novbeti_Unix'];
		$Attestasiya_Emr_No=$Attestasiya_Cek['Attestasiya_Emr_No'];
		$Attestasiya_Durum=$Attestasiya_Cek['Attestasiya_Durum'];
		$sil = $db->prepare("DELETE from attestasiya_emri where Attestasiya_Id=:Attestasiya_Id");
		$kontrol = $sil->execute(array(
			'Attestasiya_Id' => $Attestasiya_Id
		));
		if ($kontrol) {						
			$Elave_Et=$db->prepare("INSERT INTO  attestasiya_emri_islemleri SET                               
				Attestasiya_Emr_Islem_Sebebi=:Attestasiya_Emr_Islem_Sebebi,
				IPAdresi=:IPAdresi,
				TarixSaat=:TarixSaat,
				ZamanDamgasi=:ZamanDamgasi,
				Admin_Id=:Admin_Id,
				Attestasiya_Id=:Attestasiya_Id,
				ID=:ID,
				Attestasiya_Idare_Adi=:Attestasiya_Idare_Adi,
				Attestasiya_Sobe_Adi=:Attestasiya_Sobe_Adi,
				Attestasiya_Vezife_Adi=:Attestasiya_Vezife_Adi,
				Attestasiya_Tarix=:Attestasiya_Tarix,
				Attestasiya_Tarix_Unix=:Attestasiya_Tarix_Unix,
				Attestasiya_Qerar=:Attestasiya_Qerar,
				Attestasiya_Tarix_Novbeti=:Attestasiya_Tarix_Novbeti,
				Attestasiya_Tarix_Novbeti_Unix=:Attestasiya_Tarix_Novbeti_Unix,
				Attestasiya_Durum=:Attestasiya_Durum,
				Attestasiya_Emr_No=:Attestasiya_Emr_No
				");
			$Insert=$Elave_Et->execute(array(                                
				'Attestasiya_Emr_Islem_Sebebi'=>2,
				'IPAdresi'=>$IPAdresi,
				'TarixSaat'=>$TarixSaat,
				'ZamanDamgasi'=>$ZamanDamgasi,
				'Admin_Id'=>$Admin_Id,
				'Attestasiya_Id'=>$Attestasiya_Id,
				'ID'=>$ID,
				'Attestasiya_Idare_Adi'=>$Attestasiya_Idare_Adi,
				'Attestasiya_Sobe_Adi'=>$Attestasiya_Sobe_Adi,
				'Attestasiya_Vezife_Adi'=>$Attestasiya_Vezife_Adi,
				'Attestasiya_Tarix'=>$Attestasiya_Tarix,
				'Attestasiya_Tarix_Unix'=>$Attestasiya_Tarix_Unix,
				'Attestasiya_Qerar'=>$Attestasiya_Qerar,
				'Attestasiya_Tarix_Novbeti'=>$Attestasiya_Tarix_Novbeti,
				'Attestasiya_Tarix_Novbeti_Unix'=>$Attestasiya_Tarix_Novbeti_Unix,
				'Attestasiya_Durum'=>1,
				'Attestasiya_Emr_No'=>$Attestasiya_Emr_No
			));
			if ($Insert) {?>
				
				<?php 
				$Attestasiya_Sor=$db->prepare("SELECT * FROM  attestasiya_emri where ID=:ID and Attestasiya_Durum=:Attestasiya_Durum order by Attestasiya_Tarix_Unix ASC");
				$Attestasiya_Sor->execute(array(
					'ID'=>$ID,
					'Attestasiya_Durum'=>1));
					?>
					<table class="ListelemeAlaniIciTablosu caption-top">
						<caption><b>Attestasiyaları </b>	<button class="YenileButonlari sag" onclick="YeniAttestasiya()" type="button">Yeni</button></caption>
						<thead>
							<tr>
								<th class="textaligncenter">№</th>
								<th>İdarə Adı</th>
								<th>Şöbə</th>
								<th>Vəzifə</th>
								<th>Son Tarix</th>													
								<th>Növbəti Tarix</th>													
								<th>Əmrin №</th>
								<th>Qərar</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$AttestasiyaSira=0;
							while($Attestasiya_Cek=$Attestasiya_Sor->fetch(PDO::FETCH_ASSOC)) {
								$AttestasiyaSira++;?>
								<tr>
									<td  class="textaligncenter"><?php echo $AttestasiyaSira;?></td>
									<td><?php echo $Attestasiya_Cek['Attestasiya_Idare_Adi'] ?></td>
									<td><?php echo $Attestasiya_Cek['Attestasiya_Sobe_Adi'] ?></td>
									<td><?php echo $Attestasiya_Cek['Attestasiya_Vezife_Adi'] ?></td>										
									<td><?php echo $Attestasiya_Cek['Attestasiya_Tarix'] ?></td>
									<td><?php echo $Attestasiya_Cek['Attestasiya_Tarix_Novbeti'] ?></td>
									<td><?php echo $Attestasiya_Cek['Attestasiya_Emr_No'] ?></td>										
									<td><?php echo $Attestasiya_Cek['Attestasiya_Qerar']==1?"Uyğundur":"Uyğun deyil" ?></td>										
									<td class="emeliyyatlar_iki_buttom">
										<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Attestasiya_Cek['Attestasiya_Id'] ?>" onclick="AttestasiyaDuzenle(this.id)" type="button">
											<i class="fas fa-edit"></i>
										</button>		
										<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Attestasiya_Cek['Attestasiya_Id'] ?>" onclick="AttestasiyaSil(this.id)" type="button">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>

				<?php	}else{
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