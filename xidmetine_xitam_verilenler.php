<?php require_once '_header.php';?>
<div class="card heyet">
	<?php require_once '_menu_index.php'; ?>
	<script type="text/javascript">
		document.getElementById('Xidmetine_Xitam_Verilenler').classList.add("active");
	</script>
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
									$Idare_Sor=$db->prepare("SELECT * FROM idare order by Sira_No ASC ");
									$Idare_Sor->execute(); 
									?>
									<option value="" selected="selected"></option>
									<?php while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<option value="<?php echo $Idare_Cek['Idare_Kissa_Adi'] ?>" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-4">
								<label for="SobeAxtarir" class="form-label">Struktur bölmə</label>
								<select id="SobeAxtarir" class="form-control">
									<?php 
									$Sobe_Sor=$db->prepare("SELECT  DISTINCT Sobe_Ad FROM sobe order by Sira_No ASC ");
									$Sobe_Sor->execute(); 
									?>
									<option disabled="disabled" selected></option>
									<?php while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<option value="<?php echo $Sobe_Cek['Sobe_Ad'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-2">
								<label for="inputState" class="form-label">Axtarış kriteriytası</label>
								<select id="inputState" class="select2 form-select">
									<option selected>Seçin...</option>
									<option>...</option>
								</select>
							</div>
							<div class="col-2">
								<label for="VakanAxtarir" class="form-label">Vakant/Dolu</label>
								<select id="VakanAxtarir" class="form-select">
									<option value="" selected="selected"></option>
									<option value="Vakand" >Vakant</option>
									<option value="Dolu" >Dolu</option>								
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
					<table style="white-space: normal;" class="ListelemeAlaniIciTablosu " id="dataTable">
						<caption><span class="boz"></span>Vakant yerlər 	<span class="yasil"></span>Məzuniyyətdə olan əməkdaşlar</caption>
						<thead class="sabit">							
							<tr>
								<th style="width:50px;">Kod</th>
								<th>Şəkli</th>
								<th>Soyadı</th>
								<th>Adı</th>
								<th>Atasının<br/>adı</th>
								<th>İdarə</th>
								<th style="width: 70px; ">Struktur</br>bölməsi</th>
								<th>Vəzifəsi</th>
								<th>Xüsusi rütbəsi</th>							
								<th>Xidmətə</br>qəbul tarixi</th>
								<th>Doğum</br>tarixi</th>
								<th>Telefon</th>
								<th>Xitam tarixi</th>
								<th>Səbəb</th>
								<th>Əmir No</th>
							
							</tr>							
						</thead>
						<tbody>
							<?php 
							$Sor=$db->prepare("SELECT * FROM user where Durum=:Durum");
							$Sor->execute(array(
								'Durum'=>0));
							$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
							while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {					

								?>
								<tr class="vertikalmidle">

									<td class="textaligncenter"><?php echo $Cek['ID'];?></td>
									
									<td style="padding: 0; cursor: pointer;" ><a href="" target="_blank"></a></td>


									<td><?php echo $Cek['Soy_Adi'] ?></td>
									<td><?php echo $Cek['Adi'] ?></td>
									<td><?php echo $Cek['Ata_Adi'] ?></td>
									<td><?php echo $Cek['Idare_Ad'] ?></td>
									<td><?php echo $Cek['Sobe_Ad'] ?></td>
									<td><?php echo $Cek['Vezife_Ad'] ?></td>
									<td></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Qebul_Tarixi']) ?></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Dogum_Tarixi']) ?></td>
									<td><?php echo $Cek['Telefon'] ?></td>
									<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Isden_Cixarilma_Tarixi']) ?></td>
									<td><?php echo $Cek['xitam_sebebleri_kisa_ad'] ?></td>
									<td><?php echo $Cek['Isden_Cixarilma_Emir_No'] ?></td>	
								</tr>
								<?php }	?>
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

	function VakanAxtarir () {
		if ($('#VakanAxtarir').val()=="Vakand") {
			$('#dataTable').DataTable().column(2).search(
				$('#VakanAxtarir').val()
				).draw();
		}else if($('#VakanAxtarir').val()=="Dolu"){
			$('#dataTable').DataTable().column(2).search(
				'^((?!Vakand).)*$', true, false
				).draw();
		}else{
			$('#dataTable').DataTable().column(2).search(
				$('#VakanAxtarir').val()
				).draw();
		}

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


		$('#VakanAxtarir').on( 'change', function () {
			VakanAxtarir();
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