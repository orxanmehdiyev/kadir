document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Nəqliyyat Vasitələrinin Təhkim Əmri";
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
	xhttp.open("POST", "NeqliyyatVasiteleri/Yeni.php", true);
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
  document.getElementById(deyer).style.color = "#2A3F54";
  document.getElementById(deyer).style.borderColor = "#2A3F54";
}



function BalansaAlinmaFormKontrol() { 
  var Dovlet_Nom_Nisani = document.getElementById("Dovlet_Nom_Nisani"); 
  var Neqliyyat_Vasiteleri_Novu = document.getElementById("Neqliyyat_Vasiteleri_Novu"); 
  var Neqliyyat_Vasiteleri_Marka = document.getElementById("Neqliyyat_Vasiteleri_Marka"); 
  var Neqliyyat_Vasiteleri_Motor_Hecmi = document.getElementById("Neqliyyat_Vasiteleri_Motor_Hecmi");
  var Neqliyyat_Vasiteleri_Adam_Yeri = document.getElementById("Neqliyyat_Vasiteleri_Adam_Yeri"); 
  var Neqliyyat_Vasiteleri_Istehsal_Ili = document.getElementById("Neqliyyat_Vasiteleri_Istehsal_Ili"); 
  var Neqliyyat_Vasiteleri_Balans_Deyeri = document.getElementById("Neqliyyat_Vasiteleri_Balans_Deyeri");
  var Idare_Id = document.getElementById("Idare_Id"); 
  var Bann_Nomresi = document.getElementById("Bann_Nomresi"); 
  var Sash_Nomresi = document.getElementById("Sash_Nomresi");
  var Rengi = document.getElementById("Rengi"); 

  if(Dovlet_Nom_Nisani.value === '') {
   error(Dovlet_Nom_Nisani);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Novu.value === '') {
   error(Neqliyyat_Vasiteleri_Novu);
   return;
 }

 if(Neqliyyat_Vasiteleri_Marka.value === '') {
   error(Neqliyyat_Vasiteleri_Marka);
   return;
 }

 if(Neqliyyat_Vasiteleri_Motor_Hecmi.value === '') {
   error(Neqliyyat_Vasiteleri_Motor_Hecmi);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Adam_Yeri.value === '') {
   error(Neqliyyat_Vasiteleri_Adam_Yeri);
   return;
 } 

 if(Neqliyyat_Vasiteleri_Istehsal_Ili.value === '') {
   error(Neqliyyat_Vasiteleri_Istehsal_Ili);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Balans_Deyeri.value === '') {
   error(Neqliyyat_Vasiteleri_Balans_Deyeri);
   return;
 }

 if(Idare_Id.value === '') {
   error(Idare_Id);
   return;
 }

 if(Bann_Nomresi.value === '') {
   error(Bann_Nomresi);
   return;
 } 
 
 if(Sash_Nomresi.value === '') {
   error(Sash_Nomresi);
   return;
 } 
 
 if(Rengi.value === '') {
   error(Rengi);
   return;
 }

 var deyerbir="Məlumatın düzgün olduğundan əmin olunggg. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 var deyeriki="javascript:BalansaAlinmaForm()";
 Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function BalansaAlinmaForm(){
  var Dovlet_Nom_Nisani = document.getElementById("Dovlet_Nom_Nisani"); 
  var Neqliyyat_Vasiteleri_Novu = document.getElementById("Neqliyyat_Vasiteleri_Novu"); 
  var Neqliyyat_Vasiteleri_Marka = document.getElementById("Neqliyyat_Vasiteleri_Marka"); 
  var Neqliyyat_Vasiteleri_Motor_Hecmi = document.getElementById("Neqliyyat_Vasiteleri_Motor_Hecmi");
  var Neqliyyat_Vasiteleri_Adam_Yeri = document.getElementById("Neqliyyat_Vasiteleri_Adam_Yeri"); 
  var Neqliyyat_Vasiteleri_Istehsal_Ili = document.getElementById("Neqliyyat_Vasiteleri_Istehsal_Ili"); 
  var Neqliyyat_Vasiteleri_Balans_Deyeri = document.getElementById("Neqliyyat_Vasiteleri_Balans_Deyeri");
  var Idare_Id = document.getElementById("Idare_Id"); 
  var Bann_Nomresi = document.getElementById("Bann_Nomresi"); 
  var Sash_Nomresi = document.getElementById("Sash_Nomresi");
  var Rengi = document.getElementById("Rengi"); 

  if(Dovlet_Nom_Nisani.value === '') {
   error(Dovlet_Nom_Nisani);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Novu.value === '') {
   error(Neqliyyat_Vasiteleri_Novu);
   return;
 }

 if(Neqliyyat_Vasiteleri_Marka.value === '') {
   error(Neqliyyat_Vasiteleri_Marka);
   return;
 }

 if(Neqliyyat_Vasiteleri_Motor_Hecmi.value === '') {
   error(Neqliyyat_Vasiteleri_Motor_Hecmi);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Adam_Yeri.value === '') {
   error(Neqliyyat_Vasiteleri_Adam_Yeri);
   return;
 } 

 if(Neqliyyat_Vasiteleri_Istehsal_Ili.value === '') {
   error(Neqliyyat_Vasiteleri_Istehsal_Ili);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Balans_Deyeri.value === '') {
   error(Neqliyyat_Vasiteleri_Balans_Deyeri);
   return;
 }

 if(Idare_Id.value === '') {
   error(Idare_Id);
   return;
 }

 if(Bann_Nomresi.value === '') {
   error(Bann_Nomresi);
   return;
 } 
 
 if(Sash_Nomresi.value === '') {
   error(Sash_Nomresi);
   return;
 } 
 
 if(Rengi.value === '') {
   error(Rengi);
   return;
 }

 var deyer = {
   Dovlet_Nom_Nisani:document.getElementById("Dovlet_Nom_Nisani").value, 
   Neqliyyat_Vasiteleri_Novu:document.getElementById("Neqliyyat_Vasiteleri_Novu").value, 
   Neqliyyat_Vasiteleri_Marka:document.getElementById("Neqliyyat_Vasiteleri_Marka").value, 
   Neqliyyat_Vasiteleri_Motor_Hecmi:document.getElementById("Neqliyyat_Vasiteleri_Motor_Hecmi").value, 
   Neqliyyat_Vasiteleri_Adam_Yeri:document.getElementById("Neqliyyat_Vasiteleri_Adam_Yeri").value, 
   Neqliyyat_Vasiteleri_Istehsal_Ili:document.getElementById("Neqliyyat_Vasiteleri_Istehsal_Ili").value, 
   Neqliyyat_Vasiteleri_Balans_Deyeri:document.getElementById("Neqliyyat_Vasiteleri_Balans_Deyeri").value, 
   Idare_Id:document.getElementById("Idare_Id").value, 
   Bann_Nomresi:document.getElementById("Bann_Nomresi").value, 
   Sash_Nomresi:document.getElementById("Sash_Nomresi").value, 
   Rengi:document.getElementById("Rengi").value

 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "NeqliyyatVasiteleri/Yeni_Islemleri.php", true);
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
     document.getElementById("UsaqSoyadi").value="";
     document.getElementById("UsaqAdi").value="";
     document.getElementById("UsaqAtaadi").value="";
     document.getElementById("Usaq_Dogum_Tarixi").value="";
     errorcavab(Dovlet_Nom_Nisani);
     errorcavab(Neqliyyat_Vasiteleri_Novu);
     errorcavab(Neqliyyat_Vasiteleri_Marka);
     errorcavab(Neqliyyat_Vasiteleri_Motor_Hecmi);
     errorcavab(Neqliyyat_Vasiteleri_Adam_Yeri);
     errorcavab(Neqliyyat_Vasiteleri_Istehsal_Ili);
     errorcavab(Neqliyyat_Vasiteleri_Balans_Deyeri);
     errorcavab(Idare_Id);
     errorcavab(Bann_Nomresi);
     errorcavab(Sash_Nomresi);
     errorcavab(Rengi);
     document.getElementById("errorcavabi").innerHTML="";
     document.getElementById("errorcavabi").innerHTML=message;
     return;
   }else if (document.getElementById("status").value=="success") {
    Tesdiq_Modali_None();
    Modal_Ici_None();
    document.getElementById("icerik").innerHTML="";
    document.getElementById("icerik").innerHTML=data;
    CedveliCagir("dataTable");
    return;
  }
}
}
}

