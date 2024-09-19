SeyfeAdi("İşə qəbul əmri");

function modalici(cavab){
	document.getElementById("modalformalaniici").innerHTML = cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
	document.getElementById("yuklemealanikapsayici").style.display = "none"
}

function CedveliCagir(icerik){
	var dataTables = $('#'+icerik).DataTable({
		"bFilter" : false,               
		"bLengthChange": true,
		"lengthMenu": [[5,10,20,30,40,50,60,70,80,90, -1], [5,10,20,30,40,50,60,70,80,90, "Hamısı"]],
		"pageLength":5,
    "order": [], //Initial no order.
    "aaSorting": [],
    "searching": false,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "bAutoWidth": false,
    "responsive": true,
    'processing': true,
    "fixedHeader": false,   

    buttons: [    
    {extend: 'excel',
    title: 'İşə qəbul əmirləri',
    exportOptions: {
    	columns: [1,2,3,4,5,6,7,8,9,10,11],
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
  }, title: function() {
    return "<div class='datatitle'>İşə qəbul əmri</div>";
  } ,
  exportOptions: {
  	columns: [1,2,3,4,5,6,7,8,9,10,11],
  	stripHtml: false,
  }
}
],
pagingType: 'numbers',
    dom: '<"float-left"B><"float-right"f>rt<"row"<"col-6"l><"d-none"i><"col-sm-6"p>>',
});

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
function YeniImtina(){	
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IseQebulEmri/YeniImtina.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			document.getElementById("sec").innerHTML="";
			document.getElementById("sec").innerHTML=cavab;
			TarixFormati();
			document.getElementById("yenibut").removeAttribute("disabled");
			document.getElementById("yenibut").setAttribute("onclick", "Yeni()");
			document.getElementById("imtina").setAttribute("disabled", "disabled");
			document.getElementById("imtina").removeAttribute("onclick");
			document.getElementById("yaddas").setAttribute("disabled", "disabled");
			document.getElementById("yaddas").removeAttribute("onclick")
		}
	}	
}


function Bax(id) {
	var parcala=id.split("_");
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IseQebulEmri/IseQebulEmriBagisModal.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab=this.responseText.trim();
			document.getElementById("sec").innerHTML="";
			document.getElementById("sec").innerHTML=cavab;
			TarixFormati();
			document.getElementById("yuklemealanikapsayici").style.display = "none";
		}
	}	
}







