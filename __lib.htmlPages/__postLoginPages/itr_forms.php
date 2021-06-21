<?php

    //print_r($_SESSION);
    //if (isset($_REQUEST['new']) && $_REQUEST['new'] != '' && $_SESSION['newitr'] == 1) {
      if (isset($_REQUEST['new']) && $_REQUEST['new'] != '') {
          $itrFill->startSession($_REQUEST);
          $_SESSION['itr_amount'] = $_POST['amount'];
          $commonFunction->jsRedirect($CONFIG->siteurl.'mySaveTax/?module_interface='.$commonFunction->setPage('itr_forms'));
          exit;
      }

    if (isset($_REQUEST['ay']) && $_REQUEST['ay'] != '') {
        $itrFill->checkPending($_REQUEST);
        $commonFunction->jsRedirect($CONFIG->siteurl.'mySaveTax/?module_interface='.$commonFunction->setPage('itr_forms'));
        exit;
    }
    if (isset($_REQUEST['formsDataID']) && $_REQUEST['formsDataID'] != '') {
        //$documentFiles->trfrFrm16DataToMainDB($_REQUEST[formsDataID]);  //$_SESSION[$CONFIG->sessionPrefix.'_ITR_ID']);
        //$commonFunction->jsRedirect($CONFIG->siteurl."mySaveTax/?module_interface=".$commonFunction->setPage('itr_forms'));
        //exit;
    }
  /*-------------------------------------------------------------------
    if($_REQUEST['itrStatus'] && $_REQUEST['itrStatus'] !='')
    {
      $itr_status = $_REQUEST['itrStatus'];

      print_r($_REQUEST);
      die();
    }
 /*-------------------------------------------------------------------------*/
    if (isset($_FILES['form26asFile']) && $_FILES['form26asFile']['size'] > 0 && $_FILES['form26asFile']['type'] == 'application/pdf') {
        $filename = $commonFunction->upload('form26asFile');
        $documentFiles->addForm26AS($filename[0], $_REQUEST[formsDataID], $_REQUEST[file_pass]);
        $commonFunction->jsRedirect($CONFIG->siteurl.'mySaveTax/?formsDataID='.$_REQUEST[formsDataID].'&v=26&module_interface='.$commonFunction->setPage('itr_forms'));
    //print_r($filename);
    } else {
        $_SESSION['msg'] = 'Invalid File Type.....';
    }


    if(isset($_SESSION['getformsDataID']))
    {
      //$_SESSION['getformsDataID'] = 9;
    $form16data = $itrFill->fetchformdata($_SESSION['form16_id']);
    unset($_SESSION['getformsDataID']);
    unset($_SESSION['form16_id']);
    }


    $itr_profile = $itrFill->getEfillingDetails('itr_profile');
    $itr_pd_residential_st = $itrFill->getEfillingDetails('itr_pd_residential_st');
    $itr_business_profession = $itrFill->getEfillingDetails('itr_business_profession');
    $itr_presumptive = $itrFill->getEfillingDetails('itr_presumptive');
    $itr_sou_other = $itrFill->getEfillingDetails('itr_sou_other');
    $itr_deduction = $itrFill->getEfillingDetails('itr_deduction');
    $itr_taxreconci_tds = $itrFill->getEfillingDetails('itr_taxreconci_tds');
    $itr_capitalgain = $itrFill->getEfillingDetails('itr_capitalgain');

    $itr_sou_salary = $itrFill->getEfillingDetailsMultiple('itr_sou_salary');
    $itr_hp_selfocc = $itrFill->getEfillingDetailsMultiple('itr_hp_selfocc');
    $itr_hp_letout = $itrFill->getEfillingDetailsMultiple('itr_hp_letout');
    $itr_cg_saleoland_prop = $itrFill->getEfillingDetailsMultiple('itr_cg_saleoland_prop');

    $itr_hp_coowner_selfocc = $itrFill->selfCoMultipleRow('itr_hp_coowner_selfocc', 'fr_itr_selfocc_id');
    $itr_hp_coowner_letout = $itrFill->selfCoMultipleRow('itr_hp_coowner_letout', 'fr_itr_letout_id');
    $itr_cg_purchse_impro = $itrFill->selfCoMultipleRow('itr_cg_purchse_impro', 'fr_sousalnd_id');

    $itr_cg_saleomutualfunds = $itrFill->getEfillingDetailsMultiple('itr_cg_saleomutualfunds');
    $itr_cg_saleoshareordeben = $itrFill->getEfillingDetailsMultiple('itr_cg_saleoshareordeben');
    $itr_cg_saleotherassets = $itrFill->getEfillingDetailsMultiple('itr_cg_saleotherassets');
    $itr_business_profe_addmor = $itrFill->getEfillingDetailsMultiple('itr_business_profe_addmor');
    $itr_presumptive_tax44ae = $itrFill->getEfillingDetailsMultiple('itr_presumptive_tax44ae');
    $itr_sou_partnership = $itrFill->getEfillingDetailsMultiple('itr_sou_partnership');
    $itr_foa_forginassets = $itrFill->getEfillingDetailsMultiple('itr_foa_forginassets');
    $itr_foa_financialinterest = $itrFill->getEfillingDetailsMultiple('itr_foa_financialinterest');
    $itr_foa_immovableproperty = $itrFill->getEfillingDetailsMultiple('itr_foa_immovableproperty');
    $itr_foa_othcaptialassets = $itrFill->getEfillingDetailsMultiple('itr_foa_othcaptialassets');
    $itr_foa_signingauthority = $itrFill->getEfillingDetailsMultiple('itr_foa_signingauthority');
    $itr_foa_detailsoftrust = $itrFill->getEfillingDetailsMultiple('itr_foa_detailsoftrust');
    $itr_foa_othincomederived = $itrFill->getEfillingDetailsMultiple('itr_foa_othincomederived');
    $itr_sou_foreignincome = $itrFill->getEfillingDetailsMultiple('itr_sou_foreignincome');
    $itr_donation = $itrFill->getEfillingDetailsMultiple('itr_donation');
    /*---------------------------------------- get value Donation80GGA-START-BSEN ---------------------------------------------*/

    $itr_donation80gga = $itrFill->getEfillingDetailsMultiple('itr_donation80gga');
    $itr_taxreconci_tcs = $itrFill->getEfillingDetailsMultiple('itr_taxreconci_tcs');

    /*---------------------------------------- get value Donation80GGA-END-BSEN ---------------------------------------------*/
    $itr_taxreconci_tdsothsal = $itrFill->getEfillingDetailsMultiple('itr_taxreconci_tdsothsal');
    $itr_taxreconci_tdsrent = $itrFill->getEfillingDetailsMultiple('itr_taxreconci_tdsrent');
    
    $itr_taxreconci_tdsimoprop = $itrFill->getEfillingDetailsMultiple('itr_taxreconci_tdsimoprop');
    $itr_taxreconci_taxpaid_advan = $itrFill->getEfillingDetailsMultiple('itr_taxreconci_taxpaid_advan');
    $itr_taxreconci_selfasstaxpaid = $itrFill->getEfillingDetailsMultiple('itr_taxreconci_selfasstaxpaid');
    $itr_taxreconciliation = $itrFill->getEfillingDetailsMultiple('itr_taxreconciliation');
    $itr_taxfilling_land = $itrFill->getEfillingDetailsMultiple('itr_taxfilling_land');
    $itr_taxfilling = $itrFill->getEfillingDetailsMultiple('itr_taxfilling');

    $itr_state = $itrFill->getState();
    $itr_country = $itrFill->getCountry();

    $itr_id = $_SESSION[$CONFIG->sessionPrefix.'_ITR_ID'];
    $itr_pay = $itrFill->getEfillingDetails('bfsi_users_settings');
    $itr_id = $_SESSION[$CONFIG->sessionPrefix.'_ITR_ID'];

    $itr_pay_amount = $itrFill->calculatePaySelection('itr_sou_salary', $itr_id)[0];
    $itr_pay_selection = $itrFill->calculatePaySelection('itr_sou_salary', $itr_id)[1];
    $total_section = $itrFill->calculatePaySelection('itr_sou_salary', $itr_id)[2];
    //echo $itr_pay_amount;
?>

<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">
    <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li>
                                    <i class="ace-icon fa fa-home home-icon"></i>
                                    <a href="<?php echo $CONFIG->siteurl; ?>mySaveTax/">Home</a>
                                </li>
                                <li class="active">Assessment Year</li><li class="active">e-Filing Details</li>
                            </ol><!-- /.breadcrumb -->
                            <?php //include("mdocs.lib.htmlPages/form.search.php");?>

                            <!-- /section:basics/content.searchbox -->
                        </nav>            
      <div class="row">
        <div class="col-xs-12">
          <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
              <h4 class="widget-title orange"></h4>
            </div>
          </div>
          <!-- /.widget-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="space-8"></div>
      <div class="row">
        <div class="col-md-12">
          <div class="with-nav-tabs panel-default">
            <!-- <ul class="nav nav-pills"> -->
            <ul class="nav  nav-tabs tab-solid tab-solid-success" role="tablist">
              <li class="<?php if ($_REQUEST['activeTab'] == '') {
    echo 'active';
} ?>"><a href="#tabUserProf" data-toggle="tab" class="btn btn-default">ITR User Profile</a></li>
              <li class="<?php // ($_REQUEST['activeTab'] == 'tabIncSource') {
   //echo 'active';
