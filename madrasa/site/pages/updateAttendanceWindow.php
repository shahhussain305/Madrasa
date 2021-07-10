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
  <form method="post" action="?cmd=updateAttendanceWindow<?php if(isset($_REQUEST['sno'])){ ?>&sno=<?php echo($_REQUEST['sno']); }else if(isset($_REQUEST['date'])){ ?>&date=<?php echo($_REQUEST['date']); } ?>">
  <table width="626" border="1" cellspacing="0" cellpadding="3" id="tblDrj" class="generalTextFonts">
<?php
$sno = "";
$date ="";
$isSelected = "";
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) && isset($_REQUEST['date']) && !empty($_REQUEST['date'])){
	require_once('../classes/classes.php');
	$crud = new CRUD();
	$sno = $_REQUEST['sno'];
	$date = $_REQUEST['date'];
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
        <td><?php echo($date); ?></td>
    </tr>
    <tr>
    	<td style="text-align:right;" colspan="2">
        	<input type="hidden" name="sno" id="sno" value="<?php echo($sno); ?>" />
            <input type="hidden" name="date" id="date" value="<?php echo($date); ?>" />
            <input  type="radio" name="stdStatus" id="stdStatus1" value="ح" /> حاضر                                                                       
            <input type="radio" name="stdStatus" id="stdStatus2" value="غ" />  غیر حاضر                      
            <input type="radio" name="stdStatus" id="stdStatus3" value="ر" /> رخصت                     
            <input type="radio" name="stdStatus" id="stdStatus4" value="ب" /> بیمار 
        </td>
        <td style="text-align:right; width:200px;">
        <input type="submit" id="btnSave" name="btnSave" value="حاضری تبدیل کریں" class="btnSave" style="height:60px;" /></td>
    </tr>
    		<?php if(isset($_REQUEST['btnSave'])){ ?>
			<tr>
            	<td colspan="3" style="direction:rtl !important;"> 
                <?php if(isset($_REQUEST['stdStatus']) && !empty($_REQUEST['stdStatus']) && 
						 isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) &&
						 isset($_REQUEST['date']) && !empty($_REQUEST['date'])){ 
							$sno = $_REQUEST['sno'];
							$stdStatus = $_REQUEST['stdStatus'];
							$date = $_REQUEST['date'];
							$sqlUpdate = "UPDATE attendence SET stdStatus = '".$stdStatus."' WHERE regSno =".$sno." AND attendanceDate='".$date."'";
							$sqlSearch = "SELECT regSno FROM attendence WHERE regSno = ".$sno." AND attendanceDate='".$date."'";
							//echo($sqlUpdate);
								if($crud->search($sqlSearch)) { ?> 
									<?php if($crud->update($sqlUpdate)) {  
											echo($crud->sucMsg("اس طالب العلم کی حاضری تبدیل ہوچکی ہے","معلومات","../images"));
											}//end if for update method
										 else{
											echo($crud->sucMsg("اس طالب العلم کی حاضری تبدیل ہوچکی ہے","معلومات","../images"));
											}//end else for update method
										 }//end if for search()
									 else { 
											//echo($crud->errorMsg("اس طالب العلم کا ریکارڈ ہمارے پاس موجود نہیں ہے۔","غلطی","../images"));
											$darjaSno = $crud->getValue("SELECT d.derjaCode as sno FROM darjaat d, stdDarjaat std WHERE std.darja = d.derjaCode AND std.isCurrent = 1 AND std.stdSno = ".$sno,"sno");
											$sqlInsert = "INSERT INTO attendence (stdStatus,attendanceDate,regSno,darjaSno) VALUES('".$stdStatus."','".$date."',".$sno.",".$darjaSno.")";
												if($crud->insert($sqlInsert)){
													echo($crud->sucMsg("اس طالب العلم کی حاضری تبدیل ہوچکی ہے","معلومات","../images"));
														}
												else{
													 echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے حاضری محفوظ نہ ہوسکی","غلطی","../images"));
													}
										 } //end else for search()
									}//end if for empty form field checking 
								 else {
									 echo($crud->errorMsg("حاضری تبدیل کرنے کے لئے نئی حاضری منتخب کیجئے","غلطی","../images"));
									 }//end else for empty form field checking  ?>
                </td>
            </tr>			
			<?php }//end if for button pressing ?>
    <?php
	}//end if for isset(sno);
else{ ?>
            <tr>
                <td colspan="3" style="text-align:right;">
               	 <?php echo($crud->errorMsg('مہربانی کر کے کسی بھی طالب العلم کے درجہ پر کلک کر کے اس کا درجہ تبدیل کریں','غلطی',"../images")); ?>
                </td>
            </tr>
		<?php } ?>
</table>
</form>
</center>
</body>
</html>