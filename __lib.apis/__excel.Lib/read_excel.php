<?php

insertInvoiceIntoDB($invoiceFilename);

function insertInvoiceIntoDB($getFilename)
{
	global $sq,$_SESSION;

	// [0] => Array ( [1] => Invoice No. [2] => Invoice Date [3] => PO No. [4] => CFA Code [5] => Region [6] => Customer Code [7] => Customer Cat Code
	//echo "dd".$getFilename;
	$decideArr = explode("/",$getFilename);
	//print_r($decideArr);
	$getFileTypeExcel = explode(".",$decideArr[(count($decideArr)-1)]);
	//print_r($getFileTypeExcel);
	if(in_array("xls",$getFileTypeExcel))
	{
		//echo "dd";
		include 'excel-read.class.php';
		$excel = new ExcelReader($getFilename,"");

		$xlsx = $excel->getWorksheetData('Sheet1');
		//var_dump($xlsx);

		//$totalRowsArr = $xlsx->getWorksheetList() ;
		//print_r($xlsx);	
		require_once 'PHPExcel/PHPExcel.php';
		require_once 'PHPExcel/PHPExcel/Reader/Excel5.php';
		
		$objReader = new PHPExcel_Reader_Excel5();
		$objReader->setReadDataOnly(true);
		$objReader->setLoadAllSheets();
		$objPHPExcel = $objReader->load($getFilename);
		
		$sheet_names = $objPHPExcel->getSheetNames();
		$num_sheets = count($sheet_names);
		for ($s = 0; $s < $num_sheets; ++$s) {
			$current_sheet = $objPHPExcel->getSheet($s);
		
			$num_rows = $current_sheet->getHighestRow();
			$num_cols = PMA_getColumnNumberFromName($current_sheet->getHighestColumn());
			
			if ($num_rows != 1 && $num_cols != 1) {
				for ($r = 1; $r <= $num_rows; ++$r) {
					for ($c = 0; $c < $num_cols; ++$c) {
						$cell = $current_sheet->getCellByColumnAndRow($c, $r)->getCalculatedValue();
						
						if (! strcmp($cell, '')) {
							$cell = 'NULL';
						}
						
						$tempRow[] = $cell;
					}
		
					$rows[] = $tempRow;
					$tempRow = array();
				}
				
				if ($_REQUEST['xls_col_names']) {
					$col_names = array_splice($rows, 0, 1);
					$col_names = $col_names[0];
					for ($j = 0; $j < $num_cols; ++$j) {
						if (! strcmp('NULL', $col_names[$j])) {
							$col_names[$j] = PMA_getColumnAlphaName($j + 1);
						}
					}
				} else {
					for ($n = 0; $n < $num_cols; ++$n) {
						$col_names[] = PMA_getColumnAlphaName($n + 1);
					}
				}

				$tables[] = array($sheet_names[$s], $col_names, $rows);				
				$col_names = array();
				$rows = array();
			}
		}
		$totalRowsArr = $tables[0][2];
		unset($objPHPExcel);
		unset($objReader);
		unset($rows);
		unset($tempRow);
		unset($col_names);
	}
	else
	{
		include 'simplexlsx.class.php';
		$xlsx = new SimpleXLSX($getFilename);	
		$totalRowsArr = $xlsx->rows() ;
	}
	//echo "<pre>";
	//print_r( $totalRowsArr );	
	//exit;
	//echo "<br><br><br><br><br>";
	$count=1;
	
	while(list($key,$val) = each($totalRowsArr))
	{
		if($key > 0 )						// Skip First Row
		{
			//echo "<br>";
			//echo $val[0];
			//print_r($val);exit;
			if($val[0] !='')
			{
				$dateArr = explode("/",$val[1]);
				$invoiceNumber   = $val[0];
				$invoiceDate     = date("Y-m-d",strtotime($dateArr[2]."-".$dateArr[1]."-".$dateArr[0]));
				$poNumber 	     = $val[2];
				$cfaCode	     = $val[3];
				$region		     = $val[4];
				$customerCode    = $val[5];
				$customerCatCode = $val[6];
				
				$chkInvoice = mysql_query("SELECT * FROM kl_ext_invoice WHERE invoice_number = '".$invoiceNumber."' AND `fr_customer_id`='".$_SESSION["customer_id"]."'");
				
				$sql_contant	= "INSERT INTO kl_ext_invoice SET
								 `fr_customer_id`='".$_SESSION["customer_id"]."', 
								`invoice_number`='$invoiceNumber',
								`invoice_date`='".$invoiceDate."',
								`po_number`='$poNumber',
								`cfa_code`='$cfaCode',
								`region`='".$region."',
								`customer_code`='".$customerCode."',
								`customer_cat_code`='".$customerCatCode."',
								`invoice_upload_date`= now(),
								`invoice_upload_by`='".$_SESSION["smeid"]."'";
				
				if(mysql_num_rows($chkInvoice) == 0)	
				{			
			   		$sq->query($sql_contant);
				}
				else
				{
					$sql_contant	= "UPDATE kl_ext_invoice SET									
									`invoice_date`='".$invoiceDate."',
									`po_number`='".$poNumber."',
									`cfa_code`='".trim($cfaCode)."',
									`region`='".$region."',
									`customer_code`='".$customerCode."',
									`customer_cat_code`='".$customerCatCode."',
									`invoice_upload_date`= now(),
									`invoice_upload_by`='".$_SESSION["smeid"]."' 
									WHERE `invoice_number`='".$invoiceNumber."'";
					$sq->query($sql_contant);
				}
				//echo $sql_contant."<BR><BR><BR><BR>";
			}
		}
	}	
}
//exit;
function PMA_getColumnNumberFromName($name) {
    if (!empty($name)) {
        $name = strtoupper($name);
        $num_chars = strlen($name);
        $column_number = 0;
        for ($i = 0; $i < $num_chars; ++$i) {
		// read string from back to front
		$char_pos = ($num_chars - 1) - $i;

		// convert capital character to ASCII value
		// and subtract 64 to get corresponding decimal value
		// ASCII value of "A" is 65, "B" is 66, etc.
		// Decimal equivalent of "A" is 1, "B" is 2, etc.
		$number = (ord($name[$char_pos]) - 64);

		// base26 to base10 conversion : multiply each number
		// with corresponding value of the position, in this case
		// $i=0 : 1; $i=1 : 26; $i=2 : 676; ...
		$column_number += $number * pow(26,$i);
        }
        return $column_number;
    } else {
        return 0;
    }
}

function PMA_getColumnAlphaName($num)
{
	$A = 65; // ASCII value for capital "A"
	$col_name = "";

	if ($num > 26) {
		$div = (int)($num / 26);
		$remain = (int)($num % 26);

		// subtract 1 of divided value in case the modulus is 0,
		// this is necessary because A-Z has no 'zero'
		if ($remain == 0) {
			$div--;
		}

		// recursive function call
		$col_name = PMA_getColumnAlphaName($div);
		// use modulus as new column number
		$num = $remain;
	}

	if ($num == 0) {
		// use 'Z' if column number is 0,
		// this is necessary because A-Z has no 'zero'
		$col_name .= chr(($A + 26) - 1);
	} else {
		// convert column number to ASCII character
		$col_name .= chr(($A + $num) - 1);
	}

	return $col_name;
}

?>