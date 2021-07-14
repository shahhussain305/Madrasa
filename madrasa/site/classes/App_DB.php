<?php
//-----------------------Do not edit the below ----------------------//
require_once('DB.php');
class App_DB extends DB{   
    public function __construct($db_details_ary = array()) {
        try{
            if(isset($db_details_ary) && !empty($db_details_ary)){
                parent::__construct($db_details_ary);                
            }else{
                echo("Invalid User Attempt To Database!");
                exit();
            }
        }catch(Exception $exc){
            $this->tempVar = $exc->getTraceAsString();
        }
    }
    //---------------------Do not edit the above --------------------//

    //function to check integer value is less than 9 then show it with 0001, 0002....0009, 
	//if > 9 then 0010,...0099, if > 99 then 0100 if > then 999 then 1000
	 function changeNumberFormate($numberToChange){
     try{
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
        }catch(Exception $exc){
            $this->tempVar = $exc->getMessage();
        }
    }
    //function to create shoba combo
    function shobaCmb($cmb,$classCss="frmSelect",$scripts=""){
    try{
    $sql = "SELECT sno,shoba FROM shobajaat WHERE is_active = 1 ORDER BY sno ASC";
    $this->connect();
    $options = '<select name="'.$cmb.'" id="'.$cmb.'" class="'.$classCss.'" '.$scripts.'>';
    $options .='<option value=""></option>';
        $result = $this->getRecordSetFilled($sql);
        if(isset($result) && count($result) > 0) {
            foreach($result as $row){
                $options .= '<option value="'.$row['sno'].'"> '. $row['shoba'] .' </option>'.PHP_EOL;
                }					
            }
        else {
                $options = "<option value=''>شعبہ جات خالی ہیں</option>";
            }
            $options .="</select>";
            echo($options);
        }catch(Exception $exc){
            $this->tempVar = $exc->getMessage();
        }
    }//shobaCmb
    
    //functon to create darajaat combo
    //otherOptions = send javascript events or functions or style commands i.e style="color:#fff;" or onchange="myFunction(this.value);"
    function darjaatCmb($cmbName,$otherOptions="",$classCss="frmSelect"){
        try{
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
        }catch(Exception $exc){
            $this->tempVar = $exc->getMessage();
        }
        }//darjaatCmb















   public function getUserInfoAry($sno){
	try{
		return $this->getRecordSetFilled("SELECT * FROM employees WHERE sno = :sno",array(":sno"=>$sno));
		}catch(Exception $exc){
			$this->tempVar = $exc->getMessage();
		}
	}
    

    public function countriesCms(){
        try {
            $country = $this->getRecordSetFilled("SELECT sno,lbl FROM countries WHERE is_active = 1");
            if(count($country) > 0){
                echo('<option value=""></option>');
                foreach($country as $c){
                    echo("<option value='".$c['sno']."'>".$c['lbl']."</option>");
                }
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getProvinceCmb($c_sno){//country sno to filter
        try {
            $country = $this->getRecordSetFilled("SELECT sno,lbl FROM provinces WHERE c_sno = :c_sno AND is_active = 1",array(":c_sno"=>$c_sno));
            if(count($country) > 0){
                echo('<option value=""></option>');
                foreach($country as $c){
                    echo("<option value='".$c['sno']."'>".$c['lbl']."</option>");
                }
            }else{
                echo('<option value="">No Province found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getDivisionsCmb($pr_sno){//province sno to filter
        try {
            $divisions = $this->getRecordSetFilled("SELECT sno,lbl FROM divisions WHERE pr_sno = :pr_sno AND is_active = 1",array(":pr_sno"=>$pr_sno));
            if(count($divisions) > 0){
                echo('<option value=""></option>');
                foreach($divisions as $d){
                    echo("<option value='".$d['sno']."'>".$d['lbl']."</option>");
                }
            }else{
                echo('<option value="">No Division found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getDistrictCmb($div_sno){//division sno to filter
        try {
            $districts = $this->getRecordSetFilled("SELECT sno,lbl FROM districts WHERE div_sno = :div_sno AND is_active = 1",array(":div_sno"=>$div_sno));
            if(count($districts) > 0){
                echo('<option value=""></option>');
                foreach($districts as $d){
                    echo("<option value='".$d['sno']."'>".$d['lbl']."</option>");
                }
            }else{
                echo('<option value="" class="text-danger">No District found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    }

    public function getTehsilsCmb($d_sno){//district sno to filter
        try {
            $tehsils = $this->getRecordSetFilled("SELECT sno,lbl FROM tehsils WHERE d_sno = :d_sno AND is_active = 1",array(":d_sno"=>$d_sno));
            if(count($tehsils) > 0){
                echo('<option value=""></option>');
                foreach($tehsils as $d){
                    echo("<option value='".$d['sno']."'>".$d['lbl']."</option>");
                }
            }else{
                echo('<option value="">No Tehsil found</option>');
            }
        } catch (Exception $exc) {
            $this->tempVar = $exc->getMessage();
        }
    } 
    
//-------------get Configuration data -------------------------
//this will return the array from json encoded array
//to get value from this array: echo($db->getConfVal($_SESSION['config],'sno'));
public function getConfVal($json_array,$columnName,$rowNo=0){
    try{
        $ary = json_decode($json_array,true);
        return $ary[$rowNo][$columnName];
    }catch(Exception $exc){
        $this->tempVar = $exc->getMessage();
    }
}
public function getJsonVal($json_array,$columnName,$rowNo=0){
    try{
        $ary = json_decode("[".$json_array."]",true);
        return $ary[$rowNo][$columnName];
    }catch(Exception $exc){
        $this->tempVar = $exc->getMessage();
    }
}
//-------------------------Other functions --------------------
public function up_coming_meetings($interval_days = 3){
    try{
        //look into case_discussions table for any record with upcoming meetings dates and count it all + return its sno's too
        $snoAry = array();
        $sql = "SELECT sno FROM case_discussions WHERE DATEDIFF(next_date_appointment,DATE(NOW())) < :interval AND case_status = 1";
        $param = array(':interval'=>$interval_days);
        $list = $this->getRecordSetFilled($sql,$param);
        if(count($list) > 0){
            foreach($list as $r){
                $snoAry[] = $r['sno'];
            }
            return $snoAry;
        }else{
            return 0;
        }
    }catch(Exception $exc){
        $this->tempVar = $exc->getMessage();
    }
}

public function getCaseNature($sno){
    try{
        $sql = "SELECT DPEPNature FROM dpepcat WHERE sno  = :sno";
        $param = array(":sno"=>$sno);
        return $this->getValue($sql,$param);
    }catch(Exception $exc){
        $this->tempVar = $exc->getMessage();
    }
}

public function getCaseTotalFee($ins_sno){
    try{
        $ary = array();
        $dtl = $this->getRecordSetFilled("SELECT case_fee_total,finalized_on,emp_sno FROM total_fee WHERE sno = :ins_sno",array(':ins_sno'=>$ins_sno));
        if(count($dtl) > 0){
            foreach($dtl as $f){
                $ary[] = $f;
            }
            return $ary;
        }else{
            return '<a href="javascript:void(0)" class="fancy-url" onclick="addTotalFixedFee('.$ins_sno.');return false;">Add Total Fixed Fee?</a>';
        }
    }catch(Exception $exc){
        $this->tempVar = $exc->getMessage();
    }
}

}//DB()
