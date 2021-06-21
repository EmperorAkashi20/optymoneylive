/* 
   AY-2019-schema-change: Changes related to additional data for filling ITR-1
*/
jQuery(function($) {
	
//Initialize date picker


$('.date-picker-itr-original').datepicker({ 
	autoclose: true,
	format : "dd/mm/yyyy",
	startDate : "01/04/2019",
	endDate : "30/08/2019"
});
/*----------------------------------- 20190226-BSEN -------------------------------------*/
	/*--------------------------------- Change year ------------------------------------*/
$('.date-picker-itr-dob').datepicker({ 
	autoclose: true,
	format : "dd/mm/yyyy",
	endDate : "31/03/2001",
	startDate : "01/01/1920"   
});

/*----------------------------------------------------------------------------------------*/
$('.date-picker-itr-style').datepicker({ 
	autoclose: true,
	format : "dd/mm/yyyy",
	endDate : "31/03/2020",
	startDate : "01/01/1920"   
});
/*----------------------------------- 20190226-BSEN -------------------------------------*/
/*------------------------- Change the Validation style ---------------------------------*/	
//var fourteen_digit_no =  /^[1-9]{1}[0-9]{0,13}$/;	
       var fourteen_digit_no =  /^[0-9]{1}[0-9]{0,13}$/;	
      var validation_regex = {
	  "PAN" : /^[A-Za-z]{3}[pP]{1}[A-Za-z]{1}[0-9]{4}[A-Za-z]{1}$/,		
	  "GeneralPAN" : /^[A-Za-z][A-Za-z][A-Za-z][A-Za-z][A-Za-z]\d\d\d\d[A-Za-z]$/,	
	  "AadhaarCardNo" : /^[0-9]{12}$/,
	  "AadhaarEnrolmentId" : /^[0-9]{28}$/,
	  "MobileNo" : /^[1-9]{1}[0-9]{9}$/, 
	  "EmailAddress" : /^([\.a-zA-Z0-9_\-])+@([a-zA-Z0-9_\-])+(([a-zA-Z0-9_\-])*\.([a-zA-Z0-9_\-])+)+$/, 
	  "PinCode" : /^[1-9]{1}[0-9]{5}$/,	  
	  "ReceiptNo" : /^[0-9]{15}$/,
	  "Salary" : fourteen_digit_no,
	  "AlwnsNotExempt" : fourteen_digit_no,
	  "PerquisitesValue" : fourteen_digit_no,
	  "ProfitsInSalary" : fourteen_digit_no,
	  "DeductionUs16" :  /^[1-4]{0}[0-4]{4}$/,
	  "IncomeFromSal" : fourteen_digit_no,
	  "14DigitNumber" : fourteen_digit_no,
      "dividedincome" : /^[0-4]{0}[0-4]{9}$/,
	  "TAN" :  /^[A-Za-z]{4}[0-9]{5}[A-Za-z]$/,
	  "Number" : /^[1-9]{1}[0-9]*$/,
	  "challan" :/^[0-9]{5}$/,
	  "Percentage" : /^[1-9][0-9]?$|^100$/,
	  "Alphabets" : /^[a-zA-Z ]+$/,
	  //"BankAccountNo" : /^[a-zA-Z0-9]([/-]?(((\d*[1-9]\d*)*[a-zA-Z/-])|(\d*[1-9]\d*[a-zA-Z]*))+)*[0-9]*$/,
	  "BankAccountNo" : /^[0-9]{9,16}$/,

	  "IFSCCode" : /^[A-Z]{4}[0][A-Z0-9]{6}$/,
	  //"BSRCode" : /^\d\d\d\d\d\d\d$/
	  "BSRCode" : /^[0-9]{7}/
	};
	
	var dependent_elements = ['sou_oth_oi_agriinc','sou_oth_oi_diviinc','sou_oth_exi_agriinc','sou_oth_exi_diviinc'];
	var $error_ele = $('<span>',{class : 'red error-msg'});
	
	//Validations for personal details
	
	$("[name='itr_pd_return_type']").on('change',function(){
		if($(this).val() == "O")
		{
			$("[name='itr_pd_ackno_orreturn']").attr('required',false).closest('.form-group').hide();
			$("[name='itr_pd_date_filoeriretu']").attr('required',false).closest('.form-group').hide();
		}
		else
		{
			$("[name='itr_pd_ackno_orreturn']").attr('required',true).closest('.form-group').show();
			$("[name='itr_pd_date_filoeriretu']").attr('required',true).closest('.form-group').show();						
		}	
	})

	$("#tabUserProf,#tabOther").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $ele.closest('form');
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');
			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				if(validation_name == "DOB" && calculateAge(ele_value) < 18)
				{
                    //console.log("hi");
					var ele_name = $ele.closest('.form-group').find('label').text();					
					$error_ele.text("Minors (less than 18 years of age) cannot file return");
					$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);		
				}	
				else
				{
					$ele.removeClass('error').next('span.red').remove();
					
					if(dependency = $ele.data('dependency'))
					{
						$("[data-xml='"+dependency+"']",$form).removeClass('error').next('span.red').remove();
					}					
				}			
			}	
				
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}						
		}			
	});
	
	$("#form_1").on('submit',function(e){
		e.preventDefault();
		
		var $form = $(this);
		var has_error = false;	

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			
			$form.find('.error').removeClass('error').next('span.red').remove();	
			
			if($("select[data-xml='ReturnType']",$form).val() == 'Revised')
			{
				if(!$("[data-xml='ReceiptNo']",$form).val().trim())
				{
					$error_ele.text('Acknowledgement No of original return is required');
					$("[data-xml='ReceiptNo']",$form).addClass(error_classes).after($error_ele.clone());

					has_error = true;		
				}

				if(!$("[data-xml='OrigRetFiledDate']",$form).val().trim())
				{
					$error_ele.text('Date of filing original return is required');
					$("[data-xml='OrigRetFiledDate']",$form).addClass(error_classes).after($error_ele.clone());		
					
					has_error = true;							
				}			

			}

			if(!$("[data-xml='AadhaarCardNo']").val().trim() && !$("[data-xml='AadhaarEnrolmentId']").val().trim())
			{
				$error_ele.text('Either aadhar card number or aadhar enrollment number is required');
				$("[data-xml='AadhaarCardNo']",$form).addClass(error_classes).after($error_ele.clone());
				
				$("[data-xml='AadhaarEnrolmentId']",$form).addClass(error_classes).after($error_ele.clone());	

				has_error = true;					
			}

			if(!has_error)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});
	
	//Validation end


	/*-------------------------------------------------*/
		$("#form_2").on('submit',function(e){
		e.preventDefault();
		
		var $form = $(this);
		var has_error = false;	

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			ajaxFormSubmit(this,'','');		
		}		
	});
	/*------------------------------------------------*/
	
	//Resident status helper form
	
	$("#res-status-decide").on('click',function(){
		$("#resStatusHelp").find(".res-ques:gt(0)").hide().end().find('input').prop("checked",false);
	});
	
	$("#resStatusHelp").on('click','input',function(e){
		
		var $ele = $(e.target);
		
		var $group_ele =  $ele.closest('.res-ques');
		var question_no = $group_ele.data('no');
		var answer = $ele.val();
		
		var next_question = '';
		
		$group_ele.nextAll('.res-ques').hide();
		
		switch(question_no)
		{
			case 1 : 
				next_question =  ((answer == "1") ? '1d' : '1a'); break;
			case '1a' : 
				next_question = ((answer == "1") ? 'NRI' : '1c'); break;
			case '1c' : 
				next_question = ((answer == "1") ? '1d' : 'NRI'); break;
			case '1d' : 
				next_question = ((answer == "1") ? '1e' : 'NRO'); break;
			case '1e' : 
				next_question = ((answer == "1") ? 'RES' : 'NRO'); break;
		}
		
		if(next_question.length > 2)
		{
			$("[name='itr_pd_resi_sta'][value='"+next_question+"']").prop('checked',true);
			
			$("#resStatusHelp").modal('hide');
		}
		else
		{
			$('.res-ques-'+next_question).show();			
		}	
		
	});
	//resident status helper end	

	//Functions, validations and calculations for salary details
	
	$(".add_sou_salaryy_btn").on('click',function(e){
		var $original_form = $(".add_sou_salaryy_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_sou_salaryy_div:not(.hide)").length == 0)
	{
		$(".add_sou_salaryy_btn").trigger('click');
	}	
		$("#tabFromSalary").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $("#form-income-salary");
		var $container = $ele.closest('.add_sou_salaryy_div');
		
		var required_fields = $form.data('required').split(",");
		var check_fields = $form.data('check').split(",");	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');
			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				recalculateSalary($ele,$container);
				
				setRequired(check_fields,required_fields,$container);
			}

			if(validation_name == "TAN")
			{
				$ele.val(ele_value.toUpperCase());
			}			
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}

			recalculateSalary($ele,$container);	
			
			setRequired(check_fields,required_fields,$container);				
		}			
	});
	
	$("#form-income-salary").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);
		var has_error = false;	
		var have_data = false;	

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			var check_fields = $form.data('check').split(",");	

			$(".add_sou_salaryy_div").each(function(i,item){
				
				$container = $(item);
				var has_value = false;
				
				$(check_fields).each(function(i,field){
					
					var field_val = $("[name='"+field+"']",$container).val().trim();
					
					if(field_val && field_val != "0")
					{
						has_value = true;
						return false;	
					}	
				});
				
				if(!has_value)
				{
					$container.remove();
				}
				else
				{
					have_data = true;
				}	
			});	
			
			if(!has_error)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});
	
	function recalculateSalary($ele,$form)
	{
		var salary_fields = 'sou_sa_profits[],sou_sa_deduction[],sou_sa_hra10[],sou_sa_oth10[],sou_sa_perquisite[],sou_sa_salary[],deductionUs16ii[],deductionUs16iii[]';
		
		var name_prop = $ele.attr('name');
		
		if(salary_fields.indexOf(name_prop) != -1)
		{
			var profits,allowance_hra10,allowance_oth10,perquisites,salary,deduction,deduction16ii,deduction16iii;
			
			deduction16ii = $("[name='deductionUs16ii[]']",$form).val().trim();
			if (deduction16ii > 5000) 
			{
				deduction16ii  = 5000;
			}
			deduction16iii = $("[name='deductionUs16iii[]']",$form).val().trim();

			if (deduction16iii > 5000) 
			{
				deduction16iii  = 5000;
			}
			var salary_total = parseInt(((profits = $("[name='sou_sa_profits[]']",$form).val().trim()) ? profits : 0)) - 
			                   parseInt(((allowance_hra10 = $("[name='sou_sa_hra10[]']",$form).val().trim()) ? allowance_hra10 : 0)) - 
			                   parseInt(((allowance_oth10 = $("[name='sou_sa_oth10[]']",$form).val().trim()) ? allowance_oth10 : 0)) + 
			                   parseInt(((perquisites = $("[name='sou_sa_perquisite[]']",$form).val().trim()) ? perquisites : 0)) + 
			                   parseInt(((salaray = $("[name='sou_sa_salary[]']",$form).val().trim()) ? salaray : 0)) - 
			                   parseInt(((deduction = $("[name='sou_sa_deduction[]']",$form).val().trim()) ? deduction : 0))- 
			                   deduction16ii - deduction16iii; 
			
			$("[name='sou_sa_ntslary[]']",$form).val(salary_total);
		}			
	}		
	
	//Salary income end
	
	//Self occupied property form
	
	$("#selfOccPropertyShow").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $("#form-income-selfoccupied");	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');

			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				recalculateSelfOccHouseInterest();
			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}

			recalculateSelfOccHouseInterest();	
		}			
	});
	
	$("#form-income-selfoccupied").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);
		var has_error = false;	
		var have_data = false;	

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			if(!parseInt($("[name='self_con_income[]']").val()))
			{
				has_error = true;
			}	
			
			if(!has_error)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});	

	function recalculateSelfOccHouseInterest()
	{
		var loan_interest = $("[name='self_hloan_int[]']").val() ? $("[name='self_hloan_int[]']").val() : 0;
		var pre_interest = $("[name='self_con_per_int[]']").val() ? $("[name='self_con_per_int[]']").val() : 0;
		
		var total_interest = (total_interest = parseInt(loan_interest) + parseInt(pre_interest)) <= 200000 ? (-1 * total_interest) : -200000;
		
		$("[name='self_con_income[]']").val(total_interest);			
	}		
	
	//Self occupied property form end
	
	//Let-out property form



	
	$("#letOutProprtyShow").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $("#form-income-letout");	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');

			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				recalculateLetOutHouseInterest();
				recalculateLetOutHouseDeduction();
			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}

			recalculateLetOutHouseInterest();	
			recalculateLetOutHouseDeduction();
		}			
	});
	
	$("#form-income-letout").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);
		var has_error = false;	
		var have_data = false;	

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			if(!parseInt($("[name='let_con_income[]']").val()))
			{
				has_error = true;
			}	
			
			if(!has_error)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});	
	/*--------------------------------------------------------*/

	$("#bank_saving_int").focusout(function(){
		var tta_val = $(this).val();
		if(tta_val > 0)
		{
			
			var dob = $("[name='itr_pd_dob']").val().trim();
			var user_age = calculateAge(dob);

			if (user_age > 60) 
			{	
				var highest_amt = 50000;
			}
			else
			{
				var highest_amt = 10000;
			}
			if (tta_val > highest_amt) 
			{
				tta_val = highest_amt;
			}
			$("#ded_gd__80tta").val(tta_val);
		}
	});
	/*-------------------------------------------------------*/
	function recalculateLetOutHouseInterest()
	{
		var pre_interest = $("[name='let_pre_cons_per_int[]']").val() ? $("[name='let_pre_cons_per_int[]']").val() : 0;
		var loan_interest = $("[name='let_hloan_int[]']").val() ? $("[name='let_hloan_int[]']").val() : 0;
		var deduction = $("[name='let_st_dedu[]']").val() ? $("[name='let_st_dedu[]']").val() : 0;
		var property_tax = $("[name='let_proptex_pad[]']").val() ? $("[name='let_proptex_pad[]']").val() : 0;
		var rental_income = $("[name='let_ren_inc[]']").val() ? $("[name='let_ren_inc[]']").val() : 0;			
		
		var total_income = Math.round(parseInt(rental_income) - parseInt(property_tax) - parseInt(deduction) - parseInt(loan_interest) - parseInt(pre_interest)); 
		
		$("[name='let_con_income[]']").val(total_income);			
	}	

	function recalculateLetOutHouseDeduction()
	{

		var property_tax = $("[name='let_proptex_pad[]']").val() ? $("[name='let_proptex_pad[]']").val() : 0;
		var rental_income = $("[name='let_ren_inc[]']").val() ? $("[name='let_ren_inc[]']").val() : 0;			
		
		if(property_tax && rental_income)
		{
			var deduction = Math.round((parseInt(rental_income) - parseInt(property_tax)) * (3/10)); 
			
			$("[name='let_st_dedu[]']").val(deduction);					
		}			
	}			
	
	//Let out property form end	

	//Other income form
	
	$("#tabOther").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $("#form-income-other");	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');

			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				
				if(($ele.attr('name') == "sou_oth_exi_agriinc") && parseInt(ele_value) > 5000)
				{					
					$error_ele.text('Agricultural income cannot be more than 5000. Please file ITR 2');
					$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);					
				}
				else
				{
					$ele.removeClass('error').next('span.red').remove();				
					recalculateTotalOtherIncome();
					recalculateTotalExemptedIncome();					
				}		
			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}

			recalculateTotalOtherIncome();	
			recalculateTotalExemptedIncome();
		}			
	});
	
	$("#form-income-other").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);
		var has_error = false;	
		var have_data = false;	

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			ajaxFormSubmit(this,'','');	
		}		
	});	

	function recalculateTotalOtherIncome()
	{
		var other_income = $("[name='sou_oth_oi_othinc']").val() ? $("[name='sou_oth_oi_othinc']").val() : 0;
		var other_interest = $("[name='sou_oth_oi_othint']").val() ? $("[name='sou_oth_oi_othint']").val() : 0;
		var bank_interest = $("[name='sou_oth_oi_bnkint']").val() ? $("[name='sou_oth_oi_bnkint']").val() : 0;	
		/*------------------------------------- ADD family Pension -----------------------------------*/
		var family_pension = $("[name='family_pension']").val() ? $("[name='family_pension']").val() : 0;			
		/*------------------------------------ ADD FD ------------------------------------*/
		var bank_interest_fd = $("[name='sou_oth_oi_bnkint_fd']").val() ? $("[name='sou_oth_oi_bnkint_fd']").val() : 0;			

		var total_income = parseInt(other_income) + parseInt(other_interest) + parseInt(bank_interest) + parseInt(family_pension) + parseInt(bank_interest_fd); 


		
		$("[name='sou_oth_oi_totothinc']").val(total_income);			
	}	

	function recalculateTotalExemptedIncome()
	{

		var other_income = $("[name='sou_oth_exi_othinc']").val() ? $("[name='sou_oth_exi_othinc']").val() : 0;
		//var ltcg = $("[name='sou_oth_exi_ltcg']").val() ? $("[name='sou_oth_exi_ltcg']").val() : 0;
		var dividend = $("[name='sou_oth_exi_diviinc']").val() ? $("[name='sou_oth_exi_diviinc']").val() : 0;	
		var agri_income = $("[name='sou_oth_exi_agriinc']").val() ? $("[name='sou_oth_exi_agriinc']").val() : 0;				
		
		var total_income = parseInt(other_income) + parseInt(dividend) + parseInt(agri_income); //+ parseInt(ltcg)
		
		$("[name='sou_oth_exi_totexinc']").val(total_income);				
	}			
	
	//Other income form end	

	//General and health deduction
	$("#genDeduction,#tabHealthInsurance").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $("#form-income-other");	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value != "0")
		{	
			$ele.removeClass('required');
			
			if($ele.prop('name') == 'ded_hi_type')
			{
				$("[name='ded_hi_hip80d_ssc']").attr('required',true);
			}		

			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();

			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}
			
			if($ele.prop('name') == 'ded_hi_type')
			{
				$("[name='ded_hi_hip80d_ssc']").attr('required',false);
			}			

		}			
	});
	
	$("#form-deduction-general,#form-deduction-health").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			ajaxFormSubmit(this,'','');		
		}		
	});
	//End general and health deduction	
	
	
	//Form Donation deductions
	
	$(".add_don100_btn").on('click',function(e){
		var $original_form = $(".add_don100_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_don100_div:not(.hide)").length == 0)
	{
		$(".add_don100_btn").trigger('click');
	}

	$(".add_don50_btn").on('click',function(e){
		var $original_form = $(".add_don50_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_don50_div:not(.hide)").length == 0)
	{
		$(".add_don50_btn").trigger('click');
	}		
	
    /*----------------------------------- 20190514-BSEN ---------------------------------------*/
    
    $(".add_don80gga_bttn").on('click',function(e){
		var $original_form = $(".add_don80gga_div.hide");
        //alert($original_form);
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_don80gga_div:not(.hide)").length == 0)
	{
		$(".add_don80gga_bttn").trigger('click');
	}
    
	/*----------------------------------- 20190514-BSEN ---------------------------------------*/
    
	$("#form-deduction-charity100,#form-deduction-charity50").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $ele.closest('form');
		
		var form_id = $form.attr('id');
		var container_class = ".add_don100_div";
		
		if(form_id == "form-deduction-charity50")
		{
			container_class = ".add_don50_div";
		}
		
		var $container = $ele.closest(container_class);
		
		var required_fields = $form.data('required').split(",");
		var check_fields = required_fields;	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');
			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				setRequired(check_fields,required_fields,$container);
			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}
			
			setRequired(check_fields,required_fields,$container);				
		}			
	});		

	
	$("#form-deduction-charity100,#form-deduction-charity50").on('submit',function(e){
		
		//e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			var form_id = $form.attr('id');
			var container_class = ".add_don100_div";
			
			if(form_id == "form-deduction-charity50")
			{
				container_class = ".add_don50_div";
			}	
			
			$(container_class+":not(.hide):not(:first)").each(function(i,item){
				
				var has_data = false;
				
				$("input",item).each(function(i,control){
					if(control.value.trim())
					{
						has_data = true;
						return false;
					}	
				});
				
				if(!has_data)
				{
					$(item).remove();
				}	
			});
			
			if($('input:required',$form).length > 0)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});
    
    /*----------------------------------------- for Donation80GGA-BSEN-START ----------------------------------------------*/
    
    
    /*   $("#form-deduction-80gga").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $ele.closest('form');
		
		var form_id = $form.attr('id');
		var container_class = ".add_don80gga_div";
		
		var $container = $ele.closest(container_class);
		
		var required_fields = $form.data('required').split(",");
		var check_fields = required_fields;	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');
			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				setRequired(check_fields,required_fields,$container);
			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}
			
			setRequired(check_fields,required_fields,$container);				
		}			
	});	*/	

    
    $("#form-deduction-80gga").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

	/*	var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			var form_id = $form.attr('id');
			var container_class = ".add_don80gga_div";
			
			$(container_class+":not(.hide):not(:first)").each(function(i,item){
				
				var has_data = false;
				
				$("input",item).each(function(i,control){
					if(control.value.trim())
					{
						has_data = true;
						return false;
					}	
				});
				
				if(!has_data)
				{
					$(item).remove();
				}	
			});*/
			
			if($('input:required',$form).length > 0)
			{
                console.log("hi hello /n");
				ajaxFormSubmit(this,'','');
			}		
		//}		
	});
    /*-------------------------------------  for Donation80GGA-BSEN-END ---------------------------------------------*/
    
	
	$("#form-deduction-charityother").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $(this);	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');

			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();

			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}

		}			
	});
	
	$("#form-deduction-charityother").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			ajaxFormSubmit(this,'','');		
		}		
	});		
	
	//End Donation deduction
	
	//Other deductions
	$("#form-deductions-other").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $(this);	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');

			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();

			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}

		}			
	});
	
	$("#form-deductions-other").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			ajaxFormSubmit(this,'','');		
		}		
	});		
	//End Other deductions
	
	//Tax TDS reconciliation
	
	$(".add_taxrecotds_btn").on('click',function(e){
		var $original_form = $(".add_taxrecotds_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_taxrecotds_div:not(.hide)").length == 0)
	{
		$(".add_taxrecotds_btn").trigger('click');
	}

	$(".add_renttds_btn").on('click',function(e){
		var $original_form = $(".add_renttds_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_renttds_div:not(.hide)").length == 0)
	{
		$(".add_renttds_btn").trigger('click');
	}		
		

    /*-------------------------------------------------------- add for Schedule-TCS-START ---------------------------------------------------------------------*/
    
	$(".add_tcs_btn").on('click',function(e){
		var $original_form = $(".add_tcs_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_tcs_div:not(.hide)").length == 0)
	{
		$(".add_tcs_btn").trigger('click');
	}		
		
    /*--------------------------------------------------------- add for Schedule-TCS-END ---------------------------------------------------------------------*/
    
	$("#form-reconcile-tds").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $ele.closest('form');
		
		var $container = $ele.closest('.form_container');
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');
			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				setRequired(null,null,$container);
			}

			if(validation_name == "TAN")
			{
				$ele.val(ele_value.toUpperCase());
			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}
			
			setRequired(null,null,$container);			
		}			
	});		

	
	$("#form-reconcile-tds").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			$(".add_taxrecotds_div:not(.hide):not(:first),.add_renttds_div:not(.hide):not(:first)").each(function(i,item){
				
				var has_data = false;
				
				$("input",item).each(function(i,control){
					if(control.value.trim())
					{
						has_data = true;
						return false;
					}	
				});
				
				if(!has_data)
				{
					$(item).remove();
				}	
			});
			
			if($('input:required',$form).length > 0)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});	
  
    /*------------------------------------------------------------ AJAX-for-Schedule-TCS-START ---------------------------------------------------------*/
  
      $("#form-reconcile-tcs").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $ele.closest('form');
		
		var $container = $ele.closest('.form_container');
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');
			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				setRequired(null,null,$container);
			}

			if(validation_name == "TAN")
			{
				$ele.val(ele_value.toUpperCase());
			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}
			
			setRequired(null,null,$container);			
		}			
	});		

	
	$("#form-reconcile-tcs").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			$(".add_tcs_div:not(.hide):not(:first),.add_renttds_div:not(.hide):not(:first)").each(function(i,item){
				
				var has_data = false;
				
				$("input",item).each(function(i,control){
					if(control.value.trim())
					{
						has_data = true;
						return false;
					}	
				});
				
				if(!has_data)
				{
					$(item).remove();
				}	
			});
			
			if($('input:required',$form).length > 0)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});	  
  
    /*------------------------------------------------------ AJAX-for-Schedule-TCS-END ---------------------------------------------------------------*/
  
	//End TDS reconciliation end
	
	//Taxes paid reconciliation
	$(".add_taxrecotaxpaidadvan_btn").on('click',function(e){
		var $original_form = $(".add_taxrecotaxpaidadvan_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_taxrecotaxpaidadvan_div:not(.hide)").length == 0)
	{
		$(".add_taxrecotaxpaidadvan_btn").trigger('click');
	}

	$(".add_taxrecoselftxpid_btn").on('click',function(e){
		var $original_form = $(".add_taxrecoselftxpid_div.hide");
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_taxrecoselftxpid_div:not(.hide)").length == 0)
	{
		$(".add_taxrecoselftxpid_btn").trigger('click');
	}		
			
	$("#form-rencile-taxpaid").on('focusout','input',function(e){
	
		var $ele = $(e.target);
		
		var $form = $ele.closest('form');
		
		var $container = $ele.closest('.form_container');
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');
			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();
				
				setRequired(null,null,$container);
			}		
		}
		else
		{
			/*if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}
			
			setRequired(null,null,$container);	*/		
		}			
	});		

	
	$("#form-rencile-taxpaid").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			$(".add_taxrecotaxpaidadvan_div:not(.hide):not(:first),.add_taxrecoselftxpid_div:not(.hide):not(:first)").each(function(i,item){
				
				var has_data = false;
				
				$("input",item).each(function(i,control){
					if(control.value.trim())
					{
						has_data = true;
						return false;
					}	
				});
				
				if(!has_data)
				{
					$(item).remove();
				}	
			});
			
			if($('input:required',$form).length > 0)
			{
				ajaxFormSubmit(this,'','');
			}		
		}		
	});			
	//End taxes paid
	
	//Tax Filing
	
	$(".add_taxbankdetails_btn").on('click',function(e){
		
		var $original_form = $(".add_taxbankdetails_div.hide");
		
		$(this).closest(".form-group").before($original_form.clone().removeClass('hide'));		
	});	
	
	if($(".add_taxbankdetails_div:not(.hide)").length == 0)
	{
		$(".add_taxbankdetails_btn").trigger('click');
	}
	
	$("#form-bank-details").on('focusout','input,select',function(e){
	
		var $ele = $(e.target);
		
		var $form = $(this);	
		
		var validation_name = $ele.data('validation');
		var ele_value = $ele.val().trim();
		
		if(ele_value)
		{	
			$ele.removeClass('required');

			
			if( validation_regex[validation_name] && !validation_regex[validation_name].test(ele_value))
			{
				var ele_name = $ele.closest('.form-group').find('label').text();					
				$error_ele.text(ele_name+' is invalid');
				$ele.next('span.red').remove().end().addClass('error regex').after($error_ele);
			}
			else
			{
				$ele.removeClass('error').next('span.red').remove();

			}		
		}
		else
		{
			if(!$ele.hasClass('required'))
			{
				$ele.removeClass('error').next('span.red').remove();						
			}

		}			
	});
	
	$("#form-bank-details").on('submit',function(e){
		
		e.preventDefault();
		
		var $form = $(this);

		var error_classes = "error required";	
		
		if($form.find('.error').length)
		{
			$form.find('.ajaxResClass').text("Please correct all errors before submitting");
		}
		else
		{
			$form.find('.error').removeClass('error').next('span.red').remove();
			
			ajaxFormSubmit(this,'','');		
		}		
	});		
	
	//End tax filing
  
    /*---------------------------------------------------------------*/
  
    $(".salaryplus").on("focusout", function() {
    //alert("sum");
    var sum = 0;
    $("input[class *= 'salaryplus']").each(function(){
        sum += +$(this).val();
    });
      //alert(sum);
    $("#grossal").val(sum);
    });  
  
    /*---------------------------------------------------------------*/
  
     $(".sec_10").on("focusout", function() {
    //alert("sum");
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
    }); 
  
    /*--------------------------------------------------------------*/  
  
    
  
    /*--------------------------------------------------------------*/  
    
    $("#emptype").on("change", function() {
      var value = $(this).val();
      //alert(value);
      if(value == 'GOV' || value == 'PSU')
      {
        $("#de16ii").removeAttr('style');
      }
      else
      {
        //$("#de16ii").add('style="display:none"');
        $("#de16ii").attr('style', 'display: none');
      }
      
      if(value == "PE"){
         $("#de16iii").attr('style', 'display: none');
      }
      else
      {
        $("#de16iii").removeAttr('style');          
      }
    });
  
    /*--------------------------------------------------------------*/
	
	function setRequired(check_fields,required_fields,$container)
	{
		var has_value = false;
		var field_val = null;
		

		if(check_fields)
		{
			$(check_fields).each(function(i,item){
				
				field_val = $("[name='"+item+"']",$container).val().trim();
				
				if(field_val && field_val != "0")
				{
					has_value = true;
					return false;	
				}	
			});				
		}
		else
		{
			$("input",$container).each(function(i,item){
				
				field_val = $(item).val().trim();
				
				if(field_val && field_val != "0")
				{
					has_value = true;
					return false;	
				}	
			});				
		}		
		
		if(has_value)
		{
			if(required_fields)
			{
				$(required_fields).each(function(j,field){
					$("[name='"+field+"']",$container).prop('required',true);
				});					
			}
			else
			{
				$("input",$container).each(function(j,field){
					$(field).prop('required',true);
				});					
			}		
		}
		else
		{
			$(":required",$container).prop('required',false);
		}		
	}	
	
	function taxCalculations()
	{
		var calcs = {
			income_chargable_under_salary :0,
			income_chargable_house_property : 0,
			income_other_sources : 0,
			gross_total_income : 0
		};
		
		$("[name='sou_sa_ntslary[]']").each(function(i,item){
			if(parseInt($(item).val().trim()))
			{
				calcs.income_chargable_under_salary += parseInt($(item).val().trim());					
			}
		});
		
		var basic_salary = 0;

		$("[name='sou_sa_salary[]']").each(function(i,item){
			if(parseInt($(item).val().trim()))
			{
				basic_salary += parseInt($(item).val().trim());					
			}
		});
		
		
		calcs.gross_total_income += calcs.income_chargable_under_salary;
		
		if($("[name='self_con_income[]']").val().trim() || $("[name='let_con_income[]']").val().trim())
		{
			var self_con = $("[name='self_con_income[]']").val().trim() ? parseInt($("[name='self_con_income[]']").val().trim()) : 0;
			var let_con = $("[name='let_con_income[]']").val().trim() ? parseInt($("[name='let_con_income[]']").val().trim()) : 0;
			
			calcs.income_chargable_house_property = self_con + let_con;
		}
		
		calcs.gross_total_income += calcs.income_chargable_house_property;			

		if($("[name='sou_oth_oi_othinc']").val().trim() || $("[name='sou_oth_oi_othint']").val().trim() || $("[name='sou_oth_oi_bnkint']").val().trim())
		{
			var bank_int = $("[name='sou_oth_oi_bnkint']").val().trim() ? parseInt($("[name='sou_oth_oi_bnkint']").val().trim()) : 0;
			var other_int = $("[name='sou_oth_oi_othint']").val().trim() ? parseInt($("[name='sou_oth_oi_othint']").val().trim()) : 0;
			var other_inc = $("[name='sou_oth_oi_othinc']").val().trim() ? parseInt($("[name='sou_oth_oi_othinc']").val().trim()) : 0;				
			
			calcs.income_other_sources = bank_int+other_int+other_inc;
		}
		
		calcs.gross_total_income += calcs.income_other_sources;	

		var deduction_80ccg_org = $("[name='ded_othd_80ccg']").val().trim() ? parseInt($("[name='ded_othd_80ccg']").val().trim()) : 0;	
		var deduction_80rrb_org = $("[name='ded_othd_80rrb']").val().trim() ? parseInt($("[name='ded_othd_80rrb']").val().trim()) : 0;	
		var deduction_80qqb_org = $("[name='ded_othd_80qqb']").val().trim() ? parseInt($("[name='ded_othd_80qqb']").val().trim()) : 0;	
		var deduction_80ee_org = $("[name='ded_othd_80ee']").val().trim() ? parseInt($("[name='ded_othd_80ee']").val().trim()) : 0;	
		var deduction_80e_org = $("[name='ded_othd_80e']").val().trim() ? parseInt($("[name='ded_othd_80e']").val().trim()) : 0;	
		var deduction_80ddb_org = $("[name='ded_othd_80ddb']").val().trim() ? parseInt($("[name='ded_othd_80ddb']").val().trim()) : 0;	
		var deduction_80dd_org = $("[name='ded_othd_80dd']").val().trim() ? parseInt($("[name='ded_othd_80dd']").val().trim()) : 0;	
		var deduction_80u_org = $("[name='ded_othd_80u']").val().trim() ? parseInt($("[name='ded_othd_80u']").val().trim()) : 0;
		var deduction_80tta_org = $("[name='ded_gd__80tta']").val().trim() ? parseInt($("[name='ded_gd__80tta']").val().trim()) : 0;	
		/*-------------------------------------------------------------------------------------------------------------------------*/
		var deduction_80ttb_org = $("[name='ded_gd__80ttb']").val().trim() ? parseInt($("[name='ded_gd__80ttb']").val().trim()) : 0;	
		/*-------------------------------------------------------------------------------------------------------------------------*/
		var deduction_80gg_org = $("[name='ded_gd__80gg']").val().trim() ? parseInt($("[name='ded_gd__80gg']").val().trim()) : 0;	
		var deduction_80ccd2_org = $("[name='ded_othd_80ccd2']").val().trim() ? parseInt($("[name='ded_othd_80ccd2']").val().trim()) : 0;	
		var deduction_80ccd1b_org = $("[name='ded_othd_80ccd1b']").val().trim() ? parseInt($("[name='ded_othd_80ccd1b']").val().trim()) : 0;	
		var deduction_80ccd1_org = $("[name='ded_othd_80ccd1']").val().trim() ? parseInt($("[name='ded_othd_80ccd1']").val().trim()) : 0;	
		var deduction_80ccc_org = $("[name='ded_othd_80ccc']").val().trim() ? parseInt($("[name='ded_othd_80ccc']").val().trim()) : 0;	
		var deduction_80c_org = $("[name='ded_gd__80c']").val().trim() ? parseInt($("[name='ded_gd__80c']").val().trim()) : 0;	
		var deduction_80d_org = $("[name='ded_hi_hip80d_ssc']").val().trim() ? parseInt($("[name='ded_hi_hip80d_ssc']").val().trim()) : 0;	
		var deduction_80ggc_org = $("[name='ded_othdon_80ggc_dpp']").val().trim() ? parseInt($("[name='ded_othdon_80ggc_dpp']").val().trim()) : 0;
		var deduction_80gga_org = $("[name='ded_othdon_80gga_dfsrrd']").val().trim() ? parseInt($("[name='ded_othdon_80gga_dfsrrd']").val().trim()) : 0;
		
		var deduction_80c = deduction_80c_org;
		var deduction_80ccc = deduction_80ccc_org;
		var deduction_80ccd1 = deduction_80ccd1_org;

		if((deduction_80ccd1 + deduction_80ccc + deduction_80c) > 150000)
		{
			if(deduction_80c > 150000)
			{
				deduction_80c = 150000;
				deduction_80ccc = 0;
				deduction_80ccd1 = 0;
			}
			else if((deduction_80ccc + deduction_80c) > 150000)
			{
				deduction_80ccc = 150000 - deduction_80c;
				deduction_80ccd1 = 0;				
			}
			else
			{
				deduction_80ccd1 = 150000 - (deduction_80c + deduction_80ccc);
			}				
		}
		
		var deduction_80ccd1b = deduction_80ccd1b_org;

		if(deduction_80ccd1b > 50000)
		{
			deduction_80ccd1b = 50000;
		}	

		var deduction_80ccd2 =  (deduction_80ccd2_org > (basic_salary / 10)) ? Math.floor((basic_salary / 10)) : deduction_80ccd2_org;	
		
		var deduction_80gg = (deduction_80gg_org > 60000) ? 60000 : deduction_80gg_org;
		
		var deduction_80tta = (deduction_80tta_org > 10000) ? 10000 : deduction_80tta_org;

		var deduction_80ttb = (deduction_80ttb_org > 50000) ? 50000 : deduction_80ttb_org;
		
		var deduction_80d_type = $("[name='ded_hi_type']").val();
		
		var max_deduction_80d = 0;
		
		switch(deduction_80d_type)
		{
			case "1" : max_deduction_80d = 25000; break;
			case "2" : max_deduction_80d = 50000; break;
			case "3" : max_deduction_80d = 25000; break;
			case "4" : max_deduction_80d = 50000; break;
			case "5" : max_deduction_80d = 50000; break;
			case "6" : max_deduction_80d = 75000; break;
			case "7" : max_deduction_80d = 100000; break;
		}
		
		var deduction_80d = (deduction_80d_org > max_deduction_80d) ? max_deduction_80d : deduction_80d_org;

		var deduction_80ggc = (deduction_80ggc_org > calcs.gross_total_income) ? calcs.gross_total_income : deduction_80ggc_org;		

		var deduction_80gga = (deduction_80gga_org > calcs.gross_total_income) ? calcs.gross_total_income : deduction_80gga_org;
		
		var deduction_80u = 0;
		
		if(deduction_80u_org)
		{
			var deduction_80u_type = $("[name='ded_othd_80u_type']").val();
			var deduction_80u_max = 75000;
			
			if(deduction_80u_type == "2")
			{
				deduction_80u_max = 125000;
			}

			deduction_80u = (deduction_80u_org > deduction_80u_max) ? deduction_80u_max : deduction_80u_org;				
		}	
		
		var deduction_80dd = 0;
		
		if(deduction_80dd_org)
		{
			var deduction_80dd_type = $("[name='ded_othd_80dd_type']").val();
			var deduction_80dd_max = 75000;
			
			if(deduction_80dd_type == "2")
			{
				deduction_80dd_max = 125000;
			}

			deduction_80dd = (deduction_80dd_org > deduction_80dd_max) ? deduction_80dd_max : deduction_80dd_org;				
		}

		var deduction_80ddb = 0;
		
		if(deduction_80ddb_org)
		{
			var deduction_80ddb_type = $("[name='ded_othd_80ddb_type']").val();
			var deduction_80ddb_max = 60000;
			
			if(deduction_80ddb_type == "2")
			{
				deduction_80ddb_max = 100000;
			}
			/*else if(deduction_80ddb_type == "3")
			{
				deduction_80ddb_max = 80000;
			}*/

			deduction_80ddb = (deduction_80ddb_org > deduction_80ddb_max) ? deduction_80ddb_max : deduction_80ddb_org;				
		}			
		
		var deduction_80e = (deduction_80e_org > calcs.gross_total_income) ? calcs.gross_total_income : deduction_80e_org;
		
		var deduction_80ee = (deduction_80ee_org > 50000) ? 50000 : deduction_80ee_org;
		
		var deduction_80qqb = (deduction_80qqb_org > 300000) ? 300000 : deduction_80qqb_org;
		
		var deduction_80rrb = (deduction_80rrb_org > 300000) ? 300000 : deduction_80rrb_org;	

		var deduction_80ccg = 0;

		if(calcs.gross_total_income <= 1200000)
		{
			deduction_80ccg = (deduction_80ccg_org > 25000) ? 25000 : deduction_80ccg_org;
		}		
		
	
		calcs.total_deduction = deduction_80gga + deduction_80ggc + deduction_80d + deduction_80c + deduction_80ccc + deduction_80ccd1 + deduction_80ccd1b + deduction_80ccd2 + deduction_80gg + deduction_80tta + deduction_80ttb + deduction_80u + deduction_80dd + deduction_80ddb + deduction_80e + deduction_80ee + deduction_80qqb + deduction_80rrb + deduction_80ccg ;
		
		calcs.deduction_80gga = deduction_80gga;
		calcs.deduction_80ggc = deduction_80ggc;
		calcs.deduction_80ccg = deduction_80ccg;
		calcs.deduction_80rrb = deduction_80rrb;
		calcs.deduction_80qqb = deduction_80qqb;
		calcs.deduction_80ee = deduction_80ee;
		calcs.deduction_80e = deduction_80e;
		calcs.deduction_80ddb = deduction_80ddb;
		calcs.deduction_80dd = deduction_80dd;
		calcs.deduction_80u = deduction_80u;
		calcs.deduction_80tta = deduction_80tta;
		calcs.deduction_80gg = deduction_80gg;
		calcs.deduction_80ccd2 = deduction_80ccd2;
		calcs.deduction_80ccd1b = deduction_80ccd1b;
		calcs.deduction_80ccd1 = deduction_80ccd1;
		calcs.deduction_80ccc = deduction_80ccc;
		calcs.deduction_80c = deduction_80c;
		calcs.deduction_80d = deduction_80d;			
		
		var charitable_donation_limit = Math.floor((calcs.gross_total_income - calcs.total_deduction) / 10);	
		
		var donation_100_deductible = 0;
		
		$(".add_don100_div:not(.hide)").each(function(i,item){
			var $container = $(item);
			
			var donation_amnt = parseInt($("[name='dona_80g_damount[]']",$container).val().trim());
			
			donation_amnt = donation_amnt ? donation_amnt : 0;
			
			var eligible_donation_deduction = donation_amnt;
			
			var donation_eligibility = $("[name='dona_80g_deligilibity[]']",$container).val();
			
			if(donation_eligibility == "with qualifing limit")
			{
				eligible_donation_deduction = (eligible_donation_deduction > charitable_donation_limit) ? charitable_donation_limit : eligible_donation_deduction;
			}

			$("[name='dona_80g_eligdamount[]']",$container).val(eligible_donation_deduction);
			
			donation_100_deductible += eligible_donation_deduction;
			
		});
		
		var donation_50_deductible = 0;
		
		$(".add_don50_div:not(.hide)").each(function(i,item){
			var $container = $(item);
			
			var donation_amnt = parseInt($("[name='dona_80g_damount[]']",$container).val().trim());
			
			donation_amnt = donation_amnt ? donation_amnt : 0;
			
			var eligible_donation_deduction = Math.floor(donation_amnt / 2);
			
			var donation_eligibility = $("[name='dona_80g_deligilibity[]']",$container).val();
			
			if(donation_eligibility == "with qualifing limit")
			{
				eligible_donation_deduction = (eligible_donation_deduction > charitable_donation_limit) ? charitable_donation_limit : eligible_donation_deduction;
			}

			$("[name='dona_80g_eligdamount[]']",$container).val(eligible_donation_deduction);
			
			donation_50_deductible += eligible_donation_deduction;
			
		});	

		calcs.total_deduction += donation_100_deductible + donation_50_deductible;
		
		calcs.donation_100_deductible = donation_100_deductible;
		calcs.donation_50_deductible = donation_50_deductible;	
		
		calcs.deduction_80g = donation_100_deductible + donation_50_deductible;
		
	
		calcs.total_taxable_income = roundOffToTen(Math.floor(calcs.gross_total_income - calcs.total_deduction)); 
		
		var dob = $("[name='itr_pd_dob']").val().trim();
		var user_age = calculateAge(dob);
		
		var tax_rate = 0;
		var fixed_tax = 0;
		var variable_amount = 0;
		
		if(user_age < 60)
		{
			if(calcs.total_taxable_income > 250000 && calcs.total_taxable_income <= 500000)
			{
				tax_rate = 5;
				
				variable_amount = calcs.total_taxable_income - 250000;
			}
			else if(calcs.total_taxable_income > 500000 && calcs.total_taxable_income <= 1000000)
			{
				tax_rate = 20;
				
				fixed_tax = 12500;
				variable_amount = calcs.total_taxable_income - 500000;
			}
			else if(calcs.total_taxable_income > 1000000)	
			{
				tax_rate = 30;
				
				fixed_tax = 112500;
				variable_amount = calcs.total_taxable_income - 1000000;				
				
			}	
		}
		else if(user_age >= 60 && user_age < 80)
		{
			if(calcs.total_taxable_income > 300000 && calcs.total_taxable_income <= 500000)
			{
				tax_rate = 5;
				
				variable_amount = calcs.total_taxable_income - 300000;				
			}
			else if(calcs.total_taxable_income > 500000 && calcs.total_taxable_income <= 1000000)
			{
				tax_rate = 20;

				fixed_tax = 10000;
				variable_amount = calcs.total_taxable_income - 500000;				
			}
			else if(calcs.total_taxable_income > 1000000)	
			{
				tax_rate = 30;
				
				fixed_tax = 110000;
				variable_amount = calcs.total_taxable_income - 1000000;				
			}				
		}
		else if(user_age >= 80)
		{
			if(calcs.total_taxable_income > 500000 && calcs.total_taxable_income <= 1000000)
			{
				tax_rate = 20;
				
				variable_amount = calcs.total_taxable_income - 500000;				
			}
			else if(calcs.total_taxable_income > 1000000)	
			{
				tax_rate = 30;
				
				fixed_tax = 100000;
				variable_amount = calcs.total_taxable_income - 1000000;				
			}				
		}

		calcs.tax_on_total_income = fixed_tax + Math.ceil(variable_amount * (tax_rate/100));
		
		calcs.rebate = 0;
		
		var resident_status = $("[name='itr_pd_resi_sta']").val();
		
		if(resident_status == 'RES' && (calcs.total_taxable_income < 350000))
		{
			calcs.rebate = calcs.tax_on_total_income < 2500 ? calcs.tax_on_total_income : 2500;
		}	
		
		calcs.tax_after_rebate = calcs.tax_on_total_income - calcs.rebate;
		
		calcs.cess = Math.floor(calcs.tax_after_rebate * (4/100));
		
		calcs.total_tds_deducted = 0;
		calcs.total_tds_claimed = 0;
		calcs.total_tds_onrent_claimed = 0;			
		calcs.total_advance_taxes_paid = 0;
		calcs.total_self_assessment_taxes_paid = 0;
		
		var advance_tax_slabs = {1 : 0, 2 : 0, 3 : 0, 4 : 0}; 
		
		$("#tabFromSalary [name='sou_sa_tds_on_sal[]']").each(function(i,item){
			
			var tds_deducted = parseInt($(item).val().trim());
			
			tds_deducted = tds_deducted ? tds_deducted : 0;
			
			calcs.total_tds_deducted += tds_deducted;
		});
		
		$("#tabTDS [name='reco_tdsothsal_tdsclaim[]']").each(function(i,item){ 
			
			var tds_claimed = parseInt($(item).val().trim());
			
			tds_claimed = tds_claimed ? tds_claimed : 0;
			
			calcs.total_tds_claimed += tds_claimed;
		});	
		
		$("#tabTDS [name='reco_tdsonrent_claimed[]']").each(function(i,item){
			
			var tds_claimed = parseInt($(item).val().trim());
			
			tds_claimed = tds_claimed ? tds_claimed : 0;
			
			calcs.total_tds_onrent_claimed += tds_claimed;
		});		
        
        /*------------------------------------ Added for TDS(new Schema 2019)-BSEN-START -----------------------------------------------*/
        
      /*  $("#tdsonsal [name='reco_tdsothsal_tdsclaim[]']").each(function(i,item){ 
			
			var tds_claimed = parseInt($(item).val().trim());
			
			tds_claimed = tds_claimed ? tds_claimed : 0;
			
			calcs.total_tds_claimed += tds_claimed;
		});	*/
		
	/*	$("#tdsonsal [name='reco_tdsonrent_claimed[]']").each(function(i,item){
			
			var tds_claimed = parseInt($(item).val().trim());
			
			tds_claimed = tds_claimed ? tds_claimed : 0;
			
			calcs.total_tds_onrent_claimed += tds_claimed;
		});	*/
        
           $("#tdsothonsal [name='reco_tdsothsal_tdsclaim[]']").each(function(i,item){ 
			
			var tds_claimed = parseInt($(item).val().trim());
			
			tds_claimed = tds_claimed ? tds_claimed : 0;
			
			calcs.total_tds_claimed += tds_claimed;
		});	
		
		$("#tdsothonsal [name='reco_tdsonrent_claimed[]']").each(function(i,item){
			
			var tds_claimed = parseInt($(item).val().trim());
			
			tds_claimed = tds_claimed ? tds_claimed : 0;
			
			calcs.total_tds_onrent_claimed += tds_claimed;
		});	
        
        
        /*------------------------------------ Added for TDS(new Schema 2019)-BSEN-END -----------------------------------------------*/

		var self_tax_lookup = {};	

		$("#tabtaxPaid [name='reco_selfasstxpd_amount[]']").each(function(i,item){
			
			var self_tax_amount = parseInt($(item).val().trim());
			
			self_tax_amount = self_tax_amount ? self_tax_amount : 0;
			
			if(self_tax_amount)
			{
				var $date_ele = $(item).closest('.form_container').find("[name='reco_selfasstxpd_dateodepos[]']");
				var date_val = Date.parse(convertDateFormat($date_ele.val().trim()));
				
				if(date_val)
				{
					self_tax_lookup[new Date(date_val).getMonth()] = self_tax_amount;
				}	
			}	
			
			calcs.total_self_assessment_taxes_paid += self_tax_amount;
		});
		
		$(".add_taxrecotaxpaidadvan_div").each(function(i,item){
			
			var advance_tax_amount = parseInt($("[name='reco_txpaidadv_amount[]']",item).val().trim());
			
			var advance_tax_date = $("[name='reco_txpaidadv_dateodepos[]']",item).val().trim();
			
			var advance_tax_date = Date.parse(advance_tax_date);				
			
			advance_tax_amount = advance_tax_amount ? advance_tax_amount : 0;
			
			calcs.total_advance_taxes_paid += advance_tax_amount;
			
			if(advance_tax_date)
			{
				if((advance_tax_date > Date.parse('2018-04-01')) && (advance_tax_date < Date.parse('2018-06-16')))
				{
					advance_tax_slabs[1] += advance_tax_amount;
				}
				else if((advance_tax_date > Date.parse('2018-06-16')) && (advance_tax_date < Date.parse('2018-09-16')))
				{
					advance_tax_slabs[2] += advance_tax_amount + advance_tax_slabs[1];
				}
				else if((advance_tax_date > Date.parse('2018-09-16')) && (advance_tax_date < Date.parse('2018-12-16')))
				{
					advance_tax_slabs[3] += advance_tax_amount + advance_tax_slabs[2];
				}
				else if((advance_tax_date > Date.parse('2018-12-16')) && (advance_tax_date < Date.parse('2019-03-16')))
				{
					advance_tax_slabs[4] += advance_tax_amount + advance_tax_slabs[3];
				}		
			}				
		});
		
		//calcs.total_taxes_paid = calcs.total_tds_claimed + calcs.total_tds_onrent_claimed + calcs.total_advance_taxes_paid + calcs.total_self_assessment_taxes_paid+ calcs.total_tds_deducted;			
		calcs.total_taxes_paid = calcs.total_tds_claimed + calcs.total_tds_onrent_claimed + calcs.total_advance_taxes_paid + calcs.total_tds_deducted;

		calcs.total_tax_payable = calcs.tax_after_rebate + calcs.cess;


		/*------------ Net Tax Payable -----------------*/
		calcs.net_tax_payable = calcs.total_tax_payable - calcs.total_taxes_paid;
		if (calcs.net_tax_payable < 0) 
		{
			calcs.net_tax_payable = 0;
		}


		calcs.interest_234A = 0;
		
		//var months_late = (new Date()).getMonth() - 7; // Months start from 0

		var months_late = (new Date()).getMonth() - 8; // Months start from 0
		
		if(months_late > 0)
		{
			var round_tax_payable = Math.floor((calcs.net_tax_payable * 100) / 100); 
			calcs.interest_234A = Math.floor((calcs.net_tax_payable * 1) / 100);
		}

		calcs.interest_234B = 0;
		
		if(user_age < 60)
		{	//if((calcs.total_advance_taxes_paid + calcs.total_tds_deducted + calcs.total_tds_claimed + calcs.total_tds_onrent_claimed) < ((90/100) * calcs.total_tax_payable))
			if(calcs.net_tax_payable > 10000){
				if(calcs.total_taxes_paid < ((90/100) * calcs.total_tax_payable))
				//if((calcs.total_advance_taxes_paid + calcs.total_tds_claimed + calcs.total_tds_onrent_claimed) < ((90/100) * calcs.total_tax_payable))
				{	//var taxable_amnt_234b = Math.floor(calcs.total_tax_payable - (calcs.total_advance_taxes_paid + calcs.total_tds_deducted + calcs.total_tds_claimed + calcs.total_tds_onrent_claimed));
					var taxable_amnt_234b = Math.floor(calcs.net_tax_payable);
					
					if(calcs.total_self_assessment_taxes_paid)
					{
						var current_month = (new Date()).getMonth();
						var cumulative_self_tax = 0;
						var cumulative_234b = 0;
						var due_month = 2;
						
						for(i = 3; i <= current_month; i++)
						{
							cumulative_234b += Math.floor(((taxable_amnt_234b - cumulative_self_tax) / 100));
							
							if(self_tax_lookup[i])
							{
								cumulative_self_tax += self_tax_lookup[i];
							}	
						}

						calcs.interest_234B = cumulative_234b;
					}
					else
					{
						var months_234b = (new Date()).getMonth() - 2;
						
						calcs.interest_234B = Math.floor(taxable_amnt_234b * (months_234b / 100));
						/*------------------------- Round of -------------------------*/
						calcs.interest_234B = Math.round(calcs.interest_234B / 10) * 10; //Math.round(calcs.interest_234B);
					}		
				}	
			}		
		}		

		calcs.fee_234F = 0;

		var due_date = Date.parse('2019-09-01');

		if(Date.now() >= due_date)
		{
			if(calcs.total_taxable_income < 500000)
			{
				calcs.fee_234F = 0;
			}
			else
			{
				if(Date.now() > Date.parse('2019-01-01'))
				{
					calcs.fee_234F = 10000;
				}
				else
				{
					calcs.fee_234F = 5000;
				}		
			}		
		}

		calcs.interest_234C = 0;

		var i_234c_q2,i_234c_q3,i_234c_q4;

		if(user_age < 60)
		{
			if(calcs.net_tax_payable > 10000){

				if(advance_tax_slabs[1] < ((12/100) * calcs.total_tax_payable))
				{	var total_amount = Math.floor((15/100) * (calcs.total_tax_payable - (calcs.total_tds_onrent_claimed + calcs.total_tds_claimed + calcs.total_tds_deducted)));

					total_amount = total_amount - advance_tax_slabs[1];
					//var total_amount = Math.floor((15/100) * (calcs.total_tax_payable - calcs.total_taxes_paid - advance_tax_slabs[1]));
					total_amount = Math.floor(total_amount / 100) * 100;
					calcs.interest_234C = Math.floor((3 * total_amount ) / 100);			
					//calcs.interest_234C= Math.round(calcs.interest_234C / 10) * 10;		
				}	
				

				if(advance_tax_slabs[2] < ((36/100) * calcs.total_tax_payable))
				{
					var total_amount = Math.floor((45/100) * (calcs.total_tax_payable - (calcs.total_tds_onrent_claimed + calcs.total_tds_claimed + calcs.total_tds_deducted)));
					total_amount = total_amount - advance_tax_slabs[2];
					total_amount = Math.floor(total_amount / 100) * 100;
					calcs.interest_234C +=  Math.floor((3 * total_amount ) / 100);
					//i_234c_q2 = Math.floor((3 * total_amount ) / 100);
					//calcs.interest_234C = 	Math.round(i_234c_q2 / 10) * 10;//Math.round(calcs.interest_234C / 10) * 10;

				}		
				
				if(advance_tax_slabs[3] < ((75/100) * calcs.total_tax_payable))
				{
					var total_amount = Math.floor((75/100) * (calcs.total_tax_payable - (calcs.total_tds_onrent_claimed + calcs.total_tds_claimed + calcs.total_tds_deducted)));
					total_amount = total_amount  - advance_tax_slabs[3];
					total_amount = Math.floor(total_amount / 100) * 100;
					calcs.interest_234C += Math.floor((3 * total_amount ) / 100);					
					/*i_234c_q3 = Math.floor((3 * total_amount ) / 100);
					calcs.interest_234C += Math.round(i_234c_q3 / 10) * 10;*/
				}	
				
				if(advance_tax_slabs[4] < (calcs.total_tax_payable))
				{
					var total_amount = Math.floor((calcs.total_tax_payable) - (calcs.total_tds_onrent_claimed + calcs.total_tds_claimed + calcs.total_tds_deducted));
					total_amount = total_amount  - advance_tax_slabs[4];
					total_amount = Math.floor(total_amount / 100) * 100;
					calcs.interest_234C += Math.floor(total_amount / 100);					

					/*i_234c_q4 = Math.floor((3 * total_amount ) / 100);
					calcs.interest_234C += 	Math.round(i_234c_q4 / 10) * 10;*/
				}


				
			}			
		}

		if(calcs.interest_234C < 0)
		{
			calcs.interest_234C = 0;
		}		


		/*-------------------- Self Assesment Tax -----------------------------*/
		calcs.self_ass_paid = 0;
		/*-------------------- Net Payable Tax -----------------------------*/
		calcs.net_tax_to_be_paid = 0; 

		net_tax_to_be_paid = 0;

		calcs.refund_receivable = 0;
		calcs.balance_tax_to_be_paid = 0;
		
		var balance_tax = calcs.total_tax_payable + calcs.interest_234A + calcs.interest_234B + calcs.interest_234C + calcs.fee_234F - calcs.total_taxes_paid;
		
		if(balance_tax > 0)
		{
			calcs.balance_tax_to_be_paid = roundOffToTen(balance_tax);
		}	
		else
		{
			calcs.refund_receivable = roundOffToTen(-1 * balance_tax);
		}		

		if (calcs.total_self_assessment_taxes_paid > 0) 
		{
			calcs.self_ass_paid = calcs.total_self_assessment_taxes_paid;
		}
		net_tax_to_be_paid = roundOffToTen(calcs.balance_tax_to_be_paid - calcs.self_ass_paid);

		if (net_tax_to_be_paid > 0) 
		{
			calcs.net_tax_to_be_paid = net_tax_to_be_paid;
		}


		return calcs;	
		
	}
	
	window.taxCalculations = taxCalculations;
	
	$("a[href='#revTAXfile'],a[href='#tabTAXFilling']").on("show.bs.tab",function(){
			
			var calcs = taxCalculations();
			
			var review_fields = Object.keys(calcs);
			
			$(review_fields).each(function(i,item){
				$("span."+item).text(calcs[item].toLocaleString());
			});
	
	});
	
	$("a[href='#tabTaxRecon']").on("show.bs.tab",function(){
		
		var $original_form = $(".add_taxrectds_div.hide");
		
		$(".add_taxrectds_div:not('.hide')").remove();
		
		$(".add_sou_salaryy_div:not('.hide')").each(function(i,item){
			
			var $salary_income_form = $(item);
			var $clone_form = $original_form.clone().removeClass('hide');
			
			$("[name='sou_sa_tan_no']",$clone_form).val($("[name='sou_sa_tan_no[]']",$salary_income_form).val().toUpperCase());
			
			$("[name='sou_sa_employer_name']",$clone_form).val($("[name='sou_sa_employer_name[]']",$salary_income_form).val().toUpperCase());

			$("[name='sou_sa_tds_on_sal']",$clone_form).val($("[name='sou_sa_tds_on_sal[]']",$salary_income_form).val().toUpperCase());

			$("[name='sou_sa_ntslary']",$clone_form).val($("[name='sou_sa_ntslary[]']",$salary_income_form).val().toUpperCase());	

			$("#form-reconcile-tds").prepend($clone_form);	
			
		});			
	
	});	
	/*----------------------------------- 20190226-BSEN -------------------------------------*/
	function calculateAge(dob) {
	   
	   var dob_arr = dob.split("/");
	   dob = dob_arr[2]+"-"+dob_arr[1]+"-"+dob_arr[0];
		/*------------------------ for Testing  ---------------------------------------------*/
	   //console.log(dob);
		
	   var ageDifMs = Date.now() - Date.parse(dob);
		/*------------------------ for Testing  ---------------------------------------------*/
	   //console.log(ageDifMs);
	   var ageDate = new Date(ageDifMs);
	   return Math.abs(ageDate.getUTCFullYear() - 1970);
	   
	}
	
	function roundOffToTen(num)
	{
		var parsed_num =  parseInt(num);
		
		var remainder = parsed_num % 10;
		
		var rounded_number = 0;
		
		if(remainder < 5)
		{
			rounded_number = parsed_num - remainder;
		}
		else
		{
			rounded_number = parsed_num + (10 - remainder);
		}		
		
		return rounded_number;
	}
	
