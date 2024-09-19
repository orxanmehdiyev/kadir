<?php 
require_once '../Ayarlar/baglan.php';
require_once '../Ayarlar/function.php';
$Stat_Muqavile=ReqemlerXaricButunKarakterleriSil($_POST['Stat_Muqavile']);
$Vezife_Sor=$db->prepare("SELECT * FROM vezife where NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Stat_Muqavile=:Stat_Muqavile and User_Id=:User_Id and Durum=:Durum");
$Vezife_Sor->execute(array(
	'yeniemir'=>0,
	'Stat_Muqavile'=>$Stat_Muqavile,
	'User_Id'=>0,
	'Durum'=>1));
$Vezife_Say=$Vezife_Sor->rowCount();
if ( $Vezife_Say>0) {
	if ($Stat_Muqavile==0) {
		?>
		<input type="hidden" id="yersayi" value="<?php echo $Vezife_Say ?>">
		<div class="col-5">
			<label for="Islediyi_Idare" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
			<select class="form-select" required="required"  id="Islediyi_Idare" onchange="StatIdareSobeTelebEt(this.id)" tabindex="12" title="" >
				<option ></option>
				<?php
				$Idare_Sorr=$db->prepare("SELECT DISTINCT Idare_Id FROM vezife where NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Stat_Muqavile=:Stat_Muqavile and  User_Id=:User_Id and Durum=:Durum");
				$Idare_Sorr->execute(array(
					'yeniemir'=>0,
					'Stat_Muqavile'=>$Stat_Muqavile,
					'User_Id'=>0,
					'Durum'=>1));
				$Idare_Say=$Idare_Sorr->rowCount();
				while ($Idare_ceker=$Idare_Sorr->fetch(PDO::FETCH_ASSOC)){
					$Idare_Id=$Idare_ceker['Idare_Id'];
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id order by Sira_No ASC");
					$Idare_Sor->execute(array(
						'Idare_Id'=>$Idare_Id));
					while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)){
						?>
						<option value="<?php echo $Idare_Cek['Idare_Id'] ?>"><?php echo $Idare_Cek['Idare_Adi'] ?></option>
						<?php 
					}
				}
				?>
			</select>
		</div>  

		<div class="col-4" id="yeniemirsobe">
			
		</div> 

		<div class="col-3" id="yeniemirvezife">
			
		</div>

		<div class="col-12 text-center mt-3">

			<button type="button" onclick="AsagiYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>


	<?php }else{?>
		<input type="hidden" id="yersayi" value="<?php echo $Vezife_Say ?>">
		<div class="col-5">
			<label for="Islediyi_Idare" class="form-label">İdarə<span class="KirmiziYazi">*</span></label>
			<select class="form-select" required="required"  id="Islediyi_Idare" onchange="MuqavileIdareSobeTelebEt(this.id)" tabindex="12" title="" >
				<option ></option>
				<?php
				$Idare_Sorr=$db->prepare("SELECT DISTINCT Idare_Id FROM vezife where NOT EXISTS (SELECT * FROM ise_qebul_emri WHERE  ise_qebul_emri.User_Vezife = vezife.Vezife_Id and ise_qebul_emri.Ise_Qebul_Emri_Stausu=:yeniemir ) and Stat_Muqavile=:Stat_Muqavile and  User_Id=:User_Id and Durum=:Durum");
				$Idare_Sorr->execute(array(
					'yeniemir'=>0,
					'Stat_Muqavile'=>$Stat_Muqavile,
					'User_Id'=>0,
					'Durum'=>1));
				$Idare_Say=$Idare_Sorr->rowCount();
				while ($Idare_ceker=$Idare_Sorr->fetch(PDO::FETCH_ASSOC)){
					$Idare_Id=$Idare_ceker['Idare_Id'];
					$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id order by Sira_No ASC");
					$Idare_Sor->execute(array(
						'Idare_Id'=>$Idare_Id));
					while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)){
						?>
						<option value="<?php echo $Idare_Cek['Idare_Id'] ?>"><?php echo $Idare_Cek['Idare_Adi'] ?></option>
						<?php 
					}
				}
				?>
			</select>
		</div>  

		<div class="col-4" id="yeniemirsobe">
			
		</div> 

		<div class="col-3" id="yeniemirvezife">
			
		</div>

		<div class="col-12 text-center mt-3">

			<button type="button" onclick="AsagiYeniFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
			<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
		</div>


	<?php }
}
else{ 
	?>
	<input type="hidden" id="yersayi" value="<?php echo $Vezife_Say ?>">
	<?php } ?>