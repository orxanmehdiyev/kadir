<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Tedbiq_Edildiyi_Tarix      =  date("Y-m-d", strtotime($deyer['Tedbiq_Edildiyi_Tarix'])); 	
	$TequtNovu                  =  ReqemlerXaricButunKarakterleriSil($deyer['TequtNovu']);
	if ($TequtNovu==1) {	?>	
		<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
			<thead class="sabit">							
				<tr class="textaligncenter" >
					<th rowspan="2" style="width:50px;">ID</th>
					<th rowspan="2">Şəkli</th>
					<th rowspan="2">Soyadı</th>
					<th rowspan="2">Adı</th>
					<th rowspan="2">Atasının<br/> adı</th>
					<th rowspan="2">İdarə</th>
					<th rowspan="2">Struktur bölməsi</th>
					<th rowspan="2">Vəzifəsi</th>
					<th rowspan="2">Xüsusi rütbəsi</th>
					<th rowspan="2" class="tarixsutunu">Xidmətə qəbul tarixi</th>
					<th rowspan="2" class="tarixsutunu">Doğum tarixi</th>
					<th rowspan="2">Yaşı</th>
					<th colspan="3">Xidmet müddəti</th>								
				</tr>	
				<tr class="textaligncenter" >
					<th>İl</th>
					<th>Ay</th>
					<th>Gün</th>
				</tr>						
			</thead>
			<tbody>
				<?php 
				if ($UmumiBaxisButunIdareler==1) {
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC");
					$Idare_Sor->execute(array(
						'Durum'=>1));
				}else{
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id and  Durum=:Durum order by Sira_No ASC");
					$Idare_Sor->execute(array(
						'Idare_Id'=>$Islediyi_Idare_Id,
						'Durum'=>1));
				}

				while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
					$Idare_Id= $Idare_Cek['Idare_Id'];
					$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
					$Sobe_Sor->execute(array(
						'Idare_Id'=>$Idare_Id,
						'Durum'=>1));								
					while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {	
						$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and User_Id>:User_Id and Zabit_Mulu=:Zabit_Mulu   order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
						$Vezife_Sor->execute(array(
							'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
							'Vezife_Adlari_Durum'=>1,
							'User_Id'=>0,
							'Zabit_Mulu'=>0
						));									
						while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
							if ($Vezife_Cek['User_Id']>0) {
								$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
								$Sor->execute(array(
									'ID'=>$Vezife_Cek['User_Id']));
								$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
								$Ad=$Cek['Adi'];
								$Soy_Adi=$Cek['Soy_Adi'];
								$Ata_Adi=$Cek['Ata_Adi'];
								$Ise_Qebul_Tarixi      =  Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Qebul_Tarixi']);	
								$Ise_Qebul_Tarixi_beynelxalq      =  $Cek['Ise_Qebul_Tarixi'];

								$Dogum_Tarixi=Tarix_Beynelxalqi_Az_Cevir($Cek['Dogum_Tarixi']);
								$Dogum_Tarixi_beynelxalq=$Cek['Dogum_Tarixi'];
								$bugun = $Tedbiq_Edildiyi_Tarix;
								$diff = date_diff(date_create($Cek['Dogum_Tarixi']), date_create($bugun));
								$yasin=$diff->format('%y');	
								$XidmetIliFerqi=date_diff(date_create($Cek['Ise_Qebul_Tarixi']), date_create($bugun));
								$XidmetIli=$XidmetIliFerqi->format('%y');
								$XidmetAy=$XidmetIliFerqi->format('%m');
								$XidmetGun=$XidmetIliFerqi->format('%d');

								$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
								$Rutbe_Emri_Sor->execute(array(
									'ID'=>$Cek['ID']));
								$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
								if (strlen($Rutbe_Emri_Cek['Rutbe_Img'])>0) {
									$RutbeSekli='<img src="'.$Rutbe_Emri_Cek['Rutbe_Img'].'" class=" mx-auto d-block" style="width:96px;height: 100px;" alt="...">';
								}else{	
									$RutbeSekli='<img src="Senedler/Rutbe/nophoto.png" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
								}
								$Rutbe_Adi=$Rutbe_Emri_Cek['Rutbe_Adi'];
							}	else{										
								$Rutbe_Adi="";
								$RutbeSekli='';											
							}	
							if ($XidmetIli>=20)  {	
								if ($Vezife_Cek['Vezife_Adlari_Id']==1 or $Vezife_Cek['Vezife_Adlari_Id']==2 ) {
								}else{

									?>
									<tr class="vertikalmidle">
										<td class="textaligncenter"><?php echo sprintf("%03d", SexsiIsNomresi($Vezife_Cek['User_Id'],$db)) ;?></td>						
										<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
										<td><?php echo $Soy_Adi ?></td>
										<td><?php echo $Ad ?></td>
										<td><?php echo $Ata_Adi ?></td>
										<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
										<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
										<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
										<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
										<td data-sort="<?php echo $Ise_Qebul_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Ise_Qebul_Tarixi ?></td>											
										<td  data-sort="<?php echo $Dogum_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Dogum_Tarixi ?></td>
										<td class="textaligncenter"><?php echo $yasin ?></td>										
										<td class="textaligncenter"><?php echo $XidmetIli ?></td>										
										<td class="textaligncenter"><?php echo $XidmetAy ?></td>										
										<td class="textaligncenter"><?php echo $XidmetGun ?></td>										
									</tr>
									<?php

								}
							}
						}
					} 
				}?>
			</tbody>
		</table>


		<?php
	}else{?>

		<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
			<thead class="sabit">							
				<tr class="textaligncenter" >
					<th rowspan="2" style="width:50px;">ID</th>
					<th rowspan="2">Şəkli</th>
					<th rowspan="2">Soyadı</th>
					<th rowspan="2">Adı</th>
					<th rowspan="2">Atasının<br/> adı</th>
					<th rowspan="2">İdarə</th>
					<th rowspan="2">Struktur bölməsi</th>
					<th rowspan="2">Vəzifəsi</th>
					<th rowspan="2">Xüsusi rütbəsi</th>
					<th rowspan="2" class="tarixsutunu">Xidmətə qəbul tarixi</th>
					<th rowspan="2" class="tarixsutunu">Doğum tarixi</th>
					<th rowspan="2">Yaşı</th>
					<th colspan="3">Xidmet müddəti</th>								
				</tr>	
				<tr class="textaligncenter" >
					<th>İl</th>
					<th>Ay</th>
					<th>Gün</th>
				</tr>						
			</thead>
			<tbody>
				<?php 
				if ($UmumiBaxisButunIdareler==1) {
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC");
					$Idare_Sor->execute(array(
						'Durum'=>1));
				}else{
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id and  Durum=:Durum order by Sira_No ASC");
					$Idare_Sor->execute(array(
						'Idare_Id'=>$Islediyi_Idare_Id,
						'Durum'=>1));
				}

				while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
					$Idare_Id= $Idare_Cek['Idare_Id'];
					$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
					$Sobe_Sor->execute(array(
						'Idare_Id'=>$Idare_Id,
						'Durum'=>1));								
					while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {	
						$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and User_Id>:User_Id   order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
						$Vezife_Sor->execute(array(
							'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
							'Vezife_Adlari_Durum'=>1,
							'User_Id'=>0
						));									
						while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
							if ($Vezife_Cek['User_Id']>0) {
								$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
								$Sor->execute(array(
									'ID'=>$Vezife_Cek['User_Id']));
								$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
								$Ad=$Cek['Adi'];
								$Soy_Adi=$Cek['Soy_Adi'];
								$Ata_Adi=$Cek['Ata_Adi'];
								$Ise_Qebul_Tarixi      =  Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Qebul_Tarixi']);	
								$Ise_Qebul_Tarixi_beynelxalq      =  $Cek['Ise_Qebul_Tarixi'];

								$Dogum_Tarixi=Tarix_Beynelxalqi_Az_Cevir($Cek['Dogum_Tarixi']);
								$Dogum_Tarixi_beynelxalq=$Cek['Dogum_Tarixi'];
								$bugun = $Tedbiq_Edildiyi_Tarix;
								$diff = date_diff(date_create($Cek['Dogum_Tarixi']), date_create($bugun));
								$yasin=$diff->format('%y');	
								$XidmetIliFerqi=date_diff(date_create($Cek['Ise_Qebul_Tarixi']), date_create($bugun));
								$XidmetIli=$XidmetIliFerqi->format('%y');
								$XidmetAy=$XidmetIliFerqi->format('%m');
								$XidmetGun=$XidmetIliFerqi->format('%d');

								$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
								$Rutbe_Emri_Sor->execute(array(
									'ID'=>$Cek['ID']));
								$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
								$Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];

								$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id ");
								$Rutbe_Sor->execute(array(
									'Rutbe_Id'=>$Rutbe_Id));
								$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
								$Pensiyya=$Rutbe_Cek['Pensiyya'];

								if (strlen($Rutbe_Emri_Cek['Rutbe_Img'])>0) {
									$RutbeSekli='<img src="'.$Rutbe_Emri_Cek['Rutbe_Img'].'" class=" mx-auto d-block" style="width:96px;height: 100px;" alt="...">';
								}else{	
									$RutbeSekli='<img src="Senedler/Rutbe/nophoto.png" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
								}
								$Rutbe_Adi=$Rutbe_Emri_Cek['Rutbe_Adi'];

							}	else{										
								$Rutbe_Adi="";
								$RutbeSekli='';											
							}	
							if ($Pensiyya==50) {
								if ($yasin>=50) {						
									if ($Vezife_Cek['Vezife_Adlari_Id']==1 or $Vezife_Cek['Vezife_Adlari_Id']==2 ) {
									}else{	?>
										<tr class="vertikalmidle">
											<td class="textaligncenter"><?php echo sprintf("%03d", SexsiIsNomresi($Vezife_Cek['User_Id'],$db)) ;?></td>						
											<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
											<td><?php echo $Soy_Adi ?></td>
											<td><?php echo $Ad ?></td>
											<td><?php echo $Ata_Adi ?></td>
											<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
											<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
											<td data-sort="<?php echo $Ise_Qebul_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Ise_Qebul_Tarixi ?></td>											
											<td  data-sort="<?php echo $Dogum_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Dogum_Tarixi ?></td>
											<td class="textaligncenter"><?php echo $yasin ?></td>										
											<td class="textaligncenter"><?php echo $XidmetIli ?></td>										
											<td class="textaligncenter"><?php echo $XidmetAy ?></td>										
											<td class="textaligncenter"><?php echo $XidmetGun ?></td>										
										</tr>
										<?php
									}	
								}										
							}elseif ($Pensiyya==55) {
								if ($yasin>=55) {						
									if ($Vezife_Cek['Vezife_Adlari_Id']==1 or $Vezife_Cek['Vezife_Adlari_Id']==2 ) {
									}else{	?>
										<tr class="vertikalmidle">
											<td class="textaligncenter"><?php echo sprintf("%03d", SexsiIsNomresi($Vezife_Cek['User_Id'],$db)) ;?></td>						
											<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
											<td><?php echo $Soy_Adi ?></td>
											<td><?php echo $Ad ?></td>
											<td><?php echo $Ata_Adi ?></td>
											<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
											<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
											<td data-sort="<?php echo $Ise_Qebul_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Ise_Qebul_Tarixi ?></td>											
											<td  data-sort="<?php echo $Dogum_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Dogum_Tarixi ?></td>
											<td class="textaligncenter"><?php echo $yasin ?></td>										
											<td class="textaligncenter"><?php echo $XidmetIli ?></td>										
											<td class="textaligncenter"><?php echo $XidmetAy ?></td>										
											<td class="textaligncenter"><?php echo $XidmetGun ?></td>										
										</tr>
										<?php
									}	
								}										
							}elseif ($Pensiyya==60) {											
								if ($yasin>=60) {						
									if ($Vezife_Cek['Vezife_Adlari_Id']==1 or $Vezife_Cek['Vezife_Adlari_Id']==2 ) {
									}else{	?>
										<tr class="vertikalmidle">
											<td class="textaligncenter"><?php echo sprintf("%03d", SexsiIsNomresi($Vezife_Cek['User_Id'],$db)) ;?></td>						
											<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
											<td><?php echo $Soy_Adi ?></td>
											<td><?php echo $Ad ?></td>
											<td><?php echo $Ata_Adi ?></td>
											<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
											<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
											<td data-sort="<?php echo $Ise_Qebul_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Ise_Qebul_Tarixi ?></td>											
											<td  data-sort="<?php echo $Dogum_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Dogum_Tarixi ?></td>
											<td class="textaligncenter"><?php echo $yasin ?></td>										
											<td class="textaligncenter"><?php echo $XidmetIli ?></td>										
											<td class="textaligncenter"><?php echo $XidmetAy ?></td>										
											<td class="textaligncenter"><?php echo $XidmetGun ?></td>										
										</tr>
										<?php
									}	
								}	
							}elseif ($Pensiyya==65) {											
								if ($yasin>=65) {						
									if ($Vezife_Cek['Vezife_Adlari_Id']==1 or $Vezife_Cek['Vezife_Adlari_Id']==2 ) {
									}else{	?>
										<tr class="vertikalmidle">
											<td class="textaligncenter"><?php echo sprintf("%03d", SexsiIsNomresi($Vezife_Cek['User_Id'],$db)) ;?></td>						
											<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
											<td><?php echo $Soy_Adi ?></td>
											<td><?php echo $Ad ?></td>
											<td><?php echo $Ata_Adi ?></td>
											<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
											<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
											<td data-sort="<?php echo $Ise_Qebul_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Ise_Qebul_Tarixi ?></td>											
											<td  data-sort="<?php echo $Dogum_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Dogum_Tarixi ?></td>
											<td class="textaligncenter"><?php echo $yasin ?></td>										
											<td class="textaligncenter"><?php echo $XidmetIli ?></td>										
											<td class="textaligncenter"><?php echo $XidmetAy ?></td>										
											<td class="textaligncenter"><?php echo $XidmetGun ?></td>										
										</tr>
										<?php
									}	
								}	
							}elseif ($yasin>=65) {	
								if ($Vezife_Cek['Vezife_Adlari_Id']==1 or $Vezife_Cek['Vezife_Adlari_Id']==2 ) {
								}else{	?>
									<tr class="vertikalmidle">
										<td class="textaligncenter"><?php echo sprintf("%03d", SexsiIsNomresi($Vezife_Cek['User_Id'],$db)) ;?></td>						
										<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
										<td><?php echo $Soy_Adi ?></td>
										<td><?php echo $Ad ?></td>
										<td><?php echo $Ata_Adi ?></td>
										<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
										<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
										<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
										<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
										<td data-sort="<?php echo $Ise_Qebul_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Ise_Qebul_Tarixi ?></td>											
										<td  data-sort="<?php echo $Dogum_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Dogum_Tarixi ?></td>
										<td class="textaligncenter"><?php echo $yasin ?></td>										
										<td class="textaligncenter"><?php echo $XidmetIli ?></td>										
										<td class="textaligncenter"><?php echo $XidmetAy ?></td>										
										<td class="textaligncenter"><?php echo $XidmetGun ?></td>										
									</tr>
									<?php
								}	
							}
						}
					} 
				}?>
			</tbody>
		</table>

	<?php }

}else{
	header("Location:../index.php");
	exit;
}
?>