// JavaScript Document
//date year in parts
var date = new Date();
var fulYear = date.getFullYear();
var year = date.getYear();
var month = date.getMonth();
var day = date.getDate();
//alert(fulYear);
function getAndPut(getVal,putToId){
	try{
		document.getElementById(putToId).value = document.getElementById(getVal).value;
		}catch(e){
		alert(e.descriptions);
		}
	}
function showHide(fldId,option){
	try{
			if(option == "hide"){
				document.getElementById(fldId).style.display = 'none';
			}
			else{			
				document.getElementById(fldId).style.display = 'block';
			}
		}catch(e){
		alert(e.descriptions);
		}
	}
	
//function to delete photo from the thumbs and original folder inside the takephoto dir
function deletePhoto(imgName){
	var imgThumb = imgName.replace("original","thumbs");
	var imgInOriginalFolder = "takephoto/"+imgName;
	var imgInThumbFolder = "takephoto/"+imgThumb;
	var objDel;
	try{
		//alert("Img name = "+imgName+"\n Path Original = "+imgInOriginalFolder+"\nPath Tumb Folder = "+imgInThumbFolder);
		if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  objDel=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  objDel=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  objDel.onreadystatechange=function()
			  {
			  if (objDel.readyState !=4){
				document.getElementById("msg").innerHTML = "<img src='images/loading/loader.gif' />  Loading wait... ";
				}
			 else {
				 document.getElementById("msg").innerHTML = objDel.responseText;
				 clearPhoto();
				 //document.getElementById("msg").innerHTML = '<a href="takephoto/index.php?iframe=true&width=750&height=400" rel="prettyPhoto" title="طالب العلم کی فوٹو یہاں چسپان کریں۔"> فوٹو یہاں لگالیں </a>';
				 }
			  }
				// GET Method
				//objDel.open("GET","../ajaxPhp/getNIC.php?empName="+empName,true);				
				//objDel.send();
				
				// POST Method
				objDel.open("POST","AjaxPhp/deletePhoto.php",true);
				objDel.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				objDel.send("imgInOriginalFolder="+imgInOriginalFolder+"&imgInThumbFolder="+imgInThumbFolder);
		}catch(e){
		alert(e.descriptions);
		}
	}

//function to refresh the passport size photo in registration form
var counter = 0;
function refreshPhoto(){
	var pic;
	if(counter == 0){	
	try{
		if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  pic =new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  pic=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  pic.onreadystatechange=function()
			  {
			  if (pic.readyState == 4){
						  try{ 
						    document.getElementById("stdPhto").innerHTML = pic.responseText;
								if(pic.responseText.length > 5 ){
									counter += 1;
									document.getElementById("linkToTakePhoto").style.display = 'none';
									}
								else{
									document.getElementById("linkToTakePhoto").style.paddingTop = '90px';
									document.getElementById("linkToTakePhoto").style.display = 'block';
									}
									putImgValue(); //to update the textfield with the new image name information
				  		}catch(err){
					 		alert('Element Not found');
					  	} 
			  		}
			  }
				pic.open("POST","AjaxPhp/refreshPhoto.php",true);
				pic.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				pic.send("rnd="+Math.random()); //to send the random as temporary number with queryString
				//the random number will generate a unique request for our ajax request
				setTimeout("refreshPhoto()",3000); //this is dangrous but it is the only way to send request for photo refresh in the registration form only
				//alert('hii');	

		}catch(err){
		alert(err.descriptions);
		}
	}//if counter == 0
	}
//function to get value from session variable and put the value in stdPhoto	hidden textfield
function putImgValue(){
	var pValu;
	try{
		//alert("Img name = "+imgName+"\n Path Original = "+imgInOriginalFolder+"\nPath Tumb Folder = "+imgInThumbFolder);
		if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  pValu=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  pValu=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  pValu.onreadystatechange=function()
			  {
			  if (pValu.readyState == 4){
				document.getElementById("stdPhoto").value = pValu.responseText;
				}			
			  }
				pValu.open("POST","AjaxPhp/getPhotoValue.php",true);
				pValu.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				pValu.send("rnd="+Math.random());
		}catch(e){
		alert(e.descriptions);
		}
	}
//function to submit photo uploading form 
function setPassportValue(){
	try{
		$("#frmUpload").submit();
		}catch(e){
		alert(e.message);
		}
	}	
	
