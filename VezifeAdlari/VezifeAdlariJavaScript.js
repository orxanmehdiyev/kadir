document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Vəzifə adları";
function Yeni() {
	var cavab=document.getElementById("IseQebulModaliIci").innerHTML;
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
		var YoxlanisNeticesi = Yoxla.replace(/[^a-zA-Z0-9ÇçĞğİıÖöŞşÜüƏə\/\-()\s+]/g, "");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}

function SelectAlaniSecildi(deyer) {
	if (document.querySelector('[for='+deyer+']')) {
		document.querySelector('[for='+deyer+']').style.color  = "#2A3F54";
	}
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";

}

function SagVeSolBosluklariSIl(deyer){
	InputIcerikDeyeri=document.getElementById(deyer);
	var Yoxlabir = InputIcerikDeyeri.value;		
	var Yoxla=Yoxlabir.trim();	
	InputIcerikDeyeri.value = Yoxla;
}


function VezifeAdlarininYazilmasiFormKontrol() {
	if (document.getElementById("Vezife_Adlari_Ad")) {
		if (document.getElementById("Vezife_Adlari_Ad").value == "") {
			var Vezife_Adlari_Ad = document.getElementById("Vezife_Adlari_Ad");
			if (document.querySelector('[for="Vezife_Adlari_Ad"]')) {
				document.querySelector('[for="Vezife_Adlari_Ad"]').style.color = "#ff0000";
			}						
			Vezife_Adlari_Ad.style.outline = "none";
			Vezife_Adlari_Ad.style.border = "2px solid #ff0000";
			Vezife_Adlari_Ad.style.color = "#ff0000";
			Vezife_Adlari_Ad.focus();
			return;
		}
	} 


	if (document.getElementById("Vezife_Adlari_Sira")) {
		if (document.getElementById("Vezife_Adlari_Sira").value == "") {
			var Vezife_Adlari_Sira = document.getElementById("Vezife_Adlari_Sira");
			if (document.querySelector('[for="Vezife_Adlari_Sira"]')) {
				document.querySelector('[for="Vezife_Adlari_Sira"]').style.color = "#ff0000";
			}	
			Vezife_Adlari_Sira.style.outline = "none";
			Vezife_Adlari_Sira.style.border = "2px solid #ff0000";
			Vezife_Adlari_Sira.style.color = "#ff0000";
			Vezife_Adlari_Sira.focus();
			return;
		}
	}

	var Vezife_Adlari_Ad=document.getElementById('Vezife_Adlari_Ad').value;



	var deyer = {Vezife_Adlari_Ad:Vezife_Adlari_Ad
	};

	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "VezifeAdlari/Yeni_Vezife_Adi_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			function Ugursuz_Islemleri(deyer){
				var Vezife_Adlari_Ad = document.getElementById("Vezife_Adlari_Ad");
				if (document.querySelector('[for="Vezife_Adlari_Ad"]')) {
					document.querySelector('[for="Vezife_Adlari_Ad"]').style.color = "#ff0000";
				}	
				Vezife_Adlari_Ad.style.outline = "none";
				Vezife_Adlari_Ad.style.border = "2px solid #ff0000";
				Vezife_Adlari_Ad.style.color = "#ff0000";
				Vezife_Adlari_Ad.focus();
				var Vezife_Adlari_Ad = document.getElementById("Vezife_Adlari_Ad");
				if (document.querySelector('[for="Vezife_Adlari_Ad"]')) {
					document.querySelector('[for="Vezife_Adlari_Ad"]').style.color = "#ff0000";
				}	
				Vezife_Adlari_Ad.style.outline = "none";
				Vezife_Adlari_Ad.style.border = "2px solid #ff0000";
				Vezife_Adlari_Ad.style.color = "#ff0000";
				Vezife_Adlari_Ad.focus();
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=deyer;
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			if(cavab=="error_2000") {
				var Vezife_Adlari_Ad = document.getElementById("Vezife_Adlari_Ad");
				if (document.querySelector('[for="Vezife_Adlari_Ad"]')) {
					document.querySelector('[for="Vezife_Adlari_Ad"]').style.color = "#ff0000";
				}	
				Vezife_Adlari_Ad.style.outline = "none";
				Vezife_Adlari_Ad.style.border = "2px solid #ff0000";
				Vezife_Adlari_Ad.style.color = "#ff0000";
				Vezife_Adlari_Ad.focus();
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə adı boş ola bilməz!";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}		else	if(cavab=="error_2001") {
				var Vezife_Adlari_Ad = document.getElementById("Vezife_Adlari_Ad");
				if (document.querySelector('[for="Vezife_Adlari_Ad"]')) {
					document.querySelector('[for="Vezife_Adlari_Ad"]').style.color = "#ff0000";
				}	
				Vezife_Adlari_Ad.style.outline = "none";
				Vezife_Adlari_Ad.style.border = "2px solid #ff0000";
				Vezife_Adlari_Ad.style.color = "#ff0000";
				Vezife_Adlari_Ad.focus();
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə adı bazada var!";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else	if(cavab=="error_2002") {
				var Vezife_Adlari_Sira = document.getElementById("Vezife_Adlari_Sira");
				if (document.querySelector('[for="Vezife_Adlari_Sira"]')) {
					document.querySelector('[for="Vezife_Adlari_Sira"]').style.color = "#ff0000";
				}	
				Vezife_Adlari_Sira.style.outline = "none";
				Vezife_Adlari_Sira.style.border = "2px solid #ff0000";
				Vezife_Adlari_Sira.style.color = "#ff0000";
				Vezife_Adlari_Sira.focus();
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə sıra nömrəsi boş ola bilməz!";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else	if(cavab=="error_2003") {
				var Vezife_Adlari_Sira = document.getElementById("Vezife_Adlari_Sira");
				if (document.querySelector('[for="Vezife_Adlari_Sira"]')) {
					document.querySelector('[for="Vezife_Adlari_Sira"]').style.color = "#ff0000";
				}	
				Vezife_Adlari_Sira.style.outline = "none";
				Vezife_Adlari_Sira.style.border = "2px solid #ff0000";
				Vezife_Adlari_Sira.style.color = "#ff0000";
				Vezife_Adlari_Sira.focus();
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə sıra nömrəsi bazada var!";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if(cavab=="error_2004"){	
				Ugursuz_Islemleri("Adminstratorla Əlaq Saxlayın. Birinci Əməliyyat Uğursuz");
			}
			else if(cavab=="error_2005"){	
				Ugursuz_Islemleri("Adminstratorla Əlaq Saxlayın. İkinci Əməliyyat Uğursuz");
			}else{
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
			}
		}
	}
}
function VezifeAdlariAdDuzelis(id) {
	var Vezife_Adlari_Ad=document.getElementById(id).value;
	var parcala=id.split("_");
	var deyer = {Vezife_Adlari_Ad:Vezife_Adlari_Ad,
		Vezife_Adlari_Id:parcala[1]
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "VezifeAdlari/Duzelis_Vezife_Adi_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="1304") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yenilənmə Uğurlu</span>`;
			}
			else	if(cavab=="error_3004") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.(İkinci əməliyyat uğursuz. Admistatorla əlaqə saxla)</span>`;
			}

			else	if(cavab=="error_3003") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.(Birinci əməliyyat uğursuz. Admistatorla əlaqə saxla)</span>`;
			}

			else	if(cavab=="error_3002") {
				document.getElementById("cavabid").innerHTML="";

			}


			else	if(cavab=="error_3001") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.Vəzifə adı bazada var</span>`;
			}

			else	if(cavab=="error_3000") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.Vəzifə adı boş ola bilməz</span>`;
			}
		}
	}
}
/*
function CavabAlaniniBoslat() {
	document.getElementById("cavabid").innerHTML="";
}

setInterval(CavabAlaniniBoslat, 60000);

*/



