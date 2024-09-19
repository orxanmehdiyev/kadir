document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Tabelin Hazırlanması";



function SelectAlaniSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";
}


function TabelHazirla(){
	var TabelAy = document.getElementById("TabelAy"); 
	var TabelIl = document.getElementById("TabelIl"); 
	var Idare_Id = document.getElementById("Idare_Id");
	var heyyet = document.getElementById("heyyet");
	if(TabelAy.value === '') {
		error(TabelAy);
		return;
	}
	if(TabelIl.value === '') {
		error(TabelIl);
		return;
	}
	if(Idare_Id.value === '') {
		error(Idare_Id);
		return;
	}	

	if(heyyet.value === '') {
		error(heyyet);
		return;
	}

	var deyer = {
		TabelAy:TabelAy.value,
		TabelIl:TabelIl.value,
		Idare_Id:Idare_Id.value,
		heyyet:heyyet.value,
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Tabel_Islenmesi/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("icerik").innerHTML="";
			document.getElementById("icerik").innerHTML=cavab;	

			var userid=document.getElementById("Idare_Id").value;
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "Tabel_Islenmesi/Imzalayn_Melumat_Telebi.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("Deyer=" + userid);
			xhttp.onreadystatechange = function (deyer) {
				if (this.readyState == 4 && this.status == 200) {
					var cavab=this.responseText.trim();
					document.getElementById("imzalayen").innerHTML="";		
					document.getElementById("imzalayen").innerHTML=cavab;		
				}
			}	
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "Tabel_Islenmesi/Tesdiq_Eden_Melumat_Telebi.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("Deyer=" + userid);
			xhttp.onreadystatechange = function (deyer) {
				if (this.readyState == 4 && this.status == 200) {
					var cavab=this.responseText.trim();
					document.getElementById("tesdiqeden").innerHTML="";		
					document.getElementById("tesdiqeden").innerHTML=cavab;		
				}
			}


		}
	}
}

function IcraciYerineYaz(id){
	var userid=document.getElementById(id).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Tabel_Islenmesi/Icraci_Melumat_Telebi.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + userid);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			data=JSON.parse(cavab);
			document.getElementById("icracivezifesiadi").innerHTML="";		
			document.getElementById("icracivezifesiadi").innerHTML=data.adisoyadi;		
		}
	}
}

function TesdiqYerineYaz(id){
	var userid=document.getElementById(id).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Tabel_Islenmesi/Tesdiq_Melumat_Telebi.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + userid);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			data=JSON.parse(cavab);
			document.getElementById("tesdiqedenvezife").innerHTML="";		
			document.getElementById("tesdiqedenvezife").innerHTML=data.Vezifesi;	

			document.getElementById("tesdiqedenadi").innerHTML="";		
			document.getElementById("tesdiqedenadi").innerHTML=data.adisoyadi;		
		}
	}
}

function ImzalayanTelebEt(id){
	document.getElementById("icerik").innerHTML="";
	var userid=document.getElementById(id).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Tabel_Islenmesi/Imzalayn_Melumat_Telebi.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + userid);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("imzalayen").innerHTML="";		
			document.getElementById("imzalayen").innerHTML=cavab;		
		}
	}
}

function Tesdiqedentelebet(id){
	document.getElementById("icerik").innerHTML="";
	var userid=document.getElementById(id).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Tabel_Islenmesi/Tesdiq_Eden_Melumat_Telebi.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + userid);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("tesdiqeden").innerHTML="";		
			document.getElementById("tesdiqeden").innerHTML=cavab;		
		}
	}
}

function TabelCapET(){
	var imzalayen = document.getElementById("imzalayen"); 
	var tesdiqeden = document.getElementById("tesdiqeden"); 

	if(imzalayen.value === '') {
		error(imzalayen);
		return;
	}
	if(tesdiqeden.value === '') {
		error(tesdiqeden);
		return;
	}
	window.print();
}