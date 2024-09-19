<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Ise_Qebul_Emri_Id  = ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM  ise_qebul_emri where  Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id");
	$Sor->execute(array(
		'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	?>
	<div class="row g-3 p-2 ">
		
		<div class="col-4">
			<label class="form-label">Soyadı</label>
			<input type="text" class="form-control ucword" disabled="disabled" value="<?php echo $Cek['User_Soy_Ad']?>">
		</div>
		<div class="col-4">
			<label class="form-label">Adı</label>
			<input type="text" class="form-control ucword" disabled="disabled" value="<?php echo $Cek['User_Ad']?>">
		</div>
		<div class="col-4">
			<label class="form-label">Ata Adı</label>
			<input type="text" class="form-control ucword" disabled="disabled" value="<?php echo $Cek['User_Ata_Ad']?>">
		</div>
		<div class="col-2">
			<label  class="form-label">Doğum Tarixi</label>
			<input type="text" class="form-control" disabled="disabled" value="<?php echo $Cek['User_Dogum_Tarixi']?>">
		</div>
		<div class="col-2">
			<label class="form-label">Fin</label>
			<input type="text" class="form-control uppercase" disabled="disabled" value="<?php echo $Cek['User_Fin']?>">
		</div>
		<div class="col-8">
			<label class="form-label">Ünvanı</label>
			<input type="text" class="form-control ucword" disabled="disabled" value="<?php echo $Cek['User_Yasayis_Unvan']?>">
		</div>
		<div class="col-2">
			<label for="User_Tehsil	" class="form-label" >Təhsili</label>
			<?php 	
			if ($Cek['User_Tehsil']==1){
				$tehsil="İbtidai";
			}	elseif ($Cek['User_Tehsil']==2){
				$tehsil="Ümumi Orta";
			}elseif ($Cek['User_Tehsil']==3){
				$tehsil="Tam Orta";
			}elseif ($Cek['User_Tehsil']==4){
				$tehsil="İlk Peşə ";
			}elseif ($Cek['User_Tehsil']==5){
				$tehsil="Texniki Peşə";
			}elseif ($Cek['User_Tehsil']==6){
				$tehsil="Yüksək Texniki Peşə";
			}elseif ($Cek['User_Tehsil']==7){
				$tehsil="Orta ixtisas";
			}elseif ($Cek['User_Tehsil']==8){
				$tehsil="Bakalavriat";
			}elseif ($Cek['User_Tehsil']==9){
				$tehsil="Magistratura (Rezidentura)";
			}elseif ($Cek['User_Tehsil']==10){
				$tehsil="Doktorantura (Adyunktura)";
			}
			?>
			<input type="text" class="form-control " value="<?php echo $tehsil ?>" disabled="disabled">			
		</div> 
		<div class="col-10">
			<label class="form-label" >Universitet</label>
			<input type="text" class="form-control ucword" value="<?php echo $Cek['User_Tehsil_Aldigi_Muesse'] ?>" disabled="disabled">
		</div> 
		<div class="col-10">
			<label class="form-label" >İxtisas</label>
			<input type="text" class="form-control " value="<?php echo $Cek['Ixtisas'] ?>" disabled="disabled">
		</div> 
		<div class="col-2">
			<label class="form-label">İşə qəbul tarixi</label>
			<input type="text" class="form-control" value="<?php echo  $Cek['User_Ise_Qebul_Tarixi'] ?>" disabled="disabled">
		</div>
		<div class="col-2">
			<label class="form-label">Cinsiyyəti</label>
			<input disabled="disabled" type="text" value="<?php echo $Cek['Usre_Cinsiyeti']==0?"Kişi":"Qadın" ?>"  class="form-control">
		</div>
		<div class=" col-3 sinaqmuddeti">
			<label class="form-label">Sinaq Müddəti</label>	
			<input disabled="disabled" type="number" value="<?php echo $Cek['SinaqMuddeti'] ?>"  class="form-control sinaqmuddetigun">
			<input disabled="disabled" type="text" value="<?php echo $Cek['SinaqMuddetiGunAy']==0?"Ay":"Gün" ?>"  class="form-control sinaqmuddetigunay">
		</div>
		<div class="col-2">
			<label class="form-label">İşin Növü</label>			
			<input disabled="disabled" type="text" value="<?php echo $Cek['User_Is_Novu']==0?"Ştat Daxili":"Ştatdan Kənar" ?>"  class="form-control ">
		</div> 
		<div class="col-6">
			<label>Əmrin Nömrəsi</label>
			<input type="text" class="form-control" value="<?php echo $Cek['Ise_Qebul_Emri_Nomresi'] ?>"  disabled="disabled">
		</div> 
		<div class="col-12">
			<label class="form-label">Qeyd</label>
			<input type="text" class="form-control" disabled="disabled" value="<?php echo $Cek['Mezmun'] ?>">
		</div>
		<div class="col-5">
			<label class="form-label">İdarə</label>
			<input type="text" class="form-control" disabled="disabled" value="<?php echo $Cek['User_Islediyi_Idare_Ad'] ?>">
		</div>  
		<div class="col-4">
			<label class="form-label">Şöbə</label>
			<input type="text" class="form-control" disabled="disabled" value="<?php echo $Cek['User_Islediyi_Sobe_Bolme_Ad'] ?>">			
		</div> 
		<div class="col-3">
			<label class="form-label">Vəzifə</label>
			<input type="text" class="form-control" value="<?php echo $Cek['User_Vezife_Ad'] ?>"  disabled="disabled">
		</div>
		<div class="col-12 text-center mt-3">
			<?php if ($Cek['Ise_Qebul_Emri_Stausu']!=1) {?>
				<button type="button" onclick="DuzeliseGonder(this.id)" id="duzelisyoxlanis_<?php echo $Ise_Qebul_Emri_Id ?>" class="YenileButonlari" tabindex="15">Düzəliş</button>
			<?php }else{} ?>
			<?php if ($Cek['Ise_Qebul_Emri_Stausu']!=1) {?>
				<button type="button" onclick="TesdiqYoxlanis(this.id)" id="tesdiqyoxlanis_<?php echo $Ise_Qebul_Emri_Id ?>" class="YenileButonlari" tabindex="15">Təsdiq Et</button>
			<?php }else{} ?>
			<?php if ($Cek['Ise_Qebul_Emri_Stausu']!=1) {?>
				<button type="button" id="silyoxlanis_<?php echo $Ise_Qebul_Emri_Id ?>" onclick="SilYoxlanis(this.id)" class="YenileButonlari" tabindex="16">Sil</button>
			<?php }else{} ?>
		</div>
	</div>
	<?php } ?>