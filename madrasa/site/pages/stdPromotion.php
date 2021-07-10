<style>
#listTbl a{
	color:#039;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	}
#listTbl a:hover {
	color:#C30;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	background-color:#CCC;
	}

#darjaTbl a{
	color:#039;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	}
#darjaTbl a:hover {
	color:#C30;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	background-color:#CCC;
	}
#upgradeDarja{
	text-align:center;
	}	
th { text-align:center !important;}
#lnkRol{
	text-decoration:none;
	color:#ffffff !important;
	padding:0 10px 0 10px !important;
	border-radius:6px 6px 0 0 !important;
	background:#036;
	transition:background 0.3s linear;
	}
#lnkRol:hover{
	background:#03C !important;
	transition:background 0.3s linear;
	}
</style>
<script language="javascript">
function getStdList(darjaSn){
	try{
		if(darjaSn == "" || $("#promotionDates").val() == "" || $("#dateEnds").val() == ""){
			alert('مہربانی کر کے تاریخ منتخب کریں اوردرجہ پر \n کلک کریں تاکہ طلباء کی لِسٹ دکھایا جا سکیں');
			}
		else{
			//alert(darjaSn+"\n"+document.getElementById("year").value);
			document.getElementById("sno").value = darjaSn;
			document.getElementById("frmYear").submit();
		}
		}catch(err){
		
		}
	}
$(function() {
	$('#promotionDates').datepick();
	$('#dateEnds').datepick();
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
});	

function forwardToSelectedDarja(fromDarja,dateAdmition,dateEnd,toDarja,promotionDateOld,dateEndOld,shoba_sno){
	//alert("From Darja: "+fromDarja+"\nPromotion Date: "+dateAdmition+"\nDate End: "+dateEnd+"\nTo Darja: "+toDarja+"\nPromotion Date Old: "+promotionDateOld+"\nDate End Old:"+dateEndOld+"\nShoba Sno: "+shoba_sno);
	var oSno;
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
				oSno.open("POST","AjaxPhp/promoteAllStdToNextDarja.php",true);
				oSno.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				oSno.send("fromDarja="+fromDarja+"&promotionDate="+dateAdmition+"&dateEnd="+dateEnd+"&toDarja="+toDarja+"&promotionDateOld="+promotionDateOld+"&dateEndOld="+dateEndOld+"&shoba_sno="+shoba_sno+"&rnd="+Math.random());
		}catch(err){
		alert(err.descriptions);
		}	
	}//end of function	
function upgrateStdByRadio(rId,fromDarja,dateAdmition,dateEnd,toDarja,promotionDateOld,dateEndOld,shoba_sno){
	//alert("Radio Button ID: "+rId+"\nFrom Darja: "+fromDarja+"\nPromotion Date: "+dateAdmition+"\nDate End: "+dateEnd+"\nTo Darja: "+toDarja+"\nPromotion Date Old: "+promotionDateOld+"\nDate End Old:"+dateEndOld+"\nShoba Sno: "+shoba_sno);
	var objRd;
	if(rId == "" || fromDarja == "" || dateAdmition == "" || dateEnd == "" || toDarja == "" || promotionDateOld == "" || dateEndOld == "" || shoba_sno == ""){
			alert('مہربانی کر کے کسی بھی طالب العلم کے سامنے ریڈیو بٹن پر کلک کریں \nاور ساتھ ہی نیچے والا فارم بھی ٹھیک طور پر پر کریں');
			document.getElementById('chk'+rId).checked = false;
			}
	else{	
		if(confirm('خبردار! یہ طالب العلم اس درجہ میں سے منتخب کردہ درجہ میں منتقل ہوجائنگا.')){					
			try{
				//alert(stdSno);
				if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
					  objRd = new XMLHttpRequest();
					  }
					else  {// code for IE6, IE5
					  objRd = new ActiveXObject("Microsoft.XMLHTTP");
					  }
					  objRd.onreadystatechange = function()  {
					  if (objRd.readyState !=4){
						document.getElementById("msg").innerHTML = "<div style='padding:10px; vertical-alignment:bottom; height:15px; font-size:25px; color:#0033CC;'> صبر کریں ... <img src='images/loading/loader.gif' /></div>";
						}
					 else {
						 document.getElementById("msg").innerHTML = objRd.responseText;
						 document.getElementById('row'+rId).style.display = 'none';
						 }
					  }
						// POST Method
						objRd.open("POST","AjaxPhp/promoteAllStdToNextDarjaByRadio.php",true);
						objRd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						objRd.send("regSno="+rId+"&fromDarja="+fromDarja+"&promotionDate="+dateAdmition+"&dateEnd="+dateEnd+"&toDarja="+toDarja+"&promotionDateOld="+promotionDateOld+"&dateEndOld="+dateEndOld+"&shoba_sno="+shoba_sno+"&rnd="+Math.random());
				}catch(err){
				alert(err.descriptions);
				}
		}//end if for confirm
	}//end else
	}
