<?php 
require_once '../Ayarlar/setting.php';
if ($IntizamTenbehiAdlariSil==1) {
if (isset($_POST['Deyer'])) {
	$intizam_tenbehi_adlari_id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM intizam_tenbehi_adlari where intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id");
	$Sor->execute(array(
		'intizam_tenbehi_adlari_id'=>$intizam_tenbehi_adlari_id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$intizam_tenbehi_adlari_ad=$Cek['intizam_tenbehi_adlari_ad'];
	$intizam_tenbehi_adlari_Sira_No=$Cek['intizam_tenbehi_adlari_Sira_No'];
	$intizam_tenbehi_adlari_Xususi_No=$Cek['intizam_tenbehi_adlari_Xususi_No'];
	$intizam_tenbehi_adlari_Seo_Url=$Cek['intizam_tenbehi_adlari_Seo_Url'];
	$intizam_tenbehi_adlari_durum=$Cek['intizam_tenbehi_adlari_durum'];
	$intizam_tenbehi_adlari_nezere_alam=$Cek['intizam_tenbehi_adlari_nezere_alam'];
	$Say=$Sor->rowCount();
	if ($Say==1) {
		$sil = $db->prepare("DELETE from intizam_tenbehi_adlari where intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id");
		$kontrol = $sil->execute(array(
			'intizam_tenbehi_adlari_id' => $intizam_tenbehi_adlari_id
		));
		if ($kontrol) {		
			$Elave_Et=$db->prepare("INSERT INTO  intizam_tenbehi_adlari_islemleri SET                               
				intizam_tenbehi_adlari_islemleri_IPadresi=:intizam_tenbehi_adlari_islemleri_IPadresi,
				intizam_tenbehi_adlari_islemleri_ZamanDamgasi=:intizam_tenbehi_adlari_islemleri_ZamanDamgasi,
				intizam_tenbehi_adlari_id=:intizam_tenbehi_adlari_id,
				intizam_tenbehi_adlari_ad=:intizam_tenbehi_adlari_ad,
				intizam_tenbehi_adlari_Sira_No=:intizam_tenbehi_adlari_Sira_No,
				intizam_tenbehi_adlari_Xususi_No=:intizam_tenbehi_adlari_Xususi_No,
				intizam_tenbehi_adlari_durum=:intizam_tenbehi_adlari_durum,
				intizam_tenbehi_adlari_nezere_alam=:intizam_tenbehi_adlari_nezere_alam,
				Status=:Status,
				Islem_Eden_User_Id=:Islem_Eden_User_Id,
				intizam_tenbehi_adlari_Seo_Url=:intizam_tenbehi_adlari_Seo_Url
				");
			$Insert=$Elave_Et->execute(array(                                
				'intizam_tenbehi_adlari_islemleri_IPadresi'=>$IPAdresi,
				'intizam_tenbehi_adlari_islemleri_ZamanDamgasi'=>$ZamanDamgasi,
				'intizam_tenbehi_adlari_id'=>$intizam_tenbehi_adlari_id,
				'intizam_tenbehi_adlari_ad'=>$intizam_tenbehi_adlari_ad,
				'intizam_tenbehi_adlari_Sira_No'=>$intizam_tenbehi_adlari_Sira_No,
				'intizam_tenbehi_adlari_Xususi_No'=>$intizam_tenbehi_adlari_Xususi_No,
				'intizam_tenbehi_adlari_durum'=>$intizam_tenbehi_adlari_durum,
				'intizam_tenbehi_adlari_nezere_alam'=>$intizam_tenbehi_adlari_nezere_alam,
				'Status'=>3,
				'Islem_Eden_User_Id'=>$User_Id,
				'intizam_tenbehi_adlari_Seo_Url'=>$intizam_tenbehi_adlari_Seo_Url
			));
			if ($Insert) {?>
				<input type="hidden" id="yenilendi">
				<?php 
				$Sor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari order by intizam_tenbehi_adlari_Sira_No ASC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table class="table table-bordered table-hover">
								<thead class="">
									<tr>
										<th>№</th>
										<th>Adı</th>
										<th>Sıra №</th>
										<th>Xüsusi №</th>
										<?php if ($IntizamTenbehiAdlariNezerealmaGoster==1): ?>
											<th>Nəzərə alma</th>
										<?php endif ?>			
										<?php if ($IntizamTenbehiAdlariStatus==1 or $IntizamTenbehiAdlariDuzelis==1 or $IntizamTenbehiAdlariSil==1): ?>
											<th class="emeliyyatlar_alani">Əməliyatlar</th>			
										<?php endif ?>			
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php 
									$sira=0;
									while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
										$sira++;
										?>
										<tr>							
											<td class="siar_no_alani"><?php echo $sira ?></td>									
											<td><?php echo $Cek['intizam_tenbehi_adlari_ad'] ?></td>			
											<td class="siar_no_alani"><?php echo $Cek['intizam_tenbehi_adlari_Sira_No'] ?></td>								
											<td class="siar_no_alani"><?php echo $Cek['intizam_tenbehi_adlari_Xususi_No'] ?></td>
											<?php if ($IntizamTenbehiAdlariNezerealmaGoster): ?>
												<td class="Vezife_Adlari_Durum_Kapsama">
													<label class="checkbox">
														<input 
														<?php 
														if ($Cek['intizam_tenbehi_adlari_nezere_alam']==1) {
															echo  "checked";
														}else{}
														?>
														type="checkbox"
														<?php if ($IntizamTenbehiAdlariNezerealma!=1) {
															echo disabled;
														} ?>

														id="nezerealam_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onchange="NezereAlam(this.id)" > 
														<span class="checkbox"> 
															<span></span>
														</span>
													</label>
												</td>
											<?php endif ?>
											<?php if ($IntizamTenbehiAdlariStatus==1 or $IntizamTenbehiAdlariDuzelis==1 or $IntizamTenbehiAdlariSil==1): ?>
												

												<td class="textaligncenter">
													<?php if ($IntizamTenbehiAdlariStatus==1): ?>
														<label class="checkbox">
															<input 
															<?php 
															if ($Cek['intizam_tenbehi_adlari_durum']==1) {
																echo  "checked";
															}else{}
															?>
															type="checkbox" id="DurumId_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onchange="DurumKontrol(this.id)" > 
															<span class="checkbox"> 
																<span></span>
															</span>
														</label>

													<?php endif ?>
													<?php if ($IntizamTenbehiAdlariDuzelis): ?>
														<button class="YenileButonlari" id="Duzelis_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onclick="Duzelis(this.id)" type="button">	<i class="fas fa-edit"></i></button>		
													<?php endif ?>

													<?php if ($IntizamTenbehiAdlariSil): ?>
														<button class="YenileButonlari" id="Sil_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onclick="Sil(this.id)" type="button">	<i class="fas fa-trash"></i></button>				
													<?php endif ?>


												</td>								
											<?php endif ?>
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
							Bazada Tədbiq Edilə Bilən İtizam Tənbehi Yoxdur 
						</div>
					</div> 
				<?php 	}	?>

			<?php }else{
				?>
				<input type="hidden" id="silindiinsertolmadi">
				<?php 
				$Sor=$db->prepare("SELECT * FROM  intizam_tenbehi_adlari order by intizam_tenbehi_adlari_Sira_No ASC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table class="table table-bordered table-hover">
								<thead class="">
									<tr>
										<th>№</th>
										<th>Adı</th>
										<th>Sıra №</th>
										<th>Xüsusi №</th>
										<?php if ($IntizamTenbehiAdlariNezerealmaGoster==1): ?>
											<th>Nəzərə alma</th>
										<?php endif ?>			
										<?php if ($IntizamTenbehiAdlariStatus==1 or $IntizamTenbehiAdlariDuzelis==1 or $IntizamTenbehiAdlariSil==1): ?>
											<th class="emeliyyatlar_alani">Əməliyatlar</th>			
										<?php endif ?>			
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php 
									$sira=0;
									while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
										$sira++;
										?>
										<tr>							
											<td class="siar_no_alani"><?php echo $sira ?></td>									
											<td><?php echo $Cek['intizam_tenbehi_adlari_ad'] ?></td>			
											<td class="siar_no_alani"><?php echo $Cek['intizam_tenbehi_adlari_Sira_No'] ?></td>								
											<td class="siar_no_alani"><?php echo $Cek['intizam_tenbehi_adlari_Xususi_No'] ?></td>
											<?php if ($IntizamTenbehiAdlariNezerealmaGoster): ?>
												<td class="Vezife_Adlari_Durum_Kapsama">
													<label class="checkbox">
														<input 
														<?php 
														if ($Cek['intizam_tenbehi_adlari_nezere_alam']==1) {
															echo  "checked";
														}else{}
														?>
														type="checkbox"
														<?php if ($IntizamTenbehiAdlariNezerealma!=1) {
															echo disabled;
														} ?>

														id="nezerealam_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onchange="NezereAlam(this.id)" > 
														<span class="checkbox"> 
															<span></span>
														</span>
													</label>
												</td>
											<?php endif ?>
											<?php if ($IntizamTenbehiAdlariStatus==1 or $IntizamTenbehiAdlariDuzelis==1 or $IntizamTenbehiAdlariSil==1): ?>
												

												<td class="textaligncenter">
													<?php if ($IntizamTenbehiAdlariStatus==1): ?>
														<label class="checkbox">
															<input 
															<?php 
															if ($Cek['intizam_tenbehi_adlari_durum']==1) {
																echo  "checked";
															}else{}
															?>
															type="checkbox" id="DurumId_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onchange="DurumKontrol(this.id)" > 
															<span class="checkbox"> 
																<span></span>
															</span>
														</label>

													<?php endif ?>
													<?php if ($IntizamTenbehiAdlariDuzelis): ?>
														<button class="YenileButonlari" id="Duzelis_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onclick="Duzelis(this.id)" type="button">	<i class="fas fa-edit"></i></button>		
													<?php endif ?>

													<?php if ($IntizamTenbehiAdlariSil): ?>
														<button class="YenileButonlari" id="Sil_<?php echo $Cek['intizam_tenbehi_adlari_id'] ?>" onclick="Sil(this.id)" type="button">	<i class="fas fa-trash"></i></button>				
													<?php endif ?>


												</td>								
											<?php endif ?>
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
							Bazada Tədbiq Edilə Bilən İtizam Tənbehi Yoxdur 
						</div>
					</div> 
				<?php 	}	?>
				
			<?php 
			}
		}else{
			echo "error_1001";/*Silinme ugursuz*/
		}

	}else{
		echo "error_1000";/*Bazada movcut deyil*/
	}

	
}else{
	header("Location:../login.php");
	exit;
}
}
?>