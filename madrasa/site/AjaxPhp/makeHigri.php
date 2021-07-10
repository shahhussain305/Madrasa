<?php
		require_once('../classes/classes.php'); 
		require_once('../classes/Hijri_GregorianConvert.php'); 
		$hijri = new Hijri_GregorianConvert();
		$crud = new CRUD();
		$format="DD/MM/YYYY";
		$date=date("d/m/Y");
		$yearHijri = $hijri->GregorianToHijri($date,$format);
		$HijriYr = explode('-',$yearHijri);
		echo($HijriYr[2].'-');
?>