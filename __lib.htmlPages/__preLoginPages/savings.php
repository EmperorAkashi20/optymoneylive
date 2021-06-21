 

<!-- Banner -->
<div class="banner_will">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
        <h1><center>Small Savings today leads to a big Gain</center><br> <center><span class="span-end">  </center></h1>
        <center><span class="span-endline"> </center>
      </div>
      
    </div>
  </div>
</div>
<!-- Banner -->
<body>
<div class="page-contact-us-area section-spacing">
          <div class="container">
            <!--<div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="google-map-area">
                  <div id="googleMap" style="width:100%; height:424px;"></div>
                </div>
              </div>
            </div>-->
            <div class="col-md-12">
            <div class="row">
 <p class="title-p" style="text-align: center;"> <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme; ?>img/money.png" width="406" height="49"></p>
 
<p><strong> Beware of little expenses; a small leak will sink a great ship.&nbsp; </strong></p>
<p><strong> -Benjamin Franklin </strong></p>
<p> </p>
<p> If you don&rsquo;t earn much and you can barely pay your bills, the idea of saving money might seem laughable. When you only have $5 left at the end of the month, why even bother to try saving? Because everyone has to start somewhere, and if you work at it, your financial situation is likely to improve over time.&nbsp;  <br /> </p>
<p><strong> Peace of Mind </strong></p>
<p> Who hasn&rsquo;t lain awake at 3:00 a.m. wondering how they were going to afford something they needed? If money is really tight, you might be wondering how you&rsquo;re going to pay the rent next week. </p>
<p><strong>Expanded Options</strong>  
  <br /> The more money you have saved, the more you control your own destiny. If your job has you on the verge of a nervous breakdown, you can quit even if you don&rsquo;t have a new job lined up yet and take time off to restore your sanity before you look for new employment.  <br />  
 <p><strong> Money Working for You  </strong></p>
<p> Most of us put in hundreds of hours of work each year to earn most of our money. But when you have savings and stash your funds in the right places, your money starts to work for you. </p>
<ul>
<li style="list-style-type:square" > Saving is very much essential for every person basically, because we can't predict the future. Saving money can help you become financially secure and provide a safety net in case of an emergency. </li>
</ul>
 
<p><strong> Here are a few reasons why we save: </strong></p>
 
<p><u>Emergency cushion </u>   - This could be any number of things: a new roof for your house, out-of-pocket medical expenses, or sudden loss of income. You will need money set aside for these emergencies to avoid going into debt to pay for your necessities. </p>
<p><u> Retirement </u>  &ndash; If you intend to retire someday, you will probably need savings and/or investments to take the place of the income you'll no longer get from your job. </p>
<p><u> Average Life Expectancy </u>  &ndash; With more advances in medicine and public health, people are now living longer and needing more money to get by. </p>
<p><u> Volatility of Social Security </u>  &ndash; Social Security was never intended to be the primary source of income and should be treated as a supplement to income. </p>
<p><u> Education </u>  - The costs for private and public education are rising every year and it's getting tougher to meet these demands. </p>
  
<p class="title-p" style="text-align: center;"> <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme; ?>img/saving.png" ></p>
<br><br>
  </div> 

</div>
  </div>
</body>
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    
  function looksLikeMail(str) {
      var lastAtPos = str.lastIndexOf('@');
      var lastDotPos = str.lastIndexOf('.');
      return (lastAtPos < lastDotPos && lastAtPos > 0 && str.indexOf('@@') == -1 && lastDotPos > 2 && (str.length - lastDotPos) > 2);
  }
  
  function contactusJS(form)
  {       
        //alert("hi");
    if(!(looksLikeMail($("#formemail").val()))) 
    {
      //alert("test");
       $("#contactresponse").html('Please enter valid email address.');
            $("#contactresponse").css("display", "block");
            return false;
    }  
              
      $("#contactresponse").html('');   
      $("#contactresponse").css("display", "none");
      alert("hi");
      $.ajax({
          cache:false,
          url: form.action,
          type: form.method,
          data: $(form).serialize(),
          success: function(response) {
          //alert("success");
              if(response.indexOf("CONTACT_SENT")>=0)
              {
                    
                  $("#contactresponse").html("Thank you for contacting us. We will get back to you at the earliest, usually withing 24 hours. If it is urgent, please reach us on the phone numbers provided.");
                  $("#contactresponse").css("display", "block");
                    
                    $("#formemail").val("");
                    $("#formname").val("");
                    $("#formnumber").val("");
                    $("#formmessage").val("");
              }
          }            
      });
      return false;
  }

  </script>