document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "İntizam Tənbehi Əmrləri";
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


function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Yeni.php", true);
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

function IntizamTenbehiSebebAlaniYazildi(deyer) {
	InputIcerikDeyeri=document.getElementById(deyer);
	if (InputIcerikDeyeri.value.length > InputIcerikDeyeri.maxLength) 
		InputIcerikDeyeri.value = InputIcerikDeyeri.value.slice(0, InputIcerikDeyeri.maxLength)
	var InputLabelMetni=deyer+"_Metni";
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
		var YoxlanisNeticesi = Yoxla.replace(/[^a-zA-Z0-9ÇçĞğİıÖöŞşÜüƏə.,\/\-()\s+]/g, "");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}	
}

function SecimAlaniSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";	
}

function SelectAlaniSecildi(deyer) {
	var ID=document.getElementById(deyer).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Isnovu_Telebi.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("ID=" + ID);
	xhttp.onreadystatechange = function (deye) {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById(deyer).style.color = "#2A3F54";
			document.getElementById(deyer).style.borderColor = "#2A3F54";
			document.getElementById("VakantIdareSobeVezife").innerHTML="";
			document.getElementById("Isnovu").innerHTML="";
			document.getElementById("Isnovu").innerHTML=cavab;	
		}
	}
}

function VakanYerleriSay(id) {	

	document.getElementById(id).style.color = "#2A3F54";
	document.getElementById(id).style.borderColor = "#2A3F54";
	deyer=document.getElementById(id).value;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Vakant.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Stat_Muqavile=" + deyer);
	xhttp.onreadystatechange = function () {	
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("VakantIdareSobeVezife").innerHTML="";
			document.getElementById("VakantIdareSobeVezife").innerHTML=cavab;
			var yersayi=document.getElementById("yersayi").value;
			document.getElementById("vakantsayi").innerHTML="";
			document.getElementById("vakantsayi").innerHTML=yersayi;
		}
	}
}

function StatIdareSobeTelebEt(id) {
	document.getElementById(id).style.color = "#2A3F54";
	document.getElementById(id).style.borderColor = "#2A3F54";
	var IdareId=document.getElementById(id).value
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Idare_Stat_Vakant_Sobe_Teleb_Et.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Idare_Id=" + IdareId);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("yeniemirvezife").innerHTML="";
			document.getElementById("yeniemirsobe").innerHTML="";
			document.getElementById("yeniemirsobe").innerHTML=cavab;
			var yersayi=document.getElementById("vakansobesayi").value;

			document.getElementById("vakant").style.display = "block";
			document.getElementById("vakantsayi").innerHTML="";
			document.getElementById("vakantsayi").innerHTML=yersayi;
		}
	}
}

function StatSobeVezifeTelebEt(id) {
	document.getElementById(id).style.color = "#2A3F54";
	document.getElementById(id).style.borderColor = "#2A3F54";
	var deyer=document.getElementById(id).value;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Vakant_Vezife_Teleb_Et.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Sobe_Id=" + deyer);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();

			document.getElementById("yeniemirvezife").innerHTML="";
			document.getElementById("yeniemirvezife").innerHTML=cavab;
			var say=document.getElementById("vakanvezifesayi").value;
			document.getElementById("vakantsayi").innerHTML="";
			document.getElementById("vakantsayi").innerHTML=say;

		}
	}
}



function SagVeSolBosluklariSIl(deyer){
	InputIcerikDeyeri=document.getElementById(deyer);
	var Yoxlabir = InputIcerikDeyeri.value;		
	var Yoxla=Yoxlabir.trim();	
	InputIcerikDeyeri.value = Yoxla;
}



function SelectIkiAlaniSecildi(deyer) {
	var ID=document.getElementById(deyer).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Melumat_Telebi.php", true);
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


function IntizamTenbehiFormKontrol() {
	var ID = document.getElementById("ID");
	var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id");
	var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");	
	var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");	
	var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");	
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}

	if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
		error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
		return;
	}
	if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
		error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
		return;
	}

	if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
		error(Intizam_Tenbehi_Emrinin_Nomresi);
		return;
	}

	if(Intizam_Tenbehi_Sebeb.value.length == 0) {
		Intizam_Tenbehi_Sebeb.style.border = "2px solid #ff0000";	
		return;
	}
	var deyerbir="<b>Silmək istədiyinizdən əmin olun!</b> Bunu təsdiq etsəniz məlumat silinəcək";
	var deyeriki="javascript:IntizamTenbehiFormIslemi()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}



