document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "İş rejimləri";
function CedveliCagir(icerik) {

	var dataTables = $('#' + icerik).DataTable({
		"bFilter": false,
		"bLengthChange": true,
		"lengthMenu": [[5, 10, 20, 30, 40, 50, 60, 70, 80, 90, -1], [5, 10, 20, 30, 40, 50, 60, 70, 80, 90, "Hamısı"]],
		"pageLength": 5,
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
			{
				extend: 'excel',
				title: 'İşə qəbul əmirləri',
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
					stripHtml: false,
				}
			},
			{
				extend: 'print',
				customize: function (win) {
					$(win.document.body)
						.css('font-size', '10px')
					$(win.document.body).find('table')
						.addClass('compact')
						.css('font-size', 'inherit');
				}, title: function () {
					return "<div class='datatitle'>İşə qəbul əmri</div>";
				},
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
					stripHtml: false,
				}
			}
		],
		pagingType: 'numbers',
		dom: '<"float-left"B><"float-right"f>rt<"row"<"col-6"l><"d-none"i><"col-sm-6"p>>',
	});


}

function modalici(cavab) {
	document.getElementById("modalformalaniici").innerHTML = cavab;
	document.getElementById("Modal").style.display = "block";
	document.getElementById("ModalAlani").style.display = "block";
	document.getElementById("yuklemealanikapsayici").style.display = "none"
}

function Modal_Ici_None() {
	document.getElementById("modalformalaniici").innerHTML = "";
	document.getElementById("Modal").style.display = "none";
	document.getElementById("ModalAlani").style.display = "none";
}

function Tesdiq_Modali_None() {
	document.getElementById("SilKaratmaAlani").style.display = "none";
	document.getElementById("SilModalAlani").style.display = "none";
	document.getElementById("SilModalMetinAlani").innerHTML = "";
	document.getElementById("SilIslemiOnayButonu").href = "";
	document.getElementById("SilIslemiOnayButonuKapsayicisi").style.display = "none";
	document.getElementById("SilIslemiImtinaButonuKapsayicisi").style.display = "none";
}

function Tesdiq_Modali_Block(deyerbir, deyeriki) {
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
	xhttp.open("POST", "IsRejimleri/Yeni.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("yeni=yeni");
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var cavab = this.responseText.trim();
			modalici(cavab);
			TarixFormati();
			$(".js-example-placeholder-single").select2({
				placeholder: "Secin",
				allowClear: true
			});
		}
	}
}

function SebebAlaniYazildi(deyer) {
	InputIcerikDeyeri = document.getElementById(deyer);
	if (InputIcerikDeyeri.value.length > InputIcerikDeyeri.maxLength)
		InputIcerikDeyeri.value = InputIcerikDeyeri.value.slice(0, InputIcerikDeyeri.maxLength)
	var InputLabelMetni = deyer + "_Metni";
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





function SagVeSolBosluklariSIl(deyer) {
	InputIcerikDeyeri = document.getElementById(deyer);
	var Yoxlabir = InputIcerikDeyeri.value;
	var Yoxla = Yoxlabir.trim();
	InputIcerikDeyeri.value = Yoxla;
}

function SaatYazildi(deyer) {
	SagVeSolBosluklariSIl(deyer);
	InputIcerikDeyeri = document.getElementById(deyer);
	if (InputIcerikDeyeri.value.length > InputIcerikDeyeri.maxLength)
		InputIcerikDeyeri.value = InputIcerikDeyeri.value.slice(0, InputIcerikDeyeri.maxLength)
	if (InputIcerikDeyeri.value == "") {
		InputIcerikDeyeri.style.color = "#ff0000";
		InputIcerikDeyeri.style.border = "2px solid #ff0000";
		InputIcerikDeyeri.style.boxShadow = " 1px 0px 1px 0px #ff0000";
		InputIcerikDeyeri.classList.add("pleysoldercolorqirmizi");
		return;
	} else {
		InputIcerikDeyeri.style.color = "#2A3F54";
		InputIcerikDeyeri.style.border = "1px solid #2A3F54";
		InputIcerikDeyeri.style.boxShadow = " 0px 0px 0px 0px #2A3F54";
		InputIcerikDeyeri.classList.remove("pleysoldercolorqirmizi");
		var Yoxla = InputIcerikDeyeri.value;
		var YoxlanisNeticesi = Yoxla.replace(/[^0-9:\/\-()\s+]/g, "");
		InputIcerikDeyeri.value = YoxlanisNeticesi;
		return;
	}
}
function SelectAlaniSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.border = "1px solid #2A3F54";
}




