</div>

<div class="choose_goal">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mt-5 text-center">
                <h3> WE WILL HELP YOU MANAGE YOUR FINANCE BETTER</h3>
            </div>
            <div id="resultData"> </div>
        </div>
    </div>
</div>

<div class="service_area plan_goal wealth_goal mb-40">
    <div class="container">
        <div class="card-columns">
            <a href="#" data-toggle="modal" data-target="#sipCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">SIP calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#lumpsumCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">Lumpsum calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#taxCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">TAX calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#fixdepCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">Fixed deposit calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#recdepCal">  
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">Recurring deposit calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#emiHomeCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">EMI Home Loan calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#emiCarCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">EMI Car Loan calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#emiPerCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">EMI Personal Loan calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#ppfCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">PPF calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#epfCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">EPF calculator</p>
                </div>
                </div>  
            </a>
            <a href="#" data-toggle="modal" data-target="#npsCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">NPS calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#ssyCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">Sukanya Samriddhi Yojana(SSJ)</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#swpCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">SWP calculator</p>
                </div>
                </div>  
            </a>
            <a href="#" data-toggle="modal" data-target="#hraCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">HRA calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#sipInsCal">
                <div class="card bg-danger hovereffect">
                <div class="card-body text-center">
                    <p class="card-text">SIP Installment Calculator</p>
                </div>
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#oldnewCal">
                <div class="card bg-danger hovereffect">
                    <div class="card-body text-center">
                        <p class="card-text">Old vs New Regime Tax Calculator</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- modal SIP calculator start -->

<div class="modal fade in" id="sipCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">SIP calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">SIP amount </br><span style="font-size: 12px; color:#696969; font-weight: 100">(Minimum Rs. 500/-)</span></label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipInvAmt" name="sipInvAmt" placeholder="" required="" min="500" max="9999999999">
                        </div>
                        <label class="control-label col-sm-4" for="">Monthly invested</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Invested for</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipNumYears" name="sipNumYears" placeholder="" required="" min="1">
                        </div>
                        <label class="control-label col-sm-1" for="">Year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Expected rate of return</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="sipIntRate" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Adjust for inflation</label>
                        <div class="col-sm-4">
                            <select name="" id="sipInfRateTaken" class="form-control">
                                <option value="5">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Inflation rate</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipInfRate" name="" placeholder="" value="5">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" value="Check SIP" id="checkSIPBtn" name="">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Amount invested</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipTotalInvAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Future value investment of</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipFVAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-info">
                                If you invest <span id="sipMonthlyInvestmentText">&#x20B9; *****</span> per month for <span id="sipYearsInvestmentText">***</span> years @ <span id="sipPercentText">**</span>% P.A expected rate of return, you will accumulate <span id="sipTotInvestmentText">&#x20B9; *****</span> at the end of the <span id="sipEndYearText">**</span><sup>th</sup> year.
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <p>If you invest Rs.***** per month for *** years @ **% P.A expected rate of return, you will accumulate Rs. ***** at the end of the **<sup>th</sup> year</p>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#sipSTPShow';" class="btn btn-default">Start investing</button>
                <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div>
        </div>
    </div>
</div>

<!-- modal end -->

<!-- modal Lumpsum calculator start -->

<div class="modal fade in" id="lumpsumCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lumpsum calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Lumpsum amount invested</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="lumpsumInvAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Expected rate of return</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="lumpsumIntRate" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Time period</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="lumpsumNumYears" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">Year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Adjust for inflation</label>
                        <div class="col-sm-4">
                            <select name="" id="lumpsumAdjInfRate" class="form-control">
                                <option value="5">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Inflation rate</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="lumpsumInfRate" name="" placeholder="" value="5">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right">Check</label>
                        <div class="col-sm-4">

                            <input type="button" class="btn btn-primary btnsize" name="" value="Check Lumpsum" id="checkLumpsumBtn">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Amount invested</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="lumpsumTotalInvAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Future value of investment</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="lumpsumFVAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-9 col-md-offset-2 ml-5">
                            <div class="alert alert-info">
                                If you invest <span id="lumpsumMonthlyInvestmentText">&#x20B9; **</span> per month for <span id="lumpsumYearsInvestmentText"> years @ <span id="lumpsumPercentText"></span>% P.A expected rate of return, you will accumulate <span id="lumpsumTotInvestmentText">&#x20B9; **</span> at the end of the <span id="lumpsumEndYearText">**</span><sup>th</sup> year.
                            </div>
                        </div>
                    </div>
               
            </form></div>
            <div class="modal-footer">
                <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#lumpSumShow';" class="btn btn-default">Start investing</button>
                <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- modal Lumpsum calculator end -->

<!-- modal TAX calculator start -->

