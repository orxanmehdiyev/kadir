<?php require_once '_header.php';?>
<script type="text/javascript">
	document.getElementById("SeyfeAdi").innerHTML = "";
	document.getElementById("SeyfeAdi").innerHTML = "Xüsusi rütbə veriləcək əməkdaşlar";
</script>
<div class="card heyet">
	<div class="tab-content">
		<div class="tab-pane fade show active"> 
			<div class="card">
				<div class="container-fluid">
					<div class="row">
						<form class="row">
							<div class="col-6">
								<label for="TequtNovu" class="form-label">Növü</label>
								<select id="TequtNovu" class="form-control">
									<option value="Növbəti xüsusi rütbə verilmə vaxtı çatan əməkdaşlar" selected>Növbəti xüsusi rütbə verilmə vaxtı çatan əməkdaşlar</option>
									<option value="Vaxdından əvvəl növbəti xüsusi rütbə verilə biləcək əməkdaşlar">Vaxdından əvvəl növbəti xüsusi rütbə verilə biləcək əməkdaşlar</option>
									<option value="Vəzifə üçün nəzərdə tulandan bir pillə yuxarı xüsusi rütbənin verilə biləcək əməkdaşlar">Vəzifə üçün nəzərdə tulandan bir pillə yuxarı xüsusi rütbənin verilə biləcək əməkdaşlar</option>
								</select>
							</div>
							<div class="col-3">								
								<input  type="text" class="form-select tarix mezuniyyettarix" style="float: left; margin-top: 24px; " value="<?php echo $TekTarix   ?>" id="Tedbiq_Edildiyi_Tarix" autocomplete="off" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="10" tabindex="4" title="">		
								<button type="button" style="margin-top: 24px; " onclick="TeqautAxtar()" class="mezuniyyethesabla" tabindex="15" title="">Axtar</button>		
							</div>		
						</form>	
					</div> 
				</div>
				<br>
				<div  class="ListelemeAlaniIciTabloAlaniKapsayicisi" id="icerik">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="sabit">							
							<tr class="textaligncenter" >
								<th style="width:50px;">ID</th>
								<th>Şəkli</th>
								<th>Soyadı</th>
								<th>Adı</th>
								<th>Atasının<br/> adı</th>
								<th>İdarə</th>
								<th>Struktur bölməsi</th>
								<th>Vəzifəsi</th>
								<th>Xüsusi rütbəsi</th>
								<th class="tarixsutunu">Xidmətə qəbul tarixi</th>
								<th class="tarixsutunu">Doğum tarixi</th>								
								<th class="tarixsutunu">Son aldığı rütbənin tarixi</th>		
								<th class="tarixsutunu">Növbəti rütbənin tarixi</th>						
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
									$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and User_Id>:User_Id and Zabit_Mulu=:Zabit_Mulu  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
									$Vezife_Sor->execute(array(
										'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
										'Vezife_Adlari_Durum'=>1,
										'User_Id'=>0,
										'Zabit_Mulu'=>0
									));									
									while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
										$ID                  =  $Vezife_Cek['User_Id']; 									
										$Rutbe_Emri_Tarixi=$Tarix_Beynelxalq;
										$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
										$User_Sor->execute(array(
											'ID'=>$ID,
											'Durum'=>1));
										$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);

										$Intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and  Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id<>:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id and  Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:baslagic and Intizam_Tenbehinin_Bitis_Tarixi>:Bitis");
										$Intizam_Sor->execute(array(
											'ID'=>$ID,
											'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>1,
											'baslagic'=>$Rutbe_Emri_Tarixi,
											'Bitis'=>$Rutbe_Emri_Tarixi
										));
										$Intizam_Say=$Intizam_Sor->rowCount();
										$Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC);
										$Intizam_Tenbehinin_Bitis_Tarixi=$Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'];
										$Intizam_Bitis_Tarixi=Tarix_Beynelxalqi_Az_Cevir($Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi']);

										$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
										$Rutbe_Emri_Sor->execute(array(
											'ID'=>$ID));
										$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
										$Rutbe_Emri_Say=$Rutbe_Emri_Sor->rowCount();


										$Rutbe_Vaxdindan_Evvel_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID and Rutbe_Emri_Novu=:Rutbe_Emri_Novu");
										$Rutbe_Vaxdindan_Evvel_Sor->execute(array(
											'ID'=>$ID,
											'Rutbe_Emri_Novu'=>3
										));

										$Rutbe_Bir_Pille_Yuxari=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID and Rutbe_Emri_Novu=:Rutbe_Emri_Novu");
										$Rutbe_Bir_Pille_Yuxari->execute(array(
											'ID'=>$ID,
											'Rutbe_Emri_Novu'=>4
										));

										$Son_Aldigi_Rutbenin_Tarixi=$Rutbe_Emri_Cek['Rutbe_Emri_Tarixi'];	
										$Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];
										$Rutbe_Vaxdindan_Evvel_Verilmesi=$Rutbe_Vaxdindan_Evvel_Sor->rowCount();
										$Rutbe_Nezerde_Tutulandan_Bir_Pille_Yuxari_Verilmesi=$Rutbe_Bir_Pille_Yuxari->rowCount();


										$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
										$Rutbe_Sor->execute(array(
											'Rutbe_Id'=>$Rutbe_Id));
										$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
										$Rutbe_Xidmet_Ili=$Rutbe_Cek['Rutbe_Xidmet_Ili'];
										$ay=$Rutbe_Xidmet_Ili * 12;
										$XidmetiliYarisi=$ay/2;	



										$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id ");
										$Vezife_Sor->execute(array(
											'User_Id'=>$ID));
										$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
										$Zabit_Mulu=$Vezife_Cek['Zabit_Mulu'];
										$AlaBileceyiRutbe=$Vezife_Cek['AlaBileceyiRutbe'];


										$Ala_Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
										$Ala_Rutbe_Sor->execute(array(
											'Rutbe_Id'=>$AlaBileceyiRutbe));
										$Ala_Rutbe_Cek=$Ala_Rutbe_Sor->fetch(PDO::FETCH_ASSOC);

										$Faktiki_Rutbenin_Sira_Nomresi=$Rutbe_Cek['Rutbe_Sira_No'];
										$Maksimal_Rutbe_Sira_No=$Ala_Rutbe_Cek['Rutbe_Sira_No'];
										$Novbeti_Rutbenin_Sira_Nomresi=$Faktiki_Rutbenin_Sira_Nomresi+1;
										if ($Intizam_Say==0) {
											if ($Rutbe_Emri_Say==0) { ?>
												<tr class="textaligncenter" >
													<th style="width:50px;"><?php echo $ID ?></th>
													<th>Şəkli</th>
													<th>Soyadı</th>
													<th>Adı</th>
													<th>Atasının<br/> adı</th>
													<th>İdarə</th>
													<th>Struktur bölməsi</th>
													<th>Vəzifəsi</th>
													<th>Xüsusi rütbəsi</th>
													<th class="tarixsutunu">Xidmətə qəbul tarixi</th>
													<th class="tarixsutunu">Doğum tarixi</th>								
													<th class="tarixsutunu">Son aldığı rütbənin tarixi</th>		
													<th class="tarixsutunu">Növbəti rütbənin tarixi</th>						
												</tr>											
											<?php	}else{	
												$uzerineAyGel="month";
												$Novbeti_Rutbe_Tarixi=Traix_Uzerine_Gel($Son_Aldigi_Rutbenin_Tarixi,$ay,$uzerineAyGel);

												$Intizam_Bitis_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id<>:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id and  Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:baslagic and Intizam_Tenbehinin_Bitis_Tarixi>:Bitis");
												$Intizam_Bitis_Sor->execute(array(
													'ID'=>$ID,
													'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>1,
													'baslagic'=>$Novbeti_Rutbe_Tarixi,
													'Bitis'=>$Novbeti_Rutbe_Tarixi
												));
												$Intizam_Bitis_Say=$Intizam_Bitis_Sor->rowCount();
												$Intizam_Bitis_Cek=$Intizam_Bitis_Sor->fetch(PDO::FETCH_ASSOC);
												$Intizam_Tenbehinin_Bitis=$Intizam_Bitis_Cek['Intizam_Tenbehinin_Bitis_Tarixi'];
												if ($Intizam_Bitis_Say==1) {
													$novbetitarix=$Intizam_Tenbehinin_Bitis;
												}else{
													$novbetitarix=$Novbeti_Rutbe_Tarixi;
												}

												$Vaxdindanevvel_Unix=Traix_Uzerine_Gel($Son_Aldigi_Rutbenin_Tarixi,$XidmetiliYarisi,$uzerineAyGel);
												if ($Novbeti_Rutbe_Tarixi<=$Rutbe_Emri_Tarixi and $Faktiki_Rutbenin_Sira_Nomresi<$Maksimal_Rutbe_Sira_No) {
													echo "<li class='verilebiler'>Növbəti xüsusi rütbə verilə bilər</li>";
												}	
												elseif ($Rutbe_Vaxdindan_Evvel_Verilmesi<2 and $Vaxdindanevvel_Unix<=$Rutbe_Emri_Tarixi and $Novbeti_Rutbe_Tarixi>$Rutbe_Emri_Tarixi and $Novbeti_Rutbenin_Sira_Nomresi<=$Maksimal_Rutbe_Sira_No) {
													echo "<li class='verilebiler'>Vaxdindan əvvəl xüsusi rütbə verilə bilər</li>";														
												}

												elseif ($Rutbe_Nezerde_Tutulandan_Bir_Pille_Yuxari_Verilmesi<2 and $Novbeti_Rutbe_Tarixi<=$Rutbe_Emri_Tarixi and $Faktiki_Rutbenin_Sira_Nomresi==$Maksimal_Rutbe_Sira_No) {
													echo "<li class='verilebiler'>Tutduğu vəzifədən bir pillə yuxarı xüsusi rütbə verilə bilər</li>";	
												}else{
													echo "<li class='verilebilmez'>İlkin rütbənin vaxdı</li>";
												}			
											}													
											
										}else{	
											echo "<li class='verilebiler'>Əməkdaşın üzərində intizam tənbehi var. İntizam tənbehinin bitiş tarixi</li>";
										}		


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


	function filterColumn ( i ) {
		$('#dataTable').DataTable().column( i ).search(
			$('#col'+i+'_filter').val()
			).draw();
	}

	$(document).ready(function() {
		$('#dataTable').DataTable();


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
  function TeqautAxtar(){
  	var Tedbiq_Edildiyi_Tarix=document.getElementById("Tedbiq_Edildiyi_Tarix");
  	var TequtNovu=document.getElementById("TequtNovu");

  	if(Tedbiq_Edildiyi_Tarix.value === '') {
  		error(Tedbiq_Edildiyi_Tarix);
  		return;
  	}
  	if(TequtNovu.value === '') {
  		error(TequtNovu);
  		return;
  	}

  	var gonderilen = {
  		Tedbiq_Edildiyi_Tarix:Tedbiq_Edildiyi_Tarix.value,
  		TequtNovu:TequtNovu.value
  	};
  	var deyer=JSON.stringify(gonderilen);
  	document.getElementById("yuklemealanikapsayici").style.display = "block";
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "Tequt/Tequt_Axtarisi.php", true);
  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send("Deyer=" + deyer);
  	xhttp.onreadystatechange = function (deyer) {
  		if (this.readyState == 4 && this.status == 200) {
  			document.getElementById("yuklemealanikapsayici").style.display = "none";
  			var data=this.responseText.trim();    
  			document.getElementById("icerik").innerHTML="";
  			document.getElementById("icerik").innerHTML=data; 
  			
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
  			return; 
  		}
  	}

  }

</script>