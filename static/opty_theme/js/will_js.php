<script type="text/javascript">

function showtabcontents(activeTab,activeTabURL) 

{

   $(".tab_content").hide(); //Hide all content

    $("ul.nav-tabs li:first").addClass("active").show(); //Activate first tab

    $(".tab_content:first").show(); //Show first tab content

   //alert(activeTab);

   //alert(activeTabURL);

   $.ajax({

     url: activeTabURL,

     type: 'post',

     dataType: 'html',

     success: function(content) {

       $(activeTab).html(content);

     }

   });

}



function shownexttab(toshow,activeTab,activeTabURL) 

{

   $("ul.nav-tabs li").removeClass("active"); //Remove any "active" class

   $(".tab-pane").hide(); //Hide all tab content

   $(".tab_content").hide(); //Hide all content

      var navtabs = document.getElementById("myTab3");

      var liinside = navtabs.getElementsByTagName("li");

      //alert(liinside);

      $(liinside[toshow]).addClass("active").show(); //Activate first tab

      var tab_content = document.getElementById("tabcontent");

      var divinside = tab_content.getElementsByTagName("div");

      $(divinside[toshow]).show(); //Show first tab content

      //alert("ajax send");

      $.ajax({

           url: activeTabURL,

           type: 'post',

           data: {'benno':benno},

           dataType: 'html',

           success: function(content) {

               //alert("ajax");

             $(activeTab).html(content);

           }

         });

}  



function showsubtab(toshow,activeTab,activeTabURL)  {

   //$("ul.nav-tabs assettab1 li").removeClass("active"); //Remove any "active" class



   $("#bankassets").addClass("active").show(); //Activate first tab

    //$(".tab_content:first").show(); //Show first tab content

    

    $.ajax({

        url: "../ajax-request/will_request.php?action=ba",

        type: 'post',

        dataType: 'html',

        success: function(content) {

          $('.panel-body-small2').html(data);

        }

      });

   

}



var url_string = window.location.href;

var url = new URL(url_string);

var redirparam = url.searchParams.get("newpage");

var benno = url.searchParams.get("benno");

//alert(benno);

//alert(redirparam);

if(redirparam == null) {

    showtabcontents("#tabst","../ajax-request/will_request.php?action=st");

} else if(redirparam == "pi") {

   shownexttab(1,"#tab1","../ajax-request/will_request.php?action=pi");

} else if(redirparam == "bene") {   

   shownexttab(2,"#tab2","../ajax-request/will_request.php?action=bene");

} else if(redirparam == "exec") {

   shownexttab(3,"#tab3","../ajax-request/will_request.php?action=exec");

} else if(redirparam == "assets") {

   shownexttab(4,"#tab4","../ajax-request/will_request.php?action=assets");

} else if(redirparam == "nb") {

   shownexttab(5,"#tab11","../ajax-request/will_request.php?action=nb");

} else if(redirparam == "wi") {

   shownexttab(6,"#tab12","../ajax-request/will_request.php?action=wi");
 } else if(redirparam == "word") {

   shownexttab(7,"#tab13","../ajax-request/will_request.php?action=word");


} else if(redirparam == "willpay") {

   shownexttab(8,"#tab14","../ajax-request/will_request.php?action=willpay");

}else if(redirparam == "download") {

   shownexttab(8,"#tab15","../ajax-request/will_request.php?action=download");

}







</script>

<script>

      /*---------------------------------- 20190319-BSEN ------------------------------------------*/

     /*-------------------------------- Age-Calculation-START -------------------------------------*/

    function getAge(getDOB)

    {

        var mdate = getDOB.toString();

        //alert("mDate" + mdate);

        var yearThen = parseInt(mdate.substring(0,4), 10);   // getting year from b Date

        //alert("yearThen" + yearThen);

        var monthThen = parseInt(mdate.substring(5,7), 10);  // getting month from b Date

        //alert("monthThen"+monthThen);

        var dayThen = parseInt(mdate.substring(8,10), 10);   // getting date from b Date

        //alert("dayThen"+dayThen);

        var today = new Date();                              // getting today Date

        //alert("today"+today);

        var birthday = new Date(yearThen, monthThen-1, dayThen); 

        

        var differenceInMilisecond = today.valueOf() - birthday.valueOf();

        

        var year_age = Math.floor(differenceInMilisecond / 31536000000);

        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);

        

        var month_age = Math.floor(day_age/30);

        

        day_age = day_age % 30;

        

        return year_age;

    }

    /*-------------------------------- Age-Calculation-END -------------------------------------*/

</script>
