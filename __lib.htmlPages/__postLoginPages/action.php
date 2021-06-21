

<?php 
session_start(); /* Starts the session */
/* Check Login form submitted */
if(isset($_POST['submit'])){
/* Define username and associated password array */
$logins = array('Taxnsave' => 'doc@taxnsave','usertaxsave' => 'passwordtaxsave','username2' => 'password2');

/* Check and assign submitted Username and Password to new variable */
$Username = isset($_POST['username']) ? $_POST['username'] : '';
//echo "Username:-".$Username."<br>";
$Password = isset($_POST['password']) ? $_POST['password'] : '';
//echo "Password:-".$Password."<br>";


/* Check Username and Password existence in defined array */
if (isset($logins[$Username]) && $logins[$Username] == $Password){
/* Success: Set session variables and redirect to Protected page  */
$_SESSION['UserData']['username']=$Username;
//echo "username".$_SESSION['UserData']['username'];
//die();
header("location:links.php");
exit;
} 
else 
{
/*Unsuccessful attempt: Set error message */
header("location:userlogin.php?error=error");
}
}
?>