function VezifeAdlariSiraDuzelis(id) {
	var Vezife_Adlari_Sira=document.getElementById(id).value;
	var parcala=id.split("_");
	var deyer = {Vezife_Adlari_Sira:Vezife_Adlari_Sira,
		Vezife_Adlari_Id:parcala[1]
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "VezifeAdlari/Duzelis_Vezife_Adi_Sira_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			if(cavab=="1304") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yenilənmə Uğurlu</span>`;
			}
			else	if(cavab=="error_3004") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.(İkinci əməliyyat uğursuz. Admistatorla əlaqə saxla)</span>`;
			}

			else	if(cavab=="error_3003") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.(Birinci əməliyyat uğursuz. Admistatorla əlaqə saxla)</span>`;
			}

			else	if(cavab=="error_3002") {
				document.getElementById("cavabid").innerHTML="";

			}


			else	if(cavab=="error_3001") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.Bu sira bazada var</span>`;
			}

			else	if(cavab=="error_3000") {
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Yenilənmə Uğursuz.Sira Boş ola bilməz</span>`;
			}
			else{
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
			}
		}
	}
}

function VezifeAdlariDurumKontrol(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "VezifeAdlari/Vezife_Adlari_Durm_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + parcala[1]);
}

function SilYoxlanis(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Vəzifə adını silirsiz.</b>Bunu təsdiq etsəniz vəzifə adı bazadan silinəcək. Ona bağlı bütün məlumatlar silinəcək";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Vezife_Adi_Sil(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}


function Vezife_Adi_Sil(id) {
	var xhttp = new XMLHttpRequest();
	console.log(xhttp);
	xhttp.open("POST", "VezifeAdlari/Vezife_Adlari_Sil_Islemleri.php", true);
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







