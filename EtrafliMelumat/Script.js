 document.getElementById("SeyfeAdi").innerHTML = "";
 var Soy_Adi=document.getElementById("Soy_Adi").value;
 var Adi=document.getElementById("Adi").value;
 var Ata_Adi=document.getElementById("Ata_Adi").value;
 var Cinsiyeti=document.getElementById("Cinsiyeti").value;
 if(Cinsiyeti=="Kişi"){
 	var ogluqizi="oğlunun məlumatları";
 }else if(Cinsiyeti=="Qadın"){
 	var ogluqizi="qızınnın məlumatları";
 }else{
 	var ogluqizi="";
 }
 document.getElementById("SeyfeAdi").innerHTML = Soy_Adi+" "+Adi+" "+Ata_Adi+" "+ogluqizi;



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

function TarixKontrol(deyer) {
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
    var YoxlanisNeticesi = Yoxla.replace(/[^0-9.]/g, "");
    InputIcerikDeyeri.value = YoxlanisNeticesi;
    return;
  } 
}



function SelectAlaniSecildi(deyer) {
  document.getElementById(deyer).style.color = "#2A3F54";
  document.getElementById(deyer).style.borderColor = "#2A3F54";
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




function YeniTehsil() {		
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/YeniTehsil.php", true);
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



function TehsilSenediYukle(theForm) {
  var parcala=theForm.id.split("_");
  var formid="tehsilform_"+parcala[1];
  var labelid="label_"+parcala[1];
  var senedler="senedler_"+parcala[1];
  var deyere="file_"+parcala[1];
  var fileadi=[];
  for(var i = 0; i < document.getElementById(deyere).files.length; i++) {
   var adi=document.getElementById(deyere).files[i].name;
   var boyut=document.getElementById(deyere).files[i].size;
   var uzantitap=adi.split(".");
   var   uzanti = uzantitap[uzantitap.length-1];    
   if (uzanti==="PDF" || uzanti==="pdf" || uzanti=="RAR" || uzanti=="rar" || uzanti=="ZIP" || uzanti=="zip" ) {
    if ( boyut<=5242880) {
      fileadi.push(adi);
      document.getElementById(labelid).innerHTML=fileadi;        
    }else{
     alert("Sənədin həcmi 5Mb dən böyük ola bilməz.");
     return;
   }    
 }else{
  alert("İcazə verilən sənədlər pdf və ya rar olmalıdır.");
  return;
}   
}
document.getElementById("yuklemealanikapsayici").style.display = "block";
$.ajax({

  url:"EtrafliMelumat/TehsilSenedYuklenmesi.php",
  type:"POST",
  data:new FormData(theForm),
  contentType:false,
  cache:false,
  processData:false,
  success: function(data) {  
   document.getElementById("yuklemealanikapsayici").style.display = "none";        
   veri=JSON.parse(data);
   if (veri.status=="error") {
    alert("Yüklənmə nəticəsi "+veri.message);
  }    if (veri.status=="success") {
    document.getElementById(senedler).innerHTML=veri.message;
  }
}
});
}







function YeniTehsilFormKontrol() {
  var Tehsil_Aldigi_Muesise = document.getElementById("Tehsil_Aldigi_Muesise");	
  var Ixtisas = document.getElementById("Ixtisas");	
  var Tehsil = document.getElementById("Tehsil");	
  var ID = document.getElementById("ID");	
  var Qebul_Tarixi = document.getElementById("Qebul_Tarixi");	
  var Bitirdiyi_Tarix = document.getElementById("Bitirdiyi_Tarix");	
  if(Tehsil_Aldigi_Muesise.value === '') {
   error(Tehsil_Aldigi_Muesise);
   return;
 }
 if(Ixtisas.value === '') {
   error(Ixtisas);
   return;
 }

 if(Tehsil.value === '') {
   error(Tehsil);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Qebul_Tarixi.value === '') {
   error(Qebul_Tarixi);
   return;
 }
 if(Bitirdiyi_Tarix.value === '') {
   error(Bitirdiyi_Tarix);
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
  var Tehsil_Aldigi_Muesise = document.getElementById("Tehsil_Aldigi_Muesise");	
  var Ixtisas = document.getElementById("Ixtisas");	
  var Tehsil = document.getElementById("Tehsil");	
  var ID = document.getElementById("ID");	
  var Qebul_Tarixi = document.getElementById("Qebul_Tarixi");	
  var Bitirdiyi_Tarix = document.getElementById("Bitirdiyi_Tarix");	
  if(Tehsil_Aldigi_Muesise.value === '') {
   error(Tehsil_Aldigi_Muesise);
   return;
 }
 if(Ixtisas.value === '') {
   error(Ixtisas);
   return;
 }

 if(Tehsil.value === '') {
   error(Tehsil);
   return;
 }


 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Qebul_Tarixi.value === '') {
   error(Qebul_Tarixi);
   return;
 }

 if(Bitirdiyi_Tarix.value === '') {
   error(Bitirdiyi_Tarix);
   return;
 }

 var deyer = {
   Tehsil_Aldigi_Muesise:Tehsil_Aldigi_Muesise.value,	
   Ixtisas:Ixtisas.value,	
   Tehsil:Tehsil.value,
   Qebul_Tarixi:Qebul_Tarixi.value,
   Bitirdiyi_Tarix:Bitirdiyi_Tarix.value,
   ID:ID.value	
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Yeni_Tehsil_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") {	
     erroraskfoks(Mezuniyyet_Novleri_Ad,"Adı boş ola  bilməz");		
   }
   else if (cavab=="error_2002") {	
     erroraskfoks(Mezuniyyet_Novleri_Ad,"Qıssa adı boş ola  bilməz");	
   }
   else if (cavab=="error_2003") {	
     erroraskfoks(Mezuniyyet_Novleri_Ad,"Uğursuz");
   }
   else if (cavab=="error_2004") {	
     erroraskfoks(Mezuniyyet_Novleri_Ad,"Kontyrol silinmesi uğursuz");		
   }
   else if (cavab=="error_2005") {	
     erroraskfoks(Mezuniyyet_Novleri_Ad,"Uğursuz");		
   }
   else if (cavab=="error_2006") { 
    document.getElementById("SilKaratmaAlani").style.display = "none";
    document.getElementById("SilModalAlani").style.display = "none";
    document.getElementById("SilModalMetinAlani").innerHTML = "";
    document.getElementById("SilIslemiOnayButonu").href = "";
    document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
    document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    document.getElementById("errorcavabi").innerHTML = "";
    document.getElementById("errorcavabi").innerHTML = "Yeni Melumat Elave Olunmadi";
    errorcavab(Tehsil_Aldigi_Muesise);
    errorcavab(Ixtisas);
    errorcavab(Tehsil);
    errorcavab(Qebul_Tarixi);
    errorcavab(Bitirdiyi_Tarix);


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
   document.getElementById("etraflitehsilid").innerHTML = "";
   document.getElementById("etraflitehsilid").innerHTML = cavab;

 }	
}
}
}


function TehsilSenedSil(deyere){
  var parcala=deyere.split("_");
  var id=parcala[1];
  var senedlerid="senedler_"+parcala[1];
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Tehsil_Sened_Sil_Islemleri.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      var cavab=JSON.parse(this.responseText.trim());
      if (cavab.status==="success") {
        document.getElementById(senedlerid).innerHTML=cavab.message
      }
    }
  }
}

function TehsilSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Təhsili silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Tehsil_Sil_Islemleri.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      var cavab=this.responseText.trim();
      document.getElementById("etraflitehsilid").innerHTML="";
      document.getElementById("etraflitehsilid").innerHTML=cavab;
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    }
  }
}


function YeniTutduguVezife() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/YeniTutduguVezife.php", true);
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



function YeniTutduguVezifeFormKontrol() {
  var Idare_Ad = document.getElementById("Idare_Ad"); 
  var Sobe_Ad = document.getElementById("Sobe_Ad"); 
  var Vezife_Ad = document.getElementById("Vezife_Ad"); 
  var ID = document.getElementById("ID"); 
  var Vezifeye_Teyin_Tarixi = document.getElementById("Vezifeye_Teyin_Tarixi"); 
  var Vezifeden_Azad_Olunma_Tarixi = document.getElementById("Vezifeden_Azad_Olunma_Tarixi"); 
  var Sebeb = document.getElementById("Sebeb"); 

  if(Idare_Ad.value === '') {
   error(Idare_Ad);
   return;
 }

 if(Sobe_Ad.value === '') {
   error(Sobe_Ad);
   return;
 }

 if(Vezife_Ad.value === '') {
   error(Vezife_Ad);
   return;
 }
 if(Sebeb.value === '') {
   error(Sebeb);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Vezifeye_Teyin_Tarixi.value === '') {
   error(Vezifeye_Teyin_Tarixi);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:YeniTutduguVezifeFormKontrol()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function YeniTutduguVezifeFormKontrol() {
  var Idare_Ad = document.getElementById("Idare_Ad"); 
  var Sobe_Ad = document.getElementById("Sobe_Ad"); 
  var Vezife_Ad = document.getElementById("Vezife_Ad"); 
  var ID = document.getElementById("ID"); 
  var Vezifeye_Teyin_Tarixi = document.getElementById("Vezifeye_Teyin_Tarixi"); 
  var Vezifeden_Azad_Olunma_Tarixi = document.getElementById("Vezifeden_Azad_Olunma_Tarixi"); 
  var Sebeb = document.getElementById("Sebeb"); 

  if(Idare_Ad.value === '') {
   error(Idare_Ad);
   return;
 }

 if(Sobe_Ad.value === '') {
   error(Sobe_Ad);
   return;
 }

 if(Vezife_Ad.value === '') {
   error(Vezife_Ad);
   return;
 }
 if(Sebeb.value === '') {
   error(Sebeb);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Vezifeye_Teyin_Tarixi.value === '') {
   error(Vezifeye_Teyin_Tarixi);
   return;
 }


 var deyer = {
   Idare_Ad:Idare_Ad.value, 
   Sobe_Ad:Sobe_Ad.value, 
   Vezife_Ad:Vezife_Ad.value,
   Sebeb:Sebeb.value,
   Vezifeye_Teyin_Tarixi:Vezifeye_Teyin_Tarixi.value,
   Vezifeden_Azad_Olunma_Tarixi:Vezifeden_Azad_Olunma_Tarixi.value,
   ID:ID.value  
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Yeni_Tutdugu_Vezifeye_Teyin_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") {  
     erroraskfoks(Idare_Ad,"İdarə adı boş ola bilməz!");   
   }
   else if (cavab=="error_2002") {  
     erroraskfoks(Sobe_Ad,"Şöbə adı boş ola bilməz!"); 
   }
   else if (cavab=="error_2003") {  
     erroraskfoks(Vezife_Ad,"Vəzifə adı boş ola bilməz!");
   }
   else if (cavab=="error_2004") {  
     erroraskfoks(Sebeb,"Səbəb boş ola bilməz!");    
   }
   else if (cavab=="error_2005") {  
     erroraskfoks(ID,"Uğursuz");   
   }
   else if (cavab=="error_2006") {  
     erroraskfoks(Vezifeye_Teyin_Tarixi,"Təyin tarixi");   
   }
   else if (cavab=="error_2007") { 
    document.getElementById("SilKaratmaAlani").style.display = "none";
    document.getElementById("SilModalAlani").style.display = "none";
    document.getElementById("SilModalMetinAlani").innerHTML = "";
    document.getElementById("SilIslemiOnayButonu").href = "";
    document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
    document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    document.getElementById("errorcavabi").innerHTML = "";
    document.getElementById("errorcavabi").innerHTML = "Yeni Melumat Elave Olunmadi";
    errorcavab(ID);
    errorcavab(Sebeb);
    errorcavab(Vezife_Ad);
    errorcavab(Sobe_Ad);
    errorcavab(Idare_Ad);
    errorcavab(Vezifeye_Teyin_Tarixi);
    errorcavab(Vezifeden_Azad_Olunma_Tarixi);


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
   document.getElementById("etraflitutduguvezife").innerHTML = "";
   document.getElementById("etraflitutduguvezife").innerHTML = cavab;

 }  
}
}
}


