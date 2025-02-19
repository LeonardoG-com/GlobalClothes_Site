<?php
include('../users/navbar.php');
include('../conDB/con_db.php');

// Faz a consulta para buscar a localização na base de dados
$query = "SELECT nome, latitude, longitude FROM locali WHERE id_loca = 1"; // Substitua "1" pelo ID da localização que deseja buscar
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$nome = $row['nome'];
$latitude = $row['latitude'];
$longitude = $row['longitude'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/PAP/fotos/t2.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/PAP/css/user.css" />
    <title>Global Clothes</title>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>

    <style>
        #map { height: 400px; }
    </style>

</head>
<body>
    <div id="map"></div>

    <h4 style="padding-top:3%"><?php echo $nome; ?></h4>
    

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>
    <script>
        var map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map);
        
        marker.bindPopup('<?php echo $nome; ?>').openPopup();

        var circle = L.circle([<?php echo $latitude; ?>, <?php echo $longitude; ?>], {
            radius: 100,
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5
        }).addTo(map);

        map.fitBounds(circle.getBounds());
    </script>

    <?php
    include('../users/footer.html');
    ?>
</body>
</html>
