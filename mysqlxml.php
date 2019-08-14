<?php

function sanitize(&$r) {
    $r = filter_var(strip_tags($r), FILTER_SANITIZE_STRING);
}

//$conn = mysqli_connect("localhost", "r0ot3d", "RTYfGhVbN!3$", "adrs", "3306") or die("Error: Cannot create connection");

$conn = mysqli_connect("localhost", "root", "", "adrs", "3306") or die("Error: Cannot create connection");

$affectedRow = 0;

$xml = simplexml_load_file("stores.xml") or die(file_put_contents("stores.xml", "<?xml version=\'1.0\'?><markers></markers>"));

foreach ($xml->children() as $row) {
    
    $name = ($row["name"]);
    $busi = ($row["business"]);
    $no = ($row["no"]);
    // ads run
    $ph = ($row["phone"]);
    $t_addr = ($row["address"]);
    $addr = "";
    $city = ""; $st = ""; $zip = ""; $cntry = "";
    if ($t_addr != null) {
        $index = 0;
        $holder = str_getcsv($t_addr);
        $addr = trim(($holder[$index++]));
        if (count($holder) >= 5)
            $addr = $addr . " " . trim(($holder[$index++]));
        $city = trim(($holder[$index++]));
        
        $st = trim(($holder[$index++]));
        if (is_integer($holder[$index])) {
            $zip = trim(($holder[$index++]));
            $cntry = trim(($holder[$index++]));
        }
        else {
            $zip = 00000;
            $cntry = trim(($holder[$index++]));
        }
    }
    $img_dir = md5($ph . "xiv" . $no) ;
    $sql = 'INSERT INTO ad_revs(store_uniq,store_name,store_no,store_creditor,phone,ads_run,total_spent,img_dir,
        flags,joined_on,left_on,address,city,state,zip,country,avg_hrs_day,avg_ads_hr,reviews,review_tally)
            VALUES (null,"' . $busi . '","' . $no . '","' . $name . '","' . $ph . '",0,0,"'
             . $img_dir . '",0,CURRENT_TIMESTAMP,null,"' . $addr . '","'
             . $city . '","' . $st . '","' . $zip . '","' . $cntry . '",0,0,0,0)';
    
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
} else {
    $message = "No records inserted";
    echo $message;
}
?>