<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style>
#tblDrj td{
	vertical-align:middle;
	height:60px;
	}
</style>
</head>
<body style="background-image:none; background-color:#b7b88e;font-size:25px; margin:0px;" class="generalTextFonts">
<center>
<form method="post" action="?cmd=changePassword" style="margin:0px;">
<table width="600" border="0" cellspacing="0" cellpadding="4" id="tblDrj" align="center" style="background-color:#ffffff; color:#000000;">
<?php 
session_start();
if(isset($_SESSION['userid']) && !empty($_SESSION['key'])){
	require_once('../classes/classes.php');
	
	$crud = new CRUD();
	?>
    <tr>
    	<td colspan="2" style="font-size:20px; background-color:#FFC">لائسنس خریدار: جناب 
				<?php $userName = "SELECT ownreName FROM login WHERE userid='".$_SESSION['userid']."'"; 
					  echo($crud->getValue($userName,"ownreName")); ?>
		</td>
    </tr>
    <tr>
    	 <td width="275" style="vertical-align:top;">پرانا پاس ورڈ لکھیں</td>
        <td width="319" style="vertical-align:top;"><input type="password" name="oldKey" class="frmInputTxt" id="oldKey" /></td>
   	</tr>
    <tr>
   		<td width="275" style="vertical-align:top;">نیا پاس ورڈ لکھیں</td>
        <td style="vertical-align:top;"><input type="password" name="newKey" class="frmInputTxt" id="newKey" /></td>
   	</tr>
    <tr>
   		<td width="275" style="vertical-align:top;">نیا پاس ورڈ دوبارہ لکھیں</td>
        <td style="vertical-align:top;"><input type="password" name="cNewKey" class="frmInputTxt" id="cNewKey" /></td>
   	</tr>
        <td colspan="2"> <input type="submit" id="btnSave" name="btnSave" value="پاس ورڈ تبدیل کریں" class="btnSave" style="width:130px; height:50px;" /></td>
    </tr>
    		<?php if(isset($_REQUEST['btnSave'])){ ?>
			<tr>
            	<td colspan="2" style="text-align:right;"> 
                <?php if(isset($_REQUEST['oldKey']) && !empty($_REQUEST['oldKey']) && 
						 isset($_REQUEST['newKey']) && !empty($_REQUEST['newKey']) && 
						 isset($_REQUEST['cNewKey']) && !empty($_REQUEST['cNewKey'])){ 
								$oldKey = $_REQUEST['oldKey'];
								$newKey = $_REQUEST['newKey'];
								$cNewKey = $_REQUEST['cNewKey'];
							if($_REQUEST['newKey'] != $_REQUEST['cNewKey']){
								echo($crud->errorMsg("آپ کے پاس ورڈ ایک جیسے نہیں ہیں","غلطی","../images"));
								 }
							else{
										$search = "SELECT userkey,userid FROM login WHERE userid = '".$_SESSION['userid']."' AND userkey = '".$oldKey."'";
										//echo($search);
										if($crud->search($search)) { ?> 
											<?php 						
												$sqlUpate = "UPDATE login SET userkey = '".$newKey."' WHERE userid = '".$_SESSION['userid']."'";
												if($crud->update($sqlUpate)){
													echo($crud->sucMsg("آپ کا پاس ورڈ کامیابی کے ساتھ تبدیل ہوچکا ہے۔","خوشخبری","../images"));
													}
												else { 
													echo($crud->errorMsg("کمپیوٹر میں غلطی کی بناء پر آپ کا پاس ورڈ تبدیل نہ ہوسکا۔","غلطی","../images"));
												 } //end else for update()
											}//end if search() 
										else{
											echo($crud->errorMsg("آپ کا مہیا کردہ پرانا پاس ورڈ درست نہیں ہے","غلطی","../images"));
											}//end else for search()
								}//end else for password matching
								  ?>
							</td>
						</tr>			
						<?php }//end check isset form fields
						else{
							echo($crud->errorMsg("مہربانی کر کے خالی فارم پر کلک نہ کریں","غلطی","../images"));
							}//end else for if form fields were sent empty
						}//end if for button pressing ?>
    <?php }//end if for session check
else{ ?>
            <tr>
                <td colspan="2" style="text-align:right;">
               	 <?php echo($crud->errorMsg('مہر بانی کر کے دوبارہ لاگ آن کریں','غلطی',"../images")); ?>
                </td>
            </tr>
		<?php }//end of session variables check ?>
</table>
</form>
</center>
</body>
</html>