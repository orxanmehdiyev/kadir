<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                            =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Ezam_Novu                     =  ReqemlerXaricButunKarakterleriSil($deyer['Ezam_Novu']);
	$Tarixi                        =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Ezam_Baslangic_Tarixi']);
	$Ezam_Baslangic_Tarixi         =  date("Y-m-d",strtotime($deyer['Ezam_Baslangic_Tarixi']));
	$Ezam_Gun_Sayi                 =  ReqemlerXaricButunKarakterleriSil($deyer['Ezam_Gun_Sayi']);
	$Ezam_Olundugu_Yer             =  EditorluIcerikleriFiltrle($deyer['Ezam_Olundugu_Yer']);
	$Ezam_Emri_No                  =  EditorluIcerikleriFiltrle($deyer['Ezam_Emri_No']);
	$Ezam_Sebebi                   =  EditorluIcerikleriFiltrle($deyer['Ezam_Sebebi']);
	$TarixAzcevir                  =  TarixAzCevir($deyer['Ezam_Baslangic_Tarixi']);
	$Ezam_Bitis_Tarixi             =  Traix_Uzerine_Gel($Ezam_Baslangic_Tarixi,$Ezam_Gun_Sayi,"day");	
	$Ezam_Isecixma_Tarixi          =  IscixisiHesabla($Ezam_Bitis_Tarixi, $db);	


	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$mezuniyyetSor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Baslagic_Tarixi<=:Baslagic_Tarixi and Bitis_Tarixi>:Bitis_Tarixi");
	$mezuniyyetSor->execute(array(
		'ID'=>$ID,
		'Baslagic_Tarixi'=>$Ezam_Baslangic_Tarixi,
		'Bitis_Tarixi'=>$Ezam_Baslangic_Tarixi
	));
	$mezuniyyetSay=$mezuniyyetSor->rowCount();

	$EzamiyyeSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID and Ezam_Baslangic_Tarixi<=:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>:Ezam_Bitis_Tarixi");
	$EzamiyyeSor->execute(array(
		'ID'=>$ID,
		'Ezam_Baslangic_Tarixi'=>$Ezam_Baslangic_Tarixi,
		'Ezam_Bitis_Tarixi'=>$Ezam_Baslangic_Tarixi
	));
	$EzamiyyeSay=$EzamiyyeSor->rowCount();
	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($EzamiyyeSay>0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Bu tarixdə əməkdaş ezamiyyededir">';
		exit;
	}elseif($mezuniyyetSay>0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Bu tarixdə əməkdaş məzuniyyətdədir">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($Tarixi)){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}elseif($Ezam_Gun_Sayi<=0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Gun_Sayi">';
		echo '<input type="hidden" id="message" value="Gün yazın">';
		exit;
	}elseif($Ezam_Olundugu_Yer==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Olundugu_Yer">';
		echo '<input type="hidden" id="message" value="Ezam olundugu yer">';
		exit;
	}elseif($Ezam_Emri_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Emri_No">';
		echo '<input type="hidden" id="message" value="Ezam əmrinin nömrəsin yazın">';
		exit;
	}elseif($Ezam_Novu<0 or $Ezam_Novu>1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Novu">';
		echo '<input type="hidden" id="message" value="Ezam növünü secin">';
		exit;
	}
	elseif(TeqvimQeyriIsGunuYoxla($deyer['Ezam_Baslangic_Tarixi'],$db)==0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="İş günü deyil">';
		exit;
	}
	elseif($Ezam_Baslangic_Tarixi<$Tarix_Beynelxalq){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Keçmiş tarixə başlağıç ola bilməz">';
		exit;
	}
	elseif($Ezam_Baslangic_Tarixi==$Tarix_Beynelxalq){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Başlanğıç tarixi bu gün ola bilməz">';
		exit;
	}	
	else{
		$Elave_Et=$db->prepare("INSERT INTO ezamiyye_emri SET                               
			ID=:ID,		
			Ezam_Novu=:Ezam_Novu,		
			Ezam_Olundugu_Yer=:Ezam_Olundugu_Yer,	
			Ezam_Baslangic_Tarixi=:Ezam_Baslangic_Tarixi,
			Ezam_Bitis_Tarixi=:Ezam_Bitis_Tarixi,			
			Ezam_Isecixma_Tarixi=:Ezam_Isecixma_Tarixi,
			Ezam_Gun_Sayi=:Ezam_Gun_Sayi,
			Ezam_Sebebi=:Ezam_Sebebi,
			Ezam_Emri_No=:Ezam_Emri_No
			");
		$Insert=$Elave_Et->execute(array(                                
			'ID'=>$ID,			
			'Ezam_Novu'=>$Ezam_Novu,			
			'Ezam_Olundugu_Yer'=>$Ezam_Olundugu_Yer,		
			'Ezam_Baslangic_Tarixi'=>$Ezam_Baslangic_Tarixi,
			'Ezam_Bitis_Tarixi'=>$Ezam_Bitis_Tarixi,
			'Ezam_Isecixma_Tarixi'=>$Ezam_Isecixma_Tarixi,
			'Ezam_Gun_Sayi'=>$Ezam_Gun_Sayi,	
			'Ezam_Sebebi'=>$Ezam_Sebebi,	
			'Ezam_Emri_No'=>$Ezam_Emri_No	
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