function generateXml()
{
	var xml_string = '';
	
	var calcs = taxCalculations();
	
	
    xml_string = generatePersonalInfo(xml_string);
	
	xml_string = generateFilingStatus(xml_string);

	xml_string = generateIncomeDeductions(xml_string,calcs);
	
	xml_string = generateTaxComputation(xml_string,calcs);
	
	xml_string = generateTaxPaid(xml_string,calcs);
	
	xml_string = generateRefund(xml_string,calcs);
	
	xml_string = generate80GDeductions(xml_string);   
    
	//xml_string = generateschedule80GGA(xml_string);
	
	xml_string = generateTDSOnSalaries(xml_string);
    
    //xml_string = generateScheduleTDS3Dtls(xml_string);
	
    /*---------------------------------- Remove from 2019 new Schema -------------------------------------------*/
	//xml_string = generateTDSRent(xml_string);
	
	xml_string = generateTaxPayments(xml_string);
	
	xml_string = generateVerification(xml_string);
	
	return xml_string;
}

$("#save-xml").on('click',function(){
	/*----------------------------------- 20190220-BSEN -------------------------------------*/
	var $form =  $('<form action="https://test.optymoney.in/tempXML.php" method="POST" style="display:none;"><input type="hidden" name="xml-data" /></form>');
	$form.children('input').val(generateXml());
	$form.appendTo('body').submit();
	$form.remove();
});	

