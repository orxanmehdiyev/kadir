<?php require_once '_header.php'; ?>
<script type="text/javascript" src="IsRejimleri/Script.js"></script>
<div class="card heyet">
	<div class="axtaralani">
		<form id="axtarisadsoyadataadi">
			<label for="axtarsoyad" class="axtarlabel">Ay:</label>
			<select id="TabelAy" required="required" class="axtarinput" onchange="SelectAlaniSecildi(this.id)" title="">
				<option disabled="disabled" value="" selected="selected"></option>
				<option value="01">Yanvar</option>
				<option value="02">Fevral</option>
				<option value="03">Mart</option>
				<option value="04">Aprel</option>
				<option value="05">May</option>
				<option value="06">İyun</option>
				<option value="07">İyul</option>
				<option value="08">Avqust</option>
				<option value="09">Sentyabr</option>
				<option value="10">Oktyabr</option>
				<option value="11">Noyabr</option>
				<option value="12">Dekabr</option>
			</select>

			<label for="axtarad" class="axtarlabel">İl:</label>
			<select id="TabelIl" required="required" class="axtarinput" onchange="SelectAlaniSecildi(this.id)" title="">
				<?php
				for ($i = $Il_tap; $i > $Il_tap - 10; $i--) {
					echo "<option value=" . $i . ">" . $i . "</option>";
				} ?>
			</select>
			<button type="button" class="axtarbutonu" onclick="Axtar()">Axtar</button>
			<button style="float:right;" class="YenileButonlari" onclick="Yeni()" type="button">Yeni</button>
		</form>
	</div>

	<div class="tab-content">
		<div class="tab-pane fade show active">
			<div class="card">
				<div class="container-fluid">
					<div class="row">
						<form class="row">
							<div class="col-4">
								<label for="IdareAxtarir " class="form-label ">Gömrük orqanı</label>
								<select id="IdareAxtarir" class="form-control">
									<?php
									if ($UmumiBaxisButunIdareler == 1) {
										$Idare_Sor = $db->prepare("SELECT * FROM idare order by Sira_No ASC ");
										$Idare_Sor->execute();
									} else {
										$Idare_Sor = $db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id order by Sira_No ASC ");
										$Idare_Sor->execute(array(
											'Idare_Id' => $Islediyi_Idare_Id
										));
									}

									?>
									<?php
									if ($UmumiBaxisButunIdareler == 1) { ?>
										<option value="" selected="selected"></option>
									<?php } ?>
									<?php while ($Idare_Cek = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) { ?>
										<option value="<?php echo $Idare_Cek['Idare_Kissa_Adi'] ?>" title="<?php echo $Idare_Cek['Idare_Adi'] ?>"><?php echo $Idare_Cek['Idare_Kissa_Adi'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-4">
								<label for="SobeAxtarir" class="form-label">Struktur bölmə</label>
								<select id="SobeAxtarir" class="form-control">
									<?php
									if ($UmumiBaxisButunIdareler == 1) {
										$Sobe_Sor = $db->prepare("SELECT  DISTINCT Sobe_Ad FROM sobe order by Sira_No ASC ");
										$Sobe_Sor->execute();
									} else {
										$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id order by Sira_No ASC ");
										$Sobe_Sor->execute(array(
											'Idare_Id' => $Islediyi_Idare_Id
										));
									}
									?>
									<option disabled="disabled" selected></option>
									<?php while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) { ?>
										<option value="<?php echo $Sobe_Cek['Sobe_Ad'] ?>"><?php echo $Sobe_Cek['Sobe_Ad'] ?></option>
									<?php } ?>
								</select>
							</div>
						</form>
					</div>
				</div>
				<br>
				<div class="ListelemeAlaniIciTabloAlaniKapsayicisi">
					<table style="white-space: normal;" class="table table-bordered table-hover" id="dataTable">
						<caption><span class="boz"></span>Vakant yerlər <span class="yasil"></span>Məzuniyyətdə olan əməkdaşlar</caption>
						<thead class="sabit">
							<tr class="textaligncenter">
								<th>Növbə</th>
								<th>Tarix</th>
								<th>1</th>
								<th>2</th>
								<th>3</th>
								<th>4</th>
								<th>5</th>
								<th>6</th>
								<th>7</th>
								<th>8</th>
								<th>9</th>
								<th>10</th>
								<th>11</th>
								<th>12</th>
								<th>13</th>
								<th>14</th>
								<th>15</th>
								<th>16</th>
								<th>17</th>
								<th>18</th>
								<th>19</th>
								<th>20</th>
								<th>21</th>
								<th>22</th>
								<th>23</th>
								<th>24</th>
								<th>25</th>
								<th>26</th>
								<th>27</th>
								<th>28</th>
								<th>29</th>
								<th>30</th>
								<th>31</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<td>I Növbə</td>
								<td rowspan="2" >Tarix</td>
								<?php 	for ($i=1; $i <=31; $i++) { ?>
									<td style="width: 28px;">
										<label class="kapsayici">
											<input type="checkbox" name="t_ <?php echo $i ?>">
											<span class="checkmark"></span>
										</label>
									</td>
								<?php } ?>


							</tr>
							<tr>
								<td>II Növbə</td>
											<?php 	for ($i=1; $i <=31; $i++) { ?>
									<td style="width: 28px;">
										<label class="kapsayici">
											<input type="checkbox" name="t_ <?php echo $i ?>">
											<span class="checkmark"></span>
										</label>
									</td>
								<?php } ?>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<?php 
$ss=0;
for ($i="2021-01-01"; $i <$Tarix_Beynelxalq ; $i=Traix_Uzerine_Gel($i,1,"day")) { 
	if ($ss==1) {
	$ss--;
	}else{
		$ss++;
	}	
}
echo $ss;
 ?>
<?php require_once '_footer.php'; ?>
