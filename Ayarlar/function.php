<?php
date_default_timezone_set('Asia/Baku');
$ZamanDamgasi                    =   time();
$TarixSaat                       =   date("d.m.Y H:i:s", $ZamanDamgasi);
$TekTarix                        =   date("d.m.Y", $ZamanDamgasi);
$Tarix_Beynelxalq                =   date("Y-m-d", $ZamanDamgasi);
$Saat_Beynelxalq                 =   date("H:i:s", $ZamanDamgasi);
$Il_tap                          =   date("Y");
$Ay_tap                          =   date("m");
$hefdeningunu                    =   date('w');
if ($hefdeningunu     == 0) {
	$hefedgun = "Bazar";
} elseif ($hefdeningunu == 1) {
	$hefedgun = "Bazar ertəsi";
} elseif ($hefdeningunu == 2) {
	$hefedgun = "Çərşənbə axşamı";
} elseif ($hefdeningunu == 3) {
	$hefedgun = "Çərşənbə";
} elseif ($hefdeningunu == 4) {
	$hefedgun = "Cümə axşamı ";
} elseif ($hefdeningunu == 5) {
	$hefedgun = "Cümə ";
} else {
	$hefedgun = "Şənbə ";
}



$SaniyeHesaplamaBirSaniye       =   1;
$SaniyeHesaplamaBirDakika       =   60;
$SaniyeHesaplamaBirSaat         =   3600;
$SaniyeHesaplamaBirGun          =   86400;
$SaniyeHesaplamaBirAy           =   2592000;
$SaniyeHesaplamaBirYil          =   31536000;



if (isset($_SERVER["REMOTE_ADDR"])) {
	$IPAdresi					=	$_SERVER["REMOTE_ADDR"];
} else {
	$IPAdresi					=	"";
}

function AdiSoyadiAtaadi($Deyer, $db){
	$user_sor = $db->prepare("SELECT * FROM user where ID=:ID");
	$user_sor->execute(array(
		'ID' => $Deyer
	));
	$user_cek = $user_sor->fetch(PDO::FETCH_ASSOC);
	if ($user_cek['Cinsiyeti'] == 0) {
		$oglugizi = "oğlu";
	} else {
		$oglugizi = "qızı";
	}
	return $user_cek['Soy_Adi'] . " " . $user_cek['Adi'] . " " . $user_cek['Ata_Adi'] . " " . $oglugizi;
}

function RutbeAdi($Deyer, $db){
	$sor = $db->prepare("SELECT * FROM rutbe_emri where ID=:ID order by Rutbe_Emri_Tarixi DESC");
	$sor->execute(array(
		'ID' => $Deyer
	));
	$cek = $sor->fetch(PDO::FETCH_ASSOC);
	return $cek['Rutbe_Adi'];
}


function AdiSoyadi($Deyer, $db)
{
	$user_sor = $db->prepare("SELECT * FROM user where ID=:ID");
	$user_sor->execute(array(
		'ID' => $Deyer
	));
	$user_cek = $user_sor->fetch(PDO::FETCH_ASSOC);
	if ($user_cek['Cinsiyeti'] == 0) {
		$oglugizi = "oğlu";
	} else {
		$oglugizi = "qızı";
	}
	return $user_cek['Soy_Adi'] . " " . $user_cek['Adi'];
}

function IdareQissaAdi($Deyer, $db)
{
	$Sor = $db->prepare("SELECT * FROM idare  where Idare_Id=:Idare_Id");
	$Sor->execute(array(
		'Idare_Id' => $Deyer
	));
	$Say = $Sor->rowCount();
	if ($Say == 1) {
		$Idare = $Sor->fetch(PDO::FETCH_ASSOC);
		$Idare_Kissa_Adi = $Idare['Idare_Kissa_Adi'];
	} else {
		$Idare_Kissa_Adi = "";
	}
	return 	$Idare_Kissa_Adi;
}

function SobeAdi($Deyer, $db)
{
	$Sor = $db->prepare("SELECT * FROM sobe  where Sobe_Id=:Sobe_Id");
	$Sor->execute(array(
		'Sobe_Id' => $Deyer
	));
	$Say = $Sor->rowCount();
	if ($Say == 1) {
		$Cek = $Sor->fetch(PDO::FETCH_ASSOC);
		$Sobe_Ad = $Cek['Sobe_Ad'];
	} else {
		$Sobe_Ad = "";
	}
	return 	$Sobe_Ad;
}

function VezifeAdi($Deyer, $db)
{
	$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Vezife_Id=:Vezife_Id ");
	$Vezife_Sor->execute(array(
		'Vezife_Id'=>$Deyer));
	$Say = $Vezife_Sor->rowCount();
	if ($Say == 1) {
		$Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC);
		$Vezife_Adlari_Ad = $Cek['Vezife_Adlari_Ad'];
	} else {
		$Vezife_Adlari_Ad = "";
	}
	return 	$Vezife_Adlari_Ad;
}


function Tarix_Beynelxalqi_Az_Cevir($Deyer)
{
	if (strlen($Deyer) == 10) {
		$il = $Deyer[0] . $Deyer[1] . $Deyer[2] . $Deyer[3];
		$ay = $Deyer[5] . $Deyer[6];
		$gun = $Deyer[8] . $Deyer[9];
		$Tarixi = $gun . "." . $ay . "." . $il;
		return  $Tarixi;
	}
}


function DuzenleButonu($deyer)
{
	echo '<button class="YenileButonlari" id="Duzeli_' . $deyer . '" onclick="Duzeli(this.id)" type="button">
	<i class="fas fa-edit"></i>
	</button>	';
}

function SilButonu($deyer)
{
	echo '<button class="YenileButonlari" id="Sil_' . $deyer . '" onclick="Sil(this.id)" type="button">
	<i class="fas fa-trash"></i>
	</button>	';
}

function TarixAzCevir($Deyer)
{
	if (strlen($Deyer) == 10) {
		$Bir =	strtotime($Deyer);
		$Tarixi = date("d.m.Y", $Bir);
		return  $Tarixi;
	}
}