function TutduguVezifeDuzenle(deyer) {    
  var deyer=deyer.split("_");
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Tutdugu_Vezife_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("yeni="+deyer[1]);
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var cavab=this.responseText.trim();
      modalici(cavab);
    }
  } 
}


function YeniTutduguVezifeDuzenleFormKontrol() {
  var Idare_Ad = document.getElementById("Idare_Ad"); 
  var Sobe_Ad = document.getElementById("Sobe_Ad"); 
  var Vezife_Ad = document.getElementById("Vezife_Ad"); 
  var User_Islediyi_Vezife_Id = document.getElementById("User_Islediyi_Vezife_Id"); 
  var Vezifeye_Teyin_Tarixi = document.getElementById("Vezifeye_Teyin_Tarixi"); 
  var Vezifeden_Azad_Olunma_Tarixi = document.getElementById("Vezifeden_Azad_Olunma_Tarixi"); 
  var Sebeb = document.getElementById("Sebeb"); 

  if(Idare_Ad.value === '') {
   error(Idare_Ad);
   return;
 }

 if(Sobe_Ad.value === '') {
   error(Sobe_Ad);
   return;
 }

 if(Vezife_Ad.value === '') {
   error(Vezife_Ad);
   return;
 }
 if(Sebeb.value === '') {
   error(Sebeb);
   return;
 }


 if(Vezifeye_Teyin_Tarixi.value === '') {
   error(Vezifeye_Teyin_Tarixi);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:TutduguVezifeForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}


function TutduguVezifeForm() {
  var Idare_Ad = document.getElementById("Idare_Ad"); 
  var Sobe_Ad = document.getElementById("Sobe_Ad"); 
  var Vezife_Ad = document.getElementById("Vezife_Ad"); 
  var User_Islediyi_Vezife_Id = document.getElementById("User_Islediyi_Vezife_Id"); 
  var Vezifeye_Teyin_Tarixi = document.getElementById("Vezifeye_Teyin_Tarixi"); 
  var Vezifeden_Azad_Olunma_Tarixi = document.getElementById("Vezifeden_Azad_Olunma_Tarixi"); 
  var Sebeb = document.getElementById("Sebeb"); 

  if(Idare_Ad.value === '') {
   error(Idare_Ad);
   return;
 }

 if(Sobe_Ad.value === '') {
   error(Sobe_Ad);
   return;
 }

 if(Vezife_Ad.value === '') {
   error(Vezife_Ad);
   return;
 }
 if(Sebeb.value === '') {
   error(Sebeb);
   return;
 }



 if(Vezifeye_Teyin_Tarixi.value === '') {
   error(Vezifeye_Teyin_Tarixi);
   return;
 }


 var deyer = {
   Idare_Ad:Idare_Ad.value, 
   Sobe_Ad:Sobe_Ad.value, 
   Vezife_Ad:Vezife_Ad.value,
   Sebeb:Sebeb.value,
   Vezifeye_Teyin_Tarixi:Vezifeye_Teyin_Tarixi.value,
   Vezifeden_Azad_Olunma_Tarixi:Vezifeden_Azad_Olunma_Tarixi.value,
   User_Islediyi_Vezife_Id:User_Islediyi_Vezife_Id.value,
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Tutdugu_Vezifeye_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") {  
     erroraskfoks(Idare_Ad,"İdarə adı boş ola bilməz!");   
   }
   else if (cavab=="error_2002") {  
     erroraskfoks(Sobe_Ad,"Şöbə adı boş ola bilməz!"); 
   }
   else if (cavab=="error_2003") {  
     erroraskfoks(Vezife_Ad,"Vəzifə adı boş ola bilməz!");
   }
   else if (cavab=="error_2004") {  
     erroraskfoks(Sebeb,"Səbəb boş ola bilməz!");    
   }
   else if (cavab=="error_2005") {  
     erroraskfoks(ID,"Uğursuz");   
   }
   else if (cavab=="error_2006") {  
     erroraskfoks(Vezifeye_Teyin_Tarixi,"Təyin tarixi");   
   }
   else if (cavab=="error_2007") { 
    document.getElementById("SilKaratmaAlani").style.display = "none";
    document.getElementById("SilModalAlani").style.display = "none";
    document.getElementById("SilModalMetinAlani").innerHTML = "";
    document.getElementById("SilIslemiOnayButonu").href = "";
    document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
    document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    document.getElementById("errorcavabi").innerHTML = "";
    document.getElementById("errorcavabi").innerHTML = "Yeni Melumat Elave Olunmadi";
    errorcavab(ID);
    errorcavab(Sebeb);
    errorcavab(Vezife_Ad);
    errorcavab(Sobe_Ad);
    errorcavab(Idare_Ad);
    errorcavab(Vezifeye_Teyin_Tarixi);
    errorcavab(Vezifeden_Azad_Olunma_Tarixi);


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
   document.getElementById("etraflitutduguvezife").innerHTML = "";
   document.getElementById("etraflitutduguvezife").innerHTML = cavab;

 }  
}
}
}

function TutduguVezifeSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Təhsili silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:Tutdugu_Vezife_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Tutdugu_Vezife_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Tutdugu_Vezife_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      var cavab=this.responseText.trim();
      document.getElementById("etraflitutduguvezife").innerHTML="";
      document.getElementById("etraflitutduguvezife").innerHTML=cavab;
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    }
  }
}


function YeniHeveslendirmeTedbirleri() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Heveslendirme_Tedbiri_Yeni.php", true);
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



function HeveslendirmeTedbirleriYeniFormKontrol() {
  var Heveslendirem_Tedbirleri_Ad_Id = document.getElementById("Heveslendirem_Tedbirleri_Ad_Id"); 
  var Hevesledirme_Tedbirleri_Sebeb = document.getElementById("Hevesledirme_Tedbirleri_Sebeb"); 
  var ID = document.getElementById("ID"); 
  var Hevesledirme_Tedbirleri_Tarix = document.getElementById("Hevesledirme_Tedbirleri_Tarix");
  var Hevesledirme_Tedbirleri_Emrinin_Nomresi = document.getElementById("Hevesledirme_Tedbirleri_Emrinin_Nomresi");

  if(Heveslendirem_Tedbirleri_Ad_Id.value === '') {
   error(Heveslendirem_Tedbirleri_Ad_Id);
   return;
 }

 if(Hevesledirme_Tedbirleri_Sebeb.value === '') {
   error(Hevesledirme_Tedbirleri_Sebeb);
   return;
 }

 if(ID.value === '') {
   error(ID);
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

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:HeveslendirmeTedbirleriYeniForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function HeveslendirmeTedbirleriYeniForm(){
  var Heveslendirem_Tedbirleri_Ad_Id = document.getElementById("Heveslendirem_Tedbirleri_Ad_Id"); 
  var Hevesledirme_Tedbirleri_Sebeb = document.getElementById("Hevesledirme_Tedbirleri_Sebeb"); 
  var Hevesledirme_Tedbirleri_Tarix = document.getElementById("Hevesledirme_Tedbirleri_Tarix"); 
  var Hevesledirme_Tedbirleri_Emrinin_Nomresi = document.getElementById("Hevesledirme_Tedbirleri_Emrinin_Nomresi"); 
  var ID = document.getElementById("ID"); 

  if(Heveslendirem_Tedbirleri_Ad_Id.value === '') {
   error(Heveslendirem_Tedbirleri_Ad_Id);
   return;
 }

 if(Hevesledirme_Tedbirleri_Sebeb.value === '') {
   error(Hevesledirme_Tedbirleri_Sebeb);
   return;
 }

 if(Hevesledirme_Tedbirleri_Emrinin_Nomresi.value === '') {
   error(Hevesledirme_Tedbirleri_Emrinin_Nomresi);
   return;
 }

 if(Hevesledirme_Tedbirleri_Tarix.value === '') {
   error(Hevesledirme_Tedbirleri_Tarix);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 var deyer = {
   Heveslendirem_Tedbirleri_Ad_Id:Heveslendirem_Tedbirleri_Ad_Id.value, 
   Hevesledirme_Tedbirleri_Sebeb:Hevesledirme_Tedbirleri_Sebeb.value, 
   Hevesledirme_Tedbirleri_Tarix:Hevesledirme_Tedbirleri_Tarix.value,
   Hevesledirme_Tedbirleri_Emrinin_Nomresi:Hevesledirme_Tedbirleri_Emrinin_Nomresi.value,
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Heveslendirme_Tedbiri_Yeni_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") {  
     erroraskfoks(Heveslendirem_Tedbirleri_Ad_Id,"Boş ola bilməz");   
   }
   else if (cavab=="error_2002") {  
     erroraskfoks(Hevesledirme_Tedbirleri_Sebeb,"Səbəb boş ola bilməz"); 
   }
   else if (cavab=="error_2003") {  
     erroraskfoks(Hevesledirme_Tedbirleri_Emrinin_Nomresi,"Əmrin nömrəsin qeyd edin!");
   }

   else if (cavab=="error_2004") {  
     erroraskfoks(ID,"Uğursuz");   
   }
   else if (cavab=="error_2005") {  
     erroraskfoks(Hevesledirme_Tedbirleri_Tarix,"Təyin tarixi");   
   }
   else if (cavab=="error_2006") { 
    document.getElementById("SilKaratmaAlani").style.display = "none";
    document.getElementById("SilModalAlani").style.display = "none";
    document.getElementById("SilModalMetinAlani").innerHTML = "";
    document.getElementById("SilIslemiOnayButonu").href = "";
    document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
    document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    document.getElementById("errorcavabi").innerHTML = "";
    document.getElementById("errorcavabi").innerHTML = "Yeni Melumat Elave Olunmadi";
    errorcavab(Heveslendirem_Tedbirleri_Ad_Id);
    errorcavab(Hevesledirme_Tedbirleri_Sebeb);
    errorcavab(Hevesledirme_Tedbirleri_Emrinin_Nomresi);
    errorcavab(ID);
    errorcavab(Hevesledirme_Tedbirleri_Tarix);
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
   document.getElementById("tedbiqolunmusheveslendirme").innerHTML = "";
   document.getElementById("tedbiqolunmusheveslendirme").innerHTML = cavab;

 }  
}
}
}


function HeveslendirmeTedbiriDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Heveslendirme_Tedbiri_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyse=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}





