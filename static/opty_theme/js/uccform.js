// Wait for the DOM to be ready
$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='uccform']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        first_name: "required",
        gender: "required",
        pan: {
            required: true,
            maxlength: 10
        },
        birthday: "required",
        tel: {
            required: true,
            maxlength: 11
        },
        line1: {
            required: true,
            maxlength: 40
        },
        line2: {
            required: true,
            maxlength: 40
        },
        line3: {
            maxlength: 40
        },
        city: {
            required: true,
            maxlength: 30
        },
        state: "required",
        pincode: {
            required: true,
            maxlength: 6,
            minlength: 6
        },
        country: {
            required: true,
            maxlength: 35
        },
        bank_name: "required",
        bank_account: "required",
        IFSC: "required",
        nominee: "required",
        g_n_r: "required",
        email: {
          required: true,
          // Specify that email should be validated
          // by the built-in "email" rule
          email: true
        }
      },
      // Specify validation error messages
      messages: {
        first_name: "Please enter your name",
        gender: "Please select your gender",
        pan: {
            required: "Please enter your PAN",
            maxlength: "Please enter valid PAN"
        },
        birthday: "Please select your Date of Birth",
        tel: {
            required: "Please enter your phone number",
            maxlength: "Please enter a valid phone number"
        },
        line1: {
            required: "Address line 1 required",
            maxlength: "must be less than 40 charecters"
        },
        line2: {
            required: "Address line 2 required",
            maxlength: "must be less than 40 charecters"
        },
        line3: {
            maxlength: "must be less than 40 charecters"
        },
        city: {
            required: "Please enter city",
            maxlength: "must be less than 30 charecters"
        },
        state: "Please select state",
        pincode: {
            required: "Please enter pincode number",
            maxlength: "must be 6 digits",
            minlength: "must be 6 digits"
        },
        country: {
            required: "Please enter the country",
            maxlength: "must be less than 35 charecters"
        },
        bank_name: "Please enter Bank Name",
        bank_account: "Please enter Account Number",
        IFSC: "Please enter IFSC code",
        nominee: "Please enter nominee  name",
        g_n_r: "Please select the nominee relation",
        email: "Please enter a valid email address"
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });