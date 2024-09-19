<?php require_once '_header.php';?>
<script type="text/javascript" src="Sertifikat/Script.js"></script>		
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
			$Sor=$db->prepare("SELECT * FROM  sertifikat order by Sertifikat_Emir_Tarix DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
							<thead class="">
								<tr>
									<th>Adı,soyadı,ataadı</th>									
									<th>Sertifikatın növü</th>
									<th>Təlim/seminarın adı</th>
									<th>Nəticə</th>
									<th>Sertifikatın №</th>
									<th>Sert/tarix</th>						
									<th>İdarə</th>						
									<th>Sturuktur bölmə</th>						
									<th>Vəzifə</th>						
									<th>Rütbə</th>						
									<th>Əmr №</th>						
									<th>Əmrin tarixi</th>						
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php	while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) { 
									if ($Cek['Sertifikat_Novu']==0) {
										$Sertifikat_Novu="Təlim";
									}elseif ($Cek['Sertifikat_Novu']==1) {
										$Sertifikat_Novu="Seminar";
									}

									if ($Cek['Sertifikat_Qiymetlendirme']==0) {
										$Sertifikat_Qiymetlendirme="Yüksək";
									}elseif ($Cek['Sertifikat_Qiymetlendirme']==1) {
										$Sertifikat_Qiymetlendirme="Məqbul";
									}elseif ($Cek['Sertifikat_Qiymetlendirme']==2) {
										$Sertifikat_Qiymetlendirme="Qeyrimeqbul";
									}

									$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
									$User_Sor->execute(array(
										'ID'=>$Cek['ID'],
										'Durum'=>1));
									$User_Say=$User_Sor->rowCount();
									$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
									$Idare_Id=$User_Cek['Islediyi_Idare_Id'];						
									$Sobe_Id=$User_Cek['Islediyi_Sobe_Id'];
									$Vezife_Id=$User_Cek['Vezife_Id'];				

									?>
									<tr>	
										<td><?php echo  AdiSoyadiAtaadi($Cek['ID'], $db);	?></td>
										<td><?php echo $Sertifikat_Novu ?></td>
										<td><?php echo $Cek['Telim_Seminar_Adi'] ?></td>
										<td><?php echo $Sertifikat_Qiymetlendirme ?></td>
										<td><?php echo $Cek['Sertifikat_No'] ?></td>
										<td ata-sort="<?php echo $Cek['Sertifikat_Verilme_Tarix'] ?>"><?php echo date("d.m.Y",strtotime($Cek['Sertifikat_Verilme_Tarix']))?></td>
										<td><?php echo  IdareQissaAdi($Idare_Id, $db);	?></td>
										<td><?php echo  SobeAdi($Sobe_Id, $db);	?></td>
										<td><?php echo  VezifeAdi($Vezife_Id, $db);	?></td>
										<td><?php echo  RutbeAdi($Cek['ID'], $db);	?></td>
										<td><?php echo $Cek['Sertifikat_Emir_No'] ?></td>					
										<td ata-sort="<?php echo $Cek['Sertifikat_Emir_Tarix'] ?>"><?php echo date("d.m.Y",strtotime($Cek['Sertifikat_Emir_Tarix']))?></td>															

									</tr>	
								<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada sertifikat əmri yoxdur
					</div>
				</div> 
			<?php 	}	?>
		</div>
	</div>
</div>
<?php require_once '_footer.php';?>
<script> CedveliCagir("dataTable");</script>
