<?php 	
include("__lib.includes/config.inc.php");
$login_id = $_SESSION[$CONFIG->sessionPrefix.'email_id'];
	if($_SESSION[$CONFIG->sessionPrefix.'a_user_id'] !='')
		$retPage = 'secureAdmin/';
	else
		$retPage = '';
		
	$tmp = $_SESSION[$t1];
	$_SESSION=array();
	$tmp = $_SESSION[$t1];
	
	$_SESSION[$CONFIG->sessionPrefix.'page_name']		= '';
	$_SESSION[$CONFIG->sessionPrefix.'loginstatus']		= '';
	$_SESSION[$CONFIG->sessionPrefix.'user_id']			= '';
	$_SESSION[$CONFIG->sessionPrefix.'email_id']			= '';
	$_SESSION[$CONFIG->sessionPrefix.'user_name']		= '';				
	
	$_SESSION[$CONFIG->sessionPrefix.'adminLoginStatus']		= '';
	$_SESSION[$CONFIG->sessionPrefix.'a_user_id']				= '';
	$_SESSION[$CONFIG->sessionPrefix.'a_email_id']				= '';
	$_SESSION[$CONFIG->sessionPrefix.'a_user_name']				= '';
				
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
/*----------------------------------- 20190219-BSEN-START -------------------------------------*/
/*----------------------------------- Update Last Login ---------------------------------*/
global $customerProfile;

$logout_time = $customerProfile->lastlogin($login_id);
// Finally, destroy the session.
if($logout_time){
	session_destroy();
}


/*----------------------------------- 20190219-BSEN-END -------------------------------------*/
/*----------------------------------- Update Last Login ---------------------------------*/
	
	if($_SERVER['HTTP_HOST'] == "localhost")
		{
			
			header("Location: $CONFIG->siteurl".$retPage);
			exit;
		}
		else
		{
			header("Location: $CONFIG->siteurl".$retPage);
			exit;		
		}
?>