function VakanYerleriSay(id) {
	document.getElementById(id).style.color = "#2A3F54";
	document.getElementById(id).style.borderColor = "#2A3F54";
	deyer=document.getElementById(id).value;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IseQebulEmri/Vakant.php", true);
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
	xhttp.open("POST", "IseQebulEmri/Idare_Stat_Vakant_Sobe_Teleb_Et.php", true);
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
	document.getElementById(id).style.color = "#2A3F54";
	document.getElementById(id).style.borderColor = "#2A3F54";
	var deyer=document.getElementById(id).value;
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IseQebulEmri/Sobe_Stat_Vakant_Vezife_Teleb_Et.php", true);
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



function Yaddas() {
	var User_Soy_Ad = document.getElementById("User_Soy_Ad");
	var User_Ad = document.getElementById("User_Ad");
	var User_Ata_Ad = document.getElementById("User_Ata_Ad");
	var User_Dogum_Tarixi = document.getElementById("User_Dogum_Tarixi");
	var User_Fin = document.getElementById("User_Fin");
	var User_Yasayis_Unvan = document.getElementById("User_Yasayis_Unvan");
	var User_Tehsil = document.getElementById("User_Tehsil");
	var User_Tehsil_Aldigi_Muesse = document.getElementById("User_Tehsil_Aldigi_Muesse");
	var Ixtisas = document.getElementById("Ixtisas");
	var User_Ise_Qebul_Tarixi = document.getElementById("User_Ise_Qebul_Tarixi");
	var Usre_Cinsiyeti = document.getElementById("Usre_Cinsiyeti");
	var User_Is_Novu = document.getElementById("User_Is_Novu");
	var Ise_Qebul_Emri_Nomresi = document.getElementById("Ise_Qebul_Emri_Nomresi");
	var Mezmun = document.getElementById("Mezmun");
	var User_Islediyi_Idare = document.getElementById("User_Islediyi_Idare");
	var User_Islediyi_Sobe_Bolme = document.getElementById("User_Islediyi_Sobe_Bolme");
	var User_Vezife = document.getElementById("User_Vezife");
	var SinaqMuddeti=document.getElementById('SinaqMuddeti');
	var SinaqMuddetiGunAy=document.getElementById('SinaqMuddetiGunAy');
	if(User_Soy_Ad.value === '') {
		error(User_Soy_Ad);
		return;
	}

	if(User_Ad.value === '') {
		error(User_Ad);
		return;
	}
	if(User_Ata_Ad.value === '') {
		error(User_Ata_Ad);
		return;
	}

	if(User_Dogum_Tarixi.value === '') {
		error(User_Dogum_Tarixi);
		return;
	}else{
		var gun=(User_Dogum_Tarixi.value.substr(0, 2));

		var ay=(User_Dogum_Tarixi.value.substr(3, 2));

		var il=(User_Dogum_Tarixi.value.substr(6, 4));
		var yaradilantarix=gun+"."+ay+"."+il;
		if (yaradilantarix.trim()!=User_Dogum_Tarixi.value.trim()) {
			errorcavab(User_Dogum_Tarixi)
			return;
		}
	}
	/*if(User_Fin.value === '') {
		error(User_Fin);
		return;
	}

	if(User_Fin.value.length != 7) {
		errorcavab(User_Fin);
		return;
	}*/
	if(User_Yasayis_Unvan.value === '') {
		error(User_Yasayis_Unvan);
		return;
	}
	if(User_Tehsil.value === '') {
		error(User_Tehsil);
		return;
	}
	if(User_Tehsil_Aldigi_Muesse.value === '') {
		error(User_Tehsil_Aldigi_Muesse);
		return;
	}

	if(Ixtisas.value === '') {
		error(Ixtisas);
		return;
	}
	if(User_Ise_Qebul_Tarixi.value === '') {
		error(User_Ise_Qebul_Tarixi);
		return;
	}
	if(Usre_Cinsiyeti.value === '') {
		error(Usre_Cinsiyeti);
		return;
	}
	if(SinaqMuddetiGunAy.value === '') {
		error(SinaqMuddetiGunAy);
		return;
	}
	if(SinaqMuddeti.value === '') {
		error(SinaqMuddeti);
		return;
	}
	if(User_Is_Novu.value === '') {
		error(User_Is_Novu);
		return;
	}
	if(Ise_Qebul_Emri_Nomresi.value === '') {
		error(Ise_Qebul_Emri_Nomresi);
		return;
	}


	if(User_Islediyi_Idare.value === '') {
		error(User_Islediyi_Idare);
		return;
	}
	if(User_Islediyi_Sobe_Bolme.value === '') {
		error(User_Islediyi_Sobe_Bolme);
		return;
	}
	if(User_Vezife.value === '') {
		error(User_Vezife);
		return;
	}
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:FormIslemleriKontrol()";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";	
}

function FormIslemleriKontrol(IDDegeri) {
	var User_Soy_Ad = document.getElementById("User_Soy_Ad");
	var User_Ad = document.getElementById("User_Ad");
	var User_Ata_Ad = document.getElementById("User_Ata_Ad");
	var User_Dogum_Tarixi = document.getElementById("User_Dogum_Tarixi");
	var User_Fin = document.getElementById("User_Fin");
	var User_Yasayis_Unvan = document.getElementById("User_Yasayis_Unvan");
	var User_Tehsil = document.getElementById("User_Tehsil");
	var User_Tehsil_Aldigi_Muesse = document.getElementById("User_Tehsil_Aldigi_Muesse");
	var Ixtisas = document.getElementById("Ixtisas");
	var User_Ise_Qebul_Tarixi = document.getElementById("User_Ise_Qebul_Tarixi");
	var Usre_Cinsiyeti = document.getElementById("Usre_Cinsiyeti");
	var User_Is_Novu = document.getElementById("User_Is_Novu");
	var Ise_Qebul_Emri_Nomresi = document.getElementById("Ise_Qebul_Emri_Nomresi");
	var Mezmun = document.getElementById("Mezmun");
	var User_Islediyi_Idare = document.getElementById("User_Islediyi_Idare");
	var User_Islediyi_Sobe_Bolme = document.getElementById("User_Islediyi_Sobe_Bolme");
	var User_Vezife = document.getElementById("User_Vezife");
	var SinaqMuddeti=document.getElementById('SinaqMuddeti');
	var SinaqMuddetiGunAy=document.getElementById('SinaqMuddetiGunAy');
	var ID=document.getElementById('ID');
	if(ID.value === '') {
		error(ID);
		return;
	}
	if(User_Soy_Ad.value === '') {
		error(User_Soy_Ad);
		return;
	}
	if(SinaqMuddetiGunAy.value === '') {
		error(SinaqMuddetiGunAy);
		return;
	}
	if(SinaqMuddeti.value === '') {
		error(SinaqMuddeti);
		return;
	}
	if(User_Ad.value === '') {
		error(User_Ad);
		return;
	}
	if(User_Ata_Ad.value === '') {
		error(User_Ata_Ad);
		return;
	}
	if(User_Dogum_Tarixi.value === '') {
		error(User_Dogum_Tarixi);
		return;
	}else{
		var gun=(User_Dogum_Tarixi.value.substr(0, 2));

		var ay=(User_Dogum_Tarixi.value.substr(3, 2));

		var il=(User_Dogum_Tarixi.value.substr(6, 4));
		var yaradilantarix=gun+"."+ay+"."+il;
		if (yaradilantarix.trim()!=User_Dogum_Tarixi.value.trim()) {
			errorcavab(User_Dogum_Tarixi)
			return;
		}
	}
	/*if(User_Fin.value === '') {
		error(User_Fin);
		return;
	}

	if(User_Fin.value.length != 7) {
		errorcavab(User_Fin);
		return;
	}*/
	if(User_Yasayis_Unvan.value === '') {
		error(User_Yasayis_Unvan);
		return;
	}
	if(User_Tehsil.value === '') {
		error(User_Tehsil);
		return;
	}
	if(User_Tehsil_Aldigi_Muesse.value === '') {
		error(User_Tehsil_Aldigi_Muesse);
		return;
	}

	if(Ixtisas.value === '') {
		error(Ixtisas);
		return;
	}

	if(User_Ise_Qebul_Tarixi.value === '') {
		error(User_Dogum_Tarixi);
		return;
	}else{
		var gun=(User_Ise_Qebul_Tarixi.value.substr(0, 2));

		var ay=(User_Ise_Qebul_Tarixi.value.substr(3, 2));

		var il=(User_Ise_Qebul_Tarixi.value.substr(6, 4));
		var yaradilantarix=gun+"."+ay+"."+il;
		if (yaradilantarix.trim()!=User_Ise_Qebul_Tarixi.value.trim()) {
			errorcavab(User_Ise_Qebul_Tarixi)
			return;
		}
	}

	if(Usre_Cinsiyeti.value === '') {
		error(Usre_Cinsiyeti);
		return;
	}
	if(User_Is_Novu.value === '') {
		error(User_Is_Novu);
		return;
	}
	if(Ise_Qebul_Emri_Nomresi.value === '') {
		error(Ise_Qebul_Emri_Nomresi);
		return;
	}
	if(User_Islediyi_Idare.value === '') {
		error(User_Islediyi_Idare);
		return;
	}
	if(User_Islediyi_Sobe_Bolme.value === '') {
		error(User_Islediyi_Sobe_Bolme);
		return;
	}
	if(User_Vezife.value === '') {
		error(User_Vezife);
		return;
	}


	var deyer = {User_Soy_Ad:User_Soy_Ad.value,
		User_Ad:User_Ad.value,
		User_Ata_Ad:User_Ata_Ad.value,
		User_Dogum_Tarixi:User_Dogum_Tarixi.value,
		/*User_Fin:User_Fin.value,*/
		User_Yasayis_Unvan:User_Yasayis_Unvan.value,
		User_Tehsil:User_Tehsil.value,
		User_Tehsil_Aldigi_Muesse:User_Tehsil_Aldigi_Muesse.value,
		Ixtisas:Ixtisas.value,
		User_Ise_Qebul_Tarixi:User_Ise_Qebul_Tarixi.value,
		Usre_Cinsiyeti:Usre_Cinsiyeti.value,
		User_Is_Novu:User_Is_Novu.value,
		Ise_Qebul_Emri_Nomresi:Ise_Qebul_Emri_Nomresi.value,
		Mezmun:Mezmun.value,
		User_Islediyi_Idare:User_Islediyi_Idare.value,
		User_Islediyi_Sobe_Bolme:User_Islediyi_Sobe_Bolme.value,
		User_Vezife:User_Vezife.value,
		SinaqMuddeti:SinaqMuddeti.value,
		ID:ID.value,
		SinaqMuddetiGunAy:SinaqMuddetiGunAy.value,
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();

	xhttp.open("POST", "IseQebulEmri/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			function Ugursuz_Islemleri(deyer){
				errorcavab(User_Soy_Ad);
				errorcavab(User_Ad);
				errorcavab(User_Ata_Ad);
				errorcavab(User_Dogum_Tarixi);
				errorcavab(User_Fin);
				errorcavab(User_Yasayis_Unvan);
				errorcavab(User_Tehsil);
				errorcavab(User_Tehsil_Aldigi_Muesse);
				errorcavab(Ixtisas);
				errorcavab(User_Ise_Qebul_Tarixi);
				errorcavab(Usre_Cinsiyeti);
				errorcavab(User_Is_Novu);
				errorcavab(Ise_Qebul_Emri_Nomresi);
				errorcavab(User_Vezife);
				errorcavab(User_Islediyi_Sobe_Bolme);
				errorcavab(User_Islediyi_Idare);	
				errorcavab(SinaqMuddetiGunAy);
				errorcavab(SinaqMuddeti);
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("errorcavabi").innerHTML="";
				document.getElementById("errorcavabi").innerHTML=deyer;
				document.getElementById("errorcavabi").style.display = "block";

			}

			if (cavab=="error_2001") {	
				erroraskfoks(User_Soy_Ad,"Soyadı boş ola bilməz");			
			}
			else 	if (cavab=="error_2002") {	
				erroraskfoks(User_Ad,"Adı boş ola bilməz");			
			}
			else 	if (cavab=="error_2003") {	
				erroraskfoks(User_Ata_Ad,"Ata adı boş ola bilməz");			
			}
			else 	if (cavab=="error_2004") {	
				erroraskfoks(User_Dogum_Tarixi,"Doğum tarixi boş ola bilməz");			
			}
			else 	if (cavab=="error_2005") {	
				erroraskfoks(User_Fin,"FİN boş ola bilməz");			
			}
			else 	if (cavab=="error_2006") {	
				erroraskfoks(User_Fin,"Bu Fin bazada var");			
			}
			else 	if (cavab=="error_2007") {	
				erroraskfoks(User_Yasayis_Unvan,"Yaşayış ünvanı boş ola bilməz");			
			}
			else 	if (cavab=="error_2008") {	
				erroraskfoks(User_Tehsil,"Təhsil secimi boş ola bilməz");			
			}
			else 	if (cavab=="error_2009") {	
				erroraskfoks(User_Tehsil_Aldigi_Muesse,"Təhsil aldığı müəsisə boş ola bilməz");			
			}

			else 	if (cavab=="error_2023") {	
				erroraskfoks(Ixtisas,"Təhsil aldığı ixtisas");			
			}
			else 	if (cavab=="error_2010") {	
				erroraskfoks(User_Ise_Qebul_Tarixi,"İşə qəbul tarixi boş ola bilməz");			
			}
			else 	if (cavab=="error_2011") {	
				erroraskfoks(Usre_Cinsiyeti,"Cinsiyyəti boş ola bilməz");			
			}
			else 	if (cavab=="error_2012") {	
				erroraskfoks(User_Is_Novu,"işin növü boş ola bilməz");			
			}
			else 	if (cavab=="error_2013") {	
				erroraskfoks(User_Islediyi_Idare,"Təyin olunduğu idarə secilməlidir");			
			}
			else 	if (cavab=="error_2014") {	
				erroraskfoks(User_Islediyi_Sobe_Bolme,"Təyin olunduğu şöbə secilməlidir");			
			}
			else 	if (cavab=="error_2015") {	
				erroraskfoks(User_Islediyi_Sobe_Bolme,"Təyin olunduğu vəzifə secilməlidir");			
			}
			else 	if (cavab=="error_2016") {	
				Ugursuz_Islemleri("Sistem idarəcisi ilə əlaqə saxlayın ")		
			}
			else 	if (cavab=="error_2017") {	
				erroraskfoks(Ise_Qebul_Emri_Nomresi,"İşə qəbul əmrinin nömrəsi boş ola bilməz");			
			}
			else 	if (cavab=="error_2018") {	
				erroraskfoks(User_Fin,"Bu Fin üçün əmir təsdiq gözləyir");			
			}
			else 	if (cavab=="error_2019") {	
				Ugursuz_Islemleri("Sistem idarəcisi ilə əlaqə saxlayın (Birinci əməliyyat uğursuz) ")			
			}
			else 	if (cavab=="error_2020") {	
				Ugursuz_Islemleri("Sistem idarəcisi ilə əlaqə saxlayın (İkinic əməliyyat uğursuz) ")			
			}
			else 	if (cavab=="error_2021") {	
				erroraskfoks(SinaqMuddeti,"Sınaq müddətini secin");			
			}
			else 	if (cavab=="error_2022") {	
				erroraskfoks(SinaqMuddetiGunAy,"Sınaq müddətini secin");			
			}else{				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("icerik").innerHTML = "";
				document.getElementById("icerik").innerHTML = cavab;
				if (document.getElementById('yenilendi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Yeni Əmir Yaradıldı</span>`;
				}
					CedveliCagir("dataTable");

			}		
		}
	}

}


/*bu duzeldi*/


/*bu duzeldi*/
function SilYoxlanis(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>İşə qəbul əmrini silirsiniz .</b>Bunu təsdiq etsəniz məlumat bazadan silinəcək və ona bağlı bütün məlumatlar silinəcək";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Sil_Tesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();

	xhttp.open("POST", "IseQebulEmri/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if(cavab=="error_1001") {				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğursuz. Id Tapılmad</span>`;
			}
			else if(cavab=="error_1002") {				
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğursuz.</span>`;
			}	

			else{
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;

				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("icerik").innerHTML = "";
				document.getElementById("icerik").innerHTML = cavab;
				document.getElementById("icerik").innerHTML = "";
				document.getElementById("icerik").innerHTML = cavab;
				if (document.getElementById('yenilendi')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Silinmə Uğurlu</span>`;
				}

				if (document.getElementById('silinmeugurluinsertxeta')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Silinmə Uğurlu. Sitem idarəcisinə məlumat verin (İnsert Uğursuz)</span>`;
				}

			}
		}
	}
}


function TesdiqYoxlanis(IDDegeri) {
	var deyer=IDDegeri.split("_");
	document.getElementById("SilKaratmaAlani").style.display = "block";
	document.getElementById("SilModalAlani").style.display = "block";
	document.getElementById("SilModalMetinAlani").innerHTML = "<b>Əmri təsdiq edirsiniz .</b>Məlumatların düzgünlüyündən əmin olun";
	document.getElementById("SilIslemiOnayButonu").href = "javascript:Tesdiq(" + deyer[1] + ")";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "block";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "block";
}

function Tesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	console.log(xhttp);
	xhttp.open("POST", "IseQebulEmri/Tesdiq_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			if(cavab=="error_1001") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə uğursuz.(Əmir təsdiqlənib silinib və ya bazada yoxdur)</span>`;
			}
			else if(cavab=="error_1002") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə uğursuz.(Əmir təsdiqlənib silinib və ya bazada yoxdur.Sistem idarəcisinə məlumat verin)</span>`;
			}

			else if(cavab=="error_1003") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə ugurlu.(Yeni əməkdaşın məlumatları bazaya yazılmadı.Sistem idarəcisinə məlumat verin)</span>`;
			}

			else if(cavab=="error_1004") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə ugurlu.(Yeni əməkdaşın məlumatları bazaya yazılmadı.Sistem idarəcisinə məlumat verin)</span>`;
			}
			else if(cavab=="error_1005") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = cavab;
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə ugurlu.(Təhsil məmumatları bazaya yazılmadı.Sistem idarəcisinə məlumat verin)</span>`;
			}

			else if(cavab=="error_1006") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə ugurlu.(Səlahiyyət məlumatları yazılmadı .Sistem idarəcisinə məlumat verin)</span>`;
			}
			else if(cavab=="error_1007") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə ugurlu.(Tutduğu vəzifələrə məlumat yazilmadı .Sistem idarəcisinə məlumat verin)</span>`;
			}
			else if(cavab=="error_1008") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə ugurlu.(Tutduğu vəzifəyə təyin edilmədi .Sistem idarəcisinə məlumat verin)</span>`;
			}

			else if(cavab=="error_1009") {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";	
				document.getElementById("modalformalaniici").innerHTML = "";			
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("cavabid").innerHTML="";
				document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugursuz"><i class="fas fa-times"></i> Təsdiqlənmə ugurlu.(Tutduğu vəzifəyə nəzarət edilməsinə məlumat yazılmadı .Sistem idarəcisinə məlumat verin)</span>`;
			}	else {								
				document.getElementById("SilKaratmaAlani").style.display = "none";
				document.getElementById("SilModalAlani").style.display = "none";
				document.getElementById("SilModalMetinAlani").innerHTML = "";
				document.getElementById("SilIslemiOnayButonu").href = "";
				document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
				document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
				document.getElementById("modalformalaniici").innerHTML = "";
				document.getElementById("Modal").style.display = "none";
				document.getElementById("ModalAlani").style.display = "none";
				document.getElementById("yuklemealanikapsayici").style.display = "none"
				document.getElementById("icerik").innerHTML="";
				document.getElementById("icerik").innerHTML=cavab;
				if (document.getElementById('ugurlu')) {
					document.getElementById("cavabid").innerHTML="";
					document.getElementById("cavabid").innerHTML=`<span class="Vezife_Adlari_Yenilenme_Ugurlu"><i class="fas fa-check"></i> Təsdiqlənmə uğurlu</span>`;
				}					
			}
		}
	}
}


