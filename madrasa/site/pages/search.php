<?php /* Auto Complete */?>
<script language="javascript" type="text/javascript" src="js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css">
<script type="text/javascript">
 	function delHistory(sn){
	if(confirm('کیا اپ واقعی اس طالب علم کی ریکارڈ کو منتخب شدہ سال میں سےمٹا دینا چاہتے ہو؟')){
	try{
		if (window.XMLHttpRequest)  { objDel=new XMLHttpRequest();  }
			else {// code for IE6, IE5
			  objDel=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  objDel.onreadystatechange=function()
			  {  
			  if (objDel.readyState !=4){
				document.getElementById("msg").innerHTML = "<img src='images/loading/loader.gif' />  Loading wait... ";
				}
			 else {
				 document.getElementById("msg").innerHTML = "<br /><br />"+objDel.responseText;
				 }
			  }
				// POST Method
				objDel.open("POST","AjaxPhp/delHistory.php",true);
				objDel.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				objDel.send("sno="+sn);
		}catch(e){
		alert(e.message);
		}
		}
	}
function findValue(li) {
	if( li == null ) return alert("No match!");
	if( !!li.extra ) var sValue = li.extra[0];
	else var sValue = li.selectValue;
	}
function selectItem(li) {
	findValue(li);
}

function formatItem(row) {
	return row[0] + " (id: " + row[1] + ")";
}
$(document).ready(function() {
	$("#registrationNumber").autocompleteArray(
		[ <?php echo($crud->autoFill("SELECT registrationNo FROM regnumbers ORDER BY sno","registrationNo")); ?> ],
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			onItemSelect:selectItem,
			onFindValue:findValue,
			autoFill:true,
			maxItemsToShow:10
		}
	);
	
	$("#stdName").autocompleteArray(
		[ <?php echo($crud->autoFill("SELECT DISTINCT stdName FROM registrationinfo","stdName")); ?> ],
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			onItemSelect:selectItem,
			onFindValue:findValue,
			autoFill:true,
			maxItemsToShow:10
		}
	);
});

function searchStd(stdName,stdRegNo){
	//alert(stdName+"\n"+stdRegNo);
	var objRst;
	try{
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  objRst=new XMLHttpRequest();
			  }
			else {// code for IE6, IE5
			  objRst=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  objRst.onreadystatechange=function() {
			  if (objRst.readyState != 4){
				document.getElementById("searchBody").innerHTML = '<p style="position:relative; top:50px;"><img src="images/loadingAnimation.gif" /> </p>';
				}	
			   else {
				   document.getElementById("searchBody").innerHTML = objRst.responseText;
				   }		
			  }
				objRst.open("POST","AjaxPhp/getStdSearchedList.php",true);
				objRst.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				objRst.send("stdName="+stdName+"&stdRegNo="+stdRegNo+"&rnd="+Math.random());
		}catch(e){
		alert(e.descriptions);
		}
	}
</script>
<style>
ul li {
	position: relative;
	text-align: center;
	left: 10px;
	padding: 10px;
	direction: rtl !important;
}
#searchBody{
	border:0px solid #060;
	width:770px;
	margin:0 auto;
	}
#msg {
	padding:20px 10px;
	}
</style>
<table width="1090" cellspacing="0" cellpadding="2" border="1">
  <tr>
    <td width="303" valign="top">
            <table width="300" cellspacing="3" cellpadding="3" border="0" bgcolor="#CCFF66">
            <tr>
                <td style="font-size:25px;"> نام طالب علم </td>
                <td><input id="stdName" name="stdName" class="frmInputTxt" style="width:150px; position:relative;top:1px; background:#fff;border:0px; left:2px; height:33px;font-family: 'jameel noori nastaleeq' !important; font-size: 19px !important;" type="text" /></td>
            </tr>
            <tr>
                <td style="font-size:25px;"> رجسٹریشن نمبر </td>
                <td><input name="registrationNumber" id="registrationNumber" class="frmInputTxt" style="width:150px; position:relative;top:1px; background:#fff;border:0px; left:2px; height:33px;" type="text" /></td>
            </tr>
            <tr>
            <td colspan="2" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" style="font-size:23px; padding:2px; width:100px; border:1px solid #e5e5e5; border-radius:4px;" onClick="searchStd($('#stdName').val(),$('#registrationNumber').val())" value="تلاش کیجئے" class="btnSave" /></td>
            </tr>
            </table>
    </td>
    <td width="773" valign="top" style="line-height:0px;">
              <div id="searchBody"></div><br /><br />
              <div id="msg"></div><br /><br />
      </td>
  </tr>
</table>
<br /><br />