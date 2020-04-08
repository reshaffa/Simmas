function msg_box(namespace,type,message){
	switch(type){
		case "success" :
			html_alert = '<div class="alert alert-success" style="border-radius:0;margin-top:15px">'+message+'</div>';
		break;
		case "error" :
			html_alert = '<div class="alert alert-danger" style="border-radius:0;margin-top:15px">'+message+'</div>';
		break;
		default:
			html_alert = '<div class="alert alert-info" style="border-radius:0;margin-top:15px">'+message+'</div>';
		break;
	}
	$("#"+namespace).html(html_alert);
	setTimeout(function(){
		$("#"+namespace).html("");
	},2500);
}