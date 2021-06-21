$(document).ready(function () {
    jQuery.validator.addMethod("alphabetspace", function (value, element) {
        return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
    }, "Letters only please");
    jQuery.validator.addMethod("pan", function (value, element) {
        return this.optional(element) || /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/.test(value);
    }, "Invalid Pan Number");
    jQuery.validator.addMethod("aadhaar", function (value, element) {
        return this.optional(element) || /^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/.test(value);
    }, "Invalid Aadhaar Number");
    jQuery.validator.addMethod("alphabetspace", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Invalid Aadhaar Number");

    
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        $('#dob').attr('max', maxDate);
        $('#ben_dob').attr('max', maxDate);
    });
    $("#frmexecutordetails").validate({
        rules: {
            exe_fname: { required: true, minlength: 3, alphabetspace: true },
            exe_lname: { required: true, alphabetspace: true },
            exe_father_fname: { required: true, minlength: 3, alphabetspace: true },
            exe_father_lname: { required: true, minlength: 3, alphabetspace: true },
            exe_occupation: { required: true, minlength: 3 },
            exe_religious: { required: true },
            exe_nationality: { required: true },
            exe_gender: { required: true },
            exe_age: { required: true, range: [18, 100] },
            exe_rel_with_testator: { required: true },
            exe_perm_addr1: { required: true },
            exe_perm_addr2: { required: true },
            exe_perm_city: { required: true, minlength: 3 },
            exe_perm_state: { required: true },
            exe_perm_zip: { required: true, number: true, minlength: 6, maxlength: 6 },
            exe_perm_country: { required: true },
        },
        messages: {
            exe_fname: {
                required: "Please enter first name",
                minlength: "Name should be at least 3 characters",
                alphabetspace: "Please enter only alphabets"
            },
            exe_lname: {
                required: "Please enter last name",
                minlength: "Name should be at least 3 characters",
                alphabetspace: "Please enter only alphabets"
            },
            exe_father_fname: {
                required: "Please enter father's first name",
                minlength: "Name should be at least 3 characters",
                alphabetspace: "Please enter only alphabets"
            },
            exe_father_lname: {
                required: "Please enter father's first name",
                minlength: "Name should be at least 3 characters",
                alphabetspace: "Please enter only alphabets"
            },
            exe_religious: {
                required: "Please select the religion"
            },
            exe_nationality: {
                required: "Please select the nationality"
            },
            exe_gender: {
                required: "Please select the gender"
            },
            exe_age: {
                required: "Please enter the age",
                range: "Age should be 18+ "
            },
            exe_rel_with_testator: {
                required: "Please select the relation"
            },
            exe_perm_addr1: {
                required: "Please enter address"
            },
            exe_perm_addr2: {
                required: "Please enter address"
            },
            exe_perm_city: {
                required: "Please enter city",
                minlength: "City should be atleast 3 characters"
            },
            exe_perm_state: {
                required: "Please select state"
            },
            exe_perm_zip: {
                required: "Please enter pincode",
                number: "Please enter only numeric",
                minlength: "Pincode should be 6 digits",
                maxlength: "Pincode should be 6 digits"
            },
            exe_perm_country: {
                required: "Please select country"
            },
        },
        errorPlacement: function (label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function (element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });

    $("#frmWitness").validate({
        rules: {
            witness1_name: { required: true, alphabetspace: true, minlength: 3 },
            witness1_fathername: { required: true, alphabetspace: true, minlength: 3 },
            witness1_phone: { digits: true, minlength: 10, maxlength: 10 },
            witness1_addr_line1: { required: true },
            witness1_addr_line2: { required: true },
            witness1_addr_line3: {},
            witness1_zipcode: { required: true, digits: true, maxlength: 6, minlength: 6 },
            witness1_city: { required: true, alphabetspace: true, minlength: 3 },
            witness1_state: { required: true },
            witness1_country: { required: true },
            witness2_name: { required: true, alphabetspace: true, minlength: 5 },
            witness2_fathername: { required: true, alphabetspace: true, minlength: 3 },
            witness2_phone: { digits: true, maxlength: 10, minlength: 10 },
            witness2_addr_line1: { required: true },
            witness2_addr_line2: { required: true },
            witness2_addr_line3: {},
            witness2_zipcode: { required: true, digits: true, maxlength: 6, minlength: 6 },
            witness2_city: { required: true, alphabetspace: true, minlength: 3 },
            witness2_state: { required: true },
            witness2_country: { required: true }
        },
        messages: {
            witness1_name: {
                required: "Please enter name",
                alphabetspace: "Please enter only alphabets",
                minlength: "Name should be at least 3 characters"
            },
            witness1_fathername: {
                required: "Please enter father name",
                alphabetspace: "Please enter only alphabets",
                minlength: "Name should be at least 3 characters"
            },
            witness1_phone: {
                digits: "Please enter only numbers",
                maxlength: "Please enter valid mobile number",
                minlength: "Please enter valid mobile number",
            },
            witness1_addr_line1: {
                required: "Please enter address"
            },
            witness1_addr_line2: {
                required: "Please enter address"
            },
            witness1_addr_line3: {},
            witness1_zipcode: {
                required: "Please enter pincode",
                digits: "Please enter only numbers",
                maxlength: "Pincode must be 6 digits",
                minlength: "Pincode must be 6 digits"
            },
            witness1_city: {
                required: "Please enter city",
                alphabetspace: "Please enter only alphabets",
                minlength: "City should be atleast 3 characters"
            },
            witness1_state: {
                required: "Please select the state"
            },
            witness1_country: {
                required: " please select the country"
            },
            witness2_name: {
                required: "Please enter name",
                alphabetspace: "Please enter valid letters only",
                minlength: "Name should be at least 3 characters"
            },
            witness2_fathername: {
                required: "Please enter father name",
                alphabetspace: "Please enter only alphabets",
                minlength: "Name should be at least 3 characters"
            },
            witness2_phone: {
                digits: "Please enter only numbers",
                maxlength: "Please enter valid mobile number",
                minlength: "Please enter valid mobile number",
            },
            witness2_addr_line1: {
                required: "Please enter address"
            },
            witness2_addr_line2: {
                required: "Please enter address"
            },
            witness2_addr_line3: {},
            witness2_zipcode: {
                required: "Please enter pincode",
                digits: "Please enter only numbers",
                maxlength: "Pincode must be 6 digits",
                minlength: "Pincode must be 6 digits"
            },
            witness2_city: {
                required: "Please enter city",
                alphabetspace: "Please enter only alphabets",
                minlength: "City should be atleast 3 characters"
            },
            witness2_state: {
                required: "Please select the state"
            },
            witness2_country: {
                required: " please select the country"
            }
        },
        errorPlacement: function (label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function (element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });

    $("#frmCustodian").validate({
        rules: {
            cust_name: { required: true, alphabetspace: true, minlength: 3 },
            cust_father_name: { required: true, alphabetspace: true, minlength: 3 },
            cust_addr1: { required: true },
            cust_addr2: { required: true },
            cust_addr3: {},
            cust_city: { required: true, alphabetspace: true, minlength: 3 },
            cust_state: { required: true },
            cust_zip: { required: true, digits: true, maxlength: 6, minlength: 6 },
            cust_country: { required: true },
            cust_age: { required: true, digits: true, range: [18, 100] },
            cust_religion: { required: true },
            cust_nationality: { required: true }
        },
        messages: {
            cust_name: {
                required: "Please enter the name",
                alphabetspace: "Please enter only alphabets",
                minlength: "Name should be at least 3 characters"
            },
            cust_father_name: {
                required: "Please enter the father's name",
                alphabetspace: "Please enter only alphabets",
                minlength: "Name should be at least 3 characters"
            },
            cust_addr1: {
                required: "Please enter the address"
            },
            cust_addr2: {
                required: "Please enter the address"
            },
            cust_addr3: {},
            cust_city: {
                required: "Please enter the city",
                alphabetspace: "Please enter only alphabets",
                minlength: "City should be atleast 3 characters"
            },
            cust_state: {
                required: "please select the state"
            },
            cust_zip: {
                required: "Please enter pincode",
                digits: "Please enter only numbers",
                maxlength: "Pincode must be 6 digits",
                minlength: "Pincode must be 6 digits"
            },
            cust_country: {
                required: "Please select the country"
            },
            cust_age: {
                required: "Please enter the age ",
                digits: "Please enter only numbers",
                range: "Age must be greaterthan 18"
            },
            cust_religion: {
                required: "Please select the religion"
            },
            cust_nationality: {
                required: "Please select the nationality"
            },
        },
        errorPlacement: function (label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function (element, errorClass) {
            $(element).parent().addClass('has-danger');
            $(element).addClass('form-control-danger');
        }
    });

    $("#frmProfiles").validate({
        rules: {
            pan_number: { required: true, pan: true },
            aadhaar_no: { required: true, aadhaar: true, maxlength: 12, minlength: 12 },
            dob: { required: true, date: true },
            age: { required: true, digits: true, range: [1, 100] },
            sex: { required: true, },
            email: { required: true, email: true },
            isd: { maxlength: 3 },
            contact_no: { required: true, digits: true, maxlength: 10, minlength: 10 },
            landline: { digits: true },
            nationality: { required: true },
            religion: { required: true },
            father_name: { required: true, alphabetspace: true, minlength: 3 },
            address1: { required: true },
            address2: { required: true },
            address3: {},
            city: { required: true, minlength: 3 },
            state: { required: true },
            pincode: { required: true, digits: true, maxlength: 6, minlength: 6 },
            country: { required: true },
            cor_addr1: { required: true },
            cor_addr2: { required: true },
            cor_addr3: {},
            cor_city: { required: true, minlength: 3 },
            cor_state: { required: true },
            cor_zip: { required: true, digits: true, maxlength: 6, minlength: 6 },
            cor_country: { required: true },
            pi_place: { required: true },
            pi_date: {},
        },
        messages: {
            pan_number: {
                required: "Please enter pan number",
                pan: "Please enter valid PAN number"
            },
            aadhaar_no: {
                required: "Please enter aadhar number",
                aadhaar: "Please enter valid aadhaar number",
                maxlength: "Aadhaar number must be 12 digits",
                minlength: "Aadhaar number must be 12 digits"
            },
            dob: {
                required: "Please enter date of birth",
                date: "please enter valid date"
            },
            age: {
                required: "Please enter age",
                digits: "Please enter only digits",
                range: "Age must be between 1 to 100"
            },
            gender: {
                required: "Please select gender",
            },
            email: {
                required: "Please enter email address",
                email: " Please enter a valid email address"
            },
            isd: {
                required: "Please enter isd number",
                maxlength: "isd should be of 3 digits"
            },
            contact_no: {
                required: "Please enter mobile number",
                digits: "Please enter only digits",
                maxlength: "Mobile number should be of 10 digits",
                minlength: "Mobile number should be of 10 digits"
            },
            landline: {
                required: "Please enter landline number",
                digits: "Please enter only digits"
            },
            nationality: {
                required: "Please select nationality"
            },
            religion: {
                required: "Please select religion"
            },
            father_name: {
                required: "Please enter father's name",
                alphabetspace: "Please enter only alphabets",
                minlength: "Father's name should be at least 3 characters"
            },
            address1: {
                required: "Please enter address line 1"
            },
            address2: {
                required: "Please enter address line 2"
            },
            address3: {},
            city: {
                required: "Please enter city",
                minlength: "City should be atleast 3 characters"
            },
            state: {
                required: "Please select state"
            },
            pincode: {
                required: "Please enter zipcode",
                digits: "Please enter only digits",
                maxlength: "zipcode should be of 6 characters ",
                minlength: "zipcode should be of 6 characters "
            },
            country: {
                required: "Please select country"
            },
            cor_addr1: {
                required: "Please enter address line 1"
            },
            cor_addr2: {
                required: "Please enter address line 2"
            },
            cor_addr3: {},
            cor_city: {
                required: "Please enter city",
                minlength: "City should be atleast 3 characters"
            },
            cor_state: {
                required: "Please select state",
            },
            cor_zip: {
                required: "Please enter zipcode",
                digits: "Please enter only digits",
                maxlength: "zipcode should be of 6 characters ",
                minlength: "zipcode should be of 6 characters "
            },
            cor_country: {
                required: "Please enter country"
            },
            pi_place: {
                required: "Please enter place"
            },
            pi_date: {
                required: "Please enter date"
            },
        }
    });

    $("#frmBeneficiary").validate({
        rules: {
            ben_title: { required: true },
            ben_fname: { required: true, alphabetspace: true, minlength: 3 },
            ben_mname: { alphabetspace: true },
            ben_lname: { required: true, alphabetspace: true },
            ben_gender: { required: true },
            ben_dob: { required: true },
            ben_age: { required: true, range: [1, 100] },
            ben_minor: { required: true, range: [1, 18] },
            ben_isd: { required: false },
            ben_mobile: { required: false, digits: true, maxlength: 10, minlength: 10 },
            other_rel: { required: true },
            ben_rel_with_testator: { required: true },
            ben_perm_addr1: { required: true },
            ben_perm_addr2: { required: true },
            ben_perm_city: { required: true, minlength: 3 },
            ben_perm_state: { required: true },
            ben_perm_zip: { required: true, digits: true, maxlength: 6, minlength: 6 },
            ben_perm_country: { required: true },
            ben_cor_as_perm: { required: false },
            ben_cor_addr1: { required: true },
            ben_cor_addr2: { required: true },
            ben_cor_city: { required: true, minlength: 3 },
            ben_cor_state: { required: true },
            ben_cor_zip: { required: true, digits: true, maxlength: 6, minlength: 6 },
            ben_cor_country: { required: true },
        },
        messages: {
            ben_title: { required: "Please select the title" },
            ben_fname: {
                required: "Please enter the first name",
                alphabetspace: "Please enter only alphabets",
                minlength: "First name should be at least 3 characters"
            },
            ben_mname: {
                alphabetspace: "Please enter only alphabets"
            },
            ben_lname: {
                required: "Please enter the last name",
                alphabetspace: "Please enter only alphabets"
            },
            ben_gender: {
                required: "Please select the gender"
            },
            ben_dob: {
                required: "Please enter the date of birth"
            },
            ben_age: {
                required: "Please enter the age",
                range: "Age must be greaterthan 18"
            },
            ben_minor: {
                required: "please enter minor's age",
                range: "Age must be lessthan 18"
            },
            ben_isd: {
                required: "Please enter isd",
                digits: "Please enter only numbers",
                maxlength: "ISD should be of 3 digits"
            },
            ben_mobile: {
                required: "please enter mobile number",
                digits: "please enter digits only",
                maxlength: "mobile number should be of 10 digits"
            },
            other_rel: {
                required: "please enter other relation"
            },
            ben_rel_with_testator: {
                required: "please enter relation with the testor"
            },
            ben_perm_addr1: {
                required: "please enter address",
                minlength: "address should be of atleast 10 letters"
            },
            ben_perm_addr2: {
                required: "please enter address",
                digits: "please enter digits only",
                minlength: "address should be of atleast 10 letters"
            },
            ben_perm_city: {
                required: "please enter city name",
                minlength: "city should be of atleast 5 letters"
            },
            ben_perm_state: {
                required: "please enter state name",
                alphabetspace: "please enter characters only",
                minlength: "state should be of atleast 5 letters"
            },
            ben_perm_zip: {
                required: "please enter zipcode",
                digits: "please enter digits only",
                maxlength: "zipcode should be of 5 letters"
            },
            ben_perm_country: {
                required: "please enter country name",
                minlength: "country name should be of atleast 5 letters"
            },
            ben_cor_as_perm: {
                required: "please select "
            },
            ben_cor_addr1: {
                required: "please enter address",
                minlength: "address should be of atleast 5 letters"
            },
            ben_cor_addr2: {
                required: "please enter address",
                minlength: "address should be of atleast 5 letters"
            },
            ben_cor_city: {
                required: "please enter city",
                minlength: "city should be of atleast 5 letters"
            },
            ben_cor_state: {
                required: "please enter state"
            },
            ben_cor_zip: {
                required: "please enter zipcode",
                digits: "please enter digits only",
                maxlength: "zipcode should be of 6 letters"
            },
            ben_cor_country: {
                required: "please enter country name",
                minlength: "country name should be of atleast 5 letters"
            },
        },
    });
    $("#addBankAccount").validate({
        rules: {
            ba_ac_number: { required: true },
            ba_bank_name: { required: true },
            ba_branch_name: { required: true },
            ba_account_type: { required: true },
            ba_addr1: { required: false },
            ba_addr2: { required: false },
            ba_city: { required: false, minlength: 3, alphabetspace: true },
            ba_state: { required: false },
            ba_ziP: { required: false, digits: true, minlength: 6, maxlength: 6 },
            ba_country: { required: false },
            ba_ownership_perc: { required: true, range: [1, 100] },
        },
        messages: {
            ba_ac_number: { required: "Please enter account number" },
            ba_bank_name: { required: "Please enter bank name" },
            ba_branch_name: { required: "Please enter branch name" },
            ba_account_type: { required: "Please select account type" },
            ba_addr1: { required: "Please enter address" },
            ba_addr2: { required: "Please enter address", },
            ba_city: {
                required: "Please enter city",
                minlength: "City should be of atleast 3 letters",
                alphabetspace: "Please enter characters only"
            },
            ba_state: { required: "Please select state" },
            ba_ziP: {
                required: "Please enter zipcode",
                digits: "Please enter digits only",
                minlength: "Zipcode should be of 6 digits",
                maxlength: "zipcode should be of 6 digits"
            },
            ba_country: { required: "Please select country" },
            ba_ownership_perc: {
                required: "Please enter ownership percentage",
                digits: "Please enter digits only",
                range: "Percentage must be between 1 to 100"
            },
        }
    });
    $("#addLockerAccount").validate({
        rules: {
            loc_number: { required: true, digits: true },
            loc_bank_name: { required: true },
            loc_branch_name: { required: true },
            loc_addr1: { required: false },
            loc_addr2: { required: false },
            loc_city: { required: false, alphabetspace: true, minlength: 3 },
            loc_zip: { required: false, digits: true, maxlength: 6, minlength: 6 },
            loc_state: { required: false },
            loc_country: { required: false },
            loc_ownership_perc: { required: true, digits: true, range: [1, 100] },
        },
        messages: {
            loc_number: {
                required: "Please enter locker number",
                digits: "Please enter digits only"
            },
            loc_bank_name: { required: "Please enter locker bank name" },
            loc_branch_name: { required: "Please enter locker branch name" },
            loc_addr1: { required: "Please enter locker address" },
            loc_addr2: { required: "Please enter locker address" },
            loc_city: {
                required: "Please enter city name",
                minlength: "City name should be of atleast 3 letters",
                alPhabetsPace: "Please enter alphabets only"
            },
            loc_zip: {
                required: "Please enter zip code",
                digits: "Please enter digits only",
                minlength: "zipcode should be of 6 digits",
                maxlength: "zipcode should be of 6 digits"
            },
            loc_state: { required: "Please select state" },
            loc_country: { required: "Please select country name" },
            loc_ownershiP_Perc: {
                required: "Please enter ownership Percentage",
                digits: "Please enter digits only",
                range: "Percentage must be between 1 to 100"
            },
        }
    });
    $("#addFixedDeposit").validate({
        rules: {
            fd_ac_number: { required: true },
            fd_ifsc_code: { required: true },
            fd_bank_name: { required: true, alphabetspace: true },
            fd_branch_name: { required: true, alphabetspace: true },
            fd_addr1: { required: false },
            fd_addr2: { required: false },
            fd_addr3: {},
            fd_city: { required: false },
            fd_country: { required: false },
            fd_zip: { required: false, digits: true, maxlength: 6, minlength: 6 },
            fd_ownership_perc: { required: true, digits: true, range: [1, 100] },
        },
        messages: {
            fd_ac_number: { required: "Please enter fixed deposit account number" },
            fd_ifsc_code: { required: "Please enter IFCS code" },
            fd_bank_name: {
                required: "Please enter bank name",
                alphabetspace: "Please enter alphabets only"
            },
            fd_branch_name: {
                required: "Please enter branch name",
                alphabetspace: "Please enter alphabets only"
            },
            fd_addr1: { required: "Please enter address" },
            fd_addr2: { required: "Please enter address" },
            fd_addr3: {},
            fd_city: { required: "Please enter city" },
            fd_country: { required: "Please enter country" },
            fd_zip: {
                required: "Please enter zipcode",
                digits: "Please enter digits only",
                maxlength: "zipcode should be of 6 digits",
                minlength: "zipcode should be of 6 digits"
            },
            fd_ownership_perc: {
                required: "Please enter ownership percentage",
                digits: "Please enter digits only",
                range: "Percentage must be between 1 to 100"
            },
        },
    });

    $("#addMF").validate({
        rules: {
            mf_name: { required: true,  alphabetspace: true },
            mf_scheme: { required: true },
            mf_folio_number: { required: true, minlength: 5 },
            mf_amount: { required: true, digits: true },
            mf_share_count: { required: true, digit: true }
        },
        messages: {
            mf_name: { required: "Please enter mutual fund name", alPhabetsPace: "Please enter alphabets only" },
            mf_scheme: { required: "Please enter scheme name" },
            mf_folio_number: { required: "Please enter folio number", minlength: "Folio number should be of atleast 5 letters" },
            mf_amount: { required: "Please enter amount", digits: "Please enter digits only" },
            mf_share_count: { required: "Please enter the number of units", digit: "Please enter digits only", range: "Percentage must be between 1 to 100" }
        },
    });
    $("#addShare").validate({
        rules: {
            share_type: { required: true },
            share_company_name: { required: true, alphabetspace: true },
            share_demat_number: { required: true, digits: 5 },
            share_amount: { required: true, digits: true },
            share_bank_name: { required: true, digit: true, range: [0, 100] }
        },
        messages: {
            share_type: { required: "Please enter share type" },
            share_company_name: { required: "Please enter company name", alphabetspace: "Please enter alphabets only" },
            share_demat_number: { required: "Please enter demat number", digits: "Please enter digits only" },
            share_amount: { required: "Please enter amount", digits: "Please enter digits only" },
            share_bank_name: { required: "Please enter bank name", alphabetspace: "Please enter alphabets only" }
        },
    });
    $("#addBond").validate({
        rules: {
            bond_scheme_details: { required: true },
            bond_company_name: { required: true, alphabetspace: true },
            bond_dmat_number: { required: true, digits: 5 },
            bond_amount: { required: true, digits: true },
            bond_bank_name: { required: true, digit: true, range: [0, 100] }
        },
        messages: {
            bond_scheme_details: { required: "Please enter scheme details" },
            bond_company_name: { required: "Please enter company name", alphabetspace: "Please enter alphabets only" },
            bond_dmat_number: { required: "Please enter demat number", digits: "Please enter digits only" },
            bond_amount: { required: "Please enter amount", digits: "Please enter digits only" },
            bond_bank_name: { required: "Please enter bank name", alphabetspace: "Please enter alphabets only" }
        },
    }); 
    $("#addProperty").validate({
        rules: {
            property_type: { required: true },
            property_addr1: { required: true },
            property_addr2: { required: true },
            property_city: { required: true, minlength: 3, alPhabetspace: true },
            property_zip: { required: true, minlength: 6, maxlength: 6, alphabetspace: true },
            property_country: { required: true },
            property_state: { required: true },
            property_measurement: { required: true, digit: true },
            property_ownership_status: { required: true },
            property_ownership_perc: { required: true, range: [1, 100], digit: true }
        },
        messages: {
            property_type: { required: "Please select property type" },
            property_addr1: { required: "Please enter address" },
            property_addr2: { required: "Please enter address" },
            property_city: { required: "Please enter city", minlength: "City should be of 3 digits", alphabetspace: "Please enter alphabets only" },
            property_zip: { required: "Please enter zipcode", minlength: "Zipcode should be of 6 digits", maxlength: "Zipcode should be of 6 digits", digit: "Please enter digits only" },
            property_country: { required: "Please select country" },
            property_state: { required: "Please select state" },
            property_measurement: { required: "Please enter the measurement of the property", digit: "Please enter digits only" },
            property_ownership_status: { required: "Please select ownership status" },
            property_ownership_perc: { required: " Please enter ownership percentage", range: "Percentage must be between 1 to 100", digit: "Please enter digits only" }
        },
    });
    $("#addBusiness").validate({
        rules: {
            business_type: { required: true, alphabetsPace: true },
            business_owner_type: { required: true, alphabetsPace: true },
            business_company_name: { required: true,  alphabetsPace: true },
            businesss_ownership_perc: { required: true, alphabetsPace: true },
            business_addr1: { required: true },
            business_addr2: { required: true },
            business_city: { required: true, minlength: 3, alphabetsPace: true },
            business_state: { required: true },
            business_country: { required: true },
            business_zip: { required: true, minlength: 6, maxlength: 6, digit: true },
        },
        messages: {
            business_type: { required: "Please enter type", alphabetsPace: "Please enter alphabets only" },
            business_owner_type: { required: "Please enter ownership type", alphabetspace: "Please enter alphabets only" },
            business_company_name: { required: "Please enter company name", alphabetspace: "Please enter alphabets only" },
            businesss_ownership_perc: { required: "Please enter the ownership percentage", digit: "Please enter digits only" },
            business_addr1: { required: "Please enter address" },
            business_addr2: { required: "Please enter address" },
            business_city: { required: "Please enter city", minlength: "City should be of atleast 3 letters", alphabetsPace: "please enter alphabets only" },
            business_state: { required: "please Select state" },
            business_country: { required: "Please select country" },
            business_zip: {
                required: "Please enter zipcode",
                minlength: "Zipcode should be of 6 digits",
                maxlength: "Zipcode should be of 6 digits",
                digit: "Please enter digits only"
            },
        },
    });

    $("#addPF").validate({
        rules: {
            pf_ac_number: { required: true, digit: true },
            pf_company_name: { required: true, alphabetsPace: true },
            pf_addr1: { required: true },
            pf_addr2: { required: true },
            pf_city: { required: true, minlength: 3, alphabetsPace: true },
            pf_state: { required: true },
            pf_country: { required: true },
            pf_zip: { required: true, minlength: 5, maxlength: 5, digit: true },
            pf_ownership_perc: { required: true, digit: true }
        },
        messages: {
            pf_ac_number: { required: "Please enter account number", digit: "Please enter digits only" },
            pf_company_name: { required: "Please enter the company name", alphabetspace: "Please enter alphabets only" },
            pf_addr1: { required: "Please enter the address" },
            pf_addr2: { required: "Please enter the address" },
            pf_city: { required: "Please enter the city name", minlength: "City should be of atleast 3 letters", alphabetspace: "Please enter alphabets only" },
            pf_state: { required: "Please select state" },
            pf_country: { required: "Please select the country" },
            pf_zip: { required: "Please enter the zipcode", minlength: "zipcode should be of 6 digits", maxlength: "zipcode should be of  6 digits", digit: "Please enter digits only" },
            pf_ownership_perc: { required: "Please enter ownership percentage", digit: "Please enter digits only" }
        },
    });

    $("#addPension").validate({
        rules: {
            pension_plan_name: { required: true, alphabetsPace: true },
            pension_ac_number: { required: true, digit: true },
            pension_company_name: { required: true, alphabetsPace: true },
            pension_addr1: { required: true },
            pension_addr2: { required: true },
            pension_city: { required: true, minlength: 3, alphabetsPace: true },
            pension_state: { required: true },
            pension_country: { required: true },
            pension_zip: { required: true, minlength: 5, maxlength: 5, digit: true }
        },
        messages: {
            pension_plan_name: { required: "Please enter account number", alphabetspace: "Please enter alphabets only" },
            pension_ac_number: { required: "Please enter the company name", digit: "Please enter digits only" },
            pension_company_name: { required: "Please enter company name", alphabetsPace: "Please enter alphabets only" },
            pension_addr1: { required: "Please enter the address" },
            pension_addr2: { required: "Please enter the address" },
            pension_city: { required: "Please enter the city name", minlength: "City should be of atleast 3 letters", alphabetspace: "Please enter alphabets only" },
            pension_state: { required: "Please select state" },
            pension_country: { required: "Please select the country" },
            pension_zip: { required: "Please enter the zipcode", minlength: "zipcode should be of 6 digits", maxlength: "zipcode should be of  6 digits", digit: "Please enter digits only" }
        },
    });

    $("#addGratuity").validate({
        rules: {
            gratuity_ac_number: { required: true, digit: true },
            gratuity_company_name: { required: true, alphabetsPace: true },
            gratuity_addr1: { required: true },
            gratuity_addr2: { required: true },
            gratuity_city: { required: true, minlength: 3, alphabetsPace: true },
            gratuity_state: { required: true },
            gratuity_country: { required: true },
            gratuity_zip: { required: true, minlength: 5, maxlength: 5, digit: true }
        },
        messages: {
            gratuity_ac_number: { required: "Please enter the company name", digit: "Please enter digits only" },
            gratuity_company_name: { required: "Please enter company name", alphabetsPace: "Please enter alphabets only" },
            gratuity_addr1: { required: "Please enter the address" },
            gratuity_addr2: { required: "Please enter the address" },
            gratuity_city: { required: "Please enter the city name", minlength: "City should be of atleast 3 letters", alphabetspace: "Please enter alphabets only" },
            gratuity_state: { required: "Please select state" },
            gratuity_country: { required: "Please select the country" },
            gratuity_zip: { required: "Please enter the zipcode", minlength: "zipcode should be of 6 digits", maxlength: "zipcode should be of  6 digits", digit: "Please enter digits only" }
        },
    });

    $("#addGeneralInsurance").validate({
        rules: {
            gi_policy_type: { required: true },
            gi_policy_number: { required: true },
            gi_com_name: { required: true, alphabetspace: true },
            gi_policy_start_date: { required: true },
            gi_maturity_date: { required: true },
            gi_amount: { required: true, digits: true }
        },
        messages: {
            gi_policy_type: { required: "Please enter policy type" },
            gi_policy_number: { required: "Please enter policy number" },
            gi_com_name: { required: "Please enter policy company name", alphabetspace: "Please enter alphabets only" },
            gi_policy_start_date: { required: "Please select start date" },
            gi_maturity_date: { required: "Please enter maturity date" },
            gi_amount: { required: "Please enter amount", digits: "Please enter digits only" }
        },
    });

    $("#addLifeInsurance").validate({
        rules: {
            li_issuer_name: { required: true, alphabetspace: true },
            li_policy_number: { required: true },
            li_start_date: { required: true },
            li_maturity_date: { required: true },
            li_branch_name: { required: true, alphabetspace: true },
            li_sum_assured: { required: true, digits: true }
        },
        messages: {
            li_issuer_name: { required: "Please enter issuer name", alphabetspace: "Please enter alphabets only" },
            li_policy_number: { required: "Please enter policy number" },
            li_start_date: { required: "Please select start date" },
            li_maturity_date: { required: "Please select maturity date" },
            li_branch_name: { required: "Please enter branch date", alphabetspace: "Please enter alphabets only" },
            li_sum_assured: { required: "Please enter amount", digits: "Please enter digits only" }
        },
    });

    $("#addJewel").validate({
        rules: {
            jwl_type: { required: true },
            jwl_name: { required: true, alphabetspace: true },
            jwl_amount: { required: true, digits: true },
            jwl_description: { required: true }
        },
        messages: {
            jwl_type: { required: "Please select jewel type" },
            jwl_name: { required: "Please enter jewel name", alphabetspace: "Please enter alphabets only" },
            jwl_amount: { required: "Please enter grams", digits: "Please enter digits only" },
            jwl_description: { required: "Please enter description" }
        },
    });

    $("#addBodyOrgans").validate({
        rules: {
            body_organ_name: { required: true },
            body_organ_hospital_name: { required: true },
            body_organ_addr1: { required: false },
            body_organ_addr2: { required: false },
            body_organ_city: { required: false },
            body_organ_state: { required: false },
            body_organ_country: { required: false },
            body_organ_zip: { required: false, digits: true, maxlength: 6, minlength: 6 },
        },
        messages: {
            body_organ_name: { required: "Please enter fixed deposit account number" },
            body_organ_hospital_name: { required: "Please enter IFCS code" },
            body_organ_addr1: { required: "Please enter address" },
            body_organ_addr2: { required: "Please enter address" },
            body_organ_city: { required: "Please enter city" },
            body_organ_state: { required: "Please select state" },
            body_organ_country: { required: "Please select country" },
            body_organ_zip: {
                required: "Please enter zipcode",
                digits: "Please enter digits only",
                maxlength: "zipcode should be of 6 digits",
                minlength: "zipcode should be of 6 digits"
            }
        },
    });

    $("#addPetAnimal").validate({
        rules: {
            pet_animal_type: { required: true },
            pet_animal_name: { required: true, alphabetspace: true },
            pet_animal_beneficiary: { required: true }
        },
        messages: {
            pet_animal_type: { required: "Please enter animal type" },
            pet_animal_name: { required: "Please enter name of the pet", alphabetspace: "Please enter alphabets only" },
            pet_animal_beneficiary: { required: "Please select beneficiary" }
        },
    });

    $("#addOtherAsset").validate({
        rules: {
            oa_name: { required: true },
            oa_ownership: { required: true },
            oa_own_perc: { required: true },
            oa_desc: { required: true },
            oa_addr1: { required: false },
            oa_addr2: { required: false },
            oa_city: { required: false },
            oa_state: { required: false },
            oa_country: { required: false },
            oa_zip: { required: false, digits: true, maxlength: 6, minlength: 6 },
        },
        messages: {
            oa_name: { required: "Please enter name" },
            oa_ownership: { required: "Please select ownership type" },
            oa_own_perc: { required: "Please enter ownership percentage" },
            oa_desc: { required: "Please enter description" },
            oa_addr1: { required: "Please enter address" },
            oa_addr2: { required: "Please enter address" },
            oa_city: { required: "Please enter city" },
            oa_state: { required: "Please select state" },
            oa_country: { required: "Please select country" },
            oa_zip: {
                required: "Please enter zipcode",
                digits: "Please enter digits only",
                maxlength: "zipcode should be of 6 digits",
                minlength: "zipcode should be of 6 digits"
            }
        },
    });

    $("#addIPR").validate({
        rules: {
            ipr_type: { required: true },
            ipr_amount: { required: true, digits: true }
        },
        messages: {
            ipr_type: { required: "Please select IPR type" },
            ipr_amount: { required: "Please enter amount", digits: "Please enter digits only" }
        },
    });

    $("#addVehicle").validate({
        rules: {
            vehicle_name: { required: true },
            vehicle_ownership: { required: true },
            vehicle_reg_num: { required: true },
            vehicle_color: { required: true },
            vehicle_addr1: { required: false },
            vehicle_addr2: { required: false },
            vehicle_city: { required: false },
            vehicle_state: { required: false },
            vehicle_country: { required: false },
            vehicle_zip: { required: false, digits: true, maxlength: 6, minlength: 6 },
            vehicle_beneficiary: { required: true }
        },
        messages: {
            vehicle_name: { required: "Please enter vehicle name" },
            vehicle_ownership: { required: "Please select ownership type" },
            vehicle_reg_num: { required: "Please enter registration number" },
            vehicle_color: { required: "Please enter vehicle color" },
            vehicle_addr1: { required: "Please enter address" },
            vehicle_addr2: { required: "Please enter address" },
            vehicle_city: { required: "Please enter city" },
            vehicle_state: { required: "Please select state" },
            vehicle_country: { required: "Please select country" },
            vehicle_zip: {
                required: "Please enter zipcode",
                digits: "Please enter digits only",
                maxlength: "zipcode should be of 6 digits",
                minlength: "zipcode should be of 6 digits"
            },
            vehicle_beneficiary: { required: "Please select beneficiary" }
        },
    });

    $("#addLiability").validate({
        rules: {
            liability_type: { required: true },
            liability_institution_name: { required: true },
            liability_amount: { required: true, digits: true },
            liability_prop_mes: { required: true },
            liability_addr1: { required: false },
            liability_addr2: { required: false },
            liability_city: { required: false },
            liability_state: { required: true },
            liability_country: { required: false },
            liability_zip: { required: false, digits: true, maxlength: 6, minlength: 6 },
            liability_ind_addr1: { required: false },
            liability_ind_addr2: { required: false },
            liability_ind_city: { required: false },
            liability_ind_state: { required: true },
            liability_ind_country: { required: false },
            liability_ind_zip: { required: false, digits: true, maxlength: 6, minlength: 6 },
            liability_start_date: { required: true },
            liability_closing_date: { required: true },
            liability_account_number: { required: true, digits: true },
            liability_interest_rate: { required: true },
        },
        messages: {
            liability_type: { required: "Please select type" },
            liability_institution_name: { required: "Please enter name" },
            liability_amount: { required: "Please enter amount", digits: "Please enter digits only" },
            liability_prop_mes: { required: "Please enter measurements" },
            liability_addr1: { required: "Please enter address" },
            liability_addr2: { required: "Please enter address" },
            liability_city: { required: "Please enter city" },
            liability_state: { required: "Please select state" },
            liability_country: { required: "Please select country" },
            liability_zip: {
                required: "Please enter zipcode",
                digits: "Please enter digits only",
                maxlength: "zipcode should be of 6 digits",
                minlength: "zipcode should be of 6 digits"
            },
            liability_ind_addr1: { required: "Please enter address" },
            liability_ind_addr2: { required: "Please enter address" },
            liability_ind_city: { required: "Please enter city" },
            liability_ind_state: { required: "Please select state" },
            liability_ind_country: { required: "Please select country" },
            liability_ind_zip: {
                required: "Please enter zipcode",
                digits: "Please enter digits only",
                maxlength: "zipcode should be of 6 digits",
                minlength: "zipcode should be of 6 digits"
            },
            liability_start_date: { required: "Please enter start date" },
            liability_closing_date: { required: "Please enter closing date" },
            liability_account_number: { required: "Please enter amount", digits: "Please enter digits only" },
            liability_interest_rate: { required: "Please enter rate of interest" }
        },
    });
});