<?php 
require_once '_header.php';
?>
<script type="text/javascript" src="VezifedenAzadEtme/Script.js"></script>		
<div class="card-body">
	<div class="axtaralani">
		<form id="axtarisadsoyadataadi">
			<label for="axtarsoyad" class="axtarlabel">Soyadı:</label>
			<input type="text"  autocomplete="off" class="axtarinput" id="axtarsoyad" name="axtarsoyad">
			<label for="axtarad" class="axtarlabel">Adı:</label>
			<input type="text"  autocomplete="off" class="axtarinput" id="axtarad" name="axtarad">
			<label for="axtarataadi" class="axtarlabel">Ata adı:</label>
			<input type="text"  autocomplete="off" class="axtarinput" id="axtarataadi" name="axtarataadi">
			<button type="button" class="axtarbutonu" onclick="Axtar()" >Axtar</button>
			<a href="" title="Bu düyməni basın və açılan pəncərə içərisində müvafiq xanaları seçməklə daha ətraflı axtarış edə bilərsiniz">Ətraflı axtarış</a>
			<button  style="float:right;" class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>		
		</form>	
	</div>		
	<div class="bolmeleralanlari" id="icerik">
		<?php 
		$Sor=$db->prepare("SELECT * FROM vezifeden_azad_edilme  order by Vezifeden_Azad_Etme_Tarix DESC");
		$Sor->execute(array(
			'Durum'=>0));
		$Say=$Sor->rowCount();
		if ($Say>0) {?>
			<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
				<thead>
					<tr>
						<th>Adı,soyadı</th>
						<th>Səbəb</th>
						<th>Tarixi</th>
						<th>Əmri No</th>																
						<th>Sil</th>																							
					</tr>
				</thead>
				<tbody id="list" class="table_ici">
					<?php 				
					while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
						if ($Cek['Sebeb']==1) {
							$Sebeb="Ştat tədbiri";
						}elseif ($Cek['Sebeb']==2) {
							$Sebeb="İntizam tənbehi";
						}else{
							$Sebeb="";
						}
						?>
						<tr>								
							<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>
							<td><?php echo $Sebeb ?></td>
							<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Vezifeden_Azad_Etme_Tarix']) ?></td>
							<td><?php echo $Cek['Vezifeden_Azad_Etme_Emir_No'] ?></td>
							<?php 
							$NovbetiSor=$db->prepare("SELECT * FROM user where ID=:ID");
							$NovbetiSor->execute(array(
								'ID'=>$Cek['ID']));
							$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
							?>																									
							<td class="emeliyyatlar_sil_buttom">
								<?php									
								if ($Cek['Vezifeden_Azad_Etme_Tarix'] > $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
									echo SilButonu($Cek['Vezifeden_Azad_Etme_Id']);
								}?>
							</td>
						</tr>	
					<?php }	?>
				</tbody>
			</table>
		<?php }else{	?>
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