$("#submit-itr").on('click',function(e){
	
	e.preventDefault();
	
	var $popup = $("#general-popup");
	
	$(".submit-final",$popup).show();
	
	$(".content",$popup).text("Please make sure the data is correct before submitting. Continue submission ?");
	
	$popup.modal('show');
});	

$("#general-popup .submit-final").on('click',function(e){
	
	e.preventDefault();
	
	var $btn = $(this);
	var $popup = $("#general-popup");
	
	$btn.attr('disabled',true).text("Submitting...");
	$btn.prev('button').attr('disabled',true);
	
	$.ajax({
		
		/*----------------------------------- 20190226-BSEN -------------------------------------*/
		/*--------------- Old ------------------------*/
		
		//url : "/tempXML.php",
		
		/*---------------- New  ---------------------*/
		url : "https://test.optymoney.in/tempXML.php",
		method : "POST",
		data : {
			"xml-data" : generateXml(),
			"pan" : $("[data-xml='PAN']").val().trim().toUpperCase()
		}
		//alert(data);
		
		
	})
	.done(function(resp){

		/*----------------------------------- 20190226-BSEN -------------------------------------*/

		console.log("resp|"+resp);

		//alert("resp"+resp);

        

        /*--------------------- Remove for save xml into database-BSEN-START ---------------------------------*/

      

		/*if(parseInt(resp))

		{

			$(".content",$popup).text("Acknowledgement number is :"+resp);

			$("#itr-ack-no").val(resp);	

			

			$btn.prev('button').attr('disabled',false).text("Close");

		}

		else

		{

			$(".content",$popup).text("Could not retrieve acknowledgement number");

		}*/		



		/*--------------------- Remove for save xml into database-BSEN-END ---------------------------------*/

        if(resp){
        	var date = new Date();

        	var today = date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear();

        	var result = "ITR Filed on \nDate:"+today+" and \nPAN:"+resp+" of AY "+date.getFullYear();

          $(".content",$popup).text(result);

          $("#itr-ack-no").val(resp);	

          $btn.prev('button').attr('disabled',false).text("Close");

        }

		$btn.attr('disabled',false).text("Submit");

		$btn.hide();

		

		$btn.prev('button').attr('disabled',false);		

	})

	.fail(function(e){

		/*----------------------------------- 20190309-BSEN -------------------------------------*/
/*
		var a = e;

		a.toString(); 



		alert("Error|"+a);

		//console.log("e|"+e);

		$(".content",$popup).text("Submission failed");	



		$btn.attr('disabled',false).text("Submit");

		$btn.prev('button').attr('disabled',false);*/


		 $(".content",$popup).text(result);

          //$("#itr-ack-no").val(resp);		

          $btn.prev('button').attr('disabled',false).text("Close");

          $btn.attr('disabled',false).text("Submit");

			$btn.hide();

		

		$btn.prev('button').attr('disabled',false);	

	

	});

});	

