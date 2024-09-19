<?php
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer = json_decode($_POST['Deyer'], true);
	$xidmet_yerleri_ad =  EditorluIcerikleriFiltrle($deyer['xidmet_yerleri_ad']);

	if (!strlen($xidmet_yerleri_ad) > 0) {
		echo '<input type="hidden" id="status" value="error">';
		echo '<input type="hidden" id="statusiki" value="xidmet_yerleri_ad">';
		echo '<input type="hidden" id="message" value="Əməkdaş düzgün secilmeyib">';
		exit;
	} else {
		$Elave_Et = $db->prepare("INSERT INTO xidmet_yerleri_ad SET
			xidmet_yerleri_ad=:xidmet_yerleri_ad
			");
		$Insert = $Elave_Et->execute(array(
			'xidmet_yerleri_ad' => $xidmet_yerleri_ad
		));
		if ($Insert) {
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Tarix">';
			echo '<input type="hidden" id="message" value="Uğurla əlave olundu">';
			$Sor = $db->prepare("SELECT * FROM xidmet_yerleri_ad  order by xidmet_yerleri_ad ASC");
			$Sor->execute();
			$Say = $Sor->rowCount();
			if ($Say > 0) { ?>
				<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
				<thead>
					<tr>
						<th>Xidmət yeri</th>
						<th class="emeliyyatlar_iki_buttom"></th>
					</tr>
				</thead>
				<tbody id="list" class="table_ici">
					<?php while ($Cek = $Sor->fetch(PDO::FETCH_ASSOC)) { ?>
						<tr>
							<td><?php echo $Cek['xidmet_yerleri_ad'] ?></td>
							<td class="emeliyyatlar_iki_buttom"><?php
							echo  SilButonu($Cek['xidmet_yerleri_ad_id']);
							 ?></td>
						</tr>
					<?php }	?>
				</tbody>
			</table>
			<?php } else {	?>
				<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
				<thead class="">
					<tr>
						<th>Xidmət yeri</th>					
						<th class="emeliyyatlar_iki_buttom"></th>					
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