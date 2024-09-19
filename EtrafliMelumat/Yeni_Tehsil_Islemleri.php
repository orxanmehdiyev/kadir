<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$Tehsil_Aldigi_Muesise=EditorluIcerikleriFiltrle($deyer['Tehsil_Aldigi_Muesise']);
	$Ixtisas=EditorluIcerikleriFiltrle($deyer['Ixtisas']);
	$Tehsil=ReqemlerXaricButunKarakterleriSil($deyer['Tehsil']);
	$ID=ReqemlerXaricButunKarakterleriSil($deyer['ID']);
	$Qeb_Tarixi                     =strtotime($deyer['Qebul_Tarixi']) ; 
	$Qebul_Tarixi                =date("d.m.Y", $Qeb_Tarixi);

	$Bit_Tarix                     =strtotime($deyer['Bitirdiyi_Tarix']) ; 
	$Bitirdiyi_Tarix                =date("d.m.Y", $Bit_Tarix);

	if ($Tehsil_Aldigi_Muesise!="") { 
		if ($Ixtisas!="") {
			if ($Tehsil>0) {
				if ($ID>0) {
					if ($Qebul_Tarixi!="") {
						if ($Bitirdiyi_Tarix!="") {
							$Elave_Et=$db->prepare("INSERT INTO  user_tehsil SET                               
								Tehsil_Aldigi_Muesise=:Tehsil_Aldigi_Muesise,
								Ixtisas=:Ixtisas,
								Tehsil=:Tehsil,
								ID=:ID,
								Qebul_Tarixi=:Qebul_Tarixi,
								TarixSaat=:TarixSaat,
								Bitirdiyi_Tarix=:Bitirdiyi_Tarix
								");
							$Insert=$Elave_Et->execute(array(                                
								'Tehsil_Aldigi_Muesise'=>$Tehsil_Aldigi_Muesise,
								'Ixtisas'=>$Ixtisas,
								'Tehsil'=>$Tehsil,
								'ID'=>$ID,
								'Qebul_Tarixi'=>$Qebul_Tarixi,
								'TarixSaat'=>$TarixSaat,
								'Bitirdiyi_Tarix'=>$Bitirdiyi_Tarix
							));
							if ($Insert) {?>
								
								<?php 
								$Tehsil_Sor=$db->prepare("SELECT * FROM  user_tehsil where ID=:ID ");
								$Tehsil_Sor->execute(array(
									'ID'=>$ID));
									?>
									<table class="ListelemeAlaniIciTablosu caption-top">
										<caption><b>Təhsili</b><button class="YenileButonlari sag" onclick="YeniTehsil()" type="button">Yeni</button></caption>
										<thead>
											<tr>
												<th>№</th>
												<th>Təhsil Səviyyəsi</th>
												<th>Bitirdiyi Təhsil Müəsisəsi</th>
												<th>İxtisası</th>
												<th>Sənədləri</th>
												<th>Əməliyatlar</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$tehsilsirano=0;
											while ($Tehsil_Cek=$Tehsil_Sor->fetch(PDO::FETCH_ASSOC)) {
												$tehsilsirano++;
												if($Tehsil_Cek['Tehsil']==1){
													$Tehsil="İbtidai";
												}elseif($Tehsil_Cek['Tehsil']==2){
													$Tehsil="Ümumi Orta";
												}elseif($Tehsil_Cek['Tehsil']==3){
													$Tehsil="Tam Orta";
												}elseif($Tehsil_Cek['Tehsil']==4){
													$Tehsil="İlk Peşə";
												}elseif($Tehsil_Cek['Tehsil']==5){
													$Tehsil="Texniki Peşə";
												}elseif($Tehsil_Cek['Tehsil']==6){
													$Tehsil="Yüksək Texniki Peşə";
												}elseif($Tehsil_Cek['Tehsil']==7){
													$Tehsil="Orta ixtisas";
												}elseif($Tehsil_Cek['Tehsil']==8){
													$Tehsil="Bakalavriat";
												}elseif($Tehsil_Cek['Tehsil']==9){
													$Tehsil="Magistratura (Rezidentura)";
												}elseif($Tehsil_Cek['Tehsil']==10){
													$Tehsil="Doktorantura (Adyunktura)";
												}else{
													$Tehsil="";
												}
												?>
												<tr>
													<td><?php echo $tehsilsirano ?></td>
													<td><?php echo $Tehsil ?></td>
													<td><?php echo $Tehsil_Cek['Tehsil_Aldigi_Muesise'] ?></td>
													<td><?php echo $Tehsil_Cek['Ixtisas'] ?></td>
													<td class="textaligncenter" id="senedler_<?php echo $Tehsil_Cek['User_Tehsil_Id']?>">
														<?php if (strlen($Tehsil_Cek['Tehsil_Senedi_IMG'])>0) {?>
															<a style="color: #0d6efd;" href="<?php echo $Tehsil_Cek['Tehsil_Senedi_IMG'] ?>" target="blank">Sənədi</a><span style="color:red; margin-left: 5px; cursor: pointer;" onclick="TehsilSenedSil(this.id)" id="TehsilSenedSil_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">x</span>
														<?php }else{?>
															<form  method="post" enctype="multipart/form-data" id="tehsilform_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">
																<input type="hidden" name="tehsilsenediyukle">
																<input type="hidden" name="User_Tehsil_Id" value="<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">												
																<label class="fileuploadgizliinputlabel" for="file_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>" id="label_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>">Browse...</label>
																<input type="file" class="fileuploadgizliinput" name="file" id="file_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>"  onchange="TehsilSenediYukle(this.form)">
																<button class="YenileButonlari" id="button_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>" style="display: none;">Yüklə</button>
															</form>
														<?php } ?>
													</td>
													<td class="emeliyyatlar_iki_buttom">											
														<button class="YenileButonlari" id="Siltehsil_<?php echo $Tehsil_Cek['User_Tehsil_Id'] ?>" onclick="TehsilSil(this.id)" type="button">
															<i class="fas fa-trash"></i>
														</button>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>

								<?php	}else{
									echo "error_2006";/* kissa Adı boş ola bilməz*/
									exit;
								}
							}else{
								echo "error_2005";/* kissa Adı boş ola bilməz*/
								exit;
							}
						}else{
							echo "error_2005";/* kissa Adı boş ola bilməz*/
							exit;
						}					
					}else{
						echo "error_2004";/* kissa Adı boş ola bilməz*/
						exit;
					}
				}else{
					echo "error_2003";/* kissa Adı boş ola bilməz*/
					exit;
				}

			}else{
				echo "error_2002";/* kissa Adı boş ola bilməz*/
				exit;
			}
		}else{
			echo "error_2001";/* Adı boş ola bilməz*/
			exit;
		}
	}else{
		header("Location:../intizam_tebehi_adlari");
		exit;
	}
?>