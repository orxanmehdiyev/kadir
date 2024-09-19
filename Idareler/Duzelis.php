<?php 
require_once '../Ayarlar/setting.php';
if ($IdarelerDuzelis==1) {

if (isset($_POST['Deyer'])) {
	$Idare_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sors=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id");
	$Sors->execute(array(
		'Idare_Id'=>$Idare_Id
	));
	$Ceks=$Sors->fetch(PDO::FETCH_ASSOC);
	?>
	<form name="IslemFormu">
		<div class="SeyfeIciSetirAlaniKapsayici">
			<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
				<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Ust_Id" >Tabe Olduğu Qurum <span class="KirmiziYazi">*</span>
				</div>
				<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">
					<?php
					$Sor=$db->prepare("SELECT * FROM tabeli_qurumlar_ve_bas_idareler where Durum=:Durum order by Sira_No ASC ");
					$Sor->execute(array(
						'Durum'=>1));
						?>
						<select tabindex="2" required="required" id="Ust_Id" class="FormAlanlariUcunSelectInputlari" onchange="SecimEdildi(this.id)" title="Secim Edin">
							<?php
							while ($Cek = $Sor->fetch(PDO::FETCH_ASSOC)) {
								?>
								<option
								<?php 
								if ($Cek['Id']==$Ceks['Ust_Id']) {
									echo 'selected="selected"';
								}else{}
								?>
								value="<?php echo $Cek['Id'] ?>"><?php echo $Cek['Adi'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Adi" >Adı <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class=" FormAlanlariUcunTextInputlari number"oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "80" value="<?php echo $Ceks['Idare_Adi'] ?>"  id="Idare_Adi"  tabindex="1" required="" />
					</div>
				</div>
			</div>


			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Kissa_Adi" >Kisa Adı <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class=" FormAlanlariUcunTextInputlari number"oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "80" value="<?php echo $Ceks['Idare_Kissa_Adi'] ?>"  id="Idare_Kissa_Adi"  tabindex="1" required="" />
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_VOEN">VÖEN <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "number" class=" FormAlanlariUcunTextInputlari number"  oninput="VoenYazildi(this.id)" maxlength="10"  onfocusout="VoenYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Ceks['Idare_VOEN'] ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true"  id="Idare_VOEN"  tabindex="1" required="" />
					</div>
				</div>
			</div>

			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Sira_No">Sıra Nömrəsi <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "number" class=" FormAlanlariUcunTextInputlari number"  oninput="NoYazildi(this.id)" maxlength="10"  onfocusout="NoYazildi(this.id),SagVeSolBosluklariSIl(this.id)" value="<?php echo $Ceks['Sira_No'] ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true"  id="Sira_No"  tabindex="1" required="" />
					</div>
				</div>
			</div>



			<div class="SeyfeIciSetirAlaniKapsayici">
				<div class="SeyfeIciSetirAlaniKapsayiciYuzdeEllilikAlan">
					<div class="SeyfeIciSetirAlaniSolMetinAlaniKapsayici" for="Idare_Unvan">Ünvanı <span class="KirmiziYazi">*</span>
					</div>
					<div class="SeyfeIciSetirAlanlariSagFormElementleriAlaniKapsayicisi">	
						<input type = "text" class=" FormAlanlariUcunTextInputlari number" oninput="AdiYazildi(this.id)"  onfocusout="AdiYazildi(this.id),SagVeSolBosluklariSIl(this.id)" maxlength = "100" value="<?php echo $Ceks['Idare_Unvan'] ?>"  id="Idare_Unvan"  tabindex="1" required="" />
					</div>
				</div>
			</div>
			<input type="hidden" id="Idare_Id" value="<?php echo $Idare_Id ?>" >
			<div class="SayfaIciButonlarIcinSatirAlanlariKapsayicisi">
				<button type="button" class="YenileButonlari"  onClick="DuzelisFormKontrol()"  tabindex="5">Yaddaşa Yaz</button>
				<button type="button" class="QirmiziButonlar"  onClick="Bagla();" tabindex="6" >İmtina Et</button>
			</div>
			<p><b class="KirmiziYazi"  id="errorcavabi"></b></p>
		</form>
		<?php  
	}else{
		header("Location:../login.php");
		exit;
	}	// code...
}?>