function IntizamTenbehiFormIslemi() {
	var ID = document.getElementById("ID");
	var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id");
	var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");	
	var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");	
	var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");	
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}	
	if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
		error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
		return;
	}
	if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
		error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
		return;
	}
	if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
		error(Intizam_Tenbehi_Emrinin_Nomresi);
		return;
	}
	if(Intizam_Tenbehi_Sebeb.value.length == 0) {
		Intizam_Tenbehi_Sebeb.style.border = "2px solid #ff0000";	
		return;
	}
	var deyer = {
		ID:ID.value,
		Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value,
		Intizam_Tenbehi_Sebeb:Intizam_Tenbehi_Sebeb.value,
		Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value,
		Intizam_Tenbehi_Emrinin_Nomresi:Intizam_Tenbehi_Emrinin_Nomresi.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Yeni_Islemleri.php", true);
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
	var deyerbir="<b>Silmək istədiyinizdən əmin olun!</b> Bunu təsdiq etsəniz məlumat silinəcək";
	var deyeriki="javascript:Sil_Tesdiq(" + deyer[1] + ")";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 	
}

function Sil_Tesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {		
		document.getElementById("yuklemealanikapsayici").style.display = "none";
		var cavab=this.responseText.trim();
		document.getElementById("cavabid").innerHTML=cavab;
		var status=document.getElementById("status").value;
		var message=document.getElementById("message").value;
		if (status=="error") {
			Tesdiq_Modali_None()	
			document.getElementById("cavabid").innerHTML=message;
		}else{
			Tesdiq_Modali_None();					
			document.getElementById("icerik").innerHTML="";
			document.getElementById("icerik").innerHTML=cavab;
			document.getElementById("cavabid").innerHTML="";
			document.getElementById("cavabid").innerHTML=message;
		}		
	}
}