//}?>"><a href="#tabIncSource" data-toggle="tab" class="btn btn-success">Income Sources</a></li>
              <li><a href="#tabDeduction" data-toggle="tab" class="btn btn-info">Deduction</a></li>
              <li class="<?php if ($_REQUEST['activeTab'] == 'tabTaxReconsilation') {
    echo 'active';
} ?>"><a href="#tabTaxRecon" data-toggle="tab" class="btn btn-warning">Tax Reconciliation</a></li>
              <li class="<?php if ($_REQUEST['activeTab'] == 'tabTAXFilling') {
    echo 'active';
}?>"><a href="#tabTAXFilling" data-toggle="tab" class="btn btn-danger" >TAX Filing</a></li>
            </ul>
            <div class="panel-body">
              <div class="tab-content">
                <!-- ITR User Profile -->
                <div class="tab-pane active <?php if (!empty($itr_profile)) {
    echo 'form-submitted';
} ?>"  id="tabUserProf">
                      <div class="row">
                    <div class="col-md-12">
                      <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabPerDetail" data-toggle="tab">Personal Detail</a></li>
                            <li><a href="#tabConDetail" data-toggle="tab">Contact Detail</a></li>
                          </ul>
                        </div>
                        <!-- Personal Detail -->
                        <?php
                       // echo "dcs:--".$_SESSION['form16_id'];
                        ?>
                        <div class="panel-body">
                          <div class="tab-content">
                            <div class="tab-pane active" id="tabPerDetail" data-next-tab="#tabConDetail">
                             <form autocomplete="off" class="form-horizontal" name="form_1" id="form_1" action="../ajax-request/itr_update.php" method="POST" data-validation="PersonalInfo">
                                <?php //echo $_REQUEST['activeTab']; ?>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="inputPanNumber">PAN Number<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    
                                    <input type="pan" readonly class="form-control" id="itr_pd_pan_number" name="itr_pd_pan_number" value="<?php echo $itr_profile['itr_pd_pan_number']; ?>" placeholder="PAN Number" required data-validation="PAN" data-xml="PAN">
                                    
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="">Residential Status<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <label class="radio-inline">
                                    <input type="radio" name="itr_pd_resi_sta" <?php if ($itr_profile['itr_pd_resi_sta'] == 'RES') {
                                        echo 'checked';
                                    } ?> value="RES" />
                                    Resident </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="itr_pd_resi_sta" <?php if ($itr_profile['itr_pd_resi_sta'] == 'NRI') {
                                        echo 'checked';
                                    } ?> value="NRI" />
                                    Non-resident </label>
                                    <label class="radio-inline">
                                    <input type="radio" name="itr_pd_resi_sta" <?php if ($itr_profile['itr_pd_resi_sta'] == 'NRO') {
                                        echo 'checked';
                                    } ?> value="NRO" />
                                    Resident but not ordinary resident </label>
                                    <label for="">
                                    <button type="button" style="margin-left:7%;margin-top:0.5%;" class="btn btn-info" id="res-status-decide" data-toggle="modal" data-target="#resStatusHelp">Help me decide</button>
                                    </label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="">Return Type<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <select name="itr_pd_return_type"  class="form-control" data-validation="ReturnType" data-xml="ReturnType">
                                      <option <?php echo $itr_profile['itr_pd_return_type'] == 'O' ? 'selected' : ''; ?>  value="O">Original</option>
                                      <option <?php echo $itr_profile['itr_pd_return_type'] == 'R' ? 'selected' : ''; ?>  value="R">Revised</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group" <?php echo ($itr_profile['itr_pd_return_type'] == 'O' || $itr_profile['itr_pd_return_type'] == '') ? 'style="display:none;"' : ''; ?>>
                                  <label class="control-label col-sm-3" for="">Acknowledgement Number of original return<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="itr_pd_ackno_orreturn" value="<?php echo $itr_profile['itr_pd_ackno_orreturn']; ?>" placeholder="" data-validation="ReceiptNo" data-xml="ReceiptNo">
                                  </div>
                                </div>
                                <div class="form-group"  <?php echo ($itr_profile['itr_pd_return_type'] == 'O' || $itr_profile['itr_pd_return_type'] == '') ? 'style="display:none;"' : ''; ?>>
                                  <label class="control-label col-sm-3" for="">Date of filing original return<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control date-picker-itr-original"  name="itr_pd_date_filoeriretu" value="<?php if (isset($itr_profile['itr_pd_date_filoeriretu']) && $itr_profile['itr_pd_date_filoeriretu']) {
                                        echo date_create_from_format('Y-m-d', $itr_profile['itr_pd_date_filoeriretu'])->format('d/m/Y');
                                    }?>" placeholder="dd/mm/yyyy" data-validation="OrigRetFiledDate" data-xml="OrigRetFiledDate">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="inputName">First Name<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="itr_pd_fname" name="itr_pd_fname" value="<?php echo $itr_profile['itr_pd_fname']; ?>" placeholder="First name" required data-validation="Alphabets" maxlength=25 data-xml="FirstName">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="inputName">Middle Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="itr_pd_mname" name="itr_pd_mname" value="<?php echo $itr_profile['itr_pd_mname']; ?>" placeholder="middle name" data-validation="Alphabets" maxlength=25 data-xml="MiddleName">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="inputName">Last Name<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="itr_pd_lname" name="itr_pd_lname" value="<?php echo $itr_profile['itr_pd_lname']; ?>" placeholder="Last name" required data-validation="Alphabets" data-xml="SurNameOrOrgName" maxlength=75>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="inputFName">Father Name<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="itr_pd_father_name" name="itr_pd_father_name" value="<?php echo $itr_profile['itr_pd_father_name']; ?>" placeholder="Father name" required data-validation="Alphabets" data-xml="FatherName" maxlength="125">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="inputGender">Gender<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <select class="form-control" id="itr_pd_gender" name="itr_pd_gender" required>
                                      <option <?php echo $itr_profile['itr_pd_gender'] == 'm' ? 'selected' : ''; ?> value="m">Male</option>
                                      <option <?php echo $itr_profile['itr_pd_gender'] == 'f' ? 'selected' : ''; ?> value="f">Female</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="maritalStatus">Marital Status</label>
                                  <div class="col-sm-9">
                                    <select class="form-control" id="itr_pd_marital_status" name="itr_pd_marital_status">
                                      <option <?php echo $itr_profile['itr_pd_marital_status'] == 'n' ? 'selected' : ''; ?> value="n">Prefer Not to Disclose</option>
                                      <option <?php echo $itr_profile['itr_pd_marital_status'] == 'm' ? 'selected' : ''; ?> value="m">Married</option>
                                      <option <?php echo $itr_profile['itr_pd_marital_status'] == 's' ? 'selected' : ''; ?> value="s">Unmarried</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="inputDateOfBirth">Date Of Birth<span class="red"> *</span></label>
                         <div class="input-group col-sm-9">      
                                       <!----------------------------------- 20190225-BSEN ------------------------------------->
                                       <!--------------------------------- Change the if Checking ------------------------------>
                                       <input class="form-control date-picker-itr-dob itrdob" id="itr_pd_dob" name="itr_pd_dob" type="text" data-date-format="yyyy-mm-dd" value="<?php if (isset($itr_profile['itr_pd_dob'])) {if ($itr_profile['itr_pd_dob'] != '0000-00-00') {
                                        echo date_create_from_format('Y-m-d', $itr_profile['itr_pd_dob'])->format('d/m/Y');
                                    }}?>"  required data-validation="DOB" placeholder="DD/MM/YYYY" data-xml="DOB"/>
                                    
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>                                 
                                </div>
                              <!--   <div class="form-group">
                                  <label class="control-label col-sm-3" for="Aadhaar">Aadhaar Number<span class="red"> *</span></label>
                                </div> -->
                                <div class="form-group">
                                  <div class="control-label col-sm-3">
                                    <label class="control-label" for="Aadhaar Card Number">Aadhaar Card No<span class="red"> *</span></label>
                                  </div>
                                  <div class="col-sm-9">
                                    <input data-dependency="AadhaarEnrolmentId" type="text" class="form-control" id="itr_pd_adhar_no" name="itr_pd_adhar_no" value="<?php echo $itr_profile['itr_pd_adhar_no']; ?>" placeholder="Aadhaar Card Number" data-validation="AadhaarCardNo" data-xml="AadhaarCardNo">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-offset-6" for="Aadhaar">OR</label>
                                </div>
                                <div class="form-group">
                                  <div class="control-label col-sm-3">
                                    <label class="control-label" for="Aadhaar Enrolment Number">Aadhaar Enrolment No<span class="red"> *</span>  <label data-toggle="tooltip" data-html="true"data-placement="top" title="
                                           Enrolment No. <br>
                                           1234/10480/02615 <br> 
                                           Date :  
                                           06/05/2013 17:50:10<br>
                                           Please enter aadhaar Enrolment<br>
                                           1234104800261506052013175010<br>
                                           "><i class="fa fa-info-circle" aria-hidden="true"  ></i></label></label>
                                  </div>
                                  <div class="col-sm-9">
                                    <input data-dependency="AadhaarCardNo" type="text" class="form-control" id="itr_pd_adhar_enrol_no" name="itr_pd_adhar_enrol_no" value="<?php echo $itr_profile['itr_pd_adhar_enrol_no']; ?>" placeholder="Aadhaar Enrolment Number" data-validation="AadhaarEnrolmentId" data-xml="AadhaarEnrolmentId">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                <?php
                                       //echo 'Status:-'.$_SESSION['itr_status'];
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      //   echo 'Status:-'.$_SESSION['itr_status'];
                                      //print_r($_REQUEST);
                                  ?>
                                  
                                  <div class="col-sm-6">
                                    <input type="hidden" name="itr_pd_btn" value="1">
                                    <button type="submit" name="itr_pd_btn1" class="btn btn-success pull-right">Save and continue</button>
                                  </div>
                                  
                                  <?php
                                  }
                                  ?>
                                </div>
                              </form>
                            </div>
                            <!-- Contact Detail -->
                            <div class="tab-pane " id="tabConDetail" data-next-tab="#tabIncSource">
                               <form autocomplete="off" id="form_2" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" >
                               <?php //echo "active:". $_REQUEST['activeTab']; ?>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="MobNumber">Mobile Number<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="itr_cond_mobile_number" paatern="[6789][0-9]{9}" name="itr_cond_mobile_number" value="<?php echo $itr_profile['itr_cond_mobile_number']; ?>" placeholder="Mobile Number" required data-validation="MobileNo" data-xml="MobileNo">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="emailID">Email ID<span class="red"> *</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="itr_cond_email_id" name="itr_cond_email_id" value="<?php echo $itr_profile['itr_cond_email_id']; ?>" placeholder="Email ID" required data-validation="EmailAddress" data-xml="EmailAddress" maxlength=125>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label style="font-size:18pt font-weight:bold font-family:montserrat" class="control-label col-sm-3" for="Address"><strong>Address</strong></label>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="address">Flat/Door/Block No<span class="red"> *</span></label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" id="itr_cond_fl_do_bl" name="itr_cond_fl_do_bl" value="<?php echo $itr_profile['itr_cond_fl_do_bl']; ?>" placeholder="Flat/Door/Block" required data-validation="ResidenceNo" data-xml="ResidenceNo" maxlength=50>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="permisesBuilding"> Premises/Building Name</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" id="itr_cond_buname" name="itr_cond_buname" value="<?php echo $itr_profile['itr_cond_buname']; ?>" placeholder="Name of Premises/Building" data-validation="ResidenceName" data-xml="ResidenceName" maxlength=50>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="roadStreetPost">Road/Street/Postoffice</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" id="itr_cond_ro_st_po" name="itr_cond_ro_st_po" value="<?php echo $itr_profile['itr_cond_ro_st_po']; ?>" placeholder="Road/Street/Postoffice" data-validation="RoadOrStreet" data-xml="RoadOrStreet" maxlength=50>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="areaLocality">Area/Locality<span class="red"> *</span></label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" id="itr_cond_area_loc" name="itr_cond_area_loc" value="<?php echo $itr_profile['itr_cond_area_loc']; ?>" placeholder="Area/Locality" required data-validation="LocalityOrArea" data-xml="LocalityOrArea" maxlength=50>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="city">Town/City/District<span class="red"> *</span></label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" id="itr_cond_city" name="itr_cond_city" value="<?php echo $itr_profile['itr_cond_city']; ?>" placeholder="City" required data-validation="CityOrTownOrDistrict" data-xml="CityOrTownOrDistrict" maxlength=50>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="State">State<span class="red"> *</span></label>
                                  </div>
                                  <div class="col-sm-5">
                                   <Select class="form-control" id="itr_cond_state" name="itr_cond_state" required data-validation="StateCode" data-xml="StateCode">
                                     <option value="">Select State</option>
                    <?php
                    foreach ($itr_state as $eachstate) {
                        echo '<option value="'.$eachstate['state_code'].'"'.($eachstate['state_code'] == $itr_profile['itr_cond_state'] ? 'selected' : ' ').'>'.$eachstate['state_name'].'</option>';
                    }
                                        ?>
                                   </Select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="Country">Country<span class="red"> *</span></label>
                                  </div>
                                  <div class="col-sm-5">
                                     <Select class="form-control" id="itr_cond_country" name="itr_cond_country" required data-validation="CountryCode" data-xml="CountryCode">
                    <option value="91">India</option>
                  </Select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="pinCode">Pin Code<span class="red"> *</span></label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" id="itr_cond_pin_code" name="itr_cond_pin_code" value="<?php echo $itr_profile['itr_cond_pin_code']; ?>" placeholder="pin Code" required data-validation="PinCode" data-xml="PinCode">
                                  </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                 <?php
                                   if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                       ?>
                                 
                                  <div class="col-sm-6">
                                      <input type="hidden" name="itr_cond_btn" value="1">
                                      <button type="submit" name="itr_cond_btn1" class="btn btn-success pull-right">Save and continue</button>
                                    </div>
                                  
                                   <?php
                                   }
                                  ?>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Income Sources -->
                <div class="tab-pane " id="tabIncSource">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabFromSalary" data-toggle="tab">Salary</a></li>
                            <li><a href="#tabHouseProp" data-toggle="tab">House Property</a></li>
                            <li><a href="#tabOther" data-toggle="tab">Other</a></li>
                          </ul>
                        </div>
                        <div class="panel-body">
                          <div class="tab-content">
                            <!-- Salary -->
                            <div class="tab-pane  active" id="tabFromSalary" data-next-tab="#tabHouseProp">
                              <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-income-salary" data-required="sou_sa_salary[],sou_sa_tan_no[],sou_sa_employer_name[]" data-check="sou_sa_tds_on_sal[],sou_sa_ntslary[],sou_sa_tan_no[],sou_sa_employer_name[]">
                                  <?php if (!empty($itr_sou_salary)) {
                                      foreach ($itr_sou_salary as $eachsalary) {
                                          ?>  
                  <div class="add_sou_salaryy_div"> 
                    <input type="hidden" name="hidchecksalary[]" value="<?php echo $eachsalary['pk_sousal_id']; ?>"/>
                    <div class="form-group">
                    <label class="control-label col-sm-3" for="inputPanNumber">Upload Form-16-Part-B &nbsp;<code>Optional</code></label>
                    <div class="col-sm-9">
                      <div class="row">
                      <div class="col-xs-12">
                        <div class="col-xs-3">
                        <div id="container"> <a id="pickfiles" href="#" class="btn btn-sm btn-purple"><i class="ace-icon fa fa-cloud-upload"></i><strong>Upload Form 16 Part-B</strong></a> </div>
                        <div id="filelist"></div>
                        </div>
                        <div class="hide col-xs-8 pull-right" id="form_text">
                        <input type="hidden" name="form_data_id" id="form_data_id" value="" />
                        <div id="fetchProgressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87">
                          <div id="fetchProgressbarInner" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 77%;"><strong>Fetching all the data from uploaded files.....</strong></div>
                        </div>
                        </div>
                      </div>
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Gross Salary as per section 17(1)<span class="red"> *</span></label>
                    <div class="col-sm-7">
                      <input type="text" id="myInput" required="required" class="form-control" value="<?php if(!empty($eachsalary['sou_sa_salary'])){ echo $eachsalary['sou_sa_salary'];}  elseif($form16data['section_17_1']){ echo $form16data['section_17_1']; }?>" name="sou_sa_salary[]" placeholder="Salary excluding all allowances, perquisites and profits in lieu of salary" data-validation="14DigitNumber" data-xml="Salary">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Value of perquisites as per section 17(2)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="<?php if(!empty($eachsalary['sou_sa_perquisite'])){ echo $eachsalary['sou_sa_perquisite'];} elseif($form16data['section_17_2']){ echo $form16data['section_17_2']; } ?>" name="sou_sa_perquisite[]" placeholder="Value of perquisites" data-validation="14DigitNumber" data-xml="PerquisitesValue">
                    </div>
                    </div>                  
                    <div class="form-group">
                    <label class="control-label col-sm-3">Profits in lieu of salary as per section 17(3)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="<?php if(!empty($eachsalary['sou_sa_profits'])){ echo $eachsalary['sou_sa_profits'];} elseif($form16data['section_17_3']){ echo $form16data['section_17_3']; } ?>" name="sou_sa_profits[]" placeholder="Profits in lieu of salary" data-validation="14DigitNumber" data-xml="ProfitsInSalary">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4">Employee Information</label>
                    </div> 
                    <div class="form-group">
                    <label class="control-label col-sm-3" for="Employer name">Employer name<span class="red"> *</span></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control employerName" value="<?php if(!empty($eachsalary['sou_sa_employer_name'])){ echo $eachsalary['sou_sa_employer_name'];} elseif($form16data['employee_name']){ echo $form16data['employee_name']; }?>" name="sou_sa_employer_name[]" placeholder="Employer name" data-xml="EmployerOrDeductorOrCollecterName" maxlength=125>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3" for="Employer Type">Employer Type</label>
                    <div class="col-sm-7">
                      <select class="form-control employerType" name="sou_sa_employer_type[]" data-xml="EmployerCategory" id="emptype" >
                      <option <?php echo $eachsalary['sou_sa_employer_type'] == 'OTH' ? 'selected' : ''; ?> value="OTH">Private</option>
                      <option <?php echo $eachsalary['sou_sa_employer_type'] == 'GOV' ? 'selected' : ''; ?> value="GOV">Government</option>
                      <option <?php echo $eachsalary['sou_sa_employer_type'] == 'PSU' ? 'selected' : ''; ?> value="PSU">Public Sector</option>
                      <option <?php echo $eachsalary['sou_sa_employer_type'] == 'NA' ? 'selected' : ''; ?> value="NA">NA</option>                   
                      </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">TAN Number<span class="red"> *</span></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control TANNumber" value="<?php if(!empty($eachsalary['sou_sa_tan_no'])){echo $eachsalary['sou_sa_tan_no'];} elseif($form16data['deductor_tan']){ echo $form16data['deductor_tan']; } ?>" name="sou_sa_tan_no[]" placeholder="TAN Number" data-validation="TAN" data-xml="TAN">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Tax Deduction at source(TDS) on salary</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control tds" value="<?php echo $eachsalary['sou_sa_tds_on_sal']; if($form16data['sec_tot_7a_7b']){ echo $form16data['sec_tot_7a_7b']; }?>" name="sou_sa_tds_on_sal[]" placeholder="TDS on salary" data-validation="14DigitNumber" data-xml="TotTDSOnAmtPaid">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4"><strong>Allowances exempted under section 10</strong></label>
                    </div>  
                    <div class="form-group">
                    <label class="control-label col-sm-3">i. HRA-10(13A)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="<?php if(!empty($eachsalary['sou_sa_hra10'])){ echo $eachsalary['sou_sa_hra10']; } elseif($form16data['hra']){ echo $form16data['hra']; } ?>" name="sou_sa_hra10[]" placeholder="HRA-10(13A)" data-validation="14DigitNumber" data-xml="NatureDesc 10(13A)">
                    </div>
                    </div>  
                    <div class="form-group">
                    <label class="control-label col-sm-3">ii. Others under section 10</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="<?php echo $eachsalary['sou_sa_oth10']; ?>" name="sou_sa_oth10[]" placeholder="Others under section 10" data-validation="14DigitNumber" data-xml="NatureDesc OTH">
                    </div>
                    </div>                    
                    <div class="form-group">
                    <label class="control-label col-sm-3">Deduction u/s 16(ia)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="<?php if(!empty($eachsalary['sou_sa_deduction'])){echo $eachsalary['sou_sa_deduction'];} elseif($form16data['sec_16_ia']){ echo $form16data['sec_16_ia']; }else{ echo "40000"; } ?>" name="sou_sa_deduction[]" placeholder="Deduction u/s 16" data-validation="14DigitNumber" data-xml="DeductionUs16">
                    </div>
                    </div>
                    <div class="form-group de16ii" id="de16ii" style="display: none">
                    <label class="control-label col-sm-3">Entertainment Deduction u/s 16ii</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control"  value="<?php if(!empty($eachsalary['deductionUs16ii'])){echo $eachsalary['deductionUs16ii'];} elseif($form16data['sec_16_ii']){ echo $form16data['sec_16_ii']; } ?>" name="deductionUs16ii[]" placeholder="Entertainment Deduction u/s 16ii" data-validation="14DigitNumber" data-xml="DeductionUs16ii">
                    </div>
                    </div>
                                    
                   <div class="form-group" id="de16iii">
                    <label class="control-label col-sm-3">Professional Tax u/s 16(iii)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="<?php if(!empty($eachsalary['deductionUs16iii'])){echo $eachsalary['deductionUs16iii'];} elseif($form16data['sec_16_iii']){ echo $form16data['sec_16_iii']; } ?>" name="deductionUs16iii[]" placeholder="Professonal Tax u/s 16iii" data-validation="14DigitNumber" data-xml="DeductionUs16iii">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Income Chargable Under The Head Salaries</label>
                    <div class="col-sm-7">
                      <input readonly type="text" class="form-control" value="<?php  if($eachsalary['sou_sa_ntslary']){ echo $eachsalary['sou_sa_ntslary'];} elseif($form16data['head_sal']){ echo $form16data['head_sal']; }  ?>" name="sou_sa_ntslary[]" placeholder="Income chargable under salaries" data-validation="14DigitNumber" data-xml="IncomeFromSal">
                    </div>
                    </div>
                    
                    
                  </div>
                  <?php
                                      }
                                  } ?>
                <div class="form-group"> <label class="control-label col-sm-3 col-sm-offset-2" for=""> <button type="button" class="btn icon-btn btn-success add_sou_salaryy_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add more salary</button> </label> </div>
                <div class="form-group">
                 <div class="col-sm-4 col-sm-offset-2">
                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                  </div>
                   <?php
                    if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                   ?>
                                 
                  <div class="col-sm-6">
                  <input type="hidden" name="sou_salary_btn" value="1">
                  <button type="submit" name="sou_salary_btn1" id="sal_bttn" class="btn btn-success pull-right">Submit</button>
                  </div>
                  <?php
                  }
                  ?>
                </div>
                </form>
                <!-- Salary add more -->
               <div class="add_sou_salaryy_div hide">      
              <div class="form-group">
                    <label class="control-label col-sm-3" for="inputPanNumber">Upload Form-16 &nbsp;<code>Optional</code></label>
                    <div class="col-sm-9">
                      <div class="row">
                      <div class="col-xs-12">
                        <div class="col-xs-3">
                        <div id="container"> <a id="pickfiles" href="#" class="btn btn-sm btn-purple"><i class="ace-icon fa fa-cloud-upload"></i><strong>Upload Form 16</strong></a> </div>
                        <div id="filelist"></div>
                        </div>
                        <div class="hide col-xs-8 pull-right" id="form_text">
                        <input type="hidden" name="form_data_id" id="form_data_id" value="" />
                        <div id="fetchProgressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87">
                          <div id="fetchProgressbarInner" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 77%;"><strong>Fetching all the data from uploaded files.....</strong></div>
                        </div>
                        </div>
                      </div>
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Gross Salary as per section 17(1)<span class="red"> *</span></label>
                    <div class="col-sm-7">
                      <input type="text" required="required" class="form-control" value="" name="sou_sa_salary[]" placeholder="Salary excluding all allowances, perquisites and profits in lieu of salary" data-validation="14DigitNumber" data-xml="Salary">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Value of perquisites as per section 17(2)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="" name="sou_sa_perquisite[]" placeholder="Value of perquisites" data-validation="14DigitNumber" data-xml="PerquisitesValue">
                    </div>
                    </div>                  
                    <div class="form-group">
                    <label class="control-label col-sm-3">Profits in lieu of salary as per section 17(3)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="" name="sou_sa_profits[]" placeholder="Profits in lieu of salary" data-validation="14DigitNumber" data-xml="ProfitsInSalary">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4"><strong>Employee Information</strong></label>
                    </div> 
                    <div class="form-group">
                    <label class="control-label col-sm-3" for="Employer name">Employer name<span class="red"> *</span></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control employerName" value="" name="sou_sa_employer_name[]" placeholder="Employer name" data-xml="EmployerOrDeductorOrCollecterName" maxlength=125>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3" for="Employer Type">Employer Type</label>
                    <div class="col-sm-7">
                      <select class="form-control employerType" name="sou_sa_employer_type[]" data-xml="EmployerCategory">
                      <option  value="OTH">Private</option>
                      <option  value="GOV">Government</option>
                      <option  value="PSU">Public Sector</option>
                      <option  value="NA">NA</option>                   
                      </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">TAN Number<span class="red"> *</span></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control TANNumber" value="" name="sou_sa_tan_no[]" placeholder="TAN Number" data-validation="TAN" data-xml="TAN">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Tax Deduction at source(TDS) on salary</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control tds" value="" name="sou_sa_tds_on_sal[]" placeholder="TDS on salary" data-validation="14DigitNumber" data-xml="TotTDSOnAmtPaid">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4">Allowances exempted under section 10</label>
                    </div>  
                    <div class="form-group">
                    <label class="control-label col-sm-3">i. HRA-10(13A)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="" name="sou_sa_hra10[]" placeholder="HRA-10(13A)" data-validation="14DigitNumber" data-xml="NatureDesc 10(13A)">
                    </div>
                    </div>  
                    <div class="form-group">
                    <label class="control-label col-sm-3">ii. Others under section 10</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="" name="sou_sa_oth10[]" placeholder="Others under section 10" data-validation="14DigitNumber" data-xml="NatureDesc OTH">
                    </div>
                    </div>                    
                    <div class="form-group">
                    <label class="control-label col-sm-3">Deduction u/s 16(ia)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="" name="sou_sa_deduction[]" placeholder="Deduction u/s 16" data-validation="14DigitNumber" data-xml="DeductionUs16">
                    </div>
                    </div>
                    <div class="form-group de16ii" id="de16ii">
                    <label class="control-label col-sm-3">Entertainment Deduction u/s 16ii</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control"  value="" name="deductionUs16ii[]" placeholder="Entertainment Deduction u/s 16ii" data-validation="14DigitNumber" data-xml="DeductionUs16ii">
                    </div>
                    </div>
                                    
                   <div class="form-group" id="de16iii">
                    <label class="control-label col-sm-3">Professional Tax u/s 16iii</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" value="" name="deductionUs16iii[]" placeholder="Professonal Tax u/s 16iii" data-validation="14DigitNumber" data-xml="DeductionUs16iii">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Income Chargable Under The Head Salaries</label>
                    <div class="col-sm-7">
                      <input readonly type="text" class="form-control" value="" name="sou_sa_ntslary[]" placeholder="Income chargable under salaries" data-validation="14DigitNumber" data-xml="IncomeFromSal">
                    </div>
                   </div>
                  </div>
                            </div>
                            <!-- House Property -->
                            <div class="tab-pane " id="tabHouseProp" data-next-tab="#tabOther">
                              <div class="form-group">
                                <div class="col-sm-11 col-sm-offset-1">
                                  <label class="radio-inline">
                                  <input type="radio" name="housePropertyRadio" value="selfOccProperty" checked data-xml="TypeOfHP">
                                  Self Occupied Property </label>
                                  <label class="radio-inline">
                                  <input type="radio" name="housePropertyRadio" value="letOutProprty" data-xml="TypeOfHP">
                                  Let Out Property </label>
                                </div>
                              </div>
                              <br>
                              <br>
                              <br>
                              <!-- <h3><u>Self Occupied Property</u></h3> -->
                              <div class="housePropertyHide" id="selfOccPropertyShow">
                                <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-income-selfoccupied">
                                  <div class="add_self_occ_prop">                 
                                    <input type="hidden" name="hidcheckslfoccprop[]" value="<?php if (!empty($itr_hp_selfocc)) {
                                      echo $itr_hp_selfocc[0]['pk_itr_selfocc'];
                                  } ?>"/>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6">Interest paid on home loan of self occupied property</label>
                                      <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php if (!empty($itr_hp_selfocc)) {
                                      echo intval($itr_hp_selfocc[0]['self_hloan_int']);
                                  } ?>" name="self_hloan_int[]" placeholder="Interest of self occupied property" data-validation="14DigitNumber" data-xml="InterestPayable">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="">Pre construction period interest</label>
                                      <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php if (!empty($itr_hp_selfocc)) {
                                      echo $itr_hp_selfocc[0]['self_con_per_int'];
                                  } ?>" name="self_con_per_int[]" placeholder="Pre construction period interest" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="">Income from Self occupied House Property</label>
                                      <div class="col-sm-4">
                                        <input type="text" class="form-control" name="self_con_income[]" placeholder="Total Income" value="<?php if (!empty($itr_hp_selfocc)) {
                                      echo $itr_hp_selfocc[0]['self_con_income'];
                                  } elseif($form16data['inc_s_o_property']){ echo $form16data['inc_s_o_property']; } ?>" readonly data-xml="TotalIncomeOfHP">
                                      </div>
                                    </div>                  
                                    <br>
                                  </div>
                                  <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>  
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                    <input type="hidden" name="sou_hpself_btn" value="1">
                                    <button type="submit" name="sou_hpself_btn1" class="btn btn-success pull-right">Submit</button <?= $r; ?>>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </form>
                              </div>
                              <!-- <h3><u>Let Out Property</u></h3> -->
                              <div class="housePropertyHide" id="letOutProprtyShow">
                                <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-income-letout">
                                  <div class="add_let_out_prop">
                                    <input type="hidden" name="hidcheckletoutprop[]" value="<?php if (!empty($itr_hp_letout)) {
                                      echo $itr_hp_letout[0]['pk_itr_letout'];
                                  } ?>"/>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="Total Setal Income">Total Rental Income in financial year</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php if (!empty($itr_hp_letout)) {
                                      echo $itr_hp_letout[0]['let_ren_inc'];
                                  } ?>" name="let_ren_inc[]" placeholder="Total Rental Income" data-xml="GrossRentReceived" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="Property Tax Paid">Property Tax Paid</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php if (!empty($itr_hp_letout)) {
                                      echo $itr_hp_letout[0]['let_proptex_pad'];
                                  } ?>" name="let_proptex_pad[]" placeholder="Property Tax Paid" data-xml="TaxPaidlocalAuth" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="Standard Deduction">Standard Deduction</label>
                                      <div class="col-sm-6">
                                        <input readonly type="text" class="form-control" value="<?php if (!empty($itr_hp_letout)) {
                                      echo $itr_hp_letout[0]['let_st_dedu'];
                                  } ?>" name="let_st_dedu[]" placeholder="Standard Deduction" data-xml="StandardDeduction" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="intPaidLetProp">Interest paid on home loan of let out property</label>
                                      <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php if (!empty($itr_hp_letout)) {
                                      echo $itr_hp_letout[0]['let_hloan_int'];
                                  } ?>" name="let_hloan_int[]" placeholder="Interest paid on home" data-xml="InterestPayable" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="Pre construction period interest">Pre construction period interest<span class="red"> *</span>  <label data-toggle="tooltip" data-html="true"data-placement="top" title="
                                           Enrolment No. <br>
                                           1234/10480/02615 <br> 
                                           Date :  
                                           06/05/2013 17:50:10<br>
                                           Please enter aadhaar Enrolment<br>
                                           1234104800261506052013175010<br>
                                           "><i class="fa fa-info-circle" aria-hidden="true"  ></i></label></label>
                                      <div class="col-sm-4">
                                        <input type="text" class="form-control" value="<?php if (!empty($itr_hp_letout)) {
                                      echo $itr_hp_letout[0]['let_pre_cons_per_int'];
                                  } ?>" name="let_pre_cons_per_int[]" placeholder="Pre construction period Interest" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-6" for="">Income from Let out House Property</label>
                                      <div class="col-sm-4">
                                        <input type="text" class="form-control" name="let_con_income[]" placeholder="Income from Property" value="<?php if (!empty($itr_hp_letout)) {
                                      echo $itr_hp_letout[0]['let_con_income'];
                                  } ?>" data-validation="14DigitNumber" data-xml="TotalIncomeOfHP" readonly>
                                      </div>
                                    </div>                    
                                    </div>
                                    <br>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                    </label>
                                  </div>
                                  <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                    <input type="hidden" name="sou_hpletout_btn" value="1">
                                    <button type="submit" name="sou_hpletout_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                   <?php
                                  }
                                  ?>
                                  </div>
                                </form>
                </div>
                              </div>                   
                            <!-- Other -->
                            <div class="tab-pane " id="tabOther" data-next-tab="#tabDeduction">
                              <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-income-other">
                  <input type="hidden" name="pk_oth_id" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['pk_oth_id'];
                                  } ?>"/>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="Other Income"><strong>Other Income</strong></label>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="Bank Interest">Interest (Bank/Post)</label>
                                  </div>
                                  
                                  <div class="col-sm-5">                                
                                    <input type="text" class="form-control" name="sou_oth_oi_bnkint" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_oi_bnkint'];
                                  } ?>" placeholder="Interest (Bank/Post)" id="bank_saving_int" data-validation="Number" maxlength=14 data-xml="bank_saving_int">
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="Bank Interest">Interest (FD/Any other)</label>
                                  </div>
                                  
                                  <div class="col-sm-5">                                
                                    <input type="text" class="form-control" name="sou_oth_oi_bnkint_fd" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_oi_bnkint_fd'];
                                  } ?>" placeholder="Interest (FD/Any other)" data-validation="Number" maxlength=14 data-xml="bank_saving_fd">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="Other Interest">Other Interest</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_oi_othint" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_oi_othint'];
                                  } ?>" placeholder="Other Interest" data-validation="Number" maxlength=14 data-xml="other_interest">
                                  </div>
                                </div>
                                <!-- ---------------------------------------------------- -->

                                 <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="agriIncome">Family Pension</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="family_pension" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['family_pension'];
                                  } ?>" placeholder="Family Pension" data-xml="family_pension">
                                  </div>
                                </div>

                                <!-- ---------------------------------------------------- -->
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="agriIncome">Other Income</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_oi_othinc" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_oi_othinc'];
                                  } ?>" placeholder="Other Income" data-validation="Number" maxlength=14 data-xml="other_income">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="totalOtherIncome">Total Other Income</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_oi_totothinc" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_oi_totothinc'];
                                  } ?>" placeholder="Total Income" data-validation="14DigitNumber" maxlength=14 data-xml="IncomeOthSrc" readonly>
                                  </div>
                                </div>                
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for=""><strong>Exempted Income</strong></label>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="agriculInc">Agriculture Income</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_exi_agriinc" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_exi_agriinc'];
                                  } ?>" placeholder="Income From Agriculture" data-validation="Number" maxlength=14>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="divInc">Dividend Income</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_exi_diviinc" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_exi_diviinc'];
                                  } ?>" placeholder="Income From Dividend"><!-- data-validation="dividedincome" maxlength=14 -->
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="LTCGCGain">LTCG (Capital Gain)</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_exi_ltcg" value="
                                    <?php /*if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_exi_ltcg'];
                                  } */?>" placeholder="LTCG (Capital Gain)" data-validation="Number" maxlength=14>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">                
                                  <label class="control-label" for="Exempted Income">Other Exempted Income</label>
                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_exi_othinc" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_exi_othinc'];
                                  } ?>" placeholder="Exempted Income" data-validation="Number" maxlength=14>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label" for="totalExemptedIncome">Total Exempted Income</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sou_oth_exi_totexinc" value="<?php if (!empty($itr_sou_other)) {
                                      echo  $itr_sou_other['sou_oth_exi_totexinc'];
                                  } ?>" placeholder="Total Exempted Income" data-validation="14DigitNumber" maxlength=14 readonly data-xml="taxExmpIntInc">
                                  </div>
                                </div>                
                                <div class="form-group">
                                 <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  
                                  <div class="col-sm-6">
                                  <input type="hidden" name="itr_sou_other_btn" value="1">
                                  <button type="submit" name="itr_sou_other_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                  
                                  <?php
                                  }
                                  ?>
                                  
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Deduction -->
                <div class="tab-pane " id="tabDeduction">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#genDeduction" data-toggle="tab">General Deduction</a></li>
                            <li><a href="#tabHealthInsurance" data-toggle="tab">Health Insurance</a></li>
                            <li><a href="#tabDonetion" data-toggle="tab">Donation</a></li>
                            <li><a href="#tabDonetion80gga" data-toggle="tab">Donation80GGA</a></li>
                            <li><a href="#tabOtherDeductions" data-toggle="tab">Other Deductions</a></li>
                          </ul>
                        </div>
                        <div class="panel-body">
                          <div class="tab-content">
                            <!-- Tax Saving Investment -->
                            <div class="tab-pane  active" id="genDeduction" data-next-tab="#tabHealthInsurance">
                              <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-deduction-general">
                  <input type="hidden" name="pk_ded_id" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['pk_ded_id'];
                                  } ?>"/>               
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="Investments u/s 80C">Investments u/s 80C</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_gd__80c" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_gd__80c'];
                                  } ?>" placeholder="Investments u/s 80C" data-xml="Section80C" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="inputName">Investment in Pension Policies (Section 80CCC)</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_othd_80ccc" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_othd_80ccc'];
                                  } ?>" placeholder="Investment in Pension Policies" data-xml="Section80CCC" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="inputName">Total Amount of Deduction on Employee's Contribution to National Pension Scheme (NPS) (Section 80CCD-1)</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_othd_80ccd1" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_othd_80ccd1'];
                                  } ?>" placeholder="Amount of Deduction on NPS" data-xml="Section80CCDEmployeeOrSE" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="Additional Investment in NPS">Additional Investment in NPS (Section 80CCD-1B)</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_othd_80ccd1b" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_othd_80ccd1b'];
                                  } ?>" placeholder="Additional Investment in NPS" data-xml="Section80CCD1B" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="Amount of Deduction NPS Section 80CCD-2">Total Amount of Deduction on Employer's Contribution to National Pension Scheme (NPS) (Section 80CCD-2)</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_othd_80ccd2" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_othd_80ccd2'];
                                  } ?>" placeholder="Amount of Deduction NPS Section 80CCD-2" data-xml="Section80CCDEmployer" data-validation="14DigitNumber">
                                  </div>
                                </div>                
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="Section 80GG">Section 80GG</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_gd__80gg" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_gd__80gg'];
                                  } ?>" placeholder="Section 80GG (Max 60k)" data-xml="Section80GG" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="Section 80TTA">Section 80TTA</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_gd__80tta" id="ded_gd__80tta" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_gd__80tta'];
                                  } ?>" placeholder="Section 80TTA" data-xml="Section80TTA" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="Section 80TTA">Section 80TTB</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_gd__80ttb" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['ded_gd__80ttb'];
                                  } ?>" placeholder="Section 80TTB" data-xml="Section80TTB" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="">Rajiv Gandhi equity saving scheme- 80CCG</label>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control"  name="ded_othd_80ccg" value="<?php if (!empty($itr_deduction)) {
                                      echo $itr_deduction['ded_othd_80ccg'];
                                  } ?>" placeholder="Rajiv Gandhi equity saving scheme- 80CCG" data-xml="Section80CCG" data-validaton="14DigitNumber">
                                  </div>
                                </div>                
                                <div class="form-group">
                                 <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                  <input type="hidden" name="ded_gd_btn" value="1">
                                  <button type="submit" name="ded_gd_btn1" class="btn btn-success pull-right">Save and continue</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                  
                                </div>
                              </form>
                            </div>
                            <!-- Health Insurance -->
                            <div class="tab-pane " id="tabHealthInsurance" data-next-tab="#tabDonetion">
                              <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-deduction-health">
                  <input type="hidden" name="pk_ded_id" value="<?php if (!empty($itr_deduction)) {
                                      echo  $itr_deduction['pk_ded_id'];
                                  } ?>"/>                 
                                <div class="form-group">
                                  <div class="col-sm-5 col-sm-offset-2">
                                    <label class="control-label" for="Cat Type">Health Insurance Category</label>
                                  </div>
                                  <div class="col-sm-5">
                    <select class="form-control" name="ded_hi_type" required data-xml="Section80DUsrType">
                                        <option value="0">Select One</option>                   
                                        <option value="1" <?php echo $itr_deduction['ded_hi_type'] == 1 ? 'selected' : ''; ?> >Self and Family</option>
                                        <option value="2" <?php echo $itr_deduction['ded_hi_type'] == 2 ? 'selected' : ''; ?> >Self (Senior Citizen) and Family</option>
                                        <option value="3" <?php echo $itr_deduction['ded_hi_type'] == 3 ? 'selected' : ''; ?> >Parents</option>
                                        <option value="4" <?php echo $itr_deduction['ded_hi_type'] == 4 ? 'selected' : ''; ?> >Parents (Senior Citizen)</option>  
                                        <option value="5" <?php echo $itr_deduction['ded_hi_type'] == 5 ? 'selected' : ''; ?> >Self and Family including Parents</option> 
                                        <option value="6" <?php echo $itr_deduction['ded_hi_type'] == 6 ? 'selected' : ''; ?> >Self and Family including Senior Citizen Parents</option>  
                                        <option value="7" <?php echo $itr_deduction['ded_hi_type'] == 7 ? 'selected' : ''; ?> >Self (Senior Citizen) and Family including Senior Citizen Parents</option>
                  </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-5 col-sm-offset-2">
                                    <label class="control-label">Health Insurance Premium U/S 80D</label>
                                  </div>
                                  <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ded_hi_hip80d_ssc" value="<?php echo $itr_deduction['ded_hi_hip80d_ssc']; ?>" placeholder="Health Insurance Premium U/S 80D" data-xml="Section80D" data-validation="14DigitNumber" <?php if ($itr_deduction['ded_hi_type']) {
                                      echo 'required';
                                  } ?> >
                                  </div>
                                </div>
                                <div class="form-group">
                                 <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                  <input type="hidden" name="ded_hi_btn" value="1">
                                  <button type="submit" name="ded_hi_btn1" class="btn btn-success pull-right">Save and continue</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </form>
                            </div>
                            <!-- Donation -->
                            <div class="tab-pane " id="tabDonetion" data-next-tab="#tabDonetion80gga">
                              <div class="col-sm-12">
                                <label class="radio-inline">
                                <input type="radio" name="deductionDonRadio" value="charity100Ded" checked>
                                Donation with 100% deduction </label>
                                <label class="radio-inline">
                                <input type="radio" name="deductionDonRadio" value="charity50Ded">
                                Donation with 50% deduction </label>
                                <label class="radio-inline">
                                <input type="radio" name="deductionDonRadio" value="otherDonation">
                                Other Donation </label>
                              </div>
                <br /><br /><br />
                              <div class="dedDonationHide" id="charity100DedShow">
                                <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-deduction-charity100" data-required="dona_80g_damount[],dona_80g_dpincode[],dona_80g_dcity[],dona_80g_daddr[],dona_80g_dpan[],dona_80g_dname[]">
                                  <?php
                                    $don100flag = 0;
                                        if (!empty($itr_donation)) {
                                            foreach ($itr_donation as $eachdon100) {
                                                if ($eachdon100['dona_share_50_100'] == 1) {
                                                    $don100flag = 1; ?>
                  <div class="add_don100_div">                  
                                    <input type="hidden" name="hidcheckdon100[]" value="<?php echo $eachdon100['pk_dona_id']; ?>"/>
                                    <div class="form-group">
                                      <label class="control-label col-sm-7"><strong>Charitable Donation (80G) with 100% deduction</strong></label>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Donation Eligibility<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <select name="dona_80g_deligilibity[]" class="form-control">
                                          <option <?php echo $eachdon100['dona_80g_deligilibity'] == 'without qualifing limit' ? 'selected' : ''; ?> value="without qualifing limit" >Without qualifying limit</option>
                                          <option <?php echo $eachdon100['dona_80g_deligilibity'] == 'with qualifing limit' ? 'selected' : ''; ?> value="with qualifing limit">With qualifying limit</option>
                                        </select>
                                      </div>
                                    </div>                  
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Name of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_dname']; ?>" name="dona_80g_dname[]" placeholder="Donee name" data-xml="DoneeWithPanName" data-validation="Alphabets" maxlength=125>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" of the Donee>PAN of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_dpan']; ?>" name="dona_80g_dpan[]" placeholder="PAN of the Donee" data-xml="DoneePAN" data-validation="GeneralPAN">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Address<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_daddr']; ?>" name="dona_80g_daddr[]" placeholder="Address" data-xml="AddrDetail" maxlength=200>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Town/City/District<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_dcity']; ?>" name="dona_80g_dcity[]" placeholder="Town/City/District" data-xml="CityOrTownOrDistrict" data-validation="Alphabets" maxlength=50>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">State<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <Select class="form-control" name="dona_80g_dstate[]" data-xml="StateCode">
                    <option value="0">Select State</option>
                    <?php foreach ($itr_state as $eachstate) {
                                                        echo '<option value="'.$eachstate['state_code'].'"'.($eachstate['state_code'] == $eachdon100['dona_80g_dstate'] ? 'selected' : ' ').'>'.$eachstate['state_name'].'</option>';
                                                    } ?>
                  </Select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Pin code">Pin code<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_dpincode']; ?>" name="dona_80g_dpincode[]" placeholder="Pin code" data-xml="PinCode" data-validation="PinCode">
                                      </div>
                                    </div>    
                                <!--------------------------------------------- New Added for 2019 Schema-BSEN-START ----------------------------------------------------->
                                        
                                       <div class="form-group">
                                          <label class="control-label col-sm-3">Donation By Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_percentcash']; ?>" name="dona_80g_percentcash[]" placeholder="Donation By Cash" data-xml="dona80gpercentcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Donation By Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_percentothermode']; ?>" name="dona_80g_percentothermode[]" placeholder="Donation By Other Mode" data-xml="dona80gpercentothermode">
                                          </div>
                                        </div>
                                    <!------------------------------------------------- Donation in Cash-BSEN-END ----------------------------------------------------->
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Donation Amount">Total Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                      <input type="text" readonly class="form-control" name="dona_80g_damount[]" placeholder="Donation Amount" data-xml="DonationAmt" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                    
                                  </div>
                <?php
                                                }
                                            }
                                        } ?>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                    <button type="button" class="btn icon-btn btn-success add_don100_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add Donation with 100% deduction</button>
                                    </label>
                                  </div>
                                  <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                    <input type="hidden" name="ded_don100_btn" value="1">
                                    <button type="submit" name="ded_don100_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </form>
                <div class="add_don100_div hide">
                  <input type="hidden" name="hidcheckdon100[]" value=""/>
                                    <div class="form-group">
                                      <label class="control-label col-sm-7" >Charitable Donation (80G) with 100% deduction</label>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="">Donation Eligibility</label>
                                      <div class="col-sm-9">
                                        <select name="dona_80g_deligilibity[]" class="form-control">
                                          <option value="without qualifing limit">Without qualifying limit</option>
                                          <option value=">with qualifing limit">With qualifying limit</option>
                                        </select>
                                      </div>
                                    </div>                  
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Donee name">Name of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_dname[]" placeholder="Donee name" data-xml="DoneeWithPanName" data-validation="Alphabets" maxlength=125>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="PAN of the Donee">PAN of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_dpan[]" placeholder="PAN of the Donee" data-xml="DoneePAN" data-validation="GeneralPAN">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Address">Address<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_daddr[]" placeholder="Address" data-xml="AddrDetail" maxlength=200>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Town/City/District">Town/City/District<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_dcity[]" placeholder="Town/City/District" data-xml="CityOrTownOrDistrict" data-validation="Alphabets" maxlength=50>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="State">State<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <Select class="form-control" name="dona_80g_dstate[]">
                      <option value="0">Select State</option>
                      <?php foreach ($itr_state as $eachstate) {
                                      echo '<option value="'.$eachstate['state_code'].'"'.($eachstate['state_code'] == $eachdon100['dona_80g_dstate'] ? 'selected' : ' ').'>'.$eachstate['state_name'].'</option>';
                                  }
                                            ?>
                    </Select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Pin code">Pin code<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_dpincode[]" placeholder="Pin code" data-xml="PinCode" data-validation="PinCode">
                                      </div>
                                    </div>
                                   
                                     
                                    
                                <!--------------------------------------------- New Added for 2019 Schema-BSEN-START ----------------------------------------------------->
                                        
                                       <div class="form-group">
                                          <label class="control-label col-sm-3">Donation By Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentcash[]" placeholder="Donation By Cash" data-xml="dona_80g_percentcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Donation By Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentothermode[]" placeholder="Donation By Other Mode" data-xml="dona80gpercentothermode">
                                          </div>
                                        </div>
                                        
                                       
                                        
                                    <!------------------------------------------------- Donation in Cash-BSEN-END ----------------------------------------------------->
                                     <div class="form-group">
                                      <label class="control-label col-sm-3" for="Donation Amount">Total Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                      <input type="text" readonly class="form-control" name="dona_80g_damount[]" placeholder="Donation Amount" data-xml="DonationAmt" data-validation="14DigitNumber">
                                      </div>
                                    </div>
                                </div>
                              </div>
                              <div class="dedDonationHide" id="charity50DedShow">
                                <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-deduction-charity50" data-required="dona_80g_damount[],dona_80g_dpincode[],dona_80g_dcity[],dona_80g_daddr[],dona_80g_dpan[],dona_80g_dname[]">
                                    <?php
                                        $don50flag = 0;
                                        if (!empty($itr_donation)) {
                                            foreach ($itr_donation as $eachdon50) {
                                                if ($eachdon50['dona_share_50_100'] == 0) {
                                                    $don50flag = 1; ?>
                  <div class="add_don50_div">                 
                                    <input type="hidden" name="hidcheckdon50[]" value="<?php echo $eachdon50['pk_dona_id']; ?>"/>
                                    <div class="form-group">
                                      <label class="control-label col-sm-7"><strong>Charitable Donation (80G) with 50% deduction</strong></label>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="">Donation Eligibility<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <select name="dona_80g_deligilibity[]" class="form-control">
                                          <option <?php echo $eachdon50['dona_80g_deligilibity'] == 'without qualifing limit' ? 'selected' : ''; ?> value="without qualifing limit">Without qualifying limit</option>
                                          <option <?php echo $eachdon50['dona_80g_deligilibity'] == 'with qualifing limit' ? 'selected' : ''; ?> value="with qualifing limit">With qualifying limit</option>
                                        </select>
                                      </div>
                                    </div>                  
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Name of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_dname']; ?>" name="dona_80g_dname[]" placeholder="Donee name" required data-validation="Alphabets" data-xml="DoneeWithPanName">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">PAN of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_dpan']; ?>" name="dona_80g_dpan[]" placeholder="PAN of the Donee" required data-validation="GeneralPAN" data-xml="DoneePAN">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Address<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_daddr']; ?>" name="dona_80g_daddr[]" placeholder="Address" required data-xml="AddrDetail">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Town/City/District">Town/City/District<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_dcity']; ?>" name="dona_80g_dcity[]" placeholder="Town/City/District" required data-validation="Alphabets" data-xml="CityOrTownOrDistrict">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">State<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <Select class="form-control" name="dona_80g_dstate[]" data-xml="StateCode">
                      <option value="0">Select State</option>
                      <?php foreach ($itr_state as $eachstate) {
                                                        echo '<option value="'.$eachstate['state_code'].'"'.($eachstate['state_code'] == $eachdon100['dona_80g_dstate'] ? 'selected' : ' ').'>'.$eachstate['state_name'].'</option>';
                                                    } ?>
                    </Select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Pin code<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_dpincode']; ?>" name="dona_80g_dpincode[]" placeholder="Pin code" required data-validation="PinCode" data-xml="PinCode">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Donation Amount">Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_damount']; ?>" name="dona_80g_damount[]" placeholder="Donation Amount" required data-validation="14DigitNumber" data-xml="DonationAmt">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Eligible Donation Amount</label>
                                      <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_eligdamount']; ?>" name="dona_80g_eligdamount[]" placeholder="Donation Amount" data-xml="EligibleDonationAmt">
                                      </div>
                                    </div>
                                     <!--------------------------------------------- New Added for 2019 Schema-BSEN-START ----------------------------------------------------->
                                        
                                       <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation By Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentcash[]" placeholder="Eligible Donation By Cash" data-xml="dona80gpercentcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation By Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentothermode[]" placeholder="Eligible Donation By Other Mode" data-xml="dona80gpercentothermode">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation Appr Reqd Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentapprreqdcash[]" placeholder="Eligible Donation Appr Reqd Cash" data-xml="dona80gpercentapprreqdcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation Appr Reqd Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentapprreqdothermode[]" placeholder="Eligible Donation Appr Reqd Other Mode" data-xml="dona80gpercentapprreqdothermode">
                                          </div>
                                        </div>
                                        
                                         <div class="form-group">
                                          <label class="control-label col-sm-3">Total Donation US 80G Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_totaldonationsus80gcash']; ?>" name="dona_80g_totaldonationsus80gcash[]" placeholder="Total Donation US 80G Cash" data-xml="dona80gtotaldonationsus80gcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Total Donations Us80G Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_totaldonationsus80gotherMode']; ?>" name="dona_80g_totaldonationsus80gotherMode[]" placeholder="Total Donations Us80G Other Mode" data-xml="dona80gtotaldonationsus80gotherMode">
                                          </div>
                                        </div>
                                        
                                    <!------------------------------------------------- Donation in Cash-BSEN-END ----------------------------------------------------->
                  </div>
                                    <?php
                                                }
                                            }
                                        }?>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                    <button type="button" class="btn icon-btn btn-success add_don50_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add Donation with 50% deduction</button>
                                    </label>
                                  </div>
                                  <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                    <input type="hidden" name="ded_don50_btn" value="1">
                                    <button type="submit" name="ded_don50_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div> 
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </form>
                 <div class="add_don50_div hide">
                                    <input type="hidden" name="hidcheckdon50[]" value=""/>
                                    <div class="form-group">
                                      <label class="control-label col-sm-7" for="">Charitable Donation (80G) with 50% deduction</label>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="">Donation Eligibility<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <select name="dona_80g_deligilibity[]"  class="form-control" >
                                          <option value="without qualifing limit">Without qualifying limit</option>
                                          <option value=">with qualifing limit">With qualifying limit</option>
                                        </select>
                                      </div>
                                    </div>                  
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Donee name">Name of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                       <input type="text" class="form-control" name="dona_80g_dname[]" placeholder="Donee name" required data-validation="Alphabets" data-xml="DoneeWithPanName">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="PAN of the Donee">PAN of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_dpan[]" placeholder="PAN of the Donee" required data-validation="GeneralPAN" data-xml="DoneePAN">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Address">Address<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_daddr[]" placeholder="Address" required data-xml="AddrDetail">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Town/City/District">Town/City/District<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                         <input type="text" class="form-control" name="dona_80g_dcity[]" placeholder="Town/City/District" required data-validation="Alphabets" data-xml="CityOrTownOrDistrict">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="State">State<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <Select class="form-control" name="dona_80g_dstate[]" data-xml="StateCode">
                      <option value="0">Select State</option>
                      <?php foreach ($itr_state as $eachstate) {
                                      echo '<option value="'.$eachstate['state_code'].'"'.($eachstate['state_code'] == $eachdon100['dona_80g_dstate'] ? 'selected' : ' ').'>'.$eachstate['state_name'].'</option>';
                                  }
                                            ?>
                    </Select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Pin code">Pin code<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                       <input type="text" class="form-control" value="<?php echo $eachdon50['dona_80g_dpincode']; ?>" name="dona_80g_dpincode[]" placeholder="Pin code" required data-validation="PinCode" data-xml="PinCode">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Donation Amount">Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" name="dona_80g_damount[]" placeholder="Donation Amount" required data-validation="14DigitNumber" data-xml="DonationAmt">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Eligible Donation Amount</label>
                                      <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="dona_80g_eligdamount[]" placeholder="Donation Amount" data-xml="EligibleDonationAmt">
                                      </div>                  
                  </div>
                                     <!--------------------------------------------- New Added for 2019 Schema-BSEN-START ----------------------------------------------------->
                                        
                                       <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation By Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentcash[]" placeholder="Eligible Donation By Cash" data-xml="dona80gpercentcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation By Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentothermode[]" placeholder="Eligible Donation By Other Mode" data-xml="dona80gpercentothermode">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation Appr Reqd Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentapprreqdcash[]" placeholder="Eligible Donation Appr Reqd Cash" data-xml="dona80gpercentapprreqdcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Eligible Donation Appr Reqd Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="" name="dona_80g_percentapprreqdothermode[]" placeholder="Eligible Donation Appr Reqd Other Mode" data-xml="dona80gpercentapprreqdothermode">
                                          </div>
                                        </div>
                                        
                                         <div class="form-group">
                                          <label class="control-label col-sm-3">Total Donation US 80G Cash</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_totaldonationsus80gcash']; ?>" name="dona_80g_totaldonationsus80gcash[]" placeholder="Total Donation US 80G Cash" data-xml="dona80gtotaldonationsus80gcash">
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <label class="control-label col-sm-3">Total Donations Us80G Other Mode</label>
                                          <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?php echo $eachdon100['dona_80g_totaldonationsus80gotherMode']; ?>" name="dona_80g_totaldonationsus80gotherMode[]" placeholder="Total Donations Us80G Other Mode" data-xml="dona80gtotaldonationsus80gotherMode">
                                          </div>
                                        </div>
                                    <!------------------------------------------------- Donation in Cash-BSEN-END ----------------------------------------------------->
                  </div>  
                              </div>
                              <div class="dedDonationHide" id="otherDonationShow">
                                <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-deduction-charityother">
                                  <div class="form-group">
                                    <label class="control-label col-sm-5" for="Other Donations"><strong>Other Donations</strong></label>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="Donation to a Political Party (80GGC)">Donation to a Political Party (80GGC)</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="donPolParty" name="ded_othdon_80ggc_dpp" value="<?php echo $itr_deduction['ded_othdon_80ggc_dpp']; ?>" placeholder="Donation to a Political Party (80GGC)" data-xml="Section80GGC" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="Donation for Scientific Research or Rural Development">Donation for Scientific Research or Rural Development(80GGA)</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" id="donSciRes" name="ded_othdon_80gga_dfsrrd" value="<?php echo $itr_deduction['ded_othdon_80gga_dfsrrd']; ?>" placeholder="Donation for Scientific Research or Rural Development" data-xml="Section80GGA" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                    
                                    
                                    
                                  <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                    <input type="hidden" name="ded_othdon_btn" value="1">
                                    <button type="submit" name="ded_othdon_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <!----- Donation80GGA-START ---->
                            
                            <div class="tab-pane " id="tabDonetion80gga" data-next-tab="#tabOtherDeductions">
                            
                             <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-deduction-80gga" data-required=" [],dona_80gga_addrdetail[],dona_80gga_dpincode[]">
                                  <?php
                                    $don80ggaflag = 0;
                                        if (!empty($itr_donation80gga)) {
                                            foreach ($itr_donation80gga as $eachdon80gga) {
                                                $don80ggaflag = 1; ?>
                  <div class="add_don80gga_div ">                 
                                    <input type="hidden" name="hidcheckdon1000[]" value="<?php echo $eachdon80gga['pk_dona80gga_id']; ?>"/>
                                   <!-- <div class="form-group">
                                      <label class="control-label col-sm-7">Charitable Donation (80GGA)</label>
                                    </div>-->
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Deduction Claimed<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <select name="dona_80g_option[]" class="form-control" data-xml="dona80goption">
                                          <option value="80GGA2a" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2a' ? 'selected' : ''; ?> >80GGA(2)(a) - Sum paid to Research Association or University, college or
                    other institution for Scientific Research</option>
                                          <option value="80GGA2aa" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2aa' ? 'selected' : ''; ?> >80GGA(2)(aa) - Sum paid to Research Association or University, college or
                    other institution for Social science or Statistical Research</option>
                                          <option value="80GGA2b" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2b' ? 'selected' : ''; ?> >80GGA(2)(b) - Sum paid to an association or institution for
                    Rural Development</option>
                                          <option value="80GGA2bb" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2bb' ? 'selected' : ''; ?>>80GGA(2)(bb) - Sum paid to PSU or Local Authority or an association or
                    institution approved by the National Committee for carrying out
                    any eligible project</option>
                                          <option value="80GGA2c" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2c' ? 'selected' : ''; ?>>80GGA(2)(c) - Sum paid to an association or institution for Conservation
                    of Natural Resources or for afforestation</option>
                                          <option value="80GGA2cc" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2cc' ? 'selected' : ''; ?> >80GGA(2)(cc) - Sum paid for Afforestation, to the funds, which are
                    notified by Central Govt</option>
                                          <option value="80GGA2d" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2d' ? 'selected' : ''; ?> >80GGA(2)(d) - Sum paid for Rural Development to the funds, which are
                    notified by Central Govt</option>
                                          <option value="80GGA2e" <?php echo $eachdon80gga['dona_80gga_relevantclsusdedc'] == '80GGA2e' ? 'selected' : ''; ?> >80GGA(2)(e) - Sum paid to National Urban Poverty Eradication Fund as
                    setup and notified by Central Govt</option>
                                        </select>
                                      </div>
                                    </div>  
                                      <div class="form-group">
                                      <label class="control-label col-sm-3">Name of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_dname']; ?>" name="dona_80gga_dname[]" placeholder="Donee name" required data-validation="Alphabets" data-xml="DoneeWithPanName80gga">
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Address<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" required class="form-control" value="<?php echo $eachdon80gga['dona_80gga_addrdetail']; ?>" name="dona_80gga_addrdetail[]" placeholder="Address" data-xml="dona80ggaaddrdetail" maxlength=200>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Town/City/District<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_dcity']; ?>" name="dona_80gga_dcity[]" placeholder="Town/City/District" data-xml="CityOrTownOrDistrict80gga" data-validation="Alphabets" maxlength=50>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">State<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <Select class="form-control" name="dona_80gga_dstate[]" data-xml="StateCode80gga" >
                    <option value="0">Select State</option>
                    <?php foreach ($itr_state as $eachstate) {
                                                    echo '<option value="'.$eachstate['state_code'].'"'.($eachstate['state_code'] == $eachdon80gga['dona_80gga_dstate'] ? 'selected' : ' ').'>'.$eachstate['state_name'].'</option>';
                                                } ?>
                  </Select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Pin code">Pin code<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" required class="form-control" value="<?php echo $eachdon80gga['dona_80gga_dpincode']; ?>" name="dona_80gga_dpincode[]" placeholder="Pin code" data-xml="PinCode80gga" data-validation="PinCode">
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="control-label col-sm-3" of the Donee>PAN of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_dpan']; ?>" name="dona_80gga_dpan[]" placeholder="PAN of the Donee" data-xml="DoneePAN80gga" data-validation="GeneralPAN">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Donation Amount Cash<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_damountcash']; ?>" name="dona_80gga_damountcash[]" placeholder="Donation Amount Cash" data-xml="dona80ggadamountcash" data-validation="Alphabets" maxlength=125>
                                      </div>
                                    </div>                                    
                                  
                                        
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation to Other Mode<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_donationamtothermode']; ?>" name="dona_80gga_donationamtothermode[]" placeholder="Total Donation to Other Mode" data-xml="dona80ggadonationamtothermode" data-validation="14DigitNumber">
                                      </div>
                                    </div>  
                                        
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_donationamt']; ?>" name="dona_80gga_donationamt[]" placeholder="Donation Amount" data-xml="dona80ggadonationamt" data-validation="14DigitNumber">
                                      </div>
                                    </div>  
                                        
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Total Eligible Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_eligibledonationamt']; ?>" name="dona_80gga_eligibledonationamt[]" placeholder="Total Eligible Donation Amount" data-xml="dona80ggaeligibledonationamt" data-validation="14DigitNumber">
                                      </div>
                                    </div>  
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation amt By Other Mode80GGA</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_totaldonationamtotherMode80GGA']; ?>" name="dona_80gga_totaldonationamtotherMode80GGA[]" placeholder="Total Donation amt By Other Mode80GGA" data-xml="dona80ggatotaldonationamtotherMode80GGA">
                                      </div>
                                    </div>
                                      <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation Amount By Cash<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_totaldonationamtcash']; ?>" name="dona_80gga_totaldonationamtcash[]" placeholder="Total Donation Amount By Cash" data-xml="dona80ggatotaldonationamtcash" data-validation="14DigitNumber">
                                      </div>
                                    </div>  
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation U/S</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_totaldonationsus']; ?>" name="dona_80gga_totaldonationsus[]" placeholder="Total Donation U/S" data-xml="dona80ggatotaldonationsus">
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Total Eligible Donation Amount 80GGA</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $eachdon80gga['dona_80gga_totaleligibledonationamt80GGA']; ?>" name="dona_80gga_totaleligibledonationamt80GGA[]" placeholder="Total Eligible Donation Amount 80GGA" data-xml="dona80ggatotaleligibledonationamt80GGA">
                                      </div>
                                    </div>
                                  </div>
                <?php
                                            }
                                        }
                                 ?>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                    <button type="button" class="btn icon-btn btn-success add_don80gga_bttn" >
                                        <span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add Donation with 80GGA
                                    </button>
                                    </label>
                                  </div> 
                                  <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                    <input type="hidden" name="ded_don80gga_btn" value="1">
                                    <button type="submit" name="ded_don80gga_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </form>                                
                            </div>
                              
                            <div class="add_don80gga_div hide">                 
                                    <input type="hidden" name="hidcheckdon1000[]" value="<?php echo $eachdon80gga['pk_dona80gga_id']; ?>"/>
                                   <!-- <div class="form-group">
                                      <label class="control-label col-sm-7">Charitable Donation (80GGA)</label>
                                    </div>-->
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Deduction Claimed<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <select name="dona_80g_option[]" class="form-control" data-xml="dona80goption">
                                          <option value="80GGA2a" >80GGA(2)(a) - Sum paid to Research Association or University, college or
                    other institution for Scientific Research</option>
                                          <option value="80GGA2aa" >80GGA(2)(aa) - Sum paid to Research Association or University, college or
                    other institution for Social science or Statistical Research</option>
                                          <option value="80GGA2b" >80GGA(2)(b) - Sum paid to an association or institution for
                    Rural Development</option>
                                          <option value="80GGA2bb" >80GGA(2)(bb) - Sum paid to PSU or Local Authority or an association or
                    institution approved by the National Committee for carrying out
                    any eligible project</option>
                                          <option value="80GGA2c">80GGA(2)(c) - Sum paid to an association or institution for Conservation
                    of Natural Resources or for afforestation</option>
                                          <option value="80GGA2cc" >80GGA(2)(cc) - Sum paid for Afforestation, to the funds, which are
                    notified by Central Govt</option>
                                          <option value="80GGA2d"  >80GGA(2)(d) - Sum paid for Rural Development to the funds, which are
                    notified by Central Govt</option>
                                          <option value="80GGA2e" >80GGA(2)(e) - Sum paid to National Urban Poverty Eradication Fund as
                    setup and notified by Central Govt</option>
                                        </select>
                                      </div>
                                    </div>  
                                      <div class="form-group">
                                      <label class="control-label col-sm-3">Name of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_dname[]" placeholder="Donee name" required data-validation="Alphabets" data-xml="DoneeWithPanName80gga">
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Address<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" required class="form-control" value="" name="dona_80gga_addrdetail[]" placeholder="Address" data-xml="dona80ggaaddrdetail" maxlength=200>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Town/City/District<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_dcity[]" placeholder="Town/City/District" data-xml="CityOrTownOrDistrict80gga" data-validation="Alphabets" maxlength=50>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">State<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <Select class="form-control" name="dona_80gga_dstate[]" data-xml="StateCode80gga" >
                    <option value="0">Select State</option>
                    <?php foreach ($itr_state as $eachstate) {
                                      echo '<option value="'.$eachstate['state_code'].'">'.$eachstate['state_name'].'</option>';
                                  }
                                        ?>
                  </Select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="Pin code">Pin code<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" required class="form-control" value="" name="dona_80gga_dpincode[]" placeholder="Pin code" data-xml="PinCode80gga" data-validation="PinCode">
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="control-label col-sm-3" of the Donee>PAN of the Donee<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_dpan[]" placeholder="PAN of the Donee" data-xml="DoneePAN80gga" data-validation="GeneralPAN">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Donation Amount Cash<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_damountcash[]" placeholder="Donation Amount Cash" data-xml="dona80ggadamountcash" data-validation="Alphabets" maxlength=125>
                                      </div>
                                    </div> 
                                
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation to Other Mode<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_donationamtothermode[]" placeholder="Total Donation to Other Mode" data-xml="80ggaothermode" data-validation="14DigitNumber">
                                      </div>
                                    </div>  
                                        
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_donationamt[]" placeholder="Donation Amount" data-xml="dona80ggadonationamt" data-validation="14DigitNumber">
                                      </div>
                                    </div>  
                                        
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Total Eligible Donation Amount<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_eligibledonationamt[]" placeholder="Total Eligible Donation Amount" data-xml="dona80ggaeligibledonationamt" data-validation="14DigitNumber">
                                      </div>
                                    </div>  
                                                                    
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation Amount By Cash<span class="red"> *</span></label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_totaldonationamtcash[]" placeholder="Total Donation Amount By Cash" data-xml="dona80ggatotaldonationamtcash" data-validation="14DigitNumber">
                                      </div>
                                    </div>                
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation amt By Other Mode80GGA</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_totaldonationamtotherMode80GGA[]" placeholder="Total Donation amt By Other Mode80GGA" data-xml="dona80ggatotaldonationamtotherMode80GGA">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3">Total Donation U/S</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_totaldonationsus[]" placeholder="Total Donation U/S" data-xml="dona80ggatotaldonationsus">
                                      </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="control-label col-sm-3">Total Eligible Donation Amount 80GGA</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" value="" name="dona_80gga_totaleligibledonationamt80GGA[]" placeholder="Total Eligible Donation Amount 80GGA" data-xml="dona80ggatotaleligibledonationamt80GGA">
                                      </div>
                                    </div>
                                  </div>
                            
                            <!----- Donation80GGA-END ------>
                            
                            <!-- Other Deductions -->
                            <div class="tab-pane " id="tabOtherDeductions" data-next-tab="#tabTaxRecon">
                              <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-deductions-other">             
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="Deduction for Personal Disability (80U)">Deduction for Personal Disability (80U)</label>
                                  <div class="col-sm-9">
                  <select name="ded_othd_80u_type"  class="form-control" data-xml="Section80UUsrType">
                    <option value="1" <?php echo $itr_deduction['ded_othd_80u_type'] == 1 ? 'selected' : ''; ?>>Self with disability</option>
                    <option value="2" <?php echo $itr_deduction['ded_othd_80u_type'] == 2 ? 'selected' : ''; ?>>Self with severe disability</option>
                  </select>
                  <br /><br />  
                                    <input type="text" class="form-control"  name="ded_othd_80u" value="<?php echo $itr_deduction['ded_othd_80u']; ?>" placeholder="Deduction for Personal Disability" data-xml="Section80U" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="Deduction for Disabled Dependents (80DD)">Deduction for Disabled Dependents (80DD)</label>
                                  <div class="col-sm-9">
                  <select name="ded_othd_80dd_type"  class="form-control" data-xml="Section80DDUsrType">
                    <option value="1" <?php echo $itr_deduction['ded_othd_80dd_type'] == 1 ? 'selected' : ''; ?>>Dependent with disability</option>
                    <option value="2" <?php echo $itr_deduction['ded_othd_80dd_type'] == 2 ? 'selected' : ''; ?>>Dependent with severe disability</option>
                  </select>
                  <br /> <br />                 
                                    <input type="text" class="form-control"  name="ded_othd_80dd" value="<?php echo $itr_deduction['ded_othd_80dd']; ?>" placeholder="Deduction for Disabled Dependents" data-xml="Section80DD" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="Section 80DDB">Section 80DDB</label>
                                  <div class="col-sm-9">
                  <select name="ded_othd_80ddb_type" class="form-control" data-xml="Section80DDBUsrType">
                    <option value="1" <?php echo $itr_deduction['ded_othd_80ddb_type'] == 1 ? 'selected' : ''; ?>>Self Or Dependent</option>
                    <option value="2" <?php echo $itr_deduction['ded_othd_80ddb_type'] == 2 ? 'selected' : ''; ?>>Self Or Dependent - Senior Citizen</option>
                    <!-- <option value="3" <?php //echo $itr_deduction['ded_othd_80ddb_type'] == 3 ? 'selected' : ''; ?>>Self Or Dependent - Super Senior Citizen</option>                    -->
                  </select>
                  <br /> <br />                   
                                    <input type="text" class="form-control"  name="ded_othd_80ddb" value="<?php echo $itr_deduction['ded_othd_80ddb']; ?>" placeholder="Section 80DDB" data-xml="Section80DDB">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="Section 80E">Section 80E</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="ded_othd_80e" value="<?php echo $itr_deduction['ded_othd_80e']; ?>" placeholder="Section 80E" data-xml="Section80E" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="Section 80EE">Section 80EE</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="ded_othd_80ee" value="<?php echo $itr_deduction['ded_othd_80ee']; ?>" placeholder="Section 80EE"  data-xml="Section80EE" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="">Royalty received on books- 80QQB</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="ded_othd_80qqb" value="<?php echo $itr_deduction['ded_othd_80qqb']; ?>" placeholder="" data-xml="Section80QQB" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="">Income on Patents/invention- 80RRB</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="ded_othd_80rrb" value="<?php echo $itr_deduction['ded_othd_80rrb']; ?>" placeholder="" data-xml="Section80RRB" data-validation="14DigitNumber">
                                  </div>
                                </div>
                                <div class="form-group">
                                 <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                  <input type="hidden" name="ded_othdedu_btn" value="1">
                                  <button type="submit" name="ded_othdedu_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Tax Reconciliation  -->
                <div class="tab-pane " id="tabTaxRecon">
                  <!-- Tax Reconciliation TODO -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabTDS" data-toggle="tab">TDS</a></li>
                            <li><a href="#tabtaxPaid" data-toggle="tab">Taxes paid</a></li>
                            <li class="<?php if ($_REQUEST['activeTab'] == 'tabTaxReconsilation') {
                                      echo 'active';
                                  } ?>"><a href="#tabTaxReconsilation" data-toggle="tab">Tax reconcilation</a></li>
                          </ul>
                        </div>
                        <div class="panel-body">
                          <div class="tab-content">
                            <div class="tab-pane  active" id="tabTDS" data-next-tab="#tabtaxPaid">
                              <div class="row">
                                <div class="col-md-12">
                                    <!----------------------------------- 20190315-BSEN-START------------------------------------->
                                    <div class="panel with-nav-tabs panel-default">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tdsonsal" data-toggle="tab">TDS on Salary</a></li>
                                                <li><a  href="#schtcs" data-toggle="tab">Schedule TCS</a></li>
                                            </ul>
                                        </div>
                                            <div class="panel-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane  active" id="tdsonsal" data-next-tab="#schtcs">
                                                        <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-reconcile-tds">
                                                          <?php
                                                          /*echo "itr_taxreconci_tdsothsal";
                                                          print_r($itr_taxreconci_tdsothsal);*/
                                                          //echo "<br>";
                                                            if (!empty($itr_taxreconci_tdsothsal)) {
                                                                foreach ($itr_taxreconci_tdsothsal as $eachtdsothsal) {
                                                                    ?>
                                                        <div class="add_taxrecotds_div form_container"> 
                                                        <div class="form-group">
                                                          <label class="control-label col-sm-5"><strong>TDS other than salary</strong></label>
                                                        </div>                
                                                          <input type="hidden" name="hidchecktdsothsal[]" value="<?php echo $eachtdsothsal['pk_recotdsothsal_id']; ?>"/>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-3">TAN of the deductor</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" value="<?php
                                                                echo $eachtdsothsal['reco_tdsothsal_tanoded']; ?>" placeholder="TAN of the deductor" name="reco_tdsothsal_tanoded[]" placeholder="TAN" data-xml="TAN" required data-validation="TAN">
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-3">Name Of the deductor</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" placeholder="Name Of the deductor" class="form-control" value="<?php
                                                                    echo $eachtdsothsal['reco_tdsonsal_nameodedu']; ?>" name="reco_tdsonsal_nameodedu[]" placeholder="" data-xml="EmployerOrDeductorOrCollecterName"  maxlength=125 required>
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-3">TDS deducted</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" value="<?php
                                                                    echo $eachtdsothsal['reco_tdsothsal_tdsdeduc']; ?>" placeholder="TDS deducted" name="reco_tdsothsal_tdsdeduc[]" placeholder="" data-validation="14DigitNumber" data-xml="TotTDSOnAmtPaid" required>
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-3">TDS claimed</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" value="<?php
                                                                echo $eachtdsothsal['reco_tdsothsal_tdsclaim']; ?>" placeholder="TDS claimed" name="reco_tdsothsal_tdsclaim[]" data-xml="ClaimOutOfTotTDSOnAmtPaid" data-validation="14DigitNumber" required>
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-3">Gross receipts as per 26AS</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" value="<?php
                                                                echo $eachtdsothsal['reco_tdsothsal_rec26as']; ?>" placeholder="Gross receipts as per 26AS" name="reco_tdsothsal_rec26as[]" placeholder="" data-xml="AmtForTaxDeduct" data-validation="14DigitNumber" required>
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-3" >Year in which TDS deducted</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" placeholder="YYYY" value="<?php
                                                                echo $eachtdsothsal['reco_tdsothsal_yeartdsdedu']; ?>" name="reco_tdsothsal_yeartdsdedu[]" placeholder="YYYY" data-xml="DeductedYr" required>
                                                            </div>
                                                          </div>
                                                          </div>
                                                          <?php
                                                                }
                                                            }?>               
                                                        <div class="form-group">
                                                          <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                                          <button type="button" class="btn icon-btn btn-success add_taxrecotds_btn"><span class="glyphicon btn-glyphicon glyphicon-plus "></span>Add TDS other than salary</button>
                                                          </label>
                                                        </div>
                                                          <?php
                                                          //print_r($itr_taxreconci_tdsrent);
                                                          //echo "pk_recotdsrent_id:-".$itr_taxreconci_tdsrent['pk_recotdsrent_id'];
                                                            if (!empty($itr_taxreconci_tdsrent)) {
                                                                foreach ($itr_taxreconci_tdsrent as $eachtdsrent) {
                                                                    ?>                  
                                                            <div class="add_renttds_div form_container" data-xml="TDSDtls26QC">
                                                        <div class="form-group">
                                                          <label class="control-label col-sm-5"><strong>TDS on rent by the tenant</strong></label>
                                                        </div>                    
                                                                 <input type="hidden" name="hidchecktdsrent[]" value="<?php
                                                                echo $eachtdsrent['pk_recotdsrent_id']; ?>">
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">Name of the tenant</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtdsrent['reco_tdsonrent_name']; ?>" name="reco_tdsonrent_name[]" placeholder="Name of the tenant" data-xml="NameOfTenant" data-validation="Alphabets">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">PAN of the tenant</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtdsrent['reco_tdsonrent_pan']; ?>" name="reco_tdsonrent_pan[]" placeholder="PAN No" data-xml="PANofTenant" data-validation="PAN">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">Amount on which TAX is deducted</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtdsrent['reco_tdsonrent_amnt']; ?>" name="reco_tdsonrent_amnt[]" placeholder="Amount" data-xml="AmtForTaxDeduct" data-validation="14DigitNumber">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">TAX deducted(TDS)</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" placeholder="TAX deducted(TDS)" value="<?php
                                                                echo $eachtdsrent['reco_tdsonrent_deduc']; ?>"  name="reco_tdsonrent_deduc[]" data-xml="TotTDSOnAmtPaid" data-validation="14DigitNumber">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">TDS claimed</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" placeholder="TDS claimed" class="form-control" value="<?php
                                                                echo $eachtdsrent['reco_tdsonrent_claimed']; ?>" name="reco_tdsonrent_claimed[]" placeholder="" data-xml="ClaimOutOfTotTDSOnAmtPaid" data-validation="14DigitNumber">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">Year OF TDS deduction</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" placeholder="YYYY" class="form-control" value="<?php
                                                                echo $eachtdsrent['reco_tdsonrent_year']; ?>" name="reco_tdsonrent_year[]" placeholder="YYYY" data-xml="DeductedYr">
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <?php
                                                                }
                                                            } ?>                  
                                                        <div class="form-group">
                                                          <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                                          <button type="button" class="btn icon-btn btn-success add_renttds_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add more TDS on rent</button>
                                                          </label>
                                                        </div>                
                                                        <div class="form-group">
                                                         <div class="col-sm-4 col-sm-offset-2">
                                                            <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                                          </div>
                                                          <?php
                                                            if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                                                ?>
                                                              <div class="col-sm-6">
                                                               <input type="hidden" name="tax_recon_btn" value="1">
                                                               <button type="submit" name="tax_recon_btn1" class="btn btn-success pull-right">Submit</button>
                                                              </div>
                                                          <?php
                                                            }
                                                          ?>
                                                        </div>
                                                      </form>
                                                    </div> 
                                                     <div class="tab-pane" id="schtcs"  data-next-tab="#tabBankdetail">
                                                         <!----------------------------------- Schedule-TCS-START ------------------------------------->
                                                         <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-reconcile-tcs">
                                                          <?php
                                                            if (!empty($itr_taxreconci_tcs)) {
                                                                foreach ($itr_taxreconci_tcs as $eachtcs) {
                                                                    ?>                  
                                                            <div class="add_tcs_div form_container" data-xml="scheduletcs">
                                                                <div class="form-group">
                                                                  <label class="control-label col-sm-5"> <strong>Schedule TCS</strong> </label>
                                                                </div>                    
                                                                 <input type="hidden" name="hidchecktcsrent[]" value="<?php
                                                                echo $eachtdsrent['pk_recotdsrent_id']; ?>">
                                                            <div class="form-group">
                                                                <input type="hidden" name="reco_tcs_tan[]" value="<?php echo $eachtdsrent['reco_tcs_tan']; ?>">
                                                                <label class="control-label col-sm-3">TAN</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtcs['reco_tcs_employerordeductororcollectername']; ?>" name="reco_tcs_employerordeductororcollectername[]" placeholder="TAN" data-xml="reco_tcs_employerordeductororcollectername">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-3">Employer Name</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtcs['reco_tcs_employerordeductororcollectername']; ?>" name="reco_tcs_employerordeductororcollectername[]" placeholder="Employer Name" data-xml="reco_tcs_employerordeductororcollectername">
                                                                </div>
                                                              </div>
                                                               <div class="form-group">
                                                                <label class="control-label col-sm-3">TAX Amount</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtcs['reco_tcs_amttaxcollected']; ?>" name="reco_tcs_amttaxcollected[]" placeholder="Year" data-xml="reco_tcs_collectedyr" 
                                                                         data-validation="reco_tcs_collectedyr">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">TAX Collected  Year</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtcs['reco_tcs_collectedyr']; ?>" name="reco_tcs_collectedyr[]" placeholder="Year" data-xml="reco_tcs_collectedyr" 
                                                                         data-validation="reco_tcs_collectedyr">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">Total TCS</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtcs['reco_tcs_totaltcs']; ?>" name="reco_tcs_totaltcs[]" placeholder="TCS" data-xml="reco_tcs_totaltcs" data-validation="reco_tcs_totaltcs">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">Amount TCS Claimed This Year</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="<?php
                                                                echo $eachtcs['reco_tcs_amttcsclaimedthisyear']; ?>" name="reco_tcs_amttcsclaimedthisyear[]" placeholder="Amount Claimed" data-xml="reco_tcs_amttcsclaimedthisyear">
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <?php
                                                              }
                                                            } 
                                                            ?>                  
                                                            <div class="form-group">
                                                              <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                                              <button type="button" class="btn icon-btn btn-success add_tcs_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add more TCS</button>
                                                              </label>
                                                            </div>                
                                                            <div class="form-group">
                                                             <div class="col-sm-4 col-sm-offset-2">
                                                                <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                                              </div>
                                                              <?php
                                                              if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                                                  ?>
                                                              <div class="col-sm-6">
                                                               <input type="hidden" name="tax_tcs_btn" value="1">
                                                                <button type="submit" name="tax_tcs_btn1" class="btn btn-success pull-right">Submit</button>
                                                              </div>
                                                              <?php
                                                              }
                                                              ?>
                                                            </div>
                                                        </form> 
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                              </div> 
                                  <!----------------------------------- Schedule-TCS-END ------------------------------------->
                                     <!------------------------------------------------------------------------------------------------------->
                                    <div class="add_tcs_div hide form_container" data-xml="scheduletcs">
                                       <div class="form-group">
                                                                  <label class="control-label col-sm-5"><strong>Schedule TCS</strong></label>
                                                                </div>                    
                                                                 
                                                            <div class="form-group">
                                                                <input type="hidden" name="reco_tcs_tan[]" value="">
                                                                <label class="control-label col-sm-3">TAN</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="" name="reco_tcs_employerordeductororcollectername[]" placeholder="TAN" data-xml="reco_tcs_employerordeductororcollectername">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-sm-3">Employer Name</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="" name="reco_tcs_employerordeductororcollectername[]" placeholder="Employer Name" data-xml="reco_tcs_employerordeductororcollectername">
                                                                </div>
                                                              </div>
                                                               <div class="form-group">
                                                                <label class="control-label col-sm-3">TAX Amount</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="" name="reco_tcs_amttaxcollected[]" placeholder="Year" data-xml="reco_tcs_collectedyr" 
                                                                         data-validation="reco_tcs_collectedyr">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">TAX Collected  Year</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="" name="reco_tcs_collectedyr[]" placeholder="Year" data-xml="reco_tcs_collectedyr" 
                                                                         data-validation="reco_tcs_collectedyr">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">Total TCS</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="" name="reco_tcs_totaltcs[]" placeholder="TCS" data-xml="reco_tcs_totaltcs" data-validation="reco_tcs_totaltcs">
                                                                </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label col-sm-3">Amount TCS Claimed This Year</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" value="" name="reco_tcs_amttcsclaimedthisyear[]" placeholder="Amount Claimed" data-xml="reco_tcs_amttcsclaimedthisyear">
                                                                </div>
                                                              </div>                     
                                   </div>    
                                
                                <!------------------------------------------------------------------------------------------------------->
                               
                               
                <div class="add_renttds_div hide form_container" data-xml="TDSDtls26QC">
                  <div class="form-group">
                    <label class="control-label col-sm-5">TDS on rent by the tenant</label>
                  </div>                
                                     <input type="hidden" name="hidchecktdsrent[]" value="">
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">Name of the tenant</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="reco_tdsonrent_name[]" placeholder="Name of the tenant" data-xml="NameOfTenant" data-validation="Alphabets">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">PAN of the tenant</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="reco_tdsonrent_pan[]" placeholder="PAN No" data-xml="PANofTenant" data-validation="PAN">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">Amount on which TAX is deducted</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="reco_tdsonrent_amnt[]" placeholder="Amount" data-xml="AmtForTaxDeduct" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">TAX deducted(TDS)</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="reco_tdsonrent_deduc[]" data-xml="TotTDSOnAmtPaid" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">TDS claimed</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="reco_tdsonrent_claimed[]" placeholder="" data-xml="ClaimOutOfTotTDSOnAmtPaid" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">Year OF TDS deduction</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="reco_tdsonrent_year[]" placeholder="YYYY-YY" data-xml="DeductedYr">
                                    </div>
                                  </div>
                                </div>
                  <div class="add_taxrecotds_div hide form_container">
                                <div class="form-group">
                                  <label class="control-label col-sm-5"><strong>TDS other than salary</strong></label>
                                </div>                  
                                  <input type="hidden" name="hidchecktdsothsal[]" value=""/>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">TAN of the deductor</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="reco_tdsothsal_tanoded[]" placeholder="TAN" data-validation="TAN">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">Name Of the deductor</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="Name Of the deductor" name="reco_tdsonsal_nameodedu[]" placeholder="Name" data-validation="Alphabets" maxlength=125>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">TDS deducted</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="TDS deducted" name="reco_tdsothsal_tdsdeduc[]" placeholder="TDS deducted" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">TDS claimed</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="TDS claimed" name="reco_tdsothsal_tdsclaim[]" data-validation="14DigitNumber" placeholder="TDS claimed">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">Gross receipts as per 26AS</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="Gross receipts as per 26AS" name="reco_tdsothsal_rec26as[]" placeholder="Gross receipts as per 26AS" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3">Year in which TDS deducted</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" placeholder="YYYY" name="reco_tdsothsal_yeartdsdedu[]" placeholder="YYYY-YY" data-validation="Number" maxlength=4>
                                    </div>
                                  </div>
                                </div>
                <div class="add_taxrectds_div hide form_container">
                  <div class="form-group"><label class="control-label col-sm-3"><strong>TDS on salary</strong></label></div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="">TAN of the deductor</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="" name="sou_sa_tan_no" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="">Name Of the employer</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="" name="sou_sa_employer_name" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="">TDS deducted</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="" name="sou_sa_tds_on_sal" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="">Net Salary</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="" name="sou_sa_ntslary" readonly>
                    </div>
                  </div>
                </div>                
                            </div>
                            <div class="tab-pane" id="tabtaxPaid">
                              <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" id="form-rencile-taxpaid">
                                  <?php
                                        if (!empty($itr_taxreconci_taxpaid_advan)) {
                                            foreach ($itr_taxreconci_taxpaid_advan as $eachtaxadvan) {
                                                ?>
                                <div class="add_taxrecotaxpaidadvan_div form_container" data-xml="TaxPayment">  
                                <div class="form-group">
                                  <label class="control-label col-sm-5"> Advance Taxes Paid </label>
                                </div>                
                                  <input type="hidden" name="hidchecktaxadvan[]" value="<?php echo $eachtaxadvan['pk_taxpaidadvan_id']; ?>"/>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">BSR code of the bank</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  value="<?php echo $eachtaxadvan['reco_txpaidadv_bsrcodobnk']; ?>" name="reco_txpaidadv_bsrcodobnk[]" placeholder="" data-xml="BSRCode" data-validation="BSRCode" maxlength=7>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Date of deposit</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control date-picker-itr-style"  data-date-format="yyyy-mm-dd" value="<?php echo $eachtaxadvan['reco_txpaidadv_dateodepos']; ?>" name="reco_txpaidadv_dateodepos[]" placeholder="" data-xml="DateDep">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Challan Serial Number</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  value="<?php echo $eachtaxadvan['reco_txpaidadv_challsrno']; ?>" name="reco_txpaidadv_challsrno[]" data-xml="SrlNoOfChaln" data-validation="challan" maxlength=7>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Amount</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  value="<?php echo $eachtaxadvan['reco_txpaidadv_amount']; ?>" name="reco_txpaidadv_amount[]" data-xml="Amt">
                                    </div>
                                  </div>
                  </div>
                                  <?php
                                            }
                                        } ?>  
                                <div class="form-group">
                                  <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                  <button type="button" class="btn icon-btn btn-success add_taxrecotaxpaidadvan_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add advance tax paid</button>
                                  </label>
                                </div>
                                  <?php
                                    if (!empty($itr_taxreconci_selfasstaxpaid)) {
                                        foreach ($itr_taxreconci_selfasstaxpaid as $eachselfasspd) {
                                            ?>
                                <div class="add_taxrecoselftxpid_div form_container">
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="">Self Assessement taxes paid </label>
                                </div>                
                                  <input type="hidden" name="hidchecselfasspd[]" value="<?php echo $eachselfasspd['pk_selfasstxpd_id']; ?>"/>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">BSR code of the bank</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  value="<?php echo $eachselfasspd['reco_selfasstxpd_bsrcodobnk']; ?>" name="reco_selfasstxpd_bsrcodobnk[]" placeholder="" data-xml="BSRCode" data-validation="BSRCode" maxlength=>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Date of deposit</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control date-picker-itr-style" data-date-format="yyyy-mm-dd"  value="<?php echo $eachselfasspd['reco_selfasstxpd_dateodepos']; ?>" name="reco_selfasstxpd_dateodepos[]" placeholder="" data-xml="DateDep">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Challan Serial Number</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  value="<?php echo $eachselfasspd['reco_selfasstxpd_challsrno']; ?>" name="reco_selfasstxpd_challsrno[]"  data-xml="SrlNoOfChaln">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Amount</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  value="<?php echo $eachselfasspd['reco_selfasstxpd_amount']; ?>" name="reco_selfasstxpd_amount[]" data-xml="Amt">
                                    </div>
                                  </div>
                  </div>
                                  <?php
                                        }
                                    } ?>
                                <div class="form-group">
                                  <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                  <button type="button" class="btn icon-btn btn-success add_taxrecoselftxpid_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add self assessement tax</button>
                                  </label>
                                </div>
                                <div class="form-group">
                                 <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">
                                  <input type="hidden" name="taxreco_taxpaid_btn" value="1">
                                  <button type="submit" name="taxreco_taxpaid_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </form>
                  <div class="add_taxrecoselftxpid_div hide form_container">
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for=""><strong>Self Assessement taxes paid</strong></label>
                                </div>                  
                                  <input type="hidden" name="hidchecselfasspd[]" value="0"/>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">BSR code of the bank</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  name="reco_selfasstxpd_bsrcodobnk[]" placeholder="" data-validation="BSRCode" data-xml="BSRCode" maxlength=7>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Date of deposit</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control date-picker-itr-style" value="08/11/2018" data-date-format="yyyy-mm-dd"  name="reco_selfasstxpd_dateodepos[]" placeholder="" data-xml="DateDep">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Challan Serial Number</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  name="reco_selfasstxpd_challsrno[]" data-xml="SrlNoOfChaln" data-validation="challan" maxlength=5>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Amount</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  name="reco_selfasstxpd_amount[]" data-xml="Amt" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                                </div>  
                                <div class="add_taxrecotaxpaidadvan_div form_container hide" data-xml="TaxPayment"> 
                                <div class="form-group">
                                  <label class="control-label col-sm-5"><strong>Advance Taxes Paid</strong></label>
                                </div>                  
                                  <input type="hidden" name="hidchecktaxadvan[]" value=""/>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">BSR code of the bank</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  name="reco_txpaidadv_bsrcodobnk[]" placeholder="BSR code" data-validation="BSRCode" data-xml="BSRCode" maxlength=7>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Date of deposit</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control date-picker-itr-style"  data-date-format="yyyy-mm-dd" value="" name="reco_txpaidadv_dateodepos[]" placeholder="" data-xml="DateDep">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Challan Serial Number</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  name="reco_txpaidadv_challsrno[]" placeholder="Challan Serial Number" data-xml="SrlNoOfChaln" data-validation="challan" maxlength=5>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="">Amount</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control"  name="reco_txpaidadv_amount[]" data-xml="Amt" data-validation="14DigitNumber">
                                    </div>
                                  </div>
                 </div>                 
                            </div>
                            <div class="tab-pane <?php if ($_REQUEST['activeTab'] == 'tabTaxReconsilation') {
                                      echo 'active';
                                  } ?>" id="tabTaxReconsilation">
                                  <?php
                                    
                                  ?>
                              <div class="row">
                                <div class="col-xs-12">
                                  <form autocomplete="off" method="post" name="form26asform" id="form26asform" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="">Upload 26AS <code>Optional</code></label>
                                      <div class="col-sm-9">
                                        <input name="form26asFile" type="file" class="btn btn-success" value="Upload Form 26AS" />
                                        <br />
