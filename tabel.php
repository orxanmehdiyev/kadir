<?php require_once '_header.php';

$Idare_Id   =  $Islediyi_Idare_Id;
$toplusaat = cal_days_in_month(CAL_GREGORIAN, $Ay_tap, $Il_tap);
$songun = cal_days_in_month(CAL_GREGORIAN, $Ay_tap, $Il_tap);
$ilkgun =01;
$Ayin_Ilk_Gunu=$Il_tap."-".$Ay_tap."-".$ilkgun;
$Ayin_Son_Gunu=$Il_tap."-".$Ay_tap."-".$toplusaat;

$Baslangic_TRH = strtotime($Ayin_Ilk_Gunu); // başlangıç tarihi
$Bitis_TRH   = strtotime($Ayin_Son_Gunu);	// bitiş tarihi
?>
<style type="text/css">
	@page { size: auto; 
		margin-top: 20px;
		margin-bottom: 20px;
		margin-left: 7px;
		margin-right: 7px;
	}
	@media print {
		body * {
			visibility: hidden;
		}
		#icerik, #icerik * {
			visibility: visible;
		}
		#icerik {
			position: absolute;
			left: 0;
			top: -115;
		}
	}

	#tabel {		
		counter-reset: siara-no -2;
	}
	#tabel tr {
		counter-increment: siara-no ;
	}
	#tabel tr td:first-child::before {
		content: counter(siara-no);
		text-align: center;
	}
