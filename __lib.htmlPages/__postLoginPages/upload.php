
<?php
 include '../../__lib.includes/config.inc.php';
    if (!($_SESSION['oPageAccess'])) {
        header('HTTP/1.1 401 Unauthorized');
        header("Location: $CONFIG->siteurl");
        exit;
    }
     //print_r($_SESSION);
if(isset($_POST['btn-upload'])|| ($_POST['submit']))
{    
     
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];

/*$fname =$_POST['fname'];
$lname =$_POST['lname'];
*/$pan =$_POST['pan'];
$aadhaar =$_POST['aadhaar'];
$amount = $_POST['amount'];
/*$email =$_POST['email'];
$mobile =$_POST['mobile'];
*/$description =$_POST['description'];
 $folder="uploads/";
 
 // new file size in KB
 $new_size = $file_size/10240;  
 // new file size in KB
 
 // make file name in lower case
 $new_file_name = strtolower($file);
 // make file name in lower case
 
 $final_file=str_replace(' ','-',$new_file_name);
 
 if(move_uploaded_file($file_loc,$folder.$final_file))
 {
  $sql="INSERT INTO tbl_uploads(file,type,size,amount,pan,aadhaar,user_id,description,upload_date) VALUES ('".$final_file."','".$file_type."','".$new_size."','".intval($amount)."','".$pan."','".intval($aadhaar)."','".$CONFIG->loggedUserId."','".$description."',CURDATE())";
  //"INSERT INTO tbl_uploads(file,type,size,fname,lname,pan,aadhaar,email,mobile,description,upload_date) VALUES('$final_file','$file_type','$new_size','$fname','$lname','$pan','$aadhaar','$email','$mobile','$description',CURDATE())";

  
  $res = $commonFunction->run_the_query($sql);

  //mysqli_query($connection,$sql);
  ?>
  <?php
  if($res == true){
  ?>
  <script type="text/javascript">
            alert("Thanks for Contact us.");
            //window.location.href='index.php';

  </script>
  <?php
    header("location:".$CONFIG->siteurl.'mySaveTax/?module_interface='.$commonFunction->setPage('user')."&submit=submit");  
  }
  else
  {
    echo $sql;
    echo "string";
    //print_r($_SESSION);
    echo "<br>".$res;
  }
  
 }
 else
 {
  ?>
  <script>
    e.preventDefault();
  alert('error while uploading file');
        window.location.href='user.php?fail';
        </script>
  <?php
 }
}
?>