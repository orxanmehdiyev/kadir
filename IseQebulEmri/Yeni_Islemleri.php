<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
 $deyer =json_decode($_POST['Deyer'],true);
 $User_Soy_Ad                      =HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Soy_Ad']); 
 $User_Ad                          =HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Ad']); 
 $User_Ata_Ad                      =HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Ata_Ad']);

 $Gelentarix_Tarixi=ReqemlerNokteXaricButunKarakterleriSil($deyer['User_Dogum_Tarixi']);
 $User_Dogum_Tarixi                =TarixBeynelxalqCevir($deyer['User_Dogum_Tarixi']);
 if ($Gelentarix_Tarixi!=TarixAzCevir($deyer['User_Dogum_Tarixi'])) {
   echo "error_2004";/*Dogum Tarixi Boş ola bilməz*/
   exit;
 }
 /*$User_Fin                         =KicikHerfleriBoyukHerflerleDeyisidir(HerfVeReqemlerXaricButunKarakterleriSil($deyer['User_Fin'])); */
 $User_Yasayis_Unvan               =EditorluIcerikleriFiltrle($deyer['User_Yasayis_Unvan']); 
 $User_Tehsil                      =ReqemlerXaricButunKarakterleriSil($deyer['User_Tehsil']); 
 $User_Tehsil_Aldigi_Muesse=EditorluIcerikleriFiltrle($deyer['User_Tehsil_Aldigi_Muesse']); 
 $Ixtisas=EditorluIcerikleriFiltrle($deyer['Ixtisas']); 

 $Geleniseqebul_Tarixi=ReqemlerNokteXaricButunKarakterleriSil($deyer['User_Ise_Qebul_Tarixi']);

 $User_Ise_Qebul_Tarixi         =TarixBeynelxalqCevir($deyer['User_Ise_Qebul_Tarixi']); 

 if ($Geleniseqebul_Tarixi!=TarixAzCevir($deyer['User_Ise_Qebul_Tarixi'])) {
  echo "error_2010";/*İşə qəbul tarixi boş ola bilməz*/
  exit;
}
$Usre_Cinsiyeti                   =ReqemlerXaricButunKarakterleriSil($deyer['Usre_Cinsiyeti']); 
$User_Is_Novu                     =ReqemlerXaricButunKarakterleriSil($deyer['User_Is_Novu']); 
$Ise_Qebul_Emri_Nomresi           =EditorluIcerikleriFiltrle($deyer['Ise_Qebul_Emri_Nomresi']);
$Mezmun                           =EditorluIcerikleriFiltrle($deyer['Mezmun']); 
$User_Islediyi_Idare              =ReqemlerXaricButunKarakterleriSil($deyer['User_Islediyi_Idare']); 
$User_Islediyi_Sobe_Bolme         =ReqemlerXaricButunKarakterleriSil($deyer['User_Islediyi_Sobe_Bolme']); 
$User_Vezife                      =ReqemlerXaricButunKarakterleriSil($deyer['User_Vezife']);
$SinaqMuddeti                     =ReqemlerXaricButunKarakterleriSil($deyer['SinaqMuddeti']);
$SinaqMuddetiGunAy                =ReqemlerXaricButunKarakterleriSil($deyer['SinaqMuddetiGunAy']);
$ID                =ReqemlerXaricButunKarakterleriSil($deyer['ID']);
$Zaman      = date_create($User_Ise_Qebul_Tarixi);
if ($SinaqMuddetiGunAy==0) {
  date_modify($Zaman, "+{$SinaqMuddeti} month");
}else{
  date_modify($Zaman, "+{$SinaqMuddeti} day"); 
}
$SinaqMuddetiBitis_nn = date_timestamp_get($Zaman);
$SinaqMuddetiBitis            =date("Y-m-d", $SinaqMuddetiBitis_nn);

