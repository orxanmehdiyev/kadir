document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Məzuniyyət Növləri";
function modalici(cavab){
	document.getElementById("modalformalaniici").innerHTML = cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
	document.getElementById("yuklemealanikapsayici").style.display = "none"
}

function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetNovleri/Yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			modalici(cavab);
		}
	}	
}

function Adıyazıldı(deyer) {
	InputIcerikDeyeri=document.getElementById(deyer);
	if (InputIcerikDeyeri.value.length > InputIcerikDeyeri.maxLength) 
		InputIcerikDeyeri.value = InputIcerikDeyeri.value.slice(0, InputIcerikDeyeri.maxLength)
	if (InputIcerikDeyeri.value == "") {
		InputIcerikDeyeri.style.color = "#ff0000";
		InputIcerikDeyeri.style.borderColor = "#ff0000";
		InputIcerikDeyeri.style.boxShadow = " 1px 0px 1px 0px #ff0000";
		InputIcerikDeyeri.classList.add("pleysoldercolorqirmizi");
		return;
	} else {	
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

function SagVeSolBosluklariSIl(deyer){
	InputIcerikDeyeri=document.getElementById(deyer);
	var Yoxlabir = InputIcerikDeyeri.value;		
	var Yoxla=Yoxlabir.trim();	
	InputIcerikDeyeri.value = Yoxla;
}

function FormKontrol() {
	var Mezuniyyet_Novleri_Ad = document.getElementById("Mezuniyyet_Novleri_Ad");	
	var Mezuniyyet_Novleri_Kissa_Ad = document.getElementById("Mezuniyyet_Novleri_Kissa_Ad");	
	if(Mezuniyyet_Novleri_Ad.value === '') {
		error(Mezuniyyet_Novleri_Ad);
		return;
	}
	if(Mezuniyyet_Novleri_Kissa_Ad.value === '') {
		error(Mezuniyyet_Novleri_Kissa_Ad);
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
	var Mezuniyyet_Novleri_Ad = document.getElementById("Mezuniyyet_Novleri_Ad");	
	var Mezuniyyet_Novleri_Kissa_Ad = document.getElementById("Mezuniyyet_Novleri_Kissa_Ad");	
	if(Mezuniyyet_Novleri_Ad.value === '') {
		error(Mezuniyyet_Novleri_Ad);
		return;
	}
	if(Mezuniyyet_Novleri_Kissa_Ad.value === '') {
		error(Mezuniyyet_Novleri_Kissa_Ad);
		return;
	}
	var deyer = {
		Mezuniyyet_Novleri_Ad:Mezuniyyet_Novleri_Ad.value,	
		Mezuniyyet_Novleri_Kissa_Ad:Mezuniyyet_Novleri_Kissa_Ad.value		
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetNovleri/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if (cavab=="error_2001") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Adı boş ola  bilməz");			
			}
			else if (cavab=="error_2002") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Qıssa adı boş ola  bilməz");				
			}
			else if (cavab=="error_2003") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Uğursuz");		
			}
			else if (cavab=="error_2004") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Kontyrol silinmesi uğursuz");		
			}
			else if (cavab=="error_2005") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Uğursuz");		
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
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Uğurla Yeniləndi</span>`;
				}
			}	
		}
	}
}

function DurumKontrol(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetNovleri/Durum_Kontrol.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
}

function Duzelis(id) {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetNovleri/Duzelis_Modali.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.readyState == 4 && this.status == 200) {
				var cavab=this.responseText.trim();
				modalici(cavab);
			}
		}
	}	
}

function DuzelisFormKontrol(id) {
	var Mezuniyyet_Novleri_Ad = document.getElementById("Mezuniyyet_Novleri_Ad");	
	var Mezuniyyet_Novleri_Kissa_Ad = document.getElementById("Mezuniyyet_Novleri_Kissa_Ad");	
	var Mezuniyyet_Novleri_Sira = document.getElementById("Mezuniyyet_Novleri_Sira");	
	if(Mezuniyyet_Novleri_Ad.value === '') {
		error(Mezuniyyet_Novleri_Ad);
		return;
	}
	if(Mezuniyyet_Novleri_Kissa_Ad.value === '') {
		error(Mezuniyyet_Novleri_Kissa_Ad);
		return;
	}
	if(Mezuniyyet_Novleri_Sira.value === '') {
		error(Mezuniyyet_Novleri_Sira);
		return;
	}
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:DuzelisFormIslemleriKontrol("+id+")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";	
}


function DuzelisFormIslemleriKontrol(id) {
	var Mezuniyyet_Novleri_Ad = document.getElementById("Mezuniyyet_Novleri_Ad");	
	var Mezuniyyet_Novleri_Kissa_Ad = document.getElementById("Mezuniyyet_Novleri_Kissa_Ad");
	var Mezuniyyet_Novleri_Sira = document.getElementById("Mezuniyyet_Novleri_Sira");		
	if(Mezuniyyet_Novleri_Ad.value === '') {
		error(Mezuniyyet_Novleri_Ad);
		return;
	}
	if(Mezuniyyet_Novleri_Kissa_Ad.value === '') {
		error(Mezuniyyet_Novleri_Kissa_Ad);
		return;
	}

	if(Mezuniyyet_Novleri_Sira.value === '') {
		error(Mezuniyyet_Novleri_Sira);
		return;
	}
	var deyer = {
		Mezuniyyet_Novleri_ID:id,	
		Mezuniyyet_Novleri_Ad:Mezuniyyet_Novleri_Ad.value,	
		Mezuniyyet_Novleri_Kissa_Ad:Mezuniyyet_Novleri_Kissa_Ad.value,	
		Mezuniyyet_Novleri_Sira:Mezuniyyet_Novleri_Sira.value	
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetNovleri/Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if (cavab=="error_2001") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Adı boş ola  bilməz");			
			}
			else if (cavab=="error_2002") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Qıssa adı boş ola  bilməz");				
			}
			else if (cavab=="error_2003") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Uğursuz");		
			}
			else if (cavab=="error_2004") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Kontyrol silinmesi uğursuz");		
			}
			else if (cavab=="error_2005") {	
				erroraskfoks(Mezuniyyet_Novleri_Ad,"Uğursuz");		
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
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yeni Məzuniyyət Növü Yaradıldı</span>`;
				}
			}	
		}
	}
}

function DeyisiklereBax(id) {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetNovleri/Bax_Modali.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (this.readyState == 4 && this.status == 200) {
				var cavab=this.responseText.trim();
				modalici(cavab);
			}
		}
	}	
}


function Sil(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Tədbiq Edilə Bilən İtizam Tənbehini Silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək və ona bağlı məlumatlarda silinəcək (xəta baş verə bilmə ehtimalıda var) ";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetNovleri/Sil_Islemleri.php", true);
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
			}
		}
	}
}