function SelectIkiAlaniSecildi(deyer) {
	var ID = document.getElementById(deyer).value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IsRejimleri/Melumat_Telebi.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("ID=" + ID);
	xhttp.onreadystatechange = function (deye) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab = this.responseText.trim();
			data = JSON.parse(cavab);
			document.getElementById("Idare_Ad").value = data.Idare_Ad;
			document.getElementById("Sobe_Ad").value = data.Sobe_Ad;
			document.getElementById("Vezife_Ad").value = data.Vezife_Ad;
			var x = document.getElementById(deyer).nextElementSibling;
			var y = x.getElementsByTagName("span")[0];
			var e = y.getElementsByTagName("span")[0];
			e.style.border = "2px solid #2A3F54";
		}
	}
}

function IsRejimiSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.border = "1px solid #2A3F54";
	var isrejimi = document.getElementById(deyer).value;
	if (isrejimi == 1) {
		document.getElementById("Is_Giris_Saati").removeAttribute("disabled");
		document.getElementById("Fasile_Saati_Baslagic").removeAttribute("disabled");
		document.getElementById("Fasile_Saati_Bitis").removeAttribute("disabled");
		document.getElementById("Is_Cixis_Saati").removeAttribute("disabled");
		document.getElementById("Gunduz").setAttribute("disabled", "disabled");
		document.getElementById("Gece").setAttribute("disabled", "disabled");
		document.getElementById("Novbe_Sayi").setAttribute("disabled", "disabled");
		document.getElementById("Is_Qurupu").setAttribute("disabled", "disabled");
		document.getElementById("Is_Giris_Saati").value = "";;
		document.getElementById("Fasile_Saati_Baslagic").value = "";
		document.getElementById("Fasile_Saati_Bitis").value = "";
		document.getElementById("Is_Cixis_Saati").value = "";
		document.getElementById("Gunduz").value = "";
		document.getElementById("Gece").value = "";
		document.getElementById("Novbe_Sayi").innerHTML = "";
		document.getElementById("Is_Qurupu").innerHTML = "";
		document.getElementById("istraheygunu").style.display = "none";
	} else if (isrejimi == 2) {
		document.getElementById("Is_Giris_Saati").removeAttribute("disabled")
		document.getElementById("Is_Cixis_Saati").removeAttribute("disabled");
		document.getElementById("Fasile_Saati_Baslagic").setAttribute("disabled", "disabled");
		document.getElementById("Fasile_Saati_Bitis").setAttribute("disabled", "disabled");
		document.getElementById("Gunduz").setAttribute("disabled", "disabled");
		document.getElementById("Gece").setAttribute("disabled", "disabled");
		document.getElementById("Novbe_Sayi").setAttribute("disabled", "disabled");
		document.getElementById("Is_Qurupu").setAttribute("disabled", "disabled");
		document.getElementById("Is_Giris_Saati").value = "";;
		document.getElementById("Fasile_Saati_Baslagic").value = "";
		document.getElementById("Fasile_Saati_Bitis").value = "";
		document.getElementById("Is_Cixis_Saati").value = "";
		document.getElementById("Gunduz").value = "";
		document.getElementById("Gece").value = "";
		document.getElementById("Novbe_Sayi").innerHTML = "";
		document.getElementById("Is_Qurupu").innerHTML = "";
		document.getElementById("istraheygunu").style.display = "block";
	}
	else if (isrejimi == 3) {
		document.getElementById("istraheygunu").style.display = "none";
		document.getElementById("Is_Giris_Saati").setAttribute("disabled", "disabled");
		document.getElementById("Is_Cixis_Saati").setAttribute("disabled", "disabled");
		document.getElementById("Fasile_Saati_Baslagic").setAttribute("disabled", "disabled");
		document.getElementById("Fasile_Saati_Bitis").setAttribute("disabled", "disabled");
		document.getElementById("Gunduz").setAttribute("disabled", "disabled");
		document.getElementById("Gece").setAttribute("disabled", "disabled");
		document.getElementById("Novbe_Sayi").removeAttribute("disabled");
		document.getElementById("Is_Giris_Saati").value = "";
		document.getElementById("Fasile_Saati_Baslagic").value = "";
		document.getElementById("Fasile_Saati_Bitis").value = "";
		document.getElementById("Is_Cixis_Saati").value = "";
		document.getElementById("Gunduz").value = "";
		document.getElementById("Gece").value = "";
		document.getElementById("Novbe_Sayi").innerHTML = `<option disabled="disabled" value="" selected="selected"></option>
		<option value="2">2 növbəli</option>
		<option value="3">3 növbəli</option>
		<option value="4">4 növbəli</option>
		`;
	}
}