function HeveslendirmeTedbirleriDuzenleFormKontrol() {
  var Heveslendirem_Tedbirleri_Ad_Id = document.getElementById("Heveslendirem_Tedbirleri_Ad_Id"); 
  var Hevesledirme_Tedbirleri_Sebeb = document.getElementById("Hevesledirme_Tedbirleri_Sebeb"); 
  var Hevesledirme_Tedbirleri_Id = document.getElementById("Hevesledirme_Tedbirleri_Id"); 
  var Hevesledirme_Tedbirleri_Tarix = document.getElementById("Hevesledirme_Tedbirleri_Tarix");
  var Hevesledirme_Tedbirleri_Emrinin_Nomresi = document.getElementById("Hevesledirme_Tedbirleri_Emrinin_Nomresi");

  if(Heveslendirem_Tedbirleri_Ad_Id.value === '') {
   error(Heveslendirem_Tedbirleri_Ad_Id);
   return;
 }

 if(Hevesledirme_Tedbirleri_Sebeb.value === '') {
   error(Hevesledirme_Tedbirleri_Sebeb);
   return;
 }

 if(Hevesledirme_Tedbirleri_Id.value === '') {
   error(Hevesledirme_Tedbirleri_Id);
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

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:HeveslendirmeTedbirleriDuzenleForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function HeveslendirmeTedbirleriDuzenleForm(){
  var Heveslendirem_Tedbirleri_Ad_Id = document.getElementById("Heveslendirem_Tedbirleri_Ad_Id"); 
  var Hevesledirme_Tedbirleri_Sebeb = document.getElementById("Hevesledirme_Tedbirleri_Sebeb"); 
  var Hevesledirme_Tedbirleri_Tarix = document.getElementById("Hevesledirme_Tedbirleri_Tarix"); 
  var Hevesledirme_Tedbirleri_Emrinin_Nomresi = document.getElementById("Hevesledirme_Tedbirleri_Emrinin_Nomresi"); 
  var Hevesledirme_Tedbirleri_Id = document.getElementById("Hevesledirme_Tedbirleri_Id"); 

  if(Heveslendirem_Tedbirleri_Ad_Id.value === '') {
   error(Heveslendirem_Tedbirleri_Ad_Id);
   return;
 }

 if(Hevesledirme_Tedbirleri_Sebeb.value === '') {
   error(Hevesledirme_Tedbirleri_Sebeb);
   return;
 }

 if(Hevesledirme_Tedbirleri_Emrinin_Nomresi.value === '') {
   error(Hevesledirme_Tedbirleri_Emrinin_Nomresi);
   return;
 }

 if(Hevesledirme_Tedbirleri_Tarix.value === '') {
   error(Hevesledirme_Tedbirleri_Tarix);
   return;
 }
 if(Hevesledirme_Tedbirleri_Id.value === '') {
   error(Hevesledirme_Tedbirleri_Id);
   return;
 }
 var deyer = {
   Heveslendirem_Tedbirleri_Ad_Id:Heveslendirem_Tedbirleri_Ad_Id.value, 
   Hevesledirme_Tedbirleri_Sebeb:Hevesledirme_Tedbirleri_Sebeb.value, 
   Hevesledirme_Tedbirleri_Tarix:Hevesledirme_Tedbirleri_Tarix.value,
   Hevesledirme_Tedbirleri_Emrinin_Nomresi:Hevesledirme_Tedbirleri_Emrinin_Nomresi.value,
   Hevesledirme_Tedbirleri_Id:Hevesledirme_Tedbirleri_Id.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Heveslendirme_Tedbiri_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") {  
     erroraskfoks(Heveslendirem_Tedbirleri_Ad_Id,"Boş ola bilməz");   
   }
   else if (cavab=="error_2002") {  
     erroraskfoks(Hevesledirme_Tedbirleri_Sebeb,"Səbəb boş ola bilməz"); 
   }
   else if (cavab=="error_2003") {  
     erroraskfoks(Hevesledirme_Tedbirleri_Emrinin_Nomresi,"Əmrin nömrəsin qeyd edin!");
   }

   else if (cavab=="error_2004") {  
     erroraskfoks(ID,"Uğursuz");   
   }
   else if (cavab=="error_2005") {  
     erroraskfoks(Hevesledirme_Tedbirleri_Tarix,"Təyin tarixi");   
   }
   else if (cavab=="error_2006") { 
    document.getElementById("SilKaratmaAlani").style.display = "none";
    document.getElementById("SilModalAlani").style.display = "none";
    document.getElementById("SilModalMetinAlani").innerHTML = "";
    document.getElementById("SilIslemiOnayButonu").href = "";
    document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
    document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    document.getElementById("errorcavabi").innerHTML = "";
    document.getElementById("errorcavabi").innerHTML = "Yeni Melumat Elave Olunmadi";
    errorcavab(Heveslendirem_Tedbirleri_Ad_Id);
    errorcavab(Hevesledirme_Tedbirleri_Sebeb);
    errorcavab(Hevesledirme_Tedbirleri_Emrinin_Nomresi);
    errorcavab(ID);
    errorcavab(Hevesledirme_Tedbirleri_Tarix);
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
   document.getElementById("tedbiqolunmusheveslendirme").innerHTML = "";
   document.getElementById("tedbiqolunmusheveslendirme").innerHTML = cavab;

 }  
}
}
}


function HeveslendirmeTedbiriSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Təhsili silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:Heveslendirme_Tedbirleri_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Heveslendirme_Tedbirleri_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Heveslendirme_Tedbirleri_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      if (cavab=="error_2001") {  
       erroraskfoks(Heveslendirem_Tedbirleri_Ad_Id,"Boş ola bilməz");   
     }
     else if (cavab=="error_2002") {  
       erroraskfoks(Hevesledirme_Tedbirleri_Sebeb,"Səbəb boş ola bilməz"); 
     }
     else if (cavab=="error_2003") {  
       erroraskfoks(Hevesledirme_Tedbirleri_Emrinin_Nomresi,"Əmrin nömrəsin qeyd edin!");
     }

     else if (cavab=="error_2004") {  
       erroraskfoks(ID,"Uğursuz");   
     }
     else if (cavab=="error_2005") {  
       erroraskfoks(Hevesledirme_Tedbirleri_Tarix,"Təyin tarixi");   
     }
     else if (cavab=="error_2006") { 

     }
     else{ 
       document.getElementById("SilKaratmaAlani").style.display = "none";
       document.getElementById("SilModalAlani").style.display = "none";
       document.getElementById("SilModalMetinAlani").innerHTML = "";
       document.getElementById("SilIslemiOnayButonu").href = "";
       document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
       document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";     
       document.getElementById("tedbiqolunmusheveslendirme").innerHTML = "";
       document.getElementById("tedbiqolunmusheveslendirme").innerHTML = cavab;

     }  

   }
 }
}



function YeniIntizamTenbehi() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Intizam_Tenbehleri_Yeni.php", true);
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



function IntizamTedbirleriYeniFormKontrol() {
  var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id"); 
  var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix"); 
  var ID = document.getElementById("ID"); 
  var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");
  var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");

  if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
   error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
   return;
 }

 if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
   error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Intizam_Tenbehi_Sebeb.value === '') {
   error(Intizam_Tenbehi_Sebeb);
   return;
 }
 if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
   error(Intizam_Tenbehi_Emrinin_Nomresi);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:IntizamTedbirleriYeniForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function IntizamTedbirleriYeniForm(){
  var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id"); 
  var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix"); 
  var Intizam_Tenbehinin_Bitis_Tarixi = document.getElementById("Intizam_Tenbehinin_Bitis_Tarixi"); 
  var ID = document.getElementById("ID"); 
  var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");
  var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");

  if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
   error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
   return;
 }

 if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
   error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Intizam_Tenbehi_Sebeb.value === '') {
   error(Intizam_Tenbehi_Sebeb);
   return;
 }
 if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
   error(Intizam_Tenbehi_Emrinin_Nomresi);
   return;
 }
 var deyer = {
   Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value, 
   Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value, 
   Intizam_Tenbehi_Sebeb:Intizam_Tenbehi_Sebeb.value,
   Intizam_Tenbehi_Emrinin_Nomresi:Intizam_Tenbehi_Emrinin_Nomresi.value,
   Intizam_Tenbehinin_Bitis_Tarixi:Intizam_Tenbehinin_Bitis_Tarixi.value,
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Intizam_Tenbehi_Yeni_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") {  
     erroraskfoks(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,"Boş ola bilməz");   
   }
   else if (cavab=="error_2002") {  
     erroraskfoks(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,"Səbəb boş ola bilməz"); 
   }
   else if (cavab=="error_2003") {  
     erroraskfoks(Intizam_Tenbehi_Emrinin_Nomresi,"Əmrin nömrəsin qeyd edin!");
   }

   else if (cavab=="error_2004") {  
     erroraskfoks(ID,"Uğursuz");   
   }
   else if (cavab=="error_2005") {  
     erroraskfoks(Intizam_Tenbehi_Sebeb,"Təyin tarixi");   
   }
   else if (cavab=="error_2006") { 
    document.getElementById("SilKaratmaAlani").style.display = "none";
    document.getElementById("SilModalAlani").style.display = "none";
    document.getElementById("SilModalMetinAlani").innerHTML = "";
    document.getElementById("SilIslemiOnayButonu").href = "";
    document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
    document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    document.getElementById("errorcavabi").innerHTML = "";
    document.getElementById("errorcavabi").innerHTML = "Yeni Melumat Elave Olunmadi";
    errorcavab(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
    errorcavab(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
    errorcavab(Intizam_Tenbehi_Emrinin_Nomresi);
    errorcavab(ID);
    errorcavab(Intizam_Tenbehi_Sebeb);
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
   document.getElementById("etraflitedbiqolunmusintizam").innerHTML = "";
   document.getElementById("etraflitedbiqolunmusintizam").innerHTML = cavab;

 }  
}
}
}



function IntizamTedbiriDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Intizam_Tenbehi_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyse=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}




function IntizamTedbirleriDuzenleFormKontrol() {
  var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id"); 
  var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix"); 
  var Intizam_Tenbehi_Id = document.getElementById("Intizam_Tenbehi_Id"); 
  var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");
  var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");

  if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
   error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
   return;
 }

 if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
   error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
   return;
 }

 if(Intizam_Tenbehi_Id.value === '') {
   error(Intizam_Tenbehi_Id);
   return;
 }

 if(Intizam_Tenbehi_Sebeb.value === '') {
   error(Intizam_Tenbehi_Sebeb);
   return;
 }
 if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
   error(Intizam_Tenbehi_Emrinin_Nomresi);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:IntizamTedbirleriDuzenleForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function IntizamTedbirleriDuzenleForm(){
  var Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id = document.getElementById("Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id"); 
  var Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix = document.getElementById("Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix"); 
  var Intizam_Tenbehinin_Bitis_Tarixi = document.getElementById("Intizam_Tenbehinin_Bitis_Tarixi"); 
  var Intizam_Tenbehi_Id = document.getElementById("Intizam_Tenbehi_Id"); 
  var Intizam_Tenbehi_Sebeb = document.getElementById("Intizam_Tenbehi_Sebeb");
  var Intizam_Tenbehi_Emrinin_Nomresi = document.getElementById("Intizam_Tenbehi_Emrinin_Nomresi");

  if(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value === '') {
   error(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
   return;
 }

 if(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value === '') {
   error(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
   return;
 }

 if(Intizam_Tenbehi_Id.value === '') {
   error(Intizam_Tenbehi_Id);
   return;
 }

 if(Intizam_Tenbehi_Sebeb.value === '') {
   error(Intizam_Tenbehi_Sebeb);
   return;
 }
 if(Intizam_Tenbehi_Emrinin_Nomresi.value === '') {
   error(Intizam_Tenbehi_Emrinin_Nomresi);
   return;
 }
 var deyer = {
   Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id:Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id.value, 
   Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix:Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix.value, 
   Intizam_Tenbehi_Sebeb:Intizam_Tenbehi_Sebeb.value,
   Intizam_Tenbehi_Emrinin_Nomresi:Intizam_Tenbehi_Emrinin_Nomresi.value,
   Intizam_Tenbehinin_Bitis_Tarixi:Intizam_Tenbehinin_Bitis_Tarixi.value,
   Intizam_Tenbehi_Id:Intizam_Tenbehi_Id.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Intizam_Tenbehi_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") {  
     erroraskfoks(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id,"Boş ola bilməz");   
   }
   else if (cavab=="error_2002") {  
     erroraskfoks(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix,"Səbəb boş ola bilməz"); 
   }
   else if (cavab=="error_2003") {  
     erroraskfoks(Intizam_Tenbehi_Emrinin_Nomresi,"Əmrin nömrəsin qeyd edin!");
   }

   else if (cavab=="error_2004") {  
     erroraskfoks(ID,"Uğursuz");   
   }
   else if (cavab=="error_2005") {  
     erroraskfoks(Intizam_Tenbehi_Sebeb,"Təyin tarixi");   
   }
   else if (cavab=="error_2006") { 
    document.getElementById("SilKaratmaAlani").style.display = "none";
    document.getElementById("SilModalAlani").style.display = "none";
    document.getElementById("SilModalMetinAlani").innerHTML = "";
    document.getElementById("SilIslemiOnayButonu").href = "";
    document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
    document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
    document.getElementById("errorcavabi").innerHTML = "";
    document.getElementById("errorcavabi").innerHTML = "Yeni Melumat Elave Olunmadi";
    errorcavab(Intizam_Tenbehi_Itizam_Tenbehi_Adalari_Id);
    errorcavab(Intizam_Tenbehinin_Tedbiq_Edildiyi_Tarix);
    errorcavab(Intizam_Tenbehi_Emrinin_Nomresi);
    errorcavab(ID);
    errorcavab(Intizam_Tenbehi_Sebeb);
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
   document.getElementById("etraflitedbiqolunmusintizam").innerHTML = "";
   document.getElementById("etraflitedbiqolunmusintizam").innerHTML = cavab;

 }  
}
}
}


function IntizamTedbiriSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Təhsili silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:Intizam_Tenbehi_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Intizam_Tenbehi_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Intizam_Tenbehi_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {

      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      if (cavab=="error_2001") {  
       erroraskfoks(Heveslendirem_Tedbirleri_Ad_Id,"Boş ola bilməz");   
     }
     else if (cavab=="error_2002") {  
       erroraskfoks(Hevesledirme_Tedbirleri_Sebeb,"Səbəb boş ola bilməz"); 
     }
     else if (cavab=="error_2003") {  
       erroraskfoks(Hevesledirme_Tedbirleri_Emrinin_Nomresi,"Əmrin nömrəsin qeyd edin!");
     }

     else if (cavab=="error_2004") {  
       erroraskfoks(ID,"Uğursuz");   
     }
     else if (cavab=="error_2005") {  
       erroraskfoks(Hevesledirme_Tedbirleri_Tarix,"Təyin tarixi");   
     }
     else if (cavab=="error_2006") { 

     }
     else{ 
       document.getElementById("SilKaratmaAlani").style.display = "none";
       document.getElementById("SilModalAlani").style.display = "none";
       document.getElementById("SilModalMetinAlani").innerHTML = "";
       document.getElementById("SilIslemiOnayButonu").href = "";
       document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
       document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";     
       document.getElementById("etraflitedbiqolunmusintizam").innerHTML = "";
       document.getElementById("etraflitedbiqolunmusintizam").innerHTML = cavab;

     }  

   }
 }
}



function YeniEtrafliRutbe() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Rutbe_Yeni.php", true);
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



function RutbeYeniFormKontrol() {
  var Rutbe_Id = document.getElementById("Rutbe_Id"); 
  var Rutbe_Emri_Tarixi = document.getElementById("Rutbe_Emri_Tarixi"); 
  var ID = document.getElementById("ID"); 
  var Rutbe_Emri_Novu = document.getElementById("Rutbe_Emri_Novu");
  var Rutbe_Emrinin_No = document.getElementById("Rutbe_Emrinin_No");

  if(Rutbe_Id.value === '') {
   error(Rutbe_Id);
   return;
 }

 if(Rutbe_Emri_Tarixi.value === '') {
   error(Rutbe_Emri_Tarixi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Rutbe_Emri_Novu.value === '') {
   error(Rutbe_Emri_Novu);
   return;
 }
 if(Rutbe_Emrinin_No.value === '') {
   error(Rutbe_Emrinin_No);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:RutbeYeniForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function RutbeYeniForm(){
  var Rutbe_Id = document.getElementById("Rutbe_Id"); 
  var Rutbe_Emri_Tarixi = document.getElementById("Rutbe_Emri_Tarixi"); 
  var ID = document.getElementById("ID"); 
  var Rutbe_Emri_Novu = document.getElementById("Rutbe_Emri_Novu");
  var Rutbe_Emrinin_No = document.getElementById("Rutbe_Emrinin_No");

  if(Rutbe_Id.value === '') {
   error(Rutbe_Id);
   return;
 }

 if(Rutbe_Emri_Tarixi.value === '') {
   error(Rutbe_Emri_Tarixi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Rutbe_Emri_Novu.value === '') {
   error(Rutbe_Emri_Novu);
   return;
 }

 var deyer = {
   Rutbe_Id:Rutbe_Id.value, 
   Rutbe_Emri_Tarixi:Rutbe_Emri_Tarixi.value, 
   Rutbe_Emri_Novu:Rutbe_Emri_Novu.value,
   Rutbe_Emrinin_No:Rutbe_Emrinin_No.value,
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Rutbe_Yeni_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Boş alanları doldurun!";
      errorcavab(Rutbe_Id);
      errorcavab(Rutbe_Emri_Tarixi);
      errorcavab(Rutbe_Emrinin_No);
      errorcavab(ID);
      errorcavab(Intizam_Tenbehi_Sebeb);
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
     document.getElementById("etrafli_rutbe_melumati").innerHTML = "";
     document.getElementById("etrafli_rutbe_melumati").innerHTML = cavab;

   }  
 }
}
}


function RutbeDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Rutbe_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyse=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}




function RutbeDuzenleFormKontrol() {
  var Rutbe_Id = document.getElementById("Rutbe_Id"); 
  var Rutbe_Emri_Tarixi = document.getElementById("Rutbe_Emri_Tarixi"); 
  var Rutbe_Emri_Id = document.getElementById("Rutbe_Emri_Id"); 
  var Rutbe_Emri_Novu = document.getElementById("Rutbe_Emri_Novu");
  var Rutbe_Emrinin_No = document.getElementById("Rutbe_Emrinin_No");

  if(Rutbe_Id.value === '') {
   error(Rutbe_Id);
   return;
 }

 if(Rutbe_Emri_Tarixi.value === '') {
   error(Rutbe_Emri_Tarixi);
   return;
 }

 if(Rutbe_Emri_Id.value === '') {
   error(Rutbe_Emri_Id);
   return;
 }

 if(Rutbe_Emri_Novu.value === '') {
   error(Rutbe_Emri_Novu);
   return;
 }
 if(Rutbe_Emrinin_No.value === '') {
   error(Rutbe_Emrinin_No);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:RutbeDuzenleForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function RutbeDuzenleForm(){
  var Rutbe_Id = document.getElementById("Rutbe_Id"); 
  var Rutbe_Emri_Tarixi = document.getElementById("Rutbe_Emri_Tarixi"); 
  var Rutbe_Emri_Id = document.getElementById("Rutbe_Emri_Id"); 
  var Rutbe_Emri_Novu = document.getElementById("Rutbe_Emri_Novu");
  var Rutbe_Emrinin_No = document.getElementById("Rutbe_Emrinin_No");
  var ID = document.getElementById("ID");

  if(Rutbe_Id.value === '') {
   error(Rutbe_Id);
   return;
 }

 if(Rutbe_Emri_Tarixi.value === '') {
   error(Rutbe_Emri_Tarixi);
   return;
 }

 if(Rutbe_Emri_Id.value === '') {
   error(Rutbe_Emri_Id);
   return;
 }

 if(Rutbe_Emri_Novu.value === '') {
   error(Rutbe_Emri_Novu);
   return;
 }

 var deyer = {
   Rutbe_Id:Rutbe_Id.value, 
   Rutbe_Emri_Tarixi:Rutbe_Emri_Tarixi.value, 
   Rutbe_Emri_Novu:Rutbe_Emri_Novu.value,
   Rutbe_Emrinin_No:Rutbe_Emrinin_No.value,
   ID:ID.value,
   Rutbe_Emri_Id:Rutbe_Emri_Id.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Rutbe_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Boş alanları doldurun!";
      errorcavab(Rutbe_Id);
      errorcavab(Rutbe_Emri_Tarixi);
      errorcavab(Rutbe_Emrinin_No);
      errorcavab(Rutbe_Emri_Id);
      errorcavab(Intizam_Tenbehi_Sebeb);
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
     document.getElementById("etrafli_rutbe_melumati").innerHTML = "";
     document.getElementById("etrafli_rutbe_melumati").innerHTML = cavab;

   }  
 }
}
}



function RutbeSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Təhsili silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:Rutbe_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}
function Rutbe_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Rutbe_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";     
      document.getElementById("etrafli_rutbe_melumati").innerHTML = "";
      document.getElementById("etrafli_rutbe_melumati").innerHTML = cavab;
    }
  }
}



