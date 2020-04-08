SimmasUsers = {
	baseUrl : "",
	search	: "",
	searchAccess: "",
	limit	: 10,
	limitAccess :  5,
	offset	: 0,
	init:function(){
		self = this;

		$("#access").select2({
			language : "id",
			minimumInputLength : 2,
			ajax: {
			type : "GET",
		    url: self.baseUrl + "sites/systems/requirements/UsersAccess/getOfAccess",
		    dataType: 'json',
		    delay: 250,
		    data: function (params) {
		      return {
		        keyword: JSON.stringify(params.term)
		      };
		    },
		    processResults: function (data,page) {
		      return {
		        results: data
		      };
		    }
		  },
		  placeholder : "Ketik nama akses...."
		});

		$(document).ready(function(){

			$("#form-add").on("submit",function(e){
				e.preventDefault();

				username = $("#username").val();
				access 	 = $("#access").val();
				telepon  = $("#telepon").val();
				email  	 = $("#email").val();
				password = $("#password").val();

				////// START VALIDATION RULES /////
				error = false;
				if(username !== ""){
					pattern = /^[a-zA-Z0-9!.@#$%^&*]{8,32}$/;
					if(!pattern.test(username)){
						error = true;
						$(".error-username").html("Username terdiri dari huruf,angka & karakter spesial !");
					}
				}else{
					error = true;
					$(".error-username").html("Username harus diisi !");
				}

				if(typeof access !==undefined && access !== null){
					pattern = /[a-zA-Z]/;
					if(!pattern.test(access)){
						error = true;
						$(".error-access").html("Akses tidak terdeteksi !");
					}
				}else{
					error = true;
					$(".error-access").html("Silahkan pilih akses terlebih dahulu !");
				}

				if(telepon!==""){
					pattern = /^[\d]+$/;
					if(!pattern.test(telepon)){
						error = true;
						$(".error-telepon").html("Telepon minimal 10 digit & harus angka !");
					}
				}else{
					error = true;
					$(".error-telepon").html("Silahkan isikan telepon terlebih dahulu !");
				}

				if(email!== ""){
					pattern = /^[a-zA-Z0-9!.@_-]{8,80}$/;
					if(!pattern.test(email)){
						error = true;
						$(".error-email").html("Format pengisian email salah !");
					}
				}else{
					error = true;
					$(".error-email").html("Silahkan isikan email terlebih dahulu !");
				}

				if(password !==""){
					pattern = /^[a-zA-Z0-9!.@#$%^&*]{8,32}$/;
					if(!pattern.test(password)){
						error = true;
						$(".error-password").html("Password harus kombinasi huruf, angka dan karakter khusus !");
					}
				}else{
					error = true;
					$(".error-password").html("Silahkan isikan password terlebih dahulu !");
				}

				if(!error){
					$(".error-username").html("");
					$(".error-access").html("");
					$(".error-email").html("");
					$(".error-telepon").html("");
					$(".error-password").html("");
					parameter = {
						username : username,
						access   : access,
						telepon  : telepon,
						email    : email,
						password : password
					}
					self.addUsers(parameter);
				}

			});

			$("#btn-search").on("click",function(){
				self.search = $("#input-users").val();
				parameter = {
					search : self.search,
					limit  : self.limit
				}
				self.listUsers(parameter);
			});

			$("#input-users").on("keypress",function(e){
				if(e.which == 13){
					$("#btn-search").trigger("click");
				}
			});

			$("#btn-search").trigger("click");

			$("#btn-list-access").on("click",function(){
				$("#modal-list-access").on("shown.bs.modal",function(){
					parameter = {
						search : self.searchAccess,
						limit  : self.limitAccess
					}
					self.listAccess(parameter);
				});
				$("#modal-list-access").modal("show");
			});
		});
	},

	listUsers:function(param){
		tableContent  = '<tr class="text-center"><td colspan="6" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>'; 
		$("#load-users").html(tableContent);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/UsersAccess/listUsers",
				cache: false,
				data : {sendParam:JSON.stringify(param)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						tableContent = "";
						$.each(response.data,function(key,data){
							no = key +1;
							html_view_btn  = '<button class="btn btn-info btn-xs" title="Priview data users ?" data-placement="top" onclick=\'SimmasUsers.viewActions(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
							html_edit_btn  = '<button class="btn btn-success btn-xs" title="Edit data users ?" data-placement="top" onclick=\'SimmasUsers.editActions(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-pencil-alt"></i></button>';
							html_del_btn   = '<button class="btn btn-danger btn-xs" title="Hapus data users ?" data-placement="top" onclick=\'SimmasUsers.deleteActions(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
							tableContent += '<tr>';
							tableContent += '<td>'+no+'</td>';
							tableContent += '<td>'+data.user_id+'</td>';
							tableContent += '<td>'+data.username+'</td>';
							tableContent += '<td>'+data.email+'</td>';
							tableContent += '<td>'+data.phone_number+'</td>';
							tableContent += '<td class="text-center">'+html_view_btn+html_edit_btn+html_del_btn+'</td>';
							tableContent += '</tr>';
						});
						$("#load-users").html(tableContent);
					}else{
						tableContent  = '<tr class="text-center"><td colspan="6" class="text-danger">';
						tableContent += '<i class="fa fa-warning"></i> '+response.desc;
						tableContent += '</td></tr>'; 
						$("#load-users").html(tableContent);
					}
				},error:function(){
					tableContent  = '<tr class="text-center"><td colspan="6" class="text-danger">';
					tableContent += '<i class="fa fa-exclamation-circle"> Internal Server Error !</i> ';
					tableContent += '</td></tr>'; 
					$("#load-users").html(tableContent);
				}
			});
		},1000);
	},

	addUsers:function(param){
		loader = '<i class="fa fas fa-spinner fa-spin"></i> Sedang memproses data..';
		$("#btn-users").html(loader);
		$("#btn-users").attr("disabled",true);
		$("#btn-close-users").attr("disabled",true);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/UsersAccess/addUsers",
				cache: false,
				data : {data:JSON.stringify(parameter)},
				dataType: "JSON",
				success:function(response){
					alertify.set("notifier","position","top-right");
					$("#btn-users").html("Buatkan");
					$("#btn-close-users").removeAttr("disabled");
					$("#btn-users").removeAttr("disabled");
					if(response.status=="SUCCESS"){
						$("#btn-search").trigger("click");
						document.getElementById("form-add").reset();
						alertify.success(response.desc);
						$("#modal-add").modal("hide");
					}else{
						alertify.error(response.desc);
					}
				},error:function(e){
					alertify.set("notifier","position","top-right");
					alertify.error("Internal Server Error !");
					$("#btn-users").html("Buatkan");
					$("#btn-close-users").removeAttr("disabled");
					$("#btn-users").removeAttr("disabled");
				}
			});
		},1500);
	},

	viewActions:function(param){
		param = JSON.parse(unescape(param));
		$("#modal-view-users").on("shown.bs.modal",function(){
			$("#user_id").val(param.user_id);
			$("#v_username").val(param.username);
			$("#v_email").val(param.email);
			$("#v_telepon").val(param.phone_number);
		});
		$("#modal-view-users").modal("show");
	},

	listAccess:function(param){
		tableContent  = '<tr class="text-center"><td colspan="4" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>'; 
		$("#load-access").html(tableContent);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/UsersAccess/listAccess",
				cache: false,
				data : {sendParam:JSON.stringify(param)},
				dataType : "json",
				success:function(response){
					if(response.status=="SUCCESS"){
						tableContent = "";
						$.each(response.data,function(key,data){
							no = key+1;
							tableContent +="<tr>";
							tableContent +="<td class='text-center'>"+no+"</td>";
							tableContent +="<td>"+data.access_name+"</td>";
							tableContent +="<td class='text-justify'><small>"+data.description+"</small></td>";
							tableContent +="<td>Hello</td>";
							tableContent +="</tr>";
						});
						$("#load-access").html(tableContent);
					}else{
						tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
						tableContent += '<i class="fa fa-warning"></i> '+response.desc;
						tableContent += '</td></tr>'; 
						$("#load-access").html(tableContent);
					}
				},error:function(e){
					tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
					tableContent += '<i class="fa fa-warning"></i> Internal Server Error !';
					tableContent += '</td></tr>'; 
					$("#load-access").html(tableContent);
				}
			});
		},1000);
	},

	editActions:function(param){
		param = JSON.parse(unescape(param));
		$("#modal-edit-users").on("shown.bs.modal",function(){
			$("#edit-detail-name").text(param.username.toUpperCase());
			$("#e_user_id").val(param.user_id);
			$("#e_username").val(param.username);
			$("#e_email").val(param.email);
			$("#e_telepon").val(param.phone_number);
			$("#e_username").focus();
		});
		$("#modal-edit-users").modal("show");
	},

	deleteActions:function(param){
		param = JSON.parse(unescape(param));
		$("#modal-delete-users").on("shown.bs.modal",function(){
			$(".delete-title").text(param.username);
		});
		$("#modal-delete-users").modal("show");

		$("#btn-delete-users").on("click",function(){
			parameter = {user_id:param.user_id}
			html_loader = '<i class="fa fas fa-spinner fa-spin"></i> Sedang diproses...';
			$("#btn-close-delete").attr("disabled",true);
			$(this).attr("disabled",true);
			$(this).html(html_loader);
			setTimeout(function(){
				$.ajax({
					type : "GET",
					url  : self.baseUrl + "sites/systems/requirements/UsersAccess/deleteUsers",
					cache: false,
					data : {sendParam:JSON.stringify(parameter)},
					dataType : "json",
					success:function(response){
						alertify.set("notifier","position","top-right");
						$("#btn-close-delete").removeAttr("disabled");
						$("#btn-delete-users").removeAttr("disabled");
						$("#btn-delete-users").html("YA, HAPUS");
						$(this).removeAttr("disabled");
						if(response.status=="SUCCESS"){
							alertify.success(response.desc);
							$("#btn-search").trigger("click");
							$("#modal-delete-users").modal("hide");
						}else{
							msg_box("error-delete","error",response.desc);
						}
					},error:function(e){
						//alertify.set("notifier","position","top-right");
						$("#btn-close-delete").removeAttr("disabled");
						$("#btn-delete-users").html("YA, HAPUS");
						$("#btn-delete-users").removeAttr("disabled");
						msg_box("error-delete","error","Internal Server Error !");
						//alertify.error("Internal Server Error !");
					}
				});
			},1000);
		});
	}

}