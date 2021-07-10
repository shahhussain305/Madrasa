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
option {
	font-size:20px !important;
	color:#000 !important;
	font-family:"jameel Noori Nastaleeq";
	}	
</style>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#btnSave").bind("click",function(){
		var darja = $("#darja").val();
		var subjectLbl = $("#subjectLbl").val();
		var totalMarks = $("#totalMarks").val();
		if(darja == ""){
			alert('مہربانی کر کے درجہ منتخب کریں');
			$("#darja").focus();
			}
		else if(subjectLbl == ""){
			alert('مہربانی کر کے مضمون درج کریں');
			$("#subjectLbl").focus();
			}
		else if(isNaN(totalMarks) || totalMarks == ""){
			alert('مہربانی کر کے اس مضمون کے لیے نمبر درج کریں');
			$("#totalMarks").focus();
			}
		else{
		    var url = "../AjaxPhp/saveSubject.php";	
			$("#msgR").html('صبر کریں');			
			$.post(url,{darja:darja,subjectLbl:subjectLbl,totalMarks:totalMarks},function(rMsg){
				$("#msgR").html(rMsg);
				});
			}
		});
	});
</script>
<table width="615" cellspacing="0" cellpadding="2" border="1" style="border:1px solid #e4e4e4; font-family:'jameel Noori Nastaleeq'; font-size:24px; direction:rtl;">
	<tr>
    	<th colspan="3" style="font-size:25px; background:#CCC; border:1px solid #e4e4e4;">کسی بھی درجہ میں نیا مضمون درج کریں</th>
    </tr>	
    <tr>
    	<td width="177" style="border:1px solid #e4e4e4;"> درجہ منتخب کریں </td>
        <td style="border:1px solid #e4e4e4;"> 
        <?php 
			$css = 'style="border-radius:5px; border:1px solid #e5e5e5; padding:5px; width:180px; font-family:\'jameel Noori Nastaleeq\'; font-size:20px;"';
			$crud->darjaatCmb('darja',$css); ?>    
			</td>
        <td width="243" style="border:1px solid #e4e4e4;"> <input type="text" name="subjectLbl" id="subjectLbl" class="frmInputTxt" /></td>      
    </tr>
    <tr>
    	<td style="border:1px solid #e4e4e4;"> نمبر مہیاں کریں</td>
        <td style="border:1px solid #e4e4e4;"> <input type="text" name="totalMarks" id="totalMarks" value="100" class="frmInputTxt" style="width:50px;" maxlength="3" /> </td>
    	<td style="border:1px solid #e4e4e4;"> <input type="button" name="btnSave" id="btnSave" class="btnSave" value="محفوظ کریں" /> </td>
    </tr>
</table>
<br />
<div id="msgR" style="font-family:'jameel Noori Nastaleeq'; font-size:20px; color:#036; direction:rtl;"></div>