<?php 
/* ----------- Database CRUD : Create Retrive Update Delete Class ------------
// ----- Author of this PHP CRUD Class is Shah Hussain -----------------------
//---- Contact Email: shahhussain305@yahoo.com / shahhussain305@gmail.com ----
//--- Contact Phone Address: 0092-313-9419449 --------------------------------
//-- Source Code of this class is totally Free of Cost and i have dadicated it 
// all those who want to learn and prove -------------------------------------
// if any user of this code get any problem in this very simple class let me 
// know, i will try of my best to do good for them.... 
//--------------------- Updated on : 1-02-2012 -------------------------------
// ------------------------- Thanks ------------------------------------------
*/ 
class CRUD {
		var $con;  
		var $unsetFlg;
		var $returnVal = "0";
		//function to make connection to database
		function connect(){
			$this->con = mysql_connect("localhost","root","Thefire!!1") or die(mysql_error());	
			mysql_query("SET character_set_results=utf8", $this->con);
			mb_language('uni');
			mb_internal_encoding('UTF-8');
			mysql_select_db("taleemulquran_dbs",$this->con);
			mysql_query("set names 'utf8'",$this->con);			
			}
			
		//to search in database tables with parameterized query.
		function search($sql){
			$this->connect();
			//mysql_query("SET character_set_results=utf8", $this->con);
			$result = mysql_query($sql,$this->con);
			if(mysql_num_rows($result) > 0){
				return true;
				}
			else {
				return false;
				}
				mysql_close($this->con);
		}
		
		
		//function to get the field value from the table specified in the query
		function getValue($sql,$value){
			$this->connect();
			//mysql_query("SET character_set_results=utf8", $this->con);
			$result = mysql_query($sql,$this->con);
			if(mysql_num_rows($result) > 0) {
				$row = mysql_fetch_array($result);
					$value = $row[$value];
				}
			else {
					$value = "";
				}
				mysql_close($this->con);
				return $value;
			}
		
