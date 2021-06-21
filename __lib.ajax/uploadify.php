<?php
	include("../__lib.includes/config.inc.php");
	
// Define a destination
$targetFolder = $CONFIG->adminUploadPath; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . time().str_replace(" ","_",$_FILES['Filedata']['name']);
	
	// Validate the file type
	$fileTypes = array('xls','xlsx','dbf','pdf'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $targetFile;
	} else {
		echo '2';
	}
}
?>