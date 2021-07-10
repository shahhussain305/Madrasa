<?php
require_once('../classes/classes.php'); 
$crud = new CRUD();
if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) &&
   isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) &&
   isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){
	$darja = addslashes($_REQUEST["darja"]); 
	$promotionDate = addslashes($_REQUEST['promotionDate']);
	$dateEnd = addslashes($_REQUEST['dateEnd']);
	$sql = "SELECT r.sno,CONCAT(r.stdName ,' ولدِ ', r.fatherName) as stdName 
			FROM registrationinfo r, stdDarjaat std 
			WHERE std.darja = '".$darja."' 
			AND std.promotionDate = '".$promotionDate."' AND std.dateEnd = '".$dateEnd."' 
			AND std.stdSno = r.sno AND r.isActive = 1
			ORDER BY stdName ASC";
	/*echo($sql);
	exit();*/
	?>
			<select name="regSno" id="regSno" class="frmSelect" style="height:40px; width:160px; font-size:16px;">
   				 <?php echo($crud->fillCombo($sql,"sno","stdName")); ?>
            </select>
<?php  } ?>