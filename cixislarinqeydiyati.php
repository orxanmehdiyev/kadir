<?php
require_once '_header.php';
?>
<script type="text/javascript" src="CixislarinQeydiyati/Script.js"></script>
<div class="card-body">
	<div class="axtaralani">
		<form id="axtarisadsoyadataadi">
			<label for="axtarsoyad" class="axtarlabel">Soyadı:</label>
			<input type="text" autocomplete="off" class="axtarinput" id="axtarsoyad" name="axtarsoyad">
			<label for="axtarad" class="axtarlabel">Adı:</label>
			<input type="text" autocomplete="off" class="axtarinput" id="axtarad" name="axtarad">
			<label for="axtarataadi" class="axtarlabel">Ata adı:</label>
			<input type="text" autocomplete="off" class="axtarinput" id="axtarataadi" name="axtarataadi">
			<button type="button" class="axtarbutonu" onclick="Axtar()">Axtar</button>
			<button style="float:right;" class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>
		</form>
	</div>
	<div class="bolmeleralanlari" id="icerik">
		<?php
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
	</div>

</div>
<?php
require_once '_footer.php';
?>
<script>
	CedveliCagir("dataTable");
</script>