//function to get student list by darja sno
function getStdList(id){
	//alert(id);
	var darjaSno;
	try{
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  darjaSno=new XMLHttpRequest();
			  }
			else {// code for IE6, IE5
			  darjaSno=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  darjaSno.onreadystatechange=function() {
			  if (darjaSno.readyState != 4){
				document.getElementById("list").innerHTML = '<img src="images/loading/loader.gif" /> صبر کریں لسٹ کی تلاش جاری ہے۔  ';
				}	
			   else {
				   document.getElementById("list").innerHTML = darjaSno.responseText;
				   }		
			  }
				darjaSno.open("POST","AjaxPhp/getStdListByDarjaSno.php",true);
				darjaSno.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				darjaSno.send("sno="+id+"&rnd="+Math.random());
		}catch(e){
		alert(e.descriptions);
		}
	}

	
//function to reload window and show link again in the photo div
function clearPhoto(){
	try{
		//window.reload(true);
		window.location.href = "index.php?cmd=registrationForm";
		}catch(e){
		alert(e.descriptions);
		}
	}
//function to allow only 4 digits in the year field
function checkYear(val) {
	   try{
		   if(isNaN(val) || val.length > 4 || val.length < 4){
			   	  alert("Provided Number Must be 4 Digits Number");
		  	     }
		   }catch(e){
		   alert(e.descriptions);
		   }
	   }
//function to get label of darja from darjaat table by getting sno as parameter
function getDarjaLbl(sno,spanId,pathUrl){  //pathChar will be equal to empty if there is no need to use ../
	var darjaLbl;
	try{
		//alert(sno+"\n"+spanId);	
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  darjaLbl = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  darjaLbl = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  darjaLbl.onreadystatechange = function()  {
			  if (darjaLbl.readyState !=4){
				document.getElementById(spanId).innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById(spanId).innerHTML = darjaLbl.responseText;
				 }
			  }
				// POST Method
				darjaLbl.open("POST",pathUrl,true);
				darjaLbl.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				darjaLbl.send("sno="+sno);
		}catch(err){
		alert(err.descriptions);
		}
	}
//print tht div by id
function Print(node){
	try{
		  var content=document.getElementById(node).innerHTML;
		  var pwin=window.open('','print_content','width=100px,height=10');
		  pwin.document.open();
		  pwin.document.write('<html><head><link rel="stylesheet" href="../css/print.css" type="text/css" /></head><body onload="window.print()">'+content+'</body></html>');
		  pwin.document.close();
		 
		  setTimeout(function(){pwin.close();},1000);
		}catch(e){
		alert(node);
		}
	}
	

/* this function will return
1- sno will get value through sno from table
2- tableNasme will return value from this table
3- fldName will return value of the field spesified
4- showInTxtFld it is the id of the input = text where id = id of the textbox==showInTxtFld
5- resetVal will reset the original value of the textfield as it is already 
   having the original value when this function will call 
*/
function getValue(sno,tableNam,fldName,txtId,spanId,resetVal){
	var val;
	document.getElementById(txtId).value = resetVal;
	try{
		//alert(sno+"\n"+tableNam+"\n"+fldName+"\n"+txtId+"\n"+resetVal);	
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  val = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  val = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  val.onreadystatechange = function()  {
			  if (val.readyState !=4){
				document.getElementById(spanId).innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById(txtId).value = val.responseText+"-"+document.getElementById(txtId).value;
				 document.getElementById(spanId).innerHTML = "";
				 }
			  }
				// POST Method
				val.open("POST","AjaxPhp/getValue.php",true);
				val.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				val.send("sno="+sno+"&tableNam="+tableNam+"&fldName="+fldName);
		}catch(err){
		alert(err.descriptions);
		}
	}
//function to check nic fields fld1 means html form field nic field = stdNic
function checkNIC(fld1,fld2,fld3){
		try{
		document.getElementById(fld1).disabled = false;
		
		document.getElementById(fld2).value = '';
		document.getElementById(fld2).disabled = true;
		document.getElementById(fld3).value = '';
		document.getElementById(fld3).disabled = true;		
		}catch(err){
				alert(err.descriptions);
			}
	}
//function to get dropdown list menu value
function getVal(id){
	var ddlReport ,Text ,Value;
	try{
		//alert(id);
		ddlReport = document.getElementById(id);
		//Text = ddlReport.options[ddlReport.selectedIndex].text; 
		Value = ddlReport.options[ddlReport.selectedIndex].value; 
		}catch(err){
		alert(err.descriptions);
		}
		return Value;
	}
