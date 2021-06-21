<?php
include '../../__lib.includes/config.inc.php';

header('content-type: application/x-javascript');
?>

var http_server_base = '<?php echo $CONFIG->siteurl; ?>';

jQuery(function($) {

$('.show-details-btn').on('click', function(e) {
    e.preventDefault();
    $(this).closest('tr').next().toggleClass('open');
    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
});
 $(".trClick").click(function() {
        window.location = $(this).data("href");
    });
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'wealth') {
    ?>
 		$('#gndWedRiskTaken').change(function(){
    $('#gndWedIntRate').val($(this).val());
  });

  $('#gndWedProcessBtn1').click(function(){
    var currentAge      = $('#gndWedCurrAge').val();
    var marrigeAge      = $('#gndWedMariageAge').val();
    var requiredAmount  = $('#gndWedAmt').val();
    var lumsumAmount    = $('#gndWedLumpsumAmt').val();
    var rate            = $('#gndWedIntRate').val();
    var inflationRate   = $('#gndWedInfRate').val();
    var noOfYrs = marrigeAge - currentAge;
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#gndWedNumYears').val(noOfYrs);
    $('#gndWedAmt2').val(requiredAmount);
    $('#gndWedLumpsumAmt2').val(lumsumAmount);
    $('#gndWedInvPerMonth').val(Math.round(sipAmount));
    $('#gndWedIntRate2').val(rate);
    $('#gndWedInfRate2').val(inflationRate);
    $('#gndWedFvAmt').text(Math.round(fv));
    $('#gndWedSipAmt').text(Math.round(sipAmount));
    $('#gndWedSipAmt2').text(Math.round(sipAmount));
    $('#gndWedAvilAmt').text(Math.round(fvSipLum));
    $('#gndWedSipInv').text(gap2);
  });

  $('#gndWedRiskTaken2').change(function(){
    $('#gndWedIntRate2').val($(this).val());
    var requiredAmount  = $('#gndWedAmt2').val();
    var lumsumAmount    = $('#gndWedLumpsumAmt2').val();
    var rate            = $('#gndWedIntRate2').val();
    var inflationRate   = $('#gndWedInfRate2').val();
    var noOfYrs         = $('#gndWedNumYears').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#gndWedNumYears').val(noOfYrs);
    $('#gndWedAmt2').val(requiredAmount);
    $('#gndWedLumpsumAmt2').val(lumsumAmount);
    $('#gndWedInvPerMonth').val(Math.round(sipAmount));
    $('#gndWedInfRate2').val(inflationRate);
    $('#gndWedFvAmt').text(Math.round(fv));
    $('#gndWedSipAmt').text(Math.round(sipAmount));
    $('#gndWedSipAmt2').text(Math.round(sipAmount));
    $('#gndWedAvilAmt').text(Math.round(fvSipLum));
    $('#gndWedSipInv').text(gap2);
   });
   // Grand Wedding end

   //Higher Education Start
  $('#highEduRiskTaken').change(function(){
    $('#highEduIntRate').val($(this).val());
  });

  $('#highEduProcessBtn1').click(function(){
    var currentAge      = $('#highEduCurrAge').val();
    var highEduSrtAge   = $('#highEduSrtAge').val();
    var requiredAmount  = $('#highEduAmt').val();
    var lumsumAmount    = $('#highEduLumpsumAmt').val();
    var rate            = $('#highEduIntRate').val();
    var inflationRate   = $('#highEduInfRate').val();
    var noOfYrs = highEduSrtAge - currentAge;
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#highEduNumYears').val(noOfYrs);
    $('#highEduAmt2').val(requiredAmount);
    $('#highEduLumpsumAmt2').val(lumsumAmount);
    $('#highEduInvPerMonth').val(Math.round(sipAmount));
    $('#highEduIntRate2').val(rate);
    $('#highEduInfRate2').val(inflationRate);
    $('#highEduFvAmt').text(Math.round(fv));
    $('#highEduSipAmt').text(Math.round(sipAmount));
    $('#highEduSipAmt2').text(Math.round(sipAmount));
    $('#highEduAvilAmt').text(Math.round(fvSipLum));
    $('#highEduSipInv').text(gap2);
  });

  $('#highEduRiskTaken2').change(function(){
    $('#highEduIntRate2').val($(this).val());
    var requiredAmount  = $('#highEduAmt2').val();
    var lumsumAmount    = $('#highEduLumpsumAmt2').val();
    var rate            = $('#highEduIntRate2').val();
    var inflationRate   = $('#highEduInfRate2').val();
    var noOfYrs         = $('#highEduNumYears').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#highEduNumYears').val(noOfYrs);
    $('#highEduAmt2').val(requiredAmount);
    $('#highEduLumpsumAmt2').val(lumsumAmount);
    $('#highEduInvPerMonth').val(Math.round(sipAmount));
    $('#highEduInfRate2').val(inflationRate);
    $('#highEduFvAmt').text(Math.round(fv));
    $('#highEduSipAmt').text(Math.round(sipAmount));
    $('#highEduSipAmt2').text(Math.round(sipAmount));
    $('#highEduAvilAmt').text(Math.round(fvSipLum));
    $('#highEduSipInv').text(gap2);
  });
  //Higher Education End

  // Own a House start
  $('#ownHousRiskTaken').change(function(){
    $('#ownHousIntRate').val($(this).val());
  });

  $('#ownHousAmtReq').blur(function(){
    var amtReq = $(this).val();
    var IntWork = (amtReq*20/100);
    $('#ownHousIntWork').val(amtReq*20/100);
    var totalAmount =  parseInt(amtReq) + parseInt(IntWork);
    $('#ownHousTotalAmt').val(totalAmount);
  });

  $('#ownHousProcessBtn1').click(function(){
    var noOfYrs         = $('#ownHousNoOfYear').val();
    var requiredAmount  = $('#ownHousTotalAmt').val();
    var lumsumAmount    = $('#ownHousLumpsumAmt').val();
    var rate            = $('#ownHousIntRate').val();
    var inflationRate   = $('#ownHousInfRate').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#ownHousNumYears').val(noOfYrs);
    $('#ownHousAmt2').val(requiredAmount);
    $('#ownHousLumpsumAmt2').val(lumsumAmount);
    $('#ownHousInvPerMonth').val(Math.round(sipAmount));
    $('#ownHousIntRate2').val(rate);
    $('#ownHousInfRate2').val(inflationRate);
    $('#ownHousFvAmt').text(Math.round(fv));
    $('#ownHousSipAmt').text(Math.round(sipAmount));
    $('#ownHousSipAmt2').text(Math.round(sipAmount));
    $('#ownHousAvilAmt').text(Math.round(fvSipLum));
    $('#ownHousSipInv').text(gap2);
  });

  $('#ownHousRiskTaken2').change(function(){
    $('#ownHousIntRate2').val($(this).val());
    var requiredAmount  = $('#ownHousAmt2').val();
    var lumsumAmount    = $('#ownHousLumpsumAmt2').val();
    var rate            = $('#ownHousIntRate2').val();
    var inflationRate   = $('#ownHousInfRate2').val();
    var noOfYrs         = $('#ownHousNumYears').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#ownHousNumYears').val(noOfYrs);
    $('#ownHousAmt2').val(requiredAmount);
    $('#ownHousLumpsumAmt2').val(lumsumAmount);
    $('#ownHousInvPerMonth').val(Math.round(sipAmount));
    $('#ownHousInfRate2').val(inflationRate);
    $('#ownHousFvAmt').text(Math.round(fv));
    $('#ownHousSipAmt').text(Math.round(sipAmount));
    $('#ownHousSipAmt2').text(Math.round(sipAmount));
    $('#ownHousAvilAmt').text(Math.round(fvSipLum));
    $('#ownHousSipInv').text(gap2);
  });
  // Own a House end

  // Buy a Car start
  $('#buyACarRiskTaken').change(function(){
    $('#buyACarIntRate').val($(this).val());
  });

  $('#buyACarProcessBtn1').click(function(){
    var noOfYrs          = $('#buyACarNoOfYear').val();
    var requiredAmount  = $('#buyACarAmtReq').val();
    var lumsumAmount    = $('#buyACarLumpsumAmt').val();
    var rate            = $('#buyACarIntRate').val();
    var inflationRate   = $('#buyACarInfRate').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#buyACarNumYears').val(noOfYrs);
    $('#buyACarAmt2').val(requiredAmount);
    $('#buyACarLumpsumAmt2').val(lumsumAmount);
    $('#buyACarInvPerMonth').val(Math.round(sipAmount));
    $('#buyACarIntRate2').val(rate);
    $('#buyACarInfRate2').val(inflationRate);
    $('#buyACarFvAmt').text(Math.round(fv));
    $('#buyACarSipAmt').text(Math.round(sipAmount));
    $('#buyACarSipAmt2').text(Math.round(sipAmount));
    $('#buyACarAvilAmt').text(Math.round(fvSipLum));
    $('#buyACarSipInv').text(gap2);
  });

  $('#buyACarRiskTaken2').change(function(){
    $('#buyACarIntRate2').val($(this).val());
    var requiredAmount  = $('#buyACarAmt2').val();
    var lumsumAmount    = $('#buyACarLumpsumAmt2').val();
    var rate            = $('#buyACarIntRate2').val();
    var inflationRate   = $('#buyACarInfRate2').val();
    var noOfYrs         = $('#buyACarNumYears').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum 
    var gap2 = fv - fvSipLum;
    $('#buyACarNumYears').val(noOfYrs);
    $('#buyACarAmt2').val(requiredAmount);
    $('#buyACarLumpsumAmt2').val(lumsumAmount);
    $('#buyACarInvPerMonth').val(Math.round(sipAmount));
    $('#buyACarInfRate2').val(inflationRate);
    $('#buyACarFvAmt').text(Math.round(fv));
    $('#buyACarSipAmt').text(Math.round(sipAmount));
    $('#buyACarSipAmt2').text(Math.round(sipAmount));
    $('#buyACarAvilAmt').text(Math.round(fvSipLum));
    $('#buyACarSipInv').text(gap2);
  });
  // Buy a Car end

  // vacation plan START

  $('#vacaPlanRiskTaken').change(function(){
    $('#vacaPlanIntRate').val($(this).val());
  });

  $('#vacaPlanProcessBtn1').click(function(){
    var noOfYrs          = $('#vacaPlanNoOfYear').val();
    var requiredAmount  = $('#vacaPlanAmtReq').val();
    var lumsumAmount    = $('#vacaPlanLumpsumAmt').val();
    var rate            = $('#vacaPlanIntRate').val();
    var inflationRate   = $('#vacaPlanInfRate').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#vacaPlanNumYears').val(noOfYrs);
    $('#vacaPlanAmt2').val(requiredAmount);
    $('#vacaPlanLumpsumAmt2').val(lumsumAmount);
    $('#vacaPlanInvPerMonth').val(Math.round(sipAmount));
    $('#vacaPlanIntRate2').val(rate);
    $('#vacaPlanInfRate2').val(inflationRate);
    $('#vacaPlanFvAmt').text(Math.round(fv));
    $('#vacaPlanSipAmt').text(Math.round(sipAmount));
    $('#vacaPlanSipAmt2').text(Math.round(sipAmount));
    $('#vacaPlanAvilAmt').text(Math.round(fvSipLum));
    $('#vacaPlanSipInv').text(gap2);
  });

  $('#vacaPlanRiskTaken2').change(function(){
    $('#vacaPlanIntRate2').val($(this).val());
    var requiredAmount  = $('#vacaPlanAmt2').val();
    var lumsumAmount    = $('#vacaPlanLumpsumAmt2').val();
    var rate            = $('#vacaPlanIntRate2').val();
    var inflationRate   = $('#vacaPlanInfRate2').val();
    var noOfYrs         = $('#vacaPlanNumYears').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#vacaPlanNumYears').val(noOfYrs);
    $('#vacaPlanAmt2').val(requiredAmount);
    $('#vacaPlanLumpsumAmt2').val(lumsumAmount);
    $('#vacaPlanInvPerMonth').val(Math.round(sipAmount));
    $('#vacaPlanInfRate2').val(inflationRate);
    $('#vacaPlanFvAmt').text(Math.round(fv));
    $('#vacaPlanSipAmt').text(Math.round(sipAmount));
    $('#vacaPlanSipAmt2').text(Math.round(sipAmount));
    $('#vacaPlanAvilAmt').text(Math.round(fvSipLum));
    $('#vacaPlanSipInv').text(gap2);
  });
  // vacation plan End

  // emergency fund started
  $('#emeFundRiskTaken').change(function(){
    $('#emeFundIntRate').val($(this).val());
  });

  $('#emeFundProcessBtn1').click(function(){
    var noOfYrs          = $('#emeFundNoOfYear').val();
    var requiredAmount  = $('#emeFundAmtReq').val();
    var lumsumAmount    = $('#emeFundLumpsumAmt').val();
    var rate            = $('#emeFundIntRate').val();
    var inflationRate   = $('#emeFundInfRate').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#emeFundNumYears').val(noOfYrs);
    $('#emeFundAmt2').val(requiredAmount);
    $('#emeFundLumpsumAmt2').val(lumsumAmount);
    $('#emeFundInvPerMonth').val(Math.round(sipAmount));
    $('#emeFundIntRate2').val(rate);
    $('#emeFundInfRate2').val(inflationRate);
    $('#emeFundFvAmt').text(Math.round(fv));
    $('#emeFundSipAmt').text(Math.round(sipAmount));
    $('#emeFundSipAmt2').text(Math.round(sipAmount));
    $('#emeFundAvilAmt').text(Math.round(fvSipLum));
    $('#emeFundSipInv').text(gap2);
  });

  $('#emeFundRiskTaken2').change(function(){
    $('#emeFundIntRate2').val($(this).val());
    var requiredAmount  = $('#emeFundAmt2').val();
    var lumsumAmount    = $('#emeFundLumpsumAmt2').val();
    var rate            = $('#emeFundIntRate2').val();
    var inflationRate   = $('#emeFundInfRate2').val();
    var noOfYrs         = $('#emeFundNumYears').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#emeFundNumYears').val(noOfYrs);
    $('#emeFundAmt2').val(requiredAmount);
    $('#emeFundLumpsumAmt2').val(lumsumAmount);
    $('#emeFundInvPerMonth').val(Math.round(sipAmount));
    $('#emeFundInfRate2').val(inflationRate);
    $('#emeFundFvAmt').text(Math.round(fv));
    $('#emeFundSipAmt').text(Math.round(sipAmount));
    $('#emeFundSipAmt2').text(Math.round(sipAmount));
    $('#emeFundAvilAmt').text(Math.round(fvSipLum));
    $('#emeFundSipInv').text(gap2);
  });

  // emergency fund END

  // unique Goal Start
  $('#uniqGoalRiskTaken').change(function(){
    $('#uniqGoalIntRate').val($(this).val());
  });

  $('#uniqGoalProcessBtn1').click(function(){
    var noOfYrs          = $('#uniqGoalNoOfYear').val();
    var requiredAmount  = $('#uniqGoalAmtReq').val();
    var lumsumAmount    = $('#uniqGoalLumpsumAmt').val();
    var rate            = $('#uniqGoalIntRate').val();
    var inflationRate   = $('#uniqGoalInfRate').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#uniqGoalNumYears').val(noOfYrs);
    $('#uniqGoalAmt2').val(requiredAmount);
    $('#uniqGoalLumpsumAmt2').val(lumsumAmount);
    $('#uniqGoalInvPerMonth').val(Math.round(sipAmount));
    $('#uniqGoalIntRate2').val(rate);
    $('#uniqGoalInfRate2').val(inflationRate);
    $('#uniqGoalFvAmt').text(Math.round(fv));
    $('#uniqGoalSipAmt').text(Math.round(sipAmount));
    $('#uniqGoalSipAmt2').text(Math.round(sipAmount));
    $('#uniqGoalAvilAmt').text(Math.round(fvSipLum));
    $('#uniqGoalSipInv').text(gap2);
  });

  $('#uniqGoalRiskTaken2').change(function(){
    $('#uniqGoalIntRate2').val($(this).val());
    var requiredAmount  = $('#uniqGoalAmt2').val();
    var lumsumAmount    = $('#uniqGoalLumpsumAmt2').val();
    var rate            = $('#uniqGoalIntRate2').val();
    var inflationRate   = $('#uniqGoalInfRate2').val();
    var noOfYrs         = $('#uniqGoalNumYears').val();
    var rateOfReturn = rate/100;
    var fv = requiredAmount * Math.pow((1+ inflationRate/100), (noOfYrs));
    var a = Math.pow((1+ rateOfReturn), (1/noOfYrs));
    var nominal = noOfYrs * (a-1)/12;
    var lumsum = lumsumAmount * Math.pow((1+ rateOfReturn), (noOfYrs));
    var gap = fv - lumsum;
    var b = Math.pow((1+ nominal), (noOfYrs*12));
    var sipAmount = gap * nominal/(b-1);
    sipAmount;
    var c = Math.pow((1+ nominal), (noOfYrs*12));
    var fvSipInvestment = sipAmount * (c-1)/nominal;
    var fvSipLum = fvSipInvestment + lumsum ;
    var gap2 = fv - fvSipLum;
    $('#uniqGoalNumYears').val(noOfYrs);
    $('#uniqGoalAmt2').val(requiredAmount);
    $('#uniqGoalLumpsumAmt2').val(lumsumAmount);
    $('#uniqGoalInvPerMonth').val(Math.round(sipAmount));
    $('#uniqGoalInfRate2').val(inflationRate);
    $('#uniqGoalFvAmt').text(Math.round(fv));
    $('#uniqGoalSipAmt').text(Math.round(sipAmount));
    $('#uniqGoalSipAmt2').text(Math.round(sipAmount));
    $('#uniqGoalAvilAmt').text(Math.round(fvSipLum));
    $('#uniqGoalSipInv').text(gap2);
  });
  // unique Goal End

  //PPF START
  $('#ppfRateType').change(function(){
    $('#ppfIntRate').val($(this).val()); 
  });
  $('#ppfCheck').click(function(){
    var principal =$('#ppfAmt').val(); 
    var rateType =$('#ppfRateType').val(); 
    var time =$('#ppfNumYear').val(); 
    var ppfTotalMatAmt ;
    $('#ppfIntRate').val(rateType+'%'); 
    if(rateType == 7.6)
    {
      var ppfTotalMatAmt = clc_PPF(principal,rateType,time);
    }
    else if(rateType == 7.8)
    {
      var ppfTotalMatAmt = clc_PPF(principal,rateType,time);
    }
    var  ppfTotalMatAmt = (parseInt(ppfTotalMatAmt));
    var  ppfTotalInvest = (parseInt(principal) * parseInt(time));
    var  ppfTotalIntEarn =(ppfTotalMatAmt -  ppfTotalInvest);
    $('#ppfTotalMatAmt').val(ppfTotalMatAmt);
    $('#ppfTotalInvest').val(ppfTotalInvest);
    $('#ppfTotalIntEarn').val(ppfTotalIntEarn);
  });
  //PPF END

  //HRA Start
  $('#HRA_Check').click(function(){
    var sal_rec     =  parseInt($('#hraBscSal').val());
    var da          =  parseInt($('#hraDA').val());
    var hra_rec     =  parseInt($('#hraRec').val());
    var rent_paid   =  parseInt($('#hraActRentPad').val());
    var city        =  $('#hraCity').val();
    hra_rec;
    rent_paid = rent_paid-((sal_rec + da)*(10/100));
    metro_nonmetro = 0;
    if(city == 'oth')
    {
        metro_nonmetro = ((sal_rec + da)*(40/100));
    }
    else
    {
        metro_nonmetro = ((sal_rec + da)*(50/100))
    }
    var HRA_Exemptions = 0;
    if(hra_rec < rent_paid && hra_rec < metro_nonmetro)
    {
        HRA_Exemptions = hra_rec;
    }
    else if(rent_paid < hra_rec && rent_paid < metro_nonmetro)
    {
        HRA_Exemptions = rent_paid;
    }
    else if(metro_nonmetro < hra_rec && metro_nonmetro < rent_paid)
    {
        HRA_Exemptions = metro_nonmetro;
    }
    $('#hraExempt').val(HRA_Exemptions);
    $('#hrataxable').val((hra_rec - HRA_Exemptions));
  });
  //HRA end

  //SSY start
  $('#ssyCheck').click(function(){
    var principalVal   =  parseFloat($('#ssyAmt').val());
    var intRate        =  parseFloat($('#ssyIntRate').val());
    var startYears     =  parseInt($('#ssyStartyear').val());
    var ssyTotalMatAmt =  clc_SSY(principalVal,intRate);
    var ssyMatYears    =  startYears + 15;
    $('#ssyMatYear').val(ssyMatYears);
    $('#ssyTotalAmt').val(ssyTotalMatAmt);
  });
  //SSY end

  //Home Loan start
  $('#homeLoanCheck').click(function(){
    var P   = parseFloat($("#homeLoanAmt").val());
    var r   = parseFloat(parseFloat($("#homeLoanIntRate").val()) / 100/12);
    var n   = parseFloat($("#homeLoanNumYears").val() * 12);
    var emi = clc_emi(P,n,r);
    var totalPayAmt = Math.round(emi*n);
    var totalPayInt = totalPayAmt - P;
    emi = emi.toFixed(2);
    $('#homeLoanEmiAmt').val(emi);
    $('#homeLoanTotalPayAmt').val(totalPayAmt);
    $('#homeLoanTotalInt').val(totalPayInt);
  });
  //Home Loan end

  //car loan start
  $('#carLoanCheck').click(function(){
    var P   = parseFloat($("#carLoanAmt").val());
    var r   = parseFloat(parseFloat($("#carLoanIntRate").val()) / 100 / 12);
    var n   = parseFloat($("#carLoanNumYears").val() * 12);
    var emi = clc_emi(P,n,r);
    var totalPayAmt = Math.round(emi*n);
    var totalPayInt = totalPayAmt - P;
    emi = emi.toFixed(2);
    $('#carLoanEmiAmt').val(emi);
    $('#carLoanPayAmt').val(totalPayAmt);
    $('#carLoanTotalInt').val(totalPayInt);
  });
  //car loan end

  //Personal Loan start
  $('#perLoanCheck').click(function(){
    var P   = parseFloat($("#perLoanAmt").val());
    var r   = parseFloat(parseFloat($("#perLoanIntRate").val()) / 100 / 12);
    var n   = parseFloat($("#perLoanNumYears").val() * 12);
    var emi = clc_emi(P,n,r);
    var totalPayAmt = Math.round(emi*n);
    var totalPayInt = totalPayAmt - P;
    emi = emi.toFixed(2);
    $('#perLoanEmiAmt').val(emi);
    $('#perLoanPayAmt').val(totalPayAmt);
    $('#perLoanTotalInt').val(totalPayInt);
  });
  //Personal Loan end

  // Rd start
  $('#rdCheckBtn').click(function(){
    var monthlyInstallment =  $('#rdAmt').val();
    var numberOfYears      =  $('#rdNumYears').val();
    var rateOfInterest     =  $('#rdIntRate').val();
    var numberOfMonths     =  numberOfYears * 12;
    var amt = Math.round(clc_recurrInt(monthlyInstallment,numberOfMonths,rateOfInterest));
    $('#rdTotalAmt').val(amt);
    $('#rdYearShow').text(numberOfYears);
  });
  // RD end

  //Fixed Deposit start
  $('#fdCheckBtn').click(function(){
    var principal    =  $('#fixdepAmt').val();
    var rate         =  $('#fixdepIntRate').val();
    var time         =  $('#fixdepNum').val();
    var time_period  =  $('#fixdepNumType').val();
    var intType      =  $('#fixdepIntType').val();
    var amt;
    var totalInt;
     if(intType == 'simpleInterest')
      {
        amt = clc_simpleInt(principal,1,time,rate,time_period); 
      }
      else
      {
        amt = (principal* Math.pow((1 + (rate/(intType*100))), (intType*time/time_period)));
      }
      amt = Math.round(amt);
      totalInt = amt - principal;
      var show_time = calc_time(time_period);
      $('#fixdepMatAmt').val(amt);
      $('#fixdepTotalInt').val(totalInt);
      $('.fixdepYearShow').text(time+" "+show_time);
      $('#fixdepInvestAmt').text(principal);
      $('#fixdepTotalAmt').text(amt);
      $('#fixdepTimeShow').text(show_time);
  });
  //Fixed Deposti end

  // Tax start
  $('#taxCheckBtn').click(function(){
    var age = parseInt($('#taxAgeNum').val());
    var elss = parseFloat($('#taxElssSchemeAmt').val()) || 0;
    var lic = parseFloat($('#taxLICSchemeAmt').val()) || 0;
    var ssy = parseFloat($('#taxSSYSchemeAmt').val()) || 0;
    var fd = parseFloat($('#taxFDAmt').val()) || 0;
    var ppf = parseFloat($('#taxPPFAmt').val()) || 0;
    var insurance = parseFloat($('#taxInsAmt').val()) || 0;
    var otherAmt = parseFloat($('#taxOtherAmt').val()) || 0;
    var otherAmt = parseFloat($('#taxOtherAmt').val()) || 0;
    var salary = parseFloat($('#taxAnnSal').val()) || 0;
    var totalInvest = (elss + lic + ssy + fd + ppf + insurance + otherAmt);
    var remainingSalary = salary - totalInvest;
    var tax = 0;
    var furInvest;
    var taxSavedFromFurInv;
    if (totalInvest>150000) 
    {
      fur_invest = 0;
    }
    else
    {
      fur_invest = 150000 - totalInvest;
    }

    if(age >0 && age <= 60) 
    {
       if (remainingSalary>250000 && remainingSalary<=500000) 
       {
          tax=((remainingSalary-250000)*5/100);
       }
       if (remainingSalary>500000 && remainingSalary <=1000000) 
       {
          tax= 12500+((remainingSalary-500000)*20/100);
       }
       if (remainingSalary >1000000) 
       {
          tax= (12500+100000)+((remainingSalary-500000)*30/100);
       }
       if (salary<=250000) 
       {
          taxSavedFromFurInv = (fur_invest*0/100);
       }
       if (salary>250000 && salary <=500000) 
       {
          taxSavedFromFurInv = (fur_invest*5/100);
       }
       if (salary>500000 && salary<=1000000) 
       {
          taxSavedFromFurInv = (fur_invest*20/100);
       }
       if (salary>1000000) 
       {
          taxSavedFromFurInv = (fur_invest*30/100);
       }
    }
    else if(age >= 61 && age <= 80)
    {
      if (remainingSalary>300000 && remainingSalary<=500000) 
      {
          tax=((remainingSalary-300000)*5/100);
      }
      if (remainingSalary>500000 && remainingSalary <=1000000) 
      {
          tax= 10000+((remainingSalary-500000)*20/100);
      }
      if (remainingSalary >1000000) 
      {
          tax= (10000+100000)+((remainingSalary-500000)*30/100);
      }

      if (salary<=300000) 
      {
          taxSavedFromFurInv = (fur_invest*0/100);
      }
      if (salary>300000 && salary <=500000) 
      {
          taxSavedFromFurInv = (fur_invest*5/100);
      }
      if (salary>500000 && salary<=1000000) 
      {
          taxSavedFromFurInv = (fur_invest*20/100);
      }
      if (salary>1000000) 
      {
          taxSavedFromFurInv = (fur_invest*30/100);
      }

    }
    else if(age >=81)
    {
      if (remainingSalary>500000 && remainingSalary <=1000000) 
      {
          tax= (remainingSalary-500000)*20/100;
      }
      if (remainingSalary >1000000) 
      {
          tax= (100000)+((remainingSalary-500000)*30/100);
      }

      if (salary<=500000) 
      {
          taxSavedFromFurInv = (fur_invest*0/100);
      }
      if (salary>500000 && salary<=1000000) 
      {
          taxSavedFromFurInv = (fur_invest*20/100);
      }
      if (salary>1000000) 
      {
          taxSavedFromFurInv = (fur_invest*30/100);
      }
    }
    $('#taxTotalInvAmt').val(totalInvest);
    $('#taxRemInvAmt').val(fur_invest);
    $('#taxSaveAmt').val(taxSavedFromFurInv);
  });
        /*google.charts.load('current', { 'packages': ['corechart'] });
		google.charts.setOnLoadCallback(drawChart);*/

        $(".wealthDashMain").show();
        $(".wealthHide").hide();
        $("#retireRichShow").show();
        $('.sidebar').click(function(event) {
            var wealthDivClick = $(event.target).attr('id');
            // alert(wealthDivClick);
            // $(".wealthDashMain").hide();
            $('.learnPlanAndInvHide').hide();
            $(".wealthHide").hide();
            $("#" + wealthDivClick + "Show").show();
        });


        $('.riskProfShow, .calCulatorsShow, .portAllocShow, .sipSTPShow, .lumpSumShow, .saveTaxShow').hide();
        $('#rowLearnPlan>div>a>div, #rowInvestment>div>a>div').click(function(event) {
            var allLearnPlanAndInv = $(this).attr('id');
            // alert(allLearnPlanAndInv);
            $(".wealthHide").hide();
            // var test = '.' + allLearnPlanAndInv + 'show';
            $('.calCulatorsShow').show();
            // $('.learnPlanAndInvHide').hide();
            // alert(test);
            // $('.' + allLearnPlanAndInv + 'show').show();
            // $('.' + allLearnPlanAndInv + 'show').show();
        });
                $(".wealthDashMain").show();
        $(".wealthHide").hide();
        // $("#retireRichShow").show();
        $('.sidebar').click(function(event) {
            var wealthDivClick = $(event.target).attr('id');
            // alert(wealthDivClick);
            // $(".wealthDashMain").hide();
            $('.learnPlanAndInvHide').hide();
            $(".wealthHide").hide();
            $("#" + wealthDivClick + "Show").show();
        });

        $('.learnPlanAndInvHide').hide();
        $('#rowLearnPlan>div>a>div, #rowInvestment>div>a>div').click(function(event) {
            var allLearnPlanAndInv = $(this).attr('id');
            // alert(allLearnPlanAndInv);
            $(".wealthHide").hide();
            $('.learnPlanAndInvHide').hide();
            if (allLearnPlanAndInv == 'riskProf') {
                $('.riskProfShow').show();
            }else if (allLearnPlanAndInv == 'calCulators') {
                $('.calCulatorsShow').show();
            }else if (allLearnPlanAndInv == 'portAlloc') {
                $('.portAllocShow').show();
            }else if (allLearnPlanAndInv == 'sipSTP') {
                $('.sipSTPShow').show();
            }else if (allLearnPlanAndInv == 'lumpSum') {
                $('.lumpSumShow').show();
            }else if (allLearnPlanAndInv == 'saveTax') {
                $('.saveTaxShow').show();
            }
        });

<?php
} ?>    
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'mf_offer_buy' || $_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'mf_buy_sell') {
        ?>
	
    $('#edit-modal').on('show.bs.modal', function(e) {            
        var $modal = $(this),
        esseyId = e.relatedTarget.id;
        titleId = e.relatedTarget.title;
        //alert(esseyId);
        $.ajax({
                cache: false,
                type: 'POST',
                url: '../ajax-request/mf_details.php',
                data: 'MFID='+esseyId,
                success: function(data) 
                {
                	//console.log(data);
                    $modal.find('.modal-title').html(titleId);
		            $modal.find('.edit-content').html(data);
                }
        });            
   })
<?php
    } ?>
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'create_will') {
        ?>
 
    $(".tab_content").hide(); //Hide all content
    $("ul.nav-tabs li:first").addClass("active").show(); //Activate first tab
    $(".tab_content:first").show(); //Show first tab content

    $("ul.nav-tabs li").click(function() {

        $("ul.nav-tabs li").removeClass("active"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(".tab-pane").hide(); //Hide all tab content

        var activeTab = $(this).find("a").attr("href"); 
        var activeTabURL = $(this).find("a").attr("data-url");
        //if($(activeTab).html() == '') 
        //{              	
          $.ajax({
            url: activeTabURL,
            type: 'post',
            dataType: 'html',
            success: function(content) {
              $(activeTab).html(content);
              //alert("dd");
            }
          });
        //}

        $(activeTab).fadeIn(); //Fade in the active ID content
        return false;
    });
    
    /*************************WILL PAGES**********************************/
        
        $('#btn-update').click(function(){
            $.validate({form:"#frmProfiles", onSuccess:validate_stocksbonds});
        });
        $('#btn-add').click(function(){
            $.validate({form:"#frmProfiles", onSuccess:validate_stocksbonds});
        });
     
    
    /*************************WILL PAGES**********************************/
    
<?php
    }?>
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'home') {
        ?>
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "2012-2013",  data: 38.7, color: "#68BC31"},
				{ label: "2013-2014",  data: 24.5, color: "#2091CF"},
				{ label: "2014-2015",  data: 8.2, color: "#AF4E96"},
				{ label: "2015-2016",  data: 18.6, color: "#DA5430"},
				{ label: "2016-2017",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent'].toFixed()+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			 $('#searchForm').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					ignore: "",
					rules: {						
						search_input: {
							required: true
						}
					},
			
					messages: {
						search_input: {
							required: "Please provide a valid search text.",
							email: "Please provide a valid search text."
						}
					},			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					submitHandler: function (form) {
						form.submit();
					},
					invalidHandler: function (form) {
					}
				});
			
			 <?php
    }?>   
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'profile') {
        ?>
 //editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    
				
				//editables 				
                $('#cust_name').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'cust_name',
					send: 'always'		
			    });
			     $('#alternet_email_id').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'alternet_email_id',
					send: 'always'		
			    });
			     $('#city').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'city',
					send: 'always'		
			    });

			   
             
                

             

				 $('#company_name').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'company_name',
					send: 'always'		
			    });
				 $('#fath_name').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'fath_name',
                    send: 'always',                    
                    validate: function(value) {
                   <!--  alert(value); -->
                    var regex = /^[a-zA-Z ]{2,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';}},                           
                });
                $('#mother_name').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'mother_name',
					send: 'always'		
			    });
                <!-------------------------------------------------->
               $('#dob').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'date',
                    name: 'dob',
                    title: 'Enter username',
                    send: 'always',
                    success: function(response, newValue) {                      
                         $("#calcAge").html(response);
                    }                    
                });
              $('#contact_no').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'number',
                    name: 'contact_no',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[6789][0-9]{9}$/;
                    if(! regex.test(value)) {
                    return 'Please enter correct mobile number!';}},            
                });
                $('#profession').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'profession',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[a-zA-Z ]{3,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';}},                          

                });  
                <!----------------------------------------------------------------------------------->
                $('#occupation').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'occupation',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[a-zA-Z ]{3,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';}},                               
                });
      
                $('#nominee_name').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'nominee_name',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[a-zA-Z ]{2,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';}},                               
                });

                $('#nominee_dob').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'date',
					name: 'nominee_dob',
					send: 'always'		
			    });
      
                 $('#r_of_nominee_w_app').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'r_of_nominee_w_app',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[a-zA-Z ]{2,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';
                   }},                                  
                });
                <!----------------------------------------------------------------------->
				$('#address1').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'textarea',
					name: 'address1',
					send: 'always'		
			    });	
                <!-- --------------------------------------------------------------- -->			
                $('#city1').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'city1',
                    send: 'always'      
                }); 
                <!-- --------------------------------------------------------------- -->
				 $('#r_of_nominee_w_app').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'r_of_nominee_w_app',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[a-zA-Z ]{2,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';
                   }},                                  
                });
				$('#state').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'state',
					send: 'always'		
			    });
				 $('#r_of_nominee_w_app').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'r_of_nominee_w_app',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[a-zA-Z ]{2,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';
                   }},                                  
                });
                <!-- ----------------------------------------------------------------- -->
                $('#pincode').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'pincode',
                    send: 'always'  ,
                    validate: function(value) {
                    var regex = /^[0-9]{6}$/;
                    if(! regex.test(value)) {
                    return 'Please enter correct Pincode!';}},    
                });
                <!-- ----------------------------------------------------------------- -->
				$('#country').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'country',
					send: 'always'		
			    });
                $('#nationality').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'nationality',
                    send: 'always'      
                });
                $('#taxstatus').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'taxstatus',
                    send: 'always'      
                });
               $('#aadhar').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'aadhar',
                    send: 'always'  ,
                    validate: function(value) {
                    var regex = /^[0-9]{12}$/;
                    if(! regex.test(value)) {
                    return 'Please enter correct Aadhar number!';}},    
                });
                $('#pan').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'pan',
                    send: 'always'  ,
                    validate: function(value) {
                    var regex = /^[A-Za-z]{3}[pP]{1}[A-Za-z]{1}[0-9]{4}[A-Za-z]{1}$/;
                    if(! regex.test(value)) {
                    return 'Please enter correct Pan number!';}},      
            
                });
				$('#alternet_email_id').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'email',
                    name: 'alternet_email_id',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
                    if(! regex.test(value)) {
                    return 'Please enter correct email address!';}},      

                });
                $('#bank_name,#bank_name1,#bank_name2,#bank_name3,#bank_name4,#bank_name5').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'bank_name',
                    send: 'always',
                    validate: function(value) {
                     
                    var regex = /^[a-zA-Z ]{3,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';}},                                   
                });
                <!-- delete bank account -->
                  $('#deletebank,#deletebank1,#deletebank2,#deletebank3,#deletebank4').click(function()
                  {
                     var val = $(this).val();
                     
                     var ok = confirm("Are you sure to Delete?");
                     if(ok)
                     {
                        $.ajax({
                        type:'POST',
                        url:'../ajax-request/post_login_response.php',
                        data:'delete_id='+val,
                        success: function(data) 
                        { 
                        
                        location.reload();


                        }
                        });
                     }
                     else
                     {
                                parent.history.back();

                     }

                 
                                                     
                });

                <!-- delete bank account close -->

               $('#alternet_email_id').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'email',
                    name: 'alternet_email_id',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
                    if(! regex.test(value)) {
                    return 'Please enter correct email address!';}},      

                });
                $('#bank_name').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'bank_name',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[a-zA-Z ]{3,30}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';}},                                   
                });
                <!-- -------------------------------------------------------------------- -->

                  $('#acc_no,#acc_no1,#acc_no2,#acc_no3,#acc_no4,#acc_no5').editable({
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'acc_no',
                    send: 'always',
                    validate: function(value) {
                    var regex = /^[0-9]{9,19}$/;
                    if(! regex.test(value)) {
                    return 'Please enter character only!';}},                                   
                });

                <!-- -------------------------------------------------------------------- -->
                  
                    
                   $('#ifsc_code,#ifsc_code1,#ifsc_code2,#ifsc_code3,#ifsc_code4,#ifsc_code5').editable({
                   
                    url: '../ajax-request/post_login_response.php',
                    type: 'text',
                    name: 'ifsc_code',
                    send: 'always'  ,
                    context: this,

                    validate: function(value) {

                    var regex = /^[A-Z]{4}[0][A-Z0-9]{6}$/;
                    if(! regex.test(value)) {
                    return 'Please enter correct Ifsc Code!';}
                    else
                    {
                     $('#deletebank').css('display', '');
                     $('#addbnkone').css('display', '')

  
                    }
                    
                    }, 
                    success: function(data) {
                   
                     
                    var data = $("#tabshow li.active a").attr("href");
                    location.reload();


                     
                

                   
            },

                });
                 
                <!-- -------------------------------------------------------------------- -->
                $('#swift_code').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'swift_code',
					send: 'always'		
			    });
                $('#bank_address').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'textarea',
					name: 'bank_address',
					send: 'always'		
			    });
                $('#bank_city').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'bank_city',
					send: 'always'		
			    });
                $('#bank_state').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'bank_state',
					send: 'always'		
			    });
                 $('#bank_country').editable({
					url: '../ajax-request/post_login_response.php',
					type: 'text',
					name: 'bank_country',
					send: 'always'		
			    });
                // *** editable avatar *** //
				try {//ie8 throws some harmless exceptions, so let's catch'em
			
					//first let's add a fake appendChild method for Image element for browsers that have a problem with this
					//because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
					try {
						document.createElement('IMG').appendChild(document.createElement('B'));
					} catch(e) {
						Image.prototype.appendChild = function(el){}
					}
			
					var last_gritter
					$('#avatar').editable({
						type: 'image',
						name: 'avatar',
						value: null,
						//onblur: 'ignore',  //don't reset or hide editable onblur?!
						image: {
							//specify ace file input plugin's options here
							btn_choose: 'Change Profile Photo',
							droppable: true,
							maxSize: 1010000,//~100Kb
			
							//and a few extra ones here
							name: 'avatar',//put the field name here as well, will be used inside the custom plugin
							on_error : function(error_type) {//on_error function will be called when the selected file has a problem
								if(last_gritter) $.gritter.remove(last_gritter);
								if(error_type == 1) {//file format error
									last_gritter = $.gritter.add({
										title: 'File is not an image!',
										text: 'Please choose a jpg|gif|png image!',
										class_name: 'gritter-error gritter-center'
									});
								} else if(error_type == 2) {//file size rror
									last_gritter = $.gritter.add({
										title: 'File too big!',
										text: 'Image size should not exceed 100Kb!',
										class_name: 'gritter-error gritter-center'
									});
								}
								else {//other error
								}
							},
							on_success : function() {
								$.gritter.removeAll();

							}
						},
					    url: function(params) {
						// ***UPDATE AVATAR HERE*** //
						var submit_url = '../ajax-request/profile-image-upload.php';//please modify submit_url accordingly
						var deferred = null;
						var avatar = '#avatar';

						//if value is empty (""), it means no valid files were selected
						//but it may still be submitted by x-editable plugin
						//because "" (empty string) is different from previous non-empty value whatever it was
						//so we return just here to prevent problems
						var value = $(avatar).next().find('input[type=hidden]:eq(0)').val();
						if(!value || value.length == 0) {
							deferred = new $.Deferred
							deferred.resolve();
							return deferred.promise();

						}

						var $form = $(avatar).next().find('.editableform:eq(0)')
						var file_input = $form.find('input[type=file]:eq(0)');
						var pk = $(avatar).attr('data-pk');//primary key to be sent to server

						var ie_timeout = null


						if( "FormData" in window ) {
							var formData_object = new FormData();//create empty FormData object
							
							//serialize our form (which excludes file inputs)
							$.each($form.serializeArray(), function(i, item) {
								//add them one by one to our FormData 
								formData_object.append(item.name, item.value);							
							});
							//and then add files
							$form.find('input[type=file]').each(function(){
								var field_name = $(this).attr('name');
								var files = $(this).data('ace_input_files');
								if(files && files.length > 0) {
									formData_object.append(field_name, files[0]);
								}
							});

							//append primary key to our formData
							formData_object.append('pk', pk);

							deferred = $.ajax({
										url: submit_url,
									   type: 'POST',
								processData: false,//important
								contentType: false,//important
								   dataType: 'json',//server response type
									   data: formData_object
							})
						}
						else {
							deferred = new $.Deferred

							var temporary_iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
							var temp_iframe = 
									$('<iframe id="'+temporary_iframe_id+'" name="'+temporary_iframe_id+'" \
									frameborder="0" width="0" height="0" src="about:blank"\
									style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
									.insertAfter($form);
									
							$form.append('<input type="hidden" name="temporary-iframe-id" value="'+temporary_iframe_id+'" />');
							
							//append primary key (pk) to our form
							$('<input type="hidden" name="pk" />').val(pk).appendTo($form);
							
							temp_iframe.data('deferrer' , deferred);
							//we save the deferred object to the iframe and in our server side response
							//we use "temporary-iframe-id" to access iframe and its deferred object

							$form.attr({
									  action: submit_url,
									  method: 'POST',
									 enctype: 'multipart/form-data',
									  target: temporary_iframe_id //important
							});

							$form.get(0).submit();

							//if we don't receive any response after 30 seconds, declare it as failed!
							ie_timeout = setTimeout(function(){
								ie_timeout = null;
								temp_iframe.attr('src', 'about:blank').remove();
								deferred.reject({'status':'fail', 'message':'Timeout!'});
							} , 30000);
						}


						//deferred callbacks, triggered by both ajax and iframe solution
						deferred
						.done(function(result) {//success
							var res = result[0];//the `result` is formatted by your server side response and is arbitrary
							if(res.status == 'OK') 
                            {
                            	$(avatar).get(0).src = res.url;
                                $("#profile_header_img").attr('src', res.url);
                                location.reload(true);
                                
							}
                            else alert(res.message);
						})
						.fail(function(result) {//failure
							alert("There was an error");
						})
						.always(function() {//called on both success and failure
							if(ie_timeout) clearTimeout(ie_timeout)
							ie_timeout = null;	
						});

						return deferred.promise();
						// ***END OF UPDATE AVATAR HERE*** //
					},
						
						success: function(response, newValue) {
                      
                      
						}
					})
				}catch(e) {}
<?php
    } ?>
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'ac_stmt') {
        ?>
    $('.scrollable').each(function () {
        var $this = $(this);
        $(this).ace_scroll({
            size: $this.attr('data-size') || 100,
            //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
        });
    });	
 	$('.input-daterange').datepicker({autoclose:true});
    $.ajax({
        url: "../ajax-request/ac_stmt_html.php",
        type: "GET",
        data: {name:"first_time"},
        success: function(response) {
                $("#fetchProgressbarInner_ac").css("display", "none");
                $("#ac_stmt").append(response);        
        }            
    });
<?php
    } ?> 
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'folio_summary') {
        ?>
    $('.scrollable').each(function () {
        var $this = $(this);
        $(this).ace_scroll({
            size: $this.attr('data-size') || 100,
            //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
        });
    });	
 	$('.input-daterange').datepicker({autoclose:true});
    $.ajax({
        url: "../ajax-request/portfolio_summary_html.php",
        type: "GET",
        data: {name:"first_time"},
        success: function(response) {
                $("#fetchProgressbarInner_ac").css("display", "none");
                $("#ac_stmt").append(response);        
        }            
    });
<?php
    } ?>   
