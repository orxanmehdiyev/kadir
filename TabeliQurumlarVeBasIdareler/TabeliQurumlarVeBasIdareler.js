function Yeni() {		
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "TabeliQurumlarVeBasIdareler/Yeni.php", true);
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

function YeniFormKontrol(){

	if (document.getElementById("Adi")) {
		if (document.getElementById("Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Adi");
			if (document.querySelector('[for="Adi"]')) {
				document.querySelector('[for="Adi"]').style.color = "#ff0000";
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
	document.getElementById("SilIslemiOnayButonu").href = "javascript:YaddaşaYazTesdiqle()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
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

function YaddaşaYazTesdiqle() {
	var Adi=document.getElementById('Adi').value;
	var deyer = {	Adi:Adi,	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "TabeliQurumlarVeBasIdareler/YeniIslemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="error_1000"){
				if (document.getElementById("Adi")) {				
					var Adi = document.getElementById("Adi");
					if (document.querySelector('[for="Adi"]')) {
						document.querySelector('[for="Adi"]').style.color = "#ff0000";
					}	
					Adi.style.outline = "none";
					Adi.style.border = "2px solid #ff0000";
					Adi.style.color = "#ff0000";
					Adi.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Ad boş ola bilməz";
					document.getElementById("errorcavabi").style.display = "block";
					return;

				}
			} 
			

			else if(cavab=="error_1003"){
				if (document.getElementById("Nazirlik_Id")) {				
					var Nazirlik_Id = document.getElementById("Nazirlik_Id");
					if (document.querySelector('[for="Nazirlik_Id"]')) {
						document.querySelector('[for="Nazirlik_Id"]').style.color = "#ff0000";
					}	
					Nazirlik_Id.style.outline = "none";
					Nazirlik_Id.style.border = "2px solid #ff0000";
					Nazirlik_Id.style.color = "#ff0000";
					Nazirlik_Id.focus();
					document.getElementById("SilKaratmaAlani").style.display = "none";
					document.getElementById("SilModalAlani").style.display = "none";
					document.getElementById("SilModalMetinAlani").innerHTML = "";
					document.getElementById("SilIslemiOnayButonu").href = "";
					document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
					document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
					document.getElementById("errorcavabi").innerHTML="";
					document.getElementById("errorcavabi").innerHTML="Adminstartorla əlaqə saxla (İkinci İnsert xeta)";
					document.getElementById("errorcavabi").style.display = "block";
					return;

				}
			}else{
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
			}
		}
	}
}


function SiraDuzelis(id){
	var Sira_No=document.getElementById(id).value;
	var parcala=id.split("_");
	var deyer = {Sira_No:Sira_No,
		Id:parcala[1]
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "TabeliQurumlarVeBasIdareler/Sira_Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="error_1000"){
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz. Sira nömrəsi boş ola bilməz</span>`;
			}
			else	if(cavab=="error_1001"){
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz. Bu sıra nömrəsi mövcutdur</span>`;
			}

			else	if(cavab=="error_1002"){
				document.getElementById("cavabid").innerHTML="";			
			}

			else	if(cavab=="error_1003"){
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz. Bazad möcud olmayan məlumatin yenilənməsi</span>`;
			}

			else	if(cavab=="error_1004"){
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz. Adminstratorla əlaqə saxla(birinci)</span>`;
			}
			else	if(cavab=="error_1004"){
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz. Adminstratorla əlaqə saxla(ikinci)</span>`;
			}
			else{
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
			}
		}
	}
}

function DurumKontrol(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "TabeliQurumlarVeBasIdareler/Durum_Kontrol.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + parcala[1]);
}
function DuzelisYoxlanis(id){
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "TabeliQurumlarVeBasIdareler/DuzelisYoxlanis.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + parcala[1]);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("modalformalaniici").innerHTML = cavab;
			document.getElementById("Modal").style.display = "block";
			document.getElementById("ModalAlani").style.display = "block";
		}
	}

}

function SilYoxlanis(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Mövcut Olan Qurumu Silirsiniz .</b>Bunu təsdiq etsəniz İdarə bazadan silinəcək və ona bağlı bütün məlumatlar silinəcək";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "TabeliQurumlarVeBasIdareler/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="error_4000") {
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

function DuzelisFormKontrol(){

	if (document.getElementById("Adi")) {
		if (document.getElementById("Adi").value == "") {
			var YoxlanilanElement = document.getElementById("Adi");
			if (document.querySelector('[for="Adi"]')) {
				document.querySelector('[for="Adi"]').style.color = "#ff0000";
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
	document.getElementById("SilIslemiOnayButonu").href = "javascript:DuzelisTesdiqle()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function DuzelisTesdiqle() {
	var Adi=document.getElementById('Adi').value;
	var Id=document.getElementById('duzelisid').value;
	var deyer = {
		Adi:Adi,
		Id:Id,
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "TabeliQurumlarVeBasIdareler/Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="error_1000" || cavab=="error_1001"){
				if (document.getElementById("Adi")) {
					var YoxlanilanElement = document.getElementById("Adi");
					if (document.querySelector('[for="Adi"]')) {
						document.querySelector('[for="Adi"]').style.color = "#ff0000";
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
					return;
				}
			}

			else if(cavab=="error_1003" || cavab=="error_1004"  || cavab=="error_1005"){
				if (document.getElementById("Adi")) {
					var YoxlanilanElement = document.getElementById("Adi");
					if (document.querySelector('[for="Adi"]')) {
						document.querySelector('[for="Adi"]').style.color = "#ff0000";
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
				return;
			}
			else{
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				var silcavab=document.getElementById('silcavab').value;
				if (silcavab=='ugurlu') {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yenilənmə uğurlu</span>`;
				}
			}
		}
	}
}