//to fill the combo with student name and sno
function fillComboStd(darjaSno,cmb,promotionDate,dateEnd){
	//alert('darja sno: '+darjaSno+'\ncmb:'+cmb+'\npromotion date: '+promotionDate+'\ndateend: '+dateEnd);
	var dar;
	try{
		//alert(sno+"\n"+tableNam+"\n"+fldName+"\n"+txtId+"\n"+resetVal);	
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  dar = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  dar = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  dar.onreadystatechange = function()  {
			  if (dar.readyState !=4){
				document.getElementById("msg").innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById(cmb).innerHTML = dar.responseText;
				 document.getElementById("msg").innerHTML =  '';
				 }
			  }
				// POST Method
				dar.open("POST","AjaxPhp/stdNameCombo.php",true);
				dar.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				dar.send("darja="+darjaSno+"&promotionDate="+promotionDate+"&dateEnd="+dateEnd+"&rnd="+Math.random());
		}catch(err){
		alert(err.descriptions);
		}
	}
	
//to fill the combo with student name and sno but stdDarjaat.isCurrent will not be mentiong to get all the record
function fillComboStdAll(darjaSno,cmb){
	var dar1;
	try{
		//alert(sno+"\n"+tableNam+"\n"+fldName+"\n"+txtId+"\n"+resetVal);	
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  dar1 = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  dar1 = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  dar1.onreadystatechange = function()  {
			  if (dar1.readyState !=4){
				document.getElementById("msg").innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById(cmb).innerHTML = dar1.responseText;
				 document.getElementById("msg").innerHTML =  '';
				 }
			  }
				// POST Method
				dar1.open("POST","AjaxPhp/stdNameComboAll.php",true);
				dar1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				dar1.send("darja="+darjaSno+"&rnd="+Math.random());
		}catch(err){
		alert(err.descriptions);
		}
	}

//to fill the combo with student name and sno but stdDarjaat.isCurrent will not be mentioning to get all the record
function fillComboStdAll2(darjaSno,cmb){
	var dar1;
	try{
		//alert(darjaSno+"\n"+cmb);	
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  dar1 = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  dar1 = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  dar1.onreadystatechange = function()  {
			  if (dar1.readyState !=4){
				document.getElementById("msg").innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById(cmb).innerHTML = dar1.responseText;
				 document.getElementById("msg").innerHTML =  '';
				 }
			  }
				// POST Method
				dar1.open("POST","../AjaxPhp/stdNameComboAll.php",true);
				dar1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				dar1.send("darja="+darjaSno+"&rnd="+Math.random());
		}catch(err){
		alert(err.descriptions);
		}
	}

//to fill the combo with student name and sno but stdDarjaat.isCurrent will not be mentioning to get all the record
function fillComboStdAllWithDate(promotionDate,dateEnd,darja,cmb){
	var comboFil;
	try{
		//alert(year+"\n"+darja+"\n"+cmb);	
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  comboFil = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  comboFil = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  comboFil.onreadystatechange = function()  {
			  if (comboFil.readyState !=4){
				document.getElementById("msg").innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById(cmb).innerHTML = comboFil.responseText;
				 document.getElementById("msg").innerHTML =  '';
				 }
			  }
				// POST Method
				comboFil.open("POST","../AjaxPhp/fillComboStdAllWithDate.php",true);
				comboFil.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				comboFil.send("darja="+darja+"&promotionDate="+promotionDate+"&dateEnd="+dateEnd+"&rnd="+Math.random());
		}catch(err){
		alert(err.descriptions);
		}
	}
	
function delStd(stdSno){
	var objSno;
	if(confirm('اگر آپ نے اس طالب العلم کے ریکارڈ کو مٹادیا تو یہ ریکارڈ ہمیشہ کے لئے مٹ جائیگا۔ \nکیا ابھی بھی آپ اس طالب العلم کی ریکارڈ کو مٹانا چاہنگے؟ اگر ہاں تو اُو۔کے پر کلک کریں ورنہ کینسِل بٹن پر کلک کریں')){
	try{
		//alert(stdSno);
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  objSno = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  objSno = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  objSno.onreadystatechange = function()  {
			  if (objSno.readyState !=4){
				document.getElementById("msg").innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById("msg").innerHTML = objSno.responseText;
				 }
			  }
				// POST Method
				objSno.open("POST","AjaxPhp/delStd.php",true);
				objSno.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				objSno.send("stdSno="+stdSno+"&rnd="+Math.random());
		}catch(err){
		alert(err.descriptions);
		}	
	}//end if for confirm
	}
	
