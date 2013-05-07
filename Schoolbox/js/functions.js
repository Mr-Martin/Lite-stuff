$(document).ready(function(){

	$('#logoutButton').on(function(){
	    ajax('server/functions/user.php?logout', null, html);
	  });
	$('#logo').on(function(){
	    ajax('server/functions/user.php?check', null, html);
	  });

	$(document).ready(function(){
	  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	});

	$('#loginButton').on(function(e){
	    e.preventDefault();

	    var formValues = {
	        email: $('#inputEmail').val(),
	        password: $('#inputPassword').val()
	    };
	      
	    ajax('server/functions/user.php?login', formValues, html);
	  });
});