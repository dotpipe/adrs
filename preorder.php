<?php

$form = '<h3 onclick=menuList(\'menu.php\');>Menu</h3><li><b style="font-size:18px;color:lightgray;" onclick=javascript:mapView()>Click to Toggle Map</b><br><br>';
$form .= '<font style=\'font-size:16;color:red;\'>Preorder Items:</font><br>';
$form .= '<div id="preorders" style="display:table-cell"><input required type="text" name="1" placeholder=\'Item name\'>';
$form .= '<font style="font-size:12px"> Qu: </font><input type="number" style=\'width:24px;\' value=1 min=1 required>';
$form .= '&nbsp;<button style="background:black;border-radius:50%;font-size:18px" onclick="addNewItem()">&times;</button><br></div>';
$form .= '<div style="margin-left:200px;display:table-cell;text-align:right"><button style="background:black;border-radius:50%;font-size:18px" onclick="addNewItem()">+</button></div>';

$f = str_replace('"',"\'",$form);
echo json_encode($form);

?>