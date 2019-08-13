<?php
$conn = mysqli_connect("localhost", "root", "", "adrs");

$affectedRow = 0;

$xml = simplexml_load_file("stores.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $row) {
    $name = mysqli_real_escape_string($conn,$row["name"]);
    $busi = mysqli_real_escape_string($conn,$row["business"]);
    $no = mysqli_real_escape_string($conn,$row["no"]);
    // ads run
    $lat = 1; //mysqli_real_escape_string($conn,$row["lat"]);
    $lng = 1; //mysqli_real_escape_string($conn,$row["long"]);
    $ph = mysqli_real_escape_string($conn,$row["phone"]);
    $t_addr =mysqli_real_escape_string($conn,$row["address"]);
    $addr = "";
    $city = ""; $st = ""; $zip = ""; $cntry = "";
    if ($t_addr != null) {
        $index = 0;
        $holder = str_getcsv($t_addr);
        $addr = trim(mysqli_real_escape_string($conn,$holder[$index++]));
        if (count($holder) >= 5)
            $addr = $addr . " " . trim(mysqli_real_escape_string($conn,$holder[$index++]));
        $city = trim(mysqli_real_escape_string($conn,$holder[$index++]));
        echo $t_addr;
        $st = trim(mysqli_real_escape_string($conn,$holder[$index++]));
        if (is_integer($holder[4])) {
            $zip = trim(mysqli_real_escape_string($conn,$holder[$index++]));
            $cntry = trim(mysqli_real_escape_string($conn,$holder[$index++]));
        }
        else {
            $zip = 00000;
            $cntry = trim(mysqli_real_escape_string($conn,$holder[$index++]));
        }
    }
    $img_dir = md5($ph . "xiv" . $no) ;
    $sql = "INSERT INTO ad_revs(store_uniq,store_name,store_no,store_creditor,phone,ads_run,total_spent,img_dir,
        flags,joined_on,left_on,latitude,longitude,address,city,state,zip,country,avg_hrs_day,avg_ads_hr,reviews,review_tally)
            VALUES (null,'" . $busi . "','" . $no . "','" . $name . "','" . $ph . "',0,0,'"
             . $img_dir . "',0,CURRENT_TIMESTAMP,null,'" . $lat . "','" . $lng . "','" . $addr . "','"
             . $city . "','" . $st . "','" . $zip . "','" . $cntry . "',0,0,0,0)";
    
    $result = mysqli_query($conn, $sql);
    
    if (! empty($result)) {
        $affectedRow++;
        $message = $affectedRow . " records inserted";
        echo $message;
    } else {
        $error_message = mysqli_error($conn) . "\n";
        echo $error_message;
    }
}
?>
<h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
    echo $message;
//    file_put_contents('stores.xml', '<?xml version="1.0"
?><?php //<markers></markers>'); ?>
<?php
} else {
    $message = "No records inserted";
    echo $message;
}

?>