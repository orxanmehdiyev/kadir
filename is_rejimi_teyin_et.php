<?php require_once '_header.php'; ?>
<script type="text/javascript" src="IsRejimleriTeyinEt/Script.js"></script>
<script>
	function allowDrop(ev) {
		ev.preventDefault();
	}

	function drag(ev) {
		ev.dataTransfer.setData("text", ev.target.id);
	}

	function drop(ev) {
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		ev.target.appendChild(document.getElementById(data));
	}
</script>
<div class="butunheyyed">
	<div class="mydiv" id="qrafiqiolmayan" ondrop="drop(event)" ondragover="allowDrop(event)">
		<?php
			$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
		$Idare_Sor->execute(array(
			'Durum' => 1,
			'Idare_Id' => $Admin_Islediyi_Idare_Id
		));
		while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
			$Idare_Id = $Idare_ceker['Idare_Id'];
			$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
			$Sobe_Sor->execute(array(
				'Durum' => 1,
				'Idare_Id' => $Idare_Id
			));
			while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
				$Sobe_Id = $Sobe_Cek['Sobe_Id'];
				$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
				$Vezife_Sor->execute(array(
					'Durum' => 1,
					'Idare_Id' => $Idare_Id,
					'Sobe_Id' => $Sobe_Id,
					'User_Id' => 0
				));
				while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
					$Vezife_Id = $Vezife_Cek['Vezife_Id'];
					$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id ");
					$User_Sor->execute(array(
						'Durum' => 1,
						'Islediyi_Idare_Id' => $Idare_Id,
						'Islediyi_Sobe_Id' => $Sobe_Id,
						'Vezife_Id' => $Vezife_Id
						
					));
					$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
					$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
					$ID = $User_Cek['ID'];	

					$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
					$rejimsorSor->execute(array(
						'ID' => $ID
					));
					$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
					if ($rejimsorCek['Idare_Id']!=$Idare_Id) {
						?>

						<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
							<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

							<?php echo $AdSoyadAtaadi ?>
							<div class="istrahetgunleri">
								<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
								<label class="form-check-label" for="bir">
									Bazar ertəsi
								</label>
								<br>
								<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
								<label class="form-check-label" for="iki">
									Çərşəmbə axşamı
								</label>
								<br>
								<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
								<label class="form-check-label" for="uc">
									Çərşəmbə
								</label>
								<br>
								<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
								<label class="form-check-label" for="dord">
									Cümə axşamı
								</label>
								<br>
								<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
								<label class="form-check-label" for="bes">
									Cümə
								</label>
								<br>
								<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
								<label class="form-check-label" for="alti">
									Şəmbə
								</label>
								<br>
								<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
								<label class="form-check-label" for="yeddi">
									Bazar
								</label>



							</div>

						</div>
					<?php	}  }
				}
			}
			?>
		</div>
	</div>

	<form class="idaregundelik" id="idareqrafiq">
		<div class="ikinovbelibaslik">İdarə</div>
		<div class="row">
			<div class="col-12">
				<?php 
				$rejimsortaridaresor = $db->prepare("SELECT * FROM is_rejimi where Idare_Id=:Idare_Id and Is_Rejimi=:Is_Rejimi order by Tarix DESC, Is_Rejimi_Id DESC");
				$rejimsortaridaresor->execute(array(
					'Idare_Id' => $Idare_Id,
					'Is_Rejimi' => $Admin_Islediyi_Idare_Id
				));
				$rejimsortaridarecek = $rejimsortaridaresor->fetch(PDO::FETCH_ASSOC);

				?>

				<label for="Idare_Tarix" class="form-label" style="float:left;">Başlanğıc Tarixi<span class="KirmiziYazi">*</span></label>
				<input type="text" class="form-control tarix" name="Idare_Tarix" style="float: left;" value="<?php echo TarixAzCevir($rejimsortaridarecek['Tarix']) ?>" placeholder="__.__._____" id="Idare_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)" onchange="TarixAlaniYazildi(this.id)" required="required" maxlength="10" tabindex="4" title="">
			</div>
			<div class="col-6">
				<label for="Is_Giris_Saati" class="form-label">Gəlmə<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" name="Is_Giris_Saati" value="<?php echo $rejimsortaridarecek['Is_Giris_Saati'] ?>" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)" id="Is_Giris_Saati" title="">
			</div>
			<div class="col-6">
				<label for="Is_Cixis_Saati" class="form-label">Getmə<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" name="Is_Cixis_Saati" value="<?php echo $rejimsortaridarecek['Is_Cixis_Saati'] ?>" id="Is_Cixis_Saati" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>

			<div class="col-6 ">
				<label for="Fasile_Saati_Baslagic" class="form-label">Fasilə çıxış<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" name="Fasile_Saati_Baslagic" value="<?php echo $rejimsortaridarecek['Fasile_Saati_Baslagic'] ?>" id="Fasile_Saati_Baslagic" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>

			<div class="col-6">
				<label for="Fasile_Saati_Bitis" class="form-label">Fasilə Giriş<span class="KirmiziYazi">*</span></label>
				<input type="time" class="form-control" name="Fasile_Saati_Bitis"  value="<?php echo $rejimsortaridarecek['Fasile_Saati_Bitis'] ?>" id="Fasile_Saati_Bitis" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
			</div>
		</div>

		<div class="novbekapsayici "><br>
			<div id="div1" class="mydiv " ondrop="drop(event)" ondragover="allowDrop(event)">

				<?php
				$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
				$Idare_Sor->execute(array(
					'Durum' => 1,
					'Idare_Id' => $Admin_Islediyi_Idare_Id
				));
				while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
					$Idare_Id = $Idare_ceker['Idare_Id'];
					$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
					$Sobe_Sor->execute(array(
						'Durum' => 1,
						'Idare_Id' => $Idare_Id
					));
					while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
						$Sobe_Id = $Sobe_Cek['Sobe_Id'];
						$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
						$Vezife_Sor->execute(array(
							'Durum' => 1,
							'Idare_Id' => $Idare_Id,
							'Sobe_Id' => $Sobe_Id,
							'User_Id' => 0
						));
						while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
							$Vezife_Id = $Vezife_Cek['Vezife_Id'];
							$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
							$User_Sor->execute(array(
								'Durum' => 1,
								'Islediyi_Idare_Id' => $Idare_Id,
								'Islediyi_Sobe_Id' => $Sobe_Id,
								'Vezife_Id' => $Vezife_Id
							));
							$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
							$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
							$ID = $User_Cek['ID'];

							$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
							$rejimsorSor->execute(array(
								'ID' => $ID
							));
							$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
							if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==1 ) {


								?>

								<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
									<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

									<?php echo $AdSoyadAtaadi ?>
									<div class="istrahetgunleri">
										<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
										<label class="form-check-label" for="bir">
											Bazar ertəsi
										</label>
										<br>
										<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
										<label class="form-check-label" for="iki">
											Çərşəmbə axşamı
										</label>
										<br>
										<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
										<label class="form-check-label" for="uc">
											Çərşəmbə
										</label>
										<br>
										<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
										<label class="form-check-label" for="dord">
											Cümə axşamı
										</label>
										<br>
										<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
										<label class="form-check-label" for="bes">
											Cümə
										</label>
										<br>
										<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
										<label class="form-check-label" for="alti">
											Şəmbə
										</label>
										<br>
										<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
										<label class="form-check-label" for="yeddi">
											Bazar
										</label>
									</div>
								</div>
							<?php	} }
						}
					}
					?>


				</div>
			</div>
		</form>


		<form class="gundelik" id="gundelikqrafiq">
			<div class="ikinovbelibaslik">Gündəlik</div>
			<?php 
			$rejimsortargundeliksor = $db->prepare("SELECT * FROM is_rejimi where Idare_Id=:Idare_Id and Is_Rejimi=:Is_Rejimi order by Tarix DESC, Is_Rejimi_Id DESC");
			$rejimsortargundeliksor->execute(array(
				'Idare_Id' => $Idare_Id,
				'Is_Rejimi' => 2
			));
			$rejimsortargundelikcek = $rejimsortargundeliksor->fetch(PDO::FETCH_ASSOC);

			?>
			<div class="row">
				<div class="col-12">
					<label for="Gundelik_Tarix" class="form-label" style="float:left;">Başlanğıc Tarixi<span class="KirmiziYazi">*</span></label>
					<input type="text" name="Gundelik_Tarix" class="form-control tarix" style="float: left;"   value="<?php echo TarixAzCevir($rejimsortargundelikcek['Tarix']) ?>" placeholder="__.__._____" id="Gundelik_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  onchange="TarixAlaniYazildi(this.id)" required="required" maxlength="10" tabindex="4" title="">
				</div>
				<div class="col-6">

					<label for="GundelikIs_Giris_Saati" class="form-label">Gəlmə<span class="KirmiziYazi">*</span></label>
					<input type="time" name="GundelikIs_Giris_Saati" class="form-control" maxlength="10" value="<?php echo ($rejimsortargundelikcek['Is_Giris_Saati']) ?>" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)" id="GundelikIs_Giris_Saati" title="">
				</div>
				<div class="col-6">
					<label for="GundelikIs_Cixis_Saati" class="form-label">Getmə<span class="KirmiziYazi">*</span></label>
					<input type="time" name="GundelikIs_Cixis_Saati" class="form-control" id="GundelikIs_Cixis_Saati" value="<?php echo ($rejimsortargundelikcek['Is_Cixis_Saati']) ?>" title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
				</div>
			</div>
			<div class="gundelikdolu">
				<span style="float: right; margin-right:100px;"> İstrahət günü</span>
				<div id="div2" class="mydiv " ondrop="drop(event)" ondragover="allowDrop(event)">
					<?php
					$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
					$Idare_Sor->execute(array(
						'Durum' => 1,
						'Idare_Id' => $Admin_Islediyi_Idare_Id
					));
					while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
						$Idare_Id = $Idare_ceker['Idare_Id'];
						$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
						$Sobe_Sor->execute(array(
							'Durum' => 1,
							'Idare_Id' => $Idare_Id
						));
						while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
							$Sobe_Id = $Sobe_Cek['Sobe_Id'];
							$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
							$Vezife_Sor->execute(array(
								'Durum' => 1,
								'Idare_Id' => $Idare_Id,
								'Sobe_Id' => $Sobe_Id,
								'User_Id' => 0
							));
							while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Vezife_Id = $Vezife_Cek['Vezife_Id'];
								$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
								$User_Sor->execute(array(
									'Durum' => 1,
									'Islediyi_Idare_Id' => $Idare_Id,
									'Islediyi_Sobe_Id' => $Sobe_Id,
									'Vezife_Id' => $Vezife_Id
								));
								$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
								$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
								$ID = $User_Cek['ID'];

								$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
								$rejimsorSor->execute(array(
									'ID' => $ID
								));
								$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
								if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==2 ) {


									?>

									<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
										<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

										<?php echo $AdSoyadAtaadi ?>
										<div class="istrahetgunleri">
											<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" <?php echo $rejimsorCek['bir']==0?"checked":""?>>
											<label class="form-check-label" for="bir">
												Bazar ertəsi
											</label>
											<br>
											<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" <?php echo $rejimsorCek['iki']==0?"checked":""?> >
											<label class="form-check-label" for="iki">
												Çərşəmbə axşamı
											</label>
											<br>
											<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" <?php echo $rejimsorCek['uc']==0?"checked":""?> >
											<label class="form-check-label" for="uc">
												Çərşəmbə
											</label>
											<br>
											<input type="checkbox" name="<?php echo 'dord_' . $ID ?>" <?php echo $rejimsorCek['dord']==0?"checked":""?>>
											<label class="form-check-label" for="dord">
												Cümə axşamı
											</label>
											<br>
											<input type="checkbox" name="<?php echo 'bes_' . $ID ?>" <?php echo $rejimsorCek['bes']==0?"checked":""?>>
											<label class="form-check-label" for="bes">
												Cümə
											</label>
											<br>
											<input type="checkbox" name="<?php echo 'alti_' . $ID ?>" <?php echo $rejimsorCek['alti']==0?"checked":""?>>
											<label class="form-check-label" for="alti">
												Şəmbə
											</label>
											<br>
											<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>" <?php echo $rejimsorCek['yeddi']==0?"checked":""?>>
											<label class="form-check-label" for="yeddi">
												Bazar
											</label>



										</div>

									</div>
								<?php	} }
							}
						}
						?>
					</div>
				</div>
			</form>

			<div class="ikinovbeli">
				<div class="ikinovbelibaslik"> İki növbəli</div>
				<?php 
				$nobeikitarix = $db->prepare("SELECT * FROM is_rejimi where Idare_Id=:Idare_Id and Is_Rejimi=:Is_Rejimi and Novbe_Sayi=:Novbe_Sayi order by Tarix DESC, Is_Rejimi_Id DESC");
				$nobeikitarix->execute(array(
					'Idare_Id' => $Idare_Id,
					'Is_Rejimi' => 3,
					'Novbe_Sayi' => 2
				));
				$nobeikitarixcek = $nobeikitarix->fetch(PDO::FETCH_ASSOC);
				?>
				<div class="row">
					<div class="col-12">
						<label for="Ikinovbe_Tarix" class="form-label" style="float:left;">Başlanğıc Tarixi<span class="KirmiziYazi">*</span></label>
						<input type="text" class="form-control tarix" style="float: left;"  value="<?php echo TarixAzCevir($nobeikitarixcek['Tarix'])?>" placeholder="__.__._____" id="Ikinovbe_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  onchange="TarixAlaniYazildi(this.id)" required="required" maxlength="10" tabindex="4" title="">
					</div>
					<div class="col-6">
						<label for="Iki_novbeIs_Giris_Saati" class="form-label">Gəlmə<span class="KirmiziYazi">*</span></label>
						<input type="time" class="form-control" maxlength="10" onchange="SaatYazildi(this.id)" value="<?php echo $nobeikitarixcek['Is_Giris_Saati']?>" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)" id="Iki_novbeIs_Giris_Saati" title="">
					</div>
					<div class="col-6">
						<label for="Iki_novbeIs_Cixis_Saati" class="form-label">Getmə<span class="KirmiziYazi">*</span></label>
						<input type="time" class="form-control" id="Iki_novbeIs_Cixis_Saati" title="" value="<?php echo $nobeikitarixcek['Is_Cixis_Saati']?>" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
					</div>
				</div>
				<form class="novbekapsayici" id="ikinovbebirinci">I növbə
					<input type="hidden" name="gizlitarixbir" id="gizlitarixbir">
					<input type="hidden" name="gizlisaatbirbir" id="gizlisaatbirbir">
					<input type="hidden" name="gizlisaatbiriki" id="gizlisaatbiriki">
					<div id="div3" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">

						<?php
						$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
						$Idare_Sor->execute(array(
							'Durum' => 1,
							'Idare_Id' => $Admin_Islediyi_Idare_Id
						));
						while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
							$Idare_Id = $Idare_ceker['Idare_Id'];
							$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
							$Sobe_Sor->execute(array(
								'Durum' => 1,
								'Idare_Id' => $Idare_Id
							));
							while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Sobe_Id = $Sobe_Cek['Sobe_Id'];
								$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
								$Vezife_Sor->execute(array(
									'Durum' => 1,
									'Idare_Id' => $Idare_Id,
									'Sobe_Id' => $Sobe_Id,
									'User_Id' => 0
								));
								while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
									$Vezife_Id = $Vezife_Cek['Vezife_Id'];
									$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
									$User_Sor->execute(array(
										'Durum' => 1,
										'Islediyi_Idare_Id' => $Idare_Id,
										'Islediyi_Sobe_Id' => $Sobe_Id,
										'Vezife_Id' => $Vezife_Id
									));
									$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
									$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
									$ID = $User_Cek['ID'];

									$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
									$rejimsorSor->execute(array(
										'ID' => $ID
									));
									$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
									if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==2 and $rejimsorCek['Is_Qurupu']==1 ) {


										?>

										<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
											<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

											<?php echo $AdSoyadAtaadi ?>
											<div class="istrahetgunleri">
												<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
												<label class="form-check-label" for="bir">
													Bazar ertəsi
												</label>
												<br>
												<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
												<label class="form-check-label" for="iki">
													Çərşəmbə axşamı
												</label>
												<br>
												<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
												<label class="form-check-label" for="uc">
													Çərşəmbə
												</label>
												<br>
												<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
												<label class="form-check-label" for="dord">
													Cümə axşamı
												</label>
												<br>
												<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
												<label class="form-check-label" for="bes">
													Cümə
												</label>
												<br>
												<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
												<label class="form-check-label" for="alti">
													Şəmbə
												</label>
												<br>
												<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
												<label class="form-check-label" for="yeddi">
													Bazar
												</label>



											</div>

										</div>
									<?php	} }
								}
							}
							?>
						</div>
					</form>
					<form class="novbekapsayici" id="ikinovbeikinci">II növbə
						<input type="hidden" name="gizlitarixiki" id="gizlitarixiki">
						<input type="hidden" name="gizlisaatikibir" id="gizlisaatikibir">
						<input type="hidden" name="gizlisaatikiiki" id="gizlisaatikiiki">
						<div id="div4" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">
							<?php
							$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
							$Idare_Sor->execute(array(
								'Durum' => 1,
								'Idare_Id' => $Admin_Islediyi_Idare_Id
							));
							while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Idare_Id = $Idare_ceker['Idare_Id'];
								$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
								$Sobe_Sor->execute(array(
									'Durum' => 1,
									'Idare_Id' => $Idare_Id
								));
								while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
									$Sobe_Id = $Sobe_Cek['Sobe_Id'];
									$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
									$Vezife_Sor->execute(array(
										'Durum' => 1,
										'Idare_Id' => $Idare_Id,
										'Sobe_Id' => $Sobe_Id,
										'User_Id' => 0
									));
									while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
										$Vezife_Id = $Vezife_Cek['Vezife_Id'];
										$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
										$User_Sor->execute(array(
											'Durum' => 1,
											'Islediyi_Idare_Id' => $Idare_Id,
											'Islediyi_Sobe_Id' => $Sobe_Id,
											'Vezife_Id' => $Vezife_Id
										));
										$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
										$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
										$ID = $User_Cek['ID'];

										$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
										$rejimsorSor->execute(array(
											'ID' => $ID
										));
										$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
										if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==2 and $rejimsorCek['Is_Qurupu']==2 ) {
											?>

											<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
												<input type="hidden" name="ID[]" value="<?php echo $ID ?>">
												<?php echo $AdSoyadAtaadi ?>
												<div class="istrahetgunleri">
													<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
													<label class="form-check-label" for="bir">
														Bazar ertəsi
													</label>
													<br>
													<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
													<label class="form-check-label" for="iki">
														Çərşəmbə axşamı
													</label>
													<br>
													<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
													<label class="form-check-label" for="uc">
														Çərşəmbə
													</label>
													<br>
													<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
													<label class="form-check-label" for="dord">
														Cümə axşamı
													</label>
													<br>
													<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
													<label class="form-check-label" for="bes">
														Cümə
													</label>
													<br>
													<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
													<label class="form-check-label" for="alti">
														Şəmbə
													</label>
													<br>
													<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
													<label class="form-check-label" for="yeddi">
														Bazar
													</label>
												</div>
											</div>
										<?php	} }
									}
								}
								?>				
							</div>
						</form>
					</div>
					<hr>

					<div class="ucnovbeli">
						<div class="ikinovbelibaslik"> Üç növbəli</div>
						<?php 
						$nobeuctarix = $db->prepare("SELECT * FROM is_rejimi where Idare_Id=:Idare_Id and Is_Rejimi=:Is_Rejimi and Novbe_Sayi=:Novbe_Sayi order by Tarix DESC, Is_Rejimi_Id DESC");
						$nobeuctarix->execute(array(
							'Idare_Id' => $Idare_Id,
							'Is_Rejimi' => 3,
							'Novbe_Sayi' => 3
						));
						$nobeuctarixcek = $nobeuctarix->fetch(PDO::FETCH_ASSOC);
						?>
						<div class="row">
							<div class="col-12">
								<label for="Ucnovbe_Tarix" class="form-label" style="float:left;">Başlanğıc Tarixi<span class="KirmiziYazi">*</span></label>
								<input type="text" class="form-control tarix" style="float: left;" value="<?php echo TarixAzCevir($nobeuctarixcek['Tarix'])?>" placeholder="__.__._____" id="Ucnovbe_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  onchange="TarixAlaniYazildi(this.id)" required="required" maxlength="10" tabindex="4" title="">
							</div>
							<div class="col-6">
								<label for="UcnovbeIs_Giris_Saati" class="form-label">Gəlmə<span class="KirmiziYazi">*</span></label>
								<input type="time" class="form-control" maxlength="10" value="<?php echo $nobeuctarixcek['Is_Giris_Saati']?>" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)" id="UcnovbeIs_Giris_Saati" title="">
							</div>
							<div class="col-6">
								<label for="UcnovbeIs_Cixis_Saati" class="form-label">Getmə<span class="KirmiziYazi">*</span></label>
								<input type="time" class="form-control" id="UcnovbeIs_Cixis_Saati" value="<?php echo $nobeuctarixcek['Is_Cixis_Saati']?>"  title="" maxlength="10" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
							</div>
						</div>
						<form class="novbekapsayici" id="ucnovbebirinci">I növbə
							<input type="hidden" name="ucnovbetarixbir" id="ucnovbetarixbir">
							<input type="hidden" name="ucnovbegirissaatbir" id="ucnovbegirissaatbir">
							<input type="hidden" name="ucnovbecixisaatbir" id="ucnovbecixisaatbir">
							<div id="div5" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">
								<?php
								$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
								$Idare_Sor->execute(array(
									'Durum' => 1,
									'Idare_Id' => $Admin_Islediyi_Idare_Id
								));
								while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
									$Idare_Id = $Idare_ceker['Idare_Id'];
									$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
									$Sobe_Sor->execute(array(
										'Durum' => 1,
										'Idare_Id' => $Idare_Id
									));
									while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
										$Sobe_Id = $Sobe_Cek['Sobe_Id'];
										$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
										$Vezife_Sor->execute(array(
											'Durum' => 1,
											'Idare_Id' => $Idare_Id,
											'Sobe_Id' => $Sobe_Id,
											'User_Id' => 0
										));
										while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
											$Vezife_Id = $Vezife_Cek['Vezife_Id'];
											$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
											$User_Sor->execute(array(
												'Durum' => 1,
												'Islediyi_Idare_Id' => $Idare_Id,
												'Islediyi_Sobe_Id' => $Sobe_Id,
												'Vezife_Id' => $Vezife_Id
											));
											$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
											$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
											$ID = $User_Cek['ID'];

											$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
											$rejimsorSor->execute(array(
												'ID' => $ID
											));
											$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
											if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==3 and $rejimsorCek['Is_Qurupu']==1 ) {


												?>

												<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
													<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

													<?php echo $AdSoyadAtaadi ?>
													<div class="istrahetgunleri">
														<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
														<label class="form-check-label" for="bir">
															Bazar ertəsi
														</label>
														<br>
														<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
														<label class="form-check-label" for="iki">
															Çərşəmbə axşamı
														</label>
														<br>
														<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
														<label class="form-check-label" for="uc">
															Çərşəmbə
														</label>
														<br>
														<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
														<label class="form-check-label" for="dord">
															Cümə axşamı
														</label>
														<br>
														<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
														<label class="form-check-label" for="bes">
															Cümə
														</label>
														<br>
														<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
														<label class="form-check-label" for="alti">
															Şəmbə
														</label>
														<br>
														<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
														<label class="form-check-label" for="yeddi">
															Bazar
														</label>
													</div>
												</div>
											<?php	} }
										}
									}
									?>				
								</div>
							</form>

							<form class="novbekapsayici" id="ucnovbeikinci">II növbə
								<input type="hidden" name="ucnovbetarixiki" id="ucnovbetarixiki">
								<input type="hidden" name="ucnovbegirissaatiki" id="ucnovbegirissaatiki">
								<input type="hidden" name="ucnovbecixisaatiki" id="ucnovbecixisaatiki">
								<div id="div6" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">

									<?php
									$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
									$Idare_Sor->execute(array(
										'Durum' => 1,
										'Idare_Id' => $Admin_Islediyi_Idare_Id
									));
									while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
										$Idare_Id = $Idare_ceker['Idare_Id'];
										$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
										$Sobe_Sor->execute(array(
											'Durum' => 1,
											'Idare_Id' => $Idare_Id
										));
										while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
											$Sobe_Id = $Sobe_Cek['Sobe_Id'];
											$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
											$Vezife_Sor->execute(array(
												'Durum' => 1,
												'Idare_Id' => $Idare_Id,
												'Sobe_Id' => $Sobe_Id,
												'User_Id' => 0
											));
											while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
												$Vezife_Id = $Vezife_Cek['Vezife_Id'];
												$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
												$User_Sor->execute(array(
													'Durum' => 1,
													'Islediyi_Idare_Id' => $Idare_Id,
													'Islediyi_Sobe_Id' => $Sobe_Id,
													'Vezife_Id' => $Vezife_Id
												));
												$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
												$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
												$ID = $User_Cek['ID'];

												$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
												$rejimsorSor->execute(array(
													'ID' => $ID
												));
												$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
												if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==3 and $rejimsorCek['Is_Qurupu']==2 ) {


													?>

													<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
														<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

														<?php echo $AdSoyadAtaadi ?>
														<div class="istrahetgunleri">
															<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
															<label class="form-check-label" for="bir">
																Bazar ertəsi
															</label>
															<br>
															<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
															<label class="form-check-label" for="iki">
																Çərşəmbə axşamı
															</label>
															<br>
															<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
															<label class="form-check-label" for="uc">
																Çərşəmbə
															</label>
															<br>
															<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
															<label class="form-check-label" for="dord">
																Cümə axşamı
															</label>
															<br>
															<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
															<label class="form-check-label" for="bes">
																Cümə
															</label>
															<br>
															<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
															<label class="form-check-label" for="alti">
																Şəmbə
															</label>
															<br>
															<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
															<label class="form-check-label" for="yeddi">
																Bazar
															</label>
														</div>
													</div>
												<?php	} }
											}
										}
										?>				

									</div>
								</form>

								<form class="novbekapsayici" id="ucnovbeucuncu">III növbə
									<input type="hidden" name="ucnovbetarixuc" id="ucnovbetarixuc">
									<input type="hidden" name="ucnovbegirissaatuc" id="ucnovbegirissaatuc">
									<input type="hidden" name="ucnovbecixisaatuc" id="ucnovbecixisaatuc">
									<div id="div7" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">

										<?php
										$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
										$Idare_Sor->execute(array(
											'Durum' => 1,
											'Idare_Id' => $Admin_Islediyi_Idare_Id
										));
										while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
											$Idare_Id = $Idare_ceker['Idare_Id'];
											$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
											$Sobe_Sor->execute(array(
												'Durum' => 1,
												'Idare_Id' => $Idare_Id
											));
											while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
												$Sobe_Id = $Sobe_Cek['Sobe_Id'];
												$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
												$Vezife_Sor->execute(array(
													'Durum' => 1,
													'Idare_Id' => $Idare_Id,
													'Sobe_Id' => $Sobe_Id,
													'User_Id' => 0
												));
												while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
													$Vezife_Id = $Vezife_Cek['Vezife_Id'];
													$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
													$User_Sor->execute(array(
														'Durum' => 1,
														'Islediyi_Idare_Id' => $Idare_Id,
														'Islediyi_Sobe_Id' => $Sobe_Id,
														'Vezife_Id' => $Vezife_Id
													));
													$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
													$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
													$ID = $User_Cek['ID'];

													$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
													$rejimsorSor->execute(array(
														'ID' => $ID
													));
													$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
													if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==3 and $rejimsorCek['Is_Qurupu']==3 ) {


														?>

														<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
															<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

															<?php echo $AdSoyadAtaadi ?>
															<div class="istrahetgunleri">
																<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
																<label class="form-check-label" for="bir">
																	Bazar ertəsi
																</label>
																<br>
																<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
																<label class="form-check-label" for="iki">
																	Çərşəmbə axşamı
																</label>
																<br>
																<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
																<label class="form-check-label" for="uc">
																	Çərşəmbə
																</label>
																<br>
																<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
																<label class="form-check-label" for="dord">
																	Cümə axşamı
																</label>
																<br>
																<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
																<label class="form-check-label" for="bes">
																	Cümə
																</label>
																<br>
																<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
																<label class="form-check-label" for="alti">
																	Şəmbə
																</label>
																<br>
																<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
																<label class="form-check-label" for="yeddi">
																	Bazar
																</label>
															</div>
														</div>
													<?php	} }
												}
											}
											?>				

										</div>
									</form>

								</div>


								<div class="dordnovbeli">
									<div class="ikinovbelibaslik"> Dörd növbəli</div>
												<?php 
						$nobedordtarix = $db->prepare("SELECT * FROM is_rejimi where Idare_Id=:Idare_Id and Is_Rejimi=:Is_Rejimi and Novbe_Sayi=:Novbe_Sayi order by Tarix DESC, Is_Rejimi_Id DESC");
						$nobedordtarix->execute(array(
							'Idare_Id' => $Idare_Id,
							'Is_Rejimi' => 3,
							'Novbe_Sayi' => 4
						));
						$nobedordtarixcek = $nobedordtarix->fetch(PDO::FETCH_ASSOC);
						?>
									<div class="row">
										<div class="col-12">
											<label for="Dordnovbe_Tarix" class="form-label" style="float:left;">Başlanğıc Tarixi<span class="KirmiziYazi">*</span></label>
											<input type="text" class="form-control tarix" style="float: left;" value="<?php echo TarixAzCevir($nobedordtarixcek['Tarix'])?>"  placeholder="__.__._____" id="Dordnovbe_Tarix" oninput="TarixAlaniYazildi(this.id)" onfocusout="TarixAlaniYazildi(this.id),SagVeSolBosluklariSIl(this.id)"  onchange="TarixAlaniYazildi(this.id)" required="required" maxlength="10" tabindex="4" title="">
										</div>
										<div class="col-6">
											<label for="Gunduz" class="form-label">Gündüz<span class="KirmiziYazi">*</span></label>
											<input type="time" class="form-control" id="Gunduz" title="" maxlength="10" value="<?php echo $nobedordtarixcek['Gunduz']?>" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
										</div>
										<div class="col-6">
											<label for="Gece" class="form-label">Gecə<span class="KirmiziYazi">*</span></label>
											<input type="time" class="form-control" id="Gece" title="" maxlength="10" value="<?php echo $nobedordtarixcek['Gece']?>" onchange="SaatYazildi(this.id)" oninput="SaatYazildi(this.id)" onfocusout="SaatYazildi(this.id)">
										</div>
									</div>

									<form class="novbekapsayici" id="dordnovbebirinci">I növbə
										<input type="hidden" name="dordnovbetarixbir" id="dordnovbetarixbir">
										<input type="hidden" name="dordnovbegunduzbir" id="dordnovbegunduzbir">
										<input type="hidden" name="dordnovbegecebir" id="dordnovbegecebir">
										<div id="div8" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">

											<?php
											$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
											$Idare_Sor->execute(array(
												'Durum' => 1,
												'Idare_Id' => $Admin_Islediyi_Idare_Id
											));
											while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
												$Idare_Id = $Idare_ceker['Idare_Id'];
												$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
												$Sobe_Sor->execute(array(
													'Durum' => 1,
													'Idare_Id' => $Idare_Id
												));
												while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
													$Sobe_Id = $Sobe_Cek['Sobe_Id'];
													$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
													$Vezife_Sor->execute(array(
														'Durum' => 1,
														'Idare_Id' => $Idare_Id,
														'Sobe_Id' => $Sobe_Id,
														'User_Id' => 0
													));
													while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
														$Vezife_Id = $Vezife_Cek['Vezife_Id'];
														$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
														$User_Sor->execute(array(
															'Durum' => 1,
															'Islediyi_Idare_Id' => $Idare_Id,
															'Islediyi_Sobe_Id' => $Sobe_Id,
															'Vezife_Id' => $Vezife_Id
														));
														$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
														$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
														$ID = $User_Cek['ID'];

														$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
														$rejimsorSor->execute(array(
															'ID' => $ID
														));
														$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
														if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==4 and $rejimsorCek['Is_Qurupu']==1 ) {


															?>

															<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
																<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

																<?php echo $AdSoyadAtaadi ?>
																<div class="istrahetgunleri">
																	<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
																	<label class="form-check-label" for="bir">
																		Bazar ertəsi
																	</label>
																	<br>
																	<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
																	<label class="form-check-label" for="iki">
																		Çərşəmbə axşamı
																	</label>
																	<br>
																	<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
																	<label class="form-check-label" for="uc">
																		Çərşəmbə
																	</label>
																	<br>
																	<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
																	<label class="form-check-label" for="dord">
																		Cümə axşamı
																	</label>
																	<br>
																	<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
																	<label class="form-check-label" for="bes">
																		Cümə
																	</label>
																	<br>
																	<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
																	<label class="form-check-label" for="alti">
																		Şəmbə
																	</label>
																	<br>
																	<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
																	<label class="form-check-label" for="yeddi">
																		Bazar
																	</label>
																</div>
															</div>
														<?php	} }
													}
												}
												?>				

											</div>
										</form>

										<form class="novbekapsayici" id="dordnovbeikinci">II növbə
											<input type="hidden" name="dordnovbetarixiki" id="dordnovbetarixiki">
											<input type="hidden" name="dordnovbegunduziki" id="dordnovbegunduziki">
											<input type="hidden" name="dordnovbegeceiki" id="dordnovbegeceiki">
											<div id="div9" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">

												<?php
												$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
												$Idare_Sor->execute(array(
													'Durum' => 1,
													'Idare_Id' => $Admin_Islediyi_Idare_Id
												));
												while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
													$Idare_Id = $Idare_ceker['Idare_Id'];
													$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
													$Sobe_Sor->execute(array(
														'Durum' => 1,
														'Idare_Id' => $Idare_Id
													));
													while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
														$Sobe_Id = $Sobe_Cek['Sobe_Id'];
														$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
														$Vezife_Sor->execute(array(
															'Durum' => 1,
															'Idare_Id' => $Idare_Id,
															'Sobe_Id' => $Sobe_Id,
															'User_Id' => 0
														));
														while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
															$Vezife_Id = $Vezife_Cek['Vezife_Id'];
															$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
															$User_Sor->execute(array(
																'Durum' => 1,
																'Islediyi_Idare_Id' => $Idare_Id,
																'Islediyi_Sobe_Id' => $Sobe_Id,
																'Vezife_Id' => $Vezife_Id
															));
															$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
															$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
															$ID = $User_Cek['ID'];

															$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
															$rejimsorSor->execute(array(
																'ID' => $ID
															));
															$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
															if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==4 and $rejimsorCek['Is_Qurupu']==2 ) {


																?>

																<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
																	<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

																	<?php echo $AdSoyadAtaadi ?>
																	<div class="istrahetgunleri">
																		<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
																		<label class="form-check-label" for="bir">
																			Bazar ertəsi
																		</label>
																		<br>
																		<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
																		<label class="form-check-label" for="iki">
																			Çərşəmbə axşamı
																		</label>
																		<br>
																		<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
																		<label class="form-check-label" for="uc">
																			Çərşəmbə
																		</label>
																		<br>
																		<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
																		<label class="form-check-label" for="dord">
																			Cümə axşamı
																		</label>
																		<br>
																		<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
																		<label class="form-check-label" for="bes">
																			Cümə
																		</label>
																		<br>
																		<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
																		<label class="form-check-label" for="alti">
																			Şəmbə
																		</label>
																		<br>
																		<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
																		<label class="form-check-label" for="yeddi">
																			Bazar
																		</label>
																	</div>
																</div>
															<?php	} }
														}
													}
													?>				

												</div>
											</form>

											<form class="novbekapsayici" id="dordnovbeucuncu">III növbə
												<input type="hidden" name="dordnovbetarixuc" id="dordnovbetarixuc">
												<input type="hidden" name="dordnovbegunduzuc" id="dordnovbegunduzuc">
												<input type="hidden" name="dordnovbegeceuc" id="dordnovbegeceuc">
												<div id="div10" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">

													<?php
													$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
													$Idare_Sor->execute(array(
														'Durum' => 1,
														'Idare_Id' => $Admin_Islediyi_Idare_Id
													));
													while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
														$Idare_Id = $Idare_ceker['Idare_Id'];
														$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
														$Sobe_Sor->execute(array(
															'Durum' => 1,
															'Idare_Id' => $Idare_Id
														));
														while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
															$Sobe_Id = $Sobe_Cek['Sobe_Id'];
															$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
															$Vezife_Sor->execute(array(
																'Durum' => 1,
																'Idare_Id' => $Idare_Id,
																'Sobe_Id' => $Sobe_Id,
																'User_Id' => 0
															));
															while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
																$Vezife_Id = $Vezife_Cek['Vezife_Id'];
																$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
																$User_Sor->execute(array(
																	'Durum' => 1,
																	'Islediyi_Idare_Id' => $Idare_Id,
																	'Islediyi_Sobe_Id' => $Sobe_Id,
																	'Vezife_Id' => $Vezife_Id
																));
																$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
																$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
																$ID = $User_Cek['ID'];

																$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
																$rejimsorSor->execute(array(
																	'ID' => $ID
																));
																$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
																if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==4 and $rejimsorCek['Is_Qurupu']==3 ) {


																	?>

																	<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
																		<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

																		<?php echo $AdSoyadAtaadi ?>
																		<div class="istrahetgunleri">
																			<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
																			<label class="form-check-label" for="bir">
																				Bazar ertəsi
																			</label>
																			<br>
																			<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
																			<label class="form-check-label" for="iki">
																				Çərşəmbə axşamı
																			</label>
																			<br>
																			<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
																			<label class="form-check-label" for="uc">
																				Çərşəmbə
																			</label>
																			<br>
																			<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
																			<label class="form-check-label" for="dord">
																				Cümə axşamı
																			</label>
																			<br>
																			<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
																			<label class="form-check-label" for="bes">
																				Cümə
																			</label>
																			<br>
																			<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
																			<label class="form-check-label" for="alti">
																				Şəmbə
																			</label>
																			<br>
																			<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
																			<label class="form-check-label" for="yeddi">
																				Bazar
																			</label>
																		</div>
																	</div>
																<?php	} }
															}
														}
														?>				

													</div>
												</form>

												<form class="novbekapsayici" id="dordnovbedorduncu">IV növbə
													<input type="hidden" name="dordnovbetarixdord" id="dordnovbetarixdord">
													<input type="hidden" name="dordnovbegunduzdord" id="dordnovbegunduzdord">
													<input type="hidden" name="dordnovbegecedord" id="dordnovbegecedord">
													<div id="div11" class="mydiv" ondrop="drop(event)" ondragover="allowDrop(event)">

														<?php
														$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
														$Idare_Sor->execute(array(
															'Durum' => 1,
															'Idare_Id' => $Admin_Islediyi_Idare_Id
														));
														while ($Idare_ceker = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
															$Idare_Id = $Idare_ceker['Idare_Id'];
															$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Durum=:Durum and Idare_Id=:Idare_Id order by Sira_No ASC ");
															$Sobe_Sor->execute(array(
																'Durum' => 1,
																'Idare_Id' => $Idare_Id
															));
															while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
																$Sobe_Id = $Sobe_Cek['Sobe_Id'];
																$Vezife_Sor = $db->prepare("SELECT * FROM vezife where Durum=:Durum and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id and User_Id>:User_Id order by Sira_No ASC ");
																$Vezife_Sor->execute(array(
																	'Durum' => 1,
																	'Idare_Id' => $Idare_Id,
																	'Sobe_Id' => $Sobe_Id,
																	'User_Id' => 0
																));
																while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
																	$Vezife_Id = $Vezife_Cek['Vezife_Id'];
																	$User_Sor = $db->prepare("SELECT * FROM user where Durum=:Durum and Islediyi_Idare_Id=:Islediyi_Idare_Id and Islediyi_Sobe_Id=:Islediyi_Sobe_Id and Vezife_Id=:Vezife_Id");
																	$User_Sor->execute(array(
																		'Durum' => 1,
																		'Islediyi_Idare_Id' => $Idare_Id,
																		'Islediyi_Sobe_Id' => $Sobe_Id,
																		'Vezife_Id' => $Vezife_Id
																	));
																	$User_Cek = $User_Sor->fetch(PDO::FETCH_ASSOC);
																	$AdSoyadAtaadi = $User_Cek['Soy_Adi'] . " " . $User_Cek['Adi'];
																	$ID = $User_Cek['ID'];

																	$rejimsorSor = $db->prepare("SELECT * FROM is_rejimi where ID=:ID order by Tarix DESC, Is_Rejimi_Id DESC");
																	$rejimsorSor->execute(array(
																		'ID' => $ID
																	));
																	$rejimsorCek = $rejimsorSor->fetch(PDO::FETCH_ASSOC);
																	if ($rejimsorCek['Idare_Id']==$Idare_Id and $rejimsorCek['Is_Rejimi']==3 and $rejimsorCek['Novbe_Sayi']==4 and $rejimsorCek['Is_Qurupu']==4 ) {


																		?>

																		<div class="qrafiqriolmayan" draggable="true" ondragstart="drag(event)" id="<?php echo $ID ?>">
																			<input type="hidden" name="ID[]" value="<?php echo $ID ?>">

																			<?php echo $AdSoyadAtaadi ?>
																			<div class="istrahetgunleri">
																				<input type="checkbox" name="<?php echo 'bir_' . $ID ?>" >
																				<label class="form-check-label" for="bir">
																					Bazar ertəsi
																				</label>
																				<br>
																				<input type="checkbox" name="<?php echo 'iki_' . $ID ?>" >
																				<label class="form-check-label" for="iki">
																					Çərşəmbə axşamı
																				</label>
																				<br>
																				<input type="checkbox" name="<?php echo 'uc_' . $ID ?>" >
																				<label class="form-check-label" for="uc">
																					Çərşəmbə
																				</label>
																				<br>
																				<input type="checkbox" name="<?php echo 'dord_' . $ID ?>">
																				<label class="form-check-label" for="dord">
																					Cümə axşamı
																				</label>
																				<br>
																				<input type="checkbox" name="<?php echo 'bes_' . $ID ?>">
																				<label class="form-check-label" for="bes">
																					Cümə
																				</label>
																				<br>
																				<input type="checkbox" name="<?php echo 'alti_' . $ID ?>">
																				<label class="form-check-label" for="alti">
																					Şəmbə
																				</label>
																				<br>
																				<input type="checkbox" name="<?php echo 'yeddi_' . $ID ?>">
																				<label class="form-check-label" for="yeddi">
																					Bazar
																				</label>
																			</div>
																		</div>
																	<?php	} }
																}
															}
															?>				

														</div>
													</form>
												</div>
												<hr>
												<div class="row">
													<button class="qrafiqtestiqbutonu" onclick="IsrejimiYoxla()">Təsdiq et</button>
												</div>
												<?php require_once '_footer.php'; ?>
												<script>
													TarixFormati();
												</script>