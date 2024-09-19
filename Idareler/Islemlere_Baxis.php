<?php 
require_once '../Ayarlar/setting.php';
if ($IdarelerIslemlereBaxis==1) {
if (isset($_POST['Deyer'])) {
	$Idare_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sors=$db->prepare("SELECT * FROM  idare_islemleri where Idare_Id=:Idare_Id");
	$Sors->execute(array(
		'Idare_Id'=>$Idare_Id
	));
	
	?>
	<div class="row">
		<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
			<table class="ListelemeAlaniIciTablosu">
				<thead class="">
					<tr>	
						<th>№</th>
						<th>Səbəbi</th>
						<th>Tarix</th>
						<th>Tabe Oldugu Idarə</th>
						<th>Adı</th>
						<th>Kısa Adı</th>
						<th>VÖEN</th>
						<th>Sira No</th>								
						<th>Ünvanı</th>	
						<th>İcraçı</th>			
					</tr>
				</thead>
				<tbody>
					<?php 
					$Sira_Nomir=0;
					while ($Idare_Cek=$Sors->fetch(PDO::FETCH_ASSOC)) {
						$Sira_Nomir++;
						if($Idare_Cek['Idare_Islemleri_Sebebi']==1){
							$Idare_Islemleri_Sebebi="Yeni yaradıldı";
						}elseif($Idare_Cek['Idare_Islemleri_Sebebi']==2){
							$Idare_Islemleri_Sebebi="Düzəliş edildi";
						}elseif($Idare_Cek['Idare_Islemleri_Sebebi']==3){
							$Idare_Islemleri_Sebebi="Silindi";
						}elseif($Idare_Cek['Idare_Islemleri_Sebebi']==4){
							$Idare_Islemleri_Sebebi="Durum Aktiv Edildi";
						}elseif($Idare_Cek['Idare_Islemleri_Sebebi']==5){
							$Idare_Islemleri_Sebebi="Durum Passiv edildi";
						}else{
							$Idare_Islemleri_Sebebi="";
						}
						?>
						<tr>							
							<td class="textaligncenter"><?php echo $Sira_Nomir ?></td>
							<td><?php echo $Idare_Islemleri_Sebebi ?></td>	
							<td class="textaligncenter"><?php echo $Idare_Cek['Idare_Islem_Edildiyi_Tarix'] ?></td> 						
							<td class="textaligncenter"><?php echo $Idare_Cek['Ust_Ad'] ?></td> 						
							<td><?php echo $Idare_Cek['Idare_Adi'] ?></td>							
							<td><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>							
							<td class="textaligncenter"><?php echo $Idare_Cek['Idare_VOEN'] ?></td>
							<td class="textaligncenter"><?php echo $Idare_Cek['Sira_No'] ?></td>
							<td><?php echo $Idare_Cek['Idare_Unvan'] ?></td>
							<td><?php echo $Idare_Cek['Admin_Soyad']." ".$Idare_Cek['Admin_Ad']." ".$Idare_Cek['Admin_Ataadi'] ?></td>
							
							
							 							
							 
							 
						</tr>	
					<?php }
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php  
}else{
	header("Location:../login.php");
	exit;
}
}?>
