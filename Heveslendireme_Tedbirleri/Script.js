document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Həvəsləndirmə tədbirləri";
function CedveliCagir(icerik){
	var dataTables = $('#'+icerik).DataTable({
		"bFilter" : false,               
		"bLengthChange": true,
		"lengthMenu": [[50, -1], [ 50, "Hamısı"]],
		"pageLength":50,
    "order": [], //Initial no order.
    "aaSorting": [],
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "bAutoWidth": false,
    "responsive": true,
    'processing': true,
    "fixedHeader": true,   
    dom:
    "<'ui grid'"+
    "<'row'"+
    "<'col-2'l>"+
    "<'col-6'B>"+
    "<'col-4'f>"+
    ">"+
    "<'row dt-table'"+
    "<'sixteen wide column'tr>"+
    ">"+
    "<'row'"+
    "<'seven wide column'i>"+
    "<'right aligned nine wide column'p>"+
    ">"+
    ">",
    buttons: [    
    {extend: 'excel',
    title: 'Nəqliyyat Vasitələrinin siyahısı',
    exportOptions: {
    	columns: [0,1,2,3,4,5,6,7,8,9],
    	stripHtml: false,
    }
  },
  { extend: 'print',
  customize: function ( win ) {
  	$(win.document.body)
  	.css( 'font-size', '10px' )
  	$(win.document.body).find( 'table' )
  	.addClass( 'compact' )
  	.css( 'font-size', 'inherit' );
  }, title: 'Nəqliyyat Vasitələrinin siyahısı',
  exportOptions: {
  	columns: [0,1,2,3,4,5,6,7,8,9],
  	stripHtml: false,
  }
}
],
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
	xhttp.open("POST", "Heveslendireme_Tedbirleri/Yeni.php", true);
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




function SelectIkiAlaniSecildi(deyer) {;
	var x=document.getElementById(deyer).nextElementSibling;
	var y=x.getElementsByTagName("span")[0];
	var e=y.getElementsByTagName("span")[0];
	e.style.border = "2px solid #2A3F54";
}



function	YeniFormKontrol(){
	var ID = document.getElementById("ID"); 
	var Hevesledirme_Tedbirleri_Tarix = document.getElementById("Hevesledirme_Tedbirleri_Tarix"); 
	var Hevesledirme_Tedbirleri_Emrinin_Nomresi = document.getElementById("Hevesledirme_Tedbirleri_Emrinin_Nomresi"); 
	var Heveslendirem_Tedbirleri_Ad_Id = document.getElementById("Heveslendirem_Tedbirleri_Ad_Id"); 
	var Hevesledirme_Tedbirleri_Sebeb = document.getElementById("Hevesledirme_Tedbirleri_Sebeb"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Hevesledirme_Tedbirleri_Tarix.value === '') {
		error(Hevesledirme_Tedbirleri_Tarix);
		return;
	}
	if(Hevesledirme_Tedbirleri_Emrinin_Nomresi.value === '') {
		error(Hevesledirme_Tedbirleri_Emrinin_Nomresi);
		return;
	}
	if(Heveslendirem_Tedbirleri_Ad_Id.value === '') {
		error(Heveslendirem_Tedbirleri_Ad_Id);
		return;
	}
	if(Hevesledirme_Tedbirleri_Sebeb.value === '') {
		error(Hevesledirme_Tedbirleri_Sebeb);
		return;
	}	


	var deyerbir="Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:YeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function YeniForm(){
	var ID = document.getElementById("ID"); 
	var Hevesledirme_Tedbirleri_Tarix = document.getElementById("Hevesledirme_Tedbirleri_Tarix"); 
	var Hevesledirme_Tedbirleri_Emrinin_Nomresi = document.getElementById("Hevesledirme_Tedbirleri_Emrinin_Nomresi"); 
	var Heveslendirem_Tedbirleri_Ad_Id = document.getElementById("Heveslendirem_Tedbirleri_Ad_Id"); 
	var Hevesledirme_Tedbirleri_Sebeb = document.getElementById("Hevesledirme_Tedbirleri_Sebeb"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Hevesledirme_Tedbirleri_Tarix.value === '') {
		error(Hevesledirme_Tedbirleri_Tarix);
		return;
	}
	if(Hevesledirme_Tedbirleri_Emrinin_Nomresi.value === '') {
		error(Hevesledirme_Tedbirleri_Emrinin_Nomresi);
		return;
	}
	if(Heveslendirem_Tedbirleri_Ad_Id.value === '') {
		error(Heveslendirem_Tedbirleri_Ad_Id);
		return;
	}
	if(Hevesledirme_Tedbirleri_Sebeb.value === '') {
		error(Hevesledirme_Tedbirleri_Sebeb);
		return;
	}	
	var deyer = {
		ID:ID.value,
		Hevesledirme_Tedbirleri_Tarix:Hevesledirme_Tedbirleri_Tarix.value,
		Hevesledirme_Tedbirleri_Emrinin_Nomresi:Hevesledirme_Tedbirleri_Emrinin_Nomresi.value,
		Heveslendirem_Tedbirleri_Ad_Id:Heveslendirem_Tedbirleri_Ad_Id.value,
		Hevesledirme_Tedbirleri_Sebeb:Hevesledirme_Tedbirleri_Sebeb.value
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendireme_Tedbirleri/Yeni_Islemleri.php", true);
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
				CedveliCagir("dataTable");
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
	xhttp.open("POST", "Heveslendireme_Tedbirleri/Sil.php", true);
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
				CedveliCagir("dataTable");
			}
		}
	}
}



function UserAlaniSfrla(id){
	SelectAlaniSecildi(id);
	document.getElementById("heveslendirmetedmirimodalici").innerHTML = "";
	document.getElementById("heveslendirmetedmirimodalici").innerHTML = `
	<div id="heveslendirmetedmirimodalici">
	<div class="col-12 text-center mt-3">
	<button type="button" onclick="HeveslendirmeTedbiriDusenler()" class="YenileButonlari" tabindex="15" title="">Növbəti</button>
	<button type="button" onclick="Bagla()"  class="YenileButonlari" tabindex="15" title="">İmtina</button>
	</div>
	</div>
	`;
}

function HeveslendirmeTedbiriDusenler(){		
	var Heveslendirem_Tedbirleri_Ad_Id = document.getElementById("Heveslendirem_Tedbirleri_Ad_Id");
	var Hevesledirme_Tedbirleri_Sebeb = document.getElementById("Hevesledirme_Tedbirleri_Sebeb");	
	var Hevesledirme_Tedbirleri_Tarix = document.getElementById("Hevesledirme_Tedbirleri_Tarix");	
	var Hevesledirme_Tedbirleri_Emrinin_Nomresi = document.getElementById("Hevesledirme_Tedbirleri_Emrinin_Nomresi");	
	if(Hevesledirme_Tedbirleri_Tarix.value === '') {
		error(Hevesledirme_Tedbirleri_Tarix);
		return;
	}
	if(Hevesledirme_Tedbirleri_Emrinin_Nomresi.value === '') {
		error(Hevesledirme_Tedbirleri_Emrinin_Nomresi);
		return;
	}

	if(Heveslendirem_Tedbirleri_Ad_Id.value === '') {
		error(Heveslendirem_Tedbirleri_Ad_Id);
		return;
	}

	if(Hevesledirme_Tedbirleri_Sebeb.value.length == 0) {
		Hevesledirme_Tedbirleri_Sebeb.style.border = "2px solid #ff0000";	
		return;
	}
	var deyer = {
		Heveslendirem_Tedbirleri_Ad_Id:Heveslendirem_Tedbirleri_Ad_Id.value,
		Hevesledirme_Tedbirleri_Sebeb:Hevesledirme_Tedbirleri_Sebeb.value,
		Hevesledirme_Tedbirleri_Tarix:Hevesledirme_Tedbirleri_Tarix.value,
		Hevesledirme_Tedbirleri_Emrinin_Nomresi:Hevesledirme_Tedbirleri_Emrinin_Nomresi.value
	};

	var gonderilen=JSON.stringify(deyer);
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Heveslendireme_Tedbirleri/Heveslendirme_Tedbiri_User_Teleb_Et.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	console.log(xhttp);
	xhttp.onreadystatechange = function () {	
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("heveslendirmetedmirimodalici").innerHTML = "";
			document.getElementById("heveslendirmetedmirimodalici").innerHTML = cavab;
			$(".select2").select2({
				placeholder: "Secin",
				allowClear: true
			});
		}
	}
}