<div class="modal fade in" id="taxCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">TAX calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                
            </div>
            <div class="modal-body">
                <div class="col-md-9 col-md-offset-2 ml-5">
                    <p><strong>Investment limit under Sec 80C Rs.1,50,000</strong></p>
                <p><strong>how much are you investing annually in the following</strong></p>
                </div>
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Age</label>
                        <div class="col-sm-4">
                            <!-- <input type="number" min="0" class="form-control" id="taxAgeNum" name="" placeholder="" required> -->
                            <select class="form-control" id="taxAgeNum">
                                <option value="normal">0-59</option>
                                <option value="old">60-79</option>
                                <option value="seniorCitizen">&gt;=80</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Equity linked saving scheme(ELSS)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="taxElssSchemeAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">life insurance premimum paid for self, spouse and children</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxLICSchemeAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Sukanya Samriddhi Yojana(SSY)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxSSYSchemeAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">5 years fixed deposit</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxFDAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">PPF investment</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxPPFAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">unit linked insurance plan</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxInsAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Any other 80C</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxOtherAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Your annual salary</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxAnnSal" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right">Check</label>
                        <div class="col-sm-4">
                            <input type="button" name="" id="taxCheckBtn" value="Check Tax" class="btn btn-primary btnsize">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Your current investment are</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxTotalInvAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Further investment opportunity</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxRemInvAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-7 text-right" for="">Tax saved through further investment</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="taxSaveAmt123" name="" placeholder="" readonly="">
                        </div>
                    </div>
                
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#saveTaxShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- modal end -->

<!-- Fixed deposit calculator modal start -->

<div class="modal fade in" id="fixdepCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fixed deposit calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Amount invested</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="fixdepAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Invested for number of</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="fixdepNum" name="" placeholder="" required="">
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="fixdepNumType" class="form-control">
                                <option value="1">Years</option>
                                <option value="12">Months</option>
                                <option value="365">Days</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest rate</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="fixdepIntRate" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Frequency</label>
                        <div class="col-sm-4">
                            <select name="" id="fixdepIntType" class="form-control">
                                <option value="simpleInterest">Simple interest</option>
                                <option value="12">Monthly</option>
                                <option value="4">Quarterly</option>
                                <option value="2">Half yearly</option>
                                <option value="1">Annually</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Check</label>
                        <div class="col-sm-4">
                            <input type="button" name="" class="btn btn-primary btnsize" value="Check Fixed Deposit" id="fdCheckBtn">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Maturity value of investment at the end of <span class="fixdepYearShow">**</span> Rs. </label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="fixdepMatAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest earned </label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="fixdepTotalInt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-9 col-md-offset-2 ml-5">
                            <div class="alert alert-info ml-5">
                                If you invest Rs.<span id="fixdepInvestAmt">*****</span> per <span id="fixdepTimeShow">month</span> for <span class="fixdepYearShow">***</span> @ <span id="fixdepIntShow"></span>% P.A expected rate of return, you will accumulate Rs. <span id="fixdepTotalAmt">****</span> at the end of the <span class="fixdepYearShow">**</span>.
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-9 col-md-offset-2 ml-5">
                            <div class="alert alert-warning ml-5">
                                " Earn More then FD's by Investing MF's ".
                            </div>
                        </div>
                    </div>
                
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default"> 
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#lumpSumShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- Fixed deposit calculator modal end -->

<!-- Recurring deposit calculator modal start -->

<div class="modal fade in" id="recdepCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Recurring deposit calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Amount invested monthly</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="rdAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Invested for no. of</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="rdNumYears" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">Year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest rate</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="rdIntRate" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="rdCheckBtn" name="" value="Check RD" placeholder="">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Maturity value of investment at the end of <span id="rdYearShow">**</span><sup>th</sup> year is Rs. </label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="rdTotalAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-9 col-md-offset-2 ml-5">
                            <div class="alert alert-warning ml-5">
                                " Earn More then RD's by Investing MF's ".
                            </div>
                        </div>
                    </div>
               
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default"> 
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#sipSTPShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- Recurring deposit calculator modal end -->


<!-- EMI calculator for home loan modal start -->

<div class="modal fade in" id="emiHomeCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">EMI calculator for home loan</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Housing Loan Amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="homeLoanAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest rate(P.A.)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="homeLoanIntRate" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Tenure (Yrs)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="homeLoanNumYears" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="homeLoanNumYears">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="homeLoanCheck" name="" placeholder="" value="Check Home Loan" required="">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">EMI amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="homeLoanEmiAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total amount payable</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="homeLoanTotalPayAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest component</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="homeLoanTotalInt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-info ">
                                <strong>Suggestion:</strong>
                                <br> Keep your loan tenure as low as possible, as the tenure increases interest component increases significantly.
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-warning">
                                " Invest in SIP's to reach your own house goal ".
                            </div>
                        </div>
                    </div>
  
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#ownHouseShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- EMI calculator for home loan modal end -->


