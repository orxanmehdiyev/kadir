<?php
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer = json_decode($_POST['Deyer'], true);
	$ID           =  ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$Cixis_Sebebi =  EditorluIcerikleriFiltrle($deyer['Cixis_Sebebi']);

	$User_Sor = $db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID' => $ID,
		'Durum' => 1
	));
	$User_Say = $User_Sor->rowCount();
	$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);

	$Soy_Adi = $User_Cek['Soy_Adi'];
	$Adi = $User_Cek['Adi'];
	$Ata_Adi = $User_Cek['Ata_Adi'];

	$UserSor = $db->prepare("SELECT * FROM isedavamiyyet where ID=:ID and istiqamet=:istiqamet order by isedavamiyyet_id DESC");
	$UserSor->execute(array(
		'ID' => $ID,
		'istiqamet' => 0
	));
	$UserSay = $UserSor->rowCount();
	$UserCek = $UserSor->fetch(PDO::FETCH_ASSOC);
	$Idare_Id = $UserCek['Idare_Id'];
	$Idare_Ad = $UserCek['Idare_Ad'];
	$isedavamiyyet_id = $UserCek['isedavamiyyet_id'];
	$Tarix = $UserCek['Tarix'];
	$Saat = $UserCek['Saat'];



	if ($User_Say != 1) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="ID">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	} else {
		$Elave_Et = $db->prepare("INSERT INTO cixislarinqeydiyyati SET
			Ata_Adi=:Ata_Adi, 
			Soy_Adi=:Soy_Adi, 
			Adi=:Adi, 
			ID=:ID, 
			Idare_Id=:Idare_Id,
			Idare_Ad=:Idare_Ad,
			isedavamiyyet_id=:isedavamiyyet_id,
			Tarix=:Tarix,
			Saat=:Saat,
			Cixis_Sebebi=:Cixis_Sebebi
			");
		$Insert = $Elave_Et->execute(array(
			'Ata_Adi' => $Ata_Adi,
			'Soy_Adi' => $Soy_Adi,
			'Adi' => $Adi,
			'ID' => $ID,
			'Idare_Id' => $Idare_Id,
			'Idare_Ad' => $Idare_Ad,
			'isedavamiyyet_id' => $isedavamiyyet_id,
			'Tarix' => $Tarix,
			'Saat' => $Saat,
			'Cixis_Sebebi' => $Cixis_Sebebi
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