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
#lst{
	border:1px solid #039 !important;
	}
#lst a{
	color:#F00;
	text-decoration:none;
	font-size:18px;
	padding:2px 25px;
	border-radius:5px;
	background:#FFF;
	transition:background 0.3s linear;
	}
#lst a:hover{
	background:#CCC;
	transition:background 0.3s linear;
	}
#lst td{
	border:1px solid #CCF !important;
	}
#msg {
	line-height:50px;
	font-size:25px !important;
	color:#036;
	}
</style>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript">
function deleteDarja(sno){
	if(confirm('کیا آپ واقعی اس درجہ کو مکمل طور پر ہٹانا چاہتے ہیں؟')){
	$("html, body").animate({ scrollTop: 0 }, "slow");
	try{
		//alert(sno);
		var delObj;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  delObj=new XMLHttpRequest();
			  }
			else{// code for IE6, IE5
			  delObj=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  delObj.onreadystatechange=function(){
			  if(delObj.readyState == 4){
				document.getElementById("msg").innerHTML = delObj.responseText;
				}
			  else{
				  document.getElementById("msg").innerHTML = 'انتظار کیجئے ۔۔۔';
				  }			
			  }
				delObj.open("POST","../AjaxPhp/deleteDarja.php",true);
				delObj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				delObj.send("sno="+sno+"&rnd="+Math.random());		
		}catch(err){
			alert('Update Error:-'+e.message);
		}
	}//confirm()
	}
</script>
</head>
<body style="background-image:none; background-color:#b7b88e;font-size:25px; margin:0px;" class="generalTextFonts">
<center>
<span id="msg"></span>
<table width="600" border="0" cellspacing="0" cellpadding="4" id="tblDrj" align="center" style="background-color:#ffffff; color:#000000;">
<?php 
session_start();
if(isset($_SESSION['userid']) && !empty($_SESSION['key'])){
	require_once('../classes/classes.php');	
	$crud = new CRUD();
	?>
    <tr>
    	<td colspan="2" style="font-size:20px; background-color:#FFC">کسی بھی درجہ کو مٹانے کے لئے درجہ کے آگے لنک پر کلک کریں</td>
    </tr>
    <tr>
    	 <td style="vertical-align:top;" colspan="2">
         <table width="590" border="0" cellspacing="0" border="1" cellpadding="4" id="lst">
         <?php $sqlShoba = "SELECT sno,shoba FROM shobajaat WHERE is_active = 1 ORDER BY sno ASC";
		 foreach($crud->getRecordSet($sqlShoba) as $row1){
		  ?>
          <tr>
          	<td colspan="3" style="background:#e4e4e4;"><?php echo($row1['shoba']); ?></td>
          </tr>
         <?php $counter = 0; 
		 	foreach($crud->getRecordSet("SELECT derjaCode,darja FROM darjaat WHERE shoba_sno = ".$row1['sno']." ORDER BY derjaCode ASC") as $row) { 
			$counter +=1; ?> 
         	<tr>
            	<td> <?php echo($counter); ?> </td>
            	<td> <?php echo($row["darja"]); ?> </td>
                <td> <a href="#" onclick="deleteDarja('<?php echo($row["derjaCode"]); ?>'); return false;" title="درجہ کو ہٹانے کے لیے یہاں پر کلک کریں">ہٹائیں</a></td>
            </tr>
         <?php }//inner foreach()
		 		 }//outter foreach()
				 ?>
          </table>
         </td>
   	</tr>
 <?php 
  	}
else{ ?>
            <tr>
                <td colspan="2" style="text-align:right;">
               	 <?php echo($crud->errorMsg('مہر بانی کر کے دوبارہ لاگ آن کریں','غلطی')); ?>
                </td>
            </tr>
		<?php }//end of session variables check ?>
</table>
<div class="headingTxtDiv" style="height:10px !important;">&nbsp;</div>
</center>
</body>
</html>