<!-- EMI calculator for car loan modal start -->

<div class="modal fade in" id="emiCarCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">EMI calculator for car loan</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Car Loan Amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="carLoanAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest rate(P.A.)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="carLoanIntRate" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Tenure (Yrs)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="carLoanNumYears" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="carLoanCheck" name="" placeholder="" value="Check Car Loan" required="">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">EMI amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="carLoanEmiAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total payble amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="carLoanPayAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="carLoanTotalInt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-info">
                                <strong>Suggestion:</strong>
                                <br> Keep your loan tenure as low as possible, as the tenure increases interest component increases significantly.
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-warning">
                                " Invest in SIP's to reach your car goal ".
                            </div>
                        </div>
                    </div>
        
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#buyCarShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- EMI calculator for car loan modal end -->

<!-- EMI calculator for personal loan modal start -->

<div class="modal fade in" id="emiPerCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">EMI calculator for personal loan</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Loan amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="perLoanAmt" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest rate(P.A.)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="perLoanIntRate" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Tenure (Yrs)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="perLoanNumYears" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4" for="">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="perLoanCheck" name="" placeholder="" value="Check Personal Loan">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">EMI amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="perLoanEmiAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total amount payable</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="perLoanPayAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest component</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="perLoanTotalInt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-info">
                                <strong>Suggestion:</strong>
                                <br> Keep your loan tenure as low as possible, as the tenure increases interest component increases significantly.
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-warning">
                                " Invest in SIP's for emergency fund with instant withdraw option".
                            </div>
                        </div>
                    </div>
       
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#sipSTPShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- EMI calculator for personal loan modal end -->

<!-- PPF(Public Provident Fund) calculator modal start -->

<div class="modal fade in" id="ppfCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">PPF(Public Provident Fund) calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">PPF Interest Rate</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ppfIntRate" name="" placeholder="" required="" readonly="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Amount invested</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ppfAmt" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">Per year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">No. of years</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ppfNumYear" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Investment made at</label>
                        <div class="col-sm-4">
                            <select name="" id="ppfRateType" class="form-control">
                                <option value="7.6">End of the period</option>
                                <option value="7.8">Begining of the period</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="ppfCheck" name="" value="Check PPF">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total investment</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ppfTotalInvest" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total interest earned</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ppfTotalIntEarn" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total maturity amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ppfTotalMatAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-info">
                                <strong>TAX saving:</strong>
                                <br> Under Sec 80C.
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-warning">
                                " ELSS(Tax Saving MF) is also exempted like PPF and can generate better return then PPF "
                            </div>
                        </div>
                    </div>
          
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#sipSTPShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- PPF(Public Provident Fund) calculator  modal end -->

<!-- EPF(Employee Provident Fund) calculator modal start -->
<div class="modal fade in" id="epfCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">EPF(Employee Provident Fund) calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <legend>Calculate maturity value</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Basic salary per month</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Your age</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Your retirement age</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Assuming</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="">
                        </div>
                        <label class="control-label col-sm-4 text-left" for="">% contribution</label>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Your contribution</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Employer's contribution (EPF+EPS)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total interest earned</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total maturity amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" readonly="">
                        </div>
                    </div>
         
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#sipSTPShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- EPF(Employee Provident Fund) calculator modal end -->

<!-- NPS(National Pension Scheme) calculator modal start -->

<div class="modal fade in" id="npsCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">NPS(National Pension Scheme) calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Current age</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsCurrAge" name="" placeholder="" required="">
                        </div>
                        <label class="control-label col-sm-1" for="">year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Retirement age</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsRetAge" name="" placeholder="">
                        </div>
                        <label class="control-label col-sm-1" for="">year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total investing period</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsNumYears" name="" placeholder="">
                        </div>
                        <label class="control-label col-sm-1" for="">year</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">monthly contribution to be done</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsMonInvAmt" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Expected rate of return</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsIntRate" name="" placeholder="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right">Check</label>
                        <div class="col-sm-4">
                            <input type="button" name="" class="btn btn-primary btnsize" id="npsCheckBtn" value="Check NPS">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Principal amount invested</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsTotalInvAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest earned on investment</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsTotalIntAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Pension wealth generated</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="npsPensAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
          
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <!-- <button type="button" onclick="javascript:window.location='planagoal.html#retireRichShow';" class="btn btn-default">Start investing</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button> -->
            </div> 
        </div>
    </div>
</div>

<!-- NPS(National Pension Scheme) calculator modal end -->

