<?php 
session_start(); ob_start();
if (isset($_SESSION['user'])) {
	require_once 'Ayarlar/baglan.php';
	$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID ");
	$User_Sor->execute(array(
		'ID'=>$_SESSION['user']));
	$say=$User_Sor->rowCount();
	if ($say==1) {
		header("Location:index.php");
		exit;
	}
}
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Free Web tutorials">
	<meta name="keywords" content="HTML, CSS, JavaScript">
	<meta name="author" content="Orxan Mehydiyev">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kadr</title>	
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="disk/css/login.css">
	<script type="text/javascript" src="disk/jquery/jquery36.js"></script>
	<script type="text/javascript" src="disk/jqueryjson/jquery.json-2.3.js"></script>
	<script type="text/javascript" src="disk/umca/umca.js"></script>
	<script type="text/jscript">
		function setImage() {
			var reg = document.getElementById("fotoimg").value;

			if (reg.length > 0) {
				document.getElementById("Image1").src = 'Senedler/Rutbe/' + reg
			} else {
				document.getElementById("Image1").src = 'Senedler/Rutbe/nophoto.png';
			}
			if (document.getElementById("labelUID").innerText == "Kartı taxın!") {
				document.getElementById("Image1").src = 'Senedler/Rutbe/nophoto.png';
			}
			return;
		}

		function OnError(arg) {
			document.getElementById("lblDepName").innerText = '';            
		}

		function onloadPage2() {
			if (utils_CanRequestUmca()) {
				document.getElementById("UmcaActive").value = 1; 
				if (document.getElementById("labelUID")) { 
					ui_UpdateTokenUid();
				} else { 
					ui_UpdateTokenUid2();
				}
			} else {
				document.getElementById("UmcaActive").value = 0;
        onloadPage(); //nkiscript.js
      }
    }


  </script>
</head>
<body onload="onloadPage2(); setImage();">
	<div id="yuklemealanikapsayici" class="yuklemealanikapsayici" style="display: none;">
 <div class="yuklemekapsayici">
  <div class="YuklenmemetniKapsayicisi">
   <div class="sk-chase">
     <div class="sk-chase-dot"></div>
     <div class="sk-chase-dot"></div>
     <div class="sk-chase-dot"></div>
     <div class="sk-chase-dot"></div>
     <div class="sk-chase-dot"></div>
     <div class="sk-chase-dot"></div>
   </div>
 </div>
</div>
</div>
	<div class="gerb">
		<img class="gerbimg" src="disk/img/Gerb.png">
	</div>
	<div class="naxdgk">
	
	</div>
	<div class="login">
		<form action="Islem/Login_Islemleri.php" method="POST" id="giris">
			<div class="loginbaslik"></div>
			<div  id="gomrukorqani" id="Label2"></div>
			<div class="sekilvelogin">
				<div class="userfoto">
					<img id="Image1" src="#" style="border-color:#2A3F54;border-width:1px;border-style:Solid;height:148px;width:120px;" />
				</div>
				<div class="loginici">
					<span id="lblDepName" class="h3"></span>
					<div class="imzasahibi" id="Label5">İmza sahibi</div>
					<div class="imzasahibiadi">
						<div id="labelUID"></div>
						<div id="yenilealani"> 
							<img id="yenilebtonu" src="disk/img/yenile.png" id="Img3" 
							onclick="utils_CanRequestUmca() ? ui_UpdateTokenUid() : updateTokenUid(); setImage();  return false; " height="20" width="32" title="Yenilə">
						</div>
						<br>
						<div id="inputvecavab">
							<span id="labelPIN" class="h5" style="display:inline-block;width:56px;">Pin kod</span>
							<input maxlength="8" id="tbUserPass" autocomplete="off" type="password" class="password" name="">
							<button type="button" name="logB" onclick="ui_DoAuth() " id="logB" tabindex="10">Daxil ol</button>
							<span id="LN" class="h6" style="display:inline-block;color:Red;width:272px;"></span>
							<span id="LNServer" class="h6" style="display:inline-block;color:Red;width:272px;"></span>
							<input type="hidden" name="TXT_UID"  id="TXT_UID" />
							<input type="hidden" id="Sync" /> 
						</div>
					</div>
				</div>
			</div>
			<input name="UID" type="hidden" id="UID"   />
			<input name="Token" type="hidden" id="Token"  />
			<input name="UserCertificate" type="hidden" id="UserCertificate"  />
			<input name="UserRandom" type="hidden" id="UserRandom"  />
			<input name="UserKeyType" type="hidden" id="UserKeyType"  />
			<input name="ModuleVersion" type="hidden" id="ModuleVersion"  />
			<input name="COMVersion" type="hidden" id="COMVersion"/>
			<input name="ModulType" type="hidden" id="ModulType"  />
			<input name="KeyID" type="hidden" id="KeyID"  /> 
			<input name="UmcaActive" type="hidden" value="0" id="UmcaActive"  />
			<input name="hd_uid" type="hidden" id="hd_uid"   />
			<input name="FIN" type="hidden" id="FIN"  />
			<input name="img" type="hidden" id="fotoimg"  />
		</form>
	</div>	
</body>
</html>