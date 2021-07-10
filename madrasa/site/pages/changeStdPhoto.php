<?php 
	require_once('../classes/classes.php'); 
	$crud = new CRUD();
	$sno = "";
	$imgOld = "";
	$imgSize = "";
	$tableWidth = "";
	
	if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])) { 
		$sno = $_REQUEST['sno'];
		$sqlPhoto = "SELECT stdPhoto FROM registrationinfo WHERE sno = ".$sno;
		//echo($sqlPhoto);
			$imgOld = $crud->getValue($sqlPhoto,"stdPhoto");
			if(!isset($imgOld) || empty($imgOld)){ 
				$imgOld = "../images/no_photo.jpg";
				$imgSize = ' width="150" height="177" '; //for no-photo.jpg image
				$tableWidth = "160";
				}
			else{ 
				$imgOld = "../takephoto/".$imgOld; 
				$imgSize = ' width="250" height="178" '; //for original image
				$tableWidth = "270";
				}

	 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style>
	#fnt { font-size:25px; font-family: 'Jameel Noori Nastaleeq';}
</style>
</head>
<body>
<form method="post" action="../AjaxPhp/changeStdPhoto.php?sno=<?php echo($sno); ?>" id="frmUpload" enctype="multipart/form-data" style="direction:ltr;">
<table align="center" width="<?php echo($tableWidth); ?>" border="1" cellspacing="0" cellpadding="5">
	<tr>
    	<th colspan="2" style="background-color:#CCC;"> موجودہ تصویر </th>
    </tr>
    <tr>
    	<td> <img src="<?php echo($imgOld); ?>" <?php echo($imgSize); ?> vspace="3" hspace="3" style="border:1px double;" /> </td>
        <td style="text-align:center; vertical-align:middle;">	
			<span id="fnt">
        	فوٹو منتخب کریں
            </span>
            <br /> <input type="file" id="photoBrowser" name="photoBrowser" onchange="document.getElementById('frmUpload').submit();" />    	
        </td>
    </tr>
    </table>
    </form>
</body>
</html>
<?php } ?>
