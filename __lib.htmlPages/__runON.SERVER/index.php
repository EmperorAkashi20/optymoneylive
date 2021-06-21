<?php
	include("../../__lib.includes/config.inc.php");
	
	//print_r($_REQUEST);exit;
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	
	require_once('../../__lib.apis/__createPDF/html2pdf.class.php');
	
	if($_REQUEST[page] == "folio_query")
	{
		$getMFList		= $mutualFund->folioQuery($_REQUEST,'');
		$dContent='<table border="0" cellspacing="1" cellpadding="4" align=center  bgcolor="#D8D8D8">
					 <thead>                                                 
						<tr bgcolor="#638EC0" style="font: bold 11px Arial, Helvetica, sans-serif;color: #FFFFFF;text-decoration: none;">
							<th>Scheme</th><th>Folio</th><th>Name</th><th>Original Investor</th><th>PAN</th><th>Mode</th>																
							<th>Address</th><th>Jnt1 Name</th><th>Jnt1 PAN</th><th>Address2</th><th>Address3</th><th>Joint2 Name</th>
							<th>Joint2 PAN</th><th>Nominee1</th><th>Nominee2</th><th>Nominee3</th><th>A/c No.</th><th>A/c Type</th>
							<th>Bank Name</th><th>Bank Branch</th><th>UCC</th><th>IIN</th><th>BSECode</th><th>NSECode</th>
							<th>FTFolio</th>							
						</tr>
					</thead>
				<tbody>';
		if(in_array('MF_NONE',$getMFList))
			$dContent .= '<tr><td class="center red" colspan="9"> No Row(s) Found.</td></tr>';
		else
		{
			while(list($logKey,$logVal) = each($getMFList))
			{		
				if($bgcolor=="#FFFFFF") $bgcolor="#F6F6F6";
				else $bgcolor="#FFFFFF";
				
				$dContent .= '<tr bgcolor = '.$bgcolor.' style="font-family: Arial, Helvetica, sans-serif;font-size: 11px;font-weight: normal;color: #474747; 
								text-decoration: none;">
            					<td>'.str_replace('"','',$logVal[scheme_name]).'</td>
								<td>'.str_replace('"','',$logVal[folio_no]).'</td>
								<td>'.str_replace('"','',$logVal[client_name]).'</td>
								<td>'.str_replace('"','',$logVal[original_investor]).'</td>
								<td>'.str_replace('"','',$logVal[pan_no]).'</td>
								<td>'.str_replace('"','',$logVal[mode]).'</td>
								<td>'.str_replace('"','',$logVal[address1]).'</td>
								<td>'.str_replace('"','',$logVal[jnt1_Name]).'</td>
								<td>'.str_replace('"','',$logVal[jnt1_pan]).'</td> 
								<td>'.str_replace('"','',$logVal[Address2]).'</td>
								<td>'.str_replace('"','',$logVal[Address3]).'</td>
								<td>'.str_replace('"','',$logVal[jnt2_name]).'</td>
								<td>'.str_replace('"','',$logVal[jnt2_pan]).'</td>
								<td>'.str_replace('"','',$logVal[nominee1]).'</td>
								<td>'.str_replace('"','',$logVal[nominee2]).'</td>
								<td>'.str_replace('"','',$logVal[nominee3]).'</td>
								<td>'.str_replace('"','',$logVal[ac_no]).'</td>
								<td>'.str_replace('"','',$logVal[ac_type]).'</td>
								<td>'.str_replace('"','',$logVal[bank_name]).'</td>
								<td>'.str_replace('"','',$logVal[bank_branch]).'</td>
								<td>'.str_replace('"','',$logVal[ucc]).'</td>
								<td>'.str_replace('"','',$logVal[iin]).'</td>
								<td>'.str_replace('"','',$logVal[bsecode]).'</td>
								<td>'.str_replace('"','',$logVal[nsecode]).'</td>
								<td>'.str_replace('"','',$logVal[ftfolio]).'</td>
							</tr>';
			}
			$dContent .= '</tbody></table>';	
		}
		
		if($_REQUEST[export_type] == "pdf")
		{
			$cardTextContent = addslashes(strip_tags($dContent));
			$tmpFilename = $CONFIG->wwwroot.'__tmp.Generated.Files/'.time().'.pdf';
			try
			{
				$html2pdf = new HTML2PDF('L','A4','en', false, 'ISO-8859-15');
				$html2pdf->writeHTML($dContent);
				$html2pdf->Output($tmpFilename,'F');
			}
			catch(HTML2PDF_exception $e) { echo $e; }		
			if(file_exists($tmpFilename))
			{
				header("Content-Type: application/pdf");    
				header("Content-Disposition: attachment; filename=folio_query.pdf");  
				header("Pragma: no-cache"); 
				header("Expires: 0");
				$dContent=file_get_contents($tmpFilename);
				echo $dContent;	
				unlink($tmpFilename);
			}	
		}
		else
		{
			header("Content-Type: application/xls");    
			header("Content-Disposition: attachment; filename=folio_query.xls");  
			header("Pragma: no-cache"); 
			header("Expires: 0");

			echo $dContent;	
		}
		exit;
	}
	if($_REQUEST[page] == "ac_stmt_user")
	{
		header("Content-Type: application/xls");    
		header("Content-Disposition: attachment; filename=ac_stmt.xls");  
		header("Pragma: no-cache"); 
		header("Expires: 0");
		$getAcStmtArr = $mutualFund->mfACStmt();
?>
        <table class="table  table-bordered table-hover" border="1">
        <thead class="thin-border-bottom">
            <tr>
                <th>Purchase Date</th>
                <th>TranType</th>
                <th>Purchase Price</th>
                <th>Amount</th>
                <th>Unit / No.</th>
                <th>Balance</th>
            </tr>
        </thead>        
        <tbody class="scrollable" data-size="125">
<?php
		while(list($key,$val)=each($getAcStmtArr))
		{
			echo "<tr><td colspan='6'><span class='label label-warning arrowed-right'><strong>".$key."</strong></span></td></tr>";
			while(list($key1,$val1)=each($val))
			{
				echo "<tr><td colspan='6'><span class='label label-grey arrowed-right'>".$key1."</span></td></tr>";		//print_r($val1);
				while(list($key2,$val2)=each($val1))
				{
					//echo $key2,$val2;print_r($val2);
					echo "<tr>";
					while(list($key3,$val3)=each($val2))
					{
						echo "<td>".$val3."</td>";
					}
					echo "</tr>";
				}
			}	
		}
?>
        </tbody>
        </table>
<?php		
	}
	
	exit;
?>