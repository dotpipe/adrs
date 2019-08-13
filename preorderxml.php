<?php
    $filename = md5($_SESSION['iam'] . $_COOKIE['id']) . ".xml";
    if (!file_exists($filename))
        file_put_contents($filename, '<?xml version="1.0"?><preorder></preorder>');
    $xml = simplexml_load_file($filename);

    $dom = new \DomDocument();
    $dom->load($filename);

    $z = $dom->getElementsByTagName("preorder");
    $x = $dom->getElementsByTagName("preorder")[0];
    $y = $z->childNodes;
    foreach ($_POST as $x) {
        $tmp = $dom->createElement("item");
        foreach ($x as $k=>$v) {
          $tmp->setAttribute($k,$v);
        }
        $x->appendChild($tmp);
        $dom->appendChild($x);
        $dom->save($filename);
    }
header("Location: ./");
?>