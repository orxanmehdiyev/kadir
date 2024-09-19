<?php require_once '../Ayarlar/setting.php';
$Isnovu=ReqemlerXaricButunKarakterleriSil($_POST['ID']);
if ($Isnovu==5) {?>
	<div class="col-2">
		<label for="User_Is_Novu" class="form-label">İşin Növü<span class="KirmiziYazi">*</span></label>	
		<select required="required" id="User_Is_Novu" class="form-select" onchange="VakanYerleriSay(this.id)" title="">
			<option disabled="disabled" value="" selected="selected" tabindex="10"></option>										
			<option value="0">Ştat Daxili</option>				
		</select>
	</div> 
<?php }else{?>
	<div class="col-12 text-center mt-3">
					<button type="button" onclick="IntizamTenbehiFormKontrol()" class="YenileButonlari" tabindex="15" title="">Yaddaş</button>
					<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
				</div>	
<?php }


?>