<?php session_start();
require_once('../classes/classes.php'); 
require_once('../classes/Hijri_GregorianConvert.php'); 
$hijri = new Hijri_GregorianConvert();
$crud = new CRUD();
$format="DD/MM/YYYY";
$date=date("d/m/Y");
$yearHijri = $hijri->GregorianToHijri($date,$format);
$tableNam= "";
$fldName="";
$sno = "";
$HijriYr = explode('-',$yearHijri);
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) &&
    isset($_REQUEST['fldName']) && !empty($_REQUEST['fldName']) &&
	isset($_REQUEST['tableNam']) && !empty($_REQUEST['tableNam'])){
	$tableNam = addslashes($_REQUEST['tableNam']);
	$fldName = addslashes($_REQUEST['fldName']);
	$sno = addslashes($_REQUEST['sno']);	
		echo($HijriYr[2].'-');	
		$sqlVal = "SELECT ".$fldName." FROM ".$tableNam." WHERE sno = ".$sno;
		/*echo($sqlVal);
		exit();*/
		echo($crud->getValue($sqlVal,$fldName));
		
	}
else{
	echo($crud->errorMsg(" برائے مہربانی ڈراپ ڈاون مینیو میں سے کچھ منتخب کریں "," غلطی"));
    } 
?>