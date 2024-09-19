document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Vəzifə dəyişikliyi əmirləri";
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
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Yeni.php", true);
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

function VezifeBosalt() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/VezifeBosalt.php", true);
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

function SelectAlaniSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";
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
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Melumat_Telebi.php", true);
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



function YeniVezifeBosaltFormKontrol() {
	var ID = document.getElementById("ID");
	var Vezifeden_Azad_Etme_Emir_No = document.getElementById("Vezifeden_Azad_Etme_Emir_No");
	var Vezifeden_Azad_Etme_Tarix = document.getElementById("Vezifeden_Azad_Etme_Tarix");		
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}

	var deyerbir="<b>Məlumatın düzgün olduğundan əmin olun!</b> Bunu təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:VezifeBosaltFormKontrol()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}




function VezifeBosaltFormKontrol() {
	var ID = document.getElementById("ID");
	var Vezifeden_Azad_Etme_Emir_No = document.getElementById("Vezifeden_Azad_Etme_Emir_No");
	var Vezifeden_Azad_Etme_Tarix = document.getElementById("Vezifeden_Azad_Etme_Tarix");		
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}	

	var deyer = {
		ID:ID.value,
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Vezife_Bosalt_Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	console.log(xhttp);
	xhttp.onreadystatechange = function (deyer) {		
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			Tesdiq_Modali_None();	
			Modal_Ici_None();		
			document.getElementById("yenibutonalanlari").innerHTML="";
			document.getElementById("yenibutonalanlari").innerHTML=cavab;			
		}
	}
}

function BosaAlinaniSIl(IDDegeri) {
	var deyer=IDDegeri.split("_");
	var deyerbir="<b>Silmək istədiyinizdən əmin olun!</b> Bunu təsdiq etsəniz məlumat silinəcək";
	var deyeriki="javascript:BosaAlinaniSIl_Tesdiq(" + deyer[1] + ")";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 	
}

function BosaAlinaniSIl_Tesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Bosa_Alinmisi_Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {		
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			Tesdiq_Modali_None();	
			Modal_Ici_None();		
			document.getElementById("yenibutonalanlari").innerHTML="";
			document.getElementById("yenibutonalanlari").innerHTML=cavab;			
		}

	}
}




function BosaAlinmisiVezifeyeTeyin() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Bos_Vezifelini_Teyin_Et.php", true);
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

function VakanYerleriSay(id) {
	SelectAlaniSecildi(id);
	deyer=document.getElementById(id).value;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Vakant.php", true);
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
	SelectAlaniSecildi(id)
	var IdareId=document.getElementById(id).value
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Idare_Stat_Vakant_Sobe_Teleb_Et.php", true);
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
			document.getElementById("vakantsayi").innerHTML="";
			document.getElementById("vakantsayi").innerHTML=yersayi;
		}
	}
}

function StatSobeVezifeTelebEt(id) {
	SelectAlaniSecildi(id);
	var deyer=document.getElementById(id).value;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Vakant_Vezife_Teleb_Et.php", true);
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











function YeniFormKontrol() {
	var ID = document.getElementById("ID");
	var User_Is_Novu = document.getElementById("User_Is_Novu");
	var Vezifeye_Teyin_Etme_Emir_No = document.getElementById("Vezifeye_Teyin_Etme_Emir_No");		
	var Vezifeye_Teyin_Etme_Tarixi = document.getElementById("Vezifeye_Teyin_Etme_Tarixi");		
	var Islediyi_Idare = document.getElementById("Islediyi_Idare");		
	var Islediyi_Sobe = document.getElementById("Islediyi_Sobe");		
	var Vezife_Id = document.getElementById("Vezife_Id");		
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}

	if(User_Is_Novu.value === '') {
		error(User_Is_Novu);
		return;
	}
	if(Vezifeye_Teyin_Etme_Emir_No.value === '') {
		error(Vezifeye_Teyin_Etme_Emir_No);
		return;
	}

	if(Vezifeye_Teyin_Etme_Tarixi.value === '') {
		error(Vezifeye_Teyin_Etme_Tarixi);
		return;
	}

	if(Islediyi_Idare.value === '') {
		error(Islediyi_Idare);
		return;
	}

	if(Islediyi_Sobe.value === '') {
		error(Islediyi_Sobe);
		return;
	}

	if(Vezife_Id.value === '') {
		error(Vezife_Id);
		return;
	}
	var deyerbir="<b>Məlumatın düzgün olduğundan əmin olun!</b> Bunu təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:YeniFormIslemi()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function YeniFormIslemi() {
	var ID = document.getElementById("ID");
	var User_Is_Novu = document.getElementById("User_Is_Novu");
	var Vezifeye_Teyin_Etme_Emir_No = document.getElementById("Vezifeye_Teyin_Etme_Emir_No");		
	var Vezifeye_Teyin_Etme_Tarixi = document.getElementById("Vezifeye_Teyin_Etme_Tarixi");		
	var Islediyi_Idare = document.getElementById("Islediyi_Idare");		
	var Islediyi_Sobe = document.getElementById("Islediyi_Sobe");		
	var Vezife_Id = document.getElementById("Vezife_Id");		
	var Bos_Vezife_Durum = document.getElementById("Bos_Vezife_Durum");		
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(User_Is_Novu.value === '') {
		error(User_Is_Novu);
		return;
	}
	if(Vezifeye_Teyin_Etme_Emir_No.value === '') {
		error(Vezifeye_Teyin_Etme_Emir_No);
		return;
	}

	if(Vezifeye_Teyin_Etme_Tarixi.value === '') {
		error(Vezifeye_Teyin_Etme_Tarixi);
		return;
	}

	if(Islediyi_Idare.value === '') {
		error(Islediyi_Idare);
		return;
	}

	if(Islediyi_Sobe.value === '') {
		error(Islediyi_Sobe);
		return;
	}

	if(Vezife_Id.value === '') {
		error(Vezife_Id);
		return;
	}
	var deyer = {
		ID:ID.value,
		User_Is_Novu:User_Is_Novu.value,
		Vezifeye_Teyin_Etme_Emir_No:Vezifeye_Teyin_Etme_Emir_No.value,
		Vezifeye_Teyin_Etme_Tarixi:Vezifeye_Teyin_Etme_Tarixi.value,
		Islediyi_Idare:Islediyi_Idare.value,
		Islediyi_Sobe:Islediyi_Sobe.value,
		Vezife_Id:Vezife_Id.value,
		Bos_Vezife_Durum:Bos_Vezife_Durum.value

	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	console.log(xhttp);
	xhttp.onreadystatechange = function (deyer) {		
		if (this.readyState == 4 && this.status == 200) {
			window.location.reload();
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
	xhttp.open("POST", "StatDeyisikliyiEmirleri/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	console.log(xhttp);
	xhttp.onreadystatechange = function (deyer) {		
		if (this.readyState == 4 && this.status == 200) {
		window.location.reload();
		}

	}
}