<?php if ($CONFIG->loggedUserId) {
        ?>
    //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
    //so disable dragging when clicking on label
    var agent = navigator.userAgent.toLowerCase();
    if(ace.vars['touch'] && ace.vars['android']) {
      $('#tasks').on('touchstart', function(e){
        var li = $(e.target).closest('#tasks li');
        if(li.length == 0)return;
        var label = li.find('label.inline').get(0);
        if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
      });
    }
<?php
    } ?>	
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'process_forms' || $_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'itr_forms') {
        ?>
			
        $('.date-picker').datepicker({ 
			autoclose: true,
			todayHighlight: true                    
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});

        $(".capGainRadHide").hide();
        $("#salOfLandPropShow").show();
        $("input[name$='capGainOptRadio']").click(function() {
            var capGainRad = $(this).val();
            $(".capGainRadHide").hide();
            $("#" + capGainRad + "Show").show();
            // alert(capGainRad);
        });
        $(".housePropertyHide").hide();
        $("#selfOccPropertyShow").show();
        $("input[name$='housePropertyRadio']").click(function() {
            var houseProperty = $(this).val();
            $(".housePropertyHide").hide();
            $("#" + houseProperty + "Show").show();
            // alert(houseProperty);
        });
        $(".dedDonationHide").hide();
        $("#charity100DedShow").show();
        $("input[name$='deductionDonRadio']").click(function() {
            var deductionDon = $(this).val();
            $(".dedDonationHide").hide();
            $("#" + deductionDon + "Show").show();
            // alert(deductionDon);
        });
        $(".foreignAssetsHide").hide();
        $("#foreignAssetsShow").show();
        $("input[name$='foreignAssetsOtptRadio']").click(function() {
            var foreignAss = $(this).val();
            $(".foreignAssetsHide").hide();
            $("#" + foreignAss + "Show").show();
            // alert(foreignAss);
        });


/*****************************ITR************************************/        
	$('.scrollable').each(function () {
        var $this = $(this);
        $(this).ace_scroll({
            size: $this.attr('data-size') || 100,
            //styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
        });
    });	
    
    var rowCount =  1;	//$('#condition_ids').val().split(',').length;
	var reportRow = '';
    
	$(".add_income").click(function () {
            reportRow = '<tr id="_tr_row_'+rowCount+'"><td width="1%" align="left"><b class="green">'+rowCount+'</b>.&nbsp;</td><td width="2%" align="left"><input type="text" name="_other_income_'+rowCount+'" id="_other_income_'+rowCount+'" value="" /></td><td width="2%" align="left"><input type="text" name="_other_income_amount_'+rowCount+'" id="_other_income_amount_'+rowCount+'" value="" /></td><td width="2%" align="left"><a title="Delete Condition" href="#" onclick="$(\'#_tr_row_'+rowCount+'\').remove();"><i class="ace-icon fa fa-times red"></i></a></td></tr>';  
             $("#other_income_table").removeClass("hide");  
             $('#_row_condition').append(reportRow);            
             rowCount++;   
           // alert(rowCount);               
    });
<?php
    } ?>	

