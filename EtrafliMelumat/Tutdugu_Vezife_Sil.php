<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$User_Islediyi_Vezife_Id=ReqemlerXaricButunKarakterleriSil($_POST['Deyer']);
	$Tutdugu_Sor=$db->prepare("SELECT * FROM  user_islediyi_vezife where User_Islediyi_Vezife_Id=:User_Islediyi_Vezife_Id ");
	$Tutdugu_Sor->execute(array(
		'User_Islediyi_Vezife_Id'=>$User_Islediyi_Vezife_Id));
	$Say=$Tutdugu_Sor->rowCount();
	if ($Say==1) {
		$Tutdugu_Cek=$Tutdugu_Sor->fetch(PDO::FETCH_ASSOC);
		$ID=$Tutdugu_Cek['ID'];

		$sil = $db->prepare("DELETE from user_islediyi_vezife where User_Islediyi_Vezife_Id=:User_Islediyi_Vezife_Id");
		$kontrol = $sil->execute(array(
			'User_Islediyi_Vezife_Id' => $User_Islediyi_Vezife_Id
		));
		if ($kontrol) {?>

			<?php 
			$Tutdugu_Vezife_Sor=$db->prepare("SELECT * FROM  user_islediyi_vezife where ID=:ID order by Vezifeye_Teyin_Tarixi_Unix ASC ");
			$Tutdugu_Vezife_Sor->execute(array(
				'ID'=>$ID));
				?>
				<table class="ListelemeAlaniIciTablosu caption-top" >
					<caption><b>Tutduğu vəzifələr </b>	<button class="YenileButonlari sag" onclick="YeniTutduguVezife()" type="button">Yeni</button></caption>
					<thead>
						<tr>
							<th>№</th>
							<th>İdarə</th>
							<th>Şöbə/Bölmə</th>
							<th>Vəzifə</th>
							<th>Təyin</th>
							<th>Azad olma</th>
							<th>Səbəb</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php while($Tutdugu_Vezife_Cek=$Tutdugu_Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {?>
							<tr>
								<td class="textaligncenter">1</td>
								<td><?php echo $Tutdugu_Vezife_Cek['Idare_Ad'] ?></td>
								<td><?php echo $Tutdugu_Vezife_Cek['Sobe_Ad'] ?></td>
								<td><?php echo $Tutdugu_Vezife_Cek['Vezife_Ad'] ?></td>
								<td><?php echo $Tutdugu_Vezife_Cek['Vezifeye_Teyin_Tarixi'] ?></td>
								<td><?php echo $Tutdugu_Vezife_Cek['Vezifeden_Azad_Olunma_Tarixi'] ?></td>
								<td><?php echo $Tutdugu_Vezife_Cek['Sebeb'] ?></td>
								<td class="emeliyyatlar_iki_buttom">
									<button class="YenileButonlari" id="TutduguVezifeDuzenle_<?php echo $Tutdugu_Vezife_Cek['User_Islediyi_Vezife_Id'] ?>" onclick="TutduguVezifeDuzenle(this.id)" type="button">
										<i class="fas fa-edit"></i>
									</button>		
									<button class="YenileButonlari" id="TutduguVezifeSil_<?php echo $Tutdugu_Vezife_Cek['User_Islediyi_Vezife_Id'] ?>" onclick="TutduguVezifeSil(this.id)" type="button">
										<i class="fas fa-trash"></i>
									</button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>									
			<?php }else{
				echo "error_2007";/* kissa Adı boş ola bilməz*/
				exit;
			}						
			
		}else{
			echo "error_2005";/* kissa Adı boş ola bilməz*/
			exit;
		}





	}else{
		header("Location:../intizam_tebehi_adlari");
		exit;
	}
?>