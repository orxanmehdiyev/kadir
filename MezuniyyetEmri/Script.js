document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Məzuniyyət Əmrləri";

function CedveliCagir(icerik){
	var dataTables = $('#'+icerik).DataTable({
		"bFilter" : false,               
		"bLengthChange": true,
		"lengthMenu": [[10,20,30,40,50,60,70,80,90, -1], [10,20,30,40,50,60,70,80,90, "Hamısı"]],
		"pageLength":10,
    "order": [], //Initial no order.
    "aaSorting": [],
    "searching": false,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "bAutoWidth": false,
    "responsive": true,
    'processing': true,
    "fixedHeader": true,   
    buttons: [ ],
pagingType: 'numbers',
    dom: '<"float-left"B><"float-right"f>rt<"row"<"col-6"l><"d-none"i><"col-sm-6"p>>',
});
}

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




function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetEmri/Yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			modalici(cavab);			
			$(".js-example-placeholder-single").select2({
				placeholder: "Secin",
				allowClear: true
			});
		}
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

function SelectAlaniSecildi(deyer) {
	if (document.querySelector('[for='+deyer+']')) {
		document.querySelector('[for='+deyer+']').style.color  = "#2A3F54";
	}
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";
}
function SelectIkiAlaniSecildi(deyer) {
	var ID=document.getElementById(deyer).value;
	var xhttp = new XMLHttpRequest();

	xhttp.open("POST", "MezuniyyetEmri/User_Melumatlari.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("ID=" + ID);
	xhttp.onreadystatechange = function (deye) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			data=JSON.parse(cavab);
			document.getElementById("Idare_Ad").value=data.Idare_Ad;
			document.getElementById("Sobe_Ad").value=data.Sobe_Ad;
			document.getElementById("Vezife_Ad").value=data.Vezife_Ad;
			var x=document.getElementById(deyer).nextElementSibling;
			var y=x.getElementsByTagName("span")[0];
			var e=y.getElementsByTagName("span")[0];
			e.style.border = "2px solid #2A3F54";					
		}
	}	
}


function TarixAlaniYazildi(deyer) {
	SagVeSolBosluklariSIl(deyer);
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
		var YoxlanisNeticesi = Yoxla.replace(/[^0-9.,\/\-()\s+]/g,"");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}

function MetinAlaniYazildi(deyer) {
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

function ReqemAlaniYazildi(deyer) {
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


function	Xidmetilihesabla(id){
	var ID = document.getElementById("ID"); 
	var Mezuniyyet_Novleri_ID = document.getElementById("Mezuniyyet_Novleri_ID"); 
	var Tedbiq_Edildiyi_Tarix = document.getElementById("Tedbiq_Edildiyi_Tarix"); 

	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}


	if(Mezuniyyet_Novleri_ID.value === '') {
		error(Mezuniyyet_Novleri_ID);
		return;
	}
	if(Tedbiq_Edildiyi_Tarix.value === '') {
		error(Tedbiq_Edildiyi_Tarix);
		return;
	}
	var deyer = {
		ID:document.getElementById("ID").value,
		Mezuniyyet_Novleri_ID:document.getElementById("Mezuniyyet_Novleri_ID").value,
		Tedbiq_Edildiyi_Tarix:document.getElementById("Tedbiq_Edildiyi_Tarix").value
	};

	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	console.log(xhttp);
	xhttp.open("POST", "MezuniyyetEmri/Xidmet_Ili_Hesabla.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			data=JSON.parse(cavab);
			if (data.status=="succes") {
				document.getElementById("Mezuniyyet_Gun").value=data.mezuniyyetgunu;
				document.getElementById("Mezuniyyet_Gun").removeAttribute("readonly");
				document.getElementById("Mezuniyyet_Qaliq_Gun").value=data.Mezuniyyet_Qaliq_Gun;
				document.getElementById("Xidmet_Ili").value=data.Xidmet_Ili;
				document.getElementById("Mezuniyyet_Xidmet_Ili_Baslagic").value=data.Mezuniyyet_Xidmet_Ili_Baslagic;
				document.getElementById("Mezuniyyet_Xidmet_Ili_Son").value=data.Mezuniyyet_Xidmet_Ili_Son;
				document.getElementById("Mezuniyyet_Ise_Cixma_Tarixi").value=data.Mezuniyyet_Ise_Cixma_Tarixi;
				document.getElementById("Mezuniyyet_Bitis_Tarixi").value=data.Mezuniyyet_Bitis_Tarixi;
			}else if(data.status=="error"){
				Xeberdarliq_Modali(data.message);
				
			}
		}
	}
}