function convertDateFormat(in_date)
{
	 var date_arr = in_date.split('/');
	 var new_date = date_arr[2]+"-"+date_arr[1]+"-"+date_arr[0];
	 
	 return new_date;
}

function generatePersonalInfo(xml_string)
{

	xml_string += "<PersonalInfo><AssesseeName><FirstName>"+$("[data-xml='FirstName']").val().trim().toUpperCase()+"</FirstName>";	
		
	if($("[data-xml='MiddleName']").val().trim())
	{
		xml_string += "<MiddleName>"+$("[data-xml='MiddleName']").val().trim().toUpperCase()+"</MiddleName>";
	}
	
	xml_string += "<SurNameOrOrgName>"+$("[data-xml='SurNameOrOrgName']").val().trim().toUpperCase()+"</SurNameOrOrgName></AssesseeName>";
	
	xml_string += "<PAN>"+$("[data-xml='PAN']").val().trim().toUpperCase()+"</PAN>";
	
	xml_string += "<Address><ResidenceNo>"+$("[data-xml='ResidenceNo']").val().trim().toUpperCase()+"</ResidenceNo>";
	
    
    /*------------------------------------------- 20190418-BSEN ---------------------------------------------------------*/

    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
    
	/*if($("[data-xml='ResidenceName']").val().trim())
	{
		xml_string += "<ResidenceName>"+$("[data-xml='ResidenceName']").val().trim().toUpperCase()+"</ResidenceName>";
	}*/

	if($("[data-xml='RoadOrStreet']").val().trim())
	{
		xml_string += "<RoadOrStreet>"+$("[data-xml='RoadOrStreet']").val().trim().toUpperCase()+"</RoadOrStreet>";
	}

	xml_string += "<LocalityOrArea>"+$("[data-xml='LocalityOrArea']").val().trim().toUpperCase()+"</LocalityOrArea>";

	xml_string += "<CityOrTownOrDistrict>"+$("[data-xml='CityOrTownOrDistrict']").val().trim().toUpperCase()+"</CityOrTownOrDistrict>";	

	xml_string += "<StateCode>15</StateCode>";	
    
    /*------------------------------------------------------- AY-2019-schema-change-CountryCode -------------------------*/
    xml_string += "<CountryCode>91</CountryCode>";	
	
	xml_string += "<PinCode>"+$("[data-xml='PinCode']").val().trim().toUpperCase()+"</PinCode>";		

	xml_string += "<CountryCodeMobile>"+$("[data-xml='CountryCode']").val().trim().toUpperCase()+"</CountryCodeMobile>";	

	xml_string += "<MobileNo>"+$("[data-xml='MobileNo']").val().trim().toUpperCase()+"</MobileNo>";	

	xml_string += "<EmailAddress>"+$("[data-xml='EmailAddress']").val().trim()+"</EmailAddress></Address>";

	xml_string += "<DOB>"+convertDateFormat($("[data-xml='DOB']").val().trim())+"</DOB>";	

	xml_string += "<EmployerCategory>"+$("[data-xml='EmployerCategory']").val().trim().toUpperCase()+"</EmployerCategory>";

	if($("[data-xml='AadhaarCardNo']").val().trim())	
	{
		xml_string += "<AadhaarCardNo>"+$("[data-xml='AadhaarCardNo']").val().trim().toUpperCase()+"</AadhaarCardNo>";
	}
	else
	{
		xml_string += "<AadhaarEnrolmentId>"+$("[data-xml='AadhaarEnrolmentId']").val().trim().toUpperCase()+"</AadhaarEnrolmentId>";
	}
	
	xml_string += "</PersonalInfo>";

	return xml_string;	
	
}

