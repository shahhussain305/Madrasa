 <?php
//-------Display page errors------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//-----------------Importing Required Libraries-----------------------------
require_once("../classes/App_DB.php");
require_once("../classes/DbPathsArray.php");
require_once("../classes/MyMethods.php");
require_once('../classes/Hijri_GregorianConvert.php');
require_once("../includes/configuration.php");
//-Creating Object and passing user info to the constructor of App_DB class-
$db = new App_DB(DBU::$dba_user);//passing database login details from DbPathArray.php file
$method = new MyMethods();$hijri = new Hijri_GregorianConvert();
if($method->is_session_started() === FALSE){ session_start();}
require_once('../includes/security.php');