function MezuniyyetYeniFormKontrol(){
	var ID = document.getElementById("ID"); 
	var Mezuniyyet_Novleri_ID = document.getElementById("Mezuniyyet_Novleri_ID"); 
	var Tedbiq_Edildiyi_Tarix = document.getElementById("Tedbiq_Edildiyi_Tarix"); 
	var Mezuniyyet_Gun = document.getElementById("Mezuniyyet_Gun"); 
	var Mezuniyyet_Qaliq_Gun = document.getElementById("Mezuniyyet_Qaliq_Gun"); 
	var Xidmet_Ili = document.getElementById("Xidmet_Ili"); 
	var Mezuniyyet_Xidmet_Ili_Baslagic = document.getElementById("Mezuniyyet_Xidmet_Ili_Baslagic"); 
	var Mezuniyyet_Xidmet_Ili_Son = document.getElementById("Mezuniyyet_Xidmet_Ili_Son"); 
	var Mezuniyyet_Bitis_Tarixi = document.getElementById("Mezuniyyet_Bitis_Tarixi"); 
	var Mezuniyyet_Ise_Cixma_Tarixi = document.getElementById("Mezuniyyet_Ise_Cixma_Tarixi"); 
	var Mezuniyyet_Emrinin_Nomresi = document.getElementById("Mezuniyyet_Emrinin_Nomresi"); 
	var Mezuniyyet_Evezi_ID = document.getElementById("Mezuniyyet_Evezi_ID"); 

	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}


	if(Mezuniyyet_Novleri_ID.value === '') {
		error(Mezuniyyet_Novleri_ID);
		return;
	}
	if(Tedbiq_Edildiyi_Tarix.value === '') {
		error(Tedbiq_Edildiyi_Tarix);
		return;
	}

	if(Mezuniyyet_Gun.value === '') {
		error(Mezuniyyet_Gun);
		return;
	}

	if(Mezuniyyet_Qaliq_Gun.value === '') {
		error(Mezuniyyet_Qaliq_Gun);
		return;
	}

	if(Xidmet_Ili.value === '') {
		error(Xidmet_Ili);
		return;
	}

	if(Mezuniyyet_Xidmet_Ili_Baslagic.value === '') {
		error(Mezuniyyet_Xidmet_Ili_Baslagic);
		return;
	}

	if(Mezuniyyet_Xidmet_Ili_Son.value === '') {
		error(Mezuniyyet_Xidmet_Ili_Son);
		return;
	}
	if(Mezuniyyet_Bitis_Tarixi.value === '') {
		error(Mezuniyyet_Bitis_Tarixi);
		return;
	}

	if(Mezuniyyet_Ise_Cixma_Tarixi.value === '') {
		error(Mezuniyyet_Ise_Cixma_Tarixi);
		return;
	}

	if(Mezuniyyet_Emrinin_Nomresi.value === '') {
		error(Mezuniyyet_Emrinin_Nomresi);
		return;
	}

	var deyerbir="Məlumatın düzgün olduğundan əmin olung. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:MezuniyyetYeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function MezuniyyetYeniForm(){
	var ID = document.getElementById("ID"); 
	var Mezuniyyet_Novleri_ID = document.getElementById("Mezuniyyet_Novleri_ID"); 
	var Tedbiq_Edildiyi_Tarix = document.getElementById("Tedbiq_Edildiyi_Tarix"); 
	var Mezuniyyet_Gun = document.getElementById("Mezuniyyet_Gun"); 
	var Mezuniyyet_Qaliq_Gun = document.getElementById("Mezuniyyet_Qaliq_Gun"); 
	var Xidmet_Ili = document.getElementById("Xidmet_Ili"); 
	var Mezuniyyet_Xidmet_Ili_Son = document.getElementById("Mezuniyyet_Xidmet_Ili_Son"); 
	var Mezuniyyet_Xidmet_Ili_Baslagic = document.getElementById("Mezuniyyet_Xidmet_Ili_Baslagic"); 
	var Mezuniyyet_Bitis_Tarixi = document.getElementById("Mezuniyyet_Bitis_Tarixi"); 
	var Mezuniyyet_Ise_Cixma_Tarixi = document.getElementById("Mezuniyyet_Ise_Cixma_Tarixi"); 
	var Mezuniyyet_Emrinin_Nomresi = document.getElementById("Mezuniyyet_Emrinin_Nomresi"); 
	var Mezuniyyet_Evezi_ID = document.getElementById("Mezuniyyet_Evezi_ID"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Mezuniyyet_Novleri_ID.value === '') {
		error(Mezuniyyet_Novleri_ID);
		return;
	}
	if(Tedbiq_Edildiyi_Tarix.value === '') {
		error(Tedbiq_Edildiyi_Tarix);
		return;
	}
	if(Mezuniyyet_Gun.value === '') {
		error(Mezuniyyet_Gun);
		return;
	}
	if(Mezuniyyet_Qaliq_Gun.value === '') {
		error(Mezuniyyet_Qaliq_Gun);
		return;
	}
	if(Xidmet_Ili.value === '') {
		error(Xidmet_Ili);
		return;
	}
	if(Mezuniyyet_Xidmet_Ili_Baslagic.value === '') {
		error(Mezuniyyet_Xidmet_Ili_Baslagic);
		return;
	}
	if(Mezuniyyet_Xidmet_Ili_Son.value === '') {
		error(Mezuniyyet_Xidmet_Ili_Son);
		return;
	}

	if(Mezuniyyet_Bitis_Tarixi.value === '') {
		error(Mezuniyyet_Bitis_Tarixi);
		return;
	}
	if(Mezuniyyet_Ise_Cixma_Tarixi.value === '') {
		error(Mezuniyyet_Ise_Cixma_Tarixi);
		return;
	}
	if(Mezuniyyet_Emrinin_Nomresi.value === '') {
		error(Mezuniyyet_Emrinin_Nomresi);
		return;
	}

	var deyer = {
		ID:ID.value, 
		Mezuniyyet_Novleri_ID:Mezuniyyet_Novleri_ID.value,   
		Tedbiq_Edildiyi_Tarix:Tedbiq_Edildiyi_Tarix.value,   
		Mezuniyyet_Gun:Mezuniyyet_Gun.value, 
		Mezuniyyet_Emrinin_Nomresi:Mezuniyyet_Emrinin_Nomresi.value, 
		Mezuniyyet_Evezi_ID:Mezuniyyet_Evezi_ID.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	console.log(xhttp);
	xhttp.open("POST", "MezuniyyetEmri/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var data=this.responseText.trim();
			document.getElementById("errorcavabi").innerHTML= data;
			if(document.getElementById("status").value=="error"){
				var message= document.getElementById("message").value;
				var statusiki= document.getElementById("statusiki").value;
				Tesdiq_Modali_None();
				statuserror(statusiki);
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=message;
				return;
			}else if(document.getElementById("status").value=="errorfull"){
				var message= document.getElementById("message").value;  
				Tesdiq_Modali_None();				
				errorcavab(ID);
				errorcavab(Mezuniyyet_Novleri_ID);
				errorcavab(Tedbiq_Edildiyi_Tarix);
				errorcavab(Mezuniyyet_Gun);
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=message;
				return;
			}else if (document.getElementById("status").value=="success") {	
				Tesdiq_Modali_None();  
				Modal_Ici_None()  
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=data; 
				CedveliCagir("dataTable");
				return; 
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
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetEmri/Sil.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var data=this.responseText.trim();    
			Tesdiq_Modali_None();    
			document.getElementById("icerik").innerHTML="";
			document.getElementById("icerik").innerHTML=data; 
			CedveliCagir("dataTable");
			return; 
		}
	}
}



