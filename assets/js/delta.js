"use strict"
if (localStorage.getItem('token') == "") {
	window.location.href = './sign-outh'
}else{
	setInterval(function() {
		cekSessions()
	},60000)
	
}
$("#act_infak").click(function() {
	var saldo = $("#saldo").val();
	var infak = $("#amount_infak").val();
	if (infak == "") {
		toastr.error("Amount Infak can't be empty")
	}else if (infak == 0) {
		toastr.error("YAmount Infak can't 0 value")
	}else if (infak > saldo) {
		toastr.error("Your balance not enought")
	}else{
		var settings = {
		  "url": "./home/infak",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "amount": infak,
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./infak"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
})
$("#transfer_tiket").click(function() {
	var amount_tf = $("#amount_tf").val()
	var username_tf = $("#username_tf").val()
	if (amount_tf == "") {
		toastr.error("amount ticket can't be empty")
	}else if (username_tf == "") {
		toastr.error("username can't be empty")
	}else{
		var settings = {
		  "url": "./home/transfer",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "amount": amount_tf,
		    "username": username_tf
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./ticket"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
})
$("#transfer_engine").click(function() {
	var amount_tf = $("#amount_engine").val()
	var username_tf = $("#username_engine").val()
	if (amount_tf == "") {
		toastr.error("amount engine can't be empty")
	}else if (username_tf == "") {
		toastr.error("username can't be empty")
	}else{
		var settings = {
		  "url": "./home/transfer_engine",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "amount": amount_tf,
		    "username": username_tf
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./engine"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
})
$("#start_engine").click(function() {
	var engine = $("#value_engine").val();
	if (engine == "") {
		toastr.error("Engine can't be empty")
	}else{
		var settings = {
		  "url": "./home/start_engine",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "engine": engine
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
})
$("#btn_profile").click(function() {
	var wallets = $("#wallets").val();
	var password = $("#password").val();
	if (wallets == "") {
		toastr.error("Wallet address can't be empty")
	}else{
		var settings = {
		  "url": "./home/update_profile",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "wallet": wallets,
		    "password": password
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./profile"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
	
})
$("#btn_profile_control").click(function() {
	var wallets = $("#wallets_control").val();
	var password = $("#password_control").val();
	var id = $("#id_profiles").val();
	if (wallets == "") {
		toastr.error("Wallet address can't be empty")
	}else{
		var settings = {
		  "url": "./update_profile",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "wallet": wallets,
		    "password": password,
		    'id':id,
		  }
		};

		$.ajax(settings).done(function (response) {
			console.log(response);
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./members"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
	
})
$("#btn_buy_ticket").click(function() {
	var amount = $("#amount_ticket").val();
	if (amount == "") {
		toastr.error("amount can't be empty")
	}else{
		var settings = {
		  "url": "./home/buy_ticket",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "amount": amount,
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./ticket"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
	
})
$("#btn_usdt").click(function() {
	var amount = $("#amount_usdt").val();

	if (amount == "") {
		toastr.error("amount can't be empty")
	}else{
		var settings = {
		  "url": "../home/deposit",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "amount": amount,
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./deposit-usdt"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
	
})
$("#btn_usdt_hash").click(function() {
	var amount = $("#amount_usdt_hash").val();
	var id = $("#id_usdt_hash").val();
	if (amount == "") {
		toastr.error("hash transaction can't be empty")
	}else{
		var settings = {
		  "url": "../home/conf_deposit",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "hash": amount,
		    "id":id
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./deposit-usdt"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
	
})
$("#amount").keyup(function() {
	var amount = $(this).val();
	var fee =  parseInt(amount)*(0)
	var net = parseInt(amount) - parseInt(fee)
	var max = $("#max_wd").val();
	var min = $("#min_wd").val();
	$("#act_wd").attr("disabled", true);
	if (amount.length > 0) {
		$("#fee").val(fee);
		$("#net").val(net);
	}else{
		$("#fee").val("");
		$("#net").val("");
	}
	if (amount.length == max.length) {
		if (amount > max) {
			toastr.error("Your maximum withdrawal is "+max+" MBIT")
			$("#amount").val("")
			$("#net").val("")
			$("#fee").val("")
			$("#amount").focus()
			$("#act_wd").attr("disabled", true);
		}else{
			$("#act_wd").attr("disabled", false);
		}
	}
})
$("#act_wd").click(function() {
	var amount = $("#amount").val();
	var fee =  $("#fee").val();
	var net = $("#net").val();
	var ticket = $("#ticket").val();
	var settings = {
	  "url": "./act_wd",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Content-Type": "application/x-www-form-urlencoded",
	    "Authorization": localStorage.getItem('token')
	  },
	  "data": {
	    "amount": amount,
	    "fee": fee,
	    "net": net,
	    "tiket":ticket,
	  }
	};

	$.ajax(settings).done(function (response) {
	  if (response.code == 200) {
	  	toastr.info(response.message)
	  	setTimeout(function() {
	  		window.location.href="./withdrawal"
	  	},1500)
	  }else{
	  	toastr.error(response.message)
	  }
	});
})
function cekSessions() {
	var urls = "./auth/cek_token/"+localStorage.getItem('token')
	var settings = {
	  "url": urls,
	  "method": "GET",
	  "timeout": 0,
	};

	$.ajax(settings).done(function (response) {
	  console.log(response)
	});
}
function rupiah(number) {
	return number.toLocaleString('id-ID')
}
var roi = parseFloat($("#roi").html());
var bns_detik = parseFloat($("#bns_detik").val());
setInterval(function() {
	roi += bns_detik
	$('#roi').html( parseFloat(roi).toFixed(8)+" MBIT" )
},1000)
$(".link_ref").click(function() {
	var link = $(".link_ref").html();
	var tempTextArea = document.createElement("textarea");
    tempTextArea.value = link;
    document.body.appendChild(tempTextArea);
    tempTextArea.select();

	document.execCommand("copy");
	document.body.removeChild(tempTextArea);
	toastr.info("Referral link successfully copied")
})
$("#btn_conf").click(function() {
	var hash = $("#hash").val();
	if (hash == "") {
		toastr.error("Hash can't be empty")
	}else{
		var settings = {
		  "url": "./confirmation",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "Content-Type": "application/x-www-form-urlencoded",
		    "Authorization": localStorage.getItem('token')
		  },
		  "data": {
		    "hash": hash
		  }
		};

		$.ajax(settings).done(function (response) {
		  if (response.code == 200) {
		  	toastr.info(response.message)
		  	setTimeout(function() {
		  		window.location.href="./package"
		  	},1500)
		  }else{
		  	toastr.error(response.message)
		  }
		});
	}
})
$("#wallet").click(function() {
	var link = $("#wallet").html();
	var tempTextArea = document.createElement("textarea");
    tempTextArea.value = link;
    document.body.appendChild(tempTextArea);
    tempTextArea.select();

	document.execCommand("copy");
	document.body.removeChild(tempTextArea);

	toastr.info("Wallet Address successfully copied")
})

$(".subcribe1").click(function() {
	var paket = $(".paket1").val()
	var settings = {
	  "url": "./subcribe",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Content-Type": "application/x-www-form-urlencoded",
	    "Authorization": localStorage.getItem('token')
	  },
	  "data": {
	    "paket": paket
	  }
	};

	$.ajax(settings).done(function (response) {
	  if (response.code == 200) {
	  	toastr.info(response.message)
	  	setTimeout(function() {
	  		window.location.href="./package"
	  	},1500)
	  }else{
	  	toastr.error(response.message)
	  }
	});
	
})
$(".subcribe2").click(function() {
	var paket = $(".paket2").val()
	var settings = {
	  "url": "./subcribe",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Content-Type": "application/x-www-form-urlencoded",
	    "Authorization": localStorage.getItem('token')
	  },
	  "data": {
	    "paket": paket
	  }
	};

	$.ajax(settings).done(function (response) {
	  if (response.code == 200) {
	  	toastr.info(response.message)
	  	setTimeout(function() {
	  		window.location.href="./package"
	  	},1500)
	  }else{
	  	toastr.error(response.message)
	  }
	});
	
})
$(".subcribe3").click(function() {
	var paket = $(".paket3").val()
	var settings = {
	  "url": "./subcribe",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Content-Type": "application/x-www-form-urlencoded",
	    "Authorization": localStorage.getItem('token')
	  },
	  "data": {
	    "paket": paket
	  }
	};

	$.ajax(settings).done(function (response) {
	  if (response.code == 200) {
	  	toastr.info(response.message)
	  	setTimeout(function() {
	  		window.location.href="./package"
	  	},1500)
	  }else{
	  	toastr.error(response.message)
	  }
	});
	
})
$(".subcribe4").click(function() {
	var paket = $(".paket4").val()
	var settings = {
	  "url": "./subcribe",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Content-Type": "application/x-www-form-urlencoded",
	    "Authorization": localStorage.getItem('token')
	  },
	  "data": {
	    "paket": paket
	  }
	};

	$.ajax(settings).done(function (response) {
	  if (response.code == 200) {
	  	toastr.info(response.message)
	  	setTimeout(function() {
	  		window.location.href="./package"
	  	},1500)
	  }else{
	  	toastr.error(response.message)
	  }
	});
	
})
$(".subcribe5").click(function() {
	var paket = $(".paket5").val()
	var settings = {
	  "url": "./subcribe",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Content-Type": "application/x-www-form-urlencoded",
	    "Authorization": localStorage.getItem('token')
	  },
	  "data": {
	    "paket": paket
	  }
	};

	$.ajax(settings).done(function (response) {
	  if (response.code == 200) {
	  	toastr.info(response.message)
	  	setTimeout(function() {
	  		window.location.href="./package"
	  	},1500)
	  }else{
	  	toastr.error(response.message)
	  }
	});
	
})
$(".subcribe6").click(function() {
	var paket = $(".paket6").val()
	var settings = {
	  "url": "./subcribe",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
	    "Content-Type": "application/x-www-form-urlencoded",
	    "Authorization": localStorage.getItem('token')
	  },
	  "data": {
	    "paket": paket
	  }
	};

	$.ajax(settings).done(function (response) {
	  if (response.code == 200) {
	  	toastr.info(response.message)
	  	setTimeout(function() {
	  		window.location.href="./package"
	  	},1500)
	  }else{
	  	toastr.error(response.message)
	  }
	});
})