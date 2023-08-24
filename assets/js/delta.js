"use strict"
if (localStorage.getItem('token') == "") {
	window.location.href = './sign-outh'
}else{
	setInterval(function() {
		cekSessions()
	},60000)
	
}
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
function formatDateToMySQLDatetime(date) {
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var day = ('0' + date.getDate()).slice(-2);
    var hours = ('0' + date.getHours()).slice(-2);
    var minutes = ('0' + date.getMinutes()).slice(-2);
    var seconds = ('0' + date.getSeconds()).slice(-2);
    var formattedDatetime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
    return formattedDatetime;
}
function calculateTimeDifference(mysqlDatetime1, mysqlDatetime2) {
    var date1 = new Date(mysqlDatetime1);
    var date2 = new Date(mysqlDatetime2);
    var timeDifferenceMillis = date2 - date1;
    var seconds = Math.floor(timeDifferenceMillis / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    // Calculate remaining minutes and seconds
    minutes %= 60;
    seconds %= 60;
    // Format as Y-m-d h:i:s
    var formattedDifference = hours.toString().padStart(2, '0') + ':' +
                              minutes.toString().padStart(2, '0') + ':' +
                              seconds.toString().padStart(2, '0');
    return formattedDifference;
}
var amount_paket = $("#amount_paket").val();
var tgl_paket = $("#tgl_paket").val();
if (amount_paket != "") {
	function tgl_akhir() {
		var tgl = tgl_paket.split(" ");
		var waktu = tgl[1].split(":");
		var dates = tgl[0].split("-")
		var specificDate = new Date(dates[0], dates[1], dates[2], waktu[0], waktu[1], waktu[2]);
		specificDate.setDate(specificDate.getDate() + 300);
		var newDateFormatted = specificDate.toISOString();
	    return newDateFormatted;

	}
	tgl_akhir()
	if (tgl_akhir() == new Date().toISOString()) {
		$(".time_roi").html("Finish")
	}else{
		var profit_harian = amount_paket*(1/100);
		var profit_jam = parseFloat(profit_harian/24)
		var profit_menit = parseFloat(profit_jam/60)
		var profit_detik = parseFloat(profit_menit/60)
		var timeDifference = calculateTimeDifference(tgl_paket, formatDateToMySQLDatetime(new Date()));
		var selisih = timeDifference.split(":");
		var jml_jam = parseFloat(profit_jam*selisih[0])
		var jml_menit = parseFloat(profit_menit*selisih[1])
		var jml_detik = parseFloat(profit_detik*selisih[0])
		var total = parseFloat(jml_jam)+parseFloat(jml_menit)+parseFloat(jml_detik)
		setInterval(function() {
			total += profit_detik
			$(".time_roi").html(total.toFixed(8)+" MBIT")
			console.log("test")
		},1000)
		
	}
}
$(".link_ref").click(function() {
	var link = $(".link_ref").html();
	var tempTextArea = document.createElement("textarea");
    tempTextArea.value = link;
    document.body.appendChild(tempTextArea);
    tempTextArea.select();

	document.execCommand("copy");
	document.body.removeChild(tempTextArea);
	toastr.success("Referral link successfully copied")
})

$("#wallet").click(function() {
	
	toastr.success("Wallet Address successfully copied")
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