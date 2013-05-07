var doc = $(document);

doc.on('click', '#logoutButton', function(){
  ajax('server/functions/user.php?logout', null, html);
});

doc.on('click', '#popLogoutButton', function(){
  ajax('server/functions/user.php?logout', null, html);
});

doc.on('click', '#home', function(){
  check();
});

doc.on('click', '#logo', function(){
  check();
});

doc.on('click', '#settingsButton', function(){
  ajax('server/functions/utils.php?settings', null, page);
});

doc.on('submit', '#createFolder', function(e){
  e.preventDefault();

  var formValues = {
      folderName: $('#folderName').val()
  };
  ajax('server/functions/upload.php?makedir', formValues, check);
});

doc.on('submit', '#uploadForm', function(e){
  e.preventDefault();
  sendFormdataWithAjax('server/functions/upload.php?upload', $(this)[0], check);
});

doc.on('click', '#backbtn', function(){
  ajax('server/functions/utils.php?backdir', null , check);
});

doc.on('dblclick', '#directorylisting > tr > td', function(){
  var parentId = $(this).parent().attr('id');
  if (parentId.indexOf('.') == -1) {
    var formvalues = {
      newDir : parentId
    };
    
    ajax('server/functions/utils.php?updatedir', formvalues , check);
  }
});

doc.on('click', '#loginButton', function(e){
  e.preventDefault();

  var formValues = {
      email: $('#inputEmail').val(),
      password: $('#inputPassword').val()
  };
    
  ajax('server/functions/user.php?login', formValues, check);
});

doc.on('click', '#myTab a', function(e){
  e.preventDefault();
  $(this).tab('show');
})