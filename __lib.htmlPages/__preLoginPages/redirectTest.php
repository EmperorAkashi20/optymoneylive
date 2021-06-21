<?php
echo "hi";
//var_dump($_POST);
/*echo json_encode($_POST);
foreach($_POST as $key=>$value) {
  echo "$key=$value";
}*/
//$val = explode($_POST,'');
//die();
header("Location: https://optymoney.com/mySaveTax/?module_interface=cGF5L3BheW1lbnRyZXNwb25zZV9XaWxs&data=".json_encode($_POST));


?>
    