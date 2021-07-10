<?php require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD(); ?>
<?php if(isset($_REQUEST['sno'])){ 
		echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$_REQUEST['sno'],"darja")); 
		}
 ?>