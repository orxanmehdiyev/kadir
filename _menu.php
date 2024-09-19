<div class="row">
	<div id="sidebar"  >
    <ul >
      <?php if ($TenzimlenmelerMenusu==1) {    ?>
        <li class="submenu"><a href="#">Tənzimlənmələr</a>
          <ul>
            <?php if ($BasIdare==1 or $IdarelerMenusu==1 or $SobeBolmelerMenusu==1 or $VezifelerMenusu==1 or $VezifeAdlariMenusu==1 or $RutbeAdlariMensu==1 or $IntizamTenbehiAdlariMenu==1 or $HeveslendiremAdlariMenusu==1 or $MezuniyyetAdlariMenusu==1 or $IstehsaltTeqvimimenu==1 or $XidmeteXitamVerilmesiMensusu==1 ) { ?>
              <li><a href=""><b>Strukturun Yaradılması</b> </a></li>
              <?php if ($BasIdare==1) {?><li><a href="tabeli_qurumlar_bas_idareler">&emsp;Baş idarə</a></li><?php } ?>   
              <?php if ($IdarelerMenusu==1) {?><li><a href="idare">&emsp;İdarələr</a></li><?php } ?>   
              <?php if ($SobeBolmelerMenusu==1) {?><li><a href="sobe">&emsp;Şöbə/Bölmələr</a></li><?php } ?>   
              <?php if ($VezifelerMenusu==1) {?><li><a href="vezifeler">&emsp;Vəzifələr</a></li><?php } ?>   
              <?php if ($VezifeAdlariMenusu==1) {?><li><a href="vezife_adlari">&emsp;Vəzifə adları</a></li><?php } ?>  
              <?php if ($RutbeAdlariMensu==1) {?><li><a href="rutbe_adlari">&emsp;Rütbə adları</a></li><?php } ?>  
              <?php if ($IntizamTenbehiAdlariMenu==1) {?><li><a href="intizam_tebehi_adlari">&emsp;İntizam tənbehi adları</a></li><?php } ?>  
              <?php if ($HeveslendiremAdlariMenusu==1) {?><li><a href="heveslendirme_ad">&emsp;Həvəsləndirmə adları</a></li><?php } ?>  
              <?php if ($MezuniyyetAdlariMenusu==1) {?><li><a href="mezuniyyet_novleri">&emsp;Məzuniyyət növləri</a></li><?php } ?>  
              <?php if ($IstehsaltTeqvimimenu==1) {?> <li><a href="istehsalat_teqvimi">&emsp;İstehsalat təqvimi</a></li><?php } ?>  
              <?php if ($XidmeteXitamVerilmesiMensusu==1) {?><li><a href="xidmete_xitam_sebebleri">&emsp;Xitam üçün əsas</a></li><?php } ?>
              <?php if ($SelahiyyetCek['XidmetYerleriAd']==1) {?><li><a href="xidmet_yerleri_adi">&emsp;Xidmət yerləri</a></li><?php } ?>
            <?php } ?>
          </ul>
        </li>
      <?php }else{} ?>
      <?php if ($InsanResruslariEsasMenu==1) {?>  
        <li class="submenu"><a href="#">İnsan resurusları</a>
          <ul>    
           <li><a href=""><b>Məlumatlara baxış</b> </a></li>     
           <li><a href="umumi_baxis">&emsp;Ümumi baxış</a></li>
           <li><a href="tedbiq_olunmus_heveslendirme_tedbirleri">&emsp;Tədbiq olunmuş həvəsləndirmə tədbirləri</a></li>
           <li><a href="tedbiq_olunmus_diger_teltifler">&emsp;Digər təltiflər</a></li>
           <li><a href="tedbiq_olunmus_intizam_tenbehleri">&emsp;Tədbiq olunmuş intizam tənbehləri</a></li>
           <li><a href="mezuniyyetde_olan">&emsp;Məzuniyyətdə olanlar</a></li>
           <li><a href="mezuniyyet_vaxtlari">&emsp;Əməkdaşların məzuniyyət vaxtları</a></li>
           <li><a href="ezamiyyede_olan">&emsp;Ezamiyyədə olanlar</a></li>
           <li><a href="serencamda_olanlar">&emsp;Sərəncamda olan əməkdaşlar</a></li>
           <li><a href="intizam_tebehi_adlari">&emsp;Xidmətinə xitam verilənlər</a></li>           
           <li><a href="mezuniyyet_novleri">&emsp;Xarici dil bilənlər</a></li>
           <li><a href="attestasiya_baxis">&emsp;Atestasiyya</a></li>         
           <li><a href="sertifikat_baxis">&emsp;Sertifikat</a></li>         
           <li><a href="ferdi_qiymetlendirme">&emsp;Fərdi Qiymətləndirmə</a></li>         
           <li><a href="teqaud_vaxtlari">&emsp;Təqaüd vaxtları</a></li>         
           <li><a href="rutbe_verilecek_emekdaşlar">&emsp;Rütbə veriləcək əməkdaşlar</a></li>         
           <li><a href="selahiyetlerin_verilmesi">&emsp;Səlahiyətlərin verilməsi</a></li>   
         </ul>
       </li>
     <?php } ?> 

     <li class="submenu"><a href="#">Əmirlərin işlənməsi</a>
      <ul>
        <li><a href="ise_qebul_emri">İşə qəbul</a></li>
        <li><a href="isden_azad_edilme">İşdən azad etmə</a></li>
        <li><a href="vezifeden_azad_edilme">Vəzifədən azad etmə</a></li>
        <li><a href="vezifeye_teyin_etme">Vəzifəyə təyin etmə</a></li>
        <li><a href="mezuniyyet_emri">Məzuniyyət</a></li>
        <li><a href="mezuniyyet_emri_geri">Məzuniyyətdən geri</a></li>
        <li><a href="ezamiyyə_emri">Ezamiyyə</a></li>
        <li><a href="atestasiya_emri">Attestasiya</a></li>
        <li><a href="intizam_tenbehleri">İntizam tənbehləri</a></li>
        <li><a href="heveslendirme_tedbirleri">Həvəsləndirmə Tədbirləri</a></li>
        <li><a href="xidmet_iline_elave">Xidmət ilinə əlavələrin verilməsi</a></li>
        <li><a href="diger_xidmet_illeri">Digər xidmet illəri</a></li>
        <li><a href="rutbe_emrleri">Xüsusi rütbənin verilməsi</a></li>
        <li><a href="stat_deyisikliyi">Ştat dəyişiklikləri</a></li>    
        <li><a href="tehkim_emri">Təhkim əmri</a></li>
        <li><a href="tehkimden_geri_emri">Təhkimdən geri</a></li>
        <li><a href="xestelik_verqelerinin_qeydiyyati">Xəsdəlik vərəqlərininqeydiyyatı</a></li>
        <li><a href="diger_teltiflerin_qeydiyyati">Digər təltiflərin qeydiyyatı</a></li>
        <li><a href="sertifikat_emri">Sertifikatların qeydiyatı</a></li>
        <li><a href="neqliyyat_vasitelerinin_tehkim_əmri">Nəqliyyat Vasitələrinin Təhkim Əmri</a></li>
      </ul>
    </li>

    <li class="submenu"><a href="#">Hesabatlar</a>
      <ul>       
        <li><a href="tabel">&emsp;Tabel</a></li>
        <li><a href="iqtisaditesnifat_bolme.php">&emsp;Ştat sayı</a></li>
        <li><a href="iqtisaditesnifat_bolme.php">&emsp;Ştat cədvəli</a></li>
        <li><a href="is_qrafiki_teyin_et.php">&emsp;İş Qarfiki</a></li> 
        <li><a href="form-common.html"><b>Mühasibatlıq</b></a></li>
        <li><a href="iqtisaditesnifat_bolme.php">&emsp;Şəxsi Ucot Vərəqələri</a></li>        
      </ul>
    </li>


    <li class="submenu"><a href="#">Davamiyyət</a>
      <ul> 
        <li><a href="isedavamiyyet.php">&emsp;İşə davamiyyət</a></li>
        <li><a href="cixislarinqeydiyati">&emsp;Çıxışların qeydiyatı</a></li>       
        <li><a href="iqtisaditesnifat_bolme.php">&emsp;Xidmət Yerlərinin qeydiyatı</a></li>
        <li><a href="is_rejimleri.php">&emsp;İş Rejimləri</a></li>            
        <li><a href="is_rejimi_teyin_et.php">&emsp;İş Rejimi Təyin Et</a></li>            

      </ul>
    </li>




  </ul>
</div>
</div>



<div class="row">
	