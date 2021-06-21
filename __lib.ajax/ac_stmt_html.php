<style>
    .table {
    margin-bottom: 0;
    width: 1024px;
    .table td{
    vertical-align: middle;
    font-size: 0.875rem;
    line-height: 1;
    white-space: normal;
    height: 35px;
    padding: 5px 5px;
}
.table th{

    white-space: normal;
    
}
</style>
<?php

    include("../__lib.includes/config.inc.php");
    if(!($_SESSION['oPageAccess'])) { header("HTTP/1.1 401 Unauthorized");header("Location: $CONFIG->siteurl");exit;}
    
    $getAcStmtArr = $mutualFund->mfACStmt();
    //echo "<pre>";
    //print_r($acStmtArr);          
    //foreach($getAcStmtArr as $v)
    //foreach($v as $v1)    { echo "d";print_r($v1);}   
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
 
<table id="tblCustomers" class="tb2excel table  table-bordered table-hover">
<thead class="thin-border-bottom">
 
    <tr>
        <th class="text-primary">Purchase Date</th>
        <th class="text-primary">TranType</th>
        <th class="text-primary">NAV</th>
        <th class="text-primary">Amount</th>
        <th class="text-primary">Purchase Price</th>
        <th class="text-primary">Unit / No.</th>
        <th class="text-primary">Balance</th>
    </tr>
</thead>

<tbody class="scrollable" data-size="125">
<?php
    while(list($key,$val)=each($getAcStmtArr))
    {
        echo "<tr><td colspan='8'><span class='label label-warning arrowed-right'><strong>".$key."</strong></span></td></tr>";
        while(list($key1,$val1)=each($val))
        {
            echo "<tr><td colspan='8'><span class='label label-grey arrowed-right'>".$key1."</span></td></tr>";     //print_r($val1);
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="jquery.table2excel.js"></script>
<script>
$(function() {  
   $(".download").click(function() {  
    $(".tb2excel").table2excel({
                        exclude: ".noExl",
                        name: "Account Statement",
                    filename: "AccountStatement",
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
                    pdfMake.createPdf(docDefinition).download("AccountStatement.pdf");
                }
            });
        });
    </script>