$Seo_Url= HerfVeReqemlerXaricButunKarakterleriSil(Benzersiz_Seo_Url($User_Soy_Ad." ".$User_Ad." ".$User_Ata_Ad/*." ".$User_Fin*/));  
if ($SinaqMuddeti=="") {
 echo "error_2021";/*Sinaq Müddəti boş*/
 exit;
}
if ($SinaqMuddetiGunAy=="") {
  echo "error_2022";/*Sinaq Müddəti ay ve gün secilmelidir*/
  exit;
}
if ($User_Soy_Ad!="") {
  if ($User_Ad!="") {
   if ($User_Ata_Ad!="") {
    if ($User_Dogum_Tarixi!="") {
      /*if ($User_Fin!="" and strlen($User_Fin)==7) {
        $User_Fin_Sor=$db->prepare("SELECT * FROM user WHERE User_Fin=:User_Fin and User_Isleme_Durumu=:User_Isleme_Durumu");
        $User_Fin_Sor->execute(array(
          'User_Fin'=>$User_Fin,
          'User_Isleme_Durumu'=>0));
        $User_Fin_Say=$User_Fin_Sor->rowCount();
        if (!$User_Fin_Say>0) {*/
         if ($User_Yasayis_Unvan!="") {
          if ($User_Tehsil!="") {
            if ($User_Tehsil_Aldigi_Muesse!="") {
              if ($Ixtisas!="") {
                if ($User_Ise_Qebul_Tarixi!="") {
                  if ($Usre_Cinsiyeti!="") {
                    if ($User_Is_Novu!="") {
                      if ($Ise_Qebul_Emri_Nomresi!="") {
                        if ($User_Islediyi_Idare!="") {
                          if ($User_Islediyi_Sobe_Bolme!="") {
                            if ($User_Vezife!="") {
                              $Yeni_Teyinat_Ucun_Veife_Sor=$db->prepare("SELECT * FROM vezife WHERE Vezife_Id=:Vezife_Id and Idare_Id=:Idare_Id and Sobe_Id=:Sobe_Id");
                              $Yeni_Teyinat_Ucun_Veife_Sor->execute(array(
                                'Vezife_Id'=>$User_Vezife,
                                'Idare_Id'=>$User_Islediyi_Idare,
                                'Sobe_Id'=>$User_Islediyi_Sobe_Bolme));
                              $Vezife_Sayi=$Yeni_Teyinat_Ucun_Veife_Sor->rowCount();
                              if ($Vezife_Sayi===1) { 
                               $Yeni_Teyinat_Ucun_Veife_Cek=$Yeni_Teyinat_Ucun_Veife_Sor->fetch(PDO::FETCH_ASSOC);
                               $Vezife_Adlari_Id=$Yeni_Teyinat_Ucun_Veife_Cek['Vezife_Adlari_Id'];   
                               $Vezife_Adlari_Sor=$db->prepare("SELECT * FROM vezife_adlari where Vezife_Adlari_Id=:Vezife_Adlari_Id");
                               $Vezife_Adlari_Sor->execute(array(
                                'Vezife_Adlari_Id'=>$Vezife_Adlari_Id));  
                               $Vezife_Adlari_Cek=$Vezife_Adlari_Sor->fetch(PDO::FETCH_ASSOC); 
                               $User_Vezife_Ad=$Vezife_Adlari_Cek['Vezife_Adlari_Ad'];              
/*
                             $Emir_Qeydiyyat_Gozleyir_sor=$db->prepare("SELECT * FROM ise_qebul_emri WHERE User_Fin=:User_Fin and Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu");
                             $Emir_Qeydiyyat_Gozleyir_sor->execute(array(
                                'User_Fin'=>$User_Fin,
                               'Ise_Qebul_Emri_Stausu'=>0
                             ));
                             $Emir_Qeydiyyat_Gozleyir=$Emir_Qeydiyyat_Gozleyir_sor->rowCount();
                             if (!$Emir_Qeydiyyat_Gozleyir>0) {*/ 
                              $Idare_Sor=$db->prepare("SELECT * FROM idare WHERE Idare_Id=:Idare_Id");
                              $Idare_Sor->execute(array(                                
                                'Idare_Id'=>$User_Islediyi_Idare));
                              $Idare_Cek=$Idare_Sor->fetch(PDO::FETCH_ASSOC);
                              $User_Islediyi_Idare_Ad=$Idare_Cek['Idare_Adi'];

                              $Sobe_Sor=$db->prepare("SELECT * FROM sobe WHERE Sobe_Id=:Sobe_Id");
                              $Sobe_Sor->execute(array(                                
                                'Sobe_Id'=>$User_Islediyi_Sobe_Bolme));
                              $Sobe_Cek=$Sobe_Sor->fetch(PDO::FETCH_ASSOC);
                              $User_Islediyi_Sobe_Bolme_Ad=$Sobe_Cek['Sobe_Ad'];

                              $Elave_Et=$db->prepare("INSERT INTO ise_qebul_emri SET
                               ID=:ID, 
                               User_Soy_Ad=:User_Soy_Ad, 
                               User_Ad=:User_Ad,        
                               User_Ata_Ad=:User_Ata_Ad,        
                               User_Dogum_Tarixi=:User_Dogum_Tarixi,
                               /*  User_Fin=:User_Fin,*/
                               User_Yasayis_Unvan=:User_Yasayis_Unvan,
                               User_Tehsil=:User_Tehsil,
                               User_Tehsil_Aldigi_Muesse=:User_Tehsil_Aldigi_Muesse,
                               Ixtisas=:Ixtisas,
                               User_Ise_Qebul_Tarixi=:User_Ise_Qebul_Tarixi,
                               Usre_Cinsiyeti=:Usre_Cinsiyeti,
                               User_Is_Novu=:User_Is_Novu,
                               Ise_Qebul_Emri_Nomresi=:Ise_Qebul_Emri_Nomresi,
                               Mezmun=:Mezmun,
                               User_Islediyi_Idare=:User_Islediyi_Idare,
                               User_Islediyi_Idare_Ad=:User_Islediyi_Idare_Ad,
                               User_Islediyi_Sobe_Bolme=:User_Islediyi_Sobe_Bolme,
                               User_Islediyi_Sobe_Bolme_Ad=:User_Islediyi_Sobe_Bolme_Ad,
                               User_Vezife=:User_Vezife,
                               User_Vezife_Ad=:User_Vezife_Ad,
                               ZamanDamgasi=:ZamanDamgasi,
                               TarixSaat=:TarixSaat,
                               Ise_Qebul_Emri_Stausu=:Ise_Qebul_Emri_Stausu,
                               Seo_Url=:Seo_Url,
                               SinaqMuddeti=:SinaqMuddeti,
                               SinaqMuddetiBitis=:SinaqMuddetiBitis,
                               SinaqMuddetiGunAy=:SinaqMuddetiGunAy
                               ");
                              $Insert=$Elave_Et->execute(array(
                               'ID'=>$ID,  
                               'User_Soy_Ad'=>$User_Soy_Ad,  
                               'User_Ad'=>$User_Ad,        
                               'User_Ata_Ad'=>$User_Ata_Ad,        
                               'User_Dogum_Tarixi'=>$User_Dogum_Tarixi,
                               /*'User_Fin'=>$User_Fin,*/
                               'User_Yasayis_Unvan'=>$User_Yasayis_Unvan,
                               'User_Tehsil'=>$User_Tehsil,
                               'User_Tehsil_Aldigi_Muesse'=>$User_Tehsil_Aldigi_Muesse,
                               'Ixtisas'=>$Ixtisas,
                               'User_Ise_Qebul_Tarixi'=>$User_Ise_Qebul_Tarixi,
                               'Usre_Cinsiyeti'=>$Usre_Cinsiyeti,
                               'User_Is_Novu'=>$User_Is_Novu,
                               'Ise_Qebul_Emri_Nomresi'=>$Ise_Qebul_Emri_Nomresi,
                               'Mezmun'=>$Mezmun,
                               'User_Islediyi_Idare'=>$User_Islediyi_Idare,
                               'User_Islediyi_Idare_Ad'=>$User_Islediyi_Idare_Ad,
                               'User_Islediyi_Sobe_Bolme'=>$User_Islediyi_Sobe_Bolme,
                               'User_Islediyi_Sobe_Bolme_Ad'=>$User_Islediyi_Sobe_Bolme_Ad,
                               'User_Vezife'=>$User_Vezife,
                               'User_Vezife_Ad'=>$User_Vezife_Ad,
                               'ZamanDamgasi'=>$ZamanDamgasi,
                               'TarixSaat'=>$TarixSaat,
                               'Ise_Qebul_Emri_Stausu'=>1,
                               'Seo_Url'=>$Seo_Url,
                               'SinaqMuddeti'=>$SinaqMuddeti, 
                               'SinaqMuddetiBitis'=>$SinaqMuddetiBitis,
                               'SinaqMuddetiGunAy'=>$SinaqMuddetiGunAy
                             ));
                              $Ise_Qebul_Emri_Id = $db->lastInsertId();
                              $Vezife_Sor=$db->prepare("SELECT * FROM vezife WHERE Vezife_Id=:Vezife_Id");
                              $Vezife_Sor->execute(array(
                                'Vezife_Id'=>$User_Vezife));
                              $Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
                              $Vezife_Pulu=$Vezife_Cek['Vezife_Pulu'];
                              $Vezife_Adlari_Id=$Vezife_Cek['Vezife_Adlari_Id'];
                              $Vezife_Ad=$Vezife_Cek['Vezife_Ad'];
                              $Stat_Vahidi=$Vezife_Cek['Stat_Vahidi'];
                              $Stat_Muqavile=$Vezife_Cek['Stat_Muqavile'];
                              $Idare_Id=$Vezife_Cek['Idare_Id'];
                              $Sobe_Id=$Vezife_Cek['Sobe_Id'];
                              $AlaBileceyiRutbe=$Vezife_Cek['AlaBileceyiRutbe'];
                              $Zabit_Mulu=$Vezife_Cek['Zabit_Mulu'];
                              $Sira_No=$Vezife_Cek['Sira_No'];
                              $Durum=$Vezife_Cek['Durum'];
                              $User_SEO_URL=seo($User_Soy_Ad." ".$User_Ad." ".$User_Ata_Ad);
                              
                              $Elave_Et=$db->prepare("INSERT INTO user SET
                                ID=:ID, /*silinecek */
                                Ise_Qebul_Emri_Id=:Ise_Qebul_Emri_Id, 
                                Ise_Qebul_Emri_Nomresi=:Ise_Qebul_Emri_Nomresi, 
                                Soy_Adi=:Soy_Adi, 
                                Adi=:Adi, 
                                Ata_Adi=:Ata_Adi, 
                                Cinsiyeti=:Cinsiyeti, 
                                Dogum_Tarixi=:Dogum_Tarixi, 
                                Yasayis_Unvan=:Yasayis_Unvan, 
                                Ise_Qebul_Tarixi=:Ise_Qebul_Tarixi, 
                                Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi, 
                                Sinaq_Muddeti=:Sinaq_Muddeti, 
                                SinaqMuddetiGunAy=:SinaqMuddetiGunAy, 
                                SinaqMuddetiBitis=:SinaqMuddetiBitis, 
                                Is_Novu=:Is_Novu, 
                                Islediyi_Idare_Id=:Islediyi_Idare_Id, 
                                Idare_Ad=:Idare_Ad, 
                                Islediyi_Sobe_Id=:Islediyi_Sobe_Id, 
                                Sobe_Ad=:Sobe_Ad, 
                                Vezife_Id=:Vezife_Id, 
                                Vezife_Ad=:Vezife_Ad, 
                                Vezife_Pulu=:Vezife_Pulu,                             
                                Durum=:Durum,          
                                Seo_Url=:Seo_Url
                                ");
                              $Insert=$Elave_Et->execute(array(
                                'ID'=>$ID,  /*silinecek*/
                                'Ise_Qebul_Emri_Id'=>$Ise_Qebul_Emri_Id,  
                                'Ise_Qebul_Emri_Nomresi'=>$Ise_Qebul_Emri_Nomresi,  
                                'Soy_Adi'=>$User_Soy_Ad,  
                                'Adi'=>$User_Ad,  
                                'Ata_Adi'=>$User_Ata_Ad, 
                                'Cinsiyeti'=>$Usre_Cinsiyeti,  
                                'Dogum_Tarixi'=>$User_Dogum_Tarixi,  
                                'Yasayis_Unvan'=>$User_Yasayis_Unvan,  
                                'Ise_Qebul_Tarixi'=>$User_Ise_Qebul_Tarixi,  
                                'Vezifeye_Teyin_Tarixi'=>$User_Ise_Qebul_Tarixi,  
                                'Sinaq_Muddeti'=>$SinaqMuddeti,  
                                'SinaqMuddetiGunAy'=>$SinaqMuddetiGunAy,  
                                'SinaqMuddetiBitis'=>$SinaqMuddetiBitis,  
                                'Is_Novu'=>$User_Is_Novu,  
                                'Islediyi_Idare_Id'=>$User_Islediyi_Idare,  
                                'Idare_Ad'=>$User_Islediyi_Idare_Ad,  
                                'Islediyi_Sobe_Id'=>$User_Islediyi_Sobe_Bolme,  
                                'Sobe_Ad'=>$User_Islediyi_Sobe_Bolme_Ad,  
                                'Vezife_Id'=>$User_Vezife,  
                                'Vezife_Ad'=>$User_Vezife_Ad,  
                                'Vezife_Pulu'=>$Vezife_Pulu,                           
                                'Durum'=>1,           
                                'Seo_Url'=>$User_SEO_URL       
                              ));

                              $ID = $ID /*$db->lastInsertId()*/;
                              $Elave_Et=$db->prepare("INSERT INTO user_tehsil SET
                                ID=:ID,
                                Tehsil=:Tehsil,
                                Tehsil_Aldigi_Muesise=:Tehsil_Aldigi_Muesise,
                                Ixtisas=:Ixtisas,
                                TarixSaat=:TarixSaat
                                ");
                              $Insert=$Elave_Et->execute(array(
                                'ID'=>$ID,
                                'Tehsil'=>$User_Tehsil,
                                'Tehsil_Aldigi_Muesise'=>$User_Tehsil_Aldigi_Muesse,
                                'Ixtisas'=>$Ixtisas,
                                'TarixSaat'=>$TarixSaat
                              ));
                              $Elave_Et=$db->prepare("INSERT INTO selahiyyet SET
                                ID=:ID
                                ");
                              $Insert=$Elave_Et->execute(array(
                                'ID'=>$ID
                              ));

                              $Elave_Et=$db->prepare("INSERT INTO user_islediyi_vezife SET
                                ID=:ID,
                                Idare_Ad=:Idare_Ad,
                                Sobe_Ad=:Sobe_Ad,
                                Vezife_Ad=:Vezife_Ad,
                                Vezifeye_Teyin_Tarixi=:Vezifeye_Teyin_Tarixi
                                ");
                              $Insert=$Elave_Et->execute(array(
                                'ID'=>$ID,
                                'Idare_Ad'=>$User_Islediyi_Idare_Ad,
                                'Sobe_Ad'=>$User_Islediyi_Sobe_Bolme_Ad,
                                'Vezife_Ad'=>$User_Vezife_Ad,
                                'Vezifeye_Teyin_Tarixi'=>$User_Ise_Qebul_Tarixi
                              ));
                              $yenile=$db->prepare("UPDATE vezife SET 
                                User_Id=:User_Id
                                WHERE Vezife_Id=$User_Vezife");
                              $update=$yenile->execute(array(
                                'User_Id'=>$ID
                              ));


                              $Elave_Et=$db->prepare("INSERT INTO emir SET
                                ID=:ID,                                
                                Emir_Tarix=:Emir_Tarix                                
                                ");
                              $Insert=$Elave_Et->execute(array(
                                'ID'=>$ID,                                
                                'Emir_Tarix'=>$User_Ise_Qebul_Tarixi                                
                              ));
                              $Emir_Id = $db->lastInsertId();
                              $yenile=$db->prepare("UPDATE ise_qebul_emri SET 
                                Emir_Id=:Emir_Id
                                WHERE Ise_Qebul_Emri_Id=$Ise_Qebul_Emri_Id");
                              $update=$yenile->execute(array(
                                'Emir_Id'=>$Emir_Id
                              ));



                              if ($update) {
                                $Sor=$db->prepare("SELECT * FROM  ise_qebul_emri order by Ise_Qebul_Emri_Stausu ASC,Ise_Qebul_Emri_Id DESC limit 5");
                                $Sor->execute();
                                $Say=$Sor->rowCount();
                                if ($Say>0) {?>
                                  <input type="hidden" id="yenilendi">
                                  <div class="">
                                    <div class="">
                                      <table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
                                        <thead>
                                          <tr>
                                            <th></th>
                                            <th>Əmir №</th>
                                            <th>Soyadı</th>
                                            <th>Adı</th>
                                            <th>Ata adı</th>
                                            <th>Id</th>
                                            <th>Doğum tarixi</th>
                                            <th>Ünvanı</th>
                                            <th>İdarə</th>
                                            <th>Bölmə</th>
                                            <th>Vəzifə</th>
                                            <th class="tarixsutunu">Tarix</th>                        

                                          </tr>
                                        </thead>
                                        <tbody id="list" class="table_ici">
                                          <?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {  ?>
                                            <tr>    
                                              <td class="emir_sec_alani">                   
                                                <button class="SecButonu" id="Bax_<?php echo $Cek['Ise_Qebul_Emri_Id'] ?>" onclick="Bax(this.id)" type="button"></button>
                                              </td> 
                                              <td class="siar_no_alani"><?php echo $Cek['Ise_Qebul_Emri_Nomresi'] ?></td>
                                              <td><?php echo $Cek['User_Soy_Ad']?></td>
                                              <td><?php echo $Cek['User_Ad']?></td>
                                              <td><?php echo $Cek['User_Ata_Ad']?></td>
                                              <td><?php echo $Cek['ID']?></td>
                                              <td data-sort="<?php echo$Cek['User_Dogum_Tarixi'] ?>" class="textaligncenter"><?php echo  Tarix_Beynelxalqi_Az_Cevir($Cek['User_Dogum_Tarixi']); ?></td> 
                                              <td><?php echo $Cek['User_Yasayis_Unvan']?></td>        
                                              <td><?php echo $Cek['User_Islediyi_Idare_Ad']?></td>        
                                              <td><?php echo $Cek['User_Islediyi_Sobe_Bolme_Ad']?></td>       
                                              <td><?php echo $Cek['User_Vezife_Ad']?></td>        
                                              <td data-sort="<?php echo$Cek['User_Ise_Qebul_Tarixi'] ?>" class="textaligncenter"><?php echo  Tarix_Beynelxalqi_Az_Cevir($Cek['User_Ise_Qebul_Tarixi']); ?></td>         
                                              
                                            </tr> 
                                          <?php }
                                          ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                <?php }

                              }else{
                               echo "error_2019";/*İnser Uğursuz oldu*/
                               exit;
                             }  
                             /*}else{
                              echo "error_2018";//Bu şəxs üçün əmir qeydiyyat gözleyir
                              exit;
                            }*/
                          }else{
                           echo "error_2016";/*Təyin olunduğu uygun gelmir*/
                           exit;
                         }
                       }else{
                        echo "error_2015";/*Təyin olunduğu vəzifə secilməlidir*/
                        exit;
                      }
                    }else{
                      echo "error_2014";/*Təyin olunduğu şöbə secilməlidir*/
                      exit;
                    }
                  }else{
                    echo "error_2013";/*Təyin olunduğu idarə secilməlidir*/
                    exit;
                  }
                }else{
                 echo "error_2017";/*İşə Qəbul Əmri Boş ola Bilməz*/
                 exit;
               }
             }else{
               echo "error_2012";/*Işin Növü Boş Ola Bilməz Yəni Müqavilə Və ya Ştat secilməlidir*/
               exit;
             }
           }else{
            echo "error_2011";/*Cinsiyyəti Boş Ola bilməz*/
            exit;
          }
        }else{
          echo "error_2010";/*İşə qəbul tarixi boş ola bilməz*/
          exit;
        }
      }else{
        echo "error_2023";/*Təhsil Aldigi muəssisə Bos ola bilməz*/
        exit;
      }
    }else{
      echo "error_2009";/*Təhsil Aldigi muəssisə Bos ola bilməz*/
      exit;
    }
  }else{
    echo "error_2008";/*Təhsil Secimi Boş Ola Bilməz*/
    exit;
  } 
}else{
  echo "error_2007";/*Yaşayış Ünvanı Boş Ola Bilməz*/
  exit;
}
/* }else{
  echo "error_2006";//Fin Bazada var Və həmin adam işləyir
  exit;
}
}else{
  echo "error_2005";//Fin və ya qissa ola bilməz
  exit;
} */
}else{
 echo "error_2004";/*Dogum Tarixi Boş ola bilməz*/
 exit;
}
}else{
  echo "error_2003";/*Ata Adı Boş ola bilməz*/
  exit;
}
}else{
  echo "error_2002";/* Adı Boş ola bilməz*/
  exit;
}
}else{
  echo "error_2001";/* Soy adı Boş ola bilməz*/
  exit;
}

}else{
  header("Location:../ise_qebul_emri.php");
  exit;
}


?>