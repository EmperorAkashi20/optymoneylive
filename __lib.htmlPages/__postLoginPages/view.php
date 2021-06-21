
<?php
header('Access-Control-Allow-Origin: *');
include '../../__lib.includes/config.inc.php';    //$pagename = $_GET[page] || $_GET[module_interface];
$_SESSION['oPageAccess'] = 2;


    if (!($_SESSION['UserData']['username'])) {
       // header('HTTP/1.1 401 Unauthorized');
     header("Location: $CONFIG->siteurl");
        exit;
    }
    $folder = $CONFIG->siteurl.$CONFIG->userFilesURL.$CONFIG->helpdesk;

 ?>
 <?php
/*$host_name = "localhost";
$database = "taxnsave_sample"; // Change your database name
$username = "dbuser";          // Your database user id 
$password = "User@123";          // Your password

//error_reporting(0);// With this no error reporting will be there
//////// Do not Edit below /////////

$connection = mysqli_connect($host_name, $username, $password, $database);

if (!$connection) {
    echo "Error: Unable to connect to MySQL.<br>";
    echo "<br>Debugging errno: " . mysqli_connect_errno();
    echo "<br>Debugging error: " . mysqli_connect_error();
    exit;
}*/
?>
<!DOCTYPE html>

<head>
 
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="usrlogin.css">
<link rel="shortcut icon" type="image/png" href="https://test.optymoney.in/static/th_4/img/favicon.png"/>
    <link rel='shortcut icon' type='image/x-icon' href='https://test.optymoney.in/static/th_4/img/favicon.ico' />
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

</style>
</head>
<body>
<div id="body">
   <br>
    <a href="userlogin.php?st=lout">Logout</a>

  
       <br><br><br>
     
 <table width="100%"  border="1">
    <tr>
    <th>Taxation</th>
    <th>Name</th>
    <th>Father Name</th>
    <th>Pan</th>
    <th>Aadhaar / Enrolment No </th>
    <th>Email</th>
    <th>Mobile Number</th>
    <th>Address</th>\
    <th>DOB</th>
    <th>Bank Name</th>
    <th>Account No</th>
    <th>IFSC</th>
    <th>Description</th>
    <th>Amount</th>
    <th>TAX_USERID</th>
    <th>TAX_PWD</th>
    <th>Current Accounts</th>
    <th>Foreign Travel expenses</th>
    <th>Electricity charges</th>
    <th>View</th>
    <th>Status</th>
    </tr>
    <?php
    $sql="SELECT * FROM tbl_uploads";
    $result_set=$commonFunction->fetch_zip_data();
 //$count = count($result_set);
 //print_r($result_set);
 /*die();*/

  while ($res = mysqli_fetch_assoc($result_set)) 
  {
      # code...
  
?>
<tr>
            <td><?php echo $res['itr_e']; ?></td>
            <td><?php echo $res['cust_name']; ?></td>
            <td><?php echo $res['fathers_name']; ?></td>
            <td><?php echo $res['pan']; ?></td>
            <td><?php echo $res['aadhaar']; ?></td>
            <td><?php echo $res['login_id']; ?></td>
            <td><?php echo $res['contact_no']; ?></td>
            <td><?php echo $res['address']; ?></td>
            <td><?php echo $res['dobofusr']; ?></td>
            <td><?php echo $res['bank']; ?></td>
            <td><?php echo $res['acno']; ?></td>
            <td><?php echo $res['ifsc']; ?></td>
            <td><?php echo $res['description']; ?></td> 
            <td><?php echo $res['amount']; ?></td>
            <td><?php echo $res['tax_userid']; ?></td>
            <td><?php echo $res['tax_pwd']; ?></td>
            <td><?php echo $res['c_acnt']; ?></td>
            <td><?php echo $res['f_travel']; ?></td>
            <td><?php echo $res['e_bill']; ?></td>
            <td>
                <?php
                $files = explode('|',$res['file']);
                foreach($files as $file)
                {
                ?>
                    <a href="<?= $folder.$CONFIG->loggedUserId."/" ?><?php echo $file; ?>" download>Download</a>    
                <?php
                }
                ?>
                
            </td>
            <form id="form_1" name="submit_1" method="POST" action="../ajax-request/itr_update.php">
            <td>
                <input type="hidden" name="id" value="<?= $res['id']; ?>">
                <select name="status">
                    <option value="0" <?php if($res['file_status'] == 0){ echo "selected";  } ?> >Pending</option>
                    <option value="1" <?php if($res['file_status'] == 1){ echo "selected";  } ?> >Downloaded</option>    
                    <option value="2" <?php if($res['file_status'] == 2){ echo "selected";  } ?> >Filed</option>
                </select>
                <input type="submit" name="submit_status" value="update">
            </td>
            </form>
        </tr>
        
<?php
    }
 ?>
    </table>
    
</div>


</body>
</html>
 