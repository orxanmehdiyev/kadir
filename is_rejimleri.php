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
								<th>Soyadı, Adı, Ata adı</th>
								<th>İdarə</th>
								<th>Struktur bölməsi</th>
								<th>Vəzifəsi</th>
								<th>İş rejimi</th>
								<th>Növbə sayı</th>
								<th>İş qrupu</th>
								<th>İş Vəzifəsi</th>
								<th>İşə gəlmə</th>
								<th>Fasilə çıx</th>
								<th>Fasilə gir</th>
								<th>İşdən getmə</th>
								<th>Gündüz</th>
								<th>Gecə</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($UmumiBaxisButunIdareler == 1) {
								$Idare_Sor = $db->prepare("SELECT * FROM idare where Durum=:Durum order by Sira_No ASC");
								$Idare_Sor->execute(array(
									'Durum' => 1
								));
							} else {
								$Idare_Sor = $db->prepare("SELECT * FROM idare where Idare_Id=:Idare_Id and  Durum=:Durum order by Sira_No ASC");
								$Idare_Sor->execute(array(
									'Idare_Id' => $Islediyi_Idare_Id,
									'Durum' => 1
								));
							}

							while ($Idare_Cek = $Idare_Sor->fetch(PDO::FETCH_ASSOC)) {
								$Idare_Id = $Idare_Cek['Idare_Id'];
								$Sobe_Sor = $db->prepare("SELECT * FROM sobe where Idare_Id=:Idare_Id and Durum=:Durum order by Sira_No ASC");
								$Sobe_Sor->execute(array(
									'Idare_Id' => $Idare_Id,
									'Durum' => 1
								));
								while ($Sobe_Cek = $Sobe_Sor->fetch(PDO::FETCH_ASSOC)) {
									$Vezife_Sor = $db->prepare("SELECT vezife.*,vezife_adlari.* FROM vezife INNER JOIN vezife_adlari ON vezife.Vezife_Adlari_Id=vezife_adlari.Vezife_Adlari_Id where Sobe_Id=:Sobe_Id  and vezife_adlari.Vezife_Adlari_Durum=:Vezife_Adlari_Durum and User_Id>:User_Id  order by Vezife_Adlari_Sira ASC, Sira_No ASC ");
									$Vezife_Sor->execute(array(
										'Sobe_Id' => $Sobe_Cek['Sobe_Id'],
										'Vezife_Adlari_Durum' => 1,
										'User_Id' => 0
									));
									while ($Vezife_Cek = $Vezife_Sor->fetch(PDO::FETCH_ASSOC)) {
										$IsRejimi_Sor = $db->prepare("SELECT * FROM  is_rejimi where ID=:ID  order by Tarix DESC, Is_Rejimi_Id DESC");
										$IsRejimi_Sor->execute(array(
											'ID' => $Vezife_Cek['User_Id']
										));
										$IsRejimi_Cek = $IsRejimi_Sor->fetch(PDO::FETCH_ASSOC);
										if ($IsRejimi_Cek['Is_Rejimi'] == 1) {
											$Is_Rejimi = "İdarə";
										} elseif ($IsRejimi_Cek['Is_Rejimi'] == 2) {
											$Is_Rejimi = "Gündəlik";
										} elseif ($IsRejimi_Cek['Is_Rejimi'] == 3) {
											$Is_Rejimi = "Növbəli";
										} else {
											$Is_Rejimi = "";
										}

										if ($IsRejimi_Cek['Novbe_Sayi'] == 1) {
											$Novbe_Sayi = "24 Saat";
										} elseif ($IsRejimi_Cek['Novbe_Sayi'] == 2) {
											$Novbe_Sayi = "2 növbəli";
										} elseif ($IsRejimi_Cek['Novbe_Sayi'] == 3) {
											$Novbe_Sayi = "3 növbəli";
										} elseif ($IsRejimi_Cek['Novbe_Sayi'] == 4) {
											$Novbe_Sayi = "4 növbəli";
										} else {
											$Novbe_Sayi = "";
										}

										if ($IsRejimi_Cek['Is_Qurupu'] == 1) {
											$Is_Qurupu = "I qrup";
										} elseif ($IsRejimi_Cek['Is_Qurupu'] == 2) {
											$Is_Qurupu = "II qrup";
										} elseif ($IsRejimi_Cek['Is_Qurupu'] == 3) {
											$Is_Qurupu = "III qrup";
										} elseif ($IsRejimi_Cek['Is_Qurupu'] == 4) {
											$Is_Qurupu = "IV qrup";
										} else {
											$Is_Qurupu = "";
										}

										if ($IsRejimi_Cek['Is_Vezifesi'] == 1) {
											$Is_Vezifesi = "Növbə rəisi";
										} else {
											$Is_Vezifesi = "";
										}
							?>
										<tr class="vertikalmidle">
											<td><?php echo AdiSoyadiAtaadi($Vezife_Cek['User_Id'], $db) ?></td>
											<td><?php echo IdareQissaAdi($Vezife_Cek['Idare_Id'], $db) ?></td>
											<td><?php echo SobeAdi($Vezife_Cek['Sobe_Id'], $db) ?></td>
											<td><?php echo $Vezife_Cek['Vezife_Adlari_Ad'] ?></td>
											<td class="textaligncenter"><?php echo $Is_Rejimi ?></td>
											<td class="textaligncenter"><?php echo $Novbe_Sayi; ?></td>
											<td class="textaligncenter"><?php echo $Is_Qurupu ?></td>
											<td class="textaligncenter"><?php echo $Is_Vezifesi ?></td>
											<td class="textaligncenter"><?php echo  $IsRejimi_Cek['Is_Giris_Saati'] > 0 ? $IsRejimi_Cek['Is_Giris_Saati'] : "" ?></td>
											<td class="textaligncenter"><?php echo  $IsRejimi_Cek['Fasile_Saati_Baslagic'] > 0 ? $IsRejimi_Cek['Fasile_Saati_Baslagic'] : "" ?></td>
											<td class="textaligncenter"><?php echo  $IsRejimi_Cek['Fasile_Saati_Bitis'] > 0 ? $IsRejimi_Cek['Fasile_Saati_Bitis'] : "" ?></td>
											<td class="textaligncenter"><?php echo  $IsRejimi_Cek['Is_Cixis_Saati'] > 0 ? $IsRejimi_Cek['Is_Cixis_Saati'] : "" ?></td>
											<td class="textaligncenter"><?php echo  $IsRejimi_Cek['Gunduz'] > 0 ? $IsRejimi_Cek['Gunduz'] : "" ?></td>
											<td class="textaligncenter"><?php echo  $IsRejimi_Cek['Gece'] > 0 ? $IsRejimi_Cek['Gece'] : "" ?></td>
										</tr>
							<?php
									}
								}
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once '_footer.php'; ?>
<script>
	function filterGlobal() {
		$('#dataTable').DataTable().search(
			$('#global_filter').val()
		).draw();
	}

	function filterGlobalid() {
		$('#dataTable').DataTable().search(
			$('#global_filter').val()
		).draw();
	}



	function IdareAxtar() {
		$('#dataTable').DataTable().column(5).search(
			$('#IdareAxtarir').val()
		).draw();
	}


	function SobeAxtar() {
		$('#dataTable').DataTable().column(6).search(
			$('#SobeAxtarir').val()
		).draw();
	}

	function VakanAxtarir() {
		if ($('#VakanAxtarir').val() == "Vakand") {
			$('#dataTable').DataTable().column(2).search(
				$('#VakanAxtarir').val()
			).draw();
		} else if ($('#VakanAxtarir').val() == "Dolu") {
			$('#dataTable').DataTable().column(2).search(
				'^((?!Vakand).)*$', true, false
			).draw();
		} else {
			$('#dataTable').DataTable().column(2).search(
				$('#VakanAxtarir').val()
			).draw();
		}

	}

	function filterColumn(i) {
		$('#dataTable').DataTable().column(i).search(
			$('#col' + i + '_filter').val()
		).draw();
	}

	$(document).ready(function() {
		$('#dataTable').DataTable();

		$('#IdareAxtarir').on('change', function() {
			IdareAxtar();
		});

		$('#SobeAxtarir').on('change', function() {
			SobeAxtar();
		});


		$('#VakanAxtarir').on('change', function() {
			VakanAxtarir();
		});

		$('input.global_filter').on('keyup click', function() {
			filterGlobal();
		});

		$('input.column_filter').on('keyup click', function() {
			filterColumn($(this).parents('tr').attr('data-column'));
		});
	});
	var dataTables = $('#dataTable').DataTable({

		"bFilter": false,
		"bLengthChange": true,
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "Hamısı"]
		],
		"pageLength": 566,
		"order": [], //Initial no order.
		"aaSorting": [],
		"searching": true, //Tabloda arama yapma alanı gözüksün mü? true veya false
		"lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
		"info": true,
		"bAutoWidth": false,
		"responsive": true,
		'processing': true,
		"fixedHeader": true,
		dom: "<'ui grid'" +
			"<'row'" +
			"<'col-2'l>" +
			"<'col-6'B>" +
			"<'col-4'f>" +
			">" +
			"<'row dt-table'" +
			"<'sixteen wide column'tr>" +
			">" +
			"<'row'" +
			"<'seven wide column'i>" +
			"<'right aligned nine wide column'p>" +
			">" +
			">",


		buttons: [

			{
				extend: 'excel',
				title: 'ExampleFile'
			},
			{
				extend: 'print',
				customize: function(win) {
					$(win.document.body)
						.css('font-size', '10pt')
					$(win.document.body).find('table')
						.addClass('compact')
						.css('font-size', 'inherit');
				},
				title: 'Şəxsi heyyət haqqında məlumat',
				exportOptions: {
					columns: ':visible',
					stripHtml: false,
				}
			}
		],
	});
	//Sonradan yapılan butona tıklandığında asıl dışa aktarma butonunun çalışması
</script>