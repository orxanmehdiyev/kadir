<?php require_once '_header.php';?>
<script type="text/javascript" src="Sertifikat/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row"><form class="row">					
				<div class="col-2">
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
						<option disabled="disabled" selected></option>
						<?php while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {?>
							<option value="<?php echo $Sobe_Cek['Sobe_Ad'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
						<?php } ?>
					</select>
				</div>				
				<div class="col-1">
					<label for="NovuAxtarir" class="form-label">Növü</label>
					<select id="NovuAxtarir" class="form-select">
						<option value="" selected="selected"></option>
						<option value="Seminar" >Seminar</option>
						<option value="Təlim" >Təlim</option>								
					</select>
				</div>		

				<div class="col-1">
					<label for="NeticeAxtarir" class="form-label">Netice</label>
					<select id="NeticeAxtarir" class="form-select">
						<option value="" selected="selected"></option>
						<option value="Yüksək">Yüksək</option>
						<option value="Məqbul">Məqbul</option>								
						<option value="Qeyrimeqbul">Qeyrimeqbul</option>								
					</select>
				</div> 

				<div class="col-4">		
					<input  type="text" class="form-select tarix mezuniyyettarix" style="float: left; margin-top: 24px; " placeholder="__.__._____" id="tarixbaslagic" oninput="TarixAlaniYazildi(this.id)" autocomplete="off" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" onchange="TarixAlaniYazildi(this.id)"  required="required" maxlength="10" tabindex="4" title="">				
					<input  type="text" class="form-select tarix mezuniyyettarix" style="float: left; margin-top: 24px; border-left: none; border-radius: 0;"  id="tarixbitis" oninput="TarixAlaniYazildi(this.id)" onchange="TarixAlaniYazildi(this.id)" autocomplete="off" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"   required="required" maxlength="10" tabindex="4" title="" placeholder="__.__._____">		
					<button type="button" style="margin-top: 24px; " onclick="SetifikatTarixAraligi()" class="mezuniyyethesabla" tabindex="15" title="">Axtar</button>		
				</div>
			</form></div>
		</div>		
		
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM  sertifikat order by Sertifikat_Emir_Tarix DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Adı,soyadı,ataadı</th>									
									<th>Sertifikatın növü</th>
									<th>Təlim/seminarın adı</th>
									<th>Nəticə</th>
									<th>Sertifikatın №</th>
									<th>Sert/tarix</th>						
									<th>İdarə</th>						
									<th>Sturuktur bölmə</th>						
									<th>Vəzifə</th>						
									<th>Rütbə</th>						
									<th>Əmr №</th>						
									<th>Əmrin tarixi</th>						
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php	while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { 
									if ($Cek['Sertifikat_Novu']==0) {
										$Sertifikat_Novu="Təlim";
									}elseif ($Cek['Sertifikat_Novu']==1) {
										$Sertifikat_Novu="Seminar";
									}

									if ($Cek['Sertifikat_Qiymetlendirme']==0) {
										$Sertifikat_Qiymetlendirme="Yüksək";
									}elseif ($Cek['Sertifikat_Qiymetlendirme']==1) {
										$Sertifikat_Qiymetlendirme="Məqbul";
									}elseif ($Cek['Sertifikat_Qiymetlendirme']==2) {
										$Sertifikat_Qiymetlendirme="Qeyrimeqbul";
									}

									$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
									$User_Sor->execute(array(
										'ID'=>$Cek['ID'],
										'Durum'=>1));
									$User_Say=$User_Sor->rowCount();
									$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
									$Idare_Id=$User_Cek['Islediyi_Idare_Id'];						
									$Sobe_Id=$User_Cek['Islediyi_Sobe_Id'];
									$Vezife_Id=$User_Cek['Vezife_Id'];				

									?>
									<tr>	
										<td><?php echo  AdiSoyadiAtaadi($Cek['ID'], $db);	?></td>
										<td><?php echo $Sertifikat_Novu ?></td>
										<td><?php echo $Cek['Telim_Seminar_Adi'] ?></td>
										<td><?php echo $Sertifikat_Qiymetlendirme ?></td>									
										<td><?php echo $Cek['Sertifikat_No'] ?></td>
										<td ata-sort="<?php echo $Cek['Sertifikat_Verilme_Tarix'] ?>"><?php echo date("d.m.Y",strtotime($Cek['Sertifikat_Verilme_Tarix']))?></td>
										<td><?php echo  IdareQissaAdi($Idare_Id, $db);	?></td>
										<td><?php echo  SobeAdi($Sobe_Id, $db);	?></td>
										<td><?php echo  VezifeAdi($Vezife_Id, $db);	?></td>
										<td><?php echo  RutbeAdi($Cek['ID'], $db);	?></td>
										<td><?php echo $Cek['Sertifikat_Emir_No'] ?></td>					
										<td ata-sort="<?php echo $Cek['Sertifikat_Emir_Tarix'] ?>"><?php echo date("d.m.Y",strtotime($Cek['Sertifikat_Emir_Tarix']))?></td>															

									</tr>	
								<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada sertifikat əmri yoxdur
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
</div>
<?php require_once '_footer.php';?>
<script> 
	CedveliCagir("dataTable");

	function SetifikatTarixAraligi(){

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
  	xhttp.open("POST", "Sertifikat/Sertifikat_Araliq_Axtarisi.php", true);
  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send("Deyer=" + gonderilen);
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
