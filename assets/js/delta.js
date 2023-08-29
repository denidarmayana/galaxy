"use strict"
if (localStorage.getItem('token') == "") {
	window.location.href = './sign-outh'
}else{
	setInterval(function() {
		cekSessions()
	},60000)
	
}
var total_bonus = $("#total_bonus").val();
console.log(total_bonus)
if (total_bonus == 0) {
	$(".form").hide()
	$(".notif").html("<div class='alert alert-danger'>You don't have anought balance</div>")
}
$("#amount").keyup(function() {
	var amount = $(this).val();
	if (total_bonus > 0 && total_bonus > amount) {
		var fee =  parseInt(amount)*(10/100)
		var net = parseInt(amount) - parseInt(fee)
		var max = $("#max_wd").val();
		var min = $("#min_wd").val();
		$("#act_wd").attr("disabled", true);
		$("#fee").val(fee);
		$("#net").val(net);
		setTimeout(function() {
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
		},1500)	
	}else{
		$("#amount").attr("readonly",true)
		toastr.error("Your balance is "+ parseInt(total_bonus).toFixed(8) +" MBIT")
	}
	
	console.log(amount,fee,net,max,min)
})
$("#act_wd").click(function() {
	var amount = $("#amount").val();
	var fee =  $("#fee").val();
	var net = $("#net").val();
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
	$('#roi').html( parseFloat(roi).toFixed(8) )
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