function YeniRutbeSekliYukle(theForm) {
  var parcala=theForm.id.split("_");
  var formid="RutbesekilFormu_"+parcala[1];
  var labelid="rutbeimage_"+parcala[1];
  var senedler="senedler_"+parcala[1];
  var deyere="Rutbesekli_"+parcala[1];
  var fileadi=[];
  for(var i = 0; i < document.getElementById(deyere).files.length; i++) {
   var adi=document.getElementById(deyere).files[i].name;
   var boyut=document.getElementById(deyere).files[i].size;
   var uzantitap=adi.split(".");
   var   uzanti = uzantitap[uzantitap.length-1];    
   if (uzanti==="jpg" || uzanti==="JPG" || uzanti=="png" || uzanti=="PNG") {
    if ( boyut<=5242880) {
      var input = document.getElementById(deyere);
      var reader = new FileReader();
      reader.onload = function(){
        var dataURL = reader.result;
        var output = document.getElementById(labelid);
        output.src = dataURL;
      };
      reader.readAsDataURL(input.files[0]);      
    }else{
     alert("Sənədin həcmi 5Mb dən böyük ola bilməz.");
     return;
   }    
 }else{
  alert("İcazə verilən sənədlər jpg və ya png olmalıdır.");
  return;
}   
}
document.getElementById("yuklemealanikapsayici").style.display = "block";
$.ajax({
  url:"EtrafliMelumat/Rutbe_Sekil_Yukle.php",
  type:"POST",
  data:new FormData(theForm),
  contentType:false,
  cache:false,
  processData:false,
  success: function(data) {  
   document.getElementById("yuklemealanikapsayici").style.display = "none";        
   veri=JSON.parse(data);
   if (veri.status=="error") {
    alert("Yüklənmə nəticəsi "+veri.message);
  }    if (veri.status=="success") {
    document.getElementById(senedler).innerHTML=veri.message;
  }
}
});
}


function YeniEzamiyye() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Ezamiyye_Yeni.php", true);
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




function EzamiyyeYeniFormKontrol() {
  var Ezam_Olundugu_Yer = document.getElementById("Ezam_Olundugu_Yer"); 
  var Ezam_Sebebi = document.getElementById("Ezam_Sebebi"); 
  var ID = document.getElementById("ID"); 
  var Ezam_Baslangic_Tarixi = document.getElementById("Ezam_Baslangic_Tarixi");
  var Ezam_Bitis_Tarixi = document.getElementById("Ezam_Bitis_Tarixi");
  var Ezam_Emri_No = document.getElementById("Ezam_Emri_No");
  var Ezam_Gun_Sayi = document.getElementById("Ezam_Gun_Sayi");

  if(Ezam_Olundugu_Yer.value === '') {
   error(Ezam_Olundugu_Yer);
   return;
 }

 if(Ezam_Sebebi.value === '') {
   error(Ezam_Sebebi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Ezam_Baslangic_Tarixi.value === '') {
   error(Ezam_Baslangic_Tarixi);
   return;
 }
 if(Ezam_Bitis_Tarixi.value === '') {
   error(Ezam_Bitis_Tarixi);
   return;
 }

 if(Ezam_Emri_No.value === '') {
   error(Ezam_Emri_No);
   return;
 }
 if(Ezam_Gun_Sayi.value === '') {
   error(Ezam_Gun_Sayi);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:EzamiyyeYeniForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function EzamiyyeYeniForm(){
  var Ezam_Olundugu_Yer = document.getElementById("Ezam_Olundugu_Yer"); 
  var Ezam_Sebebi = document.getElementById("Ezam_Sebebi"); 
  var Ezam_Baslangic_Tarixi = document.getElementById("Ezam_Baslangic_Tarixi"); 
  var ID = document.getElementById("ID"); 
  var Ezam_Bitis_Tarixi = document.getElementById("Ezam_Bitis_Tarixi");
  var Ezam_Emri_No = document.getElementById("Ezam_Emri_No");
  var Ezam_Gun_Sayi = document.getElementById("Ezam_Gun_Sayi");

  if(Ezam_Olundugu_Yer.value === '') {
   error(Ezam_Olundugu_Yer);
   return;
 }

 if(Ezam_Sebebi.value === '') {
   error(Ezam_Sebebi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Ezam_Baslangic_Tarixi.value === '') {
   error(Ezam_Baslangic_Tarixi);
   return;
 }
 if(Ezam_Bitis_Tarixi.value === '') {
   error(Ezam_Bitis_Tarixi);
   return;
 }
 if(Ezam_Emri_No.value === '') {
   error(Ezam_Emri_No);
   return;
 }
 if(Ezam_Gun_Sayi.value === '') {
   error(Ezam_Gun_Sayi);
   return;
 }
 var deyer = {
   Ezam_Olundugu_Yer:Ezam_Olundugu_Yer.value, 
   Ezam_Sebebi:Ezam_Sebebi.value, 
   Ezam_Baslangic_Tarixi:Ezam_Baslangic_Tarixi.value,
   Ezam_Bitis_Tarixi:Ezam_Bitis_Tarixi.value,
   Ezam_Emri_No:Ezam_Emri_No.value,
   Ezam_Gun_Sayi:Ezam_Gun_Sayi.value,
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Ezamiyye_Yeni_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Ezam_Olundugu_Yer);
      errorcavab(Ezam_Sebebi);
      errorcavab(Ezam_Bitis_Tarixi);
      errorcavab(Ezam_Baslangic_Tarixi);
      errorcavab(ID);
      errorcavab(Intizam_Tenbehi_Sebeb);
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
     document.getElementById("etraflitezamiyye").innerHTML = "";
     document.getElementById("etraflitezamiyye").innerHTML = cavab;

   }  
 }
}
}


function EzamiyyeDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Ezamiyye_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Ezamiyye_Emri_Id=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}



function EzamiyyeDuzenleFormKontrol() {
  var Ezam_Olundugu_Yer = document.getElementById("Ezam_Olundugu_Yer"); 
  var Ezam_Sebebi = document.getElementById("Ezam_Sebebi"); 
  var Ezamiyye_Emri_Id = document.getElementById("Ezamiyye_Emri_Id"); 
  var Ezam_Baslangic_Tarixi = document.getElementById("Ezam_Baslangic_Tarixi");
  var Ezam_Bitis_Tarixi = document.getElementById("Ezam_Bitis_Tarixi");
  var Ezam_Emri_No = document.getElementById("Ezam_Emri_No");
  var ID = document.getElementById("ID");
  var Ezam_Gun_Sayi = document.getElementById("Ezam_Gun_Sayi");

  if(Ezam_Olundugu_Yer.value === '') {
   error(Ezam_Olundugu_Yer);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Ezam_Sebebi.value === '') {
   error(Ezam_Sebebi);
   return;
 }

 if(Ezamiyye_Emri_Id.value === '') {
   error(Ezamiyye_Emri_Id);
   return;
 }

 if(Ezam_Baslangic_Tarixi.value === '') {
   error(Ezam_Baslangic_Tarixi);
   return;
 }
 if(Ezam_Bitis_Tarixi.value === '') {
   error(Ezam_Bitis_Tarixi);
   return;
 }

 if(Ezam_Emri_No.value === '') {
   error(Ezam_Emri_No);
   return;
 }
 if(Ezam_Gun_Sayi.value === '') {
   error(Ezam_Gun_Sayi);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:EzamiyyeDuzenleForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function EzamiyyeDuzenleForm(){
  var Ezam_Olundugu_Yer = document.getElementById("Ezam_Olundugu_Yer"); 
  var Ezam_Sebebi = document.getElementById("Ezam_Sebebi"); 
  var Ezam_Baslangic_Tarixi = document.getElementById("Ezam_Baslangic_Tarixi"); 
  var Ezamiyye_Emri_Id = document.getElementById("Ezamiyye_Emri_Id"); 
  var Ezam_Bitis_Tarixi = document.getElementById("Ezam_Bitis_Tarixi");
  var Ezam_Emri_No = document.getElementById("Ezam_Emri_No");
  var ID = document.getElementById("ID");
  var Ezam_Gun_Sayi = document.getElementById("Ezam_Gun_Sayi");

  if(Ezam_Olundugu_Yer.value === '') {
   error(Ezam_Olundugu_Yer);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Ezam_Sebebi.value === '') {
   error(Ezam_Sebebi);
   return;
 }

 if(Ezamiyye_Emri_Id.value === '') {
   error(Ezamiyye_Emri_Id);
   return;
 }

 if(Ezam_Baslangic_Tarixi.value === '') {
   error(Ezam_Baslangic_Tarixi);
   return;
 }
 if(Ezam_Bitis_Tarixi.value === '') {
   error(Ezam_Bitis_Tarixi);
   return;
 }
 if(Ezam_Emri_No.value === '') {
   error(Ezam_Emri_No);
   return;
 }
 if(Ezam_Gun_Sayi.value === '') {
   error(Ezam_Gun_Sayi);
   return;
 }
 var deyer = {
   Ezam_Olundugu_Yer:Ezam_Olundugu_Yer.value, 
   Ezam_Sebebi:Ezam_Sebebi.value, 
   Ezam_Baslangic_Tarixi:Ezam_Baslangic_Tarixi.value,
   Ezam_Bitis_Tarixi:Ezam_Bitis_Tarixi.value,
   Ezam_Emri_No:Ezam_Emri_No.value,
   ID:ID.value,
   Ezam_Gun_Sayi:Ezam_Gun_Sayi.value,
   Ezamiyye_Emri_Id:Ezamiyye_Emri_Id.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Ezamiyye_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Ezam_Olundugu_Yer);
      errorcavab(Ezam_Sebebi);
      errorcavab(Ezam_Bitis_Tarixi);
      errorcavab(Ezam_Baslangic_Tarixi);
      errorcavab(ID);
      errorcavab(Intizam_Tenbehi_Sebeb);
      errorcavab(Ezam_Gun_Sayi);
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
     document.getElementById("etraflitezamiyye").innerHTML = "";
     document.getElementById("etraflitezamiyye").innerHTML = cavab;
   }  
 }
}
}

function EzamiyyeSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Ezamiyye silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:Ezamiyye_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}
function Ezamiyye_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Ezamiyye_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";     
      document.getElementById("etraflitezamiyye").innerHTML = "";
      document.getElementById("etraflitezamiyye").innerHTML = cavab;
    }
  }
}


function YeniAttestasiya() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Attestasiya_Yeni.php", true);
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



function AttestasiyaYeniFormKontrol() {
  var Attestasiya_Idare_Adi = document.getElementById("Attestasiya_Idare_Adi"); 
  var Attestasiya_Sobe_Adi = document.getElementById("Attestasiya_Sobe_Adi"); 
  var ID = document.getElementById("ID"); 
  var Attestasiya_Vezife_Adi = document.getElementById("Attestasiya_Vezife_Adi");
  var Attestasiya_Tarix = document.getElementById("Attestasiya_Tarix");
  var Attestasiya_Qerar = document.getElementById("Attestasiya_Qerar");
  var Attestasiya_Emr_No = document.getElementById("Attestasiya_Emr_No");

  if(Attestasiya_Idare_Adi.value === '') {
   error(Attestasiya_Idare_Adi);
   return;
 }

 if(Attestasiya_Sobe_Adi.value === '') {
   error(Attestasiya_Sobe_Adi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Attestasiya_Vezife_Adi.value === '') {
   error(Attestasiya_Vezife_Adi);
   return;
 }
 if(Attestasiya_Tarix.value === '') {
   error(Attestasiya_Tarix);
   return;
 }

 if(Attestasiya_Qerar.value === '') {
   error(Attestasiya_Qerar);
   return;
 }
 if(Attestasiya_Emr_No.value === '') {
   error(Attestasiya_Emr_No);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:AttestasiyaYeniForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function AttestasiyaYeniForm(){
  var Attestasiya_Idare_Adi = document.getElementById("Attestasiya_Idare_Adi"); 
  var Attestasiya_Sobe_Adi = document.getElementById("Attestasiya_Sobe_Adi"); 
  var Attestasiya_Vezife_Adi = document.getElementById("Attestasiya_Vezife_Adi"); 
  var ID = document.getElementById("ID"); 
  var Attestasiya_Tarix = document.getElementById("Attestasiya_Tarix");
  var Attestasiya_Qerar = document.getElementById("Attestasiya_Qerar");
  var Attestasiya_Emr_No = document.getElementById("Attestasiya_Emr_No");

  if(Attestasiya_Idare_Adi.value === '') {
   error(Attestasiya_Idare_Adi);
   return;
 }

 if(Attestasiya_Sobe_Adi.value === '') {
   error(Attestasiya_Sobe_Adi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Attestasiya_Vezife_Adi.value === '') {
   error(Attestasiya_Vezife_Adi);
   return;
 }
 if(Attestasiya_Tarix.value === '') {
   error(Attestasiya_Tarix);
   return;
 }
 if(Attestasiya_Qerar.value === '') {
   error(Attestasiya_Qerar);
   return;
 }
 if(Attestasiya_Emr_No.value === '') {
   error(Attestasiya_Emr_No);
   return;
 }
 var deyer = {
   Attestasiya_Idare_Adi:Attestasiya_Idare_Adi.value, 
   Attestasiya_Sobe_Adi:Attestasiya_Sobe_Adi.value, 
   Attestasiya_Vezife_Adi:Attestasiya_Vezife_Adi.value,
   Attestasiya_Tarix:Attestasiya_Tarix.value,
   Attestasiya_Qerar:Attestasiya_Qerar.value,
   Attestasiya_Emr_No:Attestasiya_Emr_No.value,
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Attestasiya_Yeni_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Attestasiya_Idare_Adi);
      errorcavab(Attestasiya_Sobe_Adi);
      errorcavab(Attestasiya_Tarix);
      errorcavab(Attestasiya_Vezife_Adi);
      errorcavab(ID);
      errorcavab(Attestasiya_Emr_No);
      errorcavab(Attestasiya_Qerar);
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
     document.getElementById("etrafliattestasiya").innerHTML = "";
     document.getElementById("etrafliattestasiya").innerHTML = cavab;

   }  
 }
}
}

function AttestasiyaDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Attestasiya_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Attestasiya_Id=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}



function AttestasiyaDuzenleFormKontrol() {
  var Attestasiya_Idare_Adi = document.getElementById("Attestasiya_Idare_Adi"); 
  var Attestasiya_Sobe_Adi = document.getElementById("Attestasiya_Sobe_Adi"); 
  var ID = document.getElementById("ID"); 
  var Attestasiya_Vezife_Adi = document.getElementById("Attestasiya_Vezife_Adi");
  var Attestasiya_Tarix = document.getElementById("Attestasiya_Tarix");
  var Attestasiya_Qerar = document.getElementById("Attestasiya_Qerar");
  var Attestasiya_Emr_No = document.getElementById("Attestasiya_Emr_No");
  var Attestasiya_Id = document.getElementById("Attestasiya_Id");

  if(Attestasiya_Id.value === '') {
   error(Attestasiya_Id);
   return;
 }

 if(Attestasiya_Idare_Adi.value === '') {
   error(Attestasiya_Idare_Adi);
   return;
 }

 if(Attestasiya_Sobe_Adi.value === '') {
   error(Attestasiya_Sobe_Adi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Attestasiya_Vezife_Adi.value === '') {
   error(Attestasiya_Vezife_Adi);
   return;
 }
 if(Attestasiya_Tarix.value === '') {
   error(Attestasiya_Tarix);
   return;
 }

 if(Attestasiya_Qerar.value === '') {
   error(Attestasiya_Qerar);
   return;
 }
 if(Attestasiya_Emr_No.value === '') {
   error(Attestasiya_Emr_No);
   return;
 }

 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:AttestasiyaDuzenleForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}

function AttestasiyaDuzenleForm(){
  var Attestasiya_Idare_Adi = document.getElementById("Attestasiya_Idare_Adi"); 
  var Attestasiya_Sobe_Adi = document.getElementById("Attestasiya_Sobe_Adi"); 
  var Attestasiya_Vezife_Adi = document.getElementById("Attestasiya_Vezife_Adi"); 
  var ID = document.getElementById("ID"); 
  var Attestasiya_Tarix = document.getElementById("Attestasiya_Tarix");
  var Attestasiya_Qerar = document.getElementById("Attestasiya_Qerar");
  var Attestasiya_Emr_No = document.getElementById("Attestasiya_Emr_No");
  var Attestasiya_Id = document.getElementById("Attestasiya_Id");

  if(Attestasiya_Id.value === '') {
   error(Attestasiya_Id);
   return;
 }
 if(Attestasiya_Idare_Adi.value === '') {
   error(Attestasiya_Idare_Adi);
   return;
 }

 if(Attestasiya_Sobe_Adi.value === '') {
   error(Attestasiya_Sobe_Adi);
   return;
 }

 if(ID.value === '') {
   error(ID);
   return;
 }

 if(Attestasiya_Vezife_Adi.value === '') {
   error(Attestasiya_Vezife_Adi);
   return;
 }
 if(Attestasiya_Tarix.value === '') {
   error(Attestasiya_Tarix);
   return;
 }
 if(Attestasiya_Qerar.value === '') {
   error(Attestasiya_Qerar);
   return;
 }
 if(Attestasiya_Emr_No.value === '') {
   error(Attestasiya_Emr_No);
   return;
 }
 var deyer = {
   Attestasiya_Idare_Adi:Attestasiya_Idare_Adi.value, 
   Attestasiya_Sobe_Adi:Attestasiya_Sobe_Adi.value, 
   Attestasiya_Vezife_Adi:Attestasiya_Vezife_Adi.value,
   Attestasiya_Tarix:Attestasiya_Tarix.value,
   Attestasiya_Qerar:Attestasiya_Qerar.value,
   Attestasiya_Emr_No:Attestasiya_Emr_No.value,
   Attestasiya_Id:Attestasiya_Id.value,
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Attestasiya_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Attestasiya_Idare_Adi);
      errorcavab(Attestasiya_Sobe_Adi);
      errorcavab(Attestasiya_Tarix);
      errorcavab(Attestasiya_Vezife_Adi);
      errorcavab(ID);
      errorcavab(Attestasiya_Emr_No);
      errorcavab(Attestasiya_Qerar);
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
     document.getElementById("etrafliattestasiya").innerHTML = "";
     document.getElementById("etrafliattestasiya").innerHTML = cavab;

   }  
 }
}
}



function AttestasiyaSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Ezamiyye silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:Attestasiya_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}
function Attestasiya_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Attestasiya_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";     
      document.getElementById("etrafliattestasiya").innerHTML = "";
      document.getElementById("etrafliattestasiya").innerHTML = cavab;
    }
  }
}


function YeniXariciDil() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Xarici_Dil_Yeni.php", true);
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



function XariciDilYeniFormKontrol() {
  var Xarici_Dil_Ad = document.getElementById("Xarici_Dil_Ad"); 
  var Xarici_Dil_Sevye = document.getElementById("Xarici_Dil_Sevye"); 
  var ID = document.getElementById("ID");  
  if(Xarici_Dil_Ad.value === '') {
   error(Xarici_Dil_Ad);
   return;
 }
 if(Xarici_Dil_Sevye.value === '') {
   error(Xarici_Dil_Sevye);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:XariciDilYeniForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}
function XariciDilYeniForm(){
  var Xarici_Dil_Ad = document.getElementById("Xarici_Dil_Ad"); 
  var Xarici_Dil_Sevye = document.getElementById("Xarici_Dil_Sevye"); 
  var ID = document.getElementById("ID"); 
  if(Xarici_Dil_Ad.value === '') {
   error(Xarici_Dil_Ad);
   return;
 }
 if(Xarici_Dil_Sevye.value === '') {
   error(Xarici_Dil_Sevye);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 var deyer = {
   Xarici_Dil_Ad:Xarici_Dil_Ad.value, 
   Xarici_Dil_Sevye:Xarici_Dil_Sevye.value,   
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Xarici_Dil_Yeni_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Xarici_Dil_Ad);
      errorcavab(Xarici_Dil_Sevye);    
      errorcavab(ID);      
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
     document.getElementById("eraflixaricidil").innerHTML = "";
     document.getElementById("eraflixaricidil").innerHTML = cavab;

   }  
 }
}
}


function XariciDilDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Xarici_Dil_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("duzenle=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}



function XariciDilDuzenleFormKontrol() {
  var Xarici_Dil_Ad = document.getElementById("Xarici_Dil_Ad"); 
  var Xarici_Dil_Sevye = document.getElementById("Xarici_Dil_Sevye"); 
  var Xarici_Dil_Id = document.getElementById("Xarici_Dil_Id"); 
  var ID = document.getElementById("ID");  
  if(Xarici_Dil_Ad.value === '') {
   error(Xarici_Dil_Ad);
   return;
 }
 if(Xarici_Dil_Sevye.value === '') {
   error(Xarici_Dil_Sevye);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:XariciDilDuzenleForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}
function XariciDilDuzenleForm(){
  var Xarici_Dil_Ad = document.getElementById("Xarici_Dil_Ad"); 
  var Xarici_Dil_Sevye = document.getElementById("Xarici_Dil_Sevye"); 
  var Xarici_Dil_Id = document.getElementById("Xarici_Dil_Id"); 
  var ID = document.getElementById("ID"); 
  if(Xarici_Dil_Ad.value === '') {
   error(Xarici_Dil_Ad);
   return;
 }
 if(Xarici_Dil_Sevye.value === '') {
   error(Xarici_Dil_Sevye);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 var deyer = {
   Xarici_Dil_Ad:Xarici_Dil_Ad.value, 
   Xarici_Dil_Sevye:Xarici_Dil_Sevye.value,   
   Xarici_Dil_Id:Xarici_Dil_Id.value,   
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Xarici_Dil_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Xarici_Dil_Ad);
      errorcavab(Xarici_Dil_Sevye);    
      errorcavab(ID);      
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
     document.getElementById("eraflixaricidil").innerHTML = "";
     document.getElementById("eraflixaricidil").innerHTML = cavab;

   }  
 }
}
}


function XariciDilSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Ezamiyye silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:XariciDil_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}
function XariciDil_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Xarici_Dil_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";     
      document.getElementById("eraflixaricidil").innerHTML = "";
      document.getElementById("eraflixaricidil").innerHTML = cavab;
    }
  }
}



function YeniBankHesabi() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Bank_Hesabi_Yeni.php", true);
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



function BankHesabNoYeniFormKontrol() {
  var Bank_Hesab_Nomresi_Bank_Adi = document.getElementById("Bank_Hesab_Nomresi_Bank_Adi"); 
  var Bank_Hesab_Nomresi = document.getElementById("Bank_Hesab_Nomresi"); 
  var ID = document.getElementById("ID");  
  if(Bank_Hesab_Nomresi_Bank_Adi.value === '') {
   error(Bank_Hesab_Nomresi_Bank_Adi);
   return;
 }
 if(Bank_Hesab_Nomresi.value === '') {
   error(Bank_Hesab_Nomresi);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:BankHesabNoYeniForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}
function BankHesabNoYeniForm(){
  var Bank_Hesab_Nomresi_Bank_Adi = document.getElementById("Bank_Hesab_Nomresi_Bank_Adi"); 
  var Bank_Hesab_Nomresi = document.getElementById("Bank_Hesab_Nomresi"); 
  var ID = document.getElementById("ID"); 
  if(Bank_Hesab_Nomresi_Bank_Adi.value === '') {
   error(Bank_Hesab_Nomresi_Bank_Adi);
   return;
 }
 if(Bank_Hesab_Nomresi.value === '') {
   error(Bank_Hesab_Nomresi);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 var deyer = {
   Bank_Hesab_Nomresi_Bank_Adi:Bank_Hesab_Nomresi_Bank_Adi.value, 
   Bank_Hesab_Nomresi:Bank_Hesab_Nomresi.value,   
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Bank_Hesab_Nomresi_Yeni_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Bank_Hesab_Nomresi_Bank_Adi);
      errorcavab(Bank_Hesab_Nomresi);    
      errorcavab(ID);      
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
     document.getElementById("eraflibankhesabno").innerHTML = "";
     document.getElementById("eraflibankhesabno").innerHTML = cavab;

   }  
 }
}
}



function BankHesabiDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Bank_Hesab_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("duzenle=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}



function BankHesabNoDuzenleFormKontrol() {
  var Bank_Hesab_Nomresi_Bank_Adi = document.getElementById("Bank_Hesab_Nomresi_Bank_Adi"); 
  var Bank_Hesab_Nomresi = document.getElementById("Bank_Hesab_Nomresi"); 
  var Bank_Hesab_Nomresi_Id = document.getElementById("Bank_Hesab_Nomresi_Id"); 
  var ID = document.getElementById("ID");  
  if(Bank_Hesab_Nomresi_Bank_Adi.value === '') {
   error(Bank_Hesab_Nomresi_Bank_Adi);
   return;
 }

 if(Bank_Hesab_Nomresi_Id.value === '') {
   error(Bank_Hesab_Nomresi_Id);
   return;
 }
 if(Bank_Hesab_Nomresi.value === '') {
   error(Bank_Hesab_Nomresi);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 document.getElementById("SilKaratmaAlani").style.display = "block";
 document.getElementById("SilModalAlani").style.display = "block";
 document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
 document.getElementById("SilIslemiOnayButonu").href = "javascript:BankHesabNoDuzenleForm()";
 document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
 document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block"; 
}
function BankHesabNoDuzenleForm(){
  var Bank_Hesab_Nomresi_Bank_Adi = document.getElementById("Bank_Hesab_Nomresi_Bank_Adi"); 
  var Bank_Hesab_Nomresi = document.getElementById("Bank_Hesab_Nomresi"); 
  var Bank_Hesab_Nomresi_Id = document.getElementById("Bank_Hesab_Nomresi_Id"); 
  var ID = document.getElementById("ID"); 
  if(Bank_Hesab_Nomresi_Bank_Adi.value === '') {
   error(Bank_Hesab_Nomresi_Bank_Adi);
   return;
 }
 if(Bank_Hesab_Nomresi.value === '') {
   error(Bank_Hesab_Nomresi);
   return;
 }

 if(Bank_Hesab_Nomresi_Id.value === '') {
   error(Bank_Hesab_Nomresi_Id);
   return;
 }
 if(ID.value === '') {
   error(ID);
   return;
 }
 var deyer = {
   Bank_Hesab_Nomresi_Bank_Adi:Bank_Hesab_Nomresi_Bank_Adi.value, 
   Bank_Hesab_Nomresi:Bank_Hesab_Nomresi.value,   
   Bank_Hesab_Nomresi_Id:Bank_Hesab_Nomresi_Id.value,   
   ID:ID.value
 };
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var gonderilen=JSON.stringify(deyer);
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Bank_Hesab_Nomresi_Duzenle_Islemleri.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + gonderilen);
 xhttp.onreadystatechange = function (deyer) {
   if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var cavab=this.responseText.trim();
    if (cavab=="error_2001") { 
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
      document.getElementById("errorcavabi").innerHTML = "";
      document.getElementById("errorcavabi").innerHTML = "Xəta baş verdi";
      errorcavab(Bank_Hesab_Nomresi_Bank_Adi);
      errorcavab(Bank_Hesab_Nomresi);    
      errorcavab(ID);      
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
     document.getElementById("eraflibankhesabno").innerHTML = "";
     document.getElementById("eraflibankhesabno").innerHTML = cavab;

   }  
 }
}
}

function BankHesabiSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  document.getElementById("SilKaratmaAlani").style.display = "block";
  document.getElementById("SilModalAlani").style.display = "block";
  document.getElementById("SilModalMetinAlani").innerHTML = "<b>Ezamiyye silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  document.getElementById("SilIslemiOnayButonu").href = "javascript:BankHesabi_Sil_Tesdiq(" + deyer[1] + ")";
  document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
  document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}
function BankHesabi_Sil_Tesdiq(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/BankHesabi_Sil.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Deyer=" + id);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      document.getElementById("SilKaratmaAlani").style.display = "none";
      document.getElementById("SilModalAlani").style.display = "none";
      document.getElementById("SilModalMetinAlani").innerHTML = "";
      document.getElementById("SilIslemiOnayButonu").href = "";
      document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
      document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";     
      document.getElementById("eraflibankhesabno").innerHTML = "";
      document.getElementById("eraflibankhesabno").innerHTML = cavab;
    }
  }
}


