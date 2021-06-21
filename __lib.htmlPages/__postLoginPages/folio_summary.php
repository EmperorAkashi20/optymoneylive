
<?php
    //echo "<pre>";print_r($_SESSION);
    //$bankInfo = $customerProfile->getCustomerBankInfo();
    //print_r($bankInfo);
?>
<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<!-- <div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="?module_interface=<?php //echo $commonFunction->setPage('home');?>">Home</a>
							</li>
							<li class="active">Mutual Fund</li><li class="active">Portfolio Summary</li>
						</ul>

						<?php //include 'form.search.php';?>
                    </div> -->
                    <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Mutual Fund</li><li class="active">Portfolio Summary</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
                </nav>
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">	
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
                                                            <span class="lbl"> Non Zero Folios</span>
                                                        </label>
                                                    </div>                                        
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" class="ace" name="form-field-radio">
                                                            <span class="lbl"> All Folios</span>
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
                                <div class="row">
                                    <div class="col-xs-12">                            
                                        <div class="space-8"></div>
                                        <div class="row">
                                            <div class="col-xs-12">		
                                                <div class="clearfix">
                                                    <div class="pull-right tableTools-container">
                                                        <div class="dt-buttons btn-overlap btn-group">
                                                            <a id="btnExport" class="buttons-colvis btn btn-white btn-primary btn-bold" title="Export To Pdf">
                                                                <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                                            </a>
                                                            <a class="download buttons-colvis btn btn-white btn-primary btn-bold " title="Export To Excel">
                                                                <span><i class="fa fa-file-excel-o bigger-110 green"></i></span>
                                                            </a>                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">                                	
                                                    <div id="ac_stmt">
                                                        <div id="fetchProgressbarInner_ac" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87">
                                                            <div id="fetchProgressbarInner_ac" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 50%;"><strong>Fetching all the data from .....</strong>
                                                            </div>
                                                        </div>
                                                    </div>                                          
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div><!-- /.page-content -->
				    </div>
                </div>
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="jquery.table2excel.js"></script>
<script>
$(function() {  
   $(".download").click(function() {  
    $(".tb2excel").table2excel({
                        exclude: ".noExl",
                        name: "Portfolio Summary",
                    filename: "PortfolioSummary",
                    fileext: ".xlsx",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true
                });
   });

});
</script>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
      $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("PortfolioSummary.pdf");
                }
            });
        });
    </script>


