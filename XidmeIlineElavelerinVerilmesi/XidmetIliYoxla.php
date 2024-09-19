<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Tarixi  = $_POST['Deyer'];
	$Tedbiq_Tarixi  = TarixBeynelxalqCevir($_POST['Deyer']);
	$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Ise_Qebul_Tarixi<:Ise_Qebul_Tarixi ");
	$User_Sor->execute(array(	
		'Durum'=>1,
		'Ise_Qebul_Tarixi'=>$Tedbiq_Tarixi
	));
	$User_Say=$User_Sor->rowCount();
	if ($User_Say>0) {?>
		<div class="row">
			<div class="over-y genislik">
				<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
					<thead class="">
						<tr>									
							<th rowspan="2">Adı,soyadı,ata adı</th>
							<th rowspan="2" class="tarixsutunu">İşə qəbul tarixi</th>
							<th rowspan="2" class="tarixsutunu">Əlavənin  veriləcəyi  tarix</th>
							<th rowspan="2" class="xidmetilimuddet">Müddət</th>
							<th rowspan="2" class="xidmetilielave">Əlavə %</th>
							<th colspan="5" class="xidmetilibaslik">Digər xidmət illəri</th>
							<th colspan="3" class="xidmetilibaslik">Verilən tarixə görə xidmət illəri</th>																												
						</tr>
						<tr>	
							<th class="tarixsutunu">Giriş tarixi</th>
							<th class="tarixsutunu">Çıxış tarixi</th>
							<th class="xidmetiligun">Gün</th>
							<th class="xidmetiligun">Ay</th>
							<th class="xidmetiligun">İl</th>
							<th class="xidmetiligun">Gün</th>
							<th class="xidmetiligun">Ay</th>
							<th class="xidmetiligun">İl</th>		
						</tr>
					</thead>
					<tbody id="list" class="table_ici">
						<?php 	
						while($User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC)){
							$Qebul_Tarixi=$User_Cek['Ise_Qebul_Tarixi'];
							$Ise_Qebul_Tarixi=$User_Cek['Ise_Qebul_Tarixi'];
							$ID=$User_Cek['ID'];			
							$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id");
							$Vezife_Sor->execute(array(			
								'User_Id'=>$ID));
							$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
							if ($Vezife_Cek['Zabit_Mulu']==0) {
								$Diger_Xidmet_Sor=$db->prepare("SELECT * FROM diger_xidmet_illeri where ID=:ID and Xidmet_Iline_Daxil_Et=:Xidmet_Iline_Daxil_Et");
								$Diger_Xidmet_Sor->execute(array(
									'ID'=>$ID,
									'Xidmet_Iline_Daxil_Et'=>1
								));
								$Diger_Xidmet_Say=$Diger_Xidmet_Sor->rowCount();
								$digerqebul=array();
								$digercixis=array();
								$diziil=array();
								$diziay=array();
								$dizigun=array();
								if ($Diger_Xidmet_Say>0) {
									while($Diger_Xidmet_Cek=$Diger_Xidmet_Sor->fetch(PDO::FETCH_ASSOC)){
										$digerqebul[]=$Diger_Xidmet_Cek['Qebul_Tarixi'];
										$digercixis[]=$Diger_Xidmet_Cek['Azad_Olma_Tarixi'];
										$d1 = new DateTime($Diger_Xidmet_Cek['Qebul_Tarixi']);
										$d2 = new DateTime($Diger_Xidmet_Cek['Azad_Olma_Tarixi']);
										$il=$Diger_Xidmet_Cek['il']; 
										$ay= $Diger_Xidmet_Cek['ay'];
										$gun=$Diger_Xidmet_Cek['gun'];
										$diziil[]=$il;
										$diziay[]=$ay;
										$dizigun[]=$gun;
										$Qebul_Tarixi = Traixden_Cix($Qebul_Tarixi,$gun,"day");
										$Qebul_Tarixi = Traixden_Cix($Qebul_Tarixi,$ay,"month");
										$Qebul_Tarixi = Traixden_Cix($Qebul_Tarixi,$il,"year");
										$gelentarix = new DateTime($Tedbiq_Tarixi);
										$Alinantarix = new DateTime($Qebul_Tarixi);
										$muddet=$gelentarix->diff($Alinantarix)->y;
										$muddetIl=$gelentarix->diff($Alinantarix)->y;
										$muddetAy=$gelentarix->diff($Alinantarix)->m;
										$muddetGun=$gelentarix->diff($Alinantarix)->d;
										if ($muddet>=1 and $muddet<2) {
											$Xidmet_Iline_Elave=5;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 1,"year");
											$Xidmet_Muddeti="1 ildən 2 ilə qədər fasiləsiz xidmət illərinə görə";
										}elseif ($muddet>=2 and $muddet<5) {
											$Xidmet_Iline_Elave=10;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 2,"year");
											$Xidmet_Muddeti="2 ildən 5 ilə qədər fasiləsiz xidmət illərinə görə ";
										}elseif ($muddet>=5 and $muddet<10) {
											$Xidmet_Iline_Elave=15;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 5,"year");
											$Xidmet_Muddeti="5 ildən 10 ilə qədər fasiləsiz xidmət illərinə görə";
										}elseif ($muddet>=10 and $muddet<15) {
											$Xidmet_Iline_Elave=20;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 10,"year");
											$Xidmet_Muddeti="10 ildən 15 ilə qədər";
										}elseif ($muddet>=15 and $muddet<20) {
											$Xidmet_Iline_Elave=25;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 15,"year");
											$Xidmet_Muddeti="15 ildən 20 ilə qədər";
										}elseif ($muddet>=20 and $muddet<25) {
											$Xidmet_Iline_Elave=30;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 20,"year");
											$Xidmet_Muddeti="20 ildən 25 ilə qədər";
										}elseif ($muddet>=25 and $muddet<30) {
											$Xidmet_Iline_Elave=40;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 25,"year");
											$Xidmet_Muddeti="25 ildən 30 ilə qədər";
										}elseif ($muddet>=30) {
											$Xidmet_Iline_Elave=50;
											$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 30,"year");
											$Xidmet_Muddeti="30 ildən yuxarı";
										}else{
											$Xidmet_Iline_Elave="";
											$Hansi_Tarixden= "";
											$Xidmet_Muddeti="";
										}
									}
								}else{
									$gelentarix = new DateTime($Tedbiq_Tarixi);
									$Alinantarix = new DateTime($Qebul_Tarixi);
									$muddet=$gelentarix->diff($Alinantarix)->y;
									$muddetIl=$gelentarix->diff($Alinantarix)->y;
									$muddetAy=$gelentarix->diff($Alinantarix)->m;
									$muddetGun=$gelentarix->diff($Alinantarix)->d;
									if ($muddet>=1 and $muddet<2) {
										$Xidmet_Iline_Elave=5;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 1,"year");
										$Xidmet_Muddeti="1 ildən 2 ilə qədər";
									}elseif ($muddet>=2 and $muddet<5) {
										$Xidmet_Iline_Elave=10;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 2,"year");
										$Xidmet_Muddeti="2 ildən 5 ilə qədər";
									}elseif ($muddet>=5 and $muddet<10) {
										$Xidmet_Iline_Elave=15;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 5,"year");
										$Xidmet_Muddeti="5 ildən 10 ilə qədər";
									}elseif ($muddet>=10 and $muddet<15) {
										$Xidmet_Iline_Elave=20;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 10,"year");
										$Xidmet_Muddeti="10 ildən 15 ilə qədər";
									}elseif ($muddet>=15 and $muddet<20) {
										$Xidmet_Iline_Elave=25;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 15,"year");
										$Xidmet_Muddeti="15 ildən 20 ilə qədər";
									}elseif ($muddet>=20 and $muddet<25) {
										$Xidmet_Iline_Elave=30;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 20,"year");
										$Xidmet_Muddeti="20 ildən 25 ilə qədər";
									}elseif ($muddet>=25 and $muddet<30) {
										$Xidmet_Iline_Elave=40;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 25,"year");
										$Xidmet_Muddeti="25 ildən 30 ilə qədər";
									}elseif ($muddet>=30) {
										$Xidmet_Iline_Elave=50;
										$Hansi_Tarixden= Traix_Uzerine_Gel($Qebul_Tarixi, 30,"year");
										$Xidmet_Muddeti="30 ildən yuxarı";
									}else{
										$Xidmet_Iline_Elave="";
										$Hansi_Tarixden= "";
										$Xidmet_Muddeti="";
									}
								}
								if ($muddet>=1) {
									$Xidmet_Ili_Sor=$db->prepare("SELECT * FROM xidmet_iline_elave where ID=:ID and Xidmet_Iline_Elave=:Xidmet_Iline_Elave");
									$Xidmet_Ili_Sor->execute(array(
										'ID'=>$ID,
										'Xidmet_Iline_Elave'=>$Xidmet_Iline_Elave
									));
									$Xidmet_Ili_Say=$Xidmet_Ili_Sor->rowCount();
									if (!$Xidmet_Ili_Say>0) {	?>
										<tr>	
											<td><?php echo AdiSoyadiAtaadi($ID,$db);?></td>
											<td class="tarixsutunu"><?php echo Tarix_Beynelxalqi_Az_Cevir($Ise_Qebul_Tarixi);?></td>
											<td class="tarixsutunu"><?php echo Tarix_Beynelxalqi_Az_Cevir($Hansi_Tarixden); ?></td>										
											<td><?php echo $Xidmet_Muddeti; ?></td>										
											<td  class="xidmetilielave"><?php echo $Xidmet_Iline_Elave; ?></td>										
											<td class="tarixsutunu"><?php foreach ($digerqebul as $değer) {
												echo Tarix_Beynelxalqi_Az_Cevir($değer)."</br>";
											}	?>												
										</td>		
										<td class="tarixsutunu">
											<?php foreach ($digercixis as $değer) {
												echo Tarix_Beynelxalqi_Az_Cevir($değer)."</br>";
											}	?>												
										</td >		
										<td class="xidmetiligun">
											<?php foreach ($dizigun as $değer) {
												echo $değer."</br>";
											}	?>												
										</td>		
										<td class="xidmetiligun">
											<?php foreach ($diziay as $değer) {
												echo $değer."</br>";
											}	?>												
										</td>	
										<td class="xidmetiligun">
											<?php foreach ($diziil as $değer) {
												echo $değer."</br>";
											}	?>												
										</td>		
										<td class="xidmetiligun"><?php echo $muddetGun;?></td>		
										<td class="xidmetiligun"><?php echo $muddetAy;?></td>		
										<td class="xidmetiligun"><?php echo $muddetIl;?></td>	
										
									</tr>	
									<?php
								}
							}
						}							
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php 
	if (!$Xidmet_Ili_Say>0) {	?>
		<div class=" row" style="width:720px;">						
			<div class="col-2" style="width:120px;">
				<label for="Emrin_Tarixi" style="width: 206px" class="form-label">Əmrin tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control pickmeup_1 tarix" autocomplete="off" id="Emrin_Tarixi" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id)"  placeholder="__.__._____" required="required" maxlength="255" tabindex="5" title="">
			</div>		
			<div class="col-2">
				<label for="Emir_No" style="width: 206px" class="form-label">Əmrin No<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control" autocomplete="off" id="Emir_No" oninput="MetinAlaniYazildi(this.id)" onfocusout="MetinAlaniYazildi(this.id)"  placeholder="____._____" required="required" maxlength="255" tabindex="5" title="">
			</div>				
			<div class="col-2">
				<button class="YenileButonlari buttonlabelsevyesine" onclick="TopluTesdiqYoxla()">Təsdiq</button>
			</div>

		</div>
	<?php  } ?>

<?php }else{	?>
	<div class="row">
		<div class="over-y">
			Məlumat tapılmadı
		</div>
	</div> 
<?php 	}	?>
</div>
<div class="card-body" id="yoxlanis"></div>	
</div>
</div>
<?php 	
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>