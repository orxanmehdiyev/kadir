document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Tədbiq Edilə Bilən Həvəsləndirmə Tədbirləri";
function modalici(cavab){
	document.getElementById("modalformalaniici").innerHTML = cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
	document.getElementById("yuklemealanikapsayici").style.display = "none"
}

function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendirme_Adlari/Yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			modalici(cavab);
		}
	}	
}

function TenbehAdiYazildi(deyer) {
	InputIcerikDeyeri=document.getElementById(deyer);
	if (InputIcerikDeyeri.value.length > InputIcerikDeyeri.maxLength) 
		InputIcerikDeyeri.value = InputIcerikDeyeri.value.slice(0, InputIcerikDeyeri.maxLength)
	var InputLabelMetni=deyer+"_Metni";
	if (InputIcerikDeyeri.value == "") {			
		if (document.querySelector('[for='+deyer+']')) {
			document.querySelector('[for='+deyer+']').style.color = "#ff0000";
		}		
		InputIcerikDeyeri.style.color = "#ff0000";
		InputIcerikDeyeri.style.borderColor = "#ff0000";
		InputIcerikDeyeri.style.boxShadow = " 1px 0px 1px 0px #ff0000";
		InputIcerikDeyeri.classList.add("pleysoldercolorqirmizi");
		return;
	} else {
		if (document.querySelector('[for='+deyer+']')) {
			document.querySelector('[for='+deyer+']').style.color  = "#2A3F54";
		}
		InputIcerikDeyeri.style.color = "#2A3F54";
		InputIcerikDeyeri.style.borderColor = "#2A3F54";
		InputIcerikDeyeri.style.boxShadow = " 0px 0px 0px 0px #2A3F54";
		InputIcerikDeyeri.classList.remove("pleysoldercolorqirmizi");
		var Yoxla = InputIcerikDeyeri.value;			
		var YoxlanisNeticesi = Yoxla.replace(/[^a-zA-Z0-9ÇçĞğİıÖöŞşÜüƏə.,\/\-()\s+]/g, "");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}




function FormKontrol() {
	var heveslendirem_tedbirleri_ad = document.getElementById("heveslendirem_tedbirleri_ad");	
	if(heveslendirem_tedbirleri_ad.value === '') {
		error(heveslendirem_tedbirleri_ad);
		return;
	}
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:FormIslemleriKontrol()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";	
}


function FormIslemleriKontrol() {
	var heveslendirem_tedbirleri_ad = document.getElementById("heveslendirem_tedbirleri_ad");	
	if(heveslendirem_tedbirleri_ad.value === '') {
		error(heveslendirem_tedbirleri_ad);
		return;
	}
	var deyer = {
		heveslendirem_tedbirleri_ad:heveslendirem_tedbirleri_ad.value		
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendirme_Adlari/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			function Ugursuz_Islemleri(deyer){
				errorcavab(heveslendirem_tedbirleri_ad);				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=deyer;
				document.getElementById("errorcavabi").style.display = "block";
			}

			if (cavab=="error_2001") {	
				erroraskfoks(heveslendirem_tedbirleri_ad,"Adı boş ola  bilməz");			
			}
			else if (cavab=="error_2002") {	
				Ugursuz_Islemleri("Birinci Əməliyyat Uğursuz");			
			}
			else if (cavab=="error_2003") {	
				Ugursuz_Islemleri("İkinci Əməliyyat Uğursuz");			
			}
			else{				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("icerik").innerHTML = "";
				document.getElementById("icerik").innerHTML = cavab;
				if (document.getElementById('yenilendi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yeni Həvəsləndirmə Tədbiri Növü Yaradıldı</span>`;
				}

			}	
		}
	}
}


function DurumKontrol(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendirme_Adlari/Durum_Kontrol.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
}

function NezereAlam(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendirme_Adlari/Nezere_Alma.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
}


function Sil(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Həvəsləndirmə tədbirini silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək və ona bağlı məlumatlarda silinəcək (xəta baş verə bilmə ehtimalıda var) ";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendirme_Adlari/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="error_1000") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğursuz</span>`;
			}	else{
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				if (document.getElementById('yenilendi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Silinme Uğurlu</span>`;
				}
				if (document.getElementById('silindiinsertolmadi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinme Uğurlu. Yoxlanış Məlumatları uğursuz</span>`;
				}
			}
		}
	}
}


