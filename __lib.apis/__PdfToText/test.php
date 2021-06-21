<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include ( 'PdfToText.phpclass' ) ;

$pdf 	=  new PdfToText ( 'sample.pdf' ) ;
echo   "<pre>";
$a=$pdf -> Text ;
//print_r( str_word_count(strtolower(str_replace("'","",str_replace("`","",$a))), 1,"0..3")); 
echo $a; 		// or you could also write : echo ( string ) $pdf ;
?>
</body>
</html>
