SeyfeAdi("Səlahiyyətlərin verilməsi");

function modalici(cavab){
	document.getElementById("modalformalaniici").innerHTML = cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
	document.getElementById("yuklemealanikapsayici").style.display = "none"
}


function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IseQebulEmri/Yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			document.getElementById("sec").innerHTML="";
			document.getElementById("sec").innerHTML=cavab;
			TarixFormati();

			document.getElementById("yenibut").removeAttribute("onclick");
			document.getElementById("yenibut").setAttribute("disabled", "disabled");
			document.getElementById("imtina").removeAttribute("disabled");
			document.getElementById("imtina").setAttribute("onclick", "YeniImtina()");
			document.getElementById("yaddas").removeAttribute("disabled");
			document.getElementById("yaddas").setAttribute("onclick", "Yaddas()");

		}
	}	
}

function	Axtar(){
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var veri= $("#axtarisadsoyadataadi").serialize();
	$.ajax({
		type:"post",
		url:"SelahiyetlerinVerilmesi/Axtaris.php",
		data:veri,
		success:function(sonuc){
			$("#icerik").html((sonuc));
			document.getElementById("yuklemealanikapsayici").style.display = "none";		
		}
	});
}

function	Sec(id){
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "SelahiyetlerinVerilmesi/Selahiyyet.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + parcala[1]);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("selahiyyetalani").innerHTML="";
			document.getElementById("selahiyyetalani").innerHTML=cavab;

		}
	}
}

function	DurumKontrol(id){
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "SelahiyetlerinVerilmesi/Selahiyyt_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
}
