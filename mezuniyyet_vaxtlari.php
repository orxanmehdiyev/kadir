<?php require_once '_header.php';?>
<script type="text/javascript">
	document.getElementById("SeyfeAdi").innerHTML = "";
	document.getElementById("SeyfeAdi").innerHTML = "Əməkdaşların məzuniyyət vaxtları";
</script>
<div class="card heyet">
	<div class="tab-content">
		<div class="tab-pane fade show active"> 
			<div class="card">
				<div class="container-fluid">
					<div class="row">
						<form class="row">					
							<div class="col-4">
								<label for="IdareAxtarir " class="form-label ">Gömrük orqanı</label>
								<select id="IdareAxtarir" class="form-control">
									<?php 
									if ($UmumiBaxisButunIdareler==1) {
										$Idare_Sor=$db->prepare("SELECT * FROM idare order by Sira_No ASC ");
										$Idare_Sor->execute(); 
									}else{
										$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id order by Sira_No ASC ");
										$Idare_Sor->execute(array(
											'Idare_Id'=>$Islediyi_Idare_Id)); 
									}
									if ($UmumiBaxisButunIdareler==1) {?>
										<option value="" selected="selected"></option>
									<?php } ?>
									<?php while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<option value="<?php echo $Idare_Cek['Idare_Kissa_Adi'] ?>" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-4">
								<label for="SobeAxtarir" class="form-label">Struktur bölmə</label>
								<select id="SobeAxtarir" class="form-control">
									<?php 
									if ($UmumiBaxisButunIdareler==1) {
										$Sobe_Sor=$db->prepare("SELECT  DISTINCT Sobe_Ad FROM sobe order by Sira_No ASC ");
										$Sobe_Sor->execute(); 
									}else{
										$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id order by Sira_No ASC ");
										$Sobe_Sor->execute(array(
											'Idare_Id'=>$Islediyi_Idare_Id)); 
									}
									?>
									<option disabled="disabled" selected></option>
									<?php while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<option value="<?php echo $Sobe_Cek['Sobe_Ad'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
									<?php } ?>
								</select>
							</div>						
							<div class="col-4 text-end">									
								<a href="#" title="">Ətraflı axtarış</a>
							</div> 
						</form>	
					</div> 
				</div>		

				<style type="text/css">

				</style>
				<div  class="ListelemeAlaniIciTabloAlaniKapsayicisi">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">				
						<caption><span class="boz"></span>Vakant yerlər 	<span class="yasil"></span>Məzuniyyətdə olan əməkdaşlar</caption>
						<thead class="sabit">							
							<tr class="textaligncenter" >
								<th style="width:50px;">ID</th>
								<th>Şəkli</th>
								<th>Soyadı</th>
								<th>Adı</th>
								<th>Atasının<br/>adı</th>
								<th>İdarə</th>
								<th style="width: 90px; ">Struktur</br>bölməsi</th>
								<th>Vəzifəsi</th>
								<th>Xüsusi rütbəsi</th>
								<th>Xidmətə</br>qəbul tarixi</th>
								<th>Qalıq</br>məzuniyyət</br>günü</th>								
								<th>Xidmət</br>İli</th>
								<th>Xidmət</br>İli</th>						
								<th style="width: 50px; ">Qalır</th>
								
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
									$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and vezife.User_Id>:User_Id  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
									$Vezife_Sor->execute(array(
										'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
										'Vezife_Adlari_Durum'=>1,
										'User_Id'=>0
									));									
									while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
										$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
										$Sor->execute(array(
											'ID'=>$Vezife_Cek['User_Id']));
										$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
										$Ad=$Cek['Adi'];
										$Soy_Adi=$Cek['Soy_Adi'];
										$Ata_Adi=$Cek['Ata_Adi'];
										$Ise_Qebul_Tarixi      =  Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Qebul_Tarixi']);	
										$Ise_Qebul_Tarixi_beynelxalq      =  $Cek['Ise_Qebul_Tarixi'];		
										$iseqebulgunay=explode("-", $Ise_Qebul_Tarixi_beynelxalq);
										$Xidmet_Ili_baslagic=($Il_tap-1)."-".$iseqebulgunay[1]."-".$iseqebulgunay[2];
										$Xidmet_Ili_Bitis=$Il_tap."-".$iseqebulgunay[1]."-".$iseqebulgunay[2];

										$d1 = new DateTime($Tarix_Beynelxalq);
										$d2 = new DateTime($Xidmet_Ili_Bitis);
										$xidmetbitisineqalangun=$d1->diff($d2)->days;

										$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
										$Rutbe_Emri_Sor->execute(array(
											'ID'=>$Cek['ID']));
										$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
										if (strlen($Rutbe_Emri_Cek['Rutbe_Img'])>0) {
											$RutbeSekli='<img src="'.$Rutbe_Emri_Cek['Rutbe_Img'].'" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
										}else{										
											$RutbeSekli='<img src="Senedler/Rutbe/nophoto.png" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
										}
										$Rutbe_Adi=$Rutbe_Emri_Cek['Rutbe_Adi'];
										?>
										<tr class="vertikalmidle" >
											<td class="textaligncenter"><?php echo $Vezife_Cek['User_Id']>0 ? $Vezife_Cek['User_Id']:"";?></td>
											<?php if ($Vezife_Cek['User_Id']>0) {?>
												<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
											<?php   }else{?>
												<td></td>
											<?php 	} ?>											
											<td><?php echo $Soy_Adi ?></td>
											<td><?php echo $Ad ?></td>
											<td><?php echo $Ata_Adi ?></td>
											<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
											<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
											<td data-sort="<?php echo $Ise_Qebul_Tarixi_beynelxalq ?>" class="textaligncenter"><?php echo $Ise_Qebul_Tarixi ?></td>
											<td class="textaligncenter"></td>
											<td data-sort="<?php echo $Xidmet_Ili_baslagic ?>" class="textaligncenter"><?php echo TarixAzCevir($Xidmet_Ili_baslagic) ?></td>
											<td data-sort="<?php echo $Xidmet_Ili_Bitis ?>" class="textaligncenter"><?php echo TarixAzCevir($Xidmet_Ili_Bitis) ?></td>
											<td class="textaligncenter"><?php echo $xidmetbitisineqalangun  ?></td>																
										</tr>
										<?php 
									}
								} 
							}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once '_footer.php';?>
