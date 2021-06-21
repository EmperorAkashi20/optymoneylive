<?php 
	header("Access-Control-Allow-Origin: *");
	include("__lib.includes/config.inc.php"); 
	$_SESSION['oPageAccess'] = 1;
  $pagename = strtolower($_GET['page']);
  $CONFIG->pageName = $pagename;
  if ($pagename == "" || $pagename == "index") {
		$pagename = "home";
	}
	$_SESSION[$CONFIG->sessionPrefix.'page_name'] = $pagename;
  $_SESSION[$CONFIG->sessionPrefix.'c_page'] = $pagename;
	$page = $pagename.".php";
  $_SESSION[$CONFIG->sessionPrefix.'pre_login_pg'] = $page;
  if($_SESSION[$CONFIG->sessionPrefix.'loginstatus']){
    header("Location: ".$CONFIG->siteurl."mySaveTax/");
  }
?>
<!doctype html>
<html class="no-js" lang="en">
  <?php  include("__lib.includes/header_includes.inc.php"); ?>
  <body class="<?php if($pagename == 'home' || $pagename == 'empanel'){echo "homepage"; } if($pagename == 'all_product'){ echo "allproducts"; } if($pagename == 'termsofuse' || $pagename == 'faq' || $pagename == 'privacypolicy' || $pagename == 'mfcategories' || $pagename == 'about' ){ echo "after_login"; } ?>">
    <?php 
      if ($header = 1) { include("__lib.includes/leftbar.inc.php");  }      
    ?>
    <div id="wrapper" class="home-page">
    <?php 
      include('__lib.htmlPages/__preLoginPages/'.$page);
      if($footer != "1") { 
        include("__lib.includes/footerlink.inc.php");  
      }
      include("__lib.includes/footer.inc.php"); 
      include("__lib.includes/login.php"); 
    ?>
    </div>
  </body>
</html>