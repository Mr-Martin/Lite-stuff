
function ajax(url, formValues, callback){
	$.ajax({
		url: url,
		dataType: 'json',
		data: formValues,
		method: 'POST',
		success: function(data) {
			callback(data);
			console.log(data);
		}
	});
}
function sendFormdataWithAjax(url, domForm, callback){
		$.ajax({
	    url: url,
	    data:new FormData(domForm),
	    contentType: false,
	    processData: false,
	    type: 'POST',
	    success: function(data){
	    	callback(data);
	    }
	});
}


function html(data, callback){
	$('body').html(data.html);
	callback && callback(data);
}
function page(data){
	$('.row-fluid').html(data.html);
}
function directorylisting(data){
	$('#directorylisting').append(data.htmlDir);
}

function check(){
	return ajax('server/functions/user.php?check', null,  
		function(d){
			html(d, 
				function(d){
					directorylisting(d);
				});
		});
}

$(function(){
	check();
});

