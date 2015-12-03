$(document).ready(function(){

$.validator.setDefaults({
	showErrors: function(map, list) {
		// there's probably a way to simplify this
		var focussed = document.activeElement;
		if (focussed && $(focussed).is("input, textarea")) {
			$(this.currentForm).tooltip("close", { currentTarget: focussed }, true)
		}
		this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
		$.each(list, function(index, error) {
			$(error.element).attr("title", error.message).addClass("ui-state-highlight");
		});
		if (focussed && $(focussed).is("input, textarea")) {
			$(this.currentForm).tooltip("open", { target: focussed });
		}
	}
});

$("#account-form").tooltip({
		show: false,
		hide: false
	});

	$("#account-form").validate({
		rules: {
			password: {
				minlength: 7
			},
			verify_password: {
				minlength: 7,
				equalTo: "#password"
			},
			current_password: {
				required: true,
				remote: "includes/validator/check-password.php"
			},
		},
		messages: {
			password: {
				minlength: "Password should be at least 7 chars"
			},
			verify_password: {
				minlength: "Password should be at least 7 chars",
				equalTo: "Please confirm password"
			},
			current_password: {
				remote: "Please enter correct password"
			},
		}
	});



	$("#upload_step_1").tooltip({
		show: false,
		hide: false
	});

	$("#upload_step_1").validate({
		rules: {
			project_title: "required",
			project_category: "required",
			project_location: "required",
			project_developer: "required",
		},
		messages: {
			project_title: "Please enter project title",
			project_category: "Please select project category",
			project_location: "Please enter project location",
			project_developer: "Please select project developer"
		}
	});

$("#upload_step_2").tooltip({
		show: false,
		hide: false
	});

	$("#upload_step_2").validate({
		rules: {
			uploaded_video: "required",
			uploaded_image: "required",
			featuring_text: "required",
		
		},
		messages: {
			uploaded_video: "Please upload a video upto 5min",
			uploaded_image: "Please upload a featured image",
			featuring_text: "Please enter featuring text",
			
		}
	});

$("#upload_step_4").tooltip({
		show: false,
		hide: false
	});

	$("#upload_step_4").validate({
		rules: {
			uploaded_video: "required",
			uploaded_image: "required",
			details: "required",
		
		},
		messages: {
			uploaded_video: "Please upload a video upto 5min",
			uploaded_image: "Please upload a featured image",
			details: "Please enter details about your project",
			
		}
	});

$("#register-form").tooltip({
		show: false,
		hide: false
	});

	$("#register-form").validate({
		rules: {
			first_name: "required",
			last_name: "required",
			password: {
				required: true,
				minlength: 5
			},
			verify_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true,
				remote: "includes/validator/check-email.php"
			},

			agree_terms: "required"
		},
		messages: {
			first_name: "Please enter your first name",
			last_name: "Please enter your last name",
			company_name: "Please enter company name",
			location: "Please enter your location",
			password: {
				required: "Password should be at least 7 chars",
				minlength: "Password should be at least 7 chars"
			},
			verify_password: {
				required: "Password should be at least 7 chars",
				minlength: "Password should be at least 7 chars",
				equalTo: "Please confirm password"
			},
			email: {
				required: "Please enter valid email",
				email: "Please enter valid email",
				remote: "This email already exists"
				 },
			agree_terms: "Plase agree with terms and conditions"
		}
	});


$("#create-message").tooltip({
		show: false,
		hide: false
	});

	$("#create-message").validate({
		rules: {
			recipient: "required",
			message: "required"
		},
		messages: {
			recipient: "Please enter recipient name",
			message: "Please type your message"
		}
	});



});