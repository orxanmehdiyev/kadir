<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$xidmet_yerleri_ad_id                     =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$sil = $db->prepare("DELETE from xidmet_yerleri_ad where xidmet_yerleri_ad_id=:xidmet_yerleri_ad_id");
		$kontrol = $sil->execute(array(
			'xidmet_yerleri_ad_id'=>$xidmet_yerleri_ad_id
		));	
		if ($kontrol) {			
			echo '<input type="hidden" id="status" value="succes">';
			echo '<input type="hidden" id="statusiki" value="Tarix">';
			echo '<input type="hidden" id="message" value="Uğurla silindi">';
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

<?php	
		}else{
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="Vezifeden_Azad_Etme_Tarix">';
			echo '<input type="hidden" id="message" value="Sistem idarəcisinə məlumat verin">';
			exit;
		}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>