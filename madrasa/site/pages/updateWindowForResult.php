<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style>
#tblDrj td{
	padding:20px;
	text-align:left;
	vertical-align:top;
	}
</style>
</head>
<body style="background-image:none; background-color:#b7b88e;">
<center>
  <form method="post" action="?cmd=updateWindowForResult<?php if(isset($_REQUEST['sno'])){ ?>&sno=<?php echo($_REQUEST['sno']);}?>">
  <table width="626" border="0" cellspacing="0" cellpadding="3" id="tblDrj" class="generalTextFonts">
<?php
$sno = "";
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
	require_once('../classes/classes.php');
	$crud = new CRUD();
	$sno = $_REQUEST['sno'];
	?>
    <tr>
    	<td width="518" style="text-align:right;">
        <input type="text" name="obtmarks" class="frmInputTxt" id="obtmarks" value="<?php echo($crud->getValue("SELECT obtmarks FROM result WHERE sno = ".$sno,"obtmarks")); ?>" />
        </td>
        <td style="text-align:right; width:200px;">
        <input type="submit" id="btnSave" name="btnSave" value="نتیجہ تبدیل کریں" class="btnSave" style="height:60px;" /></td>
    </tr>
    		<?php if(isset($_REQUEST['btnSave'])){ ?>
			<tr>
            	<td colspan="2" style="direction:rtl !important;"> 
                <?php if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) &&
						 isset($_REQUEST['obtmarks']) && !empty($_REQUEST['obtmarks'])){ 
							$sno = $_REQUEST['sno'];
							$obtmarks = $_REQUEST['obtmarks'];
							$sqlUpdate = "UPDATE result SET obtmarks='".$obtmarks."' WHERE sno=".$sno;
							$sqlSearch = "SELECT sno FROM result WHERE sno=".$sno;
							//echo($sqlUpdate);
								if($crud->search($sqlSearch)) { ?> 
									<?php if($crud->update($sqlUpdate)) {  
											echo($crud->sucMsg("اس طالب العلم کا نتیجہ تبدیل ہوچکا ہے","معلومات","../images"));
											}//end if for update method
										 else{
											echo($crud->sucMsg("اس طالب العلم کا نتیجہ تبدیل ہوچکا ہے","معلومات","../images"));
											}//end else for update method
										 }//end if for search()
									 else { 
											echo($crud->errorMsg("اس طالب العلم کا ریکارڈ ہمارے پاس موجود نہیں ہے۔","غلطی","../images"));
										 } //end else for search()
									}//end if for empty form field checking 
								 else {
									 echo($crud->errorMsg("نتیجہ تبدیل کرنے کے لئے نئے نمبرز داخل کیجئے","غلطی","../images"));
									 }//end else for empty form field checking  ?>
                </td>
            </tr>			
			<?php }//end if for button pressing ?>
    <?php
	}//end if for isset(sno);
else{ ?>
            <tr>
                <td colspan="2" style="text-align:right;">
               	 <?php echo($crud->errorMsg('نتیجہ تبدیل کرنے کے لئے ہر مضمون کے نیچے دئیے گئے نمبر پر کلک کریں','غلطی')); ?>
                </td>
            </tr>
		<?php } ?>
</table>
</form>
</center>
</body>
</html>