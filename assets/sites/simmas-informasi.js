SimmasInfo = {
	baseUrl : "",
	limit 	: 10,
	search  : "",
	init:function(){

		self = this;

		$(document).ready(function(){
			$("#btn-add-informasi").on("click",function(event){
				event.preventDefault();
				$("#modal-add-informasi").on("shown.bs.modal",function(){
					$("#target_to").focus();
					$("#target_to").select2({
						tags:true,
						placeholder: "Silahkan pilih target informasi"
					});
					$('#informasi').summernote({
			            height: 200
			        });
				});
				$("#modal-add-informasi").modal("show");
			});
		});
	}
}