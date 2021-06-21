<?php

    include '../__lib.includes/config.inc.php';
    if (!($_SESSION['oPageAccess'])) {
        header('HTTP/1.1 401 Unauthorized');
        header("Location: $CONFIG->siteurl");
        exit;
    }

    if ($_REQUEST['action'] == 'st') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'st';
        include '../__lib.htmlPages/__postLoginPages/__willPages/startpage.php';
        
        exit;
    }
    if ($_REQUEST['action'] == 'pi') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'pi';
        include '../__lib.htmlPages/__postLoginPages/__willPages/dashboard.php';
        //include '../__lib.htmlPages/__postLoginPages/__willPages/dashboardnew.php';
        
        exit;
    } elseif ($_REQUEST['action'] == 'bene') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'bene';
        include '../__lib.htmlPages/__postLoginPages/__willPages/beneficiary-details.php';
        
        exit;
    } elseif ($_REQUEST['action'] == 'exec') {																//print_r($_REQUEST);print_r($_SESSION);
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'exec';
        include '../__lib.htmlPages/__postLoginPages/__willPages/executor-details.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'assets') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'assets';
        include '../__lib.htmlPages/__postLoginPages/__willPages/asset-details.php';
        
        exit;
    } elseif ($_REQUEST['action'] == 'ba') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'ba';
        include '../__lib.htmlPages/__postLoginPages/__willPages/bank-tab.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'smb') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'smb';
        include '../__lib.htmlPages/__postLoginPages/__willPages/mutual-tab.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'ip') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'ip';
        include '../__lib.htmlPages/__postLoginPages/__willPages/immovable-properties-details.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'rf') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'rf';
        include '../__lib.htmlPages/__postLoginPages/__willPages/retire-tab.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'lip') {
        include '../__lib.htmlPages/__postLoginPages/__willPages/life-insurance-policies.php';
         $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'lip';
        exit;
    } elseif ($_REQUEST['action'] == 'liab') {
        include '../__lib.htmlPages/__postLoginPages/__willPages/liabilities-tab.php';
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'liab';
        exit;
    } elseif ($_REQUEST['action'] == 'nb') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'nb';
        include '../__lib.htmlPages/__postLoginPages/__willPages/custodian-details.php';
        
        exit;
    } elseif ($_REQUEST['action'] == 'sub_bank-account-details') {
        include '../__lib.htmlPages/__postLoginPages/__willPages/bank-account-details.php';
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_bank-account-details';
        exit;
    } elseif ($_REQUEST['action'] == 'sub_locker-details') {
        include '../__lib.htmlPages/__postLoginPages/__willPages/locker-details.php';
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_locker-details';
        exit;
    } elseif ($_REQUEST['action'] == 'sub_fixed_deposit') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_fixed_deposit';
        include '../__lib.htmlPages/__postLoginPages/__willPages/fixed-deposit-details.php';
        
        exit;
    } elseif ($_REQUEST['action'] == 'sub_mutual-funds-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_mutual-funds-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/mutual-funds-details.php';
        
        exit;
    } elseif ($_REQUEST['action'] == 'sub_share-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_share-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/share-details.php';
        
        exit;
    } elseif ($_REQUEST['action'] == 'sub_bond-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_bond-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/bond-details.php';
          
        exit;
    } elseif ($_REQUEST['action'] == 'sub_other-assets-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_other-assets-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/other-assets-details.php';
          
        exit;
    } elseif ($_REQUEST['action'] == 'sub_digital-assets-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_digital-assets-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/digital-assets-details.php';
          
        exit;
    } elseif ($_REQUEST['action'] == 'sub_vehicle-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_vehicle-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/vehicle-details.php';
          
        exit;
    } elseif ($_REQUEST['action'] == 'sub_liability-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_liability-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/liability-details.php';
          
        exit;
    } elseif ($_REQUEST['action'] == 'sub_additional-liability') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_additional-liability';
        include '../__lib.htmlPages/__postLoginPages/__willPages/additional-liability.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'sub_retirement-plan-details') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_retirement-plan-details';
        include '../__lib.htmlPages/__postLoginPages/__willPages/retirement-plan-details.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'sub_pension-fund') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_pension-fund';
        include '../__lib.htmlPages/__postLoginPages/__willPages/pension-fund.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'sub_gratuity-fund') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_gratuity-fund';
        include '../__lib.htmlPages/__postLoginPages/__willPages/gratuity-fund.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'add_bussiness') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'add_bussiness';
        include '../__lib.htmlPages/__postLoginPages/__willPages/business-details.php';
         
        exit;
    }
    /*----------------------------------- 20190315-BSEN -------------------------------------*/

    /*else if($_REQUEST['action'] == "add_bussiness")
    {
        include("../__lib.htmlPages/__postLoginPages/__willPages/business-details.php");
        exit;
    }*/
    elseif ($_REQUEST['action'] == 'add_gi') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'add_gi';
        include '../__lib.htmlPages/__postLoginPages/__willPages/general-insurance.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'add_jwe') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'add_jwe';
        include '../__lib.htmlPages/__postLoginPages/__willPages/jewellery-details.php';
        exit;
    } elseif ($_REQUEST['action'] == 'add_bo') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'add_bo';
        include '../__lib.htmlPages/__postLoginPages/__willPages/body-organ.php';
        exit;
    } elseif ($_REQUEST['action'] == 'add_pa') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'add_pa';
        include '../__lib.htmlPages/__postLoginPages/__willPages/pet-animal.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'wi') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'wi';
        include '../__lib.htmlPages/__postLoginPages/__willPages/witness-details.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'sub_contingency-special-clause') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_contingency-special-clause';
        include '../__lib.htmlPages/__postLoginPages/__willPages/contingency-special-clause.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'sub_special-clause') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'sub_special-clause';
        include '../__lib.htmlPages/__postLoginPages/__willPages/special-clause.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'oa') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'oa';
        include '../__lib.htmlPages/__postLoginPages/__willPages/other-assets-tab.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'word') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'word';
        include '../__lib.htmlPages/__postLoginPages/__willPages/word.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'willpay') {
        //include("../__lib.htmlPages/__postLoginPages/__willPages/will_payment.php");
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'willpay';
        include '../__lib.htmlPages/__postLoginPages/pay/will_payment.php';
         
        exit;
    } elseif ($_REQUEST['action'] == 'download') {
        $_SESSION[$CONFIG->sessionPrefix.'h_page'] = 'download';
        include '../__lib.htmlPages/__postLoginPages/__willPages/will_download.php';
         
        exit;
    }
    