function generateFilingStatus(xml_string)
{		
	xml_string += "<FilingStatus>";	
	
	var return_status = 11;
	var return_type = $("[data-xml='ReturnType']").val().trim();
	
	if(return_type == "R")
	{
		return_status = 17;
	}	
	if(Date.now() > Date.parse("2019-09-01"))
	{
		return_status = 12;
	}

	xml_string += "<ReturnFileSec>"+return_status+"</ReturnFileSec>";	

    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
	//xml_string += "<ReturnType>"+return_type+"</ReturnType>";
		
	if(return_type == "R")
	{
		xml_string += "<ReceiptNo>"+$("[data-xml='ReceiptNo']").val().trim().toUpperCase()+"</ReceiptNo>";
		
		xml_string += "<OrigRetFiledDate>"+convertDateFormat($("[data-xml='OrigRetFiledDate']").val().trim())+"</OrigRetFiledDate>";				
	}	
	
    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
	//xml_string += "<PortugeseCC5A>N</PortugeseCC5A></FilingStatus>";		
    xml_string += "</FilingStatus>";	

	return xml_string;	
	
}	

function generateIncomeDeductions(xml_string,calcs)
{		
	xml_string += "<ITR1_IncomeDeductions>";	

	var salary = 0;
	var hra_10 = 0;
	var other_10 = 0;
	var allowances = 0;
	var perquisites = 0;
	var profits = 0;
	var deduction = 0;
	var deduction16ii = 0;
	var deduction16iii = 0;
	var total_income = 0;
	
	calcs = Object.keys(calcs).length ? calcs : {};
	
	var salary_containers = [];
	
	$("[data-xml='IncomeFromSal']").each(function(i,item){
		if($(item).val())
		{
			salary_containers.push($(item).closest(".add_sou_salaryy_div"));
		}	
	});

	/*----------------------Adding HRA and other things-----------------------*/
	/*$("[name='sou_sa_hra10[]']").each(function(i,item){
		if(parseInt($(item).val().trim()))
		{
			hra_10 += parseInt($(item).val().trim());					
		}
	});*/


	/*---------------------------------------------------------------------*/
	
	if(salary_containers.length)
	{
		$(salary_containers).each(function(i,$item){
			
			salary += $("[data-xml='Salary']",$item).val().trim() ? parseInt($("[data-xml='Salary']",$item).val().trim()) : 0;
			hra_10 += $("[name='sou_sa_hra10[]']",$item).val().trim() ? parseInt($("[name='sou_sa_hra10[]']",$item).val().trim()) : 0;
			other_10 += $("[name='sou_sa_oth10[]']",$item).val().trim() ? parseInt($("[name='sou_sa_oth10[]']",$item).val().trim()) : 0;			
			perquisites += $("[data-xml='PerquisitesValue']",$item).val().trim() ? parseInt($("[data-xml='PerquisitesValue']",$item).val().trim()) : 0;
			profits += $("[data-xml='ProfitsInSalary']",$item).val().trim() ? parseInt($("[data-xml='ProfitsInSalary']",$item).val().trim()) : 0;
			deduction += $("[data-xml='DeductionUs16']",$item).val().trim() ? parseInt($("[data-xml='DeductionUs16']",$item).val().trim()) : 0;
			deduction16ii += $("[data-xml='DeductionUs16ii']",$item).val() ? parseInt($("[data-xml='DeductionUs16ii']",$item).val()) : 0;
			deduction16iii += $("[data-xml='DeductionUs16iii']",$item).val().trim() ? parseInt($("[data-xml='DeductionUs16iii']",$item).val().trim()) : 0;
			total_income += $("[data-xml='IncomeFromSal']",$item).val().trim() ? parseInt($("[data-xml='IncomeFromSal']",$item).val().trim()) : 0;


			/*--------------------------------------------------------*/
			if(deduction16ii){
				if (deduction16ii >5000) 
				{
					deduction16ii = 5000;
				}
			}
			/*--------------------------------------------------------*/
			if(deduction16iii){
				if (deduction16iii >5000) 
				{
					deduction16iii = 5000;
				}
			}
			/*--------------------------------------------------------*/
		});
		/*------------------------------------------------------- AY-2019-schema-change-GrossSalary ----------------------------------*/
        xml_string += "<GrossSalary>"+(salary + perquisites + profits)+"</GrossSalary>";
		
		xml_string += "<Salary>"+(salary)+"</Salary>";

        //xml_string += "<Salary>"+(salary - hra_10 - other_10)+"</Salary>";

		//xml_string += "<AlwnsNotExempt>0</AlwnsNotExempt>";

		xml_string += "<PerquisitesValue>"+perquisites+"</PerquisitesValue>";

		xml_string += "<ProfitsInSalary>"+profits+"</ProfitsInSalary>";
        
        /*------------------------------------------------------- AY-2019-schema-change-AllwncExemptUs10 -----------------------------------*/

        if(hra_10 || other_10) {

        	xml_string += "<AllwncExemptUs10>";	

	       	if(hra_10)
	       	{
				xml_string += "<AllwncExemptUs10Dtls>";	       		

				xml_string += "<SalNatureDesc>10(13A)</SalNatureDesc>";

				xml_string += "<SalOthAmount>"+ hra_10 +"</SalOthAmount>";	

				xml_string += "</AllwncExemptUs10Dtls>";	

	       		xml_string += "<TotalAllwncExemptUs10>"+hra_10+"</TotalAllwncExemptUs10>";

	       		//xml_string += "</AllwncExemptUs10>";
	       	}

	       	if(other_10)
	       	{
	       		//xml_string += "<AllwncExemptUs10>";	


				xml_string += "<AllwncExemptUs10Dtls>";	       		

				xml_string += "<SalNatureDesc>OTH</SalNatureDesc>";

				xml_string += "<SalOthAmount>"+other_10+"</SalOthAmount>";	

				xml_string += "</AllwncExemptUs10Dtls>";	

	       		xml_string += "<TotalAllwncExemptUs10>"+other_10+"</TotalAllwncExemptUs10>";
	       		
	       	}
	       	xml_string += "</AllwncExemptUs10>";
       	}
       /*	else
       	{
       		xml_string += "<AllwncExemptUs10><TotalAllwncExemptUs10>0</TotalAllwncExemptUs10></AllwncExemptUs10>";
       	}
		*/        
        
        
        /*------------------------------------------------------- AY-2019-schema-change-NetSalary ------------------------------------------*/
        
        xml_string += "<NetSalary>"+((salary+ perquisites + profits) - hra_10 - other_10)+"</NetSalary>";
		
		xml_string += "<DeductionUs16>"+(deduction + deduction16ii + deduction16iii)+"</DeductionUs16>";
        
        /*------------------------------------------------------- AY-2019-schema-change-DeductionUs16ia ------------------------------------------*/
        xml_string += "<DeductionUs16ia>"+deduction+"</DeductionUs16ia>";
        /*------------------------------------------------------- AY-2019-schema-change-EntertainmentAlw16ii ------------------------------------------*/
        xml_string += "<EntertainmentAlw16ii>"+deduction16ii+"</EntertainmentAlw16ii>";
        /*------------------------------------------------------- AY-2019-schema-change-ProfessionalTaxUs16iii ------------------------------------------*/
        xml_string += "<ProfessionalTaxUs16iii>"+deduction16iii+"</ProfessionalTaxUs16iii>";
		
		xml_string += "<IncomeFromSal>"+total_income+"</IncomeFromSal>";
					
	}
	else
	{
		xml_string += "<Salary>0</Salary>";
	}	
	
	var selected_house_property = $("[name='housePropertyRadio']:checked").val();
	
	var total_income_hp = 0;
	

	if($("[name='self_con_income[]']").val().trim())
	{
		var total_interest = 0;
		
		xml_string += "<TypeOfHP>S</TypeOfHP><TaxPaidlocalAuth>0</TaxPaidlocalAuth><AnnualValue>0</AnnualValue><StandardDeduction>0</StandardDeduction>";
		
		xml_string += "<InterestPayable>"+Math.abs($("[name='self_con_income[]']").val().trim())+"</InterestPayable>";
		
		total_income_hp = $("[name='self_con_income[]']").val().trim() ? parseInt($("[name='self_con_income[]']").val().trim()) : 0;
		
		if($("[name='self_hloan_int[]']").val().trim())
		{
			total_interest += parseInt($("[name='self_hloan_int[]']").val().trim());
		}

		if($("[name='self_con_per_int[]']").val().trim())
		{
			total_interest += parseInt($("[name='self_con_per_int[]']").val().trim());
		}	
	}
	else if($("[name='let_con_income[]']").val().trim())
	{
		xml_string += "<TypeOfHP>L</TypeOfHP>";
		
		var gross_rent = $("[name='let_ren_inc[]']").val().trim() ? parseInt($("[name='let_ren_inc[]']").val().trim()) : 0;
		
		var property_tax = $("[name='let_proptex_pad[]']").val().trim() ? parseInt($("[name='let_proptex_pad[]']").val().trim()) : 0;		
		
		xml_string += "<GrossRentReceived>"+$("[name='let_ren_inc[]']").val().trim()+"</GrossRentReceived>";
		
		xml_string += "<TaxPaidlocalAuth>"+$("[name='let_proptex_pad[]']").val().trim()+"</TaxPaidlocalAuth>";
		
		xml_string += "<AnnualValue>"+(gross_rent - property_tax)+"</AnnualValue>";		
		
		xml_string += "<StandardDeduction>"+$("[name='let_st_dedu[]']").val().trim()+"</StandardDeduction>";		

		var total_interest = 0;

		if($("[name='let_hloan_int[]']").val().trim())
		{
			total_interest += parseInt($("[name='let_hloan_int[]']").val().trim());
		}

		if($("[name='let_pre_cons_per_int[]']").val().trim())
		{
			total_interest += parseInt($("[name='let_pre_cons_per_int[]']").val().trim());
		}			

		if(total_interest)
		{
			//total_interest = "1075";
			xml_string += "<InterestPayable>"+total_interest+"</InterestPayable>";
		}


		total_income_hp = $("[name='let_con_income[]']").val().trim() ? parseInt($("[name='let_con_income[]']").val().trim()) : 0;		
	}
	else
	{
		xml_string += "<AnnualValue>0</AnnualValue><StandardDeduction>0</StandardDeduction><InterestPayable>0</InterestPayable>";
	}	

	xml_string += "<TotalIncomeOfHP>"+total_income_hp+"</TotalIncomeOfHP>"		

	xml_string += "<IncomeOthSrc>"+($("[name='sou_oth_oi_totothinc']").val().trim() ? parseInt($("[name='sou_oth_oi_totothinc']").val().trim()) : 0)+"</IncomeOthSrc>";


	/*----------------------------------*/
	
	var bank_saving_int = 0;

	var bank_saving_fd = 0;

	var other_interest = 0;

	var family_pension = 0;

	var other_income = 0;

	/*----------------------------------*/

	/*------------------ Creating New TAG-START  ----------------------*/

	bank_saving_int = $("[name='sou_oth_oi_bnkint']").val().trim() ? parseInt($("[name='sou_oth_oi_bnkint']").val().trim()) : 0;

	bank_saving_fd = $("[name='sou_oth_oi_bnkint_fd']").val().trim() ? parseInt($("[name='sou_oth_oi_bnkint_fd']").val().trim()) : 0;

	other_interest = $("[name='sou_oth_oi_othint']").val().trim() ? parseInt($("[name='sou_oth_oi_othint']").val().trim()) : 0;

	family_pension = $("[name='family_pension']").val().trim() ? parseInt($("[name='family_pension']").val().trim()) : 0;

	other_income = $("[name='sou_oth_oi_othinc']").val().trim() ? parseInt($("[name='sou_oth_oi_othinc']").val().trim()) : 0;


	if (bank_saving_int || bank_saving_fd || other_interest || family_pension || other_income) 
	{
		xml_string += "<OthersInc>";
		if(bank_saving_int) 
		{

			var dob = $("[name='itr_pd_dob']").val().trim();
			var user_age = calculateAge(dob);

			if (user_age > 60) 
			{	
				var highest_amt = 50000;
				if (bank_saving_int > highest_amt) 
				{
					bank_saving_int = highest_amt;
				}
				
				//$("#ded_gd__80tta").val(bank_saving_int);
			}
			else
			{
				var highest_amt = 10000;
				if (bank_saving_int > highest_amt) 
				{
					bank_saving_int = highest_amt;
				}
				
				//$("[name='ded_gd__80tta']").val(bank_saving_int);
			}
			xml_string += "<OthersIncDtlsOthSrc>";
			xml_string += "<OthSrcNatureDesc>SAV</OthSrcNatureDesc>";
			xml_string += "<OthSrcOthAmount>"+bank_saving_int+"</OthSrcOthAmount>";	
			xml_string += "</OthersIncDtlsOthSrc>";
		}

		if(bank_saving_fd) 
		{
			xml_string += "<OthersIncDtlsOthSrc>";
			xml_string += "<OthSrcNatureDesc>IFD</OthSrcNatureDesc>";
			xml_string += "<OthSrcOthAmount>"+bank_saving_fd+"</OthSrcOthAmount>";	
			xml_string += "</OthersIncDtlsOthSrc>";
		}

		if(other_interest) 
		{
			xml_string += "<OthersIncDtlsOthSrc>";
			xml_string += "<OthSrcNatureDesc>TAX</OthSrcNatureDesc>";
			xml_string += "<OthSrcOthAmount>"+other_interest+"</OthSrcOthAmount>";	
			xml_string += "</OthersIncDtlsOthSrc>";
		}

		if(family_pension) 
		{
			xml_string += "<OthersIncDtlsOthSrc>";
			xml_string += "<OthSrcNatureDesc>FAP</OthSrcNatureDesc>";
			xml_string += "<OthSrcOthAmount>"+family_pension+"</OthSrcOthAmount>";	
			xml_string += "</OthersIncDtlsOthSrc>";
		}

		if(other_income) 
		{
			xml_string += "<OthersIncDtlsOthSrc>";
			xml_string += "<OthSrcNatureDesc>OTH</OthSrcNatureDesc>";
			xml_string += "<OthSrcOthAmount>"+other_income+"</OthSrcOthAmount>";	
			xml_string += "</OthersIncDtlsOthSrc>";
		}
		
		xml_string += "</OthersInc>";
	}

	/*------------------ Creating New TAG OthersIncDtlsOthSrc-END ----------------------*/


    
    /*------------------------------------------------------- AY-2019-schema-change-DeductionUs57iia ------------------------------------------*/



    xml_string += "<DeductionUs57iia>0</DeductionUs57iia>";				
    
    xml_string += "<GrossTotIncome>"+calcs.gross_total_income+"</GrossTotIncome>";				
		

	//Chapter 6A Deductions

	xml_string += "<UsrDeductUndChapVIA>";		

	var total_user_deduction_6a = 0;	

	if(parseInt($("[data-xml='Section80C']").val().trim()))
	{
		xml_string += "<Section80C>"+$("[data-xml='Section80C']").val().trim()+"</Section80C>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80C']").val().trim());
	}
	else
	{
		xml_string += "<Section80C>0</Section80C>";	
	}		

	if(parseInt($("[data-xml='Section80CCC']").val().trim()))
	{
		xml_string += "<Section80CCC>"+$("[data-xml='Section80CCC']").val().trim()+"</Section80CCC>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80CCC']").val().trim());				
	}
	else
	{
		xml_string += "<Section80CCC>0</Section80CCC>";	
	}			

	if(parseInt($("[data-xml='Section80CCDEmployeeOrSE']").val().trim()))
	{
		xml_string += "<Section80CCDEmployeeOrSE>"+$("[data-xml='Section80CCDEmployeeOrSE']").val().trim()+"</Section80CCDEmployeeOrSE>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80CCDEmployeeOrSE']").val().trim());				
	}
	else
	{
		xml_string += "<Section80CCDEmployeeOrSE>0</Section80CCDEmployeeOrSE>";	
	}			
	
	if(parseInt($("[data-xml='Section80CCD1B']").val().trim()))
	{
		xml_string += "<Section80CCD1B>"+$("[data-xml='Section80CCD1B']").val().trim()+"</Section80CCD1B>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80CCD1B']").val().trim());				
	}
	else
	{
		xml_string += "<Section80CCD1B>0</Section80CCD1B>";	
	}			

	if(parseInt($("[data-xml='Section80CCDEmployer']").val().trim()))
	{
		xml_string += "<Section80CCDEmployer>"+$("[data-xml='Section80CCDEmployer']").val().trim()+"</Section80CCDEmployer>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80CCDEmployer']").val().trim());				
	}
	else
	{
		xml_string += "<Section80CCDEmployer>0</Section80CCDEmployer>";	
	}			
	
	var section_80d = $("[data-xml='Section80D']").val().trim() ? parseInt($("[data-xml='Section80D']").val().trim()) : 0;

	xml_string += "<Section80DHealthInsPremium>";	

	if(section_80d)
	{
		xml_string += "<HealthInsurancePremium>"+$("[data-xml='Section80DUsrType']").val()+"</HealthInsurancePremium>";					
		xml_string += "<Sec80DHealthInsurancePremiumUsr>"+$("[data-xml='Section80D']").val().trim()+"</Sec80DHealthInsurancePremiumUsr>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80D']").val().trim());		
	}
	else
	{
		xml_string += "<Sec80DHealthInsurancePremiumUsr>0</Sec80DHealthInsurancePremiumUsr>";			
	}		
	
	xml_string += "<Sec80DMedicalExpenditureUsr>0</Sec80DMedicalExpenditureUsr>";	

	xml_string += "<Sec80DPreventiveHealthCheckUpUsr>0</Sec80DPreventiveHealthCheckUpUsr>";		

	xml_string += "</Section80DHealthInsPremium>";			

	if(parseInt($("[data-xml='Section80DD']").val().trim()))
	{
		xml_string += "<Section80DDUsrType>"+$("[data-xml='Section80DDUsrType']").val()+"</Section80DDUsrType>";				
		xml_string += "<Section80DD>"+$("[data-xml='Section80DD']").val().trim()+"</Section80DD>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80DD']").val().trim());								
	}
	else
	{
		xml_string += "<Section80DD>0</Section80DD>";	
	}			

	if(parseInt($("[data-xml='Section80DDB']").val().trim()))
	{
		xml_string += "<Section80DDBUsrType>"+$("[data-xml='Section80DDBUsrType']").val()+"</Section80DDBUsrType>";					
		xml_string += "<Section80DDB>"+$("[data-xml='Section80DDB']").val().trim()+"</Section80DDB>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80DDB']").val().trim());				
	}
	else
	{
		xml_string += "<Section80DDB>0</Section80DDB>";	
	}			
	
	if(parseInt($("[data-xml='Section80E']").val().trim()))
	{
		xml_string += "<Section80E>"+$("[data-xml='Section80E']").val().trim()+"</Section80E>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80E']").val().trim());				
	}
	else
	{
		xml_string += "<Section80E>0</Section80E>";	
	}			
	
	if(parseInt($("[data-xml='Section80EE']").val().trim()))
	{
		xml_string += "<Section80EE>"+$("[data-xml='Section80EE']").val().trim()+"</Section80EE>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80EE']").val().trim());				
	}
	else
	{
		xml_string += "<Section80EE>0</Section80EE>";	
	}		
    
    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
	
	if(calcs.deduction_80g)
	{
		xml_string += "<Section80G>"+calcs.deduction_80g+"</Section80G>";
		total_user_deduction_6a +=	calcs.deduction_80g;				
	}
	else
	{
		xml_string += "<Section80G>0</Section80G>";	
	}			
	
    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
    
	if(parseInt($("[data-xml='Section80GG']").val().trim()))
	{
		xml_string += "<Section80GG>"+$("[data-xml='Section80GG']").val().trim()+"</Section80GG>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80GG']").val().trim());				
	}
	else
	{
		xml_string += "<Section80GG>0</Section80GG>";	
	}			
	
	if(parseInt($("[data-xml='Section80GGA']").val().trim()))
	{
		xml_string += "<Section80GGA>"+$("[data-xml='Section80GGA']").val().trim()+"</Section80GGA>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80GGA']").val().trim());				
	}
	else
	{
		xml_string += "<Section80GGA>0</Section80GGA>";	
	}			

	if(parseInt($("[data-xml='Section80GGC']").val().trim()))
	{
		xml_string += "<Section80GGC>"+$("[data-xml='Section80GGC']").val().trim()+"</Section80GGC>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80GGC']").val().trim());				
	}
	else
	{
		xml_string += "<Section80GGC>0</Section80GGC>";	
	}			

	if(parseInt($("[data-xml='Section80U']").val().trim()))
	{
		xml_string += "<Section80UUsrType>"+$("[data-xml='Section80UUsrType']").val()+"</Section80UUsrType>";					
		xml_string += "<Section80U>"+$("[data-xml='Section80U']").val().trim()+"</Section80U>";	
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80U']").val().trim());				
	}
	else
	{
		xml_string += "<Section80U>0</Section80U>";	
	}

    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
    
	/*if(parseInt($("[data-xml='Section80RRB']").val().trim()))
	{
		xml_string += "<Section80RRB>"+$("[data-xml='Section80RRB']").val().trim()+"</Section80RRB>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80RRB']").val().trim());				
	}
	else
	{
		xml_string += "<Section80RRB>0</Section80RRB>";	
	}*/

    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
    
    /*	if(parseInt($("[data-xml='Section80QQB']").val().trim()))
	{
		xml_string += "<Section80QQB>"+$("[data-xml='Section80QQB']").val().trim()+"</Section80QQB>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80QQB']").val().trim());				
	}
	else
	{
		xml_string += "<Section80QQB>0</Section80QQB>";	
	}*/

	if(parseInt($("[data-xml='Section80CCG']").val().trim()))
	{
		xml_string += "<Section80CCG>"+$("[data-xml='Section80CCG']").val().trim()+"</Section80CCG>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80CCG']").val().trim());				
	}
	else
	{
		xml_string += "<Section80CCG>0</Section80CCG>";	
	}

	if(parseInt($("[data-xml='Section80TTA']").val().trim()))
	{
		xml_string += "<Section80TTA>"+$("[data-xml='Section80TTA']").val().trim()+"</Section80TTA>";
		total_user_deduction_6a +=	parseInt($("[data-xml='Section80TTA']").val().trim());				
	}
	else
	{
		xml_string += "<Section80TTA>0</Section80TTA>";	
	}			
    
    /*------------------------------------------------------- AY-2019-schema-change-Section80TTB ------------------------------------------*/
    if(parseInt($("[data-xml='Section80TTB']").val().trim()))
	{
		//section 80TTB
		var section80TTB = parseInt($("[data-xml='Section80TTB']").val().trim());
		if (section80TTB < 50000) 
		{
			xml_string += "<Section80TTB>"+$("[data-xml='Section80TTB']").val().trim()+"</Section80TTB>";
		}
		else
		{
			xml_string += "<Section80TTB>50000</Section80TTB>";
		}
		
		//total_user_deduction_6a +=	parseInt($("[data-xml='Section80TTA']").val().trim());				
	}
	else
	{
		xml_string += "<Section80TTB>0</Section80TTB>";	
	}	
    
   // xml_string += "<Section80TTB>0</Section80TTB>";	
	
	xml_string += "<TotalChapVIADeductions>"+total_user_deduction_6a+"</TotalChapVIADeductions></UsrDeductUndChapVIA>";	

	xml_string += "<DeductUndChapVIA>";		

	xml_string += "<Section80C>"+calcs.deduction_80c+"</Section80C>";		
	xml_string += "<Section80CCC>"+calcs.deduction_80ccc+"</Section80CCC>";
	xml_string += "<Section80CCDEmployeeOrSE>"+calcs.deduction_80ccd1+"</Section80CCDEmployeeOrSE>";		
	xml_string += "<Section80CCD1B>"+calcs.deduction_80ccd1b+"</Section80CCD1B>";	
	xml_string += "<Section80CCDEmployer>"+calcs.deduction_80ccd2+"</Section80CCDEmployer>";			
	xml_string += "<Section80D>"+calcs.deduction_80d+"</Section80D>";		
	xml_string += "<Section80DD>"+calcs.deduction_80dd+"</Section80DD>";	
	xml_string += "<Section80DDB>"+calcs.deduction_80ddb+"</Section80DDB>";		
	xml_string += "<Section80E>"+calcs.deduction_80e+"</Section80E>";	
	xml_string += "<Section80EE>"+calcs.deduction_80ee+"</Section80EE>";		
	xml_string += "<Section80G>"+calcs.deduction_80g+"</Section80G>";	
	xml_string += "<Section80GG>"+calcs.deduction_80gg+"</Section80GG>";		
	xml_string += "<Section80GGA>"+calcs.deduction_80gga+"</Section80GGA>";	
	xml_string += "<Section80GGC>"+calcs.deduction_80ggc+"</Section80GGC>";		
	xml_string += "<Section80U>"+calcs.deduction_80u+"</Section80U>";			
    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
    //xml_string += "<Section80RRB>"+calcs.deduction_80rrb+"</Section80RRB>";	
	//xml_string += "<Section80QQB>"+calcs.deduction_80qqb+"</Section80QQB>";		
	xml_string += "<Section80CCG>"+calcs.deduction_80ccg+"</Section80CCG>";	
	xml_string += "<Section80TTA>"+calcs.deduction_80tta+"</Section80TTA>";	
    
    /*------------------------------------------------------- AY-2019-schema-change-Section80TTB ------------------------------------------*/
    
    xml_string += "<Section80TTB>0</Section80TTB>";		

	xml_string += "<TotalChapVIADeductions>"+calcs.total_deduction+"</TotalChapVIADeductions></DeductUndChapVIA>";

	xml_string += "<TotalIncome>"+calcs.total_taxable_income+"</TotalIncome>";	
    
    /*------------------------------------------------------- AY-2019-schema-change-Section80TTB ------------------------------------------*/
    
    //xml_string += "<ExemptIncAgriOthUs10><ExemptIncAgriOthUs10Dtls></ExemptIncAgriOthUs10Dtls><ExemptIncAgriOthUs10Total></ExemptIncAgriOthUs10Total>"+calcs.total_taxable_income+"</ExemptIncAgriOthUs10>";	
    xml_string += "</ITR1_IncomeDeductions>";
	
	return xml_string;	
}		

