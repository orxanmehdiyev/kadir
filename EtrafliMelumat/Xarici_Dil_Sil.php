<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Xarici_Dil_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Xarici_Dil=$db->prepare("SELECT * FROM  xarici_dil where Xarici_Dil_Id=:Xarici_Dil_Id ");
	$Xarici_Dil->execute(array(
		'Xarici_Dil_Id'=>$Xarici_Dil_Id));
	$Xarici_Cek=$Xarici_Dil->fetch(PDO::FETCH_ASSOC);
	$Xarici_Dil_Ad=$Xarici_Cek['Xarici_Dil_Ad'];
	$Xarici_Dil_Sevye=$Xarici_Cek['Xarici_Dil_Sevye'];
	$ID=$Xarici_Cek['ID'];
	$User_sor=$db->prepare("SELECT * FROM  user where ID=:ID and Durum=:Durum");
	$User_sor->execute(array(
		'ID'=>$ID,
		'Durum'=>0));
	$User_Say=$User_sor->rowCount();
	if ($Xarici_Dil_Ad!="" and $Xarici_Dil_Sevye!="" and $User_Say==1) {
		$sil = $db->prepare("DELETE from xarici_dil where Xarici_Dil_Id=:Xarici_Dil_Id");
		$kontrol = $sil->execute(array(
			'Xarici_Dil_Id' => $Xarici_Dil_Id
		));

		if ($kontrol) {				
			$Elave_Et=$db->prepare("INSERT INTO xarici_dil_islemleri SET                               
				Xarici_Dil_Id=:Xarici_Dil_Id,
				Xarici_Dil_Islemleri_Islem_Sebebi=:Xarici_Dil_Islemleri_Islem_Sebebi,
				Admin_Id=:Admin_Id,
				ZamanDamgasi=:ZamanDamgasi,
				TarixSaat=:TarixSaat,
				IPAdresi=:IPAdresi,
				ID=:ID,
				Xarici_Dil_Ad=:Xarici_Dil_Ad,
				Xarici_Dil_Sevye=:Xarici_Dil_Sevye
				");
			$Insert=$Elave_Et->execute(array(                                
				'Xarici_Dil_Id'=>$Xarici_Dil_Id,
				'Xarici_Dil_Islemleri_Islem_Sebebi'=>3,
				'Admin_Id'=>$Admin_Id,
				'ZamanDamgasi'=>$ZamanDamgasi,
				'TarixSaat'=>$TarixSaat,
				'IPAdresi'=>$IPAdresi,
				'ID'=>$ID,
				'Xarici_Dil_Ad'=>$Xarici_Dil_Ad,
				'Xarici_Dil_Sevye'=>$Xarici_Dil_Sevye
			));
			if ($Insert) {?>				
				<?php 
				$Xarici_Dil_Sor=$db->prepare("SELECT * FROM  xarici_dil where ID=:ID order by Xarici_Dil_Ad ASC");
				$Xarici_Dil_Sor->execute(array(
					'ID'=>$ID));
					?>
					<table class="ListelemeAlaniIciTablosu caption-top">
						<caption><b>Bildiyi xarici dillər </b>	<button class="YenileButonlari sag" onclick="YeniXariciDil()" type="button">Yeni</button></caption>
						<thead>
							<tr>
								<th class="textaligncenter">№</th>
								<th>Adı</th>
								<th>Bilik səvyyəsi</th>															
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$XariciDilSira=0;
							while($Xarici_Dil_Cek=$Xarici_Dil_Sor->fetch(PDO::FETCH_ASSOC)) {
								$XariciDilSira++;
								if ($Xarici_Dil_Cek['Xarici_Dil_Sevye']==1) {
									$Xarici_Dil_Sevye="Kafi";
								}
								else if ($Xarici_Dil_Cek['Xarici_Dil_Sevye']==2) {
									$Xarici_Dil_Sevye="Yaxşı";
								}
								else if ($Xarici_Dil_Cek['Xarici_Dil_Sevye']==3) {
									$Xarici_Dil_Sevye="Əla";
								}else{
									$Xarici_Dil_Sevye="";
								}

								?>
								<tr>
									<td  class="textaligncenter"><?php echo $XariciDilSira;?></td>
									<td><?php echo $Xarici_Dil_Cek['Xarici_Dil_Ad'] ?></td>
									<td><?php echo $Xarici_Dil_Sevye ?></td>																									
									<td class="emeliyyatlar_iki_buttom">
										<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Xarici_Dil_Cek['Xarici_Dil_Id'] ?>" onclick="XariciDilDuzenle(this.id)" type="button">
											<i class="fas fa-edit"></i>
										</button>		
										<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Xarici_Dil_Cek['Xarici_Dil_Id'] ?>" onclick="XariciDilSil(this.id)" type="button">
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