function Duzelis(id) {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendirme_Adlari/Duzelis_Modali.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="error_2000") {
				document.getElementById("yuklemealanikapsayici").style.display = "none";
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Düzəliş edilə bilməz</span>`;
			}else{
				modalici(cavab);
			}
			
		}
	}	
}

function ReqemAlaniYazildi(deyer) {
	SagVeSolBosluklariSIl(deyer);
	InputIcerikDeyeri=document.getElementById(deyer);
	if (InputIcerikDeyeri.value.length > InputIcerikDeyeri.maxLength) 
		InputIcerikDeyeri.value = InputIcerikDeyeri.value.slice(0, InputIcerikDeyeri.maxLength)
	if (InputIcerikDeyeri.value == "") {		
		if (document.querySelector('[for='+deyer+']')) {
			document.querySelector('[for='+deyer+']').style.color = "#ff0000";
		}		
		InputIcerikDeyeri.style.color = "#ff0000";
		InputIcerikDeyeri.style.borderColor = "#ff0000";
		InputIcerikDeyeri.style.boxShadow = " 1px 0px 1px 0px #ff0000";
		InputIcerikDeyeri.classList.add("pleysoldercolorqirmizi");
		return;
	} else {
		if (document.querySelector('[for='+deyer+']')) {
			document.querySelector('[for='+deyer+']').style.color  = "#2A3F54";
		}
		InputIcerikDeyeri.style.color = "#2A3F54";
		InputIcerikDeyeri.style.borderColor = "#2A3F54";
		InputIcerikDeyeri.style.boxShadow = " 0px 0px 0px 0px #2A3F54";
		InputIcerikDeyeri.classList.remove("pleysoldercolorqirmizi");
		var Yoxla = InputIcerikDeyeri.value;			
		var YoxlanisNeticesi = Yoxla.replace(/[^0-9]/g,"");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}


function DuzelisFormKontrol() {
	var heveslendirem_tedbirleri_ad = document.getElementById("heveslendirem_tedbirleri_ad");	
	var heveslendirem_tedbirleri_ad_Sira_No = document.getElementById("heveslendirem_tedbirleri_ad_Sira_No");	
	var heveslendirem_tedbirleri_ad_Xususi_No = document.getElementById("heveslendirem_tedbirleri_ad_Xususi_No");	
	var heveslendirem_tedbirleri_ad_id = document.getElementById("heveslendirem_tedbirleri_ad_id");	
	if(heveslendirem_tedbirleri_ad.value === '') {
		error(heveslendirem_tedbirleri_ad);
		return;
	}

	if(heveslendirem_tedbirleri_ad_Sira_No.value === '') {
		error(heveslendirem_tedbirleri_ad_Sira_No);
		return;
	}

	if(heveslendirem_tedbirleri_ad_Xususi_No.value === '') {
		error(heveslendirem_tedbirleri_ad_Xususi_No);
		return;
	}
	if(heveslendirem_tedbirleri_ad_id.value === '') {
		error(heveslendirem_tedbirleri_ad);
		error(heveslendirem_tedbirleri_ad_Sira_No);
		error(heveslendirem_tedbirleri_ad_Xususi_No);
		return;
	}
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:DuzelisFormIslemleriKontrol()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";	
}



function DuzelisFormIslemleriKontrol() {
	var heveslendirem_tedbirleri_ad = document.getElementById("heveslendirem_tedbirleri_ad");	
	var heveslendirem_tedbirleri_ad_Sira_No = document.getElementById("heveslendirem_tedbirleri_ad_Sira_No");	
	var heveslendirem_tedbirleri_ad_Xususi_No = document.getElementById("heveslendirem_tedbirleri_ad_Xususi_No");	
	var heveslendirem_tedbirleri_ad_id = document.getElementById("heveslendirem_tedbirleri_ad_id");	
	if(heveslendirem_tedbirleri_ad.value === '') {
		error(heveslendirem_tedbirleri_ad);
		return;
	}

	if(heveslendirem_tedbirleri_ad_Sira_No.value === '') {
		error(heveslendirem_tedbirleri_ad_Sira_No);
		return;
	}

	if(heveslendirem_tedbirleri_ad_Xususi_No.value === '') {
		error(heveslendirem_tedbirleri_ad_Xususi_No);
		return;
	}

	if(heveslendirem_tedbirleri_ad_id.value === '') {
		error(heveslendirem_tedbirleri_ad);
		error(heveslendirem_tedbirleri_ad_Sira_No);
		error(heveslendirem_tedbirleri_ad_Xususi_No);
		return;
	}

	var deyer = {
		heveslendirem_tedbirleri_ad:heveslendirem_tedbirleri_ad.value,		
		heveslendirem_tedbirleri_ad_Sira_No:heveslendirem_tedbirleri_ad_Sira_No.value,		
		heveslendirem_tedbirleri_ad_Xususi_No:heveslendirem_tedbirleri_ad_Xususi_No.value,	
		heveslendirem_tedbirleri_ad_id:heveslendirem_tedbirleri_ad_id.value	
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();

	xhttp.open("POST", "Heveslendirme_Adlari/Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			function Ugursuz_Islemleri(deyer){
				errorcavab(heveslendirem_tedbirleri_ad);				
				errorcavab(heveslendirem_tedbirleri_ad_Sira_No);				
				errorcavab(heveslendirem_tedbirleri_ad_Xususi_No);				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=deyer;
				document.getElementById("errorcavabi").style.display = "block";
			}

			if (cavab=="error_2000") {	
				Ugursuz_Islemleri("Sistem idarəcisi ilə əlaqə saxlayın");			
			}
			else if (cavab=="error_2001") {	
				erroraskfoks(heveslendirem_tedbirleri_ad,"İntizam tənbehi adını yazın");				
			}
			else if (cavab=="error_2002") {	
				erroraskfoks(heveslendirem_tedbirleri_ad,"İntizam tənbehi adı var");				
			}
			else if (cavab=="error_2003") {	
				erroraskfoks(heveslendirem_tedbirleri_ad_Sira_No,"Sıra nömrəsi boş ola bilməz");				
			}
			else if (cavab=="error_2004") {	
				erroraskfoks(heveslendirem_tedbirleri_ad_Sira_No,"Sıra nömrəsi var");				
			}
			else if (cavab=="error_2005") {	
				erroraskfoks(heveslendirem_tedbirleri_ad_Xususi_No,"Xüsusi nömrəsi boş ola bilməz");				
			}
			else if (cavab=="error_2006") {	
				erroraskfoks(heveslendirem_tedbirleri_ad_Xususi_No,"Xüsusi nömrə var");				
			}
			else if (cavab=="error_2007") {	
				Ugursuz_Islemleri("Sistem idarəcisi ilə əlaqə saxlayın. Yenilənmə uğursuz");				
			}

			else{				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("icerik").innerHTML = "";
				document.getElementById("icerik").innerHTML = cavab;
				if (document.getElementById('yenilendi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yenilənmə uğurlu</span>`;
				}
				if (document.getElementById('yenilendiinsertno')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i>Yenilənmə uğurlu. Sistem idarəcisinə məlumat verin.</span>`;
				}

			}	
		}
	}
}