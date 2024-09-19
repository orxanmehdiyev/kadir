document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Ezamiyyə Əmrləri";

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

function ReqemAlaniYazildi(deyer) {	
	SagVeSolBosluklariSIl(deyer);
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

function SelectAlaniSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";
}

function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Ezamiyye/Yeni.php", true);
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


function SelectIkiAlaniSecildi(deyer) {
	var ID=document.getElementById(deyer).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Ezamiyye/Melumat_Telebi.php", true);
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





function	YeniFormKontrol(id){
	var ID = document.getElementById("ID"); 
	var Ezam_Novu = document.getElementById("Ezam_Novu"); 
	var Ezam_Baslangic_Tarixi = document.getElementById("Ezam_Baslangic_Tarixi"); 
	var Ezam_Gun_Sayi = document.getElementById("Ezam_Gun_Sayi"); 
	var Ezam_Olundugu_Yer = document.getElementById("Ezam_Olundugu_Yer"); 
	var Ezam_Emri_No = document.getElementById("Ezam_Emri_No"); 
	var Ezam_Sebebi = document.getElementById("Ezam_Sebebi"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}

	if(Ezam_Novu.value === '') {
		error(Ezam_Novu);
		return;
	}

	if(Ezam_Baslangic_Tarixi.value === '') {
		error(Ezam_Baslangic_Tarixi);
		return;
	}

	if(Ezam_Gun_Sayi.value === '') {
		error(Ezam_Gun_Sayi);
		return;
	}

	if(Ezam_Olundugu_Yer.value === '') {
		error(Ezam_Olundugu_Yer);
		return;
	}

	if(Ezam_Emri_No.value === '') {
		error(Ezam_Emri_No);
		return;
	}
	if(Ezam_Sebebi.value === '') {
		error(Ezam_Sebebi);
		return;
	}
	var deyerbir="Məlumatın düzgün olduğundan əmin olung. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:YeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function YeniForm(){
	var ID = document.getElementById("ID"); 
	var Ezam_Novu = document.getElementById("Ezam_Novu"); 
	var Ezam_Baslangic_Tarixi = document.getElementById("Ezam_Baslangic_Tarixi"); 
	var Ezam_Gun_Sayi = document.getElementById("Ezam_Gun_Sayi"); 
	var Ezam_Olundugu_Yer = document.getElementById("Ezam_Olundugu_Yer"); 
	var Ezam_Emri_No = document.getElementById("Ezam_Emri_No"); 
	var Ezam_Sebebi = document.getElementById("Ezam_Sebebi"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Ezam_Novu.value === '') {
		error(Ezam_Novu);
		return;
	}
	if(Ezam_Baslangic_Tarixi.value === '') {
		error(Ezam_Baslangic_Tarixi);
		return;
	}
	if(Ezam_Gun_Sayi.value === '') {
		error(Ezam_Gun_Sayi);
		return;
	}
	if(Ezam_Olundugu_Yer.value === '') {
		error(Ezam_Olundugu_Yer);
		return;
	}
	if(Ezam_Emri_No.value === '') {
		error(Ezam_Emri_No);
		return;
	}
	if(Ezam_Sebebi.value === '') {
		error(Ezam_Sebebi);
		return;
	}
	var deyer = {
		ID:ID.value,
		Ezam_Novu:Ezam_Novu.value,
		Ezam_Baslangic_Tarixi:Ezam_Baslangic_Tarixi.value,
		Ezam_Gun_Sayi:Ezam_Gun_Sayi.value,
		Ezam_Olundugu_Yer:Ezam_Olundugu_Yer.value,
		Ezam_Sebebi:Ezam_Sebebi.value,
		Ezam_Emri_No:Ezam_Emri_No.value	
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Ezamiyye/Yeni_Islemleri.php", true);
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
			}else if(status=="errorfull"){
				Tesdiq_Modali_None()
				statuserror(ID);
				statuserror(Ezam_Novu);
				statuserror(Ezam_Baslangic_Tarixi);
				statuserror(Ezam_Gun_Sayi);
				statuserror(Ezam_Olundugu_Yer);
				statuserror(Ezam_Emri_No);
			}else{
				Tesdiq_Modali_None();	
				Modal_Ici_None();				
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
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
	xhttp.open("POST", "Ezamiyye/Sil.php", true);
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


function Geri(IDDegeri) {	
	var deyer=IDDegeri.split("_");	
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Ezamiyye/Geri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + deyer[1]);
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

function	GeriFormKontrol(id){
	var Ezamiyye_Emri_Id = document.getElementById("Ezamiyye_Emri_Id"); 
	var Ezamiyye_Geri_Emir_No = document.getElementById("Ezamiyye_Geri_Emir_No"); 
	var Ezam_Geri_Sebeb = document.getElementById("Ezam_Geri_Sebeb");
	var Ezam_geri_Tarixi = document.getElementById("Ezam_geri_Tarixi");
	if(Ezamiyye_Emri_Id.value === '') {
		error(Ezamiyye_Emri_Id);
		return;
	}
	if(Ezamiyye_Geri_Emir_No.value === '') {
		error(Ezamiyye_Geri_Emir_No);
		return;
	}

	if(Ezam_Geri_Sebeb.value === '') {
		error(Ezam_Geri_Sebeb);
		return;
	}
	if(Ezam_geri_Tarixi.value === '') {
		error(Ezam_geri_Tarixi);
		return;
	}
	var deyerbir="Məlumatın düzgün olduğundan əmin olung. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:GeriForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function	GeriFormKontrol(id){
	var Ezamiyye_Emri_Id = document.getElementById("Ezamiyye_Emri_Id"); 
	var Ezamiyye_Geri_Emir_No = document.getElementById("Ezamiyye_Geri_Emir_No"); 
	var Ezam_Geri_Sebeb = document.getElementById("Ezam_Geri_Sebeb");
	var Ezam_geri_Tarixi = document.getElementById("Ezam_geri_Tarixi");
	if(Ezam_geri_Tarixi.value === '') {
		error(Ezam_geri_Tarixi);
		return;
	}
	if(Ezamiyye_Emri_Id.value === '') {
		error(Ezamiyye_Emri_Id);
		return;
	}
	if(Ezamiyye_Geri_Emir_No.value === '') {
		error(Ezamiyye_Geri_Emir_No);
		return;
	}

	if(Ezam_Geri_Sebeb.value === '') {
		error(Ezam_Geri_Sebeb);
		return;
	}
	var deyer = {
		Ezamiyye_Emri_Id:Ezamiyye_Emri_Id.value,
		Ezamiyye_Geri_Emir_No:Ezamiyye_Geri_Emir_No.value,
		Ezam_geri_Tarixi:Ezam_geri_Tarixi.value,
		Ezam_Geri_Sebeb:Ezam_Geri_Sebeb.value
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Ezamiyye/Geri_Islemleri.php", true);
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
			}else if(status=="errorfull"){
				Tesdiq_Modali_None()
				document.getElementById("errorcavabi").innerHTML=message;
			}else{
				Tesdiq_Modali_None();	
				Modal_Ici_None();				
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
			}
		}
	}

}