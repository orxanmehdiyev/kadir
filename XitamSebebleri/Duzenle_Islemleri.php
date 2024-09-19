<?php 
require_once '../Ayarlar/setting.php';
if ($XidmeteXitamVerilmesisSebebiDuzelis==1) {
	if (isset($_POST['Deyer'])) {
		$deyer =json_decode($_POST['Deyer'],true);
		$xitam_sebebleri_id       =  HerfVeReqemlerXaricButunKarakterleriSil($deyer['xitam_sebebleri_id']);	
		$xitam_sebebleri_ad       =  EditorluIcerikleriFiltrle($deyer['xitam_sebebleri_ad']);	
		$xitam_sebebleri_kisa_ad  =  EditorluIcerikleriFiltrle($deyer['xitam_sebebleri_kisa_ad']);	
		if($xitam_sebebleri_ad==""){
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="xitam_sebebleri_ad">';
			echo '<input type="hidden" id="message" value="Xitam səbəbi adını yazı">';
			exit;
		}elseif($xitam_sebebleri_kisa_ad==""){
			echo '<input type="hidden" id="status" value="error">';
			echo '<input type="hidden" id="statusiki" value="xitam_sebebleri_kisa_ad">';
			echo '<input type="hidden" id="message" value="Xitam səbəbi kıssa adını yazın">';
			exit;
		}
		else{
			$Elave_Et=$db->prepare("UPDATE xitam_sebebleri SET                               
				xitam_sebebleri_ad=:xitam_sebebleri_ad,		
				xitam_sebebleri_kisa_ad=:xitam_sebebleri_kisa_ad
				where xitam_sebebleri_id=$xitam_sebebleri_id
				");
			$Insert=$Elave_Et->execute(array(                                
				'xitam_sebebleri_ad'=>$xitam_sebebleri_ad,			
				'xitam_sebebleri_kisa_ad'=>$xitam_sebebleri_kisa_ad	
			));
			if ($Insert) {
				echo '<input type="hidden" id="status" value="succes">';
				echo '<input type="hidden" id="statusiki" value="xitam_sebebleri_ad">';
				echo '<input type="hidden" id="message" value="<span class=\'Vezife_Adlari_Yenilenme_Ugurlu\'><i class=\'fas fa-check\'></i> Məlumat qeydə alındı</span>">';
				$Sor=$db->prepare("SELECT * FROM xitam_sebebleri order by xitam_sebebleri_id ASC");
				$Sor->execute();
				$Say=$Sor->rowCount();
				if ($Say>0) {?>
					<div class="row">
						<div class="over-y genislik">
							<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
								<thead class="">
									<tr>									
										<th>Adı</th>
										<th>Kısa adı</th>
										<?php if ($XidmeteXitamVerilmesisSebebiSil==1 or $XidmeteXitamVerilmesisSebebiDuzelis==1): ?>
											<th class="emeliyyatlar_iki_buttom">Əməliyatlar</th>		
										<?php endif ?>																															
									</tr>
								</thead>
								<tbody id="list" class="table_ici">
									<?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
										<tr>	
											<td><?php echo $Cek['xitam_sebebleri_ad'];?></td>					
											<td><?php echo $Cek['xitam_sebebleri_kisa_ad'] ?></td>
											<?php if ($XidmeteXitamVerilmesisSebebiSil==1 or $XidmeteXitamVerilmesisSebebiDuzelis==1): ?>	
												<td class="emeliyyatlar_iki_buttom">
													<?php 
													if ($XidmeteXitamVerilmesisSebebiSil==1) {
														echo SilButonu($Cek['xitam_sebebleri_id']);
													}
													if ($XidmeteXitamVerilmesisSebebiDuzelis==1) {
														echo  DuzenleButonu($Cek['xitam_sebebleri_id']); 
													}			
												?></td>
											<?php endif ?>
										</tr>	
									<?php }	?>
								</tbody>
							</table>
						</div>
					</div>
				<?php }else{	?>
					<div class="row">
						<div class="over-y">
							Bazada xitam səbəbi yoxdur
						</div>
					</div> 
				<?php 	}	

			}else{
				echo '<input type="hidden" id="status" value="error">';
				echo '<input type="hidden" id="statusiki" value="Rutbe_Id">';
				echo '<input type="hidden" id="message" value="Məlumat qeydə alınmadı">';
				exit;
			}
		}
	}else{
		header("Location:../intizam_tenbehleri.php");
		exit;
	}
}
?>