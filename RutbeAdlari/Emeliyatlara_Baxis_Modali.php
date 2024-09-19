<?php 
require_once '../Ayarlar/setting.php';
if ($RutbeAdlariBaxis==1) {
if (isset($_POST['Deyer'])) {
	$Rutbe_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM   rutbe_islemleri where  Rutbe_Id=:Rutbe_Id");
	$Sor->execute(array(
		'Rutbe_Id'=>$Rutbe_Id));
		?>
		<div class="row">
			<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
				<table class="ListelemeAlaniIciTablosu">						
					<thead>
						<tr>
							<th>№</th>
							<th>Əməliyyat Səbəbi</th>
							<th>Tarix</th>
							<th>Adı</th>
							<th>Pulu</th>
							<th>X/R Xidmət İli</th>	
							<th>Sıra №</th>								

							<th >Əməliyyat Edən</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
						$Sira_Nomir=0;
						while ($Rutbe_Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
							$Sira_Nomir++;
							if($Rutbe_Cek['Islem_Sebebi']==1){
								$Islem_Sebebi="Yeni yaradıldı";
							}elseif($Rutbe_Cek['Islem_Sebebi']==2){
								$Islem_Sebebi="Düzəliş edildi";
							}elseif($Rutbe_Cek['Islem_Sebebi']==3){
								$Islem_Sebebi="Silindi";
							}elseif($Rutbe_Cek['Islem_Sebebi']==4){
								$Islem_Sebebi="Durum AktivEdildi";
							}elseif($Rutbe_Cek['Islem_Sebebi']==5){
								$Islem_Sebebi="Durum Passiv edildi";
							}else{
								$Islem_Sebebi="";
							}
							?>
							<tr>						
								<td class=" textaligncenter"><?php echo $Sira_Nomir ?></td>
								<td><?php echo $Islem_Sebebi ?></td>
								<td><?php echo $Rutbe_Cek['Rutbe_Adi'] ?></td>
								<td><?php echo $Rutbe_Cek['TarixSaat'] ?></td>
								<td class="textaligncenter"><?php echo number_format($Rutbe_Cek['Rutbe_Pulu'],2) ?></td>
								<td class="textaligncenter"><?php echo $Rutbe_Cek['Rutbe_Xidmet_Ili']>0 ? $Rutbe_Cek['Rutbe_Xidmet_Ili']:"";?></td>
								<td class="textaligncenter"><?php echo $Rutbe_Cek['Rutbe_Sira_No'] ?></td>
				
								<td >										
									<?php echo $Rutbe_Cek['Admin_Soyad']." ".$Rutbe_Cek['Admin_Ad']." ".$Rutbe_Cek['Admin_Ataadi'] ?>
								</td> 							
								 
								 
							</tr>	
						<?php }	?>

					</tbody>

				</table>
			</div>
		</div>

		<?php }  }?>