
<footer>
	<div>2021 || © || <?php echo $Il_tap ?></div>
</footer>
<script type="text/javascript">/* global bootstrap: false */
(function () {
	'use strict'
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	tooltipTriggerList.forEach(function (tooltipTriggerEl) {
		new bootstrap.Tooltip(tooltipTriggerEl)
	})
})()</script>
<script src="disk/jquery/jquery36.js"></script> 
<script src="disk/popper/popper.js"></script> 
<script src="disk/bootstrap/js/bootstrap.js"></script> 
<script src="disk/jquery-ui-1.13.0/jquery-ui.js"></script> 			
<script src="disk/select2/select2.js"></script>
<script type="text/javascript" src="disk/DataTables/datatables.js"></script>
<script src="disk/js/menu_script.js"></script>


<script>
	$(".select2").select2({
		placeholder: "",
		allowClear: true
	});
</script>
<!-- /Select2 -->

<script>
	/*Hərəkət etdirmə*/
	dragElement(document.getElementById("Modal"));
	function dragElement(elmnt) {
		var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
		/* if present, the header is where you move the DIV from:*/
		document.getElementsByClassName("YeniModalBaslikAlaniKapsayicisi")[0].onmousedown = dragMouseDown;
		function dragMouseDown(e) {
			e = e || window.event;
			e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }
  function elementDrag(e) {
  	e = e || window.event;
  	e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }
  function closeDragElement() {
  	/* stop moving when mouse button is released:*/
  	document.onmouseup = null;
  	document.onmousemove = null;
  }
}
</script>  
</body>
</html>