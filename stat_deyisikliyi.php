<?php 
require_once '_header.php';
?>
<script type="text/javascript" src="StatDeyisikliyiEmirleri/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2" id="yenibutonalanlari">
						<?php 
						$Bos_Vezife_Sor=$db->prepare("SELECT * FROM bosvezife  ");
						$Bos_Vezife_Sor->execute(array(
							'Durum'=>0));
						$Bos_Vezife_Say=$Bos_Vezife_Sor->rowCount();
						if ($Bos_Vezife_Say==0) {	?>
							<button class="YenileButonlari" onclick="VezifeBosalt()" type="button">Vəzifəni boşalt</button>
						<?php }else{?>
							<button class="QirmiziButonlar" onclick="BosaAlinmisiVezifeyeTeyin()" type="button">Boşa alınmış əməkdaşlar</button>
						<?php	}
						?>

						<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>				
					</div>
				</div>				
			</div>
		</div>
		
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM  stat_deyisikliyi  order by Vezifeye_Teyin_Etme_Tarixi DESC");
			$Sor->execute(array(
				'Durum'=>0));
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Adı,soyadı</th>					
									<th>Tarixi</th>
									<th>İdarə</th>
									<th>Bölmə</th>
									<th>Vəzifə</th>
									<th>Əmri No</th>																
									<th>Sil</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
									<tr>								
										<td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>				
										<td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Vezifeye_Teyin_Etme_Tarixi']) ?></td>
										<td>
											<?php 
											$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
											$Idare_Sor->execute(array(
												'Idare_Id'=>$Cek['Islediyi_Idare']));
											$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
											echo $Idare_Cek['Idare_Kissa_Adi'] ?>
										</td>
										<td>
											<?php 
											$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Sobe_Id=:Sobe_Id");
											$Sobe_Sor->execute(array(
												'Sobe_Id'=>$Cek['Islediyi_Sobe']));
											$Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
											echo $Sobe_Cek['Sobe_Ad'] ?>
										</td>
										<td>
											<?php 
											$Vezife_Sor=$db->prepare("SELECT * FROM vezife where Vezife_Id=:Vezife_Id ");
											$Vezife_Sor->execute(array(
												'Vezife_Id'=>$Cek['Vezife_Id']));
											$Vezife_Say=$Vezife_Sor->rowCount();
											$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
											$Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];


											$Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id ");
											$Vezife_Adlari_Sor->execute(array(
												'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));
											$Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC);
											echo $Vezife_Adi=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];
											?>
										</td>
										<td><?php echo $Cek['Vezifeye_Teyin_Etme_Emir_No'] ?></td>
										<?php 
										$NovbetiSor=$db->prepare("SELECT * FROM user where ID=:ID");
										$NovbetiSor->execute(array(
											'ID'=>$Cek['ID']));
										$NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
										?>																									
										<td class="emeliyyatlar_sil_buttom">
											<?php									
											if ($Cek['Vezifeye_Teyin_Etme_Tarixi'] >= $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
												echo SilButonu($Cek['Stat_deyisikliyi_Id']);
											}?>
										</td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada vəzifədən azad etmə əmri yoxdur
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
</div>
<?php 
require_once '_footer.php';
?>
<script>
	CedveliCagir("dataTable");
</script>