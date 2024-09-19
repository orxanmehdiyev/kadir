<?php 
require_once '../Ayarlar/setting.php';
if ($MezuniyyetAdlariBax==1) {
if (isset($_POST['Deyer'])) {
	$Mezuniyyet_Novleri_ID  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM  mezuniyyet_novleri_islemleri where  Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID");
	$Sor->execute(array(
		'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID));
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
							<th>Sıra №</th>
							<th >Əməliyyat Edən</th>		
						</tr>
					</thead>
					<tbody>
						<?php 
						$Sira_Nomir=0;
						while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
							$Sira_Nomir++;
							if($Cek['Mezuniyyet_Novleri_Islem_Sebebi']==1){
								$Mezuniyyet_Novleri_Islem_Sebebi="Yeni yaradıldı";
							}elseif($Cek['Mezuniyyet_Novleri_Islem_Sebebi']==2){
								$Mezuniyyet_Novleri_Islem_Sebebi="Düzəliş edildi";
							}elseif($Cek['Mezuniyyet_Novleri_Islem_Sebebi']==3){
								$Mezuniyyet_Novleri_Islem_Sebebi="Silindi";
							}elseif($Cek['Mezuniyyet_Novleri_Islem_Sebebi']==4){
								$Mezuniyyet_Novleri_Islem_Sebebi="Durum AktivEdildi";
							}elseif($Cek['Mezuniyyet_Novleri_Islem_Sebebi']==5){
								$Mezuniyyet_Novleri_Islem_Sebebi="Durum Passiv edildi";
							}else{
								$Mezuniyyet_Novleri_Islem_Sebebi="";
							}
							?>
							<tr>						
								<td class=" textaligncenter"><?php echo $Sira_Nomir ?></td>
								<td><?php echo $Mezuniyyet_Novleri_Islem_Sebebi ?></td>
								<td><?php echo $Cek['Mezuniyyet_Novleri_Ad'] ?></td>
								<td><?php echo $Cek['Mezuniyyet_Novleri_TarixSaat'] ?></td>							
								<td class="textaligncenter"><?php echo $Cek['Mezuniyyet_Novleri_Sira'] ?></td>
				
								<td >										
									<?php echo $Cek['Admin_Soyad']." ".$Cek['Admin_Ad']." ".$Cek['Admin_Ataadi'] ?>
								</td> 							
								 
								 
							</tr>	
						<?php }	?>

					</tbody>

				</table>
			</div>
		</div>

		<?php }
		} ?>