function TarixBeynelxalqCevir($Deyer)
{
	if (strlen($Deyer) == 10) {
		$gun = $Deyer[0] . $Deyer[1];
		$ay = $Deyer[3] . $Deyer[4];
		$il = $Deyer[6] . $Deyer[7] . $Deyer[8] . $Deyer[9];
		$Tarixi = $il . "-" . $ay . "-" . $gun;
		return  $Tarixi;
	}
}

function TarixUnikCevir($Deyer)
{
	if (strlen($Deyer) == 10) {
		$gun = $Deyer[0] . $Deyer[1];
		$ay = $Deyer[3] . $Deyer[4];
		$il = $Deyer[6] . $Deyer[7] . $Deyer[8] . $Deyer[9];
		$TarixiBeynel = $il . "-" . $ay . "-" . $gun;
		$Tarixi = strtotime($TarixiBeynel);
		return  $Tarixi;
	}
}

function TraixUzerineIlGelAzCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . " year");
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("d.m.Y", $Uc);
	return  $Tarixi;
}

function TraixUzerineIlGelBeynelCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . "  year");
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("Y-m-d", $Uc);
	return  $Tarixi;
}


function TraixUzerineIlGelUnixCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . "  year");
	$Tarixi = date_timestamp_get($Iki);
	return  $Tarixi;
}


function TraixUzerineGunGelAzCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . " day");
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("d.m.Y", $Uc);
	return  $Tarixi;
}

function TraixUzerineGunGelBeynelCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . " day");
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("Y-m-d", $Uc);
	return  $Tarixi;
}


function TraixUzerineGunGelUnixCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . " day");
	$Tarixi = date_timestamp_get($Iki);
	return  $Tarixi;
}


function TraixUzerineAyGelAzCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . " month");
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("d.m.Y", $Uc);
	return  $Tarixi;
}

function TraixUzerineAyGelBeynelCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . " month");
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("Y-m-d", $Uc);
	return  $Tarixi;
}


function TraixUzerineAyGelUnixCevir($DeyerBir, $DeyerIki)
{
	$gun = $DeyerBir[0] . $DeyerBir[1];
	$ay = $DeyerBir[3] . $DeyerBir[4];
	$il = $DeyerBir[6] . $DeyerBir[7] . $DeyerBir[8] . $DeyerBir[9];
	$Bir = $il . "-" . $ay . "-" . $gun;
	$Iki      = date_create($Bir);
	date_modify($Iki, "+" . $DeyerIki . " month");
	$Tarixi = date_timestamp_get($Iki);
	return  $Tarixi;
}


function Traix_Uzerine_Gel($DeyerBir, $DeyerIki, $DeyerUc)
{
	$Iki      = date_create($DeyerBir);
	date_modify($Iki, "+" . $DeyerIki . " " . $DeyerUc);
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("Y-m-d", $Uc);
	return  $Tarixi;
}

function Traixden_Cix($DeyerBir, $DeyerIki, $DeyerUc)
{
	$Iki      = date_create($DeyerBir);
	date_modify($Iki, "-" . $DeyerIki . " " . $DeyerUc);
	$Uc = date_timestamp_get($Iki);
	$Tarixi    = date("Y-m-d", $Uc);
	return  $Tarixi;
}


function TeqvimQeyriIsGunuYoxla($Deyer, $db)
{
	$Iki = strtotime($Deyer);
	$Dord     = date("w", $Iki);
	$Teqvim_Sor = $db->prepare("SELECT * FROM istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
	$Teqvim_Sor->execute(array(
		'Tarix_Adi_Beynelxalq' => date("Y-m-d", $Iki)
	));
	$Teqvim_Say = $Teqvim_Sor->rowCount();
	if ($Teqvim_Say > 0) {
		$Cek = $Teqvim_Sor->fetch(PDO::FETCH_ASSOC);
		$Sebeb = $Cek['Sebeb'];
		if ($Sebeb == 1 or $Sebeb == 2 or $Sebeb == 4 or $Sebeb == 5) {
			$cavab = 0;
			return $cavab;
		} elseif ($Sebeb == 3) {
			$cavab = 1;
			return $cavab;
		}
	} else {
		if ($Dord == 0 or ($Dord == 6)) {
			$cavab = 0;
			return $cavab;
		} else {
			$cavab = 1;
			return $cavab;
		}
	}
}


function IscixisiHesabla($Deyer, $db)
{
	$Bir = strtotime($Deyer);
	$Cixis    = date("Y-m-d", $Bir);
	$hefteningunu     = date("w", $Bir);
	$Teqvim_Sor = $db->prepare("SELECT * FROM istehsalt_teqvimi where Tarix_Adi_Beynelxalq=:Tarix_Adi_Beynelxalq");
	$Teqvim_Sor->execute(array(
		'Tarix_Adi_Beynelxalq' => $Cixis
	));
	$Teqvim_Say = $Teqvim_Sor->rowCount();
	if ($Teqvim_Say > 0) {
		$Vezife_Cek = $Teqvim_Sor->fetch(PDO::FETCH_ASSOC);
		$Sebeb = $Vezife_Cek['Sebeb'];
		if ($Sebeb == 1) {
			$Bir = Traix_Uzerine_Gel($Cixis, 1, "day");
			return IscixisiHesabla($Bir, $db);
		} elseif ($Sebeb == 2) {
			$Bir = Traix_Uzerine_Gel($Cixis, 1, "day");
			return IscixisiHesabla($Bir, $db);
		} elseif ($Sebeb == 3) {
			return  $Cixis;
		} elseif ($Sebeb == 4) {
			$Bir = Traix_Uzerine_Gel($Cixis, 1, "day");
			return IscixisiHesabla($Bir, $db);
		} elseif ($Sebeb == 5) {
			$Bir = Traix_Uzerine_Gel($Cixis, 1, "day");
			return IscixisiHesabla($Bir, $db);
		}
	} else {
		if ($hefteningunu == 0 or ($hefteningunu == 6)) {
			$Bir = Traix_Uzerine_Gel($Cixis, 1, "day");
			return IscixisiHesabla($Bir, $db);
		} else {
			return  $Cixis;
		}
	}
}

function SexsiIsNomresi($Deyer,$db){
	$SiraNo=0;				
	$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC");
	$Idare_Sor->execute(array(
		'Durum'=>1));	
	while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
		$Idare_Id= $Idare_Cek['Idare_Id'];
		$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
		$Sobe_Sor->execute(array(
			'Idare_Id'=>$Idare_Id,
			'Durum'=>1));								
		while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {	
			$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and Stat_Muqavile=:Stat_Muqavile  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
			$Vezife_Sor->execute(array(
				'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
				'Vezife_Adlari_Durum'=>1,
				'Stat_Muqavile'=>0
			));									
			while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
				$SiraNo++;	
				if ($Vezife_Cek['User_Id']==$Deyer) {
					$deyer=$SiraNo;
					break 2;
				}									
			}
		} 
	}

		$Idare_Sor=$db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC");
	$Idare_Sor->execute(array(
		'Durum'=>1));
	
	while ($Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
		$Idare_Id= $Idare_Cek['Idare_Id'];
		$Sobe_Sor=$db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
		$Sobe_Sor->execute(array(
			'Idare_Id'=>$Idare_Id,
			'Durum'=>1));								
		while ($Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {	
			$Vezife_Sor=$db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and Stat_Muqavile=:Stat_Muqavile  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
			$Vezife_Sor->execute(array(
				'Sobe_Id'=>$Sobe_Cek['Sobe_Id'],										
				'Vezife_Adlari_Durum'=>1,
				'Stat_Muqavile'=>1
			));									
			while ($Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
				$SiraNo++;	
				if ($Vezife_Cek['User_Id']==$Deyer) {
					$deyer=$SiraNo;
					break 2;
				}									
			}
		} 

		
	}


	return $deyer;
}





