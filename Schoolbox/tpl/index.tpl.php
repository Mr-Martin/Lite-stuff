<!-- Signupsuccess
================================================== -->
<?php
if(isset($_SESSION['signup'])){?>
  <div id="signupsuccess" style="position: relative; top:0; z-index: 1500;">
    <div class="alert alert-block alert-success"><?php print($_SESSION['signup']); ?></div>
  </div>
<?php };?>
<!-- NAVBAR
================================================== -->
<div class="navbar-wrapper">
  <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
  <div class="container">

    <div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <!-- Responsive Navbar Mobile -->
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="brand" id="logo" style="cursor:pointer"><img src="css/img/logo.png" style="height: 20px;" /></div>

        <!-- Responsive Navbar Web -->
        <div class="nav-collapse collapse">
          <ul class="nav">
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>

          <ul class="nav header-menu pull-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign in <b class="caret"></b></a>
              <ul class="dropdown-menu">
                              
              <form class="dropdown-form">
                <input type="text" class="input-block-level" id="inputEmail" placeholder="Email address">
                <input type="password" class="input-block-level" id="inputPassword" placeholder="Password">
                <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                </label>
                <button class="btn btn-primary" id="loginButton">Sign in</button>
                <button class="btn btn-link" id="forgotButton">Forgot password?</button>
              </form>
            </ul>
          </li>
          </ul>

        </div><!--/.nav-collapse -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->
  </div> <!-- /.container -->
</div><!-- /.navbar-wrapper -->

<!-- CONTENT
================================================== -->
  <div id="myCarousel" class="carousel slide">
  <div class="carousel-inner">
    <div class="item active">
      <img src="css/img/slide1.jpg" alt="En slidebild">
      <div class="container">
        <div class="carousel-caption">
          <h1>Welcome to Schoolbox.</h1>
          <p class="lead">Schoolbox is a free service that lets you bring your files, docs and foldes anywhere and share them easily.</p>
          <a href="#myModal" role="button" class="btn btn-info btn-large" data-toggle="modal">Sign up</a> 
       </div>
      </div>
    </div>
  </div>
 </div>

<!-- FOOTER
================================================== -->
<div class="container">
<footer>
  <p>&copy; 2013 SchoolBox &middot; <a href="#terms">Privacy & Terms</a></p>
</footer>

</div><!-- /.container -->

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