</style>
<script type="text/javascript" src="Tabel_Islenmesi/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2 row">
						<div class="col-1" style="width: 135px;">
							<label for="TabelAy	" class="form-label">Ay<span class="KirmiziYazi">*</span></label>
							<select id="TabelAy" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">					
								<option <?php echo $Ay_tap=="01"?"selected='selected'":"" ?> value="01">Yanvar</option>
								<option <?php echo $Ay_tap=="02"?"selected='selected'":"" ?>value="02">Fevral</option>							
								<option <?php echo $Ay_tap=="03"?"selected='selected'":"" ?> value="03">Mart</option>							
								<option <?php echo $Ay_tap=="04"?"selected='selected'":"" ?> value="04">Aprel</option>							
								<option <?php echo $Ay_tap=="05"?"selected='selected'":"" ?> value="05">May</option>							
								<option <?php echo $Ay_tap=="06"?"selected='selected'":"" ?> value="06">İyun</option>							
								<option <?php echo $Ay_tap=="07"?"selected='selected'":"" ?> value="07">İyul</option>							
								<option <?php echo $Ay_tap=="08"?"selected='selected'":"" ?> value="08">Avqust</option>							
								<option <?php echo $Ay_tap=="09"?"selected='selected'":"" ?> value="09">Sentyabr</option>							
								<option <?php echo $Ay_tap=="10"?"selected='selected'":"" ?> value="10">Oktyabr</option>							
								<option <?php echo $Ay_tap=="11"?"selected='selected'":"" ?> value="11">Noyabr</option>							
								<option <?php echo $Ay_tap=="12"?"selected='selected'":"" ?> value="12">Dekabr</option>							
							</select>
						</div>	
						<div class="col-1">
							<label for="TabelIl	" class="form-label">İl<span class="KirmiziYazi">*</span></label>
							<select id="TabelIl" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">
								<?php 
								for ($i=$Il_tap; $i >$Il_tap-5 ; $i--) { 
									echo "<option value=".$i.">".$i."</option>";
								} ?>	
							</select>
						</div>	

						<div class="col-2">
							<label for="Idare_Id	" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
							<select id="Idare_Id" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id),ImzalayanTelebEt(this.id),Tesdiqedentelebet(this.id)" title="">					
								<?php 
								$Idare_Sor=$db->prepare("SELECT * FROM idare order by Sira_No ASC ");
								$Idare_Sor->execute();
								while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) { ?>	
									<option <?php $Idare_Cek['Idare_Id']==$Idare_Id?"selected='selected'":"" ?> value="<?php echo $Idare_Cek['Idare_Id'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></option>
								<?php } ?>	
							</select>
						</div>
						<div class="col-1" style="width: 135px;">
							<label for="heyyet" class="form-label">Heyyət<span class="KirmiziYazi">*</span></label>
							<select id="heyyet" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id)" title="">					
								<option value="0">Ştat</option>;
								<option value="1">Müqavilə</option>;

							</select>
						</div>
						<div class="col-1">
							<button class="YenileButonlari buttonlabelsevyesine" onclick="TabelHazirla()">Hazırla</button>
						</div>
						<hr>
						<div class="col-2" style="text-align: justify;
						text-justify: inter-word;" >
						<label for="imzalayen	" class="form-label">İcracı<span class="KirmiziYazi">*</span></label>
						<select id="imzalayen" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id),IcraciYerineYaz(this.id)" title="">
							<option disabled="disabled" value="" selected="selected" tabindex="7"></option>	
							<?php	
							$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
							$Sobe_Sor->execute(array(
								'Durum'=>1,
								'Idare_Id'=>$Idare_Id));
							while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)){
								$Sobe_Id=$Sobe_Cek['Sobe_Id'];
								$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
								$Vezife_Sor->execute(array(
									'Durum'=>1,
									'Idare_Id'=>$Idare_Id,
									'Sobe_Id'=>$Sobe_Id,
									'User_Id'=>0));
								while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)){
									$Vezife_Id=$Vezife_Cek['Vezife_Id'];
									$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
									$User_Sor->execute(array(
										'Durum'=>1,
										'Islediyi_Idare_Id'=>$Idare_Id,
										'Islediyi_Sobe_Id'=>$Sobe_Id,
										'Vezife_Id'=>$Vezife_Id));
									$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
									$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
									$ID=$User_Cek['ID'];

									$Selahiyyet_Sor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID");
									$Selahiyyet_Sor->execute(array(				
										'ID'=>$ID));
									$Selahiyyet_Cek=$Selahiyyet_Sor->fetch(PDO::FETCH_ASSOC);
									if ($Selahiyyet_Cek['IcraciImzaSelahiyyeti']==1) {
										echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
									}
									
								}
							}
							?>
						</select>
					</div>

					<div class="col-2">
						<label for="tesdiqeden	" class="form-label">Təsdiq edən<span class="KirmiziYazi">*</span></label>
						<select id="tesdiqeden" required="required" class="form-select" onchange="SelectAlaniSecildi(this.id),TesdiqYerineYaz(this.id)" title="">
							<option disabled="disabled" value="" selected="selected" tabindex="7"></option>	
							<?php	
							$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
							$Sobe_Sor->execute(array(
								'Durum'=>1,
								'Idare_Id'=>$Idare_Id));
							while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)){
								$Sobe_Id=$Sobe_Cek['Sobe_Id'];
								$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
								$Vezife_Sor->execute(array(
									'Durum'=>1,
									'Idare_Id'=>$Idare_Id,
									'Sobe_Id'=>$Sobe_Id,
									'User_Id'=>0));
								while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)){
									$Vezife_Id=$Vezife_Cek['Vezife_Id'];
									$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
									$User_Sor->execute(array(
										'Durum'=>1,
										'Islediyi_Idare_Id'=>$Idare_Id,
										'Islediyi_Sobe_Id'=>$Sobe_Id,
										'Vezife_Id'=>$Vezife_Id));
									$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
									$AdSoyadAtaadi=$User_Cek['Soy_Adi']." ".$User_Cek['Adi']." ".$User_Cek['Ata_Adi'];
									$ID=$User_Cek['ID'];

									$Selahiyyet_Sor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID");
									$Selahiyyet_Sor->execute(array(				
										'ID'=>$ID));
									$Selahiyyet_Cek=$Selahiyyet_Sor->fetch(PDO::FETCH_ASSOC);
									if ($Selahiyyet_Cek['TesdiqSelahiyyeti']==1) {
										echo "<option value='".$ID ."'>{$AdSoyadAtaadi}</option>";
									}
									
								}
							}
							?>
						</select>
					</div>

					
					<div class="col-2" style="width: 108px;">
						<button class="YenileButonlari buttonlabelsevyesine" onclick="TabelCapET()">Çap Et</button>
					</div>
					
				</div>			

			</div>				
		</div>
	</div>		
	<div class="card-body" id="icerik" style="font-size:14px;">
		<div class="row">
			<div class="col-4" style="font-size:10px; text-decoration: underline;">

				<?php
				$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id order by Sira_No ASC");
				$Sobe_Sor->execute(array(
					'Idare_Id'=>$Idare_Id));
				while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
					if ($Sobe_Cek['Sobe_Ad']!="Əmək müqaviləsinə əsasən işləyənlər") {
						echo $Sobe_Cek['Sobe_Ad'].", ";
					}

				}
				?>
			</div>
			<div class="col-4 textaligncenter">
				<div>	
					<b>
						<?php 
						$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
						$Idare_Sor->execute(array(
							'Idare_Id'=>$Idare_Id));
						$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
						echo $Idare_Cek['Idare_Adi'];
						?>
					</b>
				</div>
				<hr style="margin-bottom: 0px;margin-top: 0px !important;background-color:#000000;opacity: 1;height: 0; border-top: 1px solid #000000;">
				<div style="font-size: 10px;font-style: italic; ">(müəssisənin, təşkilatın, idarənin adı)</div>


			</div>
			<div class="col-4 textaligncenter">
				<div style="font-size:15px;">"TƏSDİQ EDİRƏM"</div>
				<div ><?php echo $Idare_Cek['Idare_Adi']; ?>nin</div>
				<div>
					<span id="tesdiqedenvezife"></span>____________________ <span id="tesdiqedenadi"></span>
				</div>
				<div>"____" _____________________ 20___</div>
			</div>
		</div>
		<div class="row ">
			<div class="col-12 textaligncenter"><b>T A B E L</b></div>
		</div>

		<div class="row ">
			<div class="col-12 textaligncenter"><b><?php echo sprintf("%02d", $ilkgun).".".$Ay_tap.".".$Il_tap." - ".$toplusaat.".".$Ay_tap.".".$Il_tap	 ?></b></div>
		</div>
		<div class="row">					
			<div class="over-y genislik">
				<table id="tabel" style="white-space: normal;" class="table table-bordered table-hover">
					<thead>
						<tr >												
							<th rowspan="2">№</th>
							<th rowspan="2">Adı soyadı ata adı</th>
							<th rowspan="2" class="textaligncenter">Vəzifəsi</th>
							<th colspan="<?php echo date( 'd', $Bitis_TRH) ?>" class="textaligncenter" >Günlər</th>
							<th rowspan="2" style="transform: rotate(-90deg); width: 30px; text-align: center; height: 59px;background-color: transparent;">İş<br>günləri</th>
							<th rowspan="2" style="transform: rotate(-90deg); width: 30px; text-align: center;background-color: transparent;">İş<br>saatları</th>
						</tr>
						<tr >												

							<?php  
							for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
								echo "<th class='textaligncenter'>".date( 'd', $i )."</th>"; 
							}
							?>



						</tr>
					</thead>
					<tbody id="list" class="table_ici">
						<?php 		
						$cemigun=0;		
						$cemisaat=0;
						$dizi=array();
						$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
						$Sobe_Sor->execute(array(
							'Idare_Id'=>$Idare_Id,
							'Durum'=>1));		

						while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {	
							$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Sobe_Id=:Sobe_Id and Stat_Muqavile=:Stat_Muqavile order by Sira_No ASC ");
							$Vezife_Sor->execute(array(
								'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],
								'Stat_Muqavile'=>0								
							));									
							while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {

								$Vezife_Id=$Vezife_Cek['Vezife_Id'];
								$Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];
								$Vezife_Ad_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id");
								$Vezife_Ad_Sor->execute(array(
									'Vezife_Adlari_Id'=>$Vezife_Adlari_Id									
								));				
								$Vezife_Ad_Cek=$Vezife_Ad_Sor->fetch(PDO::FETCH_ASSOC);
								$Vezife_Adlari_Ad=$Vezife_Ad_Cek['Vezife_Adlari_Ad'];


								$Iseqebul_Sor=$db->prepare("SELECT * FROM ise_qebul_emri where User_Vezife=:User_Vezife and User_Ise_Qebul_Tarixi<=:User_Ise_Qebul_Tarixi  and Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu order by User_Ise_Qebul_Tarixi DESC");
								$Iseqebul_Sor->execute(array(
									'User_Vezife'=>$Vezife_Id,	
									'User_Ise_Qebul_Tarixi'=>$Ayin_Son_Gunu,							
									'Ise_Qebul_Emri_Stausu'=>1));
								$Iseqebul_Cek=$Iseqebul_Sor->fetch(PDO::FETCH_ASSOC);
								$Ise_Qebul_Tarixi=$Iseqebul_Cek['User_Ise_Qebul_Tarixi'];
								$Ise_Qebul_UserID=$Iseqebul_Cek['ID'];


								$Sdeyisiklik_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where Vezife_Id=:Vezife_Id and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
								$Sdeyisiklik_Sor->execute(array(
									'Vezife_Id'=>$Vezife_Id,
									'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Ilk_Gunu
								));
								$Sdeyisiklik_Cek=$Sdeyisiklik_Sor->fetch(PDO::FETCH_ASSOC);
								$Vezifeye_Teyin_Etme_Tarixi=$Sdeyisiklik_Cek['Vezifeye_Teyin_Etme_Tarixi'];
								$Deyisiklik_UserID=$Sdeyisiklik_Cek['ID'];


								$IsdenCixarilma_Sor=$db->prepare("SELECT * FROM user where Isden_Cixarilma_Vezife_Id=:Isden_Cixarilma_Vezife_Id and Isden_Cixarilma_Tarixi<=:Isden_Cixarilma_Tarixi order by Isden_Cixarilma_Tarixi DESC");
								$IsdenCixarilma_Sor->execute(array(
									'Isden_Cixarilma_Vezife_Id'=>$Vezife_Id,
									'Isden_Cixarilma_Tarixi'=>$Ayin_Ilk_Gunu
								));
								$IsdenCixarilma_Cek=$IsdenCixarilma_Sor->fetch(PDO::FETCH_ASSOC);
								$Isden_Cixarilma_Tarixi=$IsdenCixarilma_Cek['Isden_Cixarilma_Tarixi'];


								$Vezife_Azad_Sor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where Vezife_Id=:Vezife_Id and Vezifeden_Azad_Etme_Tarix<=:Vezifeden_Azad_Etme_Tarix order by Vezifeden_Azad_Etme_Tarix DESC");
								$Vezife_Azad_Sor->execute(array(
									'Vezife_Id'=>$Vezife_Id,
									'Vezifeden_Azad_Etme_Tarix'=>$Ayin_Ilk_Gunu
								));
								$Vezife_Azad_Cek=$Vezife_Azad_Sor->fetch(PDO::FETCH_ASSOC);
								$Vezifeden_Azad_Etme_Tarix=$Vezife_Azad_Cek['Vezifeden_Azad_Etme_Tarix'];


								$Intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where Vezife_Id=:Vezife_Id and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<=:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix and  (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bir or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:iki or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:uc )  order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
								$Intizam_Sor->execute(array(
									'Vezife_Id'=>$Vezife_Id,
									'Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'=>$Ayin_Ilk_Gunu,
									'bir'=>7,
									'iki'=>8,
									'uc'=>9
								));
								$Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC);
								$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix=$Intizam_Cek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];


								$Vezife_Teyin_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where Vezife_Id=:Vezife_Id and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
								$Vezife_Teyin_Sor->execute(array(
									'Vezife_Id'=>$Vezife_Id,
									'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Ilk_Gunu
								));
								$Vezife_Teyin_Cek=$Vezife_Teyin_Sor->fetch(PDO::FETCH_ASSOC);
								$Vezifeye_Tarixi=$Vezife_Teyin_Cek['Vezifeye_Teyin_Etme_Tarixi'];
								$Vezife_Teyin_ID=$Vezife_Teyin_Cek['ID'];




								$deyisiklik_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where Vezife_Id=:Vezife_Id and Vezifeye_Teyin_Etme_Tarixi>=:ayinevveline and Vezifeye_Teyin_Etme_Tarixi<=:ayinsonuna order by Vezifeye_Teyin_Etme_Tarixi DESC");
								$deyisiklik_Sor->execute(array(
									'Vezife_Id'=>$Vezife_Id,
									'ayinevveline'=>$Ayin_Ilk_Gunu,
									'ayinsonuna'=>$Ayin_Son_Gunu
								));
								$ayIcindeDeyisikliksay=$deyisiklik_Sor->rowCount();

								if ($ayIcindeDeyisikliksay) {
									$deyisiklik_Cek=$deyisiklik_Sor->fetch(PDO::FETCH_ASSOC);						
									$Ayicinde_UserID=$deyisiklik_Cek['ID'];
									$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
									$Sor->execute(array(
										'ID'=>$Ayicinde_UserID
									));
									$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
									$Idaredxaili_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$Idaredxaili_Sor->execute(array(
										'ID'=>$Ayicinde_UserID,
										'Islediyi_Idare'=>$Idare_Id,
										'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
									));	


									$Idaredxaili_Say=$Idaredxaili_Sor->rowCount();
									if ($Idaredxaili_Say>0) {								
										$IdaredaxiliCek=$Idaredxaili_Sor->fetch(PDO::FETCH_ASSOC);
										$Statdeyistarix=$IdaredaxiliCek['Vezifeye_Teyin_Etme_Tarixi'];

										$Tyinxaili_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
										$Tyinxaili_Sor->execute(array(
											'ID'=>$Ayicinde_UserID,
											'Islediyi_Idare'=>$Idare_Id,
											'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
										));	
										$Tyinxailicek=$Tyinxaili_Sor->fetch(PDO::FETCH_ASSOC);
										$vezteytarixi=$Tyinxailicek['Vezifeye_Teyin_Etme_Tarixi'];

										$sonvezifesi=$IdaredaxiliCek['Vezife_Id'];
										if ($Statdeyistarix>$vezteytarixi) {
											if ($sonvezifesi==$Vezife_Id) {?>
												<tr>
													<td class="textaligncenter"></td>
													<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
													<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>

													<?php 
													$toplusaat=0;
													$toplgun=0;		

													for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
														$Heftenin_Gunu=date('w',$i);
														if ($Heftenin_Gunu==0) {
															$gun="İ";
														}elseif ($Heftenin_Gunu==6) {
															$gun="İ";
														}else{
															$yeddisaat=date("Y-m-d",($i+86400));
															$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
															$ISor->execute(array(
																'Tarix_Adi_Beynelxalq'=>$yeddisaat));
															$ISay=$ISor->rowCount();
															if ($ISay>0) {
																$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
																if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
																	$gun=7;
																}else{
																	$gun=8;
																}												
															}else{
																$gun=8;
															}
														}


														$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
														$TSor->execute(array(
															'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
														$TSay=$TSor->rowCount();
														if ($TSay) {
															$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
															if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
																$gun="B";
															}elseif($TCek['Sebeb']==3){
																$gun=8;
															}elseif($TCek['Sebeb']==4){
																$gun="i";
															}elseif($TCek['Sebeb']==5){
																$gun="S";
															}
														}

														$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
														$EzSor->execute(array(
															'ID'=>$Cek['ID']
														));	
														while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
															$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
															$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
															if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
																if ($Heftenin_Gunu==0) {
																	$gun="İ";
																}elseif ($Heftenin_Gunu==6) {
																	$gun="İ";
																}else{
																	$gun="E/8";
																}
															}
														}

														if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
															$gun="H";
														}

														$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
														$XeSor->execute(array(
															'ID'=>$Cek['ID']
														));	
														while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
															$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
															$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
															if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
																$gun="X";
															}
														}





														$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
														$MezSor->execute(array(
															'ID'=>$Cek['ID']
														));
														$MezSay=$MezSor->rowCount();
														if ($MezSay>0) {
															while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
																$Meztarbas=$MezCek['Baslagic_Tarixi'];
																$Meztarson=$MezCek['Bitis_Tarixi'];
																$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
																if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
																	if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																		$gun="M";
																	}elseif($Mezuniyyet_Novleri_ID==4){
																		$gun="SM";
																	}elseif($Mezuniyyet_Novleri_ID==5){
																		$gun="TM";
																	}elseif($Mezuniyyet_Novleri_ID==6){
																		$gun="ÖM";
																	}	
																}												
															}
														}	

														$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
														$IscixisSor->execute(array(
															'ID'=>$Cek['ID'],
															'Isden_Cixarilma_Tarixi'=>0
														));
														$IscixisSay=$IscixisSor->rowCount();
														if ($IscixisSay==1) {
															$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
															$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
															if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
																$gun="";
															}
														}



														$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
														$IsGirSor->execute(array(
															'ID'=>$Cek['ID']
														));
														$IsGirSay=$IsGirSor->rowCount();
														if ($IsGirSay==1) {
															$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
															$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
															if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
																$gun="";
															}
														}


														$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
														$StatDeysorSor->execute(array(
															'ID'=>$Cek['ID'],
															'Islediyi_Idare'=>$Idare_Id,
															'Bir'=>$Ayin_Ilk_Gunu,
															'iki'=>$Ayin_Son_Gunu
														));
														$StatDeysorSay=$StatDeysorSor->rowCount();
														if ($StatDeysorSay>0) {
															$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
															$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
															if ($St_Dey_Tar>date("Y-m-d",$i)) {
																$gun="";
															}
														}




														$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
														$IntSor->execute(array(
															'ID'=>$Cek['ID'],										
															'Uc'=>7,										
															'dord'=>8,										
															'bes'=>9,										
															'Bir'=>$Ayin_Ilk_Gunu,
															'iki'=>$Ayin_Son_Gunu
														));
														$IntSay=$IntSor->rowCount();
														if ($IntSay>0) {
															$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
															$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
															if ($Intiz_Tar<=date("Y-m-d",$i)) {
																$gun="";
															}
														}


														$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
														$VezazadSor->execute(array(
															'ID'=>$Cek['ID'],										
															'Bir'=>$Ayin_Ilk_Gunu,
															'iki'=>$Ayin_Son_Gunu
														));
														$VezazadSay=$VezazadSor->rowCount();
														if ($VezazadSay>0) {
															$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
															$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
															if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
																$gun="";
															}
														}








														if ($gun==8 or $gun==7 or $gun=="E/8") {
															if ($gun=="E/8") {
																$toplusaat+=8;														
																$toplgun++;
																$cemigun++;
																$cemisaat+=8;
															}else{
																$toplusaat+=$gun;
																$toplgun++;
																$cemigun++;
																$cemisaat+=$gun;

															}

														}

														echo "<td class='textaligncenter'>". $gun."</td>"; 
													}
													?>
													<td class='textaligncenter'><?php echo $toplgun ?></td>
													<td class='textaligncenter'><?php echo $toplusaat ?></td>
												</tr>
											<?php 	}
										}

									}
								}


								if ($Ise_Qebul_Tarixi>$Vezifeye_Teyin_Etme_Tarixi and $Ise_Qebul_Tarixi>$Isden_Cixarilma_Tarixi and $Ise_Qebul_Tarixi>$Vezifeden_Azad_Etme_Tarix and $Ise_Qebul_Tarixi>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix and $Ise_Qebul_Tarixi>$Vezifeye_Tarixi) {
									$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
									$Sor->execute(array(
										'ID'=>$Ise_Qebul_UserID
									));

									$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
									$Idaredxaili_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$Idaredxaili_Sor->execute(array(
										'ID'=>$Ise_Qebul_UserID,
										'Islediyi_Idare'=>$Idare_Id,
										'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
									));	
									$Idaredxaili_Say=$Idaredxaili_Sor->rowCount();
									$IdaredaxiliCek=$Idaredxaili_Sor->fetch(PDO::FETCH_ASSOC);
									$statdeytarix=$IdaredaxiliCek['Vezifeye_Teyin_Etme_Tarixi'];


									$VT_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$VT_Sor->execute(array(
										'ID'=>$Ise_Qebul_UserID,
										'Islediyi_Idare'=>$Idare_Id,
										'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
									));	
									$VT_Say=$VT_Sor->rowCount();
									$VT_Cek=$VT_Sor->fetch(PDO::FETCH_ASSOC);
									$VtTarix=$VT_Cek['Vezifeye_Teyin_Etme_Tarixi'];


									$IsQ_Sor=$db->prepare("SELECT * FROM ise_qebul_emri where ID=:ID  order by User_Ise_Qebul_Tarixi DESC");
									$IsQ_Sor->execute(array(
										'ID'=>$Ise_Qebul_UserID

									));	
									$IsQ_Say=$IsQ_Sor->rowCount();
									$IsQ_Cek=$IsQ_Sor->fetch(PDO::FETCH_ASSOC);
									$IsQ_Tarix=$IsQ_Cek['User_Ise_Qebul_Tarixi'];

									$Uz_Sta_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi  order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$Uz_Sta_Sor->execute(array(
										'ID'=>$Ise_Qebul_UserID,
										'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Ilk_Gunu
									));	
									$Uz_Sta_Cek=$Uz_Sta_Sor->fetch(PDO::FETCH_ASSOC);
									$Uz_Sta_Say=$Uz_Sta_Sor->rowCount();
									$UzerStaSontarix=$Uz_Sta_Cek['Vezifeye_Teyin_Etme_Tarixi'];


									$VTId_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID  order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$VTId_Sor->execute(array(
										'ID'=>$Ise_Qebul_UserID
									));	
									$VTId_Say=$VTId_Sor->rowCount();
									$VTId_Cek=$VTId_Sor->fetch(PDO::FETCH_ASSOC);
									$VTId_Tarix=$VTId_Cek['Vezifeye_Teyin_Etme_Tarixi'];

									if ($Idaredxaili_Say>0) {								
										$sonvezifesi=$IdaredaxiliCek['Vezife_Id'];
										if ($sonvezifesi==$Vezife_Id) {
											?>
											<td class="textaligncenter"></td>
											<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
											<?php 
											$toplusaat=0;
											$toplgun=0;									
											for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
												$Heftenin_Gunu=date('w',$i);
												if ($Heftenin_Gunu==0) {
													$gun="İ";
												}elseif ($Heftenin_Gunu==6) {
													$gun="İ";
												}else{
													$yeddisaat=date("Y-m-d",($i+86400));
													$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
													$ISor->execute(array(
														'Tarix_Adi_Beynelxalq'=>$yeddisaat));
													$ISay=$ISor->rowCount();
													if ($ISay>0) {
														$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
														if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
															$gun=7;
														}else{
															$gun=8;
														}												
													}else{
														$gun=8;
													}
												}


												$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
												$TSor->execute(array(
													'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
												$TSay=$TSor->rowCount();
												if ($TSay) {
													$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
													if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
														$gun="B";
													}elseif($TCek['Sebeb']==3){
														$gun=8;
													}elseif($TCek['Sebeb']==4){
														$gun="i";
													}elseif($TCek['Sebeb']==5){
														$gun="S";
													}
												}

												$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
												$EzSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
													$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
													$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
													if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
														if ($Heftenin_Gunu==0) {
															$gun="İ";
														}elseif ($Heftenin_Gunu==6) {
															$gun="İ";
														}else{
															$gun="E/8";
														}
													}
												}

												if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
													$gun="H";
												}

												$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
												$XeSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
													$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
													$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
													if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
														$gun="X";
													}
												}





												$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
												$MezSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$MezSay=$MezSor->rowCount();
												if ($MezSay>0) {
													while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
														$Meztarbas=$MezCek['Baslagic_Tarixi'];
														$Meztarson=$MezCek['Bitis_Tarixi'];
														$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
														if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
															if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																$gun="M";
															}elseif($Mezuniyyet_Novleri_ID==4){
																$gun="SM";
															}elseif($Mezuniyyet_Novleri_ID==5){
																$gun="TM";
															}elseif($Mezuniyyet_Novleri_ID==6){
																$gun="ÖM";
															}	
														}												
													}
												}	

												$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
												$IscixisSor->execute(array(
													'ID'=>$Cek['ID'],
													'Isden_Cixarilma_Tarixi'=>0
												));
												$IscixisSay=$IscixisSor->rowCount();
												if ($IscixisSay==1) {
													$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
													$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
													if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
														$gun="";
													}
												}



												$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
												$IsGirSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$IsGirSay=$IsGirSor->rowCount();
												if ($IsGirSay==1) {
													$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
													$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
													if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
														$gun="";
													}
												}

												$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
												$StatDeysorSor->execute(array(
													'ID'=>$Cek['ID'],
													'Islediyi_Idare'=>$Idare_Id,
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$StatDeysorSay=$StatDeysorSor->rowCount();
												if ($StatDeysorSay>0) {
													$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
													$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
													if ($St_Dey_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}

												$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
												$IntSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Uc'=>7,										
													'dord'=>8,										
													'bes'=>9,										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$IntSay=$IntSor->rowCount();
												if ($IntSay>0) {
													$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
													$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
													if ($Intiz_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}
												$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
												$VezazadSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$VezazadSay=$VezazadSor->rowCount();
												if ($VezazadSay>0) {
													$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
													$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
													if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}
												if ($gun==8 or $gun==7 or $gun=="E/8") {
													if ($gun=="E/8") {
														$toplusaat+=8;
														$toplgun++;
														$cemigun++;
														$cemisaat+=8;
													}else{
														$toplusaat+=$gun;
														$toplgun++;
														$cemigun++;
														$cemisaat+=$gun;
													}
												}
												echo "<td class='textaligncenter'>". $gun."</td>"; 
											}
											?>
											<td class='textaligncenter'><?php echo $toplgun ?></td>
											<td class='textaligncenter'><?php echo $toplusaat ?></td>
											<?php 	
										}
									}elseif ($VT_Say>0) {								
										$sonvezifesi=$VT_Cek['Vezife_Id'];
										if ($sonvezifesi==$Vezife_Id) {
											?>
											<td class="textaligncenter"></td>
											<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
											<?php 
											$toplusaat=0;
											$toplgun=0;
											for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
												$Heftenin_Gunu=date('w',$i);
												if ($Heftenin_Gunu==0) {
													$gun="İ";
												}elseif ($Heftenin_Gunu==6) {
													$gun="İ";
												}else{
													$yeddisaat=date("Y-m-d",($i+86400));
													$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
													$ISor->execute(array(
														'Tarix_Adi_Beynelxalq'=>$yeddisaat));
													$ISay=$ISor->rowCount();
													if ($ISay>0) {
														$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
														if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
															$gun=7;
														}else{
															$gun=8;
														}												
													}else{
														$gun=8;
													}
												}


												$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
												$TSor->execute(array(
													'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
												$TSay=$TSor->rowCount();
												if ($TSay) {
													$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
													if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
														$gun="B";
													}elseif($TCek['Sebeb']==3){
														$gun=8;
													}elseif($TCek['Sebeb']==4){
														$gun="i";
													}elseif($TCek['Sebeb']==5){
														$gun="S";
													}
												}

												$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
												$EzSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
													$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
													$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
													if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
														if ($Heftenin_Gunu==0) {
															$gun="İ";
														}elseif ($Heftenin_Gunu==6) {
															$gun="İ";
														}else{
															$gun="E/8";
														}
													}
												}

												if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
													$gun="H";
												}

												$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
												$XeSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
													$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
													$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
													if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
														$gun="X";
													}
												}





												$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
												$MezSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$MezSay=$MezSor->rowCount();
												if ($MezSay>0) {
													while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
														$Meztarbas=$MezCek['Baslagic_Tarixi'];
														$Meztarson=$MezCek['Bitis_Tarixi'];
														$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
														if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
															if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																$gun="M";
															}elseif($Mezuniyyet_Novleri_ID==4){
																$gun="SM";
															}elseif($Mezuniyyet_Novleri_ID==5){
																$gun="TM";
															}elseif($Mezuniyyet_Novleri_ID==6){
																$gun="ÖM";
															}	
														}												
													}
												}	

												$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
												$IscixisSor->execute(array(
													'ID'=>$Cek['ID'],
													'Isden_Cixarilma_Tarixi'=>0
												));
												$IscixisSay=$IscixisSor->rowCount();
												if ($IscixisSay==1) {
													$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
													$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
													if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
														$gun="";
													}
												}



												$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
												$IsGirSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$IsGirSay=$IsGirSor->rowCount();
												if ($IsGirSay==1) {
													$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
													$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
													if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
														$gun="";
													}
												}

												$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
												$StatDeysorSor->execute(array(
													'ID'=>$Cek['ID'],
													'Islediyi_Idare'=>$Idare_Id,
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$StatDeysorSay=$StatDeysorSor->rowCount();
												if ($StatDeysorSay>0) {
													$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
													$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
													if ($St_Dey_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}

												$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
												$IntSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Uc'=>7,										
													'dord'=>8,										
													'bes'=>9,										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$IntSay=$IntSor->rowCount();
												if ($IntSay>0) {
													$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
													$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
													if ($Intiz_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}
												$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
												$VezazadSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$VezazadSay=$VezazadSor->rowCount();
												if ($VezazadSay>0) {
													$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
													$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
													if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}
												if ($gun==8 or $gun==7 or $gun=="E/8") {
													if ($gun=="E/8") {
														$toplusaat+=8;
														$toplgun++;
														$cemigun++;
														$cemisaat+=8;
													}else{
														$toplusaat+=$gun;
														$toplgun++;
														$cemigun++;
														$cemisaat+=$gun;
													}
												}
												echo "<td class='textaligncenter'>". $gun."</td>"; 
											}
											?>
											<td class='textaligncenter'><?php echo $toplgun ?></td>
											<td class='textaligncenter'><?php echo $toplusaat ?></td>
											<?php 	
										}
									}elseif($IsQ_Tarix>$UzerStaSontarix ){?>
										<tr>
											<td class="textaligncenter"></td>
											<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>

											<?php 
											$toplusaat=0;
											$toplgun=0;
											for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
												$Heftenin_Gunu=date('w',$i);
												if ($Heftenin_Gunu==0) {
													$gun="İ";
												}elseif ($Heftenin_Gunu==6) {
													$gun="İ";
												}else{
													$yeddisaat=date("Y-m-d",($i+86400));
													$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
													$ISor->execute(array(
														'Tarix_Adi_Beynelxalq'=>$yeddisaat));
													$ISay=$ISor->rowCount();
													if ($ISay>0) {
														$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
														if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
															$gun=7;
														}else{
															$gun=8;
														}												
													}else{
														$gun=8;
													}
												}


												$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
												$TSor->execute(array(
													'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
												$TSay=$TSor->rowCount();
												if ($TSay) {
													$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
													if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
														$gun="B";
													}elseif($TCek['Sebeb']==3){
														$gun=8;
													}elseif($TCek['Sebeb']==4){
														$gun="i";
													}elseif($TCek['Sebeb']==5){
														$gun="S";
													}
												}

												$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
												$EzSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
													$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
													$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
													if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
														if ($Heftenin_Gunu==0) {
															$gun="İ";
														}elseif ($Heftenin_Gunu==6) {
															$gun="İ";
														}else{
															$gun="E/8";
														}
													}
												}

												if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
													$gun="H";
												}

												$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
												$XeSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
													$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
													$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
													if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
														$gun="X";
													}
												}





												$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
												$MezSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$MezSay=$MezSor->rowCount();
												if ($MezSay>0) {
													while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
														$Meztarbas=$MezCek['Baslagic_Tarixi'];
														$Meztarson=$MezCek['Bitis_Tarixi'];
														$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
														if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
															if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																$gun="M";
															}elseif($Mezuniyyet_Novleri_ID==4){
																$gun="SM";
															}elseif($Mezuniyyet_Novleri_ID==5){
																$gun="TM";
															}elseif($Mezuniyyet_Novleri_ID==6){
																$gun="ÖM";
															}	
														}												
													}
												}	

												$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
												$IscixisSor->execute(array(
													'ID'=>$Cek['ID'],
													'Isden_Cixarilma_Tarixi'=>0
												));
												$IscixisSay=$IscixisSor->rowCount();
												if ($IscixisSay==1) {
													$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
													$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
													if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
														$gun="";
													}
												}



												$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
												$IsGirSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$IsGirSay=$IsGirSor->rowCount();
												if ($IsGirSay==1) {
													$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
													$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
													if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
														$gun="";
													}
												}


												$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
												$StatDeysorSor->execute(array(
													'ID'=>$Cek['ID'],
													'Islediyi_Idare'=>$Idare_Id,
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$StatDeysorSay=$StatDeysorSor->rowCount();
												if ($StatDeysorSay>0) {
													$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
													$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
													if ($St_Dey_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}


												$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
												$IntSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Uc'=>7,										
													'dord'=>8,										
													'bes'=>9,										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$IntSay=$IntSor->rowCount();
												if ($IntSay>0) {
													$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
													$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
													if ($Intiz_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}


												$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
												$VezazadSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$VezazadSay=$VezazadSor->rowCount();
												if ($VezazadSay>0) {
													$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
													$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
													if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}








												if ($gun==8 or $gun==7 or $gun=="E/8") {
													if ($gun=="E/8") {
														$toplusaat+=8;
														$toplgun++;
														$cemigun++;
														$cemisaat+=8;
													}else{
														$toplusaat+=$gun;
														$toplgun++;
														$cemigun++;
														$cemisaat+=$gun;
													}

												}

												echo "<td class='textaligncenter'>". $gun."</td>"; 
											}
											?>
											<td class='textaligncenter'><?php echo $toplgun ?></td>
											<td class='textaligncenter'><?php echo $toplusaat ?></td>
										</tr>
									<?php	}	elseif($Uz_Sta_Say>0 ){

									}else{
										?>
										<td class="textaligncenter"></td>
										<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
										<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
										<?php 
										$toplusaat=0;
										$toplgun=0;
										for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
											$Heftenin_Gunu=date('w',$i);
											if ($Heftenin_Gunu==0) {
												$gun="İ";
											}elseif ($Heftenin_Gunu==6) {
												$gun="İ";
											}else{
												$yeddisaat=date("Y-m-d",($i+86400));
												$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
												$ISor->execute(array(
													'Tarix_Adi_Beynelxalq'=>$yeddisaat));
												$ISay=$ISor->rowCount();
												if ($ISay>0) {
													$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
													if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
														$gun=7;
													}else{
														$gun=8;
													}												
												}else{
													$gun=8;
												}
											}


											$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
											$TSor->execute(array(
												'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
											$TSay=$TSor->rowCount();
											if ($TSay) {
												$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
												if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
													$gun="B";
												}elseif($TCek['Sebeb']==3){
													$gun=8;
												}elseif($TCek['Sebeb']==4){
													$gun="i";
												}elseif($TCek['Sebeb']==5){
													$gun="S";
												}
											}

											$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
											$EzSor->execute(array(
												'ID'=>$Cek['ID']
											));	
											while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
												$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
												$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
												if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
													if ($Heftenin_Gunu==0) {
														$gun="İ";
													}elseif ($Heftenin_Gunu==6) {
														$gun="İ";
													}else{
														$gun="E/8";
													}
												}
											}

											if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
												$gun="H";
											}

											$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
											$XeSor->execute(array(
												'ID'=>$Cek['ID']
											));	
											while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
												$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
												$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
												if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
													$gun="X";
												}
											}





											$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
											$MezSor->execute(array(
												'ID'=>$Cek['ID']
											));
											$MezSay=$MezSor->rowCount();
											if ($MezSay>0) {
												while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
													$Meztarbas=$MezCek['Baslagic_Tarixi'];
													$Meztarson=$MezCek['Bitis_Tarixi'];
													$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
													if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
														if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
															$gun="M";
														}elseif($Mezuniyyet_Novleri_ID==4){
															$gun="SM";
														}elseif($Mezuniyyet_Novleri_ID==5){
															$gun="TM";
														}elseif($Mezuniyyet_Novleri_ID==6){
															$gun="ÖM";
														}	
													}												
												}
											}	

											$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
											$IscixisSor->execute(array(
												'ID'=>$Cek['ID'],
												'Isden_Cixarilma_Tarixi'=>0
											));
											$IscixisSay=$IscixisSor->rowCount();
											if ($IscixisSay==1) {
												$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
												$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
												if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
													$gun="";
												}
											}



											$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
											$IsGirSor->execute(array(
												'ID'=>$Cek['ID']
											));
											$IsGirSay=$IsGirSor->rowCount();
											if ($IsGirSay==1) {
												$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
												$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
												if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
													$gun="";
												}
											}

											$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
											$StatDeysorSor->execute(array(
												'ID'=>$Cek['ID'],
												'Islediyi_Idare'=>$Idare_Id,
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$StatDeysorSay=$StatDeysorSor->rowCount();
											if ($StatDeysorSay>0) {
												$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
												$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
												if ($St_Dey_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}

											$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
											$IntSor->execute(array(
												'ID'=>$Cek['ID'],										
												'Uc'=>7,										
												'dord'=>8,										
												'bes'=>9,										
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$IntSay=$IntSor->rowCount();
											if ($IntSay>0) {
												$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
												$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
												if ($Intiz_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}
											$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
											$VezazadSor->execute(array(
												'ID'=>$Cek['ID'],										
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$VezazadSay=$VezazadSor->rowCount();
											if ($VezazadSay>0) {
												$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
												$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
												if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}
											if ($gun==8 or $gun==7 or $gun=="E/8") {
												if ($gun=="E/8") {
													$toplusaat+=8;
													$toplgun++;
													$cemigun++;
													$cemisaat+=8;
												}else{
													$toplusaat+=$gun;
													$toplgun++;
													$cemigun++;
													$cemisaat+=$gun;
												}
											}
											echo "<td class='textaligncenter'>". $gun."</td>"; 
										}
										?>
										<td class='textaligncenter'><?php echo $toplgun ?></td>
										<td class='textaligncenter'><?php echo $toplusaat ?></td>
										<?php 	
									}

								}

								if($Vezifeye_Teyin_Etme_Tarixi>$Ise_Qebul_Tarixi and $Vezifeye_Teyin_Etme_Tarixi>$Isden_Cixarilma_Tarixi and $Vezifeye_Teyin_Etme_Tarixi>$Vezifeden_Azad_Etme_Tarix and $Vezifeye_Teyin_Etme_Tarixi>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix and $Vezifeye_Teyin_Etme_Tarixi>$Vezifeye_Tarixi){

									$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
									$Sor->execute(array(
										'ID'=>$Deyisiklik_UserID
									));
									$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
									$Idaredxaili_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$Idaredxaili_Sor->execute(array(
										'ID'=>$Deyisiklik_UserID,
										'Islediyi_Idare'=>$Idare_Id,
										'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
									));	
									$Idaredxaili_Say=$Idaredxaili_Sor->rowCount();
									if ($Idaredxaili_Say>0) {

										$IdaredaxiliCek=$Idaredxaili_Sor->fetch(PDO::FETCH_ASSOC);
										$sonvezifesi=$IdaredaxiliCek['Vezife_Id'];
										if ($sonvezifesi==$Vezife_Id) {?>
											<td class="textaligncenter"></td>
											<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
											<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
											<?php 
											$toplusaat=0;
											$toplgun=0;
											for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
												$Heftenin_Gunu=date('w',$i);
												if ($Heftenin_Gunu==0) {
													$gun="İ";
												}elseif ($Heftenin_Gunu==6) {
													$gun="İ";
												}else{
													$yeddisaat=date("Y-m-d",($i+86400));
													$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
													$ISor->execute(array(
														'Tarix_Adi_Beynelxalq'=>$yeddisaat));
													$ISay=$ISor->rowCount();
													if ($ISay>0) {
														$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
														if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
															$gun=7;
														}else{
															$gun=8;
														}												
													}else{
														$gun=8;
													}
												}


												$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
												$TSor->execute(array(
													'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
												$TSay=$TSor->rowCount();
												if ($TSay) {
													$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
													if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
														$gun="B";
													}elseif($TCek['Sebeb']==3){
														$gun=8;
													}elseif($TCek['Sebeb']==4){
														$gun="i";
													}elseif($TCek['Sebeb']==5){
														$gun="S";
													}
												}

												$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
												$EzSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
													$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
													$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
													if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
														if ($Heftenin_Gunu==0) {
															$gun="İ";
														}elseif ($Heftenin_Gunu==6) {
															$gun="İ";
														}else{
															$gun="E/8";
														}
													}
												}

												if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
													$gun="H";
												}

												$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
												$XeSor->execute(array(
													'ID'=>$Cek['ID']
												));	
												while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
													$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
													$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
													if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
														$gun="X";
													}
												}





												$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
												$MezSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$MezSay=$MezSor->rowCount();
												if ($MezSay>0) {
													while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
														$Meztarbas=$MezCek['Baslagic_Tarixi'];
														$Meztarson=$MezCek['Bitis_Tarixi'];
														$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
														if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
															if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																$gun="M";
															}elseif($Mezuniyyet_Novleri_ID==4){
																$gun="SM";
															}elseif($Mezuniyyet_Novleri_ID==5){
																$gun="TM";
															}elseif($Mezuniyyet_Novleri_ID==6){
																$gun="ÖM";
															}	
														}												
													}
												}	

												$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
												$IscixisSor->execute(array(
													'ID'=>$Cek['ID'],
													'Isden_Cixarilma_Tarixi'=>0
												));
												$IscixisSay=$IscixisSor->rowCount();
												if ($IscixisSay==1) {
													$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
													$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
													if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
														$gun="";
													}
												}



												$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
												$IsGirSor->execute(array(
													'ID'=>$Cek['ID']
												));
												$IsGirSay=$IsGirSor->rowCount();
												if ($IsGirSay==1) {
													$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
													$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
													if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
														$gun="";
													}
												}

												$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
												$StatDeysorSor->execute(array(
													'ID'=>$Cek['ID'],
													'Islediyi_Idare'=>$Idare_Id,
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$StatDeysorSay=$StatDeysorSor->rowCount();
												if ($StatDeysorSay>0) {
													$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
													$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
													if ($St_Dey_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}

												$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
												$IntSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Uc'=>7,										
													'dord'=>8,										
													'bes'=>9,										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$IntSay=$IntSor->rowCount();
												if ($IntSay>0) {
													$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
													$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
													if ($Intiz_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}
												$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
												$VezazadSor->execute(array(
													'ID'=>$Cek['ID'],										
													'Bir'=>$Ayin_Ilk_Gunu,
													'iki'=>$Ayin_Son_Gunu
												));
												$VezazadSay=$VezazadSor->rowCount();
												if ($VezazadSay>0) {
													$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
													$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
													if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
														$gun="";
													}
												}
												if ($gun==8 or $gun==7 or $gun=="E/8") {
													if ($gun=="E/8") {
														$toplusaat+=8;
														$toplgun++;
														$cemigun++;
														$cemisaat+=8;
													}else{
														$toplusaat+=$gun;
														$toplgun++;
														$cemigun++;
														$cemisaat+=$gun;
													}
												}
												echo "<td class='textaligncenter'>". $gun."</td>"; 
											}
											?>
											<td class='textaligncenter'><?php echo $toplgun ?></td>
											<td class='textaligncenter'><?php echo $toplusaat ?></td>
										<?php 	}
									}else{
										?>
										<td class="textaligncenter"></td>
										<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
										<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
										<?php 
										$toplusaat=0;
										$toplgun=0;
										for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
											$Heftenin_Gunu=date('w',$i);
											if ($Heftenin_Gunu==0) {
												$gun="İ";
											}elseif ($Heftenin_Gunu==6) {
												$gun="İ";
											}else{
												$yeddisaat=date("Y-m-d",($i+86400));
												$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
												$ISor->execute(array(
													'Tarix_Adi_Beynelxalq'=>$yeddisaat));
												$ISay=$ISor->rowCount();
												if ($ISay>0) {
													$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
													if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
														$gun=7;
													}else{
														$gun=8;
													}												
												}else{
													$gun=8;
												}
											}


											$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
											$TSor->execute(array(
												'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
											$TSay=$TSor->rowCount();
											if ($TSay) {
												$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
												if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
													$gun="B";
												}elseif($TCek['Sebeb']==3){
													$gun=8;
												}elseif($TCek['Sebeb']==4){
													$gun="i";
												}elseif($TCek['Sebeb']==5){
													$gun="S";
												}
											}

											$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
											$EzSor->execute(array(
												'ID'=>$Cek['ID']
											));	
											while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
												$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
												$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
												if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
													if ($Heftenin_Gunu==0) {
														$gun="İ";
													}elseif ($Heftenin_Gunu==6) {
														$gun="İ";
													}else{
														$gun="E/8";
													}
												}
											}

											if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
												$gun="H";
											}

											$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
											$XeSor->execute(array(
												'ID'=>$Cek['ID']
											));	
											while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
												$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
												$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
												if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
													$gun="X";
												}
											}





											$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
											$MezSor->execute(array(
												'ID'=>$Cek['ID']
											));
											$MezSay=$MezSor->rowCount();
											if ($MezSay>0) {
												while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
													$Meztarbas=$MezCek['Baslagic_Tarixi'];
													$Meztarson=$MezCek['Bitis_Tarixi'];
													$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
													if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
														if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
															$gun="M";
														}elseif($Mezuniyyet_Novleri_ID==4){
															$gun="SM";
														}elseif($Mezuniyyet_Novleri_ID==5){
															$gun="TM";
														}elseif($Mezuniyyet_Novleri_ID==6){
															$gun="ÖM";
														}	
													}												
												}
											}	

											$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
											$IscixisSor->execute(array(
												'ID'=>$Cek['ID'],
												'Isden_Cixarilma_Tarixi'=>0
											));
											$IscixisSay=$IscixisSor->rowCount();
											if ($IscixisSay==1) {
												$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
												$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
												if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
													$gun="";
												}
											}



											$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
											$IsGirSor->execute(array(
												'ID'=>$Cek['ID']
											));
											$IsGirSay=$IsGirSor->rowCount();
											if ($IsGirSay==1) {
												$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
												$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
												if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
													$gun="";
												}
											}

											$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
											$StatDeysorSor->execute(array(
												'ID'=>$Cek['ID'],
												'Islediyi_Idare'=>$Idare_Id,
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$StatDeysorSay=$StatDeysorSor->rowCount();
											if ($StatDeysorSay>0) {
												$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
												$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
												if ($St_Dey_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}

											$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
											$IntSor->execute(array(
												'ID'=>$Cek['ID'],										
												'Uc'=>7,										
												'dord'=>8,										
												'bes'=>9,										
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$IntSay=$IntSor->rowCount();
											if ($IntSay>0) {
												$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
												$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
												if ($Intiz_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}
											$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
											$VezazadSor->execute(array(
												'ID'=>$Cek['ID'],										
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$VezazadSay=$VezazadSor->rowCount();
											if ($VezazadSay>0) {
												$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
												$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
												if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}
											if ($gun==8 or $gun==7 or $gun=="E/8") {
												if ($gun=="E/8") {
													$toplusaat+=8;
													$toplgun++;
													$cemigun++;
													$cemisaat+=8;
												}else{
													$toplusaat+=$gun;
													$toplgun++;
													$cemigun++;
													$cemisaat+=$gun;
												}
											}
											echo "<td class='textaligncenter'>". $gun."</td>"; 
										}
										?>
										<td class='textaligncenter'><?php echo $toplgun ?></td>
										<td class='textaligncenter'><?php echo $toplusaat ?></td>
										<?php 	
									}
								}



								$Vezifeteyinay_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where Vezife_Id=:Vezife_Id and Vezifeye_Teyin_Etme_Tarixi>=:ayinevveline and Vezifeye_Teyin_Etme_Tarixi<=:ayinsonuna order by Vezifeye_Teyin_Etme_Tarixi DESC");
								$Vezifeteyinay_Sor->execute(array(
									'Vezife_Id'=>$Vezife_Id,
									'ayinevveline'=>$Ayin_Ilk_Gunu,
									'ayinsonuna'=>$Ayin_Son_Gunu
								));
								$Vezifeteyinay_Say=$Vezifeteyinay_Sor->rowCount();

								if ($Vezifeteyinay_Say) {
									$Vezifeteyinay_Cek=$Vezifeteyinay_Sor->fetch(PDO::FETCH_ASSOC);						
									$Ayicinde_teyinID=$Vezifeteyinay_Cek['ID'];
									$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
									$Sor->execute(array(
										'ID'=>$Ayicinde_teyinID
									));
									$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
									$Idaredxaili_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$Idaredxaili_Sor->execute(array(
										'ID'=>$Ayicinde_teyinID,
										'Islediyi_Idare'=>$Idare_Id,
										'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
									));	
									$Idaredxaili_Say=$Idaredxaili_Sor->rowCount();
									if ($Idaredxaili_Say>0) {								
										$IdaredaxiliCek=$Idaredxaili_Sor->fetch(PDO::FETCH_ASSOC);
										$sonvezifesi=$IdaredaxiliCek['Vezife_Id'];
										$sonvtar=$IdaredaxiliCek['Vezifeye_Teyin_Etme_Tarixi'];

										$Daxilistat_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
										$Daxilistat_Sor->execute(array(
											'ID'=>$Ayicinde_teyinID,
											'Islediyi_Idare'=>$Idare_Id,
											'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
										));	
										$Daxilistat_Cek=$Daxilistat_Sor->fetch(PDO::FETCH_ASSOC);
										$daxilistattari=$Daxilistat_Cek['Vezifeye_Teyin_Etme_Tarixi'];
										if ($sonvtar>$daxilistattari) {
											if ($sonvezifesi==$Vezife_Id) {
												?>
												<td class="textaligncenter"></td>
												<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
												<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
												<?php 
												$toplusaat=0;
												$toplgun=0;
												for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
													$Heftenin_Gunu=date('w',$i);
													if ($Heftenin_Gunu==0) {
														$gun="İ";
													}elseif ($Heftenin_Gunu==6) {
														$gun="İ";
													}else{
														$yeddisaat=date("Y-m-d",($i+86400));
														$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
														$ISor->execute(array(
															'Tarix_Adi_Beynelxalq'=>$yeddisaat));
														$ISay=$ISor->rowCount();
														if ($ISay>0) {
															$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
															if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
																$gun=7;
															}else{
																$gun=8;
															}												
														}else{
															$gun=8;
														}
													}


													$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
													$TSor->execute(array(
														'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
													$TSay=$TSor->rowCount();
													if ($TSay) {
														$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
														if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
															$gun="B";
														}elseif($TCek['Sebeb']==3){
															$gun=8;
														}elseif($TCek['Sebeb']==4){
															$gun="i";
														}elseif($TCek['Sebeb']==5){
															$gun="S";
														}
													}

													$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
													$EzSor->execute(array(
														'ID'=>$Cek['ID']
													));	
													while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
														$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
														$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
														if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
															if ($Heftenin_Gunu==0) {
																$gun="İ";
															}elseif ($Heftenin_Gunu==6) {
																$gun="İ";
															}else{
																$gun="E/8";
															}
														}
													}

													if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
														$gun="H";
													}

													$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
													$XeSor->execute(array(
														'ID'=>$Cek['ID']
													));	
													while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
														$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
														$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
														if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
															$gun="X";
														}
													}





													$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
													$MezSor->execute(array(
														'ID'=>$Cek['ID']
													));
													$MezSay=$MezSor->rowCount();
													if ($MezSay>0) {
														while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
															$Meztarbas=$MezCek['Baslagic_Tarixi'];
															$Meztarson=$MezCek['Bitis_Tarixi'];
															$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
															if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
																if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																	$gun="M";
																}elseif($Mezuniyyet_Novleri_ID==4){
																	$gun="SM";
																}elseif($Mezuniyyet_Novleri_ID==5){
																	$gun="TM";
																}elseif($Mezuniyyet_Novleri_ID==6){
																	$gun="ÖM";
																}	
															}												
														}
													}	

													$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
													$IscixisSor->execute(array(
														'ID'=>$Cek['ID'],
														'Isden_Cixarilma_Tarixi'=>0
													));
													$IscixisSay=$IscixisSor->rowCount();
													if ($IscixisSay==1) {
														$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
														$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
														if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
															$gun="";
														}
													}



													$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
													$IsGirSor->execute(array(
														'ID'=>$Cek['ID']
													));
													$IsGirSay=$IsGirSor->rowCount();
													if ($IsGirSay==1) {
														$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
														$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
														if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
															$gun="";
														}
													}

													$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
													$StatDeysorSor->execute(array(
														'ID'=>$Cek['ID'],
														'Islediyi_Idare'=>$Idare_Id,
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$StatDeysorSay=$StatDeysorSor->rowCount();
													if ($StatDeysorSay>0) {
														$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
														$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
														if ($St_Dey_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}

													$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
													$IntSor->execute(array(
														'ID'=>$Cek['ID'],										
														'Uc'=>7,										
														'dord'=>8,										
														'bes'=>9,										
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$IntSay=$IntSor->rowCount();
													if ($IntSay>0) {
														$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
														$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
														if ($Intiz_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}
													$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
													$VezazadSor->execute(array(
														'ID'=>$Cek['ID'],										
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$VezazadSay=$VezazadSor->rowCount();
													if ($VezazadSay>0) {
														$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
														$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
														if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}
													if ($gun==8 or $gun==7 or $gun=="E/8") {
														if ($gun=="E/8") {
															$toplusaat+=8;
															$toplgun++;
															$cemigun++;
															$cemisaat+=8;
														}else{
															$toplusaat+=$gun;
															$toplgun++;
															$cemigun++;
															$cemisaat+=$gun;
														}
													}
													echo "<td class='textaligncenter'>". $gun."</td>"; 
												}
												?>
												<td class='textaligncenter'><?php echo $toplgun ?></td>
												<td class='textaligncenter'><?php echo $toplusaat ?></td>
												<?php 	
											}
										}

									}
								}






								if($Vezifeye_Tarixi>$Ise_Qebul_Tarixi and $Vezifeye_Tarixi>$Isden_Cixarilma_Tarixi and $Vezifeye_Tarixi>$Vezifeden_Azad_Etme_Tarix and $Vezifeye_Tarixi>$Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix and $Vezifeye_Tarixi>$Vezifeye_Teyin_Etme_Tarixi){					
									$Sor=$db->prepare("SELECT * FROM user where ID=:ID");
									$Sor->execute(array(
										'ID'=>$Vezife_Teyin_ID
									));
									$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
									$Idaredxaili_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
									$Idaredxaili_Sor->execute(array(
										'ID'=>$Vezife_Teyin_ID,
										'Islediyi_Idare'=>$Idare_Id,
										'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
									));	
									$Idaredxaili_Say=$Idaredxaili_Sor->rowCount();
									if ($Idaredxaili_Say>0) {
										$IdaredaxiliCek=$Idaredxaili_Sor->fetch(PDO::FETCH_ASSOC);
										$sonvezifesi=$IdaredaxiliCek['Vezife_Id'];
										$sonvei=$IdaredaxiliCek['Vezifeye_Teyin_Etme_Tarixi'];

										$Daxilistat_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare=:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi<=:Vezifeye_Teyin_Etme_Tarixi order by Vezifeye_Teyin_Etme_Tarixi DESC");
										$Daxilistat_Sor->execute(array(
											'ID'=>$Vezife_Teyin_ID,
											'Islediyi_Idare'=>$Idare_Id,
											'Vezifeye_Teyin_Etme_Tarixi'=>$Ayin_Son_Gunu
										));	
										$Daxilistat_Cek=$Daxilistat_Sor->fetch(PDO::FETCH_ASSOC);								
										$daxilistattari=$Daxilistat_Cek['Vezifeye_Teyin_Etme_Tarixi'];

										$Uz_Vez_Sor=$db->prepare("SELECT * FROM vezifeye_teyin_etme where ID=:ID order by Vezifeye_Teyin_Etme_Tarixi DESC");
										$Uz_Vez_Sor->execute(array(
											'ID'=>$Vezife_Teyin_ID
										));	
										$Uz_Vez_Cek=$Uz_Vez_Sor->fetch(PDO::FETCH_ASSOC);
										$UzerVezSontarix=$Uz_Vez_Cek['Vezifeye_Teyin_Etme_Tarixi'];
										$UzerVezidare=$Uz_Vez_Cek['Islediyi_Idare'];


										$Uz_Sta_Sor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID order by Vezifeye_Teyin_Etme_Tarixi DESC");
										$Uz_Sta_Sor->execute(array(
											'ID'=>$Vezife_Teyin_ID
										));	
										$Uz_Sta_Cek=$Uz_Sta_Sor->fetch(PDO::FETCH_ASSOC);

										$UzerStaSontarix=$Uz_Sta_Cek['Vezifeye_Teyin_Etme_Tarixi'];

										if ($sonvezifesi==$Vezife_Id) {	

											if ($sonvei>$daxilistattari and $UzerVezSontarix>$UzerStaSontarix) {									
												?>
												<td class="textaligncenter"></td>
												<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
												<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
												<?php 
												$toplusaat=0;
												$toplgun=0;
												for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
													$Heftenin_Gunu=date('w',$i);
													if ($Heftenin_Gunu==0) {
														$gun="İ";
													}elseif ($Heftenin_Gunu==6) {
														$gun="İ";
													}else{
														$yeddisaat=date("Y-m-d",($i+86400));
														$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
														$ISor->execute(array(
															'Tarix_Adi_Beynelxalq'=>$yeddisaat));
														$ISay=$ISor->rowCount();
														if ($ISay>0) {
															$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
															if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
																$gun=7;
															}else{
																$gun=8;
															}												
														}else{
															$gun=8;
														}
													}


													$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
													$TSor->execute(array(
														'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
													$TSay=$TSor->rowCount();
													if ($TSay) {
														$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
														if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
															$gun="B";
														}elseif($TCek['Sebeb']==3){
															$gun=8;
														}elseif($TCek['Sebeb']==4){
															$gun="i";
														}elseif($TCek['Sebeb']==5){
															$gun="S";
														}
													}

													$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
													$EzSor->execute(array(
														'ID'=>$Cek['ID']
													));	
													while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
														$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
														$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
														if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
															if ($Heftenin_Gunu==0) {
																$gun="İ";
															}elseif ($Heftenin_Gunu==6) {
																$gun="İ";
															}else{
																$gun="E/8";
															}
														}
													}

													if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
														$gun="H";
													}

													$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
													$XeSor->execute(array(
														'ID'=>$Cek['ID']
													));	
													while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
														$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
														$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
														if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
															$gun="X";
														}
													}





													$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
													$MezSor->execute(array(
														'ID'=>$Cek['ID']
													));
													$MezSay=$MezSor->rowCount();
													if ($MezSay>0) {
														while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
															$Meztarbas=$MezCek['Baslagic_Tarixi'];
															$Meztarson=$MezCek['Bitis_Tarixi'];
															$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
															if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
																if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																	$gun="M";
																}elseif($Mezuniyyet_Novleri_ID==4){
																	$gun="SM";
																}elseif($Mezuniyyet_Novleri_ID==5){
																	$gun="TM";
																}elseif($Mezuniyyet_Novleri_ID==6){
																	$gun="ÖM";
																}	
															}												
														}
													}	

													$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
													$IscixisSor->execute(array(
														'ID'=>$Cek['ID'],
														'Isden_Cixarilma_Tarixi'=>0
													));
													$IscixisSay=$IscixisSor->rowCount();
													if ($IscixisSay==1) {
														$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
														$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
														if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
															$gun="";
														}
													}



													$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
													$IsGirSor->execute(array(
														'ID'=>$Cek['ID']
													));
													$IsGirSay=$IsGirSor->rowCount();
													if ($IsGirSay==1) {
														$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
														$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
														if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
															$gun="";
														}
													}

													$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
													$StatDeysorSor->execute(array(
														'ID'=>$Cek['ID'],
														'Islediyi_Idare'=>$Idare_Id,
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$StatDeysorSay=$StatDeysorSor->rowCount();
													if ($StatDeysorSay>0) {
														$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
														$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
														if ($St_Dey_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}

													$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
													$IntSor->execute(array(
														'ID'=>$Cek['ID'],										
														'Uc'=>7,										
														'dord'=>8,										
														'bes'=>9,										
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$IntSay=$IntSor->rowCount();
													if ($IntSay>0) {
														$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
														$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
														if ($Intiz_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}
													$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
													$VezazadSor->execute(array(
														'ID'=>$Cek['ID'],										
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$VezazadSay=$VezazadSor->rowCount();
													if ($VezazadSay>0) {
														$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
														$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
														if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}
													if ($gun==8 or $gun==7 or $gun=="E/8") {
														if ($gun=="E/8") {
															$toplusaat+=8;
															$toplgun++;
															$cemigun++;
															$cemisaat+=8;
														}else{
															$toplusaat+=$gun;
															$toplgun++;
															$cemigun++;
															$cemisaat+=$gun;
														}
													}
													echo "<td class='textaligncenter'>". $gun."</td>"; 
												}
												?>
												<td class='textaligncenter'><?php echo $toplgun ?></td>
												<td class='textaligncenter'><?php echo $toplusaat ?></td>
												<?php 	
											}elseif($UzerVezSontarix>$UzerStaSontarix and $UzerVezidare!=$Idare_Id){

												?>
												<td class="textaligncenter"></td>
												<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
												<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
												<?php 
												$toplusaat=0;
												$toplgun=0;
												for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
													$Heftenin_Gunu=date('w',$i);
													if ($Heftenin_Gunu==0) {
														$gun="İ";
													}elseif ($Heftenin_Gunu==6) {
														$gun="İ";
													}else{
														$yeddisaat=date("Y-m-d",($i+86400));
														$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
														$ISor->execute(array(
															'Tarix_Adi_Beynelxalq'=>$yeddisaat));
														$ISay=$ISor->rowCount();
														if ($ISay>0) {
															$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
															if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
																$gun=7;
															}else{
																$gun=8;
															}												
														}else{
															$gun=8;
														}
													}


													$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
													$TSor->execute(array(
														'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
													$TSay=$TSor->rowCount();
													if ($TSay) {
														$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
														if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
															$gun="B";
														}elseif($TCek['Sebeb']==3){
															$gun=8;
														}elseif($TCek['Sebeb']==4){
															$gun="i";
														}elseif($TCek['Sebeb']==5){
															$gun="S";
														}
													}

													$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
													$EzSor->execute(array(
														'ID'=>$Cek['ID']
													));	
													while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
														$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
														$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
														if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
															if ($Heftenin_Gunu==0) {
																$gun="İ";
															}elseif ($Heftenin_Gunu==6) {
																$gun="İ";
															}else{
																$gun="E/8";
															}
														}
													}

													if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
														$gun="H";
													}

													$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
													$XeSor->execute(array(
														'ID'=>$Cek['ID']
													));	
													while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
														$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
														$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
														if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
															$gun="X";
														}
													}





													$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
													$MezSor->execute(array(
														'ID'=>$Cek['ID']
													));
													$MezSay=$MezSor->rowCount();
													if ($MezSay>0) {
														while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
															$Meztarbas=$MezCek['Baslagic_Tarixi'];
															$Meztarson=$MezCek['Bitis_Tarixi'];
															$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
															if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
																if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
																	$gun="M";
																}elseif($Mezuniyyet_Novleri_ID==4){
																	$gun="SM";
																}elseif($Mezuniyyet_Novleri_ID==5){
																	$gun="TM";
																}elseif($Mezuniyyet_Novleri_ID==6){
																	$gun="ÖM";
																}	
															}												
														}
													}	

													$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
													$IscixisSor->execute(array(
														'ID'=>$Cek['ID'],
														'Isden_Cixarilma_Tarixi'=>0
													));
													$IscixisSay=$IscixisSor->rowCount();
													if ($IscixisSay==1) {
														$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
														$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
														if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
															$gun="";
														}
													}



													$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
													$IsGirSor->execute(array(
														'ID'=>$Cek['ID']
													));
													$IsGirSay=$IsGirSor->rowCount();
													if ($IsGirSay==1) {
														$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
														$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
														if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
															$gun="";
														}
													}

													$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
													$StatDeysorSor->execute(array(
														'ID'=>$Cek['ID'],
														'Islediyi_Idare'=>$Idare_Id,
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$StatDeysorSay=$StatDeysorSor->rowCount();
													if ($StatDeysorSay>0) {
														$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
														$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
														if ($St_Dey_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}

													$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
													$IntSor->execute(array(
														'ID'=>$Cek['ID'],										
														'Uc'=>7,										
														'dord'=>8,										
														'bes'=>9,										
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$IntSay=$IntSor->rowCount();
													if ($IntSay>0) {
														$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
														$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
														if ($Intiz_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}
													$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
													$VezazadSor->execute(array(
														'ID'=>$Cek['ID'],										
														'Bir'=>$Ayin_Ilk_Gunu,
														'iki'=>$Ayin_Son_Gunu
													));
													$VezazadSay=$VezazadSor->rowCount();
													if ($VezazadSay>0) {
														$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
														$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
														if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
															$gun="";
														}
													}
													if ($gun==8 or $gun==7 or $gun=="E/8") {
														if ($gun=="E/8") {
															$toplusaat+=8;
															$toplgun++;
															$cemigun++;
															$cemisaat+=8;
														}else{
															$toplusaat+=$gun;
															$toplgun++;
															$cemigun++;
															$cemisaat+=$gun;
														}
													}
													echo "<td class='textaligncenter'>". $gun."</td>"; 
												}
												?>
												<td class='textaligncenter'><?php echo $toplgun ?></td>
												<td class='textaligncenter'><?php echo $toplusaat ?></td>
												<?php 	
											}
										}
									}else{
										?>
										<td class="textaligncenter"></td>
										<td><?php echo AdiSoyadi($Cek['ID'],$db) ?></td>
										<td class="textaligncenter"><?php echo $Vezife_Adlari_Ad ?></td>
										<?php 
										$toplusaat=0;
										$toplgun=0;
										for ($i = $Baslangic_TRH; $i <= $Bitis_TRH; $i = $i + 86400) {
											$Heftenin_Gunu=date('w',$i);
											if ($Heftenin_Gunu==0) {
												$gun="İ";
											}elseif ($Heftenin_Gunu==6) {
												$gun="İ";
											}else{
												$yeddisaat=date("Y-m-d",($i+86400));
												$ISor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
												$ISor->execute(array(
													'Tarix_Adi_Beynelxalq'=>$yeddisaat));
												$ISay=$ISor->rowCount();
												if ($ISay>0) {
													$ICek=$ISor->fetch(PDO::FETCH_ASSOC);
													if ($ICek['Sebeb']==1 or $ICek['Sebeb']==2 ) {
														$gun=7;
													}else{
														$gun=8;
													}												
												}else{
													$gun=8;
												}
											}


											$TSor=$db->prepare("SELECT * FROM  istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
											$TSor->execute(array(
												'Tarix_Adi_Beynelxalq'=>date("Y-m-d",$i)));
											$TSay=$TSor->rowCount();
											if ($TSay) {
												$TCek=$TSor->fetch(PDO::FETCH_ASSOC);
												if ($TCek['Sebeb']==1 or $TCek['Sebeb']==2) {
													$gun="B";
												}elseif($TCek['Sebeb']==3){
													$gun=8;
												}elseif($TCek['Sebeb']==4){
													$gun="i";
												}elseif($TCek['Sebeb']==5){
													$gun="S";
												}
											}

											$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID order by Ezam_Baslangic_Tarixi ASC");
											$EzSor->execute(array(
												'ID'=>$Cek['ID']
											));	
											while($EzCek=$EzSor->fetch(PDO::FETCH_ASSOC)){
												$Ezbas=$EzCek['Ezam_Baslangic_Tarixi'];
												$Ezson=$EzCek['Ezam_Bitis_Tarixi'];
												if ($Ezbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Ezson) {
													if ($Heftenin_Gunu==0) {
														$gun="İ";
													}elseif ($Heftenin_Gunu==6) {
														$gun="İ";
													}else{
														$gun="E/8";
													}
												}
											}

											if (date("Y-m-d",$i)==date("Y",$i)."-01-20") {
												$gun="H";
											}

											$XeSor=$db->prepare("SELECT * FROM xestelik_qeydiyyat where ID=:ID order by Xestelik_Baslagic_Tarixi ASC");
											$XeSor->execute(array(
												'ID'=>$Cek['ID']
											));	
											while($XeCek=$XeSor->fetch(PDO::FETCH_ASSOC)){
												$Xebas=$XeCek['Xestelik_Baslagic_Tarixi'];
												$Xebit=$XeCek['Xestelik_Ise_Cixma_Tarixi'];
												if ($Xebas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Xebit) {
													$gun="X";
												}
											}





											$MezSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID order by Baslagic_Tarixi ASC");
											$MezSor->execute(array(
												'ID'=>$Cek['ID']
											));
											$MezSay=$MezSor->rowCount();
											if ($MezSay>0) {
												while($MezCek=$MezSor->fetch(PDO::FETCH_ASSOC)){
													$Meztarbas=$MezCek['Baslagic_Tarixi'];
													$Meztarson=$MezCek['Bitis_Tarixi'];
													$Mezuniyyet_Novleri_ID=$MezCek['Mezuniyyet_Novleri_ID'];
													if ($Meztarbas<=date("Y-m-d",$i) and date("Y-m-d",$i) < $Meztarson) {
														if ($Mezuniyyet_Novleri_ID==1 or $Mezuniyyet_Novleri_ID==2 or $Mezuniyyet_Novleri_ID==3) {
															$gun="M";
														}elseif($Mezuniyyet_Novleri_ID==4){
															$gun="SM";
														}elseif($Mezuniyyet_Novleri_ID==5){
															$gun="TM";
														}elseif($Mezuniyyet_Novleri_ID==6){
															$gun="ÖM";
														}	
													}												
												}
											}	

											$IscixisSor=$db->prepare("SELECT * FROM  user where ID=:ID and Isden_Cixarilma_Tarixi>:Isden_Cixarilma_Tarixi");
											$IscixisSor->execute(array(
												'ID'=>$Cek['ID'],
												'Isden_Cixarilma_Tarixi'=>0
											));
											$IscixisSay=$IscixisSor->rowCount();
											if ($IscixisSay==1) {
												$IscixisCek=$IscixisSor->fetch(PDO::FETCH_ASSOC);
												$Isden_Cixarilma_Tarixi=$IscixisCek['Isden_Cixarilma_Tarixi'];
												if ($Isden_Cixarilma_Tarixi<=date("Y-m-d",$i)) {
													$gun="";
												}
											}



											$IsGirSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
											$IsGirSor->execute(array(
												'ID'=>$Cek['ID']
											));
											$IsGirSay=$IsGirSor->rowCount();
											if ($IsGirSay==1) {
												$IsGirCek=$IsGirSor->fetch(PDO::FETCH_ASSOC);
												$IsGir_Tarixi=$IsGirCek['Ise_Qebul_Tarixi'];
												if ($IsGir_Tarixi>=date("Y-m-d",$i)) {
													$gun="";
												}
											}

											$StatDeysorSor=$db->prepare("SELECT * FROM stat_deyisikliyi where ID=:ID and Islediyi_Idare<>:Islediyi_Idare and Vezifeye_Teyin_Etme_Tarixi>=:Bir and Vezifeye_Teyin_Etme_Tarixi<:iki order by Vezifeye_Teyin_Etme_Tarixi DESC");
											$StatDeysorSor->execute(array(
												'ID'=>$Cek['ID'],
												'Islediyi_Idare'=>$Idare_Id,
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$StatDeysorSay=$StatDeysorSor->rowCount();
											if ($StatDeysorSay>0) {
												$StatDeysorCek=$StatDeysorSor->fetch(PDO::FETCH_ASSOC);
												$St_Dey_Tar=$StatDeysorCek['Vezifeye_Teyin_Etme_Tarixi'];
												if ($St_Dey_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}

											$IntSor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and (Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:Uc or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:dord or Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id=:bes)  and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix>=:Bir and Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:iki order by Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix DESC");
											$IntSor->execute(array(
												'ID'=>$Cek['ID'],										
												'Uc'=>7,										
												'dord'=>8,										
												'bes'=>9,										
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$IntSay=$IntSor->rowCount();
											if ($IntSay>0) {
												$IntCek=$IntSor->fetch(PDO::FETCH_ASSOC);
												$Intiz_Tar=$IntCek['Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix'];
												if ($Intiz_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}
											$VezazadSor=$db->prepare("SELECT * FROM vezifeden_azad_edilme where ID=:ID  and Vezifeden_Azad_Etme_Tarix>=:Bir and Vezifeden_Azad_Etme_Tarix<:iki order by Vezifeden_Azad_Etme_Tarix DESC");
											$VezazadSor->execute(array(
												'ID'=>$Cek['ID'],										
												'Bir'=>$Ayin_Ilk_Gunu,
												'iki'=>$Ayin_Son_Gunu
											));
											$VezazadSay=$VezazadSor->rowCount();
											if ($VezazadSay>0) {
												$VezazadCek=$VezazadSor->fetch(PDO::FETCH_ASSOC);
												$Vez_Azad_Tar=$VezazadCek['Vezifeden_Azad_Etme_Tarix'];
												if ($Vez_Azad_Tar<=date("Y-m-d",$i)) {
													$gun="";
												}
											}
											if ($gun==8 or $gun==7 or $gun=="E/8") {
												if ($gun=="E/8") {
													$toplusaat+=8;
													$toplgun++;
													$cemigun++;
													$cemisaat+=8;
												}else{
													$toplusaat+=$gun;
													$toplgun++;
													$cemigun++;
													$cemisaat+=$gun;
												}
											}
											echo "<td class='textaligncenter'>". $gun."</td>"; 
										}
										?>
										<td class='textaligncenter'><?php echo $toplgun ?></td>
										<td class='textaligncenter'><?php echo $toplusaat ?></td>
										<?php 	
									}
								}
							}
						} 
						?>
						<tr>
							<?php $cemicol=$songun +3 ; ?>
							<th colspan="<?php echo $cemicol ?>">Cəmi</th>
							<th class="textaligncenter" ><?php echo $cemigun ?> </th>
							<th class="textaligncenter"><?php echo $cemisaat ?></th>
						</tr>
					</tbody>
				</table>
				<div id="qeyd">
					<br><br><br>
					<div class="row">
						<div class="col-7 ">
							<div>	
								<b>
									<span>1.</span><span id="icracivezifesiadi"></span>
								</b>
							</div>
							<hr style="margin-bottom: 0px;margin-top: 0px !important;background-color:#000000;opacity: 1; height: 0; border-top: 1px solid #000000;">
							<div class="textaligncenter" style="font-size: 10px;font-style: italic; ">(vəzifəsi, soyadı, adı)</div>
						</div>
						<div class="col-2 textaligncenter">		
							<div>	
								<b>
									<span>&nbsp;</span><span> &nbsp;&nbsp;</span>
								</b>
							</div>
							<hr style="margin-bottom: 0px;margin-top: 0px !important;background-color:#000000;opacity: 1;height: 0; border-top: 1px solid #000000;">
							<div style="font-size: 10px;font-style: italic; ">(imzası)</div>
						</div>
					</div>


					<div class="row">
						<div class="col-7">
							<div>	
								<b>
									<span>2.</span><span>&nbsp;&nbsp;</span>
								</b>
							</div>
							<hr style="margin-bottom: 0px;margin-top: 0px !important;background-color:#000000;opacity: 1;height: 0; border-top: 1px solid #000000;">
							<div class="textaligncenter" style="font-size: 10px;font-style: italic; ">(vəzifəsi, soyadı, adı)</div>
						</div>
						<div class="col-2 ">		
							<div>	
								<b>
									<span>&nbsp;</span><span> &nbsp;&nbsp;</span>
								</b>
							</div>
							<hr style="margin-bottom: 0px;margin-top: 0px !important;background-color:#000000;opacity: 1; height: 0; border-top: 1px solid #000000;">
							<div class="textaligncenter" style="font-size: 10px;font-style: italic; ">(imzası)</div>
						</div>
					</div>
					<div class="row">Qeyd</div>
					<div class="row">1. Həftəlik iş vaxtı: 40 saat (8x5)</div>
					<div class="row">2. İşarətlər: İstrahət günü (İ), Bayram günü (B), Ezamiyyə günü (E), Xəstəlik günü (X), Məzuniyyət günü (M), Təhsil məzuniyyəti günü (TM), Sosial məzuniyyət günləri (SM), Ödənişsiz məzuniyyət günü (ÖM), İşə gəlmədiyi və gecikdiyi günlər (G), Ümumxalq hüzn günü (H), Səsvermə günü (S)</div>
				</div>






			</div>
		</div>
	</div>
</div>
</div>
<?php require_once '_footer.php';?>
