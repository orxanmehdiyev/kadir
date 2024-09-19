<?php require_once '_header.php';?>
<script type="text/javascript" src="MezuniyyetdenGeriCagrilamEmri/Script.js"></script>		
<div  class="mt-2">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="d-flex  justify-content-between">
					<div class="p-2"></div>
					<div class="p-2" id="cavabid"></div>
					<div class="p-2">
						<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>				
					</div>
				</div>				
			</div>
		</div>		
		<div class="card-body" id="icerik">
			<?php 
			$Sor=$db->prepare("SELECT * FROM mezuniyyet_geri order by Mezuniyyet_Geri_Tarix DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>№</th>
									<th>Adı</th>
									<th>Soyadı</th>
									<th>Ata adı</th>
									<th>Geri Çağrılam Tarixi</th>									
									<th>Əmrin nömrəsi</th>
									<th>Əməliyatlar</th>																							
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php 
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									$user_sor=$db->prepare("SELECT * FROM user where ID=:ID");
									$user_sor->execute(array(
										'ID'=>$Cek['ID']));
									$user_cek=$user_sor->fetch(PDO::FETCH_ASSOC);
									?>
									<tr>									
										<td><?php echo $user_cek['Soy_Adi'] ?></td>									
										<td><?php echo $$user_cek['Adi'] ?></td>									
										<td><?php echo $user_cek['Ata_Adi'] ?></td>									
										<td><?php echo TarixAzCevir($Cek['Mezuniyyet_Geri_Tarix']) ?></td>
										<td><?php echo $Cek['Mezuniyyet_Geri_Emir_No'] ?></td>																	
										<td class="emeliyyatlar_iki_buttom">																	
											<button class="YenileButonlari" id="Sil_<?php echo $Cek['Mezuniyyet_Geri_Id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>	
										</td>
									</tr>	
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada məzuniyyətdən geri çağrılma əmri yoxdur
					</div>
				</div> 
			<?php }	?>
		</div>
	</div>
</div>
<?php require_once '_footer.php'; ?>
<script>
	CedveliCagir("dataTable");
</script>