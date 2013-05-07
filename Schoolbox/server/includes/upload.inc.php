<?php
function uploadForm($path){
  return dressTemplate('uploadForm', array('path' => $path));
}

function uploadFile($fullPath){
  $fileName = basename($_FILES['uploaded']['name']);
  $destFilePath = $fullPath . '/' . $fileName;
  $destFilePath = str_replace('//', '/', $destFilePath);
  if($result = move_uploaded_file($_FILES['uploaded']['tmp_name'], $destFilePath)){
    return($fileName);
  }
  return false;
}