<!-- SSY(Sukanya Samriddhi Yojana) Calculator modal start -->

<div class="modal fade in" id="ssyCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">SSY(Sukanya Samriddhi Yojana) Calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Amount invested</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ssyAmt" name="" placeholder="" required="">
                        </div>
                        <div class="col-sm-4">
                            <select name="" id="ssyTimePeriod" class="form-control">
                                <option value="1">Year</option>
                                <option value="12">Month</option>
                                <!-- <option value="0">Month</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Interest rate</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ssyIntRate" name="" placeholder="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Investment started at year of</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ssyStartyear" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="ssyCheck" name="" value="Check SSY">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Maturity year</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ssyMatYear" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total maturity amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="ssyTotalAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-warning">
                                " Invest in top MF's for child education, child marriage and for bright future of child . "
                            </div>
                        </div>
                    </div>
            
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <button type="button" onclick="javascript:window.location='planagoal.html#higherEduShow';" class="btn btn-default">Browse MF'S</button>
               <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button>
            </div>
        </div>
    </div>
</div>

<!-- SSY(Sukanya Samriddhi Yojana) Calculator modal end -->

<!-- SWP(Systematic Withdrawal Plans) Calculator modal start -->

<div class="modal fade in" id="swpCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">SWP(Systematic Withdrawal Plans) Calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Total Investment Amount</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Withdrawal per month</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Expected return</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="">
                        </div>
                        <label class="control-label col-sm-1" for="">%</label>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Tenure (Yrs)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Value of the end of ** <sup>th</sup> year</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="" name="" placeholder="" readonly="">
                        </div>
                    </div>
               
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <button type="button" onclick="javascript:window.location='planagoal.html#sipSTPShow';" class="btn btn-default">Invest Now</button>
             <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button>
            </div>
        </div>
    </div>
</div>

<!-- SWP(Systematic Withdrawal Plans) Calculator modal end -->

<!-- HRA calculator modal start -->

<div class="modal fade in" id="hraCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">HRA calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Basic salary received</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="hraBscSal" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Dearness Allowance(DA) Received</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="hraDA" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">HRA received</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="hraRec" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Actual Rent Paid</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="hraActRentPad" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Select city</label>
                        <div class="col-sm-4">
                            <select name="" id="hraCity" class="form-control">
                                <option value="dl">Delhi</option>
                                <option value="mu">Mumbai</option>
                                <option value="ko">Kolkata</option>
                                <option value="ch">Chennai</option>
                                <option value="oth">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="HRA_Check" name="" value="Check">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">HRA exemption</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="hraExempt" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">HRA taxable</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="hrataxable" name="" placeholder="" readonly="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-10 col-md-offset-2 ml-5">
                            <div class="alert alert-warning">
                                " Invest in Tax saving mutual funds for saving TAX . "
                            </div>
                        </div>
                    </div>
 
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <button type="button" onclick="javascript:window.location='planagoal.html#saveTaxShow';" class="btn btn-default">Invest Now</button>
               <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button>
            </div>
        </div>
    </div>
</div>

<!-- HRA calculator modal end -->

<!-- SIP installment calculator modal start -->

