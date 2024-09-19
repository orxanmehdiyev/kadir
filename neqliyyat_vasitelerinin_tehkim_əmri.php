<?php 
require_once '_header.php';
?>	
<script type="text/javascript" src="NeqliyyatVasitelerininTehkimEmri/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">							
						<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>				
					</div>
				</div>				
			</div>
		</div>
		
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM neqliyyat_vasiteleri order by Neqliyyat_Vasiteleri_Istehsal_Ili ASC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover " id="dataTable">
							<thead class="">
								<tr>
									<th>№</th>
									<th>Nömrəsi</th>
									<th>Növü</th>
									<th>Markası</th>
									<th>Motor hecmi</th>
									<th>Yer Sayi</th>
									<th>İli</th>
									<th>İdarə</th>
									<th>Dəyəri</th>
									<th>Əməliyyatlar</th>								
								</tr>
							</thead>
							<tbody>
								<?php 
								$neqliyyatsira=0;
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									$neqliyyatsira++;
									$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id ");
									$Idare_Sor->execute(array(
										'Idare_Id'=>$Cek['Idare_Id']));
									$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
									$Idare_Adi=$Idare_Cek['Idare_Kissa_Adi'];
									?>
									<tr>							
										<td class="siar_no_alani"><?php echo $neqliyyatsira ?></td>										
										<td><?php echo $Cek['Dovlet_Nom_Nisani'] ?></td>
										<td><?php echo $Cek['Neqliyyat_Vasiteleri_Novu'] ?></td>
										<td><?php echo $Cek['Neqliyyat_Vasiteleri_Marka'] ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Motor_Hecmi'] ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Adam_Yeri'] ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Istehsal_Ili'] ?></td>
										<td class="textaligncenter"><?php echo $Idare_Adi ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Balans_Deyeri'] ?></td>
										<td class="emeliyyatlar_iki_buttom">											
											<button class="YenileButonlari" id="Duzeli_<?php echo $Cek['Neqliyyat_Vasiteleri_Id'] ?>" onclick="Duzeli(this.id)" type="button"><i class="fas fa-edit"></i></button>	
											<button class="YenileButonlari" id="Sil_<?php echo $Cek['Neqliyyat_Vasiteleri_Id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>
										</td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada Nəqliyyat vasitəsi Yoxdur
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
</div>
<?php 
require_once '_footer.php';
?>
<script>


	var dataTables = $('#dataTable').DataTable({

		"bFilter" : false,               
		"bLengthChange": true,
		"lengthMenu": [[50, -1], [ 50, "Hamısı"]],
		"pageLength":50,
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
    
    {extend: 'excel',
    title: 'Nəqliyyat Vasitələrinin siyahısı',
    exportOptions: {
    	columns: [0,1,2,3,4,5,6,7,8,9],
    	stripHtml: false,
    }
  },
  {	extend: 'print',
  customize: function ( win ) {
  	$(win.document.body)
  	.css( 'font-size', '10px' )
  	$(win.document.body).find( 'table' )
  	.addClass( 'compact' )
  	.css( 'font-size', 'inherit' );
  }, title: 'Nəqliyyat Vasitələrinin siyahısı',
  exportOptions: {
  	columns: [0,1,2,3,4,5,6,7,8,9],
  	stripHtml: false,
  }
}
],
});



</script>