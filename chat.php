<?php
    if (!isset($_SESSION))
        session_start();
    if (!isset($_COOKIE['iam']))
        setcookie("iam", session_id());
    $filename = md5($_COOKIE['iam'] . "chat" . $_COOKIE['id']) . ".xml";
    
    setcookie('chatfile',md5($_COOKIE['iam'] . "chat" . $_COOKIE['id']) . ".xml");
    if (!file_exists($filename))
        file_put_contents($filename, '<?xml version="1.0"?><messages></messages>');

    $dom = new \DomDocument();
    $dom->load($filename);

    $z = $dom->getElementsByTagName("messages");
    $x = $dom->getElementsByTagName("messages")[0];
    $y = $z->childNodes;
    $i = 0;
    $v = $_GET['a'];
    $n = "";

  $tmp = $dom->createElement("msg");
  $tmp->setAttribute("user", $_COOKIE['iam']);
  $tmpy = $dom->createTextNode($v);
  $tmp->appendChild($tmpy);
   $x->appendChild($tmp);
   $dom->appendChild($x);
   $dom->save($filename);
?>