document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Rütbə Adları";
function modalici(cavab){
	document.getElementById("modalformalaniici").innerHTML = cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
	document.getElementById("yuklemealanikapsayici").style.display = "none"
}
function Yeni() {
	var cavab=document.getElementById("YeniModalİci").innerHTML;
	document.getElementById("modalformalaniici").innerHTML = "";
	document.getElementById("modalformalaniici").innerHTML=cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
}

function Imtina() {
	document.getElementById("SilKaratmaAlani").style.display = "none";
	document.getElementById("SilModalAlani").style.display = "none";
	document.getElementById("SilModalMetinAlani").innerHTML = "";
	document.getElementById("SilIslemiOnayButonu").href = "";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
}

function MetinAlaniYazildi(deyer) {
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
		var YoxlanisNeticesi = Yoxla.replace(/[^a-zA-ZÇçĞğİıÖöŞşÜüƏə\;\/\-()\s+]/g, "");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}



function PulFormatiYazildi(deyer) {
	InputIcerikDeyeri=document.getElementById(deyer);
	if (InputIcerikDeyeri.value == "") {		
		error(InputIcerikDeyeri);
		return;
	} else {
		InputIcerikDeyeri.style.color = "#2A3F54";
		InputIcerikDeyeri.style.borderColor = "#2A3F54";
		InputIcerikDeyeri.style.boxShadow = " 0px 0px 0px 0px #2A3F54";
		InputIcerikDeyeri.classList.remove("pleysoldercolorqirmizi");
		var Yoxla = InputIcerikDeyeri.value;			
		var YoxlanisNeticesi = Yoxla.replace(/[^0-9,.]/g,"");
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

function	YeniRutbeAdiFormKontrol(){
	var Rutbe_Adi=document.getElementById('Rutbe_Adi');
	var Rutbe_Pulu=document.getElementById('Rutbe_Pulu');
	var Rutbe_Xidmet_Ili=document.getElementById('Rutbe_Xidmet_Ili');
	if(Rutbe_Adi.value === '') {
		error(Rutbe_Adi);
		return;
	}
	if(Rutbe_Pulu.value === '') {
		error(Rutbe_Pulu);
		return;
	}
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:YeniRutbeIslemi()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}


function	YeniRutbeIslemi(){
	var Rutbe_Adi=document.getElementById('Rutbe_Adi');
	var Rutbe_Pulu=document.getElementById('Rutbe_Pulu');
	var Rutbe_Xidmet_Ili=document.getElementById('Rutbe_Xidmet_Ili');
	if(Rutbe_Adi.value === '') {
		error(Rutbe_Adi);
		return;
	}
	if(Rutbe_Pulu.value === '') {
		error(Rutbe_Pulu);
		return;
	}

	var deyer = {
		Rutbe_Adi:Rutbe_Adi.value,
		Rutbe_Pulu:Rutbe_Pulu.value,
		Rutbe_Xidmet_Ili:Rutbe_Xidmet_Ili.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "RutbeAdlari/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if (cavab=="error_2000") {
				errorcavab(Rutbe_Pulu);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Rutbə pulu boş ola bilməz";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_2001") {
				errorcavab(Rutbe_Adi);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Rutbə adı boş ola bilməz";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_2002") {
				errorcavab(Rutbe_Adi);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Rutbə adı var";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_2003") {
				errorcavab(Rutbe_Adi);
				errorcavab(Rutbe_Pulu);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxlayın";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}else{

				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
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
				document.getElementById("icerik").innerHTML = "";
				document.getElementById("icerik").innerHTML = cavab;
				if (document.getElementById('yenilendi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yeni Rütbə Yaradıldı</span>`;
				}
				if (document.getElementById('silinmeugurluinsertxeta')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yeni Rütbə Yaradıldı. Sitem idarəcisinə məlumat verin (İnsert Uğursuz)</span>`;
				}				

			}

		}else if(this.readyState == 4 && this.status == 404){
			window.location.href = 'http://www.ayhus.net/login.php';
			
		}
	}
}


function	DurumKontrol(id){
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "RutbeAdlari/Durm_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + parcala[1]);
	xhttp.onreadystatechange = function (deyer) {
		if(this.readyState == 4 && this.status == 404){
			window.location.href = 'http://www.ayhus.net/login.php';
			
		}
	}
}

function Sil(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Rütbəni silirsiz.</b>Bunu təsdiq etsəniz rütbə bazadan silinəcək. Ona bağlı bütün məlumatlar silinəcək";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:SilTesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function SilTesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "RutbeAdlari/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if(cavab=="error_4000") {
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
				if (document.getElementById('silcavab')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Silinmə Uğurlu</span>`;
				}
				if (document.getElementById('SilugurInsertxeta')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğurlu. Sitem idarəcisinə məlumat verin (İnsert Uğursuz)</span>`;
				}
			}
		}else if(this.readyState == 4 && this.status == 404){
			window.location.href = 'http://www.ayhus.net/login.php';
			
		}
	}
}

function Duzelis(IDDegeri){
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var deyer=IDDegeri.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "RutbeAdlari/Duzelis_Modali.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + deyer[1]);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			modalici(cavab);
		}else if(this.readyState == 4 && this.status == 404){
			window.location.href = 'http://www.ayhus.net/login.php';
			
		}
	}
}


function DuzeliFormKontrol(){
	var Rutbe_Adi=document.getElementById('Rutbe_Adi');
	var Rutbe_Pulu=document.getElementById('Rutbe_Pulu');
	var Rutbe_Sira_No=document.getElementById('Rutbe_Sira_No');
	var Rutbe_Id=document.getElementById('Rutbe_Id');
	var Rutbe_Xidmet_Ili=document.getElementById('Rutbe_Xidmet_Ili');
	if(Rutbe_Adi.value === '') {
		error(Rutbe_Adi);
		return;
	}
	if(Rutbe_Pulu.value === '') {
		error(Rutbe_Pulu);
		return;
	}

	if(Rutbe_Sira_No.value === '') {
		error(Rutbe_Sira_No);
		return;
	}



	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:DuzelisFormIslemleriKontrol()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";	

}

function DuzelisFormIslemleriKontrol(){
	var Rutbe_Adi=document.getElementById('Rutbe_Adi');
	var Rutbe_Pulu=document.getElementById('Rutbe_Pulu');
	var Rutbe_Sira_No=document.getElementById('Rutbe_Sira_No');
	var Rutbe_Id=document.getElementById('Rutbe_Id');
	var Rutbe_Xidmet_Ili=document.getElementById('Rutbe_Xidmet_Ili');
	if(Rutbe_Adi.value === '') {
		error(Rutbe_Adi);
		return;
	}
	if(Rutbe_Pulu.value === '') {
		error(Rutbe_Pulu);
		return;
	}

	if(Rutbe_Sira_No.value === '') {
		error(Rutbe_Sira_No);
		return;
	}





	var deyer = {
		Rutbe_Adi:Rutbe_Adi.value,
		Rutbe_Pulu:Rutbe_Pulu.value,
		Rutbe_Sira_No:Rutbe_Sira_No.value,
		Rutbe_Xidmet_Ili:Rutbe_Xidmet_Ili.value,
		Rutbe_Id:Rutbe_Id.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "RutbeAdlari/Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("SilKaratmaAlani").style.display = "none";
			document.getElementById("SilModalAlani").style.display = "none";
			document.getElementById("SilModalMetinAlani").innerHTML = "";
			document.getElementById("SilIslemiOnayButonu").href = "";
			document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
			document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";	
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if (cavab=="error_2000") {
				errorcavab(Rutbe_Adi);
				errorcavab(Rutbe_Pulu);
				errorcavab(Rutbe_Sira_No);
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="ID xətalı";
				document.getElementById("errorcavabi").style.display = "block";
			}

			else if (cavab=="error_2001") {
				erroraskfoks(Rutbe_Adi,"Rütbə adı boş ola bilməz");					
			}
			else if (cavab=="error_2002") {
				erroraskfoks(Rutbe_Pulu,"Rütbə pulu boş ola bilməz");					
			}
			else if (cavab=="error_2003") {
				erroraskfoks(Rutbe_Sira_No,"Rütbə sıra nömrəsi boş ola bilməz");					
			}
			else if (cavab=="error_2004") {
				erroraskfoks(Rutbe_Sira_No,"Rütbə sıra nömrəsi bazada var");					
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
				document.getElementById("yuklemealanikapsayici").style.display = "none"				
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				if (document.getElementById('ugurlu')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yenilənmə uğurlu</span>`;
				}
				if (document.getElementById('isnertugursuz')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə uğurlu. Sitem idarəcisinə məlumat verin (İnsert Uğursuz)</span>`;
				}

			}
		}else if(this.readyState == 4 && this.status == 404){
			window.location.href = 'http://www.ayhus.net/login.php';
			
		}
	}

}

function DeyisiklereBax(IDDegeri){
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var deyer=IDDegeri.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "RutbeAdlari/Emeliyatlara_Baxis_Modali.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + deyer[1]);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			modalici(cavab);
		}else if(this.readyState == 4 && this.status == 404){
			window.location.href = 'http://www.ayhus.net/login.php';
			
		}
	}
}