<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'uploadform' || $_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'itr_forms') {
        if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'itr_forms') {
            $dotDot = '../';
        } ?>
	/**********************UPLOADER***************************************/
    	if(location.protocol == 'file:') alert("For retrieving data from server, you should access this page using a webserver.");
	
	var uploader = new plupload.Uploader({
		runtimes : 'gears,html5,flash,silverlight,browserplus',
		browse_button : 'pickfiles',
		container : 'container',
		max_file_size : '20mb',
		url : '<?php echo $dotDot; ?>ajax-request/upload.php',
		flash_swf_url : '<?php echo $CONFIG->siteurl; ?>__UI.assets/plupload/js/plupload.flash.swf',
		silverlight_xap_url : '<?php echo $CONFIG->siteurl; ?>__UI.assets/plupload/js/plupload.silverlight.xap',
		filters : [
			{title : "PDF Files", extensions : "pdf"}
		],
		resize : {width : 320, height : 240, quality : 90}
	});
	
	uploader.bind('Init', function(up, params) {
		//$('#filelist').html("<div>Current runtime: " + params.runtime + "</div>");
	});
	
	uploader.bind('BeforeUpload', function(up, files) {
		$('input.'+files.id).attr('readonly','readonly');
		up.settings.multipart_params = {"custom_name": $('input.'+files.id).val() };
        $('#pickfiles').addClass('hide');
	});

	$('#uploadfiles').click(function(e) {
		uploader.start();
		e.preventDefault();
	});

	uploader.init();

	uploader.bind('FilesAdded', function(up, files) {
		$('#filelist').html('');
		if(files.length<=10)
		{
			$.each(files, function(i, file) {
			
				$('#filelist').append(
					'<div class="upload_box"><div id="' + file.id + '" class="file_list"><p class="first"><strong>File Name:</strong> ' +
					file.name + ' </p><p><strong>File Size:</strong> ' + plupload.formatSize(file.size) + '</p><div class="progress"><div class="bar bar-success bar_'+file.id+'"><b></b></div></div><div style="margin-top:10px;"><input type="hidden" style="width:94%"/ class="' + file.id + '"></div></div></div>');
			});
            uploader.start();
		}
		else
		{
			up.splice('0',(files.length+1));
			alert('Please Select 1 Documents.');
		}

		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader.bind('UploadComplete', function(up, file) {
	
		var total_files_uploaded = file.length;
		//$('#filelist').prepend('<p><b>'+total_files_uploaded+' File(s) Uploaded Successfully</b></p>');
		up.splice('0',file.length);
       var salary_id = $("input[name='hidchecksalary[]']").val();
        <?php if ($CONFIG->loggedUserId != '') {
            ?>               
                $('#fetchProgressbarInner').css('width',"99%");               
               location.href='<?php echo $CONFIG->siteurl; ?>mySaveTax/?salary_id='+salary_id+'&formsDataID='+<?= $CONFIG->currentITRID; ?>+  '&module_interface=<?php echo $commonFunction->setPage('middle_layer_redirection'); ?>';
		<?php
        } else {
            ?>
            $('#signup').addClass('show');
        <?php
        } ?>          
	});

	uploader.bind('UploadProgress', function(up, file) {
		$('#' + file.id + " b").html(file.percent + "%");
		$('.bar_'+file.id).css('width',file.percent+"%");
        if(file.percent == 100)
        {
			<?php if ($CONFIG->loggedUserId) {
            ?>               
                $('#form_text').addClass('show');
            <?php
        } else {
            ?>
                $('#signup').addClass('show');
            <?php
        } ?>        
        }
	});

	uploader.bind('Error', function(up, err) {
		$('#filelist').append("<div>Error Message: " + err.message +
			(err.file ? ", File: " + err.file.name : "") +
			"</div>"
		);
		up.refresh(); // Reposition Flash/Silverlight
	});
	
	uploader.bind('FileUploaded', function(up, file,info) {
        $('#' + file.id + " b").html("100%");		
        //$('#' + file.id).parent().css('display','none');
        var response = JSON.parse(info.response);
        $('#form_data_id').val(response.id);
        //alert(response.id);
	});
    /**********************UPLOADER***************************************/
    
    
   <?php
    } ?>
});
<?php if ($_SESSION[$CONFIG->sessionPrefix.'page_name'] == 'profile') {
        ?>
	function ajaxCallKeyValue(key,value)
	{
		$.ajax( {
		  type: "POST",
		  url: "../ajax-request/post_login_response.php",
		  data: {"name":key,"value":value},
		  success: function( response ) {
			$('#package_response').append(response);
		  }
		});
	}
    function calcAge(getDOB)
    {
        var mdate = getDOB.toString();
        var yearThen = parseInt(mdate.substring(0,4), 10);
        var monthThen = parseInt(mdate.substring(5,7), 10);
        var dayThen = parseInt(mdate.substring(8,10), 10);
        
        var today = new Date();
        var birthday = new Date(yearThen, monthThen-1, dayThen);
        
        var differenceInMilisecond = today.valueOf() - birthday.valueOf();
        
        var year_age = Math.floor(differenceInMilisecond / 31536000000);
        var day_age = Math.floor((differenceInMilisecond % 31536000000) / 86400000);
        
        if ((today.getMonth() == birthday.getMonth()) && (today.getDate() == birthday.getDate())) {
           // alert("Happy B'day!!!");
        }
        
        var month_age = Math.floor(day_age/30);
        
        day_age = day_age % 30;
        
        if (isNaN(year_age) || isNaN(month_age) || isNaN(day_age)) {
            $("#calcAge").html("Invalid birthday - Please try again!");
        }
        else {
            $("#calcAge").html(year_age + " years " + month_age + " months " + day_age );
        }
    }
<?php
    } ?>