function MelumatTelebEt(id) {
	SelectAlaniSecildi(id);
	var deyer=document.getElementById(id).value;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetEmri/Mezuniyyete_Gore_Melumat_Telebi.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + deyer);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var data=this.responseText.trim();    
			document.getElementById("mezuniyyeticerik").innerHTML="";
			document.getElementById("mezuniyyeticerik").innerHTML=data; 
			TarixFormati();
			$(".js-example-placeholder-single").select2({
				placeholder: "Secin",
				allowClear: true
			});
			return; 
		}
	}
}



function IseCixmaHesab(id) {
	
	var Mezuniyyet_Gun = document.getElementById("Mezuniyyet_Gun"); 
	var Tedbiq_Edildiyi_Tarix = document.getElementById("Tedbiq_Edildiyi_Tarix"); 
	if(Mezuniyyet_Gun.value === '') {
		error(Mezuniyyet_Gun);
		return;
	}
	if(Tedbiq_Edildiyi_Tarix.value === '') {
		error(Tedbiq_Edildiyi_Tarix);
		return;
	}
	var deyer = {
		Mezuniyyet_Gun:Mezuniyyet_Gun.value, 
		Tedbiq_Edildiyi_Tarix:Tedbiq_Edildiyi_Tarix.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "MezuniyyetEmri/Sosial_Mezuniyyet_Ise_Cixama_Hesabla.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();    
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			data=JSON.parse(cavab);
			if (data.status=="succes") {
				document.getElementById("Mezuniyyet_Ise_Cixma_Tarixi").value=data.Mezuniyyet_Ise_Cixma_Tarixi;
				document.getElementById("Mezuniyyet_Bitis_Tarixi").value=data.Mezuniyyet_Bitis_Tarixi;
			}else if(data.status=="error"){
				Xeberdarliq_Modali(data.message);
				errorcavab(Tedbiq_Edildiyi_Tarix);
			}

			return; 
		}
	}
}




