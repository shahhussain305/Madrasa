<?php //SG class provides a very quick static methods to return website's required Paths, URL etc
class SG{
	public $sgVar;
	public static $para_class = ' style="line-height:40px !important;border:1px solid #07BC21;padding:6px;border-radius:5px;font-family:"book antiqua";font-size:14px;"';
	public static $casetitle_class = ' style="text-align:center;text-decoration:underline;color:#E30A0D;font-family:"book antiua";font-size:20px;"';
	//this method will return only the base url of the website like : 
	//http://xyz.com/sub_dir/sub_dir/index.php => will be http://xyz.com
	public static function getBaseUrl(){
			try{
				if(isset($_SERVER['HTTPS'])) {
					return 'https://'.$_SERVER['SERVER_NAME'];
					} 
				else {
					return 'http://'.$_SERVER['SERVER_NAME'];
					}
				}catch(Exception $exc){
					$sgVar = $exc->getMessage();  
					return false;
					}
			}
        //get base url by passing parameter like this: echo($_SERVER['SERVER_NAME']);
        public static function getUrl($url){
            try {
                $ary = parse_url($url);
                return $ary['path'];
            } catch (Exception $exc) {
                $sgVar = $exc->getMessage();
                return false;
            }
                }
	//get name of the page in the url e.g: http://xyz.com/sub_dir/sub_dir/etc/index.php => index.php
	public static function getPageName(){
		try{
			 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
			}catch(Exception $exc){
				$sgVar = $exc->getMessage();  
				return false;
				}
		}
	//create parameterized static function for bootstrap panels to start 
	//parameter list: $panelOpt = 'p'|'d'|'dd'|'s' => p=primary, d=danger, dd=default, s=success
	public static function startPanel($panelOpt='p',$panelHeading="",$icon="",$cssClass=""){
		try{
			$panelOption = "";
			switch($panelOpt){
				case 'p':
						$panelOption = "panel-primary";
					break;
				case 'd':
						$panelOption = "panel-danger";
					break;
				case 'dd':
						$panelOption = "panel-default";
					break;
				case 's':
						$panelOption = "panel-success";
					break;
				default:
						$panelOption = "panel-default";
					break;
				}
				if(isset($icon) && !empty($icon) && !ctype_space($icon)){
					$icon = "<span class='glyphicon glyphicon-".$icon."'></span>";
					}
				$panel = '
							<div class="panel '.$panelOption.'">
								<div class="panel-heading">'.$icon.' '.$panelHeading.'</div>
								<div class="panel-body '.$cssClass.'">							
						';
					echo($panel);
			}catch(Exception $exc){
			$sgVar = $exc->getMessage();  
			return false;	
			}		
		}
	//function to end the above panel 
	public static function endPanel(){
		try{
			echo("</div></div>");
			}catch(Exception $exc){
			$sgVar = $exc->getMessage();  
			return false;
			}
		}
	//bootstrap 4 cards equal to panels, in $extra_classes if required send extra classes like "bg-success text-white" etc
	public static function startPanel2($header="",$extra_classes=array("card_bg"=>"bg-success","body_fgColor"=>"text-dark","body_bg"=>"white-bg","body_hight"=>"body-hight","fgColor"=>"text-white")){
		echo('<div class="card '.$extra_classes["card_bg"].' '.$extra_classes['fgColor'].'">');
			if(isset($header) && !empty($header)){ echo('<div class="card-header">'.$header.'</div>');}
				echo('<div class="card-body '.$extra_classes["body_hight"].' '.$extra_classes["body_bg"].' '.$extra_classes["body_fgColor"].'">');
	}
	public static function endPanel2($footer=""){
		if(isset($footer) && !empty($footer)){ echo('<div class="card-footer">'.$footer.'</div>');}
		echo("</div>");
	}
	//show footer of the page in bootstrap 4
	public static function footer($footer=""){
		echo('<div class="text-right">
				<p>'.$footer.'</p>
	  		 </div>');
	}
	//check if session has not started in page then start
	public static function handle_session(){
		try{
			if(session_status() == PHP_SESSION_NONE) {
					session_start();
				}
			}catch(Exception $exc){
			$sgVar = $exc->getMessage();  
			return false;	
			}
		}


}//end of class