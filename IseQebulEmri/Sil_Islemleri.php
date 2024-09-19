<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Ise_Qebul_Emri_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM  ise_qebul_emri where Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id and Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu");
	$Sor->execute(array(
		'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id,
		'Ise_Qebul_Emri_Stausu'=>0));
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
		$Ise_Qebul_Emri_Nomresi=$Cek['Ise_Qebul_Emri_Nomresi'];
		$User_Soy_Ad=$Cek['User_Soy_Ad'];
		$User_Ad=$Cek['User_Ad'];
		$User_Ata_Ad=$Cek['User_Ata_Ad'];
		$User_Dogum_Tarixi=$Cek['User_Dogum_Tarixi'];
		$User_Dogum_Tarixi_Unix=$Cek['User_Dogum_Tarixi_Unix'];
		$User_Fin=$Cek['User_Fin'];
		$User_Yasayis_Unvan=$Cek['User_Yasayis_Unvan'];
		$User_Tehsil_Aldigi_Muesse=$Cek['User_Tehsil_Aldigi_Muesse'];
		$Ixtisas=$Cek['Ixtisas'];
		$User_Ise_Qebul_Tarixi=$Cek['User_Ise_Qebul_Tarixi'];
		$User_Ise_Qebul_Tarixi_Unix=$Cek['User_Ise_Qebul_Tarixi_Unix'];
		$User_Tehsil=$Cek['User_Tehsil'];
		$Usre_Cinsiyeti=$Cek['Usre_Cinsiyeti'];
		$User_Is_Novu=$Cek['User_Is_Novu'];
		$Mezmun=$Cek['Mezmun'];
		$User_Islediyi_Idare=$Cek['User_Islediyi_Idare'];
		$User_Islediyi_Idare_Ad=$Cek['User_Islediyi_Idare_Ad'];
		$User_Islediyi_Sobe_Bolme=$Cek['User_Islediyi_Sobe_Bolme'];
		$User_Islediyi_Sobe_Bolme_Ad=$Cek['User_Islediyi_Sobe_Bolme_Ad'];
		$User_Vezife=$Cek['User_Vezife'];
		$User_Vezife_Ad=$Cek['User_Vezife_Ad'];
		$Ise_Qebul_Emri_Stausu=$Cek['Ise_Qebul_Emri_Stausu'];
		$Seo_Url=$Cek['Seo_Url'];
		$SinaqMuddeti=$Cek['SinaqMuddeti'];
		$SinaqMuddetiGunAy=$Cek['SinaqMuddetiGunAy'];
		$SinaqMuddetiBitis=$Cek['SinaqMuddetiBitis'];
		$sil = $db->prepare("DELETE from ise_qebul_emri where Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id and Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu");
		$kontrol = $sil->execute(array(
			'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id,
			'Ise_Qebul_Emri_Stausu'=>0
		));
		if ($kontrol) {

			?>
			<input type="hidden" id="yenilendi">
			<?php 
			$Sor=$db->prepare("SELECT * FROM  ise_qebul_emri order by Ise_Qebul_Emri_Id DESC ");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
						<table style="white-space: normal;" class="table table-bordered table-hover" id="iseqebulemirleritablo">
							<thead>
								<tr>
									<th></th>
									<th>Nömrə</th>
									<th>Əmir №</th>
									<th>Məksədi</th>
									<th>Tarix</th>
									<th>Status</th>																
									<th>Qeyd</th>																
								</tr>
							</thead>
							<tbody id="list" class="table_ici">
								<?php 
								$Sira_Nomir=0;
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									$Sira_Nomir++;
									$OgluQizi = ( $Cek['Usre_Cinsiyeti'] == 0 ) ? "oğlunun işə qəbul əmri" : "qızının işə qəbul əmri";

									?>
									<tr>		
										<td class="emir_sec_alani">										
											<button class="YenileButonlari" id="Bax_<?php echo $Cek['Ise_Qebul_Emri_Id'] ?>" onclick="Bax(this.id)" type="button">sec</button>
										</td>					
										<td class="siar_no_alani"><?php echo $Cek['Ise_Qebul_Emri_Id'] ?></td>
										<td class="siar_no_alani"><?php echo $Cek['Ise_Qebul_Emri_Nomresi'] ?></td>
										<td><?php echo $Cek['User_Soy_Ad']." ".$Cek['User_Ad']." ".$Cek['User_Ata_Ad']." ".$OgluQizi ?></td>
										<td class="textaligncenter"><?php echo  date("d.m.Y", $Cek['User_Ise_Qebul_Tarixi_Unix']); ?></td>
										<td class="textaligncenter <?php echo  $Cek['Ise_Qebul_Emri_Stausu']==0?"sariarxafon":""?>" ><?php 
										if ($Cek['Ise_Qebul_Emri_Stausu']==0) {
											echo 'Təsdiq Gözləyir';
										}elseif($Cek['Ise_Qebul_Emri_Stausu']==1){
											echo 'Təsdiqləndi';
										}
										?>									
									</td>
									<td ><?php echo $Cek['Mezmun'] ?>	</td>												
								</tr>	
							<?php }
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php }		
	}else{
		echo "error_1002";/*Silinmə uğursuz*/
		exit;
	}
}else{
	echo "error_1001";/*Silmək üçün İD tapılmadı*/
	exit;
}
}else{
	header("Location:../ise_qebul_emri");
	exit;
}

?>