document.getElementById("SeyfeAdi").innerHTML = "";
document.getElementById("SeyfeAdi").innerHTML = "İş rejimləri Təyin et";



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

function TarixAlaniYazildi(deyer) {
  SagVeSolBosluklariSIl(deyer);
  InputIcerikDeyeri = document.getElementById(deyer);
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
    InputIcerikDeyeri.style.border = "1px solid #2A3F54";
    InputIcerikDeyeri.style.boxShadow = " 0px 0px 0px 0px #2A3F54";
    InputIcerikDeyeri.classList.remove("pleysoldercolorqirmizi");
    var Yoxla = InputIcerikDeyeri.value;
    var YoxlanisNeticesi = Yoxla.replace(/[^0-9.,\/\-()\s+]/g, "");
    InputIcerikDeyeri.value = YoxlanisNeticesi;
    return;
  }
}




function IsrejimiYoxla() {
  if (document.getElementById("div1").querySelector(".qrafiqriolmayan")) {
    var Is_Giris_Saati = document.getElementById("Is_Giris_Saati");
    var Fasile_Saati_Baslagic = document.getElementById("Fasile_Saati_Baslagic");
    var Fasile_Saati_Bitis = document.getElementById("Fasile_Saati_Bitis");
    var Is_Cixis_Saati = document.getElementById("Is_Cixis_Saati");
    var Idare_Tarix = document.getElementById("Idare_Tarix");
    if (Idare_Tarix.value === '') {
      error(Idare_Tarix);
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
    if (Fasile_Saati_Baslagic.value === '') {
      error(Fasile_Saati_Baslagic);
      return;
    }
    if (Fasile_Saati_Bitis.value === '') {
      error(Fasile_Saati_Bitis);
      return;
    }
  }

  if (document.getElementById("div2").querySelector(".qrafiqriolmayan")) {
    var GundelikIs_Giris_Saati = document.getElementById("GundelikIs_Giris_Saati");
    var GundelikIs_Cixis_Saati = document.getElementById("GundelikIs_Cixis_Saati");
    var Gundelik_Tarix = document.getElementById("Gundelik_Tarix");
    if (Gundelik_Tarix.value === '') {
      error(Gundelik_Tarix);
      return;
    }
    if (GundelikIs_Giris_Saati.value === '') {
      error(GundelikIs_Giris_Saati);
      return;
    }
    if (GundelikIs_Cixis_Saati.value === '') {
      error(GundelikIs_Cixis_Saati);
      return;
    }
  }

  if (document.getElementById("div3").querySelector(".qrafiqriolmayan") || document.getElementById("div4").querySelector(".qrafiqriolmayan")) {
    var Iki_novbeIs_Cixis_Saati = document.getElementById("Iki_novbeIs_Cixis_Saati");
    var Iki_novbeIs_Giris_Saati = document.getElementById("Iki_novbeIs_Giris_Saati");
    var Ikinovbe_Tarix = document.getElementById("Ikinovbe_Tarix");
    if (Ikinovbe_Tarix.value === '') {
      error(Ikinovbe_Tarix);
      return;
    }
    if (!Iki_novbeIs_Giris_Saati.value >0) {
      error(Iki_novbeIs_Giris_Saati);
      return;
    }
    if (!Iki_novbeIs_Cixis_Saati.value >0) {
      error(Iki_novbeIs_Cixis_Saati);
      return;
    }
    document.getElementById("gizlitarixbir").value=Ikinovbe_Tarix.value;
    document.getElementById("gizlitarixiki").value=Ikinovbe_Tarix.value;

    document.getElementById("gizlisaatbirbir").value=Iki_novbeIs_Giris_Saati.value;
    document.getElementById("gizlisaatikibir").value=Iki_novbeIs_Giris_Saati.value;

    document.getElementById("gizlisaatbiriki").value=Iki_novbeIs_Cixis_Saati.value;
    document.getElementById("gizlisaatikiiki").value=Iki_novbeIs_Cixis_Saati.value;

  }

  if (document.getElementById("div5").querySelector(".qrafiqriolmayan") || document.getElementById("div6").querySelector(".qrafiqriolmayan") || document.getElementById("div7").querySelector(".qrafiqriolmayan")) {
    var UcnovbeIs_Giris_Saati = document.getElementById("UcnovbeIs_Giris_Saati");
    var UcnovbeIs_Cixis_Saati = document.getElementById("UcnovbeIs_Cixis_Saati");
    var Ucnovbe_Tarix = document.getElementById("Ucnovbe_Tarix");
    if (Ucnovbe_Tarix.value === '') {
      error(Ucnovbe_Tarix);
      return;
    }
    if (UcnovbeIs_Giris_Saati.value === '') {
      error(UcnovbeIs_Giris_Saati);
      return;
    }
    if (UcnovbeIs_Cixis_Saati.value === '') {
      error(UcnovbeIs_Cixis_Saati);
      return;
    }

    document.getElementById("ucnovbetarixbir").value=Ucnovbe_Tarix.value;
    document.getElementById("ucnovbetarixiki").value=Ucnovbe_Tarix.value;
    document.getElementById("ucnovbetarixuc").value=Ucnovbe_Tarix.value;

    document.getElementById("ucnovbegirissaatbir").value=UcnovbeIs_Giris_Saati.value;
    document.getElementById("ucnovbegirissaatiki").value=UcnovbeIs_Giris_Saati.value;
    document.getElementById("ucnovbegirissaatuc").value=UcnovbeIs_Giris_Saati.value;

    document.getElementById("ucnovbecixisaatbir").value=UcnovbeIs_Cixis_Saati.value;
    document.getElementById("ucnovbecixisaatiki").value=UcnovbeIs_Cixis_Saati.value;
    document.getElementById("ucnovbecixisaatuc").value=UcnovbeIs_Cixis_Saati.value;

  }
  if (document.getElementById("div8").querySelector(".qrafiqriolmayan") || document.getElementById("div9").querySelector(".qrafiqriolmayan") || document.getElementById("div10").querySelector(".qrafiqriolmayan") || document.getElementById("div11").querySelector(".qrafiqriolmayan")) {
    var Gunduz = document.getElementById("Gunduz");
    var Gece = document.getElementById("Gece");
    var Dordnovbe_Tarix = document.getElementById("Dordnovbe_Tarix");
    if (Dordnovbe_Tarix.value === '') {
      error(Dordnovbe_Tarix);
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
    document.getElementById("dordnovbetarixbir").value=Dordnovbe_Tarix.value;
    document.getElementById("dordnovbegunduzbir").value=Gunduz.value;
    document.getElementById("dordnovbegecebir").value=Gece.value; 

    document.getElementById("dordnovbetarixiki").value=Dordnovbe_Tarix.value;
    document.getElementById("dordnovbegunduziki").value=Gunduz.value;
    document.getElementById("dordnovbegeceiki").value=Gece.value;

    document.getElementById("dordnovbetarixuc").value=Dordnovbe_Tarix.value;
    document.getElementById("dordnovbegunduzuc").value=Gunduz.value;
    document.getElementById("dordnovbegeceuc").value=Gece.value;

    document.getElementById("dordnovbetarixdord").value=Dordnovbe_Tarix.value;
    document.getElementById("dordnovbegunduzdord").value=Gunduz.value;
    document.getElementById("dordnovbegecedord").value=Gece.value;



  }

  if (document.getElementById("div1").querySelector(".qrafiqriolmayan")) {
    FormGonder("idareqrafiq","Idareqrafiq");
  }
  if (document.getElementById("div2").querySelector(".qrafiqriolmayan")) {
   FormGonder("gundelikqrafiq","Gundelikqrafiq");
 }
 if (document.getElementById("div3").querySelector(".qrafiqriolmayan") || document.getElementById("div4").querySelector(".qrafiqriolmayan")) {
  FormGonder("ikinovbebirinci","ikinovbebirinciqrafiq");
  FormGonder("ikinovbeikinci","ikinovbeikinciqrafiq");
}

if (document.getElementById("div5").querySelector(".qrafiqriolmayan") || document.getElementById("div6").querySelector(".qrafiqriolmayan") || document.getElementById("div7").querySelector(".qrafiqriolmayan")) {
  FormGonder("ucnovbebirinci","ucnovbebirinci");
  FormGonder("ucnovbeikinci","ucnovbeikinci");
  FormGonder("ucnovbeucuncu","ucnovbeucuncui");
}

if (document.getElementById("div8").querySelector(".qrafiqriolmayan") || document.getElementById("div9").querySelector(".qrafiqriolmayan") || document.getElementById("div10").querySelector(".qrafiqriolmayan") || document.getElementById("div11").querySelector(".qrafiqriolmayan")) {
  FormGonder("dordnovbebirinci","dordnovbebirinci");
  FormGonder("dordnovbeikinci","dordnovbeikinci");
  FormGonder("dordnovbeucuncu","dordnovbeucuncu");
  FormGonder("dordnovbedorduncu","dordnovbedorduncu");
}


}


function FormGonder(deyerbir,deyeriki) {
  $(function() {
    var veri = $("#"+deyerbir).serialize();
    $.ajax({
      type: "POST",
      url: "IsRejimleriTeyinEt/"+deyeriki+".php",
      data: veri,
      success: function(sonuc) {
        document.getElementById("cavabid").innerHTML="Tesdiq edildi";
      }
    });
  });
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
    }
    if (Is_Cixis_Saati.value === '') {
      error(Is_Cixis_Saati);
      return;
    }
  } else if (Is_Rejimi.value == 2) {
    if (Is_Giris_Saati.value === '') {
      error(Is_Giris_Saati);
      return;
    }
    if (Is_Cixis_Saati.value === '') {
      error(Is_Cixis_Saati);
      return;
    }
  } else if (Is_Rejimi.value == 3) {
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
  xhttp.onreadystatechange = function(deyer) {
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
  xhttp.onreadystatechange = function(deyer) {
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
    success: function(sonuc) {
      $("#icerik").html((sonuc));
      document.getElementById("yuklemealanikapsayici").style.display = "none";
      CedveliCagir("dataTable");
    }
  });
}