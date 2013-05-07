<style type="text/css">
      body {
        background: #fff!important;
        padding-bottom: 40px;
      }
      .alert{
        margin-top:100px;
      }
    </style>

<div class="navbar-wrapper">
  <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
  <div class="container">

    <div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <div class="brand" id="logo" style="cursor:pointer"><img src="css/img/logo.png" style="height: 20px;" /></div>

      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->
  </div> <!-- /.container -->
</div><!-- /.navbar-wrapper -->
<div class="container">

      <div class="alert alert-block alert-error">
        <div style="text-align:center"><h1>You're blocked!</h1>
         <h4>Welcome back at <?php print $_SESSION['user']['active']; ?></h4>
        </div>
      </div>

    </div> <!-- /container -->