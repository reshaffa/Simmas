SimmasLogin = {

	baseUrl : "",
	accessLogin : "",
	init :function(){
		self = this;

		$(document).on("submit","#form-login",function(event){
			event.preventDefault();

			username = $("#username").val();
			password = $("#password").val();

			error = false;
			if(username==""){
				$(".error-username").html("Maaf, silahkan isi username terlebih dahulu !");
				error = true;
			}else{
				pattern = /^[a-zA-Z0-9.@]+$/;
				if(!pattern.test(username)){
					$(".error-username").html("Maaf, username harus terdiri dari angka !");
					error = true;
				}else if(username.length<16){
					$(".error-username").html("Maaf, username minimal terdiri dari 16 digit angka !");
					error = true;	
				}else{
					$(".error-username").html("");
				}
			}

			if(password==""){
				$(".error-password").html("Maaf, silahkan isikan password terlebih dahulu !");
				error = true;
			}else{
				pattern = /^[a-zA-Z0-9!.@#$%^&*]{8,16}$/;
				if(!pattern.test(password)){
					$(".error-password").html("Maaf, Password harus mengandung 1 angka dan 1 karakter khusus (@#$%^&*) !");
					error = true;
				}else{
					$(".error-password").html("");
				}
			}

			if(error){
				html_alert = '<div class="alert alert-danger">NIK atau password salah !</div>'
				$("#login-alert").html();
			}else{
				parameter = {
					username : username,
					password : password
				}
				self.accessLogin(parameter);
			}
		});
	},

	accessLogin:function(parameter){
		$.ajax({
			type : "POST",
			url  : self.baseUrl + "/OAuth/login",
			data : parameter,
			dataType : "JSON",
			success:function(response){
				if(response.status=="SUCCESS"){
					$("#btn-login").attr("disabled",true);
					html_alert = '<span class="text-success"><i class="fas fa-sync fa-spin"></i> '+response.desc+'</span>';
					$("#login-alert").html(html_alert);
					setTimeout(function(){
						$("#login-alert").html("");
						window.location.replace(response.redirect_link);
					},3000);
				}else{
					html_alert = '<div class="alert alert-danger">'+response.desc+'</div>'
					$("#login-alert").html(html_alert);
					setTimeout(function(){
						$("#login-alert").html("");
					},3000);
				}
			},error:function(){
				html_alert = '<div class="alert alert-danger">Internal Server Error !</div>'
				$("#login-alert").html(html_alert);
				setTimeout(function(){
					$("#login-alert").html("");
				},3000);
			}
		});
	}
}