function updateRolNums(darjaSno,promotyear,endYear){
	try{
		if(confirm('کیا آپ ان سب طلباء کے رول نمبرز میں تبدیلی کرنا چاہتے ہیں؟')){
		    var startFrom = window.prompt('جہاں سے رول نمبر شروع کرنا ہو وہ یہاں سے لیکھیں','0');
			if(!isNaN(startFrom)){
			$("#rolUptMsg").html("<img src='images/loading/loader.gif' />");
			var url = "AjaxPhp/updateRollNumbersByDarjaYear.php";
			$.post(url,{darjaSno:darjaSno,yearFromDate:promotyear,startFrom:startFrom,endYear:endYear},function(msg){
				$("#rolUptMsg").html(msg);
				});
				}
			else{
				alert('صرف نمبر مہیاں کریں');
				}
		}//end if
		}catch(e){
			
			}
	}
</script>
<table width="1090" align="center" border="0" cellpadding="7" cellspacing="0" style="background-color:#999">
  <tr>
    <td colspan="7" class="headingTxtDiv" style="background-color:#000000; color:#ffffff; text-decoration:none;"> طالب العلم کا ایک درجہ سے دوسرے درجہ میں ترقی </td>
  </tr>
  <tr>
  <td colspan="7" style="background-color:#ffffff;">
  <?php 
  	 $format="DD/MM/YYYY";
	$date=date("d/m/Y");
	$promotionDt = "";
	$dateEd = "";
	$yearHijri = $hijri->GregorianToHijri($date,$format);
	$HijriYr = explode('-',$yearHijri); //we have added one year to this because it will be considered as the end of admission year
	$dateAdmitionAry = explode('-',$yearHijri);
	//$dateAdmition = $dateAdmitionAry[2].'-'.$dateAdmitionAry[1].'-'.$dateAdmitionAry[0];
	$dateAdmition = $dateAdmitionAry[2].'-10-15';
	if(isset($_SESSION['hijri'])){
		$dt = new DateTime($_SESSION['hijri']);
		$promotionDt = $dt->format('Y-m-d');
		$y = explode("-",$promotionDt);
		$y = $y[0] + 1;
		$dateEd = $dt->format($y.'-m-d');
		}
  	  $snoNum = 0;
	  $darjaTxt = "";
	  $cmbTxt = "";
	  $year = "";
	  $darjaSno = "";
	  $crud->connect();
	  $sql = "SELECT derjaCode,darja FROM darjaat ORDER BY derjaCode ASC";
	  $result = mysql_query($sql,$crud->con);
	  if(mysql_num_rows($result) > 0){ ?>
            <table width="1090" align="center" border="0" cellpadding="7" cellspacing="0" id="darjaTbl" style="background-color:#ffffff; margin:0 auto; font-size:23px;">
                <tr>
                    <td colspan="9" style="height:120px;">
                     مندرجہ ذیل درجات پر کلک کریں تاکہ اُن درجات میں مکمل طلباء کی لسٹ دیکھ کر اس میں سے 
                     کسی بھی طالب العلم کا درجہ یا رول نمبر آسانی سے تبدیل کیا جا سکے.
                     </td>
                </tr>
                <tr>
                    <td colspan="9" style="height:20px; color:#036;">
                    <form method="get" name="frmYear" action="?cmd=stdPromotion" id="frmYear">
                    <input type="hidden" name="cmd" id="cmd" value="stdPromotion" />
                     تاریخ ابتداء <span style="padding:10px 2px">&nbsp;</span>
                    <input type="text" name="promotionDates" id="promotionDates" class="frmInputTxt" style="width:150px;" value="<?php if(isset($_REQUEST['promotionDates']) && !empty($_REQUEST['promotionDates'])) {echo($_REQUEST['promotionDates']);}else{ echo($promotionDt);} ?>" />
                    <span style="padding:10px 2px">&nbsp;</span>
                    تاریخ انتہا<span style="padding:10px 2px">&nbsp;</span>
                    <input type="text" name="dateEnds" id="dateEnds" class="frmInputTxt" style="width:150px;" value="<?php if(isset($_REQUEST['dateEnds']) && !empty($_REQUEST['dateEnds'])) {echo($_REQUEST['dateEnds']);}else{ echo($dateEd);} ?>" />
                    <input type="hidden" name="sno" id="sno" />
                    <span style="padding:10px 2px">&nbsp;</span>
                    درجہ منتخب کریں
                    <span style="padding:10px 2px">&nbsp;</span>
                    <?php 
						$css = 'style="background:#ffffff; border:1px solid #e4e4e4; position:relative; width:270px; right:1px; top:1px;"';		
						$java = 'onchange="getStdList(this.value)"';
						$crud->darjaatCmb('darja1',$css.' '.$java); ?>
                    </form>                    
                    <br /></td>
                </tr>
                	<td colspan="9" style="height:20px"></td>
                </tr>
             </table>
	   <?php }//end if for mysql_num_rows() ?> 
