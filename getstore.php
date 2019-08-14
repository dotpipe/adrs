<?php
$x = urldecode($_GET['a']);
$y = str_getcsv($x, ", ");
$conn = mysqli_connect("localhost","root","","adrs");
$z = [];
if (mysqli_connect_errno()) {
    exit();
}
for ($i = 0 ; $i < count($y) ; $i++)
    $z[] = trim($y[$i]);

$results = "";
//$z[0] = str_replace($z[0], "'", " ");
if (count($z) == 6)
    $results = $conn->query("SELECT store_uniq, store_name, store_no, store_creditor, address, city, state, zip, country FROM ad_revs WHERE store_name like \"" . $z[0] . "\" AND address like \"" . $z[1] .  " " . $z[2] . "\" AND city like \"" . $z[3] . "\" AND state like \"" . $z[4] . "\"") or die(mysqli_error());
else if (count($z) == 5)
    $results = $conn->query("SELECT store_uniq, store_name, store_no, store_creditor, address, city, state, zip, country FROM ad_revs WHERE store_name like \"" . $z[0] . "\" AND address like \"" . $z[1] . "\" AND city like \"" . $z[2] . "\" AND state like \"" . $z[3] . "\"") or die(mysqli_error());
else
    $results = $conn->query("SELECT store_uniq, store_name, store_no, store_creditor, address, city, state, zip, country FROM ad_revs WHERE store_name like \"" . $z[0] . "\" AND address like \"" . $z[1] .  " " . $z[2] . "\" AND city like \"" . $z[3] . "\" AND zip like \"" . $z[4] . "\" AND state like \"" . $z[5] . "\"") or die(mysqli_error());

if ($results->num_rows > 0) {
    $rows = $results->fetch_assoc();
    setcookie("stores",$rows['store_name']);
    setcookie("id",$rows['store_uniq']);
    setcookie("contact",$rows['store_creditor']);
}
else
    setcookie("stores",'Not a valid Store');
$results->close();
$conn->close();

?>