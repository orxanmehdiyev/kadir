<?php 
require_once '../Ayarlar/setting.php';
if ($IdarelerSil==1) {
if (isset($_POST['Deyer'])) {
	$Idare_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
	$Sor->execute(array(
		'Idare_Id'=>$Idare_Id));
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$Idare_Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$Ust_Id=$Idare_Cek['Ust_Id'];
		$Ust_Ad=$Idare_Cek['Ust_Ad'];
		$Sira_No=$Idare_Cek['Sira_No'];
		$Idare_Adi=$Idare_Cek['Idare_Adi'];
		$Idare_Kissa_Adi=$Idare_Cek['Idare_Kissa_Adi'];
		$Idare_VOEN=$Idare_Cek['Idare_VOEN'];
		$Idare_Seo_Url=$Idare_Cek['Idare_Seo_Url'];
		$Idare_Unvan=$Idare_Cek['Idare_Unvan'];
		$Durum=$Idare_Cek['Durum'];
		$sil = $db->prepare("DELETE from idare where Idare_Id=:Idare_Id");
		$kontrol = $sil->execute(array(
			'Idare_Id' => $Idare_Id
		));
		if ($kontrol) {
			$Elave_Et=$db->prepare("INSERT INTO  idare_islemleri SET
				Idare_Id=:Idare_Id,
				Idare_Adi=:Idare_Adi,						
				Ust_Id=:Ust_Id,						
				Ust_Ad=:Ust_Ad,						
				Idare_Kissa_Adi=:Idare_Kissa_Adi,						
				Sira_No=:Sira_No,
				Idare_VOEN=:Idare_VOEN,
				Idare_Unvan=:Idare_Unvan,
				Idare_Seo_Url=:Idare_Seo_Url,
				Durum=:Durum,
				Idare_Islemleri_Sebebi=:Idare_Islemleri_Sebebi,
				Idare_Islemleri_Ip=:Idare_Islemleri_Ip,
				Admin_Id=:Admin_Id,
				Admin_Ad=:Admin_Ad,
				Admin_Soyad=:Admin_Soyad,
				Admin_Ataadi=:Admin_Ataadi,
				Idare_Islem_Edildiyi_Tarix=:Idare_Islem_Edildiyi_Tarix
				");
			$Insert=$Elave_Et->execute(array(
				'Idare_Id'=>$Idare_Id,
				'Idare_Adi'=>$Idare_Adi,
				'Ust_Id'=>$Ust_Id,
				'Ust_Ad'=>$Ust_Ad,
				'Idare_Kissa_Adi'=>$Idare_Kissa_Adi,
				'Ust_Id'=>$Ust_Id,
				'Ust_Ad'=>$Ust_Ad,
				'Sira_No'=>$Sira_No,
				'Idare_VOEN'=>$Idare_VOEN,
				'Idare_Unvan'=>$Idare_Unvan,
				'Idare_Seo_Url'=>seo($Idare_Adi.$Idare_VOEN),
				'Durum'=>$Durum,
				'Idare_Islemleri_Sebebi'=>3,
				'Idare_Islemleri_Ip'=>$IPAdresi,
				'Admin_Id'=>$Admin_Id,
				'Admin_Ad'=>$Admin_Ad,
				'Admin_Soyad'=>$Admin_Soyad,
				'Admin_Ataadi'=>$Admin_Ataadi,
				'Idare_Islem_Edildiyi_Tarix'=>$TarixSaat
			));
			if ($Insert) {?>
				<input type="hidden" id=silcavab value="silindi" >
				<?php 
				$Idare_Sor=$db->prepare("SELECT * FROM idare order by Sira_No ASC ");
				$Idare_Sor->execute();
				$Idare_Say=$Idare_Sor->rowCount();
				if ($Idare_Say>0) {?>
					<div class="row">
				<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
					<table class="ListelemeAlaniIciTablosu">
						<thead class="">
							<tr>	
								<th>№</th>
								<th>Adı</th>
								<th>Kısa Adı</th>
								<th>VÖEN</th>
								<th>Sira No</th>								
								<th>Ünvanı</th>	
								<th>Yaradıldığı Tarix</th>
								<th colspan="4">Əməliyyatlar</th>			
							</tr>
						</thead>
						<tbody>
							<?php 
							$Sira_Nomir=0;
							while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Sira_Nomir++;
								?>
								<tr>							
									<td class="textaligncenter"><?php echo $Sira_Nomir ?></td>
									<td><?php echo $Idare_Cek['Idare_Adi'] ?></td>							
									<td><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>							
									<td class="textaligncenter"><?php echo $Idare_Cek['Idare_VOEN'] ?></td>
									<td class="textaligncenter"><?php echo $Idare_Cek['Sira_No'] ?></td>
									<td><?php echo $Idare_Cek['Idare_Unvan'] ?></td>
									<td class="textaligncenter"><?php echo $Idare_Cek['Idarenin_Elave_Edildiyi_TarixSaat'] ?></td> 
									<td class="Vezife_Adlari_Durum_Kapsama">
										<label class="checkbox" title="" >
											<input <?php echo $Idare_Cek['Durum']==1 ? "checked":"";?>									
											type="checkbox" id="DurumId_<?php echo $Idare_Cek['Idare_Id'] ?>" onchange="DurumKontrol(this.id)" > 
											<span class="checkbox"> 
												<span></span>
											</span>
										</label>
									</td>
									<td class="emeliyyatlar_sil_alani">										
										<button class="YenileButonlari" id="DuzelisButton_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="DuzelisYoxlanis(this.id)" type="button">
											<i class="fas fa-edit"></i>
										</button>
									</td> 							
									<td class="emeliyyatlar_sil_alani">										
										<button class="YenileButonlari" id="SilButton_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="SilYoxlanis(this.id)" type="button">
										<i class="fas fa-trash"></i>
									</button>
									</td> 
									<td class="emeliyyatlar_sil_alani">										
										<button class="YenileButonlari" id="Bax_<?php echo $Idare_Cek['Idare_Id'] ?>" onclick="DeyisiklereBax(this.id)" type="button">
											<i class="fas fa-eye"></i>
										</button>
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
							Bazada İdarə Mövcut Deyil
						</div>
					</div> 
					<?php 	
				}	
			}
			else{
				echo "error_1002";/*Silinme ugursuz*/
			}
		}else{
			echo "error_1001";/*Silinme ugursuz*/
		}
	}else{
		echo "error_1000";/*Bazada movcut deyil*/
	}	
}else{
	header("Location:../login.php");
	exit;
}
}
?>