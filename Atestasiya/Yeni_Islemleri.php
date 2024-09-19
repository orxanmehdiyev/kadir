<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                      =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Attestasiya_Qerar       =  ReqemlerXaricButunKarakterleriSil($deyer['Attestasiya_Qerar']);
	$Tarixi                  =  ReqemlerNokteXaricButunKarakterleriSil($deyer['Attestasiya_Tarix']);
	$Attestasiya_Tarix       =  date("Y-m-d",strtotime($deyer['Attestasiya_Tarix']));
	$Topladigi_Bal           =  ReqemlerXaricButunKarakterleriSil($deyer['Topladigi_Bal']);
	$Attestasiya_Emr_No      =  EditorluIcerikleriFiltrle($deyer['Attestasiya_Emr_No']);
	if ($Attestasiya_Qerar==0) {
		$Attestasiya_Tarix_Novbeti=Traix_Uzerine_Gel($Attestasiya_Tarix,5,"year");
	}else{
		$Attestasiya_Tarix_Novbeti=Traix_Uzerine_Gel($Attestasiya_Tarix,1,"year");
	}

	if ($Topladigi_Bal<=49) {
		$Qiymetlendirme_Bali=0;
	}elseif($Topladigi_Bal>=50 and $Topladigi_Bal<=60){
		$Qiymetlendirme_Bali=2;
	}elseif($Topladigi_Bal>=61 and $Topladigi_Bal<=70){
		$Qiymetlendirme_Bali=4;
	}elseif($Topladigi_Bal>=71 and $Topladigi_Bal<=80){
		$Qiymetlendirme_Bali=6;
	}elseif($Topladigi_Bal>=81 and $Topladigi_Bal<=90){
		$Qiymetlendirme_Bali=8;
	}elseif($Topladigi_Bal>=91){
		$Qiymetlendirme_Bali=10;
	}


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
	}elseif($Topladigi_Bal<=0){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Topladigi_Bal">';
		echo '<input type="hidden" id="message" value="Topladığı bal">';
		exit;
	}elseif($Attestasiya_Qerar==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Attestasiya_Qerar">';
		echo '<input type="hidden" id="message" value="Qərarı secin">';
		exit;
	}elseif($Attestasiya_Emr_No==""){
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="Attestasiya_Emr_No">';
		echo '<input type="hidden" id="message" value="Əmrinin nömrəsin yazın">';
		exit;
	}
	else{
		$Elave_Et=$db->prepare("INSERT INTO attestasiya_emri SET                               
			ID=:ID,		
			Attestasiya_Tarix=:Attestasiya_Tarix,		
			Attestasiya_Qerar=:Attestasiya_Qerar,	
			Attestasiya_Tarix_Novbeti=:Attestasiya_Tarix_Novbeti,
			Attestasiya_Emr_No=:Attestasiya_Emr_No,			
			Topladigi_Bal=:Topladigi_Bal,
			Qiymetlendirme_Bali=:Qiymetlendirme_Bali,
			Idare_Id=:Idare_Id,
			Idare_Adi=:Idare_Adi,
			Sobe_Id=:Sobe_Id,
			Sobe_Ad=:Sobe_Ad,
			Vezife_Id=:Vezife_Id,
			Vezife_Ad=:Vezife_Ad
			");
		$Insert=$Elave_Et->execute(array(                                
			'ID'=>$ID,			
			'Attestasiya_Tarix'=>$Attestasiya_Tarix,			
			'Attestasiya_Qerar'=>$Attestasiya_Qerar,		
			'Attestasiya_Tarix_Novbeti'=>$Attestasiya_Tarix_Novbeti,
			'Attestasiya_Emr_No'=>$Attestasiya_Emr_No,
			'Topladigi_Bal'=>$Topladigi_Bal,
			'Qiymetlendirme_Bali'=>$Qiymetlendirme_Bali,
			'Idare_Id'=>$Idare_Id,
			'Idare_Adi'=>$Idare_Adi,
			'Sobe_Id'=>$Sobe_Id,
			'Sobe_Ad'=>$Sobe_Ad,
			'Vezife_Id'=>$Vezife_Id,
			'Vezife_Ad'=>$Vezife_Ad
		));
		if ($Insert) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Attestasiya_Tarix">';
			echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
			$Sor=$db->prepare("SELECT * FROM  attestasiya_emri order by Attestasiya_Tarix DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Adı,soyadı</th>									
									<th>Tarixi</th>
									<th>Qərar</th>
									<th>Növbəti tarix</th>
									<th>Əmir №</th>
									<th>Topladığı bal</th>
									<th>Qiymətləndirməsi</th>						
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php	while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { 
									if ($Cek['Attestasiya_Qerar']==0) {
										$Attestasiya_Qerar="Tutduğu vəzifəyə uyğundur";
									}elseif ($Cek['Attestasiya_Qerar']==1) {
										$Attestasiya_Qerar="Tutduğu vəzifəyə şərtli uyğundur";
									}elseif ($Cek['Attestasiya_Qerar']==2) {
										$Attestasiya_Qerar="Tutduğu vəzifəyə şərtli uyğun deyil";
									}
									?>
									<tr>	
										<td><?php echo  AdiSoyadiAtaadi($Cek['ID'], $db);	?></td>
										<td><?php echo date("d.m.Y",strtotime($Cek['Attestasiya_Tarix']))?></td>
										<td><?php echo $Attestasiya_Qerar ?></td>
										<td><?php echo date("d.m.Y",strtotime($Cek['Attestasiya_Tarix_Novbeti']))?></td>															
										<td><?php echo $Cek['Attestasiya_Emr_No'] ?></td>
										<td><?php echo $Cek['Topladigi_Bal'] ?></td>								
										<td><?php echo $Cek['Qiymetlendirme_Bali'] ?></td>			
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