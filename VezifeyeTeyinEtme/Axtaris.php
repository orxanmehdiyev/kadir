<?php 
require_once '../Ayarlar/setting.php';
if ($_POST) {
 $Soy_Adi   =  EditorluIcerikleriFiltrle($_POST['axtarsoyad']); 
 $Adi       =  EditorluIcerikleriFiltrle($_POST['axtarad']); 
 $Ata_Adi   =  EditorluIcerikleriFiltrle($_POST['axtarataadi']);
 $sql="SELECT * FROM vezifeye_teyin_etme WHERE ID>?";
 $dizi=array();
 $dizi[]=0;

 if (strlen($Adi)>0) {
  $sql.=" and Adi LIKE  ?";
  $dizi[]=$Adi."%";
}

if (strlen($Soy_Adi)>0) {
  $sql.=" and Soy_Adi LIKE  ?";
  $dizi[]=$Soy_Adi."%";
}

if (strlen($Ata_Adi)>0) {
  $sql.=" and Ata_Adi LIKE  ?";
  $dizi[]=$Ata_Adi."%";
}
$Sor = $db->prepare($sql);  
$Sor->execute($dizi);
$Say=$Sor->rowCount();
if ($Say>0) {?>
  <table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
    <thead class="">
      <tr>
        <th>Adı,soyadı</th>               
        <th>Tarixi</th>
        <th>Əmri No</th>                                
        <th>Sil</th>                                              
      </tr>
    </thead>
    <tbody id="list" class="table_ici">
      <?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>                
          <td><?php echo AdiSoyadiAtaadi($Cek['ID'],$db);?></td>                  
          <td><?php echo Tarix_Beynelxalqi_Az_Cevir($Cek['Vezifeye_Teyin_Etme_Tarixi']) ?></td>
          <td><?php echo $Cek['Vezifeye_Teyin_Etme_Emir_No'] ?></td>
          <?php 
          $NovbetiSor=$db->prepare("SELECT * FROM  user where ID=:ID ");
          $NovbetiSor->execute(array(
            'ID'=>$Cek['ID']));
          $NovbetiCek=$NovbetiSor->fetch(PDO::FETCH_ASSOC);
          ?>                                                  
          <td class="emeliyyatlar_sil_buttom">
            <?php                 
            if ($Cek['Vezifeye_Teyin_Etme_Tarixi'] >= $NovbetiCek['Vezifeye_Teyin_Tarixi']) {
              echo SilButonu($Cek['Vezifeye_Teyin_Etme_Id']);
            }?>
          </td>
        </tr> 
      <?php }
      ?>
    </tbody>
  </table>     
<?php }else{  ?>    
  <table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
    <thead>
      <tr>
        <th>Adı,soyadı</th>               
        <th>Tarixi</th>
        <th>Əmri No</th>                                
        <th>Sil</th>                                              
      </tr>
    </thead>
  </table> 
<?php }
}
?>