function Duzeli(IDDegeri) {
  var deyer=IDDegeri.split("_");    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "NeqliyyatVasiteleri/Duzelis.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + deyer[1]);
  xhttp.onreadystatechange = function () {  
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);
    }
  }
}




function BalansaAlinmaDuzenleFormKontrol() { 
  var Dovlet_Nom_Nisani = document.getElementById("Dovlet_Nom_Nisani"); 
  var Neqliyyat_Vasiteleri_Novu = document.getElementById("Neqliyyat_Vasiteleri_Novu"); 
  var Neqliyyat_Vasiteleri_Marka = document.getElementById("Neqliyyat_Vasiteleri_Marka"); 
  var Neqliyyat_Vasiteleri_Motor_Hecmi = document.getElementById("Neqliyyat_Vasiteleri_Motor_Hecmi");
  var Neqliyyat_Vasiteleri_Adam_Yeri = document.getElementById("Neqliyyat_Vasiteleri_Adam_Yeri"); 
  var Neqliyyat_Vasiteleri_Istehsal_Ili = document.getElementById("Neqliyyat_Vasiteleri_Istehsal_Ili"); 
  var Neqliyyat_Vasiteleri_Balans_Deyeri = document.getElementById("Neqliyyat_Vasiteleri_Balans_Deyeri");
  var Idare_Id = document.getElementById("Idare_Id"); 
  var Bann_Nomresi = document.getElementById("Bann_Nomresi"); 
  var Sash_Nomresi = document.getElementById("Sash_Nomresi");
  var Rengi = document.getElementById("Rengi"); 
  var Neqliyyat_Vasiteleri_Id = document.getElementById("Neqliyyat_Vasiteleri_Id"); 

  if(Dovlet_Nom_Nisani.value === '') {
   error(Dovlet_Nom_Nisani);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Novu.value === '') {
   error(Neqliyyat_Vasiteleri_Novu);
   return;
 }

 if(Neqliyyat_Vasiteleri_Marka.value === '') {
   error(Neqliyyat_Vasiteleri_Marka);
   return;
 }

 if(Neqliyyat_Vasiteleri_Motor_Hecmi.value === '') {
   error(Neqliyyat_Vasiteleri_Motor_Hecmi);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Adam_Yeri.value === '') {
   error(Neqliyyat_Vasiteleri_Adam_Yeri);
   return;
 } 

 if(Neqliyyat_Vasiteleri_Istehsal_Ili.value === '') {
   error(Neqliyyat_Vasiteleri_Istehsal_Ili);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Balans_Deyeri.value === '') {
   error(Neqliyyat_Vasiteleri_Balans_Deyeri);
   return;
 }

 if(Idare_Id.value === '') {
   error(Idare_Id);
   return;
 }

 if(Bann_Nomresi.value === '') {
   error(Bann_Nomresi);
   return;
 } 
 
 if(Sash_Nomresi.value === '') {
   error(Sash_Nomresi);
   return;
 } 
 
 if(Rengi.value === '') {
   error(Rengi);
   return;
 }

 if(Neqliyyat_Vasiteleri_Id.value === '') {
   error(Neqliyyat_Vasiteleri_Id);
   return;
 }

 var deyerbir="Məlumatın düzgün olduğundan əmin olunggg. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 var deyeriki="javascript:BalansaAlinmaDuzenleForm()";
 Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function BalansaAlinmaDuzenleForm(){
  var Dovlet_Nom_Nisani = document.getElementById("Dovlet_Nom_Nisani"); 
  var Neqliyyat_Vasiteleri_Novu = document.getElementById("Neqliyyat_Vasiteleri_Novu"); 
  var Neqliyyat_Vasiteleri_Marka = document.getElementById("Neqliyyat_Vasiteleri_Marka"); 
  var Neqliyyat_Vasiteleri_Motor_Hecmi = document.getElementById("Neqliyyat_Vasiteleri_Motor_Hecmi");
  var Neqliyyat_Vasiteleri_Adam_Yeri = document.getElementById("Neqliyyat_Vasiteleri_Adam_Yeri"); 
  var Neqliyyat_Vasiteleri_Istehsal_Ili = document.getElementById("Neqliyyat_Vasiteleri_Istehsal_Ili"); 
  var Neqliyyat_Vasiteleri_Balans_Deyeri = document.getElementById("Neqliyyat_Vasiteleri_Balans_Deyeri");
  var Idare_Id = document.getElementById("Idare_Id"); 
  var Bann_Nomresi = document.getElementById("Bann_Nomresi"); 
  var Sash_Nomresi = document.getElementById("Sash_Nomresi");
  var Rengi = document.getElementById("Rengi"); 
  var Neqliyyat_Vasiteleri_Id = document.getElementById("Neqliyyat_Vasiteleri_Id"); 

  if(Dovlet_Nom_Nisani.value === '') {
   error(Dovlet_Nom_Nisani);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Novu.value === '') {
   error(Neqliyyat_Vasiteleri_Novu);
   return;
 }

 if(Neqliyyat_Vasiteleri_Marka.value === '') {
   error(Neqliyyat_Vasiteleri_Marka);
   return;
 }

 if(Neqliyyat_Vasiteleri_Motor_Hecmi.value === '') {
   error(Neqliyyat_Vasiteleri_Motor_Hecmi);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Adam_Yeri.value === '') {
   error(Neqliyyat_Vasiteleri_Adam_Yeri);
   return;
 } 

 if(Neqliyyat_Vasiteleri_Istehsal_Ili.value === '') {
   error(Neqliyyat_Vasiteleri_Istehsal_Ili);
   return;
 }
 
 if(Neqliyyat_Vasiteleri_Balans_Deyeri.value === '') {
   error(Neqliyyat_Vasiteleri_Balans_Deyeri);
   return;
 }

 if(Idare_Id.value === '') {
   error(Idare_Id);
   return;
 }

 if(Bann_Nomresi.value === '') {
   error(Bann_Nomresi);
   return;
 } 
 
 if(Sash_Nomresi.value === '') {
   error(Sash_Nomresi);
   return;
 } 
 
 if(Rengi.value === '') {
   error(Rengi);
   return;
 }

 if(Neqliyyat_Vasiteleri_Id.value === '') {
   error(Neqliyyat_Vasiteleri_Id);
   return;
 }

 var deyer = {
   Dovlet_Nom_Nisani:document.getElementById("Dovlet_Nom_Nisani").value, 
   Neqliyyat_Vasiteleri_Novu:document.getElementById("Neqliyyat_Vasiteleri_Novu").value, 
   Neqliyyat_Vasiteleri_Marka:document.getElementById("Neqliyyat_Vasiteleri_Marka").value, 
   Neqliyyat_Vasiteleri_Motor_Hecmi:document.getElementById("Neqliyyat_Vasiteleri_Motor_Hecmi").value, 
   Neqliyyat_Vasiteleri_Adam_Yeri:document.getElementById("Neqliyyat_Vasiteleri_Adam_Yeri").value, 
   Neqliyyat_Vasiteleri_Istehsal_Ili:document.getElementById("Neqliyyat_Vasiteleri_Istehsal_Ili").value, 
   Neqliyyat_Vasiteleri_Balans_Deyeri:document.getElementById("Neqliyyat_Vasiteleri_Balans_Deyeri").value, 
   Idare_Id:document.getElementById("Idare_Id").value, 
   Bann_Nomresi:document.getElementById("Bann_Nomresi").value, 
   Sash_Nomresi:document.getElementById("Sash_Nomresi").value, 
   Neqliyyat_Vasiteleri_Id:document.getElementById("Neqliyyat_Vasiteleri_Id").value, 
   Rengi:document.getElementById("Rengi").value

 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "NeqliyyatVasiteleri/Duzenle_Islemleri.php", true);
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
     document.getElementById("UsaqSoyadi").value="";
     document.getElementById("UsaqAdi").value="";
     document.getElementById("UsaqAtaadi").value="";
     document.getElementById("Usaq_Dogum_Tarixi").value="";
     errorcavab(Dovlet_Nom_Nisani);
     errorcavab(Neqliyyat_Vasiteleri_Novu);
     errorcavab(Neqliyyat_Vasiteleri_Marka);
     errorcavab(Neqliyyat_Vasiteleri_Motor_Hecmi);
     errorcavab(Neqliyyat_Vasiteleri_Adam_Yeri);
     errorcavab(Neqliyyat_Vasiteleri_Istehsal_Ili);
     errorcavab(Neqliyyat_Vasiteleri_Balans_Deyeri);
     errorcavab(Idare_Id);
     errorcavab(Bann_Nomresi);
     errorcavab(Sash_Nomresi);
     errorcavab(Rengi);
     document.getElementById("errorcavabi").innerHTML="";
     document.getElementById("errorcavabi").innerHTML=message;
     return;
   }else if (document.getElementById("status").value=="success") {
    Tesdiq_Modali_None();
    Modal_Ici_None();
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
 xhttp.open("POST", "NeqliyyatVasiteleri/Sil.php", true);
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