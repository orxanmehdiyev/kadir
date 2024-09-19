<?php 
require_once '_header.php';
?>
<script type="text/javascript" src="Idareler/Script.js"></script>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="d-flex  justify-content-between">
				<div class="p-2"></div>
				<div class="p-2" id="cavabid"></div>
				<div class="p-2">
					<button class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>				
				</div>
			</div>				
		</div>
	</div>
	<div class="card-body" id="icerik">
		<?php 
		if ( $xlsx = SimpleXLSX::parse('Excel_Fayillari/VezifeKod.xlsx') ) {
			$dizi=( $xlsx->rows());
			$say= count($dizi)-1;
			for ($i=1; $i < $say; $i++) { 

				$ID=$dizi[$i][0];
				$Vezife_Kod=$dizi[$i][1];

				$User_Sor=$db->prepare("SELECT * FROM user where ID=:ID");
				$User_Sor->execute(array(
					'ID'=>$ID));
				$User_Say=$User_Sor->rowCount();

				$Vezife_Sor=$db->prepare("SELECT * FROM vezife where User_Id=:User_Id");
				$Vezife_Sor->execute(array(
					'User_Id'=>$User_Id));
				$Vezife_Say=$Vezife_Sor->rowCount();
				$Vezife_Cek=$Vezife_Sor->fetch(PDO::FETCH_ASSOC);
				if ($Vezife_Cek['Vezife_Kod']==0) {

					if ($User_Say==1) {
						$yenile=$db->prepare("UPDATE vezife SET 
							Vezife_Kod=:Vezife_Kod
							WHERE User_Id=$ID");
						$update=$yenile->execute(array(
							'Vezife_Kod'=>$Vezife_Kod
						));

					}	
				}

			}
		} 
		?>
	</div>
</div>
<?php 

?>