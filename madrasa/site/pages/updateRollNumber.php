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
<form method="post" action="?cmd=updateRollNumber<?php if(isset($_REQUEST['sno'])){ ?>&sno=<?php echo($_REQUEST['sno']); } ?>">
<table width="626" border="0" cellspacing="0" cellpadding="3" id="tblDrj" class="generalTextFonts">
<?php 
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
	require_once('../classes/classes.php');
	$crud = new CRUD();
	$sno = $_REQUEST['sno'];
	?>
    <tr>
    	<td width="300" style="text-align:right;"> نام طالب العلم  </td>
        <td colspan="2" style="text-align:right;"> 
		<?php echo($crud->getValue("SELECT stdName FROM registrationinfo WHERE sno = ".$sno,"stdName")); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <strong> ولدِ </strong> 
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <?php echo($crud->getValue("SELECT fatherName FROM registrationinfo WHERE sno = ".$sno,"fatherName")); ?>
         </td>
    </tr>
    <tr>
    	<td style="text-align:right;"> موجودہ درجہ  </td>
        <td width="218" style="text-align:right;"> <?php echo($crud->getValue("SELECT d.darja FROM darjaat d, stdDarjaat std WHERE std.darja = d.derjaCode AND std.isCurrent = 1 AND std.stdSno = ".$sno,"darja")); ?> </td>
        <td></td>
    </tr>
    <tr>
    	<td style="text-align:right;"> <font style="font-size:25px;"><strong>رول نمبر تبدیل کریں</strong> </font> </td>
        <td style="text-align:right;">
        	<input type="hidden" name="sno" id="sno" value="<?php echo($sno); ?>" />
        	<input type="text" name="rollNo" id="rollNo" class="frmInputTxt" style="width:80px;" value="<?php echo($crud->getValue("SELECT reg.RollNumber FROM regnumbers reg, registrationinfo r WHERE r.sno = reg.regSno AND r.sno = ".$sno,"RollNumber")); ?>" />
        </td>
        <td style="text-align:right; width:200px;"><input type="submit" id="btnSave" name="btnSave" value="رول نمبر تبدیل کریں" class="btnSave" style="height:60px;" /></td>
    </tr>
    		<?php if(isset($_REQUEST['btnSave'])){ ?>
			<tr>
            	<td colspan="3"> 
                <?php if(isset($_REQUEST['rollNo']) && !empty($_REQUEST['rollNo']) && isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){ 
				$sno = $_REQUEST['sno'];
				$rollNo = $_REQUEST['rollNo'];
				?> 
					<?php if($crud->search("SELECT sno FROM registrationinfo WHERE sno = ".$sno)) { ?> 
						<?php if($crud->update("UPDATE regnumbers SET RollNumber = ".$rollNo." WHERE regSno =".$sno)) {  
								echo($crud->sucMsg("اس طالب العلم کا رول نمبر تبدیل ہوچکا ہے","معلومات",'../images'));
							 	}//end if for update method
							 else{
								echo($crud->sucMsg("اس طالب العلم کا رول نمبر تبدیل ہوچکا ہے","معلومات",'../images'));
								}//end else for update method
							 }//end if for search()
						 else { 
						 		echo($crud->errorMsg("اس طالب العلم کا ریکارڈ ہمارے پاس موجود نہیں ہے۔","غلطی",'../images'));
							 } //end else for search()
					 	}//end if for empty form field checking 
					 else {
						 echo($crud->errorMsg("رول نمبر تبدیل کرنے کے لئے نیا رول نمبر منتخب کیجئے","غلطی",'../images'));
						 }//end else for empty form field checking  ?>
                </td>
            </tr>			
			<?php }//end if for button pressing ?>
    <?php
	}//end if for isset(sno);
else{ ?>
            <tr>
                <td colspan="3" style="text-align:right;">
               	 <?php echo($crud->errorMsg('مہربانی کر کے کسی بھی طالب العلم کے درجہ پر کلک کر کے اس کا درجہ تبدیل کریں','غلطی','../images')); ?>
                </td>
            </tr>
		<?php } ?>
</table>
</form>
</center>
</body>
</html>