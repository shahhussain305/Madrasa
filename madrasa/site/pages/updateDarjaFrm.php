<?php require_once('../classes/Hijri_GregorianConvert.php');  ?>
<?php $hijri = new Hijri_GregorianConvert(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style>
#tblDrj td{
	vertical-align:middle !important;
	height:50px;
	}
</style>
</head>
<body style="background-image:none; background-color:#b7b88e;font-size:25px; margin:0px;" class="generalTextFonts">
<center>
<form method="post" action="?cmd=updateDarjaFrm<?php if(isset($_REQUEST['sno'])){ ?>&sno=<?php echo($_REQUEST['sno']); } ?>" style="margin:0px;">
<table width="626" border="0" cellspacing="0" cellpadding="4" id="tblDrj">
<?php 
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
	require_once('../classes/classes.php');
	
	$crud = new CRUD();
	$sno = $_REQUEST['sno'];
	?>
    <tr style="background-color:#000; color:#FFF;">
    	<td width="131" height="71" style="border-width:1px; font-size:20px"> نام طالب العلم  </td>
        <td colspan="2" style="font-size:20px;border-width:0px;"> 
		<?php echo($crud->getValue("SELECT stdName FROM registrationinfo WHERE sno = ".$sno,"stdName")); ?> &nbsp;&nbsp;
        <strong> ولدِ </strong> 
         &nbsp;&nbsp;
         <?php echo($crud->getValue("SELECT fatherName FROM registrationinfo WHERE sno = ".$sno,"fatherName")); ?>
         </td>
     	<td width="94" style="border-width:0px; font-size:20px;"> موجودہ درجہ  </td>
        <td width="100" style="border-width:0px;"> <?php echo($crud->getValue("SELECT d.darja FROM darjaat d, stdDarjaat std WHERE std.darja = d.derjaCode AND std.stdSno = ".$sno." AND std.isCurrent=1","darja")); ?> </td>
    </tr>
    <tr>
    	<td colspan="5" style="border-width:0px; height:20px;"><div style="height:20px;">&nbsp;</div></td>
    </tr>
    <tr>
    	<td height="79" style="text-align:right;border-width:0px;"> <font style="font-size:25px;"><strong>درجہ تبدیل کریں</strong> </font> </td>
        <td width="161" style="text-align:right;border-width:0px; vertical-align:top;">
       				 	<input type="hidden" name="sno" id="sno" value="<?php echo($sno); ?>" />                        
                       <?php 
						$css = 'style="font-size:23px; position:relative;top:1px; width:150px; height:51px;"';		
						$crud->darjaatCmb('darja',$css); ?>                       
                        
        </td>
        <td width="128" style="vertical-align:top;border-width:0px;"> رول نمبر </td>
        <td style="vertical-align:top;border-width:0px;" colspan="2">
        <input type="text" name="rollNo" id="rollNo" class="frmInputTxt" style="width:80px;" value="<?php echo($crud->getValue("SELECT reg.RollNumber FROM regnumbers reg, registrationinfo r WHERE r.sno = reg.regSno AND r.sno = ".$sno,"RollNumber")); ?>" />
        </td>
        
        
   	</tr>
     <tr>
    	<td colspan="5" style="border-width:0px; height:20px;"><div style="height:20px;">&nbsp;</div></td>
    </tr>
    <tr>
        
        <td width="128" style="vertical-align:top;border-width:0px;"> تاریخ داخلہ </td>
        <td style="vertical-align:top;border-width:0px;">
        <?php $admisionDatSql = "SELECT std.promotionDate FROM stdDarjaat std WHERE std.stdSno = ".$sno." AND std.isCurrent=1" ?>
        <input type="text" name="dateAdmition" id="dateAdmition" value="<?php echo($crud->getValue($admisionDatSql,"promotionDate")); ?>" class="frmInputTxt" style="width:90px" />
        </td>
   		<td width="128" height="70" style="vertical-align:top;border-width:0px;"> اختتامِ داخلہ </td>
        <td style="vertical-align:top;border-width:0px;" colspan="2">
        <?php $admisionDatSql = "SELECT std.dateEnd FROM stdDarjaat std WHERE std.stdSno = ".$sno." AND std.isCurrent=1" ?>
        <input type="text" name="dateEnd" id="dateEnd" value="<?php echo($crud->getValue($admisionDatSql,"dateEnd")); ?>" class="frmInputTxt" style="width:90px" />
        </td>
    </tr>
    <tr>
        <td colspan="5" align="center" style="border-width:0px;"> <input type="submit" id="btnSave" name="btnSave" value="درجہ تبدیل کریں" class="btnSave" style="width:130px; height:50px;" /></td>
    </tr>
    		<?php if(isset($_REQUEST['btnSave'])){ ?>
			<tr>
            	<td colspan="5" style="text-align:right;border-width:0px; font-size:18px !important;"> 
                <?php if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) &&  
						 isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) && 
						 isset($_REQUEST['rollNo']) && !empty($_REQUEST['rollNo']) &&
						 isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd']) && 
						 isset($_REQUEST['dateAdmition']) && !empty($_REQUEST['dateAdmition'])){ 
				$sno = addslashes($_REQUEST['sno']);
				$darjaNo = addslashes($_REQUEST['darja']);
				$promotionDate = addslashes($_REQUEST['dateAdmition']);
				$dateEnd = addslashes($_REQUEST['dateEnd']);
				$rollNo = addslashes($_REQUEST['rollNo']);
				?> 
					<?php if($crud->search("SELECT sno FROM registrationinfo WHERE sno = ".$sno)) { ?> 
						<?php 				
						//update roll number in regnumbers table 
						if($crud->update("UPDATE regnumbers SET RollNumber = ".$rollNo." WHERE regSno =".$sno)) {  
								//echo($crud->sucMsg("اس طالب العلم کا رول نمبر تبدیل ہوچکا ہے","معلومات"));
							 	}//end if for update method
						$shoba_sno = $crud->getValue("SELECT shoba_sno FROM darjaat WHERE derjaCode = ".$darjaNo,"shoba_sno");									
						//to make old record as history insert the details again to the datable with 
						$sqlUpdated = "INSERT INTO stdDarjaat(darja,stdSno,isCurrent,promotionDate,dateEnd,shoba_sno) VALUES(".$darjaNo.",".$sno.",1,'".$promotionDate."','".$dateEnd."',".$shoba_sno.")";
						$sqlUpdateIsCurrent = "UPDATE stdDarjaat SET isCurrent = 0 WHERE stdSno = ".$sno;
														
							if($crud->update($sqlUpdateIsCurrent)){
								if($crud->insert($sqlUpdated)) { 
								//delete all the record from the table which kept the student darja greater then this new selected darja and 
								//also delete record i.e. if darja = 6 and this is already exists but not isCurrent, this query will be affective
								//SELECT * FROM stddarjaat WHERE stdSno = 1 AND darja > 6 AND isCurrent = 0	
								//if($crud->delete("DELETE FROM stddarjaat WHERE stdSno = ".$sno." AND darja > ".$darjaNo." AND isCurrent = 0")){						 
									//	echo($crud->sucMsg("اس طالب العلم کا درجہ تبدیل ہوچکا ہے","معلومات"));
								//}//end delete method
								
								if($crud->delete("DELETE FROM stddarjaat WHERE stdSno = ".$sno." AND darja > ".$darjaNo."  AND isCurrent = 0")){		
									if($crud->delete("DELETE FROM stddarjaat WHERE stdSno=".$sno." AND darja = ".$darjaNo." AND isCurrent = 0")){
										
										}//if the same darja has repeated then remove the 0th index				 
										//done : old record which should not be remain will be deleted from here 
								}//end delete method
								echo($crud->sucMsg("اس طالب العلم کا درجہ تبدیل ہوچکا ہے","معلومات","../images"));
								
									}//end if for update method
								 }//end if for update() method
								 }//end if for search()
							 else { 
						 		echo($crud->errorMsg("اس طالب العلم کا ریکارڈ ہمارے پاس موجود نہیں ہے۔","غلطی","../images"));
							 } //end else for search()
					 	}//end if for empty form field checking 
					 else {
						 echo($crud->errorMsg("درجہ تبدیل کرنے کے لئے کوئی بھی درجہ اور تاریخ منتخب کیجئے","غلطی","../images"));
						 }//end else for empty form field checking  ?>
                </td>
            </tr>			
			<?php }//end if for button pressing ?>
    <?php
	}//end if for isset(sno);
else{ ?>
            <tr>
                <td colspan="5" style="text-align:right; border-width:0px; font-size:17px !important;">
               	 <?php echo($crud->errorMsg('درجہ تبدیل کرنے کے لئے درجہ اور تاریخ دونوں منتخب کریں۔','غلطی',"../images")); ?>
                </td>
            </tr>
		<?php } ?>
</table>
</form>
</center>
</body>
</html>