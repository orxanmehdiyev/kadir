<?php require_once '_header.php';?>	
<?php 	
$dosya = fopen('text/ddd.txt','r');
$deyer=0;
while($oku = fgets($dosya)){
	$bir=explode(",",$oku);
	$formatek_id=$bir[0];
	$ID=$bir[1];
	$iki=explode(" ",$bir[2]);
	$uc=explode("/",$iki[1]);
	$Tarix=$uc[0]."-".$uc[1]."-".$uc[2];
	$Saat=$iki[2];
	$DavamSor=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix");
	$DavamSor->execute(array(
		'ID'=>$ID,
		'Tarix'=>$Tarix
	));
	$DavamSay=$DavamSor->rowCount();
	if ($DavamSay>0) {
		$dd=$DavamSay%2;
		if ($dd==0) {
			$istiqamet=1;
		}else{
			$istiqamet=0;
		}
	}else{
		$istiqamet=1;
	}

	$sayyoxla=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix and Saat=:Saat");
	$sayyoxla->execute(array(
		'ID'=>$ID,
		'Tarix'=>$Tarix,
		'Saat'=>$Saat
	));
	$saysay=$sayyoxla->rowCount();

	$usersor=$db->prepare("SELECT * FROM user where ID=:ID");
	$usersor->execute(array(
		'ID'=>$ID
	));
	$usercek=$usersor->fetch(PDO::FETCH_ASSOC);
	$Idare_Id=$usercek['Islediyi_Idare_Id'];
	$Idare_Ad=$usercek['Idare_Ad'];
	
	if ($saysay==0) {
		$Elave_Et=$db->prepare("INSERT INTO isedavamiyyet SET
			formatek_id=:formatek_id,
			ID=:ID,
			Tarix=:Tarix,
			Saat=:Saat,
			Idare_Id=:Idare_Id,
			Idare_Ad=:Idare_Ad,
			istiqamet=:istiqamet
			");
		$Insert=$Elave_Et->execute(array(
			'formatek_id'=>$formatek_id,
			'ID'=>$ID,
			'Tarix'=>$Tarix,
			'Saat'=>$Saat,
			'Idare_Id'=>$Idare_Id,
			'Idare_Ad'=>$Idare_Ad,
			'istiqamet'=>$istiqamet
		));
	}
}
fclose($dosya);
	/*$dosya = fopen('text/ddd.txt','w+');
	fclose($dosya);*/
	?>
	<script type="text/javascript">
		document.getElementById("SeyfeAdi").innerHTML = "";
		document.getElementById("SeyfeAdi").innerHTML = "Davamiyyət";
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
							</form>	
						</div> 
					</div>	
					<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">	
							<thead class="sabit">							
								<tr class="textaligncenter" >
									<th>Soyadı Adı Atasının adı</th>							
									<th>İdarə</th>							
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>							
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>	
									<th>Giriş</th>
									<th>Çıxış</th>	
									<th>Giriş</th>
									<th>Çıxış</th>
									<th>Giriş</th>
									<th>Çıxış</th>			
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
										$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
										$Vezife_Sor->execute(array(
											'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
											'Vezife_Adlari_Durum'=>1));									
										while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
											if ($Vezife_Cek['User_Id']>0) {			?>
												<tr>	
													<?php 
													$yoxalanis=0;
													$GirisSaati="";
													$isqrafikSor=$db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
													$isqrafikSor->execute(array(
														'ID'=>$Vezife_Cek['User_Id']
													));								
													$IsQrafikiCek=$isqrafikSor->fetch(PDO::FETCH_ASSOC);
													$Is_Rejimi=$IsQrafikiCek['Is_Rejimi'];
													if ($Is_Rejimi==1) {
														$GirisSaati=$IsQrafikiCek['Is_Giris_Saati'];
														$isgunu=TeqvimQeyriIsGunuYoxla($Tarix_Beynelxalq, $db);
														if ($isgunu==1) {
															$MezSor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Baslagic_Tarixi<=:Baslagic_Tarixi and Bitis_Tarixi>=:Bitis_Tarixi ");
															$MezSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$MezSay=$MezSor->rowCount();
															if ($MezSay==1) {
																$yoxalanis=1;//mezuniyyetde
															}
															$EzaSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID and Ezam_Baslangic_Tarixi<=:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>=:Ezam_Bitis_Tarixi ");
															$EzaSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Ezam_Baslangic_Tarixi'=>$Tarix_Beynelxalq,
																'Ezam_Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$EzaSay=$EzaSor->rowCount();
															if ($EzaSay==1) {
																$yoxalanis=2;//Ezam
															}
															$XesSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID and Xestelik_Baslagic_Tarixi<=:Xestelik_Baslagic_Tarixi and Xestelik_Ise_Cixma_Tarixi>=:Xestelik_Ise_Cixma_Tarixi ");
															$XesSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Xestelik_Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Xestelik_Ise_Cixma_Tarixi'=>$Tarix_Beynelxalq
															));								
															$XesSay=$XesSor->rowCount();
															if ($XesSay==1) {
																$yoxalanis=3;//Xeste
															}
														}
														$YoxlanisSor=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix order by Tarix ASC, isedavamiyyet_id ASC");
														$YoxlanisSor->execute(array(
															'ID'=>$Vezife_Cek['User_Id'],
															'Tarix'=>$Tarix_Beynelxalq
														));
														$YoxlanisSay=$YoxlanisSor->rowCount();
														$YoxlanisCek=$YoxlanisSor->fetch(PDO::FETCH_ASSOC);
														if ($YoxlanisSay>0) {
															$saat=$YoxlanisCek['Saat'];
														}else{
															$saat="";
														}
													}elseif($Is_Rejimi==2){
														$GirisSaati=$IsQrafikiCek['Is_Giris_Saati'];
														$HefdeGun     = date("w", strtotime($Tarix_Beynelxalq));
														if ($HefdeGun==0) {
															$yeddi=$IsQrafikiCek['yeddi'];
															if ($yeddi==0) {
																$yoxalanis=4;
															}
														}elseif($HefdeGun==1){
															$bir=$IsQrafikiCek['bir'];
															if ($bir==0) {
																$yoxalanis=4;
															}
														}elseif($HefdeGun==2){
															$iki=$IsQrafikiCek['iki'];
															if ($iki==0) {
																$yoxalanis=4;
															}
														}elseif($HefdeGun==3){
															$uc=$IsQrafikiCek['uc'];
															if ($uc==0) {
																$yoxalanis=4;
															}
														}elseif($HefdeGun==4){
															$dord=$IsQrafikiCek['dord'];
															if ($dord==0) {
																$yoxalanis=4;
															}
														}elseif($HefdeGun==5){
															$bes=$IsQrafikiCek['bes'];
															if ($bes==0) {
																$yoxalanis=4;
															}
														}elseif($HefdeGun=6){
															$alti=$IsQrafikiCek['alti'];
															if ($alti==0) {
																$yoxalanis=4;
															}
														}

														$MezSor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Baslagic_Tarixi<=:Baslagic_Tarixi and Bitis_Tarixi>=:Bitis_Tarixi ");
														$MezSor->execute(array(
															'ID'=>$Vezife_Cek['User_Id'],
															'Baslagic_Tarixi'=>$Tarix_Beynelxalq,
															'Bitis_Tarixi'=>$Tarix_Beynelxalq
														));								
														$MezSay=$MezSor->rowCount();
														if ($MezSay==1) {
																$yoxalanis=1;//mezuniyyetde
															}
															$EzaSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID and Ezam_Baslangic_Tarixi<=:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>=:Ezam_Bitis_Tarixi ");
															$EzaSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Ezam_Baslangic_Tarixi'=>$Tarix_Beynelxalq,
																'Ezam_Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$EzaSay=$EzaSor->rowCount();
															if ($EzaSay==1) {
																$yoxalanis=2;//Ezam
															}
															$XesSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID and Xestelik_Baslagic_Tarixi<=:Xestelik_Baslagic_Tarixi and Xestelik_Ise_Cixma_Tarixi>=:Xestelik_Ise_Cixma_Tarixi ");
															$XesSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Xestelik_Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Xestelik_Ise_Cixma_Tarixi'=>$Tarix_Beynelxalq
															));								
															$XesSay=$XesSor->rowCount();
															if ($XesSay==1) {
																$yoxalanis=3;//Xeste
															}
															$YoxlanisSor=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix order by Tarix ASC, isedavamiyyet_id ASC");
															$YoxlanisSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Tarix'=>$Tarix_Beynelxalq
															));
															$YoxlanisSay=$YoxlanisSor->rowCount();
															$YoxlanisCek=$YoxlanisSor->fetch(PDO::FETCH_ASSOC);
															if ($YoxlanisSay>0) {
																$saat=$YoxlanisCek['Saat'];
															}else{
																$saat="";
															}
														}elseif($Is_Rejimi==3){
															
															$Novbe_Sayi=$IsQrafikiCek['Novbe_Sayi'];
															if($Novbe_Sayi==2){
																$GirisSaati=$IsQrafikiCek['Is_Giris_Saati'];
																$baslagic="2022-01-01";
																$ikideyer=0;

																for ($i=$baslagic; $i <= $Tarix_Beynelxalq ; $i=Traix_Uzerine_Gel($i,1, "day")) { 
																	if ($ikideyer==1 ) {
																		if ($IsQrafikiCek['Is_Qurupu']==1) {																			
																			$yoxalanis=0;
																		}else{
																			$yoxalanis=4;
																		}
																		$ikideyer=0;
																	}else{
																		if ($IsQrafikiCek['Is_Qurupu']==2) {																			
																			$yoxalanis=0;
																		}else{
																			$yoxalanis=4;
																		}
																		$ikideyer=1;
																	}									
																}

																$MezSor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Baslagic_Tarixi<=:Baslagic_Tarixi and Bitis_Tarixi>=:Bitis_Tarixi ");
																$MezSor->execute(array(
																	'ID'=>$Vezife_Cek['User_Id'],
																	'Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																	'Bitis_Tarixi'=>$Tarix_Beynelxalq
																));								
																$MezSay=$MezSor->rowCount();
																if ($MezSay==1) {
																$yoxalanis=1;//mezuniyyetde
															}
															$EzaSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID and Ezam_Baslangic_Tarixi<=:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>=:Ezam_Bitis_Tarixi ");
															$EzaSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Ezam_Baslangic_Tarixi'=>$Tarix_Beynelxalq,
																'Ezam_Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$EzaSay=$EzaSor->rowCount();
															if ($EzaSay==1) {
																$yoxalanis=2;//Ezam
															}
															$XesSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID and Xestelik_Baslagic_Tarixi<=:Xestelik_Baslagic_Tarixi and Xestelik_Ise_Cixma_Tarixi>=:Xestelik_Ise_Cixma_Tarixi ");
															$XesSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Xestelik_Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Xestelik_Ise_Cixma_Tarixi'=>$Tarix_Beynelxalq
															));								
															$XesSay=$XesSor->rowCount();
															if ($XesSay==1) {
																$yoxalanis=3;//Xeste
															}
															$YoxlanisSor=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix order by Tarix ASC, isedavamiyyet_id ASC");
															$YoxlanisSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Tarix'=>$Tarix_Beynelxalq
															));
															$YoxlanisSay=$YoxlanisSor->rowCount();
															$YoxlanisCek=$YoxlanisSor->fetch(PDO::FETCH_ASSOC);
															if ($YoxlanisSay>0) {
																$saat=$YoxlanisCek['Saat'];
															}else{
																$saat="";
															}



														}elseif($Novbe_Sayi==3){
															$GirisSaati=$IsQrafikiCek['Is_Giris_Saati'];
															$baslagic="2022-01-01";
															$ikideyer=0;
															for ($i=$baslagic; $i <= $Tarix_Beynelxalq ; $i=Traix_Uzerine_Gel($i,1, "day")) { 
																$ikideyer++;
																if ($ikideyer==1 ) {
																	if ($IsQrafikiCek['Is_Qurupu']==1) {																			
																		$yoxalanis=0;
																	}else{
																		$yoxalanis=4;
																	}																	
																}	elseif ($ikideyer==2 ) {
																	if ($IsQrafikiCek['Is_Qurupu']==2) {																			
																		$yoxalanis=0;
																	}else{
																		$yoxalanis=4;
																	}																
																}	elseif ($ikideyer==3 ) {
																	if ($IsQrafikiCek['Is_Qurupu']==3) {																			
																		$yoxalanis=0;
																	}else{
																		$yoxalanis=4;
																	}		
																	$ikideyer=0;														
																}
															}

															$MezSor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Baslagic_Tarixi<=:Baslagic_Tarixi and Bitis_Tarixi>=:Bitis_Tarixi ");
															$MezSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$MezSay=$MezSor->rowCount();
															if ($MezSay==1) {
																$yoxalanis=1;//mezuniyyetde
															}
															$EzaSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID and Ezam_Baslangic_Tarixi<=:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>=:Ezam_Bitis_Tarixi ");
															$EzaSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Ezam_Baslangic_Tarixi'=>$Tarix_Beynelxalq,
																'Ezam_Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$EzaSay=$EzaSor->rowCount();
															if ($EzaSay==1) {
																$yoxalanis=2;//Ezam
															}
															$XesSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID and Xestelik_Baslagic_Tarixi<=:Xestelik_Baslagic_Tarixi and Xestelik_Ise_Cixma_Tarixi>=:Xestelik_Ise_Cixma_Tarixi ");
															$XesSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Xestelik_Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Xestelik_Ise_Cixma_Tarixi'=>$Tarix_Beynelxalq
															));								
															$XesSay=$XesSor->rowCount();
															if ($XesSay==1) {
																$yoxalanis=3;//Xeste
															}
															$YoxlanisSor=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix order by Tarix ASC, isedavamiyyet_id ASC");
															$YoxlanisSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Tarix'=>$Tarix_Beynelxalq
															));
															$YoxlanisSay=$YoxlanisSor->rowCount();
															$YoxlanisCek=$YoxlanisSor->fetch(PDO::FETCH_ASSOC);
															if ($YoxlanisSay>0) {
																$saat=$YoxlanisCek['Saat'];
															}else{
																$saat="";
															}
														}elseif($Novbe_Sayi==4){

															$baslagic="2022-01-01";
															$ikideyer=0;
															for ($i=$baslagic; $i <= $Tarix_Beynelxalq ; $i=Traix_Uzerine_Gel($i,1, "day")) { 
																$ikideyer++;
																if ($ikideyer==1 ) {
																	if ($IsQrafikiCek['Is_Qurupu']==1) {	
																		$GirisSaati=$IsQrafikiCek['Gunduz'];																		
																		$yoxalanis=0;
																	}elseif ($IsQrafikiCek['Is_Qurupu']==4) {	
																		$GirisSaati=$IsQrafikiCek['Gece'];																		
																		$yoxalanis=0;
																	}else{
																		$yoxalanis=4;
																	}																	
																}	elseif ($ikideyer==2 ) {
																	if ($IsQrafikiCek['Is_Qurupu']==2) {	
																		$GirisSaati=$IsQrafikiCek['Gunduz'];																		
																		$yoxalanis=0;
																	}elseif ($IsQrafikiCek['Is_Qurupu']==1) {	
																		$GirisSaati=$IsQrafikiCek['Gece'];																		
																		$yoxalanis=0;
																	}else{
																		$yoxalanis=4;
																	}																
																}	elseif ($ikideyer==3 ) {
																	if ($IsQrafikiCek['Is_Qurupu']==3) {
																		$GirisSaati=$IsQrafikiCek['Gunduz'];																			
																		$yoxalanis=0;
																	}elseif ($IsQrafikiCek['Is_Qurupu']==2) {	
																		$GirisSaati=$IsQrafikiCek['Gece'];																		
																		$yoxalanis=0;
																	}else{
																		$yoxalanis=4;
																	}		

																}elseif ($ikideyer==4 ) {
																	if ($IsQrafikiCek['Is_Qurupu']==4) {	
																		$GirisSaati=$IsQrafikiCek['Gunduz'];																		
																		$yoxalanis=0;
																	}elseif ($IsQrafikiCek['Is_Qurupu']==3) {	
																		$GirisSaati=$IsQrafikiCek['Gece'];																		
																		$yoxalanis=0;
																	}else{
																		$yoxalanis=4;
																	}		
																	$ikideyer=0;														
																}
															}

															$MezSor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Baslagic_Tarixi<=:Baslagic_Tarixi and Bitis_Tarixi>=:Bitis_Tarixi ");
															$MezSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$MezSay=$MezSor->rowCount();
															if ($MezSay==1) {
																$yoxalanis=1;//mezuniyyetde
															}
															$EzaSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID and Ezam_Baslangic_Tarixi<=:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>=:Ezam_Bitis_Tarixi ");
															$EzaSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Ezam_Baslangic_Tarixi'=>$Tarix_Beynelxalq,
																'Ezam_Bitis_Tarixi'=>$Tarix_Beynelxalq
															));								
															$EzaSay=$EzaSor->rowCount();
															if ($EzaSay==1) {
																$yoxalanis=2;//Ezam
															}
															$XesSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID and Xestelik_Baslagic_Tarixi<=:Xestelik_Baslagic_Tarixi and Xestelik_Ise_Cixma_Tarixi>=:Xestelik_Ise_Cixma_Tarixi ");
															$XesSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Xestelik_Baslagic_Tarixi'=>$Tarix_Beynelxalq,
																'Xestelik_Ise_Cixma_Tarixi'=>$Tarix_Beynelxalq
															));								
															$XesSay=$XesSor->rowCount();
															if ($XesSay==1) {
																$yoxalanis=3;//Xeste
															}
															$YoxlanisSor=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix order by Tarix ASC, isedavamiyyet_id ASC");
															$YoxlanisSor->execute(array(
																'ID'=>$Vezife_Cek['User_Id'],
																'Tarix'=>$Tarix_Beynelxalq
															));
															$YoxlanisSay=$YoxlanisSor->rowCount();
															$YoxlanisCek=$YoxlanisSor->fetch(PDO::FETCH_ASSOC);
															if ($YoxlanisSay>0) {
																$saat=$YoxlanisCek['Saat'];
															}else{
																$saat="";
															}

														}
													}

													?>				

													<td 
													<?php 
													if ($Is_Rejimi==1) {
														if ($yoxalanis==1) {
															echo 'class="mezuniyyet"';
														}elseif($yoxalanis==2){
															echo 'class="ezamiyye"';
														}
														elseif($yoxalanis==3){
															echo 'class="xesde"';
														}
														elseif($yoxalanis==0){		
															if ($saat>0) {
																if ( $saat > $GirisSaati) {
																	echo 'class="qirmiziyadusdu"';
																}																	
															}										
															else{
																if($Saat_Beynelxalq > $GirisSaati){
																	echo 'class="qirmiziyadusdu"';
																}

															}

														}
													}
													elseif($Is_Rejimi==2){
														if ($yoxalanis==1) {
															echo 'class="mezuniyyet"';
														}elseif($yoxalanis==2){
															echo 'class="ezamiyye"';
														}
														elseif($yoxalanis==3){
															echo 'class="xesde"';
														}elseif($yoxalanis==4){
															echo 'class=""';
														}	elseif($yoxalanis==0){																
															if ($saat>0) {
																if ( $saat > $GirisSaati) {
																	echo 'class="qirmiziyadusdu"';
																}																	
															}										
															else{
																if($Saat_Beynelxalq > $GirisSaati){
																	echo 'class="qirmiziyadusdu"';
																}

															}


														}
													}elseif($Is_Rejimi==3){
														if($Novbe_Sayi==2){
															if ($yoxalanis==1) {
																echo 'class="mezuniyyet"';
															}elseif($yoxalanis==2){
																echo 'class="ezamiyye"';
															}
															elseif($yoxalanis==3){
																echo 'class="xesde"';
															}elseif($yoxalanis==4){
																echo 'class=""';
															}	elseif($yoxalanis==0){
																if ($saat>"00:00:01") {															
																	if ( $saat > $GirisSaati) {
																		echo 'class="qirmiziyadusdu"';
																	}																	
																}										
																else{
																	if($Saat_Beynelxalq > $GirisSaati){
																		echo 'class="qirmiziyadusdu"';
																	}																
																}
															}
														}elseif($Novbe_Sayi==3){
															if ($yoxalanis==1) {
																echo 'class="mezuniyyet"';
															}elseif($yoxalanis==2){
																echo 'class="ezamiyye"';
															}
															elseif($yoxalanis==3){
																echo 'class="xesde"';
															}elseif($yoxalanis==4){
																echo 'class=""';
															}	elseif($yoxalanis==0){
																if ($saat>"00:00:01") {															
																	if ( $saat > $GirisSaati) {
																		echo 'class="qirmiziyadusdu"';
																	}																	
																}										
																else{
																	if($Saat_Beynelxalq > $GirisSaati){
																		echo 'class="qirmiziyadusdu"';
																	}																
																}
															}
														}elseif($Novbe_Sayi==4){
															if ($yoxalanis==1) {
																echo 'class="mezuniyyet"';
															}elseif($yoxalanis==2){
																echo 'class="ezamiyye"';
															}
															elseif($yoxalanis==3){
																echo 'class="xesde"';
															}elseif($yoxalanis==4){
																echo 'class=""';
															}	elseif($yoxalanis==0){
																if ($saat>"00:00:01") {															
																	if ( $saat > $GirisSaati) {
																		echo 'class="qirmiziyadusdu"';
																	}																	
																}										
																else{
																	if($Saat_Beynelxalq > $GirisSaati){
																		echo 'class="qirmiziyadusdu"';
																	}																
																}
															}
														}
													}
													?>


													><?php echo AdiSoyadiAtaadi($Vezife_Cek['User_Id'],$db) ?></td>
													<td><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></td>
													<?php 
													$DavamSor=$db->prepare("SELECT * FROM  isedavamiyyet where ID=:ID and Tarix=:Tarix");
													$DavamSor->execute(array(
														'ID'=>$Vezife_Cek['User_Id'],
														'Tarix'=>$Tarix_Beynelxalq
													));
													$DavamSay=$DavamSor->rowCount();
													while ($Davamcek=$DavamSor->fetch(PDO::FETCH_ASSOC)) { ?>	

														<td><?php echo $Davamcek['Saat'] ?></td>
													<?php } ?>					
													<?php 
													$sayi=25-$DavamSay;
													for ($i=0; $i <= $sayi; $i++) { 
														echo "<td></td>";
													}
													?>
												</tr>
											<?php 	}	else{}										
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
			$('#dataTable').DataTable().column(1 ).search(
				$('#IdareAxtarir').val()
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
</script>