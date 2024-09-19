<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$User_Usaq_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Usaq_Sor=$db->prepare("SELECT * FROM user_usaq where User_Usaq_Id=:User_Usaq_Id ");
	$Usaq_Sor->execute(array(
		'User_Usaq_Id'=>$User_Usaq_Id));
	$Usaq_Cek=$Usaq_Sor->fetch(PDO::FETCH_ASSOC);
	$ID=$Usaq_Cek['ID'];
	$Adi=$Usaq_Cek['Adi'];
	$Soyadi=$Usaq_Cek['Soyadi'];
	$Ataadi=$Usaq_Cek['Ataadi'];
	$Dogum_Tarixi=$Usaq_Cek['Dogum_Tarixi'];
	$Dogum_Tarixi_Unix=$Usaq_Cek['Dogum_Tarixi_Unix'];
	$Dogum_Tarixi_Beynel=$Usaq_Cek['Dogum_Tarixi_Beynel'];
	$Dogum_Tarixi_Beynel=$Usaq_Cek['Dogum_Tarixi_Beynel'];
	$sil = $db->prepare("DELETE from user_usaq where User_Usaq_Id=:User_Usaq_Id");
	$kontrol = $sil->execute(array(
		'User_Usaq_Id' => $User_Usaq_Id
	));	
	if ($kontrol) {			
		$Elave_Et=$db->prepare("INSERT INTO user_usaq_islemleri SET                               
			Islem_Sebebi=:Islem_Sebebi,
			IPAdresi=:IPAdresi,
			TarixSaat=:TarixSaat,
			ZamanDamgasi=:ZamanDamgasi,
			Admin_Id=:Admin_Id,
			User_Usaq_Id=:User_Usaq_Id,
			ID=:ID,
			Adi=:Adi,
			Soyadi=:Soyadi,
			Ataadi=:Ataadi,
			Dogum_Tarixi=:Dogum_Tarixi,
			Dogum_Tarixi_Unix=:Dogum_Tarixi_Unix,
			Dogum_Tarixi_Beynel=:Dogum_Tarixi_Beynel
			");
		$Insert=$Elave_Et->execute(array(                                
			'Islem_Sebebi'=>1,
			'IPAdresi'=>$IPAdresi,
			'TarixSaat'=>$TarixSaat,
			'ZamanDamgasi'=>$ZamanDamgasi,
			'Admin_Id'=>$Admin_Id,
			'User_Usaq_Id'=>$User_Usaq_Id,
			'ID'=>$ID,
			'Adi'=>$Adi,
			'Soyadi'=>$Soyadi,
			'Ataadi'=>$Ataadi,
			'Dogum_Tarixi'=>$Dogum_Tarixi,
			'Dogum_Tarixi_Unix'=>$Dogum_Tarixi_Unix,
			'Dogum_Tarixi_Beynel'=>$Dogum_Tarixi_Beynel
		));
		if ($Insert) {

			echo '<input type="hidden" id="status" value="success">';
			?>
			<?php 
			$Usaq_Sor=$db->prepare("SELECT * FROM user_usaq where ID=:ID order by Dogum_Tarixi_Beynel ASC ");
			$Usaq_Sor->execute(array(
				'ID'=>$ID));
			$Usaq_Say=$Usaq_Sor->rowCount();
			?>
			<input type="hidden" id="usaqlarininsayi" value="<?php echo $Usaq_Say ?>">
			<table class="ListelemeAlaniIciTablosu caption-top">
				<caption><b>Uşaqları</b>	<button class="YenileButonlari sag" onclick="YeniUsaq()" type="button">Yeni</button></caption>
				<thead>
					<tr>
						<th class="textaligncenter">№</th>
						<th>Soyadı Adı Ata adı</th>
						<th>Doğum tarixi</th>															
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$UsaqSira=0;
					while($Usaq_Cek=$Usaq_Sor->fetch(PDO::FETCH_ASSOC)) {
						$UsaqSira++;
						?>
						<tr>
							<td  class="textaligncenter"><?php echo $UsaqSira;?></td>
							<td><?php echo $Usaq_Cek['Soyadi']." ".$Usaq_Cek['Adi']." ".$Usaq_Cek['Ataadi'] ?></td>
							<td><?php echo $Usaq_Cek['Dogum_Tarixi'] ?></td>																									
							<td class="emeliyyatlar_iki_buttom">
								<button class="YenileButonlari" id="UsaqDuzenle_<?php echo $Usaq_Cek['User_Usaq_Id'] ?>" onclick="UsaqDuzenle(this.id)" type="button">
									<i class="fas fa-edit"></i>
								</button>		
								<button class="YenileButonlari" id="UsaqSil_<?php echo $Usaq_Cek['User_Usaq_Id'] ?>" onclick="UsaqSil(this.id)" type="button">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<hr>
			<?php	
		}else{
			echo '<input type="hidden" id="status" value="errorfull">';				
			echo '<input type="hidden" id="message" value="Xeta baş verdi sistem idarəcisinə məlumat verin (ikinci əməliyyat uğursuz)">'	;
			exit;
		}
	}else{
		echo '<input type="hidden" id="status" value="errorfull">';			
		echo '<input type="hidden" id="message" value="Xeta baş verdi sistem idarəcisinə məlumat verin">'	;
		exit;
	}







}else{
	header("Location:../intizam_tebehi_adlari");
	exit;
}
?>