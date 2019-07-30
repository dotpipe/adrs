
var datarray = [];
var ADDR;
function honey() {
  //glaze();
  navigator.geolocation.getCurrentPosition(collectXML);
}

function glaze(address) {
  if (address == "")
    return;
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({ 'address': address }, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) {
    //map.setCenter(results[0].geometry.location);
    var marker = new google.maps.Marker({
      map: map,
      position: results[0].geometry.location
    });
  }
});
}

function collectXML (position) {
        var t = position.coords;
        if (document.cookie.length == 4) {
          var lt = encodeURIComponent(t.latitude);
          var lg = encodeURIComponent(t.longitude);
          console.log(getCookie('addr'));
          var b = encodeURI("marker.php?address=" + getCookie('addr') + "&lat=" + lt + "&long=" + lg + "&business=" + getCookie('biz') + "&name=" + getCookie('name') + "&type=" + getCookie('type');
          passPOST(b);
          setCookie('addr',"");
          setCookie('biz',"");
          setCookie('name',"");
          setCookie('type',"");
        }
        var map = new google.maps.Map(
      document.getElementById('map'),
      {center: {lat: position.coords.latitude, lng: position.coords.longitude}, zoom: 13});

    var input = document.getElementById('pac-input');

    autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    // Specify just the place data fields that you need.
    autocomplete.setFields(['place_id', 'geometry', 'name', 'formatted_address']);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);

          // Change this depending on the name of your PHP or XML file
          downloadUrl('stores.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var biz = markerElem.getAttribute('business');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('long')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              geocoder = new google.maps.Geocoder();
              geocoder.geocode({ 'address': address }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                //map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
                });
                
                var infowindow = new google.maps.InfoWindow({
                  content: "<p>" + name + "&nbsp;&nbsp;&nbsp;&nbsp;<br>" + biz + "&nbsp;&nbsp;&nbsp;&nbsp;<br>" + type + "&nbsp;&nbsp;&nbsp;&nbsp;</p><br>",

                });
                marker.addListener('click', function() {
                  infowindow.open(map, marker)
                });
              }
            });
            glaze(address);
          });
        });
      }

        function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('POST', url, true);
        request.send(null);
      }

      function doNothing() {}


      function passPOST(url) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

var map;
var service;
var infowindow;

function callback2(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    var marker = new google.maps.Marker({
      map: map,
      place: {
        placeId: results[0].place_id,
        location: results[0].geometry.location
      }
    });
  }
}
function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      var place = results[i];
      createMarker(results[i]);
    }
  }
}
function createMarker(place) {
  var marker = new google.maps.Marker({
    map: map,
    name: place.name,
    placeId: place.place_id,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'click', function() {
    console.log(infowindow);
    infowindow.setContent(place.name);
    infowindow.open(map, this);
    });
}
function revitup(i,ts) {
    var rt = 0;
    var card = document.getElementsByTagName("article");
    for (let s = 0 ; s < card.length ; s++) {
        if (card[s].getAttribute("serial") == ts) {
            rt = s;
            break;
        }
    }
    
    var stars = card[rt].getElementsByTagName("c");

    for (let j = 0 ; j < 4 ; j++) {
        stars[j].innerHTML = "&#9734;";
    }

    for (let j = 0 ; j < i ; j++) {
        stars[j].innerHTML = "&#11088;";
    }
}

function review(i,ts) {
  var obj, s
  s = document.createElement("script");
  s.src = "star_rated.php?x=" + i + "&y=" + ts;
  document.body.appendChild(s);
}


function confirm_star(i,ts) {

  if (confirm("You chose " + i + " stars!")) {
    revitup(i,ts);
    review(i,ts);
  }

}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6nPPAMCGMzGcTS-HOkT1FXCJ3AqwV2V4&libraries=places&callback=honey"
  async defer></script>