function stuctOff(stdSno){
	var oSno;
	if(confirm('کیا آپ واقعی اس طالب العلم کو خارج کرنا چاہینگے؟')){
	try{
		//alert(stdSno);
		if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  oSno = new XMLHttpRequest();
			  }
			else  {// code for IE6, IE5
			  oSno = new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  oSno.onreadystatechange = function()  {
			  if (oSno.readyState !=4){
				document.getElementById("msg").innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
				}
			 else {
				 document.getElementById("msg").innerHTML = oSno.responseText;
				 }
			  }
				// POST Method
				oSno.open("POST","AjaxPhp/stuctOff.php",true);
				oSno.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				oSno.send("stdSno="+stdSno+"&rnd="+Math.random());
		}catch(err){
		alert(err.descriptions);
		}	
	}//end if for confirm
	}	
//function to delete attendance of the student from a spesific date
function deleteAttendance(sno,trIdToHide){
	//alert(sno+'\n'+trIdToHide);
	var attendance;
	try{
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  attendance=new XMLHttpRequest();
			  }
			else{// code for IE6, IE5
			  attendance=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  attendance.onreadystatechange=function(){
			  if (attendance.readyState == 4){
				  if(attendance.responseText == "done"){
						//document.getElementById(trIdToHide).style.display = "none";
						$("#"+trIdToHide).hide(3000);
				  	}
				  else{
					  alert(attendance.responseText);
					  }
				}			
			  }
				attendance.open("POST","AjaxPhp/deleteAttendance.php",true);
				attendance.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				attendance.send("sno="+sno+"&rnd="+Math.random());
		}catch(e){
		alert(e.descriptions);
		}
	}
//function to delete complete result for one student
function deleteResult(regSno,termResult,promotionDate,dateEnd,trIdToHide){
	//alert(regSno+'\n'+termResult+'\n'+year+'\n'+trIdToHide);
	var delRslt;
	try{
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  delRslt=new XMLHttpRequest();
			  }
			else{// code for IE6, IE5
			  delRslt=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  delRslt.onreadystatechange=function(){
			  if (delRslt.readyState == 4){
				  if(delRslt.responseText == "done"){
						//document.getElementById(trIdToHide).style.display = "none";
						$("#"+trIdToHide).hide(3000);
				  	}
				  else{
					  alert(delRslt.responseText);
					  }
				}			
			  }
				delRslt.open("POST","AjaxPhp/deleteResult.php",true);
				delRslt.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				delRslt.send("regSno="+regSno+"&termResult="+termResult+"&promotionDate="+promotionDate+"&dateEnd="+dateEnd+"&rnd="+Math.random());
		}catch(e){
		alert(e.descriptions);
		}
	}
function checkLastNum(num){
	//alert(num);
	$('#msgCheck').show();
	var ary = num.split("-");
	var numToSearch = "";
		if(ary.length >= 2){
			//alert(ary[1]+"-"+ary[2]);
			//numToSearch = ary[2];
			numToSearch = ary[1]+"-"+ary[2]
		}
		else {
			numToSearch = num;
		}
		//alert(numToSearch);
		
		var url = "AjaxPhp/isExistsRegNum.php";
		$.post(url,{num: numToSearch},function(result){
			$('#msgCheck').html(result);
			//alert(result);
			});
	}
function hideDiv(did){
	$("#"+did).hide(3000);
	}
function countRegNum(darja_sno){
	//alert(darja_sno);
	try{
		var url = "AjaxPhp/getRegNumber.php";
		$.post(url,{darja_sno:darja_sno},function(msg){
			$("#registrationNoForReset").val(msg);
			$("#showTotal").html(Math.round(msg));
			$("#admissionNo").val(Math.round(msg));
			$("#tStds").html(Math.round(msg));
			$.post("AjaxPhp/makeHigri.php",function(yer){
			$("#registrationNo").val(yer+''+darja_sno+'-'+msg);});
			});	
		}catch(err){
			alert(err.message);
		}
	}