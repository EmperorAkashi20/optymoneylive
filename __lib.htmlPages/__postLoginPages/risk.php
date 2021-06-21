<?php 

	header("Access-Control-Allow-Origin: *");
	include("__lib.includes/config.inc.php"); 
	
	$_SESSION['oPageAccess'] = 1;

	$pagename = strtolower($_GET[page]);				
	if ($pagename == "") {
		$pagename = "home";
		if($_GET['a'] != '' && $_GET['forget_password'] != '')
		{
			$checkRec = $customerProfile->checkVerifyPending($_GET['a'],$_GET['forget_password']);
			if($checkRec == 1) $pagename = "forget_password";
			else $pagename = "home";
		} 
	}
	$_SESSION[$CONFIG->sessionPrefix.'page_name'] = $pagename;
	//print_r($_SESSION);
	//echo $htmlPageSource;		
	$page = $pagename.".php";
?>

  <?php include("__lib.includes/header_includes.inc.php"); ?>
    <body>
    	<div id="preloader"></div>
        <div id="wrapper" class="home-page">
<?php 
	include("__lib.includes/header.inc.php"); 

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
<title>Risk Profile</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon_16.ico"/>
    <link rel="bookmark" href="favicon_16.ico"/>
    <!-- site css -->
 <link rel="stylesheet" href="site.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="dist/js/site.min.js"></script>
  </head>
  <body>
   <div class="jumbotron-contents">
    <h4>To assess your risk tolerance Seven questions are given below. Each question is followed by three, possible answers. Circle the letter that corresponds to your answer.</h4>
    </div>
	<form action="">
  <div class="content-row">
                  <h2 class="content-row-title">
                  </h2>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        
						 <div class="form-group">
						  <label for="exampleInputEmail1">1.Just six weeks after you invested in a stock, its price declines by 20 percent if the fundamentals of the stock have not changed, what would you do? </label>
                          <div class="radio">
                               <input class="calc" type="radio" name="radio1" value="1"> Sell
                               <input class="calc" type="radio" name="radio1" value="2"> Do nothing 
                             <input class="calc" type="radio" name="radio1" value="3">  Buy more 
                          </div>
						  </div>  
                          <div class="form-group">
						  <label for="exampleInputEmail1">2.Consider the previous question another way. Your stock dropped 20 percent, but it is part of a portfolio designed to meet investment goals with three different time horizons.</label>
                               <label for="exampleInputEmail1">i.What would you do if your goal were five years away?</label>
						  <div class="radio">
                              <input class="calc" type="radio" name="radio2" value="1">Sell 
                               <input class="calc" type="radio" name="radio2" value="2"> Do nothing
                              <input class="calc" type="radio" name="radio2" value="3"> Buy more 
                          </div>
						  <label for="exampleInputEmail1">ii.What would you do if the goal were 15 years away?</label>
						  <div class="radio">
                               <input class="calc" type="radio" name="radio3" value="1">Sell
                              <input class="calc" type="radio" name="radio3" value="2"> Do nothing 
                               <input class="calc" type="radio" name="radio3" value="3"> Buy more
                          </div>
						   <label for="exampleInputEmail1"> iii.What would you do if the goal were 30 years away?</label>
						   <div class="radio">
                             <input class="calc" type="radio" name="radio4" value="1"> Sell 
                               <input class="calc" type="radio" name="radio4" value="2"> Do nothing
                                <input class="calc" type="radio" name="radio4" value="3">Buy more
                          </div>
						  </div> 
             <div class="form-group">
			 <label for="exampleInputEmail1">3.You have bought a stock as part of your retirement portfolio. Its price rises by 25 percent one month. If the fundamentals of the stock have not changed, what would you do?</label>
			  <div class="radio">
                              <input class="calc" type="radio" name="radio5" value="1"> Sell
                               <input class="calc" type="radio" name="radio5" value="2"> Do nothing
                               <input class="calc" type="radio" name="radio5" value="3">Buy more 
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">4.You are investing for retirement which is 15 years away. What would you do?</label>
			  <div class="radio">
                              <input class="calc" type="radio" name="radio6" value="1">Invest in a money market mutual fund or a guaranteed investment contract<br> 
                            <input class="calc" type="radio" name="radio6" value="2"> Invest in a balanced mutual fund that has a stock: bond mix of 50:50<br>
                             <input class="calc" type="radio" name="radio6" value="3"> Invest in an aggressive growth mutual fund<br>
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">5.As a prize winner, you have been given some choice. Which one would you choose?</label>
			  <div class="radio">
                               <input class="calc" type="radio" name="radio7" value="1">Rs.50,000 in cash
                              <input class="calc" type="radio" name="radio7" value="2"> A 50 percent chance to get Rs. 125,000
                               <input class="calc" type="radio" name="radio7" value="3">A 20 percent chance to get Rs. 375,000
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">6.A good investment opportunity has come your way. To participate in it you have to borrow money. Would you take a loan?</label>
			  <div class="radio">
<input class="calc" type="radio" name="radio8" value="1">No 
                             <input class="calc" type="radio" name="radio8" value="2">Perhaps 
                             <input class="calc" type="radio" name="radio8" value="3">Yes 
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">7.Your company, which is planning to go public after three years, is offering stock to its employees. Until it goes public, you can't sell your shares. Your investment, however, has the potential of multiplying 10 times when the company goes public. How much money would you invest?</label>
			  <div class="radio">
                             <input class="calc" type="radio" name="radio9" value="1">Nothing
                              <input class="calc" type="radio" name="radio9" value="2">Three months' salary
                              <input class="calc" type="radio" name="radio9" value="3">Six months' salary
                          </div>
						 
                 </div> 
				
                </div>
				    </div>
					        
                </div>
				    </div>
					<p>Total Green Score:
<input type="text" name="sum">

</p>
					<button class="btn btn-info" onclick="calcscore()"id="submit"type="submit">Submit</button>
		
		

	<div class="site-footer">
      
    </div>
	</form>
	<script>
	function calcscore() {
    var score = 0;
    $(".calc:checked").each(function() {
	
        score += parseInt($(this).val(), 10);
		if(score < "14")
	{
	
	 document.write("You will be redirected to main page in 10 sec.");
            Redirect1()
	}
	else if(score >= "14" && score <= "21")
	{
	
	 document.write("You will be redirected to main page in 10 sec.");
            Redirect2()
	} 
	else if(score >= "22" && score <= "27")
	{
	
	 document.write("You will be redirected to main page in 10 sec.");
           Redirect3()
	} 
	function Redirect1() {
               window.location="index.html";
            }
			
    function Redirect2() {
               window.location="http://www.facebook.com";
            }
	function Redirect3() {
               window.location="http://www.twitter.com";
            }
		
    });
    $("input[name=sum]").val(score)
	
	
	
}


	</script>
	
  </body>
</html>
