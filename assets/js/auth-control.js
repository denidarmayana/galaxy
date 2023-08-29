"use strict"

$("#login").click(function() {
	var email = $("#email").val()
	var password = $("#password").val()
	if (email == "") {
		toastr.error("Username can't be empty")
	}else if (password == "") {
		toastr.error("Email can't be empty")
	}else{
		$(".col-reg").hide();
		$("#loading").show();
		var settings = {
		  "url": "./login/action",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded"
		  },
		  "data": {
		    "username": email,
		    "password": password
		  }
		};

		$.ajax(settings).done(function (response) {
			$(".col-reg").show();
			$("#loading").hide();
			if (response.code == 203) {
				toastr.error(response.message)
			}else{
				localStorage.setItem('token', response.data);
				toastr.success(response.message)
				setTimeout(function() {
					window.location.href="./control"
				},2000)
			}
		});
	}
})

