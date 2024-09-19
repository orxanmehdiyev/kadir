document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Şöbə-bölmələr";
function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "SobeBolme/Yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("modalformalaniici").innerHTML = cavab;
			document.getElementById("Modal").style.display = "block";
			document.getElementById("ModalAlani").style.display = "block";
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}	
}

function Imtina() {
	document.getElementById("SilKaratmaAlani").style.display = "none";
	document.getElementById("SilModalAlani").style.display = "none";
	document.getElementById("SilModalMetinAlani").innerHTML = "";
	document.getElementById("SilIslemiOnayButonu").href = "";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
}

function SagVeSolBosluklariSIl(deyer){
	InputIcerikDeyeri=document.getElementById(deyer);
	var Yoxlabir = InputIcerikDeyeri.value;		
	var Yoxla=Yoxlabir.trim();	
	InputIcerikDeyeri.value = Yoxla;
}

function SecimEdildi(deyer) {
	if (document.querySelector('[for='+deyer+']')) {
		document.querySelector('[for='+deyer+']').style.color = "#2A3F54";
	}
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";
	document.getElementById(deyer).style.border = "1px solid #2A3F54";
}

function AdiYazildi(deyer) {
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
		var YoxlanisNeticesi = Yoxla.replace(/[^a-zA-Z0-9ÇçĞğİıÖöŞşÜüƏə.\/\-()\s+]/g,"");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}

function NoYazildi(deyer) {
	InputIcerikDeyeri=document.getElementById(deyer);
	if (InputIcerikDeyeri.value == "") {		
		error(InputIcerikDeyeri);
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

function FormKontrolYoxlanis() {
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Ad=document.getElementById("Sobe_Ad");
	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Ad.value === '') {
		error(Sobe_Ad);
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
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Ad=document.getElementById("Sobe_Ad");
	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Ad.value === '') {
		error(Sobe_Ad);
		return;
	}
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var Idare_Id_deyer=Idare_Id.value;
	var Sobe_Ad_deyer=Sobe_Ad.value;
	var deyer = {Idare_Id:Idare_Id_deyer,
		Sobe_Ad:Sobe_Ad_deyer,
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();

	xhttp.open("POST", "SobeBolme/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if (cavab=="error_1001") {
				errorcavab(Idare_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu idarəni secin";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1002") {
				errorcavab(Sobe_Ad);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Şöbə adı boş ola bilməz";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1003") {
				errorcavab(Sobe_Ad);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Bu idarə altında Bu şöbə bazada var";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1004") {
				errorcavab(Idare_Id);
				errorcavab(Sobe_Ad);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxla ( Birinci əməliyyat uğursuz)";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1005") {
				errorcavab(Idare_Id);
				errorcavab(Sobe_Ad);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxla ( Birinci əməliyyat uğursuz)";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}else{
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
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yeni Şöbə Yaradıldı</span>`;
				}
			}
		}
	}
}

function DurumKontrol(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "SobeBolme/Durum_Kontrol.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
}

function Duzelis(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "SobeBolme/Duzelis.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("modalformalaniici").innerHTML = cavab;
			document.getElementById("Modal").style.display = "block";
			document.getElementById("ModalAlani").style.display = "block";
			document.getElementById("yuklemealanikapsayici").style.display = "none"
		}
	}	
}



function DuzelisFormYoxlanis() {
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Ad=document.getElementById("Sobe_Ad");
	var Sira_No=document.getElementById("Sira_No");
	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Ad.value === '') {
		error(Sobe_Ad);
		return;
	}

	if(Sira_No.value === '') {
		error(Sira_No);
		return;
	}




	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:DuzelisIslemleriKontrol()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}


function DuzelisIslemleriKontrol() {
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Ad=document.getElementById("Sobe_Ad");
	var Sira_No=document.getElementById("Sira_No");
	var Sobe_Id=document.getElementById("Sobe_Id");
	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Ad.value === '') {
		error(Sobe_Ad);
		return;
	}

	if(Sira_No.value === '') {
		error(Sira_No);
		return;
	}


	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var Idare_Id_deyer=Idare_Id.value;
	var Sobe_Ad_deyer=Sobe_Ad.value;
	var Sira_No_deyer=Sira_No.value;
	var Sobe_Id_deyer=Sobe_Id.value;
	var deyer = {
		Idare_Id:Idare_Id_deyer,
		Sobe_Ad:Sobe_Ad_deyer,
		Sira_No:Sira_No_deyer,
		Sobe_Id:Sobe_Id_deyer,
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "SobeBolme/Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if (cavab=="error_1001") {
				errorcavab(Idare_Id);			
				errorcavab(Sobe_Ad);
				errorcavab(Sira_No);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxlayın. (İd boşdur)";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1002") {
				errorcavabfoks(Idare_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu idarəni secin";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1003") {
				errorcavabfoks(Sobe_Ad);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Şöbə adı boş ola bilməz";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1004") {
				errorcavabfoks(Sobe_Ad);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Bu adda şöbə və ya bölmə mövcutdur";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1005") {
				errorcavabfoks(Sira_No);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sıra nömrəsi boş ola bilməz";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1006") {
				errorcavabfoks(Sira_No);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Bu idarə üçün bu sıra nömrəsi istifadə olunur";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1007") {
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Xüsusi nömrə boş ola bilməz";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1008") {
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Bu Xüsusi nömrə təyin oluna bilməz";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1009") {
				errorcavab(Idare_Id);
				errorcavab(Sobe_Ad);
				errorcavab(Sira_No);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisinə məlumat verin (Birinci əməliyyat uğursuz)";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1010") {
				errorcavab(Idare_Id);
				errorcavab(Sobe_Ad);
				errorcavab(Sira_No);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisinə məlumat verin (İkinci əməliyyat uğursuz)";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}else{
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

function SilYoxlanis(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Şöbə və bölməni silirsiz .</b>Bunu təsdiq etsəniz məlumat bazadan silinəcək və ona bağlı bütün məlumatlar silinəcək";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "SobeBolme/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if(cavab=="error_1000") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğursuz</span>`;
			}	else{
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				var silcavab=document.getElementById('silcavab').value;
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				if (silcavab=='silindi') {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Silinmə Uğurlu</span>`;
				}
			}
		}
	}
}
