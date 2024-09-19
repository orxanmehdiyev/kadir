<?php 
require_once '../Ayarlar/setting.php';
$deyer =json_decode($_POST['Deyer'],true);
$ID                                 =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
$Mezuniyyet_Novleri_ID              =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Novleri_ID']);
$Mezuniyyet_Baslagic_Tarixi         =  TarixAzCevir($deyer['Tedbiq_Edildiyi_Tarix']);
$Mezuniyyet_Baslagic_Tarixi_Beynel  =  TarixBeynelxalqCevir($deyer['Tedbiq_Edildiyi_Tarix']);  
$Mezuniyyet_Baslagic_Tarixi_Unix    =  TarixUnikCevir($deyer['Tedbiq_Edildiyi_Tarix']); 
$Mezuniyyet_Gun                     =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Gun']); 
$Mezuniyyet_Emrinin_Nomresi         =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Emrinin_Nomresi']); 
$Mezuniyyet_Evezi_ID                =  ReqemlerXaricButunKarakterleriSil($deyer['Mezuniyyet_Evezi_ID']); 
$Mezuniyyet_Bitis_Tarixi            =  TraixUzerineGunGelAzCevir($deyer['Tedbiq_Edildiyi_Tarix'],$Mezuniyyet_Gun);  
$Mezuniyyet_Bitis_Tarixi_Unix       =  TraixUzerineGunGelUnixCevir($deyer['Tedbiq_Edildiyi_Tarix'],$Mezuniyyet_Gun);
$Mezuniyyet_Ise_Cixma_Tarixi        =  TeqvimIsGunuHesabla($Mezuniyyet_Bitis_Tarixi_Unix, $db);
$Mezuniyyet_Ise_Cixma_Tarixi_Unix   =  TarixUnikCevir($Mezuniyyet_Ise_Cixma_Tarixi);
$QeyriIsGunuYoxla=TeqvimQeyriIsGunuYoxla($Mezuniyyet_Baslagic_Tarixi, $db);
$Sor=$db->prepare("SELECT * FROM mezuniyyet_novleri where Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID");
$Sor->execute(array(
	'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID));
$Say=$Sor->rowCount();
$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
$Mezuniyyet_Novleri_Ad=$Cek['Mezuniyyet_Novleri_Ad'];
$Mezuniyyet_Novleri_Kissa_Ad=$Cek['Mezuniyyet_Novleri_Kissa_Ad'];

if ($deyer['Tedbiq_Edildiyi_Tarix']!=$Mezuniyyet_Baslagic_Tarixi) {
	echo '<input type="hidden" id="status" value="error">';			
	echo '<input type="hidden" id="statusiki" value="Tedbiq_Edildiyi_Tarix">';			
	echo '<input type="hidden" id="message" value="Tarixi düzgün qeyd edin">'	;
	exit;
}elseif($QeyriIsGunuYoxla==0){
	echo '<input type="hidden" id="status" value="error">';			
	echo '<input type="hidden" id="statusiki" value="Tedbiq_Edildiyi_Tarix">';			
	echo '<input type="hidden" id="message" value="Qeyd etdiyiniz tarix qeyri iş günüdür">'	;
	exit;
}else{
	$Elave_Et=$db->prepare("INSERT INTO mezuniyyet SET                               
		ID=:ID,
		Mezuniyyet_Evezi_ID=:Mezuniyyet_Evezi_ID,		
		Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID,
		Mezuniyyet_Novleri_Ad=:Mezuniyyet_Novleri_Ad,
		Mezuniyyet_Novleri_Kissa_Ad=:Mezuniyyet_Novleri_Kissa_Ad,
		Mezuniyyet_Gun=:Mezuniyyet_Gun,
		Mezuniyyet_Baslagic_Tarixi=:Mezuniyyet_Baslagic_Tarixi,
		Mezuniyyet_Baslagic_Tarixi_Beynel=:Mezuniyyet_Baslagic_Tarixi_Beynel,
		Mezuniyyet_Baslagic_Tarixi_Unix=:Mezuniyyet_Baslagic_Tarixi_Unix,
		Mezuniyyet_Bitis_Tarixi=:Mezuniyyet_Bitis_Tarixi,
		Mezuniyyet_Bitis_Tarixi_Unix=:Mezuniyyet_Bitis_Tarixi_Unix,
		Mezuniyyet_Ise_Cixma_Tarixi=:Mezuniyyet_Ise_Cixma_Tarixi,
		Mezuniyyet_Ise_Cixma_Tarixi_Unix=:Mezuniyyet_Ise_Cixma_Tarixi_Unix,
		Mezuniyyet_Emrinin_Nomresi=:Mezuniyyet_Emrinin_Nomresi
		");
	$Insert=$Elave_Et->execute(array(                                
		'ID'=>$ID,
		'Mezuniyyet_Evezi_ID'=>$Mezuniyyet_Evezi_ID,
		'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID,
		'Mezuniyyet_Novleri_Ad'=>$Mezuniyyet_Novleri_Ad,
		'Mezuniyyet_Novleri_Kissa_Ad'=>$Mezuniyyet_Novleri_Kissa_Ad,
		'Mezuniyyet_Gun'=>$Mezuniyyet_Gun,		
		'Mezuniyyet_Baslagic_Tarixi'=>$Mezuniyyet_Baslagic_Tarixi,
		'Mezuniyyet_Baslagic_Tarixi_Beynel'=>$Mezuniyyet_Baslagic_Tarixi_Beynel,
		'Mezuniyyet_Baslagic_Tarixi_Unix'=>$Mezuniyyet_Baslagic_Tarixi_Unix,
		'Mezuniyyet_Bitis_Tarixi'=>$Mezuniyyet_Bitis_Tarixi,
		'Mezuniyyet_Bitis_Tarixi_Unix'=>$Mezuniyyet_Bitis_Tarixi_Unix,
		'Mezuniyyet_Ise_Cixma_Tarixi'=>$Mezuniyyet_Ise_Cixma_Tarixi,
		'Mezuniyyet_Ise_Cixma_Tarixi_Unix'=>$Mezuniyyet_Ise_Cixma_Tarixi_Unix,
		'Mezuniyyet_Emrinin_Nomresi'=>$Mezuniyyet_Emrinin_Nomresi
	));
	if ($Insert) {
		$Mezuniyyet_Id=$db->lastInsertId();
		$Elave_Et=$db->prepare("INSERT INTO mezuniyyet_islemleri SET                               
			Mezuniyyet_Id=:Mezuniyyet_Id,
			ID=:ID,
			Mezuniyyet_Evezi_ID=:Mezuniyyet_Evezi_ID,		
			Mezuniyyet_Novleri_ID=:Mezuniyyet_Novleri_ID,
			Mezuniyyet_Novleri_Ad=:Mezuniyyet_Novleri_Ad,
			Mezuniyyet_Novleri_Kissa_Ad=:Mezuniyyet_Novleri_Kissa_Ad,
			Mezuniyyet_Gun=:Mezuniyyet_Gun,
			Mezuniyyet_Baslagic_Tarixi=:Mezuniyyet_Baslagic_Tarixi,
			Mezuniyyet_Baslagic_Tarixi_Beynel=:Mezuniyyet_Baslagic_Tarixi_Beynel,
			Mezuniyyet_Baslagic_Tarixi_Unix=:Mezuniyyet_Baslagic_Tarixi_Unix,
			Mezuniyyet_Bitis_Tarixi=:Mezuniyyet_Bitis_Tarixi,
			Mezuniyyet_Bitis_Tarixi_Unix=:Mezuniyyet_Bitis_Tarixi_Unix,
			Mezuniyyet_Ise_Cixma_Tarixi=:Mezuniyyet_Ise_Cixma_Tarixi,
			Mezuniyyet_Ise_Cixma_Tarixi_Unix=:Mezuniyyet_Ise_Cixma_Tarixi_Unix,
			Mezuniyyet_Emrinin_Nomresi=:Mezuniyyet_Emrinin_Nomresi,
			Admin_Id=:Admin_Id,
			ZamanDamgasi=:ZamanDamgasi,
			TarixSaat	=:TarixSaat,
			IPAdresi	=:IPAdresi,
			Sebeb	=:Sebeb
			");
		$Insert=$Elave_Et->execute(array( 
			'Mezuniyyet_Id'=>$Mezuniyyet_Id,
			'ID'=>$ID,
			'Mezuniyyet_Evezi_ID'=>$Mezuniyyet_Evezi_ID,
			'Mezuniyyet_Novleri_ID'=>$Mezuniyyet_Novleri_ID,
			'Mezuniyyet_Novleri_Ad'=>$Mezuniyyet_Novleri_Ad,
			'Mezuniyyet_Novleri_Kissa_Ad'=>$Mezuniyyet_Novleri_Kissa_Ad,
			'Mezuniyyet_Gun'=>$Mezuniyyet_Gun,		
			'Mezuniyyet_Baslagic_Tarixi'=>$Mezuniyyet_Baslagic_Tarixi,
			'Mezuniyyet_Baslagic_Tarixi_Beynel'=>$Mezuniyyet_Baslagic_Tarixi_Beynel,
			'Mezuniyyet_Baslagic_Tarixi_Unix'=>$Mezuniyyet_Baslagic_Tarixi_Unix,
			'Mezuniyyet_Bitis_Tarixi'=>$Mezuniyyet_Bitis_Tarixi,
			'Mezuniyyet_Bitis_Tarixi_Unix'=>$Mezuniyyet_Bitis_Tarixi_Unix,
			'Mezuniyyet_Ise_Cixma_Tarixi'=>$Mezuniyyet_Ise_Cixma_Tarixi,
			'Mezuniyyet_Ise_Cixma_Tarixi_Unix'=>$Mezuniyyet_Ise_Cixma_Tarixi_Unix,
			'Mezuniyyet_Emrinin_Nomresi'=>$Mezuniyyet_Emrinin_Nomresi,
			'Admin_Id'=>$Admin_Id,
			'ZamanDamgasi'=>$ZamanDamgasi,
			'TarixSaat'	=>$TarixSaat,
			'IPAdresi'	=>$IPAdresi,
			'Sebeb'	=>1		
		));
		if ($Insert) {
			
			echo '<input type="hidden" id="status" value="success">';
			$Sor=$db->prepare("SELECT * FROM   mezuniyyet order by Mezuniyyet_Durum ASC,Mezuniyyet_Baslagic_Tarixi_Unix DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>№</th>
									<th>Adı,soyadı</th>
									<th>Xidmət ili</th>
									<th>Xidmət ili</th>
									<th>Məzuniyyətin növü</th>
									<th>Gün</th>
									<th>Başlanğıc Tarixi</th>
									<th>Bitiş Tarixi</th>
									<th>İşə çıxma Tarixi</th>
									<th>Əmrin nömrəsi</th>
									<th>Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php 
								$MezuniyyetSira=0;
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									$MezuniyyetSira++;
									?>
									<tr>							
										<td class="siar_no_alani"><?php echo $MezuniyyetSira ?></td>
										<td><?php 
										$user_sor=$db->prepare("SELECT * FROM user where ID=:ID");
										$user_sor->execute(array(
											'ID'=>$Cek['ID']));
										$user_cek=$user_sor->fetch(PDO::FETCH_ASSOC);
										echo $user_cek['Soy_Adi']." ".$user_cek['Adi']." ".$user_cek['Ata_Adi'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Xidmet_Ili_Baslagic'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Xidmet_Ili_Son'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Novleri_Kissa_Ad'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Gun'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Baslagic_Tarixi'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Bitis_Tarixi'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Ise_Cixma_Tarixi'] ?></td>
										<td><?php echo $Cek['Mezuniyyet_Emrinin_Nomresi'] ?></td>										
										<td class="emeliyyatlar_iki_buttom">
											<?php if ($Cek['Mezuniyyet_Durum']==0) {?>											
												<button class="YenileButonlari" id="Sil_<?php echo $Cek['Mezuniyyet_Id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>	
											<?php }else{} ?>
										</td>
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
						Bazada Məzuniyyət əmri yoxdur
					</div>
				</div> 
			<?php 	}	
			
		}else{
			echo '<input type="hidden" id="status" value="errorfull">';			
			echo '<input type="hidden" id="message" value="Xeta baş verdi sistem idarəcisinə məlumat verin">'	;
			exit;
		}
	}else{
		echo '<input type="hidden" id="status" value="errorfull">';			
		echo '<input type="hidden" id="message" value="Xeta baş verdi sistem idarəcisinə məlumat verin">'	;
		exit;
	}

}

?>