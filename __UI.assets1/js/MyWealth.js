$(document).ready(function() {

    // Retire rich start
    $('#Ret_risk').change(function() {
        $('#Ret_expRateReturn').val($(this).val());
    });

    $('#retirerichBtn').click(function() {
        var currentAge = $('#Ret_age').val();
        var retireAge = $('#Ret_retireAge').val();
        var lifeExpetency = $('#Ret_expectancy').val();
        var rate = $('#Ret_expRateReturn').val();
        var expensPerMon = $('#Ret_expPerMonth').val();
        var lumsumAmount = $('#Ret_currentLumpsum').val();
        var inflation = 5;
        var rateRetirement = 7;
        var sipInvestMoney = 5000;

        var inflationRate = inflation / 100;
        var noOfYrs = retireAge - currentAge;
        var rateTillRetire = rate / 100;
        var retirementPeriod = lifeExpetency - retireAge;
        var rateDuringRetire = rateRetirement / 100;
        var realRate = [(1 + rateDuringRetire) / (1 + inflationRate) - 1] / 12;
        var realRate1 = realRate.toFixed(7);
        var a = Math.pow((1 + rateTillRetire), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var fvAfterCurrExpns = expensPerMon * (Math.pow((1 + inflationRate), (noOfYrs)));
        var b = Math.pow((1 + realRate), (retirementPeriod * 12));
        var x = (b - 1);
        var y = 1 / x;
        var z = 1 + y;
        var pvRetireCorpus = (fvAfterCurrExpns) * (1 + realRate) / (realRate * z);
        var lumsunInvPower = Math.pow((1 + rateTillRetire), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var fvSipAmountInvPerMon = pvRetireCorpus - fvLumsumInvest;
        var sipAmountInvPerMonPow = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmountInvPerMonPowFinal = (sipAmountInvPerMonPow - 1);
        var sipAmountInvPerMonUpper = fvSipAmountInvPerMon * nominal;
        var sipAmountInvPerMonLower = sipAmountInvPerMonPowFinal * (1 + nominal);
        var sipAmount = sipAmountInvPerMonUpper / sipAmountInvPerMonLower;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow * (1 + nominal);
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;

        $('#Scurrent_age').val(currentAge);
        $('#Sretirement_age').val(retireAge);
        $('#Slife_expectancy').val(lifeExpetency);
        $('#Scurrent_lumpsum').val(lumsumAmount);
        $('#SMonthly_contribution').val(Math.round(sipAmount));
        $('#SRate_return').val(rate);
        $('#SRate_inflation').val(inflation);
        $('#SRate_return_aft').val(rateRetirement);
        $('#SMonthly_expenses_aft').val(expensPerMon);

        $('#Ret_FVAmt').text(Math.round(pvRetireCorpus));
        $('#Ret_PerMonthAmt').text(Math.round(sipAmount));
        $('#Ret_InvSipAmt1').text(Math.round(sipAmount));
        $('#Ret_InvSIPAmt2').text(Math.round(sipInvestMoney));
        $('#Ret_TotalRetFunds').text(Math.round(fvSipInvestLumsum));
        $('#SRate_SIPPerMonAmt').val(Math.round(sipInvestMoney));
    });

    $('#SRisk_curr_undertaken').change(function() {
        $('#SRate_return').val($(this).val());
        var currentAge = $('#Scurrent_age').val();
        var retireAge = $('#Sretirement_age').val();
        var lifeExpetency = $('#Slife_expectancy').val();
        var rate = $('#SRate_return').val();
        var expensPerMon = $('#SMonthly_expenses_aft').val();
        var lumsumAmount = $('#Scurrent_lumpsum').val();
        var inflation = $('#SRate_inflation').val();
        var rateRetirement = $('#SRate_return_aft').val();
        var sipInvestMoney = $('#SRate_SIPPerMonAmt').val();
        var inflationRate = inflation / 100;
        var noOfYrs = retireAge - currentAge;
        var rateTillRetire = rate / 100;
        var retirementPeriod = lifeExpetency - retireAge;
        var rateDuringRetire = rateRetirement / 100;
        var realRate = [(1 + rateDuringRetire) / (1 + inflationRate) - 1] / 12;
        var realRate1 = realRate.toFixed(7);
        var a = Math.pow((1 + rateTillRetire), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var fvAfterCurrExpns = expensPerMon * (Math.pow((1 + inflationRate), (noOfYrs)));
        var b = Math.pow((1 + realRate), (retirementPeriod * 12));
        var x = (b - 1);
        var y = 1 / x;
        var z = 1 + y;
        var pvRetireCorpus = (fvAfterCurrExpns) * (1 + realRate) / (realRate * z);
        var lumsunInvPower = Math.pow((1 + rateTillRetire), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var fvSipAmountInvPerMon = pvRetireCorpus - fvLumsumInvest;
        var sipAmountInvPerMonPow = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmountInvPerMonPowFinal = (sipAmountInvPerMonPow - 1);
        var sipAmountInvPerMonUpper = fvSipAmountInvPerMon * nominal;
        var sipAmountInvPerMonLower = sipAmountInvPerMonPowFinal * (1 + nominal);
        var sipAmount = sipAmountInvPerMonUpper / sipAmountInvPerMonLower;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow * (1 + nominal);
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;


        $('#Scurrent_age').val(currentAge);
        $('#Sretirement_age').val(retireAge);
        $('#Slife_expectancy').val(lifeExpetency);
        $('#Scurrent_lumpsum').val(lumsumAmount);
        $('#SMonthly_contribution').val(Math.round(sipAmount));
        $('#SRate_return').val(rate);
        $('#SRate_inflation').val(inflation);
        $('#SRate_return_aft').val(rateRetirement);
        $('#SMonthly_expenses_aft').val(expensPerMon);

        $('#Ret_FVAmt').text(Math.round(pvRetireCorpus));
        $('#Ret_PerMonthAmt').text(Math.round(sipAmount));
        $('#Ret_InvSipAmt1').text(Math.round(sipAmount));
        $('#Ret_InvSIPAmt2').text(Math.round(sipInvestMoney));
        $('#Ret_TotalRetFunds').text(Math.round(fvSipInvestLumsum));
        $('#SRate_SIPPerMonAmt').val(Math.round(sipInvestMoney));
    });

    $('#SRisk_undertaken_aft').change(function() {
        $('#SRate_return_aft').val($(this).val());
        var currentAge = $('#Scurrent_age').val();
        var retireAge = $('#Sretirement_age').val();
        var lifeExpetency = $('#Slife_expectancy').val();
        var rate = $('#SRate_return').val();
        var expensPerMon = $('#SMonthly_expenses_aft').val();
        var lumsumAmount = $('#Scurrent_lumpsum').val();
        var inflation = $('#SRate_inflation').val();
        var rateRetirement = $('#SRate_return_aft').val();
        var sipInvestMoney = $('#SRate_SIPPerMonAmt').val();
        var inflationRate = inflation / 100;
        var noOfYrs = retireAge - currentAge;
        var rateTillRetire = rate / 100;
        var retirementPeriod = lifeExpetency - retireAge;
        var rateDuringRetire = rateRetirement / 100;
        var realRate = [(1 + rateDuringRetire) / (1 + inflationRate) - 1] / 12;
        var realRate1 = realRate.toFixed(7);
        var a = Math.pow((1 + rateTillRetire), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var fvAfterCurrExpns = expensPerMon * (Math.pow((1 + inflationRate), (noOfYrs)));
        var b = Math.pow((1 + realRate), (retirementPeriod * 12));
        var x = (b - 1);
        var y = 1 / x;
        var z = 1 + y;
        var pvRetireCorpus = (fvAfterCurrExpns) * (1 + realRate) / (realRate * z);
        var lumsunInvPower = Math.pow((1 + rateTillRetire), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var fvSipAmountInvPerMon = pvRetireCorpus - fvLumsumInvest;
        var sipAmountInvPerMonPow = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmountInvPerMonPowFinal = (sipAmountInvPerMonPow - 1);
        var sipAmountInvPerMonUpper = fvSipAmountInvPerMon * nominal;
        var sipAmountInvPerMonLower = sipAmountInvPerMonPowFinal * (1 + nominal);
        var sipAmount = sipAmountInvPerMonUpper / sipAmountInvPerMonLower;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow * (1 + nominal);
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;

        $('#Scurrent_age').val(currentAge);
        $('#Sretirement_age').val(retireAge);
        $('#Slife_expectancy').val(lifeExpetency);
        $('#Scurrent_lumpsum').val(lumsumAmount);
        $('#SMonthly_contribution').val(Math.round(sipAmount));
        $('#SRate_return').val(rate);
        $('#SRate_inflation').val(inflation);
        $('#SRate_return_aft').val(rateRetirement);
        $('#SMonthly_expenses_aft').val(expensPerMon);

        $('#Ret_FVAmt').text(Math.round(pvRetireCorpus));
        $('#Ret_PerMonthAmt').text(Math.round(sipAmount));
        $('#Ret_InvSipAmt1').text(Math.round(sipAmount));
        $('#Ret_InvSIPAmt2').text(Math.round(sipInvestMoney));
        $('#Ret_TotalRetFunds').text(Math.round(fvSipInvestLumsum));
        $('#SRate_SIPPerMonAmt').val(Math.round(sipInvestMoney));
    });

    $('.Ret_SummaryChange').blur(function() {
        var currentAge = $('#Scurrent_age').val();
        var retireAge = $('#Sretirement_age').val();
        var lifeExpetency = $('#Slife_expectancy').val();
        var rate = $('#SRate_return').val();
        var expensPerMon = $('#SMonthly_expenses_aft').val();
        var lumsumAmount = $('#Scurrent_lumpsum').val();
        var inflation = $('#SRate_inflation').val();
        var rateRetirement = $('#SRate_return_aft').val();
        var sipInvestMoney = $('#SRate_SIPPerMonAmt').val();
        var inflationRate = inflation / 100;
        var noOfYrs = retireAge - currentAge;
        var rateTillRetire = rate / 100;
        var retirementPeriod = lifeExpetency - retireAge;
        var rateDuringRetire = rateRetirement / 100;
        var realRate = [(1 + rateDuringRetire) / (1 + inflationRate) - 1] / 12;
        var realRate1 = realRate.toFixed(7);
        var a = Math.pow((1 + rateTillRetire), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var fvAfterCurrExpns = expensPerMon * (Math.pow((1 + inflationRate), (noOfYrs)));
        var b = Math.pow((1 + realRate), (retirementPeriod * 12));
        var x = (b - 1);
        var y = 1 / x;
        var z = 1 + y;
        var pvRetireCorpus = (fvAfterCurrExpns) * (1 + realRate) / (realRate * z);
        var lumsunInvPower = Math.pow((1 + rateTillRetire), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var fvSipAmountInvPerMon = pvRetireCorpus - fvLumsumInvest;
        var sipAmountInvPerMonPow = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmountInvPerMonPowFinal = (sipAmountInvPerMonPow - 1);
        var sipAmountInvPerMonUpper = fvSipAmountInvPerMon * nominal;
        var sipAmountInvPerMonLower = sipAmountInvPerMonPowFinal * (1 + nominal);
        var sipAmount = sipAmountInvPerMonUpper / sipAmountInvPerMonLower;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow * (1 + nominal);
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;

        $('#Scurrent_age').val(currentAge);
        $('#Sretirement_age').val(retireAge);
        $('#Slife_expectancy').val(lifeExpetency);
        $('#Scurrent_lumpsum').val(lumsumAmount);
        $('#SMonthly_contribution').val(Math.round(sipAmount));
        $('#SRate_return').val(rate);
        $('#SRate_inflation').val(inflation);
        $('#SRate_return_aft').val(rateRetirement);
        $('#SMonthly_expenses_aft').val(expensPerMon);

        $('#Ret_FVAmt').text(Math.round(pvRetireCorpus));
        $('#Ret_PerMonthAmt').text(Math.round(sipAmount));
        $('#Ret_InvSipAmt1').text(Math.round(sipAmount));
        $('#Ret_InvSIPAmt2').text(Math.round(sipInvestMoney));
        $('#Ret_TotalRetFunds').text(Math.round(fvSipInvestLumsum));
        $('#SRate_SIPPerMonAmt').val(Math.round(sipInvestMoney));
    });
    // Retire rich end


    // Grand Wedding start
    $('#gndWedRiskTaken').change(function() {
        $('#gndWedIntRate').val($(this).val());
    });

    $('#gndWedProcessBtn1').click(function() {
        var currentAge = $('#gndWedCurrAge').val();
        var marrigeAge = $('#gndWedMariageAge').val();
        var requiredAmount = $('#gndWedAmt').val();
        var lumsumAmount = $('#gndWedLumpsumAmt').val();
        var rate = $('#gndWedIntRate').val();
        var inflationRate = $('#gndWedInfRate').val();
        var sipInvestMoney;

        var noOfYrs = marrigeAge - currentAge;
        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipInvestMoney = sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#gndWedNumYears').val(noOfYrs);
        $('#gndWedAmt2').val(requiredAmount);
        $('#gndWedLumpsumAmt2').val(lumsumAmount);
        $('#gndWedInvPerMonth').val(Math.round(sipAmount));
        $('#gndWedIntRate2').val(rate);
        $('#gndWedInfRate2').val(inflationRate);
        $('#gndInvSipAmt').val(Math.round(sipInvestMoney));

        $('#gndWedFvAmt').text(Math.round(fv));
        $('#gndWedSipAmt').text(Math.round(sipAmount));
        $('#gndWedSipAmt2').text(Math.round(sipInvestMoney));
        $('#gndWedAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#gndWedSipInv').text(gap2);
    });

    $('#gndWedRiskTaken2').change(function() {
        $('#gndWedIntRate2').val($(this).val());
        var requiredAmount = $('#gndWedAmt2').val();
        var lumsumAmount = $('#gndWedLumpsumAmt2').val();
        var rate = $('#gndWedIntRate2').val();
        var inflationRate = $('#gndWedInfRate2').val();
        var noOfYrs = $('#gndWedNumYears').val();
        var sipInvestMoney = $('#gndInvSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#gndWedNumYears').val(noOfYrs);
        $('#gndWedAmt2').val(requiredAmount);
        $('#gndWedLumpsumAmt2').val(lumsumAmount);
        $('#gndWedInvPerMonth').val(Math.round(sipAmount));
        $('#gndWedIntRate2').val(rate);
        $('#gndWedInfRate2').val(inflationRate);
        $('#gndInvSipAmt').val(sipInvestMoney);

        $('#gndWedFvAmt').text(Math.round(fv));
        $('#gndWedSipAmt').text(Math.round(sipAmount));
        $('#gndWedSipAmt2').text(sipInvestMoney);
        $('#gndWedAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#gndWedSipInv').text(gap2);
    });

    $('.gndWedSummaryChange').change(function() {
        var requiredAmount = $('#gndWedAmt2').val();
        var lumsumAmount = $('#gndWedLumpsumAmt2').val();
        var rate = $('#gndWedIntRate2').val();
        var inflationRate = $('#gndWedInfRate2').val();
        var noOfYrs = $('#gndWedNumYears').val();
        var sipInvestMoney = $('#gndInvSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#gndWedNumYears').val(noOfYrs);
        $('#gndWedAmt2').val(requiredAmount);
        $('#gndWedLumpsumAmt2').val(lumsumAmount);
        $('#gndWedInvPerMonth').val(Math.round(sipAmount));
        $('#gndWedIntRate2').val(rate);
        $('#gndWedInfRate2').val(inflationRate);
        $('#gndInvSipAmt').val(sipInvestMoney);

        $('#gndWedFvAmt').text(Math.round(fv));
        $('#gndWedSipAmt').text(Math.round(sipAmount));
        $('#gndWedSipAmt2').text(sipInvestMoney);
        $('#gndWedAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#gndWedSipInv').text(gap2);
    });
    // Grand Wedding end

    //Higher Education Start
    $('#highEduRiskTaken').change(function() {
        $('#highEduIntRate').val($(this).val());
    });

    $('#highEduProcessBtn1').click(function() {
        var currentAge = $('#highEduCurrAge').val();
        var marrigeAge = $('#highEduSrtAge').val();
        var requiredAmount = $('#highEduAmt').val();
        var lumsumAmount = $('#highEduLumpsumAmt').val();
        var rate = $('#highEduIntRate').val();
        var inflationRate = $('#highEduInfRate').val();
        var sipInvestMoney = 5000;

        var noOfYrs = marrigeAge - currentAge;
        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvLumsumInvest;

        $('#highEduNumYears').val(noOfYrs);
        $('#highEduAmt2').val(requiredAmount);
        $('#highEduLumpsumAmt2').val(lumsumAmount);
        $('#highEduInvPerMonth').val(Math.round(sipAmount));
        $('#highEduIntRate2').val(rate);
        $('#highEduInfRate2').val(inflationRate);
        $('#highEduSipAmt').val(sipInvestMoney);

        $('#highEduFvAmt').text(Math.round(fv));
        $('#highEduSipAmt3').text(Math.round(sipAmount));
        $('#highEduSipAmt2').text(Math.round(sipInvestMoney));
        $('#highEduAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#highEduSipInv').text(gap2);
    });

    $('#highEduRiskTaken2').change(function() {
        $('#highEduIntRate2').val($(this).val());
        var requiredAmount = $('#highEduAmt2').val();
        var lumsumAmount = $('#highEduLumpsumAmt2').val();
        var rate = $('#highEduIntRate2').val();
        var inflationRate = $('#highEduInfRate2').val();
        var noOfYrs = $('#highEduNumYears').val();
        var sipInvestMoney = $('#highEduSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvLumsumInvest;

        $('#highEduNumYears').val(noOfYrs);
        $('#highEduAmt2').val(requiredAmount);
        $('#highEduLumpsumAmt2').val(lumsumAmount);
        $('#highEduInvPerMonth').val(Math.round(sipAmount));
        $('#highEduIntRate2').val(rate);
        $('#highEduInfRate2').val(inflationRate);
        $('#highEduSipAmt').val(sipInvestMoney);

        $('#highEduFvAmt').text(Math.round(fv));
        $('#highEduSipAmt3').text(Math.round(sipAmount));
        $('#highEduSipAmt2').text(Math.round(sipInvestMoney));
        $('#highEduAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#highEduSipInv').text(gap2);
    });

    $('.highEduSummaryChange').blur(function() {
        var requiredAmount = $('#highEduAmt2').val();
        var lumsumAmount = $('#highEduLumpsumAmt2').val();
        var rate = $('#highEduIntRate2').val();
        var inflationRate = $('#highEduInfRate2').val();
        var noOfYrs = $('#highEduNumYears').val();
        var sipInvestMoney = $('#highEduSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvLumsumInvest;

        $('#highEduNumYears').val(noOfYrs);
        $('#highEduAmt2').val(requiredAmount);
        $('#highEduLumpsumAmt2').val(lumsumAmount);
        $('#highEduInvPerMonth').val(Math.round(sipAmount));
        $('#highEduIntRate2').val(rate);
        $('#highEduInfRate2').val(inflationRate);
        $('#highEduSipAmt').val(sipInvestMoney);

        $('#highEduFvAmt').text(Math.round(fv));
        $('#highEduSipAmt3').text(Math.round(sipAmount));
        $('#highEduSipAmt2').text(Math.round(sipInvestMoney));
        $('#highEduAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#highEduSipInv').text(gap2);
    });
    //Higher Education End

    // Own a House start
    $('#ownHousRiskTaken').change(function() {
        $('#ownHousIntRate').val($(this).val());
    });

    $('#ownHousIntWork').blur(function() {
        var IntWork = $(this).val() || 0;
        var amtReq = $('#ownHousAmtReq').val() || 0;
        var totalAmount = parseInt(amtReq) + parseInt(IntWork);
        $('#ownHousTotalAmt').val(totalAmount);
    });

    $('#ownHousProcessBtn1').click(function() {
        var noOfYrs = $('#ownHousNoOfYear').val();
        var requiredAmount = $('#ownHousTotalAmt').val();
        var lumsumAmount = $('#ownHousLumpsumAmt').val();
        var rate = $('#ownHousIntRate').val();
        var inflationRate = $('#ownHousInfRate').val();
        var sipInvestMoney;

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipInvestMoney = sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#ownHousNumYears').val(noOfYrs);
        $('#ownHousAmt2').val(requiredAmount);
        $('#ownHousLumpsumAmt2').val(lumsumAmount);
        $('#ownHousInvPerMonth').val(Math.round(sipAmount));
        $('#ownHousIntRate2').val(rate);
        $('#ownHousInfRate2').val(inflationRate);
        $('#ownHousSipAmt').val(Math.round(sipInvestMoney));

        $('#ownHousFvAmt').text(Math.round(fv));
        $('#ownHousSipAmt3').text(Math.round(sipAmount));
        $('#ownHousSipAmt2').text(Math.round(sipInvestMoney));
        $('#ownHousAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#ownHousSipInv').text(gap2);
    });

    $('#ownHousRiskTaken2').change(function() {
        $('#ownHousIntRate2').val($(this).val());
        var requiredAmount = $('#ownHousAmt2').val();
        var lumsumAmount = $('#ownHousLumpsumAmt2').val();
        var rate = $('#ownHousIntRate2').val();
        var inflationRate = $('#ownHousInfRate2').val();
        var noOfYrs = $('#ownHousNumYears').val();
        var sipInvestMoney = $('#ownHousSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#ownHousNumYears').val(noOfYrs);
        $('#ownHousAmt2').val(requiredAmount);
        $('#ownHousLumpsumAmt2').val(lumsumAmount);
        $('#ownHousInvPerMonth').val(Math.round(sipAmount));
        $('#ownHousIntRate2').val(rate);
        $('#ownHousInfRate2').val(inflationRate);
        $('#ownHousSipAmt').val(sipInvestMoney);

        $('#ownHousFvAmt').text(Math.round(fv));
        $('#ownHousSipAmt3').text(Math.round(sipAmount));
        $('#ownHousSipAmt2').text(Math.round(sipInvestMoney));
        $('#ownHousAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#ownHousSipInv').text(gap2);
    });

    $('.ownHousSummaryChange').change(function() {
        var requiredAmount = $('#ownHousAmt2').val();
        var lumsumAmount = $('#ownHousLumpsumAmt2').val();
        var rate = $('#ownHousIntRate2').val();
        var inflationRate = $('#ownHousInfRate2').val();
        var noOfYrs = $('#ownHousNumYears').val();
        var sipInvestMoney = $('#ownHousSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#ownHousNumYears').val(noOfYrs);
        $('#ownHousAmt2').val(requiredAmount);
        $('#ownHousLumpsumAmt2').val(lumsumAmount);
        $('#ownHousInvPerMonth').val(Math.round(sipAmount));
        $('#ownHousIntRate2').val(rate);
        $('#ownHousInfRate2').val(inflationRate);
        $('#ownHousSipAmt').val(sipInvestMoney);

        $('#ownHousFvAmt').text(Math.round(fv));
        $('#ownHousSipAmt3').text(Math.round(sipAmount));
        $('#ownHousSipAmt2').text(Math.round(sipInvestMoney));
        $('#ownHousAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#ownHousSipInv').text(gap2);
    });
    // Own a House end

    // Buy a Car start
    $('#buyACarRiskTaken').change(function() {
        $('#buyACarIntRate').val($(this).val());
    });

    $('#buyACarProcessBtn1').click(function() {
        var requiredAmount = $('#buyACarAmt').val();
        var lumsumAmount = $('#buyACarLumpsumAmt').val();
        var rate = $('#buyACarIntRate').val();
        var inflationRate = $('#buyACarInfRate').val();
        var noOfYrs = $('#buyACarNoOfYear').val();
        var sipInvestMoney = 5000;

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvLumsumInvest;

        $('#buyACarNumYears').val(noOfYrs);
        $('#buyACarAmt2').val(requiredAmount);
        $('#buyACarLumpsumAmt2').val(lumsumAmount);
        $('#buyACarInvPerMonth').val(Math.round(sipAmount));
        $('#buyACarIntRate2').val(rate);
        $('#buyACarInfRate2').val(inflationRate);
        $('#buyACarSipAmt').val(sipInvestMoney);

        $('#buyACarFvAmt').text(Math.round(fv));
        $('#buyACarSipAmt3').text(Math.round(sipAmount));
        $('#buyACarSipAmt2').text(Math.round(sipInvestMoney));
        $('#buyACarAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#buyACarSipInv').text(gap2);
    });

    $('#buyACarRiskTaken2').change(function() {
        $('#buyACarIntRate2').val($(this).val());
        var requiredAmount = $('#buyACarAmt2').val();
        var lumsumAmount = $('#buyACarLumpsumAmt2').val();
        var rate = $('#buyACarIntRate2').val();
        var inflationRate = $('#buyACarInfRate2').val();
        var noOfYrs = $('#buyACarNumYears').val();
        var sipInvestMoney = $('#buyACarSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvLumsumInvest;

        $('#buyACarNumYears').val(noOfYrs);
        $('#buyACarAmt2').val(requiredAmount);
        $('#buyACarLumpsumAmt2').val(lumsumAmount);
        $('#buyACarInvPerMonth').val(Math.round(sipAmount));
        $('#buyACarIntRate2').val(rate);
        $('#buyACarInfRate2').val(inflationRate);
        $('#buyACarSipAmt').val(sipInvestMoney);

        $('#buyACarFvAmt').text(Math.round(fv));
        $('#buyACarSipAmt3').text(Math.round(sipAmount));
        $('#buyACarSipAmt2').text(Math.round(sipInvestMoney));
        $('#buyACarAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#buyACarSipInv').text(gap2);
    });

    $('.buyACarSummaryChange').change(function() {
        var requiredAmount = $('#buyACarAmt2').val();
        var lumsumAmount = $('#buyACarLumpsumAmt2').val();
        var rate = $('#buyACarIntRate2').val();
        var inflationRate = $('#buyACarInfRate2').val();
        var noOfYrs = $('#buyACarNumYears').val();
        var sipInvestMoney = $('#buyACarSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvLumsumInvest;

        $('#buyACarNumYears').val(noOfYrs);
        $('#buyACarAmt2').val(requiredAmount);
        $('#buyACarLumpsumAmt2').val(lumsumAmount);
        $('#buyACarInvPerMonth').val(Math.round(sipAmount));
        $('#buyACarIntRate2').val(rate);
        $('#buyACarInfRate2').val(inflationRate);
        $('#buyACarSipAmt').val(sipInvestMoney);

        $('#buyACarFvAmt').text(Math.round(fv));
        $('#buyACarSipAmt3').text(Math.round(sipAmount));
        $('#buyACarSipAmt2').text(Math.round(sipInvestMoney));
        $('#buyACarAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#buyACarSipInv').text(gap2);
    });
    // Buy a Car end

    // vacation plan START
    $('#vacaPlanRiskTaken').change(function() {
        $('#vacaPlanIntRate').val($(this).val());
    });

    $('#vacaPlanProcessBtn1').click(function() {
        var noOfYrs = $('#vacaPlanNoOfYear').val();
        var requiredAmount = $('#vacaPlanAmtReq').val();
        var lumsumAmount = $('#vacaPlanLumpsumAmt').val();
        var rate = $('#vacaPlanIntRate').val();
        var inflationRate = $('#vacaPlanInfRate').val();
        var sipInvestMoney = 5000;

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#vacaPlanNumYears').val(noOfYrs);
        $('#vacaPlanAmt2').val(requiredAmount);
        $('#vacaPlanLumpsumAmt2').val(lumsumAmount);
        $('#vacaPlanInvPerMonth').val(Math.round(sipAmount));
        $('#vacaPlanIntRate2').val(rate);
        $('#vacaPlanInfRate2').val(inflationRate);
        $('#vacaPlanSipAmt').val(sipInvestMoney);

        $('#vacaPlanFvAmt').text(Math.round(fv));
        $('#vacaPlanSipAmt3').text(Math.round(sipAmount));
        $('#vacaPlanSipAmt2').text(Math.round(sipInvestMoney));
        $('#vacaPlanAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#vacaPlanSipInv').text(gap2);
    });

    $('#vacaPlanRiskTaken2').change(function() {
        $('#vacaPlanIntRate2').val($(this).val());
        var requiredAmount = $('#vacaPlanAmt2').val();
        var lumsumAmount = $('#vacaPlanLumpsumAmt2').val();
        var rate = $('#vacaPlanIntRate2').val();
        var inflationRate = $('#vacaPlanInfRate2').val();
        var noOfYrs = $('#vacaPlanNumYears').val();
        var sipInvestMoney = $('#vacaPlanSipAmt').val();
        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#vacaPlanNumYears').val(noOfYrs);
        $('#vacaPlanAmt2').val(requiredAmount);
        $('#vacaPlanLumpsumAmt2').val(lumsumAmount);
        $('#vacaPlanInvPerMonth').val(Math.round(sipAmount));
        $('#vacaPlanIntRate2').val(rate);
        $('#vacaPlanInfRate2').val(inflationRate);
        $('#vacaPlanSipAmt').val(sipInvestMoney);

        $('#vacaPlanFvAmt').text(Math.round(fv));
        $('#vacaPlanSipAmt3').text(Math.round(sipAmount));
        $('#vacaPlanSipAmt2').text(Math.round(sipInvestMoney));
        $('#vacaPlanAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#vacaPlanSipInv').text(gap2);
    });

    $('.vacaPlanSummaryChange').blur(function() {
        var requiredAmount = $('#vacaPlanAmt2').val();
        var lumsumAmount = $('#vacaPlanLumpsumAmt2').val();
        var rate = $('#vacaPlanIntRate2').val();
        var inflationRate = $('#vacaPlanInfRate2').val();
        var noOfYrs = $('#vacaPlanNumYears').val();
        var sipInvestMoney = $('#vacaPlanSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#vacaPlanNumYears').val(noOfYrs);
        $('#vacaPlanAmt2').val(requiredAmount);
        $('#vacaPlanLumpsumAmt2').val(lumsumAmount);
        $('#vacaPlanInvPerMonth').val(Math.round(sipAmount));
        $('#vacaPlanIntRate2').val(rate);
        $('#vacaPlanInfRate2').val(inflationRate);
        $('#vacaPlanSipAmt').val(sipInvestMoney);

        $('#vacaPlanFvAmt').text(Math.round(fv));
        $('#vacaPlanSipAmt3').text(Math.round(sipAmount));
        $('#vacaPlanSipAmt2').text(Math.round(sipInvestMoney));
        $('#vacaPlanAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#vacaPlanSipInv').text(gap2);
    });
    // vacation plan End

    // emergency fund started
    $('#emeFundRiskTaken').change(function() {
        $('#emeFundIntRate').val($(this).val());
    });

    $('#emeFundProcessBtn1').click(function() {
        var noOfYrs = $('#emeFundNoOfYear').val();
        var requiredAmount = $('#emeFundAmtReq').val();
        var lumsumAmount = $('#emeFundLumpsumAmt').val();
        var rate = $('#emeFundIntRate').val();
        var inflationRate = $('#emeFundInfRate').val();
        var sipInvestMoney = 5000;

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#emeFundNumYears').val(noOfYrs);
        $('#emeFundAmt2').val(requiredAmount);
        $('#emeFundLumpsumAmt2').val(lumsumAmount);
        $('#emeFundInvPerMonth').val(Math.round(sipAmount));
        $('#emeFundIntRate2').val(rate);
        $('#emeFundInfRate2').val(inflationRate);
        $('#emeFundSipAmt').val(sipInvestMoney);

        $('#emeFundFvAmt').text(Math.round(fv));
        $('#emeFundSipAmt3').text(Math.round(sipAmount));
        $('#emeFundSipAmt2').text(Math.round(sipInvestMoney));
        $('#emeFundAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#emeFundSipInv').text(gap2);
    });

    $('#emeFundRiskTaken2').change(function() {
        $('#emeFundIntRate2').val($(this).val());
        var requiredAmount = $('#emeFundAmt2').val();
        var lumsumAmount = $('#emeFundLumpsumAmt2').val();
        var rate = $('#emeFundIntRate2').val();
        var inflationRate = $('#emeFundInfRate2').val();
        var noOfYrs = $('#emeFundNumYears').val();
        var sipInvestMoney = $('#emeFundSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#emeFundNumYears').val(noOfYrs);
        $('#emeFundAmt2').val(requiredAmount);
        $('#emeFundLumpsumAmt2').val(lumsumAmount);
        $('#emeFundInvPerMonth').val(Math.round(sipAmount));
        $('#emeFundIntRate2').val(rate);
        $('#emeFundInfRate2').val(inflationRate);
        $('#emeFundSipAmt').val(sipInvestMoney);

        $('#emeFundFvAmt').text(Math.round(fv));
        $('#emeFundSipAmt3').text(Math.round(sipAmount));
        $('#emeFundSipAmt2').text(Math.round(sipInvestMoney));
        $('#emeFundAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#emeFundSipInv').text(gap2);
    });

    $('.emeFundSummaryChange').change(function() {
        var requiredAmount = $('#emeFundAmt2').val();
        var lumsumAmount = $('#emeFundLumpsumAmt2').val();
        var rate = $('#emeFundIntRate2').val();
        var inflationRate = $('#emeFundInfRate2').val();
        var noOfYrs = $('#emeFundNumYears').val();
        var sipInvestMoney = $('#emeFundSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#emeFundNumYears').val(noOfYrs);
        $('#emeFundAmt2').val(requiredAmount);
        $('#emeFundLumpsumAmt2').val(lumsumAmount);
        $('#emeFundInvPerMonth').val(Math.round(sipAmount));
        $('#emeFundIntRate2').val(rate);
        $('#emeFundInfRate2').val(inflationRate);
        $('#emeFundSipAmt').val(sipInvestMoney);

        $('#emeFundFvAmt').text(Math.round(fv));
        $('#emeFundSipAmt3').text(Math.round(sipAmount));
        $('#emeFundSipAmt2').text(Math.round(sipInvestMoney));
        $('#emeFundAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#emeFundSipInv').text(gap2);
    });
    // emergency fund END

    // unique Goal Start
    $('#uniqGoalRiskTaken').change(function() {
        $('#uniqGoalIntRate').val($(this).val());
    });

    $('#uniqGoalProcessBtn1').click(function() {
        var noOfYrs = $('#uniqGoalNoOfYear').val();
        var requiredAmount = $('#uniqGoalAmtReq').val();
        var lumsumAmount = $('#uniqGoalLumpsumAmt').val();
        var rate = $('#uniqGoalIntRate').val();
        var inflationRate = $('#uniqGoalInfRate').val();
        var sipInvestMoney = 5000;

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#uniqGoalNumYears').val(noOfYrs);
        $('#uniqGoalAmt2').val(requiredAmount);
        $('#uniqGoalLumpsumAmt2').val(lumsumAmount);
        $('#uniqGoalInvPerMonth').val(Math.round(sipAmount));
        $('#uniqGoalIntRate2').val(rate);
        $('#uniqGoalInfRate2').val(inflationRate);
        $('#uniqGoalSipAmt').val(sipInvestMoney);

        $('#uniqGoalFvAmt').text(Math.round(fv));
        $('#uniqGoalSipAmt3').text(Math.round(sipAmount));
        $('#uniqGoalSipAmt2').text(Math.round(sipInvestMoney));
        $('#uniqGoalAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#uniqGoalSipInv').text(gap2);
    });

    $('#uniqGoalRiskTaken2').change(function() {
        $('#uniqGoalIntRate2').val($(this).val());
        var requiredAmount = $('#uniqGoalAmt2').val();
        var lumsumAmount = $('#uniqGoalLumpsumAmt2').val();
        var rate = $('#uniqGoalIntRate2').val();
        var inflationRate = $('#uniqGoalInfRate2').val();
        var noOfYrs = $('#uniqGoalNumYears').val();
        var sipInvestMoney = $('#uniqGoalSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#uniqGoalNumYears').val(noOfYrs);
        $('#uniqGoalAmt2').val(requiredAmount);
        $('#uniqGoalLumpsumAmt2').val(lumsumAmount);
        $('#uniqGoalInvPerMonth').val(Math.round(sipAmount));
        $('#uniqGoalIntRate2').val(rate);
        $('#uniqGoalInfRate2').val(inflationRate);
        $('#uniqGoalSipAmt').val(sipInvestMoney);

        $('#uniqGoalFvAmt').text(Math.round(fv));
        $('#uniqGoalSipAmt3').text(Math.round(sipAmount));
        $('#uniqGoalSipAmt2').text(Math.round(sipInvestMoney));
        $('#uniqGoalAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#uniqGoalSipInv').text(gap2);
    });

    $('.uniqGoalSummaryChange').change(function() {
        var requiredAmount = $('#uniqGoalAmt2').val();
        var lumsumAmount = $('#uniqGoalLumpsumAmt2').val();
        var rate = $('#uniqGoalIntRate2').val();
        var inflationRate = $('#uniqGoalInfRate2').val();
        var noOfYrs = $('#uniqGoalNumYears').val();
        var sipInvestMoney = $('#uniqGoalSipAmt').val();

        var rateOfReturn = rate / 100;
        var fv = requiredAmount * Math.pow((1 + inflationRate / 100), (noOfYrs));
        var a = Math.pow((1 + rateOfReturn), (1 / (noOfYrs * 12)));
        var nominal = noOfYrs * (a - 1);
        var lumsunInvPower = Math.pow((1 + rateOfReturn), (noOfYrs));
        var fvLumsumInvest = lumsumAmount * lumsunInvPower;
        var gap = fv - fvLumsumInvest;
        var b = Math.pow((1 + nominal), (noOfYrs * 12));
        var sipAmount = gap * nominal / (b - 1);
        sipAmount;
        var sipInvestMoneypow = Math.pow((1 + nominal), (noOfYrs * 12));
        sipInvestMoneypow = sipInvestMoneypow - 1;
        var fvSipInvestment = sipInvestMoney * sipInvestMoneypow;
        var fvSipInvestmentfinal = fvSipInvestment / (nominal);
        var fvSipInvestLumsum = fvSipInvestmentfinal + fvLumsumInvest;
        var gap2 = fv - fvSipInvestLumsum;

        $('#uniqGoalNumYears').val(noOfYrs);
        $('#uniqGoalAmt2').val(requiredAmount);
        $('#uniqGoalLumpsumAmt2').val(lumsumAmount);
        $('#uniqGoalInvPerMonth').val(Math.round(sipAmount));
        $('#uniqGoalIntRate2').val(rate);
        $('#uniqGoalInfRate2').val(inflationRate);
        $('#uniqGoalSipAmt').val(sipInvestMoney);

        $('#uniqGoalFvAmt').text(Math.round(fv));
        $('#uniqGoalSipAmt3').text(Math.round(sipAmount));
        $('#uniqGoalSipAmt2').text(Math.round(sipInvestMoney));
        $('#uniqGoalAvilAmt').text(Math.round(fvSipInvestLumsum));
        $('#uniqGoalSipInv').text(gap2);
    });
    // unique Goal End

    // SIP Start
    $('#sipInfRateTaken').change(function() {
        $('#sipInfRate').val($(this).val());
    });

    $('#checkSIPBtn').click(function() {
        var sipAmount = $('#sipInvAmt').val();
        var noOfYrs = $('#sipNumYears').val();
        var r = $('#sipIntRate').val();
        var i = $('#sipInfRate').val();

        var returnRate = r / 100;
        var inflationRate = i / 100;
        var investedAmount = sipAmount * (noOfYrs * 12);
        var a = (1 + returnRate);
        var b = (1 + inflationRate);
        var RealReturn = ((a / b) - 1);
        var c = Math.pow((1 + RealReturn), (1 / (noOfYrs * 12)));
        var nominalRate = noOfYrs * (c - 1);
        var d = Math.pow((1 + nominalRate), (noOfYrs * 12));
        var nominalRate1 = (1 + nominalRate);
        var fv1 = sipAmount * (nominalRate1) / nominalRate;
        var fvInvestment = (d * fv1) - fv1;
        $('#sipMonthlyInvestmentText').text(sipAmount);
        $('#sipTotalInvAmt').val(investedAmount);
        $('#sipFVAmt').val(Math.round(fvInvestment));
    });
    // SIP End

    // Lumpsum start
    $('#lumpsumAdjInfRate').change(function() {
        $('#lumpsumInfRate').val($(this).val());
    });

    $('#checkLumpsumBtn').click(function() {
        var requiredAmount = $('#lumpsumInvAmt').val();
        var noOfYrs = $('#lumpsumNumYears').val();
        var r = $('#lumpsumIntRate').val();
        var i = $('#lumpsumInfRate').val();

        var returnRate = r / 100;
        var inflationRate = i / 100;
        var a = (1 + returnRate);
        var b = (1 + inflationRate);
        var RealReturn = (a / b) - 1;
        var fv = requiredAmount * Math.pow((1 + RealReturn), (noOfYrs));
        fv = Math.round(fv);

        $('#lumpsumTotalInvAmt').val(requiredAmount);
        $('#lumpsumFVAmt').val(fv);
    });
    // Lumpsum end

    // Tax start
    $('#taxCheckBtn').click(function() {
        var age = $('#taxAgeNum').val();
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

        if (totalInvest > 150000) {
            fur_invest = 0;
        } else {
            fur_invest = 150000 - totalInvest;
        }

        if (age == "normal") {
            if (remainingSalary > 250000 && remainingSalary <= 500000) {
                tax = ((remainingSalary - 250000) * 5 / 100);
            }
            if (remainingSalary > 500000 && remainingSalary <= 1000000) {
                tax = 12500 + ((remainingSalary - 500000) * 20 / 100);
            }
            if (remainingSalary > 1000000) {
                tax = (12500 + 100000) + ((remainingSalary - 500000) * 30 / 100);
            }

            if (salary <= 250000) {
                taxSavedFromFurInv = (fur_invest * 0 / 100);
            }
            if (salary > 250000 && salary <= 500000) {
                taxSavedFromFurInv = (fur_invest * 5 / 100);
            }
            if (salary > 500000 && salary <= 1000000) {
                taxSavedFromFurInv = (fur_invest * 20 / 100);
            }
            if (salary > 1000000) {
                taxSavedFromFurInv = (fur_invest * 30 / 100);
            }

        } else if (age == "old") {
            if (remainingSalary > 300000 && remainingSalary <= 500000) {
                tax = ((remainingSalary - 300000) * 5 / 100);
            }
            if (remainingSalary > 500000 && remainingSalary <= 1000000) {
                tax = 10000 + ((remainingSalary - 500000) * 20 / 100);
            }
            if (remainingSalary > 1000000) {
                tax = (10000 + 100000) + ((remainingSalary - 500000) * 30 / 100);
            }

            if (salary <= 300000) {
                taxSavedFromFurInv = (fur_invest * 0 / 100);
            }
            if (salary > 300000 && salary <= 500000) {
                taxSavedFromFurInv = (fur_invest * 5 / 100);
            }
            if (salary > 500000 && salary <= 1000000) {
                taxSavedFromFurInv = (fur_invest * 20 / 100);
            }
            if (salary > 1000000) {
                taxSavedFromFurInv = (fur_invest * 30 / 100);
            }

        } else if (age == "seniorCitizen") {
            if (remainingSalary > 500000 && remainingSalary <= 1000000) {
                tax = (remainingSalary - 500000) * 20 / 100;
            }
            if (remainingSalary > 1000000) {
                tax = (100000) + ((remainingSalary - 500000) * 30 / 100);
            }

            if (salary <= 500000) {
                taxSavedFromFurInv = (fur_invest * 0 / 100);
            }
            if (salary > 500000 && salary <= 1000000) {
                taxSavedFromFurInv = (fur_invest * 20 / 100);
            }
            if (salary > 1000000) {
                taxSavedFromFurInv = (fur_invest * 30 / 100);
            }
        }
        //alert(totalInvest + " :"+ fur_invest +" : "+ taxSavedFromFurInv);
        $('#taxTotalInvAmt').val(totalInvest);
        $('#taxRemInvAmt').val(fur_invest);
        $('#taxSaveAmt123').val(taxSavedFromFurInv);
    });
    // Tax end

    // Fixed Deposit start
    $('#fdCheckBtn').click(function() {
        var principal = $('#fixdepAmt').val();
        var rate = $('#fixdepIntRate').val();
        var time = $('#fixdepNum').val();
        var time_period = $('#fixdepNumType').val();
        var intType = $('#fixdepIntType').val();
        var amt;
        var totalInt;

        if (intType == 'simpleInterest') {
            amt = clc_simpleInt(principal, 1, time, rate, time_period);
        } else {
            amt = (principal * Math.pow((1 + (rate / (intType * 100))), (intType * time / time_period)));
        }
        amt = Math.round(amt);
        totalInt = amt - principal;
        var show_time = calc_time(time_period);
        $('#fixdepMatAmt').val(amt);
        $('#fixdepTotalInt').val(totalInt);
        $('.fixdepYearShow').text(time + " " + show_time);
        $('#fixdepInvestAmt').text(principal);
        $('#fixdepTotalAmt').text(amt);
        $('#fixdepTimeShow').text(show_time);
    });
    // Fixed Deposti end

    // Recurring Deposit start
    $('#rdCheckBtn').click(function() {
        var monthlyInstallment = $('#rdAmt').val();
        var numberOfYears = $('#rdNumYears').val();
        var rateOfInterest = $('#rdIntRate').val();
        var numberOfMonths = numberOfYears * 12;
        var amt = Math.round(clc_recurrInt(monthlyInstallment, numberOfMonths, rateOfInterest));
        $('#rdTotalAmt').val(amt);
        $('#rdYearShow').text(numberOfYears);
    });
    // Recurring Deposit end

    // Home Loan start
    $('#homeLoanCheck').click(function() {
        var P = parseFloat($("#homeLoanAmt").val());
        var r = parseFloat(parseFloat($("#homeLoanIntRate").val()) / 100 / 12);
        var n = parseFloat($("#homeLoanNumYears").val() * 12);
        var emi = clc_emi(P, n, r);
        var totalPayAmt = Math.round(emi * n);
        var totalPayInt = totalPayAmt - P;
        emi = Math.round(emi);
        $('#homeLoanEmiAmt').val(emi);
        $('#homeLoanTotalPayAmt').val(totalPayAmt);
        $('#homeLoanTotalInt').val(totalPayInt);
    });
    // Home Loan end

    // car loan start
    $('#carLoanCheck').click(function() {
        var P = parseFloat($("#carLoanAmt").val());
        var r = parseFloat(parseFloat($("#carLoanIntRate").val()) / 100 / 12);
        var n = parseFloat($("#carLoanNumYears").val() * 12);
        var emi = clc_emi(P, n, r);
        var totalPayAmt = Math.round(emi * n);
        var totalPayInt = totalPayAmt - P;
        emi = Math.round(emi);
        $('#carLoanEmiAmt').val(emi);
        $('#carLoanPayAmt').val(totalPayAmt);
        $('#carLoanTotalInt').val(totalPayInt);
    });
    // car loan end

    // Personal Loan start
    $('#perLoanCheck').click(function() {
        var P = parseFloat($("#perLoanAmt").val());
        var r = parseFloat(parseFloat($("#perLoanIntRate").val()) / 100 / 12);
        var n = parseFloat($("#perLoanNumYears").val() * 12);
        var emi = clc_emi(P, n, r);
        var totalPayAmt = Math.round(emi * n);
        var totalPayInt = totalPayAmt - P;
        emi = Math.round(emi);
        $('#perLoanEmiAmt').val(emi);
        $('#perLoanPayAmt').val(totalPayAmt);
        $('#perLoanTotalInt').val(totalPayInt);
    });
    // Personal Loan end

    // PPF START
    $('#ppfRateType').change(function() {
        $('#ppfIntRate').val($(this).val());
    });

    $('#ppfCheck').click(function() {
        var principal = $('#ppfAmt').val();
        var rateType = $('#ppfRateType').val();
        var time = $('#ppfNumYear').val();
        var ppfTotalMatAmt;
        $('#ppfIntRate').val(rateType);
        if (rateType == 7.6) {
            ppfTotalMatAmt = clc_PPF(principal, rateType, time);
        } else if (rateType == 7.8) {
            ppfTotalMatAmt = clc_PPF(principal, rateType, time);
        }
        ppfTotalMatAmt = Math.round(ppfTotalMatAmt);
        var ppfTotalInvest = (parseInt(principal) * parseInt(time));
        var ppfTotalIntEarn = (ppfTotalMatAmt - ppfTotalInvest);
        $('#ppfTotalMatAmt').val(ppfTotalMatAmt);
        $('#ppfTotalInvest').val(ppfTotalInvest);
        $('#ppfTotalIntEarn').val(ppfTotalIntEarn);
    });
    // PPF END

    // EPF start
    // EPF end

    // NPS Start
    $('#npsCheckBtn').click(function() {
        var currentAge = $('#npsCurrAge').val();
        var retirementAge = $('#npsRetAge').val();
        var noOfYrs = $('#npsNumYears').val();
        var amount = $('#npsMonInvAmt').val();
        var r = $('#npsIntRate').val();

        var returnRate = (r / (1200));
        var prinAmtInv = amount * noOfYrs * 12;
        var d = Math.pow((1 + returnRate), (noOfYrs * 12));
        var returnRate1 = (1 + returnRate);
        var fv1 = amount / returnRate;
        var fvInvestment = (d * fv1) - fv1;
        var intEarOnInvest = fvInvestment - prinAmtInv;

        $('#npsTotalInvAmt').val(prinAmtInv);
        $('#npsTotalIntAmt').val(Math.round(intEarOnInvest));
        $('#npsPensAmt').val(Math.round(fvInvestment));
    });
    // NPS end

    // SSY start
    $('#ssyCheck').click(function() {
        var amountInvest = $('#ssyAmt').val();
        var monthType = $('#ssyTimePeriod').val();
        var r = $('#ssyIntRate').val();
        var startYear = parseInt($('#ssyStartyear').val());
        var rate = r / 100;
        var result;
        var matYear = (startYear + 15);

        if (monthType == "12") {
            result = ssy_cal(amountInvest, rate, monthType);
        } else if (monthType == "1") {
            result = ssy_cal(amountInvest, rate, monthType);
        }
        $('#ssyMatYear').val(matYear);
        $('#ssyTotalAmt').val(result);
    });
    // SSY end

    // SWP start
    // SWP end

    // HRA start
    $('#HRA_Check').click(function() {
        var sal_rec = parseInt($('#hraBscSal').val());
        var da = parseInt($('#hraDA').val());
        var hra_rec = parseInt($('#hraRec').val());
        var rent_paid = parseInt($('#hraActRentPad').val());
        var city = $('#hraCity').val();
        hra_rec;
        rent_paid = rent_paid - ((sal_rec + da) * (10 / 100));
        metro_nonmetro = 0;
        if (city == 'oth') {
            metro_nonmetro = ((sal_rec + da) * (40 / 100));
        } else {
            metro_nonmetro = ((sal_rec + da) * (50 / 100))
        }

        var HRA_Exemptions = 0;
        if (hra_rec < rent_paid && hra_rec < metro_nonmetro) {
            HRA_Exemptions = hra_rec;
        } else if (rent_paid < hra_rec && rent_paid < metro_nonmetro) {
            HRA_Exemptions = rent_paid;
        } else if (metro_nonmetro < hra_rec && metro_nonmetro < rent_paid) {
            HRA_Exemptions = metro_nonmetro;
        }
        $('#hraExempt').val(HRA_Exemptions);
        $('#hrataxable').val((hra_rec - HRA_Exemptions));
    });
    // HRA end

    // SIP Installment start
    $('#sipInsRiskTaken').change(function() {
        $('#sipInsIntRate').val($(this).val());
    });

    $('#checksipInsBtn').click(function() {
        var requiredAmount = $('#sipInsAmt').val();
        var noOfYrs = $('#sipInsNumYears').val();
        var r = $('#sipInsIntRate').val();
        var returnRate = r / 100;
        var a = Math.pow((1 + returnRate), (1 / (noOfYrs * 12)));
        var nominalRate = noOfYrs * (a - 1);
        var b = parseFloat(Math.pow((1 + nominalRate), (noOfYrs * 12)));
        var sipAmount = (requiredAmount * nominalRate) / (b - 1);
        $('#sipInsMonInsAmt').val(sipAmount.toFixed(2));
    });
    // SIP Installment end

    // Old & New Tax Regime Calculator
    $('#submit_calc').click(function(){
        // Do something here!
        var si = parseInt($("#si").val());
        var ri = parseInt($("#ri").val());
        var fdi = parseInt($("#fdi").val());
        var ihl = parseInt($("#ihl").val());
        var ltac = parseInt($("#ltac").val());
        var fc= parseInt($("#fc").val());
        var i80c = parseInt($("#i80c").val());
        var i80d = parseInt($("#i80d").val());
        var ro = parseInt($("#ro").val());
        var hrac = parseInt($("#hrac").val());
        var bs = parseInt($("#bs").val());
        var dob = parseInt($("#dob").val());
        var age = parseInt($("#age").val());
        $("#sir").text(si);
        $('#sir').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        var sdr = -52400;
        $("#sirn").text( $("#sir").text());
        
        $("#sdr").text( sdr);
        $('#sdr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        var sdrn = 0;
        $("#sdrn").text( sdrn);
        $('#sdrn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        var hraer = -Math.min((hrac*12),(bs*12*0.4),((ro*12)-(bs*12*0.1)));
        console.log("hraer : "+hraer);
        $("#hraer").text(hraer);
        $('#hraer').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        var hraern = 0;
        $("#hraern").text(hraern);
        $('#hraern').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        $("#ltaer").text(-ltac);
        $('#itaer').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        var itaern = 0;
        $("#itaern").text(itaern);
        $('#itaern').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        var fcern = 0;
        $("#fcern").text(fcern);
        $('#fcern').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        $("#fcer").text(-fc);
        $('#fcer').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        $("#rir").text(ri);
        $('#rir').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        $("#rirn").text($("#rir").text());
        
        var ihlrn = 0;
        $("#ihlrn").text(ihlrn);
        $('#ihlrn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        $("#ifdr ").text(fdi);
        
        $("#ifdrn").text($("#ifdr").text());
        $('#ifdrn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        let intrest = (ihl>=200000) ? -200000 : -ihl;
        console.log(intrest); 
        $("#ihlr").text(intrest);
        $('#ihlr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
      
        let cd = (i80c>=150000) ? 150000 : i80c;
        console.log(cd); 
        $("#c80cr").text(cd);
        $('#c80cr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        
        let cdn = (i80c>0) ? 0 : 0;
        console.log(cdn); 
        $("#c80crn").text(cdn);
        $('#c80crn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        
        let dd = (i80d>=75000) ? -75000 : -i80d;
        console.log(dd); 
        $("#d80dr").text(dd);
        $('#d80dr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
        var drn80 = 0;
        $("#d80drn").text(drn80);
        $('#d80drn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
        var tir = si+sdr+hraer+(-ltac)+(-fc)+ri+intrest+fdi+cd+dd;
        console.log(tir); 
        $("#tir").text(tir);
        $('#tir').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
        var tirn= si+sdrn+hraern+itaern+fcern+ri+ihlrn+fdi+cdn+drn80;
        console.log(tirn); 
        $("#tirn").text(tirn);
        $('#tirn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
  
        if( tir<=500000 && tir>250000) {
          t = (tir-250000)*0.05;
        } else if( tir>500000 && tir<=1000000 ) {
          t = 12500 + (tir-500000)*0.2;
        } else {
          if( tir>1000000 && tir<=20000000 ) {   
            t = 112500 + (tir-1000000)*0.3;
          } else {
            t = 0;
          }
        }
        if(age>=60 && age<80) {
          t = t-2500;
        } else {
          if(age>=80) {
            t = t-12500;
          }
        }
        $("#toir").text(t);
        $('#toir').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        
        if( tirn<=500000 && tirn>250000) {
          tn = (tirn-250000)*0.05;
        } else if( tirn>500000 && tirn<=750000 ) {
          tn = 12500+((tirn-500000)*0.1);
        } else if( tirn>750000 && tirn<=1000000 ) {
          tn = 37500+(tirn-750000)*0.15;
        }else if( tirn>1000000 && tirn<=1250000 ) {
          tn = 75000+(tirn-1000000)*0.2;
        }else if( tirn>1250000 && tirn<=1500000 ) {
          tn = 125000+((tirn-1250000)*0.25);
        }else if ( tirn>1500000 ) {
          tn = 187500+((tirn-1500000)*0.3);
        }else {
          tn = 0;
        }
        $("#toirn").text(tn);
        $('#toirn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
      
        
        if( tir>5000000 && tir<=10000000) {
          s = t*0.1;
        } else if( tir>10000000 && tir<=20000000 ) {
          s = t*0.15;
        } else if( tir>20000000 && tir<=50000000 ) {
          s = t*0.25;
        }else if( tir>50000000 ) {
          s = t*0.37;
        }else {
          s = 0;
        }
        $("#sr").text(s);
        $('#sr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
      
        
        if( tirn>5000000 && tirn<=10000000) {
          sn = tn*0.1;
        } else if( tirn>10000000 && tirn<=20000000 ) {
          sn = tn*0.15;
        } else if( tirn>20000000 && tirn<=50000000 ) {
          sn = tn*0.25;
        }else if( tirn>50000000 ) {
          sn = tn*0.37;
        }else {
          sn = 0;
        }
        $("#srn").text(sn);
        $('#srn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
      
        
        let r87ar = (tir<=500000) ? -toir : 0;
        console.log(r87ar); 
        $("#r87ar").text(r87ar);
        $('#r87ar').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
      
        
        let r87arn = (tirn<=500000) ? -12500 : 0;
        console.log(r87arn); 
        $("#r87arn").text(r87arn);
        $('#r87arn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
      
        var it_r= t + s + r87ar;
        console.log(it_r); 
        $("#it_r").text(it_r);
        $('#it_r').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
        var it_rn= tn + sn + r87arn;
        console.log(it_rn); 
        $("#it_rn").text(it_rn);
        $('#it_rn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        
        var cessr=it_r*0.04;
        console.log(cessr); 
        $("#cessr").text(cessr);
        $('#cessr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        })
        
  
        var cessrn=it_rn*0.04;
        console.log(cessrn); 
        $("#cessrn").text(cessrn);
        $('#cessrn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
        
        var ttpr=it_r+cessr;
        console.log(ttpr); 
        $("#ttpr").text(ttpr);
        $('#ttpr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
        var ttprn=it_rn+cessrn;
        console.log(ttprn); 
        $("#ttprn").text(ttprn);
        $('#ttprn').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
        let bu = (ttprn>ttpr) ? "OLD TAX REGIME": "NEW TAX REGIME";
        console.log(bu); 
        $("#bu").text(bu);
  
  
        aobr1 = ttprn - ttpr;
        aobr2 = ttpr - ttprn;
        let aobr = (ttprn>ttpr) ?aobr1: aobr2;
        console.log(aobr); 
        $("#aobr").text(aobr);
        $('#aobr').each(function() {
          var monetary_value = $(this).text();
          var i = new Intl.NumberFormat('en-IN', {
              style: 'currency',
              currency: 'INR'
          }).format(monetary_value);
          $(this).text(i);
        });
  
        alert('Click OK To Submit');
    });

}); //mydocument redy close

/*------------- All function start here---------------*/
// Fixed deposit check time
function calc_time(time) {
    var time_period;
    if (time == 1) {
        time_period = "years";
    } else if (time == 12) {
        time_period = "months";
    } else if (time_period == 365 || time_period == 366) {
        time_period = "days";
    }
    return time_period;
}

//Fixed deposit simple interest
function clc_simpleInt(principal, n, time, rate, aa) {
    var rate2 = parseFloat(rate) / 100;
    var amount_interest = parseFloat(principal) * (1 + (parseFloat(rate2 / aa) * time));
    return amount_interest;
}

// Recurring Deposit
function clc_recurrInt(monthlyInstallment, numberOfMonths, rateOfInterest) {
    var frequency = Math.floor(numberOfMonths / 3);
    var accumulateMonthlyAmount = parseInt(monthlyInstallment) * ((Math.pow(rateOfInterest / 400 + 1, frequency) - 1) / (1 - (Math.pow(rateOfInterest / 400 + 1, (-1 / 3)))));
    var finalInterestGain = accumulateMonthlyAmount - monthlyInstallment * numberOfMonths;
    var depositedAmount = monthlyInstallment * numberOfMonths;
    return accumulateMonthlyAmount;
}

// Emi 
function clc_emi(P, n, r) {
    var x = Math.pow(1 + r, n);
    var emi = (P * x * r) / (x - 1);
    return emi;
}

//ppf function
function clc_PPF(principalVal, intRate, years) {
    principalVal = parseInt(principalVal);
    intRate = parseFloat(intRate);
    years = parseInt(years);
    var amt = 0;
    for (var i = 1; i <= years; i++) {
        var show = '';
        if (i >= 1 && i <= 15) {
            amt = (amt + principalVal);
        }
        if (intRate == 7.6 && i == years) {} else {
            amt = (amt + ((amt * intRate / 100)));
        }
    }
    return amt;
}

// ssy function
function ssy_cal(amount, rate, interestType) {
    var nper = 6;
    var rate1 = rate / interestType;
    var nper1 = 15 * interestType;
    var k1 = (1 + rate1);
    var rateMPow = Math.pow((k1), (nper1));
    var fvM = amount * (k1) / rate1;
    var fvFinalM = (rateMPow * fvM) - fvM;
    var rateMPow1 = Math.pow((1 + rate), (nper));
    var fv2M = rateMPow1 * fvFinalM;
    return Math.round(fv2M);
}