function SosialYeniFormKontrol(){
	var ID = document.getElementById("ID"); 
	var Mezuniyyet_Novleri_ID = document.getElementById("Mezuniyyet_Novleri_ID"); 
	var Tedbiq_Edildiyi_Tarix = document.getElementById("Tedbiq_Edildiyi_Tarix"); 
	var Mezuniyyet_Gun = document.getElementById("Mezuniyyet_Gun");	
	var Mezuniyyet_Bitis_Tarixi = document.getElementById("Mezuniyyet_Bitis_Tarixi"); 
	var Mezuniyyet_Ise_Cixma_Tarixi = document.getElementById("Mezuniyyet_Ise_Cixma_Tarixi"); 
	var Mezuniyyet_Emrinin_Nomresi = document.getElementById("Mezuniyyet_Emrinin_Nomresi"); 
	var Mezuniyyet_Evezi_ID = document.getElementById("Mezuniyyet_Evezi_ID"); 

	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}


	if(Mezuniyyet_Novleri_ID.value === '') {
		error(Mezuniyyet_Novleri_ID);
		return;
	}
	if(Tedbiq_Edildiyi_Tarix.value === '') {
		error(Tedbiq_Edildiyi_Tarix);
		return;
	}

	if(Mezuniyyet_Gun.value === '') {
		error(Mezuniyyet_Gun);
		return;
	}



	if(Mezuniyyet_Bitis_Tarixi.value === '') {
		error(Mezuniyyet_Bitis_Tarixi);
		return;
	}

	if(Mezuniyyet_Ise_Cixma_Tarixi.value === '') {
		error(Mezuniyyet_Ise_Cixma_Tarixi);
		return;
	}

	if(Mezuniyyet_Emrinin_Nomresi.value === '') {
		error(Mezuniyyet_Emrinin_Nomresi);
		return;
	}

	var deyerbir="Məlumatın düzgün olduğundan əmin olung. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:SosialYeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function SosialYeniForm(){
	var ID = document.getElementById("ID"); 
	var Mezuniyyet_Novleri_ID = document.getElementById("Mezuniyyet_Novleri_ID"); 
	var Tedbiq_Edildiyi_Tarix = document.getElementById("Tedbiq_Edildiyi_Tarix"); 
	var Mezuniyyet_Gun = document.getElementById("Mezuniyyet_Gun"); 	
	var Mezuniyyet_Bitis_Tarixi = document.getElementById("Mezuniyyet_Bitis_Tarixi"); 
	var Mezuniyyet_Ise_Cixma_Tarixi = document.getElementById("Mezuniyyet_Ise_Cixma_Tarixi"); 
	var Mezuniyyet_Emrinin_Nomresi = document.getElementById("Mezuniyyet_Emrinin_Nomresi"); 
	var Mezuniyyet_Evezi_ID = document.getElementById("Mezuniyyet_Evezi_ID"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Mezuniyyet_Novleri_ID.value === '') {
		error(Mezuniyyet_Novleri_ID);
		return;
	}
	if(Tedbiq_Edildiyi_Tarix.value === '') {
		error(Tedbiq_Edildiyi_Tarix);
		return;
	}
	if(Mezuniyyet_Gun.value === '') {
		error(Mezuniyyet_Gun);
		return;
	}	

	if(Mezuniyyet_Bitis_Tarixi.value === '') {
		error(Mezuniyyet_Bitis_Tarixi);
		return;
	}
	if(Mezuniyyet_Ise_Cixma_Tarixi.value === '') {
		error(Mezuniyyet_Ise_Cixma_Tarixi);
		return;
	}
	if(Mezuniyyet_Emrinin_Nomresi.value === '') {
		error(Mezuniyyet_Emrinin_Nomresi);
		return;
	}

	var deyer = {
		ID:ID.value, 
		Mezuniyyet_Novleri_ID:Mezuniyyet_Novleri_ID.value,   
		Tedbiq_Edildiyi_Tarix:Tedbiq_Edildiyi_Tarix.value,   
		Mezuniyyet_Gun:Mezuniyyet_Gun.value, 
		Mezuniyyet_Emrinin_Nomresi:Mezuniyyet_Emrinin_Nomresi.value, 
		Mezuniyyet_Evezi_ID:Mezuniyyet_Evezi_ID.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	console.log();
	xhttp.open("POST", "MezuniyyetEmri/Sosial_Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var data=this.responseText.trim();
			document.getElementById("errorcavabi").innerHTML= data;
			if(document.getElementById("status").value=="error"){
				var message= document.getElementById("message").value;
				var statusiki= document.getElementById("statusiki").value;
				Tesdiq_Modali_None();
				statuserror(statusiki);
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=message;
				return;
			}else if(document.getElementById("status").value=="errorfull"){
				var message= document.getElementById("message").value;  
				Tesdiq_Modali_None();			
				errorcavab(ID);
				errorcavab(Mezuniyyet_Novleri_ID);
				errorcavab(Tedbiq_Edildiyi_Tarix);
				errorcavab(Mezuniyyet_Gun);
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=message;
				return;
			}else if (document.getElementById("status").value=="success") {	
				Tesdiq_Modali_None();  
				Modal_Ici_None()  
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=data; 
				CedveliCagir("dataTable");
				return; 
			}
		}
	}
}


function SelectUcAlaniSecildi(deyer) {
	var ID=document.getElementById(deyer).value;
	var xhttp = new XMLHttpRequest();

	xhttp.open("POST", "MezuniyyetEmri/Hevale.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("ID=" + ID);
	xhttp.onreadystatechange = function (deye) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			data=JSON.parse(cavab);
			if (data.status=="ok") {			
			}
			document.getElementById("Idare_Ads").value=data.Idare_Ad;
			document.getElementById("Sobe_Ads").value=data.Sobe_Ad;
			document.getElementById("Vezife_Ads").value=data.Vezife_Ad;

		}
	}	
}

