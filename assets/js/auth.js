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
		  "url": "./sign-in",
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
					window.location.href="./"
				},2000)
			}
		});
	}
})

$("#signup").click(function() {
	var email = $("#email").val()
	var name = $("#name").val()
	var username = $("#username").val()
	var password = $("#password").val()
	var upline = $("#upline").val()
	if (email == "") {
		toastr.error("Email can't be empty")
	}else if (name == "") {
		toastr.error("Name can't be empty")
	}else if (username == "") {
		toastr.error("Username can't be empty")
	}else if (password == "") {
		toastr.error("Password can't be empty")
	}else{
		$(".col-reg").hide();
		$("#loading").show();
		var settings = {
		  "url": "./registered",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded"
		  },
		  "data": {
		    "name": name,
		    "email": email,
		    "username": username,
		    "password": password,
		    "upline": upline
		  }
		};

		$.ajax(settings).done(function (response) {
			$(".col-reg").show();
			$("#loading").hide();
			if (response.code == 203) {
				toastr.error(response.message)
			}else{
				toastr.success(response.message)
				setTimeout(function() {
					window.location.href="./auth"
				},2000)
			}
		});
	}
})