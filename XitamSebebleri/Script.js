document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Xitam səbəbləri";


function modalici(cavab){
	document.getElementById("modalformalaniici").innerHTML = cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
	document.getElementById("yuklemealanikapsayici").style.display = "none"
}

function Modal_Ici_None(){
	document.getElementById("modalformalaniici").innerHTML = "";
	document.getElementById("Modal").style.display = "none";
	document.getElementById("ModalAlani").style.display = "none";  
}

function Tesdiq_Modali_None(){
	document.getElementById("SilKaratmaAlani").style.display = "none";
	document.getElementById("SilModalAlani").style.display = "none";
	document.getElementById("SilModalMetinAlani").innerHTML = "";
	document.getElementById("SilIslemiOnayButonu").href = "";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none"; 
}

function Tesdiq_Modali_Block(deyerbir,deyeriki){
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = deyerbir;
	document.getElementById("SilIslemiOnayButonu").href = deyeriki;
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function SagVeSolBosluklariSIl(deyer){
	InputIcerikDeyeri=document.getElementById(deyer);
	var Yoxlabir = InputIcerikDeyeri.value;		
	var Yoxla=Yoxlabir.trim();	
	InputIcerikDeyeri.value = Yoxla;
}

function MetinAlaniYazildi(deyer) {
	InputIcerikDeyeri=document.getElementById(deyer);
	if (InputIcerikDeyeri.value.length > InputIcerikDeyeri.maxLength) 
		InputIcerikDeyeri.value = InputIcerikDeyeri.value.slice(0, InputIcerikDeyeri.maxLength)
	var InputLabelMetni=deyer+"_Metni";
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


function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "XitamSebebleri/Yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			modalici(cavab);	
			TarixFormati();
			$(".js-example-placeholder-single").select2({
				placeholder: "Secin",
				allowClear: true
			});
		}
	}	
}



function	YeniFormKontrol(){
	var xitam_sebebleri_ad = document.getElementById("xitam_sebebleri_ad"); 
	var xitam_sebebleri_kisa_ad = document.getElementById("xitam_sebebleri_kisa_ad"); 

	if(xitam_sebebleri_ad.value === '') {
		error(xitam_sebebleri_ad);
		return;
	}
	if(xitam_sebebleri_kisa_ad.value === '') {
		error(xitam_sebebleri_kisa_ad);
		return;
	}	
	var deyerbir="Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:YeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function YeniForm(){
	var xitam_sebebleri_ad = document.getElementById("xitam_sebebleri_ad"); 
	var xitam_sebebleri_kisa_ad = document.getElementById("xitam_sebebleri_kisa_ad"); 
	if(xitam_sebebleri_ad.value === '') {
		error(xitam_sebebleri_ad);
		return;
	}
	if(xitam_sebebleri_kisa_ad.value === '') {
		error(xitam_sebebleri_kisa_ad);
		return;
	}	
	var deyer = {
		xitam_sebebleri_ad:xitam_sebebleri_ad.value,
		xitam_sebebleri_kisa_ad:xitam_sebebleri_kisa_ad.value
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "XitamSebebleri/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("errorcavabi").innerHTML=cavab;
			var status=document.getElementById("status").value;
			var statusiki=document.getElementById("statusiki").value;
			var message=document.getElementById("message").value;
			if (status=="error") {
				Tesdiq_Modali_None()
				statuserror(statusiki);			
				document.getElementById("errorcavabi").innerHTML=message;
			}else{
				Tesdiq_Modali_None();	
				Modal_Ici_None();	
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				document.getElementById("cavabid").innerHTML=message;
			}
		}
	}
}



function Sil(IDDegeri) {
	var deyer=IDDegeri.split("_");
	var deyerbir="<b>Silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
	var deyeriki="javascript:Sil_Tesdiq(" + deyer[1] + ")";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function Sil_Tesdiq(id) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "XitamSebebleri/Sil.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("cavabid").innerHTML=cavab;
			var status=document.getElementById("status").value;
			var message=document.getElementById("message").value;
			if (status=="error") {
				Tesdiq_Modali_None()	
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=message;
			}else{
				Tesdiq_Modali_None();	
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				document.getElementById("cavabid").innerHTML=message;
			}
		}
	}
}


function Duzeli(id) {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "XitamSebebleri/Duzenle.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+id);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			modalici(cavab);	
			TarixFormati();
			$(".js-example-placeholder-single").select2({
				placeholder: "Secin",
				allowClear: true
			});
		}
	}	
}


function	DuzenleFormKontrol(){
	var xitam_sebebleri_id = document.getElementById("xitam_sebebleri_id"); 
	var xitam_sebebleri_ad = document.getElementById("xitam_sebebleri_ad"); 
	var xitam_sebebleri_kisa_ad = document.getElementById("xitam_sebebleri_kisa_ad"); 
	if(xitam_sebebleri_id.value === '') {
		error(xitam_sebebleri_id);
		return;
	}

	if(xitam_sebebleri_ad.value === '') {
		error(xitam_sebebleri_ad);
		return;
	}
	if(xitam_sebebleri_kisa_ad.value === '') {
		error(xitam_sebebleri_kisa_ad);
		return;
	}	
	var deyerbir="Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:DuzenleForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function DuzenleForm(){
	var xitam_sebebleri_id = document.getElementById("xitam_sebebleri_id"); 
	var xitam_sebebleri_ad = document.getElementById("xitam_sebebleri_ad"); 
	var xitam_sebebleri_kisa_ad = document.getElementById("xitam_sebebleri_kisa_ad"); 
	if(xitam_sebebleri_id.value === '') {
		error(xitam_sebebleri_id);
		return;
	}

	if(xitam_sebebleri_kisa_ad.value === '') {
		error(xitam_sebebleri_kisa_ad);
		return;
	}	
	var deyer = {
		xitam_sebebleri_id:xitam_sebebleri_id.value,
		xitam_sebebleri_ad:xitam_sebebleri_ad.value,
		xitam_sebebleri_kisa_ad:xitam_sebebleri_kisa_ad.value
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "XitamSebebleri/Duzenle_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("errorcavabi").innerHTML=cavab;
			var status=document.getElementById("status").value;
			var statusiki=document.getElementById("statusiki").value;
			var message=document.getElementById("message").value;
			if (status=="error") {
				Tesdiq_Modali_None()
				statuserror(statusiki);			
				document.getElementById("errorcavabi").innerHTML=message;
			}else{
				Tesdiq_Modali_None();	
				Modal_Ici_None();	
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				document.getElementById("cavabid").innerHTML=message;
			}
		}
	}
}