/*Bütün boşluqları silirəm*/
function ButunBosluklariSil($Deyer)
{
	$Filtrele       =   preg_replace("/\s/", "", $Deyer);
	$Sonuc          =   $Filtrele;
	return $Sonuc;
}


/*Birdən Artıq olan bütün boşluqları silirəm*/
function BirdenArtiqButunBosluqlariSil($Deyer)
{
	$Filtrele		=	preg_replace("/\s+/", " ", $Deyer);
	$Sonuc			=	$Filtrele;
	return $Sonuc;
}

/*Hərf və rəqəmlər xaric bütün karakterləri silirəm*/
function HerfVeReqemlerXaricButunKarakterleriSil($Deyer)
{
	$Filtrele		=	preg_replace("/[^a-zA-Z0-9çÇğĞıİöÖşŞüÜƏə]/", "", $Deyer);
	$Sonuc			=	$Filtrele;
	return $Sonuc;
}


function HerfVeReqemlerVebeziKarakterlerXaricButunKarakterleriSil($Deyer)
{
	$Bir		  =	trim($Deyer);
	$Filtrele		=	preg_replace("/[^a-zA-Z0-9ÇçĞğİıÖöŞşÜüƏə.\/\-()\s+]/", "", $Bir);
	$Sonuc			=	$Filtrele;
	return $Sonuc;
}

