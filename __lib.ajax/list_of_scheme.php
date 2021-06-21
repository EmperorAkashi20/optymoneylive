<?php
	include("../__lib.includes/config.inc.php");
	if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
	
	/* echo "<pre>";
	print_r($_SESSION);//echo $CONFIG->loggedUserId; print_r($_POST);	//
	print_r($_REQUEST);	
	echo "</pre>";  */
	//echo "<pre>";
	//print_r($acStmtArr);			
	//foreach($getAcStmtArr as $v)
	//foreach($v as $v1)	{ echo "d";print_r($v1);}
	$riskType = $_REQUEST['riskType'];
	$sipTAmount = $_REQUEST['sipAmount'];
	// $sipTAmount = 5000;
	
	$eachSIP = round (($sipTAmount/5)) ;
	$roundTotal = $eachSIP * 5 ;
	
	if($riskType < 12){
		$riskId = 1;		
	}else if($riskType == 12){
		$riskId = 2;
	}else if($riskType > 12){
		$riskId = 3;
	}	
	
	$schemeRows = $mfScheme->getSchemesByRiskId($riskId);
	
?>
	<thead>
		<tr>
			<th>#</th>
			<th>Name of Scheme</th>
			<th style="width:100px;">Amount(₹)</th>
			<th>Return</th>
			<th style="text-align: right;">Action</th>
		</tr>
	</thead>

<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
<?php
	//echo "<pre>";
	//print_r($schemeRows);
	//print_r($_SESSION);//echo $CONFIG->loggedUserId; print_r($_POST);	//
	//print_r($_REQUEST);	
	//echo "</pre>";

	while(list($key,$val)=each($schemeRows))
	{
		$id = $key + 1;
		$shStatus = ($val['PORTFOLIO_Type'] == 'PORTF-2' ) ? "style='display:none;' class='rec-$key '" : " class='active rec-$key ' " ;
		$sipAmount = ($val['PORTFOLIO_Type'] == 'PORTF-2' ) ? '' : $eachSIP;
		
		echo "<tr ".$shStatus.">";
		echo "<td><span class='sn'>".$id."</span>.</td>
			<td>".$val['Name_of_Scheme']."<br/><span style='font-size:85%'><strong>Type:</strong> ". $val['SCHEME_Category'] ."</span></td>
			<td><input type='number' min='".$val['MIN_VALUE_OF_SIP_INVESTMENT']."' placeholder='".$val['MIN_VALUE_OF_SIP_INVESTMENT']."'  step='100' value='".$sipAmount."' name='sipamount' class='sipamount' /></td>
			<td>".$val['Return_Since_Launch']."%</td>
			<td align='right'><a class='btn btn-xs delete-scheme' data-id='".$key."'><i class='glyphicon glyphicon-trash'></i></a></span></td>";
		echo "</tr>";
	}
?>
</tbody>
<tfoot class="tbl_posts_foot" id="tbl_posts_foot">
    <tr>
      <td colspan="2" align="right">Total(₹)</td>
      <td colspan="3" align="left" class="schemeTotal"><?php echo number_format((float)($roundTotal), 2 ); ?></td>
    </tr>
</tfoot>