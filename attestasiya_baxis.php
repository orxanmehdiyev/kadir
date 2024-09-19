<?php require_once '_header.php';?>
<script type="text/javascript">
	document.getElementById("SeyfeAdi").innerHTML = "";
	document.getElementById("SeyfeAdi").innerHTML = "Ümumi Baxış";
</script>
<div class="card heyet">
	<div class="tab-content">
		<div class="tab-pane fade show active"> 
			<div class="card">
				<div class="container-fluid">
					<div class="row">
						<form class="row">					
							<div class="col-3">
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

									?>
									<?php 
									if ($UmumiBaxisButunIdareler==1) {?>
										<option value="" selected="selected"></option>
									<?php } ?>
									<?php while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<option value="<?php echo $Idare_Cek['Idare_Kissa_Adi'] ?>" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-3">
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
									<option selected></option>
									<?php while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<option value="<?php echo $Sobe_Cek['Sobe_Ad'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
									<?php } ?>
								</select>
							</div>				
							<div class="col-2">
								<label for="QerarAxtarir" class="form-label">Qərar</label>
								<select id="QerarAxtarir" class="form-select">
									<option value="" selected="selected"></option>
									<option value="Tutduğu vəzifəyə uyğundur" >Tutduğu vəzifəyə uyğundur</option>
									<option value="İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur" >İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur</option>		
									<option value="Tutduğu vəzifəyə uyğun deyil" >Tutduğu vəzifəyə uyğun deyil</option>						
								</select>
							</div>	

							<div class="col-3">								
								<input  type="text" class="form-select tarix mezuniyyettarix" style="float: left; margin-top: 24px; " value="<?php echo $TekTarix   ?>" id="Tedbiq_Edildiyi_Tarix" autocomplete="off" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="10" tabindex="4" title="">		
								<button type="button" style="margin-top: 24px; " onclick="AtestasiyaVaxdicatanlar()" class="mezuniyyethesabla" tabindex="15" title="">Atestasiyya vaxdı catanlar</button>		
							</div>		


							<div class="col-5">		
								<input  type="text" class="form-select tarix mezuniyyettarix" style="float: left; margin-top: 24px; " placeholder="__.__._____" id="tarixbaslagic" oninput="TarixAlaniYazildi(this.id)" autocomplete="off" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="10" tabindex="4" title="">				
								<input  type="text" class="form-select tarix mezuniyyettarix" style="float: left; margin-top: 24px; border-left: none; border-radius: 0;"  id="tarixbitis" oninput="TarixAlaniYazildi(this.id)" autocomplete="off" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="10" tabindex="4" title="" placeholder="__.__._____">		
								<button type="button" style="margin-top: 24px; " onclick="AtestasiyaTarixAraligi()" class="mezuniyyethesabla" tabindex="15" title="">Axtar</button>		
							</div>
						</form>	
					</div> 
				</div>		

				<br>
				<div  class="ListelemeAlaniIciTabloAlaniKapsayicisi" id="AtestasiyaIci">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">				
						<thead class="sabit">							
							<tr class="textaligncenter" >
								<th style="width:50px;">ID</th>
								<th>Şəkli</th>
								<th>Soyadı</th>
								<th>Adı</th>
								<th>Atasının<br/> adı</th>
								<th>Gömrük orqanı</th>
								<th style="width: 70px; ">Sturuktur bölmə</th>
								<th>Vəzifə</th>
								<th>Attestasiyadan kecdiyi gömrük orqanı</th>
								<th style="width: 70px; ">Attestasiyadan kecdiyi bölmə</th>
								<th>Attestasiyadan kecdiyi vəzifə</th>
								<th class="tarixsutunu">Son at. tar.</th>
								<th class="tarixsutunu">Növbəti at. tar.</th>								
								<th>Qərar</th>
								<th class="tarixsutunu">Bal</th>
								<th class="tarixsutunu">Qiymetlendirme</th>

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
									$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and vezife.User_Id>:User_Id and Stat_Muqavile=:Stat_Muqavile  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
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
										$Ise_Qebul_Tarixi      =  Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Qebul_Tarixi']);	
										$Ise_Qebul_Tarixi_beynelxalq      =  $Cek['Ise_Qebul_Tarixi'];	
										$Islediyi_Idare_Id      =  $Cek['Islediyi_Idare_Id'];	
										$Islediyi_Sobe_Id      =  $Cek['Islediyi_Sobe_Id'];	
										$Vezife_Id      =  $Cek['Vezife_Id'];	

										$VezifeteyinSor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID order by Vezifeye_Teyin_Etme_Tarixi DESC");
										$VezifeteyinSor->execute(array(
											'ID'=>$Vezife_Cek['User_Id']));
										$VezifeteyinCek=$VezifeteyinSor->fetch(PDO::FETCH_ASSOC);
										$Vezifeye_Teyin_Etme_Tarixi=$VezifeteyinCek['Vezifeye_Teyin_Etme_Tarixi'];

										$StadDeyisikliSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID order by Vezifeye_Teyin_Etme_Tarixi DESC");
										$StadDeyisikliSor->execute(array(
											'ID'=>$Vezife_Cek['User_Id']));
										$StadDeyisikliCek=$StadDeyisikliSor->fetch(PDO::FETCH_ASSOC);
										$VezifeyeTarixi=$StadDeyisikliCek['Vezifeye_Teyin_Etme_Tarixi'];

										if ($Ise_Qebul_Tarixi_beynelxalq>$Vezifeye_Teyin_Etme_Tarixi and $Ise_Qebul_Tarixi_beynelxalq>$VezifeyeTarixi) {
											$Tarix=$Ise_Qebul_Tarixi_beynelxalq;
										}elseif($Vezifeye_Teyin_Etme_Tarixi>$Ise_Qebul_Tarixi_beynelxalq and $Vezifeye_Teyin_Etme_Tarixi>$VezifeyeTarixi){
											$Tarix=$Vezifeye_Teyin_Etme_Tarixi;
										}elseif($VezifeyeTarixi>$Ise_Qebul_Tarixi_beynelxalq and $VezifeyeTarixi>$Vezifeye_Teyin_Etme_Tarixi){
											$Tarix=$VezifeyeTarixi;
										}



										$Dogum_Tarixi=Tarix_Beynelxalqi_Az_Cevir($Cek['Dogum_Tarixi']);
										$Dogum_Tarixi_beynelxalq=$Cek['Dogum_Tarixi'];
										$bugun = date("Y-m-d", $ZamanDamgasi);
										$diff = date_diff(date_create($Cek['Dogum_Tarixi']), date_create($bugun));
										$yasin=$diff->format('%y');
										$Yasayis_Unvan      =  $Cek['Yasayis_Unvan'];
										$Doguldugu_Unvan      =  $Cek['Doguldugu_Unvan'];				


										$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
										$Rutbe_Emri_Sor->execute(array(
											'ID'=>$Cek['ID']));
										$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
										if (strlen($Rutbe_Emri_Cek['Rutbe_Img'])>0) {

											$RutbeSekli='<img src="'.$Rutbe_Emri_Cek['Rutbe_Img'].'" class=" mx-auto d-block" style="width:96px;height: 100px;" alt="...">';
										}else{		

											$RutbeSekli='<img src="Senedler/Rutbe/nophoto.png" class="rounded mx-auto d-block" style="width:100px;height: 100px;" alt="...">';
										}
										
										$Atest_Sor=$db->prepare("SELECT * FROM  attestasiya_emri where ID=:ID order by Attestasiya_Tarix DESC ");
										$Atest_Sor->execute(array(
											'ID'=>$Cek['ID']));
										$Atest_Say=$Atest_Sor->rowCount();
										if ($Atest_Say) {	
											while ($Atest_Cek=$Atest_Sor->fetch(PDO::FETCH_ASSOC)) {
												if ($Atest_Cek['Attestasiya_Qerar']==0) {
													$Attestasiya_Qerar="Tutduğu vəzifəyə uyğundur";
													$qerar="Tutduğu vəzifəyə uyğundur";
												}elseif ($Atest_Cek['Attestasiya_Qerar']==1) {
													$Attestasiya_Qerar="İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur";
													$qerar="İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur";
												}elseif ($Atest_Cek['Attestasiya_Qerar']==2) {
													$Attestasiya_Qerar="Tutduğu vəzifəyə uyğun deyil";
													$qerar="Tutduğu vəzifəyə uyğun deyil";
												}
												?>

												<tr class="vertikalmidle">
													<td class="textaligncenter"><?php echo $Vezife_Cek['User_Id']>0 ? $Vezife_Cek['User_Id']:"";?></td>
													<?php if ($Vezife_Cek['User_Id']>0) {?>
														<td style="padding: 0; cursor: pointer;" ><a href="<?php echo "personal-".$Cek['Seo_Url']."-".$Cek['ID'] ?>" target="_blank"><?php echo $RutbeSekli ?></a></td>
													<?php   }else{?>
														<td></td>
													<?php 	} ?>

													<td><?php echo $Soy_Adi ?></td>
													<td><?php echo $Ad ?></td>
													<td><?php echo $Ata_Adi ?></td>
													<td class="textaligncenter"><?php echo IdareQissaAdi($Islediyi_Idare_Id, $db) ?></td>
													<td class="textaligncenter" style="word-break: break-word;"><?php echo  SobeAdi($Islediyi_Sobe_Id, $db) ?></td>
													<td class="textaligncenter"><?php echo VezifeAdi($Vezife_Id, $db) ?></td>	

													<td class="textaligncenter" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Atest_Cek['Idare_Adi'] ?></td>
													<td class="textaligncenter" style="word-break: break-word;"><?php echo $Atest_Cek['Sobe_Ad'] ?></td>
													<td class="textaligncenter"><?php echo $Atest_Cek['Vezife_Ad'] ?></td>	
													<td data-sort="<?php echo $Atest_Cek['Attestasiya_Tarix'] ?>" class="textaligncenter"><?php echo date("d.m.Y",strtotime($Atest_Cek['Attestasiya_Tarix']))?></td>									
													<td data-sort="<?php echo $Atest_Cek['Attestasiya_Tarix_Novbeti']?>" class="textaligncenter"><?php echo date("d.m.Y",strtotime($Atest_Cek['Attestasiya_Tarix_Novbeti']))?></td>

													<td data-sort="<?php echo $qerar ?>"><?php echo $Attestasiya_Qerar ?></td>		
													<td class="textaligncenter"><?php echo $Atest_Cek['Topladigi_Bal']?></td>
													<td class="textaligncenter"><?php echo $Atest_Cek['Qiymetlendirme_Bali']?></td>																			
												</tr>
											<?php } 
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
	TarixFormati();
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

	function QerarAxtar () {
		$('#dataTable').DataTable().column(13).search(
			$('#QerarAxtarir').val()
			).draw();
	}

/*	function VakanAxtarir () {
		if ($('#VakanAxtarir').val()=="Tutduğu vəzifəyə uyğundur") {
			$('#dataTable').DataTable().column(10).search(
				$('#VakanAxtarir').val()
				).draw();
		}	else if ($('#VakanAxtarir').val()=="İşini yaxşılaşdırarsa və komissiyanın tövsiyələrini yerinə yetirərsə,1 ildən sonra təkrar attestasiyadan keçmək şərti ilə tutduğu vəzifəyə uyğundur") {
			$('#dataTable').DataTable().column(10).search(
				$('#VakanAxtarir').val()
				).draw();
		}else if ($('#VakanAxtarir').val()=="Tutduğu vəzifəyə uyğun deyil") {
			$('#dataTable').DataTable().column(10).search(
				$('#VakanAxtarir').val()
				).draw();
		}
		else if($('#VakanAxtarir').val()=="1"){
			$('#dataTable').DataTable().column(10).search(
				'^((?!Vakand).)*$', true, false
				).draw();
		}
		else{
			$('#dataTable').DataTable().column(10).search(
				$('#VakanAxtarir').val()
				).draw();
		}

	}*/

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
		$('#QerarAxtarir').on( 'change', function () {
			QerarAxtar();
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



  function AtestasiyaVaxdicatanlar(){

  	var tarixbaslagic=document.getElementById("tarixbaslagic");
  	if(tarixbaslagic.value === '') {
  		error(tarixbaslagic);
  		return;
  	}
  	var deyer=Tedbiq_Edildiyi_Tarix.value;
  	document.getElementById("yuklemealanikapsayici").style.display = "block";
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "Atestasiya/Atastasiya_Axtarisi.php", true);
  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send("Deyer=" + deyer);
  	xhttp.onreadystatechange = function (deyer) {
  		if (this.readyState == 4 && this.status == 200) {
  			document.getElementById("yuklemealanikapsayici").style.display = "none";
  			var data=this.responseText.trim();    
  			document.getElementById("AtestasiyaIci").innerHTML="";
  			document.getElementById("AtestasiyaIci").innerHTML=data; 
  			
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


  function AtestasiyaTarixAraligi(){

  	var tarixbaslagic=document.getElementById("tarixbaslagic");
  	var tarixbitis=document.getElementById("tarixbitis");

  	if(tarixbaslagic.value === '') {
  		error(tarixbaslagic);
  		return;
  	}  
  	if(tarixbitis.value === '') {
  		error(tarixbitis);
  		return;
  	}
  	var tarixbasl=tarixbaslagic.value.split(".")
  	var tarixson=tarixbitis.value.split(".")

  	var BaslanmaTarixi = new Date(tarixbasl[2]+"-"+tarixbasl[1]+"-"+tarixbasl[0]).getTime();
  	var SonTarixi = new Date(tarixson[2]+"-"+tarixson[1]+"-"+tarixson[0]).getTime();
  	if (BaslanmaTarixi>SonTarixi) {
  		alert("Tarix aralığı düzgün deyil");
  		return;
  	}
  	var deyer = {
  		tarixbaslagic:tarixbaslagic.value,
  		tarixbitis:tarixbitis.value
  	};
  	var gonderilen=JSON.stringify(deyer);
  	document.getElementById("yuklemealanikapsayici").style.display = "block";
  	var xhttp = new XMLHttpRequest();
  	xhttp.open("POST", "Atestasiya/Atastasiya_Araliq_Axtarisi.php", true);
  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send("Deyer=" + gonderilen);
  	xhttp.onreadystatechange = function (deyer) {
  		if (this.readyState == 4 && this.status == 200) {
  			document.getElementById("yuklemealanikapsayici").style.display = "none";
  			var data=this.responseText.trim();    
  			document.getElementById("AtestasiyaIci").innerHTML="";
  			document.getElementById("AtestasiyaIci").innerHTML=data; 
  			
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