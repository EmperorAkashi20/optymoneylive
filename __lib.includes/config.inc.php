<?php
error_reporting(E_ALL);
/*
     This file is configuration file where we change all the details of server,
     database,email etc.

*/

/*----------------------------------- 20190218-BSEN -------------------------------------*/
/*---- Change 'object' to 'obj' for conflicting with predefiend object class in PHP 7---*/
class obj
{
}
$CONFIG = new obj();

//////////////////////////////////////////////
//  Server Details                         //
////////////////////////////////////////////

$HOST = $_SERVER['HTTP_HOST'];

if ($HOST == 'localhost' || $HOST == '10.0.0.2') {
    $CONFIG->error = 0;	// testing mode 0  production mode 1

    //////////////////////////////////////////////
    //  Server Details                         //
    ////////////////////////////////////////////
    /*----------------------------------- 20190218-BSEN -------------------------------------*/
    /*------------------------------- Changed the Database Connection -----------------------*/

    $CONFIG->wwwroot = 'C:/xampp/htdocs/new_ui_opty/';
    $CONFIG->siteurl = 'http://localhost/new_ui_opty/';
    $CONFIG->siteurlHttps = 'http://localhost/new_ui_opty/';
    $CONFIG->dbHost = '13.235.25.48';
    $CONFIG->dbUser = 'dbuser';
    $CONFIG->dbPassword = 'User@123';
    $CONFIG->dbName = 'taxnsave';

    $CONFIG->userFilesURL = '__uploaded.files/';
    $CONFIG->userFilesPath = $CONFIG->wwwroot.$CONFIG->userFilesURL;
    $CONFIG->staticURL = $CONFIG->siteurl.'static/';
    $CONFIG->theme = 'th_4/';
    $CONFIG->theme_new = 'opty_theme/';
    $CONFIG->tmpFilesURL = '__tmp.Generated.Files/';
    $CONFIG->tmpFilesPath = $CONFIG->wwwroot.$CONFIG->tmpFilesURL;
    $CONFIG->debug = 'dev';
} else {
    $CONFIG->error = 0;
    //////////////////////////////////////////////
    //  Server Details                         //
    ////////////////////////////////////////////

    $CONFIG->wwwroot = '/var/www/html/';
    $CONFIG->siteurl = 'https://optymoney.com/';
    $CONFIG->siteurlHttps = 'https://optymoney.com/';
    $CONFIG->dbHost = 'localhost';
    $CONFIG->dbUser = 'dbuser';
    $CONFIG->dbPassword = 'User@123';
    $CONFIG->dbName = 'opty_m';
    $CONFIG->theme = 'th_4/';
    $CONFIG->theme_new = 'opty_theme/';
    $CONFIG->userFilesURL = '__uploaded.files/';
    $CONFIG->blog_url =  'https://admin.optymoney.com/'.$CONFIG->userFilesURL."blog_images/";
    $CONFIG->userFilesPath = $CONFIG->wwwroot.$CONFIG->userFilesURL;
    //$CONFIG->staticURL		= "http://www.taxsave.in/static/";
    
    /*----------------------------------- NSDL credential -----------------------------------*/ 

    $CONFIG->NSDLuserId   = 'VIKAS';
    $CONFIG->NSDLmobile   = '9900192697';
    $CONFIG->NSDLpassword = 'NDML@1234';    

    /*--------------------------------------------------------------------------------------*/ 

    //$CONFIG->empanel = 'empanel_cv/';   
    $CONFIG->userFilesitrURL = '__uploadeditrv.files/';
    $CONFIG->userFilesPaths=$CONFIG->siteurl;
    $CONFIG->useritrvFilesPath = $CONFIG->wwwroot.$CONFIG->userFilesitrURL;

    $CONFIG->userFilesPath = $CONFIG->wwwroot.$CONFIG->userFilesURL;

    $CONFIG->staticURL = $CONFIG->siteurl.'static/';
    $CONFIG->tmpFilesURL = '__tmp.Generated.Files/';
    $CONFIG->tmpFilesPath = $CONFIG->wwwroot.$CONFIG->tmpFilesURL;
    // $CONFIG->debug = 'dev';
}
    // empanel Path
    $CONFIG->empanel = 'empanel_cv/';

    // Help desk Path
    $CONFIG->helpdesk = 'helpdesk/';

    // will pdf Path
    $CONFIG->willpath = 'willdocs/';

    // event participant Path
    $CONFIG->myevents = 'myevents/';

    // campaign participant Path
    $CONFIG->mycampaign = 'campaign/';
    

    // Blog Images
    $CONFIG->blog_images = 'blog_images/';

    // $CONFIG->userFilesitrURL = '__uploadeditrv.files/';
    // $CONFIG->userFilesPaths=$CONFIG->siteurl;
    // $CONFIG->useritrvFilesPath = $CONFIG->wwwroot.$CONFIG->userFilesitrURL;

    $CONFIG->userFilesPath = $CONFIG->wwwroot.$CONFIG->userFilesURL;

    $CONFIG->staticURL = $CONFIG->siteurl.'static/';
    $CONFIG->tmpFilesURL = '__tmp.Generated.Files/';
    $CONFIG->tmpFilesPath = $CONFIG->wwwroot.$CONFIG->tmpFilesURL;

    if ($CONFIG->error == 1) {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    //error_reporting(-1);	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
    } else {
        ini_set('display_errors', 0);
        error_reporting(0);
    }

    $CONFIG->apidir = $CONFIG->wwwroot.'__lib.apis/';
    $CONFIG->libdir = $CONFIG->wwwroot.'__lib.includes';
    $CONFIG->imagedir = $CONFIG->wwwroot.'images';
    $CONFIG->classdir = $CONFIG->wwwroot.'__lib.classes';
    $CONFIG->timestamp = time();
    $CONFIG->loggedIP = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $CONFIG->logdir = $CONFIG->wwwroot.'__lib.log';

    session_start();

    include $CONFIG->classdir.'/db.class.php';
    $db = new Db();
    $CONFIG->dbLink = $db->connect();
    $CONFIG->db = $db;

    require "$CONFIG->libdir/commonFunction.php";
    $commonFunction = new commonFunction($db);

    $CONFIG->sessionPrefix = 'caTAX_';

    $CONFIG->requestPrefixStart = 'rEqUeSt~_';
    $CONFIG->requestPrefixEnd = '_~tSeUqEr';
    $CONFIG->requestPrefix = $CONFIG->requestPrefixStart.'{DATA}'.$CONFIG->requestPrefixEnd;
    $CONFIG->encrypt = $_SESSION[$CONFIG->sessionPrefix.'encrypt'];

    $CONFIG->loggedUserId = $_SESSION[$CONFIG->sessionPrefix.'user_id'];
    $CONFIG->customerId = $_SESSION[$CONFIG->sessionPrefix.'customer_id'];
    $CONFIG->loggedUserEmail = $_SESSION[$CONFIG->sessionPrefix.'email_id'];
    $CONFIG->loggedUserName = $_SESSION[$CONFIG->sessionPrefix.'user_name'];
    /*--------Magz--------------*/
    $CONFIG->UserName = $_SESSION[$CONFIG->sessionPrefix.'inv_name'];


    /*---------------------------------------------- BSE Credaintial-Start ------------------------------------------------------------*/
    $CONFIG->bseUserId    = '1513303';   // Demo = 1513301 || live = 1513303
    $CONFIG->bseMemberId  = '15133';
    $CONFIG->bsePassword  = '159487!';   //159487!
     
    $CONFIG->bsereturnurl  = $CONFIG->siteurl."mySaveTax/?module_interface=dHJhbl9zdGF0dXM=";
    /*---------------------------------------------- BSE Credaintial-End -------------------------------------------------------------*/



    /*----------------------------------- 20190525-BSEN -------------------------------------*/

    $CONFIG->itStatus = $_SESSION[$CONFIG->sessionPrefix.'itr_status'];

    $CONFIG->loggedAdminId = $_SESSION[$CONFIG->sessionPrefix.'a_user_id'];
    $CONFIG->loggedAdminName = $_SESSION[$CONFIG->sessionPrefix.'a_user_name'];
    $CONFIG->currentAY = $_SESSION[$CONFIG->sessionPrefix.'_AY'];
    $CONFIG->currentAYTEXT = $_SESSION[$CONFIG->sessionPrefix.'_AY_TEXT'];
    $CONFIG->currentITRID = $_SESSION[$CONFIG->sessionPrefix.'_ITR_ID'];

    $CONFIG->UserPan = $_SESSION[$CONFIG->sessionPrefix.'pan_number'];

     $CONFIG->adminuserlevel = $_SESSION[$CONFIG->sessionPrefix.'user_level'];

    /*-------------------------- For admin level Check-End-------------------------------------*/    

    if ($CONFIG->loggedUserId) {
        $htmlPageSource = '__postLoginPages';
    } else {
        $htmlPageSource = '__preLoginPages';
    }

    $CONFIG->uploadLinkPoint = 'storage_1/';
    $CONFIG->customerProfileImgURL = $CONFIG->siteurl.$CONFIG->userFilesURL.$CONFIG->uploadLinkPoint.$CONFIG->customerId.'/profile_img/';

    $CONFIG->customerFilePath = $CONFIG->userFilesPath.$CONFIG->uploadLinkPoint.$CONFIG->customerId.'/';
    $CONFIG->customerThumbPath = $CONFIG->userFilesPath.$CONFIG->uploadLinkPoint.$CONFIG->customerId.'/th/';
    $CONFIG->customerProfileImg = $CONFIG->userFilesPath.$CONFIG->uploadLinkPoint.$CONFIG->customerId.'/profile_img/';
    $CONFIG->adminUploadDIR = '__admin.upload/';
    $CONFIG->adminUploadPath = $CONFIG->userFilesPath.$CONFIG->uploadLinkPoint.$CONFIG->adminUploadDIR;

    $CONFIG->paginationPageItem = 50;
    $CONFIG->RTANames = array('cam', 'karvy', 'franklin', 'sundram');

    $CONFIG->sourceOfWealth = array('Salary' => '01', 'Business Income' => '02', 'Gift' => '03', 'Ancestral Property' => '04', 'Rental Income' => '05',
                                            'Prize Money' => '06', 'Royalty' => '07', 'Others' => '08', );

    $CONFIG->taxStatus = array('Individual' => '01', 'On Behalf Of Minor' => '02', 'HUF' => '03', 'Company' => '04', 'NRE' => '21');
    $CONFIG->clientHolding = array('Single' => 'SI', 'Joint' => 'JO', 'Anyone or Survivor' => 'AS');

    $CONFIG->occupationCode = array('Business' => '01', 'Service' => '02', 'Professional' => '03', 'Agriculturist' => '04', 'Retired' => '05',
                                            'Housewife' => '06', 'Student' => '07', 'Others' => '08', 'Doctor' => '09', 'Private Sector Service' => '41',
                                            'Public Sector Service' => '42', 'Forex Dealer' => '43', 'Government Service' => '44', );

    $CONFIG->genderArr = array('Male' => 'M', 'Female' => 'F');

    /*-------------------------------------------------------- For Old Schema 2018 ----------------------------------------------------------------------------*/
    /*
    $CONFIG->stateCodeBSE			= array("Andaman & Nicobar" => "AN", "Arunachal Pradesh" => "AR", "Andhra Pradesh" => "AP","Assam" => "AS",
                                            "Bihar" => "BH", "Chandigarh" => "CH", "Chhattisgarh" => "CG", "Delhi" => "DL", "GOA" => "GO",
                                            "Gujarat" => "GU", "Haryana" => "HA", "Himachal Pradesh" => "HP", "Jammu & Kashmir" => "JM",
                                            "Jharkhand" => "JK", "Karnataka" => "KA", "Kerala" => "KE", "Madhya Pradesh" => "MP", "Maharashtra" => "MA",
                                            "Manipur" => "MN", "Meghalaya" => "ME", "Mizoram" => "MI", "Nagaland" => "NA", "New Delhi" => "ND",
                                            "Orissa" => "OR", "Pondicherry" => "PO", "Punjab" => "PU", "Rajasthan" => "RA", "Sikkim" => "SI", "Telangana" => "TG",
                                            "Tamil Nadu" => "TN", "Tripura" => "TR", "Uttar Pradesh" => "UP", "Uttaranchal" => "UC", "West Bengal" => "WB",
                                            "Dadra and Nagar Haveli" => "DN", "Daman and Diu" => "DD", "Others" => "OH");
    */

    /*------------------------------------------------ For New Schema 2019 ------------------------------------------------------------------------------------*/
    $CONFIG->stateCodeBSE = array('Andaman & Nicobar' => '01', 'Andhra Pradesh' => '02', 'Arunachal Pradesh' => '03', 'Assam' => '04',
                                            'Bihar' => '05', 'Chandigarh' => '06',
                                            'Dadra Nagar and Haveli' => '07', 'Daman and Diu' => '08', 'Delhi' => '09', 'GOA' => '10',
                                            'Gujarat' => '11', 'Haryana' => '12', 'Himachal Pradesh' => '13', 'Jammu & Kashmir' => '14',
                                            'Karnataka' => '15', 'Kerala' => '16', 'Lakshadweep' => '17', 'Madhya Pradesh' => '18', 'Maharashtra' => '19',
                                            'Manipur' => '20', 'Meghalaya' => '21', 'Mizoram' => '22', 'Nagaland' => '23', 'Orissa' => '24', 'Pondicherry' => '25', 'Punjab' => '26', 'Rajasthan' => '27', 'Sikkim' => '28', 'Tamil Nadu' => '29', 'Tripura' => '30', 'Uttar Pradesh' => '31', 'West Bengal' => '32',
                                            'Chhattisgarh' => '33', 'Uttarakhand' => '34', 'Jharkhand' => '35', 'Telangana' => '36', );

   
    //Risk
   
    $CONFIG->risk = array("1" => "Low","2" => "Moderate Low","3" => "Modarate","4" => "Modarately High","5" => "High");


    /*----------------------- Send Mail Start ---------------------------*/
    
    
    
    /*----------------------- Send Mail End ---------------------------*/
    include $CONFIG->classdir.'/paginator.class.php';

    include $CONFIG->classdir.'/customerProfile.class.php';
    $customerProfile = new customerProfile();

    include $CONFIG->classdir.'/customerLog.class.php';
    $customerLog = new customerLog();

    include $CONFIG->classdir.'/documentFiles.class.php';
    $documentFiles = new documentFiles();

    include $CONFIG->classdir.'/search.class.php';
    $search = new search();

    include $CONFIG->classdir.'/camail.class.php';
    $mdocmail = new mdocmail();

    include $CONFIG->classdir.'/permissionSettings.class.php';
    $permissionSettings = new permissionSettings();

    include $CONFIG->classdir.'/runtimeHTML.class.php';
    $runtimeHTML = new runtimeHTML();

    include $CONFIG->classdir.'/mutualFund.class.php';
    $mutualFund = new mutualFund();

    include $CONFIG->classdir.'/websiteContent.class.php';
    $websiteContent = new websiteContent();

    include $CONFIG->classdir.'/willProfile.class.php';
    $willProfile = new willProfile();

    include $CONFIG->classdir.'/buySell.class.php';
    $buySell = new buySell();

    include $CONFIG->classdir.'/bseSync.class.php';
    $bseSync = new bseSync();

    include $CONFIG->classdir.'/mfScheme.class.php';
    $mfScheme = new mfScheme();

    include $CONFIG->classdir.'/payment.class.php';
    $payment = new payment();

    // include $CONFIG->classdir.'/itrFill.class.php';
    // $itrFill = new itrFill();