function getMutualFundShemes(thisObj, riskType, sipAmount)
	{
		$.ajax( {
		  type: "POST",
		  url: "<?php echo $CONFIG->siteurl; ?>ajax-request/list_of_scheme.php",
		  data: {"riskType":riskType,"sipAmount":sipAmount},
		  success: function( response ) {
			thisObj.parents('.calculateGoal').find ('table.listOfScheme').html(response);
		  }
		});
	return true;	
	}

	function placeSIPOrderBSE1()
	{
		$.ajax( {
		  type: "POST",
		  url: "http://162.144.140.80:8000/admin/bse/order",
		  dataType: "json",
		  data: JSON.stringify({
"transactionType":"1",
"transactionCode":"NEW",
"unique_reference_number":"",
"orderId":"",
"userId":"1100301",
"memberId":"11003",
"clientCode":"devtax1801",
"schemeCd":"02-DP",
"buySell":"P",
"buySellType":"FRESH",
"dpTxn":"P",
"amount":20000,
"qty":"0.0000",
"allRedeem":"N",
"folioNo":"",
"remarks":"",
"kycStatus":"Y",
"refNo":"",
"subBrCode":"",
"euin":"",
"euinFlag":"N",
"minRedeem":"N",
"dpc":"N",
"ipAdd":"",
"password":"123456",
"passKey":"asdfdkfh7",
"param1":"",
"param2":"",
"param3":""
}),
		  success: function( response ) {
			console.log(response);
		  }
		});
	}
	
