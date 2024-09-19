<?php 
require_once '../Ayarlar/setting.php';
if ($_POST) {
 $User_Soy_Ad   =  EditorluIcerikleriFiltrle($_POST['axtarsoyad']); 
 $User_Ad       =  EditorluIcerikleriFiltrle($_POST['axtarad']); 
 $User_Ata_Ad   =  EditorluIcerikleriFiltrle($_POST['axtarataadi']);
 $sql="SELECT * FROM ise_qebul_emri WHERE Ise_Qebul_Emri_Stausu=?";
 $dizi=array();
 $dizi[]=1;

 if (strlen($User_Ad)>0) {
  $sql.=" and User_Ad LIKE  ?";
  $dizi[]=$User_Ad."%";
}

if (strlen($User_Soy_Ad)>0) {
  $sql.=" and User_Soy_Ad LIKE  ?";
  $dizi[]=$User_Soy_Ad."%";
}

if (strlen($User_Ata_Ad)>0) {
  $sql.=" and User_Ata_Ad LIKE  ?";
  $dizi[]=$User_Ata_Ad."%";
}
$Sor = $db->prepare($sql);  
$Sor->execute($dizi);
 $Say=$Sor->rowCount();
if ($Say>0) {?>
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
<?php }else{  ?>    
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
      <tr>    
        <td></td> 
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td> 
        <td></td>        
        <td></td>        
        <td></td>       
        <td></td>        
        <td></td> 
      </tr> 
    </tbody>
  </table> 
<?php }
}
?>