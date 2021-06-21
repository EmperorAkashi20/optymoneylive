<?php
    //echo "<pre>";print_r($_SESSION);
    //$bankInfo = $customerProfile->getCustomerBankInfo();
    //print_r($bankInfo);
    $mutualFund->updateLiveMFTable(); 
?>
<div class="main-content">
                <div class="main-content-inner">
                    <!-- #section:basics/content.breadcrumbs -->
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="<?php echo $CONFIG->siteurl;?>mySaveTax/">Home</a>
                            </li>
                            <li class="active">Mutual Fund</li><li class="active">A/C Statement</li>
                        </ul><!-- /.breadcrumb -->

                        <?php include("form.search.php");?>

                        <!-- /section:basics/content.searchbox -->
                    </div>
                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">                      
                        <div class="row">
                            <div class="col-xs-12">                            
                                <div class="row">
                                    <div class="widget-box">
                                        <div class="widget-header">
                                            <h4 class="widget-title">Search</h4>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <form class="form-inline">
                                               <label class="inline" style="padding:4px;">
                                                Applicant
                                                 <select id="" name="" class="form-control">
                                                            <option selected>All</option>
                                                          </select>
                                                    <select id="" name="" class="form-control">
                                                            <option value="">All Objective</option>
                                                            <option value="">All Debt</option>
                                                            <option value="">All Equity</option>
                                                            <option value="">Debt: Credit Opportunities</option>
                                                            <option value="">Debt: FMP</option>
                                                            <option value="">Debt: Income</option>
                                                            <option value="">Debt: Liquid</option>
                                                            <option value="">Debt: Short Term</option>
                                                            <option value="">Debt: Ultra Short Term</option>
                                                            <option value="">Equity: Infrastructure</option>
                                                            <option value="">Equity: Large Cap</option>
                                                            <option value="">Equity: Mid Cap</option>
                                                            <option value="">Equity: Multi Cap</option>
                                                            <option value="">Equity: Pharma</option>
                                                            <option value="">Equity: Sectoral</option>
                                                            <option value="">Equity: Small Cap</option>
                                                            <option value="">Equity: Tax Planning</option>
                                                            <option value="">Gold: Gold Funds</option>
                                                          </select>
                                                     &nbsp;<select id="" name="" class="form-control">
                                                            <option value="">--All Companies--</option>
                                                            <option value="">Aditya Birla Sun Life Mutual Fund<</option>
                                                            <option value="">BOI  AXA Mutual Fund</option>
                                                            <option value="">DHFL Pramerica Mutual Fund</option>
                                                            <option value="">DSP BlackRock Mutual Fund</option>
                                                            <option value="">Edelweiss Mutual Fund</option>
                                                            <option value="">Franklin Templeton Mutual Fund</option>
                                                            <option value="">HDFC Mutual Fund</option>
                                                            <option value="">HSBC Mutual Fund</option>
                                                            <option value="">ICICI Prudential Mutual Fund</option>
                                                            <option value="">IDFC Mutual Fund</option>
                                                            <option value="">Invesco Mutual Fund</option>
                                                            <option value="">Kotak Mutual Fund</option>
                                                            <option value="">L&amp;T Mutual Fund</option>
                                                            <option value="">LIC Mutual Fund</option>
                                                            <option value="">Reliance Mutual Fund</option>
                                                            <option value="">SBI Mutual Fund</option>
                                                            <option value="">Tata Mutual Fund</option>
                                                          </select>                                                  
                                                          <div class="col-xs-8 col-sm-4">
                                                                <div class="input-daterange input-group">
                                                                    <input type="text" name="start" class="input-sm form-control" placeholder="Start Trade Date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-exchange"></i>
                                                                    </span>
                                                                    <input type="text" name="end" class="input-sm form-control" placeholder="End Trade Date">
                                                                </div>
                                                            </div>
                                                     </label>                                                   
                                                    <button class="btn btn-info btn-sm" type="button">
                                                        <i class="ace-icon fa fa-search bigger-110"></i><strong>Search</strong>
                                                    </button>
                                                </form>
                                            </div>                                                                                      
                                        </div>
                                    </div>
                                </div>
                                <div class="space-8"></div>
                                <div class="row">
                                    <div class="col-xs-12">     
                                        <div class="clearfix">
                                            <div class="pull-right tableTools-container">
                                                <div class="dt-buttons btn-overlap btn-group">
                                                    <a id="btnExport" class="buttons-colvis btn btn-white btn-primary btn-bold" title="Export To Pdf">
                                                        <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                                    </a>
                                                    <a class="download buttons-colvis btn btn-white btn-primary btn-bold" title="Export To Excel">
                                                        <span><i class="fa fa-file-excel-o bigger-110 green"></i></span>
                                                    </a>                                                    
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">                                   
                                            <div id="ac_stmt">
                                                <div id="fetchProgressbarInner_ac" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87"><div id="fetchProgressbarInner_ac" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 50%;"><strong>Fetching all the data from .....</strong></div></div>
                                                </div>                                          
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div>
           
           