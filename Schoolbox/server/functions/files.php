<?php

class CustomDirectoryIterator extends DirectoryIterator{
  public function isInvisible(){
    $fileName = $this->current()->getFilename();
    if (strpos($fileName, '.') === 0){
      return true;
    }
    return false;
  }
}


function ffList($fsBasePath, $relPath){
  $items = array();
  $backPath = null;
  $iterator = new CustomDirectoryIterator($fsBasePath . $relPath);
  foreach ($iterator as $fileinfo) {

      // skip invisible files (any filename beginning with a dot)
      if($fileinfo->isInvisible()){
        continue;
      }

      // skip dotfiles (meaning . and ..)
      /*if $fileinfo->isDot() {
        continue;
      }*/
      
      // is this a file? 
      if(!$fileinfo->isDir()){
        // then we don't want the file name in the path and we must stay in the current dir
        $path = $fileinfo->getPath();
        $fileExtension = $fileinfo->getExtension();
        $fileType = $fileinfo->getType();
      }else{
        // otherwise (if it is a dir) we can go into it
        $path = $fileinfo->getPathname();
        $fileExtension = null;
        $fileType = null;
      }
      $path = str_replace($fsBasePath, '', $path);
      $items[] = array(
        'filename' => $fileinfo->getFilename(), 
        'path' => $path,
        'fileType' => $fileType,
        'fileExtension' => $fileExtension
      );
      // we need to get backPath once      
      if(!$backPath){
        $backPath = str_replace($fsBasePath, '', $fileinfo->getPath());
        $backPath = explode('/', $backPath);
        array_pop($backPath);
        $backPath = implode('/', $backPath);
      }
  }
  return array('items' => $items, 'backPath' => $backPath);
}