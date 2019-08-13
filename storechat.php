
<?php
$f = "placeholder='Add a chat user' disabled";
if (isset($_SESSION['user'])) {
    $form = 'onkeypress=cheriWindow("' . $_SESSION['user'] . '")';
    $f = str_replace('"',"'",$form);
}
$chat = '<h3 style="color:wine" onclick=menuList("menu.php");>Menu</h3><li><b style="font-size:18px;color:lightgray" onclick="javascript:mapView()">Click to Toggle Map</b></li><b style="font-size:15px;color:red">Cheri</b><table style="border:1px solid black;padding:3px;spacing:0px;width:250px;height:350px"><tr><td style="background:white;height:350px;width:250px"><div id="chatwindow" style="background:white;height:350px;width:250px">&nbsp;</div></td></tr><tr><td style="background:black;"><div id="texter" style="background:black;height:30px;width:250px"><input style="font-size:24px;border:0px;width:250px;" ' . $f . ' type="text"></div></td></tr></table>';

$g = str_replace('"',"'",$chat);
echo json_encode($g);

?>