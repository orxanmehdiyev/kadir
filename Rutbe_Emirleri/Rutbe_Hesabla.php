<?php require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                  =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$Tarixi   =  $deyer['Rutbe_Emri_Tarixi'];
	$Rutbe_Emri_Tarixi=TarixBeynelxalqCevir($deyer['Rutbe_Emri_Tarixi']);
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);

	$Intizam_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and  Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id<>:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id and  Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:baslagic and Intizam_Tenbehinin_Bitis_Tarixi>:Bitis");
	$Intizam_Sor->execute(array(
		'ID'=>$ID,
		'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>1,
		'baslagic'=>$Rutbe_Emri_Tarixi,
		'Bitis'=>$Rutbe_Emri_Tarixi
	));
	$Intizam_Say=$Intizam_Sor->rowCount();
	$Intizam_Cek=$Intizam_Sor->fetch(PDO::FETCH_ASSOC);
	$Intizam_Tenbehinin_Bitis_Tarixi=$Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi'];
	$Intizam_Bitis_Tarixi=Tarix_Beynelxalqi_Az_Cevir($Intizam_Cek['Intizam_Tenbehinin_Bitis_Tarixi']);

	$Rutbe_Emri_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
	$Rutbe_Emri_Sor->execute(array(
		'ID'=>$ID));
	$Rutbe_Emri_Cek=$Rutbe_Emri_Sor->fetch(PDO::FETCH_ASSOC);
	$Rutbe_Emri_Say=$Rutbe_Emri_Sor->rowCount();


	$Rutbe_Vaxdindan_Evvel_Sor=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID and Rutbe_Emri_Novu=:Rutbe_Emri_Novu");
	$Rutbe_Vaxdindan_Evvel_Sor->execute(array(
		'ID'=>$ID,
		'Rutbe_Emri_Novu'=>3
	));

	$Rutbe_Bir_Pille_Yuxari=$db->prepare("SELECT * FROM rutbe_emri where ID=:ID and Rutbe_Emri_Novu=:Rutbe_Emri_Novu");
	$Rutbe_Bir_Pille_Yuxari->execute(array(
		'ID'=>$ID,
		'Rutbe_Emri_Novu'=>4
	));

	$Son_Aldigi_Rutbenin_Tarixi=$Rutbe_Emri_Cek['Rutbe_Emri_Tarixi'];	
	$Rutbe_Id=$Rutbe_Emri_Cek['Rutbe_Id'];
	$Rutbe_Vaxdindan_Evvel_Verilmesi=$Rutbe_Vaxdindan_Evvel_Sor->rowCount();
	$Rutbe_Nezerde_Tutulandan_Bir_Pille_Yuxari_Verilmesi=$Rutbe_Bir_Pille_Yuxari->rowCount();


	$Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
	$Rutbe_Sor->execute(array(
		'Rutbe_Id'=>$Rutbe_Id));
	$Rutbe_Cek=$Rutbe_Sor->fetch(PDO::FETCH_ASSOC);
	$Rutbe_Xidmet_Ili=$Rutbe_Cek['Rutbe_Xidmet_Ili'];
	$ay=$Rutbe_Xidmet_Ili * 12;
	$XidmetiliYarisi=$ay/2;		
	
	$butonlari='	<button type="button" onclick="YeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
	<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>';
	$rutbebutonlari="";
	$Rutbe_Emri_Novu="";

	$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id ");
	$Vezife_Sor->execute(array(
		'User_Id'=>$ID));
	$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
	$Zabit_Mulu=$Vezife_Cek['Zabit_Mulu'];
	$AlaBileceyiRutbe=$Vezife_Cek['AlaBileceyiRutbe'];


	$Ala_Rutbe_Sor=$db->prepare("SELECT * FROM rutbe where Rutbe_Id=:Rutbe_Id");
	$Ala_Rutbe_Sor->execute(array(
		'Rutbe_Id'=>$AlaBileceyiRutbe));
	$Ala_Rutbe_Cek=$Ala_Rutbe_Sor->fetch(PDO::FETCH_ASSOC);

	$Faktiki_Rutbenin_Sira_Nomresi=$Rutbe_Cek['Rutbe_Sira_No'];
	$Maksimal_Rutbe_Sira_No=$Ala_Rutbe_Cek['Rutbe_Sira_No'];
	$Novbeti_Rutbenin_Sira_Nomresi=$Faktiki_Rutbenin_Sira_Nomresi+1;
	if ($Intizam_Say==0) {
		if ($Zabit_Mulu==0) {

			if ($Rutbe_Emri_Say==0) {
				$ilkinrutbe="<li class='verilebiler'>İlkin xüsusi rütbə verilə bilər - <b>{$TekTarix}</b> - tarixdən</li>";
				$Rutbe_Emri_Novu='<option value="1">İlkin xüsusi rütbənin verilməsi</option>';
				$rutbebutonlari=$butonlari;
				$data['rutbeverilmemelumati']=$ilkinrutbe;
			}else{	
				$uzerineAyGel="month";
				$Novbeti_Rutbe_Tarixi=Traix_Uzerine_Gel($Son_Aldigi_Rutbenin_Tarixi,$ay,$uzerineAyGel);

				$Intizam_Bitis_Sor=$db->prepare("SELECT * FROM intizam_tenbehi where ID=:ID and Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id<>:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id and  Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix<:baslagic and Intizam_Tenbehinin_Bitis_Tarixi>:Bitis");
				$Intizam_Bitis_Sor->execute(array(
					'ID'=>$ID,
					'Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id'=>1,
					'baslagic'=>$Novbeti_Rutbe_Tarixi,
					'Bitis'=>$Novbeti_Rutbe_Tarixi
				));
				$Intizam_Bitis_Say=$Intizam_Bitis_Sor->rowCount();
				$Intizam_Bitis_Cek=$Intizam_Bitis_Sor->fetch(PDO::FETCH_ASSOC);
				$Intizam_Tenbehinin_Bitis=$Intizam_Bitis_Cek['Intizam_Tenbehinin_Bitis_Tarixi'];
				if ($Intizam_Bitis_Say==1) {
					$novbetitarix=$Intizam_Tenbehinin_Bitis;
				}else{
					$novbetitarix=$Novbeti_Rutbe_Tarixi;
				}

				$Vaxdindanevvel_Unix=Traix_Uzerine_Gel($Son_Aldigi_Rutbenin_Tarixi,$XidmetiliYarisi,$uzerineAyGel);
				if ($Novbeti_Rutbe_Tarixi<=$Rutbe_Emri_Tarixi and $Faktiki_Rutbenin_Sira_Nomresi<$Maksimal_Rutbe_Sira_No) {
					$ilkinrutbe="<li class='verilebiler'>Növbəti xüsusi rütbə verilə bilər - <b>".Tarix_Beynelxalqi_Az_Cevir($novbetitarix)."</b> - tarixdən</li>";
					$Rutbe_Emri_Novu='<option value="2">Növbəti xüsusi rütbənin verilməsi</option>';
					$rutbebutonlari=$butonlari;
					$data['rutbeverilmemelumati']=$ilkinrutbe;
				}	
				elseif ($Rutbe_Vaxdindan_Evvel_Verilmesi<2 and $Vaxdindanevvel_Unix<=$Rutbe_Emri_Tarixi and $Novbeti_Rutbe_Tarixi>$Rutbe_Emri_Tarixi and $Novbeti_Rutbenin_Sira_Nomresi<=$Maksimal_Rutbe_Sira_No) {
					$ilkinrutbe="<li class='verilebiler'>Vaxdindan əvvəl xüsusi rütbə verilə bilər - <b>".Tarix_Beynelxalqi_Az_Cevir($Vaxdindanevvel_Unix)."</b> - tarixdən</li>";
					$Rutbe_Emri_Novu='<option value="3">Vaxdindan əvvəl xüsusi rütbənin verilməsi</option>';
					$rutbebutonlari=$butonlari;
					$data['rutbeverilmemelumati']=$ilkinrutbe;
				}

				elseif ($Rutbe_Nezerde_Tutulandan_Bir_Pille_Yuxari_Verilmesi<2 and $Novbeti_Rutbe_Tarixi<=$Rutbe_Emri_Tarixi and $Faktiki_Rutbenin_Sira_Nomresi==$Maksimal_Rutbe_Sira_No) {
					$ilkinrutbe="<li class='verilebiler'>Tutduğu vəzifədən bir pillə yuxarı xüsusi rütbə verilə bilər - <b>{$NovbetiRutbeTarixiAz}</b> - tarixdən</li>";
					$Rutbe_Emri_Novu='<option value="4">Tutduğu vəzifədən yuxarı xüsusi rütbənin verixlməsi</option>';
					$data['rutbeverilmemelumati']=$ilkinrutbe;
					$rutbebutonlari=$butonlari;
				}else{
					$data['rutbeverilmemelumati']="<li class='verilebilmez'>İlkin rütbənin vaxdıf</li>
					<li class='verilebilmez'>Növbəti xüsusiddd rütbə verilə bilər</li>
					<li class='verilebilmez'>Tutduğu vəzifədən yuxari xüsusi rütbə verilə bilər</li>
					<li class='verilebilmez'>Vaxdından əvvəl növbəti xüsusi rütbə verilə bilər</li>";
				}			
			}		
			$data['Rutbe_Ad']=$Rutbe_Emri_Cek['Rutbe_Adi'];
		}else{
			$data['Rutbe_Ad']="Mülkü";
			$data['rutbeverilmemelumati']="<li class='verilebilmez'>İlkin rütbənin vaxdı</li>
			<li class='verilebilmez'>Növbəti xüsusisss rütbə verilə bilər</li>
			<li class='verilebilmez'>Tutduğu vəzifədən yuxari xüsusi rütbə verilə bilər</li>
			<li class='verilebilmez'>Vaxdından əvvəl növbəti xüsusi rütbə verilə bilər</li>";
		}
	}else{	
		$data['rutbeverilmemelumati']="<li class='verilebiler'>Əməkdaşın üzərində intizam tənbehi var. İntizam tənbehinin bitiş tarixi- <b>".$Intizam_Bitis_Tarixi."</b></li>";
	}
	$data['Idare_Ad']=$User_Cek['Idare_Ad'];
	$data['Sobe_Ad']=$User_Cek['Sobe_Ad'];
	$data['Vezife_Ad']=$User_Cek['Vezife_Ad'];
	$data['Son_Aldigi_Rutbenin_Tarixi']=Tarix_Beynelxalqi_Az_Cevir($Son_Aldigi_Rutbenin_Tarixi);	
	$data['rutbebutonlari']=$rutbebutonlari;
	$data['Rutbe_Emri_Novu']=$Rutbe_Emri_Novu;
	echo json_encode($data);
	exit;
} ?>