/*Təhlükəsizlik üçün istifadəçi adı və şifrəsini təmizləyib filtirdən keçirirəm*/
function IstifadeciAdiVeSifresiIcerikleriniFiltrle($Deyer)
{
	$Bir        =   preg_replace("/\s/", "", $Deyer);
	$Iki        =   preg_replace("/[^a-zA-Z0-9çÇğĞIıİiöÖşŞüÜƏə\-\@\.]/", "", $Bir);
	$Uc         =   strip_tags($Iki);
	$Dort       =   htmlspecialchars($Uc, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc      =   $Dort;
	return $Sonuc;
}


function SEO_URL($Deyer)
{
	$Filtrele           =   preg_replace("/[^0-9a-zA-Z$.]/", "", $Deyer);
	$Sonuc              =   $Filtrele;
	return $Sonuc;
}


/*Həriflər xaric bütün karakterləri silirəm*/
function HarflerXaricButunKarakterleriSil($Deyer)
{
	$Filtrele           =   preg_replace("/[^a-zA-ZçÇğĞıİöÖşŞüÜƏə]/", "", $Deyer);
	$Sonuc              =   $Filtrele;
	return $Sonuc;
}


/*Həriflər Ve Boşluqlar xaric bütün karakterləri silirəm*/
function HarflerVeBoluqlarXaricButunKarakterleriSil($Deyer)
{
	$Bir		  =	trim($Deyer);
	$Filtrele           =   preg_replace("/[^a-zA-ZÇçĞğİıÖöŞşÜüƏə\s+]/", "", $Bir);
	$Sonuc              =   $Filtrele;
	return $Sonuc;
}

/*Təhlükəsizlik üçün hərfləri fitrden keçirirəm*/
function HerfliIcerikleriFitrle($Deyer)
{
	$Bir		  =	trim($Deyer);
	$Iki		  =	strip_tags($Bir);
	$Uc       = preg_replace("/[^a-zA-ZçÇğĞıİöÖşŞüÜƏə]/", "", $Iki);
	$Dort		  =	htmlspecialchars($Uc, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc		=	$Dort;
	return $Sonuc;
}




/*Rəqəmlər xaric bütün karakterləri silirəm*/
function ReqemlerXaricButunKarakterleriSil($Deyer)
{
	$Filtrele   =   preg_replace("/[^0-9]/", "", $Deyer);
	$Sonuc      =   $Filtrele;
	return $Sonuc;
}

/*Rəqəmlər və nöktə ve vergul xaric bütün karakterləri silirəm*/
function ReqemlernokteVergulXaricButunKarakterleriSil($Deyer)
{
	$Filtrele   =   preg_replace("/[^0-9\.\,]/", "", $Deyer);
	$Sonuc      =   $Filtrele;
	return $Sonuc;
}
/*Rəqəmlər və nöktə bütün karakterləri silirəm*/
function ReqemlerNokteXaricButunKarakterleriSil($Deyer)
{
	$Filtrele   =   preg_replace("/[^0-9\.]/", "", $Deyer);
	$Sonuc      =   $Filtrele;
	return $Sonuc;
}

/*Rəqəmlər və nöktə ve vergul xaric bütün karakterləri silirəm*/
function ReqemlerCutNokteXaricButunKarakterleriSil($Deyer)
{
	$Filtrele   =   preg_replace("/[^0-9:]/", "", $Deyer);
	$Sonuc      =   $Filtrele;
	return $Sonuc;
}

/*Təhlükəsizlik üçün rəqəmli icerikleri fitrden keçirirəm*/
function ReqemliIcerikleriFitrle($Deyer)
{
	$Bir    =   preg_replace("/\s/", "", $Deyer);
	$Iki		=	  strip_tags($Bir);
	$Uc     =   preg_replace("/[^0-9]/", "", $Iki);
	$Dort		=	  htmlspecialchars($Uc, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc	=	$Dort;
	return $Sonuc;
}



/*Email karakterləri xaric bütün karakterləri silirəm*/
function EmailKarakerleriXaricButunKarakterleriSil($Deyer)
{
	$Filtrele		=	preg_replace("/[^a-zA-Z0-9_\-\.@]/", "", $Deyer);
	$Sonuc			=	$Filtrele;
	return $Sonuc;
}


/*Təhlükəsizlik üçün email alanlarını fitrləyirəm*/
function EmailIcerikleriniFitrle($Deyer)
{
	$Bir                      =   preg_replace("/\s/", "", $Deyer);
	$DeyiseceklerAzdan	      =	array("Ç", "ç", "Ğ", "ğ", "İ", "ı", "Ö", "ö", "Ş", "ş", "Ü", "ü", "Ə", "ə");
	$DeyisdirilenlerIngilise	=	array("C", "c", "G", "g", "I", "i", "O", "o", "S", "s", "U", "u", "E", "e");
	$Iki			                =	str_replace($DeyiseceklerAzdan, $DeyisdirilenlerIngilise, $Bir);
	$Uc		                    =	strip_tags($Iki);
	$Dort			                =	preg_replace("/[^a-z0-9_\-\.@]/", "", $Uc);
	$Bes		                  =	htmlspecialchars($Dort, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc		                =	$Bes;
	return $Sonuc;
}

/*Təhlükəsizlik üçün hərf ve reqem icriklerini fitrden kecirirem*/
function HerfVeReqemIcerikleriniFitrle($Deyer)
{
	$Bir		=	trim($Deyer);
	$Iki		=	strip_tags($Bir);
	$Uc		=	htmlspecialchars($Iki, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc	=	$Uc;
	return $Sonuc;
}


/*Link karakterləri xaric bütün karakterləri silirəm*/
function LinkKarakterleriXaricButunKarakterleriSil($Deyer)
{
	$Filtrele		=	preg_replace("/[^a-z0-9\.\:\+\-\_\#\?\&\/\=\%\~\@]/", "", $Deyer);
	$Sonuc			=	$Filtrele;
	return $Sonuc;
}



/*Təhlükəsizlik likleri fitrden kecirirem*/
function LikliIcerikleriFiltrle($Deyer)
{
	$Bir                      =   preg_replace("/\s/", "", $Deyer);
	$DeyiseceklerAzdan	      =	array("Ç", "ç", "Ğ", "ğ", "İ", "ı", "Ö", "ö", "Ş", "ş", "Ü", "ü", "Ə", "ə");
	$DeyisdirilenlerIngilise	=	array("C", "c", "G", "g", "I", "i", "O", "o", "S", "s", "U", "u", "E", "e");
	$Iki			                =	str_replace($DeyiseceklerAzdan, $DeyisdirilenlerIngilise, $Bir);
	$Deyisecekler	            =	array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z", "Q", "W", "X", "Ə");
	$Deyisdirilenler		      =	array("a", "b", "c", "c", "d", "e", "f", "g", "g", "h", "i", "i", "j", "k", "l", "m", "n", "o", "o", "p", "r", "s", "s", "t", "u", "u", "v", "y", "z", "q", "w", "x", "e");
	$Uc			                  =	str_replace($Deyisecekler, $Deyisdirilenler, $Iki);
	$Dort		                  =	strip_tags($Uc);
	$Bes			                =	preg_replace("/[^a-z0-9\.\:\+\-\_\#\?\&\/\=\%\~\@]/", "", $Dort);
	$Alti		                  =	htmlspecialchars($Bes, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc		=	$Alti;
	return $Sonuc;
}



/*Bütün boşluqları tire ilə dəyişdirirəm*/
function ButunBosluqlariTireIleDeyisdir($Deyer)
{
	$Filtrele		=	preg_replace("/\s/", "-", $Deyer);
	$Sonuc			=	$Filtrele;
	return $Sonuc;
}







/*Böyük hərfləri kiçik hərflə dəyişdirirəm*/
function BoyukHerfleriKicikHerfleDeyisdir($Deyer)
{
	$Deyisecekler      	=	array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z", "Q", "W", "X", "Ə", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$Deyisdirilenler		=	array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı", "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t", "u", "ü", "v", "y", "z", "q", "w", "x", "ə", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$Sonuc			        =	str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*Kiçik hərfləri böyük hərflə dəyişdirirəm*/
function KicikHerfleriBoyukHerflerleDeyisidir($Deyer)
{
	$Deyisecekler     	=	array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı", "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t", "u", "ü", "v", "y", "z", "q", "w", "x", "ə", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$Deyisdirilenler		=	array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z", "Q", "W", "X", "Ə", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$Sonuc		        	=	str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}


/*İngilis dilinə görə böyük hərfləri kiçik hərflərlə dəyişdirirəm*/
function IngilisDilineGoreBoyukHerfleriKicikHerflerleDeyisdir($Deyer)
{
	$Deyisecekler     	=	array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z", "Q", "W", "X", "Ə");
	$Deyisdirilenler		=	array("a", "b", "c", "c", "d", "e", "f", "g", "g", "h", "i", "i", "j", "k", "l", "m", "n", "o", "o", "p", "r", "s", "s", "t", "u", "u", "v", "y", "z", "q", "w", "x", "e");
	$Sonuc		        	=	str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}




/*İngilis dilinə görə kiçik hərfləri böyük hərflərlədəyişdirirəm*/
function IngilisDilineGoreKicikHerfleriBoyukHerflerleDeyisdir($Deyer)
{
	$Deyisecekler     	=	array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı", "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t", "u", "ü", "v", "y", "z", "q", "w", "x", "ə");
	$Deyisdirilenler		=	array("A", "B", "C", "C", "D", "E", "F", "G", "G", "H", "I", "I", "J", "K", "L", "M", "N", "O", "O", "P", "R", "S", "S", "T", "U", "U", "V", "Y", "Z", "Q", "W", "X", "E");
	$Sonuc		        	=	str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*Azərbaycan hərflərini ingilis hərfləri ilə dəyişdirirəm*/
function AzerbaycancaHerfleriIngilisHerfleriIleDeyisdir($Deyer)
{
	$Deyisecekler	    =	array("Ç", "ç", "Ğ", "ğ", "İ", "ı", "Ö", "ö", "Ş", "ş", "Ü", "ü", "Ə", "ə");
	$Deyisdirilenler	=	array("C", "c", "G", "g", "I", "i", "O", "o", "S", "s", "U", "u", "E", "e");
	$Sonuc		      	=	str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*Ampersatları aktiv edirəm ampersat ingilis dilindeki və işarəsidir yəni bu işarə &*/
function AmpersatlariAktivEt($Deyer)
{
	$Deyisecekler     =   array("&amp;");
	$Deyisdirilenler  =   array("&");
	$Sonuc            =   str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}


/*Cüt dırnaq işarələrini aktiv edirəm*/
function CutDirnaqlariAktivEt($Deyer)
{
	$Deyisecekler       =   array("&quot;");
	$Deyisdirilenler    =   array("\"");
	$Sonuc              =   str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*Tək dırnak işarələrini aktiv edirem*/
function TekDirnaklariAktivEt($Deyer)
{
	$Deyisecekler       =   array("&#039;", "&#39;");
	$Deyisdirilenler    =   array("'", "'");
	$Sonuc              =   str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*Kicikdir işarələrini aktiv edirem*/
function KicikdirIsareleriniAktivEt($Deyer)
{
	$Deyisecekler     =   array("&lt;");
	$Deyisdirilenler  =   array("<");
	$Sonuc            =   str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*Böyükdür işarələrini aktiv edirem*/
function BoyukdurIsareleriniKativEt($Deyer)
{
	$Deyisecekler    =   array("&gt;");
	$Deyisdirilenler =   array(">");
	$Sonuc           =   str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*R-ləri və N-ləri bö.luqlarla dəyişirəm*/
function RleriVeNleriBosluqEt($Deyer)
{
	$Deyisecekler	   =	array("\r", "\n");
	$Deyisdirilenler =	array(" ", " ");
	$Sonuc		       =	str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}


/*R-ləri və N-ləri silirəm*/
function RleriVeNleriSil($Deyer)
{
	$Deyisecekler	    =	array("\r", "\n");
	$Deyisdirilenler	=	array("", "");
	$Sonuc			      =	str_replace($Deyisecekler, $Deyisdirilenler, $Deyer);
	return $Sonuc;
}



/*Telefonlu nömrələrini filtirləyirəm*/
function TelefonluIcerikleriFitrle($Deyer)
{
	$Bir    =   preg_replace("/\s/", "", $Deyer);
	$Iki		=	  strip_tags($Bir);
	$Uc			=	  htmlspecialchars($Iki, ENT_QUOTES, "ISO-8859-1", true);
	$Dort   =   preg_replace("/[^0-9]/", "", $Uc);
	$Bes		=	  substr($Dort, -10);
	$Sonuc	=	  $Bes;
	return $Sonuc;
}


/*Təhlükəsizlik üçün beynəlxalq kod icerikləri fitrlənir və standart formaya salınır*/
function BeynelxaalqKodIcerikleriniFiltrle($Deyer)
{
	$Bir                      = preg_replace("/\s/", "", $Deyer);
	$DeyiseceklerAzdan	      =	array("Ç", "ç", "Ğ", "ğ", "İ", "ı", "Ö", "ö", "Ş", "ş", "Ü", "ü", "Ə", "ə");
	$DeyisdirilenlerIngilise	=	array("C", "c", "G", "g", "I", "i", "O", "o", "S", "s", "U", "u", "E", "e");
	$Iki			                =	str_replace($DeyiseceklerAzdan, $DeyisdirilenlerIngilise, $Bir);
	$Deyisecekler	            =	array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı", "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t", "u", "ü", "v", "y", "z", "q", "w", "x", "ə");
	$Deyisdirilenler	      	=	array("A", "B", "C", "C", "D", "E", "F", "G", "G", "H", "I", "I", "J", "K", "L", "M", "N", "O", "O", "P", "R", "S", "S", "T", "U", "U", "V", "Y", "Z", "Q", "W", "X", "E");
	$Uc		                  	=	str_replace($Deyisecekler, $Deyisdirilenler, $Iki);
	$Dort	                  	=	strip_tags($Uc);
	$Bes                      = preg_replace("/[^a-zA-ZçÇğĞıİöÖşŞüÜƏə]/", "", $Dort);
	$Alti	                  	=	htmlspecialchars($Bes, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc		=	$Alti;
	return $Sonuc;
}



/*Editorlu icəriklər filtirdən keçrilir*/
function EditorluIcerikleriFiltrle($Deyer)
{
	$Bir        =   trim($Deyer);
	$Iki        =   htmlspecialchars($Bir, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc      =   $Iki;
	return $Sonuc;
}


/*Fayılı icəriklərni filtirdən keçrilir*/
function FayilIcerikleriniFiltrele($Deyer)
{
	$Bir		=	trim($Deyer);
	$Iki		=	htmlspecialchars($Bir, ENT_QUOTES, "ISO-8859-1", true);
	$Sonuc	=	$Iki;
	return $Sonuc;
}


/*Link doğrluluğunu yoxlayır*/
function LinkDogrulugunuYoxla($Deyer)
{
	$AlanAdiKontrolYapisi		=	"/^(http(s)?:\/\/.)?(www\.)?[a-zA-Z0-9\.\:\+\-\_\#\=\%\~\@]{2,256}\.[a-z]{2,6}\b([a-zA-Z0-9\.\:\+\-\_\#\?\&\/\=\%\~\@]*)+$/";
	if (preg_match($AlanAdiKontrolYapisi, $Deyer)) {
		$Sonuc	=	1;
	} else {
		$Sonuc	=	0;
	}
	return $Sonuc;
}


/*Link ön ek məcburi yoxlayır*/
function LinkDogrulugunuOnEkMecburiYoxla($Deyer)
{
	$AlanAdiKontrolYapisi		=	"/^(http(s)?:\/\/.)+(www\.)?[a-zA-Z0-9\.\:\+\-\_\#\=\%\~\@]{2,256}\.[a-z]{2,6}\b([a-zA-Z0-9\.\:\+\-\_\#\?\&\/\=\%\~\@]*)+$/";
	if (preg_match($AlanAdiKontrolYapisi, $Deyer)) {
		$Sonuc	=	1;
	} else {
		$Sonuc	=	0;
	}
	return $Sonuc;
}




/*Mətin icəriklərindəki Email adreslərini yoxlayır*/
function MetinIceiklerindekiEmailAdresleriniYoxla($Deyer)
{
	$EMailAdresiKontrolYapisi		=	"/\s+(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))\s+/";
	preg_match_all($EMailAdresiKontrolYapisi, $Deyer, $BulununanDeger);
	$TamEslesmeDizisi		=	$BulununanDeger[0];
	$YeniDiziOlustur		=	array();
	foreach ($TamEslesmeDizisi as $Icerik) {
		$IcerikBicimlendir		=	trim($Icerik);
		if (filter_var($IcerikBicimlendir, FILTER_VALIDATE_EMAIL)) {
			$YeniDiziOlustur[] 	=	$IcerikBicimlendir;
		}
	}
	$Sonuc		=	array_unique($YeniDiziOlustur);
	return $Sonuc;
}



/*Bənzərsiz şəkil adı yaradır*/
function BenzersizSekilAdiYarad()
{
	$Sonuc      =   md5(uniqid(time()));
	return $Sonuc;
}


/*Haş kodu yaradır*/
function HashKoduYarad()
{
	$Bir		=	rand(10000, 99999);
	$Iki		=	rand(10000, 99999);
	$Uc			=	rand(10000, 99999);
	$Dort		=	rand(10000, 99999);
	$Sonuc	=	$Bir . "-" . $Iki . "-" . $Uc . "-" . $Dort;
	return $Sonuc;
}





function uzantiBul($isim)
{
	$dizi   = explode('.', $isim);
	$eleman = count($dizi) - 1;
	$uzanti = $dizi["$eleman"];
	return $uzanti;
	// return $uzanti; 
}


function islemkontrol()
{
	if (empty($_SESSION['userkullanici_mail'])) {
		Header("Location:404.php");
		exit;
	}
}


function email_tesdik_kodu()
{
	$benzersizsayi1 = rand(20000, 32000);
	$benzersizsayi2 = rand(20000, 32000);
	$benzersizsayi3 = rand(20000, 32000);
	$benzersizsayi4 = rand(20000, 32000);
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
	$user_sifreyenilekod = substr($benzersizad, 14);
	return $user_sifreyenilekod;
}


function Telefon_Tesdiq_Kodu()
{
	$benzersizsayi1 = rand(20000, 32000);
	$benzersizsayi2 = rand(20000, 32000);
	$benzersizsayi3 = rand(20000, 32000);
	$benzersizsayi4 = rand(20000, 32000);
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
	$user_sifreyenilekod = substr($benzersizad, 14);
	return $user_sifreyenilekod;
}

function elan_pin_kode()
{
	$benzersizsayi1 = rand(20000, 32000);
	$benzersizsayi2 = rand(20000, 32000);
	$benzersizsayi3 = rand(20000, 32000);
	$benzersizsayi4 = rand(20000, 32000);
	$benzersizad    = $benzersizsayi1 . $benzersizsayi2 . $benzersizsayi3 . $benzersizsayi4;
	$user_sifreyenilekod = substr($benzersizad, 14);
	return $user_sifreyenilekod;
}




function benzersiz_seo_link()
{
	$Sonuc      =  md5(uniqid(time()));
	return $Sonuc;
}

function Id_Kodla($deyer)
{
	$md5_sifrele   = md5($deyer);
	$has_sifrele   = password_hash($md5_sifrele, PASSWORD_DEFAULT);
	$id_kodlanmisi = $has_sifrele;
	return $id_kodlanmisi;
}

function Benzersiz_Seo_Url($deyer)
{
	$Sonuc         =  md5(uniqid(time()));
	$md5_sifrele   =  md5($deyer);
	$Kodlanacaq = $md5_sifrele . $Sonuc;
	$Seo_Link      =  password_hash($Kodlanacaq, PASSWORD_DEFAULT);
	return $Seo_Link;
}


function HerSozunIlkHerfiniBoyukEt($Deyer)
{
	$Parcala		  =	explode(" ", $Deyer);
	$KelimeSayisi	=	count($Parcala);
	$Sayi		    	=	1;
	$Duzenle	  	=	"";
	$Sonuc			  =	"";
	foreach ($Parcala as $Kelime) {
		$BoslukSil								              =	trim($Kelime);
		$IlkHarfiAl								              =	substr($BoslukSil, 0, 1);
		$DeyiseceklerKicikleri     	=	array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı", "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t", "u", "ü", "v", "y", "z", "q", "w", "x", "ə");
		$DeyisdirilenlerBoyuklere		=	array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z", "Q", "W", "X", "Ə");
		$IlkHarfiBuyukHarfeCevir		        	=	str_replace($DeyiseceklerKicikleri, $DeyisdirilenlerBoyuklere, $IlkHarfiAl);
		$IlkHarfHaricDigerleriniBul				      =	substr($BoslukSil, 1);
		$Deyisecekler      	=	array("A", "B", "C", "Ç", "D", "E", "F", "G", "Ğ", "H", "I", "İ", "J", "K", "L", "M", "N", "O", "Ö", "P", "R", "S", "Ş", "T", "U", "Ü", "V", "Y", "Z", "Q", "W", "X", "Ə");
		$Deyisdirilenler		=	array("a", "b", "c", "ç", "d", "e", "f", "g", "ğ", "h", "ı", "i", "j", "k", "l", "m", "n", "o", "ö", "p", "r", "s", "ş", "t", "u", "ü", "v", "y", "z", "q", "w", "x", "ə");
		$IlkHarfHaricDigerleriniKucukHarfeCevir			        =	str_replace($Deyisecekler, $Deyisdirilenler, $IlkHarfHaricDigerleriniBul);
		$Duzenle		.=	$IlkHarfiBuyukHarfeCevir . $IlkHarfHaricDigerleriniKucukHarfeCevir . " ";
		if ($Sayi == $KelimeSayisi) {
			$Deyiseceklers     =   array("&amp;");
			$Deyisdirilenlers  =   array("&");
			$Sonuc            =   str_replace($Deyisecekler, $Deyisdirilenler, $Duzenle);
			return  mb_convert_case(trim($Sonuc), MB_CASE_TITLE, "UTF-8");
		}
		$Sayi++;
	}
}


function DonusumleriGeriDondur($Deyer)
{
	$Deyisecekbir     =   array("&amp;");
	$Deyisdirilenbir  =   array("&");
	$Bir              =   str_replace($Deyisecekbir, $Deyisdirilenbir, $Deyer);

	$Deyisecekiki     =   array("&lt;");
	$Deyisdirileniki  =   array("<");
	$Iki              =   str_replace($Deyisecekiki, $Deyisdirileniki, $Bir);

	$Deyisecekuc      =   array("&gt;");
	$Deyisdirilenuc   =   array(">");
	$Uc               =   str_replace($Deyisecekuc, $Deyisdirilenuc, $Iki);

	$Deyisecekdord    =   array("&#039;", "&#39;");
	$Deyisdirilendord =   array("'", "'");
	$Dort             =   str_replace($Deyisecekdord, $Deyisdirilendord, $Uc);

	$DeyisecekBes     =   array("&quot;");
	$DeyisdirilenBes  =   array("\"");
	$Bes              =   str_replace($DeyisecekBes, $DeyisdirilenBes, $Dort);

	$Sonuc		        =	$Bes;
	return $Sonuc;
}





function UnixCevir($Deyer)
{
	$gun = $Deyer[0] . $Deyer[1];
	$ay = $Deyer[3] . $Deyer[4];
	$il = $Deyer[6] . $Deyer[7] . $Deyer[8] . $Deyer[9];
	$Beynel = $il . "-" . $ay . "-" . $gun;
	$Unix                     = strtotime($Beynel);
	return $Unix;
}
































function seo($str, $options = array())
{
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true
	);
	$options = array_merge($defaults, $options);
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
		'ß' => 'ss',
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
		'ÿ' => 'y',
		// Latin symbols
		'©' => '(c)',
		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G', 'Ə' => 'e',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 'ə' => 'e',
		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',
		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
		'Ž' => 'Z',
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z',
		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
		'Ż' => 'Z',
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',
		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	$str = trim($str, $options['delimiter']);
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}








function yaziyaCevir($a)
{

	function  birlerBul($birlerBasamagi)
	{
		$deger = "";
		switch ($birlerBasamagi) {
			case "0":
			$deger = " sıfır ";
			break;
			case "1":
			$deger = " bir ";
			break;
			case "2":
			$deger = " iki ";
			break;
			case "3":
			$deger = " üç ";
			break;
			case "4":
			$deger = " dörd ";
			break;
			case "5":
			$deger = " beş ";
			break;
			case "6":
			$deger = " altı ";
			break;
			case "7":
			$deger = " yeddi ";
			break;
			case "8":
			$deger = " səkkiz ";
			break;
			case "9":
			$deger = " doqquz ";
			break;
			default:
			return $deger;
		}
		return $deger;
	}

	function onlarBul($onlarBasamagi)
	{
		$deger = "";
		switch ($onlarBasamagi) {
			case "1":
			$deger = " on ";
			break;
			case "2":
			$deger = " iyirmi ";
			break;
			case "3":
			$deger = " otuz ";
			break;
			case "4":
			$deger = " qırx ";
			break;
			case "5":
			$deger = " əlli ";
			break;
			case "6":
			$deger = " atməş ";
			break;
			case "7":
			$deger = " yetmiş ";
			break;
			case "8":
			$deger = " səksən ";
			break;
			case "9":
			$deger = " doxsan ";
			break;
		}
		return $deger;
	}


	$sayi = "";
	$onluk = "";
	$birlik = "";
	$yuzluk = "";
	$minlik = "";
	$onminlik = "";
	$yuzminlik = "";
	$milyon = "";
	$milyar = "";
	$basamaksay = 0;

	$basamaksay = strlen($a);
	if ($basamaksay == 1) {
		$sayi = birlerBul($a);
	}

	if ($basamaksay == 2) {
		$onluk = substr($a, 0, 1);
		$birlik = substr($a, 1, 1);

		$sayi = onlarBul($onluk);

		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}
	if ($basamaksay == 3) {
		$yuzluk = substr($a, 0, 1);
		$onluk = substr($a, 1, 1);
		$birlik = substr($a, 2, 1);

		if ($yuzluk != "1" && $yuzluk != "0")
			$sayi = birlerBul($yuzluk) . "yüz ";
		if ($yuzluk == "1")
			$sayi = "yüz";

		if ($onluk != "0")
			$sayi .= onlarBul($onluk);
		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}
	if ($basamaksay == 4) {
		$minlik = substr($a, 0, 1);
		$yuzluk = substr($a, 1, 1);
		$onluk  = substr($a, 2, 1);
		$birlik = substr($a, 3, 1);

		if ($minlik != "1")
			$sayi = birlerBul($minlik) . "min";
		if ($minlik == "1")
			$sayi = "min";

		if ($yuzluk != "1" && $yuzluk != "0")
			$sayi .= birlerBul($yuzluk) . "yüz";
		else if ($yuzluk == "1")
			$sayi .= "yüz";
		else if ($yuzluk == "0")
			$sayi .= "";

		if ($onluk != "0")
			$sayi .= onlarBul($onluk);
		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}

	if ($basamaksay == 5) {

		$onminlik = substr($a, 0, 1);
		$minlik = substr($a, 1, 1);
		$yuzluk = substr($a, 2, 1);
		$onluk = substr($a, 3, 1);
		$birlik = substr($a, 4, 1);

		if ($onminlik != "0")
			$sayi = onlarBul($onminlik);

		if ($minlik != "0")
			$sayi .= birlerBul($minlik) . "min";
		else $sayi .= "min";


		if ($yuzluk != "1" && $yuzluk != "0")
			$sayi .= birlerBul($yuzluk) . "yüz";
		else if ($yuzluk == "1")
			$sayi .= "yüz";
		else if ($yuzluk == "0")
			$sayi .= "";

		if ($onluk != "0")
			$sayi .= onlarBul($onluk);
		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}

	if ($basamaksay == 6) {

		$yuzminlik = substr($a, 0, 1);
		$onminlik = substr($a, 1, 1);
		$minlik = substr($a, 2, 1);
		$yuzluk = substr($a, 3, 1);
		$onluk = substr($a, 4, 1);
		$birlik = substr($a, 5, 1);

		if ($yuzminlik != "0" && $yuzminlik != "1")
			$sayi = birlerBul($yuzminlik) . "yüz";
		else if ($yuzminlik == "1")
			$sayi = "yüz";
		else $sayi .= "";


		if ($onminlik != "0")
			$sayi .= onlarBul($onminlik);


		if ($minlik != "0")
			$sayi .= birlerBul($minlik) . "min";
		else $sayi .= "min";


		if ($yuzluk != "1" && $yuzluk != "0")
			$sayi .= birlerBul($yuzluk) . "yüz";
		else if ($yuzluk == "1")
			$sayi .= "yüz";
		else if ($yuzluk == "0")
			$sayi .= "";

		if ($onluk != "0")
			$sayi .= onlarBul($onluk);
		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}

	if ($basamaksay == 7) {
		$milyon = substr($a, 0, 1);
		$yuzminlik = substr($a, 1, 1);
		$onminlik = substr($a, 2, 1);
		$minlik = substr($a, 3, 1);
		$yuzluk = substr($a, 4, 1);
		$onluk = substr($a, 5, 1);
		$birlik = substr($a, 6, 1);

		if ($milyon != "0")
			$sayi = birlerBul($milyon) . "milyon";
		else $sayi = "";

		if ($yuzminlik != "0")
			$sayi .= birlerBul($yuzminlik) . "yüz";
		else $sayi .= "";


		if ($onminlik != "0")
			$sayi .= onlarBul($onminlik);


		if ($minlik != "0")
			$sayi .= birlerBul($minlik) . "min";
		else $sayi .= "min";


		if ($yuzluk != "1" && $yuzluk != "0")
			$sayi .= birlerBul($yuzluk) . "yüz";
		else if ($yuzluk == "1")
			$sayi .= "yüz";
		else if ($yuzluk == "0")
			$sayi .= "";

		if ($onluk != "0")
			$sayi .= onlarBul($onluk);
		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}

	if ($basamaksay == 8) {
		$onmilyon = substr($a, 0, 1);
		$milyon = substr($a, 1, 1);
		$yuzminlik = substr($a, 2, 1);
		$onminlik = substr($a, 3, 1);
		$minlik = substr($a, 4, 1);
		$yuzluk = substr($a, 5, 1);
		$onluk = substr($a, 6, 1);
		$birlik = substr($a, 7, 1);

		if ($onmilyon != "0")
			$sayi = onlarBul($onmilyon);


		if ($milyon != "0")
			$sayi .= birlerBul($milyon) . "milyon";
		else $sayi = "";

		if ($yuzminlik != "0")
			$sayi .= birlerBul($yuzminlik) . "yüz";
		else $sayi .= "";


		if ($onminlik != "0")
			$sayi .= onlarBul($onminlik);


		if ($minlik != "0")
			$sayi .= birlerBul($minlik) . "min";
		else $sayi .= "min";


		if ($yuzluk != "1" && $yuzluk != "0")
			$sayi .= birlerBul($yuzluk) . "yüz";
		else if ($yuzluk == "1")
			$sayi .= "yüz";
		else if ($yuzluk == "0")
			$sayi .= "";

		if ($onluk != "0")
			$sayi .= onlarBul($onluk);
		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}

	if ($basamaksay == 9) {
		$yuzmilyon = substr($a, 0, 1);
		$onmilyon = substr($a, 1, 1);
		$milyon = substr($a, 2, 1);
		$yuzminlik = substr($a, 3, 1);
		$onminlik = substr($a, 4, 1);
		$minlik = substr($a, 5, 1);
		$yuzluk = substr($a, 6, 1);
		$onluk = substr($a, 7, 1);
		$birlik = substr($a, 8, 1);

		if ($yuzmilyon != "0" && $yuzmilyon != "1")
			$sayi .= birlerBul($yuzmilyon) . "yüz";
		else if ($yuzmilyon == "1")
			$sayi .= "yüz";
		else $sayi .= "";


		if ($onmilyon != "0")
			$sayi .= onlarBul($onmilyon);


		if ($milyon != "0")
			$sayi .= birlerBul($milyon) . "milyon";
		else $sayi = "";

		if ($yuzminlik != "0")
			$sayi .= birlerBul($yuzminlik) . "yüz";
		else $sayi .= "";


		if ($onminlik != "0")
			$sayi .= onlarBul($onminlik);


		if ($minlik != "0")
			$sayi .= birlerBul($minlik) . "min";
		else $sayi .= "min";


		if ($yuzluk != "1" && $yuzluk != "0")
			$sayi .= birlerBul($yuzluk) . "yüz";
		else if ($yuzluk == "1")
			$sayi .= "yüz";
		else if ($yuzluk == "0")
			$sayi .= "";

		if ($onluk != "0")
			$sayi .= onlarBul($onluk);
		if ($birlik != "0")
			$sayi .= birlerBul($birlik);
	}


	return $sayi;
}