		//function to insert record to table according to the parametarized query
		function insert($sql){
			$this->connect();
			/*mysql_query("SET character_set_client=utf8", $this->con);
			mysql_query("SET character_set_connection=utf8", $this->con);*/
			mysql_query($sql,$this->con);
			if(mysql_affected_rows() > 0){
				return true;
				}
			else {
				return false;
				}
			mysql_close($this->con);
			}
		//function to update table
		function update($sql){
			$this->connect();
			/*mysql_query("SET character_set_client=utf8", $this->con);
			mysql_query("SET character_set_connection=utf8", $this->con);*/
			mysql_query($sql,$this->con);
			if(mysql_affected_rows() > 0){
				return true;
				}
			else {
				return false;
				}	
				mysql_close($this->con);		
			}
		//function to Delete table
		function delete($sql){
			$this->connect();
			mysql_query($sql,$this->con);
			if(mysql_affected_rows() > 0){
				return true;
				}
			else {
				return false;
				}	
				mysql_close($this->con);		
			}
			//function to return the filled array of data
	   /* $sqlFetch = "SELECT sno,columnsName FROM table ORDER BY sno DESC";   
			 	foreach($crud->getRecordSet($sqlFetch) as $row){
					echo($row['columnsName']);
					} */
	   function getRecordSet($sql){
			$ary = array();
			$this->connect();	
			$result = mysql_query($sql,$this->con);
			if(mysql_num_rows($result) > 0){
				while($row = mysql_fetch_assoc($result)){
					$ary[] = $row;
					}
				}
				mysql_close($this->con);
			return $ary;
		   }
	 //function to fill the combo
	 function fillCombo($sql,$idFld,$displayFld){
		 $this->connect();
		 $options = "";
		 $result = mysql_query($sql,$this->con);
		 if(mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_array($result)){
					$options .= '<option value="'.$row[$idFld].'"> '. $row[$displayFld] .' </option>'.PHP_EOL;
					}					
				}
			else {
					$options = "Not found";
				}
				mysql_close($this->con);
				return $options;
		 }
	 //function to check isset and !empty for form field
	 function isOk($fld){
		 if(isset($fld) && !empty($fld)){
			 return true;
			 }
		 else {
			 return false;
			 }
		 }
	 //function to upload file
	 function upload($fileName,$fileType,$fileTmpName,$pathToSaveIn) {
		 $flagUpload = false;
		 $rndFileName = "";
		 $rndNum = rand(10000000,9899999999);
		 
		 if ((($fileType == "image/gif") || ($fileType == "image/jpeg") || ($fileType == "image/png")))
		 	{			  
			$nameFile = $rndNum."_".$fileName;
			$_SESSION['fileName'] = $nameFile;
				if (!file_exists($pathToSaveIn."/" . $nameFile)) {					 
					  move_uploaded_file($fileTmpName,$pathToSaveIn."/" . $nameFile);
					  $flagUpload = true;
					}
			  }
			  return $flagUpload;    //may be return true or false
		 }
	  //function to Unset file
	  function unsetFile($path,$file){		   
		 /* <script>
		  alert('<?php echo($path."/".$file); ?>');
		  </script>*/
		  $this->unsetFlg = false;		 		
		   if(!empty($file)){
			  if(file_exists($path."/".$file)){
				  unlink($path."/".$file);				 
				   $this->unsetFlg = true;
				  }
			  }
			  return  $this->unsetFlg;
		  }
		  
		//function autofill / auto complete
		function autoFill($sql,$fld){
			$value = '';
			$this->connect();
			$result = mysql_query($sql,$this->con);
			if(mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_array($result)){
					$value .= '"'.$row[$fld].'",';
					}
			}//end if
			else {
					$value = "";
				}
				$len=strlen($value);
				$value=substr($value,0,($len-1));
				mysql_close($this->con);
				return $value;				
			}
			
		//function to fill the select option box with website pages
		function fillComboPages($pathOfPages){
			if(isset($pathOfPages) && !empty($pathOfPages)){
				//echo($pathOfPages);				
				if ($handle = opendir($pathOfPages)) {
					   /* This is the correct way to loop over the directory. */
					   while (false !== ($file = readdir($handle))) { 
						$fileext = substr(strrchr($file, "."), 1);
							if(strtolower($fileext) == "php" || strtolower($fileext) == "txt" || strtolower($fileext) == "css" || strtolower($fileext) == "js" || strtolower($fileext) == "sql"){
							  ?>
                               <option value="<?php echo(substr($file, 0, strlen($file)-strlen($fileext)-1).".".$fileext); ?>">
                               <?php echo(substr($file, 0, strlen($file)-strlen($fileext)-1).".".$fileext); ?>
                               </option>
                              <?php
							}
					   }
					   closedir($handle); 
					}										
				}// end if the path is not empty
			}//end of function
			
		//function to return directory / folder name
		function fillComboDir($pathToDir) {			
			$elements = scandir($pathToDir);
			foreach($elements as $singleEl) {
					$singleEl = str_replace(".","",$singleEl);
					$singleEl = str_replace("_notes","",$singleEl);
					$singleEl = str_replace("indexphp","",$singleEl);
					$singleEl = str_replace("scraps","",$singleEl);	
					$singleEl = str_replace("images","",$singleEl);	
					$singleEl = str_replace("court_Admin","",$singleEl);
					$singleEl = str_replace("courtrar","",$singleEl);				
				 		if($singleEl != ""){
						echo('<option value="'.$singleEl.'">'.$singleEl.'</option>');
						}
					}
			}	
			
		//function autofill / auto complete for two fileds return, grouping fields
		function autoFillGroup($sql,$fld1,$fld2){
			$value = '';
			$this->connect();
			$result = mysql_query($sql,$this->con);
			if(mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_array($result)){
					$value .= '"'.$row[$fld1].' V/S '.$row[$fld2].'",';
					}
			}//end if
			else {
					$value = "";
				}
				return $value;
				mysql_close($this->con);
			}
		//function to get Month Name , Day Name and Year in the 2010, 2012 etc format
		function strFormatDate($date){						
						//remove 0 from day i.e. 01
						/*if(substr($dayInt,0,1) == 0) {*/
							/*echo("true as 0");
							echo("<br>".substr($dayInt,0,1));*/
							/*$dayInt = substr_replace($dayInt,'',0,1);
							}
						*/
								$monthAry["Jan"] = "January";
								$monthAry["Feb"] = "February";
								$monthAry["Mar"] = "March";
								$monthAry["Apr"] = "April";
								$monthAry["May"] = "May";
								$monthAry["Jun"] = "June";
								$monthAry["Jul"] = "July";
								$monthAry["Aug"] = "August";
								$monthAry["Sep"] = "September";
								$monthAry["Oct"] = "October";
								$monthAry["Nov"] = "November";
								$monthAry["Dec"] = "December";
								
								$daysAry["Sat"] = "Saturday";
								$daysAry["Sun"] = "Sunday";
								$daysAry["Mon"] = "Monday";
								$daysAry["Tue"] = "Tuesday";
								$daysAry["Wed"] = "Wednesday";
								$daysAry["Thu"] = "Thursday";
								$daysAry["Fri"] = "Friday";
								
								//return $daysAry[(int)$dayInt]." ".$monthAry[(int)$monthInt]."-".$yearInt;
								$returnDate = date('D-M-Y -H:i:s', strtotime($date));
								$dateAry = explode("-",$returnDate);
								$dayStr = $dateAry[0];
								$monthStr = $dateAry[1];
								$yearInt = $dateAry[2];								
								$dat = $daysAry[$dayStr]." ".$monthAry[$monthStr]." ".$yearInt;								
								return $dat;							
								}
	//function to return date name in urdu format
	function strFormatDateUrdu($date){						
								$monthAry["Jan"] = "جنوری";
								$monthAry["Feb"] = "فروری";
								$monthAry["Mar"] = "مارچ";
								$monthAry["Apr"] = "اپریل";
								$monthAry["May"] = "مئی";
								$monthAry["Jun"] = "جون";
								$monthAry["Jul"] = "جولائی";
								$monthAry["Aug"] = "اگست";
								$monthAry["Sep"] = "ستمبر";
								$monthAry["Oct"] = "اکتوبر";
								$monthAry["Nov"] = "نومبر";
								$monthAry["Dec"] = "دسمبر";
								
								$daysAry["Sat"] = "ہفتہ";
								$daysAry["Sun"] = "اتوار";
								$daysAry["Mon"] = "پیر";
								$daysAry["Tue"] = "منگل";
								$daysAry["Wed"] = "بدھ";
								$daysAry["Thu"] = "جمعرات";
								$daysAry["Fri"] = "جمعہ";
								
								//return $daysAry[(int)$dayInt]." ".$monthAry[(int)$monthInt]."-".$yearInt;
								$returnDate = date('D-M-Y -H:i:s', strtotime($date));
								$dateAry = explode("-",$returnDate);
								$dayStr = $dateAry[0];
								$monthStr = $dateAry[1];
								$yearInt = $dateAry[2];								
								$dat = $daysAry[$dayStr]." ".$monthAry[$monthStr]." ".$yearInt;								
								return $dat;							
								}	
	//function to check the date format
	function checkDate( $value ) {		
		return preg_match('`^\d{1,2}/\d{1,2}/\d{4}$`' , $value );
	}
	
	//short lengthy text but keep php_ini("displays_errors", 0) to void the error notices
	function Left($str,$len)
		{
		$length=strlen($str);
		if ( $len > $length ) $len=$length;
		else if ( $len < 15 ) $new = $str;
		else{
			for ( $i=0; $i<$len; $i++ ){
			$temp[]=$str{$i};
			}
			$new = implode ("",$temp);
			}
			return ($new);
			}
	 //function to chanage date formate to Y-m-d this is for mySql default date format.
     function changerDateFormat($date){
		 $obj = new DateTime($date);
		 $date = $obj->format('Y-m-d');
		 return $date;
		 }
		 
	 //function to chanage date formate to d-m-Y this is for mySql default date format.
     function changerDateFormatY($date){
		 $obj = new DateTime($date);
		 $date = $obj->format('d-m-Y');
		 return $date;
		 }
    //function to get the current url of the page
	function curPageURL() {
		 $pageURL = 'http';
		// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
		}
	//function to return page name only
	function curPageName() {
		 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		}	
	//function to remove the queryString from url
	function remove_querystring_var($url, $key) {
    	$url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
		$url = substr($url, 0, -1);
		return ($url);
	}	
    //function to return the total number of days between two dates
    function dateDiff($start, $end) {
		$start_ts = strtotime($start);
		$end_ts = strtotime($end);
		//$diff = $end_ts - $start_ts;
		return round(abs($start_ts-$end_ts)/60/60/24);
		//return round(($diff / 86400) + 0.5); 
		}
	 //function to set and get hit counter by per session user
	 function hitCounter(){
		 if(!session_start()){ session_start();}
		 $oldVal = $this->getValue("SELECT counterNum FROM counters","counterNum");
		 if(!isset($_SESSION['counter']) || $_SESSION['counter'] < 1){
			 //echo('1');
			 if($oldVal < 1){
				  //echo('2 1');
				 $this->update("UPDATE Counters SET counterNum = 1");
				 $_SESSION['counter'] = 1; //to stop the updation of the counter
				 }
			 else {
				 // echo('2 2');
				  $this->update("UPDATE Counters SET counterNum = counterNum + 1");
				  $_SESSION['counter'] = 1; //to stop the updation of the counter
				 } 
			 }
			return $this->getValue("SELECT counterNum FROM counters","counterNum"); 
		 }
	//function to show global error msg 
	 function errorMsg($msg,$errorInfo,$imgPath="images"){
		 return '<img src="'.$imgPath.'/error.png" style="position:relative; top:5px;" alt="" hspace="5" vspace="0" /> <font class="errFonts"><b>'.$errorInfo.': - </b>'.$msg.'</font>';
		 }
	//function to show global successfully Done msg 
	 function sucMsg($msg,$InfoTxt,$imgPath="images"){
		 return '<img src="'.$imgPath.'/save.png" style="position:relative; top:5px;" alt="" hspace="5" vspace="0" /> <font class="sucFonts"><b>'.$InfoTxt.': - </b>'.$msg.'</font>';
		 }
 
 	//function to check integer value is less than 9 then show it with 0001, 0002....0009, 
	//if > 9 then 0010,...0099, if > 99 then 0100 if > then 999 then 1000
	 function changeNumberFormate($numberToChange){
			 $numberToChange = intval($numberToChange);		 
		 if($numberToChange < 10 && $numberToChange > 0){
			 $this->returnVal = "00000".$numberToChange;
			 }
		 else if($numberToChange > 9 && $numberToChange < 99){
			 $this->returnVal = "0000".$numberToChange;
			 }
		 else if($numberToChange > 99 && $numberToChange < 999){
			 $this->returnVal = "000".$numberToChange;
			 }
		 else if($numberToChange > 999 && $numberToChange < 9999){
			 $this->returnVal = "00".$numberToChange;
			 }
		 else if($numberToChange > 9999 && $numberToChange < 99999){
			 $this->returnVal = "0".$numberToChange;
			 }
		 else{
			 $this->returnVal = $numberToChange;
			  }
			  return $this->returnVal;
		 }
	//function to create shoba combo
	function shobaCmb($cmb,$classCss="frmSelect",$scripts=""){
		$sql = "SELECT sno,shoba FROM shobajaat WHERE is_active = 1 ORDER BY sno ASC";
		$this->connect();
		$options = '<select name="'.$cmb.'" id="'.$cmb.'" class="'.$classCss.'" '.$scripts.'>';
		$options .='<option value=""></option>';
		 $result = mysql_query($sql,$this->con);
		 if(mysql_num_rows($result) > 0) {
				while($row = mysql_fetch_array($result)){
					$options .= '<option value="'.$row['sno'].'"> '. $row['shoba'] .' </option>'.PHP_EOL;
					}					
				}
			else {
					$options = "<option value=''>شعبہ جات خالی ہیں</option>";
				}
				$options .="</select>";
				mysql_close($this->con);
				echo($options);
		}//shobaCmb
		
	//functon to create darajaat combo
	//otherOptions = send javascript events or functions or style commands i.e style="color:#fff;" or onchange="myFunction(this.value);"
	function darjaatCmb($cmbName,$otherOptions="",$classCss="frmSelect"){
		$this->connect();
				$sql = "SELECT sno,shoba FROM shobajaat WHERE is_active = 1 ORDER BY sno ASC";
				echo('<select name="'.$cmbName.'" id="'.$cmbName.'" class="'.$classCss.'" '.$otherOptions.'>');
				echo('<option value=""></option>');
				foreach($this->getRecordSet($sql) as $row1){
					echo('<optgroup label="_'.$row1['shoba'].'" style="color:#369;">'.$row1['shoba']);
					$sqlDarja = "SELECT derjaCode,shoba_sno,darja FROM darjaat WHERE shoba_sno = ".$row1['sno'];
					foreach($this->getRecordSet($sqlDarja) as $row2){
						echo('<option value="'.$row2['derjaCode'].'">_____'.$row2['darja'].'</option>'). PHP_EOL;
						}
						echo('</optgroup>');
					}
				echo("</select>");
				mysql_close($this->con);
			}//darjaatCmb
	}//end class
?>