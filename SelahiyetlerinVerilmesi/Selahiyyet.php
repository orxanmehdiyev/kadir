<?php 
require_once '../Ayarlar/setting.php';
if (isset($_POST['Deyer'])) {
 $ID   =  EditorluIcerikleriFiltrle($_POST['Deyer']); 
 $selahiyyet_yoxla=$db->prepare("SELECT * FROM selahiyyet where ID=:ID");
 $selahiyyet_yoxla->execute(array(
  'ID'=>$ID));
 $elahiyyet_say=$selahiyyet_yoxla->rowCount();
 if ($elahiyyet_say>1) {
  for ($i=0; $i <= $elahiyyet_say; $i++) { 
    $sil = $db->prepare("DELETE from selahiyyet where ID=:ID");
    $kontrol = $sil->execute(array(
      'ID' => $ID
    ));
  }    
}elseif($elahiyyet_say==0){

 $Elave_Et=$db->prepare("INSERT INTO selahiyyet SET
  ID=:ID
  ");
 $Insert=$Elave_Et->execute(array(
  'ID'=>$ID
));
}
$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID and Durum=:Durum");
$User_Sor->execute(array(
  'ID'=>$ID,
  'Durum'=>1));
$User_Say=$User_Sor->rowCount();

$Sor=$db->prepare("SELECT * FROM selahiyyet where ID=:ID");
$Sor->execute(array(
  'ID'=>$ID));
$Cek=$Sor->fetch(PDO::FETCH_ASSOC);


if ($User_Say>0) {
  ?>
  <table style="white-space: normal;" class="table table-bordered table-hover" id="iseqebulemirleritablo">  
    <tbody  class="table_ici">  
      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['KadirGirisYetgisi']==1 ? "checked":"";?>
            type="checkbox" id="KadirGirisYetgisi_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Kadrlar proqramına giriş
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IcraciImzaSelahiyyeti']==1 ? "checked":"";?>
            type="checkbox" id="IcraciImzaSelahiyyeti_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          İcracı imza səlahiyyəti
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['TesdiqSelahiyyeti']==1 ? "checked":"";?>
            type="checkbox" id="TesdiqSelahiyyeti_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Təsdiq səlahiyyəti      
        </td> 
        <td></td>   

      </tr>          
      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['TenzimlenmelerMenusu']==1 ? "checked":"";?>
            type="checkbox" id="TenzimlenmelerMenusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Tənzimlənmələr menusu
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['BasIdare']==1 ? "checked":"";?>
            type="checkbox" id="BasIdare_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Baş idarə menusu
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['YeniBasIdare']==1 ? "checked":"";?>
            type="checkbox" id="YeniBasIdare_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Yeni Baş idarə
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['BasIdareAktivPassiv']==1 ? "checked":"";?>
            type="checkbox" id="BasIdareAktivPassiv_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Baş idarə aktiv passiv etmək
        </td>   

      </tr>  



      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['BasIdareDuzenle']==1 ? "checked":"";?>
            type="checkbox" id="BasIdareDuzenle_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Baş idarə düzəliş
        </td>


        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['BasIdareSil']==1 ? "checked":"";?>
            type="checkbox" id="BasIdareSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Baş idarə Sil
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IdarelerMenusu']==1 ? "checked":"";?>
            type="checkbox" id="IdarelerMenusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          İdarələr menusu
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IdarelerYeni']==1 ? "checked":"";?>
            type="checkbox" id="IdarelerYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>  Yeni idarə yaradılması
        </td>    
      </tr>


      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IdarelerDurumKontrol']==1 ? "checked":"";?>
            type="checkbox" id="IdarelerDurumKontrol_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> İdarələr durum kontrol
        </td>


        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IdarelerDuzelis']==1 ? "checked":"";?>
            type="checkbox" id="IdarelerDuzelis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          İdarələr Düzəliş
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IdarelerSil']==1 ? "checked":"";?>
            type="checkbox" id="IdarelerSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          İdarələr sil
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IdarelerIslemlereBaxis']==1 ? "checked":"";?>
            type="checkbox" id="IdarelerIslemlereBaxis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>  İdarə əməliyatlarına baxış
        </td>    
      </tr>



      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['SobeBolmelerMenusu']==1 ? "checked":"";?>
            type="checkbox" id="SobeBolmelerMenusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Şöbə bölmələr menusu
        </td>


        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['SobeBolmeYeni']==1 ? "checked":"";?>
            type="checkbox" id="SobeBolmeYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Yeni şöbə/bölmə yaradılması
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['SobeBolmeDurumKontrol']==1 ? "checked":"";?>
            type="checkbox" id="SobeBolmeDurumKontrol_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>
          Şöbə/bölmə aktiv passif etmək
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['SobeBolmeDuzelis']==1 ? "checked":"";?>
            type="checkbox" id="SobeBolmeDuzelis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>  Şöbə/bölmə düzəliş
        </td>    
      </tr>
      <hr>
      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['SobeBolmeSil']==1 ? "checked":"";?>
            type="checkbox" id="SobeBolmeSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Şöbə bölmələr sil
        </td>
        <td></td> 
        <td></td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>Vəzifələr menusu səlahiyətləndirilməsi</b></td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifelerMenusu']==1 ? "checked":"";?>
            type="checkbox" id="VezifelerMenusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vəzifələr menusu
        </td>
        <td>          
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifelerYeniButtonu']==1 ? "checked":"";?>
            type="checkbox" id="VezifelerYeniButtonu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Yeni vəzifə
        </td> 
        <td>          
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifelerDurum']==1 ? "checked":"";?>
            type="checkbox" id="VezifelerDurum_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vezife aktiv passiv etmək
        </td> 
        <td>          
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifelerDuzeli']==1 ? "checked":"";?>
            type="checkbox" id="VezifelerDuzeli_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vezife düzəliş
        </td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifelerSil']==1 ? "checked":"";?>
            type="checkbox" id="VezifelerSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vəzifə sil butonu
        </td>
        <td>

          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifeButunIdareler']==1 ? "checked":"";?>
            type="checkbox" id="VezifeButunIdareler_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Bütün idarələri gör

        </td> 
        <td></td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>Vəzifə adları menusu səlahiyətləndirilməsi</b></td>    
      </tr>


      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifeAdlariMenusu']==1 ? "checked":"";?>
            type="checkbox" id="VezifeAdlariMenusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vəzifə adları menusu
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifeAdlariSira']==1 ? "checked":"";?>
            type="checkbox" id="VezifeAdlariSira_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vəzifə adları sıra əməliyatları
        </td> 
        <td>          
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifeAdlariAktivPassiv']==1 ? "checked":"";?>
            type="checkbox" id="VezifeAdlariAktivPassiv_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vəzifə adları status
        </td> 
        <td>                    
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifeAdlariSil']==1 ? "checked":"";?>
            type="checkbox" id="VezifeAdlariSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label> Vəzifə adları sil    
        </td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['VezifeAdlariYeni']==1 ? "checked":"";?>
            type="checkbox" id="VezifeAdlariYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Yeni vəzifə adları
        </td>
        <td></td> 
        <td></td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>Rütbə adları münusu</b></td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['RutbeAdlariMensu']==1 ? "checked":"";?>
            type="checkbox" id="RutbeAdlariMensu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Rütbə adları menusu
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['RutbeAdlariYeni']==1 ? "checked":"";?>
            type="checkbox" id="RutbeAdlariYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Yeni rütbə adları
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['RutbeAdlariStatus']==1 ? "checked":"";?>
            type="checkbox" id="RutbeAdlariStatus_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Rütbə adları status
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['RutbeAdlariDuzelis']==1 ? "checked":"";?>
            type="checkbox" id="RutbeAdlariDuzelis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Rütbə adları düzeliş
        </td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['RutbeAdlariSil']==1 ? "checked":"";?>
            type="checkbox" id="RutbeAdlariSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Rütbə adları sil
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['RutbeAdlariBaxis']==1 ? "checked":"";?>
            type="checkbox" id="RutbeAdlariBaxis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Rütbə adları baxış sil
        </td> 
        <td></td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>İntizam tənbehi adları</b></td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IntizamTenbehiAdlariMenu']==1 ? "checked":"";?>
            type="checkbox" id="IntizamTenbehiAdlariMenu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İntizam tənbehi adları menusu
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IntizamTenbehiAdlariYeni']==1 ? "checked":"";?>
            type="checkbox" id="IntizamTenbehiAdlariYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Yeni intizam tənbehi növü
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IntizamTenbehiAdlariNezerealma']==1 ? "checked":"";?>
            type="checkbox" id="IntizamTenbehiAdlariNezerealma_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İntizam tənbeh növü nəzərə alma
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IntizamTenbehiAdlariNezerealmaGoster']==1 ? "checked":"";?>
            type="checkbox" id="IntizamTenbehiAdlariNezerealmaGoster_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İntizam tənbeh növü nəzərə alma görünüş
        </td>    
      </tr>


      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IntizamTenbehiAdlariStatus']==1 ? "checked":"";?>
            type="checkbox" id="IntizamTenbehiAdlariStatus_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İntizam tənbehi növü status
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IntizamTenbehiAdlariDuzelis']==1 ? "checked":"";?>
            type="checkbox" id="IntizamTenbehiAdlariDuzelis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Yeni intizam tənbehi növü düzəliş
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IntizamTenbehiAdlariSil']==1 ? "checked":"";?>
            type="checkbox" id="IntizamTenbehiAdlariSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İntizam tənbeh adları sil
        </td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>Həvəsləndirmə adları</b></td>    
      </tr>
      

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['HeveslendiremAdlariMenusu']==1 ? "checked":"";?>
            type="checkbox" id="HeveslendiremAdlariMenusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Həvəsləndirmə adları menu
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['HeveslendiremAdlariYeni']==1 ? "checked":"";?>
            type="checkbox" id="HeveslendiremAdlariYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Yeni həvəsləndirmə adları
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['HeveslendiremAdlariNezereAlma']==1 ? "checked":"";?>
            type="checkbox" id="HeveslendiremAdlariNezereAlma_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Həvəsləndirmə adları nəzərə alma
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['HeveslendiremAdlariStatus']==1 ? "checked":"";?>
            type="checkbox" id="HeveslendiremAdlariStatus_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Həvəsləndirmə adları status
        </td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['HeveslendiremAdlariDuzelis']==1 ? "checked":"";?>
            type="checkbox" id="HeveslendiremAdlariDuzelis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Həvəsləndirmə adları düzeliş
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['HeveslendiremAdlariSil']==1 ? "checked":"";?>
            type="checkbox" id="HeveslendiremAdlariSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Həvəsləndirmə adları sil
        </td> 
        <td></td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>Məzuniyyət adları menusu</b></td>    
      </tr>


      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['MezuniyyetAdlariMenusu']==1 ? "checked":"";?>
            type="checkbox" id="MezuniyyetAdlariMenusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Məzuniyyət növləri menusu
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['MezuniyyetAdlariYeni']==1 ? "checked":"";?>
            type="checkbox" id="MezuniyyetAdlariYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Yeni məzuniyyət növü
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['MezuniyyetAdlariStatus']==1 ? "checked":"";?>
            type="checkbox" id="MezuniyyetAdlariStatus_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Məzuniyyət adları status
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['MezuniyyetAdlariDuzelis']==1 ? "checked":"";?>
            type="checkbox" id="MezuniyyetAdlariDuzelis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Məzuniyyət adları düzəliş
        </td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['MezuniyyetAdlariSil']==1 ? "checked":"";?>
            type="checkbox" id="MezuniyyetAdlariSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Məzuniyyət adları sil
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['MezuniyyetAdlariBax']==1 ? "checked":"";?>
            type="checkbox" id="MezuniyyetAdlariBax_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Məzuniyyət adları bax
        </td> 
        <td></td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>İstehsalat təqvimi səlahiyyəti</b></td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IstehsaltTeqvimimenu']==1 ? "checked":"";?>
            type="checkbox" id="IstehsaltTeqvimimenu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İstehsalat təqvimi menusu
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IstehsaltTeqvimiYeni']==1 ? "checked":"";?>
            type="checkbox" id="IstehsaltTeqvimiYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İstehsalat təqvimi yeni
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['IstehsaltTeqvimiSil']==1 ? "checked":"";?>
            type="checkbox" id="IstehsaltTeqvimiSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İstehsalat sil
        </td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>Xidmətə xitam vermə səbəblərinin səlahiyətləndirilməsi</b></td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['XidmeteXitamVerilmesiMensusu']==1 ? "checked":"";?>
            type="checkbox" id="XidmeteXitamVerilmesiMensusu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Xidmete xitam verilmesi menusu
        </td>
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['XidmeteXitamVerilmesiYeni']==1 ? "checked":"";?>
            type="checkbox" id="XidmeteXitamVerilmesiYeni_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Yeni xitam sebebi
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['XidmeteXitamVerilmesisSebebiSil']==1 ? "checked":"";?>
            type="checkbox" id="XidmeteXitamVerilmesisSebebiSil_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Xidmete xitam sebebi sil
        </td> 
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['XidmeteXitamVerilmesisSebebiDuzelis']==1 ? "checked":"";?>
            type="checkbox" id="XidmeteXitamVerilmesisSebebiDuzelis_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Xidmete xitam sebebi düzəliş
        </td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>İnsan Resruları</b></td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['InsanResruslariEsasMenu']==1 ? "checked":"";?>
            type="checkbox" id="InsanResruslariEsasMenu_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>İnsan Resrusları Əsas Menu
        </td>
        <td></td> 
        <td></td> 
        <td></td>    
      </tr>

      <tr class="textaligncenter" >
        <td colspan="4"><b>Xidmet yerkləri</b></td>    
      </tr>
      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['XidmetYerleriAd']==1 ? "checked":"";?>
            type="checkbox" id="XidmetYerleriAd_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Xidmet yerləri menusu
        </td>
        <td></td> 
        <td></td> 
        <td></td>    
      </tr>



      <tr class="textaligncenter" >
        <td colspan="4"><b>Ümumi baxış</b></td>    
      </tr>

      <tr>        
        <td>
          <label class="checkbox" title="" >
            <input <?php echo $Cek['UmumiBaxisButunIdareler']==1 ? "checked":"";?>
            type="checkbox" id="UmumiBaxisButunIdareler_<?php echo $ID ?>" onchange="DurumKontrol(this.id)" > 
            <span class="checkbox"> 
              <span></span>
            </span>
          </label>Ümumi baxış bütün idarələr
        </td>
        <td></td> 
        <td></td> 
        <td></td>    
      </tr>





      
      
























    </tbody>
  </table>
  <?php 
} 

}
?>