function placeSIPOrderBSE( samount ){
	var sipamount = samount;
	console.log(sipamount);
var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://162.144.140.80:8000/admin/bse/order",
  "method": "POST",
  "headers": {
    "Content-Type": "application/json",
    "Cache-Control": "no-cache",
  },
  "processData": false,
  "data": "{\"transactionType\":\"1\",\"transactionCode\":\"NEW\",\"unique_reference_number\":\"\",\"orderId\":\"\",\"userId\":\"1100301\",\"memberId\":\"11003\",\"clientCode\":\"devtax1801\",\"schemeCd\":\"02-DP\",\"buySell\":\"P\",\"buySellType\":\"FRESH\",\"dpTxn\":\"P\",\"amount\":10000,\"qty\":\"0.0000\",\"allRedeem\":\"N\",\"folioNo\":\"\",\"remarks\":\"\",\"kycStatus\":\"Y\",\"refNo\":\"\",\"subBrCode\":\"\",\"euin\":\"\",\"euinFlag\":\"N\",\"minRedeem\":\"N\",\"dpc\":\"N\",\"ipAdd\":\"\",\"password\":\"123456&\",\"passKey\":\"asdfdkfh7\",\"param1\":\"\",\"param2\":\"\",\"param3\":\"\"}"
}

$.ajax(settings).done(function (response) {
  console.log(response);
	$('#devTaxModal .modal-body').html(response);
   $('#devTaxModal').modal('toggle');
});

}
	
