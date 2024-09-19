function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Vezife/Yeni.php", true);
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

function VezifePuluYazildi(deyer) {
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
		var YoxlanisNeticesi = Yoxla.replace(/[^0-9,.]/g,"");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}


function VezifeUcunSobeTelebEt(id){
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Vezife/Yeni_Vezife_Ucun_Sobe_Teleb_Et.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Idare_Id="+id);	
	xhttp.onreadystatechange = function () {
		document.getElementById("yuklemealanikapsayici").style.display = "none";
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("YeniVezifeSobe").innerHTML = " ";
			document.getElementById("YeniVezifeSobe").innerHTML = this.responseText;
		}
	}
}


function FormKontrolYoxlanis() {
	var Zabit_Mulu;
	var AlaBileceyiRutbe=document.getElementById("AlaBileceyiRutbe");
	var Vezifenin_Novu=document.getElementById("Vezifenin_Novu");
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Id=document.getElementById("Sobe_Id");
	var Vezife_Adlari_Id=document.getElementById("Vezife_Adlari_Id");
	var Vezife_Pulu=document.getElementById("Vezife_Pulu");
	var Statdan_Kenar=document.getElementById("Statdan_Kenar");
	var Stat_Daxili=document.getElementById("Stat_Daxili");
	var Zabit=document.getElementById("Zabit");
	var Mulku=document.getElementById("Mulku");
	var Esas_Mezuniyyeti=document.getElementById("Esas_Mezuniyyeti");

	if(Vezifenin_Novu.value === '') {
		error(Vezifenin_Novu);
		return;
	}
	if(AlaBileceyiRutbe.value === '') {
		error(AlaBileceyiRutbe);
		return;
	}



	if (Mulku.checked === true) {
		Zabit_Mulu=1;
	}else{
		Zabit_Mulu=0;
	}

	if (Zabit.checked === true) {
		Zabit_Mulu=0;
	}else{
		Zabit_Mulu=1;
	}


	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Id.value === '') {
		error(Sobe_Id);
		return;
	}

	if(Vezife_Adlari_Id.value === '') {
		error(Vezife_Adlari_Id);
		return;
	}

	if(Vezife_Pulu.value < 0) {
		error(Vezife_Pulu);
		return;
	}
	if(Esas_Mezuniyyeti.value <= 0) {
		error(Esas_Mezuniyyeti);
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
	
	var Zabit_Mulu;
	var Vezifenin_Novu=document.getElementById("Vezifenin_Novu");
	var AlaBileceyiRutbe=document.getElementById("AlaBileceyiRutbe");
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Id=document.getElementById("Sobe_Id");
	var Vezife_Adlari_Id=document.getElementById("Vezife_Adlari_Id");
	var Vezife_Pulu=document.getElementById("Vezife_Pulu");
	var Statdan_Kenar=document.getElementById("Statdan_Kenar");
	var Stat_Daxili=document.getElementById("Stat_Daxili");
	var Zabit=document.getElementById("Zabit");
	var Mulku=document.getElementById("Mulku");
	var Esas_Mezuniyyeti=document.getElementById("Esas_Mezuniyyeti");

	if(Vezifenin_Novu.value === '') {
		error(Vezifenin_Novu);
		return;
	}
	if(AlaBileceyiRutbe.value === '') {
		error(AlaBileceyiRutbe);
		return;
	}




	if (Mulku.checked === true) {
		Zabit_Mulu=1;
	}else{
		Zabit_Mulu=0;
	}

	if (Zabit.checked === true) {
		Zabit_Mulu=0;
	}else{
		Zabit_Mulu=1;
	}
	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Id.value === '') {
		error(Sobe_Id);
		return;
	}

	if(Vezife_Adlari_Id.value === '') {
		error(Vezife_Adlari_Id);
		return;
	}

	if(Vezife_Pulu.value < 0) {
		error(Vezife_Pulu);
		return;
	}
	if(Esas_Mezuniyyeti.value <= 0) {
		error(Esas_Mezuniyyeti);
		return;
	}

	var Idare_Id_deyer=Idare_Id.value;
	var Sobe_Id_deyer=Sobe_Id.value;
	var Vezife_Adlari_Id_deyer=Vezife_Adlari_Id.value;
	var Vezife_Pulu_deyer=Vezife_Pulu.value;
	var deyer = {
		Idare_Id:Idare_Id_deyer,
		Sobe_Id:Sobe_Id_deyer,
		Vezife_Adlari_Id:Vezife_Adlari_Id_deyer,
		Vezife_Pulu:Vezife_Pulu_deyer,
		Vezifenin_Novu:Vezifenin_Novu.value,
		AlaBileceyiRutbe:AlaBileceyiRutbe.value,
		Esas_Mezuniyyeti:Esas_Mezuniyyeti.value,
		Zabit_Mulu:Zabit_Mulu,
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Vezife/Yeni_Islemleri.php", true);
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
				errorcavab(Idare_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu idarədə xəta";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1003") {
				errorcavab(Sobe_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu şöbəni secin";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1004") {
				errorcavab(Sobe_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu şöbə xəta";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1005") {
				errorcavab(Vezife_Adlari_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə secin";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1006") {
				errorcavab(Vezife_Adlari_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə xətası";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1007") {
				errorcavab(Vezife_Pulu);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vezivə pulunu yazın";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1008") {
				errorcavab(Statdan_Kenar);
				errorcavab(Stat_Daxili);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Ştat Daxili və ya Ştandan Kənar biri secilməlidir.";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1009") {
				errorcavab(Zabit);
				errorcavab(Mulku);				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Zabit və ya Mülkü biri secilməlidir.";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1010") {
				errorcavab(Statdan_Kenar);
				errorcavab(Stat_Daxili);
				errorcavab(Zabit);
				errorcavab(Mulku);
				errorcavab(Idare_Id);
				errorcavab(Sobe_Id);
				errorcavab(Vezife_Adlari_Id);
				errorcavab(Vezife_Pulu);		
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxla(Birinci əməliyyat uğursuz).";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1011") {
				errorcavab(Statdan_Kenar);
				errorcavab(Stat_Daxili);
				errorcavab(Zabit);
				errorcavab(Mulku);
				errorcavab(Idare_Id);
				errorcavab(Sobe_Id);
				errorcavab(Vezife_Adlari_Id);
				errorcavab(Vezife_Pulu);		
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxla(İkinci əməliyyat uğursuz).";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1012") {
				errorcavab(AlaBileceyiRutbe);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Ala biləcəyi rütbə";
				document.getElementById("errorcavabi").style.display = "block";
				return;
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
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yeni Vəzifə Yaradıldı</span>`;
				}
			}
		}
	}
}

function DurumKontrol(id) {
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Vezife/Durum_Kontrol.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
}

function Duzelis(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Vezife/Duzelis.php", true);
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


function DuzelisFormKontrolYoxlanis() {

	var Zabit_Mulu;
	var Vezifenin_Novu=document.getElementById("Vezifenin_Novu");
	var AlaBileceyiRutbe=document.getElementById("AlaBileceyiRutbe");
	var Vezife_Id=document.getElementById("Vezife_Id");
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Id=document.getElementById("Sobe_Id");
	var Vezife_Adlari_Id=document.getElementById("Vezife_Adlari_Id");
	var Vezife_Pulu=document.getElementById("Vezife_Pulu");
	var Statdan_Kenar=document.getElementById("Statdan_Kenar");
	var Stat_Daxili=document.getElementById("Stat_Daxili");
	var Zabit=document.getElementById("Zabit");
	var Mulku=document.getElementById("Mulku");
	var Sira_No=document.getElementById("Sira_No");
	var Esas_Mezuniyyeti=document.getElementById("Esas_Mezuniyyeti");


	if(Vezifenin_Novu.value === '') {
		error(Vezifenin_Novu);
		return;
	}
	if(AlaBileceyiRutbe.value === '') {
		error(AlaBileceyiRutbe);
		return;
	}



	if (Mulku.checked === true) {
		Zabit_Mulu=1;
	}else{
		Zabit_Mulu=0;
	}

	if (Zabit.checked === true) {
		Zabit_Mulu=0;
	}else{
		Zabit_Mulu=1;
	}

	if(Vezife_Id.value === '') {
		error(Vezife_Id);
		return;
	}
	if(Sira_No.value === '') {
		error(Sira_No);
		return;
	}





	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Id.value === '') {
		error(Sobe_Id);
		return;
	}

	if(Vezife_Adlari_Id.value === '') {
		error(Vezife_Adlari_Id);
		return;
	}
	if(Vezife_Pulu.value < 0) {
		error(Vezife_Pulu);
		return;
	}

	if(Esas_Mezuniyyeti.value <= 0) {
		error(Esas_Mezuniyyeti);
		return;
	}

	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:DuzelisTesdiq()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}


function DuzelisTesdiq() {
	var Vezifenin_Novu=document.getElementById("Vezifenin_Novu");
	var AlaBileceyiRutbe=document.getElementById("AlaBileceyiRutbe");
	var Zabit_Mulu;
	var Vezife_Id=document.getElementById("Vezife_Id");
	var Idare_Id=document.getElementById("Idare_Id");
	var Sobe_Id=document.getElementById("Sobe_Id");
	var Vezife_Adlari_Id=document.getElementById("Vezife_Adlari_Id");
	var Vezife_Pulu=document.getElementById("Vezife_Pulu");
	var Statdan_Kenar=document.getElementById("Statdan_Kenar");
	var Stat_Daxili=document.getElementById("Stat_Daxili");
	var Zabit=document.getElementById("Zabit");
	var Mulku=document.getElementById("Mulku");
	var Sira_No=document.getElementById("Sira_No");
	var Esas_Mezuniyyeti=document.getElementById("Esas_Mezuniyyeti");



	if(Vezifenin_Novu.value === '') {
		error(Vezifenin_Novu);
		return;
	}
	if(AlaBileceyiRutbe.value === '') {
		error(AlaBileceyiRutbe);
		return;
	}


	if (Mulku.checked === true) {
		Zabit_Mulu=1;
	}else{
		Zabit_Mulu=0;
	}

	if (Zabit.checked === true) {
		Zabit_Mulu=0;
	}else{
		Zabit_Mulu=1;
	}

	if(Vezife_Id.value === '') {
		error(Vezife_Id);
		return;
	}
	if(Sira_No.value === '') {
		error(Sira_No);
		return;
	}




	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}
	if(Sobe_Id.value === '') {
		error(Sobe_Id);
		return;
	}

	if(Vezife_Adlari_Id.value === '') {
		error(Vezife_Adlari_Id);
		return;
	}

	if(Vezife_Pulu.value < 0) {
		error(Vezife_Pulu);
		return;
	}
		if(Esas_Mezuniyyeti.value <= 0) {
		error(Esas_Mezuniyyeti);
		return;
	}

	var Sira_No_deyer=Sira_No.value;



	var Vezife_Id_deyer=Vezife_Id.value;
	var Idare_Id_deyer=Idare_Id.value;
	var Sobe_Id_deyer=Sobe_Id.value;
	var Vezife_Adlari_Id_deyer=Vezife_Adlari_Id.value;
	var Vezife_Pulu_deyer=Vezife_Pulu.value;
	var deyer = {
		Sira_No:Sira_No_deyer,
		Vezife_Id:Vezife_Id_deyer,

		Idare_Id:Idare_Id_deyer,
		Sobe_Id:Sobe_Id_deyer,
		Vezife_Adlari_Id:Vezife_Adlari_Id_deyer,
		Vezife_Pulu:Vezife_Pulu_deyer,
		Vezifenin_Novu:Vezifenin_Novu.value,
		AlaBileceyiRutbe:AlaBileceyiRutbe.value,
		Esas_Mezuniyyeti:Esas_Mezuniyyeti.value,
		Zabit_Mulu:Zabit_Mulu,
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Vezife/Duzelis_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if (cavab=="error_1001") {
				errorcavab(Statdan_Kenar);
				errorcavab(Stat_Daxili);
				errorcavab(Zabit);
				errorcavab(Mulku);
				errorcavab(Idare_Id);
				errorcavab(Sobe_Id);
				errorcavab(Vezife_Adlari_Id);
				errorcavab(Vezife_Pulu);		
				errorcavab(Sira_No);		


				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxla(Id sehv).";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1002") {				
				errorcavab(Statdan_Kenar);
				errorcavab(Stat_Daxili);
				errorcavab(Zabit);
				errorcavab(Mulku);
				errorcavab(Idare_Id);
				errorcavab(Sobe_Id);
				errorcavab(Vezife_Adlari_Id);
				errorcavab(Vezife_Pulu);		
				errorcavab(Sira_No);		


				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisi ilə əlaqə saxla(ID Bazada tapılmadı).";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1003") {	
				errorcavab(Sira_No);
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
			else if (cavab=="error_1004") {
				errorcavab(Sira_No);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sıra nömrəsi mövcutdur";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1009") {
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
			else if (cavab=="error_1010") {
				errorcavab(Idare_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu idarə xəta";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1011") {
				errorcavab(Sobe_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu şöbəni secin";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1012") {
				errorcavab(Sobe_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Tabe olduğu şöbəni xeta";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1013") {
				errorcavab(Vezife_Adlari_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə adını secin";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1014") {
				errorcavab(Vezife_Adlari_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə adını secim xeta";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1015") {
				errorcavab(Vezife_Adlari_Id);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifə pulu boş ola bilməz.";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}

			else if (cavab=="error_1016") {
				errorcavab(Vezifenin_Novu);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Vəzifənin növü";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1017") {
				errorcavab(Zabit);
				errorcavab(Mulku);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Zabit və ya Mülkü secilməlidir.";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1018") {
				errorcavab(Statdan_Kenar);
				errorcavab(Stat_Daxili);
				errorcavab(Zabit);
				errorcavab(Mulku);
				errorcavab(Idare_Id);
				errorcavab(Sobe_Id);
				errorcavab(Vezife_Adlari_Id);
				errorcavab(Vezife_Pulu);		
				errorcavab(Sira_No);		


				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisinə məlumat verin (Birinici əməliyyat uğursuz).";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1019") {
				errorcavab(Statdan_Kenar);
				errorcavab(Stat_Daxili);
				errorcavab(Zabit);
				errorcavab(Mulku);
				errorcavab(Idare_Id);
				errorcavab(Sobe_Id);
				errorcavab(Vezife_Adlari_Id);
				errorcavab(Vezife_Pulu);		
				errorcavab(Sira_No);		

				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Sistem idarəcisinə məlumat verin (İkinci əməliyyat uğursuz).";
				document.getElementById("errorcavabi").style.display = "block";
				return;
			}
			else if (cavab=="error_1016") {
				errorcavab(AlaBileceyiRutbe);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML="Ala biləcəyi rütbə";
				document.getElementById("errorcavabi").style.display = "block";
				return;
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

			}

		}
	}
}

function SilYoxlanis(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Vəzifəni silirsiz .</b>Bunu təsdiq etsəniz məlumat bazadan silinəcək və ona bağlı bütün məlumatlar silinəcək";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Vezife/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if(cavab=="error_1001") {				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğursuz. Id Tapılmad</span>`;
			}
			else if(cavab=="error_1002") {				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğursuz.</span>`;
			}	
			else if(cavab=="error_1003") {				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğurlu. Sitem idarəcisinə məlumat verin (İnsert Uğursuz)</span>`;
			}
			else{
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