<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                         =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Mezuniyyet_Novleri_ID      =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Novleri_ID']); 	
	$Mezuniyyet_Gun             =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Gun']); 	
	$Gelenmezuniyyettarixi      =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Tedbiq_Edildiyi_Tarix']);
	$Mezuniyyet_Emrinin_Nomresi=EditorluIcerikleriFiltrle($deyer['Mezuniyyet_Emrinin_Nomresi']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$Sor=$db->prepare("SELECT * FROM mezuniyyet_novleri where Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID");
	$Sor->execute(array(
		'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID));
	$Say=$Sor->rowCount();
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$Mezuniyyet_Novleri_Ad=$Cek['Mezuniyyet_Novleri_Ad'];
	$Mezuniyyet_Novleri_Kissa_Ad=$Cek['Mezuniyyet_Novleri_Kissa_Ad'];
	$gun=$Gelenmezuniyyettarixi[0].$Gelenmezuniyyettarixi[1];
	$ay=$Gelenmezuniyyettarixi[3].$Gelenmezuniyyettarixi[4];
	$il=$Gelenmezuniyyettarixi[6].$Gelenmezuniyyettarixi[7].$Gelenmezuniyyettarixi[8].$Gelenmezuniyyettarixi[9];
	$Mezuniyyet_Baslagic_Tarixi=$gun.".".$ay.".".$il;
	$Tedbiq_Edildiyi_Tarix=date("Y-m-d", strtotime($deyer['Tedbiq_Edildiyi_Tarix']));
	$Mezuniyyet_Evezi_ID             =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Evezi_ID']); 
	if ($Gelenmezuniyyettarixi!=$Mezuniyyet_Baslagic_Tarixi ) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Tedbiq_Edildiyi_Tarix">';
		echo '<input type="hidden" id="message" value="Məzuniyyətə çıxma tarixi səhv">';
		exit;
	}elseif(!$Mezuniyyet_Gun>0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Mezuniyyet_Gun">';
		echo '<input type="hidden" id="message" value="Məzuniyyet günü yazılmayıb">';
		exit;
	}elseif($User_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş secilmeyib">';
		exit;		
	}elseif($Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Mezuniyyet_Novleri_ID">';
		echo '<input type="hidden" id="message" value="Məzuniyyet növü secilmeyib">';
		exit;		
	}else{
		$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
		$User_Sor->execute(array(
			'ID'=>$ID,
			'Durum'=>1));
		$User_Say=$User_Sor->rowCount();
		$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
		$Cinsiyeti=$User_Cek['Cinsiyeti'];	
		$Ise_Qebul_Tarixi=$User_Cek['Ise_Qebul_Tarixi'];	
		$Idare_Id=$User_Cek['Islediyi_Idare_Id'];	
		$Adi=$User_Cek['Adi'];	
		$Soyadi=$User_Cek['Soy_Adi'];	
		$AtaAdi=$User_Cek['Ata_Adi'];	
		$Ise_Giris_Tarixi=new DateTime($Ise_Qebul_Tarixi);	
		$Mezuniyyete_Cixis_Tarixi=new DateTime($Tedbiq_Edildiyi_Tarix);	
		$Xidmet_Ili= $Ise_Giris_Tarixi->diff($Mezuniyyete_Cixis_Tarixi)->y;
		$Mezuniyyet_Huququ_Sor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID  order by Xidmet_Ili_Son DESC,Mezuniyyet_Id DESC");
		$Mezuniyyet_Huququ_Sor->execute(array(
			'ID'=>$ID));
		$Mezuniyyet_Huququ_Cek=$Mezuniyyet_Huququ_Sor->fetch(PDO::FETCH_ASSOC);
		$Xidmet_Ili_Son=$Mezuniyyet_Huququ_Cek['Xidmet_Ili_Son'];
		$Mezuniyyet_Qaliq_Gun=$Mezuniyyet_Huququ_Cek['Mezuniyyet_Qaliq_Gun'];
		if ($Ise_Qebul_Tarixi>$Tedbiq_Edildiyi_Tarix) {
			$data['status']="error";
			$data['message']="Məzuniyyətə çıxma tarixi səhv";			
			echo json_encode($data);
			exit;
		}
		/*		
		
		if ($Xidmet_Ili_Son>$Tedbiq_Edildiyi_Tarix and $Mezuniyyet_Qaliq_Gun==0) {
			echo "mezuniyyet jhuququ yoxdur";
			exit;
		}*/
		if($Xidmet_Ili_Son<$Tedbiq_Edildiyi_Tarix ){
			$iyirmigunonce=Traix_Uzerine_Gel($Tarix_Beynelxalq,20,"day");
			if ($Tarix_Beynelxalq <$Xidmet_Ili_Son and $iyirmigunonce>$Xidmet_Ili_Son) {
				echo "mezuniyyet huququ yaranmayib";
				exit;		
			}
		}		
		$Xidmet_Ili_Bitis = Traix_Uzerine_Gel($Ise_Qebul_Tarixi,1,"year");
		$Xidmet_Ili_Baslagic=$Ise_Qebul_Tarixi;
		$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id and Durum=:Durum");
		$Vezife_Sor->execute(array(
			'User_Id'=>$ID,
			'Durum'=>1));
		$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
		$Zabit_Mulu=$Vezife_Cek['Zabit_Mulu'];
		while ($Xidmet_Ili_Baslagic<$Tarix_Beynelxalq ) {			
			$Mez_Xid_Ili_Sor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Xidmet_Ili_Baslagic=:Xidmet_Ili_Baslagic and Xidmet_Ili_Son=:Xidmet_Ili_Son and (Mezuniyyet_Novleri_ID=:bir or Mezuniyyet_Novleri_ID=:iki or Mezuniyyet_Novleri_ID=:uc) order by Mezuniyyet_Id DESC");
			$Mez_Xid_Ili_Sor->execute(array(			
				'ID'=>$ID,
				'Xidmet_Ili_Baslagic'=>$Xidmet_Ili_Baslagic,
				'Xidmet_Ili_Son'=>$Xidmet_Ili_Bitis,
				'bir'=>1,
				'iki'=>2,
				'uc'=>3
			));
			$Mez_Xid_Ili_Say=$Mez_Xid_Ili_Sor->rowCount();
			if ($Mez_Xid_Ili_Say>0) {				
				$Mez_Xid_Ili_Cek=$Mez_Xid_Ili_Sor->fetch(PDO::FETCH_ASSOC);
				$Mezuniyyet_Qaliq_Guns=$Mez_Xid_Ili_Cek['Mezuniyyet_Qaliq_Gun'];
				if ($Mezuniyyet_Qaliq_Guns>0) {
					if ($Xidmet_Ili_Bitis>$Tedbiq_Edildiyi_Tarix) {
						$mezuniyyetgunu=$Mezuniyyet_Qaliq_Guns;				
						$Xidmet_Ili_BaslagicAZ   = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);					
						$Xidmet_Ili_BitisAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
						break;
					}elseif($Xidmet_Ili_Bitis<$Tedbiq_Edildiyi_Tarix and $Mezuniyyet_Qaliq_Guns>0){
						$mezuniyyetgunu=$Mezuniyyet_Qaliq_Guns;				
						$Xidmet_Ili_BaslagicAZ   = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);					
						$Xidmet_Ili_BitisAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
						break;
					}	else{		
						$Xidmet_Ili_Baslagic     = Traix_Uzerine_Gel($Xidmet_Ili_Baslagic,1,"year");
						$Xidmet_Ili_BaslagicAZ   = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);	

						$Xidmet_Ili_Bitis        = Traix_Uzerine_Gel($Xidmet_Ili_Bitis,1,"year");
						$Xidmet_Ili_BitisAZ      = Tarix_Beynelxalqi_Az_Cevir( $Xidmet_Ili_Bitis);
						$mezuniyyetgunu=$Mezuniyyet_Qaliq_Guns;	
						break;
					}					
				}else{
					$Xidmet_Ili_Baslagic       = Traix_Uzerine_Gel($Xidmet_Ili_Baslagic,1,"year");
					$Xidmet_Ili_Bitis          = Traix_Uzerine_Gel($Xidmet_Ili_Bitis,1,"year");
				}
			}else{
				if ($Mezuniyyet_Qaliq_Gun>0) {
					$mezuniyyetgunu=$Vezife_Cek['Esas_Mezuniyyeti']+$Mezuniyyet_Qaliq_Gun;			
					$Xidmet_Ili_BaslagicAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);
					$Xidmet_Ili_BitisAZ         = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
					if ($Xidmet_Ili>=5 and $Xidmet_Ili<10) {
						$mezuniyyetgunu=$mezuniyyetgunu+3;
					}elseif($Xidmet_Ili>=10 and $Xidmet_Ili<15){
						$mezuniyyetgunu=$mezuniyyetgunu+5;
					}elseif($Xidmet_Ili>=15 and $Xidmet_Ili<20){
						$mezuniyyetgunu=$mezuniyyetgunu+10;
					}elseif($Xidmet_Ili>=20){
						$mezuniyyetgunu=$mezuniyyetgunu+15;
					}else{
						$mezuniyyetgunu;
					}
					break;
				}else{
					$mezuniyyetgunu=$Vezife_Cek['Esas_Mezuniyyeti'];			
					$Xidmet_Ili_BaslagicAZ      = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Baslagic);
					$Xidmet_Ili_BitisAZ         = Tarix_Beynelxalqi_Az_Cevir($Xidmet_Ili_Bitis);
					if ($Xidmet_Ili>=5 and $Xidmet_Ili<10) {
						$mezuniyyetgunu=$mezuniyyetgunu+3;
					}elseif($Xidmet_Ili>=10 and $Xidmet_Ili<15){
						$mezuniyyetgunu=$mezuniyyetgunu+5;
					}elseif($Xidmet_Ili>=15 and $Xidmet_Ili<20){
						$mezuniyyetgunu=$mezuniyyetgunu+10;
					}elseif($Xidmet_Ili>=20){
						$mezuniyyetgunu=$mezuniyyetgunu+15;
					}else{
						$mezuniyyetgunu;
					}
					break;
				}
			}
		}	
		if ($Cinsiyeti==1) {
			$Usaq_Sor=$db->prepare("SELECT * FROM user_usaq where ID=:ID");
			$Usaq_Sor->execute(array(
				'ID'=>$ID));
			$Usaq_Say=$Usaq_Sor->rowCount();
			if ($Usaq_Say>=2) {
				$usagagoregun=0;
				$Mezuniyyete_Cixdigi_Il    = date("Y", strtotime($Tedbiq_Edildiyi_Tarix));
				while ($Usaq_Cek=$Usaq_Sor->fetch(PDO::FETCH_ASSOC)) {
					$Usaq_Dogum_tarixi=$Usaq_Cek['Dogum_Tarixi_Beynel'];
					$dogumilitap=explode("-", $Usaq_Dogum_tarixi);
					$dogumili=$dogumilitap[0];					
					$Usagin_Yasi=$Mezuniyyete_Cixdigi_Il-$dogumili;
					if ($Usagin_Yasi>0 and  $Usagin_Yasi<14) {
						$usagagoregun++;
					}
				}
			}
			if ($usagagoregun==2) {
				$mezuniyyetgunu=$mezuniyyetgunu+2;
			} elseif($usagagoregun>=3){
				$mezuniyyetgunu=$mezuniyyetgunu+5;
			}
		}
		$Istesalat_Bitis=Traix_Uzerine_Gel($Tedbiq_Edildiyi_Tarix,$mezuniyyetgunu,"day");
		$Teqvim_Sor=$db->prepare("SELECT * FROM istehsalt_teqvimi WHERE Tarix_Adi_Beynelxalq >=:Tedbiq_Edildiyi_Tarix and Tarix_Adi_Beynelxalq <=:Istesalat_Bitis");
		$Teqvim_Sor->execute(array(
			'Tedbiq_Edildiyi_Tarix'=>$Tedbiq_Edildiyi_Tarix,
			'Istesalat_Bitis'=>$Istesalat_Bitis));
		$Teqvim_Say=$Teqvim_Sor->rowCount();
		if ($Teqvim_Say>0) {
			$mezuniyyeti=$mezuniyyetgunu;
			while ($Teqvim_Cek=$Teqvim_Sor->fetch(PDO::FETCH_ASSOC)) {
				$Sebeb=$Teqvim_Cek['Sebeb'];
				if ($Sebeb==1 or $Sebeb==5) {
					$mezuniyyeti++;
				}
			}
			$CixisHesabdla    = Traix_Uzerine_Gel($Tedbiq_Edildiyi_Tarix,$mezuniyyeti,"day");
		}	else{
			$CixisHesabdla    = Traix_Uzerine_Gel($Tedbiq_Edildiyi_Tarix,$mezuniyyetgunu,"day");
		}
		if (($mezuniyyetgunu-$Mezuniyyet_Gun)==0) {
			$IseCixisTarixi = IscixisiHesabla($CixisHesabdla, $db);
			$QaliqGunSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID ");
			$QaliqGunSor->execute(array(
				'ID'=>$ID));				
			$Elave_Et=$db->prepare("INSERT INTO mezuniyyet SET                               
				ID=:ID,
				Adi=:Adi,
				Soyadi=:Soyadi,
				AtaAdi=:AtaAdi,
				Mezuniyyet_Evezi_ID=:Mezuniyyet_Evezi_ID,
				Xidmet_Ili_Baslagic=:Xidmet_Ili_Baslagic,
				Xidmet_Ili_Son=:Xidmet_Ili_Son,
				Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID,
				Mezuniyyet_Novleri_Ad=:Mezuniyyet_Novleri_Ad,
				Mezuniyyet_Novleri_Kissa_Ad=:Mezuniyyet_Novleri_Kissa_Ad,
				Mezuniyyet_Gun=:Mezuniyyet_Gun,
				Xidmet_Ili=:Xidmet_Ili,
				Baslagic_Tarixi=:Baslagic_Tarixi,
				Bitis_Tarixi=:Bitis_Tarixi,
				Ise_Cixma_Tarixi=:Ise_Cixma_Tarixi,
				Idare_Id=:Idare_Id,
				Mezuniyyet_Emrinin_Nomresi=:Mezuniyyet_Emrinin_Nomresi
				");
			$Insert=$Elave_Et->execute(array(                                
				'ID'=>$ID,
				'Adi'=>$Adi,
				'Soyadi'=>$Soyadi,
				'AtaAdi'=>$AtaAdi,
				'Mezuniyyet_Evezi_ID'=>$Mezuniyyet_Evezi_ID,
				'Xidmet_Ili_Baslagic'=>$Xidmet_Ili_Baslagic,
				'Xidmet_Ili_Son'=>$Xidmet_Ili_Bitis,
				'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID,
				'Mezuniyyet_Novleri_Ad'=>$Mezuniyyet_Novleri_Ad,
				'Mezuniyyet_Novleri_Kissa_Ad'=>$Mezuniyyet_Novleri_Kissa_Ad,
				'Mezuniyyet_Gun'=>$Mezuniyyet_Gun,
				'Xidmet_Ili'=>$Xidmet_Ili,
				'Baslagic_Tarixi'=>$Tedbiq_Edildiyi_Tarix,
				'Bitis_Tarixi'=>$CixisHesabdla,
				'Ise_Cixma_Tarixi'=>$IseCixisTarixi,
				'Idare_Id'=>$Idare_Id,
				'Mezuniyyet_Emrinin_Nomresi'=>$Mezuniyyet_Emrinin_Nomresi
			));
			if ($Insert) {
				echo '<input type="hidden" id="status" value="success">';
				$Sor=$db->prepare("SELECT * FROM   mezuniyyet order by Baslagic_Tarixi DESC limit 30");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
								<thead class="">
									<tr>
										<th>Adı,soyadı</th>
										<th>Xidmət ili</th>
										<th>Xidmət ili</th>
										<th>Məzuniyyətin növü</th>
										<th>Gün</th>
										<th>Başlanğıc Tarixi</th>
										<th>Bitiş Tarixi</th>
										<th>İşə çıxma Tarixi</th>
										<th>Əmrin nömrəsi</th>
										<th>Əməliyyatlar</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { ?>
										<tr>
											<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Baslagic']) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Son']) ?></td>
											<td><?php echo $Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>
											<td><?php echo $Cek['Mezuniyyet_Gun'] ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Baslagic_Tarixi']) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Bitis_Tarixi']) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Cixma_Tarixi']) ?></td>
											<td><?php echo $Cek['Mezuniyyet_Emrinin_Nomresi'] ?></td>										
											<td class="emeliyyatlar_iki_buttom">										
												<?php 
												echo DuzenleButonu($Cek['Mezuniyyet_Id']);
												echo SilButonu($Cek['Mezuniyyet_Id']);
												?>	
											</td>
										</tr>	
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php }else{	?>
					<div class="row">
						<div class="over-y">
							Bazada Məzuniyyət Əmri Yoxdur
						</div>
					</div> 
				<?php }	
			}else{
				echo '<input type="hidden" id="status" value="errorfull">';			
				echo '<input type="hidden" id="message" value="Xeta baş verdi sistem idarəcisinə məlumat verin">'	;
				exit;
			}			
		}	elseif (($mezuniyyetgunu-$Mezuniyyet_Gun)>0) {
			$Mezuniyyet_Qaliq_Gun=$mezuniyyetgunu-$Mezuniyyet_Gun;
			$IseCixisTarixi = IscixisiHesabla($CixisHesabdla, $db);
			$QaliqGunSor=$db->prepare("SELECT * FROM  mezuniyyet where ID=:ID ");
			$QaliqGunSor->execute(array(
				'ID'=>$ID));	
			$Elave_Et=$db->prepare("INSERT INTO mezuniyyet SET                               
				ID=:ID,
				Mezuniyyet_Evezi_ID=:Mezuniyyet_Evezi_ID,
				Xidmet_Ili_Baslagic=:Xidmet_Ili_Baslagic,
				Xidmet_Ili_Son=:Xidmet_Ili_Son,
				Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID,
				Mezuniyyet_Novleri_Ad=:Mezuniyyet_Novleri_Ad,
				Mezuniyyet_Novleri_Kissa_Ad=:Mezuniyyet_Novleri_Kissa_Ad,
				Mezuniyyet_Gun=:Mezuniyyet_Gun,
				Xidmet_Ili=:Xidmet_Ili,
				Baslagic_Tarixi=:Baslagic_Tarixi,
				Bitis_Tarixi=:Bitis_Tarixi,
				Ise_Cixma_Tarixi=:Ise_Cixma_Tarixi,
				Mezuniyyet_Qaliq_Gun=:Mezuniyyet_Qaliq_Gun,
				Idare_Id=:Idare_Id,
				Mezuniyyet_Emrinin_Nomresi=:Mezuniyyet_Emrinin_Nomresi
				");
			$Insert=$Elave_Et->execute(array(                                
				'ID'=>$ID,
				'Mezuniyyet_Evezi_ID'=>$Mezuniyyet_Evezi_ID,
				'Xidmet_Ili_Baslagic'=>$Xidmet_Ili_Baslagic,
				'Xidmet_Ili_Son'=>$Xidmet_Ili_Son,
				'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID,
				'Mezuniyyet_Novleri_Ad'=>$Mezuniyyet_Novleri_Ad,
				'Mezuniyyet_Novleri_Kissa_Ad'=>$Mezuniyyet_Novleri_Kissa_Ad,
				'Mezuniyyet_Gun'=>$Mezuniyyet_Gun,
				'Xidmet_Ili'=>$Xidmet_Ili,
				'Baslagic_Tarixi'=>$Baslagic_Tarixi,
				'Bitis_Tarixi'=>$CixisHesabdla,
				'Ise_Cixma_Tarixi'=>$IseCixisTarixi,
				'Mezuniyyet_Qaliq_Gun'=>$Mezuniyyet_Qaliq_Gun,
				'Idare_Id'=>$Idare_Id,
				'Mezuniyyet_Emrinin_Nomresi'=>$Mezuniyyet_Emrinin_Nomresi
			));
			if ($Insert) {
				echo '<input type="hidden" id="status" value="success">';
				$Sor=$db->prepare("SELECT * FROM   mezuniyyet order by Baslagic_Tarixi DESC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">								
								<thead class="">
									<tr>
										<th>Adı,soyadı</th>
										<th>Xidmət ili</th>
										<th>Xidmət ili</th>
										<th>Məzuniyyətin növü</th>
										<th>Gün</th>
										<th>Başlanğıc Tarixi</th>
										<th>Bitiş Tarixi</th>
										<th>İşə çıxma Tarixi</th>
										<th>Əmrin nömrəsi</th>
										<th>Əməliyyatlar</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { ?>
										<tr>
											<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Baslagic']) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Xidmet_Ili_Son']) ?></td>
											<td><?php echo $Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>
											<td><?php echo $Cek['Mezuniyyet_Gun'] ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Baslagic_Tarixi']) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Bitis_Tarixi']) ?></td>
											<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Ise_Cixma_Tarixi']) ?></td>
											<td><?php echo $Cek['Mezuniyyet_Emrinin_Nomresi'] ?></td>										
											<td class="emeliyyatlar_iki_buttom">										
												<?php 
												echo DuzenleButonu($Cek['Mezuniyyet_Id']);
												echo SilButonu($Cek['Mezuniyyet_Id']);
												?>	
											</td>
										</tr>	
									<?php } ?>
								</tbody>						
							</table>
						</div>
					</div>
				<?php }else{	?>
					<div class="row">
						<div class="over-y">
							Bazada Məzuniyyət Əmri Yoxdur
						</div>
					</div> 
				<?php }	
			}else{
				echo '<input type="hidden" id="status" value="errorfull">';			
				echo '<input type="hidden" id="message" value="Xeta baş verdi sistem idarəcisinə məlumat verin">'	;
				exit;
			}	
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>