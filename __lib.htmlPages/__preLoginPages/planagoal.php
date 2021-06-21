 

<!-- Banner -->
<div class="banner_will">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-10 col-md-offset-1">
				<h1><center>We will help you manage your finance better</center><br> <center><span class="span-end">Plan a goal</span></center></h1>
				<center><span class="span-endline"></span></center>
			</div>
			
		</div>
	</div>
</div>
<!-- Banner -->


<section id="content" class="welth-content">
<div class="container-fluid">
    <div class="site-panel">
        <div class="container-fluid">
            <div class="row">
            
                <div class="col-md-2">
                    <div class="sidebar">
                    <div class="row" style="height:30px"></div>
                        <div class="list-group">
                            <a class="list-group-item" id="retireRich">Retire Rich</a>
                            <a class="list-group-item" id="grandWedding">Grand Wedding</a>
                            <a class="list-group-item" id="higherEdu">Higher Education</a>
                            <a class="list-group-item" id="ownHouse">Own A House</a>
                            <a class="list-group-item" id="buyCar">Buy A Car</a>
                            <a class="list-group-item" id="vacPlan">Vacation Plan</a>
                            <a class="list-group-item" id="emerFund">Emergency Fund</a>
                            <a class="list-group-item" id="uniGoal">Unique Goal</a>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="centrecol">
                <h2><center>Click on a goal to plan</center></h2>

                <div class="content-box well wealthHide retireRich calculateGoal" id="retireRichShow" > 
                    <!-- <legend>Retire rich </legend> -->
                    <div class="panel-group" id="retRichAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#retRichAcc" href="#retRiccollapse1">Retire rich</a>
                                </h4>
                            </div>
                            <div id="retRiccollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
									<div class="col-sm-12">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">I am</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="Ret_age" name="" placeholder="" required>
                                            </div>
                                            <label class="control-label col-sm-1" for="">Old</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">I want to retire at</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="Ret_retireAge" name="" placeholder="" required>
                                            </div>
                                            <label class="control-label col-sm-1" for="">Year</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My life expectancy</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="Ret_expectancy" name="" placeholder="" required>
                                            </div>
                                            <label class="control-label col-sm-1" for="">Year</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk</label>
                                            <div class="col-sm-2">
                                                <select id="Ret_risk" name="" class="form-control riskRateS">
                                                    <option value="0">Select</option>
                                                    <option value="7">Low</option>
                                                    <option value="12">Moderate</option>
                                                    <option value="15">High</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Expected rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="Ret_expRateReturn" name="" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My current lumpsum investment</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="Ret_currentLumpsum" name="" placeholder="" required>
                                            </div>
                                            <label class="control-label col-sm-3" for="">for retirement plan</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My expenses per month is</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="Ret_expPerMonth" name="" placeholder="" required>
                                            </div>
                                            <label class="control-label col-sm-3" for="">(i.e, after retirement)</label>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#retRichAcc" href="#retRiccollapse2" class="btn btn-success pull-right" id="retirerichBtn">Process</a>
                                        </div>
                                    </form>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#retRichAcc" href="#retRiccollapse2" >Summary</a>
                                </h4>
                            </div>
                            <div id="retRiccollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <legend>Summary</legend> -->
                                        <div class="col-md-5">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">My current age</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="Scurrent_age" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">My retirement age</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="Sretirement_age" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">My life expectancy</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="Slife_expectancy" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">My current lumpsum investment</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="Scurrent_lumpsum" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly contribution to be done</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="SMonthly_contribution" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk currently undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="SRisk_curr_undertaken" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="SRate_return" name="" placeholder="" required>
                                                    </div>
                                                    <label class="control-label col-sm-1" for="">%</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken after retirement</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="SRisk_undertaken_aft" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="SRate_return_aft" name="" placeholder="" required>
                                                    </div>
                                                    <label class="control-label col-sm-1" for="">%</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly expenses after retirement</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="SMonthly_expenses_aft" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of inflation</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange" id="SRate_inflation" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control Ret_SummaryChange mySIPAmount" id="SRate_SIPPerMonAmt" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Your retirement corpus could be <span id="Ret_FVAmt"></span> to reach this goal SIP amount to be invested <span id="Ret_PerMonthAmt"></span> per month.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Graph</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li>To reach the goal SIP of Rs. <span id="Ret_InvSipAmt1"></span> to be invested per month.</li>
                                                            <li>I can invest SIP of <span id="Ret_InvSIPAmt2"></span> per month At current SIP value, your retirement fund(including current lumpsum investment) is Rs. <span id=Ret_TotalRetFunds></span></li>
                                                            <li class="hidden">Increase SIP Investment to *** .</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow" data-toggle="collapse" data-parent="#retRichAcc" href="#retRiccollapse3">Invest now</a>
                                                    <a class="btn btn-info">Revise your goal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#retRichAcc" href="#retRiccollapse3">Recommended lumpsum/SIP saving schemes</a>
								</h4>
							</div>
                            <div id="retRiccollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Scheme</th>
														<th style="width:100px;">Amount(₹)</th>
														<th>Return</th>
														<th style="text-align: right;">Action</th>
													</tr>
												</thead>
												<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
													<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
														<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
														<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
														<td>16.37%</td>
														<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												</tbody>
												<tfoot class="tbl_posts_foot" id="tbl_posts_foot">
													<tr>
														<td colspan="2" align="right">Total(₹)</td>
														<td colspan="3" align="left" class="schemeTotal">5000.00</td>
													</tr>
												</tfoot>
											</table>
                                            <div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box well wealthHide grandWedding calculateGoal" id="grandWeddingShow">
                    <div class="panel-group" id="grandWedAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#grandWedAcc" href="#grandWedcollapse1">Grand Wedding</a>
								</h4>
                            </div>
                            <div id="grandWedcollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Current age</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="gndWedCurrAge" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Marriage age</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="gndWedMariageAge" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Cost of similar grand wedding as on today</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="gndWedAmt" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My current lumpsum investment for wedding</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="gndWedLumpsumAmt" name="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-3">
                                                <select class="form-control riskRateS" id="gndWedRiskTaken">
                                                    <option value="7">Low - 7%</option>
                                                    <option value="12">Moderate - 12%</option>
                                                    <option value="15">High - 15%</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="gndWedIntRate" value="7" name="" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Inflation Rate (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="gndWedInfRate" name="" value="5" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#grandWedAcc" href="#grandWedcollapse2" class="btn btn-success pull-right" id="gndWedProcessBtn1">Process</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#grandWedAcc" href="#grandWedcollapse2">Summary</a>
								</h4>
                            </div>
                            <div id="grandWedcollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <legend>Summary</legend> -->
                                        <div class="col-md-5">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Number of years to go for wedding</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control gndWedSummaryChange" id="gndWedNumYears" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Cost of similar grand wedding as on today</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control gndWedSummaryChange" id="gndWedAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Current lumpsum investment for wedding</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control gndWedSummaryChange" id="gndWedLumpsumAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly contribution to be done</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control gndWedSummaryChange" id="gndWedInvPerMonth" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="gndWedRiskTaken2" class="form-control">
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control gndWedSummaryChange" id="gndWedIntRate2" name="" placeholder="" >
                                                    </div>
                                                    <label class="control-label col-sm-1" for="">%</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Inflation rate</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control gndWedSummaryChange" id="gndWedInfRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control mySIPAmount gndWedSummaryChange" id="gndInvSipAmt" name="" placeholder=""  value="5000" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Future value of wedding costs <span id="gndWedFvAmt"></span> to reach this goal SIP amount to be invested <span id="gndWedSipAmt"></span> per month.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Graph</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li>I can invest SIP of <span id="gndWedSipAmt2"></span> per month.</li>
                                                            <li>At current SIP value, your grand wedding available fund(including current lumpsum saving) is Rs. <span id="gndWedAvilAmt"></span> Increase yourSIP Investment to reduce the gap of <span id="gndWedSipInv"></span> .</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow " data-toggle="collapse" data-parent="#grandWedAcc" href="#grandWedcollapse3">Invest now</a>
                                                    <a class="btn btn-info">Revise your goal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#grandWedAcc" href="#grandWedcollapse3">Recommended lumpsum/SIP saving schemes</a>
								</h4>
                            </div>
                            <div id="grandWedcollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Scheme</th>
														<th style="width:100px;">Amount(₹)</th>
														<th>Return</th>
														<th style="text-align: right;">Action</th>
													</tr>
												</thead>
												<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
													<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
														<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
														<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
														<td>16.37%</td>
														<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												</tbody>
												<tfoot class="tbl_posts_foot" id="tbl_posts_foot">
													<tr>
														<td colspan="2" align="right">Total(₹)</td>
														<td colspan="3" align="left" class="schemeTotal">5000.00</td>
													</tr>
												</tfoot>
											</table>
                                            <div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <legend>Grand wedding</legend> -->
                </div>
                <div class="content-box well wealthHide higherEdu calculateGoal" id="higherEduShow">
                    <div class="panel-group" id="highEduAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#highEduAcc" href="#highEducollapse1">Higher education</a>
								</h4>
                            </div>
                            <div id="highEducollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <!-- <legend>Higher education</legend> -->
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Current age</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="highEduCurrAge" name="" placeholder="" required>
                                            </div>
                                        </div>
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Higher education will start at the age of</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="highEduSrtAge" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">I have estimated the fee and expences</label>
                                            <div class="col-sm-3">
                                                <select name="" id="highEduEstExpns" class="form-control">
                                                    <option value="">Yes</option>
                                                    <option value="">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Amount required for fee and expenses</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="highEduAmt" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My current lumpsum investment for higher education</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="highEduLumpsumAmt" name="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-3">
                                                <select class="form-control riskRateS" id="highEduRiskTaken">
                                                    <option value="7">Low - 7%</option>
                                                    <option value="12">Moderate - 12%</option>
                                                    <option value="15">High - 15%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="highEduIntRate" value="7" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Inflation Rate (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="highEduInfRate" name="" value="5" placeholder="">
                                            </div>
                                        </div>
                                        <legend>fee expenses calculator(If no)</legend>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Choice of degree</label>
                                            <div class="col-sm-3">
                                                <select name="" id="" class="form-control">
                                                    <option value="">Engineering and technology</option>
                                                    <option value="">Fashion designing</option>
                                                    <option value="">Finance</option>
                                                    <option value="">Hotel Management</option>
                                                    <option value="">LAW and science</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Education level</label>
                                            <div class="col-sm-3">
                                                <select name="" id="" class="form-control">
                                                    <option value="">PG</option>
                                                    <option value="">UG</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Country of study</label>
                                            <div class="col-sm-3">
                                                <select name="" id="" class="form-control">
                                                    <option value="">India</option>
                                                    <option value="">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Category of institution</label>
                                            <div class="col-sm-3">
                                                <select name="" id="" class="form-control">
                                                    <option value="">Top</option>
                                                    <option value="">Mid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Institution type</label>
                                            <div class="col-sm-3">
                                                <select name="" id="" class="form-control">
                                                    <option value="">Private</option>
                                                    <option value="">Public</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-5 col-sm-offset-3">
                                                <button class="btn btn-primary">Calculate</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#highEduAcc" href="#highEducollapse2" class="btn btn-success pull-right" id="highEduProcessBtn1">Process</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#highEduAcc" href="#highEducollapse2">Summary</a>
								</h4>
                            </div>
                            <div id="highEducollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <legend>Summary</legend> -->
                                        <div class="col-md-5">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Number of years to start higher education</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control highEduSummaryChange" id="highEduNumYears" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Education cost</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control highEduSummaryChange" id="highEduAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Current lumpsum investement</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control highEduSummaryChange" id="highEduLumpsumAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly contribution (SIP) to be done</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control highEduSummaryChange" id="highEduInvPerMonth" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="highEduRiskTaken2" class="form-control riskRateS">
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control highEduSummaryChange riskRateT" id="highEduIntRate2" name="" placeholder="" required>
                                                    </div>
                                                    <label class="control-label col-sm-1" for="">%</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Inflation rate</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control highEduSummaryChange" id="highEduInfRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control highEduSummaryChange mySIPAmount " id="highEduSipAmt" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Your higher education corpus could be <span id="highEduFvAmt"></span> to reach this goal SIP amount to be invested monthly is <span id="highEduSipAmt3"></span>.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Graph</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li>I can invest SIP of <span id="highEduSipAmt2"></span> per month</li>
                                                            <li>At current SIP value, your fund for education(including current lumpsum investment) is Rs. <span id="highEduAvilAmt"></span> </li>
                                                              <li>Increase your SIP Investment to reduce the gap of <span id="highEduSipInv"></span> .</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow " data-toggle="collapse" data-parent="#highEduAcc" href="#highEducollapse3">Invest Now</a>
                                                    <a class="btn btn-info">Revise your goal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#highEduAcc" href="#highEducollapse3">Recommended lumpsum/SIP saving schemes</a>
								</h4>
                            </div>
                            <div id="highEducollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row"> 
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Scheme</th>
														<th style="width:100px;">Amount(₹)</th>
														<th>Return</th>
														<th style="text-align: right;">Action</th>
													</tr>
												</thead>
												<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
													<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
														<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
														<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
														<td>16.37%</td>
														<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												</tbody>
												<tfoot id="tbl_posts_foot" class="tbl_posts_foot">
													<tr>
														<td colspan="2" align="right">Total(₹)</td>
														<td colspan="3" align="left" class="schemeTotal">5000.00</td>
													</tr>
												</tfoot>
											</table>
                                            <div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box well wealthHide ownHouse calculateGoal" id="ownHouseShow">
                    <div class="panel-group" id="ownHouseAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#ownHouseAcc" href="#ownHousecollapse1">Own A House</a>
								</h4>
                            </div>
                            <div id="ownHousecollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Number of years to buy a house</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="ownHousNoOfYear" name="" placeholder="" required>
                                            </div>
                                            <label class="control-label col-sm-1" for="">years</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Amount required to buy</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="ownHousAmtReq" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">To complete the interior work(Estimated 20%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="ownHousIntWork" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Total cost</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="ownHousTotalAmt" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-3">
                                                <select class="form-control riskRateS" id="ownHousRiskTaken">
                                                    <option value="7">Low - 7%</option>
                                                    <option value="12">Moderate - 12%</option>
                                                    <option value="15">High - 15%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="ownHousIntRate" name="" value="7" placeholder="" required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Inflation Rate (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="ownHousInfRate" name="" value="5" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Current lumpsum investment for purchase of house</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="ownHousLumpsumAmt" name="" placeholder="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#ownHouseAcc" href="#ownHousecollapse2" class="btn btn-success pull-right" id="ownHousProcessBtn1">Process</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#ownHouseAcc" href="#ownHousecollapse2">Summary</a>
								</h4>
                            </div>
                            <div id="ownHousecollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <legend>Summary</legend> -->
                                        <div class="col-md-5">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Number of years</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control ownHousSummaryChange" id="ownHousNumYears" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Amount required to buy</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control ownHousSummaryChange" id="ownHousAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">My Current lumpsum investment</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control ownHousSummaryChange" id="ownHousLumpsumAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly Contribution (SIP) to be done</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control ownHousSummaryChange" id="ownHousInvPerMonth" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="ownHousRiskTaken2" class="form-control riskRateS">
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control ownHousSummaryChange riskRateT" id="ownHousIntRate2" name="" placeholder="" required>
                                                    </div>
                                                    <label class="control-label col-sm-1" for="">%</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Inflation rate</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control ownHousSummaryChange" id="ownHousInfRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control ownHousSummaryChange mySIPAmount" id="ownHousSipAmt" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Future value of house costs <span id="ownHousFvAmt"></span> to reach this goal SIP amount to be invested <span id="ownHousSipAmt3"></span> per month.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Graph</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li>I can invest SIP of <span id="ownHousSipAmt2"></span> per month</li>
                                                            <li>At current SIP value, your fund for house(including current lumpsum saving) is Rs. <span id="ownHousAvilAmt"></span>.</li>
                                                            <li>Increase your  SIP Investment to reduce the gap of RS. <span id="ownHousSipInv"></span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow " data-toggle="collapse" data-parent="#ownHouseAcc" href="#ownHousecollapse3">Invest now</a>
                                                    <a class="btn btn-info">Revise your goal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#ownHouseAcc" href="#ownHousecollapse3">Recommended lumpsum/SIP saving schemes</a>
								</h4>
                            </div>
                            <div id="ownHousecollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Scheme</th>
														<th style="width:100px;">Amount(₹)</th>
														<th>Return</th>
														<th style="text-align: right;">Action</th>
													</tr>
												</thead>
												<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
													<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
														<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
														<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
														<td>16.37%</td>
														<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												</tbody>
												<tfoot id="tbl_posts_foot" class="tbl_posts_foot">
													<tr>
														<td colspan="2" align="right">Total(₹)</td>
														<td colspan="3" align="left" class="schemeTotal">5000.00</td>
													</tr>
												</tfoot>
											</table>
                                            <div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <legend>Own a house</legend> -->
                </div>
                <div class="content-box well wealthHide buyCar calculateGoal" id="buyCarShow">
                    <div class="panel-group" id="buyCarAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#buyCarAcc" href="#buyCarcollapse1">Buy A Car</a></h4>
                            </div>
                            <div id="buyCarcollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
									<div class="col-sm-12">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Number of years to buy a car</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="buyACarNoOfYear" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Cost of the car</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="buyACarAmt" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My current lumpsum investment for purchase of car</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="buyACarLumpsumAmt" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-3">
                                                <select class="form-control riskRateS" id="buyACarRiskTaken">
                                                    <option value="7">Low - 7%</option>
                                                    <option value="12">Moderate - 12%</option>
                                                    <option value="15">High - 15%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="buyACarIntRate" name="" placeholder="" >
                                            </div>
                                            <label class="control-label col-sm-1" for="">%</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Inflation Rate (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="buyACarInfRate" name="" value="5" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#buyCarAcc" href="#buyCarcollapse2" class="btn btn-success pull-right" id="buyACarProcessBtn1">Process</a>
                                        </div>
                                    </form>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#buyCarAcc" href="#buyCarcollapse2">Summary</a>
								</h4>
                            </div>
                            <div id="buyCarcollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
										<legend>Summary</legend>
										</div>
                                        <div class="col-md-6">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Number of years</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control buyACarSummaryChange" id="buyACarNumYears" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Cost of the car</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control buyACarSummaryChange" id="buyACarAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Current lumpsum Investment</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control buyACarSummaryChange" id="buyACarLumpsumAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="buyACarRiskTaken2" class="form-control riskRateS">
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control buyACarSummaryChange riskRateT" id="buyACarIntRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Inflation rate</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control buyACarSummaryChange" id="buyACarInfRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly contribution to be done</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control buyACarSummaryChange" id="buyACarInvPerMonth" name="" placeholder="" value="0" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control buyACarSummaryChange mySIPAmount " id="buyACarSipAmt" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Future value of car <span id="buyACarFvAmt"></span> to reach the goal SIP Rs. <span id="buyACarSipAmt3"></span> to be invested per month.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Suggestions</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li>Invest SIP of <span id="buyACarSipAmt2"></span> per month</li>
                                                            <li>At current SIP value, your retirement fund(including current lumpsum saving) is Rs. <span id="buyACarAvilAmt"></span> </li>
                                                            <li>Increase your SIP Investment to reduce the gap of<span id="buyACarSipInv"></span> .</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow " id="investNow" data-toggle="collapse" data-parent="#buyCarAcc" href="#buyCarcollapse3">Invest now</a>
													<a class="btn btn-primary" data-toggle="collapse" data-parent="#buyCarAcc" href="#buyCarcollapse1">Revise your goal</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#buyCarAcc" href="#buyCarcollapse3">Recommended lumpsum/SIP saving schemes</a></h4>
                            </div>
                            <div id="buyCarcollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Scheme</th>
														<th style="width:100px;">Amount(₹)</th>
														<th>Return</th>
														<th style="text-align: right;">Action</th>
													</tr>
												</thead>
												<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
													<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
														<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
														<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
														<td>16.37%</td>
														<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												</tbody>
												<tfoot id="tbl_posts_foot" class="tbl_posts_foot">
													<tr>
														<td colspan="2" align="right">Total(₹)</td>
														<td colspan="3" align="left" class="schemeTotal">5000.00</td>
													</tr>
												</tfoot>
											</table>
											<div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box well wealthHide vacPlan calculateGoal" id="vacPlanShow">
                    <div class="panel-group" id="vacPlanAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#vacPlanAcc" href="#vacPlancollapse1">Vacation plan</a>
								</h4>
                            </div>
                            <div id="vacPlancollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">After how many years, you are planning for vacation</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="vacaPlanNoOfYear" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Cost of vacation</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="vacaPlanAmtReq" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My current lumpsum investment for vacation</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="vacaPlanLumpsumAmt" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-3">
                                                <select class="form-control riskRateS" id="vacaPlanRiskTaken">
                                                    <option value="7">Low - 7%</option>
                                                    <option value="12">Moderate - 12%</option>
                                                    <option value="15">High - 15%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="vacaPlanIntRate" value="7" name="" placeholder="" required>
                                            </div>
                                            <label class="control-label col-sm-1" for="">%</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Inflation Rate (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="vacaPlanInfRate" name="" value="5" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#vacPlanAcc" href="#vacPlancollapse2" class="btn btn-success pull-right" id="vacaPlanProcessBtn1">Process</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#vacPlanAcc" href="#vacPlancollapse2">Summary</a>
								</h4>
                            </div>
                            <div id="vacPlancollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Number of years</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control vacaPlanSummaryChange" id="vacaPlanNumYears" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Amount</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control vacaPlanSummaryChange" id="vacaPlanAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Current lumpsum investment</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control vacaPlanSummaryChange" id="vacaPlanLumpsumAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="vacaPlanRiskTaken2" class="form-control riskRateS">
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control vacaPlanSummaryChange riskRateT" id="vacaPlanIntRate2" name="" placeholder="" required>
                                                    </div>
                                                    <label class="control-label col-sm-1" for="">%</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of inflation</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control vacaPlanSummaryChange" id="vacaPlanInfRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly contribution to be done rs.</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control vacaPlanSummaryChange" id="vacaPlanInvPerMonth" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control vacaPlanSummaryChange mySIPAmount" id="vacaPlanSipAmt" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Future value of vacation <span id="vacaPlanFvAmt"></span> to reach this goal SIP of Rs. <span id="vacaPlanSipAmt3"></span> to be invested per month.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Graph</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                          <li>I can invest SIP of <span id="vacaPlanSipAmt2"></span> per month</li>
                                                          <li>At current SIP value, your retirement fund(including current lumpsum saving) is Rs. <span id="vacaPlanAvilAmt"></span> </li>
                                                          <li>Increase your SIP Investment to reduce the gap of <span id="vacaPlanSipInv"></span> .</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow" data-toggle="collapse" data-parent="#vacPlanAcc" href="#vacPlancollapse3">Invest now</a>
                                                    <a class="btn btn-info">Revise your goal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#vacPlanAcc" href="#vacPlancollapse3">Recommended lumpsum/SIP saving schemes</a>
								</h4>
                            </div>
                            <div id="vacPlancollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
											<thead>
												<tr>
													<th>#</th>
													<th>Name of Scheme</th>
													<th style="width:100px;">Amount(₹)</th>
													<th>Return</th>
													<th style="text-align: right;">Action</th>
												</tr>
											</thead>
											<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
												<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
													<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
													<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
													<td>16.37%</td>
													<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
												</tr>
											</tbody>
											<tfoot id="tbl_posts_foot" class="tbl_posts_foot">
												<tr>
													<td colspan="2" align="right">Total(₹)</td>
													<td colspan="3" align="left" class="schemeTotal">5000.00</td>
												</tr>
											</tfoot>
										</table>
                                            <div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box well wealthHide emerFund calculateGoal" id="emerFundShow">
                    <div class="panel-group" id="emergFundAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#emergFundAcc" href="#emergFundcollapse1">Emergency fund</a>
								</h4>
                            </div>
                            <div id="emergFundcollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Amount required in case of emergency</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="emeFundAmtReq" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">In how many years you want to realize</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="emeFundNoOfYear" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My current lumpsum investment</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="emeFundLumpsumAmt" name="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-3">
                                                <select class="form-control riskRateS" id="emeFundRiskTaken">
                                                    <option value="7">Low - 7%</option>
                                                    <option value="12">Moderate - 12%</option>
                                                    <option value="15">High - 15%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="emeFundIntRate" value="7" name="" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1" for="">%</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Inflation Rate (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="emeFundInfRate" name="" value="5" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#emergFundAcc" href="#emergFundcollapse2" class="btn btn-success pull-right" id="emeFundProcessBtn1">Process</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#emergFundAcc" href="#emergFundcollapse2">Summary</a>
								</h4>
                            </div>
                            <div id="emergFundcollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Build emergency fund in year</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control emeFundSummaryChange" id="emeFundNumYears" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Amount required</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control emeFundSummaryChange" id="emeFundAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">My current lumpsum investment</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control emeFundSummaryChange" id="emeFundLumpsumAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="emeFundRiskTaken2" class="form-control riskRateS">
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control emeFundSummaryChange riskRateT" id="emeFundIntRate2" name="" placeholder="" required>
                                                    </div>
                                                    <label class="control-label col-sm-1" for="">%</label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of inflation</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control emeFundSummaryChange" id="emeFundInfRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly contribution to be done</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control emeFundSummaryChange" id="emeFundInvPerMonth" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control emeFundSummaryChange mySIPAmount" id="emeFundSipAmt" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Future value of emergency fund <span id="emeFundFvAmt"></span> to reach this goal SIP of Rs. <span id="emeFundSipAmt3"></span> to be invested.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Graph</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li>I can invest SIP of <span id="emeFundSipAmt2"></span> per month</li>
                                                            <li>At current SIP value, your fund for emergency(including current lumpsum investment) is Rs. <span id="emeFundAvilAmt"></span> </li>
                                                            <li>Increase your SIP Investment to reduce the gap of <span id="emeFundSipInv"></span> .</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow " data-toggle="collapse" data-parent="#emergFundAcc" href="#emergFundcollapse3">Invest now</a>
                                                    <a class="btn btn-info">Revise your goal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#emergFundAcc" href="#emergFundcollapse3">Recommended lumpsum/SIP saving schemes</a>
								</h4>
                            </div>
                            <div id="emergFundcollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Scheme</th>
														<th style="width:100px;">Amount(₹)</th>
														<th>Return</th>
														<th style="text-align: right;">Action</th>
													</tr>
												</thead>
												<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
													<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
														<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
														<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
														<td>16.37%</td>
														<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												</tbody>
												<tfoot id="tbl_posts_foot" class="tbl_posts_foot">
													<tr>
														<td colspan="2" align="right">Total(₹)</td>
														<td colspan="3" align="left" class="schemeTotal">5000.00</td>
													</tr>
												</tfoot>
											</table>
                                            <div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box well wealthHide uniGoal calculateGoal" id="uniGoalShow">
                    <div class="panel-group" id="uniGoalAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#uniGoalAcc" href="#uniGoalcollapse1">Unieque Goal</a>
								</h4>
                            </div>
                            <div id="uniGoalcollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">How long will you take to achive your goal</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="uniqGoalNoOfYear" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">How much amount do you need to achieve this goal</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="uniqGoalAmtReq" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">My current lumpsum investment for this goal</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="uniqGoalLumpsumAmt" name="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-3">
                                                <select class="form-control riskRateS" id="uniqGoalRiskTaken">
                                                    <option value="7">Low - 7%</option>
                                                    <option value="12">Moderate - 12%</option>
                                                    <option value="15">High - 15%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control riskRateT" id="uniqGoalIntRate" name="" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1" for="">%</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Inflation Rate (%)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="uniqGoalInfRate" name="" value="5" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a data-toggle="collapse" data-parent="#uniGoalAcc" href="#uniGoalcollapse2" class="btn btn-success pull-right" id="uniqGoalProcessBtn1">Process</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#uniGoalAcc" href="#uniGoalcollapse2">Summary</a>
								</h4>
                            </div>
                            <div id="uniGoalcollapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- <legend>Summary</legend> -->
                                        <div class="col-md-5">
                                            <form class="form-horizontal" action="/action_page.php">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Number of years</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control uniqGoalSummaryChange" id="uniqGoalNumYears" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Amount required</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control uniqGoalSummaryChange" id="uniqGoalAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Current lumpsum investment</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control uniqGoalSummaryChange" id="uniqGoalLumpsumAmt2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Risk undertaken</label>
                                                    <div class="col-sm-3">
                                                        <select name="" id="uniqGoalRiskTaken2" class="form-control riskRateS">
                                                            <option value="7">Low</option>
                                                            <option value="12">Moderate</option>
                                                            <option value="15">High</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of return</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control uniqGoalSummaryChange riskRateT" id="uniqGoalIntRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Rate of inflation</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control uniqGoalSummaryChange" id="uniqGoalInfRate2" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">Monthly contribution to be done</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control uniqGoalSummaryChange" id="uniqGoalInvPerMonth" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-9" for="">I can invest SIP of Rs.(per month)</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control uniqGoalSummaryChange mySIPAmount" id="uniqGoalSipAmt" name="" placeholder="" required>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        Future value of your goal is <span id="uniqGoalFvAmt"></span> to reach this goal SIP of Rs. <span id="uniqGoalSipAmt3"></span> to be invested.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <div class="graph-box border-1 pad-20">
                                                        <!-- <h3>95</h3> -->
                                                        <h5>Graph</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="alert alert-info">
                                                        <ul>
                                                            <li>I can invest SIP of <span id="uniqGoalSipAmt2"></span> per month</li>
                                                            <li>At current SIP value, your retirement fund(including current lumpsum saving) is Rs. <span id="uniqGoalAvilAmt"></span> </li>
                                                            <li>Increase your  SIP Investment to reduce the gap of <span id="uniqGoalSipInv"></span> .</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <a class="btn btn-success">Email report</a>
                                                    <a class="btn btn-primary investNow" data-toggle="collapse" data-parent="#uniGoalAcc" href="#uniGoalcollapse3">Invest now</a>
                                                    <a class="btn btn-info">Revise your goal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#uniGoalAcc" href="#uniGoalcollapse3">Recommended lumpsum/SIP saving schemes</a>
								</h4>
                            </div>
                            <div id="uniGoalcollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Top mutual fund schemes</p>
                                            <table class="table table-hover listOfScheme" id="listOfScheme">	
												<thead>
													<tr>
														<th>#</th>
														<th>Name of Scheme</th>
														<th style="width:100px;">Amount(₹)</th>
														<th>Return</th>
														<th style="text-align: right;">Action</th>
													</tr>
												</thead>
												<tbody class="scrollable tbl_posts_body" id="tbl_posts_body">
													<tr id="rec-0" class="active"><td><span class="sn">1</span>.</td>
														<td>HDFC Balanced Advantage Fund<br><span style="font-size:85%"><strong>Type:</strong> Reliance Value Fund</span></td>
														<td><input type="number" min="100" placeholder="100" step="100" value="5000" name="sipamount" class="sipamount"></td>
														<td>16.37%</td>
														<td align="right"><a class="btn btn-xs delete-scheme" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
													</tr>
												</tbody>
												<tfoot id="tbl_posts_foot" class="tbl_posts_foot">
													<tr>
														<td colspan="2" align="right">Total(₹)</td>
														<td colspan="3" align="left" class="schemeTotal">5000.00</td>
													</tr>
												</tfoot>
											</table>
                                            <div class="form-group">
												<label class="control-label col-sm-3" for="">
													<button type="button" class="btn icon-btn btn-success moreScheme"><span class="glyphicon btn-glyphicon glyphicon-plus"> </span> More scheme</button> 
												</label>
												<label class="control-label col-sm-3 col-sm-offset-5" for="">
													<button type="button" class="btn icon-btn btn-success startInvestment">Start investments</button>
												</label>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                         
						 
			<!-- Investment screen start -->
                            
                <div class="content-box well wealthHide sipSTP" id="sipSTPShow">
                    <div class="panel-group" id="sipAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
								  <a data-toggle="collapse" data-parent="#sipAcc" href="#sipcollapse1">SIP</a>
								</h4>
                            </div>
                            <div id="sipcollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">How much money do you want to invest in SIP per month</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">How many years you are planning to invest in SIP</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Risk undertaken</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="" name="" placeholder="" value="Low" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="" name="" placeholder="" value="Moderate" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="" name="" placeholder="" value="High" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Rate of return</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="" name="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-5" for="">Purpose of investment</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="" name="" placeholder="" value="Tax saving" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="" name="" placeholder="" value="Wealth creation" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="" name="" placeholder="" value="Goal based planning" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn btn-success pull-right" data-toggle="collapse" data-parent="#sipAcc" href="#sipcollapse3">Recommended SIP schemes</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#sipAcc" href="#sipcollapse3">Recommended SIP schemes</a>
        </h4>
                            </div>
                            <div id="sipcollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <legend>Investment allocation</legend>
                                                <img src="https://images.freeimages.com/images/premium/large-thumbs/1975/19756028-blank-pie-chart-isolated-on-white-background.jpg" class="img-responsive" alt="Pi chart">
                                            </div>
                                            <div class="col-md-9">
                                                <p>Hand picked SIP Schemees</p>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>SL No.</th>
                                                            <th>Scheme</th>
                                                            <th>Category</th>
                                                            <th>Amount(INR)</th>
                                                            <th>Alocation</th>
                                                            <th>Return</th>
                                                            <th>Compare</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>ICICI prudential long term fund - Regular plan (G)</td>
                                                            <td>Debt long term</td>
                                                            <td>3000</td>
                                                            <td>33.33%</td>
                                                            <td>15.93%</td>
                                                            <td>
                                                                <select name="" id="" class="form-control">
                                                                    <option value="">Select 1</option>
                                                                    <option value="">Select 2</option>
                                                                    <option value="">Select 3</option>
                                                                </select>
                                                            </td>
                                                            <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>ICICI prudential balance fund(G)</td>
                                                            <td>Balanced</td>
                                                            <td>3000</td>
                                                            <td>33.33%</td>
                                                            <td>28.31%</td>
                                                            <td>
                                                                <select name="" id="" class="form-control">
                                                                    <option value="">Select 1</option>
                                                                    <option value="">Select 2</option>
                                                                    <option value="">Select 3</option>
                                                                </select>
                                                            </td>
                                                            <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Aditya Birla Sun Life frontline equity fund (G)</td>
                                                            <td>Debt long term</td>
                                                            <td>3000</td>
                                                            <td>33.33%</td>
                                                            <td>25.62%</td>
                                                            <td>
                                                                <select name="" id="" class="form-control">
                                                                    <option value="">Select 1</option>
                                                                    <option value="">Select 2</option>
                                                                    <option value="">Select 3</option>
                                                                </select>
                                                            </td>
                                                            <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">Total</td>
                                                            <td colspan="5">9000</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="form-group">
                                                    <div class="col-sm-9 col-md-offset-2">
                                                        <div class="alert alert-info">
                                                            If you have invested Rs. *** per month in this portfolio per month in this portfolio for last *** Years, it could be worth of Rs. *** with return of ** % .
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3" for="">
                                                        <a class="btn icon-btn btn-success" href="#"><span class="glyphicon btn-glyphicon glyphicon-eye-open"></span> Select your own</a>
                                                    </label>
                                                    <label class="control-label col-sm-3 col-sm-offset-5" for="">
                                                        <a class="btn icon-btn btn-success" href="#"><span class="glyphicon btn-glyphicon glyphicon-save"></span> Start investments</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box well wealthHide lumpSum" id="lumpSumShow">
                    <div class="panel-group" id="lumpSumAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#lumpSumAcc" href="#lumpSumcollapse1">Lumpsum</a>
        </h4>
                            </div>
                            <div id="lumpSumcollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Recommended</div>
                                                <div class="panel-body">
                                                    <ul>
                                                        <li><a href="#">Select After Analysing</a></li>
                                                        <li><a href="">Top best schemes</a></li>
                                                    </ul>
                                                </div>
                                                <div class="panel-footer">
                                                    <button class="btn btn-default">Invest</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Select on your own</div>
                                                <div class="panel-body">Search for 5000 schemes
                                                    <br> and
                                                    <br> do anlysis</div>
                                                <div class="panel-footer">
                                                    <button class="btn btn-default">Explore</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <a onclick="window.location='calculators.html#lumpCal'" class="btn btn-default col-md-offset-4" data-toggle="modal" data-target="#lumpsumCal">Lumpsum calculator</a>
                                    <a class="btn btn-success pull-right" data-toggle="collapse" data-parent="#lumpSumAcc" href="#lumpSumcollapse3">Process</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#lumpSumAcc" href="#lumpSumcollapse3">Recommended schemes</a>
        </h4>
                            </div>
                            <div id="lumpSumcollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <legend>Recommended schemes</legend>
                                        <div class="col-md-3">
                                            <h3>Assot Allocation</h3>
                                            <img src="https://images.freeimages.com/images/premium/large-thumbs/1975/19756028-blank-pie-chart-isolated-on-white-background.jpg" class="img-responsive" alt="Pi chart">
                                        </div>
                                        <div class="col-md-9">
                                            <p>Hand picked Schemees</p>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SL No.</th>
                                                        <th>Scheme</th>
                                                        <th>Category</th>
                                                        <th>Amount(INR)</th>
                                                        <th>Alocation</th>
                                                        <th>Return</th>
                                                        <th>Compare</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>ICICI prudential long term fund - Regular plan (G)</td>
                                                        <td>Debt long term</td>
                                                        <td>3000</td>
                                                        <td>33.33%</td>
                                                        <td>15.93%</td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">Select 1</option>
                                                                <option value="">Select 2</option>
                                                                <option value="">Select 3</option>
                                                            </select>
                                                        </td>
                                                        <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>ICICI prudential balance fund(G)</td>
                                                        <td>Balanced</td>
                                                        <td>3000</td>
                                                        <td>33.33%</td>
                                                        <td>28.31%</td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">Select 1</option>
                                                                <option value="">Select 2</option>
                                                                <option value="">Select 3</option>
                                                            </select>
                                                        </td>
                                                        <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Aditya Birla Sun Life frontline equity fund (G)</td>
                                                        <td>Debt long term</td>
                                                        <td>3000</td>
                                                        <td>33.33%</td>
                                                        <td>25.62%</td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">Select 1</option>
                                                                <option value="">Select 2</option>
                                                                <option value="">Select 3</option>
                                                            </select>
                                                        </td>
                                                        <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Total</td>
                                                        <td colspan="5">9000</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="form-group">
                                                <div class="col-sm-9 col-md-offset-2">
                                                    <div class="alert alert-info">
                                                        If you have invested Rs. *** per month in this portfolio for last *** Years, it could be worth of Rs. *** with return of ** % .
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-6" for="">
                                                    <a class="btn icon-btn btn-success" href="#"><span class="glyphicon btn-glyphicon glyphicon-eye-open"></span>Select your own</a>
                                                </label>
                                                <label class="control-label col-sm-6" for="">
                                                    <a class="btn icon-btn btn-success" href="#"><span class="glyphicon btn-glyphicon glyphicon-save"></span>Invest now</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-box well wealthHide saveTax" id ="saveTaxShow">
                    <div class="panel-group" id="taxSavingAcc">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#taxSavingAcc" href="#taxSavingcollapse1">Tax Saving</a>
        </h4>
                            </div>
                            <div id="taxSavingcollapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <label class="control-label col-md-8" for="">Do you know much to invest for saving taxes this year ?</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3" for="">
                                                <button class="btn btn-primary">Yes, I know</button>
                                            </label>
                                            <label class="control-label col-sm-3 col-sm-offset-5" for="">
                                                <a onclick="window.location='calculators.html#taxsavingCal'" class="btn btn-primary" data-toggle="modal" data-target="#taxCal">No, help me</a>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <label class="control-label col-sm-4" for="">
                                                    <button class="btn btn-primary">Lump sum</button>
                                                </label>
                                                <label class="control-label col-sm-4" for="">
                                                    <button class="btn btn-primary">SIP</button>
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                    <a class="btn btn-success pull-right" data-toggle="collapse" data-parent="#taxSavingAcc" href="#taxSavingcollapse3">Process</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#taxSavingAcc" href="#taxSavingcollapse3">Recommended schemes</a>
        </h4>
                            </div>
                            <div id="taxSavingcollapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="/action_page.php">
                                        <div class="form-group">
                                            <legend>Hand picked SIP Schemees</legend>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SL No.</th>
                                                        <th>Scheme</th>
                                                        <th>Category</th>
                                                        <th>Amount(INR)</th>
                                                        <th>Alocation</th>
                                                        <th>Return</th>
                                                        <th>Compare</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>ICICI prudential long term fund - Regular plan (G)</td>
                                                        <td>Debt long term</td>
                                                        <td>3000</td>
                                                        <td>33.33%</td>
                                                        <td>15.93%</td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">Select 1</option>
                                                                <option value="">Select 2</option>
                                                                <option value="">Select 3</option>
                                                            </select>
                                                        </td>
                                                        <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>ICICI prudential balance fund(G)</td>
                                                        <td>Balanced</td>
                                                        <td>3000</td>
                                                        <td>33.33%</td>
                                                        <td>28.31%</td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">Select 1</option>
                                                                <option value="">Select 2</option>
                                                                <option value="">Select 3</option>
                                                            </select>
                                                        </td>
                                                        <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Aditya Birla Sun Life frontline equity fund (G)</td>
                                                        <td>Debt long term</td>
                                                        <td>3000</td>
                                                        <td>33.33%</td>
                                                        <td>25.62%</td>
                                                        <td>
                                                            <select name="" id="" class="form-control">
                                                                <option value="">Select 1</option>
                                                                <option value="">Select 2</option>
                                                                <option value="">Select 3</option>
                                                            </select>
                                                        </td>
                                                        <td><span class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Total</td>
                                                        <td colspan="5">9000</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Investment screen end -->

</div>
            <div class="row" style="height:30px"></div>
            <div class="col-md-2">
                <div class="sidebarR">
                    <div class="list-group">
                            <a class="list-group-item" id="sipstp">SIP / STP</a>
                            <a class="list-group-item" id="lumpsum">LumpSumn</a>
                            <a class="list-group-item" id="savetax">Tax Save</a>
                    </div>
                </div>
            </div>
                           
                        
                
                    </div>
                </div>
            </div>
            <div class="row" style="height:50px"></div>
    </div>
</section>

<div class="modal fade" id="devTaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h4 class="modal-title">Order Confirmation</h4>
            </div>
            <div class="modal-body">
				
            </div>
			<div class="modal-footer">
				<button type="button" class="btn icon-btn btn-success" data-dismiss="modal">Proceed to Pay</button>
			</div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){
   
    $("#retireRich").click(function(){ hideall(); showone("retireRichShow");  });  
    $("#grandWedding").click(function(){ hideall(); showone("grandWeddingShow");  });
    $("#higherEdu").click(function(){ hideall(); showone("higherEduShow");  });
    $("#ownHouse").click(function(){ hideall(); showone("ownHouseShow");  });
    $("#buyCar").click(function(){ hideall(); showone("buyCarShow");  });
    $("#vacPlan").click(function(){ hideall(); showone("vacPlanShow");  });
    $("#emerFund").click(function(){ hideall(); showone("emerFundShow");  });
    $("#uniGoal").click(function(){ hideall(); showone("uniGoalShow");  });
    $("#lumpsum").click(function(){ hideall(); showone("lumpSumShow");  });
    $("#savetax").click(function(){ hideall(); showone("saveTaxShow");  });
    $("#sipstp").click(function(){ hideall(); showone("sipSTPShow");  });


    openonegoal(window.location.href);

    
}); 

function openonegoal(urlstring) {
    //alert(urlstring);
    if(urlstring.indexOf("#")>=0) {
        //var val = window.location.href;
        urlstring=urlstring.substring(urlstring.indexOf("#")+1);        
//         alert(urlstring);
        //var x = document.getElementById(urlstring);
        //x.style.display = "block";
        hideall();
        switch(urlstring) {
            case "retireRichShow" :
            	showone("retireRichShow");
                break;
            case "grandWeddingShow" :
            	showone("grandWeddingShow");
                break;
            case "higherEduShow" :
            	showone("higherEduShow");
                break;
            case "ownHouseShow" :
            	showone("ownHouseShow");
                break;
            case "buyCarShow" :
            	showone("buyCarShow");
                break;
            case "vacPlanShow" :
            	showone("vacPlanShow");
                break;
            case "emerFundShow" :
            	showone("emerFundShow");
                break;
            case "uniGoalShow" :
            	showone("uniGoalShow");
                break;
            case "lumpSumShow" :
            	showone("lumpSumShow");
                break;
            case "saveTaxShow" :
            	showone("saveTaxShow");
                break;
            case "sipSTPShow" :
            	showone("sipSTPShow");
                break;
                
                default:
                	showone("retireRichShow");
            	break;
        }
    }
}

function showone(nameval) {
    var x = document.getElementById(nameval);
    x.style.display = "block";
    window.scrollTo(0, 400);
} 
    
function hideall() {
    var x = document.getElementById("retireRichShow");
    x.style.display = "none";
    x = document.getElementById("grandWeddingShow");
    x.style.display = "none";
    x = document.getElementById("higherEduShow");
    x.style.display = "none";
    x = document.getElementById("ownHouseShow");
    x.style.display = "none";
    x = document.getElementById("buyCarShow");
    x.style.display = "none";
    x = document.getElementById("vacPlanShow");
    x.style.display = "none";
    x = document.getElementById("emerFundShow");
    x.style.display = "none";
    x = document.getElementById("uniGoalShow");
    x.style.display = "none";
     x = document.getElementById("lumpSumShow");
     x.style.display = "none";
    x = document.getElementById("sipSTPShow");
    x.style.display = "none";
    x = document.getElementById("saveTaxShow");
    x.style.display = "none";
    
}
</script>
<script src="<?php echo $CONFIG->siteurl;?>__UI.assets/js/MyWealth.js"></script>
	<script type="text/javascript"
		src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
			google.charts.load('current', { 'packages': ['corechart'] });
			google.charts.setOnLoadCallback(drawChart);
			
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
		</script>
