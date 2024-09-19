<?php require_once '_header.php';?>
<script type="text/javascript">
	document.getElementById("SeyfeAdi").innerHTML = "";
	document.getElementById("SeyfeAdi").innerHTML = "Ezamiyyədə Olanlar";
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
								<th>Növü</th>						
								<th>Ezam Yeri</th>
								<th>Səbəbi</th>
								<th class="textaligncenter">Gün</th>
								<th>Başlanğıc Tarixi</th>
								<th class="textaligncenter">Bitiş Tarixi</th>
								<th>İşə çıxma Tarixi</th>
								<th>Əmrin nömrəsi</th>
							</tr>							
						</thead>
						<tbody>
							<?php
							if ($UmumiBaxisButunIdareler==1) {
								$Hevs_Sor=$db->prepare("SELECT * FROM ezamiyye_emri where  Ezam_Baslangic_Tarixi<:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>:Ezam_Bitis_Tarixi");
								$Hevs_Sor->execute(array(									
									'Ezam_Baslangic_Tarixi'=>$Tarix_Beynelxalq,
									'Ezam_Bitis_Tarixi'=>$Tarix_Beynelxalq
								));	
							}else{
								$Hevs_Sor=$db->prepare("SELECT * FROM ezamiyye_emri where Idare_Id=:Idare_Id and Ezam_Baslangic_Tarixi<:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>:Ezam_Bitis_Tarixi");
								$Hevs_Sor->execute(array(
									'Idare_Id'=>$Admin_Islediyi_Idare_Id,
									'Ezam_Baslangic_Tarixi'=>$Tarix_Beynelxalq,
									'Ezam_Bitis_Tarixi'=>$Tarix_Beynelxalq
								));	
							}
							
							while ($Hevs_Cek=$Hevs_Sor->fetch(PDO::FETCH_ASSOC)) {
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
									<td><?php echo $Hevs_Cek['Ezam_Novu']==0 ? "Daxili ezamiyy":"Xarici ezamiyyə";?></td>								
									<td><?php echo $Hevs_Cek['Ezam_Olundugu_Yer'];?></td>								
									<td><?php echo $Hevs_Cek['Ezam_Sebebi'];?></td>								
									<td><?php echo $Hevs_Cek['Ezam_Gun_Sayi'];?></td>
									<td data-sort="<?php echo $Hevs_Cek['Ezam_Baslangic_Tarixi'] ?>"><?php echo TarixAzCevir($Hevs_Cek['Ezam_Baslangic_Tarixi']) ?></td>
									<td data-sort="<?php echo$Hevs_Cek['Ezam_Bitis_Tarixi'] ?>" class="textaligncenter"><?php echo TarixAzCevir($Hevs_Cek['Ezam_Bitis_Tarixi']) ?></td>	
									<td data-sort="<?php echo $Hevs_Cek['Ezam_Isecixma_Tarixi'] ?>"><?php echo TarixAzCevir($Hevs_Cek['Ezam_Isecixma_Tarixi']) ?></td>	
									<td><?php echo $Hevs_Cek['Ezam_Emri_No'];?></td>	
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