<?php 
require_once '_header.php';
?>
<script type="text/javascript" src="SelahiyetlerinVerilmesi/Script.js"></script>		
<div class="card-body">
	<div class="axtaralani" >
		<form id="axtarisadsoyadataadi">
			<label for="axtarsoyad" class="axtarlabel">Soyadı:</label>
			<input type="text"  autocomplete="off" class="axtarinput" id="axtarsoyad" name="axtarsoyad">

			<label for="axtarad" class="axtarlabel">Adı:</label>
			<input type="text"  autocomplete="off" class="axtarinput" id="axtarad" name="axtarad">			

			<label for="axtarataadi" class="axtarlabel">Ata adı:</label>
			<input type="text"  autocomplete="off" class="axtarinput" id="axtarataadi" name="axtarataadi">
			<button type="button" class="axtarbutonu" onclick="Axtar()" >Axtar</button>	
		</form>
 
	</div>
	<div class=" bolmeleralanlari " id="icerik">
		<table style="white-space: normal;" class="table table-bordered table-hover" id="iseqebulemirleritablo">
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
		
	</div>	
	<div class="bolmeleralanlari" id="selahiyyetalani">
		<table style="white-space: normal;" class="table table-bordered table-hover" id="iseqebulemirleritablo">
			<thead>
				<tr>										
					<th colspan="2">Veriləcək səlahiyyət</th>	
					<th colspan="2">Veriləcək səlahiyyət</th>
					<th colspan="2">Veriləcək səlahiyyət</th>	
					<th colspan="2">Veriləcək səlahiyyət</th>	
				</tr>
			</thead>
			<tbody  class="table_ici">						
				<tr>				
					<td></td>						
					<td style="width: 57px; "><label class="checkbox" title="" >
						<input	type="checkbox" > 
						<span class="checkbox"> 
							<span></span>
						</span>
					</label>
				</td>	
				<td></td>						
				<td style="width: 57px; "><label class="checkbox" title="" >
					<input	type="checkbox" > 
					<span class="checkbox"> 
						<span></span>
					</span>
				</label>
			</td>	
			<td></td>						
			<td style="width: 57px; "><label class="checkbox" title="" >
				<input	type="checkbox" > 
				<span class="checkbox"> 
					<span></span>
				</span>
			</label>
		</td>	
		<td></td>						
		<td style="width: 57px; "><label class="checkbox" title="" >
			<input	type="checkbox" > 
			<span class="checkbox"> 
				<span></span>
			</span>
		</label>
	</td>					
</tr>					
</tbody>
</table>
</div>
</div>
<?php require_once '_footer.php';?>