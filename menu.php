<?php
$menu = '<h3 onclick=menuList(\'menu.php\')>Menu</h3><li><b style="font-size:18px;color:lightgray" onclick="javascript:mapView()">Click to Toggle Map</b><ul onclick=menuList(\'newclient.php\')>Add Store</ul><ul onsubmit=startChat(); onclick=menuList(\'storechat.php\');>Cheri</ul><ul onclick=menuList(\'preorder.php\')>Preorder</ul></li>';

$f = str_replace('"','\'',$menu);
echo json_encode($f);
?>