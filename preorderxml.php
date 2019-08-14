<?php
    $filename = md5($_SESSION['iam'] . $_COOKIE['id']) . ".xml";
    if (!file_exists($filename))
        file_put_contents($filename, '<?xml version="1.0"?><preorder></preorder>');

    $dom = new \DomDocument();
    $dom->load($filename);

    $z = $dom->getElementsByTagName("preorder");
    $x = $dom->getElementsByTagName("preorder")[0];
    $y = $z->childNodes;
    $i = 0;
    $a = $_GET['a'];
    $b = $_GET['b'];
    for ($i = 0 ; $i < count($z) ; $i++) {
        $a .= "," . $z[$i]->getAttribute("name");
        $b .= "," . $z[$i]->getAttribute("quantity");
    //    echo json_encode(".");
    }
    $varA = str_getcsv($a,",");
    $varB = str_getcsv($b,",");
    foreach ($varA as $v) {
        if ($v == null) {
            $i++;
            continue;
        }
        $tmp[] = $dom->createElement("item");
        $tmp[count($tmp)-1]->setAttribute("name",$v);
        $tmp[count($tmp)-1]->setAttribute("quantity",$varB[$i]);
        $i++;
    }
    foreach ($tmp as $v) {
        $x->appendChild($v);
    }
    $dom->appendChild($x);
    $dom->save($filename);
?>