function DuzeliseGonder(IDDegeri) {
	var deyer=IDDegeri.split("_");		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IseQebulEmri/Duzelis_Modali_Ici.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + deyer[1]);
	xhttp.onreadystatechange = function () {	
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab=this.responseText.trim();
			document.getElementById("modalformalaniici").innerHTML = "";
			document.getElementById("Modal").style.display = "none";
			document.getElementById("ModalAlani").style.display = "none";
			document.getElementById("modalformalaniici").innerHTML = cavab;
			document.getElementById("Modal").style.display = "block";
			document.getElementById("ModalAlani").style.display = "block";
		}
	}
}



function DuzelisYoxlanis() {
	var Ise_Qebul_Emri_Id= document.getElementById("Ise_Qebul_Emri_Id");	
	var User_Soy_Ad = document.getElementById("User_Soy_Ad");
	var User_Ad = document.getElementById("User_Ad");
	var User_Ata_Ad = document.getElementById("User_Ata_Ad");
	var User_Dogum_Tarixi = document.getElementById("User_Dogum_Tarixi");
	var User_Fin = document.getElementById("User_Fin");
	var User_Yasayis_Unvan = document.getElementById("User_Yasayis_Unvan");
	var User_Tehsil = document.getElementById("User_Tehsil");
	var User_Tehsil_Aldigi_Muesse = document.getElementById("User_Tehsil_Aldigi_Muesse");
	var Ixtisas = document.getElementById("Ixtisas");
	var User_Ise_Qebul_Tarixi = document.getElementById("User_Ise_Qebul_Tarixi");
	var Usre_Cinsiyeti = document.getElementById("Usre_Cinsiyeti");
	var User_Is_Novu = document.getElementById("User_Is_Novu");
	var Ise_Qebul_Emri_Nomresi = document.getElementById("Ise_Qebul_Emri_Nomresi");
	var Mezmun = document.getElementById("Mezmun");	
	var SinaqMuddeti=document.getElementById('SinaqMuddeti');
	var SinaqMuddetiGunAy=document.getElementById('SinaqMuddetiGunAy');
	if(Ise_Qebul_Emri_Id.value === '') {
		error(Ise_Qebul_Emri_Id);
		return;
	}
	if(User_Soy_Ad.value === '') {
		error(User_Soy_Ad);
		return;
	}

	if(User_Ad.value === '') {
		error(User_Ad);
		return;
	}
	if(User_Ata_Ad.value === '') {
		error(User_Ata_Ad);
		return;
	}
	if(User_Dogum_Tarixi.value === '') {
		error(User_Dogum_Tarixi);
		return;
	}
	if(User_Fin.value === '') {
		error(User_Fin);
		return;
	}
}

function	Axtar(){
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var veri= $("#axtarisadsoyadataadi").serialize();
	$.ajax({
		type:"post",
		url:"IseQebulEmri/Axtaris.php",
		data:veri,
		success:function(sonuc){
			$("#icerik").html((sonuc));
			document.getElementById("yuklemealanikapsayici").style.display = "none";	
			CedveliCagir("dataTable");	
		}
	});
}