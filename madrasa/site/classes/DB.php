<?php
//-------------------------------Do not edit the below ----------------------------//
 require_once('CRUD.php');
 class DB extends CRUD{   
    protected function __construct($db_details_ary = array()) {
        try{
            if(isset($db_details_ary) && !empty($db_details_ary)){
                parent::__construct(base64_decode($db_details_ary["user"]), base64_decode($db_details_ary["key"]), base64_decode($db_details_ary["host"]), base64_decode($db_details_ary["db"]));                
            }else{
                echo("Invalid User Attempt To Database! ::Parent::");
                print_r($db_details_ary);
                exit();
            }
        }catch(Exception $exc){
            $this->tempVar = $exc->getTraceAsString();
        }
    }
    
    //---------------------------------- Do not edit the above ------------------------//




    
}//DB()
