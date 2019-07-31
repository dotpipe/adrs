<?php
header("X-Content-Type-Options: nosniff");
header("Content-Type: text/html");
session_start();

$Storename[] = "Sal's Party Store";
$Storename[] = "Hal's Example Store";
$Storename[] = "Hale-Bopp Comedty Shop Examples";

$Storeslogan[] = "Next to the Chicken House!";
$Storeslogan[] = "Behind the Chicken House!";
$Storeslogan[] = "Behind the Moon!";

// array_merge_recursive()

$serial[0][0] = "134123";
$serial[0][1] = "13412";
$serial[0][2] = "13413";
$serial[0][3] = "134123";
$serial[0][4] = "13412";
$serial[0][5] = "13413";
$serial[1][0] = "13123";
$serial[1][1] = "13423";
$serial[2][0] = "14123";

?>
<!DOCTYPE html>
<html>
<head>
<title>
Diads - Follow your Best Deals
</title>
<style>
  #map {
    height: 100%;
    width: 400;
  }
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  // This container element gives us the scrollbars we want.
div.horizontal {
    width: 410px;
    height: 120px;
    overflow: auto;
    padding-bottom: 17px;
}
@import "reset.css";

/* Scroll bar */
/* width */
::-webkit-scrollbar {
  display: none;
  width: 10px;
  background: black;
}

/* Track */
::-webkit-scrollbar-track {
  display: none;
  width: 10px;
  background: darkgray; 
}

/* Handle */
::-webkit-scrollbar-thumb {
  display:none;
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  width: 10px;
  background: #555; 
}

@import url(http://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:300);
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
div.horizontal {
  display: block;
  width: 400px;
  height: 325px;
  overflow: auto;
}
div.horizontal .table {
  display: table;
  table-layout: fixed;
  width: 329px;
}
div.horizontal .table article {
  width: 400px;
  height: 325px;
  display: table-cell;
  background: #e3e3e3;
  vertical-align: middle;
  text-align: center;
    padding-bottom: 17px;
}
div.horizontal .table article:nth-child(2n+2) {
  background: #d1d1d1;
}

div.horizontal1 {
  display: block;
  width: 400px;
  height: 325px;
  overflow: auto;
}
div.horizontal1 .table1 {
  display: table;
  table-layout: fixed;
  width: 390px;
}
div.horizontal1 .table1 article {
  width: 400px;
  height: 325px;
  display: table-cell;
  background: #e3e3e3;
  vertical-align: top;
  text-align: center;
}
div.horizontal1 .table1 article:nth-child(2n+2) {
  background: #d1d1d1;
}

body {
  font-family: 'Open Sans', Helvetica, Arial, sans-serif;
  font-size: 18px;
  line-height: 24px;
}
h1,
h2,
h3,
h4 {
  font-family: 'Open Sans Condensed', Helvetica, Arial, sans-serif;
}
h1 {
  font-size: 54px;
}
h2 {
  font-size: 36px;
  line-height: 48px;
}
header#pageheader {
  line-height: 96px;
  padding-left: 24px;
}
.horizontal-track2 {
  width: 100%;
  height: 17px;
  background: #b4b4b4;
}
.horizontal-handle2 {
  height: 17px;
  background: #555;
}
.horizontal .left {
  display: hidden;
}
.horizontal .right {
  display: hidden;
}
</style>


<script src="gmaps.js">
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6nPPAMCGMzGcTS-HOkT1FXCJ3AqwV2V4&libraries=places&callback=honey"
  async defer></script>
</head>

<body style="background-color:lightgray;">
<?php
$fjs = "javascript:setCookie('addr',document.getElementById('pac-input').value,20);";
$fjs .= "javascript:setCookie('biz',document.getElementById('biz').value,20);";
$fjs .= "javascript:setCookie('name',document.getElementById('name').value,20);";
$fjs .= "javascript:setCookie('type',document.getElementById('type').value,20);";
?>
<div id="pane">
<form method="GET">
<input id="name" type="text" name="name" placeholder="Contact Person">
<input id="biz" type="text" name="biz" placeholder="Name of Business"><br>
<input id="pac-input" name="address" type="text" placeholder="St. No, Street, City, State, Zip, Country">
<input id="type" type="text" name="type" placeholder="Type of Establishment">
<button onclick="<?=$fjs?>submit">Hello!</button>
</form>
</div>

<section>
<div class="horizontal">
<div class="table">
<article style="width:300;border-radius: 10px;border: 5px solid lightgray;">
<div id="map"></div>
</article>
</div>
</div>
</section>
<section>
  <div class="horizontal" style="top_margin:0px;padding-bottom:17px;background-color:lightgray;overflow-x:hidden;overflow-y:none;">
    <div class="table">
      <article>
<?php for ($j = 0 ; $j < count($Storename) ; $j++) { ?>
  <section>
  <div class="horizontal" style="padding-bottom:17px;background-color:lightgray;overflow-x:none;overflow-y:hidden;">
     <div class="table">

<?php for ($i = 0 ; $i < count($serial[$j]) ; $i++) { ?>
    <article name="" serial="<?=$serial[$j][$i]?>" class="card" style="width:300;border-radius: 10px;border: 5px solid lightgray;">
        <b><i><?=$Storename[$j]?></i></b>
        <hr style="height:1px">
        <b><?=$Storeslogan[$j]?></b><br>
        &#11088;&#11088;&#11088;&#11088;&#127775;<br>
        <i>Review Now! !</i> <c class="star" onclick="javascript:confirm_star(1,<?=$serial[$j][$i]?>)">&#9734;</c><c class="star" onclick="javascript:confirm_star(2,<?=$serial[$j][$i]?>)">&#9734;</c><c class="star" onclick="javascript:confirm_star(3,<?=$serial[$j][$i]?>)">&#9734;</c><c class="star" onclick="javascript:confirm_star(4,<?=$serial[$j][$i]?>)">&#9734;</c>

    </article>
<?php } ?>
  </div>
  </div></section>

<?php 
}
?>
</article>
</div>
</div>
</section>

</body>
</html>