function Duzeli(IDDegeri) {
	var deyer=IDDegeri.split("_");		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Duzelis.php", true);
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


function DuzelisIntizamTenbehiFormKontrol(id) {
	var Intizam_Tenbehi_Id = document.getElementById("Intizam_Tenbehi_Id");
	var ID = document.getElementById("ID");
	var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id");
	var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");	
	var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");	
	var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");	
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}

	if(Intizam_Tenbehi_Id.value === '') {
		error(Intizam_Tenbehi_Id);
		return;
	}

	if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
		error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
		return;
	}
	if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
		error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
		return;
	}

	if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
		error(Intizam_Tenbehi_Emrinin_Nomresi);
		return;
	}

	if(Intizam_Tenbehi_Sebeb.value.length == 0) {
		Intizam_Tenbehi_Sebeb.style.border = "2px solid #ff0000";	
		return;
	}
	var deyerbir="<b>Məlumatın düzgün olduğundan əmin olun!</b> Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:DuzelisIntizamTenbehiFormIslemi()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function DuzelisIntizamTenbehiFormIslemi(id) {
	var Intizam_Tenbehi_Id = document.getElementById("Intizam_Tenbehi_Id");
	var ID = document.getElementById("ID");
	var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id");
	var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");	
	var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");	
	var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");	
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}	
	if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
		error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
		return;
	}
	if(Intizam_Tenbehi_Id.value === '') {
		error(Intizam_Tenbehi_Id);
		return;
	}
	if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
		error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
		return;
	}
	if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
		error(Intizam_Tenbehi_Emrinin_Nomresi);
		return;
	}
	if(Intizam_Tenbehi_Sebeb.value.length == 0) {
		Intizam_Tenbehi_Sebeb.style.border = "2px solid #ff0000";	
		return;
	}

	var deyer = {
		ID:ID.value,
		Intizam_Tenbehi_Id:Intizam_Tenbehi_Id.value,
		Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value,
		Intizam_Tenbehi_Sebeb:Intizam_Tenbehi_Sebeb.value,
		Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value,
		Intizam_Tenbehi_Emrinin_Nomresi:Intizam_Tenbehi_Emrinin_Nomresi.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Duzelis_Islemleri.php", true);
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


function AsagiYeniFormKontrol(){	
	var ID = document.getElementById("ID");
	var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id");
	var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");	
	var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");	
	var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");	
	if (document.getElementById("User_Is_Novu")) {
		var User_Is_Novu = document.getElementById("User_Is_Novu");	
	}
	if (document.getElementById("Islediyi_Idare")) {
		var Islediyi_Idare = document.getElementById("Islediyi_Idare");	
	}
	if (document.getElementById("Islediyi_Sobe")) {
		var Islediyi_Sobe = document.getElementById("Islediyi_Sobe");	
	}
	if (document.getElementById("Vezife_Id")) {
		var Vezife_Id = document.getElementById("Vezife_Id");	
	}

	
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}



	if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
		error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
		return;
	}
	if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
		error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
		return;
	}

	if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
		error(Intizam_Tenbehi_Emrinin_Nomresi);
		return;
	}	
	if(Intizam_Tenbehi_Sebeb.value.length == 0) {
		Intizam_Tenbehi_Sebeb.style.border = "2px solid #ff0000";	
		return;
	}	
	if (document.getElementById("User_Is_Novu")) {
		if(User_Is_Novu.value === '') {
			error(User_Is_Novu);
			return;
		}
	}
	if (document.getElementById("Islediyi_Idare")) {
		if(Islediyi_Idare.value === '') {
			error(Islediyi_Idare);
			return;
		}	
	}
	if (document.getElementById("Islediyi_Sobe")) {
		if(Islediyi_Sobe.value === '') {
			error(Islediyi_Sobe);
			return;
		}	
	}
	if (document.getElementById("Vezife_Id")) {
		if(Vezife_Id.value === '') {
			error(Vezife_Id);
			return;
		}	
	}
	var deyerbir="<b>Məlumatın düzgün olduğundan əmin olun!</b> Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:AsagiFormIslemi()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function AsagiFormIslemi(id) {	
	var ID = document.getElementById("ID");
	var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id");
	var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");	
	var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix");	
	var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");	
	if (document.getElementById("User_Is_Novu")) {
		var User_Is_Novu = document.getElementById("User_Is_Novu");	
	}
	if (document.getElementById("Islediyi_Idare")) {
		var Islediyi_Idare = document.getElementById("Islediyi_Idare");	
	}
	if (document.getElementById("Islediyi_Sobe")) {
		var Islediyi_Sobe = document.getElementById("Islediyi_Sobe");	
	}
	if (document.getElementById("Vezife_Id")) {
		var Vezife_Id = document.getElementById("Vezife_Id");	
	}
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
		error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
		return;
	}
	if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
		error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
		return;
	}

	if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
		error(Intizam_Tenbehi_Emrinin_Nomresi);
		return;
	}	
	if(Intizam_Tenbehi_Sebeb.value.length == 0) {
		Intizam_Tenbehi_Sebeb.style.border = "2px solid #ff0000";	
		return;
	}	
	if (document.getElementById("User_Is_Novu")) {
		if(User_Is_Novu.value === '') {
			error(User_Is_Novu);
			return;
		}
	}
	if (document.getElementById("Islediyi_Idare")) {
		if(Islediyi_Idare.value === '') {
			error(Islediyi_Idare);
			return;
		}	
	}
	if (document.getElementById("Islediyi_Sobe")) {
		if(Islediyi_Sobe.value === '') {
			error(Islediyi_Sobe);
			return;
		}	
	}
	if (document.getElementById("Vezife_Id")) {
		if(Vezife_Id.value === '') {
			error(Vezife_Id);
			return;
		}	
	}
	var deyer = {
		ID:ID.value,
		Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value,
		Intizam_Tenbehi_Sebeb:Intizam_Tenbehi_Sebeb.value,
		Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value,
		Intizam_Tenbehi_Emrinin_Nomresi:Intizam_Tenbehi_Emrinin_Nomresi.value,
		User_Is_Novu:User_Is_Novu.value,
		Islediyi_Idare:Islediyi_Idare.value,
		Islediyi_Sobe:Islediyi_Sobe.value,
		Vezife_Id:Vezife_Id.value
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IntizamTenbehleri/Asagi_Yeni_Islemleri.php", true);
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