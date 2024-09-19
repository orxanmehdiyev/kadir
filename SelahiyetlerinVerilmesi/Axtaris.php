<?php 
require_once '../Ayarlar/setting.php';
if ($_POST) {
  $Soy_Adi   =  EditorluIcerikleriFiltrle($_POST['axtarsoyad']); 
  $Adi       =  EditorluIcerikleriFiltrle($_POST['axtarad']); 
  $Ata_Adi   =  EditorluIcerikleriFiltrle($_POST['axtarataadi']);
  $sql="SELECT * FROM user WHERE Durum=?";
  $dizi=array();
  $dizi[]=1;

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

    <table style="white-space: normal;" class="table table-bordered table-hover">
      <thead class="">
        <tr>
          <th></th>               
          <th>Soyadı</th>
          <th>Adı</th>
          <th>Ata adı</th>
          <th>Id</th> 
          <th>İdarə</th>
          <th>Bölmə</th>
          <th>Vəzifə</th> 
        </tr>
      </thead>
      <tbody id="list" class="table_ici">
        <?php while ($Cek=$Sor->fetch(PDO::FETCH_ASSOC)) {?>
          <tr>    
            <td class="emir_sec_alani">
              <button class="SecButonu"  type="button" id="UserId_<?php echo $Cek['ID'] ?>" onclick="Sec(this.id)"></button>
            </td>
            <td ><?php echo $Cek['Soy_Adi']; ?></td>
            <td><?php echo $Cek['Adi']; ?></td>
            <td><?php echo $Cek['Ata_Adi']; ?></td>
            <td><?php echo $Cek['ID']; ?></td>
            <td><?php echo $Cek['Idare_Ad']; ?></td>
            <td><?php echo $Cek['Sobe_Ad']; ?></td>
            <td><?php echo $Cek['Vezife_Ad']; ?></td>                
          </tr> 
        <?php } ?>
      </tbody>
    </table>     
  <?php }else{  ?>    
    <table style="white-space: normal;" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th></th>               
          <th>Soyadı</th>
          <th>Adı</th>
          <th>Ata adı</th>
          <th>Id</th> 
          <th>İdarə</th>
          <th>Bölmə</th>
          <th>Vəzifə</th> 
        </tr>
      </thead>
      <tbody id="list" class="table_ici">           
        <tr>    
          <td class="emir_sec_alani"><button class="SecButonu"  type="button"></button></td>
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