<div class="modal fade in" id="sipInsCal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">SIP installment calculator</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Amount you want to achieve</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipInsAmt" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">With in Number of Years</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipInsNumYears" name="" placeholder="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Risk undertaken</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="sipInsRiskTaken">
                                <option value="7">Low - 7%</option>
                                <option value="12">Moderate - 12%</option>
                                <option value="15">High - 15%</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right" for="">Rate of return (%)</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipInsIntRate" name="" placeholder="" value="7" required="">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="control-label col-sm-4 text-right"> Check</label>
                        <div class="col-sm-4">
                            <input type="button" class="btn btn-primary btnsize" id="checksipInsBtn" value="Check SIP Installment" name="">
                        </div>
                    </div>
                    <legend>Output</legend>
                    <div class="row form-group">
                        <label class="control-label col-sm-9 text-right" for="">Monthly SIP Amount to be invested to reach your goal</label>
                        <div class="col-sm-4">
                            <input type="number" min="0" class="form-control" id="sipInsMonInsAmt" name="" placeholder="" readonly="">
                        </div>
                    </div>
 
            </form></div>
            <div class="modal-footer">
                 <input type="reset" value="Recompute" class="btn btn-default">
                <button type="button" onclick="javascript:window.location='planagoal.html#sipSTPShow';" class="btn btn-default">Invest Now</button>
              <button type="button" class="btn btn-default" onclick="window.open('login.html')">Email report</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="oldnewCal" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Old vs New Tax Regime Calculator</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="calData">
                    <div class="row" id="oldnewForm">
                        <div class="col-xl-6 col-12" style="border-right: 1px dashed #d33633;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="si">Salary Income </label> <small>(Including all allowance/perks)</small>
                                        <input type="number" id="si" name="si" class="form-control form-control-sm" placeholder="Salary Income" value=0 >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="i80d">Investment in 80D </label> <small>(Medical Insurance, Expenditure upto 75K)</small>
                                        <input type="number" name="Investment_in_80D"  id="i80d" class="form-control form-control-sm" placeholder="Investment in 80D" value=0>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="ri">Rental Income </label> 
                                        <input type="number" name="rental_income" id="ri" class="form-control form-control-sm" placeholder="Rental Income" value=0 >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="ltac">Leave Travel Allowance Claim </label> 
                                        <input type="number" name="leave_travel" id="ltac" class="form-control form-control-sm" placeholder="Leave Travel Allowance Claim" value=0 >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="dn">80G Donation  </label> <small> (100%)</small>
                                        <input type="number" name="donation50" id="dn100" class="form-control form-control-sm" placeholder="donation" value=0>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="dn">80G Donation  </label> <small> (50%)</small>
                                        <input type="number" name="donation100" id="dn50" class="form-control form-control-sm" placeholder="donation" value=0>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="ihl">Interest on house loan </label> 
                                        <input type="number" name="house_loan" id="ihl" class="form-control form-control-sm" placeholder="Interest on house loan" value="0" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="i80c">Investment in 80C </label> <small>(Insurance/FD/EPF/PPF/ Equity Oriented Mutual Fund)</small>
                                        <input type="number" name="Investment in 80C"  id="i80c" class="form-control form-control-sm" placeholder="Investment in 80C" value="0" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="fdi">Fixed Deposit Interest </label> 
                                        <input type="number" name="fixed_deposit" id="fdi" class="form-control form-control-sm" placeholder="Fixed Deposit Interest" value="0" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="fc">Food Coupon </label> <small>(Tax exempted)</small>
                                        <input type="number" name="food_coupon" id="fc" class="form-control form-control-sm" placeholder="Food Coupon (tax exempted)" value="0" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="np">National Pension Scheme Contribution </label> 
                                        <input type="number" name="national_pension" id="np" class="form-control form-control-sm" placeholder="National Pension" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <h4 class="modal-title">Other Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="ro">Rent Paid </label> <small>(Per Month)</small>
                                        <input type="number" name="rent_paid" id="ro" class="form-control form-control-sm" placeholder="Rent Paid (Per Month)" value="0" >
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="hrac">HRA Component in Salary </label> <small>(Per Month)</small>
                                        <input type="number" name="hra_component"  id="hrac"class="form-control form-control-sm" placeholder="HRA Component in Salary (Per Month)" value="0" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="age">Age </label> 
                                        <input type="number" name="age_slab"  id="age" min="1" max="100" class="form-control form-control-sm" placeholder="Age (to know the slab)" value="0" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="bs">Basic Salary </label> <small>(Per Month)</small>
                                        <input type="number" name="basic_salary" id="bs" class="form-control form-control-sm" placeholder="Basic Salary (Per Month)" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="elementH"></div>
                    <div class="col-md-12 col-12" id="oldNewResult" style="display: none; ">
                    <style type="text/css">
                    @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}

        body .container {
            min-width: 500px;
            margin: 0 auto;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        body .clearfix:after { content: ""; display: table; clear: both; }
        body .left { float: left; }
        body .right { float: right; }
        body .helper { height: 100%; }
        header { height: 80px; margin-top: 20px; padding: 0px 5px 0; }
        header .company-info { color: #BDB9B9; text-align:center; }
        header .company-info .title { margin-bottom: 5px; color: #2A8EAC; font-weight: 600; font-size: 2em; }
        header .company-info .line { display: inline-block; margin: 0 4px; }
        section .details { min-width: 500px; margin-bottom: 15px; padding: 10px 35px; background-color: #2A8EAC; color: #ffffff; margin-top: 30px; }
        section .details .client { width: 50%; line-height: 16px; }
        section .details .client p{ line-height: 16px; color: #fff; font-weight: 500; }
        section .details .client .name { font-weight: 600; }
        section .details .data {
            width: 50%;
            text-align: right;
        }
        section .details .title {
            margin-bottom: 15px;
            font-size: 3em;
            font-weight: 400;
            text-transform: uppercase;
        }
        section .table-wrapper {
            position: relative;
            overflow: hidden;
        }
        section .table-wrapper:before {
            content: "";
            display: block;
            position: absolute;
            top: 33px;
            left: 30px;
            width: 90%;
            height: 100%;
            z-index: -1;
        }
        section table {
            width: 100%;
            margin-bottom: -20px;
            table-layout: fixed;
        }
        .align-middle {
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
        }
        .align-left {
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
        }
        .align-right {
            text-align: right;
            font-weight: 600;
            text-transform: uppercase;
        }
        section table tbody tr td {
            padding: 10px 5px;
            background: #F3F3F3;
            text-align: right;
        }
        footer .company-info {
            color: #BDB9B9;
            text-align:center;
        }
        footer .company-info .title {
            margin-bottom: 5px;
            color: #2A8EAC;
            font-weight: 600;
            font-size: 2em;
        }
        footer .company-info .line {
            display: inline-block;
            height: 9px;
            margin: 0 4px;
            border-left: 1px solid #2A8EAC;
        }

    </style>
                        <header class="clearfix">
                            <div class="container">
                                <div class="company-info">
                                    <img class="logo" src="https://test.optymoney.com/static/opty_theme/img/black-logo.png" alt=""/>
                                    <h2 class="title">Tax Planning Report – Old vs New Tax Regime for FY 2020-21</h2>
                                </div>
                            </div>
                        </header>

                        <section>
                            <div class="details clearfix">
                                <div class="client left">
                                    <p>Name : <spanp id="username"></span</p>
                                    <p>Email : <spanp id="useremail"></span</p>
                                    <p>Mobile : <spanp id="userphone"></span</p>
                                    <p>Financial Year : 2020-21</p>
                                    <p>Assessment Year : 2021-22</p>
                                </div>
                                <div class="data right">
                                    <p>Date: <span id="datetime"></span></p>
                                    <script>
                                    var dt = new Date();
                                    document.getElementById("datetime").innerHTML = dt.toLocaleDateString();
                                    </script>
                                </div>
                            </div>
                            <div class="container">
                                <div class="table-wrapper">
                                    <table class="table  table-bordered"  id="headercontent">
                                        <thead class="table-danger">
                                            <tr>
                                                <th class="align-middle">Particulars</th>
                                                <th class="align-middle">Old Tax Regime</th>
                                                <th class="align-middle">New Tax Regime</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Salary Income</label></td>
                                                <td class="align-right" id="sir"></td>
                                                <td class="align-right" id="sirn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Standard Deduction</label></td>
                                                <td class="align-right" id="sdr"></td>
                                                <td class="align-right" id="sdrn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">HRA Exemption</label></td>
                                                <td class="align-right" id="hraer"></td>
                                                <td class="align-right" id="hraern"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">LTA Exemption</label></td>
                                                <td class="align-right" id="ltaer"></td>
                                                <td class="align-right" id="itaern"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Food Coupon Exemption</label></td>
                                                <td class="align-right" id="fcer"></td>
                                                <td class="align-right" id="fcern"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Rental Income</label></td>
                                                <td class="align-right" id="rir"></td>
                                                <td class="align-right" id="rirn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Interest on House Loan</label></td>
                                                <td class="align-right" id="ihlr"></td>
                                                <td class="align-right" id="ihlrn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Interest on FD</label></td>
                                                <td class="align-right" id="ifdr"></td>
                                                <td class="align-right" id="ifdrn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">80C Deduction</label></td>
                                                <td class="align-right" id="c80cr"></td>
                                                <td class="align-right" id="c80crn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">80D Deduction</label></td>
                                                <td class="align-right" id="d80dr"></td>
                                                <td class="align-right" id="d80drn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">80G Donation</label></td>
                                                <td class="align-right" id="d80gr"></td>
                                                <td class="align-right" id="d80grn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">80CCD National Pension Scheme</label></td>
                                                <td class="align-right" id="p80ccdr"></td>
                                                <td class="align-right" id="p80ccdrn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label"><b>Taxable Income</b></label></td>
                                                <td class="align-right" id="tir"><b></b></td>
                                                <td class="align-right" id="tirn"><b></b></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label"><b>Tax on the income</b></label></td>
                                                <td class="align-right" id="toir"><b></b></td>
                                                <td class="align-right" id="toirn"><b></b></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label"><b>Surcharge</b></label></td>
                                                <td class="align-right" id="sr"><b></b></td>
                                                <td class="align-right" id="srn"><b></b></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Rebate u/s 87A</label></td>
                                                <td class="align-right" id="r87ar"></td>
                                                <td class="align-right" id="r87arn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label"><b>Income Tax</b></label></td>
                                                <td class="align-right" id="it_r"><b></b></td>
                                                <td class="align-right" id="it_rn"><b></b></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Cess</label></td>
                                                <td class="align-right" id="cessr"></td>
                                                <td class="align-right" id="cessrn"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-left"><label class="control-label">Total Tax Payable</label></td>
                                                <td class="align-right" id="ttpr"></td>
                                                <td class="align-right" id="ttprn"></td>
                                            </tr>
                                            <tr style="background: #fef2f2;">
                                                <td class="align-middle"><label class="control-label"><b>Benefit Under</b></label></td>
                                                <td class="align-middle"  id="bu"colspan="2" style="text-align:center;"></td>
                                            </tr>
                                            <tr style="background: #fef2f2;">
                                                <td class="align-middle"><label class="control-label"><b>Amount of Benefit</b></label></td>
                                                <td class="align-middle" id="aobr" colspan="2" style="text-align:center;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p id="stmt1" style="font-weight: 600"></p>
                            <p id="oldNewResultFooter" style="text-align: center">This is computer generated report and conclusion is based on minimum information captured, provided by the user and the same can be consulted with an expert to validate the same.</p>
                        </section>

                        <footer style="margin-bottom: 20px; padding: 20px 5px;">
                            <div class="container">
                                <div class="company-info">
                                    <h2 class="title">OPTYMONEY</h2>
                                    <a class="phone" href="tel:080-42061247">Phone : 080-42061247</a>
                                    <span class="line"></span>
                                    <a class="phone" href="tel:7411011282">Mob : 7411011282</a>
                                    <span class="line"></span>
                                    <a class="email" href="mailto:support@optymoney.com">Email : support@optymoney.com</a>
                                </div>
                            </div>
                        </footer>
                        <button type="button" name='action' class="boxed_btn boxed_btn_bg submit_calc" id="downloadPDF" style="float: right;">Download PDF</button>
                    </div>
                </form>
                <div class="row" id="userDetailsCalOldNew">
                    <div class="col-xl-12">
                        <form id="userData">
                            <p>Please fill in this form  for completion of payment.</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Name: </label> <span class="required">*</span>
                                        <input type="text" id="name" name="name" required class="form-control form-control-sm" placeholder= "Enter Your Name"  >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Email: </label> <span class="required">*</span>
                                        <input type="email" id="email" name="email" required class="form-control form-control-sm" placeholder= "Enter Your Email" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Phone Number: </label> <span class="required">*</span>
                                        <input type="number" id="mobile" name="mobile" required class="form-control form-control-sm" placeholder= "Enter Your  phone number" >
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Address Line 1: </label> <span class="required">*</span>
                                        <input type="text" value="" required class="form-control form-control-sm" name="address_line_1"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Address Line 2: </label> <span class="required">*</span>
                                        <input type="text" value="" required class="form-control form-control-sm" name="address_line_2"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">City: </label> <span class="required">*</span>
                                        <input type="text" value="" required class="form-control form-control-sm" name="city"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">State: </label> <span class="required">*</span>
                                        <input type="text" value="" required class="form-control form-control-sm" name="state"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Country: </label> <span class="required">*</span>
                                        <input type="text" value="" required class="form-control form-control-sm" name="country"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="phone">Zip Code: </label> <span class="required">*</span>
                                        <input type="text" value="" required class="form-control form-control-sm" name="zip_code"/>
                                    </div>
                                </div>-->
                                <input type="hidden" value="85/1, 2nd Floor, 10thcross" required class="form-control form-control-sm" name="address_line_1"/>
                                <input type="hidden" value="CBI Road, Ganga Nagar" required class="form-control form-control-sm" name="address_line_2"/>
                                <input type="hidden" value="Bangalore" required class="form-control form-control-sm" name="city"/>
                                <input type="hidden" value="Karnataka" required class="form-control form-control-sm" name="state"/>
                                <input type="hidden" value="India" required class="form-control form-control-sm" name="country"/>
                                <input type="hidden" value="560024" required class="form-control form-control-sm" name="zip_code"/>
                                <input type="hidden" name="mode" value="LIVE" />
                                <input type="hidden" name="order_id" value="<?php echo (int) rand(5000, 90000); ?>" />
                                <input type="hidden" name="amount" value="150" /> 
                                <input type="hidden" name="currency" value="INR" />
                                <input type="hidden" name="action" value="action" />
                                
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="amount">Amount: </label> <span class="required">*</span>
                                        <input type="number" id="amount" name="amount" required class="form-control form-control-sm" value=50 readonly>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <noscript><input type="submit" value="Continue"/></noscript>
                                        <button type="button" value='action' name='action' onclick="admincalOldNewregime()" class="boxed_btn boxed_btn_bg submit_calc" style="float: right;">Calculate</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SIP installment calculator modal end -->

      <!-- Lead Generation  -->
    <div class="contact_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="contact_form_info ">
                        <div class="section_title mb-40">
                          
                            <h3 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Subscribe to our newsletter </h3>
                        </div>
                        <form action="#" class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="row">
                                <div class="col-xl-12">
                                    <input name="text" placeholder="Your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your name'" required="" type="text">
                                </div>
                                <div class="col-xl-12">
                                    <input name="EMAIL" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required="" type="email">
                                </div>
                                <div class="col-xl-12">
                                    <input name="mobile" placeholder="Mobile Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mobile Number'" required="" type="tel">
                                </div>
                                
                                <div class="col-xl-12">
                                    <textarea placeholder="Your Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Message'" required=""></textarea>
                                    
                                </div>
                                <div class="col-xl-12">
                                        <button class="paste_btn2 " type="submit" >Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="contact_thumb2 wow fadeInRight" data-wow-duration="1s" data-wow-delay=".2s">
                        <div class="thumb_inner">
                            <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/newsletter.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact_area_end -->
     
      <!-- Testimonial  -->
 <div class="testmonial_area">
        <div class="container">
            <div class="row">
                
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="testmonial_active owl-carousel">
                            <div class="testmonial_review">
                                    <div class="author d-flex align-items-center">
                                      
                                            <div class="about_area">
                                                <div class="about_thumb2 wow fadeInUp " data-wow-duration="1s" data-wow-delay=".1s">
                                                    
                                                   <p>It has been a pleasure working with Devmantra.  I have liaised with him for more than 2.5 years now. His holistic approach to Wealth Management has brought clarity to all my financial goals and aspirations. Their team have done an incredible job of analysing, integrating and managing my personal and corporate needs enabling me to minimise the amount of tax I pay, secure my funds in various mutual fund plans and SIP's to reap great benefits over the years. He has shown me a clear path to secure my retirement too. I greatly value his expertise and simplified approach taken for all my financial planning needs. "Dev Mantra takes pride in seeing his client succeed.</p>
                                                    <h4 class="text-center">Rajesh Balachandran</h4>
                                                    <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/testmonial/author3.png" alt="">
                                                    <!--<a class="popup-video video_play_button" href="https://www.youtube.com/watch?time_continue=4&v=pX9HKoQhQ_g" >
                                                        <i class="fa fa-play"></i>
                                                    </a>-->
                                                </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            <div class="testmonial_review">
                                    <div class="author d-flex align-items-center">
                                        
                                        <div class="about_area">
                                            <div class="about_thumb2 wow fadeInUp " data-wow-duration="1s" data-wow-delay=".1s">
                                               <p>I realised I have always been paying more tax than I should have paid. Thanks to the team they have demystified the entire process to me for me to save more money.</p>
                                                <h4 class="text-center">Atishay Jand</h4>
                                                <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/testmonial/author2.png" alt="">
                                                <!--<a class="popup-video video_play_button" href="https://www.youtube.com/watch?time_continue=4&v=pX9HKoQhQ_g">
                                                    <i class="fa fa-play"></i>-->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="testmonial_review">
                                    <div class="author d-flex align-items-center">
                                        
                                        <div class="about_area">
                                            <div class="about_thumb2 wow fadeInUp " data-wow-duration="1s" data-wow-delay=".1s">
                                               <p>I always want to do investment and increase my wealth but don't know the right options that I should start to achieve my goals. Team Dev Mantra put me into the habit of doing investment and guided me to choose the right investment options. They took time to listen me, getting to know me, understand my priorities and keeping that in mind they designed my portfolio that will work smartly to achieve my goals.</p>
                                                <h4 class="text-center">Padma Lochana Patra</h4>
                                                <img src="<?php echo $CONFIG->staticURL;?><?php echo $CONFIG->theme_new; ?>img/testmonial/author.png" alt="">
                                                <!--<a class="popup-video video_play_button" href="https://www.youtube.com/watch?time_continue=4&v=pX9HKoQhQ_g">
                                                    <i class="fa fa-play"></i>-->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>


     <!-- popup form -->
     <div class="plan_goal_popup">
     <div class="modal fade custom_login_from" id="retirement_popup1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body ">
                    <div class="login_form">
                        <div class="login_heading">
                            <h3>Build Wealth</h3>
                        </div>
                        <div class="main_content">
                           
                            <form action="wealth.html" class="login">
                                In How many years do you want to accumulate wealth ?
                                <div class="multi_input">
                                    
                                    <input type="number" min="0" placeholder="In Years" >
                                 
                                </div>
                                
                                <div class="multi_input">
                                    
                                    <input type="number" min="0" placeholder="In Months" >
                                   
                                </div>
                                Switch to date input
                                

                                <div class="single_input">
                                    How much wealth do you want to accumulate?
                                    <input type="number" min="0" placeholder="Eg:500000" >
                                </div>
                               
                                <div class="login_heading">
                                Lorem ipsum dolor sit duis aute irure dolor in reprehent in the voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">ADD</button>
                                </div>
                                <div class="login_button">
                                    <button class="boxed_btn3 w-100" type="submit">CANCEL</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ popup form -->