$('#startInvestment').click(function(){
	var sipamount = $('input.sipamount').val();
	placeSIPOrderBSE(sipamount);
});	
	
function signupJS(form)
{

    if(!(/^[0-9\-]+$/.test($("#mobile").val())))
    {
        $("#signup_invalid_email").html('Please enter valid mobile no.');
        $("#signup_invalid_email").css("display", "block");
        return false;
    }
    if($("#mobile").val().length != 10)
    {
        $("#signup_invalid_email").html('Please enter valid mobile no.');
        $("#signup_invalid_email").css("display", "block");
        return false;
    }
    if($("#reg_passwd").val().length < 6)
    {
        $("#signup_invalid_email").html('Password must be 6 character long.');
        $("#signup_invalid_email").css("display", "block");
        return false;
    }		
    if($("#reg_passwd").val() != $("#repasswd").val())
    {
        $("#signup_invalid_email").html('Password Mismatch.');
        $("#signup_invalid_email").css("display", "block");
        return false;
    }
    $("#signup_invalid_email").html('');		
    $("#signup_loader").css("display", "block");	
    $("#signup_invalid_email").css("display", "none");
    $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            //console.log(response);
            //alert(response);
            if(response.indexOf('WRONG_PASSCODE')==0)
            {
                $("#verifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#signup_loader").css("display", "none");
                $("#signup_invalid_email").html('Invalid security code.');
                $("#signup_invalid_email").css("display", "block");
                $("#email").focus();
            }
            else if(response.indexOf('REGISTER_DONE')==0)
            {									
                location.href='<?php echo $CONFIG->siteurl; ?>mySaveTax/';				
            }
            else
            {
                $("#verifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#signup_loader").css("display", "none");
                $("#signup_invalid_email").html('Email Already Exists.');
                $("#signup_invalid_email").css("display", "block");
                $("#email").focus();
            }
        }            
    });
    return false;
}

