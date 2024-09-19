<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Emr_Tarixi  = $deyer['Emrin_Tarixi'];
	$Emrin_Tarixi  = TarixBeynelxalqCevir($deyer['Emrin_Tarixi']);
	$Emir_No   =  EditorluIcerikleriFiltrle($deyer['Emir_No']);
	$Tarixi  = $deyer['Tedbiq_Tarixi'];
	$Tedbiq_Tarixi  = TarixBeynelxalqCevir($deyer['Tedbiq_Tarixi']);
	$User_Sor=$db->prepare("SELECT * FROM user where Durum=:Durum and Ise_Qebul_Tarixi<:Ise_Qebul_Tarixi ");
	$User_Sor->execute(array(	
		'Durum'=>1,
		'Ise_Qebul_Tarixi'=>$Tedbiq_Tarixi
	));
	$User_Say=$User_Sor->rowCount();
	if ($User_Say>0) {
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
						$il=$d1->diff($d2)->y; 
						$ay= $d1->diff($d2)->m; 
						$gun=$d1->diff($d2)->d;
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
					if (!$Xidmet_Ili_Say>0) {
						$Elave_Et=$db->prepare("INSERT INTO xidmet_iline_elave SET                               
							ID=:ID,		
							Xidmet_Iline_Elave_Verilme_tarixi=:Xidmet_Iline_Elave_Verilme_tarixi,		
							Emrin_Tarixi=:Emrin_Tarixi,		
							Emir_No=:Emir_No,		
							Xidmet_Iline_Elave=:Xidmet_Iline_Elave			
							");
						$Insert=$Elave_Et->execute(array(                                
							'ID'=>$ID,			
							'Xidmet_Iline_Elave_Verilme_tarixi'=>$Hansi_Tarixden,			
							'Emrin_Tarixi'=>$Emrin_Tarixi,			
							'Emir_No'=>$Emir_No,			
							'Xidmet_Iline_Elave'=>$Xidmet_Iline_Elave					
						));

					}
				}
			}							
		}
		if ($Insert) {			
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Emrin_Tarixi">';
			echo '<input type="hidden" id="message" value="<span class=\'Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
			$Sor=$db->prepare("SELECT * FROM xidmet_iline_elave order by Emrin_Tarixi DESC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>									
									<th>Adı,soyadı</th>
									<th>Əlavə verilmə tarixi</th>
									<th>Əlavə %</th>
									<th> Əmrin Tarixi</th>
									<th>Əmir no</th>
									<th class="emeliyyatlar_iki_buttom">Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>	
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Iline_Elave_Verilme_tarixi']) ?></td>										
										<td><?php echo $Cek['Xidmet_Iline_Elave'] ?></td>										
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Emrin_Tarixi']) ?></td>
										<td><?php echo $Cek['Emir_No']?></td>																															
										<td class="emeliyyatlar_iki_buttom">
											<?php 
											$Sor_Xidmet=$db->prepare("SELECT * FROM xidmet_iline_elave where ID=:ID order by  Xidmet_Iline_Elave_Verilme_tarixi DESC");
											$Sor_Xidmet->execute(array(
												'ID'=>$Cek['ID']
											));
											$Sor_Xidmet_Cek=$Sor_Xidmet->fetch(PDO::FETCH_ASSOC);
											if ($Sor_Xidmet_Cek['Xidmet_Iline_Elave_Verilme_tarixi']==$Cek['Xidmet_Iline_Elave_Verilme_tarixi']) {
												echo DuzenleButonu($Cek['Xidmet_Iline_Elave_Id']).SilButonu($Cek['Xidmet_Iline_Elave_Id']); 
											}
											
											?>	
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
						Xidmət ilinə əlavə əmri yoxdur
					</div>
				</div> 
			<?php 	}	



	// code...
		}

	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>