</td>
</tr>
</table>
<center><div style="height:20px; width:920px;"></div></center>
<span id="list">
<?php 
	if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) && 
	   isset($_REQUEST['promotionDates']) && !empty($_REQUEST['promotionDates']) && 
	   isset($_REQUEST['dateEnds']) && !empty($_REQUEST['dateEnds'])){
		$sno = addslashes($_REQUEST['sno']);//darjaSno
		$promotionDates = addslashes($_REQUEST['promotionDates']);
		$dateEnds = addslashes($_REQUEST['dateEnds']);
	?>
    <script language="javascript" type="text/javascript">
	try{
		$(document).ready(function(){
			$("#listTbl a").css({"text-decoration":"none","color":"#03F"});
		});
		}catch(err){
		
		}
	</script>
   <table width="1090" align="center" border="1" cellspacing="0" cellpadding="4" id="listTbl" style="font-size:23px;">
	  <tr style="font-size:20px; font-weight:bold;background-color:#000000;color:#ffffff;">
    	<th width="43" style="padding:3px;"> نمبر شمار </th>
    	<th width="191" style="padding:3px;"> اسم الطالب </th>
        <th width="160" style="padding:3px;"> رجسٹریشن نمبر </th>
        <th width="115" style="padding:3px;"> تاریخِ پیدائش </th>
        <th width="74" style="padding:3px;"> رول نمبر </th>
        <th width="180" style="padding:3px;"> مستقل پتہ </th>
        <th width="85" style="padding:3px;"> درجہ </th>
        <th width="85" style="padding:3px;"> انتخاب </th>
    </tr>
   <?php 
   	$crud = new CRUD(); 
   	$crud->connect();
	$sqlSearch = "SELECT r.sno,r.stdName,r.fatherName,r.dob,r.permanentAddress,std.promotionDate,r.cellNo,
						n.RollNumber,n.registrationNo,d.darja,d.derjaCode AS darjaSno,std.shoba_sno
				  FROM 
				  		registrationinfo r, regnumbers n,darjaat d,stdDarjaat std
				  WHERE 
				  		r.sno = n.regSno AND std.darja = d.derjaCode AND std.stdSno = r.sno AND 
				  		std.darja = ".$sno." AND std.isCurrent = 1 AND r.isActive = 1 
						AND std.promotionDate = '".$promotionDates."' AND std.dateEnd = '".$dateEnds."'
				  ORDER BY n.RollNumber ASC";
				  //echo($sqlSearch);
	if(!$crud->search($sqlSearch)){
		?>
        <tr>
        	<td colspan="8" style="background-color:#ffffff; height:60px; padding:3px;">
            	<?php echo($crud->errorMsg("اس درجہ میں کوئی بھی طالب العلم داخل نہیں ہوا ہے۔","غلطی")); ?>
            </td>
        </tr>
        <?php
	}else{
		foreach($crud->getRecordSet($sqlSearch) as $row){ 
		$shoba_sno = $row["shoba_sno"];
		$sno +=1;
		$snoNum +=1;
		$darjaTxt = $row['darja'];
		$darjaSno = $row['darjaSno'];
   ?>
    <tr style="font-size:20px;" id="row<?php echo($row['sno']);?>">
    	<td width="43" style="height:60px; text-align:center"> <?php echo($snoNum); ?> </td>
    	<td width="191" align="center"> <?php echo($row['stdName']); ?>  ولدِ <?php echo($row['fatherName']); ?> </td>
        <td width="160" align="center"> <a href="?cmd=registrationUpdateForm&registrationNoSearch=<?php echo($row['registrationNo']); ?>&darjaS=<?php echo($darjaSno);?>&btnSearch=true" title="یہاں سے طالب العلم کی رجسٹریشن تبدیل کر سکتے ہیں۔"> <?php echo($row['registrationNo']); ?> </a> </td>
        <td width="115" align="center"> <?php echo($row['dob']); ?> </td>
        <td width="74" align="center"> <a href="pages/updateRollNumber.php?sno=<?php echo($row['sno']); ?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" style="font-size:30px;" title="رول نمبر کو تبدیل کریں"><?php echo($row['RollNumber']); ?> </a> </td>
        <td width="180"> <span style="position:relative; right:5px;"> <?php echo($row['permanentAddress']); ?> </span> </td>
        <td width="85" align="center"> <a href="pages/updateDarjaFrm.php?sno=<?php echo($row['sno']); ?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" style="font-size:22px;" title="درجہ کو تبدیل کریں"><?php echo($row['darja']); ?> </a> </td>
        <td width="85" align="center"> <input type="radio" class="rb" id="chk<?php echo($row['sno']);?>" name="chk" onclick="if(this.checked == true){ upgrateStdByRadio('<?php echo($row['sno']);?>','<?php echo($darjaSno);?>',$('#promotionDate').val(),$('#dateEnd').val(),$('#darja').val(),$('#promotionDateOld').val(),$('#dateEndOld').val(),<?php echo($shoba_sno);?>); }else{this.checked = false;}" value="<?php echo($row['sno']);?>" /></td>
    </tr>
    <?php }//end while loop
	?>
    <tr>
    	<td colspan="8" align="center" style="background-color:#069;">
        <script language="javascript">
		$(function() {
			$('#dateAdmition').datepick();
			$('#dateEnd').datepick();
			});	
		</script>
        <font style="font-size:20px; color:#FF3;">
        اس درجہ کے تمام طلباء کو دوسرے درجہ میں مکمل طور پر منتقل کرنے کے لئے 
        <strong>"منتقل کریں"</strong> والے بٹن پر کلک کریں۔
        </font>
        <div id="upgradeDarja">
        	<table width="1090" border="1" align="center" cellspacing="0" cellpadding="4" style="font-size:23px;">
            <tr style="background-color:#CCC; color:#036;">
            	<td width="95">  تاریخ داخلہ  </td>
                <td width="118">  <input type="text" name="promotionDate" id="promotionDate" value="<?php if(isset($promotionDates) && !empty($promotionDates)){echo($promotionDates);}else{echo($yearHijri);} ?>" class="frmInputTxt" style="width:100px;" /> </td>
             	<td width="113">  اختتامِ داخلہ   </td>
                <td width="117">  <input type="text" name="dateEnd" id="dateEnd" value="<?php  if(isset($promotionDates) && !empty($dateEnds)){echo($dateEnds);}else{echo($yearHijri);} ?>" class="frmInputTxt" style="width:100px;" /> </td>
            	<td width="135">  درجہ تبدیل کریں </td>
                <td width="176"> 
				<input type="hidden" name="promotionDateOld" id="promotionDateOld" value="<?php echo($promotionDates);?>" />
                <input type="hidden" name="dateEndOld" id="dateEndOld" value="<?php echo($dateEnds);?>" />
                <?php 	$css = 'style="font-size:23px; width:150px"';		
						$crud->darjaatCmb('darja',$css); ?>
                		 </td>
                        <td width="264" style="text-align:right;">																											
                        <input type="button" onclick="if(confirm('خبردار! اس درجہ میں تمام طلباء منتخب کردہ درجہ میں منتقل ہوجائنگے۔')){ forwardToSelectedDarja('<?php echo($darjaSno);?>',$('#promotionDate').val(),$('#dateEnd').val(),$('#darja').val(),$('#promotionDateOld').val(),$('#dateEndOld').val(),<?php echo($shoba_sno);?>); }" value="منتقل کریں" id="btnChange" name="btnChange" class="btnSave" />
                        </td>
            </tr>
            <tr>
            	<td colspan="8" style="background-color:#FFF; line-height:60px;"> <div id="msg"></div> </td>
            </tr>
            <tr>
            	<td colspan="8" style="text-align:right; height:45px;">
                <a href="#" id="lnkRol" onclick="updateRolNums(<?php echo($darjaSno); ?>,'<?php echo($promotionDates); ?>','<?php echo($dateEnds); ?>'); return false;" title="تمام طلباء کے رول نمبرز کو بالترتیب تبدیل کرنے کے لیے یہاں پر کلک کریں">
                اس سال کے منتخب کردہ درجہ میں سب طلباء کے رول نمبرز کو تبدیل کریں
                </a>                 
                 <span style="padding:0px 48px 0 0; color:#ffffff !important; text-align:right;" id="rolUptMsg"></span>
                </td>
            </tr>
           </table>
           
        </div>
        </td>
    </tr>
    <?php
	}//end of else
	 ?>
</table>
    <?php
	}
else{
	echo('درجہ پر کلک کر کے لسٹ دکھائیں.');
	}
?>
</span>