<style>
    .table td{
    vertical-align: middle;
    font-size: 0.875rem;
    line-height: 1;
    white-space: normal;
    height: 35px;
    padding: 4px 4px;
}
.table th{

    white-space: normal;
    
}
</style>
 <?php

    include("../__lib.includes/config.inc.php");
    if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
    
    $getPortFolioArr = $mutualFund->portfolioSummary();
    //echo "<pre>";
    //print_r($getPortFolioArr);    
    //foreach($getAcStmtArr as $v)
    //foreach($v as $v1)    { echo "d";print_r($v1);}   
?>

<?php echo $CONFIG->loggedUserName;?>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
 

<table id="tblCustomers" class="tb2excel  table table-bordered table-striped">
    <thead class="thin-border-bottom">
        <tr>
            <th class="text-primary">Scheme/Company</th>
            <th class="text-primary">Date</th>
            <th class="text-primary">Folio</th>
            <th class="text-primary">Purchase</th>
            <th class="text-primary">Switch In</th>
            <th class="text-primary">Dividend Reinvestment</th>
            <th class="text-primary">Sell</th>
            <th class="text-primary">Switch Out</th>
            <th class="text-primary">Balance Unit/No</th>
            <th class="text-primary">Current Value</th>
            <th class="text-primary">Dividend Paid/Interest</th>
            <th class="text-primary">Gain</th>
            <th class="text-primary">Absolute Return %</th>
            <th class="text-primary">XIRR(%)</th>
            
        </tr>
    </thead>
<tbody class="scrollable" data-size="125">   
<?php
    
    $tot_purchase=0;
    $tot_switchin=0;
    $tot_div_reinv=0;
    $tot_sold=0;
    $tot_curr_price=0;
    $tot_divpaid=0;
    $tot_absret=0;
    $tot_gain=0;
    $tot_xirr=0;
    
    while(list($key,$val)=each($getPortFolioArr))
    {
        echo "<tr><td colspan='14'><span class='label label-warning arrowed-right'><strong>".$key."</strong></span></td></tr>";
        while(list($key1,$val1)=each($val))
        {
            echo "<tr><td colspan='14'><span class='label label-inverse arrowed-right'>".$key1."</span></td></tr>";     //print_r($val1);
            while(list($key2,$val2)=each($val1))
            {
                //echo "<pre>".$key2,$val2;print_r($val2);
                echo "<tr><td>".$key2."</td>";
                $purchase_price = 0;
                $switchIn       = 0;
                $divReinvAmt    = 0;
                $sold           = 0;
                $switchOut      = 0;
                $bal_unit       = 0;
                $cur_price      = 0;
                $gain           = 0;
                $absRet         = 0;
                $xirr           = 0;
                $divPaid        = 0;                
                while(list($key3,$val3)=each($val2))
                {
                    //print_r($val3);
                    while(list($key4,$val4)=each($val3))
                    {
                        if($key4 != 0)          // Skip folio number
                        {
                                
                            $purchase_price += $val3[2];
                            $switchIn       += $val3[3];
                            $divReinvAmt    += $val3[4];
                            $sold           += $val3[5];
                            $switchOut      += $val3[6];
                            $bal_unit       += $val3[7];
                            $cur_price      += $val3[8];
                            $gain           += $val3[9];
                            $absRet         += $val3[10];
                            $xirr           += $val3[11];
                            $divPaid        = 100;

                            $tot_purchase       += $val3[2];
                            $tot_switchin       += $val3[3];
                            $tot_div_reinv      += $val3[4];
                            $tot_sold           += $val3[5];
                            $tot_curr_price     += $val3[7];
                            $tot_divpaid        += $val3[9];
                            $tot_absret         += $val3[10];
                            $tot_gain           += $val3[9];
                            $tot_xirr           += $val3[11];                           
                        }
                        else
                            $folio_no = $val3[1];
                            $purchase_date  = $val3[0];
                            
                            //$purchase_date =$val3['purchase_date'];
                                                    
                    }                                       
                }
                echo "<td>".$purchase_date."</td><td>".$folio_no."</td><td>".$purchase_price."</td><td>".$switchIn."</td><td>".$divReinvAmt."</td><td>".$sold."</td><td>".
                     $switchOut."</td><td>".$bal_unit."</td><td>".$cur_price."</td><td>".$divPaid."</td><td>".$gain."</td><td>".$absRet."</td><td>".$xirr."</td>";
                echo "</tr>";
            }
        }   
    }
    echo "<tr style='background-color:#307ecc;color:#ffffff;font-weight:bold;'>";       
    echo "<td>Total</td><td>&nbsp;</td><td>&nbsp;</td><td>".$tot_purchase."</td><td>".$tot_switchin."</td><td>".$tot_div_reinv."</td><td>".$tot_sold."</td>".
         "</td><td>&nbsp;</td><td>".$tot_curr_price."</td><td>".$tot_divpaid."</td><td>".$tot_gain."</td><td>".$tot_absret."</td><td>".$tot_xirr."</td>";
    echo "<td>&nbsp;</td></tr>";        
?>                                  
</tbody>
</table>
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="jquery.table2excel.js"></script>
<script>
$(function() {  
   $(".download").click(function() {  
    $(".tb2excel").table2excel({
                        exclude: ".noExl",
                        name: "Port Folio Summary",
                    filename: "PortfolioSummary",
                    fileext: ".xlsx",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true
                });
   });

});
</script>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
      $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("PortfolioSummary.pdf");
                }
            });
        });
    </script>