function attachePAN(form)
{
	 $('#attach_status').html('<img src="<?php echo $CONFIG->staticURL.$CONFIG->theme; ?>img/formsubmitpreloader.gif">');
	 $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
        	$('#attach_status').html(response);
        }            
    });
}
/*----------------------------------- 20190226-BSEN -------------------------------------*/
function ajaxFormSubmit(form,tabGroup,nxtTab)
{ 
    var $form = $(form);
    var msgRes = $form.find('.ajaxResClass');
	
	if((form.id != "form_1") && (!$("#tabUserProf").hasClass("form-submitted")))
	{
		msgRes.html("Please complete personal details form to continue.");
		return;
	}	
    
    msgRes.html('<img src="<?php echo $CONFIG->staticURL.$CONFIG->theme; ?>img/formsubmitpreloader.gif">');
    $.ajax({
        url: form.action,
        type: form.method,
        data: $form.serialize(),
        success: function(response) {
            //console.log(response);
            /*----------------------------------- for Testing -------------------------------------*/
            //console.log(response);
            msgRes.html("Data updated successfully.");
            
            var next_tab = $form.closest('.tab-pane').data('next-tab');
            
            if(next_tab)
            {
                $('a[href="'+next_tab+'"]').tab('show');
            }

			if(form.id == "form_1")
			{
				$("#tabUserProf").addClass("form-submitted");
			}		
        }            
    });
}