function generateTaxComputation(xml_string,calcs)
{		

	xml_string += "<ITR1_TaxComputation>";	
	
	xml_string += "<TotalTaxPayable>"+calcs.tax_on_total_income+"</TotalTaxPayable>";	
	xml_string += "<Rebate87A>"+calcs.rebate+"</Rebate87A>";	
	xml_string += "<TaxPayableOnRebate>"+calcs.tax_after_rebate+"</TaxPayableOnRebate>";	
	xml_string += "<EducationCess>"+calcs.cess+"</EducationCess>";	
	xml_string += "<GrossTaxLiability>"+calcs.total_tax_payable+"</GrossTaxLiability>";	
	xml_string += "<Section89>0</Section89>";	
	xml_string += "<NetTaxLiability>"+calcs.total_tax_payable+"</NetTaxLiability>";	
	xml_string += "<TotalIntrstPay>"+(calcs.interest_234A + calcs.interest_234B + calcs.interest_234C + calcs.fee_234F)+"</TotalIntrstPay>";	
	xml_string += "<IntrstPay>";
	xml_string += "<IntrstPayUs234A>"+calcs.interest_234A+"</IntrstPayUs234A>";	
	xml_string += "<IntrstPayUs234B>"+calcs.interest_234B+"</IntrstPayUs234B>";	
	xml_string += "<IntrstPayUs234C>"+calcs.interest_234C+"</IntrstPayUs234C>";	
	xml_string += "<LateFilingFee234F>"+calcs.fee_234F+"</LateFilingFee234F>";	
	xml_string += "</IntrstPay>";			
	xml_string += "<TotTaxPlusIntrstPay>"+(calcs.total_tax_payable + calcs.interest_234A + calcs.interest_234B + calcs.interest_234C + calcs.fee_234F)+"</TotTaxPlusIntrstPay>";
	xml_string += "</ITR1_TaxComputation>";			
				
	return xml_string;	
	
}

function generateTaxPaid(xml_string,calcs)
{		

	xml_string += "<TaxPaid><TaxesPaid>";	
	
	xml_string += "<AdvanceTax>"+calcs.total_advance_taxes_paid+"</AdvanceTax>";		

	xml_string += "<TDS>"+(calcs.total_tds_deducted + calcs.total_tds_claimed + calcs.total_tds_onrent_claimed)+"</TDS>";					
	xml_string += "<TCS>0</TCS>";	

	xml_string += "<SelfAssessmentTax>"+calcs.total_self_assessment_taxes_paid+"</SelfAssessmentTax>";
	xml_string += "<TotalTaxesPaid>"+calcs.total_taxes_paid+"</TotalTaxesPaid>";	
	
	var hra_10 = 0;
	var other_10 = 0;
	



	/*$("[name='sou_sa_hra10[]']").each(function(i,item){
		if(parseInt($(item).val().trim()))
		{
			hra_10 += parseInt($(item).val().trim());					
		}
	});*/

	/*$("[name='sou_sa_oth10[]']").each(function(i,item){
		if(parseInt($(item).val().trim()))
		{
			other_10 += parseInt($(item).val().trim());					
		}
	});	
	*/

	/*----------------------------- Remove from 2019-AY ---------------------------------*/

	/*if(hra_10 || other_10)
	{
		xml_string += "<OthersInc>";
		
		if(hra_10)
		{
			xml_string += "<OthersIncDtls>";

			xml_string += "<NatureDesc>10(13A)</NatureDesc>";	

			xml_string += "<OthAmount>"+hra_10+"</OthAmount>";

			xml_string += "</OthersIncDtls>";			
		}

		if(other_10)
		{
			xml_string += "<OthersIncDtls>";

			xml_string += "<NatureDesc>OTH</NatureDesc>";	
			
			xml_string += "<OthNatOfInc>Other Allowances</OthNatOfInc>";				

			xml_string += "<OthAmount>"+other_10+"</OthAmount>";

			xml_string += "</OthersIncDtls>";			
		}		

		xml_string += "<OthersIncTotal>"+(hra_10 + other_10)+"</OthersIncTotal>";	

		xml_string += "</OthersInc>";		
	
	}*/	
	
	/*var lctg_income = $("[name='sou_oth_exi_ltcg']").val().trim() ? parseInt($("[name='sou_oth_exi_ltcg']").val().trim()) : 0;
	
	if(lctg_income)
	{
		xml_string += "<ExcIncSec1038>"+lctg_income+"</ExcIncSec1038>";	
	}*/
	
	var dividend_income = $("[name='sou_oth_exi_diviinc']").val().trim() ? parseInt($("[name='sou_oth_exi_diviinc']").val().trim()) : 0;
	
	if(dividend_income)
	{
		xml_string += "<ExcIncSec1034>"+dividend_income+"</ExcIncSec1034>";	
	}	
	
	xml_string += "</TaxesPaid>";	

	xml_string += "<BalTaxPayable>"+calcs.balance_tax_to_be_paid+"</BalTaxPayable>";

	xml_string += "</TaxPaid>";				
	
	return xml_string;	
	
}

function generateRefund(xml_string,calcs)
{		

	xml_string += "<Refund>";	
	
	xml_string += "<RefundDue>"+calcs.refund_receivable+"</RefundDue>";

	xml_string += "<BankAccountDtls>";		
	
	$(".add_taxbankdetails_div:not('.hide')").each(function(i,item){	

		/*if(i == 0)
		{
			xml_string += "<PriBankDetails>";
		}
		else
		{*/
			xml_string += "<AddtnlBankDetails>";
		/*}*/	

		xml_string += "<IFSCCode>"+$("[data-xml='IFSCCode']",item).val().trim().toUpperCase()+"</IFSCCode>";

		xml_string += "<BankName>"+$("[data-xml='BankName']",item).val().trim().toUpperCase()+"</BankName>";

		xml_string += "<BankAccountNo>"+$("[data-xml='BankAccountNo']",item).val().trim().toUpperCase()+"</BankAccountNo>";

		

		if (i === 0) 
		{
			xml_string += "<UseForRefund>true</UseForRefund>";
		}
		else
		{
			xml_string += "<UseForRefund>false</UseForRefund>";
		}
		/*if(i == 0)
		{
			xml_string += "</PriBankDetails>";
		}
		else
		{*/
			xml_string += "</AddtnlBankDetails>";
		/*}*/	
	});	

	xml_string += "</BankAccountDtls>";	
	
	xml_string += "</Refund>";	

	var agricultural_income = $("[name='sou_oth_exi_agriinc']").val().trim() ? parseInt($("[name='sou_oth_exi_agriinc']").val().trim()) : 0;
	
    
    /*--------------------------------------------------- Remove from new Schema 2019 ---------------------------------------------------------------------------*/
	//Add agricultural income after refund
	if(agricultural_income)
	{
		xml_string += "<TaxExmpIntInc>"+agricultural_income+"</TaxExmpIntInc>";
	}	
	
	return xml_string;	
	
}

function generate80GDeductions(xml_string)
{		
	
	var don_100 = [];
	var don_100_appr_req = [];
	var don_50 = [];
	var don_50_appr_req = [];

	$(".add_don100_div").each(function(i,item){
		var $container = $(item);
		
		if($("[name='dona_80g_damount[]']",$container).val().trim())
		{
			if($("[name='dona_80g_deligilibity[]']",$container).val() == "without qualifing limit")
			{
				don_100.push($container);
			}
			else
			{
				don_100_appr_req.push($container);
			}		

		}	
	});
	
	$(".add_don50_div").each(function(i,item){
		var $container = $(item);
		
		if($("[name='dona_80g_damount[]']",$container).val().trim())
		{
			if($("[name='dona_80g_deligilibity[]']",$container).val() == "without qualifing limit")
			{
				don_50.push($container);
			}
			else
			{
				don_50_appr_req.push($container);
			}		

		}	
	});	
	
	if(don_100.length || don_100_appr_req.length || don_50.length || don_50_appr_req.length)
	{
		xml_string += "<Schedule80G>";	
		
		if(don_100.length)
		{
			var total_100d = 0;
			var total_100_eligible_d = 0;
			
			xml_string += "<Don100Percent>";
			
			$(don_100).each(function(i,item){
				
				xml_string += "<DoneeWithPan>";							
				
				xml_string += "<DoneeWithPanName>"+$("[data-xml='DoneeWithPanName']",item).val().trim().toUpperCase()+"</DoneeWithPanName>";

				xml_string += "<DoneePAN>"+$("[data-xml='DoneePAN']",item).val().trim().toUpperCase()+"</DoneePAN>";
				
				xml_string += "<AddressDetail>";						

				xml_string += "<AddrDetail>"+$("[data-xml='AddrDetail']",item).val().trim().toUpperCase()+"</AddrDetail>";	

				xml_string += "<CityOrTownOrDistrict>"+$("[data-xml='CityOrTownOrDistrict']",item).val().trim().toUpperCase()+"</CityOrTownOrDistrict>";	


				/*---------------------------------------- Issue of  -----------------------------------------------*/
				xml_string += "<StateCode>"+$("[data-xml='StateCode']",item).val().trim().toUpperCase()+"</StateCode>";	

				xml_string += "<PinCode>"+$("[data-xml='PinCode']",item).val().trim().toUpperCase()+"</PinCode>";	

				xml_string += "</AddressDetail>";	
				
				total_100d += parseInt($("[data-xml='DonationAmt']",item).val().trim());

				xml_string += "<DonationAmt>"+$("[data-xml='DonationAmt']",item).val().trim()+"</DonationAmt>";
				
				total_100_eligible_d += parseInt($("[data-xml='EligibleDonationAmt']",item).val());

				xml_string += "<EligibleDonationAmt>"+$("[data-xml='EligibleDonationAmt']",item).val().trim()+"</EligibleDonationAmt>";						
				
				xml_string += "</DoneeWithPan>";
                /*-------------------------- Add new tags for Schema 2019-START ------------------------------------*/
                
                xml_string += "<TotDon100PercentCash>"+$("[data-xml='dona80gpercentcash']",item).val().trim()+"</TotDon100PercentCash>";	
                xml_string += "<TotDon100PercentOtherMode>"+$("[data-xml='dona80gpercentothermode']",item).val().trim()+"</TotDon100PercentOtherMode>";	
                
                /*-------------------------- Add new tags for Schema 2019-END ------------------------------------*/
                
			});
			
			xml_string += "<TotDon100Percent>"+total_100d+"</TotDon100Percent>";	

			xml_string += "<TotEligibleDon100Percent>"+total_100_eligible_d+"</TotEligibleDon100Percent>";

			xml_string += "</Don100Percent>";					
		}

		if(don_100_appr_req.length)
		{
			var total_100d = 0;
			var total_100_eligible_d = 0;
			
			xml_string += "<Don100PercentApprReqd>";
			
			$(don_100_appr_req).each(function(i,item){
				
				xml_string += "<DoneeWithPan>";							
				
				xml_string += "<DoneeWithPanName>"+$("[data-xml='DoneeWithPanName']",item).val().trim().toUpperCase()+"</DoneeWithPanName>";

				xml_string += "<DoneePAN>"+$("[data-xml='DoneePAN']",item).val().trim().toUpperCase()+"</DoneePAN>";
				
				xml_string += "<AddressDetail>";						

				xml_string += "<AddrDetail>"+$("[data-xml='AddrDetail']",item).val().trim().toUpperCase()+"</AddrDetail>";	

				xml_string += "<CityOrTownOrDistrict>"+$("[data-xml='CityOrTownOrDistrict']",item).val().trim().toUpperCase()+"</CityOrTownOrDistrict>";	

				xml_string += "<StateCode>"+$("[data-xml='StateCode']",item).val().trim().toUpperCase()+"</StateCode>";	

				xml_string += "<PinCode>"+$("[data-xml='PinCode']",item).val().trim().toUpperCase()+"</PinCode>";	

				xml_string += "</AddressDetail>";	
				
				total_100d += parseInt($("[data-xml='DonationAmt']",item).val().trim());

				xml_string += "<DonationAmt>"+$("[data-xml='DonationAmt']",item).val().trim()+"</DonationAmt>";
				
				total_100_eligible_d += parseInt($("[data-xml='EligibleDonationAmt']",item).val());

				xml_string += "<EligibleDonationAmt>"+$("[data-xml='EligibleDonationAmt']",item).val().trim()+"</EligibleDonationAmt>";						
				
				xml_string += "</DoneeWithPan>";							
                /*-------------------------- Add new tags for Schema 2019-START ------------------------------------*/
                
                xml_string += "<TotDon100PercentApprReqdCash>"+$("[data-xml='dona80gpercentapprreqdcash']",item).val().trim()+"</TotDon100PercentApprReqdCash>";	
                xml_string += "<TotDon100PercentApprReqdOtherMode>"+$("[data-xml='dona80gpercentapprreqdothermode']",item).val().trim()+"</TotDon100PercentApprReqdOtherMode>";	
                
                /*-------------------------- Add new tags for Schema 2019-END ------------------------------------*/
                
			});
			
			xml_string += "<TotDon100PercentApprReqd>"+total_100d+"</TotDon100PercentApprReqd>";	

			xml_string += "<TotEligibleDon100PercentApprReqd>"+total_100_eligible_d+"</TotEligibleDon100PercentApprReqd>";

			xml_string += "</Don100PercentApprReqd>";						
		}

		if(don_50.length)
		{
			var total_100d = 0;
			var total_100_eligible_d = 0;
			
			xml_string += "<Don50PercentNoApprReqd>";
			
			$(don_50).each(function(i,item){
				
				xml_string += "<DoneeWithPan>";							
				
				xml_string += "<DoneeWithPanName>"+$("[data-xml='DoneeWithPanName']",item).val().trim().toUpperCase()+"</DoneeWithPanName>";

				xml_string += "<DoneePAN>"+$("[data-xml='DoneePAN']",item).val().trim().toUpperCase()+"</DoneePAN>";
				
				xml_string += "<AddressDetail>";						

				xml_string += "<AddrDetail>"+$("[data-xml='AddrDetail']",item).val().trim().toUpperCase()+"</AddrDetail>";	

				xml_string += "<CityOrTownOrDistrict>"+$("[data-xml='CityOrTownOrDistrict']",item).val().trim().toUpperCase()+"</CityOrTownOrDistrict>";	

				xml_string += "<StateCode>"+$("[data-xml='StateCode']",item).val().trim().toUpperCase()+"</StateCode>";	

				xml_string += "<PinCode>"+$("[data-xml='PinCode']",item).val().trim().toUpperCase()+"</PinCode>";	

				xml_string += "</AddressDetail>";	
				
				total_100d += parseInt($("[data-xml='DonationAmt']",item).val().trim());

				xml_string += "<DonationAmt>"+$("[data-xml='DonationAmt']",item).val().trim()+"</DonationAmt>";
				
				total_100_eligible_d += parseInt($("[data-xml='EligibleDonationAmt']",item).val());

				xml_string += "<EligibleDonationAmt>"+$("[data-xml='EligibleDonationAmt']",item).val().trim()+"</EligibleDonationAmt>";						
				
				xml_string += "</DoneeWithPan>";	
                /*-------------------------- Add new tags for Schema 2019-START ------------------------------------*/
                xml_string += "<TotDon100PercentApprReqdCash>"+$("[data-xml='dona80gpercentapprreqdcash']",item).val().trim()+"</TotDon100PercentApprReqdCash>";	
                xml_string += "<TotDon100PercentApprReqdOtherMode>"+$("[data-xml='dona80gpercentapprreqdothermode']",item).val().trim()+"</TotDon100PercentApprReqdOtherMode>";	
                /*-------------------------- Add new tags for Schema 2019-END ------------------------------------*/
			});
			
			xml_string += "<TotDon50PercentNoApprReqd>"+total_100d+"</TotDon50PercentNoApprReqd>";	

			xml_string += "<TotEligibleDon50Percent>"+total_100_eligible_d+"</TotEligibleDon50Percent>";

			xml_string += "</Don50PercentNoApprReqd>";					
		}


		if(don_50_appr_req.length)
		{
			var total_100d = 0;
			var total_100_eligible_d = 0;
			
			xml_string += "<Don50PercentApprReqd>";
			
			$(don_50_appr_req).each(function(i,item){
				
				xml_string += "<DoneeWithPan>";							
				
				xml_string += "<DoneeWithPanName>"+$("[data-xml='DoneeWithPanName']",item).val().trim().toUpperCase()+"</DoneeWithPanName>";

				xml_string += "<DoneePAN>"+$("[data-xml='DoneePAN']",item).val().trim().toUpperCase()+"</DoneePAN>";
				
				xml_string += "<AddressDetail>";						

				xml_string += "<AddrDetail>"+$("[data-xml='AddrDetail']",item).val().trim().toUpperCase()+"</AddrDetail>";	

				xml_string += "<CityOrTownOrDistrict>"+$("[data-xml='CityOrTownOrDistrict']",item).val().trim().toUpperCase()+"</CityOrTownOrDistrict>";	

				xml_string += "<StateCode>"+$("[data-xml='StateCode']",item).val().trim().toUpperCase()+"</StateCode>";	

				xml_string += "<PinCode>"+$("[data-xml='PinCode']",item).val().trim().toUpperCase()+"</PinCode>";	

				xml_string += "</AddressDetail>";	
				
				total_100d += parseInt($("[data-xml='DonationAmt']",item).val().trim());

				xml_string += "<DonationAmt>"+$("[data-xml='DonationAmt']",item).val().trim()+"</DonationAmt>";
				
				total_100_eligible_d += parseInt($("[data-xml='EligibleDonationAmt']",item).val());

				xml_string += "<EligibleDonationAmt>"+$("[data-xml='EligibleDonationAmt']",item).val().trim()+"</EligibleDonationAmt>";						
				
				xml_string += "</DoneeWithPan>";							
			});
			
			xml_string += "<TotDon50PercentApprReqd>"+total_100d+"</TotDon50PercentApprReqd>";	

			xml_string += "<TotEligibleDon50PercentApprReqd>"+total_100_eligible_d+"</TotEligibleDon50PercentApprReqd>";

			xml_string += "</Don50PercentApprReqd>";					
		}

		xml_string += "</Schedule80G>";		
	}

	return xml_string;	

}

/*-------------------------------- New Function Created for New Schema 2019 ----------------------------------*/
    
function generateschedule80GGA(xml_string)
{
    
  

    var add_don80gga_div = [];

	$(".add_don80gga_div").each(function(i,item){
		var $container = $(item);
		
		if($("[name='dona_80gga_addrdetail[]']",$container).val().trim())
		{		
			add_don80gga_div.push($container);
		}	
	});
    
    /*-----------------------------------------------------------------------------------------------------------------------*/
    
   
          xml_string += "<Schedule80GGA>";	
    
          $(add_don80gga_div).each(function(i,item){

          xml_string += "<DonationDtlsSciRsrchRuralDev>";	
    
          

          xml_string += "<RelevantClauseUndrDedClaimed>"+$("[data-xml='dona80goption']",item).val().trim().toUpperCase()+"</RelevantClauseUndrDedClaimed>";
                          
          xml_string += "<NameOfDonee>"+$("[data-xml='DoneeWithPanName80gga']",item).val().trim().toUpperCase()+"</NameOfDonee>";	

          xml_string += "<AddressDetail>";		

          xml_string += "<AddrDetail>"+$("[data-xml='dona80ggaaddrdetail']",item).val().trim().toUpperCase()+"</AddrDetail>";	

          //xml_string += "<AddrDetail>0</AddrDetail>";		

          xml_string += "<CityOrTownOrDistrict>"+$("[data-xml='CityOrTownOrDistrict80gga']",item).val().trim().toUpperCase()+"</CityOrTownOrDistrict>";

          xml_string += "<StateCode>"+$("[data-xml='StateCode80gga']",item).val().trim().toUpperCase()+"</StateCode>";

          xml_string += "<PinCode>"+$("[data-xml='PinCode80gga']",item).val().trim().toUpperCase()+"</PinCode>";

          xml_string += "</AddressDetail>";		

          xml_string += "<DoneePAN>"+$("[data-xml='DoneePAN80gga']",item).val().trim().toUpperCase()+"</DoneePAN>";        

          xml_string += "<DonationAmtCash>"+$("[data-xml='dona80ggadamountcash']",item).val().trim().toUpperCase()+"</DonationAmtCash>";	
              
          

          xml_string += "<DonationAmtOtherMode>"+$("[data-xml='dona80ggadonationamtothermode']",item).val().trim().toUpperCase()+"</DonationAmtOtherMode>";	
    
          xml_string += "<DonationAmt>"+$("[data-xml='dona80ggadonationamt']",item).val().trim().toUpperCase()+"</DonationAmt>";	

          xml_string += "<EligibleDonationAmt>"+$("[data-xml='dona80ggaeligibledonationamt']",item).val().trim().toUpperCase()+"</EligibleDonationAmt>";	

          xml_string += "</DonationDtlsSciRsrchRuralDev>";	

          xml_string += "<TotalDonationAmtCash80GGA>"+$("[data-xml='dona80ggatotaldonationamtcash']",item).val().trim().toUpperCase()+"</TotalDonationAmtCash80GGA>";	

          xml_string += "<TotalDonationAmtOtherMode80GGA>"+$("[data-xml='dona80ggatotaldonationamtotherMode80GGA']",item).val().trim().toUpperCase()+"</TotalDonationAmtOtherMode80GGA>";	

          xml_string += "<TotalDonationsUs80GGA>"+$("[data-xml='dona80ggatotaldonationsus']",item).val().trim().toUpperCase()+"</TotalDonationsUs80GGA>";	

          xml_string += "<TotalEligibleDonationAmt80GGA>"+$("[data-xml='dona80ggatotaleligibledonationamt80GGA']",item).val().trim().toUpperCase()+"</TotalEligibleDonationAmt80GGA>";	
              
           });

          xml_string += "</Schedule80GGA>";		
   
    return xml_string;
}


function generateTDSOnSalaries(xml_string)
{		
	
	var tds_active = [];

	$(".add_sou_salaryy_div").each(function(i,item){
		var $container = $(item);
		
		if($("[name='sou_sa_ntslary[]']",$container).val().trim())
		{		
			tds_active.push($container);
		}	
	});
	
	if(tds_active.length)
	{
		var total_tds = 0;
		
		xml_string += "<TDSonSalaries>";
		
		$(tds_active).each(function(i,item){
			
			xml_string += "<TDSonSalary>";	

			xml_string += "<EmployerOrDeductorOrCollectDetl>";						
			
			xml_string += "<TAN>"+$("[data-xml='TAN']",item).val().trim().toUpperCase()+"</TAN>";

			xml_string += "<EmployerOrDeductorOrCollecterName>"+$("[data-xml='EmployerOrDeductorOrCollecterName']",item).val().trim().toUpperCase()+"</EmployerOrDeductorOrCollecterName>";
			
			xml_string += "</EmployerOrDeductorOrCollectDetl>";						

			//xml_string += "<IncChrgSal>"+$("[name='sou_sa_ntslary[]']",item).val().trim().toUpperCase()+"</IncChrgSal>";		

			xml_string += "<IncChrgSal>"+$("[name='sou_sa_ntslary[]']",item).val().trim()+"</IncChrgSal>";	
			
			var tds = $("[name='sou_sa_tds_on_sal[]']",item).val().trim() ? parseInt($("[name='sou_sa_tds_on_sal[]']",item).val().trim()) : 0;
			
			total_tds += tds;

			xml_string += "<TotalTDSSal>"+tds+"</TotalTDSSal>";					
			
			xml_string += "</TDSonSalary>";							
		});

		xml_string += "<TotalTDSonSalaries>"+total_tds+"</TotalTDSonSalaries>";

		xml_string += "</TDSonSalaries>";					
	}

	return xml_string;	
}

function generateTDSOther(xml_string)
{		
	
	var tds_active = [];

	$(".add_taxrecotds").each(function(i,item){
		var $container = $(item);
		
		if($("[name='reco_tdsothsal_tanoded[]']",$container).val().trim() && $("[name='reco_tdsothsal_tdsdeduc[]']",$container).val().trim())
		{		
			tds_active.push($container);
		}	
	});
	
	if(tds_active.length)
	{
		var total_tds = 0;
		
		xml_string += "<TDSonOthThanSals>";
		
		$(tds_active).each(function(i,item){
			
			xml_string += "<TDSonOthThanSal>";	

			xml_string += "<EmployerOrDeductorOrCollectDetl>";						
			
			xml_string += "<TAN>"+$("[data-xml='TAN']",item).val().trim().toUpperCase()+"</TAN>";

			xml_string += "<EmployerOrDeductorOrCollecterName>"+$("[data-xml='EmployerOrDeductorOrCollecterName']",item).val().trim().toUpperCase()+"</EmployerOrDeductorOrCollecterName>";
			
			xml_string += "</EmployerOrDeductorOrCollectDetl>";						

			xml_string += "<AmtForTaxDeduct>"+$("[data-xml='AmtForTaxDeduct']",item).val().trim()+"</AmtForTaxDeduct>";	

			xml_string += "<DeductedYr>"+$("[data-xml='DeductedYr']",item).val().trim()+"</DeductedYr>";						
			
			total_tds += parseInt($("[data-xml='TotTDSOnAmtPaid']",item).val().trim());

			xml_string += "<TotTDSOnAmtPaid>"+$("[data-xml='TotTDSOnAmtPaid'']",item).val().trim()+"</TotTDSOnAmtPaid>";

			xml_string += "<ClaimOutOfTotTDSOnAmtPaid>"+$("[data-xml='ClaimOutOfTotTDSOnAmtPaid'']",item).val().trim()+"</ClaimOutOfTotTDSOnAmtPaid>";					
			
			xml_string += "</TDSonOthThanSal>";							
		});

		xml_string += "<TotalTDSonOthThanSals>"+total_tds+"</TotalTDSonSalaries>";

		xml_string += "</TDSonOthThanSals>";					
	}

	return xml_string;	
}
    
    
function generateScheduleTDS3Dtls(xml_string)
{
    xml_string += "<ScheduleTDS3Dtls>";
    
    xml_string += "<TDS3Details>";
    
    xml_string += "<PANofTenant>0</PANofTenant>";
    
    xml_string += "<NameOfTenant>0</NameOfTenant>";
    
    xml_string += "<GrsRcptToTaxDeduct>0</GrsRcptToTaxDeduct>";
    
    xml_string += "<DeductedYr>0</DeductedYr>";
    
    xml_string += "<TDSDeducted>0</TDSDeducted>";
    
    xml_string += "<TDSClaimed>0</TDSClaimed>";
    
    xml_string += "</TDS3Details>";
    
    xml_string += "<TotalTDS3Details>0</TotalTDS3Details>";
    
    xml_string += "</ScheduleTDS3Dtls>";
    
    return xml_string;
}

function generateTDSRent(xml_string)
{		
	
	var tds_active = [];

	$(".add_renttds_div").each(function(i,item){
		var $container = $(item);
		
		if($("[name='reco_tdsonrent_amnt[]']",$container).val().trim() && $("[name='reco_tdsonrent_deduc[]']",$container).val().trim())
		{		
			tds_active.push($container);
		}	
	});
	
	if(tds_active.length)
	{
		var total_tds = 0;
		
		xml_string += "<TDSDtls26QC>";
		
		$(tds_active).each(function(i,item){
			
			xml_string += "<TDSDetails26QC>";						
			
			xml_string += "<PANofTenant>"+$("[data-xml='PANofTenant']",item).val().trim().toUpperCase()+"</PANofTenant>";

			xml_string += "<NameOfTenant>"+$("[data-xml='NameOfTenant']",item).val().trim().toUpperCase()+"</NameOfTenant>";
			
			

			xml_string += "<AmtForTaxDeduct>"+$("[data-xml='AmtForTaxDeduct']",item).val().trim()+"</AmtForTaxDeduct>";	

			xml_string += "<DeductedYr>"+$("[data-xml='DeductedYr']",item).val().trim()+"</DeductedYr>";						
			
			total_tds += parseInt($("[name='reco_tdsonrent_deduc[]']",item).val().trim());

			xml_string += "<TaxDeducted>"+$("[name='reco_tdsonrent_deduc[]']",item).val().trim()+"</TaxDeducted>";

			xml_string += "<ClaimOutOfTotTDSOnAmtPaid>"+$("[data-xml='ClaimOutOfTotTDSOnAmtPaid']",item).val().trim()+"</ClaimOutOfTotTDSOnAmtPaid>";					
			
			xml_string += "</TDSDetails26QC>";							
		});

		xml_string += "<TotalTDSDetails26QC>"+total_tds+"</TotalTDSDetails26QC>";

		xml_string += "</TDSDtls26QC>";					
	}

	return xml_string;	
}	

function generateTaxPayments(xml_string)
{		
	
	var tax_active = [];

	$(".add_taxrecotaxpaidadvan_div,.add_taxrecoselftxpid_div").each(function(i,item){
		var $container = $(item);
		
		if($("[data-xml='SrlNoOfChaln']",$container).val().trim() && $("[data-xml='Amt']",$container).val().trim())
		{		
			tax_active.push($container);
		}	
	});
	
	if(tax_active.length)
	{
		var total_tax = 0;
		
		xml_string += "<TaxPayments>";
		
		$(tax_active).each(function(i,item){
			
			xml_string += "<TaxPayment>";						
			
			xml_string += "<BSRCode>"+$("[data-xml='BSRCode']",item).val().trim().toUpperCase()+"</BSRCode>";

			xml_string += "<DateDep>"+$("[data-xml='DateDep']",item).val().trim().toUpperCase()+"</DateDep>";
			
			xml_string += "<SrlNoOfChaln>"+$("[data-xml='SrlNoOfChaln']",item).val().trim()+"</SrlNoOfChaln>";	

			xml_string += "<Amt>"+$("[data-xml='Amt']",item).val().trim()+"</Amt>";						
			
			total_tax += parseInt($("[data-xml='Amt']",item).val().trim());					
			
			xml_string += "</TaxPayment>";							
		});

		xml_string += "<TotalTaxPayments>"+total_tax+"</TotalTaxPayments>";

		xml_string += "</TaxPayments>";					
	}

	return xml_string;	
}

function generateVerification(xml_string)
{		
		  
	xml_string += "<Verification>";	
	
	xml_string += "<Declaration>";		
	
	var first_name  = $("[data-xml='FirstName']").val().trim().toUpperCase()+" ";

	var middle_name  = $("[data-xml='MiddleName']").val().trim();

	middle_name = middle_name ? middle_name.toUpperCase()+" " : "";	
		
	var sur_name  = $("[data-xml='SurNameOrOrgName']").val().trim().toUpperCase();	
	
	xml_string += "<AssesseeVerName>"+first_name + middle_name + sur_name+"</AssesseeVerName>";	

	xml_string += "<FatherName>"+$("[data-xml='FatherName']").val().trim().toUpperCase()+"</FatherName>";	

	xml_string += "<AssesseeVerPAN>"+$("[data-xml='PAN']").val().trim().toUpperCase()+"</AssesseeVerPAN>";	

	xml_string += "</Declaration>";		
	
	xml_string += "<Capacity>S</Capacity>";

	xml_string += "<Place>"+$("[name='tax_re_place']").val().trim().toUpperCase()+"</Place>";

    /*--------------------------------------- Remove from 2019 Schema --------------------------------------------------*/
    
	//xml_string += "<Date>"+$("[name='tax_re_date']").val().trim().toUpperCase()+"</Date>";	

	xml_string += "</Verification>";							
	
	return xml_string;	
	
}	

});	
		