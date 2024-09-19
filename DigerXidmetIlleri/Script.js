document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "Digər dövlət və ya özəl sektorda xidməti";
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



function SelectAlaniSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.borderColor = "#2A3F54";
}

function Yeni() {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "DigerXidmetIlleri/Yeni.php", true);
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
	xhttp.open("POST", "DigerXidmetIlleri/Melumat_Telebi.php", true);
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



function	YeniFormKontrol(){
	var ID = document.getElementById("ID"); 
	var gun = document.getElementById("gun"); 
	var ay = document.getElementById("ay"); 
	var il = document.getElementById("il"); 
	var Orqanin_Adi = document.getElementById("Orqanin_Adi"); 
	var Vezifesi = document.getElementById("Vezifesi"); 
	var Qebul_Tarixi = document.getElementById("Qebul_Tarixi"); 
	var Azad_Olma_Tarixi = document.getElementById("Azad_Olma_Tarixi"); 
	var Xidmet_Iline_Daxil_Et = document.getElementById("Xidmet_Iline_Daxil_Et"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Orqanin_Adi.value === '') {
		error(Orqanin_Adi);
		return;
	}
	if(Vezifesi.value === '') {
		error(Vezifesi);
		return;
	}
	if(Qebul_Tarixi.value === '') {
		error(Qebul_Tarixi);
		return;
	}
	if(Azad_Olma_Tarixi.value === '') {
		error(Azad_Olma_Tarixi);
		return;
	}	

	if(Xidmet_Iline_Daxil_Et.value === '') {
		error(Xidmet_Iline_Daxil_Et);
		return;
	}		

	if(gun.value === '') {
		error(gun);
		return;
	}		
	if(ay.value === '') {
		error(ay);
		return;
	}	
	if(il.value === '') {
		error(il);
		return;
	}	
	var deyerbir="Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:YeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function YeniForm(){
	var gun = document.getElementById("gun"); 
	var ay = document.getElementById("ay"); 
	var il = document.getElementById("il");
	var ID = document.getElementById("ID"); 
	var Orqanin_Adi = document.getElementById("Orqanin_Adi"); 
	var Vezifesi = document.getElementById("Vezifesi"); 
	var Qebul_Tarixi = document.getElementById("Qebul_Tarixi"); 
	var Azad_Olma_Tarixi = document.getElementById("Azad_Olma_Tarixi"); 
	var Xidmet_Iline_Daxil_Et = document.getElementById("Xidmet_Iline_Daxil_Et"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Orqanin_Adi.value === '') {
		error(Orqanin_Adi);
		return;
	}
	if(Vezifesi.value === '') {
		error(Vezifesi);
		return;
	}
	if(Qebul_Tarixi.value === '') {
		error(Qebul_Tarixi);
		return;
	}
	if(Azad_Olma_Tarixi.value === '') {
		error(Azad_Olma_Tarixi);
		return;
	}	

	if(Xidmet_Iline_Daxil_Et.value === '') {
		error(Xidmet_Iline_Daxil_Et);
		return;
	}		
	if(gun.value === '') {
		error(gun);
		return;
	}		
	if(ay.value === '') {
		error(ay);
		return;
	}	
	if(il.value === '') {
		error(il);
		return;
	}	
	var deyer = {
		gun:gun.value,
		ay:ay.value,
		il:il.value,
		ID:ID.value,
		Orqanin_Adi:Orqanin_Adi.value,
		Vezifesi:Vezifesi.value,
		Qebul_Tarixi:Qebul_Tarixi.value,
		Azad_Olma_Tarixi:Azad_Olma_Tarixi.value,
		Xidmet_Iline_Daxil_Et:Xidmet_Iline_Daxil_Et.value,
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "DigerXidmetIlleri/Yeni_Islemleri.php", true);
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
	xhttp.open("POST", "DigerXidmetIlleri/Sil.php", true);
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

function Duzeli(id) {		
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "DigerXidmetIlleri/Duzenle.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
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


function	DuzenleFormKontrol(){
	var gun = document.getElementById("gun"); 
	var ay = document.getElementById("ay"); 
	var il = document.getElementById("il");
	var Diger_Xidmet_Ili_Id = document.getElementById("Diger_Xidmet_Ili_Id"); 
	var ID = document.getElementById("ID"); 
	var Orqanin_Adi = document.getElementById("Orqanin_Adi"); 
	var Vezifesi = document.getElementById("Vezifesi"); 
	var Qebul_Tarixi = document.getElementById("Qebul_Tarixi"); 
	var Azad_Olma_Tarixi = document.getElementById("Azad_Olma_Tarixi"); 
	var Xidmet_Iline_Daxil_Et = document.getElementById("Xidmet_Iline_Daxil_Et"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}

	if(Diger_Xidmet_Ili_Id.value === '') {
		error(Diger_Xidmet_Ili_Id);
		return;
	}
	if(Orqanin_Adi.value === '') {
		error(Orqanin_Adi);
		return;
	}
	if(Vezifesi.value === '') {
		error(Vezifesi);
		return;
	}
	if(Qebul_Tarixi.value === '') {
		error(Qebul_Tarixi);
		return;
	}
	if(Azad_Olma_Tarixi.value === '') {
		error(Azad_Olma_Tarixi);
		return;
	}	

	if(Xidmet_Iline_Daxil_Et.value === '') {
		error(Xidmet_Iline_Daxil_Et);
		return;
	}	
		if(gun.value === '') {
		error(gun);
		return;
	}		
	if(ay.value === '') {
		error(ay);
		return;
	}	
	if(il.value === '') {
		error(il);
		return;
	}	
	var deyerbir="Məlumatın düzgün olduğundan əmin olun. Təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki="javascript:DuzelisYeniForm()";
	Tesdiq_Modali_Block(deyerbir,deyeriki) 
}

function DuzelisYeniForm(){
	var gun = document.getElementById("gun"); 
	var ay = document.getElementById("ay"); 
	var il = document.getElementById("il");
	var Diger_Xidmet_Ili_Id = document.getElementById("Diger_Xidmet_Ili_Id"); 
	var ID = document.getElementById("ID"); 
	var Orqanin_Adi = document.getElementById("Orqanin_Adi"); 
	var Vezifesi = document.getElementById("Vezifesi"); 
	var Qebul_Tarixi = document.getElementById("Qebul_Tarixi"); 
	var Azad_Olma_Tarixi = document.getElementById("Azad_Olma_Tarixi"); 
	var Xidmet_Iline_Daxil_Et = document.getElementById("Xidmet_Iline_Daxil_Et"); 
	if(ID.value === '') {
		var x=ID.nextElementSibling;
		var y=x.getElementsByTagName("span")[0];
		var e=y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";		
		return;
	}
	if(Diger_Xidmet_Ili_Id.value === '') {
		error(Diger_Xidmet_Ili_Id);
		return;
	}
	if(Orqanin_Adi.value === '') {
		error(Orqanin_Adi);
		return;
	}
	if(Vezifesi.value === '') {
		error(Vezifesi);
		return;
	}
	if(Qebul_Tarixi.value === '') {
		error(Qebul_Tarixi);
		return;
	}
	if(Azad_Olma_Tarixi.value === '') {
		error(Azad_Olma_Tarixi);
		return;
	}	

	if(Xidmet_Iline_Daxil_Et.value === '') {
		error(Xidmet_Iline_Daxil_Et);
		return;
	}		
		if(gun.value === '') {
		error(gun);
		return;
	}		
	if(ay.value === '') {
		error(ay);
		return;
	}	
	if(il.value === '') {
		error(il);
		return;
	}	
	var deyer = {
			gun:gun.value,
		ay:ay.value,
		il:il.value,
		ID:ID.value,
		Diger_Xidmet_Ili_Id:Diger_Xidmet_Ili_Id.value,
		Orqanin_Adi:Orqanin_Adi.value,
		Vezifesi:Vezifesi.value,
		Qebul_Tarixi:Qebul_Tarixi.value,
		Azad_Olma_Tarixi:Azad_Olma_Tarixi.value,
		Xidmet_Iline_Daxil_Et:Xidmet_Iline_Daxil_Et.value,
	};
	var gonderilen=JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "DigerXidmetIlleri/Duzenle_Islemleri.php", true);
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

function DaxilEt(id){
	var parcala=id.split("_");
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "DigerXidmetIlleri/Daxil_Et.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer="+parcala[1]);	
}