<!--                                         <input name="file_pass" type="password" value="" placeholder="PDF Password" />
 -->                                        <br />
                                        <input type="hidden" name="formsDataID" id="formsDataID" value="<?php echo $_SESSION[$CONFIG->sessionPrefix.'_ITR_ID']; ?>" />
                                        <br />
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="">&nbsp;</label>
                                      <div class="col-sm-9">
<!--                                         <button type="submit"  class="btn btn-success">SUBMIT</button>
 -->                                        <div class="col-xs-9 pull-right hide" id="form_26_loader">
                                          <div id="fetchProgressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87">
                                            <div id="fetchProgressbarInner" class="ui-progressbar-value ui-widget-header ui-corner-left progress-bar progress-bar-success" style="width: 77%;"><strong>Uploading Form 26AS .....</strong></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                              
                              <?php if ($itr_pay['pay_status'] == 0) {
                                  ?>
                                <form autocomplete="off" class="form-horizontal" action="?module_interface=<?php  echo $commonFunction->setPage('pay/itr_paymentdetails'); ?>" method="POST">
                              <?php
                              } elseif ($itr_pay['pay_status'] == 1) {
                                  ?>
                               <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" onSubmit="ajaxFormSubmit(this,'','');return false;"> 
                              <?php
                              } ?>
                              
                              
                            <div class="form-group">
                              <label class="control-label col-sm-3 chead" for=""><code><strong>Deductor Details</strong></code></label>
                            </div>
                            <div class="add_taxreconcil_div">
                              <?php
                                                                    $tot_tds = 0;
                                                                    if (!empty($itr_taxreconciliation)) {
                                                                        foreach ($itr_taxreconciliation as $eachreconcil) {
                                                                            ?>
                              <input type="hidden" name="hidcheckreconcil[]" value="<?php echo $eachreconcil['pk_reconci_id']; ?>"/>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">Name of the deductor</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  value="<?php echo $eachreconcil['reco_reconci_nameodeduc']; ?>" name="reco_reconci_nameodeduc[]" placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">TAN of the deductor</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  value="<?php echo $eachreconcil['reco_reconci_tanodeduc']; ?>" name="reco_reconci_tanodeduc[]" placeholder="TAN">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">Total amount credited</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  value="<?php echo $eachreconcil['reco_reconci_totamtcre']; ?>" name="reco_reconci_totamtcre[]" placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">Total TDS Deposited</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  value="<?php echo $eachreconcil['reco_reconci_tottdsdop']; ?>" name="reco_reconci_tottdsdop[]" placeholder="">
                                </div>
                              </div>
                              <?php $tot_tds = $eachreconcil['reco_reconci_tottdsdop'];
                                                                        }
                                                                    } else {
                                                                        ?>
                              <input type="hidden" name="hidcheckreconcil[]" value="0"/>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">Name of the deductor</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  name="reco_reconci_nameodeduc[]" placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">TAN of the deductor</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  name="reco_reconci_tanodeduc[]" placeholder="TAN">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">Total amount credited</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  name="reco_reconci_totamtcre[]" placeholder="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="">Total TDS Deposited</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control"  name="reco_reconci_tottdsdop[]" placeholder="">
                                </div>
                              </div>
                              <?php
                                                                    } ?>
                            </div>
                            <!--<div class="form-group">
                                                                <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                                                    <button type="button" class="btn icon-btn btn-success add_taxreconcil_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Auto add deductor</button>
                                                                </label>
                                                            </div>-->
                            <div class="form-group">
                              <label class="control-label col-sm-5 chead" for=""><code><strong>TDS match / mismatch</strong></code></label>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="">Total TDS on 26AS</label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control"  name="" placeholder="" value="<?php echo $tot_tds; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="">Total TDS as per your submission</label>
                              <div class="col-sm-9">
                                <input type="text" name="t11" class="form-control"  name="" value="<?php echo $tot_tds1; ?>" />
                              </div>
                            </div>
                            <div class="col-sm-9 col-sm-offset-3">
                              <div class="alert alert-info"> <strong>TDS match/mismatch!</strong> Lets go/ Contact CA <br>
                                <label class="radio-inline">
                                <button style="margin-top:5%;" class="btn btn-info">Go Next/Contact CA</button>
                                </label>
                              </div>
                            </div>
                            <div class="form-group">
                             <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                              <?php
                                  //if($_SESSION['itr_status']  == 0 || isset($_SESSION['itr_status'])   ==  "" || isset($_REQUEST['new'])) {
                                  ?>
                              <div class="col-sm-6">