<script>

	function filterGlobal () {
		$('#dataTable').DataTable().search(
			$('#global_filter').val()
			).draw();
	}
	function filterGlobalid () {
		$('#dataTable').DataTable().search(
			$('#global_filter').val()
			).draw();
	}



	function IdareAxtar () {
		$('#dataTable').DataTable().column(5).search(
			$('#IdareAxtarir').val()
			).draw();
	}


	function SobeAxtar () {
		$('#dataTable').DataTable().column(6).search(
			$('#SobeAxtarir').val()
			).draw();
	}



	function filterColumn ( i ) {
		$('#dataTable').DataTable().column( i ).search(
			$('#col'+i+'_filter').val()
			).draw();
	}

	$(document).ready(function() {
		$('#dataTable').DataTable();

		$('#IdareAxtarir').on( 'change', function () {
			IdareAxtar();
		} );

		$('#SobeAxtarir').on( 'change', function () {
			SobeAxtar();
		} );



		$('input.global_filter').on( 'keyup click', function () {
			filterGlobal();
		} );

		$('input.column_filter').on( 'keyup click', function () {
			filterColumn( $(this).parents('tr').attr('data-column') );
		} );
	} );
	var dataTables = $('#dataTable').DataTable({

		"bFilter" : false,               
		"bLengthChange": true,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Hamısı"]],
		"pageLength": 566,
    "order": [], //Initial no order.
    "aaSorting": [],
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "bAutoWidth": false,
    "responsive": true,
    'processing': true,
    "fixedHeader": true,   
    dom:
    "<'ui grid'"+
    "<'row'"+
    "<'col-2'l>"+
    "<'col-6'B>"+
    "<'col-4'f>"+
    ">"+
    "<'row dt-table'"+
    "<'sixteen wide column'tr>"+
    ">"+
    "<'row'"+
    "<'seven wide column'i>"+
    "<'right aligned nine wide column'p>"+
    ">"+
    ">",


    buttons: [
    
    {extend: 'excel', title: 'ExampleFile'},
    {	extend: 'print',
    customize: function ( win ) {
    	$(win.document.body)
    	.css( 'font-size', '10pt' )
    	$(win.document.body).find( 'table' )
    	.addClass( 'compact' )
    	.css( 'font-size', 'inherit' );
    }, title: 'Şəxsi heyyət haqqında məlumat',
    exportOptions: {
    	columns: ':visible',
    	stripHtml: false,
    }
  }
  ],
});
  //Sonradan yapılan butona tıklandığında asıl dışa aktarma butonunun çalışması


</script>