<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Attestasiya_Idare_Adi=EditorluIcerikleriFiltrle($deyer['Attestasiya_Idare_Adi']);
	$Attestasiya_Sobe_Adi=EditorluIcerikleriFiltrle($deyer['Attestasiya_Sobe_Adi']);
	$Attestasiya_Vezife_Adi=EditorluIcerikleriFiltrle($deyer['Attestasiya_Vezife_Adi']);
	$Attestasiya_Emr_No=EditorluIcerikleriFiltrle($deyer['Attestasiya_Emr_No']);
	$ID=ReqemlerXaricButunKarakterleriSil($deyer['ID']);

	$Attestasiya_Qerar=ReqemlerXaricButunKarakterleriSil($deyer['Attestasiya_Qerar']);
	$Attestasiya_Tarix_Unix=strtotime($deyer['Attestasiya_Tarix']);
	$Attestasiya_Tarix=date("d.m.Y", $Attestasiya_Tarix_Unix);
	$Zaman      = date_create($deyer['Attestasiya_Tarix']);
	date_modify($Zaman, "+5 year");
	$Attestasiya_Tarix_Novbeti_Unix = date_timestamp_get($Zaman);
	$Attestasiya_Tarix_Novbeti   =date("d.m.Y", $Attestasiya_Tarix_Novbeti_Unix);
	$User_sor=$db->prepare("SELECT * FROM  user where ID=:ID and Durum=:Durum");
	$User_sor->execute(array(
		'ID'=>$ID,
		'Durum'=>0));
	$User_Say=$User_sor->rowCount();
	if ($Attestasiya_Idare_Adi!="" and $Attestasiya_Sobe_Adi!="" and $Attestasiya_Vezife_Adi!="" and $Attestasiya_Emr_No!="" and $Attestasiya_Qerar!="" and $Attestasiya_Tarix_Unix!="" and $Attestasiya_Tarix!="" and $User_Say==1 and $Attestasiya_Tarix_Novbeti_Unix!="" and $Attestasiya_Tarix_Novbeti!="") {
		$Elave_Et=$db->prepare("INSERT INTO  attestasiya_emri SET                               
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
		if ($Insert) {	
			$Attestasiya_Id=$db->lastInsertId();		
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
				'Attestasiya_Emr_Islem_Sebebi'=>5,
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