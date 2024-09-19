<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
	$Bos_Vezife_Id       =  ReqemlerXaricButunKarakterleriSil($_POST['Deyer']); 
	$BosAlinam_Sor=$db->prepare("SELECT * FROM bosvezife where Bos_Vezife_Id=:Bos_Vezife_Id");
	$BosAlinam_Sor->execute(array(
		'Bos_Vezife_Id'=>$Bos_Vezife_Id
	));
	$BosAlinam_Say=$BosAlinam_Sor->rowCount();
	$BosAlinam_Cek=$BosAlinam_Sor->fetch(PDO::FETCH_ASSOC);

	$Vezife_Id=$BosAlinam_Cek['Vezife_Id'];
	$ID=$BosAlinam_Cek['ID'];

	$sil = $db->prepare("DELETE from bosvezife where Bos_Vezife_Id=:Bos_Vezife_Id");
	$kontrol = $sil->execute(array(
		'Bos_Vezife_Id'=>$Bos_Vezife_Id
	));	
	if ($kontrol) {
		$update=$db->prepare("UPDATE vezife SET
			User_Id=:User_Id
			where Vezife_Id=$Vezife_Id
			");
		$yenile=$update->execute(array(
			'User_Id'=>$ID
		));
		if ($yenile) {
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
	
}else{
	header("Location:../intizam_tenbehleri.php");
	exit;
}
?>