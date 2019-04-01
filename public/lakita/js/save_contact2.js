$(document).ready(function(){
   
    //$('#fr_save_c2').submit(ajax);
        function ajax(){
                $.ajax({
                    url : 'lakita/save_c2.php',
                    type : 'POST',
                    data : $('#fr_save_c2').serialize(),
                    success: function(data){
                    }
                });
                return false;
        }
         ajax();
	$('#f_allbody_pc a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top -120
	        }, 1000);
	        return false;
	      }
              
	    }
	  });

        $('#f_allbody_smp a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });
        
	$(document).on("submit", ".e_form_submit", function(e){
		e.preventDefault();
		var obj = $(this);
		check_lienhe(obj);
		confirm = false;
	});
});
function submit_c2(obj) {
	var url = 	obj.attr("action");
	obj.ajaxSubmit({
		type: "POST",
		url: url,
		dataType : 'json',
		async:false, 
		success: function(data) {
			if(data.status){
                        //window.location = data.redirect;
			}else{
				location.reload();
			}
		},
		error: function() {	
		},
		complete: function() {
        }
	});
}		
		
function check_sdt(sdt) {
	if (isNaN(sdt.value)){
		sdt.style.border = '3px solid Yellow';
		sdt.value='';
		alert("Số điện thoại có dạng 09XXXXXXXX hoac 012XXXXXXXX");
	}
}
		
function check_lienhe(obj) {
	var button = obj.find('.e_btn_submit');
	var email=obj.find('input[name="email"]').val();			
	var name=obj.find('input[name="name"]').val();
	var aCong=email.indexOf("@");
	var dauCham = email.lastIndexOf(".");
	var sdttext = obj.find('input[name="phone"]').val();
	var dodaisdt = sdttext.length;
	if ((name.trim() == "") || (name == "Họ tên *")){ 
		alert("Vui lòng nhập họ và tên của bạn"); 
		obj.find('input[name="name"]').focus(); 
		return (false); 
	}
	if ((email == "") || (email == "email_address@gmail.com")){ 
		alert("Vui lòng nhập email của bạn"); 
		obj.find('input[name="email"]').focus(); 
		return (false); 
	}
	if ((aCong<1) || (dauCham<aCong+2) || (dauCham+2>email.length)) {
		alert("Email có dạng: email@example.com");
		obj.find('input[name="email"]').focus();
		return false;
	}
	if ((sdttext == "") ||(sdttext == "Điện thoại *")){ 
		alert("Vui lòng nhập số Điện thoại"); 
		obj.find('input[name="phone"]').focus(); 
		return (false); 
	}
	if (d = sdttext.match(/^09/i)){
		if ((dodaisdt<10) ||(dodaisdt>11)){
			alert("Vui lòng kiểm tra lại số điện thoại");
			obj.find('input[name="phone"]').focus();
			return (false);
		}
	}else if (d = sdttext.match(/^01/i)){
		if ((dodaisdt<11) ||(dodaisdt>11)){
			alert("Vui lòng kiểm tra lại số điện thoại");
			obj.find('input[name="phone"]').focus();
			return (false);
		}
	}else {
		alert("Vui lòng kiểm tra lại số điện thoại");
		obj.find('input[name="phone"]').focus();
		return false;
	}
	button.attr('disabled','disabled');		
	var url = 	obj.attr("action");
	obj.ajaxSubmit({
		type: "POST",
		url: url,
		dataType : 'json',
		async:false, 
		success: function(data) {
			if(data.status){
                        alert('Bạn đã đăng ký thành công, chúng tôi sẽ liên lạc với bạn!');
			}else{
				
				location.reload();
			}
		},
		error: function() {
			alert('Lỗi không đăng ký được. Bạn vui lòng đăng ký lại!');
		},
		complete: function() {
               
            button.removeAttr('disabled');
        }
	});
}