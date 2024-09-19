<?php require_once '_header.php';?>
<script type="text/javascript">
	document.getElementById("SeyfeAdi").innerHTML = "";
	document.getElementById("SeyfeAdi").innerHTML = "Sərəncamda Olanlar";
</script>
<div class="card heyet">
	<div class="tab-content">
		<div class="tab-pane fade show active"> 
			<div class="card">
				<div  class="ListelemeAlaniIciTabloAlaniKapsayicisi">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="sabit">							
							<tr class="textaligncenter" >
								<th style="width:50px;">ID</th>
								<th>Şəkli</th>								
								<th>Soyadı</th>
								<th>Adı</th>
								<th>Ata adı</th>						
								<th>Tarix</th>
								<th>Səbəb</th>
								<th>Əmrin nömrəsi</th>
							</tr>							
						</thead>
						<tbody>
							<?php
							$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Serencam_Durum=:Serencam_Durum");
							$User_Sor->execute(array(
								'Durum'=>1,						
								'Serencam_Durum'=>1));

							
							while ($Hevs_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
								$Sor->execute(array(
									'ID'=>$Hevs_Cek['ID']));
								$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
								$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
								$Rutbe_Emri_Sor->execute(array(
									'ID'=>$Hevs_Cek['ID']));
								$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
								$RutbeSekli='<img src="'.$Rutbe_Emri_Cek['Rutbe_Img'].'" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
								?>
								<tr class="vertikalmidle">
									<td class="textaligncenter"><?php echo $Hevs_Cek['ID'];?></td>				
									<td style="padding: 0; cursor: pointer; width:100px" >
										<a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a>
									</td>
									<td><?php echo $Hevs_Cek['Soy_Adi'];?></td>
									<td><?php echo $Hevs_Cek['Adi'];?></td>
									<td><?php echo $Hevs_Cek['Ata_Adi'];?></td>										
									<td data-sort="<?php echo $Hevs_Cek['Serencam_Tarix'] ?>" class="textaligncenter"><?php echo TarixAzCevir($Hevs_Cek['Serencam_Tarix']); ?></td>					
									<td><?php echo $Hevs_Cek['Serencam_Sebeb']==0?"Ştat tədbiri":"İntizam tənbehi";?></td>										
									<td><?php echo $Hevs_Cek['Serencam_Emir'];?></td>										
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once '_footer.php';?>
<script>
	function CedveliCagir(icerik){
		var dataTables = $('#'+icerik).DataTable({
			"bFilter" : false,               
			"bLengthChange": true,
			"lengthMenu": [[10,20,30,40,50,60,70,80,90, -1], [10,20,30,40,50,60,70,80,90, "Hamısı"]],
			"pageLength":10,
    "order": [], //Initial no order.
    "aaSorting": [],
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "bAutoWidth": false,
    "responsive": true,
    'processing': true,
    "fixedHeader": true,   
    buttons: [ ],
    pagingType: 'numbers',

  });
	};
	CedveliCagir("dataTable");
</script>