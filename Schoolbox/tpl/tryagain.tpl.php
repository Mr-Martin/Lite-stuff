<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-login {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .alert {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-login .form-login-heading,
      .form-login .checkbox {
        margin-bottom: 10px;
      }
      .form-login input[type="text"],
      .form-login input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      h3 {
        margin-top: 0px;
      }
    </style>
<div class="container">

  <div class="alert alert-block">
    
    <h3>Oops!</h3>
    That's not right, try again!<br />Or  <a href="#myModal" role="button" data-toggle="modal">Sign up</a> for an account.
  </div>
  <form class="form-login">
    <h2 class="form-login-heading">Try again</h2>
    <input type="text" class="input-block-level" id="inputEmail" placeholder="Email address">
    <input type="password" class="input-block-level" id="inputPassword" placeholder="Password">
    <label class="checkbox">
      <input type="checkbox" value="remember-me"> Remember me
    </label>
    <button class="btn btn-large btn-success" id="loginButton">Sign in</button>
  </form>

</div> <!-- /container -->
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Sign up for Schoolbox</h3>
  </div>
  <div class="modal-body">
    <form class="form-signin">
      <div class="control-group">
        <label class="control-label" for="inputFirstname">Firstname</label>
        <div class="controls">
          <input type="text" rel="tooltip" class="input-block-level" data-toggle="tooltip" data-placement="bottom" title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." id="firstname" placeholder="Firstname">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputLastname">Lastname</label>
        <div class="controls">
          <input type="text" rel="tooltip" class="input-block-level" data-toggle="tooltip" data-placement="top" title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." id="lastname" placeholder="Lastname">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputEmail">Email</label>
        <div class="controls">
          <input type="text" rel="tooltip" class="input-block-level" data-toggle="tooltip" data-placement="top" title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." id="email" placeholder="Email">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputSchoolname">Schoolname</label>
        <div class="controls">
          <input type="text" rel="tooltip" class="input-block-level" data-toggle="tooltip" data-placement="top" title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." id="schoolname" placeholder="Schoolname">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
          <input type="password" rel="tooltip" class="alla input-block-level" data-toggle="tooltip" data-placement="top" title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." id="password" placeholder="Password">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">Confirm Password</label>
        <div class="controls">
          <input type="password" rel="tooltip" class="alla input-block-level" data-toggle="tooltip" data-placement="top" title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." id="confirmpassword" placeholder="Confirm password">
        </div>
      </div>
    </form>
  </div>

  <div class="modal-footer">
    <button class="btn btn-success" id="signupButton">Sign up!</button>
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
  </div>
</div>

<script>
$('#loginButton').click(function(e){
    e.preventDefault();

    var formValues = {
        email: $('#inputEmail').val(),
        password: $('#inputPassword').val()
    };
      
    ajax('server/functions/user.php?login', formValues, check);
  });
$('#signupButton').click(function(e){
    e.preventDefault();

    if($('#password').val() === $('#confirmpassword').val()){
       var formValues = {
        firstname: $('#firstname').val(),
        lastname: $('#lastname').val(),
        email: $('#email').val(),
        schoolname: $('#schoolname').val(),
        password: $('#password').val()
    };
  } else{
    console.log('Not ok');
  }
    ajax('server/functions/user.php?register', formValues, check);

  });
</script>