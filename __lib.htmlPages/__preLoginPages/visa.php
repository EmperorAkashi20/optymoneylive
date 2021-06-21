 
<!-- Banner -->
<div class="banner_will">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
        <h1><center>Save money and money will save you</center><br> <center><span class="span-end">  </center></h1>
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
            <div class="row">
               <div class="col-md-12">
                <br>
 <p class="title-p" style="text-align: center;"> <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme; ?>img/visa.png" width="406" height="49"></p>

 <p class="title-p">
 You might find it hard to believe, saving money actually does feel great. It helps you to know the responsibility of your family and yourself and cause you to feel accountable and proud. Whether or not you're saving for a house, an automobile or for your children's education, each time you manage to save lots of cash for that cause could be reward able and there'll be a smile on your face. Each time you save cash you may notice that you just square measure one step nearer to obtaining what you wish.</p>
  <p class="title-p">
When you save enough cash and you're ready to get what you wish we are able to assure you that it'll feel wonderful. You may appreciate what you acquire a lot of as a result of you recognizes however exhausting you worked to shop for it.</p>
 <p class="title-p">
Saving cash for the longer term is one among the good habits of individuals. An individual becomes prospering once he but the long term in order that any uncertainties are often avoided in order that expenses are often controlled rigorously in order that they will grow their cash. Saving cash doesn't mean that you just got to be scotch. Folks that set the goal to save lots of should learn to save lots of 1st and pay subsequently. If you wish to realize your money goal the foremost vital step is to save first.</p>
<ul>
  <li style="list-style-type: disc;">
      But what are the advantages of saving except having the ability to shop for what you want?
  </li>
</ul>

<p class="title-p">
 <strong>It is less disagreeable: - </strong> Knowing that you just are forever attempting to create ends meet and one check far from a monetary crisis is very stressful. Over time, this takes its toll and may cause a variety of significant health conditions like anxiety, depression, sleep disorder and even heart issues.</p>
<p class="title-p">
 <strong>Improve your monetary being: - </strong> Developing a saving habit can improve your life. It stops you from overspending, debts and feeling stressed. Saving shows that you just are committing to yourself to boost your monetary standing.</p>
<p class="title-p">
<strong>Comes handy once stuff happens: - </strong>You'll feel ready for the surprise if you have got some savings. You never recognize what ruinous events are on the brink of occurring, thus it’s higher to possess some saving to avoid wasting yourself from tons of stress, anxiety, symptom and misery throughout the time of emergency.</p>
<p class="title-p">
<strong>Retire early: - </strong>Those that save cash once they’re young will retire early. Saving for retirement funds could be a smart investment. The create some sacrifices and obtain things that don't seem to be too big-ticket and stop shopping for things that they will do while not.If you would like to retire early, you have got to begin saving early.</p>

  <strong>These are some tips to save lots of money:</strong>

  <ul>
  <li style="list-style-type: disc;">Never purchase high-ticket things on impulse</li>
  <li style="list-style-type: disc;">Use debit and credit cards providentially</li>
  <li style="list-style-type: disc;">Take advantage of discounts or incentive programs provided by the leader.</li>
  <li style="list-style-type: disc;">Save money by shopping for things online in bulk</li>
  <li style="list-style-type: disc;">Substitute low for high-ticket low drinks</li>
  <li style="list-style-type: disc;">Bring lunch to figure</li>
  <li style="list-style-type: disc;">Eat out less monthly</li>
  <li style="list-style-type: disc;">Shop for food with a listing and stick with it</li>
  <li style="list-style-type: disc;">Take fewer cab rides and use transport additional</li>
  <li style="list-style-type: disc;">Compare airlines for reasonable fares</li>
  <li style="list-style-type: disc;">Assess vesture in terms of quality furthermore as the value</li>
  <li style="list-style-type: disc;">Communicate by email instead of by phone</li>
  <li style="list-style-type: disc;">Borrow books instead of getting them</li>
  <li style="list-style-type: disc;">Savings from Birthday presents</li>
</ul>


<strong>Saving money has both physical and psychological benefits. Start saving now! The sooner you start the better; you will even earn some more by saving.</strong>

<br><br><br>
  </div>
  </div>  </div>
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