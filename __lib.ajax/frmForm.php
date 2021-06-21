<?php

include("../__lib.includes/config.inc.php");

$act = $_POST['act'];
$id = $_POST['id'];
$data = "";
$user_id = $CONFIG->loggedUserId;
$tbname = $_POST['table'];
if($_POST['data']!="") {
  foreach ($_POST['data'] as $key => $val) {
    $data.= $key.'="'.$val.'",';
  }
  $data = rtrim($data, ", ");
}
//echo "user_id : ".$act;
if ($act=="getPreview") {
  //$res = $tbname."-".$_POST[for_form]."-".$_POST[row_id];
  $res = $willProfile->getAll($user_id);
} else {
  if ($act=="getBen") {
    //$res = $tbname."-".$_POST[for_form]."-".$_POST[row_id];
    $res = $willProfile->getBenificiary($tbname, $user_id, $_POST['for_table'], $_POST['row_id']);
  } else {
    if($act=="getSingle") {
      $res = $willProfile->getSingleWillInfo($tbname, $_POST['key'], $id);
    } else { 
      if($act=="get") {
        $res = $willProfile->getWillInfo($tbname, $user_id);
      } else{
        if($act=="delete") {
          $res = $willProfile->deleteWillData($tbname, $user_id, $_POST['key'], $_POST['id'], $_POST['dbtable'], $_POST['key_parent'], $_POST['parent_row_id']);
        } else { 
          if($_POST['formType']=="0") {
            $res = $willProfile->updateWillPersonalInfo($tbname, $user_id, $data, $act, $_POST['key'], $id);
          } else {
            $res = $willProfile->willBeneficiaries($tbname, $user_id, $data, $act, $_POST['key'], $_POST['id'], $_POST['dbtable'], $_POST['key_parent'], $_POST['parent_row_id']);
          }
        }
      }
    }
  }
}

echo $res;
die();
?>