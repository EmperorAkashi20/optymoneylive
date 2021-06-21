<!-- <?php if(!isset($_SERVER['HTTP_REFERER'])){
   // header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
   //exit;
   }
   ?>
   -->
<?php
   header('Access-Control-Allow-Origin: *');
   include '../../__lib.includes/config.inc.php';      //$pagename = $_GET[page] || $_GET[module_interface];
   $_SESSION['oPageAccess'] = 2;
   
   
       if (!($_SESSION['UserData']['username'])) {
          // header('HTTP/1.1 401 Unauthorized');
        header("Location: $CONFIG->siteurl");
           exit;
       }
   
    ?>
<!DOCTYPE html>
<head>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
   <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
   <link rel="stylesheet" href="style.css" type="text/css" />
   <link rel="stylesheet" href="usrlogin.css">
   <link rel="shortcut icon" type="image/png" href="https://optymoney.com/static/th_4/img/favicon.png"/>
   <link rel='shortcut icon' type='image/x-icon' href='https://optymoney.com/static/th_4/img/favicon.ico' />
   <style type="text/css">
      table td, th {
      padding: 5px;
      border: solid #9fa8b0 1px;
      border-collapse: collapse;
      }
      a:link{
      color: green;  
      }
      a:active {
      color: green;
      }
      a:visited {
      color:red;
      }/*Generic*/
      .wrapper{
      margin: 60px auto;
      text-align: center;
      }
      h1{
      margin-bottom: 1.25em;
      }
      /*Specific styling*/
      #content{
      padding: 15px;
      border: solid 1px #eee;
      max-width: 660px;
      margin: auto;
      border-radius: 4px;
      }
      button.dt-button.buttons-excel.buttons-html5 {
      margin-left: 67px;
      }
      input[type="search"] {
      margin-right: 72px;
      }
   </style>
</head>
<body>
   <div id="body">
      <br>
      <a href="userlogin.php?st=lout">Logout</a>
      <br><br><br>
      <center><b><u>EVENT REGISTRATION DETAILS</u></b></center>
      <br>
      <table id="example" class="display" style="width:90%; margin-left:5%; margin-right:5%" border="1">
         <thead>
            <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Mobile Number</th>
               <th>Event Name</th>
               <th>Organization</th>
            </tr>
         </thead>
         <?php
            $result_set=$commonFunction->event_user();
            $count = count($result_set);
            
            
            while ($res = mysqli_fetch_assoc($result_set)) 
            {
                # code...
             
             ?>
         <tr>
            <td><?php echo $res['cust_name']; ?></td>
            <td><?php echo $res['login_id']; ?></td>
            <td><?php echo $res['contact_no']; ?></td>
            <td><?php echo $res['p_code']; ?></td>
            <td><?php echo $res['user_org']; ?></td>
         </tr>
         </form>
         <?php
            //}
            }
            ?>
      </table>
   </div>
</body>
</html>
<script type="text/javascript"> 
   $(document).ready( function() {
   $('#example').DataTable( {
      dom: 'Bfrtip',
      buttons: [ {
          extend: 'excelHtml5',
          autoFilter: true,
          sheetName: 'Event registration details'
      } ]
   } );
   } );
   
</script>