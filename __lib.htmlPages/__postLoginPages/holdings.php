<?php
	//echo "<pre>";print_r($_SESSION);
	//$bankInfo = $customerProfile->getCustomerBankInfo();
	//print_r($bankInfo);
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
							<li class="active">Mutual Fund</li><li class="active">Holdings</li>
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
                                                            <option value="">All MF</option>
                                                            <option value="">Debt: MF</option>
                                                            <option value="">Equity: MF</option>
                                                            <option value="">Debt: FD</option>
                                                          </select>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" class="ace" name="form-field-radio">
                                                            <span class="lbl"> Active Folios</span>
                                                        </label>
													</div>                                        
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" class="ace" name="form-field-radio">
                                                            <span class="lbl"> Inactive Folios</span>
                                                        </label>
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
    												<a class="buttons-colvis btn btn-white btn-primary btn-bold" title="Add Admin Users">
                                                    	<span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                                    </a>
                                                    <a class="buttons-colvis btn btn-white btn-primary btn-bold" title="Export To Excel">
                                                    	<span><i class="fa fa-file-excel-o bigger-110 green"></i></span>
                                                    </a>                                                    
												</div>
											 </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                	 <table class="table table-bordered table-striped">
                                            <thead class="thin-border-bottom">
                                                <tr>
                                                    <th>Schemes / Companies</th>
                                                    <th>Folio</th>
                                                    <th>Units / Nos</th>
                                                    <th>NAV / Price</th>
                                                    <th>Current Value(Rs.)</th>
                                                    <th>ExitLoad</th>
                                                </tr>
                                            </thead>
                                           <tbody>
                                            <tr>
                                                <td>Form 16</td>
                                                <td><?php echo $formDataFromDB[0]['total_tds_deposited'];?></td>
                                                <td><?php echo strtoupper($formDataFromDB[0]['employee_pan']);?></td>
                                                <td><?php echo $formDataFromDB[0]['assessment_year'];?></td>
                                                <td><i class="ace-icon fa fa-times red"></i></td>
                                                <td><i class="ace-icon fa fa-times red"></i></td>
                                            </tr>                                    	
                                    </tbody>
                                  </table>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div>