<?php 
ob_start();
session_start();
?>
<?php 
//-------Display page errors------------------------------------------------
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            //-----------------Importing Required Libraries-----------------------------
            require_once("site/classes/App_DB.php");
            require_once("site/classes/DbPathsArray.php");
			require_once("site/classes/MyMethods.php");
			require_once('site/classes/Hijri_GregorianConvert.php');

            //-Creating Object and passing user info to the constructor of App_DB class-
            $db = new App_DB(DBU::$dba_user);//passing database login details from DbPathArray.php file
			$method = new MyMethods();$hijri = new Hijri_GregorianConvert();
 ?>
<html !DOCTYPE=html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Authorized Users Only </title>
<script language="javascript" type="text/javascript">
function showdeadcenterdiv() { 
var centerX, centerY; 
var o=document.getElementById('dragDiv2');
var r=o.style; 
try{
	if( self.innerHeight ) { 
		centerX = self.innerWidth; 
		centerY = self.innerHeight; 
		} 
	else if( document.documentElement && document.documentElement.clientheight ) { 
		centerX = document.documentElement.clientWidth; 
		centerY = document.documentElement.clientheight; 
		} 
	else if( document.body ) { 
		centerX = document.body.clientWidth; 
		centerY = document.body.clientheight; 
		}
	//div width	
	var leftOffset = (centerX - 445) / 2; 
	// div height  
	var topOffset = (centerY - 190) / 2; 	 
	
	r.position='absolute'; 
	r.top = topOffset + 'px'; 
	r.left = leftOffset + 'px'; 
	r.display = "block"; 
}catch(e){
	//if ie 7 error
	r.position='absolute'; 
	r.top = 200 + 'px'; 
	r.left = 300 + 'px'; 
	r.display = "block"; 
	//alert(e.descriptions);
	}
} 
</script>
<script type="text/javascript" src="site/js/jquery-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript" src="site/js/jquery.dragndrop.js"></script>
<style>
       .dragDiv2 {
        	background-color:#F0FBEB;
            border:1px solid #9BDF70;
        	width:445px;
			height:215px;
			border-radius:8px;        
        	}
        .dragDiv2 h5 {
        	background-color:#C2ECA7;
        	padding:5px;
            margin:1px;
            }
        .dragDiv2 div {
        	padding:5px;
        	margin-bottom:10px;
            }
		.errFont {
			font-size:12px;
			color:#F00;
			font-family:Tahoma, Geneva, sans-serif;
			}
</style>
<script type="text/javascript">
        $().ready(function() {
            $('.dragDiv2').Drags({
                handler: '.handler2', 
                zIndex:200,
                opacity:.9
            }); 
        });
    </script>
<?php 
	$format="YYYY/MM/DD";
	$date=date("Y/m/d");
	$yearHijri = $hijri->GregorianToHijri($date,$format);
	?>
</head>
<body style="background-color:#000000; background:url(site/images/bg/1.jpg) center top fixed;" onLoad="showdeadcenterdiv();">
<div class="dragDiv2" id="dragDiv2">
    <h5 class="handler2"> ADMINISTRATION LOGIN &nbsp;&nbsp;&nbsp;
    <?php if(isset($_REQUEST['loginBtn'])){ 
					if(isset($_REQUEST['admin']) && !empty($_REQUEST['admin']) && 
					   isset($_REQUEST['userkey']) && !empty($_REQUEST['userkey'])){
						$userid = $_REQUEST['admin'];
						$key = $_REQUEST['userkey'];
						$hijri_dat = isset($_REQUEST['dat']) && !empty($_REQUEST['dat'])?$_REQUEST['dat']:date('d-m-Year');
						$sql = "Select * from login where userid = :userid AND userkey= :userkey";
						$ary = array(':userid'=>$userid,':userkey'=>$key);
						if($db->dbQuery($sql,$ary)){
							$_SESSION['userid'] = addslashes($userid);
							$_SESSION['key'] = addslashes($key);
							$_SESSION['hijri'] = addslashes($hijri_dat);
							header("Location: site/index.php");
							}
						else{
							?>
                            [<span class="errFont"><b>Error: - </b> Authentication Failed </span>]
                            <?php
							}
						}//end if textfields check
						else{
							?>
                            [<span class="errFont"><b>Error:- </b> Please fill out all the fields.</span>]
                            <?php
							}//end else for fields check
							} ?>
                            </h5>
    <div class="content2">
        <form method="post" action="index.php">         
        <table width="400" class="loginTbl" cellpadding="5" cellspacing="3" border="0">
            <tr height="20">
                <td> Administrator </td>
                <td> <input type="text" name="admin" id="admin" autofocus="autofocus" /> </td>
            </tr>
            <tr>
                <td> Password </td>
                <td> <input type="password" name="userkey" /></td>
            </tr>
            <tr>
                <td> Set Date </td>
                <td> <input type="text" name="dat" id="dat" value="<?php echo($yearHijri); ?>" /> </td>
            </tr>
            <tr>
                <td colspan="2" align="center"> 
                <input type="submit" name="loginBtn" class="btn" value="Login" /> 
                </td>
            </tr>
        </table>
        </form>    
    </div>
</div>
</body>
</html>
<?php ob_flush(); ?>