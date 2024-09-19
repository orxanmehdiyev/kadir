<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                            =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 	
	$Tarixi                        =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Isden_Cixarilma_Tarixi']);
	$xitam_sebebleri_id            =  ReqemlerXaricButunKarakterleriSil($deyer['xitam_sebebleri_id']);
	$Isden_Cixarilma_Emir_No       =  EditorluIcerikleriFiltrle($deyer['Isden_Cixarilma_Emir_No']);
	$Isden_Cixarilma_Tarixi=date("Y-m-d",strtotime($Tarixi));

	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Isden_Cixarilma_Idare_Id=$User_Cek['Islediyi_Idare_Id'];
	$Isden_Cixarilma_Sobe_Id=$User_Cek['Islediyi_Sobe_Id'];
	$Isden_Cixarilma_Vezife_Id=$User_Cek['Vezife_Id'];
	$Bosalt="";

	$mezuniyyetSor=$db->prepare("SELECT * FROM mezuniyyet where ID=:ID and Baslagic_Tarixi<=:Baslagic_Tarixi and Bitis_Tarixi>:Bitis_Tarixi");
	$mezuniyyetSor->execute(array(
		'ID'=>$ID,
		'Baslagic_Tarixi'=>$Isden_Cixarilma_Tarixi,
		'Bitis_Tarixi'=>$Isden_Cixarilma_Tarixi
	));
	$mezuniyyetSay=$mezuniyyetSor->rowCount();

	$EzamiyyeSor=$db->prepare("SELECT * FROM ezamiyye_emri where ID=:ID and Ezam_Baslangic_Tarixi<=:Ezam_Baslangic_Tarixi and Ezam_Bitis_Tarixi>:Ezam_Bitis_Tarixi");
	$EzamiyyeSor->execute(array(
		'ID'=>$ID,
		'Ezam_Baslangic_Tarixi'=>$Isden_Cixarilma_Tarixi,
		'Ezam_Bitis_Tarixi'=>$Isden_Cixarilma_Tarixi
	));
	$EzamiyyeSay=$EzamiyyeSor->rowCount();

	$Xitam_Sebeb_Sor=$db->prepare("SELECT * FROM xitam_sebebleri where xitam_sebebleri_id=:xitam_sebebleri_id");
	$Xitam_Sebeb_Sor->execute(array(
		'xitam_sebebleri_id'=>$xitam_sebebleri_id));
	$Xitam_Sebeb_Cek=$Xitam_Sebeb_Sor->fetch(PDO::FETCH_ASSOC);
	$Xitam_Sebeb_Say=$Xitam_Sebeb_Sor->rowCount();
	$xitam_sebebleri_kisa_ad=$Xitam_Sebeb_Cek['xitam_sebebleri_kisa_ad'];

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($EzamiyyeSay>0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
		echo '<input type="hidden" id="message" value="Bu tarixdə əməkdaş ezamiyyededir">';
		exit;
	}elseif($mezuniyyetSay>0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
		echo '<input type="hidden" id="message" value="Bu tarixdə əməkdaş məzuniyyətdədir">';
		exit;
	}elseif($Xitam_Sebeb_Say!=1){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="xitam_sebebleri_id">';
		echo '<input type="hidden" id="message" value="İşdən çıxarılma səbəbini secin">';
		exit;
	}elseif($Isden_Cixarilma_Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Emir_No">';
		echo '<input type="hidden" id="message" value="Əmrinin nömrəsin yazın">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($deyer['Isden_Cixarilma_Tarixi'])){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}
	elseif(TeqvimQeyriIsGunuYoxla($deyer['Isden_Cixarilma_Tarixi'],$db)==0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
		echo '<input type="hidden" id="message" value="İş günü deyil">';
		exit;
	}
	elseif((strtotime($Tarixi)+86400)<$ZamanDamgasi){
		echo (strtotime($Tarixi)+86400);
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}

	else{
		$Elave_Et=$db->prepare("UPDATE user SET                               
			Isden_Cixarilma_Emir_No=:Isden_Cixarilma_Emir_No,			
			xitam_sebebleri_kisa_ad=:xitam_sebebleri_kisa_ad,			
			xitam_sebebleri_id=:xitam_sebebleri_id,			
			Isden_Cixarilma_Tarixi=:Isden_Cixarilma_Tarixi,
			Isden_Cixarilma_Idare_Id=:Isden_Cixarilma_Idare_Id,			
			Isden_Cixarilma_Sobe_Id=:Isden_Cixarilma_Sobe_Id,			
			Isden_Cixarilma_Vezife_Id=:Isden_Cixarilma_Vezife_Id,
			Islediyi_Idare_Id=:Islediyi_Idare_Id,
			Islediyi_Sobe_Id=:Islediyi_Sobe_Id,
			Vezife_Id=:Vezife_Id,
			Durum=:Durum
			where ID=$ID			
			");
		$Update=$Elave_Et->execute(array(                                
			'Isden_Cixarilma_Emir_No'=>$Isden_Cixarilma_Emir_No,			
			'xitam_sebebleri_kisa_ad'=>$xitam_sebebleri_kisa_ad,			
			'xitam_sebebleri_id'=>$xitam_sebebleri_id,			
			'Isden_Cixarilma_Tarixi'=>$Isden_Cixarilma_Tarixi,
			'Isden_Cixarilma_Idare_Id'=>$Isden_Cixarilma_Idare_Id,			
			'Isden_Cixarilma_Sobe_Id'=>$Isden_Cixarilma_Sobe_Id,			
			'Isden_Cixarilma_Vezife_Id'=>$Isden_Cixarilma_Vezife_Id,		
			'Islediyi_Idare_Id'=>$Bosalt,		
			'Islediyi_Sobe_Id'=>$Bosalt,		
			'Vezife_Id'=>$Bosalt,		
			'Durum'=>0	
		));
		if ($Update) {		
			$Elave_Et=$db->prepare("UPDATE vezife SET                               
				User_Id=:User_Id
				where User_Id=$ID
				");
			$Insert=$Elave_Et->execute(array(                                
				'User_Id'=>$Bosalt
			));
			

			$Elave_Et=$db->prepare("INSERT INTO emir SET
				ID=:ID,                                
				Emir_Tarix=:Emir_Tarix                                
				");
			$Insert=$Elave_Et->execute(array(
				'ID'=>$ID,                                
				'Emir_Tarix'=>$Isden_Cixarilma_Tarixi                                
			));
			$Emir_Id = $db->lastInsertId();
			$yenile=$db->prepare("UPDATE user SET 
				Emir_Id=:Emir_Id
				WHERE ID=$ID");
			$update=$yenile->execute(array(
				'Emir_Id'=>$Emir_Id
			));

			if ($Insert) {
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
				echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
				$Sor=$db->prepare("SELECT * FROM user where Durum=:Durum order by Isden_Cixarilma_Tarixi DESC");
				$Sor->execute(array(
					'Durum'=>0));
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>
								<th>Adı,soyadı</th>
								<th>Səbəb</th>
								<th>Tarixi</th>
								<th>Əmri No</th>																
								<th>Sil</th>																							
							</tr>
						</thead>
						<tbody id="list" class="table_ici">
							<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
								<tr>
									<td><?php echo $Cek['Soy_Adi']." ".$Cek['Adi']." ".$Cek['Ata_Adi'] ?></td>			
									<td><?php echo $Cek['xitam_sebebleri_kisa_ad'] ?></td>
									<td data-sort="<?php echo$Cek['Isden_Cixarilma_Tarixi'] ?>"><?php echo TarixAzCevir($Cek['Isden_Cixarilma_Tarixi']) ?></td>
									<td><?php echo $Cek['Isden_Cixarilma_Emir_No'] ?></td>
									<td class="emeliyyatlar_sil_buttom">	
									<?php 
									if ($Cek['Isden_Cixarilma_Tarixi'] >0 and $Cek['Isden_Cixarilma_Idare_Id'] >0 ) {
										$VezifeSor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id");
										$VezifeSor->execute(array(
											'Vezife_Id'=>$Cek['Isden_Cixarilma_Vezife_Id']));	
										$VezifeCek=$VezifeSor->fetch(PDO::FETCH_ASSOC);
										if (!$VezifeCek['User_Id']>0) { echo SilButonu($Cek['ID']); 
									}

								} ?>
							</td>
								</tr>	
							<?php }
							?>
						</tbody>
					</table>
				<?php }else{	?>
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<thead class="">
							<tr>
								<th>№</th>
								<th>Adı,soyadı</th>
								<th>Səbəb</th>
								<th>Tarixi</th>
								<th>Əmri No</th>																
								<th>Sil</th>																							
							</tr>
						</thead>
					</table> 
				<?php 	}	?>
			<?php	}else{
				echo '<input type="hidden" id="status" value="errorfull">';
				echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
				echo '<input type="hidden" id="message" value="Ikinci melumat xetali">';
				exit;
			}
		}else{
			echo '<input type="hidden" id="status" value="errorfull">';
			echo '<input type="hidden" id="statusiki" value="Isden_Cixarilma_Tarixi">';
			echo '<input type="hidden" id="message" value="Ikinci melumat xetali">';
			exit;
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>