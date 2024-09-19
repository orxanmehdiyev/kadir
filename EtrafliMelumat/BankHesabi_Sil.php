<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Bank_Hesab_Nomresi_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Bank_Hesab=$db->prepare("SELECT * FROM  bank_hesab_nomrsei where Bank_Hesab_Nomresi_Id=:Bank_Hesab_Nomresi_Id");
	$Bank_Hesab->execute(array(
		'Bank_Hesab_Nomresi_Id'=>$Bank_Hesab_Nomresi_Id));
	$Bank_HesabCek=$Bank_Hesab->fetch(PDO::FETCH_ASSOC);
	$Bank_Hesab_Nomresi_Bank_Adi=$Bank_HesabCek['Bank_Hesab_Nomresi_Bank_Adi'];
	$Bank_Hesab_Nomresi=$Bank_HesabCek['Bank_Hesab_Nomresi'];
	$ID=$Bank_HesabCek['ID'];
	$User_sor=$db->prepare("SELECT * FROM  user where ID=:ID and Durum=:Durum");
	$User_sor->execute(array(
		'ID'=>$ID,
		'Durum'=>0));
	$User_Say=$User_sor->rowCount();
	if ($Bank_Hesab_Nomresi_Bank_Adi!="" and $Bank_Hesab_Nomresi!="" and $User_Say==1) {
		$sil = $db->prepare("DELETE from bank_hesab_nomrsei where Bank_Hesab_Nomresi_Id=:Bank_Hesab_Nomresi_Id");
		$kontrol = $sil->execute(array(
			'Bank_Hesab_Nomresi_Id' => $Bank_Hesab_Nomresi_Id
		));
		if ($kontrol) {				
			$Elave_Et=$db->prepare("INSERT INTO bank_hesab_nomrsei_islemleri SET                               
				Admin_Id=:Admin_Id,
				ZamanDamgasi=:ZamanDamgasi,
				TarixSaat=:TarixSaat,
				IPAdresi=:IPAdresi,
				Bank_Hesab_Nomresi_Islemleri_Sebeb=:Bank_Hesab_Nomresi_Islemleri_Sebeb,
				Bank_Hesab_Nomresi_Id=:Bank_Hesab_Nomresi_Id,
				ID=:ID,
				Bank_Hesab_Nomresi_Bank_Adi=:Bank_Hesab_Nomresi_Bank_Adi,
				Bank_Hesab_Nomresi=:Bank_Hesab_Nomresi
				");
			$Insert=$Elave_Et->execute(array(                                
				'Admin_Id'=>$Admin_Id,
				'ZamanDamgasi'=>$ZamanDamgasi,
				'TarixSaat'=>$TarixSaat,
				'IPAdresi'=>$IPAdresi,
				'Bank_Hesab_Nomresi_Islemleri_Sebeb'=>3,
				'Bank_Hesab_Nomresi_Id'=>$Bank_Hesab_Nomresi_Id,
				'ID'=>$ID,
				'Bank_Hesab_Nomresi_Bank_Adi'=>$Bank_Hesab_Nomresi_Bank_Adi,
				'Bank_Hesab_Nomresi'=>$Bank_Hesab_Nomresi
			));
			if ($Insert) {?>

				<?php 
				$Bank_Hesab_Sor=$db->prepare("SELECT * FROM  bank_hesab_nomrsei where ID=:ID order by Bank_Hesab_Nomresi_Bank_Adi ASC ");
				$Bank_Hesab_Sor->execute(array(
					'ID'=>$ID));
					?>
					<table class="ListelemeAlaniIciTablosu caption-top">
						<caption><b>Bank hesab nömrəsi</b>	<button class="YenileButonlari sag" onclick="YeniBankHesabi()" type="button">Yeni</button></caption>
						<thead>
							<tr>
								<th class="textaligncenter">№</th>
								<th>Bankın adı</th>
								<th>Hesab nömrəsi</th>															
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$BankHesabSira=0;
							while($Bank_Hesab_Cek=$Bank_Hesab_Sor->fetch(PDO::FETCH_ASSOC)) {
								$BankHesabSira++;
								?>
								<tr>
									<td  class="textaligncenter"><?php echo $BankHesabSira;?></td>
									<td><?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi_Bank_Adi'] ?></td>
									<td><?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi'] ?></td>																									
									<td class="emeliyyatlar_iki_buttom">
										<button class="YenileButonlari" id="EzamiyyeDuzenle_<?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi_Id'] ?>" onclick="BankHesabiDuzenle(this.id)" type="button">
											<i class="fas fa-edit"></i>
										</button>		
										<button class="YenileButonlari" id="EzamiyyeSil_<?php echo $Bank_Hesab_Cek['Bank_Hesab_Nomresi_Id'] ?>" onclick="BankHesabiSil(this.id)" type="button">
											<i class="fas fa-trash"></i>
										</button>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<hr>

				<?php }else{
					echo "error_2001";/* Adı boş ola bilməz*/
					exit;
				}

			}else{
				echo "error_2001";/* Adı boş ola bilməz*/
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