<?php 
require_once '../Ayarlar/setting.php';
if ($BasIdareSil==1) {

	if (!isset($_POST['Deyer'])) {
		header("Location:login.php");
		exit;
	}else{
		$Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
		$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Id=:Id");
		$Sor->execute(array(
			'Id'=>$Id));
		$Say=$Sor->rowCount();
		if ($Say==1) {
			$sil = $db->prepare("DELETE from tabeli_qurumlar_ve_bas_idareler where Id=:Id");
			$kontrol = $sil->execute(array(
				'Id' => $Id
			));
			if ($kontrol) {
				$Adi="Silindi";
				$Sira_No="";	
				$Seo_Url="";	
				$Elave_Et=$db->prepare("INSERT INTO tabeli_qurumlar_ve_bas_idareler_islemleri SET
					Sira_No=:Sira_No,
					Adi=:Adi,
					Islem_Edilen_Id=:Islem_Edilen_Id,
					TarixSaat=:TarixSaat,
					ZamanDamgasi=:ZamanDamgasi,
					Seo_Url=:Seo_Url,
					IPAdresi=:IPAdresi,
					Admin_Id=:Admin_Id
					");
				$Insert=$Elave_Et->execute(array(
					'Sira_No'=>$Sira_No,
					'Adi'=>$Adi,
					'Islem_Edilen_Id'=>$Id,				
					'TarixSaat'=>$TarixSaat,
					'ZamanDamgasi'=>$ZamanDamgasi,
					'Seo_Url'=>$Seo_Url,
					'IPAdresi'=>$IPAdresi,
					'Admin_Id'=>$Admin_Id
				));
				?>
				<input type="hidden" id=silcavab value="silindi" >

				<?php 
				$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler order by Sira_No ASC ");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
					<div class="over-y genislik">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="siar_no_alani">№</th>
									<th>Tabeli Qurumun və ya Baş İdarənin Adı</th>
									<th  class="emeliyyatlar_alani">Əməliyyatlar</th>		
								</tr>
							</thead>
							<tbody id="vezifeadlarlisti" class="table_ici">
								<?php 						
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {							
									?>
									<tr>	
										<td class="vezife_adlari_sira_input_kapsama">
											<input class="vezifeadlarisira" min="1" id="SiraId_<?php echo $Cek['Id'] ?>" type="number" value="<?php echo $Cek['Sira_No'] ?>" onfocusout="SiraDuzelis(this.id)" onkeydown="javascript: return event.keyCode == 69 ? false : true" >
										</td>	
										<td class="vezife_adlari_ad_input_kapsama" id="AdId_<?php echo $Cek['Id'] ?>">
											<?php echo $Cek['Adi'] ?>
										</td>
										<td class="emeliyyatlar_alani">
											<?php if ($BasIdareAktivPassiv==1) {?>
												<label class="checkbox" title="" >
													<input 
													<?php 
													if ($Cek['Durum']==1) {
														echo  "checked";
													}else{}
													?>
													type="checkbox" id="DurumId_<?php echo $Cek['Id'] ?>" onchange="DurumKontrol(this.id)" > 
													<span class="checkbox"> 
														<span></span>
													</span>
												</label>
											<?php } if ($BasIdareDuzenle==1) { ?>	
												<button class="YenileButonlari" id="DuzelisButton_<?php echo $Cek['Id'] ?>" onclick="DuzelisYoxlanis(this.id)" type="button"><i class="fas fa-edit"></i></button>
											<?php } if ($BasIdareSil==1) { ?>
												<button class="YenileButonlari" id="SilButton_<?php echo $Cek['Id'] ?>" onclick="SilYoxlanis(this.id)" type="button"><i class="fas fa-trash"></i></button>
											<?php } ?>
										</td> 
									</tr>	
								<?php }
								?>									
							</tbody>
						</table>
					</div>
				</div>
				<?php } else{	?>
					<div class="row">
						<div class="over-y">
							Bazada Tabeli Qurum Və Ya Baş İdarə Mövcut Deyil
						</div>
					</div> 					
				<?php 	}	
			}else{
				echo "error_4000";
				exit;
			}

		}
	}
	// code...
}

?>