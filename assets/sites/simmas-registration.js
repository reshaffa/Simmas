SimmasRegistration = {
	baseUrl : "",
	search	: "",
	limit	: 10,
	offset	: 0,
	selectizePropinsi : null,
	init:function(){
		self = this;

		$("#kabupaten").attr("disabled",true);
		$("#kecamatan").attr("disabled",true);
		$("#kelurahan").attr("disabled",true);
		$("#kades").attr("disabled",true);
		$("#email").attr("disabled",true);
		$("#alamat").attr("disabled",true);
		$("#telepon").attr("disabled",true);
		
		$("#form-add").on("submit",function(){

			propinsi  = $("#propinsi").val();
			kabupaten = $("#kabupaten").val();
			kecamatan = $("#kecamatan").val();
			kelurahan = $("#kelurahan").val();
			kades	  = $("#kades").val();
			email	  = $("#email").val();
			telepon	  = $("#telepon").val();
			alamat 	  = $("#alamat").val();
			kodepos   = $("#kodepos").val();
			websites  = $("#websites").val();

			error = false;

			if(propinsi==null || propinsi=="undefined"){
				error = true;
				$(".error-propinsi").html("Anda belum memilih propinsi !");
			}else{
				if(kabupaten==null || kabupaten=="undefined"){
					error = true;
					$(".error-kabupaten").html("Anda belum memilih kabupaten !");
				}else{
					if(kecamatan==null || kecamatan=="undefined"){
						error = true;
						$(".error-kecamatan").html("Anda belum memilih kecamatan !");
					}else{
						if(kelurahan==null || kelurahan=="undefined"){
							error = true;
							$(".error-kelurahan").html("Anda belum memilih kelurahan !");
						}
					}
				}
			}

			if(kades!=="" || kades.length > 0){
				pattern = /[a-zA-Z ]/;
				if(!pattern.test(kades)){
					error = true;
					$(".error-kades").html("Nama kades hanya boleh menggunakan huruf !");
				}

				if(kades.length < 5){
					error = true;
					$(".error-kades").html("Nama kades minimal 5 digit karakter !");
				}

			}else{
				error = true;
				$(".error-kades").html("Nama kades harus diisi !");
			}

			if(email!=="" || email.length > 0){
				pattern = /[.@]/;
				if(!pattern.test(email)){
					error = true;
					$(".error-email").html("Format penulisan email desa salah !");
				}
			}else{
				error = true;
				$(".error-email").html("Email desa harus diisi !");
			}

			if(telepon!=="" || telepon.length > 0){
				if(isNaN(telepon)){
					error = true;
					$(".error-telepon").html("Telepon harus angka !");
				}

				if(telepon.length < 8){
					error = true;
					$(".error-telepon").html("Telepon minimal 8 digit angka !");
				}

			}else{
				error = true;
				$(".error-telepon").html("Telepon desa harus diisi !");
			}

			if(alamat!=="" || alamat.length > 0){
				pattern = /[a-zA-Z0-9.-_():]/;
				if(!pattern.test(alamat)){
					error = true;
					$(".error-alamat").html("Alamat hanya boleh menggunakan huruf dan karakter .-_(): !");
				}

				if(alamat.length < 10 ){
					error = true;
					$(".error-alamat").html("Alamat minimal 10 digit karakter !");
				}
			}else{
				error = true;
				$(".error-alamat").html("Alamat kelurahan harus diisi !");
			}

			if(!error){
				parameter = {
					kelurahan_id : kelurahan,
					kades 		 : kades,
					email 		 : email,
					telepon 	 : telepon,
					alamat 		 : alamat
				} 
				self.addRegister(parameter);
			}

		});

		$(document).ready(function(){

			$("#btn-registrasi").attr("disabled",true);
			
			$("#btn-search").on("click",function(){
				self.search = $("#input-kelurahan").val();
				parameter = {
					search : self.search,
					limit  : self.limit
				}
				self.listRegistrasi(parameter);
			});

			$("#propinsi").select2({
				language : "id",
				minimumInputLength : 3,
				ajax: {
			    url: self.baseUrl + "sites/systems/requirements/locations/getOfpropinsi",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        keyword: params.term
			      };
			    },
			    processResults: function (data,page) {
			      return {
			        results: data
			      };
			    }
			  },
			  placeholder : "Ketik nama propinsi...."
			}).on('change', function (evt) {
		        $("#kabupaten").removeAttr("disabled");
		    });

		    $("#kabupaten").select2({
				language : "id",
				minimumInputLength : 3,
				ajax: {
			    url: self.baseUrl + "sites/systems/requirements/locations/getOfkabupaten",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        keyword: params.term,
			        prop_id: $("#propinsi").val()
			      };
			    },
			    processResults: function (data,page) {
			      return {
			        results: data
			      };
			    }
			  },
			  placeholder : "Ketik nama kabupaten...."
			}).on('change', function (evt) {
		        $("#kecamatan").removeAttr("disabled");
		    });

			$("#kecamatan").select2({
				language : "id",
				minimumInputLength : 3,
				ajax: {
			    url: self.baseUrl + "sites/systems/requirements/locations/getOfkecamatan",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        keyword: params.term,
			        kab_id : $("#kabupaten").val()
			      };
			    },
			    processResults: function (data,page) {
			      html_link = '<a href="javascript:;">Buat Kecamatan Baru</a>';
			      return { 
			        results: data
			      };
			    }
			  },
			  placeholder : "Ketik nama kecamatan...."
			}).on('change', function (evt) {
		        $("#kelurahan").removeAttr("disabled");
		    });

			$("#kelurahan").select2({
				language : "id",
				minimumInputLength : 3,
				ajax: {
			    url: self.baseUrl + "sites/systems/requirements/locations/getOfkelurahan",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        keyword: params.term,
			        kec_id : $("#kecamatan").val()
			      };
			    },
			    processResults: function (data,page) {
			      return { 
			        results: data
			      };
			    }
			  },
			  placeholder : "Ketik nama kelurahan...."
			}).on('change', function (evt) {
		        $("#kades").removeAttr("disabled");
		        $("#email").removeAttr("disabled");
		        $("#alamat").removeAttr("disabled");
		        $("#telepon").removeAttr("disabled");
		        $("#btn-registrasi").removeAttr("disabled");
		    });

		    $("#input-kelurahan").on("keypress",function(e){
		    	if(e.which == 13){
		    		$("#btn-search").trigger("click");
		    	}
		    });

		    $("#btn-search").trigger("click");
		});
	},

	addRegister:function(param){
		$("#btn-registrasi").attr("disabled",true);
		$("#btn-close-registrasi").attr("disabled",true);
		$("#btn-registrasi").html("<i class='fa fas fa-spinner fa-spin'></i> Sedang diproses...");
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Eregistrasi/addRegister",
				cache: false,
				data : {sendParam:JSON.stringify(param)},
				dataType : "json",
				success: function(response){
					$("#btn-registrasi").removeAttr("disabled");
					$("#btn-close-registrasi").removeAttr("disabled");
					$("#btn-registrasi").html("Buatkan");	
					if(response.status == "SUCCESS"){
						document.getElementById("form-add").reset();
						alertify.set("notifier","position","top-right");
						alertify.success(response.desc)
						$("#modal-add").modal("hide");
						$("#btn-search").trigger("click");
					}else{
						alertify.set("notifier","position","top-right");
						alertify.error(response.desc)
					}
				},error:function(e){
					$("#btn-registrasi").removeAttr("disabled");
					$("#btn-close-registrasi").removeAttr("disabled");
					$("#btn-registrasi").html("Buatkan");
					alertify.set("notifier","position","top-right");
					alertify.error("Internal Server Error !")
				}
			});
		},1000);
	},

	listRegistrasi:function(param){
		tableContent  = '<tr class="text-center"><td colspan="6" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>'; 
		$("#load-registrasi").html(tableContent);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Eregistrasi/listRegistrasi",
				cache: false,
				data : {sendParam:JSON.stringify(param)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						tableContent = "";
						$.each(response.data,function(key,data){
							no = key+1;
							html_view_btn  = '<button class="btn btn-info btn-xs" title="Priview data registrasi ?" data-placement="top" onclick=\'SimmasRegistration.viewActions(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
							html_edit_btn  = '<button class="btn btn-success btn-xs" title="Edit data registrasi ?" data-placement="top" onclick=\'SimmasRegistration.editActions(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-pencil-alt"></i></button>';
							html_del_btn   = '<button class="btn btn-danger btn-xs" title="Hapus data registrasi ?" data-placement="top" onclick=\'SimmasRegistration.deleteActions(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
							tableContent += '<tr>';
							tableContent += '<td class="text-center">'+no+'</td>';
							tableContent += '<td>'+data.user_id+'</td>';
							tableContent += '<td>'+data.nm_kelurahan+'</td>';
							tableContent += '<td>'+data.nm_kades+'</td>';
							tableContent += '<td class="text-center">'+html_view_btn+html_edit_btn+html_del_btn+'</td>';
							tableContent += '</tr>';
						});
						$("#load-registrasi").html(tableContent);
					}else{
						tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
						tableContent += '<i class="fa fa-warning"></i> '+response.desc;
						tableContent += '</td></tr>'; 
						$("#load-registrasi").html(tableContent);
					}
				},error:function(){
					tableContent  = '<tr class="text-center"><td colspan="6" class="text-danger">';
					tableContent += '<i class="fa fa-exclamation-circle"> Internal Server Error !</i> ';
					tableContent += '</td></tr>'; 
					$("#load-registrasi").html(tableContent);
				}
			});
		},1000);
	},

	viewActions:function(param){
		param = JSON.parse(unescape(param));
		$("#modal-view-kelurahan").on("shown.bs.modal",function(){
			$("#user_id").val(param.user_id);
			$("#kelurahan-title").text(param.nm_kelurahan.toUpperCase());
			$("#propinsi-detail").val(param.nm_propinsi);
			$("#kabupaten-detail").val(param.nm_kabupaten);
			$("#kecamatan-detail").val(param.nm_kecamatan);
			$("#kelurahan-detail").val(param.nm_kelurahan);
			$("#kades-detail").val(param.nm_kades);
			$("#alamat-detail").val(param.alamat);
			$("#email-detail").val(param.email);
			$("#telepon-detail").val(param.telepon);
			$("#sites-detail").val(param.sites);
		});
		$("#modal-view-kelurahan").modal("show");
	},

	editActions:function(param){
		param = JSON.parse(unescape(param));
		$("#modal-edit-kelurahan").on("shown.bs.modal",function(){
			$("#edit-kelurahan-title").text(param.nm_kelurahan.toUpperCase());
			$("#kelurahan-edit").val(param.nm_kelurahan);
			$("#kades-edit").val(param.nm_kades);
			$("#alamat-edit").val(param.alamat);
			$("#email-edit").val(param.email);
			$("#telepon-edit").val(param.telepon);
			$("#sites-edit").val(param.sites);
		});
		$("#modal-edit-kelurahan").modal("show");
	},

	deleteActions:function(param){
		param = JSON.parse(unescape(param));

		$("#modal-delete-kelurahan").on("shown.bs.modal",function(){
			$(".delete-title").text(param.nm_kelurahan);
		});
		$("#modal-delete-kelurahan").modal("show");

		$("#btn-delete-actions").on("click",function(){
			$(this).attr("disabled",true);
			$("#btn-delete-close").attr("disabled",true);
			html_loader = "<i class='fa fas fa-spinner fa-spin'></i> Sedang diproses...";
			$(this).html(html_loader);
			parameter = {user_id:param.user_id}
			setTimeout(function(){
				$.ajax({
					type : "GET",
					url  : self.baseUrl + "sites/systems/requirements/Eregistrasi/deleteRegister",
					cache: false,
					data : {sendParam:JSON.stringify(parameter)},
					dataType : "json",
					success:function(response){
						alertify.set("notifier","position","top-right");
						$("#btn-delete-close").removeAttr("disabled");
						$("#btn-delete-actions").removeAttr("disabled");
						$("#btn-delete-actions").html("YA, HAPUS");
						if(response.status=="SUCCESS"){
							$("#btn-search").trigger("click");
							$("#modal-delete-kelurahan").modal("hide");
							alertify.success(response.desc);
						}else{
							alertify.error(response.desc);
						}
					},error:function(e){
						alertify.set("notifier","position","top-right");
						$("#btn-delete-close").removeAttr("disabled");
						$("#btn-delete-actions").removeAttr("disabled");
						$("#btn-delete-actions").html("YA, HAPUS");
						alertify.error("Internal Server Error !");
					}
				});
			},2500);
		});
	}

}

