<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$deyer =json_decode($_POST['Deyer'],true);
	$ID                                         =  ReqemlerXaricButunKarakterleriSil($deyer['ID']); 
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
	$User_Sor->execute(array(
		'ID'=>$ID,
		'Durum'=>1));
	$User_Say=$User_Sor->rowCount();
	$User_Cek=$User_Sor->fetch(PDO::FETCH_ASSOC);
	$bosvezife_Id=$User_Cek['Vezife_Id'];
	$bos="";
	if ($User_Say==1) {
		$Elave_Et=$db->prepare("INSERT INTO bosvezife SET
			ID=:ID, 
			Vezife_Id=:Vezife_Id
			");
		$Insert=$Elave_Et->execute(array(
			'ID'=>$ID,
			'Vezife_Id'=>$bosvezife_Id						
		));
		if ($Insert) {
			$update=$db->prepare("UPDATE vezife SET
				User_Id=:User_Id
				where User_Id=$ID
				");
			$yenile=$update->execute(array(
				'User_Id'=>$bos
			));
			if ($Insert) {
				
				$Bos_Vezife_Sor=$db->prepare("SELECT * FROM bosvezife  ");
				$Bos_Vezife_Sor->execute(array(
					'Durum'=>0));
				$Bos_Vezife_Say=$Bos_Vezife_Sor->rowCount();
				if ($Bos_Vezife_Say==0) {	?>
					<button class="YenileButonlari" onclick="VezifeBosalt()" type="button">Vəzifəni boşalt</button>
					<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>		
				<?php }else{?>
					<button class="QirmiziButonlar" onclick="BosaAlinmisiVezifeyeTeyin()" type="button">Boşa alınmış əməkdaşlar</button>
					<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>		
				<?php	}
				

				
			}else{
				$Bos_Vezife_Sor=$db->prepare("SELECT * FROM bosvezife  ");
				$Bos_Vezife_Sor->execute(array(
					'Durum'=>0));
				$Bos_Vezife_Say=$Bos_Vezife_Sor->rowCount();
				if ($Bos_Vezife_Say==0) {	?>
					<button class="YenileButonlari" onclick="VezifeBosalt()" type="button">Vəzifəni boşalt</button>
					<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>		
				<?php }else{?>
					<button class="QirmiziButonlar" onclick="BosaAlinmisiVezifeyeTeyin()" type="button">Boşa alınmış əməkdaşlar</button>
					<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>		
				<?php	}
			}
		}else{
			$Bos_Vezife_Sor=$db->prepare("SELECT * FROM bosvezife  ");
			$Bos_Vezife_Sor->execute(array(
				'Durum'=>0));
			$Bos_Vezife_Say=$Bos_Vezife_Sor->rowCount();
			if ($Bos_Vezife_Say==0) {	?>
				<button class="YenileButonlari" onclick="VezifeBosalt()" type="button">Vəzifəni boşalt</button>
				<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>		
			<?php }else{?>
				<button class="QirmiziButonlar" onclick="BosaAlinmisiVezifeyeTeyin()" type="button">Boşa alınmış əməkdaşlar</button>
				<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>		
			<?php	}
		}
	}
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>