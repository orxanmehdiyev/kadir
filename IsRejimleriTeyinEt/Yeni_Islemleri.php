<?php
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer = json_decode($_POST['Deyer'], true);
	$ID                     =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$Is_Rejimi              =  ReqemlerXaricButunKarakterleriSil($deyer['Is_Rejimi']);
echo 	$Novbe_Sayi             =  ReqemlerXaricButunKarakterleriSil($deyer['Novbe_Sayi']);
	$Is_Qurupu              =  ReqemlerXaricButunKarakterleriSil($deyer['Is_Qurupu']);
	$Is_Giris_Saati         =  ReqemlerCutNokteXaricButunKarakterleriSil($deyer['Is_Giris_Saati']);
	$Fasile_Saati_Baslagic  =  ReqemlerCutNokteXaricButunKarakterleriSil($deyer['Fasile_Saati_Baslagic']);
	$Fasile_Saati_Bitis     =  ReqemlerCutNokteXaricButunKarakterleriSil($deyer['Fasile_Saati_Bitis']);
	$Is_Cixis_Saati         =  ReqemlerCutNokteXaricButunKarakterleriSil($deyer['Is_Cixis_Saati']);
	$Gunduz                 =  ReqemlerCutNokteXaricButunKarakterleriSil($deyer['Gunduz']);
	$Gece                   =  ReqemlerCutNokteXaricButunKarakterleriSil($deyer['Gece']);
	if (HarflerXaricButunKarakterleriSil($deyer['bir']) == true) {
		$bir = 0;
	} else {
		$bir = 1;
	};
	if (HarflerXaricButunKarakterleriSil($deyer['iki']) == true) {
		$iki = 0;
	} else {
		$iki = 1;
	}
	if (HarflerXaricButunKarakterleriSil($deyer['uc']) == true) {
		$uc = 0;
	} else {
		$uc = 1;
	}
	if (HarflerXaricButunKarakterleriSil($deyer['dord']) == true) {
		$dord = 0;
	} else {
		$dord = 1;
	}
	if (HarflerXaricButunKarakterleriSil($deyer['bes']) == true) {
		$bes = 0;
	} else {
		$bes = 1;
	}
	if (HarflerXaricButunKarakterleriSil($deyer['alti']) == true) {
		$alti = 0;
	} else {
		$alti = 1;
	}
	if (HarflerXaricButunKarakterleriSil($deyer['yeddi']) == true) {
		$yeddi = 0;
	} else {
		$yeddi = 1;
	}

	$User_Sor = $db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID' => $ID,
		'Durum' => 1
	));
	$User_Say = $User_Sor->rowCount();
	$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);

	$Soyadi = $User_Cek['Soy_Adi'];
	$Adi = $User_Cek['Adi'];
	$Ataadi = $User_Cek['Ata_Adi'];
	$Idare_Id = $User_Cek['Islediyi_Idare_Id'];
	$Idare_Adi = $User_Cek['Islediyi_Idare_Id'];


	if ($User_Say != 1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	} else {
		$Elave_Et = $db->prepare("INSERT INTO  is_rejimi SET
			ID=:ID,
			Adi=:Adi,
			Soyadi=:Soyadi,
			Ataadi=:Ataadi,
			Idare_Id=:Idare_Id,
			Idare_Adi=:Idare_Adi,
			Is_Rejimi=:Is_Rejimi,
			Novbe_Sayi=:Novbe_Sayi,
			Is_Qurupu=:Is_Qurupu,
			Tarix=:Tarix,
			Is_Giris_Saati=:Is_Giris_Saati,
			Fasile_Saati_Baslagic=:Fasile_Saati_Baslagic,
			Fasile_Saati_Bitis=:Fasile_Saati_Bitis,
			Is_Cixis_Saati=:Is_Cixis_Saati,
			Gunduz=:Gunduz,
			Gece=:Gece,
			bir=:bir,
			iki=:iki,
			uc=:uc,
			dord=:dord,
			bes=:bes,
			alti=:alti,
			yeddi=:yeddi
			");
		$Insert = $Elave_Et->execute(array(
			'ID' => $ID,
			'Adi' => $Adi,
			'Soyadi' => $Soyadi,
			'Ataadi' => $Ataadi,
			'Idare_Id' => $Idare_Id,
			'Idare_Adi' => $Idare_Adi,
			'Is_Rejimi' => $Is_Rejimi,
			'Novbe_Sayi' => $Novbe_Sayi,
			'Is_Qurupu' => $Is_Qurupu,
			'Tarix' => $Tarix_Beynelxalq,
			'Is_Giris_Saati' => $Is_Giris_Saati,
			'Fasile_Saati_Baslagic' => $Fasile_Saati_Baslagic,
			'Fasile_Saati_Bitis' => $Fasile_Saati_Bitis,
			'Is_Cixis_Saati' => $Is_Cixis_Saati,
			'Gunduz' => $Gunduz,
			'Gece' => $Gece,
			'bir' => $bir,
			'iki' => $iki,
			'uc' => $uc,
			'dord' => $dord,
			'bes' => $bes,
			'alti' => $alti,
			'yeddi' => $yeddi
		
		));
		if ($Insert) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Tarix">';
			echo '<input type="hidden" id="message" value="Tarix düzgün deyil">';
			$Sor = $db->prepare("SELECT * FROM cixislarinqeydiyyati where Tarix=:Tarix order by Saat DESC ");
			$Sor->execute(array(
				'Tarix' => $Tarix_Beynelxalq
			));
			$Say = $Sor->rowCount();
			if ($Say > 0) { ?>
				<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
					<thead>
						<tr>
							<th>Soyadı,Adı,Ata adı</th>
							<th>İdarə</th>
							<th>Tarixi</th>
							<th>Saat</th>
							<th>Çıxış səbəbi</th>
						</tr>
					</thead>
					<tbody id="list" class="table_ici">
						<?php while ($Cek = $Sor->fetch(PDO::FETCH_ASSOC)) { ?>
							<tr>
								<td><?php echo $Cek['Soy_Adi'] . " " . $Cek['Adi'] . " " . $Cek['Ata_Adi']; ?></td>
								<td><?php echo $Cek['Idare_Ad'] ?></td>
								<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Tarix']) ?></td>
								<td><?php echo $Cek['Saat'] ?></td>
								<td><?php echo $Cek['Cixis_Sebebi'] ?></td>
							</tr>
						<?php }	?>
					</tbody>
				</table>
			<?php } else {	?>
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
				</table>
			<?php 	}	?>

<?php	} else {
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
			echo '<input type="hidden" id="message" value="Sistem idarəcisinə məlumat verin">';
			exit;
		}
	}
} else {
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>