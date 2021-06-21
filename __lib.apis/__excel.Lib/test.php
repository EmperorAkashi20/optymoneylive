<?php
/**
  Description: Export Excel file to CSV using PHPExcel library.
 
  References:
        http://stackoverflow.com/questions/3895819/csv-export-import-with-phpexcel
        http://stackoverflow.com/questions/9695695/how-to-use-phpexcel-to-read-data-and-insert-into-database
        http://stackoverflow.com/questions/6346314/phpexcel-will-not-export-to-csv
 **/
 
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
 
// Path to PHPExcel classes
require_once 'PHPExcel/PHPExcel.php';
require_once 'PHPExcel/PHPExcel/IOFactory.php';
require_once('PHPExcel/PHPExcel/Writer/CSV.php');

// Your input Excel file.
$excelFile = '1516778987201TR49_karvy.xlsx';
 
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
 ini_set('max_execution_time', 2000);
 ini_set('memory_limit', '181M'); 
//  Read your Excel workbook
try 
{
    $inputFileType = PHPExcel_IOFactory::identify($excelFile);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($excelFile);
}
catch(Exception $e)
{
    die('Error loading file "'.pathinfo($excelFile,PATHINFO_BASENAME).'": '.$e->getMessage());
}

// Export to CSV file.
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setUseBOM(true);   // Select which sheet.
//$objWriter->setDelimiter(',');  // Define delimiter
$objWriter->save('testExportFile.csv');
 
echo "done";



/*
//Various excel formats supported by PHPExcel library
$excel_readers = array(
    'Excel5' , 
    'Excel2003XML' , 
    'Excel2007'
);

require_once('PHPExcel180/Classes/PHPExcel.php');
require_once('PHPExcel180/Classes/PHPExcel/Writer/CSV.php');

$reader = PHPExcel_IOFactory::createReader('Excel5');
$reader->setReadDataOnly(false);

$path = 'file.xls';
$excel = $reader->load($path);

$writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
$writer->setUseBOM(true);
$writer->save('data.csv');

echo 'File saved to csv format';

*/
?>