function NovbeSecildi(deyer) {
	document.getElementById(deyer).style.color = "#2A3F54";
	document.getElementById(deyer).style.border = "1px solid #2A3F54";
	var isrejimi = document.getElementById(deyer).value;
	if (isrejimi == 2) {
		document.getElementById("Is_Qurupu").innerHTML = "";
		document.getElementById("Is_Qurupu").removeAttribute("disabled");
		document.getElementById("Is_Qurupu").innerHTML = `<option disabled="disabled" value="" selected="selected"></option>
		<option value="1">I qrup</option>
		<option value="2">II qrup</option>
		`;
		document.getElementById("Fasile_Saati_Baslagic").setAttribute("disabled", "disabled");
		document.getElementById("Fasile_Saati_Bitis").setAttribute("disabled", "disabled");
		document.getElementById("Gunduz").setAttribute("disabled", "disabled");
		document.getElementById("Gece").setAttribute("disabled", "disabled");
		document.getElementById("Is_Giris_Saati").removeAttribute("disabled");
		document.getElementById("Is_Cixis_Saati").removeAttribute("disabled");
		document.getElementById("Is_Giris_Saati").value = "";
		document.getElementById("Fasile_Saati_Baslagic").value = "";
		document.getElementById("Fasile_Saati_Bitis").value = "";
		document.getElementById("Is_Cixis_Saati").value = "";
		document.getElementById("Gunduz").value = "";
		document.getElementById("Gece").value = "";

	} else if (isrejimi == 3) {
		document.getElementById("Is_Qurupu").innerHTML = "";
		document.getElementById("Is_Qurupu").removeAttribute("disabled");
		document.getElementById("Is_Qurupu").innerHTML = `<option disabled="disabled" value="" selected="selected"></option>
		<option value="1">I qrup</option>
		<option value="2">II qrup</option>
		<option value="3">III qrup</option>
		`;
		document.getElementById("Fasile_Saati_Baslagic").setAttribute("disabled", "disabled");
		document.getElementById("Fasile_Saati_Bitis").setAttribute("disabled", "disabled");
		document.getElementById("Gunduz").setAttribute("disabled", "disabled");
		document.getElementById("Gece").setAttribute("disabled", "disabled");
		document.getElementById("Is_Giris_Saati").removeAttribute("disabled");
		document.getElementById("Is_Cixis_Saati").removeAttribute("disabled");
		document.getElementById("Is_Giris_Saati").value = "";
		document.getElementById("Fasile_Saati_Baslagic").value = "";
		document.getElementById("Fasile_Saati_Bitis").value = "";
		document.getElementById("Is_Cixis_Saati").value = "";
		document.getElementById("Gunduz").value = "";
		document.getElementById("Gece").value = "";

	}
	else if (isrejimi == 4) {
		document.getElementById("Is_Qurupu").innerHTML = "";
		document.getElementById("Is_Qurupu").removeAttribute("disabled");
		document.getElementById("Is_Qurupu").innerHTML = `<option disabled="disabled" value="" selected="selected"></option>
		<option value="1">I qrup</option>
		<option value="2">II qrup</option>
		<option value="3">III qrup</option>
		<option value="4">IV qrup</option>
		`;

		document.getElementById("Fasile_Saati_Baslagic").setAttribute("disabled", "disabled");
		document.getElementById("Fasile_Saati_Bitis").setAttribute("disabled", "disabled");
		document.getElementById("Gunduz").removeAttribute("disabled");
		document.getElementById("Gece").removeAttribute("disabled");
		document.getElementById("Is_Giris_Saati").setAttribute("disabled", "disabled");
		document.getElementById("Is_Cixis_Saati").setAttribute("disabled", "disabled");
		document.getElementById("Is_Giris_Saati").value = "";
		document.getElementById("Fasile_Saati_Baslagic").value = "";
		document.getElementById("Fasile_Saati_Bitis").value = "";
		document.getElementById("Is_Cixis_Saati").value = "";
		document.getElementById("Gunduz").value = "";
		document.getElementById("Gece").value = "";
	}
}





