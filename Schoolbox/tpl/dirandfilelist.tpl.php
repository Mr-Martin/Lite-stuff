<?php

foreach ($items as $item) {
$fileext = ($item['fileType'] == 'file') ? $item['filename']:'';
$fileimage = ($fileext == '') ? 'folder':'file';
  print('
    <tr id="' . $item['filename'] . '" style="cursor : pointer;">
      <td><img src="css/img/icons/' . $fileimage . '.png"></td>
      <td>' . $item['filename'] . '</td>
      <td>' . $item['fileExtension'] . '</td>
      <td>12</td>
      <td>2013-12-12</td>
    </tr>
    ');
  }
?>