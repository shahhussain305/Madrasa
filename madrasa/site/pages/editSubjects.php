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
<script language="javascript" type="text/javascript">
function submitSubjectForm(darjaSno){
	try{
		document.getElementById("darjaSn").value = darjaSno;
		document.getElementById("submitSubjectFrm").submit();
	}catch(e){
			alert('Error in form submission.'+e.message);
		}
	}
function update(sno,subjectName){
	try{
		//alert(sno+'\n'+subjectName);
		var updt;
		//alert("Img name = "+imgName+"\n Path Original = "+imgInOriginalFolder+"\nPath Tumb Folder = "+imgInThumbFolder);
		if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  updt=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  updt=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  updt.onreadystatechange=function()
			  {
			  if(updt.readyState == 4){
				document.getElementById("msg").innerHTML = updt.responseText;
				//alert(updt.responseText);
				}
			  else{
				  document.getElementById("msg").innerHTML = 'انتظار کیجئے ۔۔۔';
				  }			
			  }
				updt.open("POST","../AjaxPhp/editSubjects.php",true);
				updt.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				updt.send("subjectName="+subjectName+"&sno="+sno+"&rnd="+Math.random());		
		}catch(err){
		alert('Update Error:-'+e.message);
		}
	}
</script>
<style>
#msg {
	line-height:50px;
	font-size:25px !important;
	color:#036;
	}
</style>
</head>
<body style="background-image:none; background-color:#b7b88e;font-size:25px; margin:0px;" class="generalTextFonts">
<center>
<form method="post" action="editSubjects.php" id="submitSubjectFrm" name="submitSubjectFrm">
    <input type="hidden" name="darjaSn" id="darjaSn" value="<?php if(isset($_REQUEST['darjaSn']) && !empty($_REQUEST['darjaSn'])){echo($_REQUEST['darjaSn']);} ?>" />
</form>
<form method="post" action="?cmd=changePassword" style="margin:0px;">
<span id="msg"></span>
<table width="600" border="0" cellspacing="0" cellpadding="4" id="tblDrj" align="center" style="background-color:#ffffff; color:#000000;">
<?php 
session_start();
if(isset($_SESSION['userid']) && !empty($_SESSION['key'])){
	require_once('../classes/classes.php');	
	$crud = new CRUD();
	//echo("SELECT darja FROM darjaat WHERE sno=".$_REQUEST['darjaSn']);
	?>
    <tr>
    	<td colspan="2" style="font-size:20px; background-color:#FFC">کسی بھی درجہ کے مضامین میں تبدیلی کرنے کے لئے درجہ منتخب کیجئے</td>
    </tr>
    <tr>
    	 <td style="vertical-align:top;" colspan="2">
         <table width="590" border="0" cellspacing="0" cellpadding="4" style="background-color:#036; color:#FFF;">
         <tr>
         	<td>درجہ منتخب کریں </td>
            <td> 
            <?php $css = 'style="width:260px;position:relative;top:1px;" onchange="if(this.value != \'\'){ submitSubjectForm(this.value); }else{alert(\'مضامین کو تبدیل کرنے کے لئے کوئی بھی درجہ منتخب کیجئے\');}"';		
           				   $crud->darjaatCmb('darja',$css); ?> 
            </td>
           </tr>
          </table>
         </td>
   	</tr>
    <?php if(isset($_REQUEST['darjaSn']) && !empty($_REQUEST['darjaSn'])){ 
		$sqlFetch = "SELECT s.sno,s.subjectName FROM subjects s,darjaat d WHERE d.derjaCode = s.darjaSno AND s.darjaSno = ".$_REQUEST['darjaSn'];   
			 	foreach($crud->getRecordSet($sqlFetch) as $row){ ?>
    <tr>
   		<td width="398" style="vertical-align:top;">
        <input type="text" name="subject<?php echo($row['sno']); ?>" class="frmInputTxt" value="<?php echo($row['subjectName']); ?>" id="subject<?php echo($row['sno']); ?>" />
        </td>
        <td width="186" style="vertical-align:top;">        
        <input type="button" name="btnSave" class="btnSave" value="تبدیل کریں" id="btnSave" onclick="update('<?php echo($row['sno']); ?>',document.getElementById('subject<?php echo($row['sno']); ?>').value)" />
        </td>
   	</tr>
 <?php    }}
					?>
<?php }else{ ?>
            <tr>
                <td colspan="2" style="text-align:right;">
               	 <?php echo($crud->errorMsg('مہر بانی کر کے دوبارہ لاگ آن کریں','غلطی')); ?>
                </td>
            </tr>
		<?php }//end of session variables check ?>
</table>
</form>
<div class="headingTxtDiv" style="height:10px !important;">&nbsp;</div>
</center>
</body>
</html>