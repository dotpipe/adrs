<?php
if (!isset($_SESSION))
    session_start();
setcookie('myid', session_id());

  $xml = simplexml_load_file(md5($_COOKIE['myid']) . '.xml') or die(file_put_contents(md5($_COOKIE['myid']) . '.xml', '<?xml version=\'1.0\'?><accounts></accounts>'));

  $list = $xml->link;
  $arr = [];
  foreach ($_POST as $k=>$v) {
	$arr[$k] = $v;
  }
  for ($i = 0; $i < count($list); $i++) {
	if ($list[$i]['no'] == $arr['no']) {
		return;
	}
  }

  $dom = new \DomDocument();
  $dom->load(md5($_COOKIE['myid']) . '.xml');

  $z = $dom->getElementsByTagName('accounts');
  $x = $dom->getElementsByTagName('accounts')[0];

  $tmp = $dom->createElement('link');

  foreach ($_POST as $k=>$v) {
    $tmp->setAttribute($k,$v);
  }
   $x->appendChild($tmp);
   $dom->appendChild($x);
   $dom->save(md5($_COOKIE['myid']) . '.xml');
   header("Location: ./");
?>