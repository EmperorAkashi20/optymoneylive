 
<!-- Banner -->
<div class="banner_will">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
                <h1>
                    <center> Calculate your Risk</center>
                </h1>
                <center><span class="span-endline"></span></center>
            </div>
        </div>
    </div>
</div>
<!-- Banner -->

<style >
    h4 {color: darkblue;line-height: 1.3; font-size: 22px;    margin-bottom: 40px; }
</style>
<div class="about-area-one section-spacing">
    <div class="inner-about">
        <div class="container">
            <div class="row about-content">
                <div class="col-lg-12 col-md-12 col-sm-12">
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
                          <div class="radio" id="rg1">
                               <input class="calc" type="radio" name="radio1" value="1">    Sell <br>
                               <input class="calc" type="radio" name="radio1" value="2">    Do nothing <br>
                               <input class="calc" type="radio" name="radio1" value="3">    Buy more <br>
                          </div>
						  </div>  
                          <div class="form-group">
						  <label for="exampleInputEmail1">2.Consider the previous question another way. Your stock dropped 20 percent, but it is part of a portfolio designed to meet investment goals with three different time horizons.</label>
                               <label for="exampleInputEmail1">i.What would you do if your goal were five years away?</label>
						  <div class="radio" id="rg2">
                              <input class="calc" type="radio" name="radio2" value="1">Sell <br>
                              <input class="calc" type="radio" name="radio2" value="2"> Do nothing <br>
                              <input class="calc" type="radio" name="radio2" value="3"> Buy more <br>
                          </div>
						  <label for="exampleInputEmail1">ii.What would you do if the goal were 15 years away?</label>
						  <div class="radio" id="rg3">
                               <input class="calc" type="radio" name="radio3" value="1">Sell <br>
                               <input class="calc" type="radio" name="radio3" value="2"> Do nothing  <br>
                               <input class="calc" type="radio" name="radio3" value="3"> Buy more <br>
                          </div>
						   <label for="exampleInputEmail1"> iii.What would you do if the goal were 30 years away?</label>
						   <div class="radio" id="rg4">
                               <input class="calc" type="radio" name="radio4" value="1"> Sell <br>
                               <input class="calc" type="radio" name="radio4" value="2"> Do nothing<br>
                               <input class="calc" type="radio" name="radio4" value="3">Buy more<br>
                          </div>
						  </div> 
             <div class="form-group">
			 <label for="exampleInputEmail1">3.You have bought a stock as part of your retirement portfolio. Its price rises by 25 percent one month. If the fundamentals of the stock have not changed, what would you do?</label>
			  <div class="radio" id="rg5">
                               <input class="calc" type="radio" name="radio5" value="1"> Sell<br>
                               <input class="calc" type="radio" name="radio5" value="2"> Do nothing<br>
                               <input class="calc" type="radio" name="radio5" value="3">Buy more<br> 
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">4.You are investing for retirement which is 15 years away. What would you do?</label>
			  <div class="radio" id="rg6">
                              <input class="calc" type="radio" name="radio6" value="1">Invest in a money market mutual fund or a guaranteed investment contract<br> 
                              <input class="calc" type="radio" name="radio6" value="2"> Invest in a balanced mutual fund that has a stock: bond mix of 50:50<br>
                              <input class="calc" type="radio" name="radio6" value="3"> Invest in an aggressive growth mutual fund<br>
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">5.As a prize winner, you have been given some choice. Which one would you choose?</label>
			  <div class="radio" id="rg7">
                               <input class="calc" type="radio" name="radio7" value="1">Rs.50,000 in cash<br>
                               <input class="calc" type="radio" name="radio7" value="2">A 50 percent chance to get Rs. 125,000<br>
                               <input class="calc" type="radio" name="radio7" value="3">A 20 percent chance to get Rs. 375,000<br>
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">6.A good investment opportunity has come your way. To participate in it you have to borrow money. Would you take a loan?</label>
			  <div class="radio" id="rg8">
                             <input class="calc" type="radio" name="radio8" value="1">No <br>
                             <input class="calc" type="radio" name="radio8" value="2">Perhaps <br>
                             <input class="calc" type="radio" name="radio8" value="3">Yes <br>
                          </div>
                 </div> 
				 <div class="form-group">
			 <label for="exampleInputEmail1">7.Your company, which is planning to go public after three years, is offering stock to its employees. Until it goes public, you can't sell your shares. Your investment, however, has the potential of multiplying 10 times when the company goes public. How much money would you invest?</label>
			  <div class="radio" id="rg9">
                              <input class="calc" type="radio" name="radio9" value="1">Nothing<br>
                              <input class="calc" type="radio" name="radio9" value="2">Three months' salary<br>
                              <input class="calc" type="radio" name="radio9" value="3">Six months' salary<br>
                          </div>
						 
                 </div> 
				
                </div>
				    </div>
					        
                </div>
				    </div>
					
					<button class="btn btn-info" onclick="calcscore()"id="submit"type="submit">Submit</button>
		
		

	
	</form>
	</div>
	
	<script>
	function calcscore() {
    var score = 0;
    $(".calc:checked").each(function() {
	
        score = score + parseInt($(this).val(), 10);
		$("input[name=sum]").val(score)
		});
		if(score >= "9" && score <= "14")
	{
	
	document.write("your score is" + score + "Points You may be a Conservative  Investor");
            setTimeout("location.href = 'Conservative.html';", 3000);
	}
	else if(score >= "15" && score <= "21")
	{
	
	 document.write("your score is" + score + "Points You may be a Moderate Investor");
            Redirect2()
	} 
	else if(score >= "22" && score <= "27")
	{
	
	  document.write("your score is" + score + "Points You may be a Aggressive  Investor");
           Redirect3()
	} 
	function Redirect1() {

              setTimeout("location.href = 'Conservative.php';", 3000);
            }
			
    function Redirect2() {
                setTimeout("location.href = 'Moderateresult.html';", 3000);
            }
	function Redirect3() {
               setTimeout("location.href = 'Aggressiveresult.html';", 3000);
            }
		
    
    
	
	
	
}


	</script>
	
	
    

	            
	                    </div>
            </div>
        </div>
    </div>
</div>
<div style="height:50px"></div>
	            
               