<!--                               <input type="text" name="taxreconcil_btn" value="1">
                             <input type="text" name="payamt" value="<?php echo $itr_pay_amount;?>">
                              <!-- <button type="submit" name="taxreconcil_btn1" class="btn btn-success pull-right">Submit</button> -->
                              
                              <?php if ($itr_pay['pay_status'] == 0) {
                                  ?>
                              <button type="submit" name="taxreconcil_btn1" class="btn btn-success pull-right">Proceed to FIle</button>
                              <?php
                               } elseif ($itr_pay['pay_status'] == 1) {
                                  ?>
                                  <button type="submit" name="taxreconcil_btn1" class="btn btn-success pull-right">Submit</button>
                                  <?php
                              } ?>
                              </div>
                            </div>
                                </form>
                                                                                                              
                            </div>
                          </div>                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Tax Filling  -->
                <div class="tab-pane" <?php if ($_REQUEST['activeTab'] == 'tabTAXFilling') {
                                  echo 'active';
                              } ?>  id="tabTAXFilling">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel with-nav-tabs panel-default">
                        <div class="panel-heading">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabBankdetail" data-toggle="tab">Bank Detail</a></li>
                            <li><a href="#revTAXfile" data-toggle="tab">Review and TAX File</a></li>
                          </ul>
                        </div>
                        <div class="panel-body">
                          <div class="tab-content">
                            <!-- Review and TAX File -->
                            <div class="tab-pane " id="revTAXfile">
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Particulars</th>
                                    <th>Amount</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>Income chargeable under salary</td>
                                    <td>RS. <span class="income_chargable_under_salary"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Income chargeable under house property</td>
                                    <td>RS. <span class="income_chargable_house_property"></span></td>
                                  </tr>
                                  <!-- <tr>
                                    <td>Income chargeable under capital gain</td>
                                    <td>RS. <span>0</span></td>
                                  </tr>
                                  <tr>
                                    <td>Profit (or) gains from business and profession</td>
                                    <td>RS. <span>0</span></td>
                                  </tr> -->
                                  <tr>
                                    <td>Income from other sources</td>
                                    <td>RS. <span class="income_other_sources"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Gross Total Income</td>
                                    <td>RS. <span class="gross_total_income"></span></td>
                                  </tr>
                                  <tr>
                                    <td>80C and Other Deductions</td>
                                    <td>RS. <span class="total_deduction"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Total Taxable Income</td>
                                    <td>Rs. <span class="total_taxable_income"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Tax on total income</td>
                                    <td>RS. <span class="tax_on_total_income"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Rebate</td>
                                    <td>RS. <span class="rebate"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Tax after rebate</td>
                                    <td>RS. <span class="tax_after_rebate"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Cess</td>
                                    <td>RS. <span class="cess"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Total tax payable</td>
                                    <td>RS. <span class="total_tax_payable"></span></td>
                                  </tr>                 
                                  <tr>
                                    <td>Total taxes paid</td>
                                    <td>RS. <span class="total_taxes_paid"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Interest 234A</td>
                                    <td>RS. <span class="interest_234A"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Interest 234B</td>
                                    <td>RS. <span class="interest_234B"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Interest 234C</td>
                                    <td>RS. <span class="interest_234C"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Fee u/s 234F</td>
                                    <td>RS. <span class="fee_234F"></span></td>
                                  </tr>                 
                                  <tr>
                                    <td>Refund Receivable</td>
                                    <td>Rs. <span class="refund_receivable"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Balance Tax to be Paid</td>
                                    <td>Rs. <span class="balance_tax_to_be_paid"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Self Assesment Tax Paid</td>
                                    <td>Rs. <span class="self_ass_paid"></span></td>
                                  </tr>
                                  <tr>
                                    <td>Net Payable</td>
                                    <td>Rs. <span class="net_tax_to_be_paid"></span></td>
                                  </tr>
                                </tbody>
                              </table>
                              <hr>
                              <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" onSubmit="javascript:;">
                                <div class="checkbox">
                                  <label>
                                  <input type="checkbox" value="" id="last_check" >
                                  I do here declare that all statements made in this application are the complete and correct to the best of my knowledge and belief.</label>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-5" for="">Date and Place</label>
                                  <div class="col-sm-2">
                                    <input type="text" class="form-control" id="tax_re_date" name="tax_re_date" value="<?php echo date('Y-m-d'); //$itr_taxfilling['tax_re_date'];?>" disabled="disabled">
                                  </div>
                                  <?php
                                  //$location =  $_SERVER['REMOTE_ADDR'];
                                  
                                      /*$res = file_get_contents('https://www.iplocate.io/api/lookup/8.8.8.8');
                                      $res = json_decode($res);

                                      echo $res->country; // United States
                                      echo $res->continent; // North America
                                      echo $res->latitude; // 37.751
                                      echo $res->longitude; // -97.822

                                      var_dump($res);*/
                                      $city = "Bangalore";
                                  ?>
                                  <div class="col-sm-3">
                                    <input type="text" required="required" class="form-control" id="tax_re_place" name="tax_re_place" value="<?php echo $city; ?>" disabled="disabled">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <?php
                                  if ($CONFIG->debug == 'dev') {
                                      ?>
                                  <div class="col-sm-9 pull-left">
                                  <label class="control-label  pull-left" for=""><span class="label label-warning"><strong><a href="<?php //echo $CONFIG->siteurl;?>tempXML.php" target="_blank" class="white pull-left"> Export To XML</a></strong></span>  <span class="label label-primary"><strong><a href="javascript:;" id="save-xml" class="white pull-left"> Save XML</a></strong></span></label> 
                                  </div>
                                  <?php
                                  }
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-3 pull-right">
                                    <input type="hidden" name="txtfilli_ratf_btn" value="1">
                                    <button type="submit" disabled="disabled" id="submit-itr" name="txtfilli_ratf_btn1" class="btn btn-success pull-right">Submit</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </form>
                            </div>
                            <!-- Bank Detail -->
                            <div class="tab-pane  active" id="tabBankdetail" data-next-tab="#revTAXfile">
                              <form autocomplete="off" id="form-bank-details" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST" data-xml="BankAccountDtls">
                                <?php if (!empty($itr_taxfilling)) {
                                      foreach ($itr_taxfilling as $taxfilling) {
                                          ?>  
                <div class="add_taxbankdetails_div form_container">
                  <input type="hidden" name="hidcheckfiling" value="<?php echo $taxfilling['pk_taxf_id']; ?>"/>               
                  <div class="form-group">
                    <label class="control-label col-sm-3"><strong>Bank Details</strong></label>
                     <label class="control-label col-sm-3">Make Default  <input type="radio" name="defaul_bank_to_refund" checked="checked"></label>
                  </div>  
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="bankName">Name Of Bank*</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" required name="tax_bkd_bname[]" value="<?php echo $taxfilling['tax_bkd_bname']; ?>" placeholder="Name Of Bank" data-xml="BankName" data-validation="Alphabets">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="Bank Acc">Account Number*</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" required name="tax_bkd_accno[]" value="<?php echo $taxfilling['tax_bkd_accno']; ?>" placeholder="Account Number" data-xml="BankAccountNo" data-validation="BankAccountNo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="IFSC Code">IFSC Code*</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" required name="tax_bkd_ifsc[]" value="<?php echo $taxfilling['tax_bkd_ifsc']; ?>" placeholder="IFSC Code" data-xml="IFSCCode" data-validation="IFSCCode">
                    </div>
                  </div>
                </div>
                <?php
                                      }
                                  } ?>
                <div class="form-group">
                                  <label class="control-label col-sm-3 col-sm-offset-2" for="">
                                  <button type="button" class="btn icon-btn btn-success add_taxbankdetails_btn" ><span class="glyphicon btn-glyphicon glyphicon-plus"></span>Add more</button>
                                  </label>
                                </div>
                                <div class="form-group">
                                   <div class="col-sm-4 col-sm-offset-2">
                                    <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
                                  </div>
                                  <?php
                                  if ($_SESSION['itr_status'] == 0 || isset($_SESSION['itr_status']) == '' || isset($_REQUEST['new'])) {
                                      ?>
                                  <div class="col-sm-6">                                 
                                    <input type="hidden" name="txtfill_bkd_btn" value="1">
                                    <button type="submit" name="txtfill_bkd_btn1" class="btn btn-success pull-right">Save and continue</button>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </form>
                <div class="add_taxbankdetails_div hide form_container">
                <div class="form-group">
                  <label class="control-label col-sm-3">Bank Details</label>
                </div>                
                  <div class="form-group">
                                  <label class="control-label col-sm-3" for="bankName">Name Of Bank*</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" required name="tax_bkd_bname[]" value="" placeholder="Name Of Bank" data-xml="BankName" data-validation="Alphabets">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="Bank Acc">Account Number*</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" required name="tax_bkd_accno[]" value="" placeholder="Account Numberber" data-xml="BankAccountNo" data-validation="BankAccountNo">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-sm-3" for="IFSC Code">IFSC Code*</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  name="tax_bkd_ifsc[]" value="" placeholder="IFSC Code" data-xml="IFSCCode" data-validation="IFSCCode">
                                  </div>
                                </div>
                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.page-content -->
  </div>
  <!-- /.main-contenter -->
</div>
<!-- /.main-content -->
<!-- Modal -->
<div class="modal " id="resStatusHelp" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header1">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Residentail status</h4>
      </div>
      <div class="modal-body">
      
        <form autocomplete="off" class="form-horizontal" action="../ajax-request/itr_update.php" method="POST">
           <div class="form-group res-ques res-ques-1" data-no="1">
        <div class="col-sm-9">
          <label class="control-label">You are in india for 182 days or more during the Financial year <?= date("Y") - 1  ; ?>-<?= date("y"); ?>( from 1st April <?= date("Y") - 1; ?> and 31st March <?= date("Y"); ?>)</label>
        </div>
        <div class="col-sm-3">
          <label class="radio-inline">
            <input type="radio" name="itr_rs_182days" id="itr_rs_182days" value="1"/>Yes
          </label>
          <label class="radio-inline">
            <input type="radio" name="itr_rs_182days"  value="0"/>No
          </label>
        </div>
      </div>
      <div class="form-group res-ques res-ques-1a" data-no="1a" style="display:none;">
        <div class="col-sm-9">
          <label class="control-label">You being Indian Citizen or Person of Indian Origin (PIO) visit India during the financial year <?= date("Y") - 1; ?>-<?= date("y"); ?> or went for employment / as a member of crew of an Indian ship outside India?</label>
        </div>
        <div class="col-sm-3">
          <label class="radio-inline">
            <input type="radio" name="itr_rs_poi" id="itr_rs_poi" value="1"/>Yes
          </label>
          <label class="radio-inline">
            <input type="radio" name="itr_rs_poi" value="0"/>No
          </label>
        </div>
      </div>
      <div class="form-group res-ques res-ques-1c" data-no="1c" style="display:none;">
        <div class="col-sm-9">
          <label class="control-label" for="">Did You stay in India for 60 days (not necessary continuously) or more during financial year <?= date("Y") - 1; ?>-<?= date("y"); ?> and stay in India for 365 days or more during the last four years period i.e between 1st April <?= date("Y")-5; ?> and 31st March <?= date("Y")- 1; ?> ?</label>
        </div>
        <div class="col-sm-3">
          <label class="radio-inline">
            <input type="radio" name="itr_rs_60days" id="itr_rs_60days" value="1"/>Yes
          </label>
          <label class="radio-inline">
            <input type="radio" name="itr_rs_60days" value="0"/>No
          </label>
        </div>
      </div>
      <div class="form-group res-ques res-ques-1d" data-no="1d" style="display:none;">
        <div class="col-sm-9">
          <label class="control-label" for="">Were you a resident of India for at least 2 years out of last 10 years between 1st April <?= date("Y")-11;  ?> and 31st March <?= date("Y")-1;?> ?</label>
        </div>
        <div class="col-sm-3">
          <label class="radio-inline">
            <input type="radio" name="itr_rs_2years" id="itr_rs_2years" value="1"/>Yes
          </label>
          <label class="radio-inline">
            <input type="radio" name="itr_rs_2years"  value="0"/>No
          </label>
        </div>
      </div>
      <div class="form-group res-ques res-ques-1e" data-no="1e" style="display:none;">
        <div class="col-sm-9">
          <label class="control-label" for="">Did you stay in India for 730 days (not necessary continuously) or more during last 7 years between 1st April <?= date("Y") - 8;?> and 31st March <?= date("Y")-1;?> ?</label>
        </div>
        <div class="col-sm-3">
          <label class="radio-inline">
            <input type="radio" name="itr_rs_730days" id="itr_rs_730days" value="1"/>Yes
          </label>
          <label class="radio-inline">
            <input type="radio" name="itr_rs_730days" value="0"/>No
          </label>
        </div>
      </div>
      
      <div class="form-group hide">
       <div class="col-sm-4 col-sm-offset-2">
            <label class="control-label ajaxResClass red" for="ajaxres">&nbsp;</label>
            </div>
      <?php

                                  if ($_SESSION['itr_status'] == 0 || $_SESSION['itr_status'] == '' || isset($_REQUEST['new'])) {
                                      ?>
      <div class="col-sm-6">
        <button type="submit" name="itr_rs_btn1" class="btn btn-success pull-right">Save and continue</button>
        <input type="hidden" value="1" name="itr_rs_btn" id="itr_rs_btn" />
        </div>
      <?php
                                  }
      //unset($_SESSION['itr_status']);
      ?>
      </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
    </div>
  </div>
</div>
<div class="modal" id="form16_upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body"><img src="<?php echo $CONFIG->staticURL.$CONFIG->theme; ?>img/preloader.gif"></div>
    </div>
  </div>
</div>
<div class="modal" id="general-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <div class="content"></div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-default submit-final">Submit</button>      
    </div>        
    </div>  
  </div>
</div>
<?php
        $_SESSION['msg'] = '';
?>
<script>
   /*$(".salaryplus").on("focusout", function() {
    alert("sum");
    var sum = 0;
    $("input[class *= 'salaryplus']").each(function(){
        sum += +$(this).val();
    });
      //alert(sum);
    $("#grossal").val(sum);
    });  */
  
    /*---------------------------------------------------------------*/
  
     /*$(".sec_10").on("focusout", function() {
    alert("sum");
    var sum = 0;
    $("input[class *= 'sec_10']").each(function(){
        sum += +$(this).val();
    });
      //alert(sum);
    $("#total_10").val(sum);
    
    var gross_sal = $("#grossal").val();
    var total_10 = $("#total_10").val();
    var net_sal = parseInt(gross_sal) - parseInt(total_10);
    $("#net_sal").val(net_sal);
    }); */
  
    /*--------------------------------------------------------------*/  
  
    
  
    /*--------------------------------------------------------------*/  
   /* $("#emptype").on("change", function() {
      var value = $(this).val();
      alert(value);
      if(value == 'GOV' || value == 'PSU')
      {
        $(".de16ii").removeAttr('style','display: none');
      }
      else
      {
        //$("#de16ii").add('style="display:none"');
        $(".de16ii").attr('style', 'display: none');
      }*/
      
     /* if(value == "PE"){
         $("#de16iii").attr('style', 'display: none');
      }
      else
      {
        $("#de16iii").removeAttr('style');          
      }*/
    //});
</script>


