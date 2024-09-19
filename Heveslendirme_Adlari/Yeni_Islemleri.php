<?php 
require_once '../Ayarlar/setting.php';
if ($HeveslendiremAdlariYeni==1) {
  if (isset($_POST['Deyer'])) {
   $deyer =json_decode($_POST['Deyer'],true);
   $heveslendirem_tedbirleri_ad=EditorluIcerikleriFiltrle($deyer['heveslendirem_tedbirleri_ad']);
   $heveslendirem_tedbirleri_ad_Seo_Url= HerfVeReqemlerXaricButunKarakterleriSil(Benzersiz_Seo_Url($heveslendirem_tedbirleri_ad));  
   $SiraSor=$db->prepare("SELECT MAX(heveslendirem_tedbirleri_ad_Sira_No) AS heveslendirem_tedbirleri_ad_Sira_No FROM heveslendirem_tedbirleri_ad");
   $SiraSor->execute();
   $SiraCek=$SiraSor->fetch(PDO::FETCH_ASSOC);
   $heveslendirem_tedbirleri_ad_Sira_No=$SiraCek['heveslendirem_tedbirleri_ad_Sira_No']+1;
   $XususiSor=$db->prepare("SELECT MAX(heveslendirem_tedbirleri_ad_Xususi_No) AS heveslendirem_tedbirleri_ad_Xususi_No FROM heveslendirem_tedbirleri_ad");
   $XususiSor->execute();
   $XususiCek=$XususiSor->fetch(PDO::FETCH_ASSOC);
   $heveslendirem_tedbirleri_ad_Xususi_No=$XususiCek['heveslendirem_tedbirleri_ad_Xususi_No']+1;
   if ($heveslendirem_tedbirleri_ad!="") { 
    $Elave_Et=$db->prepare("INSERT INTO  heveslendirem_tedbirleri_ad SET                               
     heveslendirem_tedbirleri_ad=:heveslendirem_tedbirleri_ad,
     heveslendirem_tedbirleri_ad_Sira_No=:heveslendirem_tedbirleri_ad_Sira_No,
     heveslendirem_tedbirleri_ad_Xususi_No=:heveslendirem_tedbirleri_ad_Xususi_No,
     heveslendirem_tedbirleri_ad_nezere_alam=:heveslendirem_tedbirleri_ad_nezere_alam,
     heveslendirem_tedbirleri_ad_durum=:heveslendirem_tedbirleri_ad_durum,
     heveslendirem_tedbirleri_ad_Seo_Url=:heveslendirem_tedbirleri_ad_Seo_Url
     ");
    $Insert=$Elave_Et->execute(array(                                
     'heveslendirem_tedbirleri_ad'=>$heveslendirem_tedbirleri_ad,
     'heveslendirem_tedbirleri_ad_Sira_No'=>$heveslendirem_tedbirleri_ad_Sira_No,
     'heveslendirem_tedbirleri_ad_Xususi_No'=>$heveslendirem_tedbirleri_ad_Xususi_No,
     'heveslendirem_tedbirleri_ad_nezere_alam'=>0,
     'heveslendirem_tedbirleri_ad_durum'=>0,
     'heveslendirem_tedbirleri_ad_Seo_Url'=>$heveslendirem_tedbirleri_ad_Seo_Url
   ));
    if ($Insert) {
      $heveslendirem_tedbirleri_ad_id=$db->lastInsertId();
      $Elave_Et=$db->prepare("INSERT INTO  heveslendirem_tedbirleri_ad_islemleri SET                               
       heveslendirem_tedbirleri_ad_islemleri_IPadresi=:heveslendirem_tedbirleri_ad_islemleri_IPadresi,
       heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi=:heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi,
       heveslendirem_tedbirleri_ad_id=:heveslendirem_tedbirleri_ad_id,
       heveslendirem_tedbirleri_ad=:heveslendirem_tedbirleri_ad,
       heveslendirem_tedbirleri_ad_Sira_No=:heveslendirem_tedbirleri_ad_Sira_No,
       heveslendirem_tedbirleri_ad_Xususi_No=:heveslendirem_tedbirleri_ad_Xususi_No,
       heveslendirem_tedbirleri_ad_durum=:heveslendirem_tedbirleri_ad_durum,
       heveslendirem_tedbirleri_ad_nezere_alam=:heveslendirem_tedbirleri_ad_nezere_alam,
       Status=:Status,
       Islem_Eden_User_Id=:Islem_Eden_User_Id,
       heveslendirem_tedbirleri_ad_Seo_Url=:heveslendirem_tedbirleri_ad_Seo_Url
       ");
      $Insert=$Elave_Et->execute(array(                                
       'heveslendirem_tedbirleri_ad_islemleri_IPadresi'=>$IPAdresi,
       'heveslendirem_tedbirleri_ad_islemleri_ZamanDamgasi'=>$ZamanDamgasi,
       'heveslendirem_tedbirleri_ad_id'=>$heveslendirem_tedbirleri_ad_id,
       'heveslendirem_tedbirleri_ad'=>$heveslendirem_tedbirleri_ad,
       'heveslendirem_tedbirleri_ad_Sira_No'=>$heveslendirem_tedbirleri_ad_Sira_No,
       'heveslendirem_tedbirleri_ad_Xususi_No'=>$heveslendirem_tedbirleri_ad_Xususi_No,
       'heveslendirem_tedbirleri_ad_durum'=>0,
       'heveslendirem_tedbirleri_ad_nezere_alam'=>0,
       'Status'=>1,
       'Islem_Eden_User_Id'=>$User_Id,
       'heveslendirem_tedbirleri_ad_Seo_Url'=>$heveslendirem_tedbirleri_ad_Seo_Url
     ));
     if ($Insert) {?>
      <input type="hidden" id="yenilendi">
      <?php 
      $Sor=$db->prepare("SELECT * FROM  heveslendirem_tedbirleri_ad order by heveslendirem_tedbirleri_ad_Sira_No ASC ");
      $Sor->execute();
      $Say=$Sor->rowCount();
      if ($Say>0) {?>
        <div class="row">
          <div class="over-y genislik">
            <table class="table table-bordered table-hover">
              <thead class="">
                <tr>
                  <th>№</th>
                  <th>Adı</th>
                  <th>Sıra №</th>
                  <th>Xüsusi №</th>
                  <?php if ($HeveslendiremAdlariNezereAlma==1): ?>
                    <th>Nəzərə alma</th>
                  <?php endif ?>    
                  <?php if ($HeveslendiremAdlariStatus==1 or $HeveslendiremAdlariDuzelis==1 or $HeveslendiremAdlariSil==1): ?>
                    <th class="textaligncenter">Əməliyatlar</th>        
                  <?php endif ?>                
                  
                </tr>
              </thead>
              <tbody id="list" class="table_ici">
                <?php 
                $sira=0;
                while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {
                  $sira++;
                  ?>
                  <tr>              
                    <td class="siar_no_alani"><?php echo $sira ?></td>                  
                    <td><?php echo $Cek['heveslendirem_tedbirleri_ad'] ?></td>      
                    <td class="siar_no_alani"><?php echo $Cek['heveslendirem_tedbirleri_ad_Sira_No'] ?></td>                
                    <td class="siar_no_alani"><?php echo $Cek['heveslendirem_tedbirleri_ad_Xususi_No'] ?></td>
                    <?php if ($HeveslendiremAdlariNezereAlma==1): ?>
                      <td class="Vezife_Adlari_Durum_Kapsama">
                        <label class="checkbox">
                          <input 
                          <?php 
                          if ($Cek['heveslendirem_tedbirleri_ad_nezere_alam']==1) {
                            echo  "checked";
                          }else{}
                          ?>
                          type="checkbox" id="nezerealam_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onchange="NezereAlam(this.id)" > 
                          <span class="checkbox"> 
                            <span></span>
                          </span>
                        </label>
                      </td>
                    <?php endif ?>
                    <?php if ($HeveslendiremAdlariStatus==1 or $HeveslendiremAdlariDuzelis==1 or $HeveslendiremAdlariSil==1): ?>
                      

                      <td class="textaligncenter">
                        <?php if ($HeveslendiremAdlariStatus==1): ?>
                          <label class="checkbox">
                            <input 
                            <?php 
                            if ($Cek['heveslendirem_tedbirleri_ad_durum']==1) {
                              echo  "checked";
                            }else{}
                            ?>
                            type="checkbox" id="DurumId_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onchange="DurumKontrol(this.id)" > 
                            <span class="checkbox"> 
                              <span></span>
                            </span>
                          </label>
                        <?php endif ?>
                        <?php if ($HeveslendiremAdlariDuzelis==1): ?>
                          <button class="YenileButonlari" id="Duzelis_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onclick="Duzelis(this.id)" type="button"><i class="fas fa-edit"></i></button> 
                        <?php endif ?>                  

                        <?php if ($HeveslendiremAdlariSil==1): ?>
                          <button class="YenileButonlari" id="Sil_<?php echo $Cek['heveslendirem_tedbirleri_ad_id'] ?>" onclick="Sil(this.id)" type="button"><i class="fas fa-trash"></i></button>  
                        <?php endif ?>
                      </td>     
                    <?php endif ?>          

                  </tr> 
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php }else{  ?>
        <div class="row">
          <div class="over-y">
            Bazada Tədbiq Edilə Bilən İtizam Tənbehi Yoxdur 
          </div>
        </div> 
      <?php   } ?>
      

    <?php }else{
     echo "error_2003";/* Ikinci Əməliyyat Uğursuz*/
     exit;
   }
 }else{
  echo "error_2002";/* Birinci Əməliyyat Uğursuz*/
  exit;
}

}else{
  echo "error_2001";/* Adı boş ola bilməz*/
  exit;
}
}else{
  header("Location:../intizam_tebehi_adlari");
  exit;
}
}
?>