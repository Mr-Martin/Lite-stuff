<div class="well">
  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#accountinfo">Accountinfo</a></li>
    <li><a href="#accountsettings">Accountsettings</a></li>
  </ul>
   
  <div class="tab-content">
    <div class="tab-pane active" id="accountinfo">
      <h3>Accountinfo</h3>
      <div class="progress">
        <div class="bar" style="width: <?php print(number_format($_SESSION['user']['storageused'], 2)); ?>%;"></div>
      </div>

    </div>
    <div class="tab-pane" id="accountsettings">Accountsettings</div>
  </div>
</div>