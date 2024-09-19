document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Sertifikatlar";


function filterGlobal () {
	$('#dataTable').DataTable().search(
		$('#global_filter').val()
		).draw();
}
function filterGlobalid () {
	$('#dataTable').DataTable().search(
		$('#global_filter').val()
		).draw();
}



function IdareAxtar () {
	$('#dataTable').DataTable().column(7).search(
		$('#IdareAxtarir').val()
		).draw();
}


function SobeAxtar () {
	$('#dataTable').DataTable().column(8).search(
		$('#SobeAxtarir').val()
		).draw();
}

function NovuAxtar () {
	$('#dataTable').DataTable().column(1).search(
		$('#NovuAxtarir').val()
		).draw();
}

function NeticeAxtar () {
	$('#dataTable').DataTable().column(3).search(
		$('#NeticeAxtarir').val()
		).draw();
}




function filterColumn ( i ) {
	$('#dataTable').DataTable().column( i ).search(
		$('#col'+i+'_filter').val()
		).draw();
}

$(document).ready(function() {
	$('#dataTable').DataTable();

	$('#IdareAxtarir').on( 'change', function () {
		IdareAxtar();
	} );

	$('#SobeAxtarir').on( 'change', function () {
		SobeAxtar();
	} );

	$('#NovuAxtarir').on( 'change', function () {
		NovuAxtar();
	} );

	$('#NeticeAxtarir').on( 'change', function () {
		NeticeAxtar();
	} );





	$('input.global_filter').on( 'keyup click', function () {
		filterGlobal();
	} );

	$('input.column_filter').on( 'keyup click', function () {
		filterColumn( $(this).parents('tr').attr('data-column') );
	} );
} );

function CedveliCagir(icerik){	
	var dataTables = $('#'+icerik).DataTable({

		"bFilter" : false,               
		"bLengthChange": true,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Hamısı"]],
		"pageLength": 566,
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
    
    {extend: 'excel', title: 'kadr'},
    {	extend: 'print',
    customize: function ( win ) {
    	$(win.document.body)
    	.css( 'font-size', '10pt' )
    	$(win.document.body).find( 'table' )
    	.addClass( 'compact' )
    	.css( 'font-size', 'inherit' );
    }, title: 'Şəxsi heyyət haqqında məlumat',
    exportOptions: {
    	columns: ':visible',
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
	xhttp.open("POST", "Sertifikat/Yeni.php", true);
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
	xhttp.open("POST", "Sertifikat/Melumat_Telebi.php", true);
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





function YeniFormKontrol(id){
	var ID = document.getElementById("ID"); 
	var Sertifikat_Novu = document.getElementById("Sertifikat_Novu"); 
	var Sertifikat_Qiymetlendirme = document.getElementById("Sertifikat_Qiymetlendirme"); 
	var Sertifikat_No = document.getElementById("Sertifikat_No"); 
	var Sertifikat_Verilme_Tarix = document.getElementById("Sertifikat_Verilme_Tarix"); 	
	var Telim_Seminar_Adi = document.getElementById("Telim_Seminar_Adi"); 		
	var Sertifikat_Emir_No = document.getElementById("Sertifikat_Emir_No"); 		
	var Sertifikat_Emir_Tarix = document.getElementById("Sertifikat_Emir_Tarix"); 	
	
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Sertifikat_Novu.value === '') {
		error(Sertifikat_Novu);
		return;
	}
	if(Sertifikat_Qiymetlendirme.value === '') {
		error(Sertifikat_Qiymetlendirme);
		return;
	}	

	if(Sertifikat_No.value === '') {
		error(Sertifikat_No);
		return;
	}
	if(Sertifikat_Verilme_Tarix.value === '') {
		error(Sertifikat_Verilme_Tarix);
		return;
	}

	if(Telim_Seminar_Adi.value === '') {
		error(Telim_Seminar_Adi);
		return;
	}

	if(Sertifikat_Emir_No.value === '') {
		error(Sertifikat_Emir_No);
		return;
	}

	if(Sertifikat_Emir_Tarix.value === '') {
		error(Sertifikat_Emir_Tarix);
		return;
	}
	var deyerbir="Məlumatın düzgün olduğundan əmin olung. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:YeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function YeniForm(){
	document.getElementById("yuklemealanikapsayici").style.display = "block";	
	var ID = document.getElementById("ID"); 
	var Sertifikat_Novu = document.getElementById("Sertifikat_Novu"); 
	var Sertifikat_Qiymetlendirme = document.getElementById("Sertifikat_Qiymetlendirme"); 
	var Sertifikat_No = document.getElementById("Sertifikat_No"); 
	var Sertifikat_Verilme_Tarix = document.getElementById("Sertifikat_Verilme_Tarix"); 	
	var Telim_Seminar_Adi = document.getElementById("Telim_Seminar_Adi"); 		
	var Sertifikat_Emir_No = document.getElementById("Sertifikat_Emir_No"); 		
	var Sertifikat_Emir_Tarix = document.getElementById("Sertifikat_Emir_Tarix"); 		
		
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Sertifikat_Novu.value === '') {
		error(Sertifikat_Novu);
		return;
	}
	if(Sertifikat_Qiymetlendirme.value === '') {
		error(Sertifikat_Qiymetlendirme);
		return;
	}

	if(Sertifikat_No.value === '') {
		error(Sertifikat_No);
		return;
	}
	if(Sertifikat_Verilme_Tarix.value === '') {
		error(Sertifikat_Verilme_Tarix);
		return;
	}

	if(Telim_Seminar_Adi.value === '') {
		error(Telim_Seminar_Adi);
		return;
	}

	if(Sertifikat_Emir_No.value === '') {
		error(Sertifikat_Emir_No);
		return;
	}

	if(Sertifikat_Emir_Tarix.value === '') {
		error(Sertifikat_Emir_Tarix);
		return;
	}

	var deyer = {
		ID:ID.value,
		Sertifikat_Novu:Sertifikat_Novu.value,
		Sertifikat_Qiymetlendirme:Sertifikat_Qiymetlendirme.value,
		Sertifikat_No:Sertifikat_No.value,
		Sertifikat_Verilme_Tarix:Sertifikat_Verilme_Tarix.value,
		Telim_Seminar_Adi:Telim_Seminar_Adi.value,
		Sertifikat_Emir_No:Sertifikat_Emir_No.value,
		Sertifikat_Emir_Tarix:Sertifikat_Emir_Tarix.value
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Sertifikat/Yeni_Islemleri.php", true);
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
				statuserror(Attestasiya_Qerar);
				statuserror(Attestasiya_Tarix);
				statuserror(Topladigi_Bal);				
			}else{
				Tesdiq_Modali_None();	
				Modal_Ici_None();				
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
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
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "Sertifikat/Sil.php", true);
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