function YeniUsaq() {    
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Usaq_Yeni.php", true);
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

function UsaqYeniFormKontrol() {
  var UsaqSoyadi = document.getElementById("UsaqSoyadi"); 
  var UsaqAdi = document.getElementById("UsaqAdi"); 
  var UsaqAtaadi = document.getElementById("UsaqAtaadi"); 
  var Usaq_Dogum_Tarixi = document.getElementById("Usaq_Dogum_Tarixi"); 
  var ID = document.getElementById("ID");  
  if(UsaqSoyadi.value === '') {
   error(UsaqSoyadi);
   return;
 }
 if(UsaqAdi.value === '') {
   error(UsaqAdi);
   return;
 }
 if(UsaqAtaadi.value === '') {
   error(UsaqAtaadi);
   return;
 }
 if(Usaq_Dogum_Tarixi.value === '') {
   error(Usaq_Dogum_Tarixi);
   return;
 }else{
  var gun=(Usaq_Dogum_Tarixi.value.substr(0, 2));

  var ay=(Usaq_Dogum_Tarixi.value.substr(3, 2));

  var il=(Usaq_Dogum_Tarixi.value.substr(6, 4));
  var yaradilantarix=gun+"."+ay+"."+il;
  if (yaradilantarix.trim()!=Usaq_Dogum_Tarixi.value.trim()) {
   errorcavab(Usaq_Dogum_Tarixi)
   return;
 }
}
if(ID.value === '') {
 error(ID);
 return;
}
var deyerbir="Məlumatın düzgün olduğundan əmin olunggg. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
var deyeriki="javascript:UsaqYeniForm()";
Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function UsaqYeniForm(){
  var UsaqSoyadi = document.getElementById("UsaqSoyadi"); 
  var UsaqAdi = document.getElementById("UsaqAdi"); 
  var UsaqAtaadi = document.getElementById("UsaqAtaadi"); 
  var Usaq_Dogum_Tarixi = document.getElementById("Usaq_Dogum_Tarixi"); 
  var ID = document.getElementById("ID");  
  if(UsaqSoyadi.value === '') {
   error(UsaqSoyadi);
   return;
 }
 if(UsaqAdi.value === '') {
   error(UsaqAdi);
   return;
 }
 if(UsaqAtaadi.value === '') {
   error(UsaqAtaadi);
   return;
 }
 if(Usaq_Dogum_Tarixi.value === '') {
   error(Usaq_Dogum_Tarixi);
   return;
 }else{
  var gun=(Usaq_Dogum_Tarixi.value.substr(0, 2));

  var ay=(Usaq_Dogum_Tarixi.value.substr(3, 2));

  var il=(Usaq_Dogum_Tarixi.value.substr(6, 4));
  var yaradilantarix=gun+"."+ay+"."+il;
  if (yaradilantarix.trim()!=Usaq_Dogum_Tarixi.value.trim()) {
   errorcavab(Usaq_Dogum_Tarixi)
   return;
 }
}
if(ID.value === '') {
 error(ID);
 return;
}
var deyer = {
 UsaqSoyadi:UsaqSoyadi.value, 
 UsaqAdi:UsaqAdi.value,   
 UsaqAtaadi:UsaqAtaadi.value,   
 Usaq_Dogum_Tarixi:Usaq_Dogum_Tarixi.value,   
 ID:ID.value
};
document.getElementById("yuklemealanikapsayici").style.display = "block";
var gonderilen=JSON.stringify(deyer);
var xhttp = new XMLHttpRequest();
xhttp.open("POST", "EtrafliMelumat/Usaq_Yeni_Islemleri.php", true);
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
   errorcavab(UsaqSoyadi);
   errorcavab(UsaqAdi);
   errorcavab(UsaqAtaadi);
   errorcavab(Usaq_Dogum_Tarixi);
   document.getElementById("errorcavabi").innerHTML="";
   document.getElementById("errorcavabi").innerHTML=message;
   return;
 }else if (document.getElementById("status").value=="success") {
  Tesdiq_Modali_None();
  Modal_Ici_None();
  document.getElementById("etrafliusaqlari").innerHTML="";
  document.getElementById("etrafliusaqlari").innerHTML=data;

  
  
  var usaqsayi=document.getElementById("usaqlarininsayi").value;
  document.getElementById("personusaqsayi").value="";
  document.getElementById("personusaqsayi").value=usaqsayi;

  return;
}
}
}
}

function UsaqDuzenle(id) {
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  var deyer=id.split("_");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "EtrafliMelumat/Usaq_Duzenle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("duzenle=" + deyer[1]);
  xhttp.onreadystatechange = function (deyer) {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      var cavab=this.responseText.trim();
      modalici(cavab);      
    }
  }
}



function UsaqDuzenleFormKontrol() {
  var UsaqSoyadi = document.getElementById("UsaqSoyadi"); 
  var UsaqAdi = document.getElementById("UsaqAdi"); 
  var UsaqAtaadi = document.getElementById("UsaqAtaadi"); 
  var Usaq_Dogum_Tarixi = document.getElementById("Usaq_Dogum_Tarixi"); 
  var ID = document.getElementById("ID");  
  var User_Usaq_Id = document.getElementById("User_Usaq_Id");  
  if(UsaqSoyadi.value === '') {
   error(UsaqSoyadi);
   return;
 }


 if(UsaqAdi.value === '') {
   error(UsaqAdi);
   return;
 }
 if(UsaqAtaadi.value === '') {
   error(UsaqAtaadi);
   return;
 }
 if(Usaq_Dogum_Tarixi.value === '') {
   error(Usaq_Dogum_Tarixi);
   return;
 }else{
  var gun=(Usaq_Dogum_Tarixi.value.substr(0, 2));

  var ay=(Usaq_Dogum_Tarixi.value.substr(3, 2));

  var il=(Usaq_Dogum_Tarixi.value.substr(6, 4));
  var yaradilantarix=gun+"."+ay+"."+il;
  if (yaradilantarix.trim()!=Usaq_Dogum_Tarixi.value.trim()) {
   errorcavab(Usaq_Dogum_Tarixi)
   return;
 }
}
if(ID.value === '') {
 error(ID);
 return;
}
var deyerbir="Məlumatın düzgün olduğundan əmin olunggg. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
var deyeriki="javascript:UsaqDuzenleForm()";
Tesdiq_Modali_Block(deyerbir,deyeriki) 
}


function UsaqDuzenleForm(){
  var UsaqSoyadi = document.getElementById("UsaqSoyadi"); 
  var UsaqAdi = document.getElementById("UsaqAdi"); 
  var UsaqAtaadi = document.getElementById("UsaqAtaadi"); 
  var Usaq_Dogum_Tarixi = document.getElementById("Usaq_Dogum_Tarixi"); 
  var ID = document.getElementById("ID");  
  var User_Usaq_Id = document.getElementById("User_Usaq_Id");  
  if(UsaqSoyadi.value === '') {
   error(UsaqSoyadi);
   return;
 }
 if(UsaqAdi.value === '') {
   error(UsaqAdi);
   return;
 }
 if(UsaqAtaadi.value === '') {
   error(UsaqAtaadi);
   return;
 }
 if(Usaq_Dogum_Tarixi.value === '') {
   error(Usaq_Dogum_Tarixi);
   return;
 }else{
  var gun=(Usaq_Dogum_Tarixi.value.substr(0, 2));

  var ay=(Usaq_Dogum_Tarixi.value.substr(3, 2));

  var il=(Usaq_Dogum_Tarixi.value.substr(6, 4));
  var yaradilantarix=gun+"."+ay+"."+il;
  if (yaradilantarix.trim()!=Usaq_Dogum_Tarixi.value.trim()) {
   errorcavab(Usaq_Dogum_Tarixi)
   return;
 }
}
if(ID.value === '') {
 error(ID);
 return;
}
var deyer = {
 UsaqSoyadi:UsaqSoyadi.value, 
 UsaqAdi:UsaqAdi.value,   
 UsaqAtaadi:UsaqAtaadi.value,   
 Usaq_Dogum_Tarixi:Usaq_Dogum_Tarixi.value,   
 User_Usaq_Id:User_Usaq_Id.value,   
 ID:ID.value
};
document.getElementById("yuklemealanikapsayici").style.display = "block";
var gonderilen=JSON.stringify(deyer);
var xhttp = new XMLHttpRequest();
xhttp.open("POST", "EtrafliMelumat/Usaq_Duzenle_Islemleri.php", true);
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
   errorcavab(UsaqSoyadi);
   errorcavab(UsaqAdi);
   errorcavab(UsaqAtaadi);
   errorcavab(Usaq_Dogum_Tarixi);
   document.getElementById("errorcavabi").innerHTML="";
   document.getElementById("errorcavabi").innerHTML=message;
   return;
 }else if (document.getElementById("status").value=="success") {
  Tesdiq_Modali_None();
  Modal_Ici_None();
  document.getElementById("etrafliusaqlari").innerHTML="";
  document.getElementById("etrafliusaqlari").innerHTML=data;

  
  
  var usaqsayi=document.getElementById("usaqlarininsayi").value;
  document.getElementById("personusaqsayi").value="";
  document.getElementById("personusaqsayi").value=usaqsayi;

  return;
}
}
}
}
function UsaqSil(IDDegeri) {
  var deyer=IDDegeri.split("_");
  var deyerbir="<b>Silirsiniz .</b>Bunu təsdiq etsəniz bazadan həmin məlumat silinəcək";
  var deyeriki="javascript:Usaq_Sil_Tesdiq(" + deyer[1] + ")";
  Tesdiq_Modali_Block(deyerbir,deyeriki) 
  
}

function Usaq_Sil_Tesdiq(id) {
 document.getElementById("yuklemealanikapsayici").style.display = "block";
 var xhttp = new XMLHttpRequest();
 xhttp.open("POST", "EtrafliMelumat/Usaq_Sil.php", true);
 xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhttp.send("Deyer=" + id);
 xhttp.onreadystatechange = function (deyer) {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    var data=this.responseText.trim();
    
    Tesdiq_Modali_None();    
    document.getElementById("etrafliusaqlari").innerHTML="";
    document.getElementById("etrafliusaqlari").innerHTML=data;
    var usaqsayi=document.getElementById("usaqlarininsayi").value;
    document.getElementById("personusaqsayi").value="";
    document.getElementById("personusaqsayi").value=usaqsayi;
  }
}
}