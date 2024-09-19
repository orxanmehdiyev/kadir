<?php require_once '_header.php';
 if ($SelahiyyetCek['XidmetYerleriAd']==1) { ?>
<script type="text/javascript" src="XidmetYerleri/Script.js"></script>
<div class="card-body">
	<div class="axtaralani">
		<form id="axtarisadsoyadataadi">
			<button style="float:right;" class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>
		</form>
	</div>
	<div class="bolmeleralanlari" id="icerik">
		<?php
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
	</div>

</div>
<?php require_once '_footer.php'; } ?>
<script>
	CedveliCagir("dataTable");
</script>