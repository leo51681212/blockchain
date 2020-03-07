//讀資料庫 存成php 變成maps 按下泡泡 用get方式呼叫php
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 425px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
<?php
$servername = "127.0.0.1";
$database = "blockchain";
$username = "root";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);
//mysql_query("set names utf8");
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 

$sql="select * from parking";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else
{echo "DB accessed"."</br>"; 
}
$index=0;

while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    echo "ID".$row['ID']."  Name=".$row['Name']." Lat".$row['Lat']."Lng=".$row['Lng']."</br>";
    $userArray[$index][0]=$row['ID'];
 $userArray[$index][1]=$row['Name'];
 $userArray[$index][2]=$row['Owner'];
 $userArray[$index][3]=$row['OwnerAddr'];
 $userArray[$index][4]=$row['Address'];
  $userArray[$index][5]=$row['Lat'];
 $userArray[$index][6]=$row['Lng'];
 $userArray[$index][7]=$row['HyperLink'];
 $userArray[$index][8]=$row['Image'];
 $userArray[$index][9]=$row['UnitPrice'];
 $userArray[$index][10]=$row['Hour'];
 $userArray[$index][11]=$row['Available'];
$index++;
}

//mysql_free_result($result);
mysqli_close($conn);
$user="john";
echo "php output". $user."</br>";

for($i=0;$i<$index;$i++)
{
 for($j=0;$j<11;$j++)
{
echo "  ".$userArray[$i][$j]; 
}
echo "</br>";
}
?>

<script>
var locations = <?php echo json_encode($userArray); ?>;
var indexVal = "<?php echo $index ?>";
 var marker, i,j;
document.write("Write locations array ");
document.write("</br>");
for (i=0;i<indexVal;i++)
{
locations[i][5]=Number(locations[i][5]);
locations[i][6]=Number(locations[i][6]);
locations[i][9]=Number(locations[i][9]);
locations[i][10]=Number(locations[i][10]);
locations[i][11]=Number(locations[i][11]);
}
for (i=0;i<indexVal;i++)
{
for   (j=0;j<12;j++)
{ 
document.write(locations[i][j]);
document.write(" ");
}
document.write("</br>");
}

      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 25.10, lng: 121.55},
          zoom: 16,
    mapTypeControl:true,
    fullscreenControl:true,
    rotateControl:true,
    scaleControl:true,
    streetViewControl:true,
    zoomControl:true,
    mapTypeControlOptions:{position:google.maps.ControlPosition.TOP_CENTER},
    fullscreenControlOptions:{position:google.maps.ControlPosition.TOP_RIGHT},
    rotateControlOptions:{position:google.maps.ControlPosition.RIGHT_CENTER},
    scaleControlOptions:{position:google.maps.ControlPosition.RIGHT_BOTTOM},
    streetViewControlOptions:{position:google.maps.ControlPosition.TOP_LEFT},
    zoomControlOptions:{position:google.maps.ControlPosition.RIGHT_BOTTOM}
        });
        infoWindow = new google.maps.InfoWindow();

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.watchPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

 
 
    var markers = new Array();
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(Number(locations[i][5]), Number(locations[i][6])),
        map: map,
        url: locations[i][7]

      });
     
    

     

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            alert(locations[i][2]);
var url1="http://120.96.183.29/u03/test0904_1.php?";
//var url1="http://127.0.0.1/CarPark.php?";
document.write(url1+"</br>");
url1=url1.concat('ID=',locations[i][0].toString(),'&','Owner=',locations[i][2],'&','OwnerAddr=',locations[i][3],'&','Address=',locations[i][4],'&','Image=',locations[i][8],'&','UnitPrice=',locations[i][9].toString(),'&','Hour=',locations[i][10].toString(),'&','Available=',locations[i][11].toString()); 
document.write(url1+"</br>");
document.write(url1+"</br>");
location.href=url1;
                     
        }
      })(marker, i));

      markers.push(marker);
    }
AutoCenter();
     }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
  
}
    function AutoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      $.each(markers, function (index, marker) {
      bounds.extend(marker.position);
      });
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
   
 
     


    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD87PjV0DDpv9YD8YGpNs4rWWW1gBNd9uM&callback=initMap">
    </script>
<div id="map"></div>
  </body>
</html>