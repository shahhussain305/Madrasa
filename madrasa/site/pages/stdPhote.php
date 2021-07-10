<?php if(isset($_REQUEST['regSno']) && !empty($_REQUEST['regSno'])){ ?>
<?php require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<div> 
<?php $stdPhoto = $crud->getValue("SELECT stdPhoto FROM registrationinfo WHERE sno = ".$_REQUEST['regSno'],"stdPhoto");
if(isset($stdPhoto) && !empty($stdPhoto)){ ?>
<img src="../takephoto/<?php echo($stdPhoto); ?>" title="" alt="" />
<?php } 
else { 
	echo($crud->errorMsg("اس طالب العلم کی تصویر موجود نہیں ہے","غلطی","../images")); 
}?>
</div>
</body>
</html>
<?php } ?>