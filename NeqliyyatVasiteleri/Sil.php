<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Neqliyyat_Vasiteleri_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Sor=$db->prepare("SELECT * FROM neqliyyat_vasiteleri order by Neqliyyat_Vasiteleri_Istehsal_Ili ASC");
	$Sor->execute(array(
		'Neqliyyat_Vasiteleri_Id'=>$Neqliyyat_Vasiteleri_Id));
	$Cek=$Sor->fetch(PDO::FETCH_ASSOC);
	$Dovlet_Nom_Nisani=$Cek['Dovlet_Nom_Nisani'];
	$Neqliyyat_Vasiteleri_Novu=$Cek['Neqliyyat_Vasiteleri_Novu'];
	$Neqliyyat_Vasiteleri_Marka=$Cek['Neqliyyat_Vasiteleri_Marka'];
	$Neqliyyat_Vasiteleri_Adam_Yeri=$Cek['Neqliyyat_Vasiteleri_Adam_Yeri'];
	$Bann_Nomresi=$Cek['Bann_Nomresi'];
	$Sash_Nomresi=$Cek['Sash_Nomresi'];
	$Rengi=$Cek['Rengi'];
	$Neqliyyat_Vasiteleri_Motor_Hecmi=$Cek['Neqliyyat_Vasiteleri_Motor_Hecmi'];	
	$Idare_Id=$Cek['Idare_Id'];
	$Neqliyyat_Vasiteleri_Istehsal_Ili=$Cek['Neqliyyat_Vasiteleri_Istehsal_Ili'];
	$Neqliyyat_Vasiteleri_Balans_Deyeri=$Cek['Neqliyyat_Vasiteleri_Balans_Deyeri'];
	$sil = $db->prepare("DELETE from neqliyyat_vasiteleri where Neqliyyat_Vasiteleri_Id=:Neqliyyat_Vasiteleri_Id");
	$kontrol = $sil->execute(array(
		'Neqliyyat_Vasiteleri_Id' => $Neqliyyat_Vasiteleri_Id
	));
	if ($kontrol) {			
		$Elave_Et=$db->prepare("INSERT INTO neqliyyat_vasiteleri_islemleri SET                               
			Neqliyyat_Vasiteleri_Id=:Neqliyyat_Vasiteleri_Id,
			Dovlet_Nom_Nisani=:Dovlet_Nom_Nisani,
			Neqliyyat_Vasiteleri_Novu=:Neqliyyat_Vasiteleri_Novu,
			Neqliyyat_Vasiteleri_Marka=:Neqliyyat_Vasiteleri_Marka,
			Neqliyyat_Vasiteleri_Motor_Hecmi=:Neqliyyat_Vasiteleri_Motor_Hecmi,
			Neqliyyat_Vasiteleri_Adam_Yeri=:Neqliyyat_Vasiteleri_Adam_Yeri,
			Neqliyyat_Vasiteleri_Istehsal_Ili=:Neqliyyat_Vasiteleri_Istehsal_Ili,
			Idare_Id=:Idare_Id,
			Neqliyyat_Vasiteleri_Balans_Deyeri=:Neqliyyat_Vasiteleri_Balans_Deyeri,
			Bann_Nomresi=:Bann_Nomresi,
			Sash_Nomresi=:Sash_Nomresi,
			Admin_Id=:Admin_Id,
			ZamanDamgasi=:ZamanDamgasi,
			TarixSaat=:TarixSaat,
			IPAdresi=:IPAdresi,
			Sebeb=:Sebeb,
			Rengi=:Rengi
			");
		$Insert=$Elave_Et->execute(array(                                
			'Neqliyyat_Vasiteleri_Id'=>$Neqliyyat_Vasiteleri_Id,
			'Dovlet_Nom_Nisani'=>$Dovlet_Nom_Nisani,
			'Neqliyyat_Vasiteleri_Novu'=>$Neqliyyat_Vasiteleri_Novu,
			'Neqliyyat_Vasiteleri_Marka'=>$Neqliyyat_Vasiteleri_Marka,
			'Neqliyyat_Vasiteleri_Motor_Hecmi'=>$Neqliyyat_Vasiteleri_Motor_Hecmi,
			'Neqliyyat_Vasiteleri_Adam_Yeri'=>$Neqliyyat_Vasiteleri_Adam_Yeri,
			'Neqliyyat_Vasiteleri_Istehsal_Ili'=>$Neqliyyat_Vasiteleri_Istehsal_Ili,
			'Idare_Id'=>$Idare_Id,
			'Neqliyyat_Vasiteleri_Balans_Deyeri'=>$Neqliyyat_Vasiteleri_Balans_Deyeri,
			'Bann_Nomresi'=>$Bann_Nomresi,
			'Sash_Nomresi'=>$Sash_Nomresi,
			'Admin_Id'=>$Admin_Id,
			'ZamanDamgasi'=>$ZamanDamgasi,
			'TarixSaat'=>$TarixSaat,
			'IPAdresi'=>$IPAdresi,
			'Sebeb'=>3,
			'Rengi'=>$Rengi
		));
		if ($Insert) {				
			echo '<input type="hidden" id="status" value="success">';		 
			$Sor=$db->prepare("SELECT * FROM neqliyyat_vasiteleri order by Neqliyyat_Vasiteleri_Istehsal_Ili ASC");
			$Sor->execute();
			$Say=$Sor->rowCount();
			if ($Say>0) {?>
				<div class="row">
					<div class="over-y genislik">
						<table style="white-space: normal;" class="table table-bordered table-hover " id="dataTable">
							<thead class="">
								<tr>
									<th>№</th>
									<th>Nömrəsi</th>
									<th>Növü</th>
									<th>Markası</th>
									<th>Motor hecmi</th>
									<th>Yer Sayi</th>
									<th>İli</th>
									<th>İdarə</th>
									<th>Dəyəri</th>							
									<th>Əməliyyatlar</th>								
								</tr>
							</thead>
							<tbody>
								<?php 
								$neqliyyatsira=0;
								while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
									$neqliyyatsira++;
									$Idare_Sor=$db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id ");
									$Idare_Sor->execute(array(
										'Idare_Id'=>$Cek['Idare_Id']));
									$Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
									$Idare_Adi=$Idare_Cek['Idare_Kissa_Adi'];
									?>
									<tr>							
										<td class="siar_no_alani"><?php echo $neqliyyatsira ?></td>										
										<td><?php echo $Cek['Dovlet_Nom_Nisani'] ?></td>
										<td><?php echo $Cek['Neqliyyat_Vasiteleri_Novu'] ?></td>
										<td><?php echo $Cek['Neqliyyat_Vasiteleri_Marka'] ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Motor_Hecmi'] ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Adam_Yeri'] ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Istehsal_Ili'] ?></td>
										<td class="textaligncenter"><?php echo $Idare_Adi ?></td>
										<td class="textaligncenter"><?php echo $Cek['Neqliyyat_Vasiteleri_Balans_Deyeri'] ?></td>
										<td class="emeliyyatlar_iki_buttom">											
											<button class="YenileButonlari" id="Duzeli_<?php echo $Cek['Neqliyyat_Vasiteleri_Id'] ?>" onclick="Duzeli(this.id)" type="button"><i class="fas fa-edit"></i></button>	
											<button class="YenileButonlari" id="Sil_<?php echo $Cek['Neqliyyat_Vasiteleri_Id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>
										</td>
									</tr>	
								<?php }	?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }else{	?>
				<div class="row">
					<div class="over-y">
						Bazada Nəqliyyat vasitəsi Yoxdur
					</div>
				</div> 
			<?php 	}	
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