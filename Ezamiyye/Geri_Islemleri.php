<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Ezamiyye_Emri_Id           =  ReqemlerXaricButunKarakterleriSil($deyer['Ezamiyye_Emri_Id']); 
	$Ezamiyye_Geri_Emir_No      =  EditorluIcerikleriFiltrle($deyer['Ezamiyye_Geri_Emir_No']);
	$Ezam_Geri_Sebeb            =  EditorluIcerikleriFiltrle($deyer['Ezam_Geri_Sebeb']);

	$Ezam_Bitis_Tarixi           = date("Y-m-d",strtotime(ReqemlerNokteXaricButunKarakterleriSil($deyer['Ezam_geri_Tarixi']))) ;		




	$EzSor=$db->prepare("SELECT * FROM ezamiyye_emri where Ezamiyye_Emri_Id=:Ezamiyye_Emri_Id");
	$EzSor->execute(array(
		'Ezamiyye_Emri_Id'=>$Ezamiyye_Emri_Id));
	$EzSay=$EzSor->rowCount();
	$EzCek=$EzSor->fetch(PDO::FETCH_ASSOC);
	$Ezam_Baslangic_Tarixi=$EzCek['Ezam_Baslangic_Tarixi'];

	$d1 = new DateTime($Ezam_Bitis_Tarixi);
	$d2 = new DateTime($Ezam_Baslangic_Tarixi);
	$gunferqi= $d1->diff($d2)->d; 




	if($EzSay!=1){
		echo '<input type="hidden" id="status" value="errorfull">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Bu tarixdə əməkdaş ezamiyyededir">';
		exit;
	}elseif($Ezamiyye_Geri_Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezamiyye_Geri_Emir_No">';
		echo '<input type="hidden" id="message" value="Geri çaqrılma əmrinin nömresini yazın">';
		exit;
	}elseif($Ezam_Geri_Sebeb==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Geri_Sebeb">';
		echo '<input type="hidden" id="message" value="Geri çaqrılma səbəbini yazın">';
		exit;
	}
	elseif(TeqvimQeyriIsGunuYoxla($deyer['Ezam_geri_Tarixi'],$db)==0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_geri_Tarixi">';
		echo '<input type="hidden" id="message" value="İş günü deyil">';
		exit;
	}

	else{
		$Elave_Et=$db->prepare("UPDATE ezamiyye_emri SET                               
			Ezamiyye_Geri_Emir_No=:Ezamiyye_Geri_Emir_No,		
			Ezam_Geri_Sebeb=:Ezam_Geri_Sebeb,			
			Ezam_Bitis_Tarixi=:Ezam_Bitis_Tarixi,	
			Ezam_Isecixma_Tarixi=:Ezam_Isecixma_Tarixi,		
			Ezam_Gun_Sayi=:Ezam_Gun_Sayi
			WHERE Ezamiyye_Emri_Id=$Ezamiyye_Emri_Id
			");
		$Insert=$Elave_Et->execute(array(                                
			'Ezamiyye_Geri_Emir_No'=>$Ezamiyye_Geri_Emir_No,			
			'Ezam_Geri_Sebeb'=>$Ezam_Geri_Sebeb,			
			'Ezam_Bitis_Tarixi'=>$Ezam_Bitis_Tarixi,		
			'Ezam_Isecixma_Tarixi'=>$Ezam_Bitis_Tarixi,
			'Ezam_Gun_Sayi'=>$gunferqi	
		));
		if ($Insert) {		
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
				echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
				$Sor=$db->prepare("SELECT * FROM ezamiyye_emri order by Ezamiyye_Emri_Id DESC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
								<thead class="">
									<tr>									
										<th>Adı,soyadı</th>
										<th>Səbəb</th>
										<th>Başlağıc tarixi</th>
										<th>Bitiş tarixi</th>
										<th>İşə çıxma tarixi</th>
										<th>Gün</th>
										<th>Məzuniyyətin növü</th>
										<th>Ezam Yeri</th>									
										<th>Əmrin nömrəsi</th>
										<th>Sil</th>																							
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php 
									while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {							
										if ($Cek['Ezam_Novu']==0) {
											$Ezam_Novu="Daxili ezamiyyə";
										}else{
											$Ezam_Novu="Xarici ezamiyyə";
										}
										?>
										<tr>
											<td><?php 
											$user_sor=$db->prepare("SELECT * FROM user where ID=:ID");
											$user_sor->execute(array(
												'ID'=>$Cek['ID']));
											$user_cek=$user_sor->fetch(PDO::FETCH_ASSOC);
											echo $user_cek['Soy_Adi']." ".$user_cek['Adi']." ".$user_cek['Ata_Adi'] ?></td>
											<td><?php echo $Cek['Ezam_Sebebi'] ?></td>
											<td><?php echo $Cek['Ezam_Baslangic_Tarixi'] ?></td>
											<td><?php echo $Cek['Ezam_Bitis_Tarixi'] ?></td>									
											<td><?php echo $Cek['Ezam_Isecixma_Tarixi'] ?></td>									
											<td><?php echo $Cek['Ezam_Gun_Sayi'] ?></td>
											<td><?php echo $Ezam_Novu ?></td>
											<td><?php echo $Cek['Ezam_Olundugu_Yer'] ?></td>
											<td><?php echo $Cek['Ezam_Emri_No'] ?></td>																													
											<td class="emeliyyatlar_iki_buttom">	
											<?php if($Cek['Ezam_Bitis_Tarixi']>$Tarix_Beynelxalq){  ?>																				
											<button class="YenileButonlari" id="Sil_<?php echo $Cek['Ezamiyye_Emri_Id'] ?>" onclick="Geri(this.id)" type="button"><i class="fas fa-arrow-circle-left"></i></button>
											<button class="YenileButonlari" id="Sil_<?php echo $Cek['Ezamiyye_Emri_Id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>
										<?php } ?>
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
							Bazada ezamiyyə əmri yoxdur
						</div>
					</div> 
				<?php 	}				
		

		}else{
			echo '<input type="hidden" id="status" value="errorfull">';
			echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
			echo '<input type="hidden" id="message" value="Ikinci melumat xetali">';
			exit;
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>