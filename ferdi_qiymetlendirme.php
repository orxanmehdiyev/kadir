<?php require_once '_header.php';?>
<script type="text/javascript">
	document.getElementById("SeyfeAdi").innerHTML = "";
	document.getElementById("SeyfeAdi").innerHTML = "Fərdi Qiymətləndirmə";
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
						</form>	
					</div> 
				</div>
				<div  class="ListelemeAlaniIciTabloAlaniKapsayicisi">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">	
						<thead class="sabit">							
							<tr class="textaligncenter" >
								<th style="width:50px;">ID</th>
								<th>Şəkli</th>
								<th>Soyadı</th>
								<th>Adı</th>
								<th>Atasının<br/> adı</th>
								<th>İdarə</th>
								<th style="width: 100px; ">Struktur bölməsi</th>
								<th>Vəzifəsi</th>
								<th>Xüsusi rütbəsi</th>
								<th class="tarixsutunu">Qüsursuz xidmətə görə qiymətləndirmə</th>
								<th class="tarixsutunu">Biliyin qiymətləndirilməsi</th>								
								<th class="tarixsutunu">Xidməti müvəffəqiyyətlərin qiymətləndirilməsi</th>
								<th>Xidməti intizamın qiymətləndiriləsi</th>							
								<th>Yekun Qiyməti</th>							
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
									$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and User_Id>:User_Id and Stat_Muqavile=:Stat_Muqavile  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
									$Vezife_Sor->execute(array(
										'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
										'Vezife_Adlari_Durum'=>1,
										'User_Id'=>0,
										'Stat_Muqavile'=>0
									));									
									while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
										$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
										$Sor->execute(array(
											'ID'=>$Vezife_Cek['User_Id']));
										$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
										$Ad=$Cek['Adi'];
										$Soy_Adi=$Cek['Soy_Adi'];
										$Ata_Adi=$Cek['Ata_Adi'];	
										$Ise_Qebul_Tarixi=$Cek['Ise_Qebul_Tarixi'];	

										$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
										$Rutbe_Emri_Sor->execute(array(
											'ID'=>$Cek['ID']));
										$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
										if (strlen($Rutbe_Emri_Cek['Rutbe_Img'])>0) {
											$RutbeSekli='<img src="'.$Rutbe_Emri_Cek['Rutbe_Img'].'" class=" mx-auto d-block" style="width:96px;height: 100px;" alt="...">';
										}else{	
											$RutbeSekli='<img src="Senedler/Rutbe/nophoto.png" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
										}
										$Rutbe_Adi=$Rutbe_Emri_Cek['Rutbe_Adi'];

										$QusursuzQiymetsor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID  order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC,Intizam_Tenbehi_Id DESC limit 1");
										$QusursuzQiymetsor->execute(array(
											'ID'=>$Cek['ID']));
										$QusursuzQiymetSay=$QusursuzQiymetsor->rowCount();
										$QusursuzXidmetBali=0;
										if ($QusursuzQiymetSay>0) {
											$QusursuzQiymetcek=$QusursuzQiymetsor->fetch(PDO::FETCH_ASSOC);
											$SonIntizam=new DateTime($QusursuzQiymetcek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix']);	
											$faktiki=new DateTime($Tarix_Beynelxalq);
											$Sonitizamdankecen= $faktiki->diff($SonIntizam)->y;
										}else{
											$SonIntizam=new DateTime($Ise_Qebul_Tarixi);	
											$faktiki=new DateTime($Tarix_Beynelxalq);
											$Sonitizamdankecen= $faktiki->diff($SonIntizam)->y;
										}
										if ($Sonitizamdankecen<1) {
											$QusursuzXidmetBali=0;
										}elseif ($Sonitizamdankecen>=1 and $Sonitizamdankecen<=2) {
											$QusursuzXidmetBali=1;
										}elseif ($Sonitizamdankecen>2 and $Sonitizamdankecen<=5) {
											$QusursuzXidmetBali=2;
										}elseif ($Sonitizamdankecen>5 and $Sonitizamdankecen<=10) {
											$QusursuzXidmetBali=4;
										}elseif ($Sonitizamdankecen>10 and $Sonitizamdankecen<=15) {
											$QusursuzXidmetBali=6;
										}elseif ($Sonitizamdankecen>15 and $Sonitizamdankecen<=20) {
											$QusursuzXidmetBali=8;
										}elseif ($Sonitizamdankecen>20) {
											$QusursuzXidmetBali=10;
										}
										$BilikQiymeti=0;
										$AtestasiyaSor=$db->prepare("SELECT * FROM  attestasiya_emri where ID=:ID order by Attestasiya_Tarix DESC ");
										$AtestasiyaSor->execute(array(
											'ID'=>$Cek['ID']));
										$AtestasiyaSay=$AtestasiyaSor->rowCount();
										if ($AtestasiyaSay>0) {
											$AtestasiyaCek=$AtestasiyaSor->fetch(PDO::FETCH_ASSOC);
											$BilikQiymeti=$AtestasiyaCek['Qiymetlendirme_Bali'];
										}else{
											$BilikQiymeti=0;
										}


										$HeveslendirmeSor=$db->prepare("SELECT * FROM hevesledirme_tedbirleri where ID=:ID ");
										$HeveslendirmeSor->execute(array(
											'ID'=>$Cek['ID']));
										$HeveslendirmeSay=$HeveslendirmeSor->rowCount();
										if ($HeveslendirmeSay>0) {
											$MuvefeqiyyetQiymeti=0;
											while ($HeveslendirmeCek=$HeveslendirmeSor->fetch(PDO::FETCH_ASSOC)) {										
												$HeveslendirmeAdSor=$db->prepare("SELECT * FROM heveslendirem_tedbirleri_ad where heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id ");
												$HeveslendirmeAdSor->execute(array(
													'heveslendirem_tedbirleri_ad_id'=>$HeveslendirmeCek['Heveslendirem_Tedbirleri_Ad_Id']));
												$HeveslendirmeAdCek=$HeveslendirmeAdSor->fetch(PDO::FETCH_ASSOC);
												$MuvefeqiyyetQiymeti+=$HeveslendirmeAdCek['Qiymet_bali'];

											}
										}else{
											$MuvefeqiyyetQiymeti=0;
										}


										$IntizamQiymetSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID");
										$IntizamQiymetSor->execute(array(
											'ID'=>$Cek['ID']));
										$IntizamQiymetSay=$IntizamQiymetSor->rowCount();
										if ($IntizamQiymetSay>0) {
											$IntizamQiymeti=0;
											while ($IntizamQiymetCek=$IntizamQiymetSor->fetch(PDO::FETCH_ASSOC)) {
												$IntizamAdiSor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari where intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id");
												$IntizamAdiSor->execute(array(
													'intizam_tenbehi_adlari_id'=>$IntizamQiymetCek['Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id']));
												$IntizamAdiCek=$IntizamAdiSor->fetch(PDO::FETCH_ASSOC);
												$IntizamQiymeti+=$IntizamAdiCek['Intizam_Qiymet_Bali'];
											}
										}else{
											$IntizamQiymeti=0;
										}

										
										?>
										<tr class="vertikalmidle">
											<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Id']; ?></td>									
											<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
											<td><?php echo $Soy_Adi ?></td>
											<td><?php echo $Ad ?></td>
											<td><?php echo $Ata_Adi ?></td>
											<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
											<td class="textaligncenter" style="word-break: break-word;"><?php echo $Sobe_Cek['Sobe_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Rutbe_Adi ?></td>
											<td class="textaligncenter"><?php echo $QusursuzXidmetBali; ?></td>
											<td class="textaligncenter"><?php echo $BilikQiymeti; ?></td>	
											<td class="textaligncenter"><?php echo $MuvefeqiyyetQiymeti; ?></td>	
											<td class="textaligncenter"><?php if ($IntizamQiymeti>0) {
												echo "-".$IntizamQiymeti;
											}else{
												echo $IntizamQiymeti;
											}

										?></td>	


										<td class="textaligncenter"><?php echo $QusursuzXidmetBali+$BilikQiymeti+$MuvefeqiyyetQiymeti-$IntizamQiymeti ?></td>						
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
    
    {extend: 'excel', title: 'kadr'},
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