<?php
header('Access-Control-Allow-Origin: *');
include '../../__lib.includes/config.inc.php';   
?>
<!DOCTYPE html>
<html>
<body>

<center><h2 class="title"><b><u>Report Links</u></b></h2></center>


<img src="images/arrow.gif"><a href="<?php echo $CONFIG->siteurl;?>mySaveTax/view.php"> User registration lists through helpdesk </a><br><br> 
<img src="images/arrow.gif"><a href="<?php echo $CONFIG->siteurl;?>mySaveTax/event_users.php"> Event registration report </a><br><br> 
<img src="images/arrow.gif"><a href="<?php echo $CONFIG->siteurl;?>mySaveTax/will_report.php"> Will creation report </a><br><br> 
<img src="images/arrow.gif"><a href="<?php echo $CONFIG->siteurl;?>__lib.htmlPages/__postLoginPages/calculators.php"> ITR Calculator</a><br><br> 
</body>
</html>


<style type="text/css">
	body{width:80%;margin-left: 10%;margin-right:10%;}
    a{    text-decoration: none;
    color: #675f5f;
    font-size: 20px;}
    .title{color: #675f5f;}
</style>
 