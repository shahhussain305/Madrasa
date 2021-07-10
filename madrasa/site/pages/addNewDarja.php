<?php require_once('../classes/classes.php'); $crud = new CRUD(); ?>
<style>
.frmInputTxt{
	border:1px solid #CCC;
	font-size:20px;
	border-radius:5px;
	padding:6px;
	width:200px;
	font-family:'Jameel Noori Nastaleeq';
	}
.btnSave {
	font-size:18px;
	border:0px;
	border-radius:5px 5px 0 0;
	direction:rtl;
	padding:5px;	
	background-color:#036;
	color:#F3F3F3;
	font-family:'Jameel Noori Nastaleeq';
	}	
.frmSelect{
	border: 1px solid #E4E4E4;
    border-radius: 5px;
    font-family: 'Jameel Noori Nastaleeq';
    font-size: 20px;
    padding: 2px;
    width: 201px;
	}	
</style>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#btnSave").bind("click",function(){
		var darjaLbl = $("#darjaLbl").val();
		var shoba = $("#shoba").val();
		//alert(shoba);	
		if(shoba == ""){
			alert('مہربانی کرکے پہلے شعبہ منتخب کریں');
			$("#shoba").focus();
			}	
		else if(darjaLbl == ""){
			alert('مہربانی کر کے درجہ مہیاں کریں');
			$("#darjaLbl").focus();
			}
		else{
		    var url = "../AjaxPhp/saveDarja.php";	
			$("#msgR").html('صبر کریں');			
			$.post(url,{shoba:shoba,darjaLbl:darjaLbl},function(rMsg){
				$("#msgR").html(rMsg);
				});
			}
		});
	});
</script>
<table width="615" cellspacing="0" cellpadding="2" border="1" style="border:1px solid #e4e4e4; font-family:'jameel Noori Nastaleeq'; font-size:24px; direction:rtl;">
	<tr>
    	<th colspan="3" style="font-size:25px; background:#CCC; border:1px solid #e4e4e4;">نیا درجہ یہاں سے محفوظ کریں</th>
    </tr>
     <tr>
    	<td width="177" style="border:1px solid #e4e4e4;"> شعبہ منتخب کریں </td>
        <td colspan="2" style="border:1px solid #e4e4e4;"> <?php $crud->shobaCmb("shoba"); ?></td>
    </tr>	
    <tr>
    	<td width="177" style="border:1px solid #e4e4e4;"> درجہ کا نام یہاں لکھیں </td>
        <td width="243" style="border:1px solid #e4e4e4;"> <input type="text" name="darjaLbl" id="darjaLbl" class="frmInputTxt" /></td>
        <td width="175" style="border:1px solid #e4e4e4;"> <input type="button" name="btnSave" id="btnSave" class="btnSave" value="محفوظ کریں" /> </td>
    </tr>
</table>
<br />
<div id="msgR" style="font-family:'jameel Noori Nastaleeq'; font-size:20px; color:#036; direction:rtl;"></div>