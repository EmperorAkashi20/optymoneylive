<?php

$get_trxn_status = $mutualFund->get_trxn_status();

$cart_id = array_shift($get_trxn_status);
// echo "CART ID:-".$cart_id."<br>";
// echo "get_trxn_status:-";
// print_r($get_trxn_status);
// echo "<br>";
$payment_status = $buySell->payment_status($get_trxn_status);
//echo "Payment Status:-".$payment_status;
$x = $bseSync->p_status($payment_status);
//echo "Payment :-".$x;
if(strpos($x,"NOT")!="") {
   echo "Payment not initiated";
   $PBSEstatus = "fa-times-circle";
   $status1 ="Payment not initiated";
   $status2 ="Please try again";
   //$status3 =  
   $final_page = "cart_sys";
   $final_page_name= "Go to cart";
   $trx_st = '0';
} else {
   //echo "Payment initiated";  
   $PBSEstatus = "fa-check-circle";
   $status1="Payment Initiated. Order Confirmed";
   $status2="Your transaction is confirmed, it will reflect in your statement on next working day.";
   $final_page = "dashboard";
   $final_page_name = "Go to dashboard";
   $trx_st = '1';
}
$db->db_run_query("Update mf_cart_sys set cart_status='".$trx_st."' where mf_cart_id='".$cart_id."'");
//echo "Update mf_cart_sys set cart_status='".$trx_st."' where mf_cart_id='".$cart_id."'";
?>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content" style="background-color: #fff;">
<div class="page-content">
   <!-- end page title end breadcrumb -->
   <div class="row"><br></div>
   <div class="container" style="background-color: #fff;">
      <div class="row"><br></div>
      <div class="text-center"><i class="fa <?= $PBSEstatus ?> fa-5" aria-hidden="true"></i></div>
      <div class="row justify-content-center">
         <h2><?= $status1; ?></h2>
      </div>
      <div class="row justify-content-center">
         <p><?= $status2; ?></p>
      </div>
      <div class="row"><br></div>
      <div class="row"><br></div>
      <!-- <div class="row justify-content-md-center">
         <div class="col-6">
            <b>Your Orders</b>
         </div>
         <div class="col-md-auto">
            <b>Purchase Date: <?php //echo date("d M Y"); ?></b>
         </div>
      </div>
      <br/> -->
      <!-- <div class="row justify-content-md-center">
         <table class="table tblwidth">
            <thead>
               <tr>
                  <td>FUND NAME</td>
                  <td>AMOUNT</td>
                  <td>STATUS</td>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <th>HDFC Balanced Advantage Fund Direct Plan Growth</th>
                  <th>₹500 </th>
                  <th><i class="fa fa-check-circle iconbackclr fasice" aria-hidden="true"></i></th>
               </tr>
            </tbody>
         </table>
      </div>-->
      <div class="row justify-content-center">
         <a href="?module_interface=<?php echo $commonFunction->setPage($final_page); ?>" class="btn btn-primary" style="width: 12%;"><?= $final_page_name; ?></a>
      </div>
   </div>
   <!-- end container-fluid -->
   <!-- end page-content-wrapper -->
</div>
<!-- End Page-content -->
<!-- footer_start -->
<!-- footer_end -->
<!-- end main content-->
