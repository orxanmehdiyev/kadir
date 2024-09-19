<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                         =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Sertifikat_Novu            =  ReqemlerXaricButunKarakterleriSil($deyer['Sertifikat_Novu']);
	$Sertifikat_Qiymetlendirme  =  ReqemlerXaricButunKarakterleriSil($deyer['Sertifikat_Qiymetlendirme']);
	$Sertifikat_No              =  EditorluIcerikleriFiltrle($deyer['Sertifikat_No']);	
	$Sertifikat_Verilme_Tarix   =  date("Y-m-d",strtotime($deyer['Sertifikat_Verilme_Tarix']));
	$Tarixi                     =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Sertifikat_Verilme_Tarix']);
	$Telim_Seminar_Adi          =  EditorluIcerikleriFiltrle($deyer['Telim_Seminar_Adi']);
	$Sertifikat_Emir_No         =  EditorluIcerikleriFiltrle($deyer['Sertifikat_Emir_No']);
	$Sertifikat_Emir_Tarix      =  date("Y-m-d",strtotime($deyer['Sertifikat_Emir_Tarix']));
	$Tarixiiki                  =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Sertifikat_Emir_Tarix']);

	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$Idare_Id=$User_Cek['Islediyi_Idare_Id'];
	$Idare_Adi=$User_Cek['Idare_Ad'];
	$Sobe_Id=$User_Cek['Islediyi_Sobe_Id'];
	$Sobe_Ad=$User_Cek['Sobe_Ad'];
	$Vezife_Id=$User_Cek['Vezife_Id'];
	$Vezife_Ad=$User_Cek['Vezife_Ad'];

	if ($User_Say!=1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	}elseif($Tarixi!=TarixAzCevir($Tarixi)){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}elseif($Sertifikat_Novu==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Sertifikat_Novu">';
		echo '<input type="hidden" id="message" value="Sertifikat Növü Secilməyib">';
		exit;
	}elseif($Sertifikat_Qiymetlendirme==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Sertifikat_Qiymetlendirme">';
		echo '<input type="hidden" id="message" value="Sertifikat Qiyməti secilməyib">';
		exit;
	}elseif($Sertifikat_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Sertifikat_No">';
		echo '<input type="hidden" id="message" value="Sertifikatın nömrəsini qeyd edin">';
		exit;
	}elseif($Telim_Seminar_Adi==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Telim_Seminar_Adi">';
		echo '<input type="hidden" id="message" value="Təlim seminarın adını qeyd edin">';
		exit;
	}elseif($Sertifikat_Emir_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Sertifikat_Emir_No">';
		echo '<input type="hidden" id="message" value="Sertifikat əmrinin nömrəsini qeyd edin">';
		exit;
	}

	elseif($Tarixiiki!=TarixAzCevir($Tarixiiki)){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Ezam_Baslangic_Tarixi">';
		echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
		exit;
	}else{
		$Elave_Et=$db->prepare("INSERT INTO sertifikat SET                               
			ID=:ID,		
			Sertifikat_Novu=:Sertifikat_Novu,		
			Sertifikat_Qiymetlendirme=:Sertifikat_Qiymetlendirme,	
			Sertifikat_No=:Sertifikat_No,
			Sertifikat_Verilme_Tarix=:Sertifikat_Verilme_Tarix,			
			Sertifikat_Emir_No=:Sertifikat_Emir_No,
			Sertifikat_Emir_Tarix=:Sertifikat_Emir_Tarix,
			Telim_Seminar_Adi=:Telim_Seminar_Adi,
			Idare_Id=:Idare_Id,
			Idare_Adi=:Idare_Adi,
			Sobe_Id=:Sobe_Id,
			Sobe_Ad=:Sobe_Ad,
			Vezife_Id=:Vezife_Id,
			Vezife_Ad=:Vezife_Ad
			");
		$Insert=$Elave_Et->execute(array(                                
			'ID'=>$ID,			
			'Sertifikat_Novu'=>$Sertifikat_Novu,			
			'Sertifikat_Qiymetlendirme'=>$Sertifikat_Qiymetlendirme,		
			'Sertifikat_No'=>$Sertifikat_No,
			'Sertifikat_Verilme_Tarix'=>$Sertifikat_Verilme_Tarix,
			'Sertifikat_Emir_No'=>$Sertifikat_Emir_No,
			'Sertifikat_Emir_Tarix'=>$Sertifikat_Emir_Tarix,
			'Telim_Seminar_Adi'=>$Telim_Seminar_Adi,
			'Idare_Id'=>$Idare_Id,
			'Idare_Adi'=>$Idare_Adi,
			'Sobe_Id'=>$Sobe_Id,
			'Sobe_Ad'=>$Sobe_Ad,
			'Vezife_Id'=>$Vezife_Id,
			'Vezife_Ad'=>$Vezife_Ad
		));
		if ($Insert) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Sertifikat_Emir_Tarix">';
			echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
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
										<td><?php echo date("d.m.Y",strtotime($Cek['Sertifikat_Verilme_Tarix']))?></td>
										<td><?php echo  IdareQissaAdi($Idare_Id, $db);	?></td>
										<td><?php echo  SobeAdi($Sobe_Id, $db);	?></td>
										<td><?php echo  VezifeAdi($Vezife_Id, $db);	?></td>
										<td><?php echo  RutbeAdi($Cek['ID'], $db);	?></td>
										<td><?php echo $Cek['Sertifikat_Emir_No'] ?></td>					
										<td><?php echo date("d.m.Y",strtotime($Cek['Sertifikat_Emir_Tarix']))?></td>															
											
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
						Bazada attestasiya əmri yoxdur
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