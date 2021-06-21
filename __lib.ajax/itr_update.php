

<?php
/* Donation80GGA-insert/update: where insert and update happening in table `itr_donation80gga`
     Schedule-TCS-insert: where insert and update happening in table `itr_taxreconci_tcs`
*/

    include '../__lib.includes/config.inc.php';
    /*if (!($_SESSION['oPageAccess'])) {
        header('HTTP/1.1 401 Unauthorized');
        header("Location: $CONFIG->siteurl");
        exit;
    }*/

    //print_r($_SESSION);//echo $CONFIG->loggedUserId; print_r($_POST);	//print_r($CONFIG);
    $fr_itr_id = $_SESSION[$CONFIG->sessionPrefix.'_ITR_ID'];
    $fr_user_id = $CONFIG->loggedUserId;		//$_SESSION[$CONFIG->sessionPrefix.'user_id'];

    if (isset($_POST['itr_pd_btn'])) {
        $itr_pd_dob = null;
        $itr_pd_date_filoeriretu = null;

        if (isset($_POST['itr_pd_dob']) && $_POST['itr_pd_dob']) {
            $itr_pd_dob = date_create_from_format('d/m/Y', trim($_POST['itr_pd_dob']))->format('Y-m-d');
        }

        if (isset($_POST['itr_pd_date_filoeriretu']) && $_POST['itr_pd_date_filoeriretu']) {
            $itr_pd_date_filoeriretu = date_create_from_format('d/m/Y', trim($_POST['itr_pd_date_filoeriretu']))->format('Y-m-d');
        }

        $tbname = 'itr_profile';
        $dataarray = array(
            'itr_pd_pan_number' => trim($_POST['itr_pd_pan_number']),
            'itr_pd_resi_sta' => trim($_POST['itr_pd_resi_sta']),
            //'itr_pd_fetch_pandata' => trim($_POST['itr_pd_fetch_pandata']),
            'itr_pd_return_type' => trim($_POST['itr_pd_return_type']),
            'itr_pd_ackno_orreturn' => trim($_POST['itr_pd_ackno_orreturn']),
            'itr_pd_date_filoeriretu' => $itr_pd_date_filoeriretu,
            'itr_pd_fname' => trim($_POST['itr_pd_fname']),
            'itr_pd_mname' => trim($_POST['itr_pd_mname']),
            'itr_pd_lname' => trim($_POST['itr_pd_lname']),
            'itr_pd_father_name' => trim($_POST['itr_pd_father_name']),
            'itr_pd_gender' => trim($_POST['itr_pd_gender']),
            'itr_pd_marital_status' => trim($_POST['itr_pd_marital_status']),
            'itr_pd_dob' => $itr_pd_dob,
            'itr_pd_adhar_no' => trim($_POST['itr_pd_adhar_no']),
            'itr_pd_adhar_enrol_no' => trim($_POST['itr_pd_adhar_enrol_no']),
        );
        /*------------------------------------------------- Pan Number Update in bfsi-itr-start ------------------------------------------------------*/

        $update_pan = trim($_POST['itr_pd_pan_number']);
        $result = $commonFunction->updatePan($update_pan);
        //if(isset($result)){
         //echo $result;
        $commonFunction->dynamicUpdate($tbname, $dataarray);
        //}

        /*------------------------------------------------- Pan Number Update in bfsi-itr-end -----------------------------------------------------*/
        //Clear the session of new after making payment, once itr is created
        unset($_SESSION['newitr']);
    } elseif (isset($_POST['itr_cond_btn'])) {
        $tbname = 'itr_profile';
        $dataarray = array(
            'itr_cond_mobile_number' => trim($_POST['itr_cond_mobile_number']),
            'itr_cond_email_id' => trim($_POST['itr_cond_email_id']),
            'itr_cond_fl_do_bl' => trim($_POST['itr_cond_fl_do_bl']),
            'itr_cond_buname' => trim($_POST['itr_cond_buname']),
            'itr_cond_ro_st_po' => trim($_POST['itr_cond_ro_st_po']),
            'itr_cond_area_loc' => trim($_POST['itr_cond_area_loc']),
            'itr_cond_city' => trim($_POST['itr_cond_city']),
            'itr_cond_state' => trim($_POST['itr_cond_state']),
            'itr_cond_country' => trim($_POST['itr_cond_country']),
            'itr_cond_pin_code' => trim($_POST['itr_cond_pin_code']),
        );
        $commonFunction->dynamicUpdate($tbname, $dataarray);
    } elseif (isset($_POST['itr_rs_btn'])) {
        $fr_itr_pd_id = 1;
        $tbname = 'itr_pd_residential_st';
        $dataarray = array(
        'fr_itr_pd_id' => $fr_itr_pd_id,
        'itr_rs_182days' => trim($_POST['itr_rs_182days']),
        'itr_rs_poi' => trim($_POST['itr_rs_poi']),
        'itr_rs_60days' => trim($_POST['itr_rs_60days']),
        'itr_rs_2years' => trim($_POST['itr_rs_2years']),
        'itr_rs_730days' => trim($_POST['itr_rs_730days']),
      );
        $commonFunction->dynamicUpdate($tbname, $dataarray);
    } elseif (isset($_POST['sou_salary_btn'])) {
        $arraylength = count($_POST['sou_sa_ntslary']);

        $tbname = 'itr_sou_salary';
        $dataarrayl = array();

        for ($i = 0; $i < $arraylength; ++$i) {
            if (isset($_POST['hidchecksalary']) && isset($_POST['hidchecksalary'][$i]) && trim($_POST['hidchecksalary'][$i]) != 0) {
                $dataarrayupdate = array(
                'pk_sousal_id' => trim($_POST['hidchecksalary'][$i]),
                'sou_sa_form_16' => trim($_POST['sou_sa_form_16'][$i]),
                'sou_sa_salary' => intval(trim($_POST['sou_sa_salary'][$i])),
                'sou_sa_hra10' => intval(trim($_POST['sou_sa_hra10'][$i])),
                'sou_sa_oth10' => intval(trim($_POST['sou_sa_oth10'][$i])),
                'sou_sa_perquisite' => intval(trim($_POST['sou_sa_perquisite'][$i])),
                'sou_sa_profits' => intval(trim($_POST['sou_sa_profits'][$i])),
                'sou_sa_deduction' => intval(trim($_POST['sou_sa_deduction'][$i])),
                'deductionUs16ii' => intval(trim($_POST['deductionUs16ii'][$i])),
                'deductionUs16iii' => intval(trim($_POST['deductionUs16iii'][$i])),
                'sou_sa_ntslary' => trim($_POST['sou_sa_ntslary'][$i]),
                'sou_sa_employer_name' => strtoupper(trim($_POST['sou_sa_employer_name'][$i])),
                'sou_sa_employer_type' => trim($_POST['sou_sa_employer_type'][$i]),
                'sou_sa_employer_add' => trim($_POST['sou_sa_employer_add'][$i]),
                'sou_sa_employer_city' => trim($_POST['sou_sa_employer_city'][$i]),
                'sou_sa_employer_state' => trim($_POST['sou_sa_employer_state'][$i]),
                'sou_sa_employercountry' => trim($_POST['sou_sa_employercountry'][$i]),
                'sou_sa_employer_pincode' => '0',
                'sou_sa_tan_no' => strtoupper(trim($_POST['sou_sa_tan_no'][$i])),
                'sou_sa_tds_on_sal' => trim($_POST['sou_sa_tds_on_sal'][$i]), );

                $result = $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarrayl[] = array(
                'fr_user_id' => $fr_user_id,
                'fr_itr_id' => $fr_itr_id,
                'sou_sa_form_16' => trim($_POST['sou_sa_form_16'][$i]),
                'sou_sa_salary' => intval(trim($_POST['sou_sa_salary'][$i])),
                'sou_sa_hra10' => intval(trim($_POST['sou_sa_hra10'][$i])),
                'sou_sa_oth10' => intval(trim($_POST['sou_sa_oth10'][$i])),
                'sou_sa_perquisite' => intval(trim($_POST['sou_sa_perquisite'][$i])),
                'sou_sa_profits' => intval(trim($_POST['sou_sa_profits'][$i])),
                'sou_sa_deduction' => intval(trim($_POST['sou_sa_deduction'][$i])),
                'deductionUs16ii' => intval(trim($_POST['deductionUs16ii'][$i])),
                'deductionUs16iii' => intval(trim($_POST['deductionUs16iii'][$i])),
                'sou_sa_ntslary' => trim($_POST['sou_sa_ntslary'][$i]),
                'sou_sa_employer_name' => strtoupper(trim($_POST['sou_sa_employer_name'][$i])),
                'sou_sa_employer_type' => trim($_POST['sou_sa_employer_type'][$i]),
                'sou_sa_employer_add' => trim($_POST['sou_sa_employer_add'][$i]),
                'sou_sa_employer_city' => trim($_POST['sou_sa_employer_city'][$i]),
                'sou_sa_employer_state' => trim($_POST['sou_sa_employer_state'][$i]),
                'sou_sa_employercountry' => trim($_POST['sou_sa_employercountry'][$i]),
                'sou_sa_employer_pincode' => '0',
                'sou_sa_tan_no' => strtoupper(trim($_POST['sou_sa_tan_no'][$i])),
                'sou_sa_tds_on_sal' => trim($_POST['sou_sa_tds_on_sal'][$i]), );
            }
        }
        if (!empty($dataarrayl)) {
            $result = $commonFunction->insertMultiple($tbname, $dataarrayl);
        }
    } elseif (isset($_POST['sou_hpself_btn'])) {
        $fr_itr_selfocc_id = 0;
        $tbname = 'itr_hp_selfocc';
        $tbnamee = 'itr_hp_coowner_selfocc';
        $datalandinsert = array();
        foreach ($_POST['hidcheckslfoccprop'] as $key => $value) {
            if ($value > 0) {
                $dataarrayupdate = array(
                'fr_user_id' => $fr_user_id,
                'fr_itr_id' => $fr_itr_id,
                'pk_itr_selfocc' => trim($_POST['hidcheckslfoccprop'][$key]),
                'self_hloan_int' => trim($_POST['self_hloan_int'][$key]),
                'self_con_per_int' => trim($_POST['self_con_per_int'][$key]),
                'self_fl_do_bl_no' => trim($_POST['self_fl_do_bl_no'][$key]),
                'self_bu_name' => trim($_POST['self_bu_name'][$key]),
                'self_ro_st_po' => trim($_POST['self_ro_st_po'][$key]),
                'self_area_loc' => trim($_POST['self_area_loc'][$key]),
                'self_city' => trim($_POST['self_city'][$key]),
                'self_state' => trim($_POST['self_state'][$key]),
                'self_country' => trim($_POST['self_country'][$key]),
                'self_pincode' => trim($_POST['self_pincode'][$key]),
                'self_con_income' => trim($_POST['self_con_income'][$key]),
                'self_sh_prop' => trim($_POST['self_sh_prop'][$key]), );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);

                $dataarraylimp = array();
                foreach ($_POST['hidcheck_coowner_selfocc'] as $impkey => $impvalue) {
                    if ($_POST['hidcheck_subpart_slfoccid'][$impkey] == $value) {
                        if ($impvalue > 0) {
                            $dataarrayupdateimp = array(
                              'fr_user_id' => $fr_user_id,
                              'fr_itr_id' => $fr_itr_id,
                             // 'pk_itr_cownerself' => $impvalue,
                              'fr_itr_selfocc_id' => $value,
                              'coow_name' => trim($_POST['coow_name'][$impkey]),
                              'coow_pan_no' => trim($_POST['coow_pan_no'][$impkey]),
                              'coow_sha_prop' => trim($_POST['coow_sha_prop'][$impkey]), );
                            $commonFunction->insertMultiple($tbnamee, $dataarrayupdateimp);
                        } else {
                            $dataarraylimp[] = array(
                              'fr_user_id' => $fr_user_id,
                              'fr_itr_id' => $fr_itr_id,
                              'fr_itr_selfocc_id' => $value,
                              'coow_name' => trim($_POST['coow_name'][$impkey]),
                              'coow_pan_no' => trim($_POST['coow_pan_no'][$impkey]),
                              'coow_sha_prop' => trim($_POST['coow_sha_prop'][$impkey]), );
                        }
                    }
                }
                if (!empty($dataarraylimp)) {
                    $commonFunction->insertMultiple($tbnamee, $dataarraylimp);
                }
            } else {
                $datalandinsert = array(
            'fr_user_id' => $fr_user_id,
            'fr_itr_id' => $fr_itr_id,
            'self_hloan_int' => trim($_POST['self_hloan_int'][$key]),
            'self_con_per_int' => trim($_POST['self_con_per_int'][$key]),
            'self_fl_do_bl_no' => intval(trim($_POST['self_fl_do_bl_no'][$key])),
            'self_bu_name' => trim($_POST['self_bu_name'][$key]),
            'self_ro_st_po' => trim($_POST['self_ro_st_po'][$key]),
            'self_area_loc' => trim($_POST['self_area_loc'][$key]),
            'self_city' => trim($_POST['self_city'][$key]),
            'self_state' => trim($_POST['self_state'][$key]),
            'self_country' => trim($_POST['self_country'][$key]),
            'self_pincode' => trim($_POST['self_pincode'][$key]),
            'self_con_income' => intval(trim($_POST['self_con_income'][$key])),
            'self_sh_prop' => trim($_POST['self_sh_prop'][$key]), );

                if (!empty($datalandinsert)) {
                    $datalandinserta[0] = $datalandinsert;
                    $commonFunction->insertMultiple($tbname, $datalandinserta);
                }

                $dataarraynewlimp = array();
                foreach ($_POST['hidcheck_subpart_slfoccid'] as $keyspi => $valuespi) {
                    if (!is_numeric($valuespi)) {
                        $landprop = explode('_', $value);
                        $valuespinum = explode('_', $valuespi);
                        if ($landprop[1] == $valuespinum[1]) {
                            $result = $commonFunction->latestRowById($tbname, $fr_user_id, 'pk_itr_selfocc', $limit = 1);
                            if ($result['pk_itr_selfocc']) {
                                $fr_itr_selfocc_id = $result['pk_itr_selfocc'];
                            }
                            $dataarraynewlimp[] = array(
                        'fr_user_id' => $fr_user_id,
                          'fr_itr_id' => $fr_itr_id,
                          'fr_itr_selfocc_id' => $fr_itr_selfocc_id,
                          'coow_name' => trim($_POST['coow_name'][$keyspi]),
                          'coow_pan_no' => trim($_POST['coow_pan_no'][$keyspi]),
                          'coow_sha_prop' => trim($_POST['coow_sha_prop'][$keyspi]), );
                        }
                    }
                }
                if (!empty($dataarraynewlimp)) {
                    $commonFunction->insertMultiple($tbnamee, $dataarraynewlimp);
                }
            }
        }
    } elseif(isset($_POST['submit_status'])){
        $status = $_POST['status'];
        $id = $_POST['id'];
        $sql = "UPDATE `tbl_uploads` SET file_status='".$status."' Where id='".$id."'";
        $res = $commonFunction->run_the_query($sql);
        echo $res;
        exit;
    } elseif (isset($_POST['sou_hpletout_btn'])) {
        $fr_itr_letout_id = 0;
        $tbnamelot = 'itr_hp_letout';
        $tbnamelotco = 'itr_hp_coowner_letout';
        $datalandinsert = array();
        foreach ($_POST['hidcheckletoutprop'] as $key => $value) {
            if ($value > 0) {
                $dataarrayupdate = array(
              'pk_itr_letout' => trim($_POST['hidcheckletoutprop'][$key]),
              'let_ren_inc' => trim($_POST['let_ren_inc'][$key]),
              'let_proptex_pad' => trim($_POST['let_proptex_pad'][$key]),
              'let_st_dedu' => trim($_POST['let_st_dedu'][$key]),
              'let_hloan_int' => trim($_POST['let_hloan_int'][$key]),
              'let_pre_cons_per_int' => trim($_POST['let_pre_cons_per_int'][$key]),
              'let_con_income' => trim($_POST['let_con_income'][$key]),
              'let_fl_do_bu' => trim($_POST['let_fl_do_bu'][$key]),
              'let_bu_name' => trim($_POST['let_bu_name'][$key]),
              'let_ro_st_po' => trim($_POST['let_ro_st_po'][$key]),
              'let_area_loc' => trim($_POST['let_area_loc'][$key]),
              'let_city' => trim($_POST['let_city'][$key]),
              'let_state' => trim($_POST['let_state'][$key]),
              'let_country' => trim($_POST['let_country'][$key]),
              'let_pincode' => trim($_POST['let_pincode'][$key]),
              'let_nameotenant' => trim($_POST['let_nameotenant'][$key]),
              'let_sh_prop' => trim($_POST['let_sh_prop'][$key]), );
                $commonFunction->dynamicUpdateMultiple($tbnamelot, $dataarrayupdate);

                $dataarraylimp = array();
                foreach ($_POST['hidcheck_coowner_lot'] as $impkey => $impvalue) {
                    if ($_POST['hidcheck_subpart_lotid'][$impkey] == $value) {
                        if ($impvalue > 0) {
                            $dataarrayupdateimp = array(
                      'pk_itr_cownerletout' => $impvalue,
                      'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
                      'fr_itr_letout_id' => $value,
                      'lot_coow_name' => trim($_POST['lot_coow_name'][$impkey]),
                      'lot_coow_pan_no' => trim($_POST['lot_coow_pan_no'][$impkey]),
                      'lot_coow_sha_prop' => trim($_POST['lot_coow_sha_prop'][$impkey]), );
                            $commonFunction->dynamicUpdateMultiple($tbnamelotco, $dataarrayupdateimp);
                        } else {
                            $dataarraylimp[] = array(
                      'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
                      'fr_itr_letout_id' => $value,
                      'lot_coow_name' => trim($_POST['lot_coow_name'][$impkey]),
                      'lot_coow_pan_no' => trim($_POST['lot_coow_pan_no'][$impkey]),
                      'lot_coow_sha_prop' => trim($_POST['lot_coow_sha_prop'][$impkey]), );
                        }
                    }
                }
                if (!empty($dataarraylimp)) {
                    $commonFunction->insertMultiple($tbnamelotco, $dataarraylimp);
                }
            } else {
                $datalandinsert = array(
                'fr_user_id' => $fr_user_id,
                 'fr_itr_id' => $fr_itr_id,
                'let_ren_inc' => trim($_POST['let_ren_inc'][$key]),
                'let_proptex_pad' => trim($_POST['let_proptex_pad'][$key]),
                'let_st_dedu' => trim($_POST['let_st_dedu'][$key]),
                'let_hloan_int' => trim($_POST['let_hloan_int'][$key]),
                'let_pre_cons_per_int' => trim($_POST['let_pre_cons_per_int'][$key]),
                'let_con_income' => trim($_POST['let_con_income'][$key]),
                'let_fl_do_bu' => trim($_POST['let_fl_do_bu'][$key]),
                'let_bu_name' => trim($_POST['let_bu_name'][$key]),
                'let_ro_st_po' => trim($_POST['let_ro_st_po'][$key]),
                'let_area_loc' => trim($_POST['let_area_loc'][$key]),
                'let_city' => trim($_POST['let_city'][$key]),
                'let_state' => trim($_POST['let_state'][$key]),
                'let_country' => trim($_POST['let_country'][$key]),
                'let_pincode' => trim($_POST['let_pincode'][$key]),
                'let_nameotenant' => trim($_POST['let_nameotenant'][$key]),
                'let_sh_prop' => trim($_POST['let_sh_prop'][$key]), );

                if (!empty($datalandinsert)) {
                    $datalandinserta[0] = $datalandinsert;
                    $commonFunction->insertMultiple($tbnamelot, $datalandinserta);
                }

                $dataarraynewlimp = array();
                foreach ($_POST['hidcheck_subpart_lotid'] as $keyspi => $valuespi) {
                    if (!is_numeric($valuespi)) {
                        $landprop = explode('_', $value);
                        $valuespinum = explode('_', $valuespi);
                        if ($landprop[1] == $valuespinum[1]) {
                            $result = $commonFunction->latestRowById($tbnamelot, $fr_user_id, 'pk_itr_letout', $limit = 1);
                            if ($result['pk_itr_letout']) {
                                $fr_itr_letout_id = $result['pk_itr_letout'];
                            }
                            $dataarraynewlimp[] = array(
                    'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
                  'fr_itr_letout_id' => $fr_itr_letout_id,
                  'lot_coow_name' => trim($_POST['lot_coow_name'][$keyspi]),
                  'lot_coow_pan_no' => trim($_POST['lot_coow_pan_no'][$keyspi]),
                  'lot_coow_sha_prop' => trim($_POST['lot_coow_sha_prop'][$keyspi]),
                );
                        }
                    }
                }
                if (!empty($dataarraynewlimp)) {
                    $commonFunction->insertMultiple($tbnamelotco, $dataarraynewlimp);
                }
            }
        }
    } elseif (isset($_POST['itr_sou_other_btn'])) {
        $fr_itr_sou_id = 1;
        $tbname = 'itr_sou_other';

        if (isset($_POST['pk_oth_id']) && $_POST['pk_oth_id']) {
            $dataarray = array(
              'pk_oth_id' => trim($_POST['pk_oth_id']),
              'fr_user_id' => $fr_user_id,
              'fr_itr_id' => $fr_itr_id,
              'fr_itr_sou_id' => $fr_itr_sou_id,
              'sou_oth_oi_othinc' => intval(trim($_POST['sou_oth_oi_othinc'])),
              'sou_oth_oi_bnkint' => trim($_POST['sou_oth_oi_bnkint']),
              /*---------------------------- ADD BANK-INTEREST FD & PENSION -------------------------------------------*/
              'sou_oth_oi_bnkint_fd' => trim($_POST['sou_oth_oi_bnkint_fd']),
              'family_pension' => trim($_POST['family_pension']),
              /*---------------------------- ADD BANK-INTEREST FD & PENSION -------------------------------------------*/
              'sou_oth_oi_totothinc' => intval(trim($_POST['sou_oth_oi_totothinc'])),
              'sou_oth_oi_othint' => trim($_POST['sou_oth_oi_othint']),
              'sou_oth_oi_diviinc' => trim($_POST['sou_oth_oi_diviinc']),
              'sou_oth_oi_agriinc' => trim($_POST['sou_oth_oi_agriinc']),
              'sou_oth_exi_agriinc' => trim($_POST['sou_oth_exi_agriinc']),
              'sou_oth_exi_diviinc' => trim($_POST['sou_oth_exi_diviinc']),
              'sou_oth_exi_ltcg' => trim($_POST['sou_oth_exi_ltcg']),
              'sou_oth_exi_shopropartn' => trim($_POST['sou_oth_exi_shopropartn']),
              'sou_oth_exi_aopboi' => trim($_POST['sou_oth_exi_aopboi']),
              'sou_oth_exi_shoprop' => trim($_POST['sou_oth_exi_shoprop']),
              'sou_oth_exi_othinc' => trim($_POST['sou_oth_exi_othinc']),
              'sou_oth_exi_totexinc' => intval(trim($_POST['sou_oth_exi_totexinc'])),
            );

            $commonFunction->dynamicUpdate($tbname, $dataarray);
        } else {
            $dataarray = array(
              'fr_itr_sou_id' => $fr_itr_sou_id,
              'fr_itr_id' => $fr_itr_id,
              'fr_user_id' => $fr_user_id,
              'fr_user_id' => $fr_user_id,
              'fr_itr_id' => $fr_itr_id,
              'fr_itr_sou_id' => $fr_itr_sou_id,
              'sou_oth_oi_othinc' => intval(trim($_POST['sou_oth_oi_othinc'])),
              'sou_oth_oi_bnkint' => trim($_POST['sou_oth_oi_bnkint']),
              /*---------------------------- ADD BANK-INTEREST FD & PENSION -------------------------------------------*/
              'sou_oth_oi_bnkint_fd' => trim($_POST['sou_oth_oi_bnkint_fd']),
              'family_pension' => trim($_POST['family_pension']),
              /*---------------------------- ADD BANK-INTEREST FD & PENSION -------------------------------------------*/
              'sou_oth_oi_totothinc' => intval(trim($_POST['sou_oth_oi_totothinc'])),
              'sou_oth_oi_othint' => trim($_POST['sou_oth_oi_othint']),
              'sou_oth_oi_diviinc' => trim($_POST['sou_oth_oi_diviinc']),
              'sou_oth_oi_agriinc' => trim($_POST['sou_oth_oi_agriinc']),
              'sou_oth_exi_agriinc' => trim($_POST['sou_oth_exi_agriinc']),
              'sou_oth_exi_diviinc' => trim($_POST['sou_oth_exi_diviinc']),
              'sou_oth_exi_ltcg' => trim($_POST['sou_oth_exi_ltcg']),
              'sou_oth_exi_shopropartn' => trim($_POST['sou_oth_exi_shopropartn']),
              'sou_oth_exi_aopboi' => trim($_POST['sou_oth_exi_aopboi']),
              'sou_oth_exi_shoprop' => trim($_POST['sou_oth_exi_shoprop']),
              'sou_oth_exi_othinc' => trim($_POST['sou_oth_exi_othinc']),
              'sou_oth_exi_totexinc' => intval(trim($_POST['sou_oth_exi_totexinc'])),
            );

            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['saleOfLand_btn'])) {
        $fr_capg_id = 1;
        $fr_sousalnd_id = 0;
        $tbname = ' itr_capitalgain';
        $dataarray = array(
        'cg_cosonewasspuocons' => trim($_POST['cg_cosonewasspuocons']),
        'cg_dateopurconnewass' => trim($_POST['cg_dateopurconnewass']),
        'cg_amtdepoincg' => trim($_POST['cg_amtdepoincg']),
        );
        $commonFunction->dynamicUpdate($tbname, $dataarray);
        $tbname = 'itr_cg_saleoland_prop';
        $tbnamee = 'itr_cg_purchse_impro';
        $datalandinsert = array();
        foreach ($_POST['hidcheckslndorprop'] as $key => $value) {
            if ($value > 0) {
                $dataarrayupdate = array(
          'pk_sousalnd_id' => trim($_POST['hidcheckslndorprop'][$key]),
          'fr_capg_id' => $fr_capg_id,
          'sallndpro_salolandoprop' => trim($_POST['sallndpro_salolandoprop']),
          'sallndpro_sdt_dateosal' => trim($_POST['sallndpro_sdt_dateosal'][$key]),
          'sallndpro_sdt_salvalue' => trim($_POST['sallndpro_sdt_salvalue'][$key]),
          'sallndpro_sdt_expfosal' => trim($_POST['sallndpro_sdt_expfosal'][$key]),
          'sallndpro_sdt_stmpduval' => trim($_POST['sallndpro_sdt_stmpduval'][$key]),
          'sallndpro_sdt_slprconsi' => trim($_POST['sallndpro_sdt_slprconsi'][$key]),
          'sallndpro_sdt_decassold' => trim($_POST['sallndpro_sdt_decassold'][$key]),
          'sallndpro_topuimpcost' => trim($_POST['sallndpro_topuimpcost'][$key]),
          'sallndpro_cg' => trim($_POST['sallndpro_cg'][$key]),
          'sallndpro_taxoncg' => trim($_POST['sallndpro_taxoncg'][$key]),
          'sallndpro_taxsavinvest' => trim($_POST['sallndpro_taxsavinvest']),
          'sallndpro_invundsec54' => trim($_POST['sallndpro_invundsec54'][$key]),
          'sallndpro_invundsec54ec' => trim($_POST['sallndpro_invundsec54ec'][$key]),
          'sallndpro_invundsec54ee' => trim($_POST['sallndpro_invundsec54ee'][$key]),
          'sallndpro_invundsec54f' => trim($_POST['sallndpro_invundsec54f'][$key]),
          );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);

                $dataarraylimp = array();
                foreach ($_POST['hidcheckpurchimpro'] as $impkey => $impvalue) {
                    if ($_POST['hidcheck_subpart_propid'][$impkey] == $value) {
                        if ($impvalue > 0) {
                            $dataarrayupdateimp = array(
                  'pk_purchimp_id' => $impvalue,
                  'fr_sousalnd_id' => $value,
                  'sallndpro_purimp_datopur' => trim($_POST['sallndpro_purimp_datopur'][$impkey]),
                  'sallndpro_purimp_cost' => trim($_POST['sallndpro_purimp_cost'][$impkey]),
                  'sallndpro_purimp_tyocg' => trim($_POST['sallndpro_purimp_tyocg'][$impkey]),
                  'sallndpro_purimp_indcoprch' => trim($_POST['sallndpro_purimp_indcoprch'][$impkey]),
                  'sallndpro_purimp_cosoimp' => trim($_POST['sallndpro_purimp_cosoimp'][$impkey]),
                  'sallndpro_purimp_dateoimp' => trim($_POST['sallndpro_purimp_dateoimp'][$impkey]),
                  'sallndpro_purimp_indcooimp' => trim($_POST['sallndpro_purimp_indcooimp'][$impkey]),
                );
                            $commonFunction->dynamicUpdateMultiple($tbnamee, $dataarrayupdateimp);
                        } else {
                            $dataarraylimp[] = array(
                  'fr_sousalnd_id' => $value,
                  'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
                  'sallndpro_purimp_datopur' => trim($_POST['sallndpro_purimp_datopur'][$impkey]),
                  'sallndpro_purimp_cost' => trim($_POST['sallndpro_purimp_cost'][$impkey]),
                  'sallndpro_purimp_tyocg' => trim($_POST['sallndpro_purimp_tyocg'][$impkey]),
                  'sallndpro_purimp_indcoprch' => trim($_POST['sallndpro_purimp_indcoprch'][$impkey]),
                  'sallndpro_purimp_cosoimp' => trim($_POST['sallndpro_purimp_cosoimp'][$impkey]),
                  'sallndpro_purimp_dateoimp' => trim($_POST['sallndpro_purimp_dateoimp'][$impkey]),
                  'sallndpro_purimp_indcooimp' => trim($_POST['sallndpro_purimp_indcooimp'][$impkey]),
                );
                        }
                    }
                }
                if (!empty($dataarraylimp)) {
                    $commonFunction->insertMultiple($tbnamee, $dataarraylimp);
                }
            } else {
                $datalandinsert = array(
            'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
            'fr_capg_id' => $fr_capg_id,
            'sallndpro_salolandoprop' => trim($_POST['sallndpro_salolandoprop']),
            'sallndpro_sdt_dateosal' => trim($_POST['sallndpro_sdt_dateosal'][$key]),
            'sallndpro_sdt_salvalue' => trim($_POST['sallndpro_sdt_salvalue'][$key]),
            'sallndpro_sdt_expfosal' => trim($_POST['sallndpro_sdt_expfosal'][$key]),
            'sallndpro_sdt_stmpduval' => trim($_POST['sallndpro_sdt_stmpduval'][$key]),
            'sallndpro_sdt_slprconsi' => trim($_POST['sallndpro_sdt_slprconsi'][$key]),
            'sallndpro_sdt_decassold' => trim($_POST['sallndpro_sdt_decassold'][$key]),
            'sallndpro_topuimpcost' => trim($_POST['sallndpro_topuimpcost'][$key]),
            'sallndpro_cg' => trim($_POST['sallndpro_cg'][$key]),
            'sallndpro_taxoncg' => trim($_POST['sallndpro_taxoncg'][$key]),
            'sallndpro_taxsavinvest' => trim($_POST['sallndpro_taxsavinvest']),
            'sallndpro_invundsec54' => trim($_POST['sallndpro_invundsec54'][$key]),
            'sallndpro_invundsec54ec' => trim($_POST['sallndpro_invundsec54ec'][$key]),
            'sallndpro_invundsec54ee' => trim($_POST['sallndpro_invundsec54ee'][$key]),
            'sallndpro_invundsec54f' => trim($_POST['sallndpro_invundsec54f'][$key]),
          );
                if (!empty($datalandinsert)) {
                    $datalandinserta[0] = $datalandinsert;
                    $commonFunction->insertMultiple($tbname, $datalandinserta);
                }

                $dataarraynewlimp = array();
                foreach ($_POST['hidcheck_subpart_propid'] as $keyspi => $valuespi) {
                    if (!is_numeric($valuespi)) {
                        $landprop = explode('_', $value);
                        $valuespinum = explode('_', $valuespi);
                        if ($landprop[1] == $valuespinum[1]) {
                            $result = $commonFunction->latestRowById($tbname, $fr_user_id, 'pk_sousalnd_id', $limit = 1);
                            if ($result['pk_sousalnd_id']) {
                                $fr_sousalnd_id = $result['pk_sousalnd_id'];
                            }
                            $dataarraynewlimp[] = array(
                 'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
                  'fr_sousalnd_id' => $fr_sousalnd_id,
                  'sallndpro_purimp_datopur' => trim($_POST['sallndpro_purimp_datopur'][$keyspi]),
                  'sallndpro_purimp_cost' => trim($_POST['sallndpro_purimp_cost'][$keyspi]),
                  'sallndpro_purimp_tyocg' => trim($_POST['sallndpro_purimp_tyocg'][$keyspi]),
                  'sallndpro_purimp_indcoprch' => trim($_POST['sallndpro_purimp_indcoprch'][$keyspi]),
                  'sallndpro_purimp_cosoimp' => trim($_POST['sallndpro_purimp_cosoimp'][$keyspi]),
                  'sallndpro_purimp_dateoimp' => trim($_POST['sallndpro_purimp_dateoimp'][$keyspi]),
                  'sallndpro_purimp_indcooimp' => trim($_POST['sallndpro_purimp_indcooimp'][$keyspi]),
                );
                        }
                    }
                }
                if (!empty($dataarraynewlimp)) {
                    print_r($dataarraynewlimp);
                    $commonFunction->insertMultiple($tbnamee, $dataarraynewlimp);
                }
            }
        }
    } elseif (isset($_POST['saleomutfund_btn'])) {
        $tbname = ' itr_capitalgain';
        $dataarray = array(
    'cg_cosonewasspuocons' => trim($_POST['cg_cosonewasspuocons']),
    'cg_dateopurconnewass' => trim($_POST['cg_dateopurconnewass']),
    'cg_amtdepoincg' => trim($_POST['cg_amtdepoincg']),
  );
        $commonFunction->dynamicUpdate($tbname, $dataarray);

        $arraylength = count($_POST['hidcheckslmutfnd']);

        $fr_capg_id = 1;

        $tbname = 'itr_cg_saleomutualfunds';
        $dataarrayl = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckslmutfnd'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_somutfund_id' => trim($_POST['hidcheckslmutfnd'][$i]),
        'fr_capg_id' => $fr_capg_id,
        'somuf_somutfnd' => trim($_POST['somuf_somutfnd']),
        'somuf_typemutf' => trim($_POST['somuf_typemutf'][$i]),
        'somuf_decoasssold' => trim($_POST['somuf_decoasssold'][$i]),
        'somuf_saldet_saledate' => trim($_POST['somuf_saldet_saledate'][$i]),
        'somuf_purcdet_purcdate' => trim($_POST['somuf_purcdet_purcdate'][$i]),
        'somuf_saldet_salevalue' => trim($_POST['somuf_saldet_salevalue'][$i]),
        'somuf_saldet_exponsale' => trim($_POST['somuf_saldet_exponsale'][$i]),
        'somuf_saldet_sectratax' => trim($_POST['somuf_saldet_sectratax'][$i]),
        'somuf_saldet_sttpaid' => trim($_POST['somuf_saldet_sttpaid'][$i]),
        'somuf_op1_cgwoutbeindx' => trim($_POST['somuf_op1_cgwoutbeindx'][$i]),
        'somuf_taxocg10p' => trim($_POST['somuf_taxocg10p'][$i]),
        'somuf_purcdet_purcprice' => trim($_POST['somuf_purcdet_purcprice'][$i]),
        'somuf_purcdet_indcopurc' => trim($_POST['somuf_purcdet_indcopurc'][$i]),
        'somuf_purcdet_cgwoutbeindx' => trim($_POST['somuf_purcdet_cgwoutbeindx'][$i]),
        'somuf_op2_cgwithindx' => trim($_POST['somuf_op2_cgwithindx'][$i]),
        'somuf_taxocg20p' => trim($_POST['somuf_taxocg20p'][$i]),
        'somuf_taxsavinvest' => trim($_POST['somuf_taxsavinvest']),
        'somuf_invundsec54' => trim($_POST['somuf_invundsec54'][$i]),
        'somuf_invundsec54ec' => trim($_POST['somuf_invundsec54ec'][$i]),
        'somuf_invundsec54ee' => trim($_POST['somuf_invundsec54ee'][$i]),
        'somuf_invundsec54f' => trim($_POST['somuf_invundsec54f'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarrayl[] = array(
      'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_capg_id' => $fr_capg_id,
        'somuf_somutfnd' => trim($_POST['somuf_somutfnd']),
        'somuf_typemutf' => trim($_POST['somuf_typemutf'][$i]),
        'somuf_decoasssold' => trim($_POST['somuf_decoasssold'][$i]),
        'somuf_saldet_saledate' => trim($_POST['somuf_saldet_saledate'][$i]),
        'somuf_purcdet_purcdate' => trim($_POST['somuf_purcdet_purcdate'][$i]),
        'somuf_saldet_salevalue' => trim($_POST['somuf_saldet_salevalue'][$i]),
        'somuf_saldet_exponsale' => trim($_POST['somuf_saldet_exponsale'][$i]),
        'somuf_saldet_sectratax' => trim($_POST['somuf_saldet_sectratax'][$i]),
        'somuf_saldet_sttpaid' => trim($_POST['somuf_saldet_sttpaid'][$i]),
        'somuf_op1_cgwoutbeindx' => trim($_POST['somuf_op1_cgwoutbeindx'][$i]),
        'somuf_taxocg10p' => trim($_POST['somuf_taxocg10p'][$i]),
        'somuf_purcdet_purcprice' => trim($_POST['somuf_purcdet_purcprice'][$i]),
        'somuf_purcdet_indcopurc' => trim($_POST['somuf_purcdet_indcopurc'][$i]),
        'somuf_purcdet_cgwoutbeindx' => trim($_POST['somuf_purcdet_cgwoutbeindx'][$i]),
        'somuf_op2_cgwithindx' => trim($_POST['somuf_op2_cgwithindx'][$i]),
        'somuf_taxocg20p' => trim($_POST['somuf_taxocg20p'][$i]),
        'somuf_taxsavinvest' => trim($_POST['somuf_taxsavinvest']),
        'somuf_invundsec54' => trim($_POST['somuf_invundsec54'][$i]),
        'somuf_invundsec54ec' => trim($_POST['somuf_invundsec54ec'][$i]),
        'somuf_invundsec54ee' => trim($_POST['somuf_invundsec54ee'][$i]),
        'somuf_invundsec54f' => trim($_POST['somuf_invundsec54f'][$i]),
      );
            }
        }
        if (!empty($dataarrayl)) {
            $commonFunction->insertMultiple($tbname, $dataarrayl);
        }
    } elseif (isset($_POST['cg_saloshareodeb_btn'])) {
        $tbname = ' itr_capitalgain';
        $dataarray = array(
    'cg_cosonewasspuocons' => trim($_POST['cg_cosonewasspuocons']),
    'cg_dateopurconnewass' => trim($_POST['cg_dateopurconnewass']),
    'cg_amtdepoincg' => trim($_POST['cg_amtdepoincg']),
  );
        $commonFunction->dynamicUpdate($tbname, $dataarray);

        $arraylength = count($_POST['hidcheckslshdeb']);

        $fr_capg_id = 1;

        $tbname = 'itr_cg_saleoshareordeben';
        $dataarrayl = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckslshdeb'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_sashaodeb_id' => trim($_POST['hidcheckslshdeb'][$i]),
        'fr_capg_id' => $fr_capg_id,
        'sosh_soshadeb' => trim($_POST['sosh_soshadeb']),
        'sosh_typeosha' => trim($_POST['sosh_typeosha'][$i]),
        'sosh_decoasssold' => trim($_POST['sosh_decoasssold'][$i]),
        'sosh_saldet_saledate' => trim($_POST['sosh_saldet_saledate'][$i]),
        'sosh_purcdet_purcdate' => trim($_POST['sosh_purcdet_purcdate'][$i]),
        'sosh_saldet_salevalue' => trim($_POST['sosh_saldet_salevalue'][$i]),
        'sosh_saldet_exponsale' => trim($_POST['sosh_saldet_exponsale'][$i]),
        'sosh_saldet_sectratax' => trim($_POST['sosh_saldet_sectratax'][$i]),
        'sosh_saldet_sttpaid' => trim($_POST['sosh_saldet_sttpaid'][$i]),
        'sosh_op1_cgwoutbeindx' => trim($_POST['sosh_op1_cgwoutbeindx'][$i]),
        'sosh_taxocg10p' => trim($_POST['sosh_taxocg10p'][$i]),
        'sosh_purcdet_purcprice' => trim($_POST['sosh_purcdet_purcprice'][$i]),
        'sosh_purcdet_indcopurc' => trim($_POST['sosh_purcdet_indcopurc'][$i]),
        'sosh_purcdet_cgwoutbeindx' => trim($_POST['sosh_purcdet_cgwoutbeindx'][$i]),
        'sosh_op2_cgwithindx' => trim($_POST['sosh_op2_cgwithindx'][$i]),
        'sosh_taxocg20p' => trim($_POST['sosh_taxocg20p'][$i]),
        'sosh_taxsavinvest' => trim($_POST['sosh_taxsavinvest']),
        'sosh_invundsec54' => trim($_POST['sosh_invundsec54'][$i]),
        'sosh_invundsec54ec' => trim($_POST['sosh_invundsec54ec'][$i]),
        'sosh_invundsec54ee' => trim($_POST['sosh_invundsec54ee'][$i]),
        'sosh_invundsec54f' => trim($_POST['sosh_invundsec54f'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarrayl[] = array(
      'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_capg_id' => $fr_capg_id,
        'sosh_soshadeb' => trim($_POST['sosh_soshadeb']),
        'sosh_typeosha' => trim($_POST['sosh_typeosha'][$i]),
        'sosh_decoasssold' => trim($_POST['sosh_decoasssold'][$i]),
        'sosh_saldet_saledate' => trim($_POST['sosh_saldet_saledate'][$i]),
        'sosh_purcdet_purcdate' => trim($_POST['sosh_purcdet_purcdate'][$i]),
        'sosh_saldet_salevalue' => trim($_POST['sosh_saldet_salevalue'][$i]),
        'sosh_saldet_exponsale' => trim($_POST['sosh_saldet_exponsale'][$i]),
        'sosh_saldet_sectratax' => trim($_POST['sosh_saldet_sectratax'][$i]),
        'sosh_saldet_sttpaid' => trim($_POST['sosh_saldet_sttpaid'][$i]),
        'sosh_op1_cgwoutbeindx' => trim($_POST['sosh_op1_cgwoutbeindx'][$i]),
        'sosh_taxocg10p' => trim($_POST['sosh_taxocg10p'][$i]),
        'sosh_purcdet_purcprice' => trim($_POST['sosh_purcdet_purcprice'][$i]),
        'sosh_purcdet_indcopurc' => trim($_POST['sosh_purcdet_indcopurc'][$i]),
        'sosh_purcdet_cgwoutbeindx' => trim($_POST['sosh_purcdet_cgwoutbeindx'][$i]),
        'sosh_op2_cgwithindx' => trim($_POST['sosh_op2_cgwithindx'][$i]),
        'sosh_taxocg20p' => trim($_POST['sosh_taxocg20p'][$i]),
        'sosh_taxsavinvest' => trim($_POST['sosh_taxsavinvest']),
        'sosh_invundsec54' => trim($_POST['sosh_invundsec54'][$i]),
        'sosh_invundsec54ec' => trim($_POST['sosh_invundsec54ec'][$i]),
        'sosh_invundsec54ee' => trim($_POST['sosh_invundsec54ee'][$i]),
        'sosh_invundsec54f' => trim($_POST['sosh_invundsec54f'][$i]),
      );
            }
        }
        if (!empty($dataarrayl)) {
            $commonFunction->insertMultiple($tbname, $dataarrayl);
        }
    } elseif (isset($_POST['cg_salother_assets_btn'])) {
        $tbname = ' itr_capitalgain';
        $dataarray = array(
    'cg_cosonewasspuocons' => trim($_POST['cg_cosonewasspuocons']),
    'cg_dateopurconnewass' => trim($_POST['cg_dateopurconnewass']),
    'cg_amtdepoincg' => trim($_POST['cg_amtdepoincg']),
  );
        $commonFunction->dynamicUpdate($tbname, $dataarray);
        $arraylength = count($_POST['hidcheckslothass']);

        $fr_capg_id = 1;

        $tbname = 'itr_cg_saleotherassets';
        $dataarrayl = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckslothass'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_saothass_id' => trim($_POST['hidcheckslothass'][$i]),

        'fr_capg_id' => $fr_capg_id,
        'soa_othassets' => trim($_POST['soa_othassets']),
        'soa_decoasssold' => trim($_POST['soa_decoasssold'][$i]),
        'soa_saldet_saledate' => trim($_POST['soa_saldet_saledate'][$i]),
        'soa_purcdet_purcdate' => trim($_POST['soa_purcdet_purcdate'][$i]),
        'soa_saldet_saleprice' => trim($_POST['soa_saldet_saleprice'][$i]),
        'soa_saldet_exponsale' => trim($_POST['soa_saldet_exponsale'][$i]),
        'soa_saldet_sectratax' => trim($_POST['soa_saldet_sectratax'][$i]),
        'soa_purcdet_purccost' => trim($_POST['soa_purcdet_purccost'][$i]),
        'soa_purcdet_indcopurc' => trim($_POST['soa_purcdet_indcopurc'][$i]),
        'soa_purcdet_cosoimpro' => trim($_POST['soa_purcdet_cosoimpro'][$i]),
        'soa_purcdet_indcosoimpro' => trim($_POST['soa_purcdet_indcosoimpro'][$i]),
        'soa_capgain' => trim($_POST['soa_capgain'][$i]),
        'soa_taxoncapgain' => trim($_POST['soa_taxoncapgain'][$i]),
        'soa_taxsavinvest' => trim($_POST['soa_taxsavinvest']),
        'soa_invundsec54' => trim($_POST['soa_invundsec54'][$i]),
        'soa_invundsec54ec' => trim($_POST['soa_invundsec54ec'][$i]),
        'soa_invundsec54ee' => trim($_POST['soa_invundsec54ee'][$i]),
        'soa_invundsec54f' => trim($_POST['soa_invundsec54f'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarrayl[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_capg_id' => $fr_capg_id,
        'soa_othassets' => trim($_POST['soa_othassets']),
        'soa_decoasssold' => trim($_POST['soa_decoasssold'][$i]),
        'soa_saldet_saledate' => trim($_POST['soa_saldet_saledate'][$i]),
        'soa_purcdet_purcdate' => trim($_POST['soa_purcdet_purcdate'][$i]),
        'soa_saldet_saleprice' => trim($_POST['soa_saldet_saleprice'][$i]),
        'soa_saldet_exponsale' => trim($_POST['soa_saldet_exponsale'][$i]),
        'soa_saldet_sectratax' => trim($_POST['soa_saldet_sectratax'][$i]),
        'soa_purcdet_purccost' => trim($_POST['soa_purcdet_purccost'][$i]),
        'soa_purcdet_indcopurc' => trim($_POST['soa_purcdet_indcopurc'][$i]),
        'soa_purcdet_cosoimpro' => trim($_POST['soa_purcdet_cosoimpro'][$i]),
        'soa_purcdet_indcosoimpro' => trim($_POST['soa_purcdet_indcosoimpro'][$i]),
        'soa_capgain' => trim($_POST['soa_capgain'][$i]),
        'soa_taxoncapgain' => trim($_POST['soa_taxoncapgain'][$i]),
        'soa_taxsavinvest' => trim($_POST['soa_taxsavinvest']),
        'soa_invundsec54' => trim($_POST['soa_invundsec54'][$i]),
        'soa_invundsec54ec' => trim($_POST['soa_invundsec54ec'][$i]),
        'soa_invundsec54ee' => trim($_POST['soa_invundsec54ee'][$i]),
        'soa_invundsec54f' => trim($_POST['soa_invundsec54f'][$i]),
      );
            }
        }
        if (!empty($dataarrayl)) {
            $commonFunction->insertMultiple($tbname, $dataarrayl);
        }
    } elseif (isset($_POST['soubop_btn'])) {
        $tbname = ' itr_business_profession';
        $dataarray = array(
    'sou_bop_boaccmain' => trim($_POST['sou_bop_boaccmain']),
    'sou_bop_nameoentity' => trim($_POST['sou_bop_nameoentity']),
    'sou_bop_typeobusin' => trim($_POST['sou_bop_typeobusin']),
    'sou_bop_infoeligib' => trim($_POST['sou_bop_infoeligib']),
  );
        $commonFunction->dynamicUpdate($tbname, $dataarray);

        $arraylength = count($_POST['hidchecksoubop']);

        $fr_bop_id = 1;

        $tbname = 'itr_business_profe_addmor';
        $dataarrayl = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidchecksoubop'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_bopaddmor_id' => trim($_POST['hidchecksoubop'][$i]),

        'fr_bop_id' => $fr_bop_id,
       'sou_bop_natuoinco' => trim($_POST['sou_bop_natuoinco'][$i]),
       'sou_bop_fp_sundeb' => trim($_POST['sou_bop_fp_sundeb'][$i]),
       'sou_bop_fp_suncre' => trim($_POST['sou_bop_fp_suncre'][$i]),
       'sou_bop_fp_stoitra' => trim($_POST['sou_bop_fp_stoitra'][$i]),
       'sou_bop_fp_casbal' => trim($_POST['sou_bop_fp_casbal'][$i]),
       'sou_bop_pp_grorec' => trim($_POST['sou_bop_pp_grorec'][$i]),
       'sou_bop_pp_direxp' => trim($_POST['sou_bop_pp_direxp'][$i]),
       'sou_bop_pp_groprof' => trim($_POST['sou_bop_pp_groprof'][$i]),
       'sou_bop_pp_indexp' => trim($_POST['sou_bop_pp_indexp'][$i]),
       'sou_bop_pp_netprof' => trim($_POST['sou_bop_pp_netprof'][$i]),
       'sou_bop_incfbusoprof' => trim($_POST['sou_bop_incfbusoprof'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarrayl[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_bop_id' => $fr_bop_id,
        'sou_bop_natuoinco' => trim($_POST['sou_bop_natuoinco'][$i]),
        'sou_bop_fp_sundeb' => trim($_POST['sou_bop_fp_sundeb'][$i]),
        'sou_bop_fp_suncre' => trim($_POST['sou_bop_fp_suncre'][$i]),
        'sou_bop_fp_stoitra' => trim($_POST['sou_bop_fp_stoitra'][$i]),
        'sou_bop_fp_casbal' => trim($_POST['sou_bop_fp_casbal'][$i]),
        'sou_bop_pp_grorec' => trim($_POST['sou_bop_pp_grorec'][$i]),
        'sou_bop_pp_direxp' => trim($_POST['sou_bop_pp_direxp'][$i]),
        'sou_bop_pp_groprof' => trim($_POST['sou_bop_pp_groprof'][$i]),
        'sou_bop_pp_indexp' => trim($_POST['sou_bop_pp_indexp'][$i]),
        'sou_bop_pp_netprof' => trim($_POST['sou_bop_pp_netprof'][$i]),
        'sou_bop_incfbusoprof' => trim($_POST['sou_bop_incfbusoprof'][$i]),
      );
            }
        }
        if (!empty($dataarrayl)) {
            $commonFunction->insertMultiple($tbname, $dataarrayl);
        }
    } elseif (isset($_POST['presumptive_btn'])) {
        $tbname = ' itr_presumptive';
        $dataarray = array(
    'pre_inc_nameoentity' => trim($_POST['pre_inc_nameoentity']),
    'pre_inc_typeobusin' => trim($_POST['pre_inc_typeobusin']),
    'pre_inc_natopreinc' => trim($_POST['pre_inc_natopreinc']),
    'pre_44ad_u8ptax_gro_rece' => trim($_POST['pre_44ad_u8ptax_gro_rece']),
    'pre_44ad_u8ptax_pre_prof' => trim($_POST['pre_44ad_u8ptax_pre_prof']),
    'pre_44ad_u6ptax_gro_rece' => trim($_POST['pre_44ad_u6ptax_gro_rece']),
    'pre_44ad_u6ptax_pre_prof' => trim($_POST['pre_44ad_u6ptax_pre_prof']),
    'pre_44ad_piptax50_gro_rece' => trim($_POST['pre_44ad_piptax50_gro_rece']),
    'pre_44ada_piptax50_pre_prof' => trim($_POST['pre_44ada_piptax50_pre_prof']),
    'pre_totinccha_und_pgbphead' => trim($_POST['pre_totinccha_und_pgbphead']),
  );
        $commonFunction->dynamicUpdate($tbname, $dataarray);

        $arraylength = count($_POST['hidcheckpervec']);

        $presump_id = 1;

        $tbname = 'itr_presumptive_tax44ae';
        $dataarrayl = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckpervec'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_pretax44ae_id' => trim($_POST['hidcheckpervec'][$i]),

        'fr_presump_id' => $presump_id,
        'pre_44ae_holdvechile' => trim($_POST['pre_44ae_holdvechile'][$i]),
        'pre_44ae_incearned' => trim($_POST['pre_44ae_incearned'][$i]),
        'pre_44ae_demedinco' => trim($_POST['pre_44ae_demedinco'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarrayl[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_presump_id' => $presump_id,
        'pre_44ae_holdvechile' => trim($_POST['pre_44ae_holdvechile'][$i]),
        'pre_44ae_incearned' => trim($_POST['pre_44ae_incearned'][$i]),
        'pre_44ae_demedinco' => trim($_POST['pre_44ae_demedinco'][$i]),
      );
            }
        }
        if (!empty($dataarrayl)) {
            $commonFunction->insertMultiple($tbname, $dataarrayl);
        }
    } elseif (isset($_POST['sou_partnership_btn'])) {
        $arraylength = count($_POST['hidcheckpts']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_sou_partnership';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckpts'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_ptship_id' => trim($_POST['hidcheckpts'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'sou_pts_nameoptsfir' => trim($_POST['sou_pts_nameoptsfir'][$i]),
        'sou_pts_panoptsfir' => trim($_POST['sou_pts_panoptsfir'][$i]),
        'sou_pts_firlibaud' => trim($_POST['sou_pts_firlibaud'][$i]),
        'sou_pts_trprauapfir' => trim($_POST['sou_pts_trprauapfir'][$i]),
        'sou_pts_capbal31mar' => trim($_POST['sou_pts_capbal31mar'][$i]),
        'sou_pts_shaoproft' => trim($_POST['sou_pts_shaoproft'][$i]),
        'sou_pts_invoncap' => trim($_POST['sou_pts_invoncap'][$i]),
        'sou_pts_remunera' => trim($_POST['sou_pts_remunera'][$i]),
        'sou_pts_prftloss' => trim($_POST['sou_pts_prftloss'][$i]),
        'sou_pts_expenses' => trim($_POST['sou_pts_expenses'][$i]),
        'sou_pts_exp35ac' => trim($_POST['sou_pts_exp35ac'][$i]),
        'sou_pts_nettaxincrec' => trim($_POST['sou_pts_nettaxincrec'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'sou_pts_nameoptsfir' => trim($_POST['sou_pts_nameoptsfir'][$i]),
        'sou_pts_panoptsfir' => trim($_POST['sou_pts_panoptsfir'][$i]),
        'sou_pts_firlibaud' => trim($_POST['sou_pts_firlibaud'][$i]),
        'sou_pts_trprauapfir' => trim($_POST['sou_pts_trprauapfir'][$i]),
        'sou_pts_capbal31mar' => trim($_POST['sou_pts_capbal31mar'][$i]),
        'sou_pts_shaoproft' => trim($_POST['sou_pts_shaoproft'][$i]),
        'sou_pts_invoncap' => trim($_POST['sou_pts_invoncap'][$i]),
        'sou_pts_remunera' => trim($_POST['sou_pts_remunera'][$i]),
        'sou_pts_prftloss' => trim($_POST['sou_pts_prftloss'][$i]),
        'sou_pts_expenses' => trim($_POST['sou_pts_expenses'][$i]),
        'sou_pts_exp35ac' => trim($_POST['sou_pts_exp35ac'][$i]),
        'sou_pts_nettaxincrec' => trim($_POST['sou_pts_nettaxincrec'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['foa_forginassets_btn'])) {
        $arraylength = count($_POST['hidcheckfoa']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_foa_forginassets';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfoa'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_fa_id' => trim($_POST['hidcheckfoa'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_fa_forbankacc' => trim($_POST['foa_fa_forbankacc']),
        'foa_fa_country' => trim($_POST['foa_fa_country'][$i]),
        'foa_fa_bname' => trim($_POST['foa_fa_bname'][$i]),
        'foa_fa_addobank' => trim($_POST['foa_fa_addobank'][$i]),
        'foa_fa_zipcod' => trim($_POST['foa_fa_zipcod'][$i]),
        'foa_fa_acchname' => trim($_POST['foa_fa_acchname'][$i]),
        'foa_fa_onership' => trim($_POST['foa_fa_onership'][$i]),
        'foa_fa_accno' => trim($_POST['foa_fa_accno'][$i]),
        'foa_fa_accopdate' => trim($_POST['foa_fa_accopdate'][$i]),
        'foa_fa_swiftcode' => trim($_POST['foa_fa_swiftcode'][$i]),
        'foa_fa_pakbdyear' => trim($_POST['foa_fa_pakbdyear'][$i]),
        'foa_fa_intaccdyear' => trim($_POST['foa_fa_intaccdyear'][$i]),
        'foa_fa_txablint' => trim($_POST['foa_fa_txablint'][$i]),
        'foa_fa_intdis' => trim($_POST['foa_fa_intdis'][$i]),
        'foa_fa_itmnosdu' => trim($_POST['foa_fa_itmnosdu'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
      'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_fa_forbankacc' => trim($_POST['foa_fa_forbankacc']),
        'foa_fa_country' => trim($_POST['foa_fa_country'][$i]),
        'foa_fa_bname' => trim($_POST['foa_fa_bname'][$i]),
        'foa_fa_addobank' => trim($_POST['foa_fa_addobank'][$i]),
        'foa_fa_zipcod' => trim($_POST['foa_fa_zipcod'][$i]),
        'foa_fa_acchname' => trim($_POST['foa_fa_acchname'][$i]),
        'foa_fa_onership' => trim($_POST['foa_fa_onership'][$i]),
        'foa_fa_accno' => trim($_POST['foa_fa_accno'][$i]),
        'foa_fa_accopdate' => trim($_POST['foa_fa_accopdate'][$i]),
        'foa_fa_swiftcode' => trim($_POST['foa_fa_swiftcode'][$i]),
        'foa_fa_pakbdyear' => trim($_POST['foa_fa_pakbdyear'][$i]),
        'foa_fa_intaccdyear' => trim($_POST['foa_fa_intaccdyear'][$i]),
        'foa_fa_txablint' => trim($_POST['foa_fa_txablint'][$i]),
        'foa_fa_intdis' => trim($_POST['foa_fa_intdis'][$i]),
        'foa_fa_itmnosdu' => trim($_POST['foa_fa_itmnosdu'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['foa_financial_interest_btn'])) {
        $arraylength = count($_POST['hidcheckfoafi']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_foa_financialinterest';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfoafi'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_fi_id' => trim($_POST['hidcheckfoafi'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_fi_detfinintforcoun' => trim($_POST['foa_fi_detfinintforcoun']),
        'foa_fi_country' => trim($_POST['foa_fi_country'][$i]),
        'foa_fi_zipcod' => trim($_POST['foa_fi_zipcod'][$i]),
        'foa_fi_natuentity' => trim($_POST['foa_fi_natuentity'][$i]),
        'foa_fi_nameentity' => trim($_POST['foa_fi_nameentity'][$i]),
        'foa_fi_addentity' => trim($_POST['foa_fi_addentity'][$i]),
        'foa_fi_natuinte' => trim($_POST['foa_fi_natuinte'][$i]),
        'foa_fi_datesh' => trim($_POST['foa_fi_datesh'][$i]),
        'foa_fi_toinvscost' => trim($_POST['foa_fi_toinvscost'][$i]),
        'foa_fi_intacc' => trim($_POST['foa_fi_intacc'][$i]),
        'foa_fi_natuoinc' => trim($_POST['foa_fi_natuoinc'][$i]),
        'foa_fi_amttaxoff' => trim($_POST['foa_fi_amttaxoff'][$i]),
        'foa_fi_sduintdisc' => trim($_POST['foa_fi_sduintdisc'][$i]),
        'foa_fi_itmnosdu' => trim($_POST['foa_fi_itmnosdu'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_fi_detfinintforcoun' => trim($_POST['foa_fi_detfinintforcoun']),
        'foa_fi_country' => trim($_POST['foa_fi_country'][$i]),
        'foa_fi_zipcod' => trim($_POST['foa_fi_zipcod'][$i]),
        'foa_fi_natuentity' => trim($_POST['foa_fi_natuentity'][$i]),
        'foa_fi_nameentity' => trim($_POST['foa_fi_nameentity'][$i]),
        'foa_fi_addentity' => trim($_POST['foa_fi_addentity'][$i]),
        'foa_fi_natuinte' => trim($_POST['foa_fi_natuinte'][$i]),
        'foa_fi_datesh' => trim($_POST['foa_fi_datesh'][$i]),
        'foa_fi_toinvscost' => trim($_POST['foa_fi_toinvscost'][$i]),
        'foa_fi_intacc' => trim($_POST['foa_fi_intacc'][$i]),
        'foa_fi_natuoinc' => trim($_POST['foa_fi_natuoinc'][$i]),
        'foa_fi_amttaxoff' => trim($_POST['foa_fi_amttaxoff'][$i]),
        'foa_fi_sduintdisc' => trim($_POST['foa_fi_sduintdisc'][$i]),
        'foa_fi_itmnosdu' => trim($_POST['foa_fi_itmnosdu'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['foa_immovableproperty_btn'])) {
        $arraylength = count($_POST['hidcheckfoaip']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_foa_immovableproperty';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfoaip'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_ip_id' => trim($_POST['hidcheckfoaip'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_ip_imoprooutind' => trim($_POST['foa_ip_imoprooutind']),
        'foa_ip_country' => trim($_POST['foa_ip_country'][$i]),
        'foa_ip_zipcod' => trim($_POST['foa_ip_zipcod'][$i]),
        'foa_ip_addoprop' => trim($_POST['foa_ip_addoprop'][$i]),
        'foa_ip_ownership' => trim($_POST['foa_ip_ownership'][$i]),
        'foa_ip_dateoacqui' => trim($_POST['foa_ip_dateoacqui'][$i]),
        'foa_ip_toinvscost' => trim($_POST['foa_ip_toinvscost'][$i]),
        'foa_ip_incfprop' => trim($_POST['foa_ip_incfprop'][$i]),
        'foa_ip_natuoinc' => trim($_POST['foa_ip_natuoinc'][$i]),
        'foa_ip_amttaxoff' => trim($_POST['foa_ip_amttaxoff'][$i]),
        'foa_ip_sduintdisc' => trim($_POST['foa_ip_sduintdisc'][$i]),
        'foa_ip_itmnosdu' => trim($_POST['foa_ip_itmnosdu'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
     'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_ip_imoprooutind' => trim($_POST['foa_ip_imoprooutind']),
        'foa_ip_country' => trim($_POST['foa_ip_country'][$i]),
        'foa_ip_zipcod' => trim($_POST['foa_ip_zipcod'][$i]),
        'foa_ip_addoprop' => trim($_POST['foa_ip_addoprop'][$i]),
        'foa_ip_ownership' => trim($_POST['foa_ip_ownership'][$i]),
        'foa_ip_dateoacqui' => trim($_POST['foa_ip_dateoacqui'][$i]),
        'foa_ip_toinvscost' => trim($_POST['foa_ip_toinvscost'][$i]),
        'foa_ip_incfprop' => trim($_POST['foa_ip_incfprop'][$i]),
        'foa_ip_natuoinc' => trim($_POST['foa_ip_natuoinc'][$i]),
        'foa_ip_amttaxoff' => trim($_POST['foa_ip_amttaxoff'][$i]),
        'foa_ip_sduintdisc' => trim($_POST['foa_ip_sduintdisc'][$i]),
        'foa_ip_itmnosdu' => trim($_POST['foa_ip_itmnosdu'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['foa_othcaptialassets_btn'])) {
        $arraylength = count($_POST['hidcheckfoaoca']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_foa_othcaptialassets';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfoaoca'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_oca_id' => trim($_POST['hidcheckfoaoca'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_oca_ocaoutind' => trim($_POST['foa_oca_ocaoutind']),
        'foa_oca_country' => trim($_POST['foa_oca_country'][$i]),
        'foa_oca_zipcod' => trim($_POST['foa_oca_zipcod'][$i]),
        'foa_oca_natuoass' => trim($_POST['foa_oca_natuoass'][$i]),
        'foa_oca_ownership' => trim($_POST['foa_oca_ownership'][$i]),
        'foa_oca_dateoacqui' => trim($_POST['foa_oca_dateoacqui'][$i]),
        'foa_oca_toinvscost' => trim($_POST['foa_oca_toinvscost'][$i]),
        'foa_oca_incderisasset' => trim($_POST['foa_oca_incderisasset'][$i]),
        'foa_oca_natuoinc' => trim($_POST['foa_oca_natuoinc'][$i]),
        'foa_oca_amttaxoff' => trim($_POST['foa_oca_amttaxoff'][$i]),
        'foa_oca_sduintdisc' => trim($_POST['foa_oca_sduintdisc'][$i]),
        'foa_oca_itmnosdu' => trim($_POST['foa_oca_itmnosdu'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
      'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_oca_ocaoutind' => trim($_POST['foa_oca_ocaoutind']),
        'foa_oca_country' => trim($_POST['foa_oca_country'][$i]),
        'foa_oca_zipcod' => trim($_POST['foa_oca_zipcod'][$i]),
        'foa_oca_natuoass' => trim($_POST['foa_oca_natuoass'][$i]),
        'foa_oca_ownership' => trim($_POST['foa_oca_ownership'][$i]),
        'foa_oca_dateoacqui' => trim($_POST['foa_oca_dateoacqui'][$i]),
        'foa_oca_toinvscost' => trim($_POST['foa_oca_toinvscost'][$i]),
        'foa_oca_incderisasset' => trim($_POST['foa_oca_incderisasset'][$i]),
        'foa_oca_natuoinc' => trim($_POST['foa_oca_natuoinc'][$i]),
        'foa_oca_amttaxoff' => trim($_POST['foa_oca_amttaxoff'][$i]),
        'foa_oca_sduintdisc' => trim($_POST['foa_oca_sduintdisc'][$i]),
        'foa_oca_itmnosdu' => trim($_POST['foa_oca_itmnosdu'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['foa_signingauthority_btn'])) {
        $arraylength = count($_POST['hidcheckfoasig']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_foa_signingauthority';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfoasig'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_sig_id' => trim($_POST['hidcheckfoasig'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_sig_sigautaccoutind' => trim($_POST['foa_sig_sigautaccoutind']),
        'foa_sig_nameoinstitu' => trim($_POST['foa_sig_nameoinstitu'][$i]),
        'foa_sig_addoinstitu' => trim($_POST['foa_sig_addoinstitu'][$i]),
        'foa_sig_country' => trim($_POST['foa_sig_country'][$i]),
        'foa_sig_zipcod' => trim($_POST['foa_sig_zipcod'][$i]),
        'foa_sig_accholdname' => trim($_POST['foa_sig_accholdname'][$i]),
        'foa_sig_accno' => trim($_POST['foa_sig_accno'][$i]),
        'foa_sig_pakbal' => trim($_POST['foa_sig_pakbal'][$i]),
        'foa_sig_inctaxablinhand' => trim($_POST['foa_sig_inctaxablinhand'][$i]),
        'foa_sig_incinacc' => trim($_POST['foa_sig_incinacc'][$i]),
        'foa_sig_amttaxoff' => trim($_POST['foa_sig_amttaxoff'][$i]),
        'foa_sig_sduintdisc' => trim($_POST['foa_sig_sduintdisc'][$i]),
        'foa_sig_itmnosdu' => trim($_POST['foa_sig_itmnosdu'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_sig_sigautaccoutind' => trim($_POST['foa_sig_sigautaccoutind']),
        'foa_sig_nameoinstitu' => trim($_POST['foa_sig_nameoinstitu'][$i]),
        'foa_sig_addoinstitu' => trim($_POST['foa_sig_addoinstitu'][$i]),
        'foa_sig_country' => trim($_POST['foa_sig_country'][$i]),
        'foa_sig_zipcod' => trim($_POST['foa_sig_zipcod'][$i]),
        'foa_sig_accholdname' => trim($_POST['foa_sig_accholdname'][$i]),
        'foa_sig_accno' => trim($_POST['foa_sig_accno'][$i]),
        'foa_sig_pakbal' => trim($_POST['foa_sig_pakbal'][$i]),
        'foa_sig_inctaxablinhand' => trim($_POST['foa_sig_inctaxablinhand'][$i]),
        'foa_sig_incinacc' => trim($_POST['foa_sig_incinacc'][$i]),
        'foa_sig_amttaxoff' => trim($_POST['foa_sig_amttaxoff'][$i]),
        'foa_sig_sduintdisc' => trim($_POST['foa_sig_sduintdisc'][$i]),
        'foa_sig_itmnosdu' => trim($_POST['foa_sig_itmnosdu'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['foa_detailsoftrust_btn'])) {
        $arraylength = count($_POST['hidcheckfoadot']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_foa_detailsoftrust';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfoadot'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_dot_id' => trim($_POST['hidcheckfoadot'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_dot_creulowoutind' => trim($_POST['foa_dot_creulowoutind']),
        'foa_dot_country' => trim($_POST['foa_dot_country'][$i]),
        'foa_dot_zipcod' => trim($_POST['foa_dot_zipcod'][$i]),
        'foa_dot_nameotrust' => trim($_POST['foa_dot_nameotrust'][$i]),
        'foa_dot_addotrust' => trim($_POST['foa_dot_addotrust'][$i]),
        'foa_dot_nameotrustees' => trim($_POST['foa_dot_nameotrustees'][$i]),
        'foa_dot_addotrustees' => trim($_POST['foa_dot_addotrustees'][$i]),
        'foa_dot_nameosettlor' => trim($_POST['foa_dot_nameosettlor'][$i]),
        'foa_dot_addosettlor' => trim($_POST['foa_dot_addosettlor'][$i]),
        'foa_dot_nameobeni' => trim($_POST['foa_dot_nameobeni'][$i]),
        'foa_dot_addobeni' => trim($_POST['foa_dot_addobeni'][$i]),
        'foa_dot_dateposih' => trim($_POST['foa_dot_dateposih'][$i]),
        'foa_dot_taxbleinhand' => trim($_POST['foa_dot_taxbleinhand'][$i]),
        'foa_dot_incftrst' => trim($_POST['foa_dot_incftrst'][$i]),
        'foa_dot_amttaxoff' => trim($_POST['foa_dot_amttaxoff'][$i]),
        'foa_dot_sduamtdis' => trim($_POST['foa_dot_sduamtdis'][$i]),
        'foa_dot_itmnosdu' => trim($_POST['foa_dot_itmnosdu'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_dot_creulowoutind' => trim($_POST['foa_dot_creulowoutind']),
        'foa_dot_country' => trim($_POST['foa_dot_country'][$i]),
        'foa_dot_zipcod' => trim($_POST['foa_dot_zipcod'][$i]),
        'foa_dot_nameotrust' => trim($_POST['foa_dot_nameotrust'][$i]),
        'foa_dot_addotrust' => trim($_POST['foa_dot_addotrust'][$i]),
        'foa_dot_nameotrustees' => trim($_POST['foa_dot_nameotrustees'][$i]),
        'foa_dot_addotrustees' => trim($_POST['foa_dot_addotrustees'][$i]),
        'foa_dot_nameosettlor' => trim($_POST['foa_dot_nameosettlor'][$i]),
        'foa_dot_addosettlor' => trim($_POST['foa_dot_addosettlor'][$i]),
        'foa_dot_nameobeni' => trim($_POST['foa_dot_nameobeni'][$i]),
        'foa_dot_addobeni' => trim($_POST['foa_dot_addobeni'][$i]),
        'foa_dot_dateposih' => trim($_POST['foa_dot_dateposih'][$i]),
        'foa_dot_taxbleinhand' => trim($_POST['foa_dot_taxbleinhand'][$i]),
        'foa_dot_incftrst' => trim($_POST['foa_dot_incftrst'][$i]),
        'foa_dot_amttaxoff' => trim($_POST['foa_dot_amttaxoff'][$i]),
        'foa_dot_sduamtdis' => trim($_POST['foa_dot_sduamtdis'][$i]),
        'foa_dot_itmnosdu' => trim($_POST['foa_dot_itmnosdu'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    } elseif (isset($_POST['foa_othincomederived_btn'])) {
        $arraylength = count($_POST['hidcheckfoaoid']);

        $fr_itr_sou_id = 1;
        $tbname = 'itr_foa_othincomederived';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfoaoid'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_oid_id' => trim($_POST['hidcheckfoaoid'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_oid_bthsououtind' => trim($_POST['foa_oid_bthsououtind']),
        'foa_oid_country' => trim($_POST['foa_oid_country'][$i]),
        'foa_oid_zipcod' => trim($_POST['foa_oid_zipcod'][$i]),
        'foa_oid_nameopderi' => trim($_POST['foa_oid_nameopderi'][$i]),
        'foa_oid_addopderi' => trim($_POST['foa_oid_addopderi'][$i]),
        'foa_oid_incderi' => trim($_POST['foa_oid_incderi'][$i]),
        'foa_oid_natuoinc' => trim($_POST['foa_oid_natuoinc'][$i]),
        'foa_oid_inctaxbleinhnd' => trim($_POST['foa_oid_inctaxbleinhnd'][$i]),
        'foa_oid_amttaxoff' => trim($_POST['foa_oid_amttaxoff'][$i]),
        'foa_oid_sduintdis' => trim($_POST['foa_oid_sduintdis'][$i]),
        'foa_oid_itmnosdu' => trim($_POST['foa_oid_itmnosdu'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'foa_oid_bthsououtind' => trim($_POST['foa_oid_bthsououtind']),
        'foa_oid_country' => trim($_POST['foa_oid_country'][$i]),
        'foa_oid_zipcod' => trim($_POST['foa_oid_zipcod'][$i]),
        'foa_oid_nameopderi' => trim($_POST['foa_oid_nameopderi'][$i]),
        'foa_oid_addopderi' => trim($_POST['foa_oid_addopderi'][$i]),
        'foa_oid_incderi' => trim($_POST['foa_oid_incderi'][$i]),
        'foa_oid_natuoinc' => trim($_POST['foa_oid_natuoinc'][$i]),
        'foa_oid_inctaxbleinhnd' => trim($_POST['foa_oid_inctaxbleinhnd'][$i]),
        'foa_oid_amttaxoff' => trim($_POST['foa_oid_amttaxoff'][$i]),
        'foa_oid_sduintdis' => trim($_POST['foa_oid_sduintdis'][$i]),
        'foa_oid_itmnosdu' => trim($_POST['foa_oid_itmnosdu'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    }
    if (isset($_POST['foreignincome_btn'])) {
        $arraylength = count($_POST['hidcheckfaofoi']);

        $fr_itr_sou_id = 1;

        $tbname = 'itr_sou_foreignincome';
        $dataarray = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidcheckfaofoi'][$i]) != 0) {
                $dataarrayupdate = array(
        'pk_forinc_id' => trim($_POST['hidcheckfaofoi'][$i]),

        'fr_itr_sou_id' => $fr_itr_sou_id,
        'sou_foi_incout_indtaxrel' => trim($_POST['sou_foi_incout_indtaxrel']),
        'sou_foi_coun' => trim($_POST['sou_foi_coun'][$i]),
        'sou_foi_taxpid' => trim($_POST['sou_foi_taxpid'][$i]),
        'sou_foi_sal_incoutind' => trim($_POST['sou_foi_sal_incoutind'][$i]),
        'sou_foi_sal_taxpoutind' => trim($_POST['sou_foi_sal_taxpoutind'][$i]),
        'sou_foi_sal_taxpinind' => trim($_POST['sou_foi_sal_taxpinind'][$i]),
        'sou_foi_sal_taxrelavainind' => trim($_POST['sou_foi_sal_taxrelavainind'][$i]),
        'sou_foi_sal_releartodata' => trim($_POST['sou_foi_sal_releartodata'][$i]),
        'sou_foi_houp_incoutind' => trim($_POST['sou_foi_houp_incoutind'][$i]),
        'sou_foi_houp_taxpoutind' => trim($_POST['sou_foi_houp_taxpoutind'][$i]),
        'sou_foi_houp_taxpinind' => trim($_POST['sou_foi_houp_taxpinind'][$i]),
        'sou_foi_houp_taxrelavainind' => trim($_POST['sou_foi_houp_taxrelavainind'][$i]),
        'sou_foi_houp_releartodata' => trim($_POST['sou_foi_houp_releartodata'][$i]),
        'sou_foi_businc_incoutind' => trim($_POST['sou_foi_businc_incoutind'][$i]),
        'sou_foi_businc_taxpoutind' => trim($_POST['sou_foi_businc_taxpoutind'][$i]),
        'sou_foi_businc_taxpinind' => trim($_POST['sou_foi_businc_taxpinind'][$i]),
        'sou_foi_businc_taxrelavainind' => trim($_POST['sou_foi_businc_taxrelavainind'][$i]),
        'sou_foi_businc_releartodata' => trim($_POST['sou_foi_businc_releartodata'][$i]),
        'sou_foi_capg_incoutind' => trim($_POST['sou_foi_capg_incoutind'][$i]),
        'sou_foi_capg_taxpoutind' => trim($_POST['sou_foi_capg_taxpoutind'][$i]),
        'sou_foi_capg_taxpinind' => trim($_POST['sou_foi_capg_taxpinind'][$i]),
        'sou_foi_capg_taxrelavainind' => trim($_POST['sou_foi_capg_taxrelavainind'][$i]),
        'sou_foi_capg_releartodata' => trim($_POST['sou_foi_capg_releartodata'][$i]),
        'sou_foi_otsou_incoutind' => trim($_POST['sou_foi_otsou_incoutind'][$i]),
        'sou_foi_otsou_taxpoutind' => trim($_POST['sou_foi_otsou_taxpoutind'][$i]),
        'sou_foi_otsou_taxpinind' => trim($_POST['sou_foi_otsou_taxpinind'][$i]),
        'sou_foi_otsou_taxrelavainind' => trim($_POST['sou_foi_otsou_taxrelavainind'][$i]),
        'sou_foi_otsou_releartodata' => trim($_POST['sou_foi_otsou_releartodata'][$i]),
      );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } else {
                $dataarray[] = array(
       'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_itr_sou_id' => $fr_itr_sou_id,
        'sou_foi_incout_indtaxrel' => trim($_POST['sou_foi_incout_indtaxrel']),
        'sou_foi_coun' => trim($_POST['sou_foi_coun'][$i]),
        'sou_foi_taxpid' => trim($_POST['sou_foi_taxpid'][$i]),
        'sou_foi_sal_incoutind' => trim($_POST['sou_foi_sal_incoutind'][$i]),
        'sou_foi_sal_taxpoutind' => trim($_POST['sou_foi_sal_taxpoutind'][$i]),
        'sou_foi_sal_taxpinind' => trim($_POST['sou_foi_sal_taxpinind'][$i]),
        'sou_foi_sal_taxrelavainind' => trim($_POST['sou_foi_sal_taxrelavainind'][$i]),
        'sou_foi_sal_releartodata' => trim($_POST['sou_foi_sal_releartodata'][$i]),
        'sou_foi_houp_incoutind' => trim($_POST['sou_foi_houp_incoutind'][$i]),
        'sou_foi_houp_taxpoutind' => trim($_POST['sou_foi_houp_taxpoutind'][$i]),
        'sou_foi_houp_taxpinind' => trim($_POST['sou_foi_houp_taxpinind'][$i]),
        'sou_foi_houp_taxrelavainind' => trim($_POST['sou_foi_houp_taxrelavainind'][$i]),
        'sou_foi_houp_releartodata' => trim($_POST['sou_foi_houp_releartodata'][$i]),
        'sou_foi_businc_incoutind' => trim($_POST['sou_foi_businc_incoutind'][$i]),
        'sou_foi_businc_taxpoutind' => trim($_POST['sou_foi_businc_taxpoutind'][$i]),
        'sou_foi_businc_taxpinind' => trim($_POST['sou_foi_businc_taxpinind'][$i]),
        'sou_foi_businc_taxrelavainind' => trim($_POST['sou_foi_businc_taxrelavainind'][$i]),
        'sou_foi_businc_releartodata' => trim($_POST['sou_foi_businc_releartodata'][$i]),
        'sou_foi_capg_incoutind' => trim($_POST['sou_foi_capg_incoutind'][$i]),
        'sou_foi_capg_taxpoutind' => trim($_POST['sou_foi_capg_taxpoutind'][$i]),
        'sou_foi_capg_taxpinind' => trim($_POST['sou_foi_capg_taxpinind'][$i]),
        'sou_foi_capg_taxrelavainind' => trim($_POST['sou_foi_capg_taxrelavainind'][$i]),
        'sou_foi_capg_releartodata' => trim($_POST['sou_foi_capg_releartodata'][$i]),
        'sou_foi_otsou_incoutind' => trim($_POST['sou_foi_otsou_incoutind'][$i]),
        'sou_foi_otsou_taxpoutind' => trim($_POST['sou_foi_otsou_taxpoutind'][$i]),
        'sou_foi_otsou_taxpinind' => trim($_POST['sou_foi_otsou_taxpinind'][$i]),
        'sou_foi_otsou_taxrelavainind' => trim($_POST['sou_foi_otsou_taxrelavainind'][$i]),
        'sou_foi_otsou_releartodata' => trim($_POST['sou_foi_otsou_releartodata'][$i]),
      );
            }
        }
        if (!empty($dataarray)) {
            $commonFunction->insertMultiple($tbname, $dataarray);
        }
    }

if (isset($_POST['ded_don100_btn'])) {
    $arraylength = count($_POST['hidcheckdon100']);

    $fr_ded_id = 1;
    $dona_share_50_100 = 1;

    $tbname = 'itr_donation';
    $dataarray = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidcheckdon100'][$i]) != 0) {
            $dataarrayupdate = array(
        'pk_dona_id' => trim($_POST['hidcheckdon100'][$i]),
        'fr_ded_id' => $fr_ded_id,
        'dona_share_50_100' => $dona_share_50_100,
        'dona_80g_dname' => trim($_POST['dona_80g_dname'][$i]),
        'dona_80g_dpan' => trim($_POST['dona_80g_dpan'][$i]),
        'dona_80g_daddr' => trim($_POST['dona_80g_daddr'][$i]),
        'dona_80g_dcity' => trim($_POST['dona_80g_dcity'][$i]),
        'dona_80g_dstate' => trim($_POST['dona_80g_dstate'][$i]),
        'dona_80g_dpincode' => trim($_POST['dona_80g_dpincode'][$i]),
        'dona_80g_damount' => trim($_POST['dona_80g_damount'][$i]),
        'dona_80g_deligilibity' => trim($_POST['dona_80g_deligilibity'][$i]),

        /*-------------------------------------- New Added for 2019 Schema-BSEN-START -------------------------------------------------*/

        'dona_80g_percentcash' => trim($_POST['dona_80g_percentcash'][$i]),
        'dona_80g_percentothermode' => trim($_POST['dona_80g_percentothermode'][$i]),
        //'dona_80g_percentapprreqdcash' => trim($_POST['dona_80g_percentapprreqdcash'][$i]),
        //'dona_80g_percentapprreqdothermode' => trim($_POST['dona_80g_percentapprreqdothermode'][$i]),
        //'dona_80g_totaldonationsus80gcash' => trim($_POST['dona_80g_totaldonationsus80gcash'][$i]),
        //'dona_80g_totaldonationsus80gotherMode' => trim($_POST['dona_80g_totaldonationsus80gotherMode'][$i]),

        /*-------------------------------------- New Added for 2019 Schema-BSEN-END -------------------------------------------------*/
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } else {
            $dataarray[] = array(
          'fr_user_id' => $fr_user_id,
        'fr_itr_id' => $fr_itr_id,
        'fr_ded_id' => $fr_ded_id,
        'dona_share_50_100' => $dona_share_50_100,
        'dona_80g_dname' => trim($_POST['dona_80g_dname'][$i]),
        'dona_80g_dpan' => trim($_POST['dona_80g_dpan'][$i]),
        'dona_80g_daddr' => trim($_POST['dona_80g_daddr'][$i]),
        'dona_80g_dcity' => trim($_POST['dona_80g_dcity'][$i]),
        'dona_80g_dstate' => trim($_POST['dona_80g_dstate'][$i]),
        'dona_80g_dpincode' => trim($_POST['dona_80g_dpincode'][$i]),
        'dona_80g_damount' => trim($_POST['dona_80g_damount'][$i]),
        'dona_80g_deligilibity' => trim($_POST['dona_80g_deligilibity'][$i]),

        /*-------------------------------------- New Added for 2019 Schema-BSEN-START -------------------------------------------------*/
        'dona_80g_percentcash' => trim($_POST['dona_80g_percentcash'][$i]),
        'dona_80g_percentothermode' => trim($_POST['dona_80g_percentothermode'][$i]),
        //'dona_80g_percentapprreqdcash' => trim($_POST['dona_80g_percentapprreqdcash'][$i]),
        //'dona_80g_percentapprreqdothermode' => trim($_POST['dona_80g_percentapprreqdothermode'][$i]),

        //'dona_80g_totaldonationsus80gcash' => trim($_POST['dona_80g_totaldonationsus80gcash'][$i]),
       // 'dona_80g_totaldonationsus80gotherMode' => trim($_POST['dona_80g_totaldonationsus80gotherMode'][$i]),
        /*-------------------------------------- New Added for 2019 Schema-BSEN-END -------------------------------------------------*/
      );
        }
    }

    if (!empty($dataarray)) {
        $commonFunction->insertMultiple($tbname, $dataarray);
    }
}

if (isset($_POST['ded_don50_btn'])) {
    $arraylength = count($_POST['hidcheckdon50']);

    $fr_ded_id = 1;
    $dona_share_50_100 = 0;

    $tbname = 'itr_donation';
    $dataarray = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidcheckdon50'][$i]) != 0) {
            $dataarrayupdate = array(
        'pk_dona_id' => trim($_POST['hidcheckdon50'][$i]),

        'fr_ded_id' => $fr_ded_id,
        'dona_share_50_100' => $dona_share_50_100,
        'dona_80g_dname' => trim($_POST['dona_80g_dname'][$i]),
        'dona_80g_dpan' => trim($_POST['dona_80g_dpan'][$i]),
        'dona_80g_daddr' => trim($_POST['dona_80g_daddr'][$i]),
        'dona_80g_dcity' => trim($_POST['dona_80g_dcity'][$i]),
        'dona_80g_dstate' => trim($_POST['dona_80g_dstate'][$i]),
        'dona_80g_dpincode' => trim($_POST['dona_80g_dpincode'][$i]),
        'dona_80g_damount' => trim($_POST['dona_80g_damount'][$i]),
        'dona_80g_deligilibity' => trim($_POST['dona_80g_deligilibity'][$i]),
        /*-------------------------------------- New Added for 2019 Schema-BSEN-START -------------------------------------------------*/
        'dona_80g_percentcash' => trim($_POST['dona_80g_percentcash'][$i]),
        'dona_80g_percentothermode' => trim($_POST['dona_80g_percentothermode'][$i]),
        //'dona_80g_percentapprreqdcash' => trim($_POST['dona_80g_percentapprreqdcash'][$i]),
        //'dona_80g_percentapprreqdothermode' => trim($_POST['dona_80g_percentapprreqdothermode'][$i]),
        'dona_80g_totaldonationsus80gcash' => trim($_POST['dona_80g_totaldonationsus80gcash'][$i]),
        'dona_80g_totaldonationsus80gotherMode' => trim($_POST['dona_80g_totaldonationsus80gotherMode'][$i]),
        /*-------------------------------------- New Added for 2019 Schema-BSEN-END -------------------------------------------------*/
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } else {
            $dataarray[] = array(
      'fr_user_id' => $fr_user_id,
        'fr_itr_id' => $fr_itr_id,
        'fr_ded_id' => $fr_ded_id,
        'dona_share_50_100' => $dona_share_50_100,
        'dona_80g_dname' => trim($_POST['dona_80g_dname'][$i]),
        'dona_80g_dpan' => trim($_POST['dona_80g_dpan'][$i]),
        'dona_80g_daddr' => trim($_POST['dona_80g_daddr'][$i]),
        'dona_80g_dcity' => trim($_POST['dona_80g_dcity'][$i]),
        'dona_80g_dstate' => trim($_POST['dona_80g_dstate'][$i]),
        'dona_80g_dpincode' => trim($_POST['dona_80g_dpincode'][$i]),
        'dona_80g_damount' => trim($_POST['dona_80g_damount'][$i]),
        'dona_80g_deligilibity' => trim($_POST['dona_80g_deligilibity'][$i]),
        /*-------------------------------------- New Added for 2019 Schema-BSEN-START -------------------------------------------------*/
        'dona_80g_percentcash' => trim($_POST['dona_80g_percentcash'][$i]),
        'dona_80g_percentothermode' => trim($_POST['dona_80g_percentothermode'][$i]),
        //'dona_80g_percentapprreqdcash' => trim($_POST['dona_80g_percentapprreqdcash'][$i]),
        //'dona_80g_percentapprreqdothermode' => trim($_POST['dona_80g_percentapprreqdothermode'][$i]),
        'dona_80g_totaldonationsus80gcash' => trim($_POST['dona_80g_totaldonationsus80gcash'][$i]),
        'dona_80g_totaldonationsus80gotherMode' => trim($_POST['dona_80g_totaldonationsus80gotherMode'][$i]),
        /*-------------------------------------- New Added for 2019 Schema-BSEN-END -------------------------------------------------*/
      );
        }
    }
    if (!empty($dataarray)) {
        $commonFunction->insertMultiple($tbname, $dataarray);
    }
}

/*----------------------------------------------- 20190514-BSEN-Donation80GGA-insert/update-START --------------------------------------------------*/

if (isset($_POST['ded_don80gga_btn'])) {
    //$arraylength = count($_POST['hidcheckdon100']);
    /*
    $tbname ='itr_donation80gga';
    $dataarray = array();
    */

    $arraylength = count($_POST['hidcheckdon1000']);

    $fr_ded_id = 1;
    //$dona_share_50_100 = 1;

    $tbname = 'itr_donation80gga';
    $dataarray = array();

    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidcheckdon1000'][$i]) != 0) {
            $dataarrayupdate = array(
            'pk_dona80gga_id' => trim($_POST['hidcheckdon1000'][$i]),
            'fr_ded_id' => $fr_ded_id,
            'dona_80gga_relevantclsusdedc' => trim($_POST['dona_80g_option'][$i]),
            'dona_80gga_dname' => trim($_POST['dona_80gga_dname'][$i]),
            'dona_80gga_addrdetail' => trim($_POST['dona_80gga_addrdetail'][$i]),
            'dona_80gga_dcity' => trim($_POST['dona_80gga_dcity'][$i]),
            'dona_80gga_dstate' => trim($_POST['dona_80gga_dstate'][$i]),
            'dona_80gga_dpincode' => trim($_POST['dona_80gga_dpincode'][$i]),
            'dona_80gga_dpan' => trim($_POST['dona_80gga_dpan'][$i]),
            'dona_80gga_damountcash' => trim($_POST['dona_80gga_damountcash'][$i]),

            'dona_80gga_donationamtothermode' => trim($_POST['dona_80gga_donationamtothermode'][$i]),
            'dona_80gga_donationamt' => trim($_POST['dona_80gga_donationamt'][$i]),
            'dona_80gga_eligibledonationamt' => trim($_POST['dona_80gga_eligibledonationamt'][$i]),

            'dona_80gga_totaldonationamtcash' => trim($_POST['dona_80gga_totaldonationamtcash'][$i]),
            'dona_80gga_totaldonationamtotherMode80GGA' => trim($_POST['dona_80gga_totaldonationamtotherMode80GGA'][$i]),
            'dona_80gga_totaldonationsus' => trim($_POST['dona_80gga_totaldonationsus'][$i]),
            'dona_80gga_totaleligibledonationamt80GGA' => trim($_POST['dona_80gga_totaleligibledonationamt80GGA'][$i]),
          );
            /*---------------------------------- for testing purpose ------------------------------------------------*/
            //print_r($dataarrayupdate);
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } else {
            $dataarray[] = array(
            'fr_user_id' => $fr_user_id,
            'fr_itr_id' => $fr_itr_id,
            'fr_ded_id' => $fr_ded_id,
            'dona_80gga_relevantclsusdedc' => trim($_POST['dona_80g_option'][$i]),
            'dona_80gga_dname' => trim($_POST['dona_80gga_dname'][$i]),
            'dona_80gga_addrdetail' => trim($_POST['dona_80gga_addrdetail'][$i]),
            'dona_80gga_dcity' => trim($_POST['dona_80gga_dcity'][$i]),
            'dona_80gga_dstate' => trim($_POST['dona_80gga_dstate'][$i]),
            'dona_80gga_dpincode' => trim($_POST['dona_80gga_dpincode'][$i]),
            'dona_80gga_dpan' => trim($_POST['dona_80gga_dpan'][$i]),
            'dona_80gga_damountcash' => trim($_POST['dona_80gga_damountcash'][$i]),

            'dona_80gga_donationamtothermode' => trim($_POST['dona_80gga_donationamtothermode'][$i]),
            'dona_80gga_donationamt' => trim($_POST['dona_80gga_donationamt'][$i]),
            'dona_80gga_eligibledonationamt' => trim($_POST['dona_80gga_eligibledonationamt'][$i]),

            'dona_80gga_totaldonationamtcash' => trim($_POST['dona_80gga_totaldonationamtcash'][$i]),
            'dona_80gga_totaldonationamtotherMode80GGA' => trim($_POST['dona_80gga_totaldonationamtotherMode80GGA'][$i]),
            'dona_80gga_totaldonationsus' => trim($_POST['dona_80gga_totaldonationsus'][$i]),
            'dona_80gga_totaleligibledonationamt80GGA' => trim($_POST['dona_80gga_totaleligibledonationamt80GGA'][$i]),
          );
        }
    }

    if (!empty($dataarray)) {
        $commonFunction->insertMultiple($tbname, $dataarray);
    }
}

/*------------------------------------------- Update 80GGA Table-BSEN-END ------------------------------------------------------*/

if (isset($_POST['ded_othdon_btn'])) {
    $tbname = ' itr_deduction';
    $dataarray = array(
    'ded_othdon_80ggc_dpp' => trim($_POST['ded_othdon_80ggc_dpp']),
    'ded_othdon_80gga_dfsrrd' => trim($_POST['ded_othdon_80gga_dfsrrd']),
  );

    $commonFunction->dynamicUpdate($tbname, $dataarray);
}

if (isset($_POST['ded_othdedu_btn'])) {
    $tbname = ' itr_deduction';
    $dataarray = array(
    'ded_othd_80u' => trim($_POST['ded_othd_80u']),
    'ded_othd_80u_type' => trim($_POST['ded_othd_80u_type']),
    'ded_othd_80dd' => trim($_POST['ded_othd_80dd']),
    'ded_othd_80dd_type' => trim($_POST['ded_othd_80dd_type']),
    'ded_othd_80ddb' => trim($_POST['ded_othd_80ddb']),
    'ded_othd_80ddb_type' => trim($_POST['ded_othd_80ddb_type']),
    'ded_othd_80e' => trim($_POST['ded_othd_80e']),
    'ded_othd_80ee' => trim($_POST['ded_othd_80ee']),
    'ded_othd_80ccc' => trim($_POST['ded_othd_80ccc']),
    'ded_othd_80ccd1' => trim($_POST['ded_othd_80ccd1']),
    'ded_othd_80ccd1b' => trim($_POST['ded_othd_80ccd1b']),
    'ded_othd_80ccd2' => trim($_POST['ded_othd_80ccd2']),
    'ded_othd_80qqb' => trim($_POST['ded_othd_80qqb']),
    'ded_othd_80rrb' => trim($_POST['ded_othd_80rrb']),
    'ded_othd_80ccg' => trim($_POST['ded_othd_80ccg']),
  );

    $commonFunction->dynamicUpdate($tbname, $dataarray);
}

if (isset($_POST['taxreconcil_btn'])) {
    $arraylength = count($_POST['hidcheckreconcil']);
    $fr_itr_sou_id = 1;

    $tbname = 'itr_taxreconciliation';
    $dataarray = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidcheckreconcil'][$i]) != 0) {
            $dataarrayupdate = array(
        'pk_reconci_id' => trim($_POST['hidcheckreconcil'][$i]),

        'reco_reconci_nameodeduc' => trim($_POST['reco_reconci_nameodeduc'][$i]),
        'reco_reconci_tanodeduc' => trim($_POST['reco_reconci_tanodeduc'][$i]),
        'reco_reconci_totamtcre' => trim($_POST['reco_reconci_totamtcre'][$i]),
        'reco_reconci_tottdsdop' => trim($_POST['reco_reconci_tottdsdop'][$i]),
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } else {
            $dataarray[] = array(
        'fr_user_id' => $fr_user_id,
        'fr_itr_id' => $fr_itr_id,
        'reco_reconci_nameodeduc' => trim($_POST['reco_reconci_nameodeduc'][$i]),
        'reco_reconci_tanodeduc' => trim($_POST['reco_reconci_tanodeduc'][$i]),
        'reco_reconci_totamtcre' => trim($_POST['reco_reconci_totamtcre'][$i]),
        'reco_reconci_tottdsdop' => trim($_POST['reco_reconci_tottdsdop'][$i]),
      );
        }
    }
    if (!empty($dataarray)) {
        $commonFunction->insertMultiple($tbname, $dataarray);
    }
    $tbname = 'itr_sou_salary';
    $itr_pay_amount = $itrFill->calculatePaySelection($tbname, $fr_itr_id)[0];
    $itr_pay_selection = $itrFill->calculatePaySelection($tbname, $fr_itr_id)[1];
    $total_section = $itrFill->calculatePaySelection($tbname, $fr_itr_id)[2];
}

if (isset($_POST['taxreco_taxpaid_btn'])) {
    $arraylength = count($_POST['hidchecktaxadvan']);

    $tbname = 'itr_taxreconci_taxpaid_advan';
    $dataarray = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidchecktaxadvan'][$i]) != '') {
            $dataarrayupdate = array(
        'pk_taxpaidadvan_id' => trim($_POST['hidchecktaxadvan'][$i]),

        'reco_txpaidadv_bsrcodobnk' => trim($_POST['reco_txpaidadv_bsrcodobnk'][$i]),
        'reco_txpaidadv_dateodepos' => trim($_POST['reco_txpaidadv_dateodepos'][$i]),
        'reco_txpaidadv_challsrno' => trim($_POST['reco_txpaidadv_challsrno'][$i]),
        'reco_txpaidadv_amount' => trim($_POST['reco_txpaidadv_amount'][$i]),
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } elseif (trim($_POST['reco_txpaidadv_challsrno'][$i]) > 1) {
            $dataarray[] = array(
        'fr_user_id' => $fr_user_id,
        'fr_itr_id' => $fr_itr_id,
        'reco_txpaidadv_bsrcodobnk' => trim($_POST['reco_txpaidadv_bsrcodobnk'][$i]),
        'reco_txpaidadv_dateodepos' => trim($_POST['reco_txpaidadv_dateodepos'][$i]),
        'reco_txpaidadv_challsrno' => trim($_POST['reco_txpaidadv_challsrno'][$i]),
        'reco_txpaidadv_amount' => trim($_POST['reco_txpaidadv_amount'][$i]),
      );
        }
    }
    if (!empty($dataarray)) {
        $commonFunction->insertMultiple($tbname, $dataarray);
    }

    $arraylength = count($_POST['hidchecselfasspd']);

    $tbname = 'itr_taxreconci_selfasstaxpaid';
    $dataarraysf = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidchecselfasspd'][$i]) != 0) {
            $dateof_issue = date_create_from_format('d/m/Y', trim($_POST['reco_selfasstxpd_dateodepos'][$i]))->format('Y-m-d');
            $dataarrayupdate = array(
        'pk_selfasstxpd_id' => trim($_POST['hidchecselfasspd'][$i]),

        'reco_selfasstxpd_bsrcodobnk' => trim($_POST['reco_selfasstxpd_bsrcodobnk'][$i]),
        'reco_selfasstxpd_dateodepos' => $dateof_issue,

        'reco_selfasstxpd_challsrno' => trim($_POST['reco_selfasstxpd_challsrno'][$i]),
        'reco_selfasstxpd_amount' => trim($_POST['reco_selfasstxpd_amount'][$i]),
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } elseif (trim($_POST['reco_selfasstxpd_challsrno'][$i]) > 1) {
             $dateof_issue = date_create_from_format('d/m/Y', trim($_POST['reco_selfasstxpd_dateodepos'][$i]))->format('Y-m-d');
            $dataarraysf[] = array(
      'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'reco_selfasstxpd_bsrcodobnk' => trim($_POST['reco_selfasstxpd_bsrcodobnk'][$i]),
        'reco_selfasstxpd_dateodepos' => $dateof_issue,
        'reco_selfasstxpd_challsrno' => trim($_POST['reco_selfasstxpd_challsrno'][$i]),
        'reco_selfasstxpd_amount' => trim($_POST['reco_selfasstxpd_amount'][$i]),
      );
        }
    }
    if (!empty($dataarraysf)) {
        $commonFunction->insertMultiple($tbname, $dataarraysf);
    }
}

/*----------------------------------------------- 20190514-BSEN-Schedule-TCS-insert/update-START ----------------------------------------*/

if (isset($_POST['tax_tcs_btn'])) {
    //$arraylength = count($_POST['hidcheckdon100']);
    /*
    $tbname ='itr_donation80gga';
    $dataarray = array();
    */

    /*echo "string:-";
    print_r($_POST);*/


    $arraylength = count($_POST['hidchecktdsrent']);

    echo "array:-".$arraylength;
    $fr_ded_id = 1;

    $tbname = 'itr_taxreconci_tcs';
    $dataarray = array();

    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidchecktcsrent'][$i]) != 0) {
            $dataarrayupdate = array(
            'pk_tcs_id' => trim($_POST['hidchecktcsrent'][$i]),
            //'fr_ded_id' => $fr_ded_id,
            'reco_tcs_tan' => trim($_POST['reco_tcs_tan'][$i]),
            'reco_tcs_employerordeductororcollectername' => trim($_POST['reco_tcs_employerordeductororcollectername'][$i]),
            'reco_tcs_amttaxcollected' => trim($_POST['reco_tcs_amttaxcollected'][$i]),
            'reco_tcs_collectedyr' => trim($_POST['reco_tcs_collectedyr'][$i]),
            'reco_tcs_totaltcs' => trim($_POST['reco_tcs_totaltcs'][$i]),
            'reco_tcs_amttcsclaimedthisyear' => trim($_POST['reco_tcs_amttcsclaimedthisyear'][$i]),
          );
            /*---------------------------------- for testing purpose ------------------------------------------------*/
            //print_r($dataarrayupdate);
            $res = $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            echo $res;

        } else {
            $dataarray[] = array(
            'fr_user_id' => $fr_user_id,
            'fr_itr_id' => $fr_itr_id,
            //'fr_ded_id' => $fr_ded_id,
            'reco_tcs_tan' => trim($_POST['reco_tcs_tan'][$i]),
            'reco_tcs_employerordeductororcollectername' => trim($_POST['reco_tcs_employerordeductororcollectername'][$i]),
            'reco_tcs_amttaxcollected' => trim($_POST['reco_tcs_amttaxcollected'][$i]),
            'reco_tcs_collectedyr' => trim($_POST['reco_tcs_collectedyr'][$i]),
            'reco_tcs_totaltcs' => trim($_POST['reco_tcs_totaltcs'][$i]),
            'reco_tcs_amttcsclaimedthisyear' => trim($_POST['reco_tcs_amttcsclaimedthisyear'][$i]),
          );
        }
    }

    //print_r($dataarray);
    if (!empty($dataarray)) {
        $commonFunction->insertMultiple($tbname, $dataarray);
    }
}

/*----------------------------------------------- 20190514-BSEN-Schedule-TCS-insert/update-END ----------------------------------------*/
//print_r($_POST);
if (isset($_POST['tax_recon_btn'])) {
    
    $arraylength = count($_POST['hidchecktdsothsal']);

    $fr_recotds_id = 1;
    $tbname = 'itr_taxreconci_tdsothsal';
    $dataarrayl = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidchecktdsothsal'][$i]) != '') {
            $dataarrayupdate = array(
        'pk_recotdsothsal_id' => trim($_POST['hidchecktdsothsal'][$i]),

        'fr_recotds_id' => $fr_recotds_id,

        'reco_tdsothsal_tanoded' => strtoupper(trim($_POST['reco_tdsothsal_tanoded'][$i])),
        'reco_tdsonsal_nameodedu' => trim($_POST['reco_tdsonsal_nameodedu'][$i]),
        'reco_tdsothsal_tdsdeduc' => trim($_POST['reco_tdsothsal_tdsdeduc'][$i]),
        'reco_tdsothsal_tdsclaim' => trim($_POST['reco_tdsothsal_tdsclaim'][$i]),
        'reco_tdsothsal_rec26as' => trim($_POST['reco_tdsothsal_rec26as'][$i]),
        'reco_tdsothsal_yeartdsdedu' => trim($_POST['reco_tdsothsal_yeartdsdedu'][$i]),
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } elseif (trim($_POST['reco_tdsothsal_tdsdeduc'][$i]) > 0) {
            $dataarrayl[] = array(
        'fr_user_id' => $fr_user_id,
        'fr_itr_id' => $fr_itr_id,
        'fr_recotds_id' => $fr_recotds_id,
        'reco_tdsothsal_tanoded' => strtoupper(trim($_POST['reco_tdsothsal_tanoded'][$i])),
        'reco_tdsonsal_nameodedu' => trim($_POST['reco_tdsonsal_nameodedu'][$i]),
        'reco_tdsothsal_tdsdeduc' => trim($_POST['reco_tdsothsal_tdsdeduc'][$i]),
        'reco_tdsothsal_tdsclaim' => trim($_POST['reco_tdsothsal_tdsclaim'][$i]),
        'reco_tdsothsal_rec26as' => trim($_POST['reco_tdsothsal_rec26as'][$i]),
        'reco_tdsothsal_yeartdsdedu' => trim($_POST['reco_tdsothsal_yeartdsdedu'][$i]),
      );
        }
    }
    if (!empty($dataarrayl)) {
        $commonFunction->insertMultiple($tbname, $dataarrayl);
    }

    $arraylength = count($_POST['hidchecktdsrent']);

    if ($arraylength > 0) {
        $tbname = 'itr_taxreconci_tdsrent';
        $dataarrayl = array();
        for ($i = 0; $i < $arraylength; ++$i) {
            if (trim($_POST['hidchecktdsrent'][$i]) != '') {
                $dataarrayupdate = array(
            'pk_recotdsrent_id' => trim($_POST['hidchecktdsrent'][$i]),
            'reco_tdsonrent_year' => trim($_POST['reco_tdsonrent_year'][$i]),
            'reco_tdsonrent_claimed' => trim($_POST['reco_tdsonrent_claimed'][$i]),
            'reco_tdsonrent_deduc' => trim($_POST['reco_tdsonrent_deduc'][$i]),
            'reco_tdsonrent_amnt' => trim($_POST['reco_tdsonrent_amnt'][$i]),
            'reco_tdsonrent_pan' => trim($_POST['reco_tdsonrent_pan'][$i]),
            'reco_tdsonrent_name' => trim($_POST['reco_tdsonrent_name'][$i]),
          );
                $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
            } elseif (trim($_POST['reco_tdsonrent_amnt'][$i]) > 0) {
                $dataarrayl[] = array(
            'fr_user_id' => $fr_user_id,
            'fr_itr_id' => $fr_itr_id,
            'reco_tdsonrent_year' => trim($_POST['reco_tdsonrent_year'][$i]),
            'reco_tdsonrent_claimed' => trim($_POST['reco_tdsonrent_claimed'][$i]),
            'reco_tdsonrent_deduc' => trim($_POST['reco_tdsonrent_deduc'][$i]),
            'reco_tdsonrent_amnt' => trim($_POST['reco_tdsonrent_amnt'][$i]),
            'reco_tdsonrent_pan' => trim($_POST['reco_tdsonrent_pan'][$i]),
            'reco_tdsonrent_name' => trim($_POST['reco_tdsonrent_name'][$i]),
          );
            }
        }

        if (!empty($dataarrayl)) {
            $commonFunction->insertMultiple($tbname, $dataarrayl);
        }
    }

    $arraylength = count($_POST['hidcheckimoprop']);

    $fr_recotds_id = 1;
    $tbname = 'itr_taxreconci_tdsimoprop';
    $dataarrayim = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidcheckimoprop'][$i]) != 0) {
            $dataarrayupdate = array(
        'pk_recotdsimoprop_id' => trim($_POST['hidcheckimoprop'][$i]),

        'fr_recotds_id' => $fr_recotds_id,
        'reco_tdsimoprop_panobuyer' => trim($_POST['reco_tdsimoprop_panobuyer'][$i]),
        'reco_tdsimoprop_nameobuyer' => trim($_POST['reco_tdsimoprop_nameobuyer'][$i]),
        'reco_tdsimoprop_tdsdeduct' => trim($_POST['reco_tdsimoprop_tdsdeduct'][$i]),
        'reco_tdsimoprop_tdsclaimed' => trim($_POST['reco_tdsimoprop_tdsclaimed'][$i]),
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } else {
            $dataarrayim[] = array(
        'fr_user_id' => $fr_user_id,
                      'fr_itr_id' => $fr_itr_id,
        'fr_recotds_id' => $fr_recotds_id,
        'reco_tdsimoprop_panobuyer' => trim($_POST['reco_tdsimoprop_panobuyer'][$i]),
        'reco_tdsimoprop_nameobuyer' => trim($_POST['reco_tdsimoprop_nameobuyer'][$i]),
        'reco_tdsimoprop_tdsdeduct' => trim($_POST['reco_tdsimoprop_tdsdeduct'][$i]),

        'reco_tdsimoprop_tdsclaimed' => trim($_POST['reco_tdsimoprop_tdsclaimed'][$i]),
      );
        }
    }
    if (!empty($dataarrayim)) {
        $commonFunction->insertMultiple($tbname, $dataarrayim);
    }
}


if (isset($_POST['txtfill_bkd_btn'])) {

    $arraylength = count($_POST['tax_bkd_accno']);

    $tbname = 'itr_taxfilling';
    $dataarrayl = array();
    /*----------------------------------- 20190220-BSEN -------------------------------------*/
    /*-------------*/
    // echo "<script> console.log(".print_r($_POST).")</script>";
    //echo "<script>window.stop();</script>";
    //print_r($_POST);
    for ($i = 0; $i < $arraylength; ++$i) {
        if (isset($_POST['hidcheckfiling']) && isset($_POST['hidcheckfiling'][$i]) && trim($_POST['hidcheckfiling'][$i]) != 0) {
            /*----------------------------------- Old ---------------------------------------------*/
          /*  $dataarrayupdate = array(
            'pk_taxfil_id' => trim($_POST['hidchecksalary'][$i]),
            'tax_bkd_bname' => trim($_POST['tax_bkd_bname'][$i]),
            'tax_bkd_accno' => trim($_POST['tax_bkd_accno'][$i]),
            'tax_bkd_ifsc' => trim($_POST['tax_bkd_ifsc'][$i]), );*/

            /*----------------------------------- Change ---------------------------------------------*/
            $dataarrayupdate = array(
            'pk_taxf_id' => trim($_POST['hidcheckfiling']),
            'tax_bkd_bname' => trim($_POST['tax_bkd_bname'][$i]),
            'tax_bkd_accno' => trim($_POST['tax_bkd_accno'][$i]),
            'tax_bkd_ifsc' => trim($_POST['tax_bkd_ifsc'][$i]), );
            /*echo "dataarrayupdate";
            print_r($dataarrayupdate);*/

            //$result = $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);

            $result = $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } else {
            $dataarrayl[] = array(
            'fr_user_id' => $fr_user_id,
            'fr_itr_id' => $fr_itr_id,
            'tax_bkd_bname' => trim($_POST['tax_bkd_bname'][$i]),
            'tax_bkd_accno' => trim($_POST['tax_bkd_accno'][$i]),
            'tax_bkd_ifsc' => trim($_POST['tax_bkd_ifsc'][$i]), );
           /* echo "dataarrayl";
            print_r($dataarrayl);*/
        }
    }
    if (!empty($dataarrayl)) {
        $result = $commonFunction->insertMultiple($tbname, $dataarrayl);
    }
}

if (isset($_POST['txtfilli_ratf_btn'])) {
    $tbname = ' itr_taxfilling';
    $dataarray = array(
    'tax_re_m50lakhs_buld' => trim($_POST['tax_re_m50lakhs_buld']),
    'tax_re_m50lakhs_bankbd' => trim($_POST['tax_re_m50lakhs_bankbd']),
    'tax_re_m50lakhs_shasec' => trim($_POST['tax_re_m50lakhs_shasec']),
    'tax_re_m50lakhs_inspol' => trim($_POST['tax_re_m50lakhs_inspol']),
    'tax_re_m50lakhs_loanad' => trim($_POST['tax_re_m50lakhs_loanad']),
    'tax_re_m50lakhs_cashih' => trim($_POST['tax_re_m50lakhs_cashih']),
    'tax_re_m50lakhs_jewellary' => trim($_POST['tax_re_m50lakhs_jewellary']),
    'tax_re_m50lakhs_painting' => trim($_POST['tax_re_m50lakhs_painting']),
    'tax_re_m50lakhs_vehicles' => trim($_POST['tax_re_m50lakhs_vehicles']),
    'tax_re_return_type' => trim($_POST['tax_re_return_type']),
    'tax_re_date' => trim($_POST['tax_re_date']),
    'tax_re_place' => trim($_POST['tax_re_place']),
  );
    $commonFunction->dynamicUpdate($tbname, $dataarray);

    $arraylength = count($_POST['hidchecktaxfilland']);

    $fr_taxfill_id = 1;
    $tbname = 'itr_taxfilling_land';
    $dataarrayl = array();
    for ($i = 0; $i < $arraylength; ++$i) {
        if (trim($_POST['hidchecktaxfilland'][$i]) != 0) {
            $dataarrayupdate = array(
        'pk_taxfland_id' => trim($_POST['hidchecktaxfilland'][$i]),

        'fr_taxfill_id' => $fr_taxfill_id,
        'tax_re_m50lakhs_land' => trim($_POST['tax_re_m50lakhs_land']),
        'tax_re_m50lakhs_fldoblno' => trim($_POST['tax_re_m50lakhs_fldoblno'][$i]),
        'tax_re_m50lakhs_areloc' => trim($_POST['tax_re_m50lakhs_areloc'][$i]),
        'tax_re_m50lakhs_tocidi' => trim($_POST['tax_re_m50lakhs_tocidi'][$i]),
        'tax_re_m50lakhs_state' => trim($_POST['tax_re_m50lakhs_state'][$i]),
        'tax_re_m50lakhs_count' => trim($_POST['tax_re_m50lakhs_count'][$i]),
      );
            $commonFunction->dynamicUpdateMultiple($tbname, $dataarrayupdate);
        } else {
            $dataarrayl[] = array(
        'fr_user_id' => $fr_user_id,
        'fr_itr_id' => $fr_itr_id,
        'fr_taxfill_id' => $fr_taxfill_id,
        'tax_re_m50lakhs_land' => trim($_POST['tax_re_m50lakhs_land']),
        'tax_re_m50lakhs_fldoblno' => trim($_POST['tax_re_m50lakhs_fldoblno'][$i]),
        'tax_re_m50lakhs_areloc' => trim($_POST['tax_re_m50lakhs_areloc'][$i]),
        'tax_re_m50lakhs_tocidi' => trim($_POST['tax_re_m50lakhs_tocidi'][$i]),
        'tax_re_m50lakhs_state' => trim($_POST['tax_re_m50lakhs_state'][$i]),
        'tax_re_m50lakhs_count' => trim($_POST['tax_re_m50lakhs_count'][$i]),
      );
        }
    }
    if (!empty($dataarrayl)) {
        $commonFunction->insertMultiple($tbname, $dataarrayl);
    }

    $xmlTable = 'bfsi_itr';
} elseif (isset($_POST['ded_hi_btn'])) {
    $tbname = ' itr_deduction';
    $dataarray = array(
            'fr_user_id' => $fr_user_id,
            'fr_itr_id' => $fr_itr_id,
            'ded_hi_type' => trim($_POST['ded_hi_type']),
            /*'ded_hi_phc_ssc' => trim($_POST['ded_hi_phc_ssc']),
            'ded_hi_phc_parents' => trim($_POST['ded_hi_phc_parents']),*/
            'ded_hi_hip80d_ssc' => trim($_POST['ded_hi_hip80d_ssc']),
            /*'ded_hi_hip80d_parents' => trim($_POST['ded_hi_hip80d_parents']),
            'ded_hi_hip80d_ageoparent' => trim($_POST['ded_hi_hip80d_ageoparent']),*/
        );

    if (isset($_POST['pk_ded_id']) && $_POST['pk_ded_id']) {
        $dataarray['pk_ded_id'] = $_POST['pk_ded_id'];
    }

    $commonFunction->dynamicUpdate($tbname, $dataarray);
} elseif (isset($_POST['ded_gd_btn'])) {
    $tbname = ' itr_deduction';
    $dataarray = array(
        'fr_user_id' => $fr_user_id,
        'fr_itr_id' => $fr_itr_id,
        'ded_gd__80c' => trim($_POST['ded_gd__80c']),
        'ded_gd__80gg' => trim($_POST['ded_gd__80gg']),
        'ded_gd__80tta' => trim($_POST['ded_gd__80tta']),
        'ded_gd__80ttb' => trim($_POST['ded_gd__80ttb']),
        'ded_othd_80ccc' => trim($_POST['ded_othd_80ccc']),
        'ded_othd_80ccd1' => trim($_POST['ded_othd_80ccd1']),
        'ded_othd_80ccd1b' => trim($_POST['ded_othd_80ccd1b']),
        'ded_othd_80ccd2' => trim($_POST['ded_othd_80ccd2']),
        'ded_othd_80ccg' => trim($_POST['ded_othd_80ccg']),
      );

    if (isset($_POST['pk_ded_id']) && $_POST['pk_ded_id']) {
        $dataarray['pk_ded_id'] = $_POST['pk_ded_id'];
    }

    $commonFunction->dynamicUpdate($tbname, $dataarray);
}

//include("inc.summary_calc.php");

// Income chargeable under salary
$tax_re_inccha_undsal = ($itrFill->getSum('sou_sa_ntslary', 'itr_sou_salary', $fr_itr_id, $fr_user_id));

//Income chargeable under house property
$tax_re_inccha_undhp = ((($itrFill->getSum('self_hloan_int', 'itr_hp_selfocc', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('self_con_per_int', 'itr_hp_selfocc', $fr_itr_id, $fr_user_id))) * -1);

//Profit (or) gains from business and profession
$tax_re_progai_buspro = (($itrFill->getSum('sou_bop_pp_netprof', 'itr_business_profe_addmor', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('pre_totinccha_und_pgbphead', 'itr_presumptive', $fr_itr_id, $fr_user_id)));

// Income from other sources
$tax_re_inc_othsou = (($itrFill->getSum('sou_oth_oi_bnkint', 'itr_sou_other', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('sou_oth_oi_othint', 'itr_sou_other', $fr_itr_id, $fr_user_id)));

//Income chargeable under capital gain
$tax_re_inccha_undcg = 0;

//Gross Total Income
$tax_re_gro_totinc = (($itrFill->getSum('tax_re_inccha_undsal', 'itr_taxfilling', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('tax_re_inccha_undhp', 'itr_taxfilling', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('tax_re_inccha_undcg', 'itr_taxfilling', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('tax_re_progai_buspro', 'itr_taxfilling', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('tax_re_inc_othsou', 'itr_taxfilling', $fr_itr_id, $fr_user_id)));

//80C and Other Deductions
$tax_re_80c_othde = $itrXMLcal['S_TotalChapVIADeductions'];

    //Total Taxable Income
    $temptax = (int) $tax_re_gro_totinc - (int) $tax_re_80c_othde;
    $lastdigt = substr($temptax, -1);
    $diff = 10 - $lastdigt;
    $tax_re_tot_taxinc = 0;
    if ($diff <= 5) {
        $tax_re_tot_taxinc = $temptax + $diff;
    } else {
        $tax_re_tot_taxinc = $temptax - $lastdigt;
    }
    if ($tax_re_tot_taxinc < 0) {
        $tax_re_tot_taxinc = 0;
    }

    $dateOfBirth = $db->db_fetch_array($db->db_run_query("select * from itr_profile WHERE fr_user_id = '".$fr_user_id."'"));
    //Tax on total income
    $tax_re_tax_totinc = 0;
    if ($dateOfBirth[15] != '') {
        $userAge = date_diff(date_create($dateOfBirth[15]), date_create(date('Y-m-d')))->format('%y');
        $temp_Tax_on_total_inc = (($tax_re_gro_totinc - $tax_re_inccha_undcg) - $tax_re_80c_othde);
        if ($temp_Tax_on_total_inc > 0) {
            $tax_re_tax_totinc = getIncomeTax($userAge, $temp_Tax_on_total_inc);
        }
    }

 // Rebate
  $tax_re_rebate = 0;
  $RES = $db->db_fetch_array($db->db_run_query("select * from itr_profile WHERE fr_user_id = '".$fr_user_id."'"));
  $RES = $RES[4];
  //print_r($RES);exit;
  if ($tax_re_tot_taxinc < 500000 && $RES == 'RES') {
      if ($tax_re_tax_totinc < 5000) {
          $temprebt = (int) $tax_re_tax_totinc;
          $lastdigtr = substr($temprebt, -1);
          $diffr = 10 - $lastdigtr;
          if ($diffr <= 5) {
              $tax_re_rebate = $temprebt + $diffr;
          } else {
              $tax_re_rebate = $temprebt - $lastdigtr;
          }
      } else {
          $tax_re_rebate = 5000;
      }
  }

  // Tax after rebate
  $tax_re_taxaft_rebate = $tax_re_tax_totinc - $tax_re_rebate;

  // Cess
  $tax_re_cess = ($tax_re_taxaft_rebate * 3 / 100);

  //Section 89 relief
  $tax_re_sec89_relief = 0;

 // Total tax payable
 /* $tax_re_total_taxpyble = ($itrFill->getSum('sou_sa_ntslary','itr_sou_salary',$fr_itr_id , $fr_user_id)) + ($itrFill->getSum('reco_tdsothsal_tdsclaim','itr_taxreconci_tdsothsal',$fr_itr_id , $fr_user_id)) + ($itrFill->getSum('reco_tdsimoprop_tdsclaimed','itr_taxreconci_tdsimoprop',$fr_itr_id , $fr_user_id)) + ($itrFill->getSum('reco_txpaidadv_amount','itr_taxreconci_taxpaid_advan',$fr_itr_id , $fr_user_id)) + ($itrFill->getSum('reco_selfasstxpd_amount','itr_taxreconci_selfasstaxpaid',$fr_itr_id , $fr_user_id));*/

  $tax_re_total_taxpyble = $tax_re_taxaft_rebate + $tax_re_cess + $tax_re_sec89_relief;

  $tax_re_total_taxpaid = ($itrFill->getSum('sou_sa_tds_on_sal', 'itr_sou_salary', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('reco_tdsothsal_tdsclaim', 'itr_taxreconci_tdsothsal', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('reco_tdsimoprop_tdsclaimed', 'itr_taxreconci_tdsimoprop', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('reco_txpaidadv_amount', 'itr_taxreconci_taxpaid_advan', $fr_itr_id, $fr_user_id)) + ($itrFill->getSum('reco_selfasstxpd_amount', 'itr_taxreconci_selfasstaxpaid', $fr_itr_id, $fr_user_id));
  //Total taxes paid
 // $tax_re_total_taxpaid = $tax_re_taxaft_rebate + $tax_re_cess + $tax_re_sec89_relief;

  $tax_re_int_234a = 0;
  $tax_re_int_234b = 0;
  $tax_re_int_234c = 0;

  // Refund Receivable
 $tax_re_ref_recev = 0;
 $temp_re_ref_recev = (int) ($tax_re_total_taxpyble - ($tax_re_total_taxpaid + $tax_re_int_234a + $tax_re_int_234b + $tax_re_int_234c));
 if ($temp_re_ref_recev < 0) {
     $temprec = $temp_re_ref_recev;
     $lastdigtrr = substr($temprec, -1);
     $diffrr = 10 - $lastdigtrr;
     if ($lastdigtrr < 5) {
         $tax_re_ref_recev = $temprec + $lastdigtrr;
     } else {
         $tax_re_ref_recev = $temprec - $diffrr;
     }
 } else {
     $tax_re_ref_recev = 0;
 }

 // Balance Tax to be Paid
 $tax_re_bal_taxtopaid = (int) ($tax_re_total_taxpyble - ($tax_re_total_taxpaid + $tax_re_int_234a + $tax_re_int_234b + $tax_re_int_234c));
 if ($tax_re_bal_taxtopaid > 0) {
     $temprec = $tax_re_bal_taxtopaid;
     $lastdigtrr = substr($temprec, -1);
     $diffrr = 10 - $lastdigtrr;
     if ($diffrr <= 5) {
         $tax_re_bal_taxtopaid = $temprec + $diffrr;
     } else {
         $tax_re_bal_taxtopaid = $temprec - $lastdigtrr;
     }
 } else {
     $tax_re_bal_taxtopaid = 0;
 }

  $telfilling_calFild = array(
    'tax_re_inccha_undsal' => intval($tax_re_inccha_undsal),

    'tax_re_inccha_undhp' => ($tax_re_inccha_undhp),

    'tax_re_inccha_undcg' => ($tax_re_inccha_undcg),

    'tax_re_progai_buspro' => ($tax_re_progai_buspro),

    'tax_re_inc_othsou' => ($tax_re_inc_othsou),

    'tax_re_gro_totinc' => ($tax_re_gro_totinc),

    'tax_re_80c_othde' => ($tax_re_80c_othde),

    'tax_re_tot_taxinc' => ($tax_re_tot_taxinc),

    'tax_re_tax_totinc' => ($tax_re_tax_totinc),
    'tax_re_rebate' => ($tax_re_rebate),
    'tax_re_taxaft_rebate' => ($tax_re_taxaft_rebate),
    'tax_re_cess' => ($tax_re_cess),
    'tax_re_sec89_relief' => ($tax_re_sec89_relief),
    'tax_re_total_taxpaid' => ($tax_re_total_taxpaid),
    'tax_re_total_taxpyble' => ($tax_re_total_taxpyble),
    'tax_re_int_234a' => ($tax_re_int_234a),
    'tax_re_int_234b' => ($tax_re_int_234b),
    'tax_re_int_234c' => ($tax_re_int_234c),
    'tax_re_ref_recev' => ($tax_re_ref_recev),
    'tax_re_bal_taxtopaid' => ($tax_re_bal_taxtopaid),
  );

    $commonFunction->dynamicUpdate('itr_taxfilling', $telfilling_calFild);

function getIncomeTax($age, $salary)
{
    $tax = 0;
    if ($age > 0 && $age < 60) {
        if ($salary > 250000 && $salary <= 500000) {
            $tax = (($salary - 250000) * 10 / 100);
        }
        if ($salary > 500000 && $salary <= 1000000) {
            $tax = 25000 + (($salary - 500000) * 20 / 100);
        }
        if ($salary > 1000000) {
            $tax = (25000 + 100000) + (($salary - 1000000) * 30 / 100);
        }
    } elseif (age >= 60 && age < 80) {
        if ($salary > 300000 && $salary <= 500000) {
            $tax = (($salary - 300000) * 10 / 100);
        }
        if ($salary > 500000 && $salary <= 1000000) {
            $tax = 20000 + (($salary - 500000) * 20 / 100);
        }
        if ($salary > 1000000) {
            $tax = (20000 + 100000) + (($salary - 1000000) * 30 / 100);
        }
    } elseif (age >= 80) {
        if ($salary > 500000 && $salary <= 1000000) {
            $tax = ($salary - 500000) * 20 / 100;
        }
        if ($salary > 1000000) {
            $tax = (100000) + (($salary - 1000000) * 30 / 100);
        }
    }

    return $tax;
}

?>