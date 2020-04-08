SimmasSystems = {
	baseUrl : "",

	limit 	: 10,
	limitKabupaten : 10,
	limitKecamatan : 5,
	limitKelurahan : 5,

	offset	: 0,
	offsetKabupaten : 0,
	offsetKecamatan : 0,
	offsetKelurahan : 0,

	search 	: "",
	searchKabupaten   : "",
	searchKecamatan	  : "",
	searchKelurahan	  : "", 

	selectizePropinsi : null,
	init:function(){
		self = this;

		$(document).ready(function(){
			///// Prepare set oprtional ////////
			$("#btn-search").on("click",function(){
				self.search = $("#input-search").val();
				parameter = {
					limit	: self.limit,
					offset	: self.offset,
					search 	: self.search
				}
				self.listLocations(parameter);
			});

			$("#btn-kabupaten-search").on("click",function(){
				self.searchKabupaten = $("#kabupaten-search").val();
				propinsi_id = $("#btn-kabupaten-search").attr('data-id');
				parameter = {
					id_propinsi : propinsi_id,
					limit	: self.limitKabupaten,
					search 	: self.searchKabupaten
				}
				self.listKabupaten(escape(JSON.stringify(parameter)));
			});

			$("#btn-kecamatan-search").on("click",function(){
				self.searchKecamatan = $("#kecamatan-search").val();
				kabupaten_id = $("#btn-kecamatan-search").attr('data-id');
				parameter = {
					id_kabupaten : kabupaten_id,
					limit	: self.limitKecamatan,
					search 	: self.searchKecamatan
				}
				self.listKecamatan(escape(JSON.stringify(parameter)));
			});

			$("#btn-kelurahan-search").on("click",function(){
				self.searchKelurahan = $("#kelurahan-search").val();
				kecamatan_id = $("#btn-kelurahan-search").attr('data-id');
				parameter = {
					id_kecamatan : kecamatan_id,
					limit	: self.limitKelurahan,
					search 	: self.searchKelurahan
				}
				console.log(parameter);
				self.listKelurahan(escape(JSON.stringify(parameter)));
			});

			$("#select-propinsi").select2({
				language : "id",
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
		        $("#select-kabupaten").removeAttr("disabled");
		        $(".select-propinsi-error").html("");
		    });

		    $("#select-kabupaten").select2({
				language : "id",
				ajax: {
			    url: self.baseUrl + "sites/systems/requirements/locations/getOfkabupaten",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        keyword: params.term,
			        prop_id: $("#select-propinsi").val()
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
		        $("#select-kecamatan").removeAttr("disabled");
		        $(".select-kabupaten-error").html("");
		    });

			$("#select-kecamatan").select2({
				language : "id",
				ajax: {
			    url: self.baseUrl + "sites/systems/requirements/locations/getOfkecamatan",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        keyword: params.term,
			        kab_id : $("#select-kabupaten").val()
			      };
			    },
			    processResults: function (data,page) {
			      return {
			        results: data
			      };
			    }
			  },
			  placeholder : "Ketik nama kecamatan...."
			}).on('change', function (evt) {
				$(".select-kecamatan-error").html("");
		        $("#kelurahan").removeAttr("disabled");
		        $("#kelurahan").focus();
		        $("#kode-pos").removeAttr("disabled");
		    });

			$("#btn-propinsi").on("click",function(event){
				event.preventDefault();
				$("#modal-propinsi").on("shown.bs.modal",function(){
					$("#propinsi").focus();
				});
				$("#modal-propinsi").modal("show");
			});

			$("#btn-kabupaten").on("click",function(event){
				event.preventDefault();
				$("#modal-kabupaten").on("shown.bs.modal",function(){
					$("#select-kab-prop").focus();
					$("#kabupaten").attr("disabled",true);
				});
				$("#modal-kabupaten").modal("show");
			});

			$("#btn-kecamatan").on("click",function(event){
				event.preventDefault();
				$("#modal-kecamatan").on("shown.bs.modal",function(){
					$("#select-kec-prop").focus();
					$("#select-kec-kab").attr("disabled",true);
					$("#kecamatan").attr("disabled",true);
				});
				$("#modal-kecamatan").modal("show");
			});

			$("#btn-kelurahan").on("click",function(event){
				event.preventDefault();
				$("#modal-kelurahan").on("shown.bs.modal",function(){
					$("#select-propinsi").focus();
					$("#select-kabupaten").attr("disabled",true);
					$("#select-kecamatan").attr("disabled",true);
					$("#kelurahan").attr("disabled",true);
					$("#kode-pos").attr("disabled",true);
				});
				$("#modal-kelurahan").modal("show");
			});

			$("#select-kab-prop").select2({
				language : "id",
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
		        $(".select-prop-error").html("");
		    });

		    $("#select-kec-prop").select2({
				language : "id",
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
		        $("#select-kec-kab").removeAttr("disabled");
		        $(".select-kec-kab-error").html("");
		    });

		    $("#select-kec-kab").select2({
				language : "id",
				ajax: {
			    url: self.baseUrl + "sites/systems/requirements/locations/getOfkabupaten",
			    dataType: 'json',
			    delay: 250,
			    data: function (params) {
			      return {
			        keyword: params.term,
			        prop_id: $("#select-kec-prop").val()
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
		        $(".select-kec-kab-error").html("");
		    });

		    $("#btn-search").trigger("click");

		    $("#input-search").on("keypress",function(evt){
		    	if(evt.which==13){
		    		$("#btn-search").trigger("click");
		    	}
		    });

		    $("#kabupaten-search").on("keypress",function(evt){
		    	if(evt.which==13){
		    		$("#btn-kabupaten-search").trigger("click");
		    	}
		    });

		    $("#kecamatan-search").on("keypress",function(evt){
		    	if(evt.which==13){
		    		$("#btn-kecamatan-search").trigger("click");
		    	}
		    });

		    $("#kelurahan-search").on("keypress",function(evt){
		    	if(evt.which==13){
		    		$("#btn-kelurahan-search").trigger("click");
		    	}
		    });

		    $(document).ajaxComplete(function() {
				$('[data-toggle="tooltip"]').tooltip({trigger : 'hover'});
			});

		});

		$("#form-propinsi").on("submit",function(event){
			event.preventDefault();
			propinsi = $("#propinsi").val();

			error = false;

			if(propinsi!==""){
				pattern = /[!~@#$%^&*()`'";:?.,<>|=+-_/0123456789]/;
				if(pattern.test(propinsi)){
					error = true;
					$(".propinsi-error").html("Maaf, format penulisan nama propinsi salah !");
				}
			}else{
				error = true;
				$(".propinsi-error").html("Silahkan isikan nama propinsi terlebih dahulu !");
			}

			if(!error){
				parameter = {
					propinsi:propinsi
				}
				self.addPropinsi(parameter);
			}
		});

		$("#form-kabupaten").on("submit",function(event){
			event.preventDefault();
			propinsi = $("#select-kab-prop").val();
			kabupaten= $("#kabupaten").val();

			error = false;
			/// VALIDATION RULES PROPINSI ///
			if(propinsi == null || propinsi == "undefined"){
				error = true;
				$(".select-kab-prop-error").html("Silahkan pilih propinsi terlebih dahulu !");
			}else{
				$(".select-kab-prop-error").html("");
			}

			/// VALIDATION RULES KABUPATEN ///
			if(kabupaten!==""){
				pattern = /[!~@#$%^&*()`'";:?.,<>|=+-_/0123456789]/;
				if(pattern.test(kabupaten)){
					error = true;
					$(".kabupaten-error").html("Maaf, format penulisan kabupaten salah !");
				}
			}else{
				error = true;
				$(".kabupaten-error").html("Silahkan isikan bagian nama kabupaten terlebih dahulu !");
			}

			if(!error){
				parameter = {
					propinsi_id:propinsi,
					nm_kabupaten:kabupaten
				}
				self.addKabupaten(parameter);
			}
		});

		$("#form-kecamatan").on("submit",function(event){
			event.preventDefault();
			propinsi = $("#select-kec-prop").val();
			kabupaten= $("#select-kec-kab").val();
			kecamatan= $("#kecamatan").val();

			error = false;
			/// VALIDATION RULES PROPINSI ///
			if(propinsi ==null || propinsi =="undefined"){
				error = true;
				$(".select-kec-prop-error").html("Silahkan pilih propinsi terlebih dahulu !");
			}else{
				$(".select-kec-prop-error").html("");
			}

			if(kabupaten == null || kabupaten == "undefined"){
				error = true;
				$(".select-kec-kab-error").html("Silahkan pilih kabupaten terlebih dahulu !");
			}else{
				$(".select-kec-kab-error").html("");
			}

			/// VALIDATION RULES KABUPATEN ///
			if(kecamatan!==""){
				pattern = /[!~@#$%^&*()`'";:?.,<>|=+-_/0123456789]/;
				if(pattern.test(kecamatan)){
					error = true;
					$(".kecamatan-error").html("Maaf, format penulisan kecamatan salah !");
				}
			}else{
				error = true;
				$(".kecamatan-error").html("Silahkan isikan bagian nama kecamatan terlebih dahulu !");
			}

			if(!error){
				parameter = {
					propinsi_id:propinsi,
					kabupaten_id:kabupaten,
					nm_kecamatan:kecamatan
				}
				self.addKecamatan(parameter);
			}
		});

		$("#form-kelurahan").on("submit",function(event){
			event.preventDefault();

			propinsi = $("#select-propinsi").val();
			kabupaten = $("#select-kabupaten").val();
			kecamatan = $("#select-kecamatan").val();
			kelurahan = $("#kelurahan").val();
			kodepos = $("#kode-pos").val();

			error = false;

			if(propinsi ==null || propinsi =="undefined"){
				error = true;
				$(".select-propinsi-error").html("Silahkan pilih propinsi terlebih dahulu !");
			}else{
				$(".select-propinsi-error").html("");
			}

			if(kabupaten==null || kabupaten =="undefined"){
				error = true;
				$(".select-kabupaten-error").html("Silahkan pilih kabupaten terlebih dahulu !");
			}else{
				$(".select-kabupaten-error").html("");
			}

			if(kecamatan==null || kecamatan =="undefined"){
				error = true;
				$(".select-kecamatan-error").html("Silahkan pilih kecamatan terlebih dahulu !");
			}else{
				$(".select-kecamatan-error").html("");
			}

			if(kelurahan==""){
				error = true;
				$(".kelurahan-error").html("Silahkan isi bagian kelurahan !");
			}else{
				pattern = /[\'^£$%&*}{@#~?><>,|_=+¬-]/;
				if(pattern.test(kelurahan)){
					error = true;
					$(".kelurahan-error").html("Nama kelurahan tidak boleh menggunakan karakter spesial !");
				}else{
					$(".kelurahan-error").html("");
				}
			}

			if(kodepos==""){
				error = true;
				$(".kodepos-error").html("Silahkan isikan kode pos terlebih dahulu !");
			}else{
				pattern = /^[\d]+$/;
				if(!pattern.test(kodepos)){
					error = true;
					$(".kodepos-error").html("Kode pos hanya boleh menggunakan angka !");
				}else{
					$(".kodepos-error").html("");
				}
			}

			if(!error){
				parameter = {
					propinsi : propinsi,
					kabupaten: kabupaten,
					kecamatan: kecamatan,
					kelurahan: kelurahan,
					kodepos  : kodepos
				}
				self.addKelurahan(parameter);
			}
		});
	},

	addPropinsi:function(param){
		self = this;
		$(".propinsi-error").html("");
		$("#submit_propinsi").attr("disabled",true);
		$("#submit_propinsi").html("<i class='fa fas fa-spinner fa-spin'></i> Sedang diproses...");
		$("#close_propinsi").attr("disabled",true);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/addPropinsi",
				cache: false,
				data : {data:JSON.stringify(param)},
				dataType: "JSON",
				success:function(response){
					$("#submit_propinsi").html("Buatkan");
					$("#submit_propinsi").removeAttr("disabled");
					$("#close_propinsi").removeAttr("disabled");
					alertify.set("notifier","position","top-right");
					if(response.status=="SUCCESS"){
						document.getElementById("form-propinsi").reset();
						alertify.success(response.desc);
						$("#modal-propinsi").modal("hide");
					}else{
						alertify.error(response.desc);
					}
				},error:function(){
					alertify.set("notifier","position","top-right");
					$("#submit_propinsi").removeAttr("disabled");
					$("#close_propinsi").removeAttr("disabled");
					$("#submit_propinsi").html("Buatkan");
					alertify.error("Internal Server Error");
				}
			});
		},500);
	},

	addKabupaten:function(param){
		self = this;
		$(".select-kab-prop-error").html("");
		$(".kabupaten-error").html("");
		$("#submit_kabupaten").attr("disabled",true);
		$("#submit_kabupaten").html("<i class='fa fas fa-spinner fa-spin'></i> Sedang diproses...");
		$("#close_kabupaten").attr("disabled",true);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/addKabupaten",
				cache: false,
				data : {data:JSON.stringify(param)},
				dataType: "json",
				success:function(response){
					$("#submit_kabupaten").html("Buatkan");
					$("#submit_kabupaten").removeAttr("disabled");
					$("#close_kabupaten").removeAttr("disabled");
					alertify.set("notifier","position","top-right");
					if(response.status=="SUCCESS"){
						document.getElementById("form-kabupaten").reset();
						$("#modal-kabupaten").modal("hide");
						alertify.success(response.desc);
					}else{
						alertify.error(response.desc);
					}
				},error:function(){
					alertify.set("notifier","position","top-right");
					$("#submit_kabupaten").removeAttr("disabled");
					$("#close_kabupaten").removeAttr("disabled");
					$("#submit_kabupaten").html("Buatkan");
					alertify.error("Internal Server Error");
				}
			});
		},500);
	},

	addKecamatan:function(param){
		self = this;
		$(".select-kec-prop-error").html("");
		$(".select-kec-kab-error").html("");
		$(".kecamatan-error").html("");
		$("#submit_kecamatan").attr("disabled",true);
		$("#submit_kecamatan").html("<i class='fa fas fa-spinner fa-spin'></i> Sedang diproses...");
		$("#close_kecamatan").attr("disabled",true);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/addKecamatan",
				cache: false,
				data : {data:JSON.stringify(param)},
				dataType: "json",
				success:function(response){
					$("#submit_kecamatan").html("Buatkan");
					$("#submit_kecamatan").removeAttr("disabled");
					$("#close_kecamatan").removeAttr("disabled");
					alertify.set("notifier","position","top-right");
					if(response.status=="SUCCESS"){
						document.getElementById("form-kecamatan").reset();
						$("#modal-kecamatan").modal("hide");
						alertify.success(response.desc);
					}else{
						alertify.error(response.desc);
					}
				},error:function(){
					alertify.set("notifier","position","top-right");
					$("#submit_kecamatan").removeAttr("disabled");
					$("#close_kecamatan").removeAttr("disabled");
					$("#submit_kecamatan").html("Buatkan");
					alertify.error("Internal Server Error");
				}
			});
		},500);
	},

	addKelurahan:function(param){
		self = this;
		$("#btn-add-kelurahan").attr("disabled",true);
		$("#btn-close-kelurahan").attr("disabled",true);
		$("#btn-add-kelurahan").html("<i class='fa fas fa-spinner fa-spin'></i> Sedang diproses...");
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/addKelurahan",
				cache: false,
				data : {data:JSON.stringify(param)},
				success:function(response){
					$("#btn-add-kelurahan").html("Buatkan");
					$("#btn-add-kelurahan").removeAttr("disabled");
					$("#btn-close-kelurahan").removeAttr("disabled");
					alertify.set("notifier","position","top-right");
					if(response.status=="SUCCESS"){
						alertify.success(response.desc);
						document.getElementById("form-kelurahan").reset();
						setTimeout(function(){
							$("#select-propinsi").val("");
							$("#select-kabupaten").val("");
							$("#select-kecamatan").val("");
							$("#modal-kelurahan").modal("hide");
						},500);
					}else{
						alertify.error(response.desc);
					}
				},error:function(){
					$("#btn-add-kelurahan").html("Buatkan");
					$("#btn-add-kelurahan").removeAttr("disabled");
					$("#btn-close-kelurahan").removeAttr("disabled");
					alertify.set("notifier","position","top-right");
				}
			});
		},500);
	},

	listLocations:function(param){
		tableContent  = '<tr class="text-center"><td colspan="6" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>'; 
		$("#load-locations").html(tableContent);
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/listLocations",
				cache: false,
				data : {sendParam:JSON.stringify(param)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						tableContent = "";
						$.each(response.data,function(key,data){
							no = key+1;
							html_view_btn  = '<button class="btn btn-info btn-xs" title="List Kabupaten" data-placement="top" onclick=\'SimmasSystems.viewKabupaten(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i> List Kabupaten</button>';
							html_del_btn = '<button class="btn btn-danger btn-xs" onclick=\'SimmasSystems.deletePropinsi(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i> Hapus</button>';
							tableContent += '<tr>';
							tableContent += '<td class="text-center">'+no+'</td>';
							tableContent += '<td>'+data.nm_propinsi+'</td>';
							if(data.total_kabupaten==0){
								total_kabupaten = '<i class="text-danger">Belum ada list kabupaten yang di inputkan !</i>';
							}else{
								total_kabupaten = '<i class="text-success">Total ada '+data.total_kabupaten+' kabupaten yang teindeks !</i>';
							}
							tableContent += '<td>'+total_kabupaten+'</td>';
							tableContent += '<td class="text-center">'+html_view_btn+html_del_btn+'</td>';
							tableContent += '</tr>';
						});
						$("#load-locations").html(tableContent);
					}else{
						tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
						tableContent += '<i class="fa fa-warning"></i> '+response.desc;
						tableContent += '</td></tr>'; 
						$("#load-locations").html(tableContent);
					}
				},error:function(){
					tableContent  = '<tr class="text-center"><td colspan="6" class="text-danger">';
					tableContent += '<i class="fa fa-exclamation-circle"> Internal Server Error !</i> ';
					tableContent += '</td></tr>'; 
					$("#load-locations").html(tableContent);
				}
			});
		},1000);
	},

	viewKabupaten:function(param){
		self  = this;
		param = JSON.parse(unescape(param));
		
		parameter = {
			propinsi_id:param.id_propinsi,
			search: self.searchKabupaten,
			limit : self.limitKabupaten
		}

		tableContent  = '<tr class="text-center"><td colspan="4" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>';
		$("#load-kabupaten").html(tableContent);

		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/listKabupaten",
				data : {sendParam:JSON.stringify(parameter)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						$("#modal-view-kabupaten").on("shown.bs.modal",function(){
							$(".title-propinsi").text(param.nm_propinsi);
							$("#btn-kabupaten-search").attr("data-id",param.id_propinsi);
							tableContent = "";
							$.each(response.data,function(key,data){
								no = key+1;
								html_view_btn  = '<button class="btn btn-info btn-xs" onclick=\'SimmasSystems.viewKecamatan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
								html_del_btn = '<button class="btn btn-danger btn-xs" onclick=\'SimmasSystems.deleteKabupaten(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
								tableContent += '<tr>';
								tableContent += '<td class="text-center">'+no+'</td>';
								tableContent += '<td>'+data.nm_kabupaten+'</td>';
								if(data.total_kecamatan==0){
									total_kecamatan = '<i class="text-danger">Belum ada list kecamatan yang di inputkan !</i>';
								}else{
									total_kecamatan = '<i class="text-success">Total ada '+data.total_kecamatan+' kecamatan yang teindeks !</i>';
								}
								tableContent += '<td>'+total_kecamatan+'</td>';
								tableContent += '<td class="text-center">'+html_view_btn+html_del_btn+'</td>';
								tableContent += '</tr>';
							});
							$("#load-kabupaten").html(tableContent);
						});
						$("#modal-view-kabupaten").modal("show");
					}else{
						alertify.set("notifier","position","top-right");
						alertify.error("<i class='fa fa-exclamation-triangle'></i> "+response.desc);
					}
				},error:function(e){
					alertify.set("notifier","position","top-right");
					alertify.error("<i class='fa fa-exclamation-triangle'></i> Internal Server Error !");
				}
			});
		},1000);
	},

	listKabupaten:function(param){
		self  = this;
		param = JSON.parse(unescape(param));
		
		parameter = {
			propinsi_id:param.id_propinsi,
			search: self.searchKabupaten,
			limit : self.limitKabupaten
		}

		tableContent  = '<tr class="text-center"><td colspan="4" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>';
		$("#load-kabupaten").html(tableContent);

		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/listKabupaten",
				data : {sendParam:JSON.stringify(parameter)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						$(".title-propinsi").text(param.nm_propinsi);
						$("#btn-kabupaten-search").attr("data-id",param.id_propinsi);
						tableContent = "";
						$.each(response.data,function(key,data){
							no = key+1;
							html_view_btn  = '<button class="btn btn-info btn-xs" onclick=\'SimmasSystems.viewKecamatan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
							html_del_btn = '<button class="btn btn-danger btn-xs" onclick=\'SimmasSystems.deleteKabupaten(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
							tableContent += '<tr>';
							tableContent += '<td class="text-center">'+no+'</td>';
							tableContent += '<td>'+data.nm_kabupaten+'</td>';
							if(data.total_kecamatan==0){
								total_kecamatan = '<i class="text-danger">Belum ada list kecamatan yang di inputkan !</i>';
							}else{
								total_kecamatan = '<i class="text-success">Total ada '+data.total_kecamatan+' kecamatan yang teindeks !</i>';
							}
							tableContent += '<td>'+total_kecamatan+'</td>';
							tableContent += '<td class="text-center">'+html_view_btn+html_del_btn+'</td>';
							tableContent += '</tr>';
						});
						$("#load-kabupaten").html(tableContent);
					}else{
						tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
						tableContent += '<i class="fa fa-exclamation-circle"></i> '+response.desc;
						tableContent += '</td></tr>';
						$("#load-kabupaten").html(tableContent);
					}
				},error:function(e){
					alertify.set("notifier","position","top-right");
					alertify.error("<i class='fa fa-exclamation-triangle'></i> Internal Server Error !");
				}
			});
		},1000);
	},

	deleteKabupaten:function(param){

	},

	viewKecamatan:function(param){
		self = this;
		param = JSON.parse(unescape(param));
		
		parameter = {
			kabupaten_id:param.id_kabupaten,
			search: self.searchKecamatan,
			limit : self.limitKecamatan
		}

		tableContent  = '<tr class="text-center"><td colspan="4" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>';
		$("#load-kecamatan").html(tableContent);

		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/listKecamatan",
				data : {sendParam:JSON.stringify(parameter)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						$("#modal-view-kabupaten").modal("hide");
						$("#modal-view-kecamatan").on("shown.bs.modal",function(){
							$(".title-kabupaten").text(param.nm_kabupaten.toUpperCase());
							$("#btn-kecamatan-search").attr("data-id",param.id_kabupaten);
							tableContent = "";
							$.each(response.data,function(key,data){
								no = key+1;
								html_view_btn  = '<button class="btn btn-info btn-xs" onclick=\'SimmasSystems.viewKelurahan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
								html_del_btn   = '<button class="btn btn-danger btn-xs" onclick=\'SimmasSystems.deleteKecamatan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
								tableContent += '<tr>';
								tableContent += '<td class="text-center">'+no+'</td>';
								tableContent += '<td>'+data.nm_kecamatan+'</td>';
								if(data.total_kelurahan==0){
									total_kelurahan = '<i class="text-danger">Belum ada list kelurahan yang di inputkan !</i>';
								}else{
									total_kelurahan = '<i class="text-success">Total ada '+data.total_kelurahan+' kelurahan yang teindeks !</i>';
								}
								tableContent += '<td>'+total_kelurahan+'</td>';
								tableContent += '<td class="text-center">'+html_view_btn+html_del_btn+'</td>';
								tableContent += '</tr>';
							});
							$("#load-kecamatan").html(tableContent);
						});
						$("#modal-view-kecamatan").modal("show");
					}else{
						tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
						tableContent += '<i class="fa fa-exclamation-circle">'+response.desc+'</i> ';
						tableContent += '</td></tr>';
						$("#load-kecamatan").html(tableContent);
					}
				},error:function(e){
					tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
					tableContent += '<i class="fa fa-exclamation-circle"></i> Internal Server Error !';
					tableContent += '</td></tr>';
					$("#load-kecamatan").html(tableContent);
				}
			});
		},500);
	},

	listKecamatan:function(param){
		self = this;
		param = JSON.parse(unescape(param));
		
		parameter = {
			kabupaten_id:param.id_kabupaten,
			search: self.searchKecamatan,
			limit : self.limitKecamatan
		}

		tableContent  = '<tr class="text-center"><td colspan="4" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>';
		$("#load-kecamatan").html(tableContent);

		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/listKecamatan",
				data : {sendParam:JSON.stringify(parameter)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						$(".title-kabupaten").text(param.nm_kabupaten);
						$("#btn-kecamatan-search").attr("data-id",param.id_kabupaten);
						tableContent = "";
						$.each(response.data,function(key,data){
							no = key+1;
							html_view_btn  = '<button class="btn btn-info btn-xs" onclick=\'SimmasSystems.viewKelurahan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
							html_del_btn   = '<button class="btn btn-danger btn-xs" onclick=\'SimmasSystems.deleteKecamatan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
							tableContent += '<tr>';
							tableContent += '<td class="text-center">'+no+'</td>';
							tableContent += '<td>'+data.nm_kecamatan+'</td>';
							if(data.total_kelurahan==0){
								total_kelurahan = '<i class="text-danger">Belum ada list kelurahan yang di inputkan !</i>';
							}else{
								total_kelurahan = '<i class="text-success">Total ada '+data.total_kelurahan+' kelurahan yang teindeks !</i>';
							}
							tableContent += '<td>'+total_kelurahan+'</td>';
							tableContent += '<td class="text-center">'+html_view_btn+html_del_btn+'</td>';
							tableContent += '</tr>';
						});
						$("#load-kecamatan").html(tableContent);
					}else{
						tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
						tableContent += '<i class="fa fa-exclamation-circle">'+response.desc+'</i> ';
						tableContent += '</td></tr>';
						$("#load-kecamatan").html(tableContent);
					}
				},error:function(e){
					tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
					tableContent += '<i class="fa fa-exclamation-circle"></i> Internal Server Error !';
					tableContent += '</td></tr>';
					$("#load-kecamatan").html(tableContent);
				}
			});
		},500);
	},

	deletePropinsi:function(param){
		self = this;
		param = JSON.parse(unescape(param));
		param = {
			propinsi_id:param.id_propinsi
		}
		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "",
				data : {sendParam:JSON.stringify(param)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						$("#modal-view-kabupaten").on("shown.bs.modal",function(){

						});
						$("#modal-view-kabupaten").modal("show");
					}else{
						alertify.error(response.desc);
					}
				},error:function(e){
					alertify.set("notifier","position","top-right");
					alertify.error("<i class='fa fa-exclamation-triangle'></i> Internal Server Error !");
				}
			});
		},500);
	},

	viewKelurahan:function(param){
		self = this;
		param = JSON.parse(unescape(param));
		
		parameter = {
			kecamatan_id:param.id_kecamatan,
			search: self.searchKelurahan,
			limit : self.limitKelurahan
		}

		tableContent  = '<tr class="text-center"><td colspan="5" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>';
		$("#load-kelurahan").html(tableContent);

		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/listKelurahan",
				data : {sendParam:JSON.stringify(parameter)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						$("#modal-view-kecamatan").modal("hide");
						$("#modal-view-kelurahan").on("shown.bs.modal",function(){
							$(".title-kecamatan").text(param.nm_kecamatan.toUpperCase());
							$("#btn-kelurahan-search").attr("data-id",param.id_kecamatan);
							tableContent = "";
							$.each(response.data,function(key,data){
								no = key+1;
								html_view_btn  = '<button class="btn btn-info btn-xs" onclick=\'SimmasSystems.viewKelurahan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
								html_edit_btn  = '<button class="btn btn-success btn-xs" onclick=\'SimmasSystems.editKelurahan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-pencil-alt"></i></button>';
								html_del_btn   = '<button class="btn btn-danger btn-xs" onclick=\'SimmasSystems.deleteKecamatan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
								tableContent += '<tr>';
								tableContent += '<td class="text-center">'+no+'</td>';
								tableContent += '<td>'+data.nm_kelurahan+'</td>';

								if(
									typeof data.nm_kades =="undefined" || data.nm_kades == null &&
									data.email == "undefined" || data.email == null &&
									data.telepon == "undefined" || data.telepon == null &&
									data.alamat == "undefined" || data.alamat == null
								){
									nm_kades = "<span class='text-danger'>Desa ini belum terdaftar di simmas sistem !</span>";
									email 	 = "<span class='text-danger text-center'>---X---</span>";
									html_btn = "<span class='text-danger'>---X---</span>"
								}else{
									nm_kades = data.nm_kades;
									email	 = data.email;
									html_btn = html_view_btn+html_edit_btn+html_del_btn;
								}

								tableContent += '<td>'+nm_kades+'</td>';
								tableContent += '<td class="text-center">'+email+'</td>';
								tableContent += '<td class="text-center">'+html_btn+'</td>';
								tableContent += '</tr>';
							});
							$("#load-kelurahan").html(tableContent);
						});
						$("#modal-view-kelurahan").modal("show");
					}else{
						tableContent  = '<tr class="text-center"><td colspan="5" class="text-danger">';
						tableContent += '<i class="fa fa-exclamation-circle">'+response.desc+'</i> ';
						tableContent += '</td></tr>';
						$("#load-kelurahan").html(tableContent);
					}
				},error:function(e){
					tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
					tableContent += '<i class="fa fa-exclamation-circle"></i> Internal Server Error !';
					tableContent += '</td></tr>';
					$("#load-kelurahan").html(tableContent);
				}
			});
		},500);
	},

	listKelurahan:function(param){
		self = this;
		param = JSON.parse(unescape(param));
		
		parameter = {
			kecamatan_id:param.id_kecamatan,
			search: self.searchKelurahan,
			limit : self.limitKelurahan
		}

		tableContent  = '<tr class="text-center"><td colspan="5" class="text-primary">';
		tableContent += '<i class="fa fas fa-spinner fa-spin"></i> Mohon tunggu sebentar, data sedang diproses..!';
		tableContent += '</td></tr>';
		$("#load-kelurahan").html(tableContent);

		setTimeout(function(){
			$.ajax({
				type : "GET",
				url  : self.baseUrl + "sites/systems/requirements/Locations/listKelurahan",
				data : {sendParam:JSON.stringify(parameter)},
				dataType : "JSON",
				success:function(response){
					if(response.status=="SUCCESS"){
						$(".title-kecamatan").text(param.nm_kecamatan);
						$("#btn-kelurahan-search").attr("data-id",param.id_kecamatan);
						tableContent = "";
						$.each(response.data,function(key,data){
							no = key+1;
							html_view_btn  = '<button class="btn btn-info btn-xs" onclick=\'SimmasSystems.viewKelurahan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-list"></i></button>';
							html_edit_btn  = '<button class="btn btn-success btn-xs" onclick=\'SimmasSystems.editKelurahan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-pencil-alt"></i></button>';
							html_del_btn   = '<button class="btn btn-danger btn-xs" onclick=\'SimmasSystems.deleteKecamatan(\"'+escape(JSON.stringify(data))+'\")\'><i class="fa fa-trash"></i></button>';
							tableContent += '<tr>';
							tableContent += '<td class="text-center">'+no+'</td>';
							tableContent += '<td>'+data.nm_kelurahan+'</td>';

							if(
								typeof data.nm_kades =="undefined" || data.nm_kades == null &&
								data.email == "undefined" || data.email == null &&
								data.telepon == "undefined" || data.telepon == null &&
								data.alamat == "undefined" || data.alamat == null
							){
								nm_kades = "<span class='text-danger'>Desa ini belum terdaftar di simmas sistem !</span>";
								email 	 = "<span class='text-danger text-center'>---X---</span>";
								html_btn = "<span class='text-danger'>---X---</span>"
							}else{
								nm_kades = data.nm_kades;
								email	 = data.email;
								html_btn = html_view_btn+html_edit_btn+html_del_btn;
							}

							tableContent += '<td>'+nm_kades+'</td>';
							tableContent += '<td class="text-center">'+email+'</td>';
							tableContent += '<td class="text-center">'+html_btn+'</td>';
							tableContent += '</tr>';
						});
						$("#load-kelurahan").html(tableContent);
					}else{
						tableContent  = '<tr class="text-center"><td colspan="5" class="text-danger">';
						tableContent += '<i class="fa fa-exclamation-circle">'+response.desc+'</i> ';
						tableContent += '</td></tr>';
						$("#load-kelurahan").html(tableContent);
					}
				},error:function(e){
					tableContent  = '<tr class="text-center"><td colspan="4" class="text-danger">';
					tableContent += '<i class="fa fa-exclamation-circle"></i> Internal Server Error !';
					tableContent += '</td></tr>';
					$("#load-kelurahan").html(tableContent);
				}
			});
		},500);
	},

	editKelurahan:function(param){

	},

	deleteKelurahan:function(param){

	}

}

