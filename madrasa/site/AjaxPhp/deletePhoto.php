<?php require_once('../classes/classes.php'); ?>
<?php 
$crud = new CRUD();
session_start();
$imgInOriginalFolder = "";
$imgInThumbFolder = "";
if(isset($_REQUEST['imgInOriginalFolder']) && !empty($_REQUEST['imgInOriginalFolder']) && isset($_REQUEST['imgInThumbFolder']) && !empty($_REQUEST['imgInThumbFolder'])){
	$imgInOriginalFolder = $_REQUEST['imgInOriginalFolder'];
	$imgInThumbFolder = $_REQUEST['imgInThumbFolder'];
		//echo('Original Folder = '.$imgInOriginalFolder." <br /> Thumb Folder = ".$imgInThumbFolder);
		$_SESSION['photo'] = "";
		if(file_exists("../".$imgInOriginalFolder)){
			unlink("../".$imgInOriginalFolder);
			if(file_exists("../".$imgInThumbFolder)){
				unlink("../".$imgInThumbFolder);
				}
			}
		//echo("Original = ../".$imgInOriginalFolder);
			//echo("Original = ../".$imgInThumbFolder);
	}
else{
	echo($crud->errorMsg(" برائے مہربانی لنک ہڈادو پر کلک کریں "," غلطی"));
    } 
?>