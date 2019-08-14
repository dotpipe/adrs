
<?php
$f = ""; //"placeholder='Add a chat user' disabled";
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION['user'])) {
  //  $form = 'onkeypress=cheriWindow("' . $_COOKIE['id'] . '")';
   // $f = str_replace('"',"'",$form);
}
$chat = '<h3 style="color:wine" onclick=menuList("menu.php");>Menu</h3>';
$chat .= '<li><b style="font-size:18px;color:lightgray" onclick="javascript:mapView()">Click to Toggle Map</b></li>';
$chat .= '<table style="border:1px solid black;padding:3px;spacing:0px;width:250px;height:350px">';
$chat .= '<tr><td><b style="font-size:15px;color:red">Cheri with ' . $_COOKIE['contact'] . '</b> : : </td>';
$chat .= '<td><button onclick=\'clearChat();\' style="border-radius:50%;color:green">&check;</button></td></tr>';
$chat .= '<tr><td colspan=2 style="background:white;height:350px;width:250px"><div id="chatwindow" style="overflow-wrap:break-word;overflow-y:scroll;color:black;background:white;height:350px;width:250px">';
$chat .= '&nbsp;</div></td></tr><tr><td colspan=2 style="background:black;"><div id="texter" style="background:black;height:30px;width:250px">';
$chat .= '<input onkeypress="goChat(this,event.keyCode)" style="font-size:24px;border:0px;width:250px;" ' . $f . ' type="text"></div></td></tr></table>';

$g = str_replace('"',"'",$chat);
echo json_encode($g);
?>