function YeniFormKontrol() {
	var ID = document.getElementById("ID");
	var Is_Rejimi = document.getElementById("Is_Rejimi");
	var Novbe_Sayi = document.getElementById("Novbe_Sayi");
	var Is_Qurupu = document.getElementById("Is_Qurupu");
	var Is_Giris_Saati = document.getElementById("Is_Giris_Saati");
	var Fasile_Saati_Baslagic = document.getElementById("Fasile_Saati_Baslagic");
	var Fasile_Saati_Bitis = document.getElementById("Fasile_Saati_Bitis");
	var Is_Cixis_Saati = document.getElementById("Is_Cixis_Saati");
	var Gunduz = document.getElementById("Gunduz");
	var Gece = document.getElementById("Gece");
	if (ID.value === '') {
		var x = ID.nextElementSibling;
		var y = x.getElementsByTagName("span")[0];
		var e = y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";
		return;
	}

	if (Is_Rejimi.value === '') {
		error(Is_Rejimi);
		return;
	}

	if (Is_Rejimi.value == 1) {
		if (Is_Giris_Saati.value === '') {
			error(Is_Giris_Saati);
			return;
		}

		if (Fasile_Saati_Baslagic.value === '') {
			error(Fasile_Saati_Baslagic);
			return;
		}
		if (Fasile_Saati_Bitis.value === '') {
			error(Fasile_Saati_Bitis);
			return;
		} if (Is_Cixis_Saati.value === '') {
			error(Is_Cixis_Saati);
			return;
		}
	}
	else if (Is_Rejimi.value == 2) {
		if (Is_Giris_Saati.value === '') {
			error(Is_Giris_Saati);
			return;
		}
		if (Is_Cixis_Saati.value === '') {
			error(Is_Cixis_Saati);
			return;
		}
	}
	else if (Is_Rejimi.value == 3) {
		if (Novbe_Sayi.value === '') {
			error(Novbe_Sayi);
			return;
		}

		if (Novbe_Sayi.value == 2 || Novbe_Sayi.value == 3) {
			if (Is_Qurupu.value === '') {
				error(Is_Qurupu);
				return;
			}
			if (Is_Qurupu.value === '') {
				error(Is_Qurupu);
				return;
			}
			if (Is_Giris_Saati.value === '') {
				error(Is_Giris_Saati);
				return;
			}
			if (Is_Cixis_Saati.value === '') {
				error(Is_Cixis_Saati);
				return;
			}
		}


		if (Novbe_Sayi.value == 4) {
			if (Is_Qurupu.value === '') {
				error(Is_Qurupu);
				return;
			}
			if (Gunduz.value === '') {
				error(Gunduz);
				return;
			}
			if (Gece.value === '') {
				error(Gece);
				return;
			}
		}
	}
	var deyerbir = "<b>Məlumatın düzgün olduğundan əmin olun!</b> Bunu təsdiq etsəniz məlumat yaddaşa yazılacaq";
	var deyeriki = "javascript:YeniFormIslemi()";
	Tesdiq_Modali_Block(deyerbir, deyeriki)
}

function YeniFormIslemi() {
	var ID = document.getElementById("ID");
	var Is_Rejimi = document.getElementById("Is_Rejimi");
	var Novbe_Sayi = document.getElementById("Novbe_Sayi");
	var Is_Qurupu = document.getElementById("Is_Qurupu");
	var Is_Giris_Saati = document.getElementById("Is_Giris_Saati");
	var Fasile_Saati_Baslagic = document.getElementById("Fasile_Saati_Baslagic");
	var Fasile_Saati_Bitis = document.getElementById("Fasile_Saati_Bitis");
	var Is_Cixis_Saati = document.getElementById("Is_Cixis_Saati");
	var Gunduz = document.getElementById("Gunduz");
	var Gece = document.getElementById("Gece");
	var bir = document.getElementById("bir");
	var iki = document.getElementById("iki");
	var uc = document.getElementById("uc");
	var dord = document.getElementById("dord");
	var bes = document.getElementById("bes");
	var alti = document.getElementById("alti");
	var yeddi = document.getElementById("yeddi");
	if (ID.value === '') {
		var x = ID.nextElementSibling;
		var y = x.getElementsByTagName("span")[0];
		var e = y.getElementsByTagName("span")[0];
		e.style.border = "2px solid #ff0000";
		return;
	}

	if (Is_Rejimi.value === '') {
		error(Is_Rejimi);
		return;
	}

	if (Is_Rejimi.value == 1) {
		if (Is_Giris_Saati.value === '') {
			error(Is_Giris_Saati);
			return;
		}

		if (Fasile_Saati_Baslagic.value === '') {
			error(Fasile_Saati_Baslagic);
			return;
		}
		if (Fasile_Saati_Bitis.value === '') {
			error(Fasile_Saati_Bitis);
			return;
		} if (Is_Cixis_Saati.value === '') {
			error(Is_Cixis_Saati);
			return;
		}
	}
	else if (Is_Rejimi.value == 2) {
		if (Is_Giris_Saati.value === '') {
			error(Is_Giris_Saati);
			return;
		}
		if (Is_Cixis_Saati.value === '') {
			error(Is_Cixis_Saati);
			return;
		}
	}
	else if (Is_Rejimi.value == 3) {
		if (Novbe_Sayi.value === '') {
			error(Novbe_Sayi);
			return;
		}

		if (Novbe_Sayi.value == 2 || Novbe_Sayi.value == 3) {
			if (Is_Qurupu.value === '') {
				error(Is_Qurupu);
				return;
			}
			if (Is_Qurupu.value === '') {
				error(Is_Qurupu);
				return;
			}
			if (Is_Giris_Saati.value === '') {
				error(Is_Giris_Saati);
				return;
			}
			if (Is_Cixis_Saati.value === '') {
				error(Is_Cixis_Saati);
				return;
			}
		}


		if (Novbe_Sayi.value == 4) {
			if (Is_Qurupu.value === '') {
				error(Is_Qurupu);
				return;
			}
			if (Gunduz.value === '') {
				error(Gunduz);
				return;
			}
			if (Gece.value === '') {
				error(Gece);
				return;
			}
		}
	}
	var deyer = {
		ID: ID.value,
		Is_Rejimi: Is_Rejimi.value,
		Novbe_Sayi: Novbe_Sayi.value,
		Is_Qurupu: Is_Qurupu.value,
		Is_Giris_Saati: Is_Giris_Saati.value,
		Fasile_Saati_Baslagic: Fasile_Saati_Baslagic.value,
		Fasile_Saati_Bitis: Fasile_Saati_Bitis.value,
		Is_Cixis_Saati: Is_Cixis_Saati.value,
		Gunduz: Gunduz.value,
		Gece: Gece.value,
		bir: bir.checked,
		iki: iki.checked,
		uc: uc.checked,
		dord: dord.checked,
		bes: bes.checked,
		alti: alti.checked,
		yeddi: yeddi.checked
	};
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var gonderilen = JSON.stringify(deyer);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IsRejimleri/Yeni_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + gonderilen);
	console.log(xhttp);
	xhttp.onreadystatechange = function (deyer) {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			var cavab = this.responseText.trim();
			document.getElementById("errorcavabi").innerHTML = cavab;
			var status = document.getElementById("status").value;
			var statusiki = document.getElementById("statusiki").value;
			var message = document.getElementById("message").value;
			if (status == "error") {
				Tesdiq_Modali_None()
				statuserror(statusiki);
				document.getElementById("errorcavabi").innerHTML = message;
			} else {
				Tesdiq_Modali_None();
				Modal_Ici_None();
				document.getElementById("icerik").innerHTML = "";
				document.getElementById("icerik").innerHTML = cavab;
				document.getElementById("cavabid").innerHTML = message;
				CedveliCagir("dataTable");
			}
		}
	}
}

function Sil(IDDegeri) {
	var deyer = IDDegeri.split("_");
	var deyerbir = "<b>Silmək istədiyinizdən əmin olun!</b> Bunu təsdiq etsəniz məlumat silinəcək";
	var deyeriki = "javascript:Sil_Tesdiq(" + deyer[1] + ")";
	Tesdiq_Modali_Block(deyerbir, deyeriki)
}

function Sil_Tesdiq(id) {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "IsRejimleri/Sil_Islemleri.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("Deyer=" + id);
	xhttp.onreadystatechange = function (deyer) {
		document.getElementById("yuklemealanikapsayici").style.display = "none";
		var cavab = this.responseText.trim();
		document.getElementById("cavabid").innerHTML = cavab;
		var status = document.getElementById("status").value;
		var message = document.getElementById("message").value;
		if (status == "error") {
			Tesdiq_Modali_None()
			document.getElementById("cavabid").innerHTML = message;
		} else {
			Tesdiq_Modali_None();
			document.getElementById("icerik").innerHTML = "";
			document.getElementById("icerik").innerHTML = cavab;
			document.getElementById("cavabid").innerHTML = "";
			document.getElementById("cavabid").innerHTML = message;
		}
	}
}

function Axtar() {
	document.getElementById("yuklemealanikapsayici").style.display = "block";
	var veri = $("#axtarisadsoyadataadi").serialize();
	$.ajax({
		type: "post",
		url: "IsRejimleri/Axtaris.php",
		data: veri,
		success: function (sonuc) {
			$("#icerik").html((sonuc));
			document.getElementById("yuklemealanikapsayici").style.display = "none";
			CedveliCagir("dataTable");
		}
	});
}