"use strict";

// Class definition
var KTSigninGeneral = function() {
    // Elements
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleValidation = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
			form,
			{
				fields: {					
					'email': {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'The value is not a valid email address',
                            },
							notEmpty: {
								message: 'Email address is required'
							}
						}
					},
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    } 
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
				}
			}
		);	
    }
    var handleSubmitAjax = function(e) {
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Hide loading indication
                    submitButton.removeAttribute('data-kt-indicator');
                    // Enable button
                    submitButton.disabled = false;
                  
                    
                    axios.post('Controller.php', {
                        Login:'Login',
                        usr: form.querySelector('[name="email"]').value, 
                        pwd: form.querySelector('[name="password"]').value 
                    }).then(function (response) {
                      
                        if (response) {
                            form.querySelector('[name="email"]').value= "";
                            form.querySelector('[name="password"]').value= "";  
                            if(response.data.trim()=="Success"){
                                window.location.href = '../Dashboard/';
                            }else{
                                Swal.fire({
                                    text: "ขออภัย เกิดข้อผิดพลาดบางอย่าง กรุณาลองใหม่อีกครั้ง",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "รับทราบ",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        } else {
                            Swal.fire({
                                text: "Email หรือ รหัสผ่านไม่ถูกต้อง",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "รับทราบ",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    }).catch(function (error) {
                        Swal.fire({
                            text: "ขออภัย เกิดข้อผิดพลาดบางอย่าง กรุณาลองใหม่อีกครั้ง",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "รับทราบ",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    });
                    
                    
                } else {
                    Swal.fire({
                        text: "ขออภัย เกิดข้อผิดพลาดบางอย่าง กรุณาลองใหม่อีกครั้ง",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "รับทราบ",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
                
            });
		});
    }
    return {
        init: function() {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');
            handleValidation();
            handleSubmitAjax(); 
        }
    };
}();
KTUtil.onDOMContentLoaded(function() {
    KTSigninGeneral.init();
});
