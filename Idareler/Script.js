function Yeni() {		
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Idareler/yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("modalformalaniici").innerHTML = cavab;
			document.getElementById("Modal").style.display = "block";
			document.getElementById("ModalAlani").style.display = "block";
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

function VoenYazildi(deyer) {
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

function YeniFormKontrol(){
	if (document.getElementById("Ust_Id")) {
		if (document.getElementById("Ust_Id").value == "") {
			var YoxlanilanElement = document.getElementById("Ust_Id");
			if (document.querySelector('[for="Ust_Id"]')) {
				document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Adi")) {
		if (document.getElementById("Idare_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Adi");
			if (document.querySelector('[for="Idare_Adi"]')) {
				document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Kissa_Adi")) {
		if (document.getElementById("Idare_Kissa_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
			if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
				document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_VOEN")) {
		var Idare_VOEN = document.getElementById("Idare_VOEN");
		var Idare_VOEN_Uzunluq=Idare_VOEN.value.length;			
		if (Idare_VOEN.value == "" )  {
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;				
		}else if(Idare_VOEN_Uzunluq!=10){
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Unvan")) {
		if (document.getElementById("Idare_Unvan").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Unvan");
			if (document.querySelector('[for="Idare_Unvan"]')) {
				document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:FormIslemleriKontrol()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}



function FormIslemleriKontrol() {
	if (document.getElementById("Ust_Id")) {
		if (document.getElementById("Ust_Id").value == "") {
			var YoxlanilanElement = document.getElementById("Ust_Id");
			if (document.querySelector('[for="Ust_Id"]')) {
				document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Adi")) {
		if (document.getElementById("Idare_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Adi");
			if (document.querySelector('[for="Idare_Adi"]')) {
				document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Kissa_Adi")) {
		if (document.getElementById("Idare_Kissa_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
			if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
				document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_VOEN")) {
		var Idare_VOEN = document.getElementById("Idare_VOEN");
		var Idare_VOEN_Uzunluq=Idare_VOEN.value.length;			
		if (Idare_VOEN.value == "" )  {
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;				
		}else if(Idare_VOEN_Uzunluq!=10){
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Unvan")) {
		if (document.getElementById("Idare_Unvan").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Unvan");
			if (document.querySelector('[for="Idare_Unvan"]')) {
				document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	var Ust_Id=document.getElementById("Ust_Id").value;
	var Idare_Adi=document.getElementById("Idare_Adi").value;
	var Idare_Kissa_Adi=document.getElementById("Idare_Kissa_Adi").value;
	var Idare_VOEN=document.getElementById("Idare_VOEN").value;
	var Idare_Unvan=document.getElementById("Idare_Unvan").value;
	var deyer = {Ust_Id:Ust_Id,
		Idare_Adi:Idare_Adi,
		Idare_Kissa_Adi:Idare_Kissa_Adi,
		Idare_VOEN:Idare_VOEN,
		Idare_Unvan:Idare_Unvan,
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Idareler/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if (cavab=="error_1001") {
				if (document.getElementById("Ust_Id")) {
					var YoxlanilanElement = document.getElementById("Ust_Id");
					if (document.querySelector('[for="Ust_Id"]')) {
						document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Tabe olduğu qurumu secin";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}
			else if (cavab=="error_1002") {
				if (document.getElementById("Idare_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Adi");
					if (document.querySelector('[for="Idare_Adi"]')) {
						document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Adı boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}
			else if (cavab=="error_1007") {
				if (document.getElementById("Idare_Kissa_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
					if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
						document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Adı boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1003") {
				if (document.getElementById("Idare_VOEN")) {
					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Vöen boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1004") {
				if (document.getElementById("Idare_VOEN")) {
					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Vöen bazada var";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1005") {
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Ünvan boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1006" || cavab=="error_1007") {
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";

					var YoxlanilanElement = document.getElementById("Ust_Id");
					if (document.querySelector('[for="Ust_Id"]')) {
						document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";

					var YoxlanilanElement = document.getElementById("Idare_Adi");
					if (document.querySelector('[for="Idare_Adi"]')) {
						document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";

					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";


					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Adminstartorla əlaqə saxlayın";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
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
			}
		}
	}
}

function DuzelisYoxlanis(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Idareler/Duzelis.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("modalformalaniici").innerHTML = cavab;
			document.getElementById("Modal").style.display = "block";
			document.getElementById("ModalAlani").style.display = "block";
		}
	}	
}


function DuzelisFormKontrol(){
	if (document.getElementById("Ust_Id")) {
		if (document.getElementById("Ust_Id").value == "") {
			var YoxlanilanElement = document.getElementById("Ust_Id");
			if (document.querySelector('[for="Ust_Id"]')) {
				document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Adi")) {
		if (document.getElementById("Idare_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Adi");
			if (document.querySelector('[for="Idare_Adi"]')) {
				document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

		if (document.getElementById("Idare_Kissa_Adi")) {
		if (document.getElementById("Idare_Kissa_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
			if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
				document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_VOEN")) {
		var Idare_VOEN = document.getElementById("Idare_VOEN");
		var Idare_VOEN_Uzunluq=Idare_VOEN.value.length;			
		if (Idare_VOEN.value == "" )  {
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;				
		}else if(Idare_VOEN_Uzunluq!=10){
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;
		}
	}

	if (document.getElementById("Sira_No")) {
		if (document.getElementById("Sira_No").value == "") {
			var YoxlanilanElement = document.getElementById("Sira_No");
			if (document.querySelector('[for="Sira_No"]')) {
				document.querySelector('[for="Sira_No"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}



	if (document.getElementById("Idare_Unvan")) {
		if (document.getElementById("Idare_Unvan").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Unvan");
			if (document.querySelector('[for="Idare_Unvan"]')) {
				document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:DuzelisFormIslemleriKontrol()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}



function DuzelisFormIslemleriKontrol() {
	if (document.getElementById("Ust_Id")) {
		if (document.getElementById("Ust_Id").value == "") {
			var YoxlanilanElement = document.getElementById("Ust_Id");
			if (document.querySelector('[for="Ust_Id"]')) {
				document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_Adi")) {
		if (document.getElementById("Idare_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Adi");
			if (document.querySelector('[for="Idare_Adi"]')) {
				document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

		if (document.getElementById("Idare_Kissa_Adi")) {
		if (document.getElementById("Idare_Kissa_Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
			if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
				document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}

	if (document.getElementById("Idare_VOEN")) {
		var Idare_VOEN = document.getElementById("Idare_VOEN");
		var Idare_VOEN_Uzunluq=Idare_VOEN.value.length;			
		if (Idare_VOEN.value == "" )  {
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;				
		}else if(Idare_VOEN_Uzunluq!=10){
			if (document.querySelector('[for="Idare_VOEN"]')) {
				document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
			}	
			Idare_VOEN.style.outline = "none";
			Idare_VOEN.style.border = "2px solid #ff0000";
			Idare_VOEN.style.color = "#ff0000";
			Idare_VOEN.focus();
			return;
		}
	}

	if (document.getElementById("Sira_No")) {
		if (document.getElementById("Sira_No").value == "") {
			var YoxlanilanElement = document.getElementById("Sira_No");
			if (document.querySelector('[for="Sira_No"]')) {
				document.querySelector('[for="Sira_No"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}



	if (document.getElementById("Idare_Unvan")) {
		if (document.getElementById("Idare_Unvan").value == "") {
			var YoxlanilanElement = document.getElementById("Idare_Unvan");
			if (document.querySelector('[for="Idare_Unvan"]')) {
				document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
			}	
			YoxlanilanElement.style.outline = "none";
			YoxlanilanElement.style.border = "2px solid #ff0000";
			YoxlanilanElement.style.color = "#ff0000";
			YoxlanilanElement.focus();
			return;
		}
	}





	var Ust_Id=document.getElementById("Ust_Id").value;
	var Idare_Adi=document.getElementById("Idare_Adi").value;
	var Idare_Kissa_Adi=document.getElementById("Idare_Kissa_Adi").value;
	var Idare_VOEN=document.getElementById("Idare_VOEN").value;
	var Sira_No=document.getElementById("Sira_No").value;
	var Idare_Unvan=document.getElementById("Idare_Unvan").value;
	var Idare_Id=document.getElementById("Idare_Id").value;
	var deyer = {Ust_Id:Ust_Id,
		Idare_Adi:Idare_Adi,
		Idare_Kissa_Adi:Idare_Kissa_Adi,
		Idare_VOEN:Idare_VOEN,
		Sira_No:Sira_No,
		Idare_Unvan:Idare_Unvan,
		Idare_Id:Idare_Id,
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Idareler/Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if (cavab=="error_1001") {
				if (document.getElementById("Ust_Id")) {
					var YoxlanilanElement = document.getElementById("Ust_Id");
					if (document.querySelector('[for="Ust_Id"]')) {
						document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Tabe olduğu qurumu secin";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1002") {
				if (document.getElementById("Ust_Id")) {
					var YoxlanilanElement = document.getElementById("Ust_Id");
					if (document.querySelector('[for="Ust_Id"]')) {
						document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Tabe olduğu qurumu secin";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1003") {
				if (document.getElementById("Idare_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Adi");
					if (document.querySelector('[for="Idare_Adi"]')) {
						document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="İdarə adı boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}


			else if (cavab=="error_1007") {
				if (document.getElementById("Idare_Kissa_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
					if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
						document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="İdarə adı boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1004") {
				if (document.getElementById("Idare_VOEN")) {
					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="VÖEN boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1005") {
				if (document.getElementById("Idare_VOEN")) {
					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="VÖEN bazada var";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}






			else if (cavab=="error_1008") {
				if (document.getElementById("Sira_No")) {
					var YoxlanilanElement = document.getElementById("Sira_No");
					if (document.querySelector('[for="Sira_No"]')) {
						document.querySelector('[for="Sira_No"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
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
			}

			else if (cavab=="error_1009") {
				if (document.getElementById("Sira_No")) {
					var YoxlanilanElement = document.getElementById("Sira_No");
					if (document.querySelector('[for="Sira_No"]')) {
						document.querySelector('[for="Sira_No"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Sıra nömrəsi bazad var";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1010") {
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
					YoxlanilanElement.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Ünvan boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;
				}
			}

			else if (cavab=="error_1011") {
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Ust_Id")) {
					var YoxlanilanElement = document.getElementById("Ust_Id");
					if (document.querySelector('[for="Ust_Id"]')) {
						document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Idare_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Adi");
					if (document.querySelector('[for="Idare_Adi"]')) {
						document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

								if (document.getElementById("Idare_Kissa_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
					if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
						document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Idare_VOEN")) {
					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}



				if (document.getElementById("Sira_No")) {
					var YoxlanilanElement = document.getElementById("Sira_No");
					if (document.querySelector('[for="Sira_No"]')) {
						document.querySelector('[for="Sira_No"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}


				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Administrator əlaqə saxlayın (ID boşdur).";
				document.getElementById("errorcavabi").style.display = "block";
				return;

			}


			else if (cavab=="error_1012") {
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Ust_Id")) {
					var YoxlanilanElement = document.getElementById("Ust_Id");
					if (document.querySelector('[for="Ust_Id"]')) {
						document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Idare_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Adi");
					if (document.querySelector('[for="Idare_Adi"]')) {
						document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

								if (document.getElementById("Idare_Kissa_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
					if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
						document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Idare_VOEN")) {
					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}



				if (document.getElementById("Sira_No")) {
					var YoxlanilanElement = document.getElementById("Sira_No");
					if (document.querySelector('[for="Sira_No"]')) {
						document.querySelector('[for="Sira_No"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}


				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Administrator əlaqə saxlayın (Birinci insert xəta).";
				document.getElementById("errorcavabi").style.display = "block";
				return;
				
			}

			else if (cavab=="error_1013") {
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Ust_Id")) {
					var YoxlanilanElement = document.getElementById("Ust_Id");
					if (document.querySelector('[for="Ust_Id"]')) {
						document.querySelector('[for="Ust_Id"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Idare_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Adi");
					if (document.querySelector('[for="Idare_Adi"]')) {
						document.querySelector('[for="Idare_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

								if (document.getElementById("Idare_Kissa_Adi")) {
					var YoxlanilanElement = document.getElementById("Idare_Kissa_Adi");
					if (document.querySelector('[for="Idare_Kissa_Adi"]')) {
						document.querySelector('[for="Idare_Kissa_Adi"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}

				if (document.getElementById("Idare_VOEN")) {
					var YoxlanilanElement = document.getElementById("Idare_VOEN");
					if (document.querySelector('[for="Idare_VOEN"]')) {
						document.querySelector('[for="Idare_VOEN"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}



				if (document.getElementById("Sira_No")) {
					var YoxlanilanElement = document.getElementById("Sira_No");
					if (document.querySelector('[for="Sira_No"]')) {
						document.querySelector('[for="Sira_No"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}
				if (document.getElementById("Idare_Unvan")) {
					var YoxlanilanElement = document.getElementById("Idare_Unvan");
					if (document.querySelector('[for="Idare_Unvan"]')) {
						document.querySelector('[for="Idare_Unvan"]').style.color = "#ff0000";
					}	
					YoxlanilanElement.style.outline = "none";
					YoxlanilanElement.style.border = "2px solid #ff0000";
					YoxlanilanElement.style.color = "#ff0000";
				}


				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Administrator əlaqə saxlayın (İkinci insert xəta).";
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
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				if (document.getElementById('yenilendi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Uğurla Yeniləndi</span>`;
				}


				return;
			}
		}
	}
}




function DurumKontrol(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Idareler/Durum_Kontrol.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
}


function SilYoxlanis(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>İdarəni Silirsiniz .</b>Bunu təsdiq etsəniz İdarə bazadan silinəcək və ona bağlı bütün məlumatlar silinəcək";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Idareler/Sil_Islemleri.php", true);
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

function DeyisiklereBax(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Idareler/Islemlere_Baxis.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("modalformalaniici").innerHTML = cavab;
			document.getElementById("Modal").style.display = "block";
			document.getElementById("ModalAlani").style.display = "block";
		}
	}	
}