function loginJS(form)
{		
    $("#login_loader").css("display", "block");	
    $("#login_invalid_email").css("display", "none");
    $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
        //alert(response);
        console.log(response);
            if(response.indexOf('PASS')==0 || response.indexOf('PASS')>0)
                location.href='<?php echo $CONFIG->siteurl; ?>mySaveTax/';
            else
            {
            alert("Login failed. Please ensure username and password are correct.");
                $("#login_loader").css("display", "none");
                $("#login_invalid_email").css("display", "block");
                $("#email").focus();
            }
        }            
    });
    return false;
}		
function doResetPasswordJS(form)
{		
    $("#reset_invalid_email").html('');		
    $("#reset_loader").css("display", "block");	
    $("#reset_invalid_email").css("display", "none");
    $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            //  alert(response);
            console.log(response);
            response = response.trim();
            if(response.indexOf('RESET_DONE')==0|| response.indexOf('RESET_DONE')>0)
            {			
                $("#reset_email").val('');		
                $("#reset_sec_code").val('');	
                $("#resetverifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#reset_loader").css("display", "none");
                $("#reset_invalid_email").html('Please check your mail, to change password.');
                $("#reset_invalid_email").css("display", "block");
            }
            else if(response.indexOf('WRONG_PASSCODE')==0 || response.indexOf('WRONG_PASSCODE')>0)
            {
                $("#resetverifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#reset_loader").css("display", "none");
                $("#reset_invalid_email").html('Wrong security code.');
                $("#reset_invalid_email").css("display", "block");
                $("#reset_sec_code").focus();
            }				
            else
            {
                $("#resetverifyCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#reset_loader").css("display", "none");
                $("#reset_invalid_email").html('Email Not Found.');
                $("#reset_invalid_email").css("display", "block");
                $("#reset_email").focus();
            }
        }            
    });
    return false;
}		
function doRecoverPasswordJS(form)
{		
	if($("#form_pass").val().length < 6)
    {
        $("#reset_invalid_email").html('Password must be 6 character long.');
        $("#reset_invalid_email").css("display", "block");
        return false;
    }	
	if($("#form_pass").val() != $("#form_cpass").val())
    {
        $("#reset_invalid_email").html('Password and Confirm Password Mismatch.');
        $("#reset_invalid_email").css("display", "block");
        return false;
    }
    $("#reset_invalid_email").html('');		
    $("#reset_loader").css("display", "block");	
    $("#reset_invalid_email").css("display", "none");
    $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            if(response.indexOf('PASSWORD_CHANGED')==0)
            {			
                $("#reset_email").val('');		
                $("#reset_sec_code").val('');	
                $("#resetCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#reset_loader").css("display", "none");
                $("#reset_invalid_email").html('Password has been changed successfully.');
                $("#reset_invalid_email").css("display", "block");
            }
            else if(response.indexOf('WRONG_PASSCODE')==0)
            {
                $("#resetCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#reset_loader").css("display", "none");
                $("#reset_invalid_email").html('Wrong security code.');
                $("#reset_invalid_email").css("display", "block");
                $("#reset_sec_code").focus();
            }				
            else
            {
                $("#resetCaptcha").attr('src', "captcha/securimage_show.php?"+$.now());
                $("#reset_loader").css("display", "none");
                $("#reset_invalid_email").html('Email Not Found.');
                $("#reset_invalid_email").css("display", "block");
                $("#reset_email").focus();
            }
        }            
    });
    return false;
}		
function randomString()
{
	var rsa = new RSAKey();								
    rsa.setPublic('83a1f4c17bfaca642ec309cbf5d575a8c311cecaf1cf943aa0eb656f71c957e23240282d01090c7d8e56b16d9957ade3acf31fda040d68fdb7b15cf8f6890513', '10001');
	var password=rsa.encrypt(document.getElementById('password').value);
	document.getElementById('password').value = password +'83a1f4'+"08a3d83c3641d199560a3d27edb72461";
}


function placeBSEOrder(form)
{
	$("#nav_error").css("display", "none");	//$('.error').addClass('hide');	//
    
    if($("#nav_amount").val() =='')
    {
    	$("#nav_error").css("display", "block");
         return false;
    }
    if(!(/^[0-9\-]+$/.test($("#nav_amount").val())))
    {
        $("#nav_error").css("display", "block");  
        return false;
    }
    if($("#nav_amount").val() >= $("#jsAMT").val())
    {
    	$("#nav_error").css("display", "none;");  //alert($("#nav_amount").val()); 
    }
    else
    {
       $("#nav_error").css("display", "block");     
        return false;
    }
    $("#bse_order_loading").removeClass("hide");
    $("#bse_order_response").html('');
	 $.ajax({
        url: form.action,
        type: form.method,
        data: $(form).serialize(),
        success: function(response) {
            //alert(response);
        	$("#bse_order_loading").addClass("hide");
            $("#bse_order_response").html(response);
            $("#bse_order_response").addClass("show");
        }            
    });
}

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Amount', 'Toatal'],
        ['Equity', 33],
        ['Debt', 77]
    ]);

    var options = {
        title: 'Investment allocation',
        left:20,
        top:0
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}
function calc_time(time)
{
  var time_period;
  if (time == 1) {
    time_period = "years";
  }else if(time == 12){
    time_period = "months";
  }else if(time_period == 365 || time_period == 366){
    time_period = "days";
  }
  return time_period;
}


//Fixed deposit simple interest
function clc_simpleInt(principal,n,time,rate,aa)
{
  var  rate2 = parseFloat(rate)/100;
  var amount_interest = parseFloat(principal) * (1+ (parseFloat(rate2/aa)*time));
  return amount_interest;
}

// Recurring Deposit
function clc_recurrInt(monthlyInstallment,numberOfMonths,rateOfInterest)
{
  var frequency = Math.floor(numberOfMonths/3); // Quarterly
  var accumulateMonthlyAmount = parseInt(monthlyInstallment) * ((Math.pow(rateOfInterest / 400 + 1, frequency) - 1) / (1-(Math.pow(rateOfInterest / 400 + 1,(-1/3)))));
  var finalInterestGain = accumulateMonthlyAmount - monthlyInstallment * numberOfMonths;
  var depositedAmount = monthlyInstallment * numberOfMonths;
  return accumulateMonthlyAmount;
}

//Home loan
function clc_emi(P,n,r)
{
  var x = Math.pow(1 + r, n); //Math.pow computes powers
  var emi = (P*x*r)/(x-1);
  return emi;
}

//ssy function
function clc_SSY(principalVal,intRate)
{
  var amt = 0;
  for (var i = 1; i <= 21; i++)
  { var show = ''; 
    if(i>=1 &&i<=15)
    {
        amt = (amt + principalVal);
    }
    amt = Math.round(amt + (amt*intRate/100));
  }
  return amt;
}

//ppf function
function clc_PPF(principalVal,intRate,years)
{
  principalVal = parseFloat(principalVal);
  intRate      = parseFloat(intRate);
  years        = parseInt(years);
  var amt = 0;
  for (var i = 1; i <= years; i++)
  { var show = '';
    if(i>=1 &&i<=15)
    {
        amt = (amt + principalVal);
    }
    amt = Math.round(amt + Math.round((amt*intRate/100)));
  }
  return amt;
}
