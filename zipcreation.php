<?php
//include("__lib.includes/config.inc.php");
/*$filesToAdd = array(
                    'img/Chrysanthemum.jpg',
                    'img/Desert.jpg'
                );
$destination = "zip";
$result = create_zip($filesToAdd,$destination);*/

/*$files_to_zip = array(
	'Chrysanthemum.jpg',
    'Desert.jpg'
);*/
//if true, good; if false, zip creation failed
//$destination = "zip";
//$result = create_zip($files_to_zip,$destination.'/my-archive123.zip');


/*if ($result) 
{
	echo "String";
}
else
{
	echo "Faliure";
	//print_r($result);
}*/


/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...



	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}
/*-----------------------------------------------------------------------------------------------------*/
/*$zipArchive = new ZipArchive();
 
//The full path to where we want to save the zip file.
$zipFilePath = 'data/example.zip';
 
//Call the open function.
$status = $zipArchive->open($zipFilePath,  ZipArchive::CREATE);
 
 
//An array of files that we want to add to our zip archive.
//You should list the full path to each file.
$filesToAdd = array(
    'data/image.png',
    'data/test.jpg'
);
 
//Add our files to the archive by using the addFile function.
foreach($filesToAdd as $fileToAdd){
    //Add the file in question using the addFile function.
    $zipArchive->addFile($fileToAdd);
}
 
//Finally, close the active archive.
$zipArchive->close();
 
//Get the basename of the zip file.
$zipBaseName = basename($zipFilePath);
 
//Set the Content-Type, Content-Disposition and Content-Length headers.
header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=$zipBaseName");
header("Content-Length: " . filesize($zipFilePath));
 
//Read the file data and exit the script.
readfile($zipFilePath);
exit;
*/
/*---------------------------------------------------------------------------------------------------*/

/*$filesToAdd = array(
                    'img/checkChrysanthemum.jpg',
                    'img/scheckDesert.jpg'
                );*/
/*$destination = "data";
//$result = create_zip($filesToAdd,$destination);

$files_to_zip = array(
	'img/Desert.jpg'
);
//if true, good; if false, zip creation failed
$result = createZip($files_to_zip,"my-archive.zip");


if ($result) 
{
	echo "String";
}
else
{
	echo "Faliure";
	//print_r($result);
}
*/
/* create a compressed zip file */
/*function createZip($files = array(), $destination = '', $overwrite = false) {


   if(file_exists($destination) && !$overwrite) { return false; }


   $validFiles = [];
   if(is_array($files)) {
      foreach($files as $file) {
         if(file_exists($file)) {
            $validFiles[] = $file;
         }
      }
   }


   if(count($validFiles)) {
      $zip = new ZipArchive();
      if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
         return false;
      }


      foreach($validFiles as $file) {
         $zip->addFile($file,$file);
      }


      $zip->close();
      return file_exists($destination);
   }else{
      return false;
   }
}


$fileName = 'archive.zip';
$files_to_zip = ['img/Desert.jpg', 'img/Jellyfish.jpg'];
$result = createZip($files_to_zip, $fileName);


header("Content-Disposition: attachment; filename=\"".$fileName."\"");
header("Content-Length: ".filesize($fileName));
readfile($fileName);*/

/*--------------------------------------------------------------------------*/
/*
$zip = new ZipArchive();
$zip->open('compressed/font_files.zip', ZipArchive::CREATE);
  
$zip->addFile('img/Desert.jpg', 'img/Jellyfish.jpg');
//$zip->addFile('fonts/Monoton/OFL.txt', 'license.txt');

$fileName = "font_files.zip";  
$zip->close();
header("Content-Disposition: attachment; filename=\"".$fileName."\"");
header("Content-Length: ".filesize($fileName));
readfile($fileName);*/


/*--------------------------------------------------------------------------*/

//
/*$zip = zip_open("test.zip");
if ($zip) {
  while ($zip_entry = zip_read($zip)) {
    echo "<p>Name: " . zip_entry_name($zip_entry) . "<br>";
    // Open directory entry for reading
    if (zip_entry_open($zip, $zip_entry)) {
      echo "File Contents:<br>";
      // Read open directory entry
      $contents = zip_entry_read($zip_entry);
      echo "$contents<br>";
      zip_entry_close($zip_entry);
    }
  echo "</p>";
  }
zip_close($zip);
}*/

?>
