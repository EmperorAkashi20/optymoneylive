<style>
    .table td{
    vertical-align: middle;
    font-size: 0.875rem;
    line-height: 1;
    white-space: normal;
    height: 35px;
    padding: 5px 5px;
}
.table th{

    white-space: normal;
    
}
</style>
<div class="main-content">
    <div class="main-content-inner">
        <!-- #section:basics/content.breadcrumbs -->
        <!-- <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="?module_interface=<?php //echo $commonFunction->setPage('home');?>">Home</a>
                </li>
                <li class="active">Mutual Fund</li><li class="active">Folio Query</li>
            </ul>
            <?php //include 'form.search.php';?>           
        </div> -->
        <nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
							</li>
							<li class="active">Mutual Fund</li><li class="active">Folio Query</li>
						</ol><!-- /.breadcrumb -->
						<?php //include("mdocs.lib.htmlPages/form.search.php");?>

						<!-- /section:basics/content.searchbox -->
                    </nav>
        <div class="page-content">	
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Search</h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <form class="form-inline" method="get" action="">
                                            <label class="inline" style="padding:4px;">                                                
                                                <input type="text" class="ace" placeholder="Search......" id="search_str" name="search_str" value="<?php echo $_REQUEST[search_str]; ?>" required />
                                                <input type="hidden" id="module_interface" name="module_interface" value="<?php echo $commonFunction->setPage('folio_query'); ?>" />
                                            </label>                                                   
                                            <button class="btn btn-info btn-sm" type="submit">
                                                <i class="ace-icon fa fa-search bigger-110"></i><strong>Search</strong>
                                            </button>
                                    </form>
                                </div>                                                										
                            </div>
                        </div>
            <div class="row">
                <div class="col-md-12">		
                    
                    <div class="space-8"></div> 			
                    <div class="row">
                        <div class="col-xs-12">		
                            <div class="clearfix">
                                <div class="pull-right tableTools-container">
                                    <div class="dt-buttons btn-overlap btn-group">
                                        <a href="../exportresult/folio_query&export_type=pdf&<?php echo $_SERVER['QUERY_STRING']; ?>" class="buttons-colvis btn btn-white btn-primary btn-bold" title="Export To Pdf">
                                            <span><i class="fa fa-file-pdf-o bigger-110 red"></i></span>
                                        </a>
                                        <a href="../exportresult/folio_query&export_type=pdf&<?php echo $_SERVER['QUERY_STRING']; ?>" class="buttons-colvis btn btn-white btn-primary btn-bold" title="Export To Excel">
                                            <span><i class="fa fa-file-excel-o bigger-110 green"></i></span>
                                        </a>                                                    
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row"> -->
                        <table class="table table-bordered table-striped table-hover dataTable">
                            <thead class="thin-border-bottom">                                                 
                                <tr>
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'scheme_name'); ?> >Scheme</th>																
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'folio_no'); ?>>Folio</th>
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'client_name'); ?>>Name</th>	
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'original_investor'); ?>>Original Investor</th>																
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'pan_no'); ?>>PAN</th>																
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'mode'); ?>>Mode</th>																
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'address1'); ?>>Address</th>																
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'jnt1_Name'); ?>>Jnt1 Name</th>
                                    <th <?php echo $commonFunction->orderByToggle($_REQUEST, 'jnt1_pan'); ?>>Jnt1 PAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    if ($_REQUEST[whichPage] == '') {
                                        $page = 1;
                                    } else {
                                        $page = $_REQUEST[whichPage];
                                    }

                                    $currentPage = $page;
                                    $totalItems = $mutualFund->folioQueryCount($_REQUEST);
                                    $itemsPerPage = $CONFIG->paginationPageItem;
                                    $getMFList = $mutualFund->folioQuery($_REQUEST, ($currentPage * $itemsPerPage) - $itemsPerPage);

                                    if (in_array('MF_NONE', $getMFList)) {
                                        echo $fileHTML = '<tr><td class="center red" colspan="9"> No Row(s) Found.</td></tr>';
                                    } else {
                                        $urlPattern = '?whichPage=(:num)&search_str='.$_REQUEST['search_str'].'&module_interface='.$_REQUEST['module_interface'];
                                        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

                                        while (list($logKey, $logVal) = each($getMFList)) {
                                            ?>
                                <tr class="show-details-btn" title="Click To Expand">
                                    <td class="blue" style="width:100px; word-wrap:break-word;"><b class="blue"><?php echo str_replace('"', '', $logVal[scheme_name]); ?></b></td>
                                    <td>
                                        <?php echo str_replace('"', '', $logVal[folio_no]); ?>
                                    </td>
                                    <td>
                                        <b class="green"><?php echo str_replace('"', '', $logVal[client_name]); ?></b>
                                    </td>
                                    <td><?php echo str_replace('"', '', $logVal[original_investor]); ?></td>
                                    <td><?php echo str_replace('"', '', $logVal[pan_no]); ?></td>
                                    <td><?php echo str_replace('"', '', $logVal[mode]); ?></td>
                                    <td><?php echo str_replace('"', '', $logVal[address1]); ?></td>
                                    <td><?php echo str_replace('"', '', $logVal[jnt1_Name]); ?></td>
                                    <td><?php echo str_replace('"', '', $logVal[jnt1_pan]); ?></td> 
                                </tr>
                                <tr class="detail-row">
                                    <td colspan="9">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="space visible-xs"></div>    
                                            <div class="profile-user-info profile-user-info-striped">
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Address2 </div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[Address2]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name"> Address3 </div>
                                                    <div class="profile-info-value">                                
                                                        <span><?php echo str_replace('"', '', $logVal[Address3]); ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Joint2 Name </div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[jnt2_name]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name"> Joint2 PAN </div>
                                                    <div class="profile-info-value">                                
                                                        <span><?php echo str_replace('"', '', $logVal[jnt2_pan]); ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Nominee1 </div>
                                                    <div class="profile-info-value">                               
                                                        <span><?php echo str_replace('"', '', $logVal[nominee1]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name"> Nominee2 </div>
                                                    <div class="profile-info-value">                                
                                                        <span><?php echo str_replace('"', '', $logVal[nominee2]); ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Nominee3 </div>    
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[nominee3]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name"> A/c No. </div>    
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[ac_no]); ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> A/c Type </div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[ac_type]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name">Bank Name</div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[bank_name]); ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Bank Branch</div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[bank_branch]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name"> UCC</div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[ucc]); ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name">IIN</div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[iin]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name">BSECode</div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[bsecode]); ?></span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name">NSECode</div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[nsecode]); ?></span>
                                                    </div>
                                                    <div class="profile-info-name">FTFolio</div>
                                                    <div class="profile-info-value">
                                                        <span><?php echo str_replace('"', '', $logVal[ftfolio]); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                        }
                                        echo '<tr><td class="center red" colspan="9">'.$paginator.'</td></tr>';
                                    }
                                ?>

                            </tbody>
                        </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>    
</div><!-- /.page-content -->
      
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
                 pdfMake.createPdf(docDefinition).download("FolioQuery.pdf");
             }
         });
     });
</script>
<!--  
<script src='https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js'></script> -->
  <script src="tableToExcel.js"></script>
  <script type="text/javascript">

let button = document.querySelector("#button-excel");

button.addEventListener("click", e => {
  let table = document.querySelector(".